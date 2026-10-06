@props([
    'dokumenMou'
])

@php
    $totalMou = ($dokumenMou ?? collect())->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalMou) $perPageOptions[] = $opt;
    }
    if ($totalMou > 0) $perPageOptions[] = $totalMou;
    $defaultPerPage = $totalMou > 10 ? 10 : ($totalMou > 0 ? $totalMou : 10);
@endphp

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Kerjasama MoU / MoA</h4>
        <button type="button" class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800" onclick="openModal('modalMou')">
            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah
        </button>
    </div>

    {{-- Toolbar: Info + Per Page --}}
    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 
                bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="mouTotalDisplay">
                Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalMou }}</span> data
            </span>
        </div>
        <div class="flex items-center gap-2">
            <label for="mouPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="mouPerPage" class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                @if($totalMou > 0)
                    @foreach($perPageOptions as $option)
                        @php
                            $isAll = $option === $totalMou;
                            $isSelected = $option === $defaultPerPage;
                        @endphp
                        <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                            @if($isAll && $totalMou > 100) Semua ({{ $totalMou }})
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
        <div id="mouTableScroll" class="overflow-auto" style="max-height: 600px;" data-url="{{ route('prodi.identitas-prodi') }}">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">No</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Nama Dokumen</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">File</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Tgl Penetapan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Tgl Berakhir</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Sisa Kadaluarsa</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Tingkat</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-center text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody id="mouTableBody">
                    @forelse($dokumenMou ?? [] as $item)
                    <tr class="mou-row border-b border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-2 no">{{ $loop->iteration }}</td>

                        <td class="px-4 py-2">
                            {{ $item->nama_dokumen }}
                        </td>

                        <td class="px-4 py-2">
                            <a href="{{ Storage::url($item->file) }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400">
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
                                    $selisihHari = $hariIni->diffInDays($tanggalBerakhir, false);
                                    
                                    $diff = $hariIni->diff($tanggalBerakhir);
                                    $tahun = $diff->y;
                                    $bulan = $diff->m;
                                    $hari = $diff->d;
                                    
                                    $isExpired = $selisihHari < 0;
                                    $isToday = $selisihHari === 0;
                                @endphp

                                @if($isToday)
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300">
                                        Kadaluarsa hari ini
                                    </span>
                                @elseif($isExpired)
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-300">
                                        @php
                                            $expiredText = [];
                                            if ($tahun > 0) $expiredText[] = $tahun . ' tahun';
                                            if ($bulan > 0) $expiredText[] = $bulan . ' bulan';
                                            if ($hari > 0) $expiredText[] = $hari . ' hari';
                                            $expiredText = implode(' ', $expiredText) ?: '0 hari';
                                        @endphp
                                        Kadaluarsa {{ $expiredText }} lalu
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700 dark:bg-green-900/30 dark:text-green-300">
                                        @php
                                            $remainingText = [];
                                            if ($tahun > 0) $remainingText[] = $tahun . ' tahun';
                                            if ($bulan > 0) $remainingText[] = $bulan . ' bulan';
                                            if ($hari > 0) $remainingText[] = $hari . ' hari';
                                            $remainingText = implode(' ', $remainingText) ?: '0 hari';
                                        @endphp
                                        {{ $remainingText }} lagi
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>

                        <td class="px-4 py-2">
                            {{ $item->keterangan ?? '-' }}
                        </td>

                        <td class="px-4 py-2 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button"
                                    onclick="openEditModal(
                                        'modalMou',
                                        {{ $item->id }},
                                        '{{ $item->nama_dokumen }}',
                                        '{{ $item->tanggal_penetapan }}',
                                        '{{ $item->tanggal_revisi }}',
                                        '{{ $item->keterangan }}'
                                    )"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>

                                <button type="button"
                                    onclick="deleteDokumen({{ $item->id }}, '#mouTableScroll')"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="mouEmptyState">
                        <td colspan="8" class="text-center py-4 text-gray-500">
                            Belum ada data MoU.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Controls --}}
    <div id="mouPaginationContainer" class="mt-4"></div>
</div>

<!-- Modal MOU -->
<div id="modalMou" 
     tabindex="-1" 
     class="modal-overlay fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 p-4" 
     style="backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);"
     data-table-id="#mouTableScroll"
     onclick="event.stopPropagation();">
    <div class="relative mx-auto max-w-md top-20" onclick="event.stopPropagation();">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800" onclick="event.stopPropagation();">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah MoU</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 text-sm dark:hover:bg-gray-700 dark:hover:text-white" onclick="closeModal('modalMou')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6">
                <form action="{{ route('prodi.identitas-prodi.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="kategori" value="MOU">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" required class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Dokumen</label>
                        <input type="file" name="file" required class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        <small class="text-xs text-gray-500">*Wajib untuk tambah, kosongkan jika tidak ingin mengganti file saat edit</small>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penetapan</label>
                        <input type="text" name="tanggal_penetapan" required class="datepicker mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Berakhir</label>
                        <input type="text" name="tanggal_revisi" class="datepicker mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat (Wilayah/Lokal, nasional, internasional)</label>
                        <textarea name="keterangan" rows="2" class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" class="mr-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700" onclick="closeModal('modalMou')">
                            Batal
                        </button>

                        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// ============================================================
//  MOU PAGINATION (Client-side, tanpa reload)
// ============================================================
window.mouPaginationState = {
    currentPage: 1,
    perPage: {{ $defaultPerPage }},
    totalData: {{ $totalMou }}
};

document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('mouPerPage');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            window.mouPaginationState.perPage = parseInt(this.value);
            window.mouPaginationState.currentPage = 1;
            renderMouPagination();
        });
    }
    renderMouPagination();
});

window.renderMouPagination = function() {
    const state = window.mouPaginationState;
    const allRows = Array.from(document.querySelectorAll('.mou-row'));
    state.totalData = allRows.length;

    const totalDisplay = document.getElementById('mouTotalDisplay');
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

    const emptyRow = document.getElementById('mouEmptyState');
    if (emptyRow) emptyRow.style.display = state.totalData === 0 ? '' : 'none';

    renderMouPaginationControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

function renderMouPaginationControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('mouPaginationContainer');
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
        html += `<button type="button" onclick="goToMouPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createMouPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createMouPageButton(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
            html += createMouPageButton(totalPages, currentPage);
        }

        html += `<button type="button" onclick="goToMouPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }
    html += `</div>`;
    container.innerHTML = html;
}

function createMouPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToMouPage(${page})"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
        ${page}
    </button>`;
}

window.goToMouPage = function(page) {
    const state = window.mouPaginationState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (page < 1 || page > totalPages || page === state.currentPage) return;
    state.currentPage = page;
    renderMouPagination();
    document.getElementById('mouTableScroll')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};
</script>
@endpush