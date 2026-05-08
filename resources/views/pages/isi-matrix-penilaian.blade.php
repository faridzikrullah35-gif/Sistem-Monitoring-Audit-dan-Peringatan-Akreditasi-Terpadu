@extends('layouts.app')

@section('title', 'Isi Matrix Penilaian | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Input Matrix Penilaian" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Input Matrix Penilaian</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Berikan nilai pada setiap kriteria audit berdasarkan data yang ditemukan
                </p>
            </div>

            <!-- Button Tambah Data -->
            <button
                onclick="openMatrixModal()"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors"
            >
                <!-- Icon Plus -->
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4"></path>
                </svg>

                Tambah Data
            </button>
        </div>

        <!-- Container Utama -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden shadow-sm">
            <div x-data="matrixFilter()">
            <!-- Filter Bar (Akan di-sticky nanti) -->
            <x-matrix-penilaian.filter-bar :kriterias="$kriterias" />

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700"></div>

            <!-- Tabel Matrix -->
            <div id="matrixTableContainer">
                <x-matrix-penilaian.matrix-table :matrixs="$matrixs" />
            </div>

            <x-matrix-penilaian.matrix-modal :kriterias="$kriterias" />

        </div>

    </div>

    @include('components.matrix-penilaian.modal.modal-tambah-indikator')

@endsection

