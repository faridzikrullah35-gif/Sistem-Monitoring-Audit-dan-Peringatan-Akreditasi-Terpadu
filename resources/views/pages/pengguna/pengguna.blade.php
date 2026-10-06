@extends('layouts.app')

@section('title', 'Manajemen Pengguna | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Manajemen Pengguna" />

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Manajemen Pengguna
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola akun Admin, Auditor, dan Auditee
            </p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Kelola Role -->
            <a href="{{ route('kelola-roles.index') }}"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-indigo-600 hover:bg-indigo-700
                    dark:bg-indigo-500 dark:hover:bg-indigo-600
                    text-white text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                    dark:focus:ring-offset-gray-800">

                <svg class="w-5 h-5 mr-2 -ml-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0
                        a1.724 1.724 0 002.573 1.066
                        c1.543-.94 3.31.826 2.37 2.37
                        a1.724 1.724 0 001.065 2.572
                        c1.756.426 1.756 2.924 0 3.35
                        a1.724 1.724 0 00-1.066 2.573
                        c.94 1.543-.826 3.31-2.37 2.37
                        a1.724 1.724 0 00-2.572 1.065
                        c-.426 1.756-2.924 1.756-3.35 0
                        a1.724 1.724 0 00-2.573-1.066
                        c-1.543.94-3.31-.826-2.37-2.37
                        a1.724 1.724 0 00-1.065-2.572
                        c-1.756-.426-1.756-2.924 0-3.35
                        a1.724 1.724 0 001.066-2.573
                        c-.94-1.543.826-3.31 2.37-2.37
                        a1.724 1.724 0 002.572-1.065z" />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

                Kelola Role
            </a>

            <!-- Import User Excel -->
            <button type="button"
                onclick="openModalExcel('import')"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                    bg-emerald-600 hover:bg-emerald-700
                    dark:bg-emerald-500 dark:hover:bg-emerald-600
                    text-white text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2
                    dark:focus:ring-offset-gray-800">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M8 12l4 4m0 0l4-4m-4 4V4" />
                </svg>

                Import User Excel
            </button>

            <!-- Tambah Pengguna -->
            <button type="button"
                onclick="openModal('create')"
                class="inline-flex items-center justify-center px-4 py-2.5
                    bg-blue-600 hover:bg-blue-700
                    text-white text-sm font-medium rounded-lg
                    transition-colors
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                    dark:focus:ring-offset-gray-800">

                <svg class="w-5 h-5 mr-2 -ml-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>

                Tambah Pengguna
            </button>
        </div>
    </div>

    <!-- Komponen Pencarian & Filter -->
    <x-user.search-filter
        :roles="$roles"
        :units="$units"
        :subUnits="$subUnits"
    />

    <!-- Komponen Tabel Data -->
    <x-user.data-table :users="$users" />

    <!-- Komponen Modal Form -->
    <x-user.form-modal :roles="$roles" />

    <x-user.import-modal />
</div>
@endsection
