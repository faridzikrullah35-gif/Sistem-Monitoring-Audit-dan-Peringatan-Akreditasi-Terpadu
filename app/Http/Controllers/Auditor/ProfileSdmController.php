<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataDosen;
use App\Models\ProdiDataTendik;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileSdmController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cari prodi dengan unit & sub_unit yang sama
        $prodi = User::where('role', 'prodi')
            ->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit)
            ->first();

        if (!$prodi) {
            return view('pages.auditor.profile-sdm', [
                'dosen' => collect(),
                'tendik' => collect(),
            ]);
        }

        // Ambil data dosen prodi langsung berdasarkan users_id
        $dosen = ProdiDataDosen::where('users_id', $prodi->id)
            ->orderBy('nama', 'asc')
            ->get();

        // Ambil data tendik prodi langsung berdasarkan users_id
        $tendik = ProdiDataTendik::where('users_id', $prodi->id)
            ->orderBy('nama', 'asc')
            ->get();

        return view('pages.auditor.profile-sdm', [
            'dosen' => $dosen,
            'tendik' => $tendik,
        ]);
    }
}