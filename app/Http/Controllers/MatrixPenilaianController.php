<?php

namespace App\Http\Controllers;

use App\Models\Matrix;
use App\Models\KriteriaAudit;
use Illuminate\Http\Request;

class MatrixPenilaianController extends Controller
{
    public function index(Request $request)
    {
        $query = Matrix::with('kriteriaAudit.standar')->latest();

        if ($request->kriteria_id) {
            $query->where('kriteria_audit_id', $request->kriteria_id);
        }

        $matrixs = $query->paginate(10);

        if ($request->ajax()) {
            return view('components.matrix-penilaian.matrix-table', compact('matrixs'))->render();
        }

        $kriterias = KriteriaAudit::with('standar')->get();

        return view('pages.isi-matrix-penilaian', compact('matrixs', 'kriterias'));
    }

    // ==========================
    // STORE
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'kriteria' => 'required|exists:kriteria_audit,id',
            'elemen' => 'required|string|max:1000',
        ]);

        $data = Matrix::create([
            'kriteria_audit_id' => $request->kriteria,
            'elemen' => $request->elemen,
        ]);

        return response()->json([
            'message' => 'Matrix berhasil ditambahkan',
            'data' => $data
        ]);
    }

    // ==========================
    // SHOW (UNTUK EDIT MODAL)
    // ==========================
    public function show($id)
    {
        $data = Matrix::with('kriteriaAudit')->findOrFail($id);

        return response()->json([
            'id' => $data->id,
            'kriteria' => $data->kriteria_audit_id,
            'elemen' => $data->elemen,
        ]);
    }

    // ==========================
    // UPDATE
    // ==========================
    public function update(Request $request, $id)
    {
        $matrix = Matrix::findOrFail($id);

        $request->validate([
            'kriteria' => 'required|exists:kriteria_audit,id',
            'elemen' => 'required|string|max:1000',
        ]);

        $matrix->update([
            'kriteria_audit_id' => $request->kriteria,
            'elemen' => $request->elemen,
        ]);

        return response()->json([
            'message' => 'Matrix berhasil diupdate',
            'data' => $matrix
        ]);
    }

    // ==========================
    // DELETE
    // ==========================
    public function destroy($id)
    {
        $matrix = Matrix::findOrFail($id);
        $matrix->delete();

        return response()->json([
            'message' => 'Matrix berhasil dihapus'
        ]);
    }
}