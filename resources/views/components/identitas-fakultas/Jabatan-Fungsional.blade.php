@props([
    'jabatanProdi' => [],
    'prodi'        => [],
])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Jabatan Fungsional</h4>

        <div class="flex items-center gap-2">
            <select
                id="filterProdiJabatan"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterJabatanByProdi(this.value)"
            >
                <option value="all">Semua Prodi</option>
                @foreach($prodi as $p)
                    <option value="prodi-{{ $p->id }}">{{ $p->sub_unit ?? $p->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 text-xs text-gray-500 dark:text-gray-400">
        Menampilkan: <span id="jabatanDataInfoLabel" class="font-medium text-gray-700 dark:text-gray-200">Semua Prodi</span>
    </div>

    <div id="jabatanTableContainer" class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-center w-[50px]">No</th>
                    <th class="px-4 py-3 min-w-[140px]">Prodi</th>
                    <th class="px-4 py-3 min-w-[110px]">Asisten Ahli</th>
                    <th class="px-4 py-3 min-w-[100px]">Lektor</th>
                    <th class="px-4 py-3 min-w-[120px]">Lektor Kepala</th>
                    <th class="px-4 py-3 min-w-[110px]">Guru Besar</th>
                    <th class="px-4 py-3 min-w-[90px]">Total</th>
                </tr>
            </thead>
            <tbody id="jabatanTableBodyProdi">
                @forelse($jabatanProdi ?? [] as $item)
                    @php
                        $asisten = (int) ($item->jumlah_asisten_ahli ?? 0);
                        $lektor  = (int) ($item->jumlah_lektor ?? 0);
                        $lekKep  = (int) ($item->jumlah_lektor_kepala ?? 0);
                        $guruB   = (int) ($item->jumlah_guru_besar ?? 0);
                        $total   = $asisten + $lektor + $lekKep + $guruB;
                        $userId  = optional($item->user)->id;
                    @endphp
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                        data-user-id="{{ $userId }}">
                        <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">{{ $loop->iteration }}</span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">{{ optional($item->user)->sub_unit ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $asisten }}</td>
                        <td class="px-4 py-3">{{ $lektor }}</td>
                        <td class="px-4 py-3">{{ $lekKep }}</td>
                        <td class="px-4 py-3">{{ $guruB }}</td>
                        <td class="px-4 py-3 font-semibold text-gray-800 dark:text-white">{{ $total }}</td>
                    </tr>
                @empty
                <tr class="empty-row-prodi">
                    <td colspan="7" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data Jabatan Fungsional Prodi</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function filterJabatanByProdi(value) {
    const tbody    = document.getElementById('jabatanTableBodyProdi');
    const infoLabel = document.getElementById('jabatanDataInfoLabel');

    tbody.querySelectorAll('tr[data-user-id]').forEach(tr => tr.style.display = '');

    if (value === 'all') {
        infoLabel.textContent = 'Semua Prodi';
        const hasData = tbody.querySelectorAll('tr[data-user-id]').length > 0;
        const emptyRow = tbody.querySelector('.empty-row-prodi');
        if (emptyRow) emptyRow.style.display = hasData ? 'none' : '';
    } else if (value.startsWith('prodi-')) {
        const prodiId = String(value.replace('prodi-', '')).trim();
        let visibleCount = 0;

        tbody.querySelectorAll('tr[data-user-id]').forEach(tr => {
            const rowUserId = String(tr.getAttribute('data-user-id') || '').trim();
            if (rowUserId === prodiId) {
                tr.style.display = '';
                visibleCount++;
            } else {
                tr.style.display = 'none';
            }
        });

        const emptyRow = tbody.querySelector('.empty-row-prodi');
        if (emptyRow) emptyRow.style.display = visibleCount > 0 ? 'none' : '';

        const selectedOpt = document.querySelector(`#filterProdiJabatan option[value="${value}"]`);
        infoLabel.textContent = selectedOpt ? selectedOpt.textContent : 'Prodi';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    filterJabatanByProdi('all');
});
</script>