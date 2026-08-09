<?php

namespace App\Http\Controllers;

use App\Models\FormObservasi;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class AuditeeObservasiController extends Controller
{
    /**
     * Helper: nama relasi di FormObservasi ke pertanyaan asli
     */
    private function getPertanyaanRelation()
    {
        return auth()->user()->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $relasiAmi = $this->getPertanyaanRelation();

        /*
        |--------------------------------------------------------------------------
        | DAPATKAN TAHUN AKADEMIK YANG ADA (dari data observasi)
        |--------------------------------------------------------------------------
        */
        $observasiQuery = FormObservasi::whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
              ->where('sub_unit', $user->sub_unit);
        })
        ->whereHas($relasiAmi, function ($q) {
            $q->whereNotNull('tahun_akademik_id');
        });

        if ($request->filled('tahun_akademik_id')) {
            $observasiQuery->whereHas($relasiAmi, function ($q) use ($request) {
                $q->where('tahun_akademik_id', $request->tahun_akademik_id);
            });
        }

        // Ambil data lalu pluck tahun dari relasi (hindari dot notation di query builder)
        $tahunAkademikIds = $observasiQuery->with($relasiAmi)
            ->get()
            ->pluck($relasiAmi . '.tahun_akademik_id')
            ->unique()
            ->filter()
            ->values();

        $tahunAkademiks = TahunAkademik::whereIn('id', $tahunAkademikIds)
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | QUERY OBSERVASI (dengan filter dan paginasi)
        |--------------------------------------------------------------------------
        */
        $query = FormObservasi::with([
            $relasiAmi . '.isiIndikator',
            $relasiAmi . '.tahunAkademik',
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
              ->where('sub_unit', $user->sub_unit);
        });

        if ($request->filled('tahun_akademik_id')) {
            $query->whereHas($relasiAmi, function ($q) use ($request) {
                $q->where('tahun_akademik_id', $request->tahun_akademik_id);
            });
        }

        $observations = $query
            ->orderBy('created_at', 'asc')
            ->paginate(10)
            ->withQueryString();

        // AJAX untuk table refresh
        if ($request->ajax()) {
            return view('components.auditee-observasi.observation-table', compact('observations'))->render();
        }

        return view('pages.auditee-observasi', compact(
            'observations',
            'tahunAkademiks'
        ));
    }

    /**
     * Print form observasi untuk auditee berdasarkan filter tahun akademik
     */
    public function print(Request $request)
    {
        $user = auth()->user();
        $relasiAmi = $this->getPertanyaanRelation();

        $query = FormObservasi::with([
            $relasiAmi . '.isiIndikator',
            $relasiAmi . '.tahunAkademik',
            'user',
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
              ->where('sub_unit', $user->sub_unit);
        });

        $tahunAkademikId = $request->tahun_akademik_id;
        if ($tahunAkademikId) {
            $query->whereHas($relasiAmi, function ($q) use ($tahunAkademikId) {
                $q->where('tahun_akademik_id', $tahunAkademikId);
            });
        }

        $observasiItems = $query->orderBy('id', 'asc')->get();

        // Ambil nama tahun akademik untuk judul
        $tahunAkademik = null;
        if ($tahunAkademikId) {
            $tahunAkademik = TahunAkademik::find($tahunAkademikId);
        } elseif ($observasiItems->isNotEmpty()) {
            $first = $observasiItems->first();
            $tahunId = optional($first->{$relasiAmi})->tahun_akademik_id;
            $tahunAkademik = $tahunId ? TahunAkademik::find($tahunId) : null;
        }

        return view('auditee.observasi.print', compact('observasiItems', 'tahunAkademik'));
    }
}