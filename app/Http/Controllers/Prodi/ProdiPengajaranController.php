<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiPengajaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProdiPengajaranController extends Controller
{
    /**
     * Filter data Pengajaran berdasarkan tahun akademik & semester.
     */
    public function filter(Request $request): JsonResponse
    {
        $user = $this->authUser();

        $tahun    = $request->query('tahun_akademik');
        $semester = $request->query('semester');

        $query = ProdiPengajaran::where('users_id', $user->id);

        if ($tahun)    $query->where('tahun_akademik', $tahun);
        if ($semester) $query->where('semester', $semester);

        $pengajarans = $query->orderBy('id', 'asc')->get();

        return response()->json([
            'success'       => true,
            'data'          => $pengajarans,
            'total'         => $pengajarans->count(),
            'tahun_list'    => $pengajarans->pluck('tahun_akademik')->unique()->sort()->values(),
            'semester_list' => $pengajarans->pluck('semester')->unique()->sort()->values(),
        ]);
    }

    /**
     * Simpan data Pengajaran baru.
     */
    public function store(Request $request): JsonResponse
    {
        $user = $this->authUser();

        $validated = $this->validateData($request);

        $validated['users_id'] = $user->id;

        if ($request->hasFile('sk_pengajaran')) {
            $validated['sk_pengajaran'] = $request->file('sk_pengajaran')
                ->store('prodi/pengajaran', 'public');
        }

        $pengajaran = ProdiPengajaran::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Pengajaran berhasil ditambahkan.',
            'data'    => $pengajaran->fresh(),
        ], 201);
    }

    /**
     * Detail satu data Pengajaran.
     */
    public function show($id): JsonResponse
    {
        $user = $this->authUser();

        $pengajaran = ProdiPengajaran::where('users_id', $user->id)->find($id);

        if (!$pengajaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pengajaran tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Pengajaran berhasil ditemukan.',
            'data'    => $this->transformForForm($pengajaran),
        ]);
    }

    /**
     * Update data Pengajaran.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = $this->authUser();

        $pengajaran = ProdiPengajaran::where('users_id', $user->id)->find($id);

        if (!$pengajaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pengajaran tidak ditemukan.',
            ], 404);
        }

        $validated = $this->validateData($request);

        // ⚠️ PENTING: kalau tidak ada file baru, JANGAN overwrite sk_pengajaran lama.
        //    Ini yang bikin file lama kehapus/ke-null-kan sebelumnya.
        if ($request->hasFile('sk_pengajaran')) {
            // Hapus file lama kalau ada
            if ($pengajaran->sk_pengajaran
                && Storage::disk('public')->exists($pengajaran->sk_pengajaran)) {
                Storage::disk('public')->delete($pengajaran->sk_pengajaran);
            }

            $validated['sk_pengajaran'] = $request->file('sk_pengajaran')
                ->store('prodi/pengajaran', 'public');
        } else {
            // Buang dari array agar tidak jadi null di DB
            unset($validated['sk_pengajaran']);
        }

        $pengajaran->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Pengajaran berhasil diperbarui.',
            'data'    => $this->transformForForm($pengajaran->fresh()),
        ]);
    }

    /**
     * Hapus data Pengajaran.
     */
    public function destroy($id): JsonResponse
    {
        $user = $this->authUser();

        $pengajaran = ProdiPengajaran::where('users_id', $user->id)->find($id);

        if (!$pengajaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pengajaran tidak ditemukan.',
            ], 404);
        }

        if ($pengajaran->sk_pengajaran
            && Storage::disk('public')->exists($pengajaran->sk_pengajaran)) {
            Storage::disk('public')->delete($pengajaran->sk_pengajaran);
        }

        $pengajaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Pengajaran berhasil dihapus.',
        ]);
    }

    // ============================================================
    // Helper
    // ============================================================

    /**
     * Pastikan user sudah login. Kalau tidak, lempar 401 lewat exception
     * agar tidak ketelan try-catch. (Midlleware 'auth' harusnya sudah handle,
     * ini cuma safety net.)
     */
    private function authUser()
    {
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Anda harus login terlebih dahulu.');
        }

        return $user;
    }

    /**
     * Normalisasi data untuk form edit (tgl_penetapan jadi Y-m-d, dll).
     */
    private function transformForForm(ProdiPengajaran $pengajaran): array
    {
        return [
            'id'             => $pengajaran->id,
            'tahun_akademik' => $pengajaran->tahun_akademik,
            'semester'       => $pengajaran->semester,
            'sk_pengajaran'  => $pengajaran->sk_pengajaran,
            'tgl_penetapan'  => $pengajaran->tgl_penetapan
                ? \Carbon\Carbon::parse($pengajaran->tgl_penetapan)->format('Y-m-d')
                : null,
            'keterangan'     => $pengajaran->keterangan,
        ];
    }

    /**
     * Validasi data Pengajaran.
     */
    private function validateData(Request $request): array
    {
        // Normalisasi: kosongkan string jadi null biar 'nullable' benar-benar jalan
        $request->merge([
            'tgl_penetapan' => $request->input('tgl_penetapan') ?: null,
            'keterangan'    => $request->input('keterangan') ?: null,
        ]);

        return $request->validate([
            'tahun_akademik' => ['required', 'string', 'max:20'],
            'semester'       => ['required', 'in:Ganjil,Genap'],
            'sk_pengajaran'  => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'tgl_penetapan'  => ['nullable', 'date'],
            'keterangan'     => ['nullable', 'string', 'max:255'],
        ]);
    }
}