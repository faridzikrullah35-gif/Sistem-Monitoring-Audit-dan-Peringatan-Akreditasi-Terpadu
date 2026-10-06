<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiPublikasiIlmiah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasPublikasiIlmiahController extends Controller
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

        // ===================== Filter Jenis Publikasi =====================
        $filterJenis = request()->query('filter_jenis_publikasi');

        // ===================== Pagination =====================
        $perPage = request()->query('per_page', 10);

        $query = ProdiPublikasiIlmiah::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, function ($q) use ($filterTahun) {
                $q->where('tahun_akademik', $filterTahun);
            })
            ->when($filterJenis, function ($q) use ($filterJenis) {
                $q->where('jenis_publikasi', $filterJenis);
            })
            ->orderBy('id', 'asc');

        if ($perPage === 'all') {
            $publikasi = $query->get();
        } else {
            $perPage = in_array((int) $perPage, $allowedPerPage, true)
                ? (int) $perPage : 10;

            $publikasi = $query->paginate($perPage, ['*'], 'publikasi_page')
                ->withQueryString();
        }

        // ===================== List Tahun untuk Dropdown =====================
        $tahunList = ProdiPublikasiIlmiah::whereIn('users_id', $prodiUserIds)
            ->select('tahun_akademik')
            ->whereNotNull('tahun_akademik')
            ->where('tahun_akademik', '!=', '')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        // ===================== List Jenis Publikasi untuk Dropdown =====================
        $jenisList = ProdiPublikasiIlmiah::whereIn('users_id', $prodiUserIds)
            ->select('jenis_publikasi')
            ->whereNotNull('jenis_publikasi')
            ->where('jenis_publikasi', '!=', '')
            ->distinct()
            ->orderBy('jenis_publikasi', 'asc')
            ->pluck('jenis_publikasi');

        // ===================== AJAX =====================
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            if ($partial === 'publikasi') {
                return view('components.fakultas-publikasi-ilmiah.data-table', compact('publikasi'));
            }

            if (request()->has('publikasi_page') || request()->has('per_page')) {
                return view('components.fakultas-publikasi-ilmiah.data-table', compact('publikasi'));
            }
        }

        return view('pages.fakultas.fakultas-publikasi-ilmiah', compact(
            'prodi',
            'publikasi',
            'tahunList',
            'jenisList',
            'filterProdi',
            'filterTahun',
            'filterJenis'
        ));
    }
}