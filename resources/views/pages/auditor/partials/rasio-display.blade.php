@props(['profil'])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Rasio Dosen : Mahasiswa</h4>
        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            View Only
        </span>
    </div>

    @php
        $totalDosen = ($profil->jumlah_magister ?? 0) + ($profil->jumlah_doktor ?? 0);
        $jumlahMahasiswa = $profil->jumlah_mahasiswa ?? 0;
        $rasio = $totalDosen > 0 ? round($jumlahMahasiswa / $totalDosen, 2) : 0;
    @endphp

    <div class="flex items-center justify-between">
        <div>
            <div class="text-3xl font-bold text-gray-800 dark:text-white">
                1 : {{ $rasio }}
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                <span class="font-medium">{{ $totalDosen }}</span> Dosen : 
                <span class="font-medium">{{ $jumlahMahasiswa }}</span> Mahasiswa
            </p>
        </div>
        <div class="text-right">
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Otomatis
            </span>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4 border-t border-gray-200 pt-4 dark:border-gray-700">
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Total Dosen (S2 + S3)</p>
            <p class="text-lg font-semibold text-gray-800 dark:text-white">
                {{ $totalDosen }}
                <span class="text-xs font-normal text-gray-500 dark:text-gray-400">
                    (S2: {{ $profil->jumlah_magister ?? 0 }}, S3: {{ $profil->jumlah_doktor ?? 0 }})
                </span>
            </p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Mahasiswa</p>
            <p class="text-lg font-semibold text-gray-800 dark:text-white">
                {{ $jumlahMahasiswa }}
            </p>
        </div>
    </div>
</div>