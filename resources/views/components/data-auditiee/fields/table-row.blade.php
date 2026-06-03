@props([
    'index',
    'auditiee',
    'tahunAkademik',
])

<tr class="group transition-colors hover:bg-gray-50/60 dark:hover:bg-white/[0.02]">
    {{-- Nomor Urut --}}
    <td class="whitespace-nowrap px-4 py-3.5 text-gray-500 dark:text-gray-400">
        {{ $index + 1 }}
    </td>

    {{-- Nama Auditiee --}}
    <td class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-800 dark:text-white/85">
        {{ $auditiee->nama_auditiee }}
    </td>

    {{-- Tahun Akademik --}}
    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
        {{ $auditiee->tahunAkademik->tahun_akademik ?? '-' }}
        -
        {{ $auditiee->tahunAkademik->semester ?? '-' }}
    </td>

    {{-- Aksi --}}
    <td class="whitespace-nowrap px-4 py-3.5 text-right">
        <div class="inline-flex items-center gap-2">

            {{-- Tombol Edit --}}
            <button
                type="button"
                onclick="openModalFormAuditiee('edit', {{ $auditiee->id }})"
                class="inline-flex items-center gap-1.5 rounded-lg border border-yellow-200 bg-yellow-50 px-3 py-1.5 text-xs font-medium text-yellow-600 transition-all hover:bg-yellow-100 hover:text-yellow-700 dark:border-yellow-500/20 dark:bg-yellow-500/10 dark:text-yellow-400 dark:hover:bg-yellow-500/20"
            >
                {{-- Icon Edit --}}
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                </svg>

                <span>Edit</span>
            </button>

            {{-- Tombol Hapus --}}
            <button
                type="button"
                onclick="deleteAuditiee({{ $auditiee->id }})"
                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20"
            >
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                </svg>

                <span>Hapus</span>
            </button>

        </div>
    </td>
</tr>