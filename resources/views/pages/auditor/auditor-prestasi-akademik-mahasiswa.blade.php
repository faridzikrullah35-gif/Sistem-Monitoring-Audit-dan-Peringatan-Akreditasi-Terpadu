@extends('layouts.app')

@section('title', 'Prestasi Akademik Mahasiswa | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Prestasi Akademik Mahasiswa" />

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Prestasi Akademik Mahasiswa
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Data dan informasi prestasi akademik mahasiswa pada program studi
                {{ $prodi->name ?? '' }}
            </p>
        </div>
    </div>

    {{-- Informasi --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6
                dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center
                        rounded-xl bg-blue-50 text-blue-600
                        dark:bg-blue-500/10 dark:text-blue-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data Prestasi Akademik Mahasiswa Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini menampilkan informasi yang berkaitan dengan
                    prestasi akademik mahasiswa pada program studi, meliputi
                    nama kegiatan, waktu perolehan, tingkat, prestasi yang dicapai,
                    dan bukti pendukung.
                    Data bersifat hanya baca (view only).
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION: PRESTASI --}}
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Data Prestasi</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data prestasi akademik mahasiswa program studi beserta link buktinya
            </p>
        </div>

        @include('pages.auditor.partials-auditor-prestasi-akademik-mahasiswa.filter-section', [
            'prestasi'    => $prestasi,
            'tahunList'   => $tahunList,
            'tingkatList' => $tingkatList,
        ])

        @include('pages.auditor.partials-auditor-prestasi-akademik-mahasiswa.data-table', [
            'prestasi' => $prestasi,
        ])
    </div>

</div>
@endsection