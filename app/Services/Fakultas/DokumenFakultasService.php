<?php

namespace App\Services\Fakultas;

use App\Models\DokumenFakultas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenFakultasService
{
    /**
     * Get dokumen milik Fakultas (user login sendiri) by kategori
     */
    public function getByKategoriFakultas($kategori)
    {
        return DokumenFakultas::with('user')
            ->where('user_id', Auth::id())
            ->where('kategori', $kategori)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get dokumen by kategori (legacy - tetap dipakai di tempat lain jika ada)
     */
    public function getByKategori($kategori)
    {
        return DokumenFakultas::where('user_id', Auth::id())
            ->where('kategori', $kategori)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get all dokumen
     */
    public function getAll()
    {
        return DokumenFakultas::orderBy('created_at', 'desc')->get();
    }

    /**
     * Find dokumen by id
     */
    public function find($id)
    {
        return DokumenFakultas::findOrFail($id);
    }

    /**
     * Store dokumen
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'dokumen/fakultas/' . $request->kategori . '/' . $fileName;

            Storage::disk('public')->put(
                $filePath,
                file_get_contents($file)
            );

            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }

        return DokumenFakultas::create($data);
    }

    /**
     * Update dokumen
     */
    public function update(Request $request, $id)
    {
        $dokumen = DokumenFakultas::where('user_id', Auth::id())
            ->findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('file')) {
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'dokumen/fakultas/' . ($request->kategori ?? $dokumen->kategori) . '/' . $fileName;

            Storage::disk('public')->put($filePath, file_get_contents($file));

            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }

        $dokumen->update($data);
        return $dokumen;
    }

    /**
     * Delete dokumen
     */
    public function delete($id)
    {
        $dokumen = DokumenFakultas::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        return $dokumen->delete();
    }

    /**
     * Get dokumen by kategori with pagination
     */
    public function getByKategoriPaginate($kategori, $perPage = 10)
    {
        return DokumenFakultas::where('kategori', $kategori)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Search dokumen by nama or kategori
     */
    public function search($keyword)
    {
        return DokumenFakultas::where('nama_dokumen', 'LIKE', "%{$keyword}%")
            ->orWhere('kategori', 'LIKE', "%{$keyword}%")
            ->orderBy('created_at', 'desc')
            ->get();
    }
}