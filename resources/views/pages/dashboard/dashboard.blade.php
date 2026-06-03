@extends('layouts.app')

@section('title', 'Dashboard | SIMANTAP')

@section('content')
  <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Admin</h1>

  <div class="space-y-6">
    <div class="mb-6">
      <x-audit.metrics-cards />
    </div>

    <div class="grid grid-cols-12 gap-4 md:gap-6">

      <div class="col-span-12 space-y-6 xl:col-span-7">
        <x-audit.charts-overview />
      </div>
      <div class="col-span-12 xl:col-span-5">
        <x-audit.alert-issues />
      </div>

      <div class="col-span-12 xl:col-span-7">
        <x-audit.recent-audits />
      </div>
      <div class="col-span-12 xl:col-span-5">
        <x-audit.activity-log />
      </div>

      <div class="col-span-12">
        <x-audit.quick-access />
      </div>

      <div class="col-span-12">
        <x-audit.faculty-data />
      </div>

    </div>
  </div>
@endsection