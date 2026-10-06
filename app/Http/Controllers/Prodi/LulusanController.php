<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataLulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LulusanController extends Controller
{
    /**
     * Menampilkan data lulusan milik Prodi yang sedang login.
     * (Biasanya dipanggil via AJAX atau untuk keperluan view)
     */
    public function index()
    {
        $userId = Auth::id();

        $lulusan = ProdiDataLulusan::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get(); // ← ganti paginate(10) jadi get()

        return response()->json([
            'success' => true,
            'data' => $lulusan,
        ]);
    }

    /**
     * Menyimpan data lulusan baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'nullable|string|max:100',
            'ta_3' => 'required|integer|min:0',
            'ta_2' => 'required|integer|min:0',
            'ta_1' => 'required|integer|min:0',
            'ta' => 'required|integer|min:0',
            // persentase_penurunan tidak wajib karena akan dihitung otomatis di model
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            // Simpan data (persentase_penurunan akan dihitung otomatis oleh model)
            $lulusan = ProdiDataLulusan::create([
                'nama_prodi' => $request->nama_prodi,
                'ta_3' => $request->ta_3,
                'ta_2' => $request->ta_2,
                'ta_1' => $request->ta_1,
                'ta' => $request->ta,
                // persentase_penurunan tidak perlu diisi manual, akan dihitung otomatis
                'users_id' => $userId,
            ]);

            $lulusan->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data lulusan berhasil ditambahkan!',
                'data' => $lulusan,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan detail data lulusan.
     */
    public function show($id)
    {
        try {
            $userId = Auth::id();

            $lulusan = ProdiDataLulusan::with('user')
                ->where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$lulusan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $lulusan,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mengupdate data lulusan.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'nullable|string|max:100',
            'ta_3' => 'required|integer|min:0',
            'ta_2' => 'required|integer|min:0',
            'ta_1' => 'required|integer|min:0',
            'ta' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $lulusan = ProdiDataLulusan::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$lulusan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            // Update data (persentase_penurunan akan dihitung otomatis oleh model)
            $lulusan->update([
                'nama_prodi' => $request->nama_prodi,
                'ta_3' => $request->ta_3,
                'ta_2' => $request->ta_2,
                'ta_1' => $request->ta_1,
                'ta' => $request->ta,
                // persentase_penurunan otomatis dihitung ulang di model
            ]);

            $lulusan->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data lulusan berhasil diupdate!',
                'data' => $lulusan,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menghapus data lulusan.
     */
    public function destroy($id)
    {
        try {
            $userId = Auth::id();

            $lulusan = ProdiDataLulusan::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$lulusan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            $lulusan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data lulusan berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}