@props([
    'tendikFakultas' => [],
    'tendikProdi'    => [],
    'prodi'          => [],
])

@php
    $totalAll = ($tendikFakultas ?? collect())->count() + ($tendikProdi ?? collect())->count();
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
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Data Tendik</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data tenaga kependidikan Fakultas & Prodi</p>
        </div>
        <div class="flex items-center gap-2">
            <select id="filterProdiTendik"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterTendikByProdi(this.value)">
                <option value="fakultas">Data Fakultas</option>
                <option value="all">Semua Prodi</option>
                @foreach($prodi as $p)
                    <option value="prodi-{{ $p->id }}">{{ $p->sub_unit ?? $p->name }}</option>
                @endforeach
            </select>

            <button type="button" onclick="openModalTendik()"
                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 dark:bg-blue-500 dark:hover:bg-blue-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Menampilkan: <span id="tendikDataInfoLabel" class="font-semibold text-gray-800 dark:text-gray-200">Data Fakultas</span>
            &middot; Total: <span id="tendikTotalDisplay" class="font-semibold text-gray-800 dark:text-gray-200">0</span> data
        </div>
        <div class="flex items-center gap-2">
            <label for="tendikPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="tendikPerPage"
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
        <div id="tendikTableScroll" class="overflow-auto" style="max-height: 600px;">
            <table id="sdmtendikTableContainer" class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50">
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 w-12">No</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 min-w-[160px]">Prodi</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 min-w-[180px]">Nama</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Posisi / Jabatan</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Terhitung Mulai Tgl</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Latar Pendidikan</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Sertifikasi</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">SK Pegawai Tetap</th>
                        <th class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 w-24">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tendikTableBody" class="bg-white dark:bg-gray-900">

                    {{-- DATA FAKULTAS --}}
                    @forelse($tendikFakultas ?? [] as $item)
                    <tr class="tendik-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="fakultas"
                        data-user-id="{{ $item->users_id }}"
                        data-id="{{ $item->id }}">
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium">
                            <span class="inline-flex items-center whitespace-nowrap rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">Fakultas</span>
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
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 posisi">{{ $item->posisi ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 tmt">
                            {{ $item->terhitung_mulai_tanggal ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 latar-pendidikan">{{ $item->latar_pendidikan ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sertifikasi">
                            @php $isYa = ($item->sertifikasi ?? 'Tidak') === 'Ya'; @endphp
                            <span class="inline-flex items-center rounded-full {{ $isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }} px-2.5 py-0.5 text-xs font-medium">
                                {{ $item->sertifikasi ?? 'Tidak' }}
                            </span>
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sk-pegawai">{{ $item->sk_pegawai_tetap ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center align-top">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button" onclick="openModalTendik({{ $item->id }})"
                                    class="btn-edit-tendik inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30"
                                    title="Edit" data-id="{{ $item->id }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/></svg> Edit
                                </button>
                                <button type="button" onclick="deleteTendikProdi({{ $item->id }})"
                                    class="btn-delete-tendik-prodi inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30"
                                    title="Hapus" data-id="{{ $item->id }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="tendik-empty fakultas-empty">
                        <td colspan="9" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Tendik Fakultas</h3>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- DATA PRODI --}}
                    @forelse($tendikProdi ?? [] as $item)
                    <tr class="tendik-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="prodi"
                        data-user-id="{{ $item->users_id }}"
                        data-id="{{ $item->id }}">
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ optional($item->user)->sub_unit ?? '-' }}
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
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 posisi">{{ $item->posisi ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 tmt">
                            {{ $item->terhitung_mulai_tanggal ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 latar-pendidikan">{{ $item->latar_pendidikan ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sertifikasi">
                            @php $isYa = ($item->sertifikasi ?? 'Tidak') === 'Ya'; @endphp
                            <span class="inline-flex items-center rounded-full {{ $isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }} px-2.5 py-0.5 text-xs font-medium">
                                {{ $item->sertifikasi ?? 'Tidak' }}
                            </span>
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sk-pegawai">{{ $item->sk_pegawai_tetap ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center align-top">
                            <span class="inline-flex items-center whitespace-nowrap rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">Read-only</span>
                        </td>
                    </tr>
                    @empty
                    <tr class="tendik-empty prodi-empty" style="display:none;">
                        <td colspan="9" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Tendik Prodi</h3>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="tendikPaginationContainer" class="mt-4"></div>
</div>

@push('scripts')
<script>
window.tendikPaginationState = { currentPage: 1, perPage: {{ $defaultPerPage }}, filter: 'fakultas', totalData: 0 };

window.filterTendikByProdi = function(value) {
    window.tendikPaginationState.filter = value;
    window.tendikPaginationState.currentPage = 1;
    renderTendikPagination();
};

function getVisibleTendikRows() {
    const s = window.tendikPaginationState;
    const all = Array.from(document.querySelectorAll('.tendik-row'));
    if (s.filter === 'fakultas') return all.filter(r => r.dataset.source === 'fakultas');
    if (s.filter === 'all')      return all.filter(r => r.dataset.source === 'prodi');
    if (s.filter.startsWith('prodi-')) {
        const pid = String(s.filter.replace('prodi-', '')).trim();
        return all.filter(r => r.dataset.source === 'prodi' && String(r.dataset.userId).trim() === pid);
    }
    return [];
}

window.renderTendikPagination = function() {
    const s = window.tendikPaginationState;
    const allRows = Array.from(document.querySelectorAll('.tendik-row'));
    allRows.forEach(r => r.style.display = 'none');

    const visible = getVisibleTendikRows();
    s.totalData = visible.length;

    const infoLabel = document.getElementById('tendikDataInfoLabel');
    const totalDisplay = document.getElementById('tendikTotalDisplay');
    if (totalDisplay) totalDisplay.textContent = s.totalData;
    if (s.filter === 'fakultas') infoLabel.textContent = 'Data Fakultas';
    else if (s.filter === 'all') infoLabel.textContent = 'Semua Prodi';
    else if (s.filter.startsWith('prodi-')) {
        const opt = document.querySelector(`#filterProdiTendik option[value="${s.filter}"]`);
        infoLabel.textContent = opt ? opt.textContent : 'Prodi';
    }

    const totalPages = Math.ceil(s.totalData / s.perPage) || 1;
    if (s.currentPage > totalPages) s.currentPage = totalPages;
    if (s.currentPage < 1) s.currentPage = 1;

    const startIndex = (s.currentPage - 1) * s.perPage;
    const endIndex   = Math.min(startIndex + s.perPage, s.totalData);

    visible.forEach((row, idx) => {
        if (idx >= startIndex && idx < endIndex) {
            row.style.display = '';
            const td = row.querySelector('td.no');
            if (td) td.textContent = idx + 1;
        }
    });

    const fakEmpty = document.querySelector('.tendik-empty.fakultas-empty');
    const prodiEmpty = document.querySelector('.tendik-empty.prodi-empty');
    if (fakEmpty) fakEmpty.style.display = (s.filter === 'fakultas' && s.totalData === 0) ? '' : 'none';
    if (prodiEmpty) prodiEmpty.style.display = (s.filter !== 'fakultas' && s.totalData === 0) ? '' : 'none';

    renderTendikControls(s.currentPage, totalPages, s.totalData, startIndex, endIndex);
};

function renderTendikControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('tendikPaginationContainer');
    if (!container) return;
    if (totalData === 0) { container.innerHTML = ''; return; }

    const fromDisplay = from + 1;
    let html = `
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-3">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan <span class="font-semibold text-gray-700 dark:text-gray-300">${fromDisplay}</span>
                sampai <span class="font-semibold text-gray-700 dark:text-gray-300">${to}</span>
                dari <span class="font-semibold text-gray-700 dark:text-gray-300">${totalData}</span> data
            </div>`;

    if (totalPages > 1) {
        html += `<nav class="flex items-center gap-1">`;
        html += `<button type="button" onclick="goToTendikPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createTendikPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createTendikPageButton(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
            html += createTendikPageButton(totalPages, currentPage);
        }
        html += `<button type="button" onclick="goToTendikPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }
    html += `</div>`;
    container.innerHTML = html;
}

function createTendikPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToTendikPage(${page})"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
        ${page}
    </button>`;
}

window.goToTendikPage = function(page) {
    const s = window.tendikPaginationState;
    const totalPages = Math.ceil(s.totalData / s.perPage) || 1;
    if (page < 1 || page > totalPages || page === s.currentPage) return;
    s.currentPage = page;
    renderTendikPagination();
    document.getElementById('sdmtendikTableContainer')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

document.addEventListener('DOMContentLoaded', function() {
    const sel = document.getElementById('tendikPerPage');
    if (sel) sel.addEventListener('change', function() {
        window.tendikPaginationState.perPage = parseInt(this.value);
        window.tendikPaginationState.currentPage = 1;
        renderTendikPagination();
    });
    window.tendikPaginationState.filter = 'fakultas';
    renderTendikPagination();
});
</script>
@endpush