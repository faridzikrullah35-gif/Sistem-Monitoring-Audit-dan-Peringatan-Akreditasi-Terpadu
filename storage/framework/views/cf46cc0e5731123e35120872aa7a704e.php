<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
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
                <label for="filterProdiSarpras" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Prodi:
                </label>
                <select
                    id="filterProdiSarpras"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[200px]"
                >
                    <option value="fakultas">Data Fakultas</option>
                    <option value="all">Semua Prodi</option>
                    <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="prodi-<?php echo e($p->id); ?>"><?php echo e($p->sub_unit ?? $p->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                
                <button
                    type="button"
                    onclick="resetFilterSarpras()"
                    class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700"
                    title="Reset filter ke default"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan: <span id="sarprasDataInfoLabel" class="font-semibold text-gray-700 dark:text-gray-300">Data Fakultas</span>
                    &middot; Total: <span id="sarprasTotalDisplay" class="font-semibold text-gray-700 dark:text-gray-300">0</span> data
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
/**
 * Fallback filter function (dipakai kalau window.filterSarprasByProdi
 * belum di-override oleh data-table).
 */
if (typeof window.filterSarprasByProdi === 'undefined') {
    window.filterSarprasByProdi = function (value) {
        const fakultasRows = document.querySelectorAll('.sarpras-row[data-source="fakultas"]');
        const prodiRows    = document.querySelectorAll('.sarpras-row[data-source="prodi"]');
        const emptyFak     = document.querySelector('.sarpras-empty.fakultas-empty');
        const emptyProdi   = document.querySelector('.sarpras-empty.prodi-empty');
        const infoLabel    = document.getElementById('sarprasDataInfoLabel');

        fakultasRows.forEach(r => r.style.display = 'none');
        prodiRows.forEach(r => r.style.display = 'none');

        let visibleCount = 0;
        let emptyRow = null;

        if (value === 'fakultas') {
            fakultasRows.forEach(r => r.style.display = '');
            visibleCount = fakultasRows.length;
            if (infoLabel) infoLabel.textContent = 'Data Fakultas';
            emptyRow = emptyFak;
            if (emptyProdi) emptyProdi.style.display = 'none';
        } else if (value === 'all') {
            prodiRows.forEach(r => r.style.display = '');
            visibleCount = prodiRows.length;
            if (infoLabel) infoLabel.textContent = 'Semua Prodi';
            emptyRow = emptyProdi;
            if (emptyFak) emptyFak.style.display = 'none';
        } else if (value.startsWith('prodi-')) {
            const pid = String(value.replace('prodi-', '')).trim();
            let count = 0;
            prodiRows.forEach(r => {
                if (String(r.dataset.userId).trim() === pid) {
                    r.style.display = '';
                    count++;
                }
            });
            visibleCount = count;
            if (infoLabel) {
                const opt = document.querySelector(`#filterProdiSarpras option[value="${value}"]`);
                infoLabel.textContent = opt ? opt.textContent : 'Prodi';
            }
            emptyRow = emptyProdi;
            if (emptyFak) emptyFak.style.display = 'none';
        }

        if (emptyRow) emptyRow.style.display = visibleCount > 0 ? 'none' : '';

        const totalDisplay = document.getElementById('sarprasTotalDisplay');
        if (totalDisplay) totalDisplay.textContent = visibleCount;
    };
}

/**
 * Reset filter ke default (fakultas) & reset pagination ke halaman 1.
 */
window.resetFilterSarpras = function () {
    // 1) Reset dropdown ke default
    const sel = document.getElementById('filterProdiSarpras');
    if (sel) sel.value = 'fakultas';

    // 2) Reset pagination state (kalau ada)
    if (window.sarprasPaginationState) {
        window.sarprasPaginationState.filter = 'fakultas';
        window.sarprasPaginationState.currentPage = 1;

        // Panggil render pagination (versi filter-aware)
        if (typeof window.renderSarprasPagination === 'function') {
            window.renderSarprasPagination();
        }
    } else {
        // Fallback: pakai filter biasa
        window.filterSarprasByProdi('fakultas');
    }

    // 3) Reset per-page dropdown ke default (10)
    const perPageSel = document.getElementById('sarprasPerPage');
    if (perPageSel && window.sarprasPaginationState) {
        // Cari opsi default: 10 kalau ada, atau opsi pertama
        const hasTen = Array.from(perPageSel.options).some(o => o.value === '10');
        perPageSel.value = hasTen ? '10' : (perPageSel.options[0]?.value || '10');

        if (hasTen) {
            window.sarprasPaginationState.perPage = 10;
        }
    }

    // 4) Scroll ke tabel (opsional, biar user tahu tabel sudah reset)
    document.getElementById('sarprasFakultasTableContainer')?.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
};

document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('filterProdiSarpras');
    if (sel) {
        sel.addEventListener('change', function () {
            window.filterSarprasByProdi(this.value);
        });
    }

    // Set default
    window.filterSarprasByProdi('fakultas');
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/sarpras-fakultas/filter-section.blade.php ENDPATH**/ ?>