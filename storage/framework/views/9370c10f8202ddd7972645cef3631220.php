<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'pengajarans',
    'tahunPengajaranList',
    'semesterPengajaranList',
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
    'pengajarans',
    'tahunPengajaranList',
    'semesterPengajaranList',
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

                
                <label for="filterProdiPengajaran" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Prodi:
                </label>
                <select
                    id="filterProdiPengajaran"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[180px]"
                >
                    <option value="">Semua Prodi</option>
                    <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->id); ?>" <?php echo e(request('filter_prodi') == $p->id ? 'selected' : ''); ?>>
                            <?php echo e($p->sub_unit ?? $p->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                
                <label for="filterTahunAkademikPengajaran" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    Tahun Akademik:
                </label>
                <select
                    id="filterTahunAkademikPengajaran"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    <?php $__currentLoopData = $tahunPengajaranList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tahun); ?>" <?php echo e(request('filter_tahun_pengajaran') === $tahun ? 'selected' : ''); ?>>
                            <?php echo e($tahun); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                
                <label for="filterSemesterPengajaran" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    Semester:
                </label>
                <select
                    id="filterSemesterPengajaran"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[130px]"
                >
                    <option value="">Semua Semester</option>
                    <?php $__currentLoopData = $semesterPengajaranList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($semester); ?>" <?php echo e(request('filter_semester_pengajaran') === $semester ? 'selected' : ''); ?>>
                            <?php echo e($semester); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <button type="button" onclick="resetFilterPengajaran()"
                    class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span id="totalDataDisplayPengajaran">Total: <span class="font-semibold text-gray-700 dark:text-gray-300"><?php echo e($pengajarans->count()); ?></span> data</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    ['filterTahunAkademikPengajaran', 'filterSemesterPengajaran', 'filterProdiPengajaran']
        .forEach(id => {
            const el = document.getElementById(id);
            if (el) el.addEventListener('change', loadPengajaranWithFilter);
        });
});

window.loadPengajaranWithFilter = async function () {
    const tableWrapper = document.getElementById('pengajaranTableWrapper');
    if (!tableWrapper) return;

    const fTahun    = document.getElementById('filterTahunAkademikPengajaran');
    const fSemester = document.getElementById('filterSemesterPengajaran');
    const fProdi    = document.getElementById('filterProdiPengajaran');

    const url = new URL(window.location.href);

    const tahun = fTahun ? fTahun.value : '';
    const semester = fSemester ? fSemester.value : '';
    const prodiId = fProdi ? fProdi.value : '';

    if (tahun) url.searchParams.set('filter_tahun_pengajaran', tahun);
    else url.searchParams.delete('filter_tahun_pengajaran');

    if (semester) url.searchParams.set('filter_semester_pengajaran', semester);
    else url.searchParams.delete('filter_semester_pengajaran');

    if (prodiId) url.searchParams.set('filter_prodi', prodiId);
    else url.searchParams.delete('filter_prodi');

    url.searchParams.delete('pengajaran_page');
    url.searchParams.set('_partial', 'pengajaran');

    try {
        tableWrapper.classList.add('opacity-60', 'pointer-events-none');

        const response = await fetch(url.toString(), {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' }
        });

        if (!response.ok) throw new Error('Gagal memuat data pengajaran.');

        const html = await response.text();
        tableWrapper.outerHTML = html;

        const historyUrl = new URL(url.toString());
        historyUrl.searchParams.delete('_partial');
        window.history.pushState({}, '', historyUrl.toString());

        document.dispatchEvent(new Event('DOMContentLoaded'));
    } catch (error) {
        console.error('Error filter pengajaran:', error);
        const currentWrapper = document.getElementById('pengajaranTableWrapper');
        if (currentWrapper) currentWrapper.classList.remove('opacity-60', 'pointer-events-none');
        if (window.toast?.error) window.toast.error(error.message || 'Gagal memuat data pengajaran.');
    }
};

window.resetFilterPengajaran = function () {
    const fTahun    = document.getElementById('filterTahunAkademikPengajaran');
    const fSemester = document.getElementById('filterSemesterPengajaran');
    const fProdi    = document.getElementById('filterProdiPengajaran');

    if (fTahun) fTahun.value = '';
    if (fSemester) fSemester.value = '';
    if (fProdi) fProdi.value = '';

    loadPengajaranWithFilter();
};
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/fakultas-pendidikan/prodi-pengajaran/filter-section.blade.php ENDPATH**/ ?>