<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use App\Models\AdminInputBerita;

class LandingController extends Controller
{
    public function index()
    {
        $nasionalStats = Akreditasi::query()
            ->whereNotNull('peringkat_akreditasi')
            ->where('peringkat_akreditasi', '!=', '')
            ->select('peringkat_akreditasi')
            ->get()
            ->groupBy('peringkat_akreditasi')
            ->map(fn ($items) => $items->count())
            ->sortDesc()
            ->toArray();

        $internasionalStats = Akreditasi::query()
            ->whereNotNull('akreditasi_internasional')
            ->where('akreditasi_internasional', '!=', '')
            ->select('akreditasi_internasional')
            ->get()
            ->groupBy('akreditasi_internasional')
            ->map(fn ($items) => $items->count())
            ->sortDesc()
            ->toArray();

        $beritas = AdminInputBerita::query()
            ->with(['files:id,admin_input_berita_id,nama_file,file'])
            ->select(['id', 'nama_file', 'thumbnail', 'created_at'])
            ->latest('created_at')
            ->take(6)
            ->get();

        return view('pages.landing.landingpage-simantap', [
            'nasionalStats' => $nasionalStats,
            'internasionalStats' => $internasionalStats,
            'beritas' => $beritas,
        ]);
    }
}