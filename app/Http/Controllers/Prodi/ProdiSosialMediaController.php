<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiSosialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProdiSosialMediaController extends Controller
{
    /**
     * Daftar platform yang diizinkan.
     */
    private const PLATFORMS = [
        'instagram',
        'facebook',
        'youtube',
        'tiktok',
        'linkedin',
        'website',
    ];

    /**
     * Ambil atau buat record sosial media milik prodi yang login.
     */
    private function getSosialMedia()
    {
        return ProdiSosialMedia::firstOrCreate(
            ['users_id' => Auth::id()],
            [
                'instagram' => null,
                'facebook'  => null,
                'youtube'   => null,
                'tiktok'    => null,
                'linkedin'  => null,
                'website'   => null,
            ]
        );
    }

    /**
     * Response sukses (JSON).
     */
    private function success($message, $data = null)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    /**
     * Response error validasi (JSON).
     */
    private function validationError($validator)
    {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    /**
     * ==========================================================
     * SHOW (ambil 1 data sosial media milik prodi)
     * ==========================================================
     */
    public function show()
    {
        return $this->success(
            'Data sosial media ditemukan.',
            $this->getSosialMedia()
        );
    }

    /**
     * ==========================================================
     * EDIT (ambil data untuk form edit)
     * ==========================================================
     */
    public function edit()
    {
        return $this->success(
            'Data sosial media ditemukan.',
            $this->getSosialMedia()
        );
    }

    /**
     * ==========================================================
     * UPDATE (per platform)
     * ==========================================================
     *
     * Body request:
     *   - platform : instagram | facebook | youtube | tiktok | linkedin | website
     *   - value    : url atau kosong (untuk hapus)
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'platform' => 'required|in:' . implode(',', self::PLATFORMS),
            'value'    => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $sosialMedia = ProdiSosialMedia::findOrFail($id);

        // Pastikan hanya pemilik yang boleh update
        if ($sosialMedia->users_id !== Auth::id()) {
            return response()->json([
                'status'  => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah data ini.',
            ], 403);
        }

        $platform = $request->platform;

        // Update field sesuai platform. Kosong = null (hapus).
        $sosialMedia->update([
            $platform => $request->filled('value') ? $request->value : null,
        ]);

        return $this->success(
            'Link ' . ucfirst($platform) . ' berhasil diperbarui.',
            $sosialMedia->fresh()
        );
    }

    /**
     * ==========================================================
     * DELETE (hapus 1 record sosial media prodi)
     * ==========================================================
     *
     * Catatan: Ini menghapus SELURUH record sosial media prodi,
     * bukan per platform. Untuk hapus per platform, gunakan update
     * dengan value kosong.
     */
    public function destroy($id)
    {
        $sosialMedia = ProdiSosialMedia::findOrFail($id);

        if ($sosialMedia->users_id !== Auth::id()) {
            return response()->json([
                'status'  => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus data ini.',
            ], 403);
        }

        $sosialMedia->delete();

        return $this->success('Data sosial media berhasil dihapus.');
    }
}