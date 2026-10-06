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

<div
    id="penelitianTableWrapper"
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden"
>
    
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <div>
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Daftar Penelitian</h3>
        </div>
        
    </div>

    
    <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
        <table id="penelitianTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Ketua/Anggota</th>
                    <th scope="col" class="px-6 py-3">Nama Dosen</th>
                    <th scope="col" class="px-6 py-3">Judul Penelitian</th>
                    <th scope="col" class="px-6 py-3">Lembaga Mitra</th>
                    <th scope="col" class="px-6 py-3">Tingkat</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Skema</th>
                    <th scope="col" class="px-6 py-3">Sumber Dana</th>
                    <th scope="col" class="px-6 py-3">Luaran</th>
                    <th scope="col" class="px-6 py-3">Bukti</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php $__empty_1 = true; $__currentLoopData = $penelitian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($penelitian instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                                <?php echo e($penelitian->firstItem() + $index); ?>

                            <?php else: ?>
                                <?php echo e($index + 1); ?>

                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                <?php echo e(optional($item->user)->sub_unit ?? '-'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($item->ketua_anggota === 'Ketua'): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">Ketua</span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">Anggota</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white"><?php echo e($item->nama_dosen ?? '-'); ?></td>
                        <td class="px-6 py-4 max-w-xs"><?php echo e($item->judul_penelitian ?? '-'); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->lembaga_mitra ?? '-'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                                $tingkatClass = match($item->tingkat) {
                                    'Internasional' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                    'Nasional'      => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                    default         => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                };
                            ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($tingkatClass); ?>">
                                <?php echo e($item->tingkat ?? '-'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($item->tahun_akademik ?? '-'); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->skema ?? '-'); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->sumber_dana ?? '-'); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->luaran ?? '-'); ?></td>
                        <td class="px-6 py-4">
                            <?php if($item->link_bukti): ?>
                                <a href="<?php echo e($item->link_bukti); ?>" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Buka
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr id="emptyStateRow">
                        <td colspan="12" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data Penelitian dari prodi</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="border-t border-gray-200 px-6 py-3 dark:border-gray-700">
        <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                <?php if($penelitian instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                    <?php if($penelitian->total() > 0): ?>
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($penelitian->firstItem()); ?></span> - <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($penelitian->lastItem()); ?></span> dari <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($penelitian->total()); ?></span> data
                    <?php else: ?>
                        Tidak ada data
                    <?php endif; ?>
                <?php else: ?>
                    <?php if($penelitian->count() > 0): ?>
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">1</span> - <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($penelitian->count()); ?></span> dari <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($penelitian->count()); ?></span> data
                    <?php else: ?>
                        Tidak ada data
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="flex items-center gap-2">
                <label for="penelitianPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan Data:</label>
                <select id="penelitianPerPage"
                        class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                        onchange="changePenelitianPerPage(this.value)">
                    <option value="10"  <?php echo e(request('per_page', 10) == 10 ? 'selected' : ''); ?>>10</option>
                    <option value="25"  <?php echo e(request('per_page') == 25 ? 'selected' : ''); ?>>25</option>
                    <option value="50"  <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>50</option>
                    <option value="100" <?php echo e(request('per_page') == 100 ? 'selected' : ''); ?>>100</option>
                    <option value="all" <?php echo e(request('per_page') == 'all' ? 'selected' : ''); ?>>Semua</option>
                </select>
            </div>
        </div>

        <?php if($penelitian instanceof \Illuminate\Pagination\LengthAwarePaginator && $penelitian->hasPages()): ?>
            <div class="mt-3 pagination-wrapper">
                <?php echo e($penelitian->links('pagination::tailwind')); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('02f870d1-942d-4a21-a639-116df3e8fb7b')): $__env->markAsRenderedOnce('02f870d1-942d-4a21-a639-116df3e8fb7b'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    'use strict';

    function buildUrl(extraParams = {}) {
        const url = new URL(window.location.href);

        url.searchParams.set('_partial', 'penelitian');

        if (!extraParams.page) {
            url.searchParams.delete('penelitian_page');
        }

        Object.entries(extraParams).forEach(([k, v]) => {
            url.searchParams.set(k, v);
        });

        return url;
    }

    async function fetchAndReplaceTable(url) {
        const wrapper = document.getElementById('penelitianTableWrapper');
        if (!wrapper) return;

        try {
            wrapper.classList.add('opacity-60', 'pointer-events-none');

            const res = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            });

            if (!res.ok) throw new Error('Gagal memuat data penelitian.');

            const html = await res.text();
            wrapper.outerHTML = html;

            const cleanUrl = new URL(url.toString());
            cleanUrl.searchParams.delete('_partial');
            window.history.pushState({}, '', cleanUrl.toString());

            attachPaginationListeners();
        } catch (err) {
            console.error(err);
            const current = document.getElementById('penelitianTableWrapper');
            current?.classList.remove('opacity-60', 'pointer-events-none');
            if (window.toast?.error) window.toast.error(err.message);
        }
    }

    function attachPaginationListeners() {
        const wrapper = document.getElementById('penelitianTableWrapper');
        if (!wrapper) return;

        const links = wrapper.querySelectorAll('.pagination-wrapper a');
        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                if (!href) return;

                const url = new URL(href);
                url.searchParams.set('_partial', 'penelitian');

                fetchAndReplaceTable(url);
            });
        });
    }

    window.changePenelitianPerPage = function (value) {
        fetchAndReplaceTable(buildUrl({ per_page: value }));
    };

    window.reloadPenelitianTable = function () {
        const sel = document.getElementById('penelitianPerPage');
        const perPage = sel ? sel.value : (new URL(window.location.href)).searchParams.get('per_page') || '10';
        fetchAndReplaceTable(buildUrl({ per_page: perPage }));
    };

    document.addEventListener('DOMContentLoaded', attachPaginationListeners);
    document.addEventListener('penelitian:table:reloaded', attachPaginationListeners);
})();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/fakultas-penelitian/data-table.blade.php ENDPATH**/ ?>