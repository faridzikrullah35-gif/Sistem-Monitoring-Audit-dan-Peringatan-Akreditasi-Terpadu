<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['penelitian']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['penelitian']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $totalPenelitian = $penelitian->count();
    
    // Generate opsi perPage dinamis
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];
    
    foreach ($baseOptions as $opt) {
        if ($opt < $totalPenelitian) {
            $perPageOptions[] = $opt;
        }
    }
    
    if ($totalPenelitian > 0) {
        $perPageOptions[] = $totalPenelitian;
    }
    
    $defaultPerPage = $totalPenelitian > 10 ? 10 : ($totalPenelitian > 0 ? $totalPenelitian : 10);
?>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
    <div class="p-4">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
            <div class="flex items-center gap-3 flex-wrap">
                <label for="filterTahunAkademik" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter:
                </label>
                
                <select 
                    id="filterTahunAkademik" 
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    <?php
                        $tahunList = $penelitian->pluck('tahun_akademik')->unique()->sort()->values();
                    ?>
                    <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tahun); ?>"><?php echo e($tahun); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <button 
                    type="button"
                    onclick="resetFilterPenelitian()"
                    class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </button>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span id="totalDataDisplay">Total: <span class="font-semibold text-gray-700 dark:text-gray-300"><?php echo e($totalPenelitian); ?></span> data</span>
                </div>
                
                <div class="flex items-center gap-2">
                    <label for="perPageSelect" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
                    <select 
                        id="perPageSelect" 
                        class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                    >
                        <?php if($totalPenelitian > 0): ?>
                            <?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isAll = $option === $totalPenelitian;
                                    $isSelected = $option === $defaultPerPage;
                                ?>
                                <option value="<?php echo e($option); ?>" <?php echo e($isSelected ? 'selected' : ''); ?>>
                                    <?php if($isAll && $totalPenelitian > 100): ?>
                                        Semua (<?php echo e($totalPenelitian); ?>)
                                    <?php elseif($isAll): ?>
                                        Semua
                                    <?php else: ?>
                                        <?php echo e($option); ?>

                                    <?php endif; ?>
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <option value="10">10</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// ============================================================
//  PAGINATION STATE
// ============================================================
window.penelitianPaginationState = {
    currentPage: 1,
    perPage: <?php echo e($defaultPerPage); ?>,
    totalData: <?php echo e($totalPenelitian); ?>,
    filters: {
        tahun_akademik: ''
    }
};

// ============================================================
//  INIT
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    initPenelitianPagination();
});

function initPenelitianPagination() {
    const filterTahunAkademik = document.getElementById('filterTahunAkademik');
    const perPageSelect = document.getElementById('perPageSelect');

    if (filterTahunAkademik) {
        filterTahunAkademik.addEventListener('change', function() {
            window.penelitianPaginationState.filters.tahun_akademik = this.value;
            window.penelitianPaginationState.currentPage = 1;
            updatePenelitianPerPageOptions();
            renderPenelitianPagination();
        });
    }

    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            window.penelitianPaginationState.perPage = parseInt(this.value);
            window.penelitianPaginationState.currentPage = 1;
            renderPenelitianPagination();
        });
    }

    updatePenelitianPerPageOptions();
    renderPenelitianPagination();
}

// ============================================================
//  UPDATE PER PAGE OPTIONS (dinamis setelah filter)
// ============================================================
window.updatePenelitianPerPageOptions = function() {
    const perPageSelect = document.getElementById('perPageSelect');
    if (!perPageSelect) return;

    const state = window.penelitianPaginationState;
    const allRows = Array.from(document.querySelectorAll('.penelitian-row'));

    const filteredCount = allRows.filter(row => {
        const tahun = row.dataset.tahun || '';
        if (state.filters.tahun_akademik && tahun !== state.filters.tahun_akademik) return false;
        return true;
    }).length;

    const currentValue = parseInt(perPageSelect.value);
    const baseOptions = [5, 10, 25, 50, 100];
    const options = [];

    baseOptions.forEach(opt => {
        if (opt < filteredCount) options.push(opt);
    });

    if (filteredCount > 0) options.push(filteredCount);

    perPageSelect.innerHTML = '';

    if (options.length === 0) {
        const opt = document.createElement('option');
        opt.value = '10';
        opt.textContent = '10';
        perPageSelect.appendChild(opt);
        state.perPage = 10;
    } else {
        options.forEach(optValue => {
            const opt = document.createElement('option');
            opt.value = optValue;

            const isAll = optValue === filteredCount && filteredCount > 0;
            if (isAll && filteredCount > 100) {
                opt.textContent = `Semua (${filteredCount})`;
            } else if (isAll) {
                opt.textContent = 'Semua';
            } else {
                opt.textContent = optValue;
            }

            if (optValue === currentValue && options.includes(currentValue)) {
                opt.selected = true;
            }
            perPageSelect.appendChild(opt);
        });

        if (!options.includes(currentValue)) {
            const defaultVal = filteredCount > 10 ? 10 : filteredCount;
            perPageSelect.value = defaultVal;
            state.perPage = defaultVal;
        }
    }
};

// ============================================================
//  RENDER PAGINATION
// ============================================================
window.renderPenelitianPagination = function() {
    const state = window.penelitianPaginationState;
    const allRows = Array.from(document.querySelectorAll('.penelitian-row'));

    // Filter rows (hanya tahun akademik)
    const filteredRows = allRows.filter(row => {
        const tahun = row.dataset.tahun || '';
        if (state.filters.tahun_akademik && tahun !== state.filters.tahun_akademik) return false;
        return true;
    });

    // Update total
    state.totalData = filteredRows.length;
    const totalDisplay = document.getElementById('totalDataDisplay');
    if (totalDisplay) {
        totalDisplay.innerHTML = `Total: <span class="font-semibold text-gray-700 dark:text-gray-300">${state.totalData}</span> data`;
    }

    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;

    if (state.currentPage > totalPages) state.currentPage = totalPages;
    if (state.currentPage < 1) state.currentPage = 1;

    const startIndex = (state.currentPage - 1) * state.perPage;
    const endIndex = Math.min(startIndex + state.perPage, state.totalData);

    // Hide all
    allRows.forEach(row => row.style.display = 'none');

    // Show current page only
    filteredRows.forEach((row, index) => {
        if (index >= startIndex && index < endIndex) {
            row.style.display = '';
            const td = row.querySelector('td:first-child');
            if (td) td.textContent = index + 1;
        }
    });

    handlePenelitianEmptyState(filteredRows.length, allRows.length);
    renderPenelitianPaginationControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

// ============================================================
//  EMPTY STATE
// ============================================================
function handlePenelitianEmptyState(filteredCount, totalCount) {
    const tbody = document.getElementById('penelitianTableBody');
    const emptyStateRow = document.getElementById('emptyStateRow');
    const existingFilterEmpty = tbody?.querySelector('.filter-empty-row');

    if (existingFilterEmpty) existingFilterEmpty.remove();

    if (totalCount === 0) {
        if (emptyStateRow) emptyStateRow.style.display = '';
    } else if (filteredCount === 0) {
        if (emptyStateRow) emptyStateRow.style.display = 'none';

        const tr = document.createElement('tr');
        tr.className = 'filter-empty-row';
        tr.innerHTML = `
            <td colspan="12" class="px-6 py-12 text-center">
                <div class="flex flex-col items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada data untuk filter yang dipilih</p>
                    <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Ubah filter atau reset untuk melihat semua data</p>
                </div>
            </td>
        `;
        tbody.appendChild(tr);
    } else {
        if (emptyStateRow) emptyStateRow.style.display = 'none';
    }
}

// ============================================================
//  PAGINATION CONTROLS
// ============================================================
function renderPenelitianPaginationControls(currentPage, totalPages, totalData, from, to) {
    let container = document.getElementById('penelitianPaginationContainer');

    if (!container) {
        container = document.createElement('div');
        container.id = 'penelitianPaginationContainer';
        container.className = 'mt-4';

        const tableContainer = document.getElementById('penelitianTableContainer');
        if (tableContainer) {
            tableContainer.parentElement.parentElement.appendChild(container);
        }
    }

    if (totalData === 0) {
        container.innerHTML = '';
        return;
    }

    const fromDisplay = from + 1;
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
            <button type="button" onclick="goToPenelitianPage(${currentPage - 1})"
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
            html += createPenelitianPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
        }

        for (let i = startPage; i <= endPage; i++) {
            html += createPenelitianPageButton(i, currentPage);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
            html += createPenelitianPageButton(totalPages, currentPage);
        }

        // Next
        html += `
            <button type="button" onclick="goToPenelitianPage(${currentPage + 1})"
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

function createPenelitianPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `
        <button type="button" onclick="goToPenelitianPage(${page})"
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
window.goToPenelitianPage = function(page) {
    const state = window.penelitianPaginationState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;

    if (page < 1 || page > totalPages || page === state.currentPage) return;

    state.currentPage = page;
    renderPenelitianPagination();

    const container = document.getElementById('penelitianTableContainer');
    if (container) {
        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

// ============================================================
//  RESET FILTER
// ============================================================
window.resetFilterPenelitian = function() {
    const filterTahunAkademik = document.getElementById('filterTahunAkademik');
    if (filterTahunAkademik) filterTahunAkademik.value = '';

    window.penelitianPaginationState.filters = {
        tahun_akademik: ''
    };
    window.penelitianPaginationState.currentPage = 1;

    updatePenelitianPerPageOptions();
    renderPenelitianPagination();
};

// ============================================================
//  REFRESH TABLE (setelah CRUD)
// ============================================================
window.refreshPenelitianTable = function() {
    fetch(window.location.href, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');

        // Update tbody
        const newTbody = doc.querySelector('#penelitianTableBody');
        const currentTbody = document.getElementById('penelitianTableBody');
        if (newTbody && currentTbody) {
            currentTbody.innerHTML = newTbody.innerHTML;
        }

        // Update filter options
        const newFilterTahun = doc.querySelector('#filterTahunAkademik');
        const currentFilterTahun = document.getElementById('filterTahunAkademik');
        if (newFilterTahun && currentFilterTahun) {
            const selectedValue = currentFilterTahun.value;
            currentFilterTahun.innerHTML = newFilterTahun.innerHTML;
            currentFilterTahun.value = selectedValue;
        }

        // Reset ke halaman 1 & re-render
        window.penelitianPaginationState.currentPage = 1;

        updatePenelitianPerPageOptions();
        renderPenelitianPagination();
    })
    .catch(error => {
        console.error('Error refreshing table:', error);
        location.reload();
    });
};

// ============================================================
//  HANDLE PRINT PENELITIAN (dengan filter aktif)
// ============================================================
window.handlePrintPenelitian = function(event) {
    if (event) event.preventDefault();

    // Baca filter yang aktif dari state
    const state = window.penelitianPaginationState || {};
    const filterTahun = state.filters?.tahun_akademik || '';

    // Base URL print
    const baseUrl = '<?php echo e(route("prodi.penelitian.print")); ?>';

    // Bangun query string
    const params = new URLSearchParams();
    if (filterTahun) params.append('tahun_akademik', filterTahun);

    const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;

    // Buka tab baru
    window.open(url, '_blank');
    return false;
};

// Alias biar kompatibel dengan kode lama
window.filterPenelitianTable = window.renderPenelitianPagination;
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/prodi-penelitian/filter-section.blade.php ENDPATH**/ ?>