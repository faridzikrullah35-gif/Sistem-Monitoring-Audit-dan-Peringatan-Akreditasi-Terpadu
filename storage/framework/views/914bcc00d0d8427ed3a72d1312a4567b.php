<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sarprasFakultas' => [],
    'sarprasProdi'    => [],
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
    'sarprasFakultas' => [],
    'sarprasProdi'    => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $totalAll = ($sarprasFakultas ?? collect())->count() + ($sarprasProdi ?? collect())->count();
    $baseOptions = [5, 10, 25, 50, 100];
    $perPageOptions = [];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalAll) $perPageOptions[] = $opt;
    }
    if ($totalAll > 0) $perPageOptions[] = $totalAll;
    $defaultPerPage = $totalAll > 10 ? 10 : ($totalAll > 0 ? $totalAll : 10);
?>


<div
    id="sarprasFakultasTableContainer"
    class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden"
>
    
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-b border-gray-200 px-4 py-3 dark:border-gray-700">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            <span id="sarprasPerPageInfo">Total: <span class="font-semibold text-gray-800 dark:text-gray-200"><?php echo e($totalAll); ?></span> data</span>
        </div>
        <div class="flex items-center gap-2">
            <label for="sarprasPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="sarprasPerPage"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                <?php if($totalAll > 0): ?>
                    <?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isAll = $option === $totalAll;
                            $isSelected = $option === $defaultPerPage;
                        ?>
                        <option value="<?php echo e($option); ?>" <?php echo e($isSelected ? 'selected' : ''); ?>>
                            <?php if($isAll && $totalAll > 100): ?> Semua (<?php echo e($totalAll); ?>)
                            <?php elseif($isAll): ?> Semua
                            <?php else: ?> <?php echo e($option); ?>

                            <?php endif; ?>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <option value="10">10</option>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-12">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[150px]">Prodi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[130px]">Kode</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">Nama Sarana Prasarana</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-24">Jumlah</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-40">File</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">Dibuat Oleh</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">Aksi</th>
                </tr>
            </thead>

            <tbody id="sarprasFakultasTableBody" class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">

                
                <?php $__empty_1 = true; $__currentLoopData = $sarprasFakultas ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="sarpras-row hover:bg-gray-50 dark:hover:bg-gray-700/50 transition align-top"
                        data-source="fakultas"
                        data-user-id="<?php echo e($item->users_id); ?>"
                        data-id="<?php echo e($item->id); ?>">
                        <td class="no whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white text-center align-top"></td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">
                                Fakultas
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <span class="font-medium text-gray-900 dark:text-white"><?php echo e($item->kode); ?></span>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top"><?php echo e($item->nama_sarpras); ?></td>
                        <td class="whitespace-nowrap px-4 py-4 align-top">
                            <?php
                                $statusColors = [
                                    'baik' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                    'rusak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                    'perbaikan' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                ];
                                $statusColor = $statusColors[strtolower($item->status)] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400';
                            ?>
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?php echo e($statusColor); ?>">
                                <?php echo e($item->status); ?>

                            </span>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 text-center align-top"><?php echo e($item->jumlah); ?></td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <?php if($item->file_path): ?>
                                <div class="flex items-center gap-2">
                                    <?php if($item->is_image): ?>
                                        <button onclick="previewImage('<?php echo e($item->file_url); ?>', '<?php echo e($item->file_name); ?>')"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1.5 text-xs font-medium text-blue-700 transition-all hover:bg-blue-100 dark:bg-blue-950/30 dark:text-blue-400 dark:hover:bg-blue-900/40">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Lihat Foto
                                        </button>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('fakultas.sarpras.download', $item->id)); ?>" target="_blank"
                                           class="inline-flex items-center gap-1.5 rounded-lg bg-purple-50 px-2.5 py-1.5 text-xs font-medium text-purple-700 transition-all hover:bg-purple-100 dark:bg-purple-950/30 dark:text-purple-400 dark:hover:bg-purple-900/40">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            Download
                                        </a>
                                    <?php endif; ?>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        (<?php echo e($item->formatted_file_size ?? '0 B'); ?>)
                                    </span>
                                </div>
                            <?php else: ?>
                                <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top"><?php echo e($item->user->name ?? '-'); ?></td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <div class="flex items-center gap-1">
                                <button onclick="openModalFormSarprasFakultas('edit', <?php echo e($item->id); ?>)"
                                    class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                                    title="Edit Data">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" onclick="deleteSarprasFakultas(<?php echo e($item->id); ?>)"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="sarpras-empty fakultas-empty">
                        <td colspan="9" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Sarana Prasarana Fakultas</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Klik tombol "Tambah Sarana Prasarana" untuk membuat data baru.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>

                
                <?php $__empty_1 = true; $__currentLoopData = $sarprasProdi ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="sarpras-row hover:bg-gray-50 dark:hover:bg-gray-700/50 transition align-top"
                        data-source="prodi"
                        data-user-id="<?php echo e($item->users_id); ?>"
                        data-id="<?php echo e($item->id); ?>">
                        <td class="no whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white text-center align-top"></td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <span class="inline-flex items-center rounded-md bg-indigo-100 px-2 py-0.5 text-xs font-medium text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-300">
                                <?php echo e(optional($item->user)->sub_unit ?? '-'); ?>

                            </span>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <span class="font-medium text-gray-900 dark:text-white"><?php echo e($item->kode); ?></span>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top"><?php echo e($item->nama_sarpras); ?></td>
                        <td class="whitespace-nowrap px-4 py-4 align-top">
                            <?php
                                $statusColors = [
                                    'baik' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                    'rusak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                    'perbaikan' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                ];
                                $statusColor = $statusColors[strtolower($item->status)] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400';
                            ?>
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?php echo e($statusColor); ?>">
                                <?php echo e($item->status); ?>

                            </span>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 text-center align-top"><?php echo e($item->jumlah); ?></td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <?php if($item->file_path): ?>
                                <div class="flex items-center gap-2">
                                    <?php if(isset($item->is_image) && $item->is_image): ?>
                                        <button onclick="previewImage('<?php echo e($item->file_url); ?>', '<?php echo e($item->file_name); ?>')"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1.5 text-xs font-medium text-blue-700 transition-all hover:bg-blue-100 dark:bg-blue-950/30 dark:text-blue-400 dark:hover:bg-blue-900/40">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Lihat Foto
                                        </button>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-purple-50 px-2.5 py-1.5 text-xs font-medium text-purple-700 dark:bg-purple-950/30 dark:text-purple-400">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            File
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top"><?php echo e($item->user->name ?? '-'); ?></td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                            <span class="inline-flex items-center whitespace-nowrap rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                Read-only
                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="sarpras-empty prodi-empty" style="display:none;">
                        <td colspan="9" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center text-center">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Sarpras dari Prodi</h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div id="sarprasPaginationContainer" class="border-t border-gray-200 px-4 py-3 dark:border-gray-700"></div>
</div>


<div id="imagePreviewModalFakultas" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
    <div class="relative max-w-4xl mx-4">
        <button onclick="closeImagePreviewFakultas()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="previewImageFakultas" src="" alt="Preview" class="max-h-[80vh] w-auto rounded-lg shadow-2xl">
        <p id="previewImageNameFakultas" class="mt-2 text-center text-sm text-white/80"></p>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // ============================================================
    //  PREVIEW GAMBAR
    // ============================================================
    function previewImage(url, name) {
        const modal = document.getElementById('imagePreviewModalFakultas');
        const img = document.getElementById('previewImageFakultas');
        const imgName = document.getElementById('previewImageNameFakultas');

        img.src = url;
        imgName.textContent = name || 'Foto';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeImagePreviewFakultas() {
        const modal = document.getElementById('imagePreviewModalFakultas');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        document.getElementById('previewImageFakultas').src = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImagePreviewFakultas();
        }
    });

    // ============================================================
    //  PAGINATION STATE
    // ============================================================
    window.sarprasPaginationState = {
        currentPage: 1,
        perPage: <?php echo e($defaultPerPage); ?>,
        filter: 'fakultas',
        totalData: 0
    };

    function getCurrentFilterValue() {
        const sel = document.getElementById('filterProdiSarpras');
        return sel ? sel.value : 'fakultas';
    }

    function getVisibleSarprasRows() {
        const s = window.sarprasPaginationState;
        const all = Array.from(document.querySelectorAll('.sarpras-row'));
        if (s.filter === 'fakultas') return all.filter(r => r.dataset.source === 'fakultas');
        if (s.filter === 'all')      return all.filter(r => r.dataset.source === 'prodi');
        if (s.filter.startsWith('prodi-')) {
            const pid = String(s.filter.replace('prodi-', '')).trim();
            return all.filter(r => r.dataset.source === 'prodi' && String(r.dataset.userId).trim() === pid);
        }
        return [];
    }

    window.renderSarprasPagination = function() {
        const s = window.sarprasPaginationState;
        const allRows = Array.from(document.querySelectorAll('.sarpras-row'));
        allRows.forEach(r => r.style.display = 'none');

        const visible = getVisibleSarprasRows();
        s.totalData = visible.length;

        // Update label
        const infoLabel = document.getElementById('sarprasDataInfoLabel');
        const totalDisplay = document.getElementById('sarprasTotalDisplay');
        if (totalDisplay) totalDisplay.textContent = s.totalData;

        if (infoLabel) {
            if (s.filter === 'fakultas') infoLabel.textContent = 'Data Fakultas';
            else if (s.filter === 'all') infoLabel.textContent = 'Semua Prodi';
            else if (s.filter.startsWith('prodi-')) {
                const opt = document.querySelector(`#filterProdiSarpras option[value="${s.filter}"]`);
                infoLabel.textContent = opt ? opt.textContent : 'Prodi';
            }
        }

        const totalPages = Math.ceil(s.totalData / s.perPage) || 1;
        if (s.currentPage > totalPages) s.currentPage = totalPages;
        if (s.currentPage < 1) s.currentPage = 1;

        const startIndex = (s.currentPage - 1) * s.perPage;
        const endIndex   = Math.min(startIndex + s.perPage, s.totalData);

        visible.forEach((row, idx) => {
            if (idx >= startIndex && idx < endIndex) {
                row.style.display = '';
                const td = row.querySelector('td.no');
                if (td) td.textContent = idx + 1;
            }
        });

        // Toggle empty state
        const fakEmpty = document.querySelector('.sarpras-empty.fakultas-empty');
        const prodiEmpty = document.querySelector('.sarpras-empty.prodi-empty');
        if (fakEmpty) fakEmpty.style.display = (s.filter === 'fakultas' && s.totalData === 0) ? '' : 'none';
        if (prodiEmpty) prodiEmpty.style.display = (s.filter !== 'fakultas' && s.totalData === 0) ? '' : 'none';

        renderSarprasControls(s.currentPage, totalPages, s.totalData, startIndex, endIndex);
    };

    function renderSarprasControls(currentPage, totalPages, totalData, from, to) {
        const container = document.getElementById('sarprasPaginationContainer');
        if (!container) return;
        if (totalData === 0) { container.innerHTML = ''; return; }

        const fromDisplay = from + 1;
        let html = `
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan <span class="font-semibold text-gray-700 dark:text-gray-300">${fromDisplay}</span>
                    sampai <span class="font-semibold text-gray-700 dark:text-gray-300">${to}</span>
                    dari <span class="font-semibold text-gray-700 dark:text-gray-300">${totalData}</span> data
                </div>`;

        if (totalPages > 1) {
            html += `<nav class="flex items-center gap-1">`;
            html += `<button type="button" onclick="goToSarprasPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                    ${currentPage <= 1 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>`;

            const maxVisible = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
            let endPage = Math.min(totalPages, startPage + maxVisible - 1);
            if (endPage - startPage + 1 < maxVisible) startPage = Math.max(1, endPage - maxVisible + 1);

            if (startPage > 1) {
                html += createSarprasPageBtn(1, currentPage);
                if (startPage > 2) html += `<span class="px-2 text-gray-400">...</span>`;
            }
            for (let i = startPage; i <= endPage; i++) html += createSarprasPageBtn(i, currentPage);
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400">...</span>`;
                html += createSarprasPageBtn(totalPages, currentPage);
            }

            html += `<button type="button" onclick="goToSarprasPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                    ${currentPage >= totalPages ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button></nav>`;
        }
        html += `</div>`;
        container.innerHTML = html;
    }

    function createSarprasPageBtn(page, currentPage) {
        const isActive = page === currentPage;
        return `<button type="button" onclick="goToSarprasPage(${page})"
            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-medium transition-colors
                ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'}">
            ${page}
        </button>`;
    }

    window.goToSarprasPage = function(page) {
        const s = window.sarprasPaginationState;
        const totalPages = Math.ceil(s.totalData / s.perPage) || 1;
        if (page < 1 || page > totalPages || page === s.currentPage) return;
        s.currentPage = page;
        renderSarprasPagination();
        document.getElementById('sarprasFakultasTableContainer')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    // Override filter (versi lama hanya sembunyikan row)
    window.filterSarprasByProdi = function(value) {
        window.sarprasPaginationState.filter = value;
        window.sarprasPaginationState.currentPage = 1;
        renderSarprasPagination();
    };

    // Per-page change
    document.addEventListener('DOMContentLoaded', function () {
        const selPerPage = document.getElementById('sarprasPerPage');
        if (selPerPage) {
            selPerPage.addEventListener('change', function () {
                window.sarprasPaginationState.perPage = parseInt(this.value);
                window.sarprasPaginationState.currentPage = 1;
                renderSarprasPagination();
            });
        }

        // Attach filter event (override versi blade filter-section)
        const sel = document.getElementById('filterProdiSarpras');
        if (sel) {
            sel.addEventListener('change', function () {
                filterSarprasByProdi(this.value);
            });
        }

        renderSarprasPagination();
    });

    // ============================================================
    //  DELETE FUNCTION
    // ============================================================
    function deleteSarprasFakultas(id) {
        if (!id) return;
        const url = `<?php echo e(route('fakultas.sarpras.destroy', ['sarpras' => ':id'])); ?>`.replace(':id', id);

        if (typeof window.showConfirmDialog === 'function') {
            window.showConfirmDialog(
                'Konfirmasi Hapus',
                'Apakah Anda yakin ingin menghapus data Sarana Prasarana ini?',
                function() { executeDeleteFakultas(url); }
            );
        } else {
            if (confirm('Apakah Anda yakin ingin menghapus data Sarana Prasarana ini?')) {
                executeDeleteFakultas(url);
            }
        }
    }

    function executeDeleteFakultas(url) {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                window.toast?.success(result.message || 'Data berhasil dihapus');
                setTimeout(function() {
                    if (typeof window.refreshTable === 'function') {
                        window.refreshTable('#sarprasFakultasTableContainer');
                    } else {
                        window.location.reload();
                    }
                }, 300);
            } else {
                window.toast?.error(result.message || 'Gagal menghapus data');
            }
        })
        .catch(error => {
            console.error('Error deleting sarpras:', error);
            window.toast?.error('Terjadi kesalahan saat menghapus data');
        });
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/sarpras-fakultas/data-sarpras-fakultas-table.blade.php ENDPATH**/ ?>