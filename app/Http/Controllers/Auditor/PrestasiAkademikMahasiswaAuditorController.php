<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiPrestasiAkademikMahasiswa;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PrestasiAkademikMahasiswaAuditorController extends Controller
{
    /**
     * Menampilkan halaman Prestasi Akademik Mahasiswa sekaligus data
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
            return view('pages.auditor.auditor-prestasi-akademik-mahasiswa', [
                'prodi'       => null,
                'prestasi'    => collect(),
                'tahunList'   => collect(),
                'tingkatList' => collect(),
            ]);
        }

        $prestasi = ProdiPrestasiAkademikMahasiswa::where('users_id', $prodi->id)
            ->orderBy('id', 'asc')
            ->get();

        $tahunList = $prestasi
            ->pluck('tahun_akademik')
            ->unique()
            ->sort()
            ->values();

        $tingkatList = $prestasi
            ->pluck('tingkat')
            ->unique()
            ->sort()
            ->values();

        return view('pages.auditor.auditor-prestasi-akademik-mahasiswa', compact(
            'prodi',
            'prestasi',
            'tahunList',
            'tingkatList',
        ));
    }

    /**
     * Filter data Prestasi Akademik Mahasiswa berdasarkan tahun akademik, tingkat, dan waktu perolehan.
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
                    'tingkat_list' => [],
                    'waktu_list' => [],
                ]);
            }

            $tahunAkademik   = $request->query('tahun_akademik');
            $tingkat         = $request->query('tingkat');
            $waktuPerolehan  = $request->query('waktu_perolehan');

            $query = ProdiPrestasiAkademikMahasiswa::where('users_id', $prodi->id);

            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }

            if ($tingkat) {
                $query->where('tingkat', $tingkat);
            }

            if ($waktuPerolehan) {
                $query->where('waktu_perolehan', $waktuPerolehan);
            }

            $prestasi = $query->orderBy('id', 'asc')->get();

            return response()->json([
                'success' => true,
                'data' => $prestasi,
                'total' => $prestasi->count(),
                'tahun_list' => $prestasi->pluck('tahun_akademik')->unique()->sort()->values(),
                'tingkat_list' => $prestasi->pluck('tingkat')->unique()->sort()->values(),
                'waktu_list' => $prestasi->pluck('waktu_perolehan')->unique()->sort()->values(),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal memfilter data Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memfilter data Prestasi Akademik Mahasiswa.',
            ], 500);
        }
    }

    /**
     * Paginate data Prestasi Akademik Mahasiswa (opsional, server-side pagination).
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

            $perPage        = (int) $request->query('per_page', 10);
            $page           = (int) $request->query('page', 1);
            $tahunAkademik  = $request->query('tahun_akademik');
            $tingkat        = $request->query('tingkat');
            $waktuPerolehan = $request->query('waktu_perolehan');

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiPrestasiAkademikMahasiswa::where('users_id', $prodi->id);

            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }

            if ($tingkat) {
                $query->where('tingkat', $tingkat);
            }

            if ($waktuPerolehan) {
                $query->where('waktu_perolehan', $waktuPerolehan);
            }

            $total = $query->count();
            $prestasi = $query
                ->orderBy('id', 'asc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $prestasi,
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pagination Prestasi Akademik Mahasiswa', [
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