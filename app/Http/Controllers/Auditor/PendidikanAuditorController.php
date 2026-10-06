<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\ProdiBimbingan;
use App\Models\ProdiKurikulum;
use App\Models\ProdiPengajaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PendidikanAuditorController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | RESOLVE PRODI (auditor melihat data prodi dengan unit & sub_unit sama)
        |--------------------------------------------------------------------------
        */
        $prodi = User::where('role', 'prodi')
            ->where('unit', $user->unit)
            ->where('sub_unit', $user->sub_unit)
            ->first();

        // Kalau prodi tidak ditemukan, tampilkan halaman kosong
        if (!$prodi) {
            return view('pages.auditor.auditor-pendidikan', [
                'prodi'                  => null,
                'kurikulums'             => collect(),
                'pengajarans'            => collect(),
                'bimbingans'             => collect(),
                'tahunKurikulumList'     => collect(),
                'tahunPengajaranList'    => collect(),
                'semesterPengajaranList' => collect(),
                'tahunBimbinganList'     => collect(),
                'semesterBimbinganList'  => collect(),
            ]);
        }

        $allowedPerPage = [10, 25, 50, 100];

        /*
        |--------------------------------------------------------------------------
        | PAGINATION KURIKULUM
        |--------------------------------------------------------------------------
        */
        $perPageKurikulum     = request()->query('per_page', 10);
        $filterTahunKurikulum = request()->query('filter_tahun_kurikulum');

        $kurikulumQuery = ProdiKurikulum::where('users_id', $prodi->id)
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
        $perPagePengajaran        = request()->query('per_page_pengajaran', 10);
        $filterTahunPengajaran    = request()->query('filter_tahun_pengajaran');
        $filterSemesterPengajaran = request()->query('filter_semester_pengajaran');

        $pengajaranQuery = ProdiPengajaran::where('users_id', $prodi->id)
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
        $perPageBimbingan        = request()->query('per_page_bimbingan', 10);
        $filterTahunBimbingan    = request()->query('filter_tahun_bimbingan');
        $filterSemesterBimbingan = request()->query('filter_semester_bimbingan');

        $bimbinganQuery = ProdiBimbingan::where('users_id', $prodi->id)
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

        /*
        |--------------------------------------------------------------------------
        | LIST FILTER (Tahun & Semester)
        |--------------------------------------------------------------------------
        */
        $tahunKurikulumList = ProdiKurikulum::where('users_id', $prodi->id)
            ->select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        $tahunPengajaranList = ProdiPengajaran::where('users_id', $prodi->id)
            ->select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        $semesterPengajaranList = ProdiPengajaran::where('users_id', $prodi->id)
            ->select('semester')
            ->whereNotNull('semester')
            ->where('semester', '!=', '')
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester');

        $tahunBimbinganList = ProdiBimbingan::where('users_id', $prodi->id)
            ->select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        $semesterBimbinganList = ProdiBimbingan::where('users_id', $prodi->id)
            ->select('semester')
            ->whereNotNull('semester')
            ->where('semester', '!=', '')
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester');

        /*
        |--------------------------------------------------------------------------
        | AJAX (partial table only)
        |--------------------------------------------------------------------------
        */
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            // Prioritas: pakai marker dulu
            if ($partial === 'pengajaran') {
                return view(
                    'pages.auditor.partials-auditor-pendidikan.pengajaran.data-table',
                    compact('pengajarans')
                );
            }

            if ($partial === 'kurikulum') {
                return view(
                    'pages.auditor.partials-auditor-pendidikan.kurikulum.data-table',
                    compact('kurikulums')
                );
            }

            if ($partial === 'bimbingan') {
                return view(
                    'pages.auditor.partials-auditor-pendidikan.bimbingan.data-table',
                    compact('bimbingans')
                );
            }

            // Fallback lama (biar gak break kalau ada code lain yang masih pakai)
            if (request()->has('per_page_pengajaran') || request()->has('pengajaran_page')) {
                return view(
                    'pages.auditor.partials-auditor-pendidikan.pengajaran.data-table',
                    compact('pengajarans')
                );
            }

            if (request()->has('per_page_bimbingan') || request()->has('bimbingan_page')) {
                return view(
                    'pages.auditor.partials-auditor-pendidikan.bimbingan.data-table',
                    compact('bimbingans')
                );
            }

            return view(
                'pages.auditor.partials-auditor-pendidikan.kurikulum.data-table',
                compact('kurikulums')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FULL PAGE
        |--------------------------------------------------------------------------
        */
        return view('pages.auditor.auditor-pendidikan', compact(
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