<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'jabatan' => null
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
    'jabatan' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Jabatan Fungsional</h4>
        <button type="button" 
                class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800" 
                onclick="openCreateJabatanModal()">
            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah
        </button>
    </div>

    <div id="jabatanTableContainer" class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Asisten Ahli</th>
                    <th class="px-4 py-3">Lektor</th>
                    <th class="px-4 py-3">Lektor Kepala</th>
                    <th class="px-4 py-3">Guru Besar</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="jabatanTableBody">
                <?php
                    $asistenAhli = $jabatan && $jabatan->exists ? ($jabatan->jumlah_asisten_ahli ?? 0) : 0;
                    $lektor = $jabatan && $jabatan->exists ? ($jabatan->jumlah_lektor ?? 0) : 0;
                    $lektorKepala = $jabatan && $jabatan->exists ? ($jabatan->jumlah_lektor_kepala ?? 0) : 0;
                    $guruBesar = $jabatan && $jabatan->exists ? ($jabatan->jumlah_guru_besar ?? 0) : 0;
                    $total = $asistenAhli + $lektor + $lektorKepala + $guruBesar;
                ?>

                <?php if($jabatan && $jabatan->exists && $total > 0): ?>
                <tr class="border-b border-gray-200 dark:border-gray-700" id="jabatanRow-<?php echo e($jabatan->id); ?>">
                    <td class="px-4 py-2">1</td>
                    <td class="px-4 py-2" id="asistenAhli-<?php echo e($jabatan->id); ?>"><?php echo e($asistenAhli); ?></td>
                    <td class="px-4 py-2" id="lektor-<?php echo e($jabatan->id); ?>"><?php echo e($lektor); ?></td>
                    <td class="px-4 py-2" id="lektorKepala-<?php echo e($jabatan->id); ?>"><?php echo e($lektorKepala); ?></td>
                    <td class="px-4 py-2" id="guruBesar-<?php echo e($jabatan->id); ?>"><?php echo e($guruBesar); ?></td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button"
                                    onclick="openEditJabatanModal(<?php echo e($jabatan->id); ?>)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <button type="button"
                                    onclick="deleteJabatan(<?php echo e($jabatan->id); ?>)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                <tr id="emptyStateRow">
                    <td colspan="6" class="text-center py-8">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data Jabatan Fungsional</span>
                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik tombol Tambah untuk menambahkan data</span>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div id="modalJabatan" 
     tabindex="-1" 
     class="modal-overlay fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 p-4" 
     style="backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);"
     onclick="event.stopPropagation();">
    <div class="relative mx-auto max-w-md top-20" onclick="event.stopPropagation();">
        
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800" onclick="event.stopPropagation();">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalJabatanTitle">Tambah Jabatan Fungsional</h3>
                <button type="button" 
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 text-sm dark:hover:bg-gray-700 dark:hover:text-white" 
                        onclick="closeModal('modalJabatan')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <form id="formJabatan" method="POST" onsubmit="return handleJabatanSubmit(event)">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="formMode" name="mode" value="create">
                    <input type="hidden" id="editId" name="id">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Asisten Ahli</label>
                        <input type="number" name="jumlah_asisten_ahli" id="inputAsistenAhli" required min="0" value="0" class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lektor</label>
                        <input type="number" name="jumlah_lektor" id="inputLektor" required min="0" value="0" class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lektor Kepala</label>
                        <input type="number" name="jumlah_lektor_kepala" id="inputLektorKepala" required min="0" value="0" class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guru Besar</label>
                        <input type="number" name="jumlah_guru_besar" id="inputGuruBesar" required min="0" value="0" class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="button" 
                                class="mr-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700" 
                                onclick="closeModal('modalJabatan')">Batal</button>
                        <button type="submit" id="btnJabatanSubmit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
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

        const ROUTES = {
            store: '<?php echo e(route("prodi.identitas-prodi.jabatan.store")); ?>',
            update: '<?php echo e(route("prodi.identitas-prodi.jabatan.update")); ?>',
            destroy: (id) => '<?php echo e(route("prodi.identitas-prodi.jabatan.destroy", ["id" => ":id"])); ?>'.replace(':id', id),
        };

        const els = {
            form: document.getElementById('formJabatan'),
            mode: document.getElementById('formMode'),
            id: document.getElementById('editId'),
            asistenAhli: document.getElementById('inputAsistenAhli'),
            lektor: document.getElementById('inputLektor'),
            lektorKepala: document.getElementById('inputLektorKepala'),
            guruBesar: document.getElementById('inputGuruBesar'),
            title: document.getElementById('modalJabatanTitle'),
            btnText: document.getElementById('btnText'),
            submit: document.getElementById('btnJabatanSubmit')
        };

        const clearErrors = () => {
            document.querySelectorAll('#formJabatan .is-invalid').forEach(el => {
                el.classList.remove('is-invalid', 'border-red-500');
            });
            document.querySelectorAll('#formJabatan .invalid-feedback').forEach(el => el.remove());
        };

        const showErrors = (errors) => {
            for (const [field, messages] of Object.entries(errors)) {
                const input = document.querySelector(`#formJabatan [name="${field}"]`);
                if (input) {
                    input.classList.add('is-invalid', 'border-red-500');
                    const div = document.createElement('div');
                    div.className = 'invalid-feedback text-red-500 text-xs mt-1';
                    div.innerText = messages[0];
                    input.parentNode.appendChild(div);
                }
            }
        };

        const resetForm = function() {
            els.form.reset();
            els.mode.value = 'create';
            els.id.value = '';
            els.title.textContent = 'Tambah Jabatan Fungsional';
            els.btnText.textContent = 'Simpan';
            els.asistenAhli.value = '0';
            els.lektor.value = '0';
            els.lektorKepala.value = '0';
            els.guruBesar.value = '0';
            clearErrors();
        };

        function showConfirmDialog(title, message, onConfirm, onCancel) {
            const modal = document.getElementById('globalConfirmModal');
            const titleEl = document.getElementById('confirmTitle');
            const messageEl = document.getElementById('confirmMessage');
            const okBtn = document.getElementById('confirmOkBtn');
            const cancelBtn = document.getElementById('confirmCancelBtn');
            const backdrop = document.getElementById('confirmBackdrop');

            titleEl.textContent = title || 'Konfirmasi Hapus';
            messageEl.textContent = message || 'Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';
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
                if (e.target === backdrop) {
                    handleCancel();
                }
            };

            okBtn.addEventListener('click', handleOk);
            cancelBtn.addEventListener('click', handleCancel);
            backdrop.addEventListener('click', handleBackdrop);

            const handleEscape = function(e) {
                if (e.key === 'Escape') {
                    handleCancel();
                    document.removeEventListener('keydown', handleEscape);
                }
            };
            document.addEventListener('keydown', handleEscape);
        }

        // ============================================
        // OPEN CREATE MODAL
        // ============================================
        window.openCreateJabatanModal = function() {
            resetForm();
            openModal('modalJabatan');
        };

        // ============================================
        // OPEN EDIT MODAL
        // ============================================
        window.openEditJabatanModal = function(id) {
            const asistenAhliEl = document.getElementById(`asistenAhli-${id}`);
            const lektorEl = document.getElementById(`lektor-${id}`);
            const lektorKepalaEl = document.getElementById(`lektorKepala-${id}`);
            const guruBesarEl = document.getElementById(`guruBesar-${id}`);
            
            const asistenAhli = parseInt(asistenAhliEl?.textContent?.trim() || 0);
            const lektor = parseInt(lektorEl?.textContent?.trim() || 0);
            const lektorKepala = parseInt(lektorKepalaEl?.textContent?.trim() || 0);
            const guruBesar = parseInt(guruBesarEl?.textContent?.trim() || 0);
            
            els.mode.value = 'edit';
            els.id.value = id;
            els.title.textContent = 'Edit Jabatan Fungsional';
            els.btnText.textContent = 'Perbarui';
            
            clearErrors();
            openModal('modalJabatan');
            
            setTimeout(function() {
                els.asistenAhli.value = asistenAhli;
                els.lektor.value = lektor;
                els.lektorKepala.value = lektorKepala;
                els.guruBesar.value = guruBesar;
            }, 50);
        };

        // ============================================
        // HANDLE SUBMIT
        // ============================================
        window.handleJabatanSubmit = function(event) {
            event.preventDefault();
            event.stopPropagation();

            const mode = els.mode.value;
            const id = els.id.value;
            const formData = new FormData(els.form);
            
            clearErrors();

            const url = mode === 'edit' ? ROUTES.update : ROUTES.store;
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
            cleanData.append('jumlah_asisten_ahli', formData.get('jumlah_asisten_ahli') || 0);
            cleanData.append('jumlah_lektor', formData.get('jumlah_lektor') || 0);
            cleanData.append('jumlah_lektor_kepala', formData.get('jumlah_lektor_kepala') || 0);
            cleanData.append('jumlah_guru_besar', formData.get('jumlah_guru_besar') || 0);
            
            if (mode === 'edit') {
                cleanData.append('_method', 'PUT');
                const updateUrl = `${url}/${id}`;
                
                fetch(updateUrl, {
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
                        toastr?.success(data.message || 'Data berhasil diperbarui.');
                        closeModal('modalJabatan');
                        refreshJabatanTable();
                    } else if (data.errors) {
                        showErrors(data.errors);
                        const msg = Object.values(data.errors).flat().join('\n');
                        toastr?.error(msg);
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
                    els.btnText.textContent = 'Perbarui';
                });
            } else {
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
                        toastr?.success(data.message || 'Data berhasil ditambahkan.');
                        closeModal('modalJabatan');
                        refreshJabatanTable();
                    } else if (data.errors) {
                        showErrors(data.errors);
                        const msg = Object.values(data.errors).flat().join('\n');
                        toastr?.error(msg);
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
                    els.btnText.textContent = 'Simpan';
                });
            }

            return false;
        };

        // ============================================
        // DELETE JABATAN
        // ============================================
        window.deleteJabatan = function(id) {
            showConfirmDialog(
                'Konfirmasi Hapus',
                'Yakin ingin menghapus data Jabatan Fungsional? Nilai akan direset ke 0.',
                function() {
                    const url = ROUTES.destroy(id);

                    fetch(url, {
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
                            toastr?.success('Jabatan Fungsional berhasil direset.');
                            refreshJabatanTable();
                        } else {
                            toastr?.error(data.message || 'Gagal menghapus data');
                        }
                    })
                    .catch(err => {
                        toastr?.error(err.message || 'Terjadi kesalahan pada server.');
                    });
                },
                function() {}
            );
        };

        // ============================================
        // REFRESH TABLE
        // ============================================
        window.refreshJabatanTable = function() {
            const tbody = document.querySelector('#jabatanTableBody');
            if (tbody) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-8">
                            <div class="flex items-center justify-center">
                                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="ml-3 text-gray-600 dark:text-gray-400">Memuat data...</span>
                            </div>
                        </td>
                    </tr>
                `;
            }

            fetch('<?php echo e(route("prodi.identitas-prodi")); ?>', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newBody = doc.querySelector('#jabatanTableBody');
                const currentBody = document.querySelector('#jabatanTableBody');
                
                if (newBody && currentBody) {
                    currentBody.innerHTML = newBody.innerHTML;
                } else {
                    location.reload();
                }
            })
            .catch(() => location.reload());
        };

        // ============================================
        // MODAL HELPERS
        // ============================================
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
    })();
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/identitas-prodi/Jabatan-Fungsional.blade.php ENDPATH**/ ?>