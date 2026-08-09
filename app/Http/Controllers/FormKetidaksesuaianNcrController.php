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
use App\Models\AksesPertanyaanProdi;
use App\Models\AksesPertanyaanUnit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FormKetidaksesuaianNcrController extends Controller
{
    /**
     * Helper: model akses sesuai role
     */
    private function getAksesModel()
    {
        return auth()->user()->role === 'unit_kerja'
            ? AksesPertanyaanUnit::class
            : AksesPertanyaanProdi::class;
    }

    /**
     * Helper: nama relasi di AuditPtk ke pertanyaan asli
     */
    private function getPertanyaanRelation()
    {
        return auth()->user()->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';
    }

    /**
     * Display listing
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;

        $aksesModel = $this->getAksesModel();
        $relasiPertanyaan = $this->getPertanyaanRelation(); // 'pertanyaanAmiProdi' atau 'pertanyaanAmiUnit'

        /*
        |--------------------------------------------------------------------------
        | DATA TAHUN AKADEMIK (dari akses)
        |--------------------------------------------------------------------------
        */
        $tahunAkademikIds = $aksesModel::forUser($user)
            ->with('pertanyaan.tahunAkademik')
            ->get()
            ->pluck('pertanyaan.tahun_akademik_id')
            ->unique()
            ->filter();

        $tahunAkademik = TahunAkademik::whereIn('id', $tahunAkademikIds)
            ->orderBy('tahun_akademik', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTANYAAN YANG DIAKSES (untuk matriks & kriteria)
        |--------------------------------------------------------------------------
        */
        $aksesList = $aksesModel::forUser($user)
            ->with('pertanyaan.isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        $pertanyaanAmi = $aksesList->pluck('pertanyaan')->filter()->unique('id')->values();

        // PERBAIKAN: muat relasi indikator dengan pertanyaan sesuai role
        $matrixs = $pertanyaanAmi
            ->pluck('isiIndikator.matrix')
            ->filter()
            ->unique('id')
            ->values()
            ->map(function ($matrix) use ($relasiPertanyaan) {
                // Load isiIndikator beserta relasi pertanyaan (prodi atau unit)
                $matrix->load(['isiIndikator.' . $relasiPertanyaan]);
                return $matrix;
            });

        $kriteriaList = $matrixs
            ->pluck('kriteriaAudit.standar')
            ->filter()
            ->unique('id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | QUERY NCR (AUDIT PTK) DENGAN FILTER
        |--------------------------------------------------------------------------
        */
        $query = AuditPtk::with([
            $relasiPertanyaan . '.indikator',
            $relasiPertanyaan . '.tahunAkademik',
            'auditPeriksa'
        ])
        ->where('users_id', $user->id);

        if ($request->filled('tahun_akademik_id')) {
            $query->whereHas($relasiPertanyaan, function ($q) use ($request) {
                $q->where('tahun_akademik_id', $request->tahun_akademik_id);
            });
        }

        $auditPtk = $query->orderBy('created_at', 'asc')->paginate(10)->appends(request()->query());

        $kategoriTemuan = SettingScore::where('generate_ncr', 1)->get();

        return view('pages.form-ketidaksesuaian-ncr', [
            'title'          => 'Form Ketidaksesuaian NCR | SIMANTAP',
            'dataNcr'        => [],
            'kriteriaList'   => $kriteriaList,
            'matrixs'        => $matrixs,
            'auditPtk'       => $auditPtk,
            'tahunAkademik'  => $tahunAkademik,
            'kategoriTemuan' => $kategoriTemuan,
            'relasiPertanyaan' => $relasiPertanyaan,
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
     * Store new NCR
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;

        // Validasi dinamis berdasarkan role
        $rules = [
            'no_ncr'                  => 'required',
            'klausul_dokumen'         => 'required',
            'deskripsi_uraian_temuan' => 'required',
            'kategori_temuan'         => 'required',
            'status_ncr'              => 'required',
            'audit_periksa_id'        => 'nullable|exists:audit_periksa,id',
        ];

        if ($role === 'unit_kerja') {
            $rules['pertanyaan_ami_unit_id'] = 'required|exists:pertanyaan_ami_unit,id';
        } else {
            $rules['pertanyaan_ami_prodi_id'] = 'required|exists:pertanyaan_ami_prodi,id';
        }

        $request->validate($rules);

        // Ambil pertanyaan asli berdasarkan role
        if ($role === 'unit_kerja') {
            $pertanyaan = PertanyaanAmiUnit::find($request->pertanyaan_ami_unit_id);
            $foreignKey = 'pertanyaan_ami_unit_id';
        } else {
            $pertanyaan = PertanyaanAmiProdi::find($request->pertanyaan_ami_prodi_id);
            $foreignKey = 'pertanyaan_ami_prodi_id';
        }

        // Cek apakah user punya akses ke pertanyaan ini (via tabel akses)
        $aksesModel = $this->getAksesModel();
        $hasAccess = $aksesModel::forUser($user)
            ->where('pertanyaan_id', $pertanyaan->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk pertanyaan ini.'
            ], 403);
        }

        // Siapkan data
        $data = $request->all();
        $data['users_id'] = $user->id;
        $data['isi_indikator_id'] = $pertanyaan->isi_indikator_id;
        $data['audit_periksa_id'] = $request->audit_periksa_id ?? null;

        // Hanya simpan foreign key yang sesuai
        if ($role === 'unit_kerja') {
            $data['pertanyaan_ami_unit_id'] = $pertanyaan->id;
            $data['pertanyaan_ami_prodi_id'] = null;
        } else {
            $data['pertanyaan_ami_prodi_id'] = $pertanyaan->id;
            $data['pertanyaan_ami_unit_id'] = null;
        }

        AuditPtk::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data NCR berhasil ditambahkan.'
        ]);
    }

    /**
     * Edit NCR (AJAX / modal)
     */
    public function edit($id)
    {
        $relasi = $this->getPertanyaanRelation();

        $data = AuditPtk::with([
            $relasi . '.indikator.matrix.kriteriaAudit.standar'
        ])->findOrFail($id);

        // Pastikan NCR milik user yang login
        if ($data->users_id !== auth()->id()) {
            abort(403);
        }

        // Ambil informasi tambahan untuk tampilan modal
        $pertanyaan = $data->{$relasi};
        $isiIndikator = $pertanyaan->indikator ?? null;
        $matrix = $isiIndikator->matrix ?? null;
        $kriteriaAudit = $matrix->kriteriaAudit ?? null;
        $standar = $kriteriaAudit->standar ?? null;

        $data->kriteria_id = $standar->id ?? null;
        $data->matrixs_id = $matrix->id ?? null;
        $data->elemen_nama = $matrix->elemen ?? null;
        $data->kriteria_nama = $standar->nama ?? null;

        return response()->json(['data' => $data]);
    }

    /**
     * Update NCR
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $role = $user->role;

        $auditPtk = AuditPtk::where('users_id', $user->id)->findOrFail($id);

        // Validasi dinamis
        $rules = [
            'no_ncr'                  => 'required',
            'klausul_dokumen'         => 'required',
            'deskripsi_uraian_temuan' => 'required',
            'kategori_temuan'         => 'required',
            'status_ncr'              => 'required',
            'audit_periksa_id'        => 'nullable|exists:audit_periksa,id',
        ];

        if ($role === 'unit_kerja') {
            $rules['pertanyaan_ami_unit_id'] = 'required|exists:pertanyaan_ami_unit,id';
        } else {
            $rules['pertanyaan_ami_prodi_id'] = 'required|exists:pertanyaan_ami_prodi,id';
        }

        $request->validate($rules);

        // Ambil pertanyaan asli
        if ($role === 'unit_kerja') {
            $pertanyaan = PertanyaanAmiUnit::find($request->pertanyaan_ami_unit_id);
            $foreignKey = 'pertanyaan_ami_unit_id';
        } else {
            $pertanyaan = PertanyaanAmiProdi::find($request->pertanyaan_ami_prodi_id);
            $foreignKey = 'pertanyaan_ami_prodi_id';
        }

        // Cek akses
        $aksesModel = $this->getAksesModel();
        $hasAccess = $aksesModel::forUser($user)
            ->where('pertanyaan_id', $pertanyaan->id)
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk pertanyaan ini.'
            ], 403);
        }

        // Update data
        $data = $request->all();
        $data['isi_indikator_id'] = $pertanyaan->isi_indikator_id;
        $data['audit_periksa_id'] = $request->audit_periksa_id ?? $auditPtk->audit_periksa_id;

        if ($role === 'unit_kerja') {
            $data['pertanyaan_ami_unit_id'] = $pertanyaan->id;
            $data['pertanyaan_ami_prodi_id'] = null;
        } else {
            $data['pertanyaan_ami_prodi_id'] = $pertanyaan->id;
            $data['pertanyaan_ami_unit_id'] = null;
        }

        $auditPtk->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data NCR berhasil diupdate.'
        ]);
    }

    /**
     * Delete NCR
     */
    public function destroy($id)
    {
        $data = AuditPtk::where('users_id', auth()->id())->findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data NCR berhasil dihapus'
        ]);
    }
}