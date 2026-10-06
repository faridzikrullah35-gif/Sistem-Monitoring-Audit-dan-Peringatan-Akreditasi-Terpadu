<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiPublikasiIlmiah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PublikasiIlmiahController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $publikasi = ProdiPublikasiIlmiah::where('users_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.publikasi-ilmiah-prodi', compact('publikasi'));
    }

    /**
     * Filter data Publikasi Ilmiah berdasarkan tahun akademik.
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
            
            $query = ProdiPublikasiIlmiah::where('users_id', $user->id);
            
            if ($tahun) {
                $query->where('tahun_akademik', $tahun);
            }
            
            $publikasi = $query->orderBy('id', 'asc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $publikasi,
                'total' => $publikasi->count(),
                'tahun_list' => $publikasi->pluck('tahun_akademik')->unique()->sort()->values(),
            ]);
            
        } catch (\Throwable $e) {
            Log::error('Gagal memfilter data Publikasi Ilmiah', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter data Publikasi Ilmiah.',
            ], 500);
        }
    }

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

            $publikasi = ProdiPublikasiIlmiah::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Publikasi Ilmiah berhasil ditambahkan.',
                'data' => $publikasi->fresh(),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan data Publikasi Ilmiah', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data Publikasi Ilmiah.',
            ], 500);
        }
    }

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

            $publikasi = ProdiPublikasiIlmiah::where('users_id', $user->id)
                ->find($id);

            if (!$publikasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Publikasi Ilmiah tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Publikasi Ilmiah berhasil ditemukan.',
                'data' => $publikasi,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data Publikasi Ilmiah', [
                'user_id' => Auth::id(),
                'publikasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data Publikasi Ilmiah.',
            ], 500);
        }
    }

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

            $publikasi = ProdiPublikasiIlmiah::where('users_id', $user->id)
                ->find($id);

            if (!$publikasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Publikasi Ilmiah tidak ditemukan.',
                ], 404);
            }

            $validated = $this->validateData($request);
            $publikasi->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Publikasi Ilmiah berhasil diperbarui.',
                'data' => $publikasi->fresh(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Publikasi Ilmiah', [
                'user_id' => Auth::id(),
                'publikasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data Publikasi Ilmiah.',
            ], 500);
        }
    }

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

            $publikasi = ProdiPublikasiIlmiah::where('users_id', $user->id)
                ->find($id);

            if (!$publikasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Publikasi Ilmiah tidak ditemukan.',
                ], 404);
            }

            $publikasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Publikasi Ilmiah berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data Publikasi Ilmiah', [
                'user_id' => Auth::id(),
                'publikasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data Publikasi Ilmiah.',
            ], 500);
        }
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'nama_dosen' => [
                'required',
                'string',
                'max:255',
            ],
            'nidn' => [
                'nullable',
                'string',
                'max:20',
            ],
            'judul_artikel' => [
                'required',
                'string',
                'max:500',
            ],
            'jenis_publikasi' => [
                'required',
                'string',
                'max:100',
            ],
            'nama_jurnal_prosiding' => [
                'required',
                'string',
                'max:255',
            ],
            'issn' => [
                'nullable',
                'string',
                'max:50',
            ],
            'volume_no' => [
                'nullable',
                'string',
                'max:50',
            ],
            'sinta_scopus' => [
                'nullable',
                'string',
                'max:50',
            ],
            'penulis_ke' => [
                'nullable',
                'string',
                'max:10',
            ],
            'link_artikel' => [
                'nullable',
                'url',
                'max:500',
            ],
            'tahun_akademik' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}\/\d{4}$|^\d{4}-\d{4}$/', // Format: 2024/2025 atau 2024-2025
            ],
        ]);
    }
}