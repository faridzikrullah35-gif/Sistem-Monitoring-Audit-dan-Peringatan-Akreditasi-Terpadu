<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'mahasiswaFakultas' => [],
    'mahasiswaProdi'    => [],
    'prodi'             => [],
]));

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

foreach (array_filter(([
    'mahasiswaFakultas' => [],
    'mahasiswaProdi'    => [],
    'prodi'             => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $totalFak   = ($mahasiswaFakultas ?? collect())->count();
    $totalProdi = ($mahasiswaProdi ?? collect())->count();
    $totalAll   = $totalFak + $totalProdi;

    $baseOptions = [5, 10, 25, 50, 100];
    $perPageOptions = [];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalAll) $perPageOptions[] = $opt;
    }
    if ($totalAll > 0) $perPageOptions[] = $totalAll;
    $defaultPerPage = $totalAll > 10 ? 10 : ($totalAll > 0 ? $totalAll : 10);
?>

<div>
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">DTPS | Mahasiswa | Data Mahasiswa</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data mahasiswa Fakultas & Prodi</p>
        </div>
        <div class="flex items-center gap-2">
            <select id="filterProdiMahasiswaPd"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterMahasiswaPdByProdi(this.value)">
                <option value="fakultas">Data Fakultas</option>
                <option value="all">Semua Prodi</option>
                <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="prodi-<?php echo e($p->id); ?>"><?php echo e($p->sub_unit ?? $p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    
    <div class="mb-3 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2.5">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Menampilkan: <span id="mahasiswaPdDataInfoLabel" class="font-semibold text-gray-800 dark:text-gray-200">Data Fakultas</span>
            &middot; Total: <span id="mahasiswaPdTotalDisplay" class="font-semibold text-gray-800 dark:text-gray-200">0</span> data
        </div>
        <div class="flex items-center gap-2">
            <label for="mahasiswaPdPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="mahasiswaPdPerPage"
                class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                <?php if($totalAll > 0): ?>
                    <?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isAll = $option === $totalAll;
                            $isSelected = $option === $defaultPerPage;
                        ?>
                        <option value="<?php echo e($option); ?>" <?php echo e($isSelected ? 'selected' : ''); ?>>
                            <?php if($isAll && $totalAll > 100): ?> Semua (<?php echo e($totalAll); ?>)
                            <?php elseif($isAll): ?> Semua
                            <?php else: ?> <?php echo e($option); ?>

                            <?php endif; ?>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <option value="10">10</option>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div id="mahasiswaPdTableScroll" class="overflow-auto" style="max-height: 600px;">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50">
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400 w-12">No</th>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Prodi</th>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Tahun Akademik</th>
                        <th colspan="7" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Jumlah Mahasiswa</th>
                        <th rowspan="2" class="sticky top-0 z-30 border border-gray-400 bg-gray-50 px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400">Lulusan Akhir TA</th>
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
                <tbody id="mahasiswaPdTableBody" class="bg-white dark:bg-gray-900">

                    
                    <?php $__empty_1 = true; $__currentLoopData = $mahasiswaFakultas ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="mahasiswa-pd-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="fakultas"
                        data-user-id="<?php echo e($item->users_id); ?>">
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">Fakultas</span>
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->tahun_akademik ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_6 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_5 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_4 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_3 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_2 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_1 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->lulusan_akhir_ta ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="mahasiswa-pd-empty fakultas-empty">
                        <td colspan="11" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Mahasiswa Fakultas</h3>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    
                    <?php $__empty_1 = true; $__currentLoopData = $mahasiswaProdi ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="mahasiswa-pd-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                        data-source="prodi"
                        data-user-id="<?php echo e($item->users_id); ?>">
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no"></td>
                        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                            <?php echo e(optional($item->user)->sub_unit ?? '-'); ?>

                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->tahun_akademik ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_6 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_5 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_4 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_3 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_2 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta_1 ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->ta ?? '-'); ?></td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->lulusan_akhir_ta ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="mahasiswa-pd-empty prodi-empty" style="display:none;">
                        <td colspan="11" class="border border-gray-400 px-4 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Mahasiswa Prodi</h3>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="mahasiswaPdPaginationContainer" class="mt-4"></div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
window.mahasiswaPdState = {
    currentPage: 1,
    perPage: <?php echo e($defaultPerPage); ?>,
    filter: 'fakultas',     // fakultas | all | prodi-X
    totalData: 0
};

// -------------------- FILTER --------------------
window.filterMahasiswaPdByProdi = function(value) {
    window.mahasiswaPdState.filter = value;
    window.mahasiswaPdState.currentPage = 1;
    renderMahasiswaPdPagination();
};

// -------------------- FILTER ROWS --------------------
function getVisibleMahasiswaPdRows() {
    const state = window.mahasiswaPdState;
    const allRows = Array.from(document.querySelectorAll('.mahasiswa-pd-row'));

    if (state.filter === 'fakultas') {
        return allRows.filter(r => r.dataset.source === 'fakultas');
    }
    if (state.filter === 'all') {
        return allRows.filter(r => r.dataset.source === 'prodi');
    }
    if (state.filter.startsWith('prodi-')) {
        const prodiId = String(state.filter.replace('prodi-', '')).trim();
        return allRows.filter(r => r.dataset.source === 'prodi' &&
            String(r.dataset.userId).trim() === prodiId);
    }
    return [];
}

// -------------------- RENDER PAGINATION --------------------
window.renderMahasiswaPdPagination = function() {
    const state = window.mahasiswaPdState;
    const allRows = Array.from(document.querySelectorAll('.mahasiswa-pd-row'));

    // Sembunyikan semua dulu
    allRows.forEach(r => r.style.display = 'none');

    // Ambil baris yang match filter
    const visibleRows = getVisibleMahasiswaPdRows();
    state.totalData = visibleRows.length;

    // Update label info
    const infoLabel = document.getElementById('mahasiswaPdDataInfoLabel');
    const totalDisplay = document.getElementById('mahasiswaPdTotalDisplay');
    if (totalDisplay) totalDisplay.textContent = state.totalData;

    if (state.filter === 'fakultas') {
        if (infoLabel) infoLabel.textContent = 'Data Fakultas';
    } else if (state.filter === 'all') {
        if (infoLabel) infoLabel.textContent = 'Semua Prodi';
    } else if (state.filter.startsWith('prodi-')) {
        const opt = document.querySelector(`#filterProdiMahasiswaPd option[value="${state.filter}"]`);
        if (infoLabel) infoLabel.textContent = opt ? opt.textContent : 'Prodi';
    }

    // Hitung halaman
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (state.currentPage > totalPages) state.currentPage = totalPages;
    if (state.currentPage < 1) state.currentPage = 1;

    const startIndex = (state.currentPage - 1) * state.perPage;
    const endIndex   = Math.min(startIndex + state.perPage, state.totalData);

    // Tampilkan baris sesuai halaman
    visibleRows.forEach((row, idx) => {
        if (idx >= startIndex && idx < endIndex) {
            row.style.display = '';
            const td = row.querySelector('td.no');
            if (td) td.textContent = idx + 1;
        }
    });

    // Toggle empty state
    const fakultasEmpty = document.querySelector('.mahasiswa-pd-empty.fakultas-empty');
    const prodiEmpty    = document.querySelector('.mahasiswa-pd-empty.prodi-empty');

    if (fakultasEmpty) {
        fakultasEmpty.style.display = (state.filter === 'fakultas' && state.totalData === 0) ? '' : 'none';
    }
    if (prodiEmpty) {
        prodiEmpty.style.display = (state.filter !== 'fakultas' && state.totalData === 0) ? '' : 'none';
    }

    renderMahasiswaPdControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
};

function renderMahasiswaPdControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('mahasiswaPdPaginationContainer');
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
        html += `<button type="button" onclick="goToMahasiswaPdPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage   = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createMahasiswaPdPageBtn(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createMahasiswaPdPageBtn(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
            html += createMahasiswaPdPageBtn(totalPages, currentPage);
        }

        html += `<button type="button" onclick="goToMahasiswaPdPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }

    html += `</div>`;
    container.innerHTML = html;
}

function createMahasiswaPdPageBtn(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToMahasiswaPdPage(${page})"
        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
        ${page}
    </button>`;
}

window.goToMahasiswaPdPage = function(page) {
    const state = window.mahasiswaPdState;
    const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
    if (page < 1 || page > totalPages || page === state.currentPage) return;
    state.currentPage = page;
    renderMahasiswaPdPagination();
    document.getElementById('mahasiswaPdTableScroll')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

// -------------------- INIT --------------------
document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('mahasiswaPdPerPage');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            window.mahasiswaPdState.perPage = parseInt(this.value);
            window.mahasiswaPdState.currentPage = 1;
            renderMahasiswaPdPagination();
        });
    }
    window.mahasiswaPdState.filter = 'fakultas';
    renderMahasiswaPdPagination();
});

// ============================================================
//  HANDLE PRINT PD DIKTI MAHASISWA FAKULTAS (filter-aware)
// ============================================================
window.handlePrintPdDiktiMahasiswa = function(event) {
    if (event) event.preventDefault();

    const state = window.mahasiswaPdState || {};
    const filterSource = state.filter || 'fakultas';

    const baseUrl = '<?php echo e(route("fakultas.profile-pd-dikti.mahasiswa.print")); ?>';
    const params = new URLSearchParams();
    if (filterSource) params.append('filter_source', filterSource);

    const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
    window.open(url, '_blank');
    return false;
};
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/fakultas-profile-pd-dikti/table-data-pd-dikti.blade.php ENDPATH**/ ?>