@extends('layouts.app')

@section('title', 'Isi Data Auditiee | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Isi Data Auditiee" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        {{-- Header: Judul + Tombol Tambah --}}
        <x-data-auditiee.data-auditiee-header />

        {{-- Tabel Data Auditiee --}}
        <x-data-auditiee.data-auditiee-table :auditieeList="$auditieeList" />

    </div>

    {{-- Modal Tambah/Edit Auditiee --}}
    @include('components.data-auditiee.modal-form-auditiee')

@endsection