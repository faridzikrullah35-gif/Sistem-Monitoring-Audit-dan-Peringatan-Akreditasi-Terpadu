<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiPKM;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $pkm = ProdiPKM::where('users_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.pkm-prodi', compact('pkm'));
    }

    /**
     * Filter data PKM berdasarkan tingkat dan tahun akademik.
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

            $tingkat = $request->query('tingkat');
            $tahunAkademik = $request->query('tahun_akademik');
            $melibatkanMahasiswa = $request->query('melibatkan_mahasiswa');
            
            $query = ProdiPKM::where('users_id', $user->id);
            
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

            $perPage = (int) $request->query('per_page', 10);
            $page = (int) $request->query('page', 1);
            $tahunAkademik = $request->query('tahun_akademik');

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiPKM::where('users_id', $user->id);

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
            $validated['melibatkan_mahasiswa'] = $request->has('melibatkan_mahasiswa') 
                ? filter_var($request->melibatkan_mahasiswa, FILTER_VALIDATE_BOOLEAN) 
                : false;

            $pkm = ProdiPKM::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data PKM berhasil ditambahkan.',
                'data' => $pkm->fresh(),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan data PKM', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data PKM.',
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

            $pkm = ProdiPKM::where('users_id', $user->id)->find($id);

            if (!$pkm) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data PKM tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data PKM berhasil ditemukan.',
                'data' => $pkm,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data PKM', [
                'user_id' => Auth::id(),
                'pkm_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data PKM.',
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

            $pkm = ProdiPKM::where('users_id', $user->id)->find($id);

            if (!$pkm) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data PKM tidak ditemukan.',
                ], 404);
            }

            $validated = $this->validateData($request, $id);
            $validated['melibatkan_mahasiswa'] = $request->has('melibatkan_mahasiswa') 
                ? filter_var($request->melibatkan_mahasiswa, FILTER_VALIDATE_BOOLEAN) 
                : false;
                
            $pkm->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data PKM berhasil diperbarui.',
                'data' => $pkm->fresh(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data PKM', [
                'user_id' => Auth::id(),
                'pkm_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data PKM.',
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

            $pkm = ProdiPKM::where('users_id', $user->id)->find($id);

            if (!$pkm) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data PKM tidak ditemukan.',
                ], 404);
            }

            $pkm->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data PKM berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data PKM', [
                'user_id' => Auth::id(),
                'pkm_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data PKM.',
            ], 500);
        }
    }

    /**
     * Validate data for PKM.
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
            'nidn' => ['required', 'string', 'max:20', 'regex:/^[0-9]{10,20}$/'],
            'judul_pkm' => ['required', 'string', 'max:255'],
            'lokasi_mitra' => ['required', 'string'],
            'tingkat' => ['required', 'string', 'in:Internasional,Nasional,Lokal'],
            'sumber_dana' => ['required', 'string', 'max:255'],
            'melibatkan_mahasiswa' => ['nullable', 'boolean'],
            'luaran' => ['required', 'string'],
            'link_bukti' => ['nullable', 'url', 'max:500'],
        ];

        if ($id) {
            $rules['tahun_akademik'][] = 'sometimes';
            $rules['nama_dosen'][] = 'sometimes';
            $rules['nidn'][] = 'sometimes';
            $rules['judul_pkm'][] = 'sometimes';
            $rules['lokasi_mitra'][] = 'sometimes';
            $rules['tingkat'][] = 'sometimes';
            $rules['sumber_dana'][] = 'sometimes';
            $rules['luaran'][] = 'sometimes';
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

            $tahunList = ProdiPKM::where('users_id', $user->id)
                ->select('tahun_akademik')
                ->distinct()
                ->orderBy('tahun_akademik', 'desc')
                ->pluck('tahun_akademik');

            return response()->json([
                'success' => true,
                'data' => $tahunList,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil opsi tahun akademik PKM', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil opsi tahun akademik PKM.',
            ], 500);
        }
    }

    /**
     * Get list of tingkat options for dropdown.
     */
    public function getTingkatOptions(): JsonResponse
    {
        try {
            $tingkatOptions = ['Internasional', 'Nasional', 'Lokal'];
            
            return response()->json([
                'success' => true,
                'data' => $tingkatOptions,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil opsi tingkat PKM', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil opsi tingkat PKM.',
            ], 500);
        }
    }

    /**
     * Get statistics for PKM data.
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

            $query = ProdiPKM::where('users_id', $user->id);
            
            $statistics = [
                'total' => $query->count(),
                'internasional' => (clone $query)->where('tingkat', 'Internasional')->count(),
                'nasional' => (clone $query)->where('tingkat', 'Nasional')->count(),
                'lokal' => (clone $query)->where('tingkat', 'Lokal')->count(),
                'melibatkan_mahasiswa' => (clone $query)->where('melibatkan_mahasiswa', true)->count(),
                'total_dosen' => (clone $query)->distinct('nama_dosen')->count('nama_dosen'),
                'total_tahun' => (clone $query)->distinct('tahun_akademik')->count('tahun_akademik'),
            ];

            return response()->json([
                'success' => true,
                'data' => $statistics,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil statistik PKM', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil statistik PKM.',
            ], 500);
        }
    }

    /**
     * Export PKM data to Excel/CSV (placeholder).
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

            $tingkat = $request->query('tingkat');
            $tahunAkademik = $request->query('tahun_akademik');
            $query = ProdiPKM::where('users_id', $user->id);
            
            if ($tingkat) {
                $query->where('tingkat', $tingkat);
            }

            if ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            }
            
            $pkm = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data PKM berhasil diekspor.',
                'data' => $pkm,
                'total' => $pkm->count(),
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengekspor data PKM', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengekspor data PKM.',
            ], 500);
        }
    }
}