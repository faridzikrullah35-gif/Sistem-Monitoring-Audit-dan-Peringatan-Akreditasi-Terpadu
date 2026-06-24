@extends('layouts.app')

@section('title', 'Hasil Audit Daftar Periksa | SIMANTAP')

@section('content')
    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Hasil Audit Daftar Periksa" />

    {{-- Card utama --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        {{-- Header Card --}}
        <x-hasil-audit.daftar-periksa.header />

        {{-- Filter --}}
        @include('components.hasil-audit.daftar-periksa.filter')

        {{-- Tabel Data --}}
        <div id="table-container">
            <x-hasil-audit.daftar-periksa.table :data="$data" />
        </div>

    </div>
@endsection