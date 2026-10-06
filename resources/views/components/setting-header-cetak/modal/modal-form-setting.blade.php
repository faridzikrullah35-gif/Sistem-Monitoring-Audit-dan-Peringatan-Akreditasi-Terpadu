<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <h3 id="modalSettingTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Setting
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalSetting()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form id="formSetting"
            action="{{ route('setting-header-cetak.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#tableSettingContainer"
            data-refresh-table="settingHeaderCetak">

            @csrf
            @method('POST')

            <input type="hidden" id="settingId" name="id" value="" />

            <div class="space-y-4 px-6 py-5">

                {{-- No Dokumen --}}
                <div>
                    <label for="noDokumen" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        No Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="noDokumen"
                        name="no_dokumen"
                        placeholder="Contoh: UM.BJM-LPM-FORM.DP-AMI-002"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Format: Kode dokumen sesuai standar yang berlaku
                    </p>
                </div>

                {{-- Tanggal Terbit (dengan Flatpickr) --}}
                <div>
                    <label for="tanggalTerbit" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Terbit <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        {{-- Icon Calendar --}}
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="tanggalTerbit"
                            name="tanggal_terbit"
                            placeholder="Pilih tanggal"
                            required
                            class="datepicker w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                        />
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Format: DD-MM-YYYY (akan ditampilkan otomatis)
                    </p>
                </div>

                {{-- No Revisi --}}
                <div>
                    <label for="noRevisi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        No Revisi <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="noRevisi"
                        name="no_revisi"
                        placeholder="00"
                        value="00"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Default: 00 (nomor revisi terakhir)
                    </p>
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalSetting()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    id="btnSubmitSetting"
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
    // ==========================================
    // FLATPICKR INSTANCE (GLOBAL)
    // ==========================================
    window.flatpickrSettingInstance = null;

    // ==========================================
    // INIT FLATPICKR
    // ==========================================
    function initFlatpickrSetting() {
        const input = document.getElementById('tanggalTerbit');
        if (input && typeof flatpickr !== 'undefined') {
            window.flatpickrSettingInstance = flatpickr("#tanggalTerbit", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d F Y",
                allowInput: true,
                disableMobile: true,
                onOpen: function(selectedDates, dateStr, instance) {
                    if (instance.calendarContainer) {
                        instance.calendarContainer.style.zIndex = '9999';
                    }
                }
            });
        }
    }

    // ==========================================
    // INIT ON DOM READY
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        initFlatpickrSetting();
    });

    // ==========================================
    // FUNGSI BUKA MODAL
    // ==========================================
    function openModalSetting(id = null, rowData = null) {
        const modal = document.getElementById('userModal');
        const title = document.getElementById('modalSettingTitle');
        const hiddenId = document.getElementById('settingId');
        const form = document.getElementById('formSetting');
        const btnSubmit = document.getElementById('btnSubmitSetting');

        // Reset form (KOSONGKAN SEMUA)
        document.getElementById('noDokumen').value = '';
        document.getElementById('noRevisi').value = '00';

        // Clear flatpickr (KOSONGKAN TANGGAL)
        if (window.flatpickrSettingInstance) {
            window.flatpickrSettingInstance.clear();
        }

        // Hapus error
        document.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
        });
        document.querySelectorAll('.text-red-500.text-xs.mt-1').forEach(el => {
            el.remove();
        });

        // =====================
        // MODE EDIT
        // =====================
        if (id && id !== 'null' && rowData) {
            title.textContent = 'Edit Setting';
            hiddenId.value = id;
            document.getElementById('noDokumen').value = rowData.no_dokumen || '';
            document.getElementById('noRevisi').value = rowData.no_revisi || '00';
            btnSubmit.textContent = 'Update';

            // Set tanggal dengan flatpickr (hanya jika ada data)
            if (rowData.tanggal_terbit && window.flatpickrSettingInstance) {
                window.flatpickrSettingInstance.setDate(rowData.tanggal_terbit, false);
            }

            // Update action form untuk PUT
            form.action = `/admin/setting-header-cetak/update/${id}`;
            const methodField = document.querySelector('input[name="_method"]');
            if (methodField) methodField.value = 'PUT';
        }
        // =====================
        // MODE CREATE
        // =====================
        else {
            title.textContent = 'Tambah Setting';
            hiddenId.value = '';
            btnSubmit.textContent = 'Simpan';
            form.action = "{{ route('setting-header-cetak.store') }}";
            const methodField = document.querySelector('input[name="_method"]');
            if (methodField) methodField.value = 'POST';
        }

        // Show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    // ==========================================
    // FUNGSI TUTUP MODAL (GLOBAL)
    // ==========================================
    window.closeModalSetting = function() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        
        // Reset flatpickr
        if (window.flatpickrSettingInstance) {
            window.flatpickrSettingInstance.clear();
        }
    }

    // ==========================================
    // REGISTER REFRESH TABLE KE GLOBAL
    // ==========================================
    if (typeof window !== 'undefined') {
        window.refreshSettingHeaderCetakTable = function() {
            const container = document.getElementById('tableSettingContainer');
            if (!container) return;

            fetch('/admin/setting-header-cetak', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.getElementById('tableSettingContainer');
                if (newTable) {
                    container.innerHTML = newTable.innerHTML;
                }
            })
            .catch(error => {
                console.error('Error reload table:', error);
            });
        };
    }
</script>