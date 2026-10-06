@props(['mahasiswa'])

@php
    $prefix = 'pddiktiMahasiswa';
    $totalMahasiswa = ($mahasiswa ?? collect())->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalMahasiswa) $perPageOptions[] = $opt;
    }
    if ($totalMahasiswa > 0) $perPageOptions[] = $totalMahasiswa;
    $defaultPerPage = $totalMahasiswa > 10 ? 10 : ($totalMahasiswa > 0 ? $totalMahasiswa : 10);
@endphp

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">DTPS | Mahasiswa | Data Mahasiswa Prodi</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data mahasiswa yang terdaftar</p>
        </div>
        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            View Only
        </span>
    </div>

    {{-- Toolbar: Info + Per Page --}}
    @if($totalMahasiswa > 0)
    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 
                bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="{{ $prefix }}TotalDisplay">
                Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalMahasiswa }}</span> data
            </span>
        </div>
        <div class="flex items-center gap-2">
            <label for="{{ $prefix }}PerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="{{ $prefix }}PerPage" class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                @foreach($perPageOptions as $option)
                    @php
                        $isAll = $option === $totalMahasiswa;
                        $isSelected = $option === $defaultPerPage;
                    @endphp
                    <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                        @if($isAll && $totalMahasiswa > 100) Semua ({{ $totalMahasiswa }})
                        @elseif($isAll) Semua
                        @else {{ $option }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    {{-- TABLE SCROLL CONTAINER --}}
    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div id="{{ $prefix }}TableScroll" class="overflow-auto" style="max-height: 600px;">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Tahun Akademik
                        </th>
                        <th colspan="7" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Jumlah Mahasiswa
                        </th>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Jumlah Lulusan Akhir TA
                        </th>
                    </tr>
                    <tr>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-6</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-5</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-4</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-3</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-2</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-1</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900">
                    @forelse($mahasiswa ?? [] as $item)
                    <tr class="{{ $prefix }}-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90 no">
                            {{ $item->tahun_akademik ?? '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_6 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_5 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_4 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_3 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_2 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_1 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->lulusan_akhir_ta ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr id="{{ $prefix }}EmptyState">
                        <td colspan="10" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Mahasiswa</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data mahasiswa akan muncul di sini setelah ditambahkan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Controls --}}
    <div id="{{ $prefix }}PaginationContainer" class="mt-4"></div>
</div>

@push('scripts')
<script>
// ============================================================
//  PDDIKTI MAHASISWA PAGINATION (Client-side, tanpa reload)
// ============================================================
(function() {
    'use strict';

    const PREFIX = '{{ $prefix }}';
    const state = {
        currentPage: 1,
        perPage: {{ $defaultPerPage }},
        totalData: {{ $totalMahasiswa }}
    };

    function getRows() {
        return Array.from(document.querySelectorAll('.' + PREFIX + '-row'));
    }

    function render() {
        const allRows = getRows();
        state.totalData = allRows.length;

        const totalDisplay = document.getElementById(PREFIX + 'TotalDisplay');
        if (totalDisplay) {
            totalDisplay.innerHTML = `Total: <span class="font-semibold text-gray-800 dark:text-gray-200">${state.totalData}</span> data`;
        }

        const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
        if (state.currentPage > totalPages) state.currentPage = totalPages;
        if (state.currentPage < 1) state.currentPage = 1;

        const startIndex = (state.currentPage - 1) * state.perPage;
        const endIndex = Math.min(startIndex + state.perPage, state.totalData);

        allRows.forEach((row, index) => {
            if (index >= startIndex && index < endIndex) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        const emptyRow = document.getElementById(PREFIX + 'EmptyState');
        if (emptyRow) emptyRow.style.display = state.totalData === 0 ? '' : 'none';

        renderControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
    }

    function renderControls(currentPage, totalPages, totalData, from, to) {
        const container = document.getElementById(PREFIX + 'PaginationContainer');
        if (!container) return;
        if (totalData === 0) { container.innerHTML = ''; return; }

        const fromDisplay = from + 1;
        let html = `
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 
                        bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-3">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan <span class="font-semibold text-gray-700 dark:text-gray-300">${fromDisplay}</span>
                    sampai <span class="font-semibold text-gray-700 dark:text-gray-300">${to}</span>
                    dari <span class="font-semibold text-gray-700 dark:text-gray-300">${totalData}</span> data
                </div>
        `;

        if (totalPages > 1) {
            html += `<nav class="flex items-center gap-1">`;
            html += `<button type="button" data-page="${currentPage - 1}" ${currentPage <= 1 ? 'disabled' : ''}
                class="pagination-btn inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                    ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>`;

            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

            if (startPage > 1) {
                html += createBtn(1, currentPage);
                if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
            }
            for (let i = startPage; i <= endPage; i++) html += createBtn(i, currentPage);
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
                html += createBtn(totalPages, currentPage);
            }

            html += `<button type="button" data-page="${currentPage + 1}" ${currentPage >= totalPages ? 'disabled' : ''}
                class="pagination-btn inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                    ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button></nav>`;
        }
        html += `</div>`;
        container.innerHTML = html;

        container.querySelectorAll('.pagination-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                goToPage(parseInt(this.getAttribute('data-page')));
            });
        });
    }

    function createBtn(page, currentPage) {
        const isActive = page === currentPage;
        return `<button type="button" data-page="${page}"
            class="pagination-btn inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            ${page}
        </button>`;
    }

    function goToPage(page) {
        const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
        if (page < 1 || page > totalPages || page === state.currentPage) return;
        state.currentPage = page;
        render();
        document.getElementById(PREFIX + 'TableScroll')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function init() {
        const perPageSelect = document.getElementById(PREFIX + 'PerPage');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                state.perPage = parseInt(this.value);
                state.currentPage = 1;
                render();
            });
        }
        render();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
@endpush