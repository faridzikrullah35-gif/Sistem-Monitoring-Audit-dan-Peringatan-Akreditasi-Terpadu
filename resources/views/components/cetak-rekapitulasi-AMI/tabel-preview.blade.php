<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 border text-sm">
        <thead class="bg-gray-50">
            <tr><th class="px-3 py-2 text-left font-medium text-gray-700">No</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">No. NCR</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Tgl. Audit</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Bagian</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Macam Temuan</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Uraian Temuan</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Tgl. Target Perbaikan</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Tgl. Verifikasi</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Auditor</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Status</th>
                <th class="px-3 py-2 text-left font-medium text-gray-700">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(item, idx) in dataRekap" :key="idx">
                <tr>
                    <td class="px-3 py-2" x-text="idx+1"></td>
                    <td class="px-3 py-2" x-text="item.no_ncr"></td>
                    <td class="px-3 py-2" x-text="item.tgl_audit"></td>
                    <td class="px-3 py-2" x-text="item.bagian"></td>
                    <td class="px-3 py-2" x-text="item.macam_temuan"></td>
                    <td class="px-3 py-2" x-text="item.uraian_temuan"></td>
                    <td class="px-3 py-2" x-text="item.tgl_target_perbaikan"></td>
                    <td class="px-3 py-2" x-text="item.tgl_verifikasi"></td>
                    <td class="px-3 py-2" x-text="item.auditor"></td>
                    <td class="px-3 py-2" x-text="item.status"></td>
                    <td class="px-3 py-2" x-text="item.keterangan"></td>
                </tr>
            </template>
        </tbody>
    </table>
</div>