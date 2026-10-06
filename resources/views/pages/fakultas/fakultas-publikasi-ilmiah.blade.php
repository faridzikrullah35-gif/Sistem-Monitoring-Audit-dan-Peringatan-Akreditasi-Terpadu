@extends('layouts.app')

@section('title', 'Publikasi Ilmiah Fakultas | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Publikasi Ilmiah Fakultas" />

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Publikasi Ilmiah
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data publikasi ilmiah dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    {{-- Filter Section --}}
    <x-fakultas-publikasi-ilmiah.filter-section
        :publikasi="$publikasi"
        :tahunList="$tahunList"
        :jenisList="$jenisList"
        :prodi="$prodi"
        :filterProdi="$filterProdi"
        :filterTahun="$filterTahun"
        :filterJenis="$filterJenis"
    />

    {{-- Komponen Tabel Data Publikasi Ilmiah --}}
    <x-fakultas-publikasi-ilmiah.data-table :publikasi="$publikasi" />

</div>
@endsection