<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingProfileAdmin;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingProfileAdminController extends Controller
{
    /**
     * Menampilkan halaman Setting Profile Admin dengan daftar konten.
     */
    public function index()
    {
        $contents = SettingProfileAdmin::with('user')
            ->orderBy('id', 'asc')
            ->get();
        
        $strukturs = StrukturOrganisasi::with([
            'user',
            'parent',
            'children',
        ])
            ->orderBy('urutan', 'asc')
            ->get();
            
        return view('pages.admin.setting-profile-admin', compact('contents', 'strukturs'));
    }

    // ==========================================
    // CRUD KONTEN TENTANG KAMI
    // ==========================================

    /**
     * Menyimpan konten baru (Support AJAX).
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'deskripsi' => 'required|string',
                'visi' => 'required|string',
                'misi' => 'required|string',
                'tujuan' => 'required|string',
                'sasaran' => 'required|string',
                'is_active' => 'nullable|boolean',
                'dibuat_oleh' => 'nullable|string|max:255'
            ]);

            // Tambahkan users_id dari user yang sedang login
            $validated['users_id'] = Auth::id();

            // Jika dibuat_oleh tidak diisi, gunakan nama user yang login
            if (empty($validated['dibuat_oleh'])) {
                $validated['dibuat_oleh'] = Auth::user()->name;
            }

            // Jika konten diaktifkan, nonaktifkan konten lain yang aktif
            if ($request->has('is_active') && $request->is_active == 1) {
                SettingProfileAdmin::where('is_active', true)
                    ->update(['is_active' => false]);

                $validated['is_active'] = true;
            } else {
                $validated['is_active'] = false;
            }

            $content = SettingProfileAdmin::create($validated);

            // Load relasi user untuk response
            $content->load('user');

            // Response untuk AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Konten berhasil ditambahkan.',
                    'data' => $content,
                    'redirect' => route('setting-profile-admin.index')
                ], 201);
            }

            return redirect()->route('setting-profile-admin.index')
                ->with('success', 'Konten berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error storing content: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan konten: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal menambahkan konten.');
        }
    }

    /**
     * Menampilkan data konten untuk diedit (via AJAX).
     */
    public function edit($id)
    {
        try {
            $content = SettingProfileAdmin::with('user')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching content: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data konten.'
            ], 404);
        }
    }

    /**
     * Memperbarui konten yang sudah ada (Support AJAX).
     */
    public function update(Request $request, $id)
    {
        try {
            $content = SettingProfileAdmin::findOrFail($id);

            $validated = $request->validate([
                'deskripsi' => 'required|string',
                'visi' => 'required|string',
                'misi' => 'required|string',
                'tujuan' => 'required|string',
                'sasaran' => 'required|string',
                'is_active' => 'nullable|boolean',
                'dibuat_oleh' => 'nullable|string|max:255'
            ]);

            // Jika dibuat_oleh diisi, update
            if (!empty($validated['dibuat_oleh'])) {
                $content->dibuat_oleh = $validated['dibuat_oleh'];
            }

            // Jika konten diaktifkan, nonaktifkan konten lain yang aktif
            if ($request->has('is_active') && $request->is_active == 1) {
                SettingProfileAdmin::where('id', '!=', $id)
                    ->update(['is_active' => false]);

                $validated['is_active'] = true;
            } else {
                $validated['is_active'] = false;
            }

            // Update data
            $content->update([
                'deskripsi' => $validated['deskripsi'],
                'visi' => $validated['visi'],
                'misi' => $validated['misi'],
                'tujuan' => $validated['tujuan'],
                'sasaran' => $validated['sasaran'],
                'is_active' => $validated['is_active'],
            ]);

            // Load relasi user untuk response
            $content->load('user');

            // Response untuk AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Konten berhasil diperbarui.',
                    'data' => $content,
                    'redirect' => route('setting-profile-admin.index')
                ], 200);
            }

            return redirect()->route('setting-profile-admin.index')
                ->with('success', 'Konten berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating content: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui konten: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal memperbarui konten.');
        }
    }

    /**
     * Menghapus konten (Support AJAX).
     */
    public function destroy(Request $request, $id)
    {
        try {
            $content = SettingProfileAdmin::findOrFail($id);
            
            // Simpan data untuk response jika diperlukan
            $contentData = $content->toArray();
            
            $content->delete();

            // Response untuk AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Konten berhasil dihapus.',
                    'data' => $contentData,
                    'redirect' => route('setting-profile-admin.index')
                ], 200);
            }

            return redirect()->route('setting-profile-admin.index')
                ->with('success', 'Konten berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting content: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus konten: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal menghapus konten.');
        }
    }

    // ==========================================
    // CRUD STRUKTUR ORGANISASI
    // ==========================================

    /**
     * Menyimpan data struktur organisasi baru.
     */
    public function storeStruktur(Request $request)
    {
        try {
            $validated = $request->validate([
                'parent_id' => [
                    'nullable',
                    'integer',
                    'exists:struktur_organisasi,id',
                ],
                'nama' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'urutan' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);

            // User yang sedang login
            $validated['users_id'] = Auth::id();

            // Default status aktif
            $validated['is_active'] = $request->boolean('is_active', true);

            // Jika urutan tidak diisi,
            // letakkan setelah urutan terbesar.
            if ($request->filled('urutan')) {
                $validated['urutan'] = (int) $request->urutan;
            } else {
                $validated['urutan'] =
                    (StrukturOrganisasi::max('urutan') ?? 0) + 1;
            }

            // Handle upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');

                $filename = time() . '_' . $file->getClientOriginalName();

                $file->storeAs(
                    'struktur_organisasi',
                    $filename,
                    'public'
                );

                $validated['foto'] = $filename;
            }

            $struktur = StrukturOrganisasi::create($validated);

            // Load relasi untuk response AJAX
            $struktur->load([
                'user',
                'parent',
                'children',
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data struktur organisasi berhasil ditambahkan.',
                    'data' => $struktur,
                    'redirect' => route('setting-profile-admin.index'),
                ], 201);
            }

            return redirect()
                ->route('setting-profile-admin.index')
                ->with(
                    'success',
                    'Data struktur organisasi berhasil ditambahkan.'
                );

        } catch (\Exception $e) {

            Log::error(
                'Error storing struktur: ' . $e->getMessage()
            );

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan data: ' . $e->getMessage(),
                ], 500);
            }

            return back()
                ->with(
                    'error',
                    'Gagal menambahkan data struktur organisasi.'
                );
        }
    }

    /**
     * Menampilkan data struktur organisasi untuk diedit (via AJAX).
     */
    public function editStruktur($id)
    {
        try {
            $struktur = StrukturOrganisasi::with([
                'user',
                'parent',
                'children',
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $struktur,
            ]);

        } catch (\Exception $e) {

            Log::error(
                'Error fetching struktur: ' . $e->getMessage()
            );

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data struktur organisasi.',
            ], 404);
        }
    }

    /**
     * Memperbarui data struktur organisasi yang sudah ada.
     */
    public function updateStruktur(Request $request, $id)
    {
        try {
            $struktur = StrukturOrganisasi::findOrFail($id);

            $validated = $request->validate([
                'parent_id' => [
                    'nullable',
                    'integer',
                    'exists:struktur_organisasi,id',
                ],
                'nama' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'urutan' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);

            /*
            * Jangan sampai struktur menjadi parent
            * untuk dirinya sendiri.
            */
            if (
                !empty($validated['parent_id']) &&
                (int) $validated['parent_id'] === (int) $struktur->id
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Struktur tidak dapat menjadi parent untuk dirinya sendiri.',
                ], 422);
            }

            /*
            * Cek apakah parent yang dipilih adalah
            * salah satu keturunan dari struktur ini.
            *
            * Contoh:
            * Ketua
            *  └── Kepala Divisi
            *       └── Staff
            *
            * Ketua tidak boleh memilih Staff sebagai parent.
            */
            if (!empty($validated['parent_id'])) {

                $parentId = (int) $validated['parent_id'];

                $current = StrukturOrganisasi::find($parentId);

                while ($current) {

                    if ((int) $current->id === (int) $struktur->id) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Parent tidak valid karena akan membentuk struktur melingkar.',
                        ], 422);
                    }

                    if (!$current->parent_id) {
                        break;
                    }

                    $current = StrukturOrganisasi::find(
                        $current->parent_id
                    );
                }
            }

            /*
            * Status aktif.
            */
            $validated['is_active'] =
                $request->boolean('is_active', false);

            /*
            * Handle upload foto baru.
            */
            if ($request->hasFile('foto')) {

                // Hapus foto lama
                if ($struktur->foto) {
                    Storage::disk('public')->delete(
                        'struktur_organisasi/' . $struktur->foto
                    );
                }

                $file = $request->file('foto');

                $filename =
                    time() . '_' . $file->getClientOriginalName();

                $file->storeAs(
                    'struktur_organisasi',
                    $filename,
                    'public'
                );

                $validated['foto'] = $filename;
            }

            $struktur->update($validated);

            $struktur->load([
                'user',
                'parent',
                'children',
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data struktur organisasi berhasil diperbarui.',
                    'data' => $struktur,
                    'redirect' => route('setting-profile-admin.index'),
                ], 200);
            }

            return redirect()
                ->route('setting-profile-admin.index')
                ->with(
                    'success',
                    'Data struktur organisasi berhasil diperbarui.'
                );

        } catch (\Exception $e) {

            Log::error(
                'Error updating struktur: ' . $e->getMessage()
            );

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui data: ' . $e->getMessage(),
                ], 500);
            }

            return back()
                ->with(
                    'error',
                    'Gagal memperbarui data struktur organisasi.'
                );
        }
    }

    /**
     * Menghapus data struktur organisasi.
     */
    public function destroyStruktur(Request $request, $id)
    {
        try {
            $struktur = StrukturOrganisasi::findOrFail($id);
            
            // Hapus foto jika ada
            if ($struktur->foto) {
                Storage::disk('public')->delete('struktur_organisasi/' . $struktur->foto);
            }
            
            $strukturData = $struktur->toArray();
            $struktur->delete();

            // Response untuk AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data struktur organisasi berhasil dihapus.',
                    'data' => $strukturData,
                    'redirect' => route('setting-profile-admin.index')
                ], 200);
            }

            return redirect()->route('setting-profile-admin.index')
                ->with('success', 'Data struktur organisasi berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting struktur: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal menghapus data struktur organisasi.');
        }
    }
}