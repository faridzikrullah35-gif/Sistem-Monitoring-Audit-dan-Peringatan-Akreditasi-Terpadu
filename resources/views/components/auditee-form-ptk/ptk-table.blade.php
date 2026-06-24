<div class="overflow-x-auto rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
    <table class="min-w-[3400px] w-full border-separate border-spacing-0 text-sm">
        <thead class="bg-gray-50 dark:bg-gray-800/50">
            <tr>
                <th class="whitespace-nowrap border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">No. NCR</th>
                <th class="w-[550px] border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Indikator</th>
                <th class="w-[450px] border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Klausul / Dokumen</th>
                <th class="border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400"
                    style="min-width: 400px; max-width: 800px; width: auto;">
                    Deskripsi / Uraian Temuan
                </th>
                <th class="w-[650px] border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Analisis Penyebab</th>
                <th class="w-[650px] border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Akibat</th>
                <th class="whitespace-nowrap border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Kategori</th>
                <th class="w-[500px] border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Rencana Tindakan Perbaikan<br><span class="font-normal text-gray-400 dark:text-gray-500">(Auditee)</span></th>
                <th class="whitespace-nowrap border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Target Perbaikan</th>
                <th class="w-[500px] border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Tindakan Pencegahan<br><span class="font-normal text-gray-400 dark:text-gray-500">(Auditee)</span></th>
                <th class="whitespace-nowrap border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">File</th>
                <th class="whitespace-nowrap border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Tgl Selesai</th>
                <th class="whitespace-nowrap border-b px-4 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Status</th>
                <th class="whitespace-nowrap border-b px-4 py-4 text-center text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(item, index) in paginated" :key="item.id">
                <tr class="border-b border-gray-100 align-top transition hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-900/40">
                    <td class="whitespace-nowrap px-4 py-4 text-gray-700 dark:text-gray-200" x-text="item.no_ncr || '-'"></td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-200"><div class="line-clamp-4 leading-relaxed" x-text="item.pertanyaan_ami_prodi?.isi_indikator?.indikator || '-'"></div></td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-200"><div class="line-clamp-4 leading-relaxed" x-text="item.klausul_dokumen || '-'"></div></td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-200">
                        <div class="line-clamp-4 break-words whitespace-normal leading-relaxed" 
                            x-html="item.deskripsi_uraian_temuan || '-'">
                        </div>
                    </td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-200"><div class="line-clamp-4 leading-relaxed" x-text="item.audit_periksa?.analisis_penyebab || '-'"></div></td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-200"><div class="line-clamp-4 leading-relaxed" x-text="item.audit_periksa?.akibat || '-'"></div></td>
                    <td class="whitespace-nowrap px-4 py-4">
                        <span :class="{
                            'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400': item.kategori_temuan === 'Mayor',
                            'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400': item.kategori_temuan === 'Minor'
                        }" class="inline-flex rounded-full px-3 py-1 text-xs font-medium" x-text="item.kategori_temuan"></span>
                    </td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-200" x-text="item.rencana_tindakan_perbaikan_auditee || '-'"></td>
                    <td class="whitespace-nowrap px-4 py-4 text-gray-700 dark:text-gray-200" x-text="item.tanggal_target_perbaikan_auditee || '-'"></td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-200" x-html="item.tindakan_pencegahan_auditee || '-'"></td>
                    <td class="whitespace-nowrap px-4 py-4 text-gray-700 dark:text-gray-200" x-text="item.file_auditee || '-'"></td>
                    <td class="whitespace-nowrap px-4 py-4 text-gray-700 dark:text-gray-200" x-text="item.tanggal_selesai || '-'"></td>
                    <td class="whitespace-nowrap px-4 py-4">
                        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400" x-text="item.status_ncr"></span>
                    </td>
                    <td class="whitespace-nowrap px-4 py-4 text-center">
                        <button @click="$dispatch('open-ptk-modal', item)" 
                            class="inline-flex items-center gap-2 rounded-lg bg-yellow-100 px-3 py-2 text-sm font-medium text-yellow-700 transition hover:bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400 dark:hover:bg-yellow-900/50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                            </svg>
                            Edit
                        </button>
                    </td>
                </tr>
            </template>
            <tr x-show="filtered.length === 0">
                <td colspan="14" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>Tidak ada data PTK.</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="flex flex-col items-center justify-between gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800 sm:flex-row">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan <span x-text="startIndex"></span> - <span x-text="endIndex"></span> dari <span x-text="filtered.length"></span> data
        </div>
        <div class="flex gap-2">
            <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1" class="rounded border border-gray-300 bg-white px-3 py-1 text-gray-700 disabled:opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:disabled:opacity-50">Prev</button>
            <template x-for="page in totalPages" :key="page">
                <button @click="changePage(page)" :class="page === currentPage ? 'bg-black text-white dark:bg-white dark:text-black' : 'border border-gray-300 bg-white text-gray-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300'" class="rounded px-3 py-1" x-text="page"></button>
            </template>
            <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages" class="rounded border border-gray-300 bg-white px-3 py-1 text-gray-700 disabled:opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:disabled:opacity-50">Next</button>
        </div>
    </div>
</div>