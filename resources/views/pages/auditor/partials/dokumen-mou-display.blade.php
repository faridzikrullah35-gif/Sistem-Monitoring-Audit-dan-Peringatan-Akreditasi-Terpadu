@props(['title', 'dokumen'])

@php
    $prefix = 'moudisplay';
    $totalDokumen = ($dokumen ?? collect())->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalDokumen) $perPageOptions[] = $opt;
    }
    if ($totalDokumen > 0) $perPageOptions[] = $totalDokumen;
    $defaultPerPage = $totalDokumen > 10 ? 10 : ($totalDokumen > 0 ? $totalDokumen : 10);
@endphp

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h4>

        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
            <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7z"/>
            </svg>
            View Only
        </span>
    </div>

    {{-- Toolbar: Info + Per Page --}}
    @if($totalDokumen > 0)
    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 
                bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="{{ $prefix }}TotalDisplay">
                Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalDokumen }}</span> data
            </span>
        </div>
        <div class="flex items-center gap-2">
            <label for="{{ $prefix }}PerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="{{ $prefix }}PerPage" class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                @foreach($perPageOptions as $option)
                    @php
                        $isAll = $option === $totalDokumen;
                        $isSelected = $option === $defaultPerPage;
                    @endphp
                    <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                        @if($isAll && $totalDokumen > 100) Semua ({{ $totalDokumen }})
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
            <table class="w-full border-collapse text-left text-sm text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">No</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Nama Dokumen</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">File</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Tgl Penetapan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Tgl Berakhir</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">Sisa Kadaluarsa</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            Tingkat (Wilayah/Lokal, nasional, internasional)
                        </th>
                    </tr>
                </thead>

                <tbody id="{{ $prefix }}TableBody">
                    @forelse($dokumen ?? [] as $item)
                        <tr class="{{ $prefix }}-row border-b border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-2 no">{{ $loop->iteration }}</td>

                            <td class="px-4 py-2">
                                {{ $item->nama_dokumen }}
                            </td>

                            <td class="px-4 py-2">
                                <a href="{{ Storage::url($item->file) }}" target="_blank"
                                    class="inline-flex items-center gap-1.5 text-blue-600 hover:underline dark:text-blue-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download PDF
                                </a>
                            </td>

                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($item->tanggal_penetapan)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-2">
                                {{ $item->tanggal_revisi ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y') : '-' }}
                            </td>

                            <td class="px-4 py-2">
                                @if($item->tanggal_revisi)
                                    @php
                                        $tanggalBerakhir = \Carbon\Carbon::parse($item->tanggal_revisi)->startOfDay();
                                        $hariIni = \Carbon\Carbon::today();

                                        /*
                                        * Hitung selisih berdasarkan kalender:
                                        * Tahun → Bulan → Hari
                                        */
                                        if ($hariIni->lt($tanggalBerakhir)) {
                                            $diff = $hariIni->diff($tanggalBerakhir);

                                            $tahun = $diff->y;
                                            $bulan = $diff->m;
                                            $hari = $diff->d;

                                            $parts = [];

                                            if ($tahun > 0) {
                                                $parts[] = $tahun . ' tahun';
                                            }

                                            if ($bulan > 0) {
                                                $parts[] = $bulan . ' bulan';
                                            }

                                            if ($hari > 0) {
                                                $parts[] = $hari . ' hari';
                                            }

                                            $sisaWaktu = !empty($parts)
                                                ? implode(' ', $parts)
                                                : 'Hari ini';
                                        } elseif ($hariIni->eq($tanggalBerakhir)) {
                                            $sisaWaktu = 'Hari ini';
                                        } else {
                                            $diff = $tanggalBerakhir->diff($hariIni);

                                            $tahun = $diff->y;
                                            $bulan = $diff->m;
                                            $hari = $diff->d;

                                            $parts = [];

                                            if ($tahun > 0) {
                                                $parts[] = $tahun . ' tahun';
                                            }

                                            if ($bulan > 0) {
                                                $parts[] = $bulan . ' bulan';
                                            }

                                            if ($hari > 0) {
                                                $parts[] = $hari . ' hari';
                                            }

                                            $sisaWaktu = !empty($parts)
                                                ? implode(' ', $parts)
                                                : '0 hari';
                                        }
                                    @endphp

                                    @if($hariIni->lt($tanggalBerakhir))
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700 dark:bg-green-900/30 dark:text-green-300">
                                            {{ $sisaWaktu }} lagi
                                        </span>

                                    @elseif($hariIni->eq($tanggalBerakhir))
                                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300">
                                            Kadaluarsa hari ini
                                        </span>

                                    @else
                                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-300">
                                            Kadaluarsa {{ $sisaWaktu }} lalu
                                        </span>
                                    @endif

                                @else
                                    <span class="text-gray-400 dark:text-gray-500">-</span>
                                @endif
                            </td>

                            <td class="px-4 py-2">
                                {{ $item->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr id="{{ $prefix }}EmptyState">
                            <td colspan="7" class="py-8 text-center text-gray-400 dark:text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="mb-3 h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012 2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    <span class="text-sm font-medium">Belum ada data {{ $title }}</span>
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
//  MOU DISPLAY PAGINATION (Client-side, tanpa reload)
// ============================================================
(function() {
    'use strict';

    const PREFIX = '{{ $prefix }}';
    const state = {
        currentPage: 1,
        perPage: {{ $defaultPerPage }},
        totalData: {{ $totalDokumen }}
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