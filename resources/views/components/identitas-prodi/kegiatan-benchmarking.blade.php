@props(['kegiatanBenchmarking' => collect()])

@php
    $totalKb = $kegiatanBenchmarking->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalKb) $perPageOptions[] = $opt;
    }
    if ($totalKb > 0) $perPageOptions[] = $totalKb;
    $defaultPerPage = $totalKb > 10 ? 10 : ($totalKb > 0 ? $totalKb : 10);
@endphp

<div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">

    {{-- HEADER --}}
    <div class="mb-5 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Kegiatan Benchmarking</h3>
        </div>
        <button type="button" onclick="openModalKegiatanBenchmarking()" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kegiatan
        </button>
    </div>

    {{-- TOOLBAR: Info + Per Page --}}
    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 
                bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="kbTotalDisplay">
                Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalKb }}</span> data
            </span>
        </div>
        <div class="flex items-center gap-2">
            <label for="kbPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="kbPerPage" class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                @if($totalKb > 0)
                    @foreach($perPageOptions as $option)
                        @php
                            $isAll = $option === $totalKb;
                            $isSelected = $option === $defaultPerPage;
                        @endphp
                        <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                            @if($isAll && $totalKb > 100) Semua ({{ $totalKb }})
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

    {{-- TABEL --}}
    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div id="kbTableScroll" class="overflow-auto" style="max-height: 600px;">
            <table id="kegiatanbenchmarking" class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-300">No</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-300">Laporan Kegiatan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-300">Tanggal Pelaksanaan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-300">Keterangan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-left font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-300">File</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-center font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($kegiatanBenchmarking as $index => $item)
                        <tr class="kb-row">
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300 no">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $item->laporan_kegiatan }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($item->tgl_pelaksanaan)->translatedFormat('d F Y') }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $item->keterangan ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @if ($item->file)
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400 dark:hover:text-blue-300">Lihat File</a>
                                @else
                                    <span class="text-gray-400 dark:text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        onclick="openEditModalKegiatanBenchmarking(
                                            {{ $item->id }},
                                            @js($item->laporan_kegiatan),
                                            @js($item->tgl_pelaksanaan),
                                            @js($item->keterangan),
                                            @js($item->file)
                                        )"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-yellow-100 px-3 py-1.5 text-xs font-semibold text-yellow-700 transition-all duration-200 hover:bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:hover:bg-yellow-900/50"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>

                                    {{-- HAPUS --}}
                                    <button
                                        type="button"
                                        onclick="deleteKegiatanBenchmarking({{ $item->id }})"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition-all duration-200 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="kbEmptyState">
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400 dark:text-gray-500">Belum ada data kegiatan benchmarking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION CONTROLS --}}
    <div id="kbPaginationContainer" class="mt-4"></div>
</div>

{{-- MODAL TAMBAH / EDIT KEGIATAN BENCHMARKING --}}
<div id="modalKegiatanBenchmarking"
     class="modal-overlay fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm dark:bg-black/70"
     data-table-id="#kbTableScroll">
    <div class="w-full max-w-2xl rounded-2xl bg-white shadow-xl dark:bg-gray-800 dark:shadow-black/40">

        {{-- HEADER MODAL --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Tambah Kegiatan Benchmarking</h3>
            <button type="button" onclick="closeModal('modalKegiatanBenchmarking')" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- FORM --}}
        <form id="formKegiatanBenchmarking"
              method="POST"
              action="{{ route('prodi.identitas-prodi.kegiatan-benchmarking.store') }}"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="id" id="kbId">

            <div class="space-y-4 px-6 py-5">
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Laporan Kegiatan <span class="text-red-500 dark:text-red-400">*</span></label>
                    <textarea name="laporan_kegiatan" rows="4" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-900/40" placeholder="Tulis laporan kegiatan benchmarking..."></textarea>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pelaksanaan <span class="text-red-500 dark:text-red-400">*</span></label>
                    <input type="text" name="tgl_pelaksanaan" class="datepicker w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-900/40" placeholder="Pilih tanggal">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500 dark:focus:border-blue-400 dark:focus:ring-blue-900/40" placeholder="Keterangan tambahan (opsional)"></textarea>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">File Lampiran</label>
                    <input type="file" name="file" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 file:mr-3 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-gray-700 hover:file:bg-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-600 dark:focus:border-blue-400 dark:focus:ring-blue-900/40">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, png. Maks 5MB.</p>
                    <div id="existingKbFile"></div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                <button type="button" onclick="closeModal('modalKegiatanBenchmarking')" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">Batal</button>
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// ============================================================
//  KEGIATAN BENCHMARKING PAGINATION (Client-side, tanpa reload)
// ============================================================
window.kbPaginationState = {
    currentPage: 1,
    perPage: {{ $defaultPerPage }},
    totalData: {{ $totalKb }}
};

document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('kbPerPage');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            window.kbPaginationState.perPage = parseInt(this.value);
            window.kbPaginationState.currentPage = 1;
            renderKbPagination();
        });
    }
    renderKbPagination();
});

window.renderKbPagination = function() {
    const state = window.kbPaginationState;
    const allRows = Array.from(document.querySelectorAll('.kb-row'));
    state.totalData = allRows.length;

    const totalDisplay = document.getElementById('kbTotalDisplay');
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

    const emptyRow = document.getElementById('kbEmptyState');
    if (emptyRow) emptyRow.style.display = state.totalData === 0 ? '' : 'none';

    renderKbPaginationControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

function renderKbPaginationControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('kbPaginationContainer');
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
        html += `<button type="button" onclick="goToKbPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createKbPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createKbPageButton(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
            html += createKbPageButton(totalPages, currentPage);
        }

        html += `<button type="button" onclick="goToKbPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }
    html += `</div>`;
    container.innerHTML = html;
}

function createKbPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToKbPage(${page})"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
        ${page}
    </button>`;
}

window.goToKbPage = function(page) {
    const state = window.kbPaginationState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (page < 1 || page > totalPages || page === state.currentPage) return;
    state.currentPage = page;
    renderKbPagination();
    document.getElementById('kbTableScroll')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};
</script>

{{-- SCRIPT LAMA: CRUD, MODAL, DELETE --}}
<script>
    const updateKbRoute = "{{ route('prodi.identitas-prodi.kegiatan-benchmarking.update', ['id' => '__ID__']) }}";
    const KB_TABLE_SELECTOR = '#kbTableScroll';

    // ======================================================
    // OPEN MODAL TAMBAH
    // ======================================================
    function openModalKegiatanBenchmarking() {
        const modal = document.getElementById('modalKegiatanBenchmarking');
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('formKegiatanBenchmarking');
        if (!form) return;

        form.reset();
        form.action = "{{ route('prodi.identitas-prodi.kegiatan-benchmarking.store') }}";

        const methodInput = form.querySelector('[name="_method"]');
        if (methodInput) methodInput.value = 'POST';

        const idInput = document.getElementById('kbId');
        if (idInput) idInput.value = '';

        if (typeof resetDatepicker === 'function') resetDatepicker(form);
        if (typeof clearValidationErrors === 'function') clearValidationErrors(form);

        const existing = document.getElementById('existingKbFile');
        if (existing) existing.innerHTML = '';

        const fileInput = form.querySelector('[name="file"]');
        if (fileInput) { fileInput.value = ''; fileInput.required = false; }

        const title = modal.querySelector('h3');
        if (title) title.innerText = 'Tambah Kegiatan Benchmarking';
    }

    // ======================================================
    // OPEN MODAL EDIT
    // ======================================================
    function openEditModalKegiatanBenchmarking(id, laporan, tgl, keterangan, file) {
        const modal = document.getElementById('modalKegiatanBenchmarking');
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('formKegiatanBenchmarking');
        if (!form) return;

        form.action = updateKbRoute.replace('__ID__', id);

        const methodInput = form.querySelector('[name="_method"]');
        if (methodInput) methodInput.value = 'PUT';

        const idInput = document.getElementById('kbId');
        if (idInput) idInput.value = id;

        const laporanInput = form.querySelector('[name="laporan_kegiatan"]');
        if (laporanInput) laporanInput.value = laporan ?? '';

        const keteranganInput = form.querySelector('[name="keterangan"]');
        if (keteranganInput) keteranganInput.value = keterangan ?? '';

        if (typeof setDatepicker === 'function') setDatepicker(form, 'tgl_pelaksanaan', tgl);

        const fileInput = form.querySelector('[name="file"]');
        if (fileInput) { fileInput.value = ''; fileInput.required = false; }

        const existing = document.getElementById('existingKbFile');
        if (existing) {
            if (file) {
                const cleanFile = String(file).replace(/^\/+/, '');
                const fileUrl = "{{ asset('storage') }}/" + cleanFile;
                const fileName = cleanFile.split('/').pop();
                existing.innerHTML = `
                    <div class="mt-2 rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900/40">
                        <div class="flex items-center justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">File saat ini</p>
                                <p class="truncate text-sm text-gray-700 dark:text-gray-300">${fileName}</p>
                            </div>
                            <a href="${fileUrl}" target="_blank" class="shrink-0 rounded-lg bg-blue-50 px-3 py-2 text-xs font-medium text-blue-600 hover:bg-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:hover:bg-blue-500/20">Lihat File</a>
                        </div>
                    </div>
                `;
            } else {
                existing.innerHTML = `<div class="mt-2 text-xs text-gray-500 dark:text-gray-400">Belum ada file.</div>`;
            }
        }

        if (typeof clearValidationErrors === 'function') clearValidationErrors(form);

        const title = modal.querySelector('h3');
        if (title) title.innerText = 'Edit Kegiatan Benchmarking';
    }

    // ======================================================
    // DELETE
    // ======================================================
    function deleteKegiatanBenchmarking(id) {
        const modal = document.getElementById('globalConfirmModal');
        const title = document.getElementById('confirmTitle');
        const message = document.getElementById('confirmMessage');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        const backdrop = document.getElementById('confirmBackdrop');

        if (!modal || !okBtn || !cancelBtn) {
            console.error('[KegiatanBenchmarking] Global confirm modal tidak ditemukan.');
            return;
        }

        if (title) title.textContent = 'Konfirmasi Hapus';
        if (message) message.textContent = 'Yakin ingin menghapus kegiatan benchmarking ini? Tindakan ini tidak dapat dibatalkan.';

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const cleanup = () => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            okBtn.onclick = null;
            cancelBtn.onclick = null;
            if (backdrop) backdrop.onclick = null;
        };

        cancelBtn.onclick = () => cleanup();
        if (backdrop) backdrop.onclick = () => cleanup();

        okBtn.onclick = async () => {
            const originalText = okBtn.innerHTML;
            okBtn.disabled = true;
            cancelBtn.disabled = true;

            okBtn.innerHTML = `
                <span class="inline-flex items-center gap-2">
                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Menghapus...
                </span>
            `;

            const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
            const url = "{{ route('prodi.identitas-prodi.kegiatan-benchmarking.destroy', ['id' => '__ID__']) }}".replace('__ID__', id);

            try {
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });

                let data = {};
                try { data = await response.json(); } catch (error) { data = {}; }

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal menghapus kegiatan benchmarking.');
                }

                cleanup();
                window.toast?.success(data.message || 'Kegiatan benchmarking berhasil dihapus.');

                // Refresh tabel SATU KALI
                if (window.TableRefresh && typeof window.TableRefresh.refresh === 'function') {
                    await window.TableRefresh.refresh(KB_TABLE_SELECTOR);
                    // Re-render pagination setelah refresh
                    if (typeof window.renderKbPagination === 'function') {
                        setTimeout(() => window.renderKbPagination(), 100);
                    }
                } else {
                    window.location.reload();
                }

            } catch (error) {
                console.error('[KegiatanBenchmarking Delete]', error);
                okBtn.disabled = false;
                cancelBtn.disabled = false;
                okBtn.innerHTML = originalText;
                window.toast?.error(error.message || 'Terjadi kesalahan saat menghapus data.');
            }
        };
    }
</script>
@endpush