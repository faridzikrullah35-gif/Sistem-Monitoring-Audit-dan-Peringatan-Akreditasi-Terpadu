<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;

class TahunAkademikController extends Controller
{
    /**
     * LIST DATA + PAGINATION
     */
    public function index()
    {
        $tahunAkademiks = TahunAkademik::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.tahun-akademik', compact('tahunAkademiks'));
    }

    /**
     * STORE DATA BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_akademik' => 'required',
            'semester' => 'required|in:Ganjil,Genap',
            'status' => 'required|in:Aktif,Non Aktif',
        ]);

        $data = TahunAkademik::create($request->all());

        return response()->json([
            'message' => 'Tahun akademik berhasil ditambahkan!',
            'data' => $data,
        ]);
    }

    /**
     * DETAIL DATA (UNTUK EDIT MODAL)
     */
    public function show($id)
    {
        try {
            $data = TahunAkademik::findOrFail($id);

            return response()->json([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $tahun = TahunAkademik::findOrFail($id);

        $request->validate([
            'tahun_akademik' => 'required',
            'semester' => 'required|in:Ganjil,Genap',
            'status' => 'required|in:Aktif,Non Aktif',
        ]);

        $tahun->update($request->all());

        return response()->json([
            'message' => 'Tahun akademik berhasil diupdate!',
            'data' => $tahun,
        ]);
    }

    /**
     * DELETE DATA
     */
    public function destroy($id)
    {
        $tahun = TahunAkademik::findOrFail($id);
        $tahun->delete();

        return response()->json([
            'message' => 'Tahun akademik berhasil dihapus!',
            'data' => $id,
        ]);
    }
}