<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IsiAksesAuditor;

class IsiAksesAuditorController extends Controller
{
    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'setting_akses_auditor_id' => 'required|exists:setting_akses_auditors,id',
            'auditor_id' => 'required|exists:data_auditor,id',
            'posisi' => 'required|in:lead_auditor,anggota',
        ]);

        $data = IsiAksesAuditor::create([
            'setting_akses_auditor_id' => $request->setting_akses_auditor_id,
            'auditor_id' => $request->auditor_id,
            'posisi' => $request->posisi,
        ]);

        return response()->json([
            'message' => 'Auditor berhasil ditambahkan',
            'data' => $data
        ]);
    }

    // =========================
    // SHOW (ambil semua auditor dalam 1 akses)
    // =========================
    public function show($id)
    {
        $data = IsiAksesAuditor::with('auditor')
            ->where('setting_akses_auditor_id', $id)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    // =========================
    // UPDATE (replace semua data)
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'auditor_id' => 'required|exists:data_auditor,id',
            'posisi' => 'required|in:lead_auditor,anggota',
        ]);

        $data = IsiAksesAuditor::findOrFail($id);

        $data->update([
            'auditor_id' => $request->auditor_id,
            'posisi' => $request->posisi,
        ]);

        return response()->json([
            'message' => 'Updated successfully'
        ]);
    }

    // =========================
    // DELETE (optional)
    // =========================
    public function destroy($id)
    {
        $data = IsiAksesAuditor::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'message' => 'Auditor berhasil dihapus'
        ]);
    }
}