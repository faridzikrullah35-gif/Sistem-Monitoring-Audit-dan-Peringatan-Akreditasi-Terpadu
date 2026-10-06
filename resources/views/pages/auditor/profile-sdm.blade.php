@extends('layouts.app')

@section('title', 'Profile SDM | SIMANTAP (View Only)')

@section('content')
    <x-common.page-breadcrumb pageTitle="Profile SDM" />

    <div class="space-y-6">
        @if($dosen->isEmpty() && $tendik->isEmpty())
            {{-- TAMPILKAN PESAN KOSONG --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-8 text-center dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                    <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="text-sm font-medium">Belum ada data Profile SDM</span>
                    <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                        Belum ada data dosen atau tendik yang terdaftar untuk prodi ini.
                    </span>
                </div>
            </div>
        @else
            {{-- TAMPILKAN SEMUA DATA --}}
            @include('pages.auditor.partials-sdm.sdm-dosen-display', ['dosen' => $dosen])
            @include('pages.auditor.partials-sdm.sdm-tendik-display', ['tendik' => $tendik])
        @endif
    </div>
@endsection