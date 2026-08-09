@extends('layouts.app')

@section('title', 'Penilaian Kinerja Prodi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Penilaian Kinerja Prodi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <x-auditee-penilaian-kinerja.header :total="$dataPenilaian->total()" />
        
        <x-auditee-penilaian-kinerja.filter :standarList="$standarList" />
        
        {{-- Container untuk tabel --}}
        <div id="tableContainer">
            <x-auditee-penilaian-kinerja.table :dataPenilaian="$dataPenilaian" />
        </div>
    </div>

    <x-auditee-penilaian-kinerja.drawer />
    <x-auditee-penilaian-kinerja.modal
        :matrixs="$matrixs"
        :settingScores="$settingScores"
        :standarList="$standarList"
    />
@endsection