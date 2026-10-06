<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['pengajarans']));

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

foreach (array_filter((['pengajarans']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    id="pengajaranTableWrapper"
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden"
>
    
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <div>
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Daftar Pengajaran</h3>
        </div>
    </div>

    
    <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
        <table id="pengajaranTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Semester</th>
                    <th scope="col" class="px-6 py-3">SK Pengajaran</th>
                    <th scope="col" class="px-6 py-3">Tanggal Penetapan</th>
                    <th scope="col" class="px-6 py-3">Keterangan</th>
                </tr>
            </thead>
            <tbody id="pengajaranTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php $__empty_1 = true; $__currentLoopData = $pengajarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pengajaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors pengajaran-row"
                        data-tahun="<?php echo e($pengajaran->tahun_akademik); ?>"
                        data-semester="<?php echo e($pengajaran->semester); ?>"
                        data-id="<?php echo e($pengajaran->id); ?>">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($pengajarans instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                                <?php echo e($pengajarans->firstItem() + $index); ?>

                            <?php else: ?>
                                <?php echo e($index + 1); ?>

                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                <?php echo e(optional($pengajaran->user)->sub_unit ?? '-'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white"><?php echo e($pengajaran->tahun_akademik); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($pengajaran->semester): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php echo e($pengajaran->semester === 'Ganjil'
                                        ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300'
                                        : 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300'); ?>">
                                    <?php echo e($pengajaran->semester); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($pengajaran->sk_pengajaran): ?>
                                <a href="<?php echo e(Storage::url($pengajaran->sk_pengajaran)); ?>" target="_blank"
                                   class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Lihat SK
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($pengajaran->tgl_penetapan): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    <?php echo e(\Carbon\Carbon::parse($pengajaran->tgl_penetapan)->format('d M Y')); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if($pengajaran->keterangan): ?>
                                <?php echo e($pengajaran->keterangan); ?>

                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr id="emptyStateRow">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data Pengajaran dari prodi</p>
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
            <?php if($pengajarans instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                <?php if($pengajarans->total() > 0): ?>
                    Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($pengajarans->firstItem()); ?></span> - <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($pengajarans->lastItem()); ?></span> dari <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($pengajarans->total()); ?></span> data
                <?php else: ?>
                    Tidak ada data
                <?php endif; ?>
            <?php else: ?>
                <?php if($pengajarans->count() > 0): ?>
                    Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">1</span> - <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($pengajarans->count()); ?></span> dari <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($pengajarans->count()); ?></span> data
                <?php else: ?>
                    Tidak ada data
                <?php endif; ?>
            <?php endif; ?>
            </div>
            <div class="flex items-center gap-2">
                <label for="pengajaranPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan Data:</label>
                <select id="pengajaranPerPage"
                        class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                        onchange="changePengajaranPerPage(this.value)">
                    <option value="10"  <?php echo e(request('per_page_pengajaran', 10) == 10 ? 'selected' : ''); ?>>10</option>
                    <option value="25"  <?php echo e(request('per_page_pengajaran') == 25 ? 'selected' : ''); ?>>25</option>
                    <option value="50"  <?php echo e(request('per_page_pengajaran') == 50 ? 'selected' : ''); ?>>50</option>
                    <option value="100" <?php echo e(request('per_page_pengajaran') == 100 ? 'selected' : ''); ?>>100</option>
                    <option value="all" <?php echo e(request('per_page_pengajaran') == 'all' ? 'selected' : ''); ?>>Semua</option>
                </select>
            </div>
        </div>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('8f8d9eaf-0eee-4593-bf52-ae99e9d158f5')): $__env->markAsRenderedOnce('8f8d9eaf-0eee-4593-bf52-ae99e9d158f5'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    'use strict';

    function buildUrl(extraParams = {}) {
        const url = new URL(window.location.href);
        url.searchParams.set('_partial', 'pengajaran');

        url.searchParams.delete('per_page');
        url.searchParams.delete('kurikulum_page');
        url.searchParams.delete('pengajaran_page');

        Object.entries(extraParams).forEach(([k, v]) => {
            url.searchParams.set(k, v);
        });

        return url;
    }

    async function fetchAndReplaceTable(url) {
        const wrapper = document.getElementById('pengajaranTableWrapper');
        if (!wrapper) return;

        try {
            wrapper.classList.add('opacity-60', 'pointer-events-none');

            const res = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            });

            if (!res.ok) throw new Error('Gagal memuat data pengajaran.');

            const html = await res.text();
            wrapper.outerHTML = html;

            const cleanUrl = new URL(url.toString());
            cleanUrl.searchParams.delete('_partial');
            window.history.pushState({}, '', cleanUrl.toString());
        } catch (err) {
            console.error(err);
            const current = document.getElementById('pengajaranTableWrapper');
            current?.classList.remove('opacity-60', 'pointer-events-none');
            if (window.toast?.error) window.toast.error(err.message);
        }
    }

    window.changePengajaranPerPage = function (value) {
        fetchAndReplaceTable(buildUrl({ per_page_pengajaran: value }));
    };

    window.reloadPengajaranTable = function () {
        const sel = document.getElementById('pengajaranPerPage');
        const perPage = sel ? sel.value : (new URL(window.location.href)).searchParams.get('per_page_pengajaran') || '10';
        fetchAndReplaceTable(buildUrl({ per_page_pengajaran: perPage }));
    };
})();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/fakultas-pendidikan/prodi-pengajaran/data-table.blade.php ENDPATH**/ ?>