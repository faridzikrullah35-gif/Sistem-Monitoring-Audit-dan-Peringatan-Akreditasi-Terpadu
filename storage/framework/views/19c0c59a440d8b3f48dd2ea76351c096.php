<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'dtpsFakultas' => null,
    'dtpsProdi'    => [],
    'prodi'        => [],
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
    'dtpsFakultas' => null,
    'dtpsProdi'    => [],
    'prodi'        => [],
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
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Jumlah DTPS</h4>

        <div class="flex items-center gap-2">
            
            <select
                id="filterProdiDtps"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterDtpsByProdi(this.value)"
            >
                <option value="fakultas">Data Fakultas</option>
                <option value="all">Semua Prodi</option>
                <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="prodi-<?php echo e($p->id); ?>"><?php echo e($p->sub_unit ?? $p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <button type="button"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800"
                    onclick="openCreateDtpsModal()">
                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    
    <div class="mb-3 text-xs text-gray-500 dark:text-gray-400">
        Menampilkan: <span id="dtpsDataInfoLabel" class="font-medium text-gray-700 dark:text-gray-200">Data Fakultas</span>
    </div>

    <div id="dtpsTableContainer" class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-center w-[50px]">No</th>
                    <th class="px-4 py-3 min-w-[120px]">Prodi</th>
                    <th class="px-4 py-3 min-w-[100px]">Magister</th>
                    <th class="px-4 py-3 min-w-[100px]">Doktor</th>
                    <th class="px-4 py-3 min-w-[100px]">Total</th>
                    <th class="px-4 py-3 text-center w-[140px]">Aksi</th>
                </tr>
            </thead>

            
            <tbody id="dtpsTableBodyFakultas">
                <?php
                    $magisterFak = $dtpsFakultas && $dtpsFakultas->exists ? ($dtpsFakultas->jumlah_magister ?? 0) : 0;
                    $doktorFak   = $dtpsFakultas && $dtpsFakultas->exists ? ($dtpsFakultas->jumlah_doktor ?? 0) : 0;
                    $totalFak    = $dtpsFakultas && $dtpsFakultas->exists ? ($dtpsFakultas->jumlah_total ?? ($magisterFak + $doktorFak)) : 0;
                ?>

                <?php if($dtpsFakultas && $dtpsFakultas->exists && $totalFak > 0): ?>
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                    id="dtpsRow-<?php echo e($dtpsFakultas->id); ?>"
                    data-user-id="<?php echo e($dtpsFakultas->user_id); ?>">
                    <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">1</span>
                    </td>
                    <td class="px-4 py-3 prodi-value">
                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">
                            Fakultas
                        </span>
                    </td>
                    <td class="px-4 py-3 magister-value" data-id="<?php echo e($dtpsFakultas->id); ?>"><?php echo e($magisterFak); ?></td>
                    <td class="px-4 py-3 doktor-value" data-id="<?php echo e($dtpsFakultas->id); ?>"><?php echo e($doktorFak); ?></td>
                    <td class="px-4 py-3 font-semibold text-gray-800 dark:text-white total-value" data-id="<?php echo e($dtpsFakultas->id); ?>">
                        <?php echo e($totalFak); ?>

                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button"
                                    onclick="openEditDtpsModal(<?php echo e($dtpsFakultas->id); ?>)"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30"
                                    title="Edit">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                                </svg> Edit
                            </button>
                            <button type="button"
                                    onclick="deleteDtps(<?php echo e($dtpsFakultas->id); ?>)"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30"
                                    title="Hapus">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                <tr class="empty-row-fakultas">
                    <td colspan="6" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data DTPS Fakultas</span>
                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik tombol Tambah untuk menambahkan data</span>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>

            
            <tbody id="dtpsTableBodyProdi" style="display: none;">
                <?php $__empty_1 = true; $__currentLoopData = $dtpsProdi ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $magister = $item->jumlah_magister ?? 0;
                        $doktor   = $item->jumlah_doktor ?? 0;
                        $total    = $item->jumlah_total ?? ($magister + $doktor);
                        $userId   = optional($item->user)->id;
                    ?>
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                        id="dtpsRowProdi-<?php echo e($item->id); ?>"
                        data-user-id="<?php echo e($userId); ?>">
                        <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300"><?php echo e($loop->iteration); ?></span>
                        </td>
                        <td class="px-4 py-3 prodi-value">
                            <?php echo e(optional($item->user)->sub_unit ?? '-'); ?>

                        </td>
                        <td class="px-4 py-3"><?php echo e($magister); ?></td>
                        <td class="px-4 py-3"><?php echo e($doktor); ?></td>
                        <td class="px-4 py-3 font-semibold text-gray-800 dark:text-white"><?php echo e($total); ?></td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                Read-only
                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="empty-row-prodi">
                    <td colspan="6" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data DTPS Prodi</span>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div id="modalDtps"
     tabindex="-1"
     class="modal-overlay fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 p-4"
     style="backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);"
     onclick="event.stopPropagation();">
    <div class="relative mx-auto max-w-md top-20" onclick="event.stopPropagation();">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800" onclick="event.stopPropagation();">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalDtpsTitle">Tambah DTPS</h3>
                <button type="button"
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 text-sm dark:hover:bg-gray-700 dark:hover:text-white"
                        onclick="closeModal('modalDtps')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <form id="formDtps" method="POST" onsubmit="return handleDtpsSubmit(event)">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="formMode" name="mode" value="create">
                    <input type="hidden" id="editId" name="id">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Magister</label>
                        <input type="number" name="jumlah_magister" id="inputMagister" required min="0"
                               class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doktor</label>
                        <input type="number" name="jumlah_doktor" id="inputDoktor" required min="0"
                               class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <div class="flex justify-end">
                        <button type="button"
                                class="mr-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                                onclick="closeModal('modalDtps')">
                            Batal
                        </button>
                        <button type="submit" id="btnDtpsSubmit"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                            <span id="btnText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php if (isset($component)) { $__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3 = $attributes; } ?>
<?php $component = App\View\Components\Ui\Alert::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Ui\Alert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3)): ?>
<?php $attributes = $__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3; ?>
<?php unset($__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3)): ?>
<?php $component = $__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3; ?>
<?php unset($__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3); ?>
<?php endif; ?>

<script>
    (function() {
        'use strict';

        // ============================================
        // ROUTES
        // ============================================
        const ROUTES = {
            store: '<?php echo e(route("fakultas.identitas-fakultas.dtps.store")); ?>',
            update: (id) => '<?php echo e(route("fakultas.identitas-fakultas.dtps.update", ["id" => ":id"])); ?>'.replace(':id', id),
            destroy: (id) => '<?php echo e(route("fakultas.identitas-fakultas.dtps.destroy", ["id" => ":id"])); ?>'.replace(':id', id),
        };

        const els = {
            form: document.getElementById('formDtps'),
            mode: document.getElementById('formMode'),
            id: document.getElementById('editId'),
            magister: document.getElementById('inputMagister'),
            doktor: document.getElementById('inputDoktor'),
            title: document.getElementById('modalDtpsTitle'),
            btnText: document.getElementById('btnText'),
            submit: document.getElementById('btnDtpsSubmit')
        };

        const clearErrors = () => {
            document.querySelectorAll('#formDtps .is-invalid').forEach(el => {
                el.classList.remove('is-invalid', 'border-red-500');
            });
            document.querySelectorAll('#formDtps .invalid-feedback').forEach(el => el.remove());
        };

        const showErrors = (errors) => {
            for (const [field, messages] of Object.entries(errors)) {
                const input = document.querySelector(`#formDtps [name="${field}"]`);
                if (input) {
                    input.classList.add('is-invalid', 'border-red-500');
                    const div = document.createElement('div');
                    div.className = 'invalid-feedback text-red-500 text-xs mt-1';
                    div.innerText = messages[0];
                    input.parentNode.appendChild(div);
                }
            }
        };

        function showConfirmDialog(title, message, onConfirm, onCancel) {
            const modal = document.getElementById('globalConfirmModal');
            const titleEl = document.getElementById('confirmTitle');
            const messageEl = document.getElementById('confirmMessage');
            const okBtn = document.getElementById('confirmOkBtn');
            const cancelBtn = document.getElementById('confirmCancelBtn');
            const backdrop = document.getElementById('confirmBackdrop');

            titleEl.textContent = title || 'Konfirmasi Hapus';
            messageEl.textContent = message || 'Yakin ingin menghapus data ini?';
            modal.classList.remove('hidden');

            const handleOk = function() {
                modal.classList.add('hidden');
                okBtn.removeEventListener('click', handleOk);
                cancelBtn.removeEventListener('click', handleCancel);
                backdrop.removeEventListener('click', handleBackdrop);
                if (typeof onConfirm === 'function') onConfirm();
            };
            const handleCancel = function() {
                modal.classList.add('hidden');
                okBtn.removeEventListener('click', handleOk);
                cancelBtn.removeEventListener('click', handleCancel);
                backdrop.removeEventListener('click', handleBackdrop);
                if (typeof onCancel === 'function') onCancel();
            };
            const handleBackdrop = function(e) {
                if (e.target === backdrop) handleCancel();
            };

            okBtn.addEventListener('click', handleOk);
            cancelBtn.addEventListener('click', handleCancel);
            backdrop.addEventListener('click', handleBackdrop);
        }

        const resetForm = function() {
            els.form.reset();
            els.mode.value = 'create';
            els.id.value = '';
            els.title.textContent = 'Tambah DTPS';
            els.btnText.textContent = 'Simpan';
            els.magister.value = '0';
            els.doktor.value = '0';
            clearErrors();
        };

        window.openCreateDtpsModal = function() {
            resetForm();
            openModal('modalDtps');
        };

        window.openEditDtpsModal = function(id) {
            const magisterEl = document.querySelector(`.magister-value[data-id="${id}"]`);
            const doktorEl   = document.querySelector(`.doktor-value[data-id="${id}"]`);

            let magister = magisterEl ? parseInt(magisterEl.textContent.trim()) || 0 : 0;
            let doktor   = doktorEl ? parseInt(doktorEl.textContent.trim()) || 0 : 0;

            els.mode.value = 'edit';
            els.id.value = id;
            els.title.textContent = 'Edit DTPS';
            els.btnText.textContent = 'Perbarui';

            els.magister.value = magister;
            els.doktor.value = doktor;

            clearErrors();
            openModal('modalDtps');
        };

        window.handleDtpsSubmit = function(event) {
            event.preventDefault();
            event.stopPropagation();

            const mode = els.mode.value;
            const id = els.id.value;
            const formData = new FormData(els.form);

            clearErrors();

            const url = mode === 'edit' ? ROUTES.update(id) : ROUTES.store;
            const loadingText = mode === 'edit' ? 'Memperbarui...' : 'Menyimpan...';

            els.submit.disabled = true;
            els.btnText.innerHTML = `
                <svg class="animate-spin h-4 w-4 mr-2 inline" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ${loadingText}
            `;

            const cleanData = new FormData();
            cleanData.append('jumlah_magister', formData.get('jumlah_magister') || 0);
            cleanData.append('jumlah_doktor', formData.get('jumlah_doktor') || 0);

            if (mode === 'edit') {
                cleanData.append('_method', 'PUT');
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json',
                },
                body: cleanData
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw data;
                return data;
            })
            .then(data => {
                if (data.status) {
                    const msg = mode === 'edit' ? 'Data berhasil diperbarui.' : 'Data berhasil ditambahkan.';
                    toastr?.success(data.message || msg);
                    closeModal('modalDtps');
                    refreshDtpsTable();
                } else if (data.errors) {
                    showErrors(data.errors);
                    toastr?.error(Object.values(data.errors).flat().join('\n'));
                } else {
                    toastr?.error(data.message || 'Terjadi kesalahan.');
                }
            })
            .catch(err => {
                const msg = err.errors ? Object.values(err.errors).flat().join('\n') : (err.message || 'Terjadi kesalahan pada server.');
                toastr?.error(msg);
            })
            .finally(() => {
                els.submit.disabled = false;
                els.btnText.textContent = mode === 'edit' ? 'Perbarui' : 'Simpan';
            });

            return false;
        };

        window.deleteDtps = function(id) {
            showConfirmDialog(
                'Konfirmasi Hapus',
                'Yakin ingin menghapus data DTPS? Nilai akan direset ke 0.',
                function() {
                    fetch(ROUTES.destroy(id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(async res => {
                        const data = await res.json();
                        if (!res.ok) throw data;
                        return data;
                    })
                    .then(data => {
                        if (data.status) {
                            toastr?.success('Jumlah DTPS berhasil dihapus.');
                            refreshDtpsTable();
                        } else {
                            toastr?.error(data.message || 'Gagal menghapus data');
                        }
                    })
                    .catch(err => toastr?.error(err.message || 'Terjadi kesalahan pada server.'));
                }
            );
        };

        window.refreshDtpsTable = function() {
            fetch('<?php echo e(route("fakultas.identitas-fakultas")); ?>', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Update tbody fakultas
                const newFak = doc.querySelector('#dtpsTableBodyFakultas');
                const curFak = document.querySelector('#dtpsTableBodyFakultas');
                if (newFak && curFak) curFak.innerHTML = newFak.innerHTML;

                // Update tbody prodi
                const newProdi = doc.querySelector('#dtpsTableBodyProdi');
                const curProdi = document.querySelector('#dtpsTableBodyProdi');
                if (newProdi && curProdi) curProdi.innerHTML = newProdi.innerHTML;

                // Re-apply filter
                const filterVal = document.getElementById('filterProdiDtps')?.value || 'fakultas';
                filterDtpsByProdi(filterVal);
            })
            .catch(() => location.reload());
        };

        window.openModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closeModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                resetForm();
            }
        };

        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
            .animate-spin { animation: spin 1s linear infinite; }
        `;
        document.head.appendChild(style);

    })();

    // ============================================
    // FILTER PRODI (di luar IIFE agar bisa dipanggil onchange)
    // ============================================
    function filterDtpsByProdi(value) {
        const tbodyFakultas = document.getElementById('dtpsTableBodyFakultas');
        const tbodyProdi    = document.getElementById('dtpsTableBodyProdi');
        const infoLabel     = document.getElementById('dtpsDataInfoLabel');

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

            const selectedOpt = document.querySelector(`#filterProdiDtps option[value="${value}"]`);
            infoLabel.textContent = selectedOpt ? selectedOpt.textContent : 'Prodi';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        filterDtpsByProdi('fakultas');
    });
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/identitas-fakultas/dtps.blade.php ENDPATH**/ ?>