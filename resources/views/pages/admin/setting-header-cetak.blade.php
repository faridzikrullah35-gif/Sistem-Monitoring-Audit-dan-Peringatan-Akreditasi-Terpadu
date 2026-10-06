@extends('layouts.app')

@section('title', 'Setting Header Cetak | SIMANTAP')

@section('content')
    <x-common.page-breadcrumb pageTitle="Setting Header Cetak" />

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

        {{-- Header dengan Tombol Tambah --}}
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Pengaturan Header Cetak
            </h2>
            <button 
                onclick="openModalSetting()"
                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <svg class="inline h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Setting
            </button>
        </div>

        {{-- Tabel --}}
        <div id="tableSettingContainer">
            <x-setting-header-cetak.setting-header-cetak-table 
                :settingHeaderCetak="$settingHeaderCetak" 
            />
        </div>

    </div>
    
{{-- Modal --}}
@include('components.setting-header-cetak.modal.modal-form-setting')

@endsection
