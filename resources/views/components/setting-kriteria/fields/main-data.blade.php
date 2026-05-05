<div class="space-y-4">
    <div class="flex items-center gap-2 mb-2">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Detail Kriteria</h4>
    </div>
    
    <div>
        <label for="standar_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Masuk ke dalam Standar</label>
        <div>
            <div class="flex gap-2">
                <select 
                    id="standar_id" 
                    name="standar_id"
                    data-auto-refresh="true"
                    data-refresh-url="{{ route('standar.data') }}"
                    class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm"
                >
                    <option value="">Pilih Standar</option>

                    @foreach ($standars as $standar)
                        <option value="{{ $standar->id }}">
                            {{ $standar->nama }}
                        </option>
                    @endforeach
                </select>

                <!-- tombol tambah -->
                <button 
                    type="button"
                    onclick="openModalStandar()"
                    class="flex items-center gap-2 px-3 py-2 text-xs bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-4 h-4" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor">
                        <path stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M12 4v16m8-8H4" />
                    </svg>

                    <span>Tambah Standar</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="sm:col-span-2">
            <label for="sub_kriteria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Kriteria <span class="text-red-500">*</span></label>
            <textarea id="sub_kriteria" name="sub_kriteria" rows="3" required class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 resize-none" placeholder="Tuliskan deskripsi indikator penilaian..."></textarea>
        </div>
    </div>
</div>
