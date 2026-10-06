<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataDosen;
use App\Models\ProdiDataTendik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}