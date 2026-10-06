@props(['users' => [], 'daftarFakultas' => []])

{{-- ============================================================
    MODAL FORM - Setting Hak Akses Fakultas
    Digunakan untuk menambah/mengedit data hak akses fakultas
   ============================================================ --}}
<div id="userModal" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6">
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
        
        {{-- ===========================================
            HEADER MODAL
           =========================================== --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                {{-- Icon --}}
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                {{-- Title --}}
                <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah Setting Hak Akses Fakultas</h3>
            </div>
            {{-- Close button --}}
            <button type="button" onclick="closeModalForm()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- ===========================================
            FORM
            Catatan: Tidak menggunakan data-ajax agar 
            tidak ditangkap oleh global AJAX handler
           =========================================== --}}
        <form id="contentForm" action="{{ route('admin.setting-hak-akses-fakultas.store') }}" method="POST">
            @csrf
            {{-- Hidden field untuk ID (edit mode) --}}
            <input type="hidden" id="contentId" name="id" value="">
            {{-- Hidden field untuk method PUT (edit mode) --}}
            <input type="hidden" name="_method" id="formMethod" value="POST">

            {{-- ===========================================
                BODY FORM
               =========================================== --}}
            <div class="space-y-4 px-6 py-5">
                
                {{-- 1. PILIH USER --}}
                <div>
                    <label for="user_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        User Fakultas <span class="text-red-500">*</span>
                    </label>
                    <select name="user_id" id="user_id" required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85">
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} - {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback mt-1 hidden text-xs text-red-500"></div>
                </div>

                {{-- 2. PILIH FAKULTAS --}}
                <div>
                    <label for="fakultas" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Fakultas <span class="text-red-500">*</span>
                    </label>
                    <select name="fakultas" id="fakultas" required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85">
                        <option value="">-- Pilih Fakultas --</option>
                        @foreach($daftarFakultas as $fakultas)
                            <option value="{{ $fakultas }}" {{ old('fakultas') == $fakultas ? 'selected' : '' }}>
                                {{ $fakultas }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback mt-1 hidden text-xs text-red-500"></div>
                </div>

                {{-- 3. PILIH SUB UNIT (Multi Select dengan Custom Dropdown) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sub Unit
                    </label>
                    
                    {{-- Custom multi-select dropdown --}}
                    <div id="subUnitMultiSelect" class="relative">
                        {{-- Trigger button - menampilkan tag yang sudah dipilih --}}
                        <button
                            type="button"
                            id="subUnitTrigger"
                            class="flex min-h-[46px] w-full flex-wrap items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-2 text-left text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04]"
                        >
                            {{-- Area untuk menampilkan tag yang dipilih --}}
                            <div id="subUnitSelectedTags" class="flex flex-1 flex-wrap items-center gap-1.5">
                                <span id="subUnitPlaceholder" class="text-gray-400 dark:text-gray-500">
                                    Pilih Sub Unit
                                </span>
                            </div>
                            {{-- Icon panah --}}
                            <svg id="subUnitArrow" class="h-4 w-4 shrink-0 text-gray-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>

                        {{-- Dropdown options --}}
                        <div id="subUnitDropdown" class="absolute left-0 right-0 top-full z-[60] mt-1 hidden overflow-hidden rounded-lg border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800">
                            {{-- Fitur "Pilih Semua" --}}
                            <div class="border-b border-gray-200 px-3 py-2 dark:border-gray-700">
                                <label class="flex cursor-pointer items-center gap-2">
                                    <input type="checkbox" id="subUnitSelectAll" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Pilih Semua</span>
                                </label>
                            </div>
                            {{-- Daftar opsi sub unit --}}
                            <div id="subUnitOptions" class="max-h-56 overflow-y-auto p-1.5">
                                <div class="px-3 py-3 text-sm text-gray-400">
                                    Pilih Fakultas Terlebih Dahulu
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Informasi tambahan --}}
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Kosongkan untuk akses ke semua sub unit
                    </p>
                    <div class="invalid-feedback mt-1 hidden text-xs text-red-500"></div>
                </div>

                {{-- 4. LEVEL AKSES --}}
                <div>
                    <label for="level_akses" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Level Akses <span class="text-red-500">*</span>
                    </label>
                    <select name="level_akses" id="level_akses" required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85">
                        <option value="">-- Pilih Level --</option>
                        <option value="read" {{ old('level_akses') == 'read' ? 'selected' : '' }}>Baca/Melihat</option>
                        <option value="write" {{ old('level_akses') == 'write' ? 'selected' : '' }}>Tulis</option>
                    </select>
                    <div class="invalid-feedback mt-1 hidden text-xs text-red-500"></div>
                </div>

                {{-- 5. STATUS AKTIF/NONAKTIF (Toggle Switch) --}}
                <div class="flex items-center justify-between border-t border-gray-100 pt-4 dark:border-gray-800">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Status Akses</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Aktifkan atau nonaktifkan akses ini</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span id="statusLabel" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</span>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="peer sr-only">
                            <div class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800 rtl:peer-checked:after:-translate-x-full"></div>
                        </label>
                    </div>
                </div>

                {{-- 6. KETERANGAN (Opsional) --}}
                <div>
                    <label for="keterangan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Keterangan (Opsional)
                    </label>
                    <textarea name="keterangan" id="keterangan" rows="2" placeholder="Masukkan keterangan tambahan..." class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500"></textarea>
                    <div class="invalid-feedback mt-1 hidden text-xs text-red-500"></div>
                </div>
            </div>

            {{-- ===========================================
                FOOTER - Tombol Aksi
               =========================================== --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                {{-- Tombol Batal --}}
                <button type="button" onclick="closeModalForm()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                
                {{-- Tombol Submit --}}
                <button type="submit" id="submitButton" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
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
/**
 * ============================================================
 * MODAL FORM CONTROLLER
 * Menangani semua interaksi pada modal form hak akses fakultas
 * ============================================================
 */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // ===========================================
    // 1. KONFIGURASI URL
    // ===========================================
    const storeUrl = @json(route('admin.setting-hak-akses-fakultas.store'));
    const updateUrl = @json(url('admin/setting-hak-akses-fakultas/update'));
    const subUnitUrl = @json(route('admin.setting-hak-akses-fakultas.get-sub-units'));
    const userDataUrl = @json(url('admin/setting-hak-akses-fakultas/get-user-data'));
    const tableSelector = '#tableFakultasContainer';

    // ===========================================
    // 2. DOM ELEMENTS
    // ===========================================
    const modal = document.getElementById('userModal');
    const form = document.getElementById('contentForm');
    if (!modal || !form) return;

    const submitButton = document.getElementById('submitButton');
    const submitText = document.getElementById('submitText');
    const userSelect = document.getElementById('user_id');
    const fakultasSelect = document.getElementById('fakultas');
    const levelSelect = document.getElementById('level_akses');
    const activeCheckbox = document.getElementById('is_active');
    const statusLabel = document.getElementById('statusLabel');
    const keteranganInput = document.getElementById('keterangan');
    const contentId = document.getElementById('contentId');
    const formMethod = document.getElementById('formMethod');
    const modalFormTitle = document.getElementById('modalFormTitle');

    // Elemen untuk multi-select sub unit
    const subUnitMultiSelect = document.getElementById('subUnitMultiSelect');
    const subUnitTrigger = document.getElementById('subUnitTrigger');
    const subUnitDropdown = document.getElementById('subUnitDropdown');
    const subUnitOptions = document.getElementById('subUnitOptions');
    const subUnitSelectedTags = document.getElementById('subUnitSelectedTags');
    const subUnitPlaceholder = document.getElementById('subUnitPlaceholder');
    const subUnitSelectAll = document.getElementById('subUnitSelectAll');
    const subUnitArrow = document.getElementById('subUnitArrow');

    // STATE - Deklarasi hanya SEKALI
    let isSubmitting = false;
    let selectedSubUnits = [];

    // ===========================================
    // 3. UTILITY FUNCTIONS
    // ===========================================

    /** Menampilkan toast sukses */
    function toastSuccess(message) {
        if (window.toastr) window.toastr.success(message);
    }

    /** Menampilkan toast error */
    function toastError(message) {
        if (window.toastr) window.toastr.error(message);
    }

    /** Mengupdate label status toggle */
    function toggleStatusLabel() {
        if (!activeCheckbox || !statusLabel) return;
        statusLabel.textContent = activeCheckbox.checked ? 'Aktif' : 'Nonaktif';
    }

    /** Reset error validation pada form */
    function resetFormErrors() {
        form.querySelectorAll('.is-invalid').forEach(function (el) {
            el.classList.remove('is-invalid', 'border-red-500');
        });
        form.querySelectorAll('.invalid-feedback').forEach(function (el) {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

    /** Tampilkan error validation dari server */
    function showValidationErrors(errors) {
        if (!errors) return;
        Object.entries(errors).forEach(function ([field, messages]) {
            const input = form.querySelector(`[name="${field}"]`);
            if (!input) return;
            input.classList.add('is-invalid', 'border-red-500');
            const wrapper = input.closest('div');
            const feedback = wrapper?.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = Array.isArray(messages) ? messages[0] : messages;
                feedback.classList.remove('hidden');
            }
        });
    }

    /** Escape HTML untuk keamanan */
    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    // ===========================================
    // 4. SUB UNIT MULTI-SELECT FUNCTIONS
    // ===========================================

    /** Toggle dropdown */
    function toggleSubUnitDropdown() {
        if (!subUnitDropdown) return;
        subUnitDropdown.classList.toggle('hidden');
        if (subUnitArrow) {
            subUnitArrow.style.transform = subUnitDropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    }

    /** Render badge/tag sub unit yang dipilih */
    function renderSelectedSubUnits() {
        if (!subUnitSelectedTags) return;

        subUnitSelectedTags.innerHTML = '';

        if (selectedSubUnits.length === 0) {
            subUnitSelectedTags.innerHTML = `
                <span id="subUnitPlaceholder" class="text-gray-400 dark:text-gray-500">Pilih Sub Unit</span>
            `;
            return;
        }

        selectedSubUnits.forEach(function (item) {
            const badge = document.createElement('span');
            badge.className = 'inline-flex items-center gap-1 rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-300';
            badge.innerHTML = `
                <span>${escapeHtml(item.label)}</span>
                <button type="button" class="remove-sub-unit inline-flex h-4 w-4 items-center justify-center rounded-full hover:bg-blue-200 dark:hover:bg-blue-500/20" data-value="${escapeHtml(item.value)}" title="Hapus">
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            subUnitSelectedTags.appendChild(badge);
        });

        // Event hapus badge
        subUnitSelectedTags.querySelectorAll('.remove-sub-unit').forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.stopPropagation();
                const value = String(this.dataset.value);
                selectedSubUnits = selectedSubUnits.filter(item => String(item.value) !== value);
                updateSubUnitCheckboxes();
                renderSelectedSubUnits();
                updateSubUnitHiddenInputs();
                updateSelectAllState();
            });
        });
    }

    /** Render checkbox list sub unit */
    function renderSubUnitOptions(data) {
        if (!subUnitOptions) return;
        subUnitOptions.innerHTML = '';

        if (!Array.isArray(data) || data.length === 0) {
            subUnitOptions.innerHTML = `
                <div class="px-3 py-3 text-sm text-gray-400 dark:text-gray-500">Tidak ada sub unit tersedia</div>
            `;
            return;
        }

        data.forEach(function (option) {
            const wrapper = document.createElement('label');
            wrapper.className = 'flex cursor-pointer items-center gap-2 rounded-md px-2.5 py-2 hover:bg-gray-100 dark:hover:bg-white/[0.05]';
            wrapper.innerHTML = `
                <input type="checkbox" class="sub-unit-checkbox h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" value="${escapeHtml(option.value)}" data-label="${escapeHtml(option.label)}">
                <span class="text-sm text-gray-700 dark:text-gray-200">${escapeHtml(option.label)}</span>
            `;

            const checkbox = wrapper.querySelector('.sub-unit-checkbox');
            checkbox.addEventListener('change', function () {
                const value = String(this.value);
                const label = this.dataset.label;
                if (this.checked) {
                    const exists = selectedSubUnits.some(item => String(item.value) === value);
                    if (!exists) {
                        selectedSubUnits.push({ value: value, label: label });
                    }
                } else {
                    selectedSubUnits = selectedSubUnits.filter(item => String(item.value) !== value);
                }
                renderSelectedSubUnits();
                updateSubUnitHiddenInputs();
                updateSelectAllState();
            });

            subUnitOptions.appendChild(wrapper);
        });

        updateSubUnitCheckboxes();
        updateSelectAllState();
    }

    /** Update checkbox berdasarkan selectedSubUnits */
    function updateSubUnitCheckboxes() {
        if (!subUnitOptions) return;
        const selectedValues = selectedSubUnits.map(item => String(item.value));
        subUnitOptions.querySelectorAll('.sub-unit-checkbox').forEach(function (checkbox) {
            checkbox.checked = selectedValues.includes(String(checkbox.value));
        });
    }

    /** Update "Pilih Semua" */
    function updateSelectAllState() {
        if (!subUnitSelectAll || !subUnitOptions) return;
        const checkboxes = [...subUnitOptions.querySelectorAll('.sub-unit-checkbox')];
        if (checkboxes.length === 0) {
            subUnitSelectAll.checked = false;
            subUnitSelectAll.indeterminate = false;
            return;
        }
        const checkedCount = checkboxes.filter(checkbox => checkbox.checked).length;
        subUnitSelectAll.checked = checkedCount === checkboxes.length;
        subUnitSelectAll.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
    }

    /** Pilih semua sub unit */
    function selectAllSubUnits(checked) {
        if (!subUnitOptions) return;
        const checkboxes = [...subUnitOptions.querySelectorAll('.sub-unit-checkbox')];

        if (checked) {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = true;
                const value = String(checkbox.value);
                const label = checkbox.dataset.label;
                const exists = selectedSubUnits.some(item => String(item.value) === value);
                if (!exists) {
                    selectedSubUnits.push({ value: value, label: label });
                }
            });
        } else {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false;
            });
            selectedSubUnits = [];
        }

        renderSelectedSubUnits();
        updateSubUnitHiddenInputs();
        updateSelectAllState();
    }

    /** Hidden input untuk dikirim ke Laravel (sub_unit[]) */
    function updateSubUnitHiddenInputs() {
        if (!form) return;
        form.querySelectorAll('.sub-unit-hidden-input').forEach(function (input) {
            input.remove();
        });
        selectedSubUnits.forEach(function (item) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'sub_unit[]';
            input.value = item.value;
            input.className = 'sub-unit-hidden-input';
            form.appendChild(input);
        });
    }

    /** Reset multi select */
    function resetSubUnitMultiSelect() {
        selectedSubUnits = [];
        if (subUnitOptions) {
            subUnitOptions.innerHTML = `
                <div class="px-3 py-3 text-sm text-gray-400 dark:text-gray-500">Pilih Fakultas Terlebih Dahulu</div>
            `;
        }
        if (subUnitSelectAll) {
            subUnitSelectAll.checked = false;
            subUnitSelectAll.indeterminate = false;
        }
        renderSelectedSubUnits();
        updateSubUnitHiddenInputs();
    }

    /** Load sub unit dari server */
    async function loadSubUnits(fakultas, selectedSubUnit = []) {
        console.log('loadSubUnits called with:', { fakultas, selectedSubUnit });
        
        if (!subUnitOptions) return;

        // Reset selected
        selectedSubUnits = [];
        
        if (!fakultas) {
            resetSubUnitMultiSelect();
            return;
        }

        subUnitOptions.innerHTML = `<div class="px-3 py-3 text-sm text-gray-400">Memuat sub unit...</div>`;

        try {
            const response = await fetch(`${subUnitUrl}?fakultas=${encodeURIComponent(fakultas)}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data sub unit');
            
            const data = await response.json();
            console.log('Sub unit data from server:', data);
            
            renderSubUnitOptions(data);

            // Normalisasi selectedSubUnit
            let selectedValues = [];
            
            if (Array.isArray(selectedSubUnit)) {
                selectedValues = selectedSubUnit.map(value => String(value));
            } else if (typeof selectedSubUnit === 'string') {
                // Coba parse JSON dulu
                try {
                    const parsed = JSON.parse(selectedSubUnit);
                    if (Array.isArray(parsed)) {
                        selectedValues = parsed.map(value => String(value));
                    } else {
                        selectedValues = [String(parsed)];
                    }
                } catch (e) {
                    // Bukan JSON, cek comma separated
                    if (selectedSubUnit.includes(',')) {
                        selectedValues = selectedSubUnit.split(',').map(item => String(item.trim())).filter(Boolean);
                    } else if (selectedSubUnit !== '' && selectedSubUnit !== 'null' && selectedSubUnit !== 'undefined') {
                        selectedValues = [String(selectedSubUnit)];
                    }
                }
            } else if (selectedSubUnit !== null && selectedSubUnit !== undefined) {
                selectedValues = [String(selectedSubUnit)];
            }

            console.log('Final selected values:', selectedValues);

            // Set pilihan edit
            data.forEach(function (option) {
                if (selectedValues.includes(String(option.value))) {
                    const exists = selectedSubUnits.some(item => String(item.value) === String(option.value));
                    if (!exists) {
                        selectedSubUnits.push({
                            value: String(option.value),
                            label: option.label
                        });
                    }
                }
            });

            console.log('Final selectedSubUnits:', selectedSubUnits);

            updateSubUnitCheckboxes();
            renderSelectedSubUnits();
            updateSubUnitHiddenInputs();
            updateSelectAllState();

        } catch (error) {
            console.error('Load Sub Unit Error:', error);
            subUnitOptions.innerHTML = `<div class="px-3 py-3 text-sm text-red-500">Gagal memuat sub unit</div>`;
            toastError('Gagal memuat data sub unit');
        }
    }

    // ===========================================
    // 5. MODAL CONTROL FUNCTIONS
    // ===========================================

    /** Buka modal untuk tambah data */
    window.openModal = function () {
        form.reset();
        resetFormErrors();
        contentId.value = '';
        formMethod.value = 'POST';
        form.action = storeUrl;
        modalFormTitle.textContent = 'Tambah Setting Hak Akses Fakultas';
        submitText.textContent = 'Simpan';
        activeCheckbox.checked = true;
        toggleStatusLabel();
        resetSubUnitMultiSelect();
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
        setTimeout(function () {
            userSelect?.focus();
        }, 100);
    };

    /** Buka modal untuk edit data */
    window.openEditModal = async function (id, userId, fakultas, subUnit, levelAkses, isActive, keterangan) {
        console.log('openEditModal called with:', { id, userId, fakultas, subUnit, levelAkses, isActive, keterangan });
        
        form.reset();
        resetFormErrors();
        contentId.value = id;
        formMethod.value = 'PUT';
        form.action = `${updateUrl}/${id}`;
        modalFormTitle.textContent = 'Edit Setting Hak Akses Fakultas';
        submitText.textContent = 'Update';
        userSelect.value = userId || '';
        fakultasSelect.value = fakultas || '';
        levelSelect.value = levelAkses || '';
        activeCheckbox.checked = Number(isActive) === 1;
        toggleStatusLabel();
        keteranganInput.value = keterangan || '';

        // =====================================================
        // NORMALISASI SUB UNIT UNTUK EDIT
        // =====================================================
        let selectedSubUnitsForEdit = [];
        
        console.log('Raw subUnit data:', subUnit);
        
        // Kasus 1: subUnit adalah array
        if (Array.isArray(subUnit)) {
            selectedSubUnitsForEdit = subUnit;
        } 
        // Kasus 2: subUnit adalah string JSON
        else if (typeof subUnit === 'string') {
            try {
                // Coba parse JSON
                const parsed = JSON.parse(subUnit);
                if (Array.isArray(parsed)) {
                    selectedSubUnitsForEdit = parsed;
                } else if (parsed && typeof parsed === 'object') {
                    // Mungkin object dengan key tertentu
                    selectedSubUnitsForEdit = Object.values(parsed);
                } else {
                    selectedSubUnitsForEdit = [String(parsed)];
                }
            } catch (e) {
                // Kasus 3: subUnit adalah string biasa (comma separated)
                if (subUnit.includes(',')) {
                    selectedSubUnitsForEdit = subUnit.split(',').map(item => item.trim()).filter(Boolean);
                } else if (subUnit !== '' && subUnit !== 'null' && subUnit !== 'undefined') {
                    selectedSubUnitsForEdit = [subUnit];
                }
            }
        }
        // Kasus 4: subUnit null/undefined
        else if (subUnit === null || subUnit === undefined) {
            selectedSubUnitsForEdit = [];
        }

        console.log('Parsed subUnit for edit:', selectedSubUnitsForEdit);

        // Load sub unit dengan data yang sudah diparse
        await loadSubUnits(fakultas, selectedSubUnitsForEdit);
        
        // Buka modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    /** Tutup modal */
    window.closeModalForm = function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        if (subUnitDropdown) subUnitDropdown.classList.add('hidden');
        if (subUnitArrow) subUnitArrow.style.transform = 'rotate(0deg)';
    };

    // ===========================================
    // 6. FORM SUBMIT HANDLER
    // ===========================================

    function setSubmitting(status) {
        isSubmitting = status;
        submitButton.disabled = status;
        if (status) {
            submitText.innerHTML = `
                <svg class="animate-spin h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...
            `;
        } else {
            submitText.textContent = formMethod.value === 'PUT' ? 'Update' : 'Simpan';
        }
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (e.stopImmediatePropagation) e.stopImmediatePropagation();
        if (isSubmitting) return;

        resetFormErrors();
        setSubmitting(true);

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            let result = null;
            try {
                result = await response.json();
            } catch (jsonError) {
                console.error('Invalid JSON response:', jsonError);
                throw new Error('Response server tidak valid.');
            }

            if (response.status === 422) {
                showValidationErrors(result.errors);
                toastError(result.message || 'Data yang dimasukkan tidak valid.');
                return;
            }

            if (!response.ok) {
                toastError(result.message || 'Terjadi kesalahan pada server.');
                return;
            }

            if (result && result.success === true) {
                closeModalForm();
                toastSuccess(result.message || 'Data berhasil disimpan!');
                if (typeof window.refreshTable === 'function') {
                    try {
                        await window.refreshTable(tableSelector);
                    } catch (refreshError) {
                        console.error('Refresh table error:', refreshError);
                    }
                }
                return;
            }

            toastError(result?.message || 'Data gagal disimpan!');

        } catch (error) {
            console.error('AJAX Submit Error:', error);
            toastError(error.message || 'Terjadi kesalahan pada server!');
        } finally {
            setSubmitting(false);
        }
    }, true);

    // ===========================================
    // 7. EVENT LISTENERS
    // ===========================================

    fakultasSelect?.addEventListener('change', function () {
        selectedSubUnits = [];
        loadSubUnits(this.value);
    });

    userSelect?.addEventListener('change', async function () {
        const userId = this.value;
        if (!userId) return;
        try {
            const response = await fetch(`${userDataUrl}/${userId}`, {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            if (!response.ok) throw new Error('Gagal mengambil data user');
            const data = await response.json();
            if (data.unit && fakultasSelect) {
                fakultasSelect.value = data.unit;
                await loadSubUnits(data.unit, data.sub_unit ? [data.sub_unit] : []);
            }
        } catch (error) {
            console.error('Get User Data Error:', error);
            toastError('Gagal mengambil data user');
        }
    });

    activeCheckbox?.addEventListener('change', toggleStatusLabel);

    subUnitTrigger?.addEventListener('click', function (e) {
        e.stopPropagation();
        toggleSubUnitDropdown();
    });

    subUnitSelectAll?.addEventListener('change', function () {
        selectAllSubUnits(this.checked);
    });

    document.addEventListener('click', function (e) {
        if (subUnitMultiSelect && !subUnitMultiSelect.contains(e.target)) {
            if (subUnitDropdown) subUnitDropdown.classList.add('hidden');
            if (subUnitArrow) subUnitArrow.style.transform = 'rotate(0deg)';
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        if (modal && !modal.classList.contains('hidden')) closeModalForm();
    });

    // ===========================================
    // 8. INITIALIZATION
    // ===========================================

    toggleStatusLabel();

    window.confirmDelete = function (id, fakultas) {
        if (!confirm(`Apakah Anda yakin ingin menghapus setting hak akses untuk ${fakultas}?`)) return;
        const deleteForm = document.getElementById(`delete-form-${id}`);
        if (deleteForm) deleteForm.submit();
    };

});
</script>
@endpush