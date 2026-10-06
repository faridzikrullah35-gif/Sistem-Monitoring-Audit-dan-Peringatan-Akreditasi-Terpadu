@extends('layouts.app')

@section('title', 'Setting Hak Akses Fakultas | SIMANTAP')

@section('content')

<div class="space-y-8">
    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Setting Hak Akses Fakultas" />

    {{-- Card Utama --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        {{-- Header with Button Add --}}
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    Manajemen Hak Akses Fakultas
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Kelola hak akses untuk user dengan role fakultas
                </p>
            </div>
            {{-- Button Trigger Modal --}}
            <button type="button" 
                    onclick="openModal()"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Akses
            </button>
        </div>

        {{-- Table --}}
        <div>
            <x-admin.setting-hak-akses-fakultas-table :akses="$akses" />
        </div>
    </div>
</div>

{{-- Modal Create --}}
<x-admin.modal.setting-hak-akses-fakultas-modal :users="$users ?? []" :daftarFakultas="$daftarFakultas ?? []" />

@endsection