<?php

namespace App\Http\Controllers;

use App\Models\FormTerpenuhi;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use App\Models\SettingHeaderCetak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuditeeTerpenuhiController extends Controller
{
    /**
     * Helper: nama relasi di FormTerpenuhi ke pertanyaan asli
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
        | DAPATKAN TAHUN AKADEMIK YANG ADA (dari data terpenuhi)
        |--------------------------------------------------------------------------
        */
        $terpenuhiQuery = FormTerpenuhi::whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
              ->where('sub_unit', $user->sub_unit);
        })
        ->whereHas($relasiAmi, function ($q) {
            $q->whereNotNull('tahun_akademik_id');
        });

        if ($request->filled('tahun_akademik_id')) {
            $terpenuhiQuery->whereHas($relasiAmi, function ($q) use ($request) {
                $q->where('tahun_akademik_id', $request->tahun_akademik_id);
            });
        }

        // Ambil data lalu pluck tahun dari relasi (hindari dot notation di query builder)
        $tahunAkademikIds = $terpenuhiQuery->with($relasiAmi)
            ->get()
            ->pluck($relasiAmi . '.tahun_akademik_id')
            ->unique()
            ->filter()
            ->values();

        $tahunAkademik = TahunAkademik::whereIn('id', $tahunAkademikIds)
            ->orderBy('tahun_akademik', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | QUERY TERPENUHI (dengan filter dan paginasi)
        |--------------------------------------------------------------------------
        */
        $query = FormTerpenuhi::with([
            $relasiAmi . '.isiIndikator',
            'matrix.kriteriaAudit',
            'user',
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

        $terpenuhi = $query
            ->orderBy('created_at', 'asc')
            ->paginate(10)
            ->appends($request->query());

        // AJAX untuk table refresh
        if ($request->ajax() && $request->wantsJson()) {
            return response()->json([
                'table' => view('components.auditee-terpenuhi.terpenuhi-table', compact('terpenuhi'))->render()
            ]);
        }

        return view('pages.auditee-terpenuhi', compact(
            'terpenuhi',
            'tahunAkademik'
        ));
    }

    public function print(Request $request)
    {
        $user = auth()->user();
        $tahunAkademikId = $request->tahun_akademik_id;
        $relasiAmi = $this->getPertanyaanRelation();

        $query = FormTerpenuhi::with([
            $relasiAmi . '.isiIndikator',
            'matrix.kriteriaAudit.standar',
            'user'
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
              ->where('sub_unit', $user->sub_unit);
        });

        if ($tahunAkademikId) {
            $query->whereHas($relasiAmi, function ($q) use ($tahunAkademikId) {
                $q->where('tahun_akademik_id', $tahunAkademikId);
            });
        }

        $terpenuhiItems = $query->orderBy('id', 'asc')->get();
        $firstTerpenuhi = $terpenuhiItems->first();
        $auditorUserId = $firstTerpenuhi ? $firstTerpenuhi->users_id : null;
        $headerCetak = null;
        if ($auditorUserId) {
            $headerCetak = SettingHeaderCetak::where('auditor_id', $auditorUserId)
                ->first();
        }
        $headerNoDokumen = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi = $headerCetak?->no_revisi ?? '-';

        // Ambil nama tahun akademik untuk judul
        $tahunAkademik = null;
        if ($tahunAkademikId) {
            $tahunAkademik = TahunAkademik::find($tahunAkademikId);
        } elseif ($terpenuhiItems->isNotEmpty()) {
            $first = $terpenuhiItems->first();
            $tahunId = optional($first->{$relasiAmi})->tahun_akademik_id;
            $tahunAkademik = $tahunId ? TahunAkademik::find($tahunId) : null;
        }

        return view('auditee.terpenuhi.print', compact(
            'terpenuhiItems',
            'tahunAkademik',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi'
        ));
    }
}