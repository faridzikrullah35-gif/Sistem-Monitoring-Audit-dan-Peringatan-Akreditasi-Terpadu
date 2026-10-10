<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'rasioProdi' => [],
    'prodi'      => [],
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
    'rasioProdi' => [],
    'prodi'      => [],
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
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Rasio Dosen : Mahasiswa</h4>

        <div class="flex items-center gap-2">
            <select
                id="filterProdiRasio"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterRasioByProdi(this.value)"
            >
                <option value="all">Semua Prodi</option>
                <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="prodi-<?php echo e($p->id); ?>"><?php echo e($p->sub_unit ?? $p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="mb-3 text-xs text-gray-500 dark:text-gray-400">
        Menampilkan: <span id="rasioDataInfoLabel" class="font-medium text-gray-700 dark:text-gray-200">Semua Prodi</span>
    </div>

    <div id="rasioProdiContainer">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-center w-[50px]">No</th>
                        <th class="px-4 py-3 min-w-[140px]">Prodi</th>
                        <th class="px-4 py-3 min-w-[140px]">Total Dosen (S2 + S3)</th>
                        <th class="px-4 py-3 min-w-[120px]">Jumlah Mahasiswa</th>
                        <th class="px-4 py-3 min-w-[110px]">Rasio</th>
                    </tr>
                </thead>
                <tbody id="rasioTableBodyProdi">
                    <?php $__empty_1 = true; $__currentLoopData = $rasioProdi ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $mgr    = (int) ($item->jumlah_magister ?? 0);
                            $dkt    = (int) ($item->jumlah_doktor ?? 0);
                            $mhs    = (int) ($item->jumlah_mahasiswa ?? 0);
                            $totalD = $mgr + $dkt;
                            $rasio  = $totalD > 0 ? round($mhs / $totalD, 2) : 0;
                            $userId = optional($item->user)->id;
                        ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                            data-user-id="<?php echo e($userId); ?>">
                            <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300"><?php echo e($loop->iteration); ?></span>
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200"><?php echo e(optional($item->user)->sub_unit ?? '-'); ?></td>
                            <td class="px-4 py-3">
                                <?php echo e($totalD); ?>

                                <span class="text-xs text-gray-400 dark:text-gray-500">(S2: <?php echo e($mgr); ?>, S3: <?php echo e($dkt); ?>)</span>
                            </td>
                            <td class="px-4 py-3"><?php echo e($mhs); ?></td>
                            <td class="px-4 py-3 font-semibold text-gray-800 dark:text-white">
                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">
                                    1 : <?php echo e($rasio); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="empty-row-prodi">
                        <td colspan="5" class="text-center py-12">
                            <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <span class="text-sm font-medium">Belum ada data Rasio Prodi</span>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterRasioByProdi(value) {
    const tbody     = document.getElementById('rasioTableBodyProdi');
    const infoLabel = document.getElementById('rasioDataInfoLabel');

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

        const selectedOpt = document.querySelector(`#filterProdiRasio option[value="${value}"]`);
        infoLabel.textContent = selectedOpt ? selectedOpt.textContent : 'Prodi';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    filterRasioByProdi('all');
});
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/identitas-fakultas/rasio.blade.php ENDPATH**/ ?>