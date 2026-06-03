@extends('layouts.app')

@section('title', 'Dashboard Auditor | SIMANTAP')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Auditor</h1>

    <div class="space-y-6">
        <!-- Header Sapaan -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Selamat Datang, Tim Auditor</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Berikut adalah ringkasan tugas audit dan jadwal Anda saat ini.</p>
            </div>
            <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                {{-- SVG ICON --}}
                <svg 
                    class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24">
                    
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M3 7h18M3 12h18M3 17h18">
                    </path>
                </svg>

                {{-- TEXT --}}
                <span class="text-sm font-medium text-blue-700 dark:text-blue-300">
                    Unit: {{ auth()->user()->unit ?? '-' }} 
                    |
                    Sub Unit: {{ auth()->user()->sub_unit ?? '-' }}
                </span>

            </div>
        </div>

        <!-- Komponen Stats Cards -->
        <x-dashboard-auditor.stats-cards />

        <!-- Grid Bawah: Deadline & Progress -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
            
            <!-- Tabel Deadline Mendekat (Prioritas Utama) -->
            <div class="xl:col-span-7">
                <x-dashboard-auditor.deadline-table />
            </div>

            <!-- Progress Audit Terakhir -->
            <div class="xl:col-span-5">
                <x-dashboard-auditor.recent-progress />
            </div>

        </div>
    </div>

@endsection 