@extends('layouts.app')

@section('title', 'Form Observasi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Form Observasi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-5 lg:mb-7">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Data Observasi</h3>
            <button
                type="button"
                onclick="openModalFormObservasi()"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Data
            </button>
        </div>

        <div x-data="filterComponent()">

            <x-form-observasi.filter-section
                :tahunAkademik="$tahunAkademik"
            />

            <div id="observationTableContainer">
                <x-form-observasi.observation-table
                    :observasi="$observasi"
                />
            </div>

        </div>
    </div>

    @include('components.form-observasi.modal-form')

@endsection
