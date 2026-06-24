{{-- resources/views/components/auditee-terpenuhi/terpenuhi-table.blade.php --}}
@props(['terpenuhi'])

<div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
    <div class="overflow-x-auto relative max-h-[500px] overflow-y-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="sticky top-0 z-10 bg-gray-100 dark:bg-gray-800/90 backdrop-blur-sm">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Indikator</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Discussed With</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Recommendations & Improvement Suggestions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900/50">
                @forelse($terpenuhi as $item)
                    @php
                        $indikator =
                            $item->pertanyaanAmiProdi?->isiIndikator?->indikator
                            ?? $item->pertanyaanAmiUnit?->isiIndikator?->indikator
                            ?? '-';
                    @endphp
                    <tr class="group transition-colors duration-150 hover:bg-blue-50/50 dark:hover:bg-blue-900/10">
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $terpenuhi->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-white/90 font-medium">
                            {{ $indikator }}
                        </td>

                        {{-- DISCUSSED WITH (RICH TEXT) --}}
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                            @if(!empty($item->discussed_with))
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

                        {{-- RECOMMENDATIONS (RICH TEXT) --}}
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
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

                                [&_h1]:text-lg
                                [&_h1]:font-bold
                                [&_h1]:mb-2

                                [&_h2]:text-base
                                [&_h2]:font-semibold
                                [&_h2]:mb-2

                                [&_table]:w-full
                                [&_table]:border-collapse

                                [&_td]:border
                                [&_td]:p-2

                                [&_th]:border
                                [&_th]:p-2
                                [&_th]:font-semibold
                            ">
                                {!! $item->rekomendasi ?? '-' !!}
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-gray-400">
                                        <path d="M20 13V6C20 4.89543 19.1046 4 18 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H13M16 19L19 22M19 16L22 19M9 10H15M9 14H12"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Belum ada data terpenuhi</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex flex-col items-center justify-between gap-4 border-t border-gray-200 px-6 py-4 dark:border-gray-700 sm:flex-row">
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