<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiDataLulusan;
use App\Models\ProdiDataMahasiswa;
use App\Models\RasioDosenMahasiswaProdi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilePddiktiController extends Controller
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
            return view('pages.auditor.profile-pddikti', [
                'mahasiswa' => collect(),
                'rasio' => collect(),
                'lulusan' => collect(),
            ]);
        }

        // Ambil data mahasiswa prodi langsung berdasarkan users_id
        $mahasiswa = ProdiDataMahasiswa::where('users_id', $prodi->id)
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        // Ambil data rasio dosen mahasiswa langsung berdasarkan users_id
        $rasio = RasioDosenMahasiswaProdi::where('users_id', $prodi->id)
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        // Ambil data lulusan per tahun langsung berdasarkan users_id
        $lulusan = ProdiDataLulusan::where('users_id', $prodi->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.auditor.profile-pddikti', [
            'mahasiswa' => $mahasiswa,
            'rasio' => $rasio,
            'lulusan' => $lulusan,
        ]);
    }
}