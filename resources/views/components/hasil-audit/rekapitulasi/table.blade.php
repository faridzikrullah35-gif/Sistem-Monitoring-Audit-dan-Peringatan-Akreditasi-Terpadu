@if(empty($items))
    <div class="mt-5 text-center py-12 text-gray-500">
        Silakan pilih Tahun Akademik terlebih dahulu untuk melihat data.
    </div>
@else
<div class="mt-5 space-y-6">

    {{-- TABLE --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-[1400px] divide-y divide-gray-200 text-sm dark:divide-gray-700">

            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="w-12 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">No. NCR</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tgl. Audit</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Bagian</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Macam Temuan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Uraian Temuan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tgl. Target</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tgl. Verifikasi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Auditor</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Keterangan</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                @forelse($items as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $item['no_ncr'] }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $item['tgl_audit'] }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $item['bagian'] }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200 font-semibold">{{ $item['macam_temuan'] }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
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
                                {!! $item['uraian_temuan'] !!}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $item['tgl_target_perbaikan'] }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $item['tgl_verifikasi'] }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $item['auditor'] }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                            @if($item['status'] && $item['status'] != '-')
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                    {{ strtolower($item['status']) == 'open' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                    {{ $item['status'] }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $item['keterangan'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="py-12 text-center text-gray-500">
                            Tidak ada data untuk filter yang dipilih.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- REKAP CARDS --}}
    @if(!empty($categories))
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($categories as $cat)
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total {{ $cat['label'] }}
                    </div>
                    <div class="mt-2 text-3xl font-bold {{ $cat['color'] ?? 'text-gray-700' }}">
                        {{ $cat['total'] }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endif