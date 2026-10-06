@extends('layouts.app')

@php
    $user = auth()->user();
    $namaUser = $user->name ?? 'User';
    $roleLabel = match ($user->role) {
        'prodi' => 'Prodi',
        'unit_kerja' => 'Unit Kerja',
        default => ucfirst(str_replace('_', ' ', $user->role ?? 'Auditee')),
    };
    $unitName = $user->sub_unit ?: $user->unit;
    $dashboardTitle = 'Dashboard ' . $roleLabel;
    $dashboardSubtitle = $unitName ? $unitName : null;
@endphp

@section('title', $dashboardTitle . ' | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb :pageTitle="$dashboardTitle" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 lg:p-6">
        {{-- Header Dashboard --}}
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $dashboardTitle }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Selamat datang,
                <span class="font-medium text-gray-700 dark:text-gray-200">{{ $namaUser }}</span>
                @if ($dashboardSubtitle)
                    <span class="mx-1">•</span>
                    {{ $dashboardSubtitle }}
                @endif
            </p>
        </div>

        <x-dashboard-auditee.status-cards
            :tahun="$tahunAkademikText"
            :status="$statusAudit"
            :deadline="$deadline"
            :progress="$progressPersen"
        />

        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <x-dashboard-auditee.progress-ami
                    :total="$totalPertanyaan"
                    :sudah="$sudahDiisi"
                    :belum="$belumDiisi"
                    :persen="$progressPersen"
                />

                <x-dashboard-auditee.ringkasan-temuan
                    :ncrMayor="$ncrMayor"
                    :ncrMinor="$ncrMinor"
                    :observasi="$observasi"
                    :terpenuhi="$terpenuhi"
                />

                <x-dashboard-auditee.grafik-ami
                    :labels="$chartLabels"
                    :chartSeries="$chartSeries"
                />
            </div>

            <div class="flex h-full">
                <x-dashboard-fakultas.notifikasi
                    :notifications="$notifications"
                    :notification-route="route('prodi.notifications')"
                />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    {{-- script grafik dan notifikasi --}}
@endpush