@extends('layouts.app')

@section('title', 'Dashboard PRODI | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Dashboard Prodi" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 lg:p-6">
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
                <x-dashboard-auditee.notifikasi />
            </div>
        </div>
        
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <!-- script grafik dan notifikasi (sama seperti sebelumnya, tapi dimasukkan di sini) -->
@endpush