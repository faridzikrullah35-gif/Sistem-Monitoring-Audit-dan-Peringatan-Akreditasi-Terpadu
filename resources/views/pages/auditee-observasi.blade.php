@extends('layouts.app')

@section('title', 'Observasi - Permintaan Tindakan Koreksi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Observasi (Permintaan Tindakan Koreksi)" />

    <div x-data="observationFilter()" 
        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        
        {{-- HEADER --}}
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Daftar Permintaan Tindakan Koreksi
            </h3>
            <div class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                <span>Hanya menampilkan data koreksi yang sudah tercatat</span>
            </div>
        </div>

        {{-- FILTER --}}
        <x-auditee-observasi.observation-filter :tahunAkademiks="$tahunAkademiks" />

        {{-- TABLE --}}
        <div id="observation-table">
            <x-auditee-observasi.observation-table :observations="$observations" />
        </div>

    </div>
@endsection