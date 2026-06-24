@extends('layouts.app')

@section('title', 'Hasil Audit Rekapitulasi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hasil Audit Rekapitulasi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        <x-hasil-audit.rekapitulasi.header />

        @include('components.hasil-audit.rekapitulasi.filter')

        <div id="table-container">
            <x-hasil-audit.rekapitulasi.table :items="[]" :categories="[]" />
        </div>

    </div>
@endsection