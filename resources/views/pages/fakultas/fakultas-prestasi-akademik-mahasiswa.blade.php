@extends('layouts.app')

@section('title', 'Prestasi Akademik Mahasiswa Fakultas | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Prestasi Akademik Mahasiswa Fakultas" />

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Prestasi Akademik Mahasiswa
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data prestasi akademik mahasiswa dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    {{-- Filter Section --}}
    <x-fakultas-prestasi-akademik-mahasiswa.filter-section
        :prestasi="$prestasi"
        :tahunList="$tahunList"
        :tingkatList="$tingkatList"
        :waktuList="$waktuList"
        :prodi="$prodi"
        :filterProdi="$filterProdi"
        :filterTahun="$filterTahun"
        :filterTingkat="$filterTingkat"
        :filterWaktu="$filterWaktu"
    />

    {{-- Komponen Tabel Data Prestasi Akademik Mahasiswa --}}
    <x-fakultas-prestasi-akademik-mahasiswa.data-table :prestasi="$prestasi" />

</div>
@endsection