@extends('layouts.app')

@section('title', 'Data Auditor | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Data Auditor" />

    <div class="space-y-6">
        <!-- Header & Tombol Tambah -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Auditor</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola data tim auditor internal universitas</p>
            </div>
            <button onclick="openModal('create')" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Data Auditor
            </button>
        </div>

        <!-- Kirim variable $auditors sebagai props -->
        <div id="auditorTableContainer">
            <x-data-auditor.data-table :auditors="$auditors" />
        </div>
    </div>

    <!-- Komponen Modal Form (Dipanggil di luar container agar z-index nya aman) -->
    <x-data-auditor.form-modal />

@endsection