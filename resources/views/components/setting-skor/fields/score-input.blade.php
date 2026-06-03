<div class="space-y-4">

    <!-- Input Skor -->
    <div>
        <label for="score_value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Nilai Skor
            <span class="text-red-500">*</span>
        </label>

        <input 
            type="text"
            id="score_value"
            name="score_value"
            required
            class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-center text-lg font-bold text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Contoh: 0 - 1 / 1 / dst."
        >

        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            Format: 0 - 1 / 1 / dst.
        </p>
    </div>

    <!-- Input Keterangan -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Keterangan
            <span class="text-red-500">*</span>
        </label>

        <input 
            type="text"
            id="description"
            name="description"
            required
            class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Contoh: Sangat Baik"
        >

        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            Singkat dan jelas.
        </p>
    </div>

    <!-- =========================
    GENERATE NCR/PTK
    ========================= -->
    <div class="space-y-2">

        <!-- Label -->
        <div class="flex items-center justify-between">

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                    Generate NCR/PTK
                </label>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Jika aktif, sistem otomatis membuat data NCR/PTK saat score dipilih auditor.
                </p>
            </div>

            <!-- Toggle -->
            <label class="relative inline-flex cursor-pointer items-center">

                <input
                    type="checkbox"
                    name="generate_ncr"
                    id="generate_ncr"
                    value="1"
                    class="peer sr-only"
                >

                <!-- Background -->
                <div class="peer h-6 w-11 rounded-full bg-gray-300 transition-all
                            peer-checked:bg-blue-600
                            dark:bg-gray-600">
                </div>

                <!-- Circle -->
                <div class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow-md transition-all
                            peer-checked:translate-x-5">
                </div>
            </label>
        </div>
    </div>

</div>