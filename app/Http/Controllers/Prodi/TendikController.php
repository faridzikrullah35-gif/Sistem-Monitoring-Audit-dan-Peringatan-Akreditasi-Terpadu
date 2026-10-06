<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataTendik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TendikController extends Controller
{
    /**
     * Menampilkan data tendik milik Prodi yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id();

        $tendik = ProdiDataTendik::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get(); // ← ganti paginate(10) jadi get()

        return response()->json([
            'success' => true,
            'data' => $tendik,
        ]);
    }

    /**
     * Menyimpan data tendik baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'posisi' => 'nullable|string|max:100',
            'terhitung_mulai_tanggal' => 'nullable|date',
            'latar_pendidikan' => 'nullable|string|max:255',
            'sertifikasi' => 'nullable|string|max:100',
            'sk_pegawai_tetap' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $tendik = ProdiDataTendik::create([
                'nama' => $request->nama,
                'posisi' => $request->posisi,
                'terhitung_mulai_tanggal' => $request->terhitung_mulai_tanggal,
                'latar_pendidikan' => $request->latar_pendidikan,
                'sertifikasi' => $request->sertifikasi,
                'sk_pegawai_tetap' => $request->sk_pegawai_tetap,
                'users_id' => $userId,
            ]);

            $tendik->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data tendik berhasil ditambahkan!',
                'data' => $tendik,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan detail data tendik.
     */
    public function show($id)
    {
        try {
            $userId = Auth::id();

            $tendik = ProdiDataTendik::with('user')
                ->where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$tendik) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $tendik,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mengupdate data tendik.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'posisi' => 'nullable|string|max:100',
            'terhitung_mulai_tanggal' => 'nullable|date',
            'latar_pendidikan' => 'nullable|string|max:255',
            'sertifikasi' => 'nullable|string|max:100',
            'sk_pegawai_tetap' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $tendik = ProdiDataTendik::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$tendik) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            $tendik->update([
                'nama' => $request->nama,
                'posisi' => $request->posisi,
                'terhitung_mulai_tanggal' => $request->terhitung_mulai_tanggal,
                'latar_pendidikan' => $request->latar_pendidikan,
                'sertifikasi' => $request->sertifikasi,
                'sk_pegawai_tetap' => $request->sk_pegawai_tetap,
            ]);

            $tendik->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data tendik berhasil diupdate!',
                'data' => $tendik,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menghapus data tendik.
     */
    public function destroy($id)
    {
        try {
            $userId = Auth::id();

            $tendik = ProdiDataTendik::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$tendik) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            $tendik->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data tendik berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}