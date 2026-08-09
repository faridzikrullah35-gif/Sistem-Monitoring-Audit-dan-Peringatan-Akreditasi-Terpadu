<?php

namespace App\Http\Controllers;

use App\Models\IsiIndikator;
use App\Models\PertanyaanAmiUnit;
use App\Models\AksesPertanyaanUnit;
use App\Models\TahunAkademik;
use App\Models\User;
use App\Models\FormTerpenuhi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PertanyaanAmiUnitController extends Controller
{
    public function index(Request $request)
    {
        // Dropdown Kriteria
        $kriteria = IsiIndikator::join('matrixs', 'isi_indikator.matrixs_id', '=', 'matrixs.id')
            ->join('kriteria_audit', 'matrixs.kriteria_audit_id', '=', 'kriteria_audit.id')
            ->join('standar', 'kriteria_audit.standar_id', '=', 'standar.id')
            ->select('standar.id', 'standar.nama')
            ->distinct()
            ->orderBy('standar.nama')
            ->get();

        // Dropdown Tahun Akademik
        $tahunAkademik = TahunAkademik::where('status', 'Aktif')
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        // ===== Ambil semua indikator beserta relasi standar untuk dropdown dinamis =====
        $indikators = IsiIndikator::with([
            'matrix.kriteriaAudit.standar'
        ])->get();

        // ===== Filter akses =====
        $filterAksesOptions = AksesPertanyaanUnit::select('role', 'unit', 'sub_unit')
            ->distinct()
            ->orderBy('role')
            ->orderBy('unit')
            ->orderBy('sub_unit')
            ->get()
            ->map(function ($item) {
                $sub = $item->sub_unit ?: '(tanpa sub unit)';
                return [
                    'value' => $item->role . '|' . $item->unit . '|' . ($item->sub_unit ?? ''),
                    'label' => $item->role . ' - ' . $item->unit . ' - ' . $sub
                ];
            });

        // ===== Data pertanyaan dengan filter =====
        $dataPertanyaan = PertanyaanAmiUnit::with([
            'isiIndikator.matrix.kriteriaAudit.standar',
            'tahunAkademik',
            'akses'
        ])
        ->when($request->tahun_id, function ($query) use ($request) {
            $query->where('tahun_akademik_id', $request->tahun_id);
        })
        ->when($request->kriteria_id, function ($query) use ($request) {
            $query->whereHas('isiIndikator.matrix.kriteriaAudit', function ($q) use ($request) {
                $q->where('standar_id', $request->kriteria_id);
            });
        })
        ->when($request->akses_filter, function ($query) use ($request) {
            [$role, $unit, $sub_unit] = explode('|', $request->akses_filter);
            $query->whereHas('akses', function ($q) use ($role, $unit, $sub_unit) {
                $q->where('role', $role)
                  ->where('unit', $unit)
                  ->where('sub_unit', $sub_unit);
            });
        })
        ->join('isi_indikator', 'pertanyaan_ami_unit.isi_indikator_id', '=', 'isi_indikator.id')
        ->orderBy('isi_indikator.matrixs_id')
        ->select('pertanyaan_ami_unit.*')
        ->paginate(10);

        if ($request->ajax()) {
            return view('components.pertanyaan-ami-unit.question-list', compact('dataPertanyaan'))->render();
        }

        // ===== Data untuk dropdown role, unit, sub unit =====
        $roles = User::select('role')->distinct()->whereNotNull('role')->pluck('role');
        $units = User::select('unit')->distinct()->whereNotNull('unit')->pluck('unit');
        $subUnits = User::select('sub_unit')->distinct()->whereNotNull('sub_unit')->pluck('sub_unit');

        $roleData = User::select('role', 'unit', 'sub_unit')
            ->where('role', 'unit_kerja')
            ->whereNotNull('unit')
            ->get()
            ->groupBy('role')
            ->map(function ($roleGroup) {
                return $roleGroup->groupBy('unit')
                    ->map(function ($unitGroup) {
                        return $unitGroup->pluck('sub_unit')
                            ->filter()
                            ->unique()
                            ->values()
                            ->toArray();
                    })
                    ->toArray();
            })
            ->toArray();

        return view('pages.pertanyaan-ami-unit', compact(
            'kriteria',
            'tahunAkademik',
            'dataPertanyaan',
            'roles',
            'units',
            'subUnits',
            'roleData',
            'filterAksesOptions',
            'indikators' // <-- tambahkan
        ));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kriteria_id'    => 'required|exists:standar,id',
                'indikator_ids'  => 'required|array',
                'indikator_ids.*'=> 'required|exists:isi_indikator,id',
                'tahun'          => 'required|exists:tahun_akademik,id',
                'role'           => 'required|string|max:255',
                'unit'           => 'required|string|max:255',
                'sub_unit'       => 'required|string|max:255',
            ]);

            DB::beginTransaction();

            $indikatorIds = $validated['indikator_ids'];
            $tahunId = $validated['tahun'];
            $kriteriaId = $validated['kriteria_id'];
            $aksesData = [
                'role'     => $validated['role'],
                'unit'     => $validated['unit'],
                'sub_unit' => $validated['sub_unit'] ?? null,
            ];

            // Validasi tambahan: pastikan semua indikator memiliki standar_id sesuai kriteria
            $indikators = IsiIndikator::with('matrix.kriteriaAudit')
                ->whereIn('id', $indikatorIds)
                ->get();

            foreach ($indikators as $indikator) {
                if (!$indikator->matrix || !$indikator->matrix->kriteriaAudit || $indikator->matrix->kriteriaAudit->standar_id != $kriteriaId) {
                    throw new \Exception('Salah satu indikator tidak sesuai dengan kriteria yang dipilih.');
                }
            }

            $savedCount = 0;
            foreach ($indikatorIds as $indikatorId) {
                // Simpan pertanyaan (hindari duplikasi)
                $pertanyaan = PertanyaanAmiUnit::firstOrCreate([
                    'isi_indikator_id'   => $indikatorId,
                    'tahun_akademik_id'  => $tahunId,
                ]);

                // Tambahkan akses
                $pertanyaan->akses()->firstOrCreate($aksesData);

                $savedCount++;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Berhasil menyimpan {$savedCount} data pertanyaan AMI Unit beserta akses.",
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tahun' => 'required|exists:tahun_akademik,id',
            ]);

            $data = PertanyaanAmiUnit::findOrFail($id);
            $data->update([
                'tahun_akademik_id' => $validated['tahun'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat update data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = PertanyaanAmiUnit::find($id);
            if (!$data) {
                return response()->json(['success' => true, 'message' => 'Data tidak ditemukan.']);
            }

            FormTerpenuhi::where('pertanyaan_ami_unit_id', $id)->delete();
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyFiltered(Request $request)
    {
        try {
            $query = PertanyaanAmiUnit::query();

            if ($request->tahun_id) {
                $query->where('tahun_akademik_id', $request->tahun_id);
            }

            if ($request->kriteria_id) {
                $query->whereHas('isiIndikator.matrix.kriteriaAudit', function ($q) use ($request) {
                    $q->where('standar_id', $request->kriteria_id);
                });
            }

            // Hapus akses filter, sesuai dengan Prodi

            $ids = $query->pluck('id');

            if ($ids->isNotEmpty()) {
                FormTerpenuhi::whereIn('pertanyaan_ami_unit_id', $ids)->delete();
                PertanyaanAmiUnit::whereIn('id', $ids)->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data yang difilter.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteAll(Request $request)
    {
        try {
            $query = PertanyaanAmiUnit::query();

            if ($request->tahun_id) {
                $query->where('tahun_akademik_id', $request->tahun_id);
            }

            if ($request->kriteria_id) {
                $query->whereHas('isiIndikator.matrix.kriteriaAudit', function ($q) use ($request) {
                    $q->where('standar_id', $request->kriteria_id);
                });
            }

            // Hapus akses filter, sesuai dengan Prodi

            $ids = $query->pluck('id');

            if ($ids->isNotEmpty()) {
                FormTerpenuhi::whereIn('pertanyaan_ami_unit_id', $ids)->delete();
                PertanyaanAmiUnit::whereIn('id', $ids)->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus semua data.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}