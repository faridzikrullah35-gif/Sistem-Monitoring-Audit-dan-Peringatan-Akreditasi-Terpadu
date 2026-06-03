<?php

namespace App\Http\Controllers;

use App\Models\FormObservasi;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class AuditeeObservasiController extends Controller
{
    public function index(Request $request)
    {
        $query = FormObservasi::with([
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiProdi.tahunAkademik',
        ]);

        if ($request->filled('tahun_akademik_id')) {
            $query->whereHas('pertanyaanAmiProdi', function ($q) use ($request) {
                $q->where('tahun_akademik_id', $request->tahun_akademik_id);
            });
        }

        $observations = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // AJAX REQUEST
        if ($request->ajax()) {
            return view(
                'components.auditee-observasi.observation-table',
                compact('observations')
            )->render();
        }

        $tahunAkademiks = TahunAkademik::latest()->get();

        return view('pages.auditee-observasi', compact(
            'observations',
            'tahunAkademiks'
        ));
    }
}