<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiKurikulum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProdiKurikulumController extends Controller
{
    /**
     * Filter data Kurikulum berdasarkan tahun akademik.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function filter(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $tahun = $request->query('tahun_akademik');

            $query = ProdiKurikulum::where('users_id', $user->id);

            if ($tahun) {
                $query->where('tahun_akademik', $tahun);
            }

            $kurikulums = $query->orderBy('id', 'asc')->get();

            return response()->json([
                'success'    => true,
                'data'       => $kurikulums,
                'total'      => $kurikulums->count(),
                'tahun_list' => $kurikulums->pluck('tahun_akademik')->unique()->sort()->values(),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal memfilter data Kurikulum', [
                'user_id' => Auth::id(),
                'error'   => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter data Kurikulum.',
            ], 500);
        }
    }

    /**
     * Menyimpan data Kurikulum baru.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $validated = $this->validateData($request);

            $validated['users_id'] = $user->id;

            // Upload dokumen (jika ada)
            if ($request->hasFile('dokumen')) {
                $validated['dokumen'] = $request->file('dokumen')
                    ->store('prodi/kurikulum', 'public');
            }

            $kurikulum = ProdiKurikulum::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Kurikulum berhasil ditambahkan.',
                'data'    => $kurikulum->fresh(),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan data Kurikulum', [
                'user_id' => Auth::id(),
                'error'   => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data Kurikulum.',
            ], 500);
        }
    }

    /**
     * Menampilkan detail satu data Kurikulum.
     */
    public function show($id): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $kurikulum = ProdiKurikulum::where('users_id', $user->id)->find($id);

            if (!$kurikulum) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kurikulum tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Kurikulum berhasil ditemukan.',
                'data'    => $kurikulum,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data Kurikulum', [
                'user_id'      => Auth::id(),
                'kurikulum_id' => $id,
                'error'        => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data Kurikulum.',
            ], 500);
        }
    }

    /**
     * Mengupdate data Kurikulum.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $kurikulum = ProdiKurikulum::where('users_id', $user->id)->find($id);

            if (!$kurikulum) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kurikulum tidak ditemukan.',
                ], 404);
            }

            $validated = $this->validateData($request);

            // Upload dokumen baru (jika ada), hapus yang lama
            if ($request->hasFile('dokumen')) {
                if ($kurikulum->dokumen && Storage::disk('public')->exists($kurikulum->dokumen)) {
                    Storage::disk('public')->delete($kurikulum->dokumen);
                }

                $validated['dokumen'] = $request->file('dokumen')
                    ->store('prodi/kurikulum', 'public');
            }

            $kurikulum->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Kurikulum berhasil diperbarui.',
                'data'    => $kurikulum->fresh(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Kurikulum', [
                'user_id'      => Auth::id(),
                'kurikulum_id' => $id,
                'error'        => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data Kurikulum.',
            ], 500);
        }
    }

    /**
     * Menghapus data Kurikulum.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $kurikulum = ProdiKurikulum::where('users_id', $user->id)->find($id);

            if (!$kurikulum) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kurikulum tidak ditemukan.',
                ], 404);
            }

            // Hapus file dokumen dari storage
            if ($kurikulum->dokumen && Storage::disk('public')->exists($kurikulum->dokumen)) {
                Storage::disk('public')->delete($kurikulum->dokumen);
            }

            $kurikulum->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Kurikulum berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data Kurikulum', [
                'user_id'      => Auth::id(),
                'kurikulum_id' => $id,
                'error'        => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data Kurikulum.',
            ], 500);
        }
    }

    /**
     * Validasi data Kurikulum.
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'tahun_akademik' => [
                'required',
                'string',
                'max:20',
            ],

            'dokumen' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120', // maks 5MB
            ],

            'tgl_penetapan' => [
                'nullable',
                'date',
            ],

            'peninjauan_kurikulum' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);
    }
}