<?php

namespace App\Services\Prodi;

use App\Models\DokumenProdi;
use App\Models\ProfilProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DokumenProdiService
{
    /**
     * Ambil profil prodi berdasarkan user login.
     */
    protected function profil(): ProfilProdi
    {
        return ProfilProdi::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Ambil semua dokumen berdasarkan kategori.
     */
    public function getByJenis(string $jenis)
    {
        return DokumenProdi::where(
                'profil_prodi_id',
                $this->profil()->id
            )
            ->where('jenis', $jenis)
            ->latest()
            ->get();
    }

    /**
     * Upload file.
     */
    protected function uploadFile(Request $request): ?string
    {
        if (!$request->hasFile('file')) {
            return null;
        }

        return $request->file('file')->store(
            'profil-prodi',
            'public'
        );
    }

    /**
     * Hapus file.
     */
    protected function deleteFile(?string $path): void
    {
        if (
            $path &&
            Storage::disk('public')->exists($path)
        ) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Validator dokumen.
     */
    protected function validator(Request $request, bool $update = false)
    {
        return Validator::make($request->all(), [

            'kategori' => 'required|string|max:50',

            'nama_dokumen' => 'required|string|max:255',

            'tanggal_penetapan' => 'required|date',

            'tanggal_revisi' => 'nullable|date',

            'keterangan' => 'nullable|string',

            'file' => ($update ? 'nullable' : 'required')
                . '|file|mimes:pdf,doc,docx|max:5120',

        ]);
    }

    /**
     * Simpan dokumen.
     */
    public function store(Request $request): DokumenProdi
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return DokumenProdi::create([

            'profil_prodi_id' => $this->profil()->id,

            'jenis' => $request->kategori,

            'nama_dokumen' => $request->nama_dokumen,

            'file' => $this->uploadFile($request),

            'tanggal_penetapan' => $request->tanggal_penetapan,

            'tanggal_revisi' => $request->tanggal_revisi,

            'keterangan' => $request->keterangan,

        ]);
    }

    /**
     * Ambil detail dokumen berdasarkan ID.
     */
    public function find(int $id): DokumenProdi
    {
        return DokumenProdi::where(
            'profil_prodi_id',
            $this->profil()->id
        )->findOrFail($id);
    }

    /**
     * Update dokumen.
     */
    public function update(Request $request, int $id): DokumenProdi
    {
        $dokumen = $this->find($id);

        $validator = $this->validator($request, true);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        $data = [

            'jenis'             => $request->kategori,

            'nama_dokumen'      => $request->nama_dokumen,

            'tanggal_penetapan' => $request->tanggal_penetapan,

            'tanggal_revisi'    => $request->tanggal_revisi,

            'keterangan'        => $request->keterangan,

        ];

        if ($request->hasFile('file')) {

            $this->deleteFile($dokumen->file);

            $data['file'] = $this->uploadFile($request);

        }

        $dokumen->update($data);

        return $dokumen->fresh();
    }

    /**
     * Hapus dokumen.
     */
    public function delete(int $id): void
    {
        $dokumen = $this->find($id);

        // Hapus file fisik
        $this->deleteFile($dokumen->file);

        // Hapus data database
        $dokumen->delete();
    }

}