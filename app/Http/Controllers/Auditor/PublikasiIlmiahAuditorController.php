<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiPublikasiIlmiah;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PublikasiIlmiahAuditorController extends Controller
{
    /**
     * Menampilkan halaman Publikasi Ilmiah sekaligus data
     * milik prodi yang berada di unit/sub_unit yang sama dengan auditor.
     */
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | RESOLVE PRODI (auditor melihat data prodi dengan unit & sub_unit sama)
        |--------------------------------------------------------------------------
        */
        $prodi = User::where('role', 'prodi')
            ->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit)
            ->first();

        // Kalau prodi tidak ditemukan, tampilkan halaman kosong
        if (!$prodi) {
            return view('pages.auditor.auditor-publikasi-ilmiah', [
                'prodi'     => null,
                'publikasi' => collect(),
                'tahunList' => collect(),
            ]);
        }

        $publikasi = ProdiPublikasiIlmiah::where('users_id', $prodi->id)
            ->orderBy('id', 'asc')
            ->get();

        $tahunList = $publikasi
            ->pluck('tahun_akademik')
            ->unique()
            ->sort()
            ->values();

        return view('pages.auditor.auditor-publikasi-ilmiah', compact(
            'prodi',
            'publikasi',
            'tahunList',
        ));
    }

    /**
     * Filter data Publikasi Ilmiah berdasarkan tahun akademik.
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

            $prodi = User::where('role', 'prodi')
                ->where('unit', $user->unit)
                ->where('sub_unit', $user->sub_unit)
                ->first();

            if (!$prodi) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'total' => 0,
                    'tahun_list' => [],
                ]);
            }

            $tahun = $request->query('tahun_akademik');

            $query = ProdiPublikasiIlmiah::where('users_id', $prodi->id);

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

    /**
     * Paginate data Publikasi Ilmiah (opsional, untuk server-side pagination).
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

            $prodi = User::where('role', 'prodi')
                ->where('unit', $user->unit)
                ->where('sub_unit', $user->sub_unit)
                ->first();

            if (!$prodi) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'total' => 0,
                    'per_page' => (int) $request->query('per_page', 10),
                    'current_page' => 1,
                    'last_page' => 1,
                    'from' => 0,
                    'to' => 0,
                ]);
            }

            $perPage = (int) $request->query('per_page', 10);
            $page    = (int) $request->query('page', 1);
            $tahun   = $request->query('tahun_akademik');

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiPublikasiIlmiah::where('users_id', $prodi->id);

            if ($tahun) {
                $query->where('tahun_akademik', $tahun);
            }

            $total = $query->count();
            $publikasi = $query
                ->orderBy('id', 'asc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $publikasi,
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pagination Publikasi Ilmiah', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data pagination.',
            ], 500);
        }
    }
}