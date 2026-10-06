<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['kurikulums']));

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

foreach (array_filter((['kurikulums']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    id="kurikulumTableWrapper"
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden"
>

    
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <div>
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Daftar Kurikulum</h3>
        </div>
        <button type="button" onclick="openModalKurikulum('create')" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-offset-gray-800">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
            </svg>
            Tambah Data Kurikulum
        </button>
    </div>

    
    <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
        <table id="kurikulumTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Dokumen</th>
                    <th scope="col" class="px-6 py-3">Tanggal Penetapan</th>
                    <th scope="col" class="px-6 py-3">Peninjauan Kurikulum</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="kurikulumTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php $__empty_1 = true; $__currentLoopData = $kurikulums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kurikulum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors kurikulum-row" data-tahun="<?php echo e($kurikulum->tahun_akademik); ?>" data-id="<?php echo e($kurikulum->id); ?>">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($kurikulums instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                                <?php echo e($kurikulums->firstItem() + $index); ?>

                            <?php else: ?>
                                <?php echo e($index + 1); ?>

                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white"><?php echo e($kurikulum->tahun_akademik); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($kurikulum->dokumen): ?>
                                <a href="<?php echo e(Storage::url($kurikulum->dokumen)); ?>" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Lihat Dokumen
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($kurikulum->tgl_penetapan): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300"><?php echo e(\Carbon\Carbon::parse($kurikulum->tgl_penetapan)->format('d M Y')); ?></span>
                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if($kurikulum->peninjauan_kurikulum): ?>
                                <?php echo e($kurikulum->peninjauan_kurikulum); ?>

                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" onclick="editKurikulum(<?php echo e($kurikulum->id); ?>)" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" onclick="deleteKurikulum(<?php echo e($kurikulum->id); ?>)" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr id="emptyStateRow">
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data Kurikulum</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Klik tombol "Tambah Data Kurikulum" untuk menambahkan data</p>
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
                <?php if($kurikulums instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                    <?php if($kurikulums->total() > 0): ?>
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($kurikulums->firstItem()); ?></span> - <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($kurikulums->lastItem()); ?></span> dari <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($kurikulums->total()); ?></span> data
                    <?php else: ?>
                        Tidak ada data
                    <?php endif; ?>
                <?php else: ?>
                    <?php if($kurikulums->count() > 0): ?>
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">1</span> - <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($kurikulums->count()); ?></span> dari <span class="font-medium text-gray-700 dark:text-gray-200"><?php echo e($kurikulums->count()); ?></span> data
                    <?php else: ?>
                        Tidak ada data
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="flex items-center gap-2">
                <label for="kurikulumPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan Data:</label>
                <select
                    id="kurikulumPerPage"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                    onchange="changeKurikulumPerPage(this.value)"
                >
                    <option value="10" <?php echo e(request('per_page', 10) == 10 ? 'selected' : ''); ?>>
                        10
                    </option>
                    <option value="25" <?php echo e(request('per_page') == 25 ? 'selected' : ''); ?>>
                        25
                    </option>
                    <option value="50" <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>
                        50
                    </option>
                    <option value="100" <?php echo e(request('per_page') == 100 ? 'selected' : ''); ?>>
                        100
                    </option>
                    <option value="all" <?php echo e(request('per_page') == 'all' ? 'selected' : ''); ?>>
                        Semua
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
window.changeKurikulumPerPage = async function(value) {

    const tableWrapper = document.getElementById(
        'kurikulumTableWrapper'
    );

    if (!tableWrapper) {
        return;
    }

    const url = new URL(window.location.href);

    /*
    |--------------------------------------------------------------------------
    | Ambil filter tahun yang sedang aktif
    |--------------------------------------------------------------------------
    */
    const filterTahun = url.searchParams.get(
        'filter_tahun_kurikulum'
    );

    /*
    |--------------------------------------------------------------------------
    | Simpan / hapus jumlah data
    |--------------------------------------------------------------------------
    */
    if (value === '10') {
        url.searchParams.delete('per_page');
    } else {
        url.searchParams.set(
            'per_page',
            value
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Pastikan filter tahun tetap ada
    |--------------------------------------------------------------------------
    */
    if (filterTahun) {
        url.searchParams.set(
            'filter_tahun_kurikulum',
            filterTahun
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Kita tidak menggunakan pagination link.
    | Reset page tetap aman kalau parameter lama masih ada.
    |--------------------------------------------------------------------------
    */
    url.searchParams.delete(
        'kurikulum_page'
    );

    /*
    |--------------------------------------------------------------------------
    | Request partial Kurikulum
    |--------------------------------------------------------------------------
    */
    url.searchParams.set(
        '_partial',
        'kurikulum'
    );

    try {

        tableWrapper.classList.add(
            'opacity-60',
            'pointer-events-none'
        );

        const response = await fetch(
            url.toString(),
            {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            }
        );

        if (!response.ok) {
            throw new Error(
                'Gagal memuat data kurikulum.'
            );
        }

        const html = await response.text();

        /*
        |--------------------------------------------------------------------------
        | Replace hanya table Kurikulum
        |--------------------------------------------------------------------------
        */
        tableWrapper.outerHTML = html;

        /*
        |--------------------------------------------------------------------------
        | Update URL browser
        | Jangan tampilkan _partial
        |--------------------------------------------------------------------------
        */
        const historyUrl = new URL(
            url.toString()
        );

        historyUrl.searchParams.delete(
            '_partial'
        );

        window.history.pushState(
            {},
            '',
            historyUrl.toString()
        );

    } catch (error) {

        console.error(
            'Error pagination kurikulum:',
            error
        );

        const currentWrapper =
            document.getElementById(
                'kurikulumTableWrapper'
            );

        if (currentWrapper) {
            currentWrapper.classList.remove(
                'opacity-60',
                'pointer-events-none'
            );
        }

        if (window.toast?.error) {
            window.toast.error(
                error.message ||
                'Gagal memuat data kurikulum.'
            );
        }
    }
};
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/prodi-pendidikan/prodi-kurikulum/data-table.blade.php ENDPATH**/ ?>