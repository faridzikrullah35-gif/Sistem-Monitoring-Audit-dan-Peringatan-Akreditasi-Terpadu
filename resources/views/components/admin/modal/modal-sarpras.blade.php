{{-- Modal Tambah / Edit Sarana Prasarana --}}
<div
    id="modalFormSarpras"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6"
>
    <div class="mx-4 w-full max-w-lg animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>
                </div>
                <h3 id="modalFormSarprasTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Sarana Prasarana
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalFormSarpras()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form
            id="sarprasForm"
            action="{{ url('/admin/sarpras') }}"
            method="POST"
        >
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">
            <input type="hidden" id="sarprasId" name="id" value="">

            <div class="space-y-4 px-6 py-5">

                {{-- Kode Sarana Prasarana --}}
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

                {{-- Nama Sarana Prasarana --}}
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

                {{-- Status --}}
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

                {{-- Jumlah --}}
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

                {{-- Loading/Info --}}
                <div id="formLoading" class="hidden text-center py-2">
                    <svg class="animate-spin h-5 w-5 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">Menyimpan...</span>
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalFormSarpras()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Batal
                </button>
                <button
                    type="button"
                    onclick="submitSarprasForm()"
                    id="submitButton"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="submitText">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    let isSubmitting = false;
    let baseUrl = '{{ url("/admin/sarpras") }}';

    // Open modal form
    function openModalFormSarpras(action, id = null) {
        const modal = document.getElementById('modalFormSarpras');
        const title = document.getElementById('modalFormSarprasTitle');
        const form = document.getElementById('sarprasForm');
        const methodInput = document.getElementById('formMethod');
        const idInput = document.getElementById('sarprasId');
        const submitText = document.getElementById('submitText');

        // Reset form
        form.reset();
        clearErrors();

        // OPEN MODAL
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        if (action === 'create') {
            title.textContent = 'Tambah Sarana Prasarana';
            methodInput.value = 'POST';
            idInput.value = '';
            submitText.textContent = 'Simpan';
            form.action = baseUrl;

        } else if (action === 'edit' && id) {
            title.textContent = 'Edit Sarana Prasarana';
            methodInput.value = 'PUT';
            idInput.value = id;
            submitText.textContent = 'Update';
            form.action = `${baseUrl}/${id}`;

            // Fetch data untuk diisi ke form
            fetch(`${baseUrl}/${id}`, {
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
                    } else {
                        window.toast?.error(result.message || 'Gagal mengambil data Sarana Prasarana');
                        closeModalFormSarpras();
                    }
                })
                .catch(error => {
                    console.error('Error fetching sarpras detail:', error);
                    window.toast?.error('Terjadi kesalahan saat mengambil data');
                    closeModalFormSarpras();
                });
        }

        // FOCUS ke field pertama
        setTimeout(() => {
            document.getElementById('kode')?.focus();
        }, 100);
    }

    // Close modal form
    function closeModalFormSarpras() {
        const modal = document.getElementById('modalFormSarpras');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        clearErrors();
        isSubmitting = false;
    }

    // Clear errors
    function clearErrors() {
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
    function showFieldError(field, message) {
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
    function submitSarprasForm() {
        if (isSubmitting) return;
        isSubmitting = true;

        const form = document.getElementById('sarprasForm');
        const submitBtn = document.getElementById('submitButton');
        const submitText = document.getElementById('submitText');
        const loading = document.getElementById('formLoading');
        const formData = new FormData(form);

        // Get method from hidden input
        const method = document.getElementById('formMethod').value;
        const id = document.getElementById('sarprasId').value;

        // Determine URL
        let url;
        if (method === 'PUT' && id) {
            url = `${baseUrl}/${id}`;
            formData.append('_method', 'PUT');
        } else {
            url = baseUrl;
        }

        // Show loading
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        loading.classList.remove('hidden');
        clearErrors();

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                window.toast?.success(result.message || 'Data berhasil disimpan');
                closeModalFormSarpras();
                
                // Refresh table menggunakan TableRefresh
                if (typeof window.refreshTable === 'function') {
                    window.refreshTable('#sarprasTableContainer');
                } else {
                    // Fallback: reload halaman
                    window.location.reload();
                }
            } else {
                // Handle validation errors
                if (result.errors) {
                    Object.keys(result.errors).forEach(field => {
                        showFieldError(field, result.errors[field][0]);
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
            isSubmitting = false;
            submitBtn.disabled = false;
            submitText.textContent = method === 'PUT' ? 'Update' : 'Simpan';
            loading.classList.add('hidden');
        });
    }

    // Close modal with Escape key ONLY
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('modalFormSarpras');
            if (modal && !modal.classList.contains('hidden')) {
                closeModalFormSarpras();
            }
        }
    });

    // DISABLE backdrop click - hanya bisa close via tombol atau ESC
    document.getElementById('modalFormSarpras')?.addEventListener('click', function(e) {
        if (!e.target.closest('.rounded-2xl')) {
            e.stopPropagation();
        }
    });
</script>
@endpush

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
    #modalFormSarpras::-webkit-scrollbar {
        width: 6px;
    }
    #modalFormSarpras::-webkit-scrollbar-track {
        background: transparent;
    }
    #modalFormSarpras::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 9999px;
    }
    #modalFormSarpras::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    .dark #modalFormSarpras::-webkit-scrollbar-thumb {
        background: #4b5563;
    }
    .dark #modalFormSarpras::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }
</style>