<?php
    $totalDosen = ($dosen ?? collect())->count();
    $perPageOptions = [];
    $baseOptions = [5, 10, 25, 50, 100];

    foreach ($baseOptions as $opt) {
        if ($opt < $totalDosen) {
            $perPageOptions[] = $opt;
        }
    }

    if ($totalDosen > 0) {
        $perPageOptions[] = $totalDosen;
    }

    $defaultPerPage = $totalDosen > 10 ? 10 : ($totalDosen > 0 ? $totalDosen : 10);
?>

<div>
    
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Data Dosen</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data dosen yang terdaftar</p>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" onclick="openModalDosen()" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white transition-all duration-200 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah
            </button>
        </div>
    </div>

    
    <div class="mb-3 flex flex-col items-center justify-between gap-3 rounded-lg border border-gray-200 bg-white px-4 py-2.5 dark:border-gray-700 dark:bg-gray-800 sm:flex-row">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="dosenTotalDisplay">Total: <span class="font-semibold text-gray-800 dark:text-gray-200"><?php echo e($totalDosen); ?></span> data</span>
        </div>
        <div class="flex items-center gap-2">
            <label for="dosenPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="dosenPerPage" class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                <?php if($totalDosen > 0): ?>
                    <?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isAll = $option === $totalDosen;
                            $isSelected = $option === $defaultPerPage;
                        ?>
                        <option value="<?php echo e($option); ?>" <?php echo e($isSelected ? 'selected' : ''); ?>>
                            <?php if($isAll && $totalDosen > 100): ?>
                                Semua (<?php echo e($totalDosen); ?>)
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

    
    
    
    
    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">

        <div
            id="dosenTableScroll"
            class="overflow-auto"
            style="max-height: 600px;"
        >
            <table id="sdmdosenTableContainer" class="w-max min-w-[1800px] border-collapse text-sm">
                <thead>
                    
                    <tr>
                        <th rowspan="2" class="sticky top-0 z-30 w-12 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">No</th>
                        <th rowspan="2" class="sticky top-0 z-30 min-w-[220px] whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Nama</th>
                        <th colspan="5" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Pendidikan</th>
                        <th colspan="2" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Sertifikasi & Jabatan</th>
                        <th colspan="2" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Posisi/Jabatan</th>
                        <th colspan="4" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Status & Identitas</th>
                        <th rowspan="2" class="sticky top-0 z-30 w-32 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Aksi</th>
                    </tr>

                    
                    <tr>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Latar Pendidikan</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 100px;">Doktor</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 110px;">Magister</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 100px;">Sarjana</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Instansi Asal</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 130px;">Sertifikasi</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Jabatan Akademik</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Posisi/Jabatan</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 120px;">Tgl Mulai</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">SK Dosen Tetap</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 120px;">Status</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 140px;">NIDN</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 140px;">NUPTK</th>
                    </tr>
                </thead>
                <tbody id="dosenTableBody" class="bg-white dark:bg-gray-900">
                    <?php $__empty_1 = true; $__currentLoopData = $dosen ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr id="dosenRow-<?php echo e($item->id); ?>" class="dosen-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50" data-id="<?php echo e($item->id); ?>">
                            <td class="no border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"><?php echo e($loop->iteration); ?></td>
                            <td class="nama min-w-[220px] border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-200 dark:bg-gray-700">
                                        <svg class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                    <span class="whitespace-nowrap"><?php echo e($item->nama ?? '-'); ?></span>
                                </div>
                            </td>
                            <td class="latar-pendidikan min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->latar_pendidikan ?? '-'); ?></td>
                            <td class="doktor min-w-[100px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->doktor ?? '-'); ?></td>
                            <td class="magister min-w-[110px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->magister ?? '-'); ?></td>
                            <td class="sarjana min-w-[100px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->sarjana ?? '-'); ?></td>
                            <td class="instansi-asal min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->nama_instansi_asal ?? '-'); ?></td>
                            <td class="sertifikasi min-w-[130px] border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                <?php $isYa = ($item->sertifikasi ?? 'Tidak') === 'Ya'; ?>
                                <span class="inline-flex items-center whitespace-nowrap rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'); ?>">
                                    <span class="mr-1.5 inline-block h-1.5 w-1.5 rounded-full <?php echo e($isYa ? 'bg-green-600 dark:bg-green-400' : 'bg-red-600 dark:bg-red-400'); ?>"></span>
                                    <?php echo e($item->sertifikasi ?? 'Tidak'); ?>

                                </span>
                            </td>
                            <td class="jabatan-akademik min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->jabatan_akademik ?? '-'); ?></td>
                            <td class="posisi-jabatan min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->posisi_jabatan ?? '-'); ?></td>
                            <td class="tgl-mulai min-w-[120px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                <?php echo e($item->terhitung_mulai_tanggal ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y') : '-'); ?>

                            </td>
                            <td class="sk-dosen min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->sk_dosen_tetap ?? '-'); ?></td>
                            <td class="status min-w-[120px] border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                <?php $isAktif = ($item->status ?? 'Aktif') === 'Aktif'; ?>
                                <span class="inline-flex items-center whitespace-nowrap rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($isAktif ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-800/50 dark:text-gray-400'); ?>">
                                    <?php echo e($item->status ?? 'Aktif'); ?>

                                </span>
                            </td>
                            <td class="nidn min-w-[140px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->nidn ?? '-'); ?></td>
                            <td class="nuptk min-w-[140px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->nuptk ?? '-'); ?></td>
                            <td class="border border-gray-400 px-4 py-2 text-center align-top">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" class="btn-edit-dosen inline-flex items-center gap-1 rounded-lg border border-yellow-200/50 bg-yellow-50 px-2.5 py-1.5 text-xs font-medium text-yellow-700 transition-all duration-200 hover:bg-yellow-100 dark:border-yellow-800/30 dark:bg-yellow-900/20 dark:text-yellow-300 dark:hover:bg-yellow-900/40" title="Edit" data-id="<?php echo e($item->id); ?>">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button type="button" class="btn-delete-dosen inline-flex items-center gap-1 rounded-lg border border-red-200/50 bg-red-50 px-2.5 py-1.5 text-xs font-medium text-red-700 transition-all duration-200 hover:bg-red-100 dark:border-red-800/30 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/40" title="Hapus" data-id="<?php echo e($item->id); ?>">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 01-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr id="emptyStateDosenRow">
                            <td colspan="16" class="border border-gray-400 px-4 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                        <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Dosen</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data dosen akan muncul di sini setelah ditambahkan</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
    

    
    <div id="dosenPaginationContainer" class="mt-4"></div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    window.dosenPaginationState = {
        currentPage: 1,
        perPage: <?php echo e($defaultPerPage); ?>,
        totalData: <?php echo e($totalDosen); ?>

    };

    document.addEventListener('DOMContentLoaded', function() {
        initDosenPagination();
    });

    function initDosenPagination() {
        const perPageSelect = document.getElementById('dosenPerPage');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                window.dosenPaginationState.perPage = parseInt(this.value);
                window.dosenPaginationState.currentPage = 1;
                renderDosenPagination();
            });
        }
        renderDosenPagination();
    }

    window.renderDosenPagination = function() {
        const state = window.dosenPaginationState;
        const allRows = Array.from(document.querySelectorAll('.dosen-row'));
        state.totalData = allRows.length;

        const totalDisplay = document.getElementById('dosenTotalDisplay');
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

        handleDosenEmptyState(state.totalData);
        renderDosenPaginationControls(state.currentPage, totalPages, state.totalData, startIndex, endIndex);
    };

    function handleDosenEmptyState(totalCount) {
        const emptyStateRow = document.getElementById('emptyStateDosenRow');
        if (emptyStateRow) emptyStateRow.style.display = totalCount === 0 ? '' : 'none';
    }

    function renderDosenPaginationControls(currentPage, totalPages, totalData, from, to) {
        const container = document.getElementById('dosenPaginationContainer');
        if (!container) return;
        if (totalData === 0) { container.innerHTML = ''; return; }

        const fromDisplay = from + 1;
        const toDisplay = to;

        let html = `
            <div class="flex flex-col items-center justify-between gap-3 rounded-lg border border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800 sm:flex-row">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan <span class="font-semibold text-gray-700 dark:text-gray-300">${fromDisplay}</span> sampai <span class="font-semibold text-gray-700 dark:text-gray-300">${toDisplay}</span> dari <span class="font-semibold text-gray-700 dark:text-gray-300">${totalData}</span> data
                </div>
        `;

        if (totalPages > 1) {
            html += `<nav class="flex items-center gap-1" aria-label="Pagination">`;
            html += `<button type="button" onclick="goToDosenPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''} class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-sm font-medium transition-colors ${currentPage <= 1 ? 'cursor-not-allowed text-gray-300 dark:text-gray-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200'}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg></button>`;

            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            if (startPage > 1) {
                html += createDosenPageButton(1, currentPage);
                if (startPage > 2) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
            }

            for (let i = startPage; i <= endPage; i++) {
                html += createDosenPageButton(i, currentPage);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
                html += createDosenPageButton(totalPages, currentPage);
            }

            html += `<button type="button" onclick="goToDosenPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''} class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-sm font-medium transition-colors ${currentPage >= totalPages ? 'cursor-not-allowed text-gray-300 dark:text-gray-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200'}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>`;
            html += `</nav>`;
        }

        html += `</div>`;
        container.innerHTML = html;
    }

    function createDosenPageButton(page, currentPage) {
        const isActive = page === currentPage;
        return `<button type="button" onclick="goToDosenPage(${page})" class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-sm font-medium transition-colors ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200'}">${page}</button>`;
    }

    window.goToDosenPage = function(page) {
        const state = window.dosenPaginationState;
        const totalPages = Math.ceil(state.totalData / state.perPage) || 1;
        if (page < 1 || page > totalPages || page === state.currentPage) return;
        state.currentPage = page;
        renderDosenPagination();
        const container = document.getElementById('sdmdosenTableContainer');
        if (container) container.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/profile-sdm/table-data-dosen.blade.php ENDPATH**/ ?>