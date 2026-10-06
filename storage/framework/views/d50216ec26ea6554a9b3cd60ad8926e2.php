<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'kurikulums',
    'tahunKurikulumList',
    'prodi' => [],
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
    'kurikulums',
    'tahunKurikulumList',
    'prodi' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
    <div class="p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3 flex-wrap">

                
                <label for="filterProdiKurikulum" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Prodi:
                </label>
                <select
                    id="filterProdiKurikulum"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[180px]"
                >
                    <option value="">Semua Prodi</option>
                    <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($p->id); ?>"
                            <?php echo e(request('filter_prodi') == $p->id ? 'selected' : ''); ?>

                        >
                            <?php echo e($p->sub_unit ?? $p->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                
                <label for="filterTahunAkademikKurikulum" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Tahun Akademik:
                </label>
                <select
                    id="filterTahunAkademikKurikulum"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    <?php $__currentLoopData = $tahunKurikulumList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tahun); ?>" <?php echo e(request('filter_tahun_kurikulum') === $tahun ? 'selected' : ''); ?>>
                            <?php echo e($tahun); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <button
                    type="button"
                    onclick="resetFilterKurikulum()"
                    class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span id="totalDataDisplayKurikulum">Total: <span class="font-semibold text-gray-700 dark:text-gray-300"><?php echo e($kurikulums->count()); ?></span> data</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterTahun = document.getElementById('filterTahunAkademikKurikulum');
    const filterProdi = document.getElementById('filterProdiKurikulum');

    if (filterTahun) filterTahun.addEventListener('change', loadKurikulumWithFilter);
    if (filterProdi) filterProdi.addEventListener('change', loadKurikulumWithFilter);
});

async function loadKurikulumWithFilter() {
    const tableWrapper = document.getElementById('kurikulumTableWrapper');
    if (!tableWrapper) return;

    const filterTahun = document.getElementById('filterTahunAkademikKurikulum');
    const filterProdi = document.getElementById('filterProdiKurikulum');

    const url = new URL(window.location.href);

    const tahun = filterTahun ? filterTahun.value : '';
    const prodiId = filterProdi ? filterProdi.value : '';

    if (tahun) url.searchParams.set('filter_tahun_kurikulum', tahun);
    else url.searchParams.delete('filter_tahun_kurikulum');

    if (prodiId) url.searchParams.set('filter_prodi', prodiId);
    else url.searchParams.delete('filter_prodi');

    url.searchParams.delete('kurikulum_page');
    url.searchParams.set('_partial', 'kurikulum');

    try {
        tableWrapper.classList.add('opacity-60', 'pointer-events-none');

        const response = await fetch(url.toString(), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
            }
        });

        if (!response.ok) throw new Error('Gagal memuat data kurikulum.');

        const html = await response.text();
        tableWrapper.outerHTML = html;

        // Reload filter-section juga biar list tahun & prodi tetap update
        // (optional; kalau mau refresh filter tahunnya)
        const historyUrl = new URL(url.toString());
        historyUrl.searchParams.delete('_partial');
        window.history.pushState({}, '', historyUrl.toString());

        // Re-init event listener
        document.dispatchEvent(new Event('DOMContentLoaded'));

    } catch (error) {
        console.error(error);
        const currentWrapper = document.getElementById('kurikulumTableWrapper');
        if (currentWrapper) currentWrapper.classList.remove('opacity-60', 'pointer-events-none');
        if (window.toast?.error) window.toast.error(error.message || 'Gagal memuat data kurikulum.');
    }
}

window.resetFilterKurikulum = function() {
    const filterTahun = document.getElementById('filterTahunAkademikKurikulum');
    const filterProdi = document.getElementById('filterProdiKurikulum');

    if (filterTahun) filterTahun.value = '';
    if (filterProdi) filterProdi.value = '';

    loadKurikulumWithFilter();
};
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/fakultas-pendidikan/prodi-kurikulum/filter-section.blade.php ENDPATH**/ ?>