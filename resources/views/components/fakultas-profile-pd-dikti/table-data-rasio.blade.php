@props([
    'rasioFakultas' => [],
    'rasioProdi'    => [],
    'prodi'         => [],
])

@php
    $totalAll = ($rasioFakultas ?? collect())->count() + ($rasioProdi ?? collect())->count();
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
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Rasio Dosen Terhadap Mahasiswa</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data rasio Fakultas & Prodi</p>
        </div>
        <div class="flex items-center gap-2">
            <select id="filterProdiRasioPd"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterRasioPdByProdi(this.value)">
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
            Menampilkan: <span id="rasioPdDataInfoLabel" class="font-semibold text-gray-800 dark:text-gray-200">Data Fakultas</span>
            &middot; Total: <span id="rasioPdTotalDisplay" class="font-semibold text-gray-800 dark:text-gray-200">0</span> data
        </div>
        <div class="flex items-center gap-2">
            <label for="rasioPdPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="rasioPdPerPage"
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
        <div id="rasioPdTableScroll" class="overflow-auto" style="max-height: 600px;">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50">
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">No</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Prodi</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Tahun Akademik</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Jumlah Dosen Tetap</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Jumlah Mahasiswa</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Rasio</th>
                    </tr>
                </thead>
                <tbody id="rasioPdTableBody" class="bg-white dark:bg-gray-900">

                    {{-- DATA FAKULTAS --}}
                    @forelse($rasioFakultas ?? [] as $item)
                    <tr class="rasio-pd-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="fakultas"
                        data-user-id="{{ $item->users_id }}">
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">Fakultas</span>
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->tahun_akademik ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->jumlah_dosen ?? 0 }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->jumlah_mahasiswa ?? 0 }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">1 : {{ number_format($item->rasio ?? 0, 2) }}</td>
                    </tr>
                    @empty
                    <tr class="rasio-pd-empty fakultas-empty">
                        <td colspan="6" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Rasio Fakultas</h3>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- DATA PRODI --}}
                    @forelse($rasioProdi ?? [] as $item)
                    <tr class="rasio-pd-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="prodi"
                        data-user-id="{{ $item->users_id }}">
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ optional($item->user)->sub_unit ?? '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->tahun_akademik ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->jumlah_dosen_tetap ?? 0 }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->jumlah_mahasiswa ?? 0 }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">1 : {{ number_format($item->rasio ?? 0, 2) }}</td>
                    </tr>
                    @empty
                    <tr class="rasio-pd-empty prodi-empty" style="display:none;">
                        <td colspan="6" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Rasio Prodi</h3>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="rasioPdPaginationContainer" class="mt-4"></div>
</div>

@push('scripts')
<script>
window.rasioPdState = { currentPage: 1, perPage: {{ $defaultPerPage }}, filter: 'fakultas', totalData: 0 };

window.filterRasioPdByProdi = function(value) {
    window.rasioPdState.filter = value;
    window.rasioPdState.currentPage = 1;
    renderRasioPdPagination();
};

function getVisibleRasioPdRows() {
    const state = window.rasioPdState;
    const allRows = Array.from(document.querySelectorAll('.rasio-pd-row'));
    if (state.filter === 'fakultas') return allRows.filter(r => r.dataset.source === 'fakultas');
    if (state.filter === 'all')      return allRows.filter(r => r.dataset.source === 'prodi');
    if (state.filter.startsWith('prodi-')) {
        const pid = String(state.filter.replace('prodi-', '')).trim();
        return allRows.filter(r => r.dataset.source === 'prodi' && String(r.dataset.userId).trim() === pid);
    }
    return [];
}

window.renderRasioPdPagination = function() {
    const state = window.rasioPdState;
    const allRows = Array.from(document.querySelectorAll('.rasio-pd-row'));
    allRows.forEach(r => r.style.display = 'none');

    const visible = getVisibleRasioPdRows();
    state.totalData = visible.length;

    const totalDisplay = document.getElementById('rasioPdTotalDisplay');
    const infoLabel = document.getElementById('rasioPdDataInfoLabel');
    if (totalDisplay) totalDisplay.textContent = state.totalData;
    if (state.filter === 'fakultas') infoLabel.textContent = 'Data Fakultas';
    else if (state.filter === 'all') infoLabel.textContent = 'Semua Prodi';
    else if (state.filter.startsWith('prodi-')) {
        const opt = document.querySelector(`#filterProdiRasioPd option[value="${state.filter}"]`);
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

    const fakEmpty = document.querySelector('.rasio-pd-empty.fakultas-empty');
    const prodiEmpty = document.querySelector('.rasio-pd-empty.prodi-empty');
    if (fakEmpty) fakEmpty.style.display = (state.filter === 'fakultas' && state.totalData === 0) ? '' : 'none';
    if (prodiEmpty) prodiEmpty.style.display = (state.filter !== 'fakultas' && state.totalData === 0) ? '' : 'none';

    renderRasioPdControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

function renderRasioPdControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('rasioPdPaginationContainer');
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
        html += `<button type="button" onclick="goToRasioPdPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createRasioPdPageBtn(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createRasioPdPageBtn(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
            html += createRasioPdPageBtn(totalPages, currentPage);
        }
        html += `<button type="button" onclick="goToRasioPdPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }
    html += `</div>`;
    container.innerHTML = html;
}

function createRasioPdPageBtn(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToRasioPdPage(${page})"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
        ${page}
    </button>`;
}

window.goToRasioPdPage = function(page) {
    const state = window.rasioPdState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (page < 1 || page > totalPages || page === state.currentPage) return;
    state.currentPage = page;
    renderRasioPdPagination();
    document.getElementById('rasioPdTableScroll')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

document.addEventListener('DOMContentLoaded', function() {
    const sel = document.getElementById('rasioPdPerPage');
    if (sel) sel.addEventListener('change', function() {
        window.rasioPdState.perPage = parseInt(this.value);
        window.rasioPdState.currentPage = 1;
        renderRasioPdPagination();
    });
    window.rasioPdState.filter = 'fakultas';
    renderRasioPdPagination();
});
</script>
@endpush