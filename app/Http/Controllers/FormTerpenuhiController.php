<?php

namespace App\Http\Controllers;

use App\Models\FormTerpenuhi;
use App\Models\Matrix;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class FormTerpenuhiController extends Controller
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

        $terpenuhi = FormTerpenuhi::with([
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
                'table' => view('components.form-terpenuhi.terpenuhi-table',
                    ['terpenuhi' => $terpenuhi]
                )->render()
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

    public function print(Request $request)
    {
        $userId = auth()->id();
        $tahunAkademikId = $request->tahun_akademik_id;

        $terpenuhiItems = FormTerpenuhi::with([
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiUnit.isiIndikator',
            'matrix.kriteriaAudit.standar',
            'user'
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

        $tahunAkademik = null;

        if ($tahunAkademikId) {

            $tahunAkademik = TahunAkademik::find($tahunAkademikId);

        } elseif ($terpenuhiItems->isNotEmpty()) {

            $first = $terpenuhiItems->first();

            $tahunId =
                $first->pertanyaanAmiProdi->tahun_akademik_id
                ?? $first->pertanyaanAmiUnit->tahun_akademik_id
                ?? null;

            $tahunAkademik = $tahunId
                ? TahunAkademik::find($tahunId)
                : null;
        }

        return view(
            'auditor.form-terpenuhi.print',
            compact(
                'terpenuhiItems',
                'tahunAkademik'
            )
        );
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

        $data = FormTerpenuhi::create([
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
            'message' => 'Data terpenuhi berhasil disimpan',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $pertanyaanRelation = $this->getPertanyaanRelation();
            $isUnit = auth()->user()->role === 'unit_kerja';

            $terpenuhi = FormTerpenuhi::with([
                'matrix.kriteriaAudit.standar',
                'matrix.isiIndikator.pertanyaanAmiProdi',
                'matrix.isiIndikator.pertanyaanAmiUnit',
            ])->findOrFail($id);

            $matrix = $terpenuhi->matrix;

            $kriteriaId = optional(
                optional($matrix->kriteriaAudit)->standar
            )->id;

            $isi_indikator_id = $terpenuhi->isi_indikator_id;

            if (!$isi_indikator_id && $terpenuhi->pertanyaan_ami_prodi_id) {
                $pertanyaan = PertanyaanAmiProdi::find($terpenuhi->pertanyaan_ami_prodi_id);
                $isi_indikator_id = $pertanyaan?->isi_indikator_id;
            }

            if (!$isi_indikator_id && $terpenuhi->pertanyaan_ami_unit_id) {
                $pertanyaan = PertanyaanAmiUnit::find($terpenuhi->pertanyaan_ami_unit_id);
                $isi_indikator_id = $pertanyaan?->isi_indikator_id;
            }

            $indikatorList = [];

            if ($matrix && $matrix->isiIndikator) {
                $indikatorList = $matrix->isiIndikator->map(function ($item) use ($isUnit) {
                    return [
                        'id'                     => $item->id,
                        'indikator'              => $item->indikator,
                        'pertanyaan_ami_prodi_id' => optional($item->pertanyaanAmiProdi->first())->id,
                        'pertanyaan_ami_unit_id'  => optional($item->pertanyaanAmiUnit->first())->id,
                        // value & type untuk frontend
                        'value' => $isUnit
                            ? optional($item->pertanyaanAmiUnit->first())->id
                            : optional($item->pertanyaanAmiProdi->first())->id,
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
                    'discussed_with'         => $terpenuhi->discussed_with,
                    'rekomendasi'            => $terpenuhi->rekomendasi,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Data tidak ditemukan',
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

        $terpenuhi = FormTerpenuhi::findOrFail($id);

        $terpenuhi->update([
            'matrixs_id' => $validated['matrixs_id'],
            'pertanyaan_ami_prodi_id' => $validated['pertanyaan_ami_prodi_id'] ?? null,
            'pertanyaan_ami_unit_id'  => $validated['pertanyaan_ami_unit_id'] ?? null,
            'isi_indikator_id' => $validated['isi_indikator_id'] ?? null,
            'discussed_with'   => $validated['discussed_with'] ?? null,
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
        $terpenuhi = FormTerpenuhi::findOrFail($id);

        $terpenuhi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terpenuhi berhasil dihapus'
        ]);
    }
}