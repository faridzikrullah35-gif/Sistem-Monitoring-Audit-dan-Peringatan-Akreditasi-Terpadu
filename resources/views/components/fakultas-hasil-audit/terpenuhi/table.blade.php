<div class="mt-5 overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">

    <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">

        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="w-12 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">#</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300" style="width:35%;">Indikator</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300" style="width:60%;">Recommendations and Improvement Suggestions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">

            @if (!$filterStatus['isComplete'] || $data->isEmpty())
                <tr>
                    <td colspan="3" class="py-12 text-center">
                        <div class="flex flex-col items-center text-gray-400 dark:text-gray-500">
                            <!-- Icon Filter -->
                            <svg class="mb-3 h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            
                            <p class="text-sm font-medium">{{ $filterStatus['message'] }}</p>
                            <p class="text-xs">{{ $filterStatus['subMessage'] }}</p>
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($data as $index => $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $data->firstItem() + $index }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->indikator }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                            <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-2 [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-2 [&_li]:mb-1 [&_strong]:font-semibold [&_em]:italic [&_u]:underline [&_h1]:text-lg [&_h1]:font-bold [&_h1]:mb-2 [&_h2]:text-base [&_h2]:font-semibold [&_h2]:mb-2 [&_table]:w-full [&_table]:border-collapse [&_td]:border [&_td]:p-2 [&_th]:border [&_th]:p-2 [&_th]:font-semibold">
                                {!! $row->rekomendasi !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    @if($filterStatus['isComplete'] && !$data->isEmpty())
    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-gray-200 px-6 py-3 dark:border-gray-700">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
        </div>
        <div class="flex items-center gap-1">
            {{ $data->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @endif

</div>