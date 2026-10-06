@php
    $totalMahasiswa = ($mahasiswa ?? collect())->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalMahasiswa) $perPageOptions[] = $opt;
    }
    if ($totalMahasiswa > 0) $perPageOptions[] = $totalMahasiswa;
    $defaultPerPage = $totalMahasiswa > 10 ? 10 : ($totalMahasiswa > 0 ? $totalMahasiswa : 10);
@endphp

<div>
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">DTPS | Mahasiswa | Data Mahasiswa Prodi</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data mahasiswa yang terdaftar</p>
        </div>
        <div class="flex items-center gap-2">
            <button
                type="button"
                onclick="openModalMahasiswa()"
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
            <span id="mahasiswaTotalDisplay">
                Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalMahasiswa }}</span> data
            </span>
        </div>
        <div class="flex items-center gap-2">
            <label for="mahasiswaPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select 
                id="mahasiswaPerPage" 
                class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 
                       focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 
                       dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
            >
                @if($totalMahasiswa > 0)
                    @foreach($perPageOptions as $option)
                        @php
                            $isAll = $option === $totalMahasiswa;
                            $isSelected = $option === $defaultPerPage;
                        @endphp
                        <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                            @if($isAll && $totalMahasiswa > 100)
                                Semua ({{ $totalMahasiswa }})
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

    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div id="mahasiswaTableScroll" class="overflow-auto" style="max-height: 600px;">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50">
                        {{-- KOLOM NO (BARU) --}}
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 w-12">
                            No
                        </th>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Tahun Akademik
                        </th>
                        <th colspan="7" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Jumlah Mahasiswa
                        </th>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Jumlah Lulusan Akhir TA
                        </th>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                            Aksi
                        </th>
                    </tr>
                    <tr class="bg-gray-50 dark:bg-gray-900/50">
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-6</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-5</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-4</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-3</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-2</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA-1</th>
                        <th class="sticky z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px;">TA</th>
                    </tr>
                </thead>
                <tbody id="mahasiswaTableBody" class="bg-white dark:bg-gray-900">
                    @forelse($mahasiswa ?? [] as $item)
                    <tr id="mahasiswaRow-{{ $item->id }}" 
                        class="mahasiswa-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-id="{{ $item->id }}">
                        {{-- KOLOM NO (BARU) --}}
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90 tahun-akademik">
                            {{ $item->tahun_akademik ?? '-' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-6">{{ $item->ta_6 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-5">{{ $item->ta_5 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-4">{{ $item->ta_4 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-3">{{ $item->ta_3 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-2">{{ $item->ta_2 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-1">{{ $item->ta_1 ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta">{{ $item->ta ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 lulusan-akhir">{{ $item->lulusan_akhir_ta ?? '-' }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center align-top">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button" class="btn-edit-mahasiswa inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30" title="Edit" data-id="{{ $item->id }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                                    </svg> Edit
                                </button>
                                <button type="button" class="btn-delete-mahasiswa inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30" title="Hapus" data-id="{{ $item->id }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyStateMahasiswaRow">
                        {{-- COLSPAN NAIK DARI 10 → 11 --}}
                        <td colspan="11" class="border border-gray-400 px-4 py-10 text-center">
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
    <div id="mahasiswaPaginationContainer" class="mt-4"></div>
</div>

@push('scripts')
<script>
// ============================================================
//  MAHASISWA PAGINATION (Client-side, tanpa reload)
// ============================================================
window.mahasiswaPaginationState = {
    currentPage: 1,
    perPage: {{ $defaultPerPage }},
    totalData: {{ $totalMahasiswa }}
};

document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('mahasiswaPerPage');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            window.mahasiswaPaginationState.perPage = parseInt(this.value);
            window.mahasiswaPaginationState.currentPage = 1;
            renderMahasiswaPagination();
        });
    }
    renderMahasiswaPagination();
});

window.renderMahasiswaPagination = function() {
    const state = window.mahasiswaPaginationState;
    const allRows = Array.from(document.querySelectorAll('.mahasiswa-row'));
    state.totalData = allRows.length;

    const totalDisplay = document.getElementById('mahasiswaTotalDisplay');
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
            // UPDATE NOMOR URUT GLOBAL
            const td = row.querySelector('td.no');
            if (td) td.textContent = index + 1;
        } else {
            row.style.display = 'none';
        }
    });

    const emptyRow = document.getElementById('emptyStateMahasiswaRow');
    if (emptyRow) emptyRow.style.display = state.totalData === 0 ? '' : 'none';

    renderMahasiswaPaginationControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

function renderMahasiswaPaginationControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('mahasiswaPaginationContainer');
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
        html += `<button type="button" onclick="goToMahasiswaPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createMahasiswaPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createMahasiswaPageButton(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
            html += createMahasiswaPageButton(totalPages, currentPage);
        }

        html += `<button type="button" onclick="goToMahasiswaPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }
    html += `</div>`;
    container.innerHTML = html;
}

function createMahasiswaPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToMahasiswaPage(${page})"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
        ${page}
    </button>`;
}

window.goToMahasiswaPage = function(page) {
    const state = window.mahasiswaPaginationState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (page < 1 || page > totalPages || page === state.currentPage) return;
    state.currentPage = page;
    renderMahasiswaPagination();
    document.getElementById('mahasiswaTableScroll')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};
</script>
@endpush