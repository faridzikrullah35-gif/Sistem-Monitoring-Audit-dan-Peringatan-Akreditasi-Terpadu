@extends('layouts.app')

@section('title', 'SINTA | SIMANTAP')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="SINTA" />

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                SINTA
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Data dan informasi SINTA pada program studi
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
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data SINTA Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini menampilkan informasi yang berkaitan dengan
                    Science and Technology Index (SINTA) pada program studi.
                    Data bersifat hanya baca (view only).
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION: SINTA --}}
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Data SINTA</h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data SINTA program studi beserta skor dan indeksnya
            </p>
        </div>

        {{-- Filter SINTA --}}
        @include('pages.auditor.partials-auditor-sinta.filter-section', [
            'sintas'    => $sintas,
            'tahunList' => $tahunList,
        ])

        {{-- Tabel SINTA --}}
        @include('pages.auditor.partials-auditor-sinta.data-table', [
            'sintas' => $sintas,
        ])
    </div>

</div>
@endsection