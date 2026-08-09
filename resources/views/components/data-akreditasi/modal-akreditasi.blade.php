<div id="userModal"
     class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8">
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="modalAkreditasiTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data Akreditasi
                </h3>
            </div>
            <button type="button" onclick="closeModalAkreditasi()"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form id="formAkreditasi"
              action="{{ route('data-akreditasi.store') }}"
              method="POST"
              enctype="multipart/form-data"
              data-ajax="1"
              data-table-id="#akreditasiTableContainer">
            @csrf
            <input type="hidden" id="akreditasiId" name="id" value="" />
            <input type="hidden" name="_method" id="akreditasiMethod" value="POST" />
            <input type="hidden" id="akreditasiMode" name="mode" value="" />

            <div class="space-y-5 px-6 py-5">

                {{-- Upcoming TS-3 --}}
                <div>
                    <label for="upcoming_ts3" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upcoming TS-3
                    </label>
                    <input type="text" name="upcoming_ts3" id="upcoming_ts3"
                           class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                </div>

                {{-- Upcoming TS-2 --}}
                <div>
                    <label for="upcoming_ts2" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upcoming TS-2
                    </label>
                    <input type="text" name="upcoming_ts2" id="upcoming_ts2"
                           class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                </div>

                {{-- Upcoming TS-1 --}}
                <div>
                    <label for="upcoming_ts1" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upcoming TS-1
                    </label>
                    <input type="text" name="upcoming_ts1" id="upcoming_ts1"
                           class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                </div>

                {{-- Upcoming TS --}}
                <div>
                    <label for="upcoming_ts" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upcoming TS
                    </label>
                    <input type="text" name="upcoming_ts" id="upcoming_ts"
                           class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                </div>

                {{-- Tanggal Pendampingan --}}
                <div>
                    <label for="tanggal_pendampingan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Pendampingan <span class="text-xs text-gray-400">(dd/mm/yyyy)</span>
                    </label>
                    <input type="date" name="tanggal_pendampingan" id="tanggal_pendampingan"
                           class="datepicker-akreditasi w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                </div>

                {{-- LED Upload --}}
                <div>
                    <label for="led" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        LED (PDF)
                    </label>
                    <input type="file" name="led" id="led" accept="application/pdf"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                    <p class="mt-1 text-xs text-gray-400">Maksimal ukuran file 2MB (PDF)</p>
                    <div id="ledExisting" class="mt-1 text-sm text-gray-500 hidden">
                        File saat ini: <a href="#" id="ledLink" target="_blank" class="text-blue-600 hover:underline">Download</a>
                        <button type="button" onclick="removeFile('led')" class="text-red-500 hover:underline ml-2">Hapus</button>
                        <input type="hidden" name="remove_led" id="remove_led" value="0">
                    </div>
                </div>

                {{-- LKPT Upload --}}
                <div>
                    <label for="lkpt" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        LKPT (PDF)
                    </label>
                    <input type="file" name="lkpt" id="lkpt" accept="application/pdf"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                    <p class="mt-1 text-xs text-gray-400">Maksimal ukuran file 2MB (PDF)</p>
                    <div id="lkptExisting" class="mt-1 text-sm text-gray-500 hidden">
                        File saat ini: <a href="#" id="lkptLink" target="_blank" class="text-blue-600 hover:underline">Download</a>
                        <button type="button" onclick="removeFile('lkpt')" class="text-red-500 hover:underline ml-2">Hapus</button>
                        <input type="hidden" name="remove_lkpt" id="remove_lkpt" value="0">
                    </div>
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalAkreditasi()"
                        class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Batal
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="modalAkreditasiSubmitText">Simpan</span>
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    const baseUrl = "{{ auth()->user()->role === 'admin' ? url('/admin') : url('/prodi') }}";

    const updateUrl = "{{ auth()->user()->role === 'admin'
        ? route('data-akreditasi.update', ['id' => ':id'])
        : route('prodi.data-akreditasi.update', ['id' => ':id']) }}";

    const deleteUrl = "{{ auth()->user()->role === 'admin'
        ? route('data-akreditasi.delete', ['id' => ':id'])
        : route('prodi.data-akreditasi.delete', ['id' => ':id']) }}";

    const storeUrl = "{{ auth()->user()->role === 'admin'
        ? route('data-akreditasi.store')
        : route('prodi.data-akreditasi.store') }}";

    const showUrl = "{{ auth()->user()->role === 'admin'
        ? route('data-akreditasi.show', ['id' => ':id'])
        : route('prodi.data-akreditasi.show', ['id' => ':id']) }}";
</script>

<script>
    // ==========================================
    // INISIALISASI FLATPICKR
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof flatpickr !== 'undefined') {
            document.querySelectorAll('.datepicker-akreditasi').forEach(input => {
                flatpickr(input, {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d/m/Y",
                    allowInput: false,
                    disableMobile: true,
                    locale: { firstDayOfWeek: 1 }
                });
            });
        } else {
            console.warn('Flatpickr not loaded.');
        }
    });

    // ==========================================
    // FUNGSI BUKA MODAL (CREATE & EDIT & LENGKAPI)
    // ==========================================
    function openModalAkreditasi(id = null, mode = 'lengkapi', rowData = null) {
        const modal = document.getElementById('userModal');
        const title = document.getElementById('modalAkreditasiTitle');
        const submitText = document.getElementById('modalAkreditasiSubmitText');
        const form = document.getElementById('formAkreditasi');
        const methodInput = document.getElementById('akreditasiMethod');
        const idInput = document.getElementById('akreditasiId');
        const modeInput = document.getElementById('akreditasiMode');

        // Reset form
        form.reset();
        document.getElementById('ledExisting').classList.add('hidden');
        document.getElementById('lkptExisting').classList.add('hidden');
        document.getElementById('remove_led').value = '0';
        document.getElementById('remove_lkpt').value = '0';
        document.querySelectorAll('.datepicker-akreditasi').forEach(input => {
            const fp = input._flatpickr;
            if (fp) fp.clear();
        });

        // =====================
        // MODE EDIT / LENGKAPI
        // =====================
        if (id && id !== 'null') {
            if (mode === 'edit') {
                title.textContent = 'Edit Data Akreditasi';
                submitText.textContent = 'Update';
            } else { // lengkapi
                title.textContent = 'Lengkapi Data Akreditasi';
                submitText.textContent = 'Simpan';
            }
            methodInput.value = 'PUT';
            form.action = updateUrl.replace(':id', id);
            idInput.value = id;
            modeInput.value = mode;

            if (rowData) {
                fillForm(rowData);
            } else {
                fetch(showUrl.replace(':id', id), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => fillForm(data))
                .catch(err => console.error('Error fetching data:', err));
            }
        }
        // =====================
        // MODE CREATE
        // =====================
        else {
            title.textContent = 'Tambah Data Akreditasi';
            submitText.textContent = 'Simpan';
            methodInput.value = 'POST';
            form.action = storeUrl;
            idInput.value = '';
            modeInput.value = 'tambah';
        }

        // Tampilkan modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Update flatpickr setelah modal terbuka
        document.querySelectorAll('.datepicker-akreditasi').forEach(input => {
            const fp = input._flatpickr;
            if (fp) fp.setDate(input.value, true);
        });
    }

    // ==========================================
    // FUNGSI TUTUP MODAL
    // ==========================================
    function closeModalAkreditasi() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        // Reset ke mode create
        const form = document.getElementById('formAkreditasi');
        form.reset();
        document.getElementById('akreditasiMethod').value = 'POST';
        document.getElementById('akreditasiId').value = '';
        document.getElementById('akreditasiMode').value = '';
        document.getElementById('modalAkreditasiTitle').textContent = 'Tambah Data Akreditasi';
        document.getElementById('modalAkreditasiSubmitText').textContent = 'Simpan';
        form.action = storeUrl;

        // Reset flatpickr
        document.querySelectorAll('.datepicker-akreditasi').forEach(input => {
            const fp = input._flatpickr;
            if (fp) fp.clear();
        });

        // Sembunyikan existing file indicators
        document.getElementById('ledExisting').classList.add('hidden');
        document.getElementById('lkptExisting').classList.add('hidden');
    }

    // ==========================================
    // FUNGSI FILL FORM
    // ==========================================
    function fillForm(data) {
        document.getElementById('upcoming_ts3').value = data.upcoming_ts3 ?? '';
        document.getElementById('upcoming_ts2').value = data.upcoming_ts2 ?? '';
        document.getElementById('upcoming_ts1').value = data.upcoming_ts1 ?? '';
        document.getElementById('upcoming_ts').value = data.upcoming_ts ?? '';

        const dateInput = document.getElementById('tanggal_pendampingan');
        if (dateInput._flatpickr) {
            dateInput._flatpickr.setDate(data.tanggal_pendampingan, true);
        }

        // LED
        const ledExisting = document.getElementById('ledExisting');
        const ledLink = document.getElementById('ledLink');
        if (data.led) {
            ledLink.href = '/storage/' + data.led;
            ledExisting.classList.remove('hidden');
        } else {
            ledExisting.classList.add('hidden');
        }

        // LKPT
        const lkptExisting = document.getElementById('lkptExisting');
        const lkptLink = document.getElementById('lkptLink');
        if (data.lkpt) {
            lkptLink.href = '/storage/' + data.lkpt;
            lkptExisting.classList.remove('hidden');
        } else {
            lkptExisting.classList.add('hidden');
        }

        // Reset remove flags
        document.getElementById('remove_led').value = '0';
        document.getElementById('remove_lkpt').value = '0';
    }

    // ==========================================
    // FUNGSI REMOVE FILE
    // ==========================================
    function removeFile(type) {
        document.getElementById('remove_' + type).value = '1';
        document.getElementById(type + 'Existing').classList.add('hidden');
        document.getElementById(type).value = '';
    }

    // ==========================================
    // EVENT LISTENER UNTUK TOMBOL DI TABEL
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        // Tombol "Tambah Data"
        const btnCreate = document.getElementById('btn-create-akreditasi');
        if (btnCreate) {
            btnCreate.addEventListener('click', function() {
                openModalAkreditasi(null, 'tambah');
            });
        }

        // Tombol "Lengkapi Data"
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-lengkapi-akreditasi');
            if (btn) {
                e.preventDefault();
                const id = btn.dataset.id;
                if (id) openModalAkreditasi(id, 'lengkapi');
            }
        });

        // Tombol "Edit Data"
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-edit-akreditasi');
            if (btn) {
                e.preventDefault();
                const id = btn.dataset.id;
                if (id) openModalAkreditasi(id, 'edit');
            }
        });
    });
</script>