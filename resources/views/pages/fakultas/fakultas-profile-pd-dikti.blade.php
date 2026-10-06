@extends('layouts.app')

@section('title', 'Profile PD-DIKTI Fakultas | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Profile PD-DIKTI Fakultas" />

    <div class="space-y-6">
        {{-- Header Card --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">DTPS</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data berdasarkan PD-DIKTI terbaru</p>
                </div>
            </div>
        </div>

        {{-- Header halaman --}}
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white/90">
            Profile PD Dikti Fakultas
        </h1>
    </div>

        {{-- Tabel Mahasiswa --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <x-fakultas-profile-pd-dikti.table-data-pd-dikti
                :mahasiswaFakultas="$mahasiswaFakultas"
                :mahasiswaProdi="$mahasiswaProdi"
                :prodi="$prodi"
            />
        </div>

        {{-- Tabel Rasio --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <x-fakultas-profile-pd-dikti.table-data-rasio
                :rasioFakultas="$rasioFakultas"
                :rasioProdi="$rasioProdi"
                :prodi="$prodi"
            />
        </div>

        {{-- Tabel Lulusan --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
            <x-fakultas-profile-pd-dikti.table-data-lulusan
                :lulusanFakultas="$lulusanFakultas"
                :lulusanProdi="$lulusanProdi"
                :prodi="$prodi"
            />
        </div>
    </div>

    {{-- Modal Tambah/Ubah Mahasiswa --}}
    @include('components.fakultas-profile-pd-dikti.modal.mahasiswa-modal')

    {{-- Modal Tambah/Ubah Rasio --}}
    @include('components.fakultas-profile-pd-dikti.modal.rasio-modal')

    {{-- Modal Tambah/Ubah Lulusan --}}
    @include('components.fakultas-profile-pd-dikti.modal.lulusan-modal')
@endsection