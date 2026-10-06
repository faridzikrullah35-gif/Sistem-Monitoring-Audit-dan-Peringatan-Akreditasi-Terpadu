<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiInovasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasInovasiController extends Controller
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

        // ===================== Filter Jenis Inovasi =====================
        $filterJenis = request()->query('filter_jenis_inovasi');

        // ===================== Pagination =====================
        $perPage = request()->query('per_page', 10);

        $query = ProdiInovasi::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, function ($q) use ($filterTahun) {
                $q->where('tahun_akademik', $filterTahun);
            })
            ->when($filterJenis, function ($q) use ($filterJenis) {
                $q->where('jenis_inovasi', $filterJenis);
            })
            ->orderBy('id', 'asc');

        if ($perPage === 'all') {
            $inovasi = $query->get();
        } else {
            $perPage = in_array((int) $perPage, $allowedPerPage, true)
                ? (int) $perPage : 10;

            $inovasi = $query->paginate($perPage, ['*'], 'inovasi_page')
                ->withQueryString();
        }

        // ===================== List Tahun =====================
        $tahunList = ProdiInovasi::whereIn('users_id', $prodiUserIds)
            ->select('tahun_akademik')
            ->whereNotNull('tahun_akademik')
            ->where('tahun_akademik', '!=', '')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        // ===================== List Jenis Inovasi =====================
        $jenisList = ProdiInovasi::whereIn('users_id', $prodiUserIds)
            ->select('jenis_inovasi')
            ->whereNotNull('jenis_inovasi')
            ->where('jenis_inovasi', '!=', '')
            ->distinct()
            ->orderBy('jenis_inovasi', 'asc')
            ->pluck('jenis_inovasi');

        // ===================== AJAX =====================
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            if ($partial === 'inovasi') {
                return view('components.fakultas-inovasi.data-table', compact('inovasi'));
            }

            if (request()->has('inovasi_page') || request()->has('per_page')) {
                return view('components.fakultas-inovasi.data-table', compact('inovasi'));
            }
        }

        return view('pages.fakultas.fakultas-inovasi', compact(
            'prodi',
            'inovasi',
            'tahunList',
            'jenisList',
            'filterProdi',
            'filterTahun',
            'filterJenis'
        ));
    }
}