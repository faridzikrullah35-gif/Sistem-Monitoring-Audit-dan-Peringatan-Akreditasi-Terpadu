<?php

namespace App\Http\Controllers;

use App\Models\DataAuditor;
use Illuminate\Http\Request;

class DataAuditorController extends Controller
{
    /**
     * LIST DATA + PAGINATION
     */
    public function index()
    {
        $auditors = DataAuditor::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.data-auditor', compact('auditors'));
    }

    public function show($id)
    {
        $auditor = DataAuditor::findOrFail($id);

        return response()->json([
            'data' => $auditor
        ]);
    }

    /**
     * STORE DATA BARU
     */
    public function store(Request $request)
    {
       $request->validate([
            'identity_number' => 'required|unique:data_auditor,identity_number',
            'identity_type' => 'required|in:nidn,nik',
            'nama_auditor' => 'required',
            'unit' => 'required',
            'sub_unit' => 'nullable',
            'tahun_aktif' => 'required|digits:4',
            'status' => 'required|in:Aktif,Non Aktif',
            'tahun_non_aktif' => 'nullable|digits:4',
        ]);

        $auditor = DataAuditor::create($request->only([
            'identity_number',
            'identity_type',
            'nama_auditor',
            'unit',
            'sub_unit',
            'tahun_aktif',
            'status',
            'tahun_non_aktif',
        ]));

        return response()->json([
            'message' => 'Data auditor berhasil ditambahkan!',
            'data' => $auditor,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $auditor = DataAuditor::findOrFail($id);

        $request->validate([
            'identity_number' => 'required|unique:data_auditor,identity_number,' . $id,
            'identity_type' => 'required|in:nidn,nik',
            'nama_auditor' => 'required',
            'unit' => 'required',
            'sub_unit' => 'nullable',
            'tahun_aktif' => 'required|digits:4',
            'status' => 'required|in:Aktif,Non Aktif',
            'tahun_non_aktif' => 'nullable|digits:4',
        ]);

        $auditor->update($request->only([
            'identity_number',
            'identity_type',
            'nama_auditor',
            'unit',
            'sub_unit',
            'tahun_aktif',
            'status',
            'tahun_non_aktif',
        ]));

        return response()->json([
            'message' => 'Data auditor berhasil diupdate!',
            'data' => $auditor,
        ]);
    }

    /**
     * DELETE DATA
     */
    public function destroy($id)
    {
        try {
            $auditor = DataAuditor::findOrFail($id);
            $auditor->delete();

            return response()->json([
                'success' => true,
                'message' => 'Auditor berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus auditor: ' . $e->getMessage()
            ], 500);
        }
    }
}