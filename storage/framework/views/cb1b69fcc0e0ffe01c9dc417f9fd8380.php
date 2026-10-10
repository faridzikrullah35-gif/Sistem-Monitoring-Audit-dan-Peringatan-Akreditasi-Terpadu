<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'dokumenRenstraFakultas' => [],
    'dokumenRenstraProdi'    => [],
    'prodi'                  => [],
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
    'dokumenRenstraFakultas' => [],
    'dokumenRenstraProdi'    => [],
    'prodi'                  => [],
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
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Rencana Strategis</h4>

        <div class="flex items-center gap-2">
            
            <select
                id="filterProdiRenstra"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterRenstraByProdi(this.value)"
            >
                <option value="fakultas">Data Fakultas</option>
                <option value="all">Semua Prodi</option>
                <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="prodi-<?php echo e($p->id); ?>"><?php echo e($p->sub_unit ?? $p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <button type="button" class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800" onclick="openModalRenstra()">
                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah
            </button>
        </div>
    </div>

    
    <div class="mb-3 text-xs text-gray-500 dark:text-gray-400">
        Menampilkan: <span id="renstraDataInfoLabel" class="font-medium text-gray-700 dark:text-gray-200">Data Fakultas</span>
    </div>

    <div id="renstraTableContainer" class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-center w-[50px]">No</th>
                    <th class="px-4 py-3 min-w-[120px]">Prodi</th>
                    <th class="px-4 py-3 min-w-[150px]">Nama Dokumen</th>
                    <th class="px-4 py-3 min-w-[120px]">File</th>
                    <th class="px-4 py-3 min-w-[120px]">Tgl Penetapan</th>
                    <th class="px-4 py-3 min-w-[120px]">Tgl Revisi</th>
                    <th class="px-4 py-3 min-w-[120px]">Keterangan</th>
                    <th class="px-4 py-3 text-center w-[120px]">Aksi</th>
                </tr>
            </thead>

            
            <tbody id="renstraTableBodyFakultas">
                <?php $__empty_1 = true; $__currentLoopData = $dokumenRenstraFakultas ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                    id="renstraRow-<?php echo e($item->id); ?>"
                    data-user-id="<?php echo e($item->user_id); ?>">
                    <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300"><?php echo e($loop->iteration); ?></span>
                    </td>
                    <td class="px-4 py-3 prodi-value">
                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">
                            Fakultas
                        </span>
                    </td>
                    <td class="px-4 py-3 nama-dokumen-value"><?php echo e($item->nama_dokumen); ?></td>
                    <td class="px-4 py-3">
                        <?php if($item->file_path): ?>
                            <a href="<?php echo e(Storage::url($item->file_path)); ?>" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download PDF
                            </a>
                        <?php else: ?>
                            <span class="text-gray-400 dark:text-gray-500">File tidak tersedia</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 tanggal-penetapan-value"><?php echo e(\Carbon\Carbon::parse($item->tanggal_penetapan)->format('d/m/Y')); ?></td>
                    <td class="px-4 py-3 tanggal-revisi-value"><?php echo e($item->tanggal_revisi ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y') : '-'); ?></td>
                    <td class="px-4 py-3 keterangan-value"><?php echo e($item->keterangan ?? '-'); ?></td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button"
                                class="btn-edit-renstra inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30"
                                title="Edit">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                                </svg> Edit
                            </button>
                            <button type="button"
                                onclick="deleteRenstra(<?php echo e($item->id); ?>)"
                                class="btn-delete-renstra inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30"
                                title="Hapus">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="empty-row-fakultas">
                    <td colspan="8" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data RENSTRA Fakultas</span>
                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik tombol Tambah untuk menambahkan data</span>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>

            
            <tbody id="renstraTableBodyProdi" style="display: none;">
                <?php $__empty_1 = true; $__currentLoopData = $dokumenRenstraProdi ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                    id="renstraRowProdi-<?php echo e($item->id); ?>"
                    data-user-id="<?php echo e(optional(optional($item->profilProdi)->user)->id ?? ''); ?>">
                    <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300"><?php echo e($loop->iteration); ?></span>
                    </td>
                    <td class="px-4 py-3 prodi-value">
                        <?php echo e(optional(optional($item->profilProdi)->user)->sub_unit ?? '-'); ?>

                    </td>
                    <td class="px-4 py-3 nama-dokumen-value"><?php echo e($item->nama_dokumen); ?></td>
                    <td class="px-4 py-3">
                        <?php if($item->file): ?>
                            <a href="<?php echo e(Storage::url($item->file)); ?>" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download PDF
                            </a>
                        <?php else: ?>
                            <span class="text-gray-400 dark:text-gray-500">File tidak tersedia</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 tanggal-penetapan-value"><?php echo e(\Carbon\Carbon::parse($item->tanggal_penetapan)->format('d/m/Y')); ?></td>
                    <td class="px-4 py-3 tanggal-revisi-value"><?php echo e($item->tanggal_revisi ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y') : '-'); ?></td>
                    <td class="px-4 py-3 keterangan-value"><?php echo e($item->keterangan ?? '-'); ?></td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                            Read-only
                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="empty-row-prodi">
                    <td colspan="8" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data RENSTRA Prodi</span>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo $__env->make('components.identitas-fakultas.modal.modal-renstra', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
function filterRenstraByProdi(value) {
    const tbodyFakultas = document.getElementById('renstraTableBodyFakultas');
    const tbodyProdi    = document.getElementById('renstraTableBodyProdi');
    const infoLabel     = document.getElementById('renstraDataInfoLabel');

    tbodyFakultas.style.display = 'none';
    tbodyProdi.style.display    = 'none';

    tbodyProdi.querySelectorAll('tr[data-user-id]').forEach(tr => {
        tr.style.display = '';
    });

    if (value === 'fakultas') {
        tbodyFakultas.style.display = '';
        infoLabel.textContent = 'Data Fakultas';
    } else if (value === 'all') {
        tbodyProdi.style.display = '';
        infoLabel.textContent = 'Semua Prodi';

        const hasData = tbodyProdi.querySelectorAll('tr[data-user-id]').length > 0;
        const emptyRow = tbodyProdi.querySelector('.empty-row-prodi');
        if (emptyRow) emptyRow.style.display = hasData ? 'none' : '';
    } else if (value.startsWith('prodi-')) {
        const prodiId = String(value.replace('prodi-', '')).trim();
        tbodyProdi.style.display = '';

        let visibleCount = 0;
        tbodyProdi.querySelectorAll('tr[data-user-id]').forEach(tr => {
            const rowUserId = String(tr.getAttribute('data-user-id') || '').trim();
            if (rowUserId === prodiId) {
                tr.style.display = '';
                visibleCount++;
            } else {
                tr.style.display = 'none';
            }
        });

        const emptyRow = tbodyProdi.querySelector('.empty-row-prodi');
        if (emptyRow) emptyRow.style.display = visibleCount > 0 ? 'none' : '';

        const selectedOpt = document.querySelector(`#filterProdiRenstra option[value="${value}"]`);
        infoLabel.textContent = selectedOpt ? selectedOpt.textContent : 'Prodi';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    filterRenstraByProdi('fakultas');
});
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/identitas-fakultas/renstra.blade.php ENDPATH**/ ?>