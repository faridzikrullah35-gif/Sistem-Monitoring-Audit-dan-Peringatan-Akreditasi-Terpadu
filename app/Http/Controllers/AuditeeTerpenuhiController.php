<?php

namespace App\Http\Controllers;

use App\Models\FormTerpenuhi;
use App\Models\PertanyaanAmiProdi;
use App\Models\PertanyaanAmiUnit;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class AuditeeTerpenuhiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $amiModel = $user->role === 'unit_kerja'
            ? PertanyaanAmiUnit::class
            : PertanyaanAmiProdi::class;

        $tahunAkademik = TahunAkademik::whereIn(
            'id',
            $amiModel::whereNotNull('tahun_akademik_id')
                ->pluck('tahun_akademik_id')
                ->unique()
        )
        ->orderBy('tahun_akademik', 'desc')
        ->orderBy('semester', 'desc')
        ->get();

        $terpenuhi = FormTerpenuhi::with([
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiUnit.isiIndikator',
            'matrix.kriteriaAudit',
            'user',
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
              ->where('sub_unit', $user->sub_unit);
        })
        ->when($request->filled('tahun_akademik_id'), function ($query) use ($request) {
            $tahunId = $request->tahun_akademik_id;
            $query->where(function ($q) use ($tahunId) {
                $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($tahunId) {
                    $sub->where('tahun_akademik_id', $tahunId);
                })
                ->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($tahunId) {
                    $sub->where('tahun_akademik_id', $tahunId);
                });
            });
        })
        ->orderBy('created_at', 'asc')
        ->paginate(10)
        ->appends($request->query());

        if ($request->ajax() && $request->wantsJson()) {
            return response()->json([
                'table' => view(
                    'components.auditee-terpenuhi.terpenuhi-table',
                    compact('terpenuhi')
                )->render()
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

        $terpenuhiItems = FormTerpenuhi::with([
            'pertanyaanAmiProdi.isiIndikator',
            'pertanyaanAmiUnit.isiIndikator',
            'matrix.kriteriaAudit.standar',
            'user'
        ])
        ->whereHas('user', function ($q) use ($user) {
            $q->where('unit', $user->unit)
              ->where('sub_unit', $user->sub_unit);
        })
        ->when($tahunAkademikId, function ($query) use ($tahunAkademikId) {
            $query->where(function ($q) use ($tahunAkademikId) {
                $q->whereHas('pertanyaanAmiProdi', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                })
                ->orWhereHas('pertanyaanAmiUnit', function ($sub) use ($tahunAkademikId) {
                    $sub->where('tahun_akademik_id', $tahunAkademikId);
                });
            });
        })
        ->orderBy('id', 'asc')
        ->get();

        $tahunAkademik = $tahunAkademikId
            ? TahunAkademik::find($tahunAkademikId)
            : null;

        return view('auditee.terpenuhi.print', compact('terpenuhiItems', 'tahunAkademik'));
    }
}