<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\RasioDosenMahasiswaProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RasioController extends Controller
{
    /**
     * Menampilkan data rasio dosen-mahasiswa milik Prodi yang sedang login.
     * (Biasanya dipanggil via AJAX atau untuk keperluan view)
     */
    public function index()
    {
        $userId = Auth::id();

        $rasio = RasioDosenMahasiswaProdi::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get(); // ← ganti paginate(10) jadi get()

        return response()->json([
            'success' => true,
            'data' => $rasio,
        ]);
    }

    /**
     * Menyimpan data rasio baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_akademik' => 'nullable|string|max:20',
            'jumlah_dosen_tetap' => 'required|integer|min:0',
            'jumlah_mahasiswa' => 'required|integer|min:0',
            // rasio tidak wajib karena akan dihitung otomatis di model
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            // Cek duplikasi data (jika ada tahun_akademik)
            if ($request->filled('tahun_akademik')) {
                $existing = RasioDosenMahasiswaProdi::where('users_id', $userId)
                    ->where('tahun_akademik', $request->tahun_akademik)
                    ->first();

                if ($existing) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data untuk tahun akademik '
                            . $request->tahun_akademik
                            . ' sudah ada!',
                    ], 409);
                }
            }

            // Simpan data (rasio akan dihitung otomatis oleh model)
            $rasio = RasioDosenMahasiswaProdi::create([
                'tahun_akademik' => $request->tahun_akademik,
                'jumlah_dosen_tetap' => $request->jumlah_dosen_tetap,
                'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
                // rasio tidak perlu diisi manual, akan dihitung otomatis
                'users_id' => $userId,
            ]);

            $rasio->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data rasio berhasil ditambahkan!',
                'data' => $rasio,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan detail data rasio.
     */
    public function show($id)
    {
        try {
            $userId = Auth::id();

            $rasio = RasioDosenMahasiswaProdi::with('user')
                ->where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$rasio) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $rasio,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mengupdate data rasio.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun_akademik' => 'nullable|string|max:20',
            'jumlah_dosen_tetap' => 'required|integer|min:0',
            'jumlah_mahasiswa' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $rasio = RasioDosenMahasiswaProdi::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$rasio) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            // Cek duplikasi tahun_akademik (jika diubah)
            if ($request->filled('tahun_akademik')) {
                $existing = RasioDosenMahasiswaProdi::where('users_id', $userId)
                    ->where('tahun_akademik', $request->tahun_akademik)
                    ->where('id', '!=', $id)
                    ->first();

                if ($existing) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data untuk tahun akademik '
                            . $request->tahun_akademik
                            . ' sudah ada!',
                    ], 409);
                }
            }

            // Update data (rasio akan dihitung otomatis oleh model)
            $rasio->update([
                'tahun_akademik' => $request->tahun_akademik,
                'jumlah_dosen_tetap' => $request->jumlah_dosen_tetap,
                'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
                // rasio otomatis dihitung ulang di model
            ]);

            $rasio->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data rasio berhasil diupdate!',
                'data' => $rasio,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menghapus data rasio.
     */
    public function destroy($id)
    {
        try {
            $userId = Auth::id();

            $rasio = RasioDosenMahasiswaProdi::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$rasio) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            $rasio->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data rasio berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}