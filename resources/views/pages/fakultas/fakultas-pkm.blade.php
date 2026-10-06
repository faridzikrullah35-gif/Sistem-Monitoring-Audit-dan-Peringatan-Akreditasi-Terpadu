@extends('layouts.app')

@section('title', 'PKM Fakultas | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="PKM Fakultas" />

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                PKM (Program Kreativitas Mahasiswa)
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data PKM dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    {{-- Filter Section --}}
    <x-fakultas-pkm.filter-section
        :pkm="$pkm"
        :tahunList="$tahunList"
        :tingkatList="$tingkatList"
        :prodi="$prodi"
        :filterProdi="$filterProdi"
        :filterTahun="$filterTahun"
        :filterTingkat="$filterTingkat"
        :filterMahasiswa="$filterMahasiswa"
    />

    {{-- Komponen Tabel Data PKM --}}
    <x-fakultas-pkm.data-table :pkm="$pkm" />

</div>
@endsection