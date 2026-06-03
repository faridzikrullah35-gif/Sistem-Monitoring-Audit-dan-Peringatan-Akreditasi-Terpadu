@props([
    'index',
    'noNcr',
    'indikator',
    'klausul',
    'deskripsiTemuan',
    'kategori',
    'analisisPenyebab',
    'akibat',

    'analisisPenyebab',
    'rencanaPerbaikan',
    'tanggalTargetPerbaikan',
    'tindakanPencegahan',

    'file',

    'tglSelesai',
    'statusVerifikasi',
    'dataId',
    'tahunAkademikId' => null
])

@php

    /*
    |--------------------------------------------------------------------------
    | BADGE KATEGORI
    |--------------------------------------------------------------------------
    */

    $kategoriClass = match($kategori) {

        'Major'
            => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400',

        'Minor'
            => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400',

        'Observasi'
            => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400',

        'OFI'
            => 'bg-purple-50 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400',

        default
            => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
    };


    /*
    |--------------------------------------------------------------------------
    | BADGE STATUS
    |--------------------------------------------------------------------------
    */

    $statusClass = match($statusVerifikasi) {

        'Diterima'
            => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400',

        'Ditolak'
            => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400',

        default
            => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
    };


    /*
    |--------------------------------------------------------------------------
    | FORMAT TANGGAL
    |--------------------------------------------------------------------------
    */

    $tanggalTargetFormatted = $tanggalTargetPerbaikan
        ? \Carbon\Carbon::parse($tanggalTargetPerbaikan)->format('d M Y')
        : '-';

    $tglSelesaiFormatted = $tglSelesai
        ? \Carbon\Carbon::parse($tglSelesai)->format('d M Y')
        : '-';


    /*
    |--------------------------------------------------------------------------
    | CHECK FILE
    |--------------------------------------------------------------------------
    */

    $hasFile = !empty($file);

@endphp

    <tr 
        data-id="{{ $dataId }}"
        data-ta-id="{{ $tahunAkademikId ?? '' }}"
        class="hover:bg-gray-50/40 dark:hover:bg-white/[0.02] transition-colors"
    >

    {{-- =====================================================
        NO NCR
    ====================================================== --}}
    <td class="sticky left-0 z-10 whitespace-nowrap border-r border-gray-100 bg-white px-4 py-2.5 font-mono text-xs font-semibold text-gray-800 dark:border-gray-800/60 dark:bg-gray-900/95 dark:text-white/90">
        {{ $noNcr ?? '-' }}
    </td>


    {{-- =====================================================
        INDIKATOR
    ====================================================== --}}
    <td class="min-w-[280px] max-w-[350px] px-3 py-2.5 align-top">
        <div class="whitespace-normal break-words text-xs text-gray-600 dark:text-gray-400">
            {{ $indikator }}
        </div>
    </td>


    {{-- =====================================================
        KLAUSUL / DOKUMEN
    ====================================================== --}}
    <td class="min-w-[200px] max-w-[280px] px-3 py-2.5 align-top">
        <p class="whitespace-normal break-words text-xs text-gray-600 dark:text-gray-400">
            {{ $klausul ?? '-' }}
        </p>
    </td>


    {{-- =====================================================
        DESKRIPSI URAIAN TEMUAN
    ====================================================== --}}
    <td class="min-w-[320px] max-w-[450px] px-3 py-2.5 align-top">
        <div class="whitespace-normal break-words text-xs text-gray-600 dark:text-gray-400">
            {!! $deskripsiTemuan ?? '-' !!}
        </div>
    </td>

    {{-- =====================================================
        ANALISIS PENYEBAB
    ====================================================== --}}
    <td class="min-w-[260px] max-w-[360px] px-3 py-2.5 align-top">
        <p class="whitespace-normal break-words text-xs text-gray-600 dark:text-gray-400">
            {{ $analisisPenyebab ?: '-' }}
        </p>
    </td>

    {{-- =====================================================
        AKIBAT
    ====================================================== --}}
    <td class="min-w-[260px] max-w-[360px] px-3 py-2.5 align-top">
        <p class="whitespace-normal break-words text-xs text-gray-600 dark:text-gray-400">
            {{ $akibat ?: '-' }}
        </p>
    </td>

    {{-- =====================================================
        KATEGORI
    ====================================================== --}}
    <td class="whitespace-nowrap px-3 py-2.5 align-top">
        <span class="inline-flex rounded-full px-2 py-0.5 text-[11px] font-semibold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
            {{ $kategori ?? '-' }}
        </span>
    </td>

    {{-- =====================================================
        Rencana Tindakan Perbaikan
    ====================================================== --}}
    <td class="min-w-[260px] max-w-[360px] px-3 py-2.5 align-top">
        <p class="whitespace-normal break-words text-xs text-gray-600 dark:text-gray-400">
            {{ $rencanaPerbaikan ?? '-' }}
        </p>
    </td>


    {{-- =====================================================
        TARGET PERBAIKAN
    ====================================================== --}}
    <td class="whitespace-nowrap px-3 py-2.5 align-top">
        <span class="text-xs text-gray-500 dark:text-gray-400">
            {{ $tanggalTargetFormatted }}
        </span>
    </td>


    {{-- =====================================================
        TINDAKAN PENCEGAHAN
    ====================================================== --}}
    <td class="min-w-[260px] max-w-[360px] px-3 py-2.5 align-top">
        <p class="whitespace-normal break-words text-xs text-gray-600 dark:text-gray-400">
            {{ $tindakanPencegahan ?? '-' }}
        </p>
    </td>


    {{-- =====================================================
        FILE
    ====================================================== --}}
    <td class="px-3 py-2.5 text-center align-top">

        @if($hasFile)

            <div class="flex flex-col items-center gap-1">

                {{-- ICON FILE --}}
                <a
                    href="{{ asset('storage/' . $file) }}"
                    target="_blank"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 transition-colors hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:hover:bg-emerald-500/20"
                    title="Lihat File"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32"
                        />
                    </svg>
                </a>

                {{-- TEXT --}}
                <span class="text-[11px] font-medium text-emerald-600 dark:text-emerald-400">
                    Lihat File
                </span>

            </div>

        @else

            <div class="flex flex-col items-center gap-1">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800">
                    <svg
                        class="h-4 w-4 text-gray-400 dark:text-gray-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9Z"
                        />
                    </svg>
                </div>

                <span class="text-[11px] text-gray-400 dark:text-gray-500">
                    Tidak Ada
                </span>

            </div>

        @endif

    </td>


    {{-- =====================================================
        TGL SELESAI
    ====================================================== --}}
    <td class="whitespace-nowrap px-3 py-2.5 align-top">
        <span class="text-xs {{ $tglSelesai ? 'text-gray-600 dark:text-gray-400' : 'text-gray-300 dark:text-gray-600' }}">
            {{ $tglSelesaiFormatted }}
        </span>
    </td>


    {{-- =====================================================
        STATUS VERIFIKASI
    ====================================================== --}}
    @php
        $status = $statusVerifikasi ?? 'Open';

        $statusClass = match($status) {
            'Close' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
            'Open'  => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
            default => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300',
        };

        $dotClass = match($status) {
            'Close' => 'bg-red-500 dark:bg-red-400',
            'Open'  => 'bg-blue-500 dark:bg-blue-400',
            default => 'bg-gray-400 dark:bg-gray-500',
        };
    @endphp

    <td class="whitespace-nowrap px-3 py-2.5 align-top">
        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[11px] font-medium {{ $statusClass }}">

            <span class="h-1.5 w-1.5 rounded-full {{ $dotClass }}"></span>

            {{ $status }}
        </span>
    </td>


    {{-- =====================================================
        AKSI
    ====================================================== --}}
    <td class="sticky right-0 z-10 whitespace-nowrap border-l border-gray-100 bg-white px-3 py-2.5 text-right dark:border-gray-800/60 dark:bg-gray-900/95 align-top">
        <div class="inline-flex items-center gap-2">
            {{-- EDIT --}}
            <button
                type="button"
                onclick="openModalFormNCR({{ $dataId }})"
                class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                title="Edit Data"
            >
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit
            </button>

            {{-- DELETE --}}
            <button
                type="button"
                onclick="openModalHapusNCR({{ $dataId }}, '{{ $noNcr }}')"
                class="inline-flex items-center gap-1.5 rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition-all duration-200 hover:bg-red-200 hover:shadow-sm dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50"
                title="Hapus Data"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Hapus
            </button>
        </div>
    </td>

</tr>