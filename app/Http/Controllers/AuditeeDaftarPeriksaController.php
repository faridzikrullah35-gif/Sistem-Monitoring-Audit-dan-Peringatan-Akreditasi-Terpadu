<?php

namespace App\Http\Controllers;

use App\Models\AuditPeriksa;
use App\Models\PertanyaanAmiProdi;
use App\Models\TahunAkademik;

class AuditeeDaftarPeriksaController extends Controller
{
    public function index()
    {
        $tahunAkademiks = TahunAkademik::whereIn(
            'id',
            PertanyaanAmiProdi::select('tahun_akademik_id')->distinct()
        )
        ->orderBy('tahun_akademik', 'desc')
        ->get();

        $daftarPeriksas = AuditPeriksa::with([
            'pertanyaanAmiProdi.indikator.matrix.kriteriaAudit.standar',
            'pertanyaanAmiProdi.tahunAkademik',
            'score',
        ])
        ->latest()
        ->get();

        return view('pages.auditee-daftar-periksa', compact(
            'tahunAkademiks',
            'daftarPeriksas'
        ));
    }
}