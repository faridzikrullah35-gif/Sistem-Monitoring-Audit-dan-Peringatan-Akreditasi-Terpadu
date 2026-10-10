@props([
    'lulusanFakultas' => [],
    'lulusanProdi'    => [],
    'prodi'           => [],
])

@php
    $totalAll = ($lulusanFakultas ?? collect())->count() + ($lulusanProdi ?? collect())->count();
    $baseOptions = [5, 10, 25, 50, 100];
    $perPageOptions = [];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalAll) $perPageOptions[] = $opt;
    }
    if ($totalAll > 0) $perPageOptions[] = $totalAll;
    $defaultPerPage = $totalAll > 10 ? 10 : ($totalAll > 0 ? $totalAll : 10);
@endphp

<div>
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Data Lulusan per Tahun</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data lulusan Fakultas & Prodi</p>
        </div>
        <div class="flex items-center gap-2">
            <select id="filterProdiLulusanPd"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterLulusanPdByProdi(this.value)">
                <option value="fakultas">Data Fakultas</option>
                <option value="all">Semua Prodi</option>
                @foreach($prodi as $p)
                    <option value="prodi-{{ $p->id }}">{{ $p->sub_unit ?? $p->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Menampilkan: <span id="lulusanPdDataInfoLabel" class="font-semibold text-gray-800 dark:text-gray-200">Data Fakultas</span>
            &middot; Total: <span id="lulusanPdTotalDisplay" class="font-semibold text-gray-800 dark:text-gray-200">0</span> data
        </div>
        <div class="flex items-center gap-2">
            <label for="lulusanPdPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="lulusanPdPerPage"
                class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                @if($totalAll > 0)
                    @foreach($perPageOptions as $option)
                        @php
                            $isAll = $option === $totalAll;
                            $isSelected = $option === $defaultPerPage;
                        @endphp
                        <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                            @if($isAll && $totalAll > 100) Semua ({{ $totalAll }})
                            @elseif($isAll) Semua
                            @else {{ $option }}
                            @endif
                        </option>
                    @endforeach
                @else
                    <option value="10">10</option>
                @endif
            </select>
        </div>
    </div>

    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div id="lulusanPdTableScroll" class="overflow-auto" style="max-height: 600px;">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50">
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">No</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Prodi</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">TA-3</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">TA-2</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">TA-1</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">TA</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Persentase Penurunan</th>
                    </tr>
                </thead>
                <tbody id="lulusanPdTableBody" class="bg-white dark:bg-gray-900">

                    {{-- DATA FAKULTAS --}}
                    @forelse($lulusanFakultas ?? [] as $item)
                    <tr class="lulusan-pd-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="fakultas"
                        data-user-id="{{ $item->users_id }}">
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">Fakultas</span>
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_3 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_2 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_1 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm font-medium">
                            @php
                                $penurunan = $item->persentase_penurunan ?? 0;
                                $warna = $penurunan > 50 ? 'text-red-600 dark:text-red-400' : ($penurunan > 25 ? 'text-yellow-600 dark:text-yellow-400' : 'text-green-600 dark:text-green-400');
                            @endphp
                            <span class="{{ $warna }}">{{ number_format($penurunan, 2) }}%</span>
                        </td>
                    </tr>
                    @empty
                    <tr class="lulusan-pd-empty fakultas-empty">
                        <td colspan="7" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Lulusan Fakultas</h3>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- DATA PRODI --}}
                    @forelse($lulusanProdi ?? [] as $item)
                    <tr class="lulusan-pd-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="prodi"
                        data-user-id="{{ $item->users_id }}">
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ optional($item->user)->sub_unit ?? $item->nama_prodi ?? '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_3 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_2 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta_1 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300">{{ $item->ta ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm font-medium">
                            @php
                                $penurunan = $item->persentase_penurunan ?? 0;
                                $warna = $penurunan > 50 ? 'text-red-600 dark:text-red-400' : ($penurunan > 25 ? 'text-yellow-600 dark:text-yellow-400' : 'text-green-600 dark:text-green-400');
                            @endphp
                            <span class="{{ $warna }}">{{ number_format($penurunan, 2) }}%</span>
                        </td>
                    </tr>
                    @empty
                    <tr class="lulusan-pd-empty prodi-empty" style="display:none;">
                        <td colspan="7" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Lulusan Prodi</h3>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="lulusanPdPaginationContainer" class="mt-4"></div>
</div>

@push('scripts')
<script>
window.lulusanPdState = { currentPage: 1, perPage: {{ $defaultPerPage }}, filter: 'fakultas', totalData: 0 };

window.filterLulusanPdByProdi = function(value) {
    window.lulusanPdState.filter = value;
    window.lulusanPdState.currentPage = 1;
    renderLulusanPdPagination();
};

function getVisibleLulusanPdRows() {
    const state = window.lulusanPdState;
    const allRows = Array.from(document.querySelectorAll('.lulusan-pd-row'));
    if (state.filter === 'fakultas') return allRows.filter(r => r.dataset.source === 'fakultas');
    if (state.filter === 'all')      return allRows.filter(r => r.dataset.source === 'prodi');
    if (state.filter.startsWith('prodi-')) {
        const pid = String(state.filter.replace('prodi-', '')).trim();
        return allRows.filter(r => r.dataset.source === 'prodi' && String(r.dataset.userId).trim() === pid);
    }
    return [];
}

window.renderLulusanPdPagination = function() {
    const state = window.lulusanPdState;
    const allRows = Array.from(document.querySelectorAll('.lulusan-pd-row'));
    allRows.forEach(r => r.style.display = 'none');

    const visible = getVisibleLulusanPdRows();
    state.totalData = visible.length;

    const totalDisplay = document.getElementById('lulusanPdTotalDisplay');
    const infoLabel = document.getElementById('lulusanPdDataInfoLabel');
    if (totalDisplay) totalDisplay.textContent = state.totalData;
    if (state.filter === 'fakultas') infoLabel.textContent = 'Data Fakultas';
    else if (state.filter === 'all') infoLabel.textContent = 'Semua Prodi';
    else if (state.filter.startsWith('prodi-')) {
        const opt = document.querySelector(`#filterProdiLulusanPd option[value="${state.filter}"]`);
        infoLabel.textContent = opt ? opt.textContent : 'Prodi';
    }

    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (state.currentPage > totalPages) state.currentPage = totalPages;
    if (state.currentPage < 1) state.currentPage = 1;

    const startIndex = (state.currentPage - 1) * state.perPage;
    const endIndex   = Math.min(startIndex + state.perPage, state.totalData);

    visible.forEach((row, idx) => {
        if (idx >= startIndex && idx < endIndex) {
            row.style.display = '';
            const td = row.querySelector('td.no');
            if (td) td.textContent = idx + 1;
        }
    });

    const fakEmpty = document.querySelector('.lulusan-pd-empty.fakultas-empty');
    const prodiEmpty = document.querySelector('.lulusan-pd-empty.prodi-empty');
    if (fakEmpty) fakEmpty.style.display = (state.filter === 'fakultas' && state.totalData === 0) ? '' : 'none';
    if (prodiEmpty) prodiEmpty.style.display = (state.filter !== 'fakultas' && state.totalData === 0) ? '' : 'none';

    renderLulusanPdControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

function renderLulusanPdControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('lulusanPdPaginationContainer');
    if (!container) return;
    if (totalData === 0) { container.innerHTML = ''; return; }

    const fromDisplay = from + 1;
    let html = `<div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-3">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan <span class="font-semibold text-gray-700 dark:text-gray-300">${fromDisplay}</span>
            sampai <span class="font-semibold text-gray-700 dark:text-gray-300">${to}</span>
            dari <span class="font-semibold text-gray-700 dark:text-gray-300">${totalData}</span> data
        </div>`;

    if (totalPages > 1) {
        html += `<nav class="flex items-center gap-1">`;
        html += `<button type="button" onclick="goToLulusanPdPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createLulusanPdPageBtn(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createLulusanPdPageBtn(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
            html += createLulusanPdPageBtn(totalPages, currentPage);
        }
        html += `<button type="button" onclick="goToLulusanPdPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }
    html += `</div>`;
    container.innerHTML = html;
}

function createLulusanPdPageBtn(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToLulusanPdPage(${page})"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
        ${page}
    </button>`;
}

window.goToLulusanPdPage = function(page) {
    const state = window.lulusanPdState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (page < 1 || page > totalPages || page === state.currentPage) return;
    state.currentPage = page;
    renderLulusanPdPagination();
    document.getElementById('lulusanPdTableScroll')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

document.addEventListener('DOMContentLoaded', function() {
    const sel = document.getElementById('lulusanPdPerPage');
    if (sel) sel.addEventListener('change', function() {
        window.lulusanPdState.perPage = parseInt(this.value);
        window.lulusanPdState.currentPage = 1;
        renderLulusanPdPagination();
    });
    window.lulusanPdState.filter = 'fakultas';
    renderLulusanPdPagination();
});

// ============================================================
//  HANDLE PRINT PD DIKTI LULUSAN FAKULTAS (filter-aware)
// ============================================================
window.handlePrintPdDiktiLulusan = function(event) {
    if (event) event.preventDefault();

    const state = window.lulusanPdState || {};
    const filterSource = state.filter || 'fakultas';

    const baseUrl = '{{ route("fakultas.profile-pd-dikti.lulusan.print") }}';
    const params = new URLSearchParams();
    if (filterSource) params.append('filter_source', filterSource);

    const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
    window.open(url, '_blank');
    return false;
};
</script>
@endpush