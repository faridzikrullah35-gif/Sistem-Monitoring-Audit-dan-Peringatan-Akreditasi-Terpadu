@extends('layouts.app')

@section('title', 'Setting Landing Page | SIMANTAP')

@section('content')

<div class="space-y-8">
    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Setting Landing Page" />

    {{-- Card: Manajemen Berita --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <x-admin.berita.table :beritas="$beritas" />
    </div>
</div>

@endsection