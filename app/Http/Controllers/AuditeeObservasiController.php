<?php

namespace App\Http\Controllers;

use App\Models\FormObservasi;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class AuditeeObservasiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $amiModel = $user->role === 'unit_kerja'
            ? \App\Models\PertanyaanAmiUnit::class
            : \App\Models\PertanyaanAmiProdi::class;

        $relasiAmi = $user->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';

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

        $tahunAkademiks = $amiModel::select('tahun_akademik_id')
            ->distinct()
            ->pluck('tahun_akademik_id');

        $tahunAkademiks = TahunAkademik::whereIn('id', $tahunAkademiks)
            ->orderBy('tahun_akademik', 'desc')
            ->get();

        if ($request->ajax()) {
            return view(
                'components.auditee-observasi.observation-table',
                compact('observations')
            )->render();
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

        // Tentukan model dan relasi sesuai role
        $amiModel = $user->role === 'unit_kerja'
            ? \App\Models\PertanyaanAmiUnit::class
            : \App\Models\PertanyaanAmiProdi::class;

        $relasiAmi = $user->role === 'unit_kerja'
            ? 'pertanyaanAmiUnit'
            : 'pertanyaanAmiProdi';

        // Query data observasi milik auditee (sama dengan di index)
        $query = FormObservasi::with([
            $relasiAmi . '.isiIndikator',
            $relasiAmi . '.tahunAkademik',
            'user',
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit);
        });

        // Filter tahun jika ada
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
            $tahunId = $first->{$relasiAmi}->tahun_akademik_id ?? null;
            $tahunAkademik = $tahunId ? TahunAkademik::find($tahunId) : null;
        }

        return view('auditee.observasi.print', compact('observasiItems', 'tahunAkademik'));
    }

}