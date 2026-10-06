<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\DokumenProdi;
use App\Models\ProdiKegiatanBenchmarking;
use App\Models\ProdiSosialMedia;
use App\Models\ProfilProdi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IdentitasProdiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cari prodi dengan unit & sub_unit yang sama
        $prodi = User::where('role', 'prodi')
            ->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit)
            ->first();

        // Default values kalau prodi gak ketemu
        $emptyView = [
            'profil'               => null,
            'dokumenRip'           => collect(),
            'dokumenRenstra'       => collect(),
            'dokumenRenop'         => collect(),
            'dokumenMou'           => collect(),
            'kegiatanBenchmarking' => collect(),
            'sosialMedia'          => null,
        ];

        if (!$prodi) {
            return view('pages.auditor.identitas-prodi', $emptyView);
        }

        // Ambil profil prodi milik user prodi
        $profil = ProfilProdi::where('user_id', $prodi->id)->first();

        // Ambil dokumen by jenis (1 query, groupBy)
        $dokumenByJenis = collect();
        if ($profil) {
            $dokumenByJenis = DokumenProdi::where('profil_prodi_id', $profil->id)
                ->orderBy('id', 'asc')
                ->get()
                ->groupBy('jenis');
        }

        // Ambil kegiatan benchmarking (relasi ke users_id, bukan profil_prodi_id)
        $kegiatanBenchmarking = ProdiKegiatanBenchmarking::where('users_id', $prodi->id)
            ->orderBy('tgl_pelaksanaan', 'desc')
            ->get();

        // Ambil sosial media (relasi ke users_id)
        $sosialMedia = ProdiSosialMedia::where('users_id', $prodi->id)->first();

        return view('pages.auditor.identitas-prodi', [
            'profil'               => $profil,
            'dokumenRip'           => $dokumenByJenis->get('RIP', collect()),
            'dokumenRenstra'       => $dokumenByJenis->get('RENSTRA', collect()),
            'dokumenRenop'         => $dokumenByJenis->get('RENOP', collect()),
            'dokumenMou'           => $dokumenByJenis->get('MOU', collect()),
            'kegiatanBenchmarking' => $kegiatanBenchmarking,
            'sosialMedia'          => $sosialMedia,
        ]);
    }
}