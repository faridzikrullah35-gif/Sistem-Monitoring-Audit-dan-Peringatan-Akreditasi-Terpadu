@extends('layouts.app')

@section('title', 'Setting Profile Admin | SIMANTAP')

@section('content')

<div class="space-y-8">
    {{-- Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Setting Profile Admin" />

    {{-- Card 1: Profile Admin (View Only) --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <x-admin.setting-profile-admin />
    </div>

    {{-- Divider --}}
    <div class="border-t border-gray-200 dark:border-gray-700"></div>

    {{-- Card 2: Manajemen Konten Tentang Kami --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <x-admin.tentang-kami-table :contents="$contents" />
    </div>

    {{-- Divider --}}
    <div class="border-t border-gray-200 dark:border-gray-700"></div>

    {{-- Card 3: Manajemen Struktur Organisasi --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <x-admin.struktur-organisasi-table :strukturs="$strukturs" />
    </div>
</div>

@endsection