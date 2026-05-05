<div class="space-y-5">
    
    <!-- Info Singkat -->
    <div class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="text-xs text-blue-700 dark:text-blue-300">Atur unit yang akan diaudit beserta periode dan jadwal pelaksanaannya.</p>
    </div>

    <!-- Field 1: Pilih Akun -->
    <div>
        <label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Pilih Akun <span class="text-red-500">*</span>
        </label>
        <select id="unit" name="unit" 
            class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

            <option value="" disabled selected>-- Pilih Akun --</option>

            @foreach ($units as $unit)
                <option value="{{ $unit->id }}">
                    {{ $unit->name }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- Field 2: Tahun Akademik -->
    <div>
        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Tahun Akademik <span class="text-red-500">*</span>
        </label>
        <select id="tahun_akademik" name="tahun_akademik" 
            class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

            <option value="" disabled selected>-- Pilih Tahun Akademik --</option>

            @foreach ($tahunAkademiks as $item)
                <option value="{{ $item->id }}">
                    {{ $item->tahun_akademik }} {{ $item->semester }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- Field 3: Tanggal Audit -->
    <div>
        <label for="tgl_audit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Tanggal Audit <span class="text-red-500">*</span>
        </label>
        <input 
            type="text" 
            id="tgl_audit" 
            name="tgl_audit"
            class="datepicker w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            placeholder="Pilih tanggal audit..."
        >
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Klik ikon kalender untuk memilih jadwal pelaksanaan audit.</p>
    </div>

</div>