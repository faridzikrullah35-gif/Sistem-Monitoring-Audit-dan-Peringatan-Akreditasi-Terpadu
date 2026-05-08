<?php

namespace App\Http\Controllers;

use App\Models\IsiIndikator;
use App\Models\PertanyaanAmiProdi;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PertanyaanAmiProdiController extends Controller
{
    /**
     * Index Page
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Dropdown Kriteria
        |--------------------------------------------------------------------------
        */

        $kriteria = IsiIndikator::join('matrixs', 'isi_indikator.matrixs_id', '=', 'matrixs.id')
            ->join('kriteria_audit', 'matrixs.kriteria_audit_id', '=', 'kriteria_audit.id')
            ->join('standar', 'kriteria_audit.standar_id', '=', 'standar.id')
            ->select(
                'standar.id',
                'standar.nama'
            )
            ->distinct()
            ->orderBy('standar.nama')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Dropdown Tahun Akademik
        |--------------------------------------------------------------------------
        */

        $tahunAkademik = TahunAkademik::orderBy('tahun_akademik')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Query Data Pertanyaan
        |--------------------------------------------------------------------------
        */

        $dataPertanyaan = PertanyaanAmiProdi::with([
            'isiIndikator.matrix.kriteriaAudit.standar',
            'tahunAkademik'
                ])

                ->when($request->tahun_id, function ($query) use ($request) {

                    $query->where('tahun_akademik_id', $request->tahun_id);

                })

                ->when($request->kriteria_id, function ($query) use ($request) {

                    $query->whereHas('isiIndikator.matrix.kriteriaAudit', function ($q) use ($request) {

                        $q->where('standar_id', $request->kriteria_id);

                    });

                })

                ->join(
                    'isi_indikator',
                    'pertanyaan_ami_prodi.isi_indikator_id',
                    '=',
                    'isi_indikator.id'
                )

                ->orderBy('isi_indikator.matrixs_id')
                ->select('pertanyaan_ami_prodi.*')
                ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | AJAX Request
        |--------------------------------------------------------------------------
        */

        if ($request->ajax()) {

            return view(
                'components.pertanyaan-ami-prodi.question-list',
                compact('dataPertanyaan')
            )->render();
        }

        return view('pages.pertanyaan-ami-prodi', compact(
            'kriteria',
            'tahunAkademik',
            'dataPertanyaan'
        ));
    }

    /**
     * Store Data (AJAX)
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'kriteria' => 'required|array|min:1',
                'kriteria.*' => 'exists:standar,id',

                'tahun' => 'required|exists:tahun_akademik,id',
            ]);

            DB::beginTransaction();

            /*
            |--------------------------------------------------------------------------
            | Ambil semua isi indikator berdasarkan standar yang dipilih
            |--------------------------------------------------------------------------
            */

            $indikator = IsiIndikator::join('matrixs', 'isi_indikator.matrixs_id', '=', 'matrixs.id')
                ->join('kriteria_audit', 'matrixs.kriteria_audit_id', '=', 'kriteria_audit.id')
                ->whereIn('kriteria_audit.standar_id', $validated['kriteria'])
                ->select('isi_indikator.id')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Simpan Data
            |--------------------------------------------------------------------------
            */

            foreach ($indikator as $item) {

                PertanyaanAmiProdi::firstOrCreate([
                    'isi_indikator_id' => $item->id,
                    'tahun_akademik_id' => $validated['tahun'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pertanyaan AMI Prodi berhasil disimpan.',
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
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update Data (AJAX)
     */
    public function update(Request $request, $id)
    {
        try {

            $validated = $request->validate([
                'tahun' => 'required|exists:tahun_akademik,id',
            ]);

            $data = PertanyaanAmiProdi::findOrFail($id);

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

    /**
     * Delete Data (AJAX)
     */
    public function destroy($id)
    {
        $data = PertanyaanAmiProdi::findOrFail($id);

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Indikator berhasil dihapus.'
        ]);
    }

    public function destroyFiltered(Request $request)
    {
        $query = PertanyaanAmiProdi::query();

        // samakan dengan filter index
        if ($request->tahun_id) {
            $query->where('tahun_akademik_id', $request->tahun_id);
        }

        if ($request->kriteria_id) {
            $query->whereHas('isiIndikator.matrix.kriteriaAudit', function ($q) use ($request) {
                $q->where('standar_id', $request->kriteria_id);
            });
        }

        $deleted = $query->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus data"
        ]);
    }

    public function deleteAll(Request $request)
    {
        try {

            // optional: filter ikut request (kalau mau global beneran)
            $query = PertanyaanAmiProdi::query();

            // kalau nanti kamu mau versi "delete sesuai filter"
            if ($request->tahun_id) {
                $query->where('tahun_akademik_id', $request->tahun_id);
            }

            if ($request->kriteria_id) {
                $query->whereHas('isiIndikator.matrix.kriteriaAudit', function ($q) use ($request) {
                    $q->where('standar_id', $request->kriteria_id);
                });
            }

            $deleted = $query->delete();

            return response()->json([
                'success' => true,
                'message' => "Berhasil menghapus data",
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}