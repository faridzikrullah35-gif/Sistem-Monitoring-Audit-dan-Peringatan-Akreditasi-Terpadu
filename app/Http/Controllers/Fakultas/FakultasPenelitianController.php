<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiPenelitian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class FakultasPenelitianController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allowedPerPage = [10, 25, 50, 100];

        // ===================== Daftar Prodi =====================
        $prodi = User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();

        $prodiUserIds = $prodi->pluck('id')->toArray();

        // ===================== Filter Prodi =====================
        $filterProdi = request()->query('filter_prodi');
        $prodiFilterIds = $filterProdi
            ? [(int) $filterProdi]
            : $prodiUserIds;

        // ===================== Filter Tahun =====================
        $filterTahun = request()->query('filter_tahun_akademik');

        // ===================== Filter Tingkat =====================
        $filterTingkat = request()->query('filter_tingkat');

        // ===================== Pagination =====================
        $perPage = request()->query('per_page', 10);

        $query = ProdiPenelitian::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, function ($q) use ($filterTahun) {
                $q->where('tahun_akademik', $filterTahun);
            })
            ->when($filterTingkat, function ($q) use ($filterTingkat) {
                $q->where('tingkat', $filterTingkat);
            })
            ->orderBy('id', 'asc');

        if ($perPage === 'all') {
            $penelitian = $query->get();
        } else {
            $perPage = in_array((int) $perPage, $allowedPerPage, true)
                ? (int) $perPage : 10;

            $penelitian = $query->paginate($perPage, ['*'], 'penelitian_page')
                ->withQueryString();
        }

        // ===================== List Tahun (untuk dropdown) =====================
        $tahunList = ProdiPenelitian::whereIn('users_id', $prodiUserIds)
            ->select('tahun_akademik')
            ->whereNotNull('tahun_akademik')
            ->where('tahun_akademik', '!=', '')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        // ===================== List Tingkat (untuk dropdown) =====================
        $tingkatList = ['Internasional', 'Nasional', 'Lokal'];

        // ===================== AJAX =====================
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            if ($partial === 'penelitian') {
                return view('components.fakultas-penelitian.data-table', compact('penelitian'));
            }

            if (request()->has('penelitian_page') || request()->has('per_page')) {
                return view('components.fakultas-penelitian.data-table', compact('penelitian'));
            }
        }

        return view('pages.fakultas.fakultas-penelitian', compact(
            'prodi',
            'penelitian',
            'tahunList',
            'tingkatList',
            'filterProdi',
            'filterTahun',
            'filterTingkat'
        ));
    }

    /**
     * ==========================================================
     * PRINT DATA PENELITIAN (Fakultas) — dengan filter
     * ==========================================================
     */
    public function print(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Anda harus login terlebih dahulu.');
        }

        // ===================== Daftar Prodi di fakultas ini =====================
        $prodi = User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();

        $prodiUserIds = $prodi->pluck('id')->toArray();

        // ===================== Filter dari query string =====================
        $filterProdi   = $request->query('filter_prodi');
        $filterTahun   = $request->query('filter_tahun_akademik');
        $filterTingkat = $request->query('filter_tingkat');

        $prodiFilterIds = $filterProdi ? [(int) $filterProdi] : $prodiUserIds;

        // ===================== Query =====================
        $query = ProdiPenelitian::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, fn($q) => $q->where('tahun_akademik', $filterTahun))
            ->when($filterTingkat, fn($q) => $q->where('tingkat', $filterTingkat))
            ->orderBy('id', 'asc');

        $penelitian = $query->get();

        // ===================== Header Cetak =====================
        $headerCetak = SettingHeaderCetak::latest('id')->first();

        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y')
            : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        // ===================== Info Fakultas =====================
        $namaFakultas = $user->name ?? '-';
        $unit         = $user->unit ?? '-';

        // ===================== Info Filter =====================
        $filterParts = [];
        if ($filterProdi) {
            $namaProdi = $prodi->firstWhere('id', (int) $filterProdi);
            $filterParts[] = "Prodi: " . ($namaProdi->sub_unit ?? $namaProdi->name ?? '-');
        }
        if ($filterTahun)   $filterParts[] = "Tahun Akademik: {$filterTahun}";
        if ($filterTingkat) $filterParts[] = "Tingkat: {$filterTingkat}";
        $filterInfo = !empty($filterParts) ? implode(' | ', $filterParts) : null;

        return view('print.fakultas.penelitian', compact(
            'penelitian',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaFakultas',
            'unit',
            'filterInfo',
        ));
    }
}