<?php

namespace App\Http\Controllers;

use App\Models\Auditiee;
use App\Models\TahunAkademik;

class DataAuditeeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $auditees = Auditiee::with('tahunAkademik')
            ->whereHas('user', function ($q) use ($user) {
                $q->where('unit', $user->unit)
                ->where('sub_unit', $user->sub_unit);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        $tahunAkademiks = TahunAkademik::where('status', 'Aktif')
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        return view('pages.data-auditee', compact(
            'auditees',
            'tahunAkademiks'
        ));
    }
}