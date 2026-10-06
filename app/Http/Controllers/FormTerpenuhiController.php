<?php

namespace App\Http\Controllers;

use App\Models\FormTerpenuhi;
use App\Models\Matrix;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use App\Models\AksesPertanyaanProdi;
use App\Models\AksesPertanyaanUnit;
use App\Models\SettingHeaderCetak;
use Illuminate\Http\Request;

class FormTerpenuhiController extends Controller
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
     * Helper: nama relasi di FormTerpenuhi ke pertanyaan asli
     */
    private function getPertanyaanRelation()
    {
        return auth()->user()->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $aksesModel = $this->getAksesModel();
        $relasiPertanyaan = $this->getPertanyaanRelation();

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

        $matrixs = $pertanyaanAmi
            ->pluck('isiIndikator.matrix')
            ->filter()
            ->unique('id')
            ->values()
            ->map(function ($matrix) {
                // PERBAIKAN: harus eager-load kedua relasi pertanyaan (prodi & unit)
                // di dalam isiIndikator, karena JS di blade membaca
                // item.pertanyaan_ami_prodi dan item.pertanyaan_ami_unit
                // untuk membangun opsi dropdown Indikator (add & edit mode).
                // Sebelumnya cuma load('isiIndikator') tanpa relasi nested ini,
                // jadi kedua field itu selalu kosong di JSON -> dropdown Indikator kosong.
                $matrix->load(['isiIndikator.pertanyaanAmiProdi', 'isiIndikator.pertanyaanAmiUnit']);
                return $matrix;
            });

        $kriteriaList = $matrixs
            ->pluck('kriteriaAudit.standar')
            ->filter()
            ->unique('id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | QUERY TERPENUHI
        |--------------------------------------------------------------------------
        */
        $terpenuhi = FormTerpenuhi::with([
            $relasiPertanyaan . '.indikator',
            'matrix.kriteriaAudit',
            'user',
        ])
        ->where('users_id', $user->id)
        ->when($request->filled('tahun_akademik_id'), function ($query) use ($request, $relasiPertanyaan) {
            $query->whereHas($relasiPertanyaan, function ($q) use ($request) {
                $q->where('tahun_akademik_id', $request->tahun_akademik_id);
            });
        })
        ->orderBy('id', 'asc')
        ->paginate(10)
        ->appends(request()->query());

        // Alpine filter → return JSON
        if ($request->ajax() && $request->wantsJson()) {
            return response()->json([
                'table' => view('components.form-terpenuhi.terpenuhi-table', ['terpenuhi' => $terpenuhi])->render()
            ]);
        }

        // TableRefresh & normal request → return full view
        return view('pages.form-terpenuhi', [
            'title'         => 'Form Terpenuhi | SIMANTAP',
            'terpenuhi'     => $terpenuhi,
            'kriteriaList'  => $kriteriaList,
            'matrixs'       => $matrixs,
            'tahunAkademik' => $tahunAkademik,
        ]);
    }

    /**
     * Print form terpenuhi berdasarkan filter tahun akademik
     */
    public function print(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $tahunAkademikId = $request->tahun_akademik_id;
        $relasiPertanyaan = $this->getPertanyaanRelation();

        $terpenuhiItems = FormTerpenuhi::with([
            $relasiPertanyaan . '.isiIndikator',
            'matrix.kriteriaAudit.standar',
            'user'
        ])
        ->where('users_id', $userId)
        ->when($tahunAkademikId, function ($query) use ($tahunAkademikId, $relasiPertanyaan) {
            $query->whereHas($relasiPertanyaan, function ($q) use ($tahunAkademikId) {
                $q->where('tahun_akademik_id', $tahunAkademikId);
            });
        })
        ->orderBy('id', 'asc')
        ->get();

        /*
        |--------------------------------------------------------------------------
        | TAHUN AKADEMIK
        |--------------------------------------------------------------------------
        */
        $tahunAkademik = null;
        if ($tahunAkademikId) {
            $tahunAkademik = TahunAkademik::find($tahunAkademikId);
        } elseif ($terpenuhiItems->isNotEmpty()) {
            $first = $terpenuhiItems->first();
            $pertanyaan = $first->{$relasiPertanyaan};
            $tahunId = $pertanyaan->tahun_akademik_id ?? null;
            $tahunAkademik = $tahunId
                ? TahunAkademik::find($tahunId)
                : null;
        }

        /*
        |--------------------------------------------------------------------------
        | SETTING HEADER CETAK
        |--------------------------------------------------------------------------
        */
        $settingHeader = SettingHeaderCetak::where('auditor_id', $userId)
            ->where('role', $user->role)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | DEFAULT JIKA BELUM DISETTING
        |--------------------------------------------------------------------------
        */
        $noDokumen = $settingHeader?->no_dokumen ?? '-';
        $tanggalTerbit = $settingHeader?->tanggal_terbit
            ? $settingHeader->tanggal_terbit->format('d-m-Y')
            : '-';
        $revisi = $settingHeader?->no_revisi ?? '-';
        return view('auditor.form-terpenuhi.print', compact(
            'terpenuhiItems',
            'tahunAkademik',
            'noDokumen',
            'tanggalTerbit',
            'revisi'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;

        // Validasi dinamis
        $rules = [
            'matrixs_id'    => 'required|exists:matrixs,id',
            'isi_indikator_id' => 'nullable|exists:isi_indikator,id',
            'rekomendasi'      => 'nullable|string',
        ];

        if ($role === 'unit_kerja') {
            $rules['pertanyaan_ami_unit_id'] = 'required|exists:pertanyaan_ami_unit,id';
        } else {
            $rules['pertanyaan_ami_prodi_id'] = 'required|exists:pertanyaan_ami_prodi,id';
        }

        $validated = $request->validate($rules);

        // Ambil pertanyaan asli berdasarkan role
        if ($role === 'unit_kerja') {
            $pertanyaan = PertanyaanAmiUnit::find($validated['pertanyaan_ami_unit_id']);
            $prodiId = null;
            $unitId = $pertanyaan->id;
        } else {
            $pertanyaan = PertanyaanAmiProdi::find($validated['pertanyaan_ami_prodi_id']);
            $prodiId = $pertanyaan->id;
            $unitId = null;
        }

        // Cek akses user terhadap pertanyaan ini
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

        // Ambil isi_indikator_id dari pertanyaan jika tidak dikirim
        $isiIndikatorId = $validated['isi_indikator_id'] ?? $pertanyaan->isi_indikator_id;

        // Simpan
        $data = FormTerpenuhi::create([
            'users_id' => $user->id,
            'matrixs_id' => $validated['matrixs_id'],
            'pertanyaan_ami_prodi_id' => $prodiId,
            'pertanyaan_ami_unit_id'  => $unitId,
            'isi_indikator_id' => $isiIndikatorId,
            'rekomendasi'      => $validated['rekomendasi'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data terpenuhi berhasil disimpan',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $relasiPertanyaan = $this->getPertanyaanRelation();
        $isUnit = auth()->user()->role === 'unit_kerja';

        try {
            $terpenuhi = FormTerpenuhi::with([
                'matrix.kriteriaAudit.standar',
                'matrix.isiIndikator.' . $relasiPertanyaan,
            ])->findOrFail($id);

            // Pastikan data milik user yang login
            if ($terpenuhi->users_id !== auth()->id()) {
                abort(403);
            }

            $matrix = $terpenuhi->matrix;
            $kriteriaId = optional(optional($matrix->kriteriaAudit)->standar)->id;

            // Ambil isi_indikator_id dari pertanyaan jika null
            $isi_indikator_id = $terpenuhi->isi_indikator_id;
            if (!$isi_indikator_id) {
                $pertanyaan = $terpenuhi->{$relasiPertanyaan};
                $isi_indikator_id = $pertanyaan?->isi_indikator_id;
            }

            // Ambil daftar indikator untuk dropdown (dari matrix)
            $indikatorList = [];
            if ($matrix && $matrix->isiIndikator) {
                $indikatorList = $matrix->isiIndikator->map(function ($item) use ($relasiPertanyaan, $isUnit) {
                    $pertanyaan = $item->{$relasiPertanyaan}->first();
                    $pertanyaanId = optional($pertanyaan)->id;
                    return [
                        'id'                     => $item->id,
                        'indikator'              => $item->indikator,
                        'pertanyaan_ami_prodi_id' => $isUnit ? null : $pertanyaanId,
                        'pertanyaan_ami_unit_id'  => $isUnit ? $pertanyaanId : null,
                        'value' => $pertanyaanId,
                        'type'  => $isUnit ? 'unit' : 'prodi',
                        'label' => $item->indikator,
                        'isi_indikator_id' => $item->id,
                    ];
                });
            }

            return response()->json([
                'data' => [
                    'id'                     => $terpenuhi->id,
                    'kriteria_id'            => $kriteriaId,
                    'matrixs_id'             => $terpenuhi->matrixs_id,
                    'indikator_list'         => $indikatorList,
                    'selected_indikator_id'  => $terpenuhi->pertanyaan_ami_unit_id
                                                ?? $terpenuhi->pertanyaan_ami_prodi_id,
                    'selected_type'          => $terpenuhi->pertanyaan_ami_unit_id ? 'unit' : 'prodi',
                    'isi_indikator_id'       => $isi_indikator_id,
                    'rekomendasi'            => $terpenuhi->rekomendasi,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Data tidak ditemukan',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $role = $user->role;

        $terpenuhi = FormTerpenuhi::where('users_id', $user->id)->findOrFail($id);

        // Validasi dinamis
        $rules = [
            'matrixs_id'    => 'required|exists:matrixs,id',
            'isi_indikator_id' => 'nullable|exists:isi_indikator,id',
            'rekomendasi'      => 'nullable|string',
        ];

        if ($role === 'unit_kerja') {
            $rules['pertanyaan_ami_unit_id'] = 'required|exists:pertanyaan_ami_unit,id';
        } else {
            $rules['pertanyaan_ami_prodi_id'] = 'required|exists:pertanyaan_ami_prodi,id';
        }

        $validated = $request->validate($rules);

        // Ambil pertanyaan asli
        if ($role === 'unit_kerja') {
            $pertanyaan = PertanyaanAmiUnit::find($validated['pertanyaan_ami_unit_id']);
            $prodiId = null;
            $unitId = $pertanyaan->id;
        } else {
            $pertanyaan = PertanyaanAmiProdi::find($validated['pertanyaan_ami_prodi_id']);
            $prodiId = $pertanyaan->id;
            $unitId = null;
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

        $isiIndikatorId = $validated['isi_indikator_id'] ?? $pertanyaan->isi_indikator_id;

        // Update
        $terpenuhi->update([
            'matrixs_id' => $validated['matrixs_id'],
            'pertanyaan_ami_prodi_id' => $prodiId,
            'pertanyaan_ami_unit_id'  => $unitId,
            'isi_indikator_id' => $isiIndikatorId,
            'rekomendasi'      => $validated['rekomendasi'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data terpenuhi berhasil diperbarui',
            'data' => $terpenuhi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $terpenuhi = FormTerpenuhi::where('users_id', auth()->id())->findOrFail($id);
        $terpenuhi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terpenuhi berhasil dihapus'
        ]);
    }
}