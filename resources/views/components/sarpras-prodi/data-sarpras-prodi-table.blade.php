@props(['sarpras' => []])

@php
    $totalSarpras = $sarpras->count();
    
    // Generate opsi perPage dinamis
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    
    foreach ($baseOptions as $opt) {
        if ($opt < $totalSarpras) {
            $perPageOptions[] = $opt;
        }
    }
    
    if ($totalSarpras > 0) {
        $perPageOptions[] = $totalSarpras;
    }
    
    $defaultPerPage = $totalSarpras > 10 ? 10 : ($totalSarpras > 0 ? $totalSarpras : 10);
@endphp

{{-- Toolbar: Info + Per Page --}}
<div class="mb-4 flex flex-col sm:flex-row items-center justify-between gap-3 
            bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 px-4 py-3">
    <div class="text-sm text-gray-600 dark:text-gray-400">
        <span id="sarprasTotalDisplay">
            Total: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $totalSarpras }}</span> data
        </span>
    </div>

    <div class="flex items-center gap-2">
        <label for="sarprasPerPage" class="text-sm text-gray-500 dark:text-gray-400">
            Tampilkan:
        </label>
        <select 
            id="sarprasPerPage" 
            class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 
                   focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 
                   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
        >
            @if($totalSarpras > 0)
                @foreach($perPageOptions as $option)
                    @php
                        $isAll = $option === $totalSarpras;
                        $isSelected = $option === $defaultPerPage;
                    @endphp
                    <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                        @if($isAll && $totalSarpras > 100)
                            Semua ({{ $totalSarpras }})
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

{{-- Tabel --}}
<div
    id="sarprasProdiTableContainer"
    class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden"
>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

            {{-- HEADER --}}
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-12">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[150px]">Kode</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">Nama Sarana Prasarana</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-24">Jumlah</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-40">File</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">Dibuat Oleh</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">Aksi</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody id="sarprasProdiTableBody" class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                @forelse($sarpras as $index => $item)
                <tr
                    class="sarpras-row hover:bg-gray-50 dark:hover:bg-gray-700/50 transition align-top"
                    data-id="{{ $item->id }}"
                >
                    {{-- No --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white text-center align-top">
                        {{ $index + 1 }}
                    </td>

                    {{-- KODE --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                        <span class="font-medium text-gray-900 dark:text-white">{{ $item->kode }}</span>
                    </td>

                    {{-- NAMA --}}
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

                    {{-- FILE --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                        @if($item->file_path)
                            <div class="flex items-center gap-2">
                                @if($item->is_image)
                                    <button
                                        onclick="previewImage('{{ $item->file_url }}', '{{ $item->file_name }}')"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1.5 text-xs font-medium text-blue-700 transition-all hover:bg-blue-100 dark:bg-blue-950/30 dark:text-blue-400 dark:hover:bg-blue-900/40"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Lihat Foto
                                    </button>
                                @else
                                    <a href="{{ route('prodi.sarpras.view', $item->id) }}"
                                       class="inline-flex items-center gap-1.5 rounded-lg bg-purple-50 px-2.5 py-1.5 text-xs font-medium text-purple-700 transition-all hover:bg-purple-100 dark:bg-purple-950/30 dark:text-purple-400 dark:hover:bg-purple-900/40"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat File
                                    </a>
                                @endif
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    ({{ $item->formatted_file_size ?? '0 B' }})
                                </span>
                            </div>
                        @else
                            <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                        @endif
                    </td>

                    {{-- DIBUAT OLEH --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                        {{ $item->user->name ?? '-' }}
                    </td>

                    {{-- AKSI --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                        <div class="flex items-center gap-1">
                            <button
                                onclick="openModalFormSarprasProdi('edit', {{ $item->id }})"
                                class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                                title="Edit Data"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit
                            </button>

                            <button
                                type="button"
                                onclick="deleteSarprasProdi({{ $item->id }})"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="sarprasEmptyStateRow">
                    <td colspan="8" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center justify-center text-center">
                            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Sarana Prasarana</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Klik tombol "Tambah Sarana Prasarana" untuk membuat data baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination Controls --}}
<div id="sarprasPaginationContainer" class="mt-4"></div>

{{-- Modal Preview Gambar --}}
<div id="imagePreviewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
    <div class="relative max-w-4xl mx-4">
        <button onclick="closeImagePreview()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="previewImage" src="" alt="Preview" class="max-h-[80vh] w-auto rounded-lg shadow-2xl">
        <p id="previewImageName" class="mt-2 text-center text-sm text-white/80"></p>
    </div>
</div>

@push('scripts')
<script>
// ============================================================
//  PAGINATION STATE
// ============================================================
window.sarprasPaginationState = {
    currentPage: 1,
    perPage: {{ $defaultPerPage }},
    totalData: {{ $totalSarpras }},
};

// ============================================================
//  INIT
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    initSarprasPagination();
});

function initSarprasPagination() {
    const perPageSelect = document.getElementById('sarprasPerPage');
    
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            window.sarprasPaginationState.perPage = parseInt(this.value);
            window.sarprasPaginationState.currentPage = 1;
            renderSarprasPagination();
        });
    }

    renderSarprasPagination();
}

// ============================================================
//  RENDER PAGINATION
// ============================================================
window.renderSarprasPagination = function() {
    const state = window.sarprasPaginationState;
    const allRows = Array.from(document.querySelectorAll('.sarpras-row'));
    
    state.totalData = allRows.length;

    // Update total display
    const totalDisplay = document.getElementById('sarprasTotalDisplay');
    if (totalDisplay) {
        totalDisplay.innerHTML = `Total: <span class="font-semibold text-gray-800 dark:text-gray-200">${state.totalData}</span> data`;
    }

    // Calculate pagination
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    
    if (state.currentPage > totalPages) state.currentPage = totalPages;
    if (state.currentPage < 1) state.currentPage = 1;

    const startIndex = (state.currentPage - 1) * state.perPage;
    const endIndex = Math.min(startIndex + state.perPage, state.totalData);

    // Hide all, show current page only
    allRows.forEach((row, index) => {
        if (index >= startIndex && index < endIndex) {
            row.style.display = '';
            const td = row.querySelector('td:first-child');
            if (td) td.textContent = index + 1;
        } else {
            row.style.display = 'none';
        }
    });

    // Handle empty state
    handleSarprasEmptyState(state.totalData);

    // Render controls
    renderSarprasPaginationControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

// ============================================================
//  EMPTY STATE
// ============================================================
function handleSarprasEmptyState(totalCount) {
    const tbody = document.getElementById('sarprasProdiTableBody');
    const emptyStateRow = document.getElementById('sarprasEmptyStateRow');
    const existingFilterEmpty = tbody?.querySelector('.sarpras-filter-empty-row');
    
    if (existingFilterEmpty) existingFilterEmpty.remove();
    
    if (emptyStateRow) {
        emptyStateRow.style.display = totalCount === 0 ? '' : 'none';
    }
}

// ============================================================
//  PAGINATION CONTROLS
// ============================================================
function renderSarprasPaginationControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('sarprasPaginationContainer');
    if (!container) return;

    if (totalData === 0) {
        container.innerHTML = '';
        return;
    }

    const fromDisplay = totalData > 0 ? from + 1 : 0;
    const toDisplay = to;

    let html = `
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 
                    bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 px-4 py-3">
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
            <button type="button" onclick="goToSarprasPage(${currentPage - 1})"
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

        // Pages
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        if (startPage > 1) {
            html += createSarprasPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
        }

        for (let i = startPage; i <= endPage; i++) {
            html += createSarprasPageButton(i, currentPage);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
            html += createSarprasPageButton(totalPages, currentPage);
        }

        // Next
        html += `
            <button type="button" onclick="goToSarprasPage(${currentPage + 1})"
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

function createSarprasPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `
        <button type="button" onclick="goToSarprasPage(${page})"
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${isActive 
                    ? 'bg-blue-600 text-white shadow-sm' 
                    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-200'}">
            ${page}
        </button>
    `;
}

// ============================================================
//  GO TO PAGE
// ============================================================
window.goToSarprasPage = function(page) {
    const state = window.sarprasPaginationState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    
    if (page < 1 || page > totalPages || page === state.currentPage) return;
    
    state.currentPage = page;
    renderSarprasPagination();
    
    const container = document.getElementById('sarprasProdiTableContainer');
    if (container) {
        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

// ============================================================
//  PREVIEW GAMBAR
// ============================================================
function previewImage(url, name) {
    const modal = document.getElementById('imagePreviewModal');
    const img = document.getElementById('previewImage');
    const imgName = document.getElementById('previewImageName');
    
    img.src = url;
    imgName.textContent = name || 'Foto';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeImagePreview() {
    const modal = document.getElementById('imagePreviewModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
    document.getElementById('previewImage').src = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImagePreview();
    }
});

// ============================================================
//  DELETE
// ============================================================
function deleteSarprasProdi(id) {
    if (!id) return;

    const url = `{{ url('/sarpras') }}/${id}`;

    if (typeof window.showConfirmDialog === 'function') {
        window.showConfirmDialog(
            'Konfirmasi Hapus',
            'Apakah Anda yakin ingin menghapus data Sarana Prasarana ini?',
            function() {
                forceCloseAllModals();
                setTimeout(function() {
                    executeDeleteProdi(url);
                }, 300);
            }
        );
    } else {
        if (confirm('Apakah Anda yakin ingin menghapus data Sarana Prasarana ini?')) {
            forceCloseAllModals();
            setTimeout(function() {
                executeDeleteProdi(url);
            }, 300);
        }
    }
}

function executeDeleteProdi(url) {
    forceCloseAllModals();

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            if (window.toast) {
                window.toast.success(result.message || 'Data berhasil dihapus');
            }
            setTimeout(function() {
                if (typeof window.refreshTable === 'function') {
                    window.refreshTable('#sarprasProdiTableContainer');
                } else {
                    window.location.reload();
                }
            }, 300);
        } else {
            if (window.toast) {
                window.toast.error(result.message || 'Gagal menghapus data');
            }
        }
    })
    .catch(error => {
        console.error('Error deleting sarpras:', error);
        if (window.toast) {
            window.toast.error('Terjadi kesalahan saat menghapus data');
        }
    });
}

// ============================================================
//  FORCE CLOSE MODALS
// ============================================================
function forceCloseAllModals() {
    if (typeof $ !== 'undefined' && $.fn && $.fn.modal) {
        $('.modal').modal('hide');
    }

    const modalSelectors = [
        '.modal', '.modal-dialog', '.modal-content', '.modal-overlay',
        '.modal-mask', '.confirm-dialog', '.swal2-container',
        '[role="dialog"]', '[role="alertdialog"]',
    ];

    modalSelectors.forEach(selector => {
        document.querySelectorAll(selector).forEach(el => {
            el.classList.remove('show', 'in', 'fade', 'active', 'visible');
            el.style.display = 'none';
            el.style.visibility = 'hidden';
            el.style.opacity = '0';
            el.style.pointerEvents = 'none';
            el.setAttribute('aria-hidden', 'true');
            el.removeAttribute('aria-modal');
            const backdrop = el.querySelector('.modal-backdrop, .backdrop');
            if (backdrop) backdrop.remove();
        });
    });

    document.querySelectorAll('.modal-backdrop, .backdrop, .overlay, .modal-overlay').forEach(el => {
        el.remove();
    });

    document.body.classList.remove('modal-open', 'overflow-hidden', 'no-scroll');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
    document.body.style.marginRight = '';
    document.body.style.position = '';
    document.body.style.top = '';

    if (typeof Swal !== 'undefined' && Swal.isVisible && Swal.isVisible()) {
        Swal.close();
    }

    document.querySelectorAll('[data-bs-dismiss="modal"], [data-dismiss="modal"], .btn-close, .close, .modal-close, .confirm-close').forEach(btn => {
        btn.click();
    });

    const escEvent = new KeyboardEvent('keydown', { key: 'Escape', keyCode: 27, which: 27 });
    document.dispatchEvent(escEvent);

    document.querySelectorAll('.active.modal, .open.modal, .active.overlay, .open.overlay').forEach(el => {
        el.classList.remove('active', 'open');
        el.style.display = 'none';
    });

    document.querySelectorAll('[data-modal], [data-toggle="modal"]').forEach(el => {
        const target = el.getAttribute('data-target') || el.getAttribute('href');
        if (target) {
            const modalEl = document.querySelector(target);
            if (modalEl) {
                modalEl.style.display = 'none';
                modalEl.classList.remove('show');
            }
        }
    });

    setTimeout(() => {
        document.querySelectorAll('.modal-backdrop, .backdrop, .overlay, .modal-overlay').forEach(el => {
            el.remove();
        });
        document.body.classList.remove('modal-open', 'overflow-hidden');
        document.body.style.overflow = '';
    }, 50);
}

// ============================================================
//  REFRESH TABLE
// ============================================================
if (typeof window.refreshSarprasProdiTable === 'undefined') {
    window.refreshSarprasProdiTable = function() {
        if (typeof window.refreshTable === 'function') {
            window.refreshTable('#sarprasProdiTableContainer');
        }
    };
}
</script>
@endpush