@extends('layouts.app')

@section('title', 'Form PTK (Permintaan Tindakan Koreksi) | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Form PTK (Permintaan Tindakan Koreksi)" />

    {{-- Flatpickr Dark Mode Override --}}
    <style>
        .dark .flatpickr-calendar {
            background: #1f2937 !important;
            border-color: #374151 !important;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4) !important;
        }
        .dark .flatpickr-months .flatpickr-month {
            background: #1f2937 !important;
            color: #f3f4f6 !important;
            fill: #d1d5db !important;
        }
        .dark .flatpickr-current-month .flatpickr-monthDropdown-months {
            background: #1f2937 !important;
            color: #f3f4f6 !important;
        }
        .dark .flatpickr-current-month input.cur-year {
            color: #f3f4f6 !important;
        }
        .dark .flatpickr-months .flatpickr-prev-month svg,
        .dark .flatpickr-months .flatpickr-next-month svg {
            fill: #9ca3af !important;
        }
        .dark .flatpickr-months .flatpickr-prev-month:hover svg,
        .dark .flatpickr-months .flatpickr-next-month:hover svg {
            fill: #60a5fa !important;
        }
        .dark span.flatpickr-weekday {
            color: #9ca3af !important;
        }
        .dark .flatpickr-day {
            color: #d1d5db !important;
            border-color: #374151 !important;
        }
        .dark .flatpickr-day:hover {
            background: #374151 !important;
            border-color: #374151 !important;
            color: #f3f4f6 !important;
        }
        .dark .flatpickr-day.selected,
        .dark .flatpickr-day.startRange,
        .dark .flatpickr-day.endRange,
        .dark .flatpickr-day.selected.inRange {
            background: #2563eb !important;
            border-color: #2563eb !important;
            color: #ffffff !important;
        }
        .dark .flatpickr-day.inRange {
            background: rgba(37, 99, 235, 0.15) !important;
            border-color: rgba(37, 99, 235, 0.15) !important;
        }
        .dark .flatpickr-day.today {
            border-color: #3b82f6 !important;
            color: #60a5fa !important;
        }
        .dark .flatpickr-day.today:hover {
            background: #374151 !important;
            color: #93c5fd !important;
        }
        .dark .flatpickr-day.prevMonthDay,
        .dark .flatpickr-day.nextMonthDay {
            color: #4b5563 !important;
        }
        .dark .flatpickr-day.disabled {
            color: #374151 !important;
        }
        .dark .flatpickr-months .flatpickr-month:hover .flatpickr-monthDropdown-months {
            background: #374151 !important;
        }
        .dark .flatpickr-monthDropdown-months option {
            background: #1f2937 !important;
            color: #f3f4f6 !important;
        }
        .dark .flatpickr-yearDropdown option {
            background: #1f2937 !important;
            color: #f3f4f6 !important;
        }
        .dark .flatpickr-day.flatpickr-disabled {
            color: #374151 !important;
        }
        .dark .flatpickr-day.flatpickr-disabled:hover {
            background: transparent !important;
        }
    </style>

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        {{-- Header --}}
        <x-form-ketidaksesuaian-ncr.ncr-header />

        {{-- Filter Tahun Akademik --}}
        <x-form-ketidaksesuaian-ncr.filter-tahun-akademik 
            :tahunAkademik="$tahunAkademik"
            icon-color="red"
            title="Filter Tahun Akademik PTK"
            description="Pilih tahun akademik untuk menyaring data PTK"
            colspan="13"
        />

        {{-- Tabel NCR --}}
        <x-form-ketidaksesuaian-ncr.ncr-table
            :auditPtk="$auditPtk"
        />

    </div>

    {{-- Modal Tambah / Edit --}}
    @include('components.form-ketidaksesuaian-ncr.modal-form-ncr')

    {{-- Modal Detail / Lihat File --}}
    @include('components.form-ketidaksesuaian-ncr.modal-detail-ncr')

@endsection