<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\ProdiSinta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasSintaController extends Controller
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

        // ===================== Pagination =====================
        $perPage = request()->query('per_page', 10);

        $query = ProdiSinta::with('user')
            ->whereIn('users_id', $prodiFilterIds)
            ->when($filterTahun, function ($q) use ($filterTahun) {
                $q->where('tahun_akademik', $filterTahun);
            })
            ->orderBy('id', 'asc');

        if ($perPage === 'all') {
            $sintas = $query->get();
        } else {
            $perPage = in_array((int) $perPage, $allowedPerPage, true)
                ? (int) $perPage : 10;

            $sintas = $query->paginate($perPage, ['*'], 'sinta_page')
                ->withQueryString();
        }

        // ===================== List Tahun untuk Dropdown =====================
        $tahunList = ProdiSinta::whereIn('users_id', $prodiUserIds)
            ->select('tahun_akademik')
            ->whereNotNull('tahun_akademik')
            ->where('tahun_akademik', '!=', '')
            ->distinct()
            ->orderBy('tahun_akademik', 'asc')
            ->pluck('tahun_akademik');

        // ===================== AJAX =====================
        if (request()->ajax()) {
            $partial = request()->query('_partial');

            if ($partial === 'sinta') {
                return view('components.fakultas-sinta.data-table', compact('sintas'));
            }

            // Fallback
            if (request()->has('sinta_page') || request()->has('per_page')) {
                return view('components.fakultas-sinta.data-table', compact('sintas'));
            }
        }

        // ===================== Full Page =====================
        return view('pages.fakultas.fakultas-sinta', compact(
            'prodi',
            'sintas',
            'tahunList',
            'filterProdi',
            'filterTahun'
        ));
    }
}