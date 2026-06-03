@props([
    'auditieeList' => [],
])

<div class="overflow-x-auto">
    <table id="auditieeTableContainer" class="w-full text-left text-sm">
        <thead>
            <tr class="border-b border-gray-200 bg-gray-50 dark:border-gray-800 dark:bg-white/[0.02]">
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">#</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">Nama Auditiee</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">Tahun Akademik</th>
                <th class="whitespace-nowrap px-4 py-3.5 text-right font-medium text-gray-500 dark:text-gray-400">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60">

            @if($auditieeList->isEmpty())
                <tr>
                    <td colspan="4" class="px-4 py-12 text-center">
                        <div class="flex flex-col items-center gap-2">
                            {{-- Icon Empty State --}}
                            <svg class="h-10 w-10 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125v-3.75" />
                            </svg>
                            <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada data auditiee</p>
                        </div>
                    </td>
                </tr>
            @else
                @foreach($auditieeList as $index => $auditiee)
                    <x-data-auditiee.fields.table-row
                        :index="$index"
                        :auditiee="$auditiee"
                    />
                @endforeach
            @endif

        </tbody>
    </table>
</div>