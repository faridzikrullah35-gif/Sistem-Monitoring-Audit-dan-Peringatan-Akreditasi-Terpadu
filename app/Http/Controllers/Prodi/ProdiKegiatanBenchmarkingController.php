<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiKegiatanBenchmarking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdiKegiatanBenchmarkingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'laporan_kegiatan' => 'required|string',
            'file'             => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:5120',
            'tgl_pelaksanaan'  => 'required|date',
            'keterangan'       => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            $filePath = null;

            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('benchmarking', 'public');
            }

            ProdiKegiatanBenchmarking::create([
                'users_id'         => Auth::id() ?? 1,
                'laporan_kegiatan' => $request->laporan_kegiatan,
                'file'             => $filePath,
                'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
                'keterangan'       => $request->keterangan,
            ]);

            return response()->json([
                'message' => 'Kegiatan benchmarking berhasil disimpan.',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $data = ProdiKegiatanBenchmarking::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'laporan_kegiatan' => 'required|string',
            'file'             => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:5120',
            'tgl_pelaksanaan'  => 'required|date',
            'keterangan'       => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            $filePath = $data->file;

            if ($request->hasFile('file')) {
                if ($data->file && Storage::disk('public')->exists($data->file)) {
                    Storage::disk('public')->delete($data->file);
                }
                $filePath = $request->file('file')->store('benchmarking', 'public');
            }

            $data->update([
                'laporan_kegiatan' => $request->laporan_kegiatan,
                'file'             => $filePath,
                'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
                'keterangan'       => $request->keterangan,
            ]);

            return response()->json([
                'message' => 'Kegiatan benchmarking berhasil diperbarui.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $data = ProdiKegiatanBenchmarking::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        try {
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $data->delete();

            return response()->json([
                'message' => 'Kegiatan benchmarking berhasil dihapus.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}