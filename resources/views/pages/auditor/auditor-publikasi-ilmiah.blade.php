@extends('layouts.app')

@section('title', 'Publikasi Ilmiah | SIMANTAP')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Publikasi Ilmiah" />

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Publikasi Ilmiah
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Data dan informasi publikasi ilmiah pada program studi
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
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data Publikasi Ilmiah Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini menampilkan informasi yang berkaitan dengan
                    publikasi ilmiah dosen pada program studi, meliputi
                    nama dosen, judul artikel, jenis publikasi, jurnal/prosiding,
                    ISSN, volume, SINTA/Scopus, dan penulis ke-.
                    Data bersifat hanya baca (view only).
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION: PUBLIKASI ILMIAH --}}
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Data Publikasi Ilmiah</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data publikasi ilmiah program studi beserta link artikelnya
            </p>
        </div>

        {{-- Filter Publikasi --}}
        @include('pages.auditor.partials-auditor-publikasi-ilmiah.filter-section', [
            'publikasi' => $publikasi,
            'tahunList' => $tahunList,
        ])

        {{-- Tabel Publikasi --}}
        @include('pages.auditor.partials-auditor-publikasi-ilmiah.data-table', [
            'publikasi' => $publikasi,
        ])
    </div>

</div>
@endsection