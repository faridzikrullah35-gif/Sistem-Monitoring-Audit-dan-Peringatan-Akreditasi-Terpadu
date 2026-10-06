@extends('layouts.app')

@section('title', 'Data Sarana Prasarana | SIMANTAP')

@section('content')
<div class="space-y-6">

    <x-common.page-breadcrumb pageTitle="Data Sarana Prasarana" />

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Data Sarana Prasarana
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Menampilkan data sarana dan prasarana dari prodi {{ $prodi->name ?? '' }}
            </p>
        </div>
    </div>

    <!-- Komponen Tabel Data Sarana Prasarana Auditor -->
    @include('pages.auditor.partials-sarpras.data-sarpras-auditor-table', [
        'sarpras' => $sarpras
    ])

</div>
@endsection