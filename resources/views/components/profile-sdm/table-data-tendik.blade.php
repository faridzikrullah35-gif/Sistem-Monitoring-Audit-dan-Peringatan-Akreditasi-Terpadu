@php
    $totalTendik = ($tendik ?? collect())->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    
    foreach ($baseOptions as $opt) {
        if ($opt < $totalTendik) $perPageOptions[] = $opt;
    }
    if ($totalTendik > 0) $perPageOptions[] = $totalTendik;
    
    $defaultPerPage = $totalTendik > 10 ? 10 : ($totalTendik > 0 ? $totalTendik : 10);
@endphp

<div>
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Data Tendik</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data tenaga kependidikan yang terdaftar</p>
        </div>
        <div class="flex items-center gap-2">
            {{-- Tombol Print --}}
            <a href="{{ route('prodi.profile-sdm.tendik.print') }}"
            target="_blank"
            class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition-all duration-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print
            </a>

            {{-- Tombol Tambah --}}
            <button
                type="button"
                onclick="openModalTendik()"
                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 dark:bg-blue-500 dark:hover:bg-blue-600"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    {{-- Toolbar: Info + Per Page --}}
    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 
                bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="tendikTotalDisplay">
                Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalTendik }}</span> data
            </span>
        </div>
        <div class="flex items-center gap-2">
            <label for="tendikPerPage" class="text-sm text-gray-500 dark:text-gray-400">
                Tampilkan:
            </label>
            <select 
                id="tendikPerPage" 
                class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 
                       focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 
                       dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
            >
                @if($totalTendik > 0)
                    @foreach($perPageOptions as $option)
                        @php
                            $isAll = $option === $totalTendik;
                            $isSelected = $option === $defaultPerPage;
                        @endphp
                        <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                            @if($isAll && $totalTendik > 100)
                                Semua ({{ $totalTendik }})
                            @elseif($isAll)
                                Semua
                            @else
                                {{ $option }}
                            @endif
                        </option>
                    @endforeach
                @else
                    <option value="10">10</option>
                @endif
            </select>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- TABLE SCROLL CONTAINER                                       --}}
    {{-- Solusi: container overflow-auto + sticky di setiap <th>      --}}
    {{-- ============================================================ --}}
    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">

        <div
            id="tendikTableScroll"
            class="overflow-auto"
            style="max-height: 600px;"
        >
            <table id="sdmtendikTableContainer" class="w-full border-collapse text-sm">
                
                {{-- HEADER --}}
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50">
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 w-12">
                            No
                        </th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 min-w-[180px]">
                            Nama
                        </th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Posisi / Jabatan
                        </th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Terhitung Mulai Tgl
                        </th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Latar Pendidikan
                        </th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Sertifikasi
                        </th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            SK Pegawai Tetap
                        </th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 w-24">
                            Aksi
                        </th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody id="tendikTableBody" class="bg-white dark:bg-gray-900">
                    @forelse($tendik ?? [] as $index => $item)
                    <tr id="tendikRow-{{ $item->id }}" 
                        class="tendik-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-id="{{ $item->id }}">
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90 nama">
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                                    <svg class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                                {{ $item->nama ?? '-' }}
                            </div>
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 posisi">
                            {{ $item->posisi ?? '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 tmt">
                            {{ $item->terhitung_mulai_tanggal ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 latar-pendidikan">
                            {{ $item->latar_pendidikan ?? '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sertifikasi">
                            @php $isYa = ($item->sertifikasi ?? 'Tidak') === 'Ya'; @endphp
                            <span class="inline-flex items-center rounded-full {{ $isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }} px-2.5 py-0.5 text-xs font-medium">
                                <span class="mr-1.5 inline-block h-1.5 w-1.5 rounded-full {{ $isYa ? 'bg-green-600 dark:bg-green-400' : 'bg-red-600 dark:bg-red-400' }}"></span>
                                {{ $item->sertifikasi ?? 'Tidak' }}
                            </span>
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sk-pegawai">
                            {{ $item->sk_pegawai_tetap ?? '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-center align-top">
                            <div class="flex items-center justify-center gap-1.5">
                                {{-- Tombol Edit --}}
                                <button
                                    type="button"
                                    onclick="openModalTendik({{ $item->id }})"
                                    class="btn-edit-tendik inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30"
                                    title="Edit"
                                    data-id="{{ $item->id }}"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                                    </svg>
                                    Edit
                                </button>

                                {{-- Tombol Hapus --}}
                                <button
                                    type="button"
                                    onclick="deleteTendikProdi({{ $item->id }})"
                                    class="btn-delete-tendik-prodi inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30"
                                    title="Hapus"
                                    data-id="{{ $item->id }}"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyStateTendikRow">
                        <td colspan="8" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Tendik</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data tenaga kependidikan akan muncul di sini setelah ditambahkan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
    {{-- /TABLE SCROLL CONTAINER --}}

    {{-- Pagination Controls --}}
    <div id="tendikPaginationContainer" class="mt-4"></div>
</div>

@push('scripts')
<script>
// ============================================================
//  TENDIK PAGINATION (Client-side, tanpa reload)
// ============================================================
window.tendikPaginationState = {
    currentPage: 1,
    perPage: {{ $defaultPerPage }},
    totalData: {{ $totalTendik }}
};

document.addEventListener('DOMContentLoaded', function() {
    initTendikPagination();
});

function initTendikPagination() {
    const perPageSelect = document.getElementById('tendikPerPage');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            window.tendikPaginationState.perPage = parseInt(this.value);
            window.tendikPaginationState.currentPage = 1;
            renderTendikPagination();
        });
    }
    renderTendikPagination();
}

window.renderTendikPagination = function() {
    const state = window.tendikPaginationState;
    const allRows = Array.from(document.querySelectorAll('.tendik-row'));

    state.totalData = allRows.length;

    const totalDisplay = document.getElementById('tendikTotalDisplay');
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

    handleTendikEmptyState(state.totalData);
    renderTendikPaginationControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

function handleTendikEmptyState(totalCount) {
    const emptyStateRow = document.getElementById('emptyStateTendikRow');
    if (emptyStateRow) {
        emptyStateRow.style.display = totalCount === 0 ? '' : 'none';
    }
}

function renderTendikPaginationControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('tendikPaginationContainer');
    if (!container) return;

    if (totalData === 0) {
        container.innerHTML = '';
        return;
    }

    const fromDisplay = from + 1;
    const toDisplay = to;

    let html = `
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 
                    bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-3">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan <span class="font-semibold text-gray-700 dark:text-gray-300">${fromDisplay}</span>
                sampai <span class="font-semibold text-gray-700 dark:text-gray-300">${toDisplay}</span>
                dari <span class="font-semibold text-gray-700 dark:text-gray-300">${totalData}</span> data
            </div>
    `;

    if (totalPages > 1) {
        html += `<nav class="flex items-center gap-1" aria-label="Pagination">`;

        // Prev
        html += `
            <button type="button" onclick="goToTendikPage(${currentPage - 1})"
                ${currentPage <= 1 ? 'disabled' : ''}
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                    ${currentPage <= 1 
                        ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' 
                        : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-200'}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
        `;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        if (startPage > 1) {
            html += createTendikPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
        }

        for (let i = startPage; i <= endPage; i++) {
            html += createTendikPageButton(i, currentPage);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
            html += createTendikPageButton(totalPages, currentPage);
        }

        // Next
        html += `
            <button type="button" onclick="goToTendikPage(${currentPage + 1})"
                ${currentPage >= totalPages ? 'disabled' : ''}
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                    ${currentPage >= totalPages 
                        ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' 
                        : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-200'}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        `;

        html += `</nav>`;
    }

    html += `</div>`;
    container.innerHTML = html;
}

function createTendikPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `
        <button type="button" onclick="goToTendikPage(${page})"
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${isActive 
                    ? 'bg-blue-600 text-white shadow-sm' 
                    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-200'}">
            ${page}
        </button>
    `;
}

window.goToTendikPage = function(page) {
    const state = window.tendikPaginationState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;

    if (page < 1 || page > totalPages || page === state.currentPage) return;

    state.currentPage = page;
    renderTendikPagination();

    const container = document.getElementById('sdmtendikTableContainer');
    if (container) {
        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};
</script>
@endpush