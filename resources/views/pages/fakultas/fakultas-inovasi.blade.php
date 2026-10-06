@extends('layouts.app')

@section('title', 'Inovasi Fakultas | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Inovasi Fakultas" />

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Inovasi
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data inovasi dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    {{-- Filter Section --}}
    <x-fakultas-inovasi.filter-section
        :inovasi="$inovasi"
        :tahunList="$tahunList"
        :jenisList="$jenisList"
        :prodi="$prodi"
        :filterProdi="$filterProdi"
        :filterTahun="$filterTahun"
        :filterJenis="$filterJenis"
    />

    {{-- Komponen Tabel Data Inovasi --}}
    <x-fakultas-inovasi.data-table :inovasi="$inovasi" />

</div>
@endsection