<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiInovasi;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InovasiAuditorController extends Controller
{
    /**
     * Menampilkan halaman Inovasi sekaligus data Inovasi
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
            return view('pages.auditor.auditor-inovasi', [
                'prodi'     => null,
                'inovasi'   => collect(),
                'tahunList' => collect(),
                'jenisList' => collect(),
            ]);
        }

        $inovasi = ProdiInovasi::where('users_id', $prodi->id)
            ->orderBy('id', 'asc')
            ->get();

        $tahunList = $inovasi
            ->pluck('tahun_akademik')
            ->unique()
            ->sort()
            ->values();

        $jenisList = $inovasi
            ->pluck('jenis_inovasi')
            ->unique()
            ->sort()
            ->values();

        return view('pages.auditor.auditor-inovasi', compact(
            'prodi',
            'inovasi',
            'tahunList',
            'jenisList',
        ));
    }

    /**
     * Filter data Inovasi berdasarkan tahun akademik dan jenis inovasi.
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
                    'jenis_list' => [],
                ]);
            }

            $tahunAkademik = $request->query('tahun_akademik');
            $jenisInovasi  = $request->query('jenis_inovasi');

            $query = ProdiInovasi::where('users_id', $prodi->id);

            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }

            if ($jenisInovasi) {
                $query->where('jenis_inovasi', $jenisInovasi);
            }

            $inovasi = $query->orderBy('id', 'asc')->get();

            return response()->json([
                'success' => true,
                'data' => $inovasi,
                'total' => $inovasi->count(),
                'tahun_list' => $inovasi->pluck('tahun_akademik')->unique()->sort()->values(),
                'jenis_list' => $inovasi->pluck('jenis_inovasi')->unique()->sort()->values(),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal memfilter data Inovasi', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter data Inovasi.',
            ], 500);
        }
    }

    /**
     * Paginate data Inovasi (opsional, untuk server-side pagination).
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

            $perPage       = (int) $request->query('per_page', 10);
            $page          = (int) $request->query('page', 1);
            $tahunAkademik = $request->query('tahun_akademik');
            $jenisInovasi  = $request->query('jenis_inovasi');

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiInovasi::where('users_id', $prodi->id);

            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }

            if ($jenisInovasi) {
                $query->where('jenis_inovasi', $jenisInovasi);
            }

            $total = $query->count();
            $inovasi = $query
                ->orderBy('id', 'asc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $inovasi,
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pagination Inovasi', [
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