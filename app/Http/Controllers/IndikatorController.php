<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IsiIndikator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class IndikatorController extends Controller
{
    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'elemen_id' => 'required|exists:matrixs,id',
            'indikator_input' => 'required|string|max:1000',
        ]);

        $data = IsiIndikator::create([
            'matrixs_id' => $request->elemen_id,
            'indikator' => $request->indikator_input,
        ]);

        return response()->json([
            'message' => 'Indikator berhasil ditambahkan',
            'data' => $data
        ]);
    }

    // =========================
    // SHOW (ambil semua indikator per matrix)
    // =========================
    public function getByElemen($id)
    {
        $data = IsiIndikator::where('matrixs_id', $id)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'indikator_input' => 'required|string|max:1000',
        ]);

        $data = IsiIndikator::findOrFail($id);

        $data->update([
            'indikator' => $request->indikator_input,
        ]);

        return response()->json([
            'message' => 'Indikator berhasil diupdate'
        ]);
    }

    // =========================
    // DELETE (cascade manual: cucu -> anak -> induk)
    // =========================
    public function destroy($id)
    {
        $data = IsiIndikator::with(['pertanyaanAmiProdi', 'pertanyaanAmiUnit'])->find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        try {
            DB::transaction(function () use ($data, $id) {
                $prodiIds = $data->pertanyaanAmiProdi->pluck('id');
                $unitIds  = $data->pertanyaanAmiUnit->pluck('id');

                // form_terpenuhi (punya isi_indikator_id langsung + prodi_id + unit_id)
                DB::table('form_terpenuhi')
                    ->where('isi_indikator_id', $id)
                    ->delete();

                if ($prodiIds->isNotEmpty()) {
                    DB::table('akses_pertanyaan_prodi')
                        ->whereIn('pertanyaan_id', $prodiIds)
                        ->delete();

                    DB::table('audit_observasi')
                        ->whereIn('pertanyaan_ami_prodi_id', $prodiIds)
                        ->delete();

                    DB::table('audit_periksa')
                        ->whereIn('pertanyaan_ami_prodi_id', $prodiIds)
                        ->delete();

                    DB::table('audit_ptk')
                        ->whereIn('pertanyaan_ami_prodi_id', $prodiIds)
                        ->delete();
                }

                if ($unitIds->isNotEmpty()) {
                    DB::table('akses_pertanyaan_unit')
                        ->whereIn('pertanyaan_id', $unitIds)
                        ->delete();

                    DB::table('audit_observasi')
                        ->whereIn('pertanyaan_ami_unit_id', $unitIds)
                        ->delete();
                }

                // Level anak: pertanyaan_ami_prodi / pertanyaan_ami_unit
                $data->pertanyaanAmiProdi()->delete();
                $data->pertanyaanAmiUnit()->delete();

                // Level induk: isi_indikator
                $data->delete();
            });
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Masih ada data turunan yang belum bisa dihapus otomatis.',
                'error' => $e->getMessage(),
            ], 409);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Indikator berhasil dihapus (beserta seluruh data terkait)'
        ]);
    }
}