@extends('layouts.app')

@section('title', 'Profile PD-DIKTI Fakultas | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Profile PD-DIKTI Fakultas" />

    <div class="space-y-6">
        {{-- Header Card --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">DTPS</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data berdasarkan PD-DIKTI terbaru</p>
                </div>
            </div>
        </div>

        {{-- Header halaman --}}
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white/90">
            Profile PD Dikti Fakultas
        </h1>
    </div>

        {{-- Tabel Mahasiswa --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="mb-4 flex items-center justify-end">
                <a href="#"
                id="btnPrintPdDiktiMahasiswa"
                onclick="return handlePrintPdDiktiMahasiswa(event)"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-white hover:bg-gray-50
                    dark:bg-gray-800 dark:hover:bg-gray-700
                    border border-gray-300 dark:border-gray-600
                    text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-gray-400
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Mahasiswa
                </a>
            </div>

            <x-fakultas-profile-pd-dikti.table-data-pd-dikti
                :mahasiswaFakultas="$mahasiswaFakultas"
                :mahasiswaProdi="$mahasiswaProdi"
                :prodi="$prodi"
            />
        </div>

        {{-- Tabel Rasio --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <x-fakultas-profile-pd-dikti.table-data-rasio
                :rasioFakultas="$rasioFakultas"
                :rasioProdi="$rasioProdi"
                :prodi="$prodi"
            />
        </div>

        {{-- Tabel Lulusan --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="mb-4 flex items-center justify-end">
                <a href="#"
                id="btnPrintPdDiktiLulusan"
                onclick="return handlePrintPdDiktiLulusan(event)"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-white hover:bg-gray-50
                    dark:bg-gray-800 dark:hover:bg-gray-700
                    border border-gray-300 dark:border-gray-600
                    text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-gray-400
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Lulusan
                </a>
            </div>

            <x-fakultas-profile-pd-dikti.table-data-lulusan
                :lulusanFakultas="$lulusanFakultas"
                :lulusanProdi="$lulusanProdi"
                :prodi="$prodi"
            />
        </div>
    </div>

    {{-- Modal Tambah/Ubah Mahasiswa --}}
    @include('components.fakultas-profile-pd-dikti.modal.mahasiswa-modal')

    {{-- Modal Tambah/Ubah Rasio --}}
    @include('components.fakultas-profile-pd-dikti.modal.rasio-modal')

    {{-- Modal Tambah/Ubah Lulusan --}}
    @include('components.fakultas-profile-pd-dikti.modal.lulusan-modal')
@endsection