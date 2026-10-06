<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingHeaderCetak;
use Illuminate\Http\Request;

class SettingHeaderCetakController extends Controller
{
    /**
     * Menampilkan halaman setting header cetak.
     */
    public function index()
    {
        $settingHeaderCetak = SettingHeaderCetak::orderBy('id', 'asc')
            ->paginate(10);
        
        return view('pages.admin.setting-header-cetak', compact('settingHeaderCetak'));
    }
    
    /**
     * Simpan setting header cetak.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_dokumen' => ['required', 'string', 'max:255'],
            'tanggal_terbit' => ['required', 'date'],
            'no_revisi' => ['required', 'string', 'max:50'],
        ]);

        $setting = SettingHeaderCetak::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Setting header cetak berhasil ditambahkan.',
            'data' => $setting,
        ]);
    }

    /**
     * Ambil satu data untuk edit via AJAX (tidak wajib digunakan).
     */
    public function show($id)
    {
        $setting = SettingHeaderCetak::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $setting,
        ]);
    }

    /**
     * Update setting header cetak.
     */
    public function update(Request $request, $id)
    {
        $setting = SettingHeaderCetak::findOrFail($id);

        $validated = $request->validate([
            'no_dokumen' => ['required', 'string', 'max:255'],
            'tanggal_terbit' => ['required', 'date'],
            'no_revisi' => ['required', 'string', 'max:50'],
        ]);

        $setting->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Setting header cetak berhasil diperbarui.',
            'data' => $setting,
        ]);
    }

    /**
     * Hapus setting header cetak.
     */
    public function destroy($id)
    {
        $setting = SettingHeaderCetak::findOrFail($id);

        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Setting header cetak berhasil dihapus.',
        ]);
    }
}