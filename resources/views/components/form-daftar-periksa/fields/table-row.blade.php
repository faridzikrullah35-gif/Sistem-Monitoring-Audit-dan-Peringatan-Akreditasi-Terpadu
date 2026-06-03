@props([
    'index',
    'tujuan',
    'indikator',
    'lingkup',
    'skor',
    'panduan',
    'dataId',
])

<tr
    class="group transition-colors hover:bg-gray-50/60 dark:hover:bg-white/[0.02]"
    data-ta-id="3"
>
    {{-- Nomor --}}
    <td class="whitespace-nowrap px-4 py-3.5 text-gray-500 dark:text-gray-400">
        {{ $index + 1 }}
    </td>

    {{-- Tujuan --}}
    <td class="max-w-[200px] px-4 py-3.5">
        <p class="text-sm font-medium text-gray-800 dark:text-white/85 line-clamp-2">{{ $tujuan }}</p>
    </td>

    {{-- Indikator --}}
    <td class="max-w-[180px] px-4 py-3.5">
        <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
            {{ $indikator }}
        </span>
    </td>

    {{-- Lingkup Pertanyaan --}}
    <td class="max-w-[180px] px-4 py-3.5">
        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $lingkup }}</p>
    </td>

    {{-- Skor (Badge warna) --}}
    <td class="whitespace-nowrap px-4 py-3.5 text-center">
        @php
            $skorColor = match((int) $skor) {
                4 => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400',
                3 => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400',
                2 => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400',
                1 => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400',
                default => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
            };
        @endphp
        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full text-sm font-semibold {{ $skorColor }}">
            {{ $skor }}
        </span>
    </td>

    {{-- Panduan Pengisian --}}
    <td class="max-w-[220px] px-4 py-3.5">
        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $panduan }}</p>
    </td>

    {{-- Aksi --}}
    <td class="whitespace-nowrap px-4 py-3.5 text-right">
        <div class="inline-flex items-center gap-1">

            {{-- Edit --}}
            <button
                type="button"
                onclick="openModalFormPeriksa({{ $dataId }})"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-blue-500/10 dark:hover:text-blue-400"
                title="Edit"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button>

            {{-- Hapus --}}
            <button
                type="button"
                onclick="openModalHapusPeriksa({{ $dataId }}, '{{ $tujuan }}')"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-500/10 dark:hover:text-red-400"
                title="Hapus"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>

        </div>
    </td>
</tr>