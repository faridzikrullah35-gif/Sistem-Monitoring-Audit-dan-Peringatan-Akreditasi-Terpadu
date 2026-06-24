<?php

namespace App\Http\Controllers;

use App\Models\AuditPtk;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use App\Models\Matrix;
use App\Models\SettingScore;
use App\Models\SettingAksesAuditor;
use App\Models\IsiAksesAuditor;
use App\Models\Auditiee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FormKetidaksesuaianNcrController extends Controller
{
    /**
     * Display listing
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;

        $pertanyaanAmiModel = match($role) {
            'unit_kerja' => PertanyaanAmiUnit::class,
            default      => PertanyaanAmiProdi::class,
        };

        $relasiPertanyaan = match($role) {
            'unit_kerja' => 'pertanyaanAmiUnit',
            default      => 'pertanyaanAmiProdi',
        };

        // Ambil semua indikator dari pertanyaan_ami_prodi
        $indikatorIds = $pertanyaanAmiModel::pluck('isi_indikator_id');

        // Query matrix
        $matrixs = Matrix::with([
            'kriteriaAudit.standar',
            'isiIndikator.' . $relasiPertanyaan
        ])
        ->whereHas('isiIndikator', function ($q) use ($indikatorIds) {
            $q->whereIn('id', $indikatorIds);
        })
        ->get();

        // Kriterialist untuk dropdown
        $kriteriaList = $matrixs
            ->pluck('kriteriaAudit.standar')
            ->filter()
            ->unique('id')
            ->values();

        // Ambil semua tahun_akademik_id yang unique dari tabel pertanyaan_ami_prodi
        $tahunAkademik = TahunAkademik::whereIn(
            'id',
            $pertanyaanAmiModel::select('tahun_akademik_id')
                ->whereNotNull('tahun_akademik_id')
        )
        ->orderBy('tahun_akademik', 'desc')
        ->orderBy('semester', 'desc')
        ->get();

        // ========== QUERY AUDIT PTK DENGAN FILTER ==========
        $query = AuditPtk::with([
            $relasiPertanyaan . '.indikator',
            $relasiPertanyaan . '.tahunAkademik',
            'auditPeriksa'
        ])
        ->where('users_id', auth()->id());;

        // Filter berdasarkan tahun akademik jika ada
        if ($request->filled('tahun_akademik_id')) {
            $query->whereHas($relasiPertanyaan, function($q) use ($request) {
                $q->where(
                    'tahun_akademik_id',
                    $request->tahun_akademik_id
                );
            });
        }

        $auditPtk = $query->orderBy('created_at', 'asc')->paginate(10)->appends(request()->query());

        $kategoriTemuan = SettingScore::where('generate_ncr', 1)->get();

        // Debug: cek apakah $tahunAkademik ada datanya
        // dd($tahunAkademik); // Uncomment untuk cek

        return view('pages.form-ketidaksesuaian-ncr', [
            'title' => 'Form Ketidaksesuaian NCR | SIMANTAP',
            'dataNcr' => [],
            'kriteriaList' => $kriteriaList,
            'matrixs' => $matrixs,
            'auditPtk' => $auditPtk,
            'tahunAkademik' => $tahunAkademik,
            'kategoriTemuan' => $kategoriTemuan,
        ]);
    }

    public function print(Request $request)
    {
        $user = auth()->user();
        $userId = auth()->id();
        $tahunAkademikId = $request->tahun_akademik_id;

        /*
        |----------------------------------------
        | DATA NCR (AUDIT PTK)
        |----------------------------------------
        */
        $ncrItems = AuditPtk::with([
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiUnit.isiIndikator',
            'auditPeriksa'
        ])
        ->where('users_id', $userId)
        ->when($tahunAkademikId, function ($query) use ($tahunAkademikId) {
            $query->where(function ($q) use ($tahunAkademikId) {
                $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                })
                ->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                });
            });
        })
        ->orderBy('id', 'desc')
        ->get();

        /*
        |----------------------------------------
        | LOKASI AUDIT
        |----------------------------------------
        */
        $lokasi_audit = implode(' - ', array_filter([
            $user->sub_unit ?? null,
            $user->unit ?? null
        ]));

        /*
        |----------------------------------------
        | TAHUN AKADEMIK FALLBACK
        |----------------------------------------
        */
        $tahunYangDigunakan = $tahunAkademikId;

        if (!$tahunYangDigunakan && $ncrItems->isNotEmpty()) {
            $first = $ncrItems->first();

            $tahunYangDigunakan =
                $first->pertanyaanAmiProdi->tahun_akademik_id
                ?? $first->pertanyaanAmiUnit->tahun_akademik_id
                ?? null;
        }

        $tahunAkademik = TahunAkademik::find($tahunYangDigunakan);

        /*
        |----------------------------------------
        | AUDITOR SETTING (SAMA KAYAK DAFTAR PERIKSA)
        |----------------------------------------
        */
        $setting = SettingAksesAuditor::where('user_id', $userId)->first();

        $auditors = collect();
        $leadAuditorName = null;
        $leadAuditorNidn = null;
        $tanggal_audit = null;

        if ($setting) {
            $tanggal_audit = $setting->tgl_audit
                ? Carbon::parse($setting->tgl_audit)->translatedFormat('d F Y')
                : null;

            $isiAkses = IsiAksesAuditor::with('auditor')
                ->where('setting_akses_auditor_id', $setting->id)
                ->whereIn('posisi', ['lead_auditor', 'anggota'])
                ->get();

            $auditors = $isiAkses->map(function ($item) {
                return [
                    'nama' => $item->auditor->nama_auditor ?? '-',
                    'role' => $item->posisi === 'lead_auditor' ? 'Lead Auditor' : 'Anggota',
                    'nidn' => $item->auditor->identity_number ?? null,
                ];
            });

            $lead = $isiAkses->firstWhere('posisi', 'lead_auditor');
            if ($lead && $lead->auditor) {
                $leadAuditorName = $lead->auditor->nama_auditor;
                $leadAuditorNidn = $lead->auditor->identity_number;
            }
        }

        // fallback lead auditor
        if (!$leadAuditorName) {
            $leadAuditorName = '_________________________';
            $leadAuditorNidn = '_________________';
        }

        /*
        |----------------------------------------
        | AUDITEE
        |----------------------------------------
        */
        $auditees = Auditiee::where('users_id', $userId)->get();

        /*
        |----------------------------------------
        | SIGNATURES
        |----------------------------------------
        */
        $kabalai = IsiAksesAuditor::with('auditor')
            ->where('setting_akses_auditor_id', $setting->id ?? null)
            ->where('posisi', 'posisi_kepala_bidang_internal')
            ->first();

        if (!$kabalai || !$kabalai->auditor) {
            $kabalai = (object)[
                'auditor' => (object)[
                    'nama_auditor' => '_________________________',
                    'identity_number' => '_________________'
                ]
            ];
        }

        $kepalaLPM = IsiAksesAuditor::with('auditor')
            ->where('setting_akses_auditor_id', $setting->id ?? null)
            ->where('posisi', 'posisi_kepala_lembaga_penjaminan_mutu')
            ->first();

        if (!$kepalaLPM || !$kepalaLPM->auditor) {
            $kepalaLPM = (object)[
                'auditor' => (object)[
                    'nama_auditor' => '_________________________',
                    'identity_number' => '_________________'
                ]
            ];
        }

        /*
        |----------------------------------------
        | RETURN VIEW
        |----------------------------------------
        */
        return view('auditor.form-ketidaksesuaian-ncr.print', compact(
            'ncrItems',
            'tahunAkademik',
            'auditors',
            'auditees',
            'leadAuditorName',
            'leadAuditorNidn',
            'kabalai',
            'kepalaLPM',
            'tanggal_audit',
            'lokasi_audit',
            'tahunAkademikId'
        ));
    }

    /**
     * Store new data
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan_ami_prodi_id' => 'required|exists:pertanyaan_ami_prodi,id',
            'no_ncr' => 'required',
            'klausul_dokumen' => 'required',
            'deskripsi_uraian_temuan' => 'required',
            'kategori_temuan' => 'required',
            'status_ncr' => 'required',
        ]);

        $pertanyaanAmiProdi = PertanyaanAmiProdi::find($request->pertanyaan_ami_prodi_id);
        
        $data = $request->all();
        $data['isi_indikator_id'] = $pertanyaanAmiProdi->isi_indikator_id;
        $data['audit_periksa_id'] = $request->audit_periksa_id ?? null;
        $data['users_id'] = auth()->user()->id;
        
        AuditPtk::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data NCR berhasil ditambahkan.'
        ]);
    }

    /**
     * Edit data (AJAX / modal)
     */
    public function edit($id)
    {
        $data = AuditPtk::with([
            'pertanyaanAmiProdi.indikator.matrix.kriteriaAudit.standar'
        ])->findOrFail($id);
        
        // Cari kriteria_id dan matrixs_id dari relasi
        $pertanyaan = $data->pertanyaanAmiProdi;
        $isiIndikator = $pertanyaan->indikator ?? null;
        $matrix = $isiIndikator->matrix ?? null;
        $kriteriaAudit = $matrix->kriteriaAudit ?? null;
        $standar = $kriteriaAudit->standar ?? null;
        
        // Tambahkan ke response
        $data->kriteria_id = $standar->id ?? null;
        $data->matrixs_id = $matrix->id ?? null;
        $data->elemen_nama = $matrix->elemen ?? null;
        $data->kriteria_nama = $standar->nama ?? null;

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan_ami_prodi_id' => 'required|exists:pertanyaan_ami_prodi,id',
            'no_ncr' => 'required', // required tapi tidak harus unique
            'klausul_dokumen' => 'required',
            'deskripsi_uraian_temuan' => 'required',
            'kategori_temuan' => 'required',
            'status_ncr' => 'required',
        ]);

        $data = AuditPtk::findOrFail($id);
        
        $input = $request->all();
        $input['audit_periksa_id'] = $request->audit_periksa_id ?? $data->audit_periksa_id;
        
        // $input['isi_indikator_id'] = $request->isi_indikator_id ?? $data->isi_indikator_id;
        
        $data->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data NCR berhasil diupdate.'
        ]);
    }

    /**
     * Delete data
     */
    public function destroy($id)
    {
        $data = AuditPtk::findOrFail($id);

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data NCR berhasil dihapus'
        ]);
    }
}