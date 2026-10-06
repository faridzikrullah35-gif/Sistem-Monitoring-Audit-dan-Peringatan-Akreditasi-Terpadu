<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiPenelitian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}