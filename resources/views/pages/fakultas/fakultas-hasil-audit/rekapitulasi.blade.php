@extends('layouts.app')

@section('title', 'Hasil Audit Rekapitulasi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hasil Audit Rekapitulasi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        <x-fakultas-hasil-audit.rekapitulasi.header />

        @include('components.fakultas-hasil-audit.rekapitulasi.filter')

        <div id="table-container">
            <x-fakultas-hasil-audit.rekapitulasi.table 
                :items="[]" 
                :categories="[]" 
                :filterStatus="$filterStatus ?? ['message' => 'Pilih Tahun Akademik terlebih dahulu', 'subMessage' => 'Tahun Akademik wajib dipilih untuk menampilkan rekapitulasi data']"
                :isComplete="false"
            />
        </div>

    </div>
@endsection