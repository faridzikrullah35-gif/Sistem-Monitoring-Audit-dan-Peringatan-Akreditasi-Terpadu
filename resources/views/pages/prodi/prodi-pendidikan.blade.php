@extends('layouts.app')

@section('title', 'Pendidikan | SIMANTAP')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Pendidikan" />

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Pendidikan
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kelola data dan informasi pendidikan pada program studi
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
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 14l6.16-3.422A12.083 12.083 0 0118 15.5c0 1.933-2.686 3.5-6 3.5s-6-1.567-6-3.5c0-.815.3-1.572.84-2.222L12 14z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 9v6"
                    />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                    Data Pendidikan Program Studi
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                    Halaman ini digunakan untuk mengelola informasi yang berkaitan
                    dengan penyelenggaraan pendidikan pada program studi.
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION 1: KURIKULUM --}}
    <div class="space-y-4">

        {{-- Section Header --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Kurikulum
            </h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data kurikulum program studi beserta dokumen penetapannya
            </p>
        </div>

        {{-- Filter Kurikulum --}}
        <x-prodi-pendidikan.prodi-kurikulum.filter-section
            :kurikulums="$kurikulums"
            :tahunKurikulumList="$tahunKurikulumList"
        />

        {{-- Tabel Kurikulum --}}
        <x-prodi-pendidikan.prodi-kurikulum.data-table :kurikulums="$kurikulums" />

    </div>

    {{-- SECTION 2: PENGAJARAN --}}
    <div class="space-y-4">

        {{-- Section Header --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Pengajaran
            </h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data SK pengajaran program studi beserta penetapannya
            </p>
        </div>

        {{-- Filter Pengajaran --}}
        <x-prodi-pendidikan.prodi-pengajaran.filter-section
            :pengajarans="$pengajarans"
            :tahunPengajaranList="$tahunPengajaranList"
            :semesterPengajaranList="$semesterPengajaranList"
        />

        {{-- Tabel Pengajaran --}}
        <x-prodi-pendidikan.prodi-pengajaran.data-table :pengajarans="$pengajarans" />

    </div>

    {{-- SECTION 3: BIMBINGAN --}}
    <div class="space-y-4">

        {{-- Section Header --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Bimbingan
            </h2>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                Data bimbingan program studi beserta dokumen penetapannya
            </p>
        </div>

        {{-- Filter Bimbingan --}}
        <x-prodi-pendidikan.prodi-bimbingan.filter-section
            :bimbingans="$bimbingans"
            :tahunBimbinganList="$tahunBimbinganList"
            :semesterBimbinganList="$semesterBimbinganList"
        />

        {{-- Tabel Bimbingan --}}
        <x-prodi-pendidikan.prodi-bimbingan.data-table :bimbingans="$bimbingans" />

    </div>

</div>

<!-- MODAL -->
@include('components.prodi-pendidikan.prodi-kurikulum.modal-form')
@include('components.prodi-pendidikan.prodi-pengajaran.modal-form')
@include('components.prodi-pendidikan.prodi-bimbingan.modal-form')

@endsection