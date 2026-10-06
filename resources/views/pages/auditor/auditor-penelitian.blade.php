@extends('layouts.app')

@section('title', 'Penelitian | SIMANTAP')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Penelitian" />

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Penelitian
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Data dan informasi penelitian pada program studi
                {{ $prodi->name ?? '' }}
            </p>
        </div>
    </div>

    {{-- Informasi --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6
                dark:border-gray-700 dark:bg-gray-800">

        <div class="flex items-start gap-4">

            {{-- Icon --}}
            <div class="flex h-12 w-12 shrink-0 items-center justify-center
                        rounded-xl bg-blue-50 text-blue-600
                        dark:bg-blue-500/10 dark:text-blue-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data Penelitian Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini menampilkan informasi yang berkaitan dengan
                    kegiatan penelitian dosen pada program studi, meliputi
                    ketua/anggota, judul penelitian, lembaga mitra, tingkat,
                    skema, sumber dana, luaran, dan bukti pendukung.
                    Data bersifat hanya baca (view only).
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION: PENELITIAN --}}
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Data Penelitian</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data penelitian program studi beserta dokumen pendukungnya
            </p>
        </div>

        {{-- Filter Penelitian --}}
        @include('pages.auditor.partials-auditor-penelitian.filter-section', [
            'penelitian' => $penelitian,
            'tahunList'  => $tahunList,
        ])

        {{-- Tabel Penelitian --}}
        @include('pages.auditor.partials-auditor-penelitian.data-table', [
            'penelitian' => $penelitian,
        ])
    </div>

</div>
@endsection