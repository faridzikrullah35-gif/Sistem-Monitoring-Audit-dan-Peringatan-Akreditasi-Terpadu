<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiInovasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class InovasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $inovasi = ProdiInovasi::where('users_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.inovasi-prodi', compact('inovasi'));
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

            $tahunAkademik = $request->query('tahun_akademik');
            $jenisInovasi = $request->query('jenis_inovasi');
            
            $query = ProdiInovasi::where('users_id', $user->id);
            
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

            $perPage = (int) $request->query('per_page', 10);
            $page = (int) $request->query('page', 1);
            $tahunAkademik = $request->query('tahun_akademik');
            $jenisInovasi = $request->query('jenis_inovasi');

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiInovasi::where('users_id', $user->id);

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

    /**
     * Store a newly created resource in storage.
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

            $inovasi = ProdiInovasi::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Inovasi berhasil ditambahkan.',
                'data' => $inovasi->fresh(),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan data Inovasi', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data Inovasi.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
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

            $inovasi = ProdiInovasi::where('users_id', $user->id)->find($id);

            if (!$inovasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Inovasi tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Inovasi berhasil ditemukan.',
                'data' => $inovasi,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data Inovasi', [
                'user_id' => Auth::id(),
                'inovasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data Inovasi.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
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

            $inovasi = ProdiInovasi::where('users_id', $user->id)->find($id);

            if (!$inovasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Inovasi tidak ditemukan.',
                ], 404);
            }

            $validated = $this->validateData($request, $id);
            $inovasi->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Inovasi berhasil diperbarui.',
                'data' => $inovasi->fresh(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Inovasi', [
                'user_id' => Auth::id(),
                'inovasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data Inovasi.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
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

            $inovasi = ProdiInovasi::where('users_id', $user->id)->find($id);

            if (!$inovasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Inovasi tidak ditemukan.',
                ], 404);
            }

            $inovasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Inovasi berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data Inovasi', [
                'user_id' => Auth::id(),
                'inovasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data Inovasi.',
            ], 500);
        }
    }

    /**
     * Validate data for Inovasi.
     */
    private function validateData(Request $request, $id = null): array
    {
        $rules = [
            'tahun_akademik' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}\/\d{4}$|^\d{4}-\d{4}$/',
            ],
            'nama_dosen' => ['required', 'string', 'max:255'],
            'nama_inovasi' => ['required', 'string', 'max:255'],
            'jenis_inovasi' => ['required', 'string', 'max:100'],
            'hki' => ['nullable', 'string', 'max:100'],
            'nomor_hki' => ['nullable', 'string', 'max:50'],
            'produk_prototype' => ['required', 'string'],
            'pengguna_mitra' => ['required', 'string', 'max:255'],
            'link_bukti' => ['nullable', 'url', 'max:500'],
        ];

        if ($id) {
            $rules['tahun_akademik'][] = 'sometimes';
            $rules['nama_dosen'][] = 'sometimes';
            $rules['nama_inovasi'][] = 'sometimes';
            $rules['jenis_inovasi'][] = 'sometimes';
            $rules['produk_prototype'][] = 'sometimes';
            $rules['pengguna_mitra'][] = 'sometimes';
        }

        return $request->validate($rules);
    }

    /**
     * Get list of tahun akademik options from existing data.
     */
    public function getTahunAkademikOptions(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $tahunList = ProdiInovasi::where('users_id', $user->id)
                ->select('tahun_akademik')
                ->distinct()
                ->orderBy('tahun_akademik', 'desc')
                ->pluck('tahun_akademik');

            return response()->json([
                'success' => true,
                'data' => $tahunList,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil opsi tahun akademik Inovasi', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil opsi tahun akademik Inovasi.',
            ], 500);
        }
    }

    /**
     * Get statistics for Inovasi data.
     */
    public function statistics(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $query = ProdiInovasi::where('users_id', $user->id);
            
            $statistics = [
                'total' => $query->count(),
                'total_dosen' => (clone $query)->distinct('nama_dosen')->count('nama_dosen'),
                'total_tahun' => (clone $query)->distinct('tahun_akademik')->count('tahun_akademik'),
                'dengan_hki' => (clone $query)->whereNotNull('hki')->where('hki', '!=', '')->count(),
                'tanpa_hki' => (clone $query)->whereNull('hki')->orWhere('hki', '')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $statistics,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil statistik Inovasi', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil statistik Inovasi.',
            ], 500);
        }
    }

    /**
     * Export Inovasi data to Excel/CSV (placeholder).
     */
    public function export(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.',
                ], 401);
            }

            $tahunAkademik = $request->query('tahun_akademik');
            $query = ProdiInovasi::where('users_id', $user->id);
            
            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }
            
            $inovasi = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Inovasi berhasil diekspor.',
                'data' => $inovasi,
                'total' => $inovasi->count(),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengekspor data Inovasi', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengekspor data Inovasi.',
            ], 500);
        }
    }

    /**
     * ==========================================================
     * PRINT DATA INOVASI (milik user sendiri)
     * ==========================================================
     */
    public function printInovasi(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Anda harus login terlebih dahulu.');
        }

        // ==================== FILTER DARI QUERY STRING ====================
        $filterTahun = $request->query('tahun_akademik');
        $filterJenis = $request->query('jenis_inovasi');

        $query = ProdiInovasi::where('users_id', $user->id);

        if ($filterTahun) $query->where('tahun_akademik', $filterTahun);
        if ($filterJenis) $query->where('jenis_inovasi', $filterJenis);

        $inovasi = $query->orderBy('id', 'asc')->get();

        // ==================== HEADER CETAK ====================
        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        // ==================== INFO PRODI ====================
        $namaProdi = $user->name ?? '-';
        $unit      = $user->unit ?? '-';

        // ==================== INFO FILTER ====================
        $filterParts = [];
        if ($filterTahun) $filterParts[] = "Tahun Akademik: {$filterTahun}";
        if ($filterJenis) $filterParts[] = "Jenis Inovasi: {$filterJenis}";
        $filterInfo = !empty($filterParts) ? implode(' | ', $filterParts) : null;

        return view('print.prodi.inovasi', compact(
            'inovasi',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
            'filterInfo',
        ));
    }
}