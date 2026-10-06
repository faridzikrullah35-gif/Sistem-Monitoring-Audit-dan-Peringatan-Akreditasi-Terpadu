@extends('layouts.app')

@section('title', 'Hasil Audit Observasi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hasil Audit Observasi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        <x-fakultas-hasil-audit.observasi.header />

        @include('components.fakultas-hasil-audit.observasi.filter')

        <div id="table-container">
            <x-fakultas-hasil-audit.observasi.table :data="$data" :filterStatus="$filterStatus" />
        </div>

    </div>
@endsection