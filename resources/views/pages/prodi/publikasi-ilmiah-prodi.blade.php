@extends('layouts.app')

@section('title', 'Publikasi Ilmiah Prodi | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Publikasi Ilmiah Prodi" />

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Publikasi Ilmiah Prodi
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola data publikasi ilmiah untuk program studi
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button
                type="button"
                onclick="openModalFormPublikasi('create')"
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
                Tambah Publikasi
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <x-prodi-publikasi-ilmiah.filter-section :publikasi="$publikasi" />

    <x-prodi-publikasi-ilmiah.data-table :publikasi="$publikasi" />

    @include('components.prodi-publikasi-ilmiah.modal-form')

</div>
@endsection