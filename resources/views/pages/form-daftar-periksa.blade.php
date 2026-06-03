@extends('layouts.app')

@section('title', 'Form Daftar Periksa | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Form Daftar Periksa" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        {{-- Header --}}
        <x-form-daftar-periksa.daftar-periksa-header 
            :pertanyaanAmi="$pertanyaanAmi->first()" 
        />

        {{-- Filter Tahun Akademik --}}
        <div>
            @include('components.form-daftar-periksa.filter-tahun-akademik', [
                'pertanyaan' => $pertanyaan,
                'tahunAkademik' => $tahunAkademik
            ])
        </div>

        {{-- Tabel --}}
        <x-form-daftar-periksa.daftar-periksa-table :pertanyaan="$pertanyaan" />

    </div>

    {{-- Modal Tambah / Edit --}}
    @include('components.form-daftar-periksa.modal-form-periksa')

@endsection
