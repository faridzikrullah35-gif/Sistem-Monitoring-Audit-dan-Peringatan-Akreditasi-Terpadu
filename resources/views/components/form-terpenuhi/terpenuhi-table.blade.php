@props(['terpenuhi'])

<div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Indikator</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Discussed with</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Recommendations & Improvement Suggestions</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($terpenuhi as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition">
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $terpenuhi->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $item->pertanyaanAmiProdi?->isiIndikator?->indikator ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            @if($item->discussed_with)
                                <div class="
                                    max-w-none break-words

                                    [&_p]:mb-2

                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ul]:mb-2

                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                    [&_ol]:mb-2

                                    [&_li]:mb-1

                                    [&_strong]:font-semibold
                                    [&_em]:italic
                                    [&_u]:underline
                                ">
                                    {!! $item->discussed_with !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            @if($item->rekomendasi)
                                <div class="
                                    max-w-none break-words

                                    [&_p]:mb-2

                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ul]:mb-2

                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                    [&_ol]:mb-2

                                    [&_li]:mb-1

                                    [&_strong]:font-semibold
                                    [&_em]:italic
                                    [&_u]:underline
                                ">
                                    {!! $item->rekomendasi !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">

                                <!-- EDIT -->
                                <button
                                    type="button"
                                    onclick="openModalFormTerpenuhi({{ $item->id }})"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                                    title="Edit Data"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                        />
                                    </svg>

                                    Edit
                                </button>

                                <!-- DELETE -->
                                <button
                                    type="button"
                                    onclick="deleteTerpenuhi({{ $item->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>

                                    Hapus
                                </button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M20 13V6C20 4.89543 19.1046 4 18 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H13M16 19L19 22M19 16L22 19M9 10H15M9 14H12" stroke-width="1.5"/>
                                </svg>
                                <p class="text-sm font-medium">Belum ada data terpenuhi</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-700">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan
            <span class="font-medium text-gray-700 dark:text-gray-200">{{ $terpenuhi->firstItem() ?? 0 }}</span>
            -
            <span class="font-medium text-gray-700 dark:text-gray-200">{{ $terpenuhi->lastItem() ?? 0 }}</span>
            dari
            <span class="font-medium text-gray-700 dark:text-gray-200">{{ $terpenuhi->total() }}</span>
            data
        </div>
        <div class="pagination-wrapper">
            {{ $terpenuhi->links('pagination::tailwind') }}
        </div>
    </div>
</div>