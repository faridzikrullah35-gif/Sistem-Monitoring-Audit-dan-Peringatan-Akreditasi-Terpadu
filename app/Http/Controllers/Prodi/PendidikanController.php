<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\ProdiBimbingan;
use App\Models\ProdiKurikulum;
use App\Models\ProdiPengajaran;
use Illuminate\Support\Facades\Auth;

class PendidikanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allowedPerPage = [10, 25, 50, 100];

        /*
        |--------------------------------------------------------------------------
        | PAGINATION KURIKULUM
        |--------------------------------------------------------------------------
        */
        $perPageKurikulum = request()->query('per_page', 10);
        $filterTahunKurikulum = request()->query('filter_tahun_kurikulum');

        $kurikulumQuery = ProdiKurikulum::where('users_id', $user->id)
            ->when($filterTahunKurikulum, function ($query) use ($filterTahunKurikulum) {
                $query->where('tahun_akademik', $filterTahunKurikulum);
            })
            ->orderBy('id', 'asc');

        if ($perPageKurikulum === 'all') {
            $kurikulums = $kurikulumQuery->get();
        } else {
            $perPageKurikulum = in_array(
                (int) $perPageKurikulum,
                $allowedPerPage,
                true
            )
                ? (int) $perPageKurikulum
                : 10;

            $kurikulums = $kurikulumQuery
                ->paginate(
                    $perPageKurikulum,
                    ['*'],
                    'kurikulum_page'
                )
                ->withQueryString();
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION PENGAJARAN
        |--------------------------------------------------------------------------
        */
        $perPagePengajaran = request()->query('per_page_pengajaran', 10);
        $filterTahunPengajaran = request()->query('filter_tahun_pengajaran');
        $filterSemesterPengajaran = request()->query('filter_semester_pengajaran');

        $pengajaranQuery = ProdiPengajaran::where('users_id', $user->id)
            ->when($filterTahunPengajaran, function ($query) use ($filterTahunPengajaran) {
                $query->where('tahun_akademik', $filterTahunPengajaran);
            })
            ->when($filterSemesterPengajaran, function ($query) use ($filterSemesterPengajaran) {
                $query->where('semester', $filterSemesterPengajaran);
            })
            ->orderBy('id', 'asc');

        if ($perPagePengajaran === 'all') {
            $pengajarans = $pengajaranQuery->get();
        } else {
            $perPagePengajaran = in_array(
                (int) $perPagePengajaran,
                $allowedPerPage,
                true
            )
                ? (int) $perPagePengajaran
                : 10;

            $pengajarans = $pengajaranQuery
                ->paginate(
                    $perPagePengajaran,
                    ['*'],
                    'pengajaran_page'
                )
                ->withQueryString();
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION BIMBINGAN
        |--------------------------------------------------------------------------
        */
        $perPageBimbingan = request()->query('per_page_bimbingan', 10);
        $filterTahunBimbingan = request()->query('filter_tahun_bimbingan');
        $filterSemesterBimbingan = request()->query('filter_semester_bimbingan');

        $bimbinganQuery = ProdiBimbingan::where('users_id', $user->id)
            ->when($filterTahunBimbingan, function ($query) use ($filterTahunBimbingan) {
                $query->where('tahun_akademik', $filterTahunBimbingan);
            })
            ->when($filterSemesterBimbingan, function ($query) use ($filterSemesterBimbingan) {
                $query->where('semester', $filterSemesterBimbingan);
            })
            ->orderBy('id', 'asc');

        if ($perPageBimbingan === 'all') {
            $bimbingans = $bimbinganQuery->get();
        } else {
            $perPageBimbingan = in_array(
                (int) $perPageBimbingan,
                $allowedPerPage,
                true
            )
                ? (int) $perPageBimbingan
                : 10;

            $bimbingans = $bimbinganQuery
                ->paginate(
                    $perPageBimbingan,
                    ['*'],
                    'bimbingan_page'
                )
                ->withQueryString();
        }

        $tahunKurikulumList = ProdiKurikulum::where('users_id', $user->id)
            ->select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        $tahunPengajaranList = ProdiPengajaran::where('users_id', $user->id)
            ->select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        $semesterPengajaranList = ProdiPengajaran::where('users_id', $user->id)
            ->select('semester')
            ->whereNotNull('semester')
            ->where('semester', '!=', '')
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester');

        $tahunBimbinganList = ProdiBimbingan::where('users_id', $user->id)
            ->select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        $semesterBimbinganList = ProdiBimbingan::where('users_id', $user->id)
            ->select('semester')
            ->whereNotNull('semester')
            ->where('semester', '!=', '')
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester');

        /*
        |--------------------------------------------------------------------------
        | AJAX
        |--------------------------------------------------------------------------
        */
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            // Prioritas: pakai marker dulu
            if ($partial === 'pengajaran') {
                return view('components.prodi-pendidikan.prodi-pengajaran.data-table', compact('pengajarans'));
            }

            if ($partial === 'kurikulum') {
                return view('components.prodi-pendidikan.prodi-kurikulum.data-table', compact('kurikulums'));
            }

            if ($partial === 'bimbingan') {
                return view('components.prodi-pendidikan.prodi-bimbingan.data-table', compact('bimbingans'));
            }

            // Fallback lama (biar gak break kalau ada code lain yang masih pakai)
            if (request()->has('per_page_pengajaran') || request()->has('pengajaran_page')) {
                return view('components.prodi-pendidikan.prodi-pengajaran.data-table', compact('pengajarans'));
            }

            if (request()->has('per_page_bimbingan') || request()->has('bimbingan_page')) {
                return view('components.prodi-pendidikan.prodi-bimbingan.data-table', compact('bimbingans'));
            }

            return view('components.prodi-pendidikan.prodi-kurikulum.data-table', compact('kurikulums'));
        }

        /*
        |--------------------------------------------------------------------------
        | FULL PAGE
        |--------------------------------------------------------------------------
        */
        return view('pages.prodi.prodi-pendidikan', compact(
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