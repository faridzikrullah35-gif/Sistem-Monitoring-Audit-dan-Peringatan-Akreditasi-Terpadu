@extends('layouts.app')

@section('title', 'Data Akreditasi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Data Akreditasi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        @include('components.data-akreditasi.table-akreditasi')
    </div>

    {{-- Modal for Create/Edit (only extra fields) --}}
    @include('components.data-akreditasi.modal-akreditasi')
@endsection