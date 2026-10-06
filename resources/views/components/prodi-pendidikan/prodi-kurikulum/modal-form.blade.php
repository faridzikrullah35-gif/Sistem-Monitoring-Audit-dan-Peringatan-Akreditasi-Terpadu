{{-- Modal Form Kurikulum --}}
<div
    id="kurikulumModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 id="modalFormTitleKurikulum" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data Kurikulum
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalKurikulum()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form id="formKurikulum"
            action="{{ route('prodi.kurikulum.store') }}"
            method="POST"
            enctype="multipart/form-data"
            data-ajax="1"
            data-table-id="#kurikulumTableContainer">

            @csrf
            @method('POST')

            <input type="hidden" id="kurikulumId" name="id" value="" />
            <input type="hidden" id="methodFieldKurikulum" name="_method" value="POST" />

            <div class="space-y-5 px-6 py-5">

                {{-- Tahun Akademik --}}
                <div>
                    <label for="tahun_akademik_kurikulum" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tahun Akademik <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="tahun_akademik_kurikulum"
                        name="tahun_akademik"
                        required
                        placeholder="Contoh: 2024/2025"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Dokumen --}}
                <div>
                    <label for="dokumen_kurikulum" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Dokumen (PDF/DOC/DOCX)
                    </label>
                    <input type="file"
                        id="dokumen_kurikulum"
                        name="dokumen"
                        accept=".pdf,.doc,.docx"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 file:mr-3 file:rounded-md file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:file:bg-blue-500/10 dark:file:text-blue-400"
                    />
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                        Maks. 5MB. Format: PDF, DOC, DOCX.
                    </p>
                    {{-- Info file lama (ditampilkan saat edit) --}}
                    <div id="dokumenLamaInfo" class="mt-2 hidden">
                        <span class="text-xs text-gray-500 dark:text-gray-400">File saat ini: </span>
                        <a id="dokumenLamaLink" href="#" target="_blank" class="text-xs text-blue-600 dark:text-blue-400 underline">Lihat dokumen</a>
                    </div>
                </div>

                {{-- Tanggal Penetapan --}}
                <div>
                    <label for="tgl_penetapan_kurikulum" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Penetapan
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="tgl_penetapan_kurikulum"
                            name="tgl_penetapan"
                            class="datepicker-kurikulum w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 pr-10 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                            placeholder="Pilih tanggal..."
                            autocomplete="off"
                        />
                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 dark:text-gray-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </span>
                    </div>
                </div>

                {{-- Peninjauan Kurikulum --}}
                <div>
                    <label for="peninjauan_kurikulum" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Peninjauan Kurikulum
                    </label>
                    <input type="text"
                        id="peninjauan_kurikulum"
                        name="peninjauan_kurikulum"
                        maxlength="255"
                        placeholder="Contoh: 2024"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalKurikulum()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    id="submitKurikulumBtn"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
(function() {
    'use strict';

    const modal = document.getElementById('kurikulumModal');
    const form = document.getElementById('formKurikulum');
    const title = document.getElementById('modalFormTitleKurikulum');
    const methodField = document.getElementById('methodFieldKurikulum');
    const kurikulumId = document.getElementById('kurikulumId');
    const dokumenLamaInfo = document.getElementById('dokumenLamaInfo');
    const dokumenLamaLink = document.getElementById('dokumenLamaLink');

        // ==========================================
    // FLATPICKR — Tanggal Penetapan (LAZY INIT)
    // ==========================================
    let flatpickrKurikulum = null;

    function initFlatpickrKurikulum() {
        // Skip kalau Flatpickr belum ke-load
        if (typeof flatpickr === 'undefined') {
            console.warn('[Kurikulum] Flatpickr belum ke-load, picker tidak aktif.');
            return null;
        }

        // Skip kalau udah pernah di-init
        if (flatpickrKurikulum) return flatpickrKurikulum;

        const input = document.getElementById('tgl_penetapan_kurikulum');
        if (!input) {
            console.warn('[Kurikulum] Input tgl_penetapan_kurikulum tidak ditemukan.');
            return null;
        }

        flatpickrKurikulum = flatpickr(input, {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d F Y",
            allowInput: true,
            disableMobile: true,
            locale: {
                firstDayOfWeek: 1,
            },
        });

        return flatpickrKurikulum;
    }

    // ==========================================
    // REFRESH TABEL (dipakai bareng oleh delete & submit sukses)
    // ==========================================
    function refreshTable() {
        if (typeof TableRefresh !== 'undefined' && typeof TableRefresh.refresh === 'function') {
            TableRefresh.refresh('#kurikulumTableContainer');
        } else if (typeof window.refreshKurikulumTable === 'function') {
            window.refreshKurikulumTable();
        } else {
            location.reload();
        }
    }

    // ==========================================
    // OPEN / CLOSE MODAL
    // ==========================================
    window.openModalKurikulum = function(action, data) {
        form.reset();
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());
        dokumenLamaInfo.classList.add('hidden');

        // Init Flatpickr kalau belum
        initFlatpickrKurikulum();

        // Reset flatpickr
        if (flatpickrKurikulum) {
            flatpickrKurikulum.clear();
        }

        if (action === 'create') {
            title.textContent = 'Tambah Data Kurikulum';
            methodField.value = 'POST';
            kurikulumId.value = '';
            form.action = "{{ route('prodi.kurikulum.store') }}";
        } else if (action === 'edit' && data) {
            title.textContent = 'Edit Data Kurikulum';
            methodField.value = 'PUT';
            kurikulumId.value = data.id;
            form.action = `/prodi/kurikulum/${data.id}`;

            document.getElementById('tahun_akademik_kurikulum').value = data.tahun_akademik || '';
            document.getElementById('peninjauan_kurikulum').value = data.peninjauan_kurikulum || '';

            if (flatpickrKurikulum && data.tgl_penetapan) {
                flatpickrKurikulum.setDate(data.tgl_penetapan, true);
            }

            if (data.dokumen) {
                dokumenLamaInfo.classList.remove('hidden');
                dokumenLamaLink.href = `/storage/${data.dokumen}`;
            }
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.closeModalKurikulum = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());

        if (flatpickrKurikulum) {
            flatpickrKurikulum.clear();
        }
    };

    // ==========================================
    // EDIT & DELETE
    // ==========================================
    window.editKurikulum = function(id) {
        fetch(`/prodi/kurikulum/${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.openModalKurikulum('edit', data.data);
                } else {
                    if (window.toast) window.toast.error(data.message || 'Gagal mengambil data');
                    else alert(data.message || 'Gagal mengambil data');
                }
            })
            .catch(() => {
                if (window.toast) window.toast.error('Terjadi kesalahan saat mengambil data');
                else alert('Terjadi kesalahan saat mengambil data');
            });
    };

    window.deleteKurikulum = function(id) {
        const confirmModal = document.getElementById('globalConfirmModal');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        const confirmTitle = document.getElementById('confirmTitle');
        const confirmMessage = document.getElementById('confirmMessage');

        if (!confirmModal || !cancelBtn || !okBtn) {
            console.error('Global confirm modal tidak ditemukan.');
            return;
        }

        confirmTitle.textContent = 'Konfirmasi Hapus';
        confirmMessage.textContent = 'Yakin ingin menghapus data Kurikulum ini? Tindakan ini tidak dapat dibatalkan.';
        okBtn.textContent = 'Hapus';

        confirmModal.classList.remove('hidden');

        const newCancelBtn = cancelBtn.cloneNode(true);
        const newOkBtn = okBtn.cloneNode(true);

        cancelBtn.replaceWith(newCancelBtn);
        okBtn.replaceWith(newOkBtn);

        newCancelBtn.addEventListener('click', function() {
            confirmModal.classList.add('hidden');
        });

        newOkBtn.addEventListener('click', function() {
            newOkBtn.disabled = true;
            newOkBtn.textContent = 'Menghapus...';

            fetch(`/prodi/kurikulum/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Gagal menghapus data.');
                return data;
            })
            .then(data => {
                confirmModal.classList.add('hidden');

                if (data.success) {
                    if (window.toast) window.toast.success(data.message);
                    else alert(data.message);

                    refreshTable();
                } else {
                    if (window.toast) window.toast.error(data.message || 'Gagal menghapus data.');
                    else alert(data.message || 'Gagal menghapus data.');
                }
            })
            .catch(error => {
                confirmModal.classList.add('hidden');
                if (window.toast) window.toast.error(error.message || 'Terjadi kesalahan saat menghapus data.');
                else alert(error.message || 'Terjadi kesalahan saat menghapus data.');
            })
            .finally(() => {
                newOkBtn.disabled = false;
                newOkBtn.textContent = 'Hapus';
            });
        });
    };

    // ==========================================
    // TUTUP MODAL + REFRESH TABEL SAAT SUBMIT BERHASIL
    // ==========================================
    window.addEventListener('app:success', function(e) {
        if (!modal.classList.contains('hidden') && modal.classList.contains('flex')) {
            window.closeModalKurikulum();
        }
    });

    // ==========================================
    // ESC CLOSE
    // ==========================================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.closeModalKurikulum();
        }
    });

})();
</script>