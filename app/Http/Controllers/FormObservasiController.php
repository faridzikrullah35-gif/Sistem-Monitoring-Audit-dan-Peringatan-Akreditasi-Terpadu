<?php

namespace App\Http\Controllers;

use App\Models\FormObservasi;
use App\Models\Matrix;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class FormObservasiController extends Controller
{
    public function index(Request $request)
    {
        $pertanyaanModel = $this->getPertanyaanModel();

        $pertanyaanRelation = $this->getPertanyaanRelation();

        $indikatorIds = $pertanyaanModel::pluck('isi_indikator_id');

        $matrixs = Matrix::with([
            'kriteriaAudit.standar',
            'isiIndikator.' . $pertanyaanRelation
        ])
        ->whereHas('isiIndikator', function ($q) use ($indikatorIds) {
            $q->whereIn('id', $indikatorIds);
        })
        ->get();

        $kriteriaList = $matrixs
            ->pluck('kriteriaAudit.standar')
            ->filter()
            ->unique('id')
            ->values();

        $tahunAkademikIdsProdi = PertanyaanAmiProdi::whereNotNull('tahun_akademik_id')
            ->pluck('tahun_akademik_id');
        $tahunAkademikIdsUnit = PertanyaanAmiUnit::whereNotNull('tahun_akademik_id')
            ->pluck('tahun_akademik_id');
        $tahunAkademik = TahunAkademik::whereIn(
                'id',
                $tahunAkademikIdsProdi->merge($tahunAkademikIdsUnit)->unique()
            )
            ->orderBy('tahun_akademik', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        $observasi = FormObservasi::with([
            'pertanyaanAmiProdi.indikator',
            'pertanyaanAmiUnit.indikator',
            'matrix.kriteriaAudit',
            'user',
        ])
        ->where('users_id', auth()->id())
        
        ->when($request->filled('tahun_akademik_id'), function ($query) use ($request) {
            $tahunId = $request->tahun_akademik_id;
            $query->where(function ($q) use ($tahunId) {
                $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($tahunId) {
                    $sub->where('tahun_akademik_id', $tahunId);
                })
                ->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($tahunId) {
                    $sub->where('tahun_akademik_id', $tahunId);
                });
            });
        })
        ->orderBy('id', 'asc')
        ->paginate(10)
        ->appends(request()->query());

        // Alpine filter → return JSON
        if ($request->ajax() && $request->wantsJson()) {
            return response()->json([
                'table' => view('components.form-observasi.observation-table',
                    ['observasi' => $observasi]
                )->render()
            ]);
        }

        // TableRefresh & normal request → return full view
        return view('pages.form-observasi', [
            'title'         => 'Form Observasi | SIMANTAP',
            'observasi'     => $observasi,
            'kriteriaList'  => $kriteriaList,
            'matrixs'       => $matrixs,
            'tahunAkademik' => $tahunAkademik,
        ]);
    }

    private function getPertanyaanModel()
    {
        return auth()->user()->role === 'unit_kerja'
            ? \App\Models\PertanyaanAmiUnit::class
            : \App\Models\PertanyaanAmiProdi::class;
    }

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
        $validated = $request->validate([
            'matrixs_id' => 'required|exists:matrixs,id',
            'pertanyaan_ami_prodi_id' => 'nullable|exists:pertanyaan_ami_prodi,id',
            'pertanyaan_ami_unit_id'  => 'nullable|exists:pertanyaan_ami_unit,id',
            'isi_indikator_id' => 'nullable|exists:isi_indikator,id',
            'discussed_with'   => 'nullable|string',
            'rekomendasi'      => 'nullable|string',
        ]);

        $data = FormObservasi::create([
            'users_id' => auth()->id(),
            'matrixs_id' => $validated['matrixs_id'],

            'pertanyaan_ami_prodi_id' => $validated['pertanyaan_ami_prodi_id'] ?? null,
            'pertanyaan_ami_unit_id'  => $validated['pertanyaan_ami_unit_id'] ?? null,

            'isi_indikator_id' => $validated['isi_indikator_id'] ?? null,
            'discussed_with'   => $validated['discussed_with'] ?? null,
            'rekomendasi'      => $validated['rekomendasi'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data observasi berhasil disimpan',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $observasi = FormObservasi::with([
                'matrix.kriteriaAudit.standar',
                'matrix.isiIndikator.pertanyaanAmiProdi'
            ])->findOrFail($id);

            $matrix = $observasi->matrix;

            $kriteriaId = optional(
                optional($matrix->kriteriaAudit)->standar
            )->id;

            $isi_indikator_id = $observasi->isi_indikator_id;

            if (!$isi_indikator_id && $observasi->pertanyaan_ami_prodi_id) {
                $pertanyaan = PertanyaanAmiProdi::find($observasi->pertanyaan_ami_prodi_id);
                $isi_indikator_id = $pertanyaan?->isi_indikator_id;
            }

            // ambil list indikator biar frontend gak blank pas edit
            $indikatorList = [];

            if ($matrix && $matrix->isiIndikator) {
                $indikatorList = $matrix->isiIndikator->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'indikator' => $item->indikator,
                        'pertanyaan_ami_prodi_id' =>
                            optional($item->pertanyaanAmiProdi->first())->id
                    ];
                });
            }

            return response()->json([
                'data' => [
                    'id' => $observasi->id,
                    'kriteria_id' => $kriteriaId,
                    'matrixs_id' => $observasi->matrixs_id,

                    'indikator_list' => $indikatorList,

                    'pertanyaan_ami_prodi_id' => $observasi->pertanyaan_ami_prodi_id,
                    'pertanyaan_ami_unit_id' => $observasi->pertanyaan_ami_unit_id,
                    'isi_indikator_id' => $isi_indikator_id,

                    'discussed_with' => $observasi->discussed_with,
                    'rekomendasi' => $observasi->rekomendasi,
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
        $validated = $request->validate([
            'matrixs_id' => 'required|exists:matrixs,id',

            'pertanyaan_ami_prodi_id' => 'nullable|exists:pertanyaan_ami_prodi,id',
            'pertanyaan_ami_unit_id'  => 'nullable|exists:pertanyaan_ami_unit,id',

            'isi_indikator_id' => 'nullable|exists:isi_indikator,id',
            'discussed_with'   => 'nullable|string',
            'rekomendasi'      => 'nullable|string',
        ]);

        $observasi = FormObservasi::findOrFail($id);

        $observasi->update([
            'matrixs_id' => $validated['matrixs_id'],

            'pertanyaan_ami_prodi_id' => $validated['pertanyaan_ami_prodi_id'] ?? null,
            'pertanyaan_ami_unit_id'  => $validated['pertanyaan_ami_unit_id'] ?? null,

            'isi_indikator_id' => $validated['isi_indikator_id'] ?? null,
            'discussed_with'   => $validated['discussed_with'] ?? null,
            'rekomendasi'      => $validated['rekomendasi'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data observasi berhasil diperbarui',
            'data' => $observasi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $observasi = FormObservasi::findOrFail($id);

        $observasi->delete();

        return response()->json([

            'success' => true,
            'message' => 'Data observasi berhasil dihapus'
        ]);
    }
}