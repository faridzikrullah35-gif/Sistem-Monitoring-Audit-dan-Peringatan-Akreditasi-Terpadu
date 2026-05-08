<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IsiIndikator;

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
            'matrixs_id' => $request->elemen_id, // FIX
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
    // DELETE
    // =========================
    public function destroy($id)
    {
        $data = IsiIndikator::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'message' => 'Indikator berhasil dihapus'
        ]);
    }
}