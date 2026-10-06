<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $dosen = ProdiDataDosen::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get(); // ← ganti paginate(10) jadi get()

        return response()->json([
            'success' => true,
            'data' => $dosen,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'latar_pendidikan' => 'nullable|string|max:255',
            'nama_instansi_asal' => 'nullable|string|max:150',
            'sertifikasi' => 'nullable|string|max:100',
            'jabatan_akademik' => 'nullable|string|max:100',
            'posisi_jabatan' => 'nullable|string|max:100',
            'terhitung_mulai_tanggal' => 'nullable|date',
            'sk_dosen_tetap' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'nidn' => 'nullable|string|max:20',
            'nuptk' => 'nullable|string|max:20',
            'doktor' => 'nullable|string|max:100',
            'magister' => 'nullable|string|max:100',
            'sarjana' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            if ($request->filled('nidn')) {
                $existing = ProdiDataDosen::where('users_id', $userId)
                    ->where('nidn', $request->nidn)
                    ->first();

                if ($existing) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Dosen dengan NIDN ' . $request->nidn . ' sudah ada!',
                    ], 409);
                }
            }

            $dosen = ProdiDataDosen::create([
                'nama' => $request->nama,
                'latar_pendidikan' => $request->latar_pendidikan,
                'nama_instansi_asal' => $request->nama_instansi_asal,
                'sertifikasi' => $request->sertifikasi,
                'jabatan_akademik' => $request->jabatan_akademik,
                'posisi_jabatan' => $request->posisi_jabatan,
                'terhitung_mulai_tanggal' => $request->terhitung_mulai_tanggal,
                'sk_dosen_tetap' => $request->sk_dosen_tetap,
                'status' => $request->status,
                'nidn' => $request->nidn,
                'nuptk' => $request->nuptk,
                'doktor' => $request->doktor,
                'magister' => $request->magister,
                'sarjana' => $request->sarjana,
                'users_id' => $userId,
            ]);

            $dosen->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data dosen berhasil ditambahkan!',
                'data' => $dosen,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $userId = Auth::id();

            $dosen = ProdiDataDosen::with('user')
                ->where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$dosen) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $dosen,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'latar_pendidikan' => 'nullable|string|max:255',
            'nama_instansi_asal' => 'nullable|string|max:150',
            'sertifikasi' => 'nullable|string|max:100',
            'jabatan_akademik' => 'nullable|string|max:100',
            'posisi_jabatan' => 'nullable|string|max:100',
            'terhitung_mulai_tanggal' => 'nullable|date',
            'sk_dosen_tetap' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'nidn' => 'nullable|string|max:20',
            'nuptk' => 'nullable|string|max:20',
            'doktor' => 'nullable|string|max:100',
            'magister' => 'nullable|string|max:100',
            'sarjana' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $userId = Auth::id();

            $dosen = ProdiDataDosen::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$dosen) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }

            if ($request->filled('nidn')) {
                $existing = ProdiDataDosen::where('users_id', $userId)
                    ->where('nidn', $request->nidn)
                    ->where('id', '!=', $id)
                    ->first();

                if ($existing) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Dosen dengan NIDN ' . $request->nidn . ' sudah ada!',
                    ], 409);
                }
            }

            $dosen->update([
                'nama' => $request->nama,
                'latar_pendidikan' => $request->latar_pendidikan,
                'nama_instansi_asal' => $request->nama_instansi_asal,
                'sertifikasi' => $request->sertifikasi,
                'jabatan_akademik' => $request->jabatan_akademik,
                'posisi_jabatan' => $request->posisi_jabatan,
                'terhitung_mulai_tanggal' => $request->terhitung_mulai_tanggal,
                'sk_dosen_tetap' => $request->sk_dosen_tetap,
                'status' => $request->status,
                'nidn' => $request->nidn,
                'nuptk' => $request->nuptk,
                'doktor' => $request->doktor,
                'magister' => $request->magister,
                'sarjana' => $request->sarjana,
            ]);

            $dosen->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data dosen berhasil diupdate!',
                'data' => $dosen,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        \Log::info('PRODI DELETE DIPANGGIL', [
            'id' => $id,
            'user_id' => Auth::id(),
        ]);

        try {
            $userId = Auth::id();

            $dosen = ProdiDataDosen::where('users_id', $userId)
                ->where('id', $id)
                ->first();

            if (!$dosen) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data dosen tidak ditemukan di ProdiDataDosen. ID: ' . $id,
                ], 404);
            }

            $dosen->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data dosen berhasil dihapus!',
            ]);

        } catch (\Exception $e) {
            \Log::error('PRODI DELETE ERROR', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}