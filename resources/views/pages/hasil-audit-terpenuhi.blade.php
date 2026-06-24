@extends('layouts.app')

@section('title', 'Hasil Audit Terpenuhi | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hasil Audit Terpenuhi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        <x-hasil-audit.terpenuhi.header />

        @include('components.hasil-audit.terpenuhi.filter')

        <div id="table-container">
            <x-hasil-audit.terpenuhi.table :data="$data" />
        </div>

    </div>
@endsection