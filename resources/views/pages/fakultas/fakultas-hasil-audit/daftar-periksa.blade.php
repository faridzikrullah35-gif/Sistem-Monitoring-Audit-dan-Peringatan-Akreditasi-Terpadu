@extends('layouts.app')

@section('title', 'Hasil Audit Daftar Periksa | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hasil Audit Daftar Periksa" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        <x-fakultas-hasil-audit.daftar-periksa.header />

        @include('components.fakultas-hasil-audit.daftar-periksa.filter')

        <div id="table-container">
            @include('components.fakultas-hasil-audit.daftar-periksa.table', [
                'data' => $data,
                'hasFilter' => $hasFilter ?? false
            ])
        </div>

    </div>
@endsection