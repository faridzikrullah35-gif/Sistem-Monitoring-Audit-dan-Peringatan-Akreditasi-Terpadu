<div class="space-y-4">
    <div class="flex items-center gap-2 mb-2">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Detail Pertanyaan AMI Prodi</h4>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <!-- Pilih Kriteria -->
        <div 
            x-data="{ open: false }"
            class="relative"
        >
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Pilih Kriteria <span class="text-red-500">*</span>
            </label>

            <!-- Trigger Dropdown -->
            <button 
                type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-700 dark:text-white"
            >
                <span>Pilih Kriteria</span>

                <svg 
                    class="w-4 h-4 transition-transform"
                    :class="{ 'rotate-180': open }"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </button>

            <!-- Dropdown Content -->
            <div 
                x-show="open"
                @click.away="open = false"
                x-transition
                class="absolute z-50 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg overflow-hidden"
            >

                <!-- Header -->
                <div class="grid grid-cols-2 bg-gray-100 dark:bg-gray-700 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
                    <div>Nama Kriteria</div>
                    <div class="text-center">Pilih</div>
                </div>

                <!-- Body -->
                <div class="max-h-60 overflow-y-auto divide-y divide-gray-200 dark:divide-gray-700">

                    @foreach($kriteria as $item)
                        <label class="grid grid-cols-2 items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                            
                            <div class="text-sm text-gray-800 dark:text-gray-100">
                                {{ $item->nama }}
                            </div>

                            <div class="flex justify-center">
                                <input 
                                    type="checkbox"
                                    name="kriteria[]"
                                    value="{{ $item->id }}"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                >
                            </div>

                        </label>
                    @endforeach

                </div>
            </div>
        </div>

        <!-- Tahun Akademik -->
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Tahun Akademik <span class="text-red-500">*</span>
            </label>

            <select 
                id="tahun" 
                name="tahun" 
                required
                class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white"
            >
                <option value="" disabled selected>
                    -- Pilih Tahun Akademik --
                </option>

                @foreach($tahunAkademik as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->tahun_akademik }} - {{ $item->semester }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

</div>