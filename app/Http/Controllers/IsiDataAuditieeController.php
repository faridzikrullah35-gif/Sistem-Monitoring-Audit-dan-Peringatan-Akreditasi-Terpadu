<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditiee;
use App\Models\User;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Validator;

class IsiDataAuditieeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditieeList = Auditiee::with([
                'user',
                'tahunAkademik'
            ])
            ->where('users_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        $tahunAkademik = TahunAkademik::where('status', 'Aktif')
            ->orderBy('tahun_akademik', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        return view('pages.isi-data-auditiee', compact(
            'auditieeList',
            'tahunAkademik'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_auditiee' => 'required|string|max:255',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
        ]);

        // VALIDATION ERROR AJAX
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $auditiee = Auditiee::create([
            'users_id' => auth()->id(),
            'tahun_akademik_id' => $request->tahun_akademik_id,
            'nama_auditiee' => $request->nama_auditiee,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'data' => $auditiee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $auditiee = Auditiee::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $auditiee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $auditiee = Auditiee::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_auditiee' => 'required|string|max:255',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
        ]);

        // VALIDATION ERROR AJAX
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $auditiee->update([
            'nama_auditiee' => $request->nama_auditiee,
            'tahun_akademik_id' => $request->tahun_akademik_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data auditiee berhasil diupdate!',
            'data' => $auditiee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $auditiee = Auditiee::where('users_id', auth()->id())
            ->findOrFail($id);

        $auditiee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data auditiee berhasil dihapus!'
        ]);
    }
}