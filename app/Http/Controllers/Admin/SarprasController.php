<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sarpras;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SarprasController extends Controller
{
    /**
     * Menampilkan halaman data sarpras.
     */
    public function index()
    {
        $sarpras = Sarpras::with('user')
            ->where('users_id', Auth::id())
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.admin.sarpras', compact('sarpras'));
    }

    /**
     * Mengambil data sarpras untuk AJAX.
     */
    public function data(): JsonResponse
    {
        try {
            $sarpras = Sarpras::with('user')
                ->where('users_id', Auth::id())
                ->orderBy('id', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sarpras,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data sarpras', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data sarpras.',
            ], 500);
        }
    }

    /**
     * Menyimpan data sarpras baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:255',
                'unique:sarpras,kode',
            ],
            'nama_sarpras' => [
                'required',
                'string',
                'max:255',
            ],
            'status' => [
                'required',
                'string',
                'max:255',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:0',
            ],
        ], [
            'kode.required' => 'Kode sarpras wajib diisi.',
            'kode.unique' => 'Kode sarpras sudah digunakan.',
            'nama_sarpras.required' => 'Nama sarpras wajib diisi.',
            'status.required' => 'Status sarpras wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0.',
        ]);

        try {
            $sarpras = Sarpras::create([
                'users_id' => Auth::id(),
                'kode' => $validated['kode'],
                'nama_sarpras' => $validated['nama_sarpras'],
                'status' => $validated['status'],
                'jumlah' => $validated['jumlah'],
            ]);

            $sarpras->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil ditambahkan.',
                'data' => $sarpras,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan sarpras', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data sarpras.',
            ], 500);
        }
    }

    /**
     * Mengambil detail satu sarpras.
     */
    public function show(Sarpras $sarpras): JsonResponse
    {
        try {
            $sarpras->load('user');

            return response()->json([
                'success' => true,
                'data' => $sarpras,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil detail sarpras', [
                'id' => $sarpras->id,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail data sarpras.',
            ], 500);
        }
    }

    /**
     * Mengupdate data sarpras.
     */
    public function update(Request $request, Sarpras $sarpras): JsonResponse
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sarpras', 'kode')->ignore($sarpras->id),
            ],
            'nama_sarpras' => [
                'required',
                'string',
                'max:255',
            ],
            'status' => [
                'required',
                'string',
                'max:255',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:0',
            ],
        ], [
            'kode.required' => 'Kode sarpras wajib diisi.',
            'kode.unique' => 'Kode sarpras sudah digunakan.',
            'nama_sarpras.required' => 'Nama sarpras wajib diisi.',
            'status.required' => 'Status sarpras wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0.',
        ]);

        try {
            $sarpras->update([
                'kode' => $validated['kode'],
                'nama_sarpras' => $validated['nama_sarpras'],
                'status' => $validated['status'],
                'jumlah' => $validated['jumlah'],
            ]);

            $sarpras->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil diperbarui.',
                'data' => $sarpras,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui sarpras', [
                'id' => $sarpras->id,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data sarpras.',
            ], 500);
        }
    }

    /**
     * Menghapus data sarpras.
     */
    public function destroy(Sarpras $sarpras): JsonResponse
    {
        try {
            $sarpras->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus sarpras', [
                'id' => $sarpras->id,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data sarpras.',
            ], 500);
        }
    }
}