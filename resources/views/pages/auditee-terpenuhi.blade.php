{{-- resources/views/auditee-terpenuhi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Terpenuhi Auditee | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Terpenuhi Auditee" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-5 lg:mb-7">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Data Terpenuhi</h3>
            {{-- Tidak ada tombol tambah data untuk auditee --}}
        </div>

        <div x-data="filterTerpenuhiComponent()">
            {{-- Filter section dengan desain yang sama --}}
            <x-auditee-terpenuhi.filter-section :tahunAkademik="$tahunAkademik ?? []" />

            <div id="terpenuhiTableContainer">
                <x-auditee-terpenuhi.terpenuhi-table :terpenuhi="$terpenuhi" />
            </div>
        </div>
    </div>
@endsection