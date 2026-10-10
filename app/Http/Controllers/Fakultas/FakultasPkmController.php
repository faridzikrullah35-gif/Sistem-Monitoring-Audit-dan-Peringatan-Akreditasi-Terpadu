<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiPKM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

class FakultasPkmController extends Controller
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

        // ===================== Filter Melibatkan Mahasiswa =====================
        $filterMahasiswa = request()->query('filter_melibatkan_mahasiswa');

        // ===================== Pagination =====================
        $perPage = request()->query('per_page', 10);

        $query = ProdiPKM::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, function ($q) use ($filterTahun) {
                $q->where('tahun_akademik', $filterTahun);
            })
            ->when($filterTingkat, function ($q) use ($filterTingkat) {
                $q->where('tingkat', $filterTingkat);
            })
            ->when($filterMahasiswa !== null && $filterMahasiswa !== '', function ($q) use ($filterMahasiswa) {
                $q->where('melibatkan_mahasiswa', filter_var($filterMahasiswa, FILTER_VALIDATE_BOOLEAN));
            })
            ->orderBy('id', 'asc');

        if ($perPage === 'all') {
            $pkm = $query->get();
        } else {
            $perPage = in_array((int) $perPage, $allowedPerPage, true)
                ? (int) $perPage : 10;

            $pkm = $query->paginate($perPage, ['*'], 'pkm_page')
                ->withQueryString();
        }

        // ===================== List Tahun =====================
        $tahunList = ProdiPKM::whereIn('users_id', $prodiUserIds)
            ->select('tahun_akademik')
            ->whereNotNull('tahun_akademik')
            ->where('tahun_akademik', '!=', '')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        // ===================== List Tingkat =====================
        $tingkatList = ['Internasional', 'Nasional', 'Lokal'];

        // ===================== AJAX =====================
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            if ($partial === 'pkm') {
                return view('components.fakultas-pkm.data-table', compact('pkm'));
            }

            if (request()->has('pkm_page') || request()->has('per_page')) {
                return view('components.fakultas-pkm.data-table', compact('pkm'));
            }
        }

        return view('pages.fakultas.fakultas-pkm', compact(
            'prodi',
            'pkm',
            'tahunList',
            'tingkatList',
            'filterProdi',
            'filterTahun',
            'filterTingkat',
            'filterMahasiswa'
        ));
    }

    /**
     * ==========================================================
     * PRINT DATA PKM (Fakultas) — dengan filter
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
        $filterProdi     = $request->query('filter_prodi');
        $filterTahun     = $request->query('filter_tahun_akademik');
        $filterTingkat   = $request->query('filter_tingkat');
        $filterMahasiswa = $request->query('filter_melibatkan_mahasiswa');

        $prodiFilterIds = $filterProdi ? [(int) $filterProdi] : $prodiUserIds;

        // ===================== Query =====================
        $query = ProdiPKM::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, fn($q) => $q->where('tahun_akademik', $filterTahun))
            ->when($filterTingkat, fn($q) => $q->where('tingkat', $filterTingkat))
            ->when($filterMahasiswa !== null && $filterMahasiswa !== '', function ($q) use ($filterMahasiswa) {
                $q->where('melibatkan_mahasiswa', filter_var($filterMahasiswa, FILTER_VALIDATE_BOOLEAN));
            })
            ->orderBy('id', 'asc');

        $pkm = $query->get();

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
        if ($filterMahasiswa !== null && $filterMahasiswa !== '') {
            $filterParts[] = "Melibatkan Mahasiswa: " . (filter_var($filterMahasiswa, FILTER_VALIDATE_BOOLEAN) ? 'Ya' : 'Tidak');
        }
        $filterInfo = !empty($filterParts) ? implode(' | ', $filterParts) : null;

        return view('print.fakultas.pkm', compact(
            'pkm',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaFakultas',
            'unit',
            'filterInfo',
        ));
    }
}