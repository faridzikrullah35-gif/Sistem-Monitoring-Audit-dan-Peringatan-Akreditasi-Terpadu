<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiPrestasiAkademikMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SettingHeaderCetak;
use Carbon\Carbon;

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

    /**
     * ==========================================================
     * PRINT DATA PRESTASI AKADEMIK MAHASISWA (Fakultas) — dengan filter
     * ==========================================================
     */
    public function print(Request $request)
    {
        $user = Auth::user();
        if (!$user) abort(401, 'Anda harus login terlebih dahulu.');

        $prodi = User::with('profilProdi')
            ->where('role', 'prodi')
            ->where('unit', $user->unit)
            ->orderBy('sub_unit')
            ->get();

        $prodiUserIds = $prodi->pluck('id')->toArray();

        // Filter
        $filterProdi   = $request->query('filter_prodi');
        $filterTahun   = $request->query('filter_tahun_akademik');
        $filterTingkat = $request->query('filter_tingkat');
        $filterWaktu   = $request->query('filter_waktu_perolehan');

        $prodiFilterIds = $filterProdi ? [(int) $filterProdi] : $prodiUserIds;

        $prestasi = ProdiPrestasiAkademikMahasiswa::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, fn($q) => $q->where('tahun_akademik', $filterTahun))
            ->when($filterTingkat, fn($q) => $q->where('tingkat', $filterTingkat))
            ->when($filterWaktu, fn($q) => $q->where('waktu_perolehan', $filterWaktu))
            ->orderBy('id', 'asc')
            ->get();

        // Header Cetak
        $headerCetak = SettingHeaderCetak::latest('id')->first();
        $headerNoDokumen     = $headerCetak?->no_dokumen ?? '-';
        $headerTanggalTerbit = $headerCetak?->tanggal_terbit
            ? Carbon::parse($headerCetak->tanggal_terbit)->format('d-m-Y') : '-';
        $headerNoRevisi      = $headerCetak?->no_revisi ?? '-';

        // Info Fakultas
        $namaFakultas = $user->name ?? '-';
        $unit         = $user->unit ?? '-';

        // Info Filter
        $filterParts = [];
        if ($filterProdi) {
            $namaProdi = $prodi->firstWhere('id', (int) $filterProdi);
            $filterParts[] = "Prodi: " . ($namaProdi->sub_unit ?? $namaProdi->name ?? '-');
        }
        if ($filterTahun)   $filterParts[] = "Tahun Akademik: {$filterTahun}";
        if ($filterTingkat) $filterParts[] = "Tingkat: {$filterTingkat}";
        if ($filterWaktu)   $filterParts[] = "Waktu Perolehan: {$filterWaktu}";
        $filterInfo = !empty($filterParts) ? implode(' | ', $filterParts) : null;

        return view('print.fakultas.prestasi-akademik-mahasiswa', compact(
            'prestasi',
            'headerNoDokumen',
            'headerTanggalTerbit',
            'headerNoRevisi',
            'namaFakultas',
            'unit',
            'filterInfo',
        ));
    }
}