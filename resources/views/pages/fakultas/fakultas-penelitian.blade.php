@extends('layouts.app')

@section('title', 'Penelitian Fakultas | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Penelitian Fakultas" />

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Penelitian
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data penelitian dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    {{-- Filter Section --}}
    <x-fakultas-penelitian.filter-section
        :penelitian="$penelitian"
        :tahunList="$tahunList"
        :tingkatList="$tingkatList"
        :prodi="$prodi"
        :filterProdi="$filterProdi"
        :filterTahun="$filterTahun"
        :filterTingkat="$filterTingkat"
    />

    {{-- Komponen Tabel Data Penelitian --}}
    <x-fakultas-penelitian.data-table :penelitian="$penelitian" />

</div>
@endsection