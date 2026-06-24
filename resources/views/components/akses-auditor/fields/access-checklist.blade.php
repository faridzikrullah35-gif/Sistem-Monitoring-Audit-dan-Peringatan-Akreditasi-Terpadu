<div class="space-y-6">
    
    <!-- Informasi Singkat -->
    <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="text-xs text-gray-600 dark:text-gray-400">Pilih Auditor & posisi jabatan Auditor yang diizinkan untuk diaudit oleh auditor ini. <span class="font-semibold text-gray-800 dark:text-gray-200">Jika tidak dipilih, auditor tidak bisa melihat data audit tersebut.</span></p>
    </div>

    <!-- Pilih Auditor (Combobox - Alpine Pure) -->
    <div 
        x-data="{
            search: '',
            selected: null,
            isOpen: true,
            auditors: @js($auditors),

            get filtered() {
                return this.auditors;
            }
        }"
        x-on:reset-auditor-form.window="
            search = '';
            selected = null;
            isOpen = true;
        "
    >
        <h4 class="text-sm font-semibold text-gray-800 dark:text-white mb-3">
            Pilih Auditor
        </h4>

        <!-- Input -->
        <input 
            type="text"
            x-model="search"
            @focus="isOpen = true"
            @input="isOpen = true"
            placeholder="Cari auditor..."
            class="w-full px-4 py-2.5 border rounded-lg text-sm"
        />

        <!-- Hidden -->
        <input type="hidden" name="auditor_id" :value="selected?.id">

        <!-- LIST (INLINE, BUKAN DROPDOWN) -->
        <div 
            x-show="isOpen"
            class="mt-2 border rounded-lg max-h-60 overflow-y-auto bg-white dark:bg-gray-800"
        >
            
            <template x-for="item in filtered" :key="item.id">
                <div 
                    @click="
                        selected = item;
                        search = item.nama_auditor;
                        isOpen = true;
                    "
                    :class="selected?.id === item.id 
                        ? 'bg-blue-100 dark:bg-blue-900/30' 
                        : ''"
                    class="px-4 py-2 cursor-pointer 
                    hover:bg-blue-50 dark:hover:bg-blue-900/20 
                    text-sm text-gray-800 dark:text-gray-200"
                >
                    <span x-text="item.nama_auditor"></span>
                </div>
            </template>

            <div x-show="filtered.length === 0" class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                Auditor tidak ditemukan.
            </div>
        </div>

        <!-- Selected -->
        <div x-show="selected" class="mt-2 text-xs text-blue-600 dark:text-blue-400">
            Dipilih: <span x-text="selected.nama_auditor"></span>
        </div>
    </div>

    <!-- Posisi Jabatan Auditor -->
    <div>
        <h4 class="text-sm font-semibold text-gray-800 dark:text-white mb-3">
            Posisi Jabatan Auditor
        </h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

            <!-- Lead Auditor -->
            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer
                border-gray-300 dark:border-gray-600
                has-[:checked]:bg-emerald-50 has-[:checked]:border-emerald-500
                dark:has-[:checked]:bg-emerald-900/20 dark:has-[:checked]:border-emerald-400">
                
                <input type="radio" name="posisi" value="lead_auditor"
                    class="w-4 h-4 text-emerald-600">

                <span class="text-sm text-gray-800 dark:text-gray-200">
                    Lead Auditor
                </span>
            </label>

            <!-- Anggota -->
            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer
                border-gray-300 dark:border-gray-600
                has-[:checked]:bg-emerald-50 has-[:checked]:border-emerald-500
                dark:has-[:checked]:bg-emerald-900/20 dark:has-[:checked]:border-emerald-400">
                
                <input type="radio" name="posisi" value="anggota"
                    class="w-4 h-4 text-emerald-600">

                <span class="text-sm text-gray-800 dark:text-gray-200">
                    Anggota
                </span>
            </label>

            <!-- Kepala Bidang Internal -->
            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer
                border-gray-300 dark:border-gray-600
                has-[:checked]:bg-emerald-50 has-[:checked]:border-emerald-500
                dark:has-[:checked]:bg-emerald-900/20 dark:has-[:checked]:border-emerald-400">

                <input type="radio" name="posisi" value="posisi_kepala_bidang_internal"
                    class="w-4 h-4 text-emerald-600">

                <span class="text-sm text-gray-800 dark:text-gray-200">
                    Kepala Bidang Internal
                </span>
            </label>

            <!-- Kepala Lembaga Penjaminan Mutu -->
            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer
                border-gray-300 dark:border-gray-600
                has-[:checked]:bg-emerald-50 has-[:checked]:border-emerald-500
                dark:has-[:checked]:bg-emerald-900/20 dark:has-[:checked]:border-emerald-400">

                <input type="radio" name="posisi" value="posisi_kepala_lembaga_penjaminan_mutu"
                    class="w-4 h-4 text-emerald-600">

                <span class="text-sm text-gray-800 dark:text-gray-200">
                    Kepala Lembaga Penjaminan Mutu
                </span>
            </label>

        </div>
    </div>
</div>

