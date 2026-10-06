<div class="mt-5 overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">

    <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">

        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="w-12 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">#</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">No. NCR</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Indikator</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Klausul/Dokumen</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Deskripsi / Uraian Temuan</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Analisis Penyebab</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Akibat</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Kategori Temuan</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Rencana Tindakan Perbaikan (Auditee)</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tanggal Target Perbaikan (Auditee)</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tindakan Pencegahan (Auditee)</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">File (Auditee)</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tgl Selesai</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Status Verifikasi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">

            @if (!$filterStatus['isComplete'] || $data->isEmpty())
                <tr>
                    <td colspan="14" class="py-12 text-center">
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
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->no_ncr }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->indikator }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->klausul_dokumen }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                            @if(!empty($row->deskripsi_uraian_temuan) && $row->deskripsi_uraian_temuan != '-')
                                <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-2 [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-2 [&_li]:mb-1 [&_strong]:font-semibold [&_em]:italic [&_u]:underline [&_h1]:text-lg [&_h1]:font-bold [&_h1]:mb-2 [&_h2]:text-base [&_h2]:font-semibold [&_h2]:mb-2 [&_table]:w-full [&_table]:border-collapse [&_td]:border [&_td]:p-2 [&_th]:border [&_th]:p-2 [&_th]:font-semibold">
                                    {!! $row->deskripsi_uraian_temuan !!}
                                </div>
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->analisis_penyebab }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->akibat }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->kategori_temuan }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                            @if(!empty($row->rencana_tindakan_perbaikan_auditee) && $row->rencana_tindakan_perbaikan_auditee != '-')
                                <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-2 [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-2 [&_li]:mb-1 [&_strong]:font-semibold [&_em]:italic [&_u]:underline [&_table]:w-full [&_table]:border-collapse [&_td]:border [&_td]:p-2 [&_th]:border [&_th]:p-2 [&_th]:font-semibold">
                                    {!! $row->rencana_tindakan_perbaikan_auditee !!}
                                </div>
                            @else
                                <span class="italic text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->tanggal_target_perbaikan_auditee }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                            @if(!empty($row->tindakan_pencegahan_auditee) && $row->tindakan_pencegahan_auditee != '-')
                                <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-2 [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-2 [&_li]:mb-1 [&_strong]:font-semibold [&_em]:italic [&_u]:underline [&_table]:w-full [&_table]:border-collapse [&_td]:border [&_td]:p-2 [&_th]:border [&_th]:p-2 [&_th]:font-semibold">
                                    {!! $row->tindakan_pencegahan_auditee !!}
                                </div>
                            @else
                                <span class="italic text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->file_auditee }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $row->tanggal_selesai }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                            <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                {{ ucfirst($row->status_ncr) }}
                            </span>
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