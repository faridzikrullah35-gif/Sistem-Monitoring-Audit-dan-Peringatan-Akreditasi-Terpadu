@props(['observations'])

<div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        #
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Indikator
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Discussed with
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Recommendations & Improvement Suggestions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($observations as $index => $obs)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition">

                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $observations->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $obs->pertanyaanAmiProdi?->isiIndikator?->indikator ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $obs->discussed_with ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                            {!! $obs->rekomendasi ?? '-' !!}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">

                            <div class="flex flex-col items-center gap-2">

                                <svg
                                    width="48"
                                    height="48"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                >
                                    <path
                                        d="M20 13V6C20 4.89543 19.1046 4 18 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H13M16 19L19 22M19 16L22 19M9 10H15M9 14H12"
                                        stroke-width="1.5"
                                    />
                                </svg>

                                <p class="text-sm font-medium">
                                    Belum ada data observasi
                                </p>

                            </div>

                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-700">

        {{-- INFO --}}
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan
            <span class="font-medium text-gray-700 dark:text-gray-200">
                {{ $observations->firstItem() ?? 0 }}
            </span>
            -
            <span class="font-medium text-gray-700 dark:text-gray-200">
                {{ $observations->lastItem() ?? 0 }}
            </span>
            dari
            <span class="font-medium text-gray-700 dark:text-gray-200">
                {{ $observations->total() }}
            </span>
            data
        </div>

        {{-- LINKS --}}
        <div class="pagination-wrapper">
            {{ $observations->links('pagination::tailwind') }}
        </div>

    </div>

</div>