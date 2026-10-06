<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiBimbingan;
use App\Models\ProdiKurikulum;
use App\Models\ProdiPengajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasPendidikanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allowedPerPage = [10, 25, 50, 100];

        // ============================================================
        // Daftar prodi di bawah fakultas ini
        // ============================================================
        $prodi = User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();

        $prodiUserIds = $prodi->pluck('id')->toArray();

        // ============================================================
        // Filter Prodi (dari request)
        // ============================================================
        $filterProdi = request()->query('filter_prodi');
        $prodiFilterIds = $filterProdi
            ? [$filterProdi]
            : $prodiUserIds;

        // ============================================================
        // PAGINATION KURIKULUM
        // ============================================================
        $perPageKurikulum       = request()->query('per_page', 10);
        $filterTahunKurikulum   = request()->query('filter_tahun_kurikulum');

        $kurikulumQuery = ProdiKurikulum::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahunKurikulum, function ($q) use ($filterTahunKurikulum) {
                $q->where('tahun_akademik', $filterTahunKurikulum);
            })
            ->orderBy('id', 'asc');

        if ($perPageKurikulum === 'all') {
            $kurikulums = $kurikulumQuery->get();
        } else {
            $perPageKurikulum = in_array((int) $perPageKurikulum, $allowedPerPage, true)
                ? (int) $perPageKurikulum : 10;

            $kurikulums = $kurikulumQuery
                ->paginate($perPageKurikulum, ['*'], 'kurikulum_page')
                ->withQueryString();
        }

        // ============================================================
        // PAGINATION PENGAJARAN
        // ============================================================
        $perPagePengajaran         = request()->query('per_page_pengajaran', 10);
        $filterTahunPengajaran     = request()->query('filter_tahun_pengajaran');
        $filterSemesterPengajaran  = request()->query('filter_semester_pengajaran');

        $pengajaranQuery = ProdiPengajaran::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahunPengajaran, function ($q) use ($filterTahunPengajaran) {
                $q->where('tahun_akademik', $filterTahunPengajaran);
            })
            ->when($filterSemesterPengajaran, function ($q) use ($filterSemesterPengajaran) {
                $q->where('semester', $filterSemesterPengajaran);
            })
            ->orderBy('id', 'asc');

        if ($perPagePengajaran === 'all') {
            $pengajarans = $pengajaranQuery->get();
        } else {
            $perPagePengajaran = in_array((int) $perPagePengajaran, $allowedPerPage, true)
                ? (int) $perPagePengajaran : 10;

            $pengajarans = $pengajaranQuery
                ->paginate($perPagePengajaran, ['*'], 'pengajaran_page')
                ->withQueryString();
        }

        // ============================================================
        // PAGINATION BIMBINGAN
        // ============================================================
        $perPageBimbingan          = request()->query('per_page_bimbingan', 10);
        $filterTahunBimbingan      = request()->query('filter_tahun_bimbingan');
        $filterSemesterBimbingan   = request()->query('filter_semester_bimbingan');

        $bimbinganQuery = ProdiBimbingan::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahunBimbingan, function ($q) use ($filterTahunBimbingan) {
                $q->where('tahun_akademik', $filterTahunBimbingan);
            })
            ->when($filterSemesterBimbingan, function ($q) use ($filterSemesterBimbingan) {
                $q->where('semester', $filterSemesterBimbingan);
            })
            ->orderBy('id', 'asc');

        if ($perPageBimbingan === 'all') {
            $bimbingans = $bimbinganQuery->get();
        } else {
            $perPageBimbingan = in_array((int) $perPageBimbingan, $allowedPerPage, true)
                ? (int) $perPageBimbingan : 10;

            $bimbingans = $bimbinganQuery
                ->paginate($perPageBimbingan, ['*'], 'bimbingan_page')
                ->withQueryString();
        }

        // ============================================================
        // LIST UNTUK FILTER DROPDOWN
        // ============================================================
        $tahunKurikulumList = ProdiKurikulum::whereIn('users_id', $prodiFilterIds)
            ->select('tahun_akademik')->distinct()
            ->orderBy('tahun_akademik', 'asc')->pluck('tahun_akademik');

        $tahunPengajaranList = ProdiPengajaran::whereIn('users_id', $prodiFilterIds)
            ->select('tahun_akademik')->distinct()
            ->orderBy('tahun_akademik', 'asc')->pluck('tahun_akademik');

        $semesterPengajaranList = ProdiPengajaran::whereIn('users_id', $prodiFilterIds)
            ->select('semester')->whereNotNull('semester')
            ->where('semester', '!=', '')->distinct()
            ->orderBy('semester', 'asc')->pluck('semester');

        $tahunBimbinganList = ProdiBimbingan::whereIn('users_id', $prodiFilterIds)
            ->select('tahun_akademik')->distinct()
            ->orderBy('tahun_akademik', 'asc')->pluck('tahun_akademik');

        $semesterBimbinganList = ProdiBimbingan::whereIn('users_id', $prodiFilterIds)
            ->select('semester')->whereNotNull('semester')
            ->where('semester', '!=', '')->distinct()
            ->orderBy('semester', 'asc')->pluck('semester');

        // ============================================================
        // AJAX
        // ============================================================
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            if ($partial === 'pengajaran') {
                return view('components.fakultas-pendidikan.prodi-pengajaran.data-table', compact('pengajarans'));
            }
            if ($partial === 'kurikulum') {
                return view('components.fakultas-pendidikan.prodi-kurikulum.data-table', compact('kurikulums'));
            }
            if ($partial === 'bimbingan') {
                return view('components.fakultas-pendidikan.prodi-bimbingan.data-table', compact('bimbingans'));
            }

            if (request()->has('per_page_pengajaran') || request()->has('pengajaran_page')) {
                return view('components.fakultas-pendidikan.prodi-pengajaran.data-table', compact('pengajarans'));
            }
            if (request()->has('per_page_bimbingan') || request()->has('bimbingan_page')) {
                return view('components.fakultas-pendidikan.prodi-bimbingan.data-table', compact('bimbingans'));
            }
            return view('components.fakultas-pendidikan.prodi-kurikulum.data-table', compact('kurikulums'));
        }

        // ============================================================
        // FULL PAGE
        // ============================================================
        return view('pages.fakultas.fakultas-pendidikan', compact(
            'prodi',
            'kurikulums',
            'pengajarans',
            'bimbingans',
            'tahunKurikulumList',
            'tahunPengajaranList',
            'semesterPengajaranList',
            'tahunBimbinganList',
            'semesterBimbinganList',
        ));
    }
}