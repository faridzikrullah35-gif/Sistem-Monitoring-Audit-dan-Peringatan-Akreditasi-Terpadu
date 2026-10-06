<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiSinta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProdiSintaController extends Controller
{
    /**
     * Menampilkan halaman SINTA sekaligus data SINTA
     * milik Prodi yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();

        $sintas = ProdiSinta::where('users_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.sinta-prodi', compact('sintas'));
    }

    /**
     * Filter data SINTA berdasarkan tahun akademik.
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
            
            $query = ProdiSinta::where('users_id', $user->id);
            
            if ($tahun) {
                $query->where('tahun_akademik', $tahun);
            }
            
            $sintas = $query->orderBy('id', 'asc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $sintas,
                'total' => $sintas->count(),
                'tahun_list' => $sintas->pluck('tahun_akademik')->unique()->sort()->values(),
            ]);
            
        } catch (\Throwable $e) {
            Log::error('Gagal memfilter data SINTA', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter data SINTA.',
            ], 500);
        }
    }

    /**
     * Paginate data SINTA (opsional, untuk server-side pagination).
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

            $query = ProdiSinta::where('users_id', $user->id);

            if ($tahun) {
                $query->where('tahun_akademik', $tahun);
            }

            $total = $query->count();
            $sintas = $query
                ->orderBy('id', 'asc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sintas,
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pagination SINTA', [
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
     * Menyimpan data SINTA baru.
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

            $sinta = ProdiSinta::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data SINTA berhasil ditambahkan.',
                'data' => $sinta->fresh(),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan data SINTA', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data SINTA.',
            ], 500);
        }
    }

    /**
     * Menampilkan detail satu data SINTA.
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

            $sinta = ProdiSinta::where('users_id', $user->id)->find($id);

            if (!$sinta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data SINTA tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data SINTA berhasil ditemukan.',
                'data' => $sinta,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data SINTA', [
                'user_id' => Auth::id(),
                'sinta_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data SINTA.',
            ], 500);
        }
    }

    /**
     * Mengupdate data SINTA.
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

            $sinta = ProdiSinta::where('users_id', $user->id)->find($id);

            if (!$sinta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data SINTA tidak ditemukan.',
                ], 404);
            }

            $validated = $this->validateData($request);
            $sinta->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data SINTA berhasil diperbarui.',
                'data' => $sinta->fresh(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data SINTA', [
                'user_id' => Auth::id(),
                'sinta_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data SINTA.',
            ], 500);
        }
    }

    /**
     * Menghapus data SINTA.
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

            $sinta = ProdiSinta::where('users_id', $user->id)->find($id);

            if (!$sinta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data SINTA tidak ditemukan.',
                ], 404);
            }

            $sinta->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data SINTA berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data SINTA', [
                'user_id' => Auth::id(),
                'sinta_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data SINTA.',
            ], 500);
        }
    }

    /**
     * Validasi data SINTA.
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'tahun_akademik' => ['required', 'string', 'max:20'],
            'dosen_terdata_sinta' => ['required', 'string', 'max:255'],
            'sinta_score_3_tahun' => ['required', 'numeric', 'min:0'],
            'sinta_score_overall' => ['required', 'numeric', 'min:0'],
            'index' => ['required', 'numeric', 'min:0'],
            'link_sinta' => ['nullable', 'url', 'max:255'],
        ]);
    }
}