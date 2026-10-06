<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiSarpras;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SarprasProdiController extends Controller
{
    /**
     * Menampilkan halaman data sarpras prodi.
     */
    public function index()
    {
        $sarpras = ProdiSarpras::with('user')
            ->where('users_id', Auth::id())
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.sarpras-prodi', compact('sarpras'));
    }

    /**
     * Mengambil data sarpras untuk AJAX.
     */
    public function data(): JsonResponse
    {
        try {
            $sarpras = ProdiSarpras::with('user')
                ->where('users_id', Auth::id())
                ->orderBy('id', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sarpras,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data sarpras prodi', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data sarpras.',
            ], 500);
        }
    }

    /**
     * Mengambil data sarpras dengan pagination (untuk AJAX).
     * Opsional — dipakai kalau nanti mau server-side pagination.
     */
    public function paginate(Request $request): JsonResponse
    {
        try {
            $perPage = (int) $request->query('per_page', 10);
            $page = (int) $request->query('page', 1);

            if ($perPage < 1) $perPage = 10;
            if ($page < 1) $page = 1;

            $query = ProdiSarpras::with('user')
                ->where('users_id', Auth::id())
                ->orderBy('id', 'asc');

            $total = $query->count();
            $sarpras = $query
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sarpras,
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pagination sarpras prodi', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pagination.',
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
                'unique:prodi_sarpras,kode',
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

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $fileName = time()
                    . '_'
                    . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.'
                    . $file->getClientOriginalExtension();

                $filePath = $file->storeAs('sarpras/' . date('Y/m'), $fileName, 'public');

                $data['file_path'] = $filePath;
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_type'] = $file->getMimeType();
                $data['file_size'] = $file->getSize();
            }

            $sarpras = ProdiSarpras::create($data);
            $sarpras->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil ditambahkan.',
                'data' => $sarpras,
            ], 201);

        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan sarpras prodi', [
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
    public function show(ProdiSarpras $sarpras): JsonResponse
    {
        try {
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
            Log::error('Gagal mengambil detail sarpras prodi', [
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
    public function update(Request $request, ProdiSarpras $sarpras): JsonResponse
    {
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
                Rule::unique('prodi_sarpras', 'kode')->ignore($sarpras->id),
            ],
            'nama_sarpras' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'file' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
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

            if ($request->hasFile('file')) {
                if ($sarpras->file_path && Storage::disk('public')->exists($sarpras->file_path)) {
                    Storage::disk('public')->delete($sarpras->file_path);
                }

                $file = $request->file('file');

                $fileName = time()
                    . '_'
                    . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.'
                    . $file->getClientOriginalExtension();

                $filePath = $file->storeAs('sarpras/' . date('Y/m'), $fileName, 'public');

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
            Log::error('Gagal memperbarui sarpras prodi', [
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
    public function destroy(ProdiSarpras $sarpras): JsonResponse
    {
        if ($sarpras->users_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus data ini.',
            ], 403);
        }

        try {
            if ($sarpras->file_path && Storage::disk('public')->exists($sarpras->file_path)) {
                Storage::disk('public')->delete($sarpras->file_path);
            }

            $sarpras->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data sarpras berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus sarpras prodi', [
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
     * Preview gambar sarpras (inline).
     */
    public function previewImage(ProdiSarpras $sarpras)
    {
        if ($sarpras->users_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        if (!$sarpras->file_path || !Storage::disk('public')->exists($sarpras->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($sarpras->file_path);
        $mime = Storage::disk('public')->mimeType($sarpras->file_path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . $sarpras->file_name . '"',
        ]);
    }
}