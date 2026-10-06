@extends('layouts.app')

@section('title', 'Profile SDM | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Profile SDM" />

    <div class="space-y-6">
        {{-- Header Card --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">SDM</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data berdasarkan PD-DIKTI terbaru</p>
                </div>
            </div>
        </div>

        {{-- Tabel Dosen --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <x-profile-sdm.table-data-dosen :dosen="$dosen" />
        </div>

        {{-- Tabel Tendik --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <x-profile-sdm.table-data-tendik :tendik="$tendik" />
        </div>
    </div>

    {{-- Modal Tambah/Ubah Dosen --}}
    @include('components.profile-sdm.modal.dosen-modal')

    {{-- Modal Tambah/Ubah Tendik --}}
    @include('components.profile-sdm.modal.tendik-modal')
@endsection