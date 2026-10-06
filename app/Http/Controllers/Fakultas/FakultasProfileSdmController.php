<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\FakultasDataDosen;
use App\Models\FakultasDataTendik;
use App\Models\ProdiDataDosen;      
use App\Models\ProdiDataTendik;
use App\Models\User;     
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class FakultasProfileSdmController extends Controller
{
    /**
     * Menampilkan halaman Profil SDM Fakultas.
     */
    public function index()
    {
        $user   = Auth::user();
        $userId = Auth::id();

        // Ambil daftar prodi di bawah fakultas ini
        $prodi = User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();

        $prodiUserIds = $prodi->pluck('id')->toArray();

        // ================= DOSEN =================
        $dosenFakultas = FakultasDataDosen::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')->get();

        $dosenProdi = ProdiDataDosen::with('user')
            ->whereIn('users_id', $prodiUserIds)
            ->orderBy('id', 'asc')->get();

        // ================= TENDIK =================
        $tendikFakultas = FakultasDataTendik::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')->get();

        $tendikProdi = ProdiDataTendik::with('user')
            ->whereIn('users_id', $prodiUserIds)
            ->orderBy('id', 'asc')->get();

        return view('pages.fakultas.fakultas-profile-sdm', compact(
            'prodi',
            'dosenFakultas', 'dosenProdi',
            'tendikFakultas', 'tendikProdi'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | DATA DOSEN
    |--------------------------------------------------------------------------
    */

    /**
     * Mengambil seluruh data dosen dalam bentuk JSON.
     */
    public function dataDosen(): JsonResponse
    {
        $dosen = FakultasDataDosen::with('user')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $dosen,
        ]);
    }

    /**
     * Menyimpan data dosen.
     */
    public function storeDosen(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'latar_pendidikan' => ['nullable', 'string', 'max:255'],
            'doktor' => ['nullable', 'string', 'max:255'],
            'magister' => ['nullable', 'string', 'max:255'],
            'sarjana' => ['nullable', 'string', 'max:255'],
            'nama_instansi_asal' => ['nullable', 'string', 'max:255'],
            'sertifikasi' => ['nullable', Rule::in(['Ya', 'Tidak'])],
            'jabatan_akademik' => ['nullable', 'string', 'max:255'],
            'sk_dosen_tetap' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['Aktif', 'Tidak Aktif'])],
            'nidn' => ['nullable', 'string', 'max:50'],
            'nuptk' => ['nullable', 'string', 'max:50'],
        ]);

        try {
            $validated['users_id'] = Auth::id();
            $validated['sertifikasi'] = $validated['sertifikasi'] ?? 'Tidak';
            $validated['status'] = $validated['status'] ?? 'Aktif';

            $dosen = FakultasDataDosen::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data dosen berhasil ditambahkan.',
                'data' => $dosen->load('user'),
            ], 201);
        } catch (Throwable $e) {
            Log::error('Gagal menambahkan data dosen.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data dosen.',
            ], 500);
        }
    }

    /**
     * Menampilkan satu data dosen.
     */
    public function showDosen(FakultasDataDosen $dosen): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $dosen->load('user'),
        ]);
    }

    /**
     * Mengubah data dosen.
     */
    public function updateDosen(
        Request $request,
        FakultasDataDosen $dosen
    ): JsonResponse {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'latar_pendidikan' => ['nullable', 'string', 'max:255'],
            'doktor' => ['nullable', 'string', 'max:255'],
            'magister' => ['nullable', 'string', 'max:255'],
            'sarjana' => ['nullable', 'string', 'max:255'],
            'nama_instansi_asal' => ['nullable', 'string', 'max:255'],
            'sertifikasi' => ['nullable', Rule::in(['Ya', 'Tidak'])],
            'jabatan_akademik' => ['nullable', 'string', 'max:255'],
            'sk_dosen_tetap' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['Aktif', 'Tidak Aktif'])],
            'nidn' => ['nullable', 'string', 'max:50'],
            'nuptk' => ['nullable', 'string', 'max:50'],
        ]);

        try {
            $validated['sertifikasi'] = $validated['sertifikasi'] ?? 'Tidak';
            $validated['status'] = $validated['status'] ?? 'Aktif';

            $dosen->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data dosen berhasil diperbarui.',
                'data' => $dosen->fresh()->load('user'),
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal memperbarui data dosen.', [
                'dosen_id' => $dosen->id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data dosen.',
            ], 500);
        }
    }

    /**
     * Menghapus data dosen.
     */
    public function destroyDosen(FakultasDataDosen $dosen): JsonResponse
    {
        try {
            $dosen->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data dosen berhasil dihapus.',
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal menghapus data dosen.', [
                'dosen_id' => $dosen->id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data dosen.',
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DATA TENDIK
    |--------------------------------------------------------------------------
    */

    /**
     * Mengambil seluruh data tendik dalam bentuk JSON.
     */
    public function dataTendik(): JsonResponse
    {
        $tendik = FakultasDataTendik::with('user')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tendik,
        ]);
    }

    /**
     * Menyimpan data tendik.
     */
    public function storeTendik(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'latar_pendidikan' => ['nullable', 'string', 'max:255'],
            'sertifikasi' => ['nullable', Rule::in(['Ya', 'Tidak'])],
            'sk_pegawai_tetap' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $validated['users_id'] = Auth::id();
            $validated['sertifikasi'] = $validated['sertifikasi'] ?? 'Tidak';

            $tendik = FakultasDataTendik::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data tendik berhasil ditambahkan.',
                'data' => $tendik->load('user'),
            ], 201);
        } catch (Throwable $e) {
            Log::error('Gagal menambahkan data tendik.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data tendik.',
            ], 500);
        }
    }

    /**
     * Menampilkan satu data tendik.
     */
    public function showTendik(FakultasDataTendik $tendik): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $tendik->load('user'),
        ]);
    }

    /**
     * Mengubah data tendik.
     */
    public function updateTendik(
        Request $request,
        FakultasDataTendik $tendik
    ): JsonResponse {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'latar_pendidikan' => ['nullable', 'string', 'max:255'],
            'sertifikasi' => ['nullable', Rule::in(['Ya', 'Tidak'])],
            'sk_pegawai_tetap' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $validated['sertifikasi'] = $validated['sertifikasi'] ?? 'Tidak';

            $tendik->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data tendik berhasil diperbarui.',
                'data' => $tendik->fresh()->load('user'),
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal memperbarui data tendik.', [
                'tendik_id' => $tendik->id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data tendik.',
            ], 500);
        }
    }

    /**
     * Menghapus data tendik.
     */
    public function destroyTendik(FakultasDataTendik $tendik): JsonResponse
    {
        try {
            $tendik->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data tendik berhasil dihapus.',
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal menghapus data tendik.', [
                'tendik_id' => $tendik->id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data tendik.',
            ], 500);
        }
    }
}