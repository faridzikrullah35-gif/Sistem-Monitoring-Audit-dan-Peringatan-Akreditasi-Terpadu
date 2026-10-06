<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiPenelitian;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PenelitianController extends Controller
{
    /**
     * Menampilkan halaman Penelitian milik Prodi yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();

        $penelitian = ProdiPenelitian::where('users_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.penelitian-prodi', compact('penelitian'));
    }

    /**
     * Filter data Penelitian berdasarkan tahun akademik.
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
            
            $query = ProdiPenelitian::where('users_id', $user->id);
            
            if ($tahun) {
                $query->where('tahun_akademik', $tahun);
            }
            
            $penelitian = $query->orderBy('id', 'asc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $penelitian,
                'total' => $penelitian->count(),
                'tahun_list' => $penelitian->pluck('tahun_akademik')->unique()->sort()->values(),
            ]);
            
        } catch (\Throwable $e) {
            Log::error('Gagal memfilter data Penelitian', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter data Penelitian.',
            ], 500);
        }
    }

    /**
     * Paginate data Penelitian (opsional, untuk server-side pagination).
     */
    public function paginate(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $perPage = (int) $request->query('per_page', 10);
            $page = (int) $request->query('page', 1);
            $tahun = $request->query('tahun_akademik');

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiPenelitian::where('users_id', $user->id);

            if ($tahun) {
                $query->where('tahun_akademik', $tahun);
            }

            $total = $query->count();
            $penelitian = $query
                ->orderBy('id', 'asc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $penelitian,
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pagination Penelitian', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data pagination.',
            ], 500);
        }
    }

    /**
     * Menyimpan data Penelitian baru.
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

            $penelitian = ProdiPenelitian::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Penelitian berhasil ditambahkan.',
                'data' => $penelitian->fresh(),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan data Penelitian', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data Penelitian.',
            ], 500);
        }
    }

    /**
     * Menampilkan detail satu data Penelitian.
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

            $penelitian = ProdiPenelitian::where('users_id', $user->id)->find($id);

            if (!$penelitian) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Penelitian tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Penelitian berhasil ditemukan.',
                'data' => $penelitian,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data Penelitian', [
                'user_id' => Auth::id(),
                'penelitian_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data Penelitian.',
            ], 500);
        }
    }

    /**
     * Mengupdate data Penelitian.
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

            $penelitian = ProdiPenelitian::where('users_id', $user->id)->find($id);

            if (!$penelitian) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Penelitian tidak ditemukan.',
                ], 404);
            }

            $validated = $this->validateData($request);
            $penelitian->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Penelitian berhasil diperbarui.',
                'data' => $penelitian->fresh(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Penelitian', [
                'user_id' => Auth::id(),
                'penelitian_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data Penelitian.',
            ], 500);
        }
    }

    /**
     * Menghapus data Penelitian.
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

            $penelitian = ProdiPenelitian::where('users_id', $user->id)->find($id);

            if (!$penelitian) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Penelitian tidak ditemukan.',
                ], 404);
            }

            $penelitian->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Penelitian berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data Penelitian', [
                'user_id' => Auth::id(),
                'penelitian_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data Penelitian.',
            ], 500);
        }
    }

    /**
     * Validasi data Penelitian.
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'ketua_anggota' => ['required', 'string', 'in:Ketua,Anggota'],
            'nama_dosen' => ['required', 'string', 'max:255'],
            'judul_penelitian' => ['required', 'string', 'max:500'],
            'lembaga_mitra' => ['nullable', 'string', 'max:255'],
            'tingkat' => ['required', 'string', 'in:Internasional,Nasional,Lokal'],
            'tahun_akademik' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}\/\d{4}$|^\d{4}-\d{4}$/',
            ],
            'skema' => ['nullable', 'string', 'max:100'],
            'sumber_dana' => ['nullable', 'string', 'max:100'],
            'luaran' => ['nullable', 'string', 'max:255'],
            'link_bukti' => ['nullable', 'url', 'max:500'],
        ]);
    }
}