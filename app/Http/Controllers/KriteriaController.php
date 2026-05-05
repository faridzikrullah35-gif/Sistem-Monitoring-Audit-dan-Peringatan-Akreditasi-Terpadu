<?php

namespace App\Http\Controllers;

use App\Models\Standar;
use App\Models\KriteriaAudit;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * LIST PAGE (VIEW + PAGINATION)
     */
    public function index()
    {
        $standars = Standar::with('kriteria')
            ->orderBy('nama', 'asc')
            ->paginate(10);

        return view('pages.setting-kriteria', compact('standars'));
    }

    /**
     * SHOW DETAIL KRITERIA (AJAX)
     */
    public function show($id)
    {
        $kriteria = KriteriaAudit::with('standar')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $kriteria->id,
                'standar_id' => $kriteria->standar_id,
                'sub_kriteria' => $kriteria->sub_kriteria
            ]
        ]);
    }

    /**
     * STORE SUB-KRITERIA (AJAX)
     */
    public function store(Request $request)
    {
        $request->validate([
            'standar_id'   => 'required|exists:standar,id',
            'sub_kriteria' => 'required|string'
        ]);

        $kriteria = KriteriaAudit::create([
            'standar_id'   => $request->standar_id,
            'sub_kriteria' => $request->sub_kriteria,
        ]);

        return response()->json([
            'message' => 'Sub-Kriteria berhasil ditambahkan!',
            'data'    => $kriteria,
        ]);
    }

    /**
     * UPDATE SUB-KRITERIA
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'standar_id'   => 'required|exists:standar,id',
            'sub_kriteria' => 'required|string'
        ]);

        $kriteria = KriteriaAudit::findOrFail($id);

        $kriteria->update([
            'standar_id'   => $request->standar_id,
            'sub_kriteria' => $request->sub_kriteria,
        ]);

        return response()->json([
            'message' => 'Sub-Kriteria berhasil diupdate!',
            'data'    => $kriteria,
        ]);
    }

    /**
     * DELETE SUB-KRITERIA
     */
    public function destroy($id)
    {
        $kriteria = KriteriaAudit::findOrFail($id);
        $kriteria->delete();

        return response()->json([
            'message' => 'Sub-Kriteria berhasil dihapus!',
        ]);
    }
}