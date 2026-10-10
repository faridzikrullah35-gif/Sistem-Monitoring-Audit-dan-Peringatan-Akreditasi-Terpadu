<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataDosen;
use App\Models\ProdiDataTendik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class ProfileSdmController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil SEMUA data (bukan paginate) — pagination dihandle di client-side
        $dosen = ProdiDataDosen::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $tendik = ProdiDataTendik::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.prodi.profile-sdm', compact('dosen', 'tendik'));
    }

    /**
     * ==========================================================
     * PRINT DATA DOSEN (milik user sendiri)
     * ==========================================================
     */
    public function printDosen()
    {
        $userId = Auth::id();
        $user   = Auth::user();

        $dosen = ProdiDataDosen::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        // ==================== HEADER CETAK (global) ====================
        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        // ==================== INFO PRODI ====================
        $namaProdi = $user->name ?? '-';
        $unit      = $user->unit ?? '-';

        return view('print.prodi.sdm-dosen', compact(
            'dosen',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
        ));
    }

    /**
     * ==========================================================
     * PRINT DATA TENDIK (milik user sendiri)
     * ==========================================================
     */
    public function printTendik()
    {
        $userId = Auth::id();
        $user   = Auth::user();

        $tendik = ProdiDataTendik::with('user')
            ->where('users_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        // ==================== HEADER CETAK (global) ====================
        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        // ==================== INFO PRODI ====================
        $namaProdi = $user->name ?? '-';
        $unit      = $user->unit ?? '-';

        return view('print.prodi.sdm-tendik', compact(
            'tendik',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaProdi',
            'unit',
        ));
    }
}