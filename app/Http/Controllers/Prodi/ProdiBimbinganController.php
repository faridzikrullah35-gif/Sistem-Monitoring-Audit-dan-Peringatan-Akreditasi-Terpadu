<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiBimbingan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProdiBimbinganController extends Controller
{
    /**
     * Filter data Bimbingan berdasarkan tahun akademik & semester.
     */
    public function filter(Request $request): JsonResponse
    {
        $user = $this->authUser();

        $tahun    = $request->query('tahun_akademik');
        $semester = $request->query('semester');

        $query = ProdiBimbingan::where('users_id', $user->id);

        if ($tahun)    $query->where('tahun_akademik', $tahun);
        if ($semester) $query->where('semester', $semester);

        $bimbingans = $query->orderBy('id', 'asc')->get();

        return response()->json([
            'success'       => true,
            'data'          => $bimbingans,
            'total'         => $bimbingans->count(),
            'tahun_list'    => $bimbingans->pluck('tahun_akademik')->unique()->sort()->values(),
            'semester_list' => $bimbingans->pluck('semester')->unique()->sort()->values(),
        ]);
    }

    /**
     * Simpan data Bimbingan baru.
     */
    public function store(Request $request): JsonResponse
    {
        $user = $this->authUser();

        $validated = $this->validateData($request);

        $validated['users_id'] = $user->id;

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')
                ->store('prodi/bimbingan', 'public');
        }

        $bimbingan = ProdiBimbingan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Bimbingan berhasil ditambahkan.',
            'data'    => $bimbingan->fresh(),
        ], 201);
    }

    /**
     * Detail satu data Bimbingan.
     */
    public function show($id): JsonResponse
    {
        $user = $this->authUser();

        $bimbingan = ProdiBimbingan::where('users_id', $user->id)->find($id);

        if (!$bimbingan) {
            return response()->json([
                'success' => false,
                'message' => 'Data Bimbingan tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Bimbingan berhasil ditemukan.',
            'data'    => $this->transformForForm($bimbingan),
        ]);
    }

    /**
     * Update data Bimbingan.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = $this->authUser();

        $bimbingan = ProdiBimbingan::where('users_id', $user->id)->find($id);

        if (!$bimbingan) {
            return response()->json([
                'success' => false,
                'message' => 'Data Bimbingan tidak ditemukan.',
            ], 404);
        }

        $validated = $this->validateData($request);

        // ⚠️ PENTING: kalau tidak ada file baru, JANGAN overwrite file lama.
        //    Ini yang bikin file lama kehapus/ke-null-kan sebelumnya.
        if ($request->hasFile('file')) {
            // Hapus file lama kalau ada
            if ($bimbingan->file
                && Storage::disk('public')->exists($bimbingan->file)) {
                Storage::disk('public')->delete($bimbingan->file);
            }

            $validated['file'] = $request->file('file')
                ->store('prodi/bimbingan', 'public');
        } else {
            // Buang dari array agar tidak jadi null di DB
            unset($validated['file']);
        }

        $bimbingan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Bimbingan berhasil diperbarui.',
            'data'    => $this->transformForForm($bimbingan->fresh()),
        ]);
    }

    /**
     * Hapus data Bimbingan.
     */
    public function destroy($id): JsonResponse
    {
        $user = $this->authUser();

        $bimbingan = ProdiBimbingan::where('users_id', $user->id)->find($id);

        if (!$bimbingan) {
            return response()->json([
                'success' => false,
                'message' => 'Data Bimbingan tidak ditemukan.',
            ], 404);
        }

        if ($bimbingan->file
            && Storage::disk('public')->exists($bimbingan->file)) {
            Storage::disk('public')->delete($bimbingan->file);
        }

        $bimbingan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Bimbingan berhasil dihapus.',
        ]);
    }

    // ============================================================
    // Helper
    // ============================================================

    /**
     * Pastikan user sudah login. Kalau tidak, lempar 401 lewat exception
     * agar tidak ketelan try-catch. (Middleware 'auth' harusnya sudah handle,
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
    private function transformForForm(ProdiBimbingan $bimbingan): array
    {
        return [
            'id'             => $bimbingan->id,
            'tahun_akademik' => $bimbingan->tahun_akademik,
            'semester'       => $bimbingan->semester,
            'file'           => $bimbingan->file,
            'tgl_penetapan'  => $bimbingan->tgl_penetapan
                ? \Carbon\Carbon::parse($bimbingan->tgl_penetapan)->format('Y-m-d')
                : null,
            'keterangan'     => $bimbingan->keterangan,
        ];
    }

    /**
     * Validasi data Bimbingan.
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
            'file'           => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'tgl_penetapan'  => ['nullable', 'date'],
            'keterangan'     => ['nullable', 'string', 'max:255'],
        ]);
    }
}