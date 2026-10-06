
<div
    id="modalFormSarprasFakultas"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6"
>
    <div class="mx-4 w-full max-w-lg animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>
                </div>
                <h3 id="modalFormSarprasFakultasTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Sarana Prasarana
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalFormSarprasFakultas()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        
        <form
            id="sarprasFakultasForm"
            action="<?php echo e(route('fakultas.sarpras.store')); ?>"
            method="POST"
            enctype="multipart/form-data"
        >
            <?php echo csrf_field(); ?>
            <input type="hidden" id="formMethodFakultas" name="_method" value="POST">
            <input type="hidden" id="sarprasFakultasId" name="id" value="">

            <div class="space-y-4 px-6 py-5">

                
                <div>
                    <label for="kode" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Kode Sarana Prasarana <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="kode"
                        name="kode"
                        placeholder="Contoh: SPR-001"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500"
                        required
                        maxlength="255"
                    />
                    <p id="kodeError" class="mt-1 text-xs text-red-500 hidden"></p>
                </div>

                
                <div>
                    <label for="nama_sarpras" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Sarana Prasarana <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_sarpras"
                        name="nama_sarpras"
                        placeholder="Masukkan nama sarana/prasarana"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500"
                        required
                        maxlength="255"
                    />
                    <p id="nama_sarprasError" class="mt-1 text-xs text-red-500 hidden"></p>
                </div>

                
                <div>
                    <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85"
                        required
                    >
                        <option value="">Pilih Status</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Perbaikan">Perbaikan</option>
                    </select>
                    <p id="statusError" class="mt-1 text-xs text-red-500 hidden"></p>
                </div>

                
                <div>
                    <label for="jumlah" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jumlah <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="number"
                        id="jumlah"
                        name="jumlah"
                        placeholder="Masukkan jumlah"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500"
                        required
                        min="0"
                    />
                    <p id="jumlahError" class="mt-1 text-xs text-red-500 hidden"></p>
                </div>

                
                <div>
                    <label for="file" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upload File (Foto/Dokumen)
                    </label>
                    <input
                        type="file"
                        id="file"
                        name="file"
                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 transition-colors file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:file:bg-blue-950/30 dark:file:text-blue-400 dark:hover:file:bg-blue-900/40"
                    />
                    <div class="mt-1.5 flex flex-wrap items-center gap-2">
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            <svg class="inline h-3.5 w-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Maksimal 5MB
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            <svg class="inline h-3.5 w-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Format: JPG, JPEG, PNG, PDF, DOC, DOCX
                        </span>
                    </div>
                    
                    
                    <div id="currentFileInfoFakultas" class="mt-2 hidden">
                        <div class="rounded-lg bg-blue-50 p-3 dark:bg-blue-950/20">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="text-sm text-blue-700 dark:text-blue-400">
                                    File saat ini: <span id="currentFileNameFakultas"></span>
                                </span>
                                <span class="text-xs text-blue-600 dark:text-blue-400" id="currentFileSizeFakultas"></span>
                            </div>
                            <p class="mt-1 text-xs text-blue-600 dark:text-blue-400">
                                * Upload file baru untuk mengganti file saat ini
                            </p>
                        </div>
                    </div>
                    <p id="fileError" class="mt-1 text-xs text-red-500 hidden"></p>
                </div>

                
                <div id="formLoadingFakultas" class="hidden text-center py-2">
                    <svg class="animate-spin h-5 w-5 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">Menyimpan...</span>
                </div>

            </div>

            
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalFormSarprasFakultas()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Batal
                </button>
                <button
                    type="button"
                    onclick="submitSarprasFakultasForm()"
                    id="submitButtonFakultas"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="submitTextFakultas">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    let isSubmittingFakultas = false;
    let baseUrlFakultas = '<?php echo e(route("fakultas.sarpras.store")); ?>';

    // Open modal form
    function openModalFormSarprasFakultas(action, id = null) {
        const modal = document.getElementById('modalFormSarprasFakultas');
        const title = document.getElementById('modalFormSarprasFakultasTitle');
        const form = document.getElementById('sarprasFakultasForm');
        const methodInput = document.getElementById('formMethodFakultas');
        const idInput = document.getElementById('sarprasFakultasId');
        const submitText = document.getElementById('submitTextFakultas');
        const fileInput = document.getElementById('file');
        const currentFileInfo = document.getElementById('currentFileInfoFakultas');

        // Reset form
        form.reset();
        clearErrorsFakultas();
        currentFileInfo.classList.add('hidden');
        fileInput.value = '';

        // OPEN MODAL
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        if (action === 'create') {
            title.textContent = 'Tambah Sarana Prasarana';
            methodInput.value = 'POST';
            idInput.value = '';
            submitText.textContent = 'Simpan';
            form.action = baseUrlFakultas;

        } else if (action === 'edit' && id) {
            title.textContent = 'Edit Sarana Prasarana';
            methodInput.value = 'PUT';
            idInput.value = id;
            submitText.textContent = 'Update';
            form.action = `<?php echo e(route("fakultas.sarpras.update", ['sarpras' => ':id'])); ?>`.replace(':id', id);

            // Fetch data untuk diisi ke form
            fetch(`<?php echo e(route("fakultas.sarpras.show", ['sarpras' => ':id'])); ?>`.replace(':id', id), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data Sarana Prasarana');
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.success) {
                        const data = result.data;
                        document.getElementById('kode').value = data.kode ?? '';
                        document.getElementById('nama_sarpras').value = data.nama_sarpras ?? '';
                        document.getElementById('status').value = data.status ?? '';
                        document.getElementById('jumlah').value = data.jumlah ?? 0;

                        // Tampilkan info file jika ada
                        if (data.file_path) {
                            currentFileInfo.classList.remove('hidden');
                            document.getElementById('currentFileNameFakultas').textContent = data.file_name || 'File';
                            document.getElementById('currentFileSizeFakultas').textContent = data.formatted_file_size ? `(${data.formatted_file_size})` : '';
                        }
                    } else {
                        window.toast?.error(result.message || 'Gagal mengambil data Sarana Prasarana');
                        closeModalFormSarprasFakultas();
                    }
                })
                .catch(error => {
                    console.error('Error fetching sarpras detail:', error);
                    window.toast?.error('Terjadi kesalahan saat mengambil data');
                    closeModalFormSarprasFakultas();
                });
        }

        // FOCUS ke field pertama
        setTimeout(() => {
            document.getElementById('kode')?.focus();
        }, 100);
    }

    // Close modal form
    function closeModalFormSarprasFakultas() {
        const modal = document.getElementById('modalFormSarprasFakultas');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        clearErrorsFakultas();
        isSubmittingFakultas = false;
    }

    // Clear errors
    function clearErrorsFakultas() {
        document.querySelectorAll('[id$="Error"]').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        document.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
            el.classList.add('border-gray-300', 'dark:border-gray-700');
        });
    }

    // Show field error
    function showFieldErrorFakultas(field, message) {
        const errorEl = document.getElementById(`${field}Error`);
        const inputEl = document.getElementById(field);
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        }
        if (inputEl) {
            inputEl.classList.remove('border-gray-300', 'dark:border-gray-700');
            inputEl.classList.add('border-red-500');
        }
    }

    // Submit form
    function submitSarprasFakultasForm() {
        if (isSubmittingFakultas) return;
        isSubmittingFakultas = true;

        const form = document.getElementById('sarprasFakultasForm');
        const submitBtn = document.getElementById('submitButtonFakultas');
        const submitText = document.getElementById('submitTextFakultas');
        const loading = document.getElementById('formLoadingFakultas');
        const formData = new FormData(form);

        // Get method from hidden input
        const method = document.getElementById('formMethodFakultas').value;
        const id = document.getElementById('sarprasFakultasId').value;

        // Determine URL
        let url;
        if (method === 'PUT' && id) {
            url = `<?php echo e(route("fakultas.sarpras.update", ['sarpras' => ':id'])); ?>`.replace(':id', id);
            formData.append('_method', 'PUT');
        } else {
            url = baseUrlFakultas;
        }

        // Show loading
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        loading.classList.remove('hidden');
        clearErrorsFakultas();

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                window.toast?.success(result.message || 'Data berhasil disimpan');
                closeModalFormSarprasFakultas();
                
                // Refresh table menggunakan TableRefresh
                if (typeof window.refreshTable === 'function') {
                    window.refreshTable('#sarprasFakultasTableContainer');
                } else {
                    // Fallback: reload halaman
                    window.location.reload();
                }
            } else {
                // Handle validation errors
                if (result.errors) {
                    Object.keys(result.errors).forEach(field => {
                        showFieldErrorFakultas(field, result.errors[field][0]);
                    });
                    window.toast?.error('Mohon periksa kembali form yang diisi');
                } else {
                    window.toast?.error(result.message || 'Gagal menyimpan data');
                }
            }
        })
        .catch(error => {
            console.error('Error submitting form:', error);
            window.toast?.error('Terjadi kesalahan saat menyimpan data');
        })
        .finally(() => {
            isSubmittingFakultas = false;
            submitBtn.disabled = false;
            submitText.textContent = method === 'PUT' ? 'Update' : 'Simpan';
            loading.classList.add('hidden');
        });
    }

    // Close modal with Escape key ONLY
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('modalFormSarprasFakultas');
            if (modal && !modal.classList.contains('hidden')) {
                closeModalFormSarprasFakultas();
            }
        }
    });

    // DISABLE backdrop click - hanya bisa close via tombol atau ESC
    document.getElementById('modalFormSarprasFakultas')?.addEventListener('click', function(e) {
        if (!e.target.closest('.rounded-2xl')) {
            e.stopPropagation();
        }
    });
</script>
<?php $__env->stopPush(); ?>

<style>
    /* Animasi fadeIn untuk modal */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Scroll styling untuk modal */
    #modalFormSarprasFakultas::-webkit-scrollbar {
        width: 6px;
    }
    #modalFormSarprasFakultas::-webkit-scrollbar-track {
        background: transparent;
    }
    #modalFormSarprasFakultas::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 9999px;
    }
    #modalFormSarprasFakultas::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    .dark #modalFormSarprasFakultas::-webkit-scrollbar-thumb {
        background: #4b5563;
    }
    .dark #modalFormSarprasFakultas::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }
</style><?php /**PATH F:\Project-2\audit-app\resources\views/components/sarpras-fakultas/modal/modal-sarpras-fakultas.blade.php ENDPATH**/ ?>