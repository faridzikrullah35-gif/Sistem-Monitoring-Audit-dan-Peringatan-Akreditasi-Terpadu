<div class="space-y-4">
    <div class="flex items-center gap-2 mb-2">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Detail Periode</h4>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Tahun Akademik -->
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun Akademik <span class="text-red-500">*</span></label>
            <input type="text" id="tahun" name="tahun_akademik" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 font-medium" placeholder="2023/2024" oninput="this.value = this.value.replace(/[^0-9/]/g, '')">
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Format: TahunAwal/TahunAkhir</p>
        </div>

        <!-- Semester -->
        <div>
            <label for="semester" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Semester <span class="text-red-500">*</span></label>
            <select id="semester" name="semester" required class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-no-repeat bg-[center_right_0.5rem] bg-[length:1.25rem]">
                <option value="" disabled selected>-- Pilih Semester --</option>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
        </div>
    </div>
</div>