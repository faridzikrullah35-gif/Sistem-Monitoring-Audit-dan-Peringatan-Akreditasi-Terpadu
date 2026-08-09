@extends('layouts.app')

@section('title', 'Early Warning System | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Early Warning System" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
        <x-early-warning-system.table-ews :akreditasis="$akreditasis" />
    </div>

    {{-- Modal gabungan --}}
    @include('components.early-warning-system.modal-ews')
@endsection