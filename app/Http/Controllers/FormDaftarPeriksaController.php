<?php

namespace App\Http\Controllers;

use App\Models\AuditPeriksa;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use App\Models\Matrix;
use App\Models\IsiIndikator;
use App\Models\SettingScore;
use App\Models\FormTerpenuhi;
use App\Models\FormObservasi;
use App\Models\SettingAksesAuditor;
use App\Models\IsiAksesAuditor;
use App\Models\DataAuditor;
use App\Models\Auditiee;
use App\Models\User;
use App\Models\AksesPertanyaanProdi;
use App\Models\AksesPertanyaanUnit;
use App\Models\SettingHeaderCetak;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FormDaftarPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Model akses sesuai role
        $aksesModel = $user->role === 'unit_kerja'
            ? AksesPertanyaanUnit::class
            : AksesPertanyaanProdi::class;

        // Relasi yang dipakai di AuditPeriksa (tetap ke tabel asli)
        $relasiPertanyaan = $user->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';

        /*
        |--------------------------------------------------------------------------
        | DATA DROPDOWN TAHUN AKADEMIK
        |--------------------------------------------------------------------------
        */
        // Ambil semua akses yang sesuai dengan user, lalu ambil tahun_akademik_id
        // dari relasi pertanyaan (tanpa join manual)
        $tahunAkademikIds = $aksesModel::forUser($user)
            ->with('pertanyaan.tahunAkademik')
            ->get()
            ->pluck('pertanyaan.tahun_akademik_id')
            ->unique()
            ->filter(); // hilangkan nilai null

        $tahunAkademik = TahunAkademik::whereIn('id', $tahunAkademikIds)
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTANYAAN YANG DIAKSES
        |--------------------------------------------------------------------------
        */
        $aksesList = $aksesModel::forUser($user)
            ->with('pertanyaan.isiIndikator.matrix.kriteriaAudit.standar')
            ->get();

        // Kumpulkan pertanyaan asli (unik) dari akses
        $pertanyaanAmi = $aksesList->pluck('pertanyaan')->filter()->unique('id')->values();

        /*
        |--------------------------------------------------------------------------
        | TABLE UTAMA (data audit yang sudah diisi)
        |--------------------------------------------------------------------------
        */
        $pertanyaan = AuditPeriksa::with([
            $relasiPertanyaan . '.isiIndikator.matrix.kriteriaAudit.standar',
            'score',
        ])
        ->where('users_id', $user->id)
        ->paginate(10)
        ->appends(request()->query());

        /*
        |--------------------------------------------------------------------------
        | MATRIX & KRITERIA
        |--------------------------------------------------------------------------
        */
        $matrixs = $pertanyaanAmi
            ->pluck('isiIndikator.matrix')
            ->filter()
            ->unique('id')
            ->values()
            ->map(function ($matrix) {
                $matrix->load('isiIndikator');
                return $matrix;
            });

        $kriteriaList = $matrixs
            ->pluck('kriteriaAudit.standar')
            ->filter()
            ->unique('id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | SCORE
        |--------------------------------------------------------------------------
        */
        $settingScores = SettingScore::all();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view('pages.form-daftar-periksa', [
            'title'         => 'Form Daftar Periksa | SIMANTAP',
            'tahunAkademik' => $tahunAkademik,
            'kriteriaList'  => $kriteriaList,
            'settingScores' => $settingScores,
            'pertanyaan'    => $pertanyaan,
            'pertanyaanAmi' => $pertanyaanAmi,
            'matrixs'       => $matrixs,
        ]);
    }

    public function print(Request $request)
    {
        $user = auth()->user();
        $userId = auth()->id();
        $tahunAkademikId = $request->tahun_akademik_id;
        // SETTING HEADER CETAK
        $settingHeaderCetak = SettingHeaderCetak::where('auditor_id', $userId)
            ->where('role', $user->role)
            ->first();
        // =======================
        // DATA AUDIT PERIKSA
        // =======================
        $data = AuditPeriksa::with([
            'score',
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiUnit.isiIndikator'
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
        ->orderBy('id', 'asc')
        ->get();

        $lokasi_audit = implode(' - ', array_filter([
            $user->sub_unit,
            $user->unit
        ]));

        // =======================
        // AUDITEE
        // =======================
        $auditees = Auditiee::where('users_id', $userId)
        ->get();

        // =======================
        // AMBIL TAHUN AKTIF
        // =======================
        $tahunYangDigunakan = $tahunAkademikId;

        if (!$tahunYangDigunakan && $data->isNotEmpty()) {
            $first = $data->first();

            $tahunYangDigunakan =
                $first->pertanyaanAmiProdi->tahun_akademik_id
                ?? $first->pertanyaanAmiUnit->tahun_akademik_id
                ?? null;
        }

        // =======================
        // AUDITOR
        // =======================
        $setting = SettingAksesAuditor::where('user_id', $userId)->first();

        $auditors = collect();
        $leadAuditorName = null;
        $leadAuditorNidn = null;

        if ($setting) {
            $tanggal_audit = $setting?->tgl_audit
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

            // Fallback jika tidak ada lead auditor
            if (!$leadAuditorName) {
                $leadAuditorName = '_________________________';
                $leadAuditorNidn = '_________________';
            }

            $kabalai = IsiAksesAuditor::with('auditor')
                ->where('setting_akses_auditor_id', $setting->id ?? null)
                ->where('posisi', 'posisi_kepala_bidang_internal')
                ->first();

            if (!$kabalai || !$kabalai->auditor) {
                $kabalai = (object) [
                    'auditor' => (object) [
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
                $kepalaLPM = (object) [
                    'auditor' => (object) [
                        'nama_auditor' => '_________________________',
                        'identity_number' => '_________________'
                    ]
                ];
            }

        // =======================
        // FALLBACK AMAN
        // =======================
        if ($auditors->isEmpty()) {
            $auditors = collect([[
                'nama' => 'Data Auditor Tidak Tersedia',
                'role' => '-',
                'nidn' => null,
            ]]);
        }

        // =======================
        // RETURN VIEW
        // =======================
        return view('auditor.form-daftar-periksa.print', compact(
            'data',
            'auditees',
            'auditors',
            'tahunAkademikId',
            'lokasi_audit',
            'tanggal_audit',
            'leadAuditorName',
            'leadAuditorNidn',
            'kabalai',
            'kepalaLPM',
            'settingHeaderCetak',
        ));
    }

    /**
     * Helper untuk mengambil model akses
     */
    private function getAksesModel()
    {
        return auth()->user()->role === 'unit_kerja'
            ? AksesPertanyaanUnit::class
            : AksesPertanyaanProdi::class;
    }

    /**
     * Helper untuk relasi di AuditPeriksa (tetap ke tabel asli)
     */
    private function getPertanyaanRelation()
    {
        return auth()->user()->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_indikator_id'   => 'required|exists:isi_indikator,id',
            'uraian_temuan'      => 'required|string',
            'analisis_penyebab'  => 'required|string',
            'akibat'             => 'required|string',
            'setting_score_id'   => 'nullable|exists:setting_scores,id',
            'panduan_pengisian'  => 'nullable|string',
        ]);

        $user = auth()->user();
        $aksesModel = $this->getAksesModel();

        // Cari akses yang sesuai dengan user dan isi_indikator_id
        $akses = $aksesModel::forUser($user)
            ->whereHas('pertanyaan', function ($q) use ($request) {
                $q->where('isi_indikator_id', $request->isi_indikator_id);
            })
            ->first();

        if (!$akses) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk pertanyaan ini.'
            ], 403);
        }

        // Ambil pertanyaan asli dari relasi
        $pertanyaanAsli = $akses->pertanyaan; // instance PertanyaanAmiProdi atau Unit

        // Tentukan foreign key mana yang diisi
        $foreignKeyProdi = null;
        $foreignKeyUnit = null;

        if ($pertanyaanAsli instanceof PertanyaanAmiProdi) {
            $foreignKeyProdi = $pertanyaanAsli->id;
        } elseif ($pertanyaanAsli instanceof PertanyaanAmiUnit) {
            $foreignKeyUnit = $pertanyaanAsli->id;
        }

        // Simpan ke AuditPeriksa
        $data = AuditPeriksa::create([
            'users_id' => $user->id,
            'pertanyaan_ami_prodi_id' => $foreignKeyProdi,
            'pertanyaan_ami_unit_id'  => $foreignKeyUnit,
            'uraian_temuan'     => $request->uraian_temuan,
            'analisis_penyebab' => $request->analisis_penyebab,
            'akibat'            => $request->akibat,
            'setting_score_id'  => $request->setting_score_id,
            'panduan_pengisian' => $request->panduan_pengisian,
        ]);

        $data = $data->fresh([
            'score',
            'pertanyaanAmiProdi',
            'pertanyaanAmiUnit'
        ]);

        $this->handlePtk($data);
        $this->handleObservasi($data);
        $this->handleTerpenuhi($data);

        return response()->json([
            'success' => true,
            'message' => 'Data audit berhasil disimpan',
            'data'    => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $relasiPertanyaan = $this->getPertanyaanRelation();

        $data = AuditPeriksa::with([
            $relasiPertanyaan . '.isiIndikator.matrix.kriteriaAudit.standar',
            'score'
        ])
        ->where('users_id', auth()->id())
        ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'uraian_temuan'      => 'required|string',
            'analisis_penyebab'  => 'required|string',
            'akibat'             => 'required|string',
            'setting_score_id'   => 'nullable|exists:setting_scores,id',
            'panduan_pengisian'  => 'nullable|string',
        ]);

        $audit = AuditPeriksa::where('users_id', auth()->id())->findOrFail($id);

        $audit->update([
            'uraian_temuan'     => $request->uraian_temuan,
            'analisis_penyebab' => $request->analisis_penyebab,
            'akibat'            => $request->akibat,
            'setting_score_id'  => $request->setting_score_id,
            'panduan_pengisian' => $request->panduan_pengisian,
        ]);

        $audit = $audit->fresh();

        $this->handlePtk($audit);
        $this->handleObservasi($audit);
        $this->handleTerpenuhi($audit);

        return response()->json([
            'success' => true,
            'message' => 'Data audit berhasil diperbarui',
            'data'    => $audit
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $audit = AuditPeriksa::where('users_id', auth()->id())->findOrFail($id);

        $audit->ptk()->delete();
        $audit->observasi()->delete();
        $audit->terpenuhi()->delete();

        $audit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    // ====== METODE PEMBANTU UNTUK NCR, OBSERVASI, TERPENUHI ======

    private function handlePtk($audit)
    {
        $score = $audit->score;

        if (!$score || !$score->generate_ncr) {
            $audit->ptk()->delete();
            return;
        }

        $audit->ptk()->updateOrCreate(
            ['audit_periksa_id' => $audit->id],
            [
                'users_id' => $audit->users_id,
                'pertanyaan_ami_prodi_id' => $audit->pertanyaan_ami_prodi_id,
                'pertanyaan_ami_unit_id'  => $audit->pertanyaan_ami_unit_id,
                'no_ncr' => null,
                'klausul_dokumen' => null,
                'deskripsi_uraian_temuan' => $audit->uraian_temuan,
                'analisis_penyebab' => $audit->analisis_penyebab,
                'akibat' => $audit->akibat,
                'kategori_temuan' => $score->keterangan,
                'status_ncr' => 'Open',
            ]
        );
    }

    private function handleObservasi($audit)
    {
        $score = $audit->score;
        $nilai = (int) ($score->nilai_score ?? 0);

        if (!$score || $nilai !== 3) {
            $audit->observasi()->delete();
            return;
        }

        $pertanyaan = $audit->pertanyaanAmiProdi ?? $audit->pertanyaanAmiUnit;
        $matrixId = optional(optional($pertanyaan)->isiIndikator)->matrixs_id;

        $audit->observasi()->updateOrCreate(
            ['audit_periksa_id' => $audit->id],
            [
                'users_id' => $audit->users_id,
                'pertanyaan_ami_prodi_id' => $audit->pertanyaan_ami_prodi_id,
                'pertanyaan_ami_unit_id'  => $audit->pertanyaan_ami_unit_id,
                'matrixs_id' => $matrixId,
            ]
        );
    }

    private function handleTerpenuhi($audit)
    {
        $score = $audit->score;
        $nilai = (int) ($score->nilai_score ?? 0);

        if (!$score || $nilai !== 4) {
            $audit->terpenuhi()->delete();
            return;
        }

        $pertanyaan = $audit->pertanyaanAmiProdi ?? $audit->pertanyaanAmiUnit;
        $indikator = optional($pertanyaan)->isiIndikator;
        $matrix = Matrix::with('kriteriaAudit.standar')->find($indikator?->matrixs_id);

        $audit->terpenuhi()->updateOrCreate(
            ['audit_periksa_id' => $audit->id],
            [
                'users_id' => $audit->users_id,
                'matrixs_id' => $indikator?->matrixs_id,
                'isi_indikator_id' => $indikator?->id,
                'pertanyaan_ami_prodi_id' => $audit->pertanyaan_ami_prodi_id,
                'pertanyaan_ami_unit_id'  => $audit->pertanyaan_ami_unit_id,
                'discussed_with' => null,
                'rekomendasi' => null,
            ]
        );
    }
}
