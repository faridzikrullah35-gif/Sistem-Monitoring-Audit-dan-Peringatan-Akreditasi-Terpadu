@extends('layouts.app')

@section('title', 'PKM | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Program Kreativitas Mahasiswa (PKM)" />

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Program Kreativitas Mahasiswa (PKM)
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Data dan informasi PKM pada program studi
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
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data PKM Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini menampilkan informasi yang berkaitan dengan
                    Program Kreativitas Mahasiswa (PKM) pada program studi,
                    meliputi nama dosen, judul PKM, lokasi mitra, tingkat,
                    sumber dana, keterlibatan mahasiswa, dan luaran.
                    Data bersifat hanya baca (view only).
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION: PKM --}}
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Data PKM</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data PKM program studi beserta dokumen pendukungnya
            </p>
        </div>

        @include('pages.auditor.partials-auditor-pkm.filter-section', [
            'pkm'         => $pkm,
            'tahunList'   => $tahunList,
            'tingkatList' => $tingkatList,
        ])

        @include('pages.auditor.partials-auditor-pkm.data-table', [
            'pkm' => $pkm,
        ])
    </div>

</div>
@endsection