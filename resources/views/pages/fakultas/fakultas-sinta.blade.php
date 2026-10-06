@extends('layouts.app')

@section('title', 'Dosen Terdata Sinta Fakultas | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Dosen Terdata Sinta Fakultas" />

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Dosen Terdata Sinta
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Data dosen terdata Sinta dari program studi di bawah fakultas (read-only)
            </p>
        </div>
    </div>

    {{-- Filter Section --}}
    <x-fakultas-sinta.filter-section
        :sintas="$sintas"
        :tahunList="$tahunList"
        :prodi="$prodi"
        :filterProdi="$filterProdi"
        :filterTahun="$filterTahun"
    />

    {{-- Komponen Tabel Data SINTA --}}
    <x-fakultas-sinta.data-table :sintas="$sintas" />

</div>
@endsection