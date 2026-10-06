@props(['sarpras' => []])

@php
    $prefix = 'sarprasAuditor';
    $totalSarpras = ($sarpras ?? collect())->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalSarpras) $perPageOptions[] = $opt;
    }
    if ($totalSarpras > 0) $perPageOptions[] = $totalSarpras;
    $defaultPerPage = $totalSarpras > 10 ? 10 : ($totalSarpras > 0 ? $totalSarpras : 10);
@endphp

<div
    id="sarprasAuditorTableContainer"
    class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden"
>
    {{-- ============================================================ --}}
    {{-- TOOLBAR: Info + Per Page                                     --}}
    {{-- ============================================================ --}}
    @if($totalSarpras > 0)
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 
                bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700 px-4 py-3">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="{{ $prefix }}TotalDisplay">
                Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalSarpras }}</span> data
            </span>
        </div>
        <div class="flex items-center gap-2">
            <label for="{{ $prefix }}PerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="{{ $prefix }}PerPage" class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                @foreach($perPageOptions as $option)
                    @php
                        $isAll = $option === $totalSarpras;
                        $isSelected = $option === $defaultPerPage;
                    @endphp
                    <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                        @if($isAll && $totalSarpras > 100) Semua ({{ $totalSarpras }})
                        @elseif($isAll) Semua
                        @else {{ $option }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    {{-- ============================================================ --}}
    {{-- TABLE SCROLL CONTAINER                                       --}}
    {{-- ============================================================ --}}
    <div class="relative w-full">
        <div id="{{ $prefix }}TableScroll" class="overflow-auto" style="max-height: 600px;">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                {{-- ==================== HEADER ==================== --}}
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 whitespace-nowrap w-12">
                            No
                        </th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 min-w-[150px]">
                            Kode
                        </th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 min-w-[200px]">
                            Nama Sarana Prasarana
                        </th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 whitespace-nowrap w-32">
                            Status
                        </th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 whitespace-nowrap w-24">
                            Jumlah
                        </th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 whitespace-nowrap w-32">
                            Dibuat Oleh
                        </th>
                    </tr>
                </thead>

                {{-- ==================== BODY ==================== --}}
                <tbody id="sarprasAuditorTableBody" class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($sarpras as $item)
                    <tr
                        class="{{ $prefix }}-row hover:bg-gray-50 dark:hover:bg-gray-700/50 transition align-top"
                        data-id="{{ $item->id }}"
                    >
                        {{-- No --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white text-center align-top no">
                            {{ $loop->iteration }}
                        </td>

                        {{-- KODE --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <span class="font-medium text-gray-900 dark:text-white">
                                {{ $item->kode }}
                            </span>
                        </td>

                        {{-- NAMA SARANA PRASARANA --}}
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            {{ $item->nama_sarpras }}
                        </td>

                        {{-- STATUS --}}
                        <td class="whitespace-nowrap px-4 py-4 align-top">
                            @php
                                $statusColors = [
                                    'baik' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                    'rusak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                    'perbaikan' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                ];
                                $statusColor = $statusColors[strtolower($item->status)] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400';
                            @endphp
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusColor }}">
                                {{ $item->status }}
                            </span>
                        </td>

                        {{-- JUMLAH --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 text-center align-top">
                            {{ $item->jumlah }}
                        </td>

                        {{-- DIBUAT OLEH --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                            {{ $item->user->name ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr id="{{ $prefix }}EmptyState">
                        <td colspan="6" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                    <svg
                                        class="h-8 w-8 text-gray-400 dark:text-gray-500"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                                        />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Belum Ada Data Sarana Prasarana
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Tidak ada data sarana prasarana untuk unit/sub unit Anda.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- PAGINATION CONTROLS                                          --}}
    {{-- ============================================================ --}}
    <div id="{{ $prefix }}PaginationContainer" class="border-t border-gray-200 dark:border-gray-700 px-4 py-3"></div>
</div>

@push('scripts')
<script>
// ============================================================
//  SARPRAS AUDITOR PAGINATION (Client-side, tanpa reload)
// ============================================================
(function() {
    'use strict';

    const PREFIX = '{{ $prefix }}';
    const state = {
        currentPage: 1,
        perPage: {{ $defaultPerPage }},
        totalData: {{ $totalSarpras }}
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
                const td = row.querySelector('td.no');
                if (td) td.textContent = index + 1;
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
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
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

<script>
    // ============================================================
    // REFRESH FUNCTION UNTUK TABEL SARPRAS AUDITOR
    // (terdaftar di window supaya bisa dipanggil dari luar)
    // ============================================================
    if (typeof window.refreshSarprasAuditorTable === 'undefined') {
        window.refreshSarprasAuditorTable = function() {
            if (typeof window.refreshTable === 'function') {
                window.refreshTable('#sarprasAuditorTableContainer');
            }
        };
    }
</script>
@endpush