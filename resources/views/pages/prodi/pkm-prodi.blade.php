@extends('layouts.app')

@section('title', 'PKM Prodi | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Program Kreativitas Mahasiswa (PKM)" />

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Program Kreativitas Mahasiswa (PKM)
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola data Program Kreativitas Mahasiswa untuk program studi
            </p>
        </div>

        <div class="flex items-center gap-3">
            {{-- Tombol Print --}}
            <a
                href="#"
                id="btnPrintPkm"
                onclick="return handlePrintPkm(event)"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-white hover:bg-gray-50
                    dark:bg-gray-800 dark:hover:bg-gray-700
                    border border-gray-300 dark:border-gray-600
                    text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-gray-400
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800"
            >
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print
            </a>

            {{-- Tombol Tambah PKM --}}
            <button
                type="button"
                onclick="openModalFormPKM('create')"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-blue-600 hover:bg-blue-700
                    dark:bg-blue-500 dark:hover:bg-blue-600
                    text-white text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:ring-offset-2 dark:focus:ring-offset-gray-800"
            >
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah PKM
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <x-prodi-pkm.filter-section :pkm="$pkm" />

    <x-prodi-pkm.data-table :pkm="$pkm" />

    @include('components.prodi-pkm.modal-form')

</div>
@endsection