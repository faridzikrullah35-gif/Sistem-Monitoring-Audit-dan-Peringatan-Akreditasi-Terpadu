<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'mahasiswaProdi' => [],
    'prodi'          => [],
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
    'mahasiswaProdi' => [],
    'prodi'          => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Jumlah Mahasiswa</h4>

        <div class="flex items-center gap-2">
            
            <button
                type="button"
                onclick="handlePrintMahasiswaFakultas(event)"
                class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition-all duration-200"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print
            </button>

            
            <select
                id="filterProdiMahasiswa"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterMahasiswaByProdi(this.value)"
            >
                <option value="all">Semua Prodi</option>
                <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="prodi-<?php echo e($p->id); ?>"><?php echo e($p->sub_unit ?? $p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="mb-3 text-xs text-gray-500 dark:text-gray-400">
        Menampilkan: <span id="mahasiswaDataInfoLabel" class="font-medium text-gray-700 dark:text-gray-200">Semua Prodi</span>
    </div>

    <div id="mahasiswaTableContainer" class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-center w-[50px]">No</th>
                    <th class="px-4 py-3 min-w-[140px]">Prodi</th>
                    <th class="px-4 py-3 min-w-[140px]">Jumlah Mahasiswa</th>
                    <th class="px-4 py-3 min-w-[140px]">Tahun Akademik</th>
                </tr>
            </thead>
            <tbody id="mahasiswaTableBodyProdi">
                <?php $__empty_1 = true; $__currentLoopData = $mahasiswaProdi ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $jumlahMhs = (int) ($item->jumlah_mahasiswa ?? 0);
                        $tahunAk   = $item->tahun_akademik ?? '';
                        $userId    = optional($item->user)->id;
                    ?>
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                        data-user-id="<?php echo e($userId); ?>">
                        <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300"><?php echo e($loop->iteration); ?></span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200"><?php echo e(optional($item->user)->sub_unit ?? '-'); ?></td>
                        <td class="px-4 py-3"><?php echo e($jumlahMhs); ?></td>
                        <td class="px-4 py-3"><?php echo e($tahunAk ?: '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="empty-row-prodi">
                    <td colspan="4" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data Mahasiswa Prodi</span>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function filterMahasiswaByProdi(value) {
    const tbody     = document.getElementById('mahasiswaTableBodyProdi');
    const infoLabel = document.getElementById('mahasiswaDataInfoLabel');

    tbody.querySelectorAll('tr[data-user-id]').forEach(tr => tr.style.display = '');

    if (value === 'all') {
        infoLabel.textContent = 'Semua Prodi';
        const hasData = tbody.querySelectorAll('tr[data-user-id]').length > 0;
        const emptyRow = tbody.querySelector('.empty-row-prodi');
        if (emptyRow) emptyRow.style.display = hasData ? 'none' : '';
    } else if (value.startsWith('prodi-')) {
        const prodiId = String(value.replace('prodi-', '')).trim();
        let visibleCount = 0;

        tbody.querySelectorAll('tr[data-user-id]').forEach(tr => {
            const rowUserId = String(tr.getAttribute('data-user-id') || '').trim();
            if (rowUserId === prodiId) {
                tr.style.display = '';
                visibleCount++;
            } else {
                tr.style.display = 'none';
            }
        });

        const emptyRow = tbody.querySelector('.empty-row-prodi');
        if (emptyRow) emptyRow.style.display = visibleCount > 0 ? 'none' : '';

        const selectedOpt = document.querySelector(`#filterProdiMahasiswa option[value="${value}"]`);
        infoLabel.textContent = selectedOpt ? selectedOpt.textContent : 'Prodi';
    }
}

// ============================================================
//  HANDLE PRINT MAHASISWA (filter-aware)
// ============================================================
window.handlePrintMahasiswaFakultas = function(event) {
    if (event) event.preventDefault();

    const sel = document.getElementById('filterProdiMahasiswa');
    const filterSource = sel ? sel.value : 'all';

    const baseUrl = '<?php echo e(route("fakultas.identitas-fakultas.mahasiswa.print")); ?>';
    const params = new URLSearchParams();
    if (filterSource) params.append('filter_source', filterSource);

    const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
    window.open(url, '_blank');
    return false;
};

document.addEventListener('DOMContentLoaded', function () {
    filterMahasiswaByProdi('all');
});
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/identitas-fakultas/mahasiswa.blade.php ENDPATH**/ ?>