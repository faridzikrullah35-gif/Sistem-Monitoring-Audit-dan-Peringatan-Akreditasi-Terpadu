{{-- ============================================================ --}}
{{-- MODAL FORM PENGAJARAN (Tambah & Edit) — Standalone            --}}
{{-- ============================================================ --}}

@once
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    /* Dark mode override untuk flatpickr */
    .dark .flatpickr-calendar {
        background: #1f2937;
        border-color: #374151;
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.4);
    }
    .dark .flatpickr-calendar .flatpickr-day {
        color: #e5e7eb;
    }
    .dark .flatpickr-calendar .flatpickr-day:hover {
        background: #374151;
        border-color: #374151;
    }
    .dark .flatpickr-calendar .flatpickr-day.today {
        border-color: #60a5fa;
    }
    .dark .flatpickr-calendar .flatpickr-day.selected,
    .dark .flatpickr-calendar .flatpickr-day.selected:hover {
        background: #3b82f6;
        border-color: #3b82f6;
    }
    .dark .flatpickr-calendar .flatpickr-months,
    .dark .flatpickr-calendar .flatpickr-weekdays {
        background: #111827;
    }
    .dark .flatpickr-calendar .flatpickr-current-month,
    .dark .flatpickr-calendar .flatpickr-monthDropdown-months,
    .dark .flatpickr-calendar .flatpickr-weekday {
        color: #f3f4f6;
    }
    .dark .flatpickr-calendar .flatpickr-prev-month svg,
    .dark .flatpickr-calendar .flatpickr-next-month svg {
        fill: #f3f4f6;
    }
    .dark .flatpickr-calendar .flatpickr-monthDropdown-months,
    .dark .flatpickr-calendar .numInputWrapper {
        background: #111827;
    }
    .dark .flatpickr-calendar .flatpickr-monthDropdown-months option {
        background: #1f2937;
        color: #e5e7eb;
    }
    .dark .flatpickr-calendar input.numInput {
        color: #e5e7eb;
        background: transparent;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
@endpush
@endonce

<div
    id="modal-pengajaran"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
>
    <div class="w-full max-w-lg rounded-2xl bg-white shadow-xl dark:bg-gray-800">
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <h3 id="modal-pengajaran-title" class="text-lg font-semibold text-gray-800 dark:text-white">
                Tambah Data Pengajaran
            </h3>
            <button type="button" id="modal-pengajaran-close"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="form-pengajaran" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="pengajaran-id" name="id">
            <input type="hidden" id="pengajaran-method" name="_method" value="POST">

            <div class="space-y-4 px-6 py-5">
                {{-- Tahun Akademik --}}
                <div>
                    <label for="tahun_akademik" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tahun Akademik <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="tahun_akademik" name="tahun_akademik"
                           placeholder="Contoh: 2024/2025"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    <p class="error-text mt-1 hidden text-xs text-red-500" data-field="tahun_akademik"></p>
                </div>

                {{-- Semester --}}
                <div>
                    <label for="semester" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Semester <span class="text-red-500">*</span>
                    </label>
                    <select id="semester" name="semester"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                        <option value="">-- Pilih Semester --</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                    <p class="error-text mt-1 hidden text-xs text-red-500" data-field="semester"></p>
                </div>

                {{-- SK Pengajaran --}}
                <div>
                    <label for="sk_pengajaran" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        SK Pengajaran
                    </label>
                    <input type="file" id="sk_pengajaran" name="sk_pengajaran" accept=".pdf,.doc,.docx"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-blue-600 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:file:bg-blue-500/10 dark:file:text-blue-400">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Format: PDF, DOC, DOCX. Maks 5MB.
                    </p>
                    <p id="sk_pengajaran_current" class="mt-1 hidden text-xs text-gray-500 dark:text-gray-400"></p>
                    <p class="error-text mt-1 hidden text-xs text-red-500" data-field="sk_pengajaran"></p>
                </div>

                {{-- Tanggal Penetapan --}}
                <div>
                    <label for="tgl_penetapan" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Penetapan
                    </label>
                    <input type="text" id="tgl_penetapan" name="tgl_penetapan"
                           placeholder="Pilih tanggal penetapan"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    <p class="error-text mt-1 hidden text-xs text-red-500" data-field="tgl_penetapan"></p>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Keterangan
                    </label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              placeholder="Catatan tambahan (opsional)"
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    <p class="error-text mt-1 hidden text-xs text-red-500" data-field="keterangan"></p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-2 border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                <button type="button" id="modal-pengajaran-cancel"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Batal
                </button>
                <button type="submit" id="modal-pengajaran-submit"
                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@once
@push('scripts')
<script>
(function () {
    'use strict';

    // ---- Route config (SUDAH pakai prefix prodi.) ----
    const CONFIG = {
        storeUrl:   @json(route('prodi.pengajaran.store')),
        showUrl:    @json(route('prodi.pengajaran.show',    ['id' => '__ID__'])),
        updateUrl:  @json(route('prodi.pengajaran.update',  ['id' => '__ID__'])),
        destroyUrl: @json(route('prodi.pengajaran.destroy', ['id' => '__ID__'])),
    };

    const withId = (tpl, id) => tpl.replace('__ID__', id);

    const modal       = document.getElementById('modal-pengajaran');
    if (!modal) return;

    const titleEl     = document.getElementById('modal-pengajaran-title');
    const form        = document.getElementById('form-pengajaran');
    const submitBtn   = document.getElementById('modal-pengajaran-submit');
    const closeBtn    = document.getElementById('modal-pengajaran-close');
    const cancelBtn   = document.getElementById('modal-pengajaran-cancel');
    const idInput     = document.getElementById('pengajaran-id');
    const methodInput = document.getElementById('pengajaran-method');
    const skCurrent   = document.getElementById('sk_pengajaran_current');

    // ============================================================
    // FLATPICKR SETUP
    // ============================================================
    let fpPenetapan = null;

    function initFlatpickr() {
        const input = document.getElementById('tgl_penetapan');
        if (!input || typeof flatpickr === 'undefined') return;

        // Destroy instance lama biar tidak dobel
        if (fpPenetapan) {
            fpPenetapan.destroy();
            fpPenetapan = null;
        }

        fpPenetapan = flatpickr(input, {
            locale: 'id',
            dateFormat: 'Y-m-d',       // format yang dikirim ke backend
            altInput: true,            // tampilkan format human-readable
            altFormat: 'd F Y',        // contoh: 15 Januari 2025
            allowInput: true,
            disableMobile: true,       // biar konsisten pakai UI flatpickr di mobile
            maxDate: 'today',          // tanggal penetapan tidak boleh di masa depan
        });
    }

    function setFlatpickrValue(value) {
        if (!fpPenetapan) return;
        if (value) {
            fpPenetapan.setDate(value, true, 'Y-m-d');
        } else {
            fpPenetapan.clear();
        }
    }

    // Init flatpickr setelah DOM siap
    function ensureFlatpickr() {
        if (typeof flatpickr !== 'undefined') {
            initFlatpickr();
        } else {
            // fallback: coba lagi sebentar
            setTimeout(ensureFlatpickr, 50);
        }
    }
    ensureFlatpickr();

    // ============================================================
    // HELPERS
    // ============================================================

    function getCsrf() {
        return form.querySelector('input[name="_token"]')?.value
            || document.querySelector('meta[name="csrf-token"]')?.content
            || '';
    }

    function notify(type, msg) {
        if (window.toast && typeof window.toast[type] === 'function') {
            window.toast[type](msg);
        } else {
            console[type === 'error' ? 'error' : 'log']('[pengajaran]', msg);
        }
    }

    function clearErrors() {
        form.querySelectorAll('.error-text').forEach(el => {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

    function showErrors(errors) {
        Object.keys(errors).forEach(field => {
            const el = form.querySelector(`.error-text[data-field="${field}"]`);
            if (el) {
                el.textContent = Array.isArray(errors[field]) ? errors[field][0] : errors[field];
                el.classList.remove('hidden');
            }
        });
    }

    function setLoading(loading) {
        submitBtn.disabled = loading;
        submitBtn.textContent = loading ? 'Menyimpan...' : 'Simpan';
    }

    function resetForm() {
        form.reset();
        idInput.value = '';
        methodInput.value = 'POST';
        skCurrent.classList.add('hidden');
        skCurrent.textContent = '';
        clearErrors();

        // Reset flatpickr
        if (fpPenetapan) fpPenetapan.clear();
    }

    function openModal(mode, data) {
        resetForm();

        if (mode === 'edit' && data) {
            titleEl.textContent = 'Edit Data Pengajaran';
            idInput.value       = data.id ?? '';
            methodInput.value   = 'PUT';

            form.tahun_akademik.value = data.tahun_akademik ?? '';
            form.semester.value       = data.semester ?? '';
            form.keterangan.value     = data.keterangan ?? '';

            // Set tanggal lewat flatpickr (bukan form.tgl_penetapan.value)
            setFlatpickrValue(data.tgl_penetapan || null);

            if (data.sk_pengajaran) {
                skCurrent.textContent = 'File saat ini: ' + data.sk_pengajaran.split('/').pop();
                skCurrent.classList.remove('hidden');
            }
        } else {
            titleEl.textContent = 'Tambah Data Pengajaran';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        // Refresh flatpickr setelah modal visible
        setTimeout(() => {
            if (fpPenetapan && typeof fpPenetapan.redraw === 'function') {
                fpPenetapan.redraw();
            }
        }, 100);
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        resetForm();
    }

    // ============================================================
    // PUBLIC API
    // ============================================================

    window.openModalPengajaran = function (mode = 'create', data = null) {
        openModal(mode, data);
    };
    window.closeModalPengajaran = closeModal;

    window.editPengajaran = async function (id) {
        try {
            const res = await fetch(withId(CONFIG.showUrl, id), {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });
            if (!res.ok) throw new Error('Gagal memuat data pengajaran.');
            const body = await res.json();
            openModal('edit', body.data ?? body);
        } catch (err) {
            console.error(err);
            notify('error', err.message);
        }
    };

    window.deletePengajaran = function (id) {
        const confirmModal = document.getElementById('globalConfirmModal');
        const title        = document.getElementById('confirmTitle');
        const message      = document.getElementById('confirmMessage');
        const okBtn        = document.getElementById('confirmOkBtn');
        const cancelBtnC   = document.getElementById('confirmCancelBtn');
        const backdrop     = document.getElementById('confirmBackdrop');

        if (!confirmModal || !okBtn || !cancelBtnC) {
            console.error('Global confirm modal tidak ditemukan.');
            return;
        }

        if (title)   title.textContent = 'Konfirmasi Hapus';
        if (message) message.textContent =
            'Yakin ingin menghapus data pengajaran ini? Tindakan ini tidak dapat dibatalkan.';

        confirmModal.classList.remove('hidden');

        const closeConfirm = () => {
            confirmModal.classList.add('hidden');
        };

        cancelBtnC.onclick = function () {
            closeConfirm();
        };

        if (backdrop) {
            backdrop.onclick = function () {
                closeConfirm();
            };
        }

        okBtn.onclick = async function () {
            okBtn.disabled = true;
            okBtn.classList.add('opacity-60', 'cursor-not-allowed');

            try {
                const res = await fetch(withId(CONFIG.destroyUrl, id), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': getCsrf(),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });

                const body = await res.json().catch(() => ({}));

                if (!res.ok) {
                    throw new Error(body.message || 'Gagal menghapus data.');
                }

                closeConfirm();
                notify('success', body.message || 'Data berhasil dihapus.');

                if (typeof window.reloadPengajaranTable === 'function') {
                    window.reloadPengajaranTable();
                }

            } catch (err) {
                console.error(err);
                closeConfirm();
                notify('error', err.message || 'Gagal menghapus data.');

            } finally {
                okBtn.disabled = false;
                okBtn.classList.remove('opacity-60', 'cursor-not-allowed');
            }
        };
    };

    // ============================================================
    // EVENT LISTENERS
    // ============================================================

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();

        const isEdit = methodInput.value === 'PUT';
        const id     = idInput.value;
        const url    = isEdit ? withId(CONFIG.updateUrl, id) : CONFIG.storeUrl;

        const fd = new FormData(form);

        // Laravel pakai spoofing _method untuk PUT
        if (isEdit) fd.set('_method', 'PUT');

        // Buang file kosong saat edit (kalau user tidak pilih file baru)
        const skFile = fd.get('sk_pengajaran');
        if (skFile instanceof File && skFile.size === 0) {
            fd.delete('sk_pengajaran');
        }

        setLoading(true);

        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getCsrf(),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: fd,
            });

            const body = await res.json().catch(() => ({}));

            if (res.status === 422) {
                showErrors(body.errors || {});
                throw new Error(body.message || 'Data yang dikirim tidak valid.');
            }

            if (!res.ok) throw new Error(body.message || 'Gagal menyimpan data.');

            notify('success', body.message || (isEdit ? 'Data berhasil diperbarui.' : 'Data berhasil ditambahkan.'));
            closeModal();

            if (typeof window.reloadPengajaranTable === 'function') {
                window.reloadPengajaranTable();
            }
        } catch (err) {
            console.error(err);
            notify('error', err.message);
        } finally {
            setLoading(false);
        }
    });
})();
</script>
@endpush
@endonce