<div class="space-y-4">
    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">Informasi Dasar</h4>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Nama Lengkap -->
        <div class="md:col-span-2">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Nama <span class="text-red-500">*</span>
            </label>
            <input type="text" id="name" name="name" required
                class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan nama">
        </div>

        <!-- Unit -->
        <div>
            <label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Unit
            </label>
            <input type="text" id="unit" name="unit"
                class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Contoh: Fakultas Teknik">
        </div>

        <!-- Sub Unit -->
        <div>
            <label for="sub_unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Sub Unit
            </label>
            <input type="text" id="sub_unit" name="sub_unit"
                class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Contoh: Prodi Informatika">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400" placeholder="email@simantap.ac.id">
        </div>

        <!-- Password -->
        <div x-data="{ show: false }" class="relative">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Password <span class="text-red-500">*</span>
            </label>

            <input 
                :type="show ? 'text' : 'password'"
                name="password"
                class="w-full px-3 py-2 pr-10 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="Min. 8 karakter"
            >

            <!-- Eye Icon -->
            <button type="button"
                @click="show = !show"
                class="absolute right-3 top-[34px] text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
            >
                <!-- Eye -->
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm2.458 5.458C16.034 18.768 14.07 19.5 12 19.5c-2.07 0-4.034-.732-5.458-2.042C4.82 15.84 3.5 14.06 3.5 12c0-2.06 1.32-3.84 3.042-5.458C7.966 5.232 9.93 4.5 12 4.5c2.07 0 4.034.732 5.458 2.042C19.18 8.16 20.5 9.94 20.5 12c0 2.06-1.32 3.84-3.042 5.458z"/>
                </svg>

                <!-- Eye Off -->
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19.5c-2.07 0-4.034-.732-5.458-2.042C4.82 15.84 3.5 14.06 3.5 12c0-1.25.47-2.42 1.3-3.5m3.28-2.59A9.953 9.953 0 0112 4.5c2.07 0 4.034.732 5.458 2.042C19.18 8.16 20.5 9.94 20.5 12c0 1.35-.57 2.6-1.5 3.75M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3v6m9 4L3 3"/>
                </svg>
            </button>
        </div>

        <!-- Konfirmasi Password -->
        <div x-data="{ showConfirm: false }" class="relative">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Konfirmasi Password <span class="text-red-500">*</span>
            </label>

            <input 
                :type="showConfirm ? 'text' : 'password'"
                name="password_confirmation"
                class="w-full px-3 py-2 pr-10 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="Ulangi password"
            >

            <button type="button"
                @click="showConfirm = !showConfirm"
                class="absolute right-3 top-[34px] text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
            >
                <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm2.458 5.458C16.034 18.768 14.07 19.5 12 19.5c-2.07 0-4.034-.732-5.458-2.042C4.82 15.84 3.5 14.06 3.5 12c0-2.06 1.32-3.84 3.042-5.458C7.966 5.232 9.93 4.5 12 4.5c2.07 0 4.034.732 5.458 2.042C19.18 8.16 20.5 9.94 20.5 12c0 2.06-1.32 3.84-3.042 5.458z"/>
                </svg>

                <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19.5c-2.07 0-4.034-.732-5.458-2.042C4.82 15.84 3.5 14.06 3.5 12c0-1.25.47-2.42 1.3-3.5m3.28-2.59A9.953 9.953 0 0112 4.5c2.07 0 4.034.732 5.458 2.042C19.18 8.16 20.5 9.94 20.5 12c0 1.35-.57 2.6-1.5 3.75M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3v6m9 4L3 3"/>
                </svg>
            </button>
        </div>
        
    </div>
    <p class="text-xs text-gray-500 dark:text-gray-400 italic mt-1">* Biarkan password kosong jika tidak ingin mengubahnya saat edit.</p>
</div>