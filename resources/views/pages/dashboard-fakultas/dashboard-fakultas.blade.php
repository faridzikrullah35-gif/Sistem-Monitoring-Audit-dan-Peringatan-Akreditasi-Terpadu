@extends('layouts.app')

@section('title', 'Dashboard Fakultas | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Dashboard Fakultas" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 lg:p-6">

        {{-- ==================== STATUS CARDS ==================== --}}
        <x-dashboard-fakultas.status-cards
            :tahun="$tahunAkademikText"
            :status="$statusAudit"
            :deadline="$deadline"
            :progress="$progressPersen"
        />

        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- ==================== KONTEN UTAMA ==================== --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- Progress AMI Fakultas --}}
                <x-dashboard-fakultas.progress-ami
                    :total="$totalPertanyaan"
                    :sudah="$sudahDiisi"
                    :belum="$belumDiisi"
                    :persen="$progressPersen"
                />

                {{-- Ringkasan Temuan Seluruh Prodi --}}
                <x-dashboard-fakultas.ringkasan-temuan
                    :ncrMayor="$ncrMayor"
                    :ncrMinor="$ncrMinor"
                    :observasi="$observasi"
                    :terpenuhi="$terpenuhi"
                />

                {{-- Grafik AMI Fakultas --}}
                <x-dashboard-fakultas.vmts
                    :labels="$chartLabels"
                    :chartSeries="$chartSeries"
                />

            </div>

            {{-- ==================== NOTIFIKASI ==================== --}}
            <div class="flex h-full">
                <x-dashboard-fakultas.notifikasi />
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

    {{-- Script grafik & notifikasi --}}
@endpush