<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiSarpras;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SarprasAuditorController extends Controller
{
    /**
     * Menampilkan halaman data sarpras untuk auditor.
     * Hanya menampilkan data dari prodi dengan unit/sub_unit yang sama.
     */
    public function index()
    {
        $user = Auth::user();

        // Cari prodi dengan unit & sub_unit yang sama
        // Bisa dipakai oleh AUDITOR_PRODI atau AUDITOR_UNIT_KERJA
        $prodi = User::where('role', 'prodi')
            ->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit)
            ->first();

        // Jika tidak ada prodi yang cocok, tampilkan kosong
        if (!$prodi) {
            return view('pages.auditor.sarpras-auditor', [
                'sarpras' => collect(),
            ]);
        }

        // Ambil sarpras milik user prodi tersebut
        $sarpras = ProdiSarpras::with('user')
            ->where('users_id', $prodi->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.auditor.sarpras-auditor', compact('sarpras'));
    }

    /**
     * Mengambil data sarpras untuk AJAX (untuk refresh tabel).
     */
    public function data(): JsonResponse
    {
        try {
            $user = Auth::user();

            // Cari prodi dengan unit & sub_unit yang sama
            $prodi = User::where('role', 'prodi')
                ->where('unit', $user->unit)
                ->where('sub_unit', $user->sub_unit)
                ->first();

            if (!$prodi) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                ]);
            }

            $sarpras = ProdiSarpras::with('user')
                ->where('users_id', $prodi->id)
                ->orderBy('id', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sarpras,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data sarpras auditor', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data sarpras.',
            ], 500);
        }
    }
}