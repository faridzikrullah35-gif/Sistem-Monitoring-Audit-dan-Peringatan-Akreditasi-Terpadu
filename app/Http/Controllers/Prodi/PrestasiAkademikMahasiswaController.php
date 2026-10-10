<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiPrestasiAkademikMahasiswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class PrestasiAkademikMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $prestasi = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.prestasi-akademik-mahasiswa-prodi', compact('prestasi'));
    }

    /**
     * Filter data Prestasi Akademik Mahasiswa berdasarkan tahun akademik, tingkat, dan waktu perolehan.
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

            $tahunAkademik = $request->query('tahun_akademik');
            $tingkat = $request->query('tingkat');
            $waktuPerolehan = $request->query('waktu_perolehan');
            
            $query = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id);
            
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
     * Get paginated data for AJAX pagination.
     * 
     * @param Request $request
     * @return JsonResponse
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

            $perPage = $request->query('per_page', 10);
            $page = $request->query('page', 1);
            $tahunAkademik = $request->query('tahun_akademik');
            $tingkat = $request->query('tingkat');
            $waktuPerolehan = $request->query('waktu_perolehan');
            
            $query = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id);
            
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
            $prestasi = $query->orderBy('id', 'asc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $prestasi,
                'total' => $total,
                'per_page' => (int) $perPage,
                'current_page' => (int) $page,
                'last_page' => ceil($total / $perPage),
                'from' => ($page - 1) * $perPage + 1,
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

            $prestasi = ProdiPrestasiAkademikMahasiswa::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Prestasi Akademik Mahasiswa berhasil ditambahkan.',
                'data' => $prestasi->fresh(),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan data Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data Prestasi Akademik Mahasiswa.',
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

            $prestasi = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id)
                ->find($id);

            if (!$prestasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Prestasi Akademik Mahasiswa tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Prestasi Akademik Mahasiswa berhasil ditemukan.',
                'data' => $prestasi,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'prestasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data Prestasi Akademik Mahasiswa.',
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

            $prestasi = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id)
                ->find($id);

            if (!$prestasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Prestasi Akademik Mahasiswa tidak ditemukan.',
                ], 404);
            }

            $validated = $this->validateData($request, $id);
            $prestasi->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data Prestasi Akademik Mahasiswa berhasil diperbarui.',
                'data' => $prestasi->fresh(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'prestasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data Prestasi Akademik Mahasiswa.',
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

            $prestasi = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id)
                ->find($id);

            if (!$prestasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Prestasi Akademik Mahasiswa tidak ditemukan.',
                ], 404);
            }

            $prestasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Prestasi Akademik Mahasiswa berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'prestasi_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data Prestasi Akademik Mahasiswa.',
            ], 500);
        }
    }

    /**
     * Validate data for Prestasi Akademik Mahasiswa.
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
            'nama_kegiatan' => [
                'required',
                'string',
                'max:255',
            ],
            'waktu_perolehan' => [
                'required',
                'integer',
                'min:2000',
                'max:' . date('Y'),
            ],
            'tingkat' => [
                'required',
                'string',
                'in:Lokal/Wilayah,Nasional,Internasional',
            ],
            'prestasi_dicapai' => [
                'required',
                'string',
            ],
            'link' => [
                'nullable',
                'string',
                'max:255',
                'url',
            ],
        ];

        if ($id) {
            $rules['tahun_akademik'][] = 'sometimes';
            $rules['nama_kegiatan'][] = 'sometimes';
            $rules['waktu_perolehan'][] = 'sometimes';
            $rules['tingkat'][] = 'sometimes';
            $rules['prestasi_dicapai'][] = 'sometimes';
            $rules['link'][] = 'sometimes';
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

            $tahunList = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id)
                ->select('tahun_akademik')
                ->distinct()
                ->orderBy('tahun_akademik', 'desc')
                ->pluck('tahun_akademik');

            return response()->json([
                'success' => true,
                'data' => $tahunList,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil opsi tahun akademik Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil opsi tahun akademik Prestasi Akademik Mahasiswa.',
            ], 500);
        }
    }

    /**
     * Get list of tingkat options for dropdown.
     */
    public function getTingkatOptions(): JsonResponse
    {
        try {
            $tingkatOptions = ['Lokal/Wilayah', 'Nasional', 'Internasional'];
            
            return response()->json([
                'success' => true,
                'data' => $tingkatOptions,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil opsi tingkat Prestasi Akademik Mahasiswa', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil opsi tingkat Prestasi Akademik Mahasiswa.',
            ], 500);
        }
    }

    /**
     * Get statistics for Prestasi Akademik Mahasiswa data.
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

            $query = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id);
            
            $statistics = [
                'total' => $query->count(),
                'lokal_wilayah' => (clone $query)->where('tingkat', 'Lokal/Wilayah')->count(),
                'nasional' => (clone $query)->where('tingkat', 'Nasional')->count(),
                'internasional' => (clone $query)->where('tingkat', 'Internasional')->count(),
                'total_tahun' => (clone $query)->distinct('tahun_akademik')->count('tahun_akademik'),
                'total_waktu' => (clone $query)->distinct('waktu_perolehan')->count('waktu_perolehan'),
                'total_with_link' => (clone $query)->whereNotNull('link')->where('link', '!=', '')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $statistics,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil statistik Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil statistik Prestasi Akademik Mahasiswa.',
            ], 500);
        }
    }

    /**
     * Export Prestasi Akademik Mahasiswa data to Excel/CSV (placeholder).
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
            $tingkat = $request->query('tingkat');
            $query = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id);
            
            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }

            if ($tingkat) {
                $query->where('tingkat', $tingkat);
            }
            
            $prestasi = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Prestasi Akademik Mahasiswa berhasil diekspor.',
                'data' => $prestasi,
                'total' => $prestasi->count(),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengekspor data Prestasi Akademik Mahasiswa', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengekspor data Prestasi Akademik Mahasiswa.',
            ], 500);
        }
    }

    /**
     * ==========================================================
     * PRINT DATA PRESTASI AKADEMIK MAHASISWA (dengan filter)
     * ==========================================================
     */
    public function printPrestasi(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Anda harus login terlebih dahulu.');
        }

        // ==================== FILTER DARI QUERY STRING ====================
        $filterTahun   = $request->query('tahun_akademik');
        $filterTingkat = $request->query('tingkat');
        $filterWaktu   = $request->query('waktu_perolehan');

        $query = ProdiPrestasiAkademikMahasiswa::where('users_id', $user->id);

        if ($filterTahun)   $query->where('tahun_akademik', $filterTahun);
        if ($filterTingkat) $query->where('tingkat', $filterTingkat);
        if ($filterWaktu)   $query->where('waktu_perolehan', $filterWaktu);

        $prestasi = $query->orderBy('id', 'asc')->get();

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
        if ($filterTahun)   $filterParts[] = "Tahun Akademik: {$filterTahun}";
        if ($filterTingkat) $filterParts[] = "Tingkat: {$filterTingkat}";
        if ($filterWaktu)   $filterParts[] = "Waktu Perolehan: {$filterWaktu}";
        $filterInfo = !empty($filterParts) ? implode(' | ', $filterParts) : null;

        return view('print.prodi.prestasi-akademik-mahasiswa', compact(
            'prestasi',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
            'filterInfo',
        ));
    }
}