<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiPKM;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PkmAuditorController extends Controller
{
    /**
     * Menampilkan halaman PKM sekaligus data PKM
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
            return view('pages.auditor.auditor-pkm', [
                'prodi'         => null,
                'pkm'           => collect(),
                'tahunList'     => collect(),
                'tingkatList'   => collect(),
            ]);
        }

        $pkm = ProdiPKM::where('users_id', $prodi->id)
            ->orderBy('id', 'asc')
            ->get();

        $tahunList = $pkm
            ->pluck('tahun_akademik')
            ->unique()
            ->sort()
            ->values();

        $tingkatList = $pkm
            ->pluck('tingkat')
            ->unique()
            ->sort()
            ->values();

        return view('pages.auditor.auditor-pkm', compact(
            'prodi',
            'pkm',
            'tahunList',
            'tingkatList',
        ));
    }

    /**
     * Filter data PKM berdasarkan tingkat, tahun akademik, dan mahasiswa.
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
                    'tingkat_list' => [],
                    'tahun_list' => [],
                ]);
            }

            $tingkat             = $request->query('tingkat');
            $tahunAkademik       = $request->query('tahun_akademik');
            $melibatkanMahasiswa = $request->query('melibatkan_mahasiswa');

            $query = ProdiPKM::where('users_id', $prodi->id);

            if ($tingkat) {
                $query->where('tingkat', $tingkat);
            }

            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }

            if ($melibatkanMahasiswa !== null && $melibatkanMahasiswa !== '') {
                $query->where('melibatkan_mahasiswa', filter_var($melibatkanMahasiswa, FILTER_VALIDATE_BOOLEAN));
            }

            $pkm = $query->orderBy('id', 'asc')->get();

            return response()->json([
                'success' => true,
                'data' => $pkm,
                'total' => $pkm->count(),
                'tingkat_list' => $pkm->pluck('tingkat')->unique()->sort()->values(),
                'tahun_list' => $pkm->pluck('tahun_akademik')->unique()->sort()->values(),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal memfilter data PKM', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter data PKM.',
            ], 500);
        }
    }

    /**
     * Paginate data PKM (opsional, untuk server-side pagination).
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

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiPKM::where('users_id', $prodi->id);

            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }

            $total = $query->count();
            $pkm = $query
                ->orderBy('id', 'asc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $pkm,
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pagination PKM', [
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