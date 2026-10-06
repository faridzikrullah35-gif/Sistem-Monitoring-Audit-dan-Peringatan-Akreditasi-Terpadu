<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\FakultasSarpras;
use App\Models\User;
use App\Models\ProdiSarpras;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SarprasFakultasController extends Controller
{
    /**
     * Menampilkan halaman data sarpras fakultas.
     */
    public function index()
    {
        $user = Auth::user();

        // ===================== Daftar Prodi =====================
        $prodi = \App\Models\User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();

        $prodiUserIds = $prodi->pluck('id')->toArray();

        // ===================== Data Fakultas (Milik User Login) =====================
        $sarprasFakultas = FakultasSarpras::with('user')
            ->where('users_id', Auth::id())
            ->orderBy('id', 'asc')
            ->get();

        // ===================== Data Prodi =====================
        $sarprasProdi = \App\Models\ProdiSarpras::with('user')
            ->whereIn('users_id', $prodiUserIds)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.fakultas.sarpras-fakultas', compact(
            'sarprasFakultas',
            'sarprasProdi',
            'prodi'
        ));
    }

    /**
     * Mengambil data sarpras untuk AJAX.
     */
    public function data(): JsonResponse
    {
        try {
            $sarpras = FakultasSarpras::with('user')
                ->where('users_id', Auth::id())
                ->orderBy('id', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sarpras,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data sarpras fakultas', [
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
                'unique:fakultas_sarpras,kode',
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

            'file' => [
                'nullable',
                'file',
                'max:5120',
                'mimes:jpg,jpeg,png,pdf,doc,docx',
            ],
        ], [
            'kode.required' => 'Kode sarpras wajib diisi.',
            'kode.unique' => 'Kode sarpras sudah digunakan.',
            'nama_sarpras.required' => 'Nama sarpras wajib diisi.',
            'status.required' => 'Status sarpras wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0.',
            'file.max' => 'Ukuran file maksimal 5MB.',
            'file.mimes' => 'Format file harus JPG, JPEG, PNG, PDF, DOC, atau DOCX.',
        ]);

        try {
            $data = [
                'users_id' => Auth::id(),
                'kode' => $validated['kode'],
                'nama_sarpras' => $validated['nama_sarpras'],
                'status' => $validated['status'],
                'jumlah' => $validated['jumlah'],
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $fileName = time()
                    . '_'
                    . Str::slug(
                        pathinfo(
                            $file->getClientOriginalName(),
                            PATHINFO_FILENAME
                        )
                    )
                    . '.'
                    . $file->getClientOriginalExtension();

                $filePath = $file->storeAs(
                    'sarpras/' . date('Y/m'),
                    $fileName,
                    'public'
                );

                $data['file_path'] = $filePath;
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_type'] = $file->getMimeType();
                $data['file_size'] = $file->getSize();
            }

            $sarpras = FakultasSarpras::create($data);

            $sarpras->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil ditambahkan.',
                'data' => $sarpras,
            ], 201);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan sarpras fakultas', [
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
    public function show(FakultasSarpras $sarpras): JsonResponse
    {
        try {
            // Cek apakah sarpras milik user yang sedang login
            if ($sarpras->users_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses ke data ini.',
                ], 403);
            }

            $sarpras->load('user');

            return response()->json([
                'success' => true,
                'data' => $sarpras,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil detail sarpras fakultas', [
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
    public function update(
        Request $request,
        FakultasSarpras $sarpras
    ): JsonResponse {
        // Cek apakah sarpras milik user yang sedang login
        if ($sarpras->users_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengupdate data ini.',
            ], 403);
        }

        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fakultas_sarpras', 'kode')
                    ->ignore($sarpras->id),
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

            'file' => [
                'nullable',
                'file',
                'max:5120',
                'mimes:jpg,jpeg,png,pdf,doc,docx',
            ],
        ], [
            'kode.required' => 'Kode sarpras wajib diisi.',
            'kode.unique' => 'Kode sarpras sudah digunakan.',
            'nama_sarpras.required' => 'Nama sarpras wajib diisi.',
            'status.required' => 'Status sarpras wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0.',
            'file.max' => 'Ukuran file maksimal 5MB.',
            'file.mimes' => 'Format file harus JPG, JPEG, PNG, PDF, DOC, atau DOCX.',
        ]);

        try {
            $data = [
                'kode' => $validated['kode'],
                'nama_sarpras' => $validated['nama_sarpras'],
                'status' => $validated['status'],
                'jumlah' => $validated['jumlah'],
            ];

            // Handle file upload
            if ($request->hasFile('file')) {

                // Hapus file lama jika ada
                if (
                    $sarpras->file_path &&
                    Storage::disk('public')->exists($sarpras->file_path)
                ) {
                    Storage::disk('public')->delete(
                        $sarpras->file_path
                    );
                }

                $file = $request->file('file');

                $fileName = time()
                    . '_'
                    . Str::slug(
                        pathinfo(
                            $file->getClientOriginalName(),
                            PATHINFO_FILENAME
                        )
                    )
                    . '.'
                    . $file->getClientOriginalExtension();

                $filePath = $file->storeAs(
                    'sarpras/' . date('Y/m'),
                    $fileName,
                    'public'
                );

                $data['file_path'] = $filePath;
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_type'] = $file->getMimeType();
                $data['file_size'] = $file->getSize();
            }

            $sarpras->update($data);

            $sarpras->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil diperbarui.',
                'data' => $sarpras,
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui sarpras fakultas', [
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
    public function destroy(FakultasSarpras $sarpras): JsonResponse
    {
        // Cek apakah sarpras milik user yang sedang login
        if ($sarpras->users_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus data ini.',
            ], 403);
        }

        try {
            // Hapus file jika ada.
            if (
                $sarpras->file_path &&
                Storage::disk('public')->exists($sarpras->file_path)
            ) {
                Storage::disk('public')->delete(
                    $sarpras->file_path
                );
            }

            $sarpras->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus sarpras fakultas', [
                'id' => $sarpras->id,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data sarpras.',
            ], 500);
        }
    }

    /**
     * Download file sarpras.
     */
    public function downloadFile(FakultasSarpras $sarpras)
    {
        // Cek akses
        if ($sarpras->users_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        if (
            !$sarpras->file_path ||
            !Storage::disk('public')->exists($sarpras->file_path)
        ) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download(
            $sarpras->file_path,
            $sarpras->file_name
        );
    }
}