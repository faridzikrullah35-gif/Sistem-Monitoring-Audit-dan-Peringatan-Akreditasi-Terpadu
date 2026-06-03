@extends('layouts.app')

@section('title', 'Dashboard PRODI | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Dashboard Auditee (PRODI)" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 lg:p-6">
        <x-dashboard-auditee.status-cards />
        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <x-dashboard-auditee.progress-ami />
                <x-dashboard-auditee.ringkasan-temuan />
                <x-dashboard-auditee.grafik-ami />
            </div>
            <div class="space-y-6">
                <x-dashboard-auditee.menu-cepat />
                <x-dashboard-auditee.notifikasi />
                <x-dashboard-auditee.dokumen-terbaru />
            </div>
        </div>
        <div class="mt-6">
            <x-dashboard-auditee.timeline-audit />
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <!-- script grafik dan notifikasi (sama seperti sebelumnya, tapi dimasukkan di sini) -->
@endpush