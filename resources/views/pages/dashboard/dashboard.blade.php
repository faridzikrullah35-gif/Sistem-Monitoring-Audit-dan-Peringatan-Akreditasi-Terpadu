{{-- dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard | SIMANTAP')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Admin</h1>

    <div class="space-y-6">
        {{-- Metric Cards --}}
        <x-audit.metrics-cards 
          :totalDataAmi="$totalDataAmi"
          :tahunAkademikAktif="$tahunAkademikAktif"
          :totalUnit="$totalUnit"
          :totalSubUnit="$totalSubUnit"
          :totalUnitSubUnit="$totalUnitSubUnit"
          :totalAuditor="$totalAuditor"
          :totalAuditorAktif="$totalAuditorAktif"
          :totalAuditorNonAktif="$totalAuditorNonAktif"
        />

        {{-- Row: Charts Overview | Recent Audits --}}
        <div class="grid grid-cols-12 gap-4 md:gap-6">
            <div class="col-span-12 xl:col-span-7">
                <x-audit.charts-overview
                    :labels="$chartLabels"
                    :chartSeries="$chartSeries"
                />
            </div>
            <div class="col-span-12 xl:col-span-5">
                <x-audit.recent-audits 
                  :recentAudits="$recentAudits"
                />
            </div>
        </div>

        {{-- Faculty Data --}}
        <x-audit.faculty-data :unitData="$unitData" />
    </div>
@endsection