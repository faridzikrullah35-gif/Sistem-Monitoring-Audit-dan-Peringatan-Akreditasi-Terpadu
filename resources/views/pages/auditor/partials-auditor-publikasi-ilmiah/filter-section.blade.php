@props([
    'publikasi',
    'tahunList',
])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
    <div class="p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3 flex-wrap">
                <label for="filterTahunAkademik" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter Tahun Akademik:
                </label>

                <select
                    id="filterTahunAkademik"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>

                <button
                    type="button"
                    onclick="resetFilterPublikasi()"
                    class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span id="totalDataDisplay">Total: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $publikasi->count() }}</span> data</span>
                </div>

                @if($publikasi->count() > 0)
                    <div class="text-xs text-gray-400 dark:text-gray-500">
                        <span id="visibleDataDisplay">Menampilkan: <span class="font-semibold text-gray-600 dark:text-gray-400">{{ $publikasi->count() }}</span></span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterSelect = document.getElementById('filterTahunAkademik');
    const rows = document.querySelectorAll('.publikasi-row');
    const totalDisplay = document.getElementById('totalDataDisplay');
    const visibleDisplay = document.getElementById('visibleDataDisplay');

    // Filter function
    window.filterPublikasiTable = function() {
        if (!filterSelect) return;

        const selectedTahun = filterSelect.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const tahun = row.dataset.tahun;
            if (selectedTahun === '' || tahun === selectedTahun) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update nomor urut
        let counter = 1;
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const td = row.querySelector('td:first-child');
                if (td) {
                    td.textContent = counter++;
                }
            }
        });

        // Update total data
        if (totalDisplay) {
            const total = rows.length;
            const span = totalDisplay.querySelector('.font-semibold');
            if (span) span.textContent = total;
        }

        // Update visible data
        if (visibleDisplay) {
            const span = visibleDisplay.querySelector('.font-semibold');
            if (span) span.textContent = visibleCount;
        }

        // Handle empty state
        const tbody = document.getElementById('publikasiTableBody');
        const emptyStateRow = document.getElementById('emptyStateRow');
        const hasData = rows.length > 0;
        const hasVisible = visibleCount > 0;

        if (hasData && !hasVisible) {
            const existingEmpty = tbody.querySelector('.filter-empty-row');
            if (existingEmpty) existingEmpty.remove();

            const tr = document.createElement('tr');
            tr.className = 'filter-empty-row';
            tr.innerHTML = `
                <td colspan="12" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada data untuk tahun <span class="font-semibold">${selectedTahun}</span></p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Ubah filter atau reset untuk melihat semua data</p>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);

            if (emptyStateRow) emptyStateRow.style.display = 'none';
        } else if (hasVisible) {
            const filteredEmpty = tbody.querySelector('.filter-empty-row');
            if (filteredEmpty) filteredEmpty.remove();

            if (emptyStateRow && rows.length === 0) {
                emptyStateRow.style.display = '';
            } else if (emptyStateRow) {
                emptyStateRow.style.display = 'none';
            }
        } else if (!hasData && !hasVisible) {
            if (emptyStateRow) emptyStateRow.style.display = '';
            const filteredEmpty = tbody.querySelector('.filter-empty-row');
            if (filteredEmpty) filteredEmpty.remove();
        }
    };

    if (filterSelect) {
        filterSelect.addEventListener('change', window.filterPublikasiTable);
    }

    setTimeout(window.filterPublikasiTable, 100);
});

// Reset filter
window.resetFilterPublikasi = function() {
    const filterSelect = document.getElementById('filterTahunAkademik');
    if (filterSelect) {
        filterSelect.value = '';
        filterSelect.dispatchEvent(new Event('change'));
    }
};
</script>
@endpush