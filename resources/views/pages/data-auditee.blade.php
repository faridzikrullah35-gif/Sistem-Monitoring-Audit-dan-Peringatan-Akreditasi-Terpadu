{{-- resources/views/pages/data-auditee.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Auditee | SIMANTAP')

@section('content')

<div
    x-data="{
        selectedTahun: '',

        visibleRows: @js(
            $auditees->pluck('tahun_akademik_id')
        ),
    }"
    class="flex flex-col min-h-screen"   {{-- 1. Bikin container fleksibel & full viewport --}}
>

    <x-common.page-breadcrumb pageTitle="Data Auditee" />

    {{-- 2. Area konten utama: flex-1 agar mendorong footer ke bawah --}}
    <div class="flex-1 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        {{-- HEADER --}}
        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Daftar Auditee
            </h3>

            {{-- FILTER COMPONENT --}}
            <x-page-data-auditee.filter-tahun-akademik
                :tahunAkademiks="$tahunAkademiks"
            />

        </div>

        {{-- TABLE --}}
        <x-page-data-auditee.auditee-table
            :auditees="$auditees"
        />

    </div>

</div>

@endsection