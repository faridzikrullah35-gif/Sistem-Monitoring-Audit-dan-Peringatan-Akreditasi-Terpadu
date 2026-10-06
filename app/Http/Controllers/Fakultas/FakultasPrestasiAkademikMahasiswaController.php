<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiPrestasiAkademikMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasPrestasiAkademikMahasiswaController extends Controller
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

        // ===================== Filter Waktu Perolehan =====================
        $filterWaktu = request()->query('filter_waktu_perolehan');

        // ===================== Pagination =====================
        $perPage = request()->query('per_page', 10);

        $query = ProdiPrestasiAkademikMahasiswa::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, function ($q) use ($filterTahun) {
                $q->where('tahun_akademik', $filterTahun);
            })
            ->when($filterTingkat, function ($q) use ($filterTingkat) {
                $q->where('tingkat', $filterTingkat);
            })
            ->when($filterWaktu, function ($q) use ($filterWaktu) {
                $q->where('waktu_perolehan', $filterWaktu);
            })
            ->orderBy('id', 'asc');

        if ($perPage === 'all') {
            $prestasi = $query->get();
        } else {
            $perPage = in_array((int) $perPage, $allowedPerPage, true)
                ? (int) $perPage : 10;

            $prestasi = $query->paginate($perPage, ['*'], 'prestasi_page')
                ->withQueryString();
        }

        // ===================== List Tahun =====================
        $tahunList = ProdiPrestasiAkademikMahasiswa::whereIn('users_id', $prodiUserIds)
            ->select('tahun_akademik')
            ->whereNotNull('tahun_akademik')
            ->where('tahun_akademik', '!=', '')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        // ===================== List Tingkat =====================
        $tingkatList = ['Lokal/Wilayah', 'Nasional', 'Internasional'];

        // ===================== List Waktu Perolehan =====================
        $waktuList = ProdiPrestasiAkademikMahasiswa::whereIn('users_id', $prodiUserIds)
            ->select('waktu_perolehan')
            ->whereNotNull('waktu_perolehan')
            ->distinct()
            ->orderBy('waktu_perolehan', 'desc')
            ->pluck('waktu_perolehan');

        // ===================== AJAX =====================
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            if ($partial === 'prestasi') {
                return view('components.fakultas-prestasi-akademik-mahasiswa.data-table', compact('prestasi'));
            }

            if (request()->has('prestasi_page') || request()->has('per_page')) {
                return view('components.fakultas-prestasi-akademik-mahasiswa.data-table', compact('prestasi'));
            }
        }

        return view('pages.fakultas.fakultas-prestasi-akademik-mahasiswa', compact(
            'prodi',
            'prestasi',
            'tahunList',
            'tingkatList',
            'waktuList',
            'filterProdi',
            'filterTahun',
            'filterTingkat',
            'filterWaktu'
        ));
    }
}