@extends('layouts.app')

@section('title', 'Pertanyaan AMI Prodi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Daftar Pertanyaan AMI Prodi" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Pertanyaan AMI Prodi</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola daftar pertanyaan AMI Program Studi audit mutu internal</p>
            </div>
            <button onclick="openModal('create')" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Data Baru
            </button>
        </div>

        <!-- Container Utama -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden shadow-sm">
            
            <!-- Filter Bar -->
            <x-pertanyaan-ami-prodi.filter-bar 
                :kriteria="$kriteria"
                :tahunAkademik="$tahunAkademik"
            />

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700"></div>

            <!-- List Pertanyaan -->
            <div 
                id="pertanyaanTableContainer"
                class="p-5 lg:p-6"
            >
                <x-pertanyaan-ami-prodi.question-list 
                    :dataPertanyaan="$dataPertanyaan" 
                />
            </div>
            
        </div>
    </div>

    <!-- Modal Form -->
    <x-pertanyaan-ami-prodi.form-modal 
        :kriteria="$kriteria"
        :tahunAkademik="$tahunAkademik"
    />

@endsection