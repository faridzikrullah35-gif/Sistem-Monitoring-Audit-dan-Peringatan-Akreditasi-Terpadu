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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="modalEwsTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data Akreditasi
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalEws()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form
            id="formEws"
            action="{{ route('early-warning-system.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#ewsTableContainer"
        >
            @csrf
            <input type="hidden" id="ewsId" name="id" value="" />
            <input type="hidden" name="_method" id="ewsMethod" value="POST" />

            <div class="space-y-5 px-6 py-5">

                {{-- Jenjang --}}
                <div>
                    <label for="program" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jenjang <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="program"
                        id="program"
                        value="{{ old('program') }}"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                </div>

                {{-- Unit & Sub Unit --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Unit --}}
                <div>
                    <label for="unit" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Unit <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="unit"
                        id="unit"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">

                        <option value="">Pilih Unit</option>

                        @foreach($units as $unit)
                            <option value="{{ $unit }}">{{ $unit }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Sub Unit --}}
                <div>
                    <label for="sub_unit" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sub Unit <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="sub_unit"
                        id="sub_unit"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">

                        <option value="">Pilih Sub Unit</option>

                    </select>
                </div>

            </div>

                {{-- SK Akreditasi --}}
                <div>
                    <label for="nomor_sk" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        SK Akreditasi <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nomor_sk"
                        id="nomor_sk"
                        value="{{ old('nomor_sk') }}"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                </div>

                {{-- Tanggal SK (dengan date picker) --}}
                <div>
                    <label for="tanggal_sk" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal SK <span class="text-red-500">*</span> <span class="text-xs text-gray-400">(dd/mm/yyyy)</span>
                    </label>
                    <input
                        type="date"
                        name="tanggal_sk"
                        id="tanggal_sk"
                        value="{{ old('tanggal_sk') }}"
                        required
                        placeholder="dd/mm/yyyy"
                        class="datepicker-ews w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                </div>

                {{-- Peringkat --}}
                <div>
                    <label for="peringkat_akreditasi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Peringkat <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="peringkat_akreditasi"
                        id="peringkat_akreditasi"
                        value="{{ old('peringkat_akreditasi') }}"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                </div>

                {{-- Tanggal Daluwarsa (dengan date picker) --}}
                <div>
                    <label for="tanggal_kadaluarsa" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Daluwarsa <span class="text-red-500">*</span> <span class="text-xs text-gray-400">(dd/mm/yyyy)</span>
                    </label>
                    <input
                        type="date"
                        name="tanggal_kadaluarsa"
                        id="tanggal_kadaluarsa"
                        value="{{ old('tanggal_kadaluarsa') }}"
                        required
                        placeholder="dd/mm/yyyy"
                        class="datepicker-ews w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                </div>

                {{-- Akreditasi Nasional --}}
                <div>
                    <label for="akreditasi_nasional" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Akreditasi Nasional
                    </label>
                    <input
                        type="text"
                        name="akreditasi_nasional"
                        id="akreditasi_nasional"
                        value="{{ old('akreditasi_nasional') }}"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                </div>

                {{-- Akreditasi Internasional --}}
                <div>
                    <label for="akreditasi_internasional" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Akreditasi Internasional
                    </label>
                    <input
                        type="text"
                        name="akreditasi_internasional"
                        id="akreditasi_internasional"
                        value="{{ old('akreditasi_internasional') }}"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Keterangan
                    </label>
                    <textarea
                        name="keterangan"
                        id="keterangan"
                        rows="2"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >{{ old('keterangan') }}</textarea>
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalEws()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Batal
                </button>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="modalEwsSubmitText">Simpan</span>
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    const ewsBaseUrl = @json(
        auth()->user()->role === 'admin'
            ? url('/admin/early-warning-system')
            : url('/prodi/early-warning-system')
    );

    const subUnitUrl = @json(
        auth()->user()->role === 'admin'
            ? url('/admin/sub-unit')
            : url('/prodi/sub-unit')
    );

    // ==========================================
    // INISIALISASI FLATPICKR
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan Flatpickr sudah dimuat
        if (typeof flatpickr !== 'undefined') {
            const dateInputs = document.querySelectorAll('.datepicker-ews');
            dateInputs.forEach(input => {
                flatpickr(input, {
                    dateFormat: "Y-m-d",      // Yang dikirim ke server
                    altInput: true,
                    altFormat: "d/m/Y",       // Yang dilihat user
                    allowInput: false,
                    disableMobile: true,
                    locale: {
                        firstDayOfWeek: 1
                    }
                });
            });
        } else {
            console.warn('Flatpickr not loaded. Please include the library.');
        }
    });

    // ==========================================
    // FUNGSI BUKA / TUTUP MODAL (CREATE & EDIT)
    // ==========================================

    function openModalEws(id = null, rowData = null) {
        const modal = document.getElementById('userModal');
        const title = document.getElementById('modalEwsTitle');
        const submitText = document.getElementById('modalEwsSubmitText');
        const form = document.getElementById('formEws');
        const methodInput = document.getElementById('ewsMethod');
        const idInput = document.getElementById('ewsId');

        // Reset form terlebih dahulu
        form.reset();

        // =====================
        // MODE EDIT
        // =====================
        if (id && id !== 'null') {
            title.textContent = 'Edit Data Akreditasi';
            submitText.textContent = 'Update';
            methodInput.value = 'PUT';
            form.action = `${ewsBaseUrl}/${id}`;
            idInput.value = id;

            // Jika rowData disertakan, isi langsung
            if (rowData) {
                document.getElementById('program').value = rowData.program ?? '';
                document.getElementById('unit').value = data.unit ?? '';

                fetch(`${subUnitUrl}/${encodeURIComponent(data.unit ?? '')}`)
                    .then(res => res.json())
                    .then(items => {

                        const sub = document.getElementById('sub_unit');

                        sub.innerHTML =
                            '<option value="">Pilih Sub Unit</option>';

                        items.forEach(item => {

                            sub.innerHTML +=
                                `<option value="${item}">${item}</option>`;

                        });

                        sub.value = data.sub_unit ?? '';
                    });
                document.getElementById('nomor_sk').value = rowData.nomor_sk ?? '';
                // Untuk tanggal, format dd/mm/yyyy
                document.getElementById('tanggal_sk')._flatpickr.setDate(
                    rowData.tanggal_sk
                );
                document.getElementById('peringkat_akreditasi').value = rowData.peringkat_akreditasi ?? '';
                const expDate = rowData.tanggal_kadaluarsa ? rowData.tanggal_kadaluarsa.split('-').reverse().join('/') : '';
                document.getElementById('tanggal_kadaluarsa')._flatpickr.setDate(
                    rowData.tanggal_kadaluarsa
                );
                document.getElementById('akreditasi_nasional').value = rowData.akreditasi_nasional ?? '';
                document.getElementById('akreditasi_internasional').value = rowData.akreditasi_internasional ?? '';
                document.getElementById('keterangan').value = rowData.keterangan ?? '';
            } else {
                // Fetch dari server
                fetch(`${ewsBaseUrl}/${id}/edit`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {

                    document.getElementById('program').value = data.program ?? '';
                    document.getElementById('unit').value = data.unit ?? '';

                    fetch(`${subUnitUrl}/${encodeURIComponent(data.unit ?? '')}`)
                        .then(res => res.json())
                        .then(items => {

                            const sub = document.getElementById('sub_unit');

                            sub.innerHTML =
                                '<option value="">Pilih Sub Unit</option>';

                            items.forEach(item => {

                                sub.innerHTML +=
                                    `<option value="${item}">${item}</option>`;

                            });

                            sub.value = data.sub_unit ?? '';
                        });
                    document.getElementById('nomor_sk').value = data.nomor_sk ?? '';

                    document.getElementById('peringkat_akreditasi').value =
                        data.peringkat_akreditasi ?? '';

                    document.getElementById('akreditasi_nasional').value =
                        data.akreditasi_nasional ?? '';

                    document.getElementById('akreditasi_internasional').value =
                        data.akreditasi_internasional ?? '';

                    document.getElementById('keterangan').value =
                        data.keterangan ?? '';

                    // Flatpickr
                    if (document.getElementById('tanggal_sk')._flatpickr) {
                        document.getElementById('tanggal_sk')._flatpickr.setDate(
                            data.tanggal_sk,
                            true
                        );
                    }

                    if (document.getElementById('tanggal_kadaluarsa')._flatpickr) {
                        document.getElementById('tanggal_kadaluarsa')._flatpickr.setDate(
                            data.tanggal_kadaluarsa,
                            true
                        );
                    }

                })
                .catch(error => {
                    console.error(error);
                });
            }
        }
        // =====================
        // MODE CREATE
        // =====================
        else {
            title.textContent = 'Tambah Data Akreditasi';
            submitText.textContent = 'Simpan';
            methodInput.value = 'POST';
            form.action = "{{ route('early-warning-system.store') }}";
            idInput.value = '';
        }

        // Tampilkan modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Update flatpickr setelah modal terbuka (jika ada nilai dari rowData)
        if (typeof flatpickr !== 'undefined') {
            document.querySelectorAll('.datepicker-ews').forEach(input => {
                const fp = input._flatpickr;
                if (fp) {
                    fp.setDate(input.value, true); // set nilai dengan format yang sudah ada
                }
            });
        }
    }

    function closeModalEws() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        // Reset ke mode create
        const form = document.getElementById('formEws');
        form.reset();
        document.getElementById('ewsMethod').value = 'POST';
        document.getElementById('ewsId').value = '';
        document.getElementById('modalEwsTitle').textContent = 'Tambah Data Akreditasi';
        document.getElementById('modalEwsSubmitText').textContent = 'Simpan';
        form.action = "{{ route('early-warning-system.store') }}";

        // Reset flatpickr
        if (typeof flatpickr !== 'undefined') {
            document.querySelectorAll('.datepicker-ews').forEach(input => {
                const fp = input._flatpickr;
                if (fp) {
                    fp.clear();
                }
            });
        }
    }

    // ==========================================
    // EVENT LISTENER UNTUK TOMBOL DI TABEL
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        // Tombol "Tambah Data"
        const btnCreate = document.getElementById('btn-create-ews');
        if (btnCreate) {
            btnCreate.addEventListener('click', function() {
                openModalEws();
            });
        }

        // Tombol edit di tabel (class .btn-edit-ews)
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-edit-ews');
            if (!btn) return;
            openModalEws(btn.dataset.id);
        });
    });

    // ==========================================
    // DROPDOWN UNIT -> SUB UNIT
    // ==========================================
    const unitSelect = document.getElementById('unit');
    const subUnitSelect = document.getElementById('sub_unit');

    if (unitSelect) {
        unitSelect.addEventListener('change', function () {

            const unit = this.value;

            subUnitSelect.innerHTML =
                '<option value="">Loading...</option>';

            if (!unit) {
                subUnitSelect.innerHTML =
                    '<option value="">Pilih Sub Unit</option>';
                return;
            }

            fetch(`${subUnitUrl}/${encodeURIComponent(unit)}`)
                .then(res => res.json())
                .then(items => {

                    subUnitSelect.innerHTML =
                        '<option value="">Pilih Sub Unit</option>';

                    items.forEach(item => {

                        subUnitSelect.innerHTML +=
                            `<option value="${item}">${item}</option>`;

                    });

                });
        });
    }
</script>