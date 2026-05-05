<div class="space-y-4">
    <!-- Heading Form -->
    <div class="flex items-center gap-2 mb-2">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Data Auditor</h4>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Input Unit -->
        <div>
            <label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unit <span class="text-red-500">*</span></label>
            <input type="text" id="unit" name="unit" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400" placeholder="Masukkan nama unit">
        </div>

        <!-- Input Sub Unit -->
        <div>
            <label for="subunit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sub Unit <span class="text-red-500">*</span></label>
            <input type="text" id="sub_unit" name="sub_unit" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400" placeholder="Masukkan nama sub unit">
        </div>

        <!-- Input NIDN / NIK -->
        <div>
            <label id="identity_label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                NIDN / NIK <span class="text-red-500">*Silakan pilih tipe identitas</span>
            </label>

            <div class="flex gap-2">
                <!-- Dropdown Type -->
                <select id="identity_type" name="identity_type" required
                    class="px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- NIDN / NIK --</option>
                    <option value="nidn">NIDN</option>
                    <option value="nik">NIK</option>
                </select>

                <div id="identity_number_wrapper" class="hidden w-full">
                    <!-- Input Number -->
                    <input type="text"
                        id="identity_number"
                        name="identity_number"
                        required
                        class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono"
                        placeholder="Masukkan NIDN / NIK">
                </div>
            </div>
        </div>

        <!-- Input Nama Auditor -->
        <div>
            <label for="nama_auditor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Auditor <span class="text-red-500">*</span></label>
            <input type="text" id="nama_auditor" name="nama_auditor" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400" placeholder="Dr. Nama Lengkap, Gelar">
        </div>

        <!-- Input Tahun Aktif -->
        <div>
            <label for="tahun_aktif" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun Aktif <span class="text-red-500">*</span></label>
            <input type="text" id="tahun_aktif" name="tahun_aktif" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400" placeholder="Contoh: 2021 - 2023">
        </div>

        <!-- Dropdown Status Auditor -->
        <div>
            <label for="status_auditor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Auditor <span class="text-red-500">*</span></label>
            <select id="status" name="status" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">-- Status Auditor --</option>
                <option value="Aktif">Aktif</option>
                <option value="Non Aktif">Non Aktif</option>
            </select>
        </div>

        <!-- Input Tahun Non Aktif -->
        <div class="md:col-span-2">
            <label for="tahun_non_aktif" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun Non Aktif</label>
            <input type="text" id="tahun_non_aktif" name="tahun_non_aktif" class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400" placeholder="Contoh: 2021 - Sekarang">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">*Saat mengedit kosongkan jika auditor masih aktif.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const typeSelect = document.getElementById('identity_type');
    const label = document.getElementById('identity_label');
    const wrapper = document.getElementById('identity_number_wrapper');
    const input = document.getElementById('identity_number');

    function updateIdentityUI() {
        const type = typeSelect.value;

        // SHOW / HIDE INPUT
        if (!type) {
            wrapper.classList.add('hidden');
            return;
        }

        wrapper.classList.remove('hidden');

        // UPDATE LABEL
        if (type === 'nidn/nik') {
            label.innerHTML = 'NIDN <span class="text-red-500">*Silakan pilih tipe identitas</span>';
            input.placeholder = 'Contoh: 0012038901 (10 digit)';
        } else {
            label.innerHTML = 'NIK <span class="text-red-500">*Silakan pilih tipe identitas</span>';
            input.placeholder = 'Contoh: 6371xxxxxxxxxxxx (16 digit)';
        }
    }

    // EVENT
    typeSelect.addEventListener('change', updateIdentityUI);

    // INIT STATE
    updateIdentityUI();
});
</script>