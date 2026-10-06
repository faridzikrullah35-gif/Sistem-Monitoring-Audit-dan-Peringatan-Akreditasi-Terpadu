<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'publikasi',
    'tahunList',
    'jenisList',
    'prodi' => [],
    'filterProdi' => null,
    'filterTahun' => null,
    'filterJenis' => null,
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
    'publikasi',
    'tahunList',
    'jenisList',
    'prodi' => [],
    'filterProdi' => null,
    'filterTahun' => null,
    'filterJenis' => null,
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

                
                <label for="filterProdiPublikasi" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Prodi:
                </label>
                <select
                    id="filterProdiPublikasi"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[180px]"
                >
                    <option value="">Semua Prodi</option>
                    <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($p->id); ?>"
                            <?php echo e((string) $filterProdi === (string) $p->id ? 'selected' : ''); ?>

                        >
                            <?php echo e($p->sub_unit ?? $p->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                
                <label for="filterTahunPublikasi" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Tahun Akademik:
                </label>
                <select
                    id="filterTahunPublikasi"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($tahun); ?>"
                            <?php echo e((string) $filterTahun === (string) $tahun ? 'selected' : ''); ?>

                        >
                            <?php echo e($tahun); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                
                <label for="filterJenisPublikasi" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    Jenis:
                </label>
                <select
                    id="filterJenisPublikasi"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Jenis</option>
                    <?php $__currentLoopData = $jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($jenis); ?>"
                            <?php echo e((string) $filterJenis === (string) $jenis ? 'selected' : ''); ?>

                        >
                            <?php echo e($jenis); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <button
                    type="button"
                    onclick="resetFilterPublikasi()"
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
                    <span id="totalDataDisplayPublikasi">Total: <span class="font-semibold text-gray-700 dark:text-gray-300"><?php echo e($publikasi instanceof \Illuminate\Pagination\LengthAwarePaginator ? $publikasi->total() : $publikasi->count()); ?></span> data</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        ['filterTahunPublikasi', 'filterProdiPublikasi', 'filterJenisPublikasi']
            .forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('change', applyFilterPublikasi);
            });
    });

    function applyFilterPublikasi() {
        const wrapper = document.getElementById('publikasiTableWrapper');
        if (!wrapper) return;

        const fTahun = document.getElementById('filterTahunPublikasi');
        const fProdi = document.getElementById('filterProdiPublikasi');
        const fJenis = document.getElementById('filterJenisPublikasi');

        const url = new URL(window.location.href);

        const tahun   = fTahun ? fTahun.value : '';
        const prodiId = fProdi ? fProdi.value : '';
        const jenis   = fJenis ? fJenis.value : '';

        if (tahun)   url.searchParams.set('filter_tahun_akademik', tahun);
        else         url.searchParams.delete('filter_tahun_akademik');

        if (prodiId) url.searchParams.set('filter_prodi', prodiId);
        else         url.searchParams.delete('filter_prodi');

        if (jenis)   url.searchParams.set('filter_jenis_publikasi', jenis);
        else         url.searchParams.delete('filter_jenis_publikasi');

        url.searchParams.delete('publikasi_page');
        url.searchParams.set('_partial', 'publikasi');

        fetchAndReplacePublikasiTable(url);
    }

    async function fetchAndReplacePublikasiTable(url) {
        const wrapper = document.getElementById('publikasiTableWrapper');
        if (!wrapper) return;

        try {
            wrapper.classList.add('opacity-60', 'pointer-events-none');

            const res = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            });

            if (!res.ok) throw new Error('Gagal memuat data publikasi.');

            const html = await res.text();
            wrapper.outerHTML = html;

            const cleanUrl = new URL(url.toString());
            cleanUrl.searchParams.delete('_partial');
            window.history.pushState({}, '', cleanUrl.toString());

            document.dispatchEvent(new Event('publikasi:table:reloaded'));
        } catch (err) {
            console.error(err);
            const current = document.getElementById('publikasiTableWrapper');
            current?.classList.remove('opacity-60', 'pointer-events-none');
            if (window.toast?.error) window.toast.error(err.message);
        }
    }

    window.resetFilterPublikasi = function () {
        const fTahun = document.getElementById('filterTahunPublikasi');
        const fProdi = document.getElementById('filterProdiPublikasi');
        const fJenis = document.getElementById('filterJenisPublikasi');

        if (fTahun) fTahun.value = '';
        if (fProdi) fProdi.value = '';
        if (fJenis) fJenis.value = '';

        applyFilterPublikasi();
    };
})();
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/fakultas-publikasi-ilmiah/filter-section.blade.php ENDPATH**/ ?>