{{-- resources/views/components/auditee-penilaian-kinerja/header.blade.php --}}
@props(['total' => 0])

<div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between lg:mb-6">
    <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
            Penilaian Kinerja
        </h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Halaman ini digunakan untuk melakukan evaluasi terhadap hasil audit dan menyusun rencana perbaikan.
        </p>
    </div>
    <div class="mt-2 flex items-center gap-2 sm:mt-0">
        {{-- Tombol Tambah Penilaian --}}
        <button type="button"
            onclick="openModalPenilaianKinerja()"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Penilaian
        </button>

        {{-- Badge total data --}}
        <span class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            {{ $total }} Data
        </span>
    </div>
</div>