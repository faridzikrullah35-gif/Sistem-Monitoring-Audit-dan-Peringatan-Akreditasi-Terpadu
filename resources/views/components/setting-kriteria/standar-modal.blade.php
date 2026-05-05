<!-- MODAL -->
<div id="modalStandar" class="fixed inset-0 z-[60] hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    
    <div class="relative w-full max-w-md mx-4 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-5 animate-fadeIn">
        
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h4 id="standarModalTitle" class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                    Input Standar Kriteria
                </h4>
            </div>
            <button onclick="closeModalStandar()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">✕</button>
        </div>

        <form 
            id="formStandar"
            method="POST"
            data-table-id="#standarTableContainer"
        >
            @csrf
            <input type="hidden" name="id" id="standar_id">

            <div class="space-y-3">
                <div>
                    <label for="standar" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                        Standar Kriteria
                    </label>
                    <input 
                        type="text" 
                        id="standar" 
                        name="nama"
                        placeholder="Input Standar Kriteria Baru..." 
                        class="w-full px-3 py-2 text-sm text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition"
                    >
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Input standar kriteria baru jika ingin menambah standar. Jika tidak ada, boleh dikosongkan.
                    </p>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-5">
                <button type="button" onclick="closeModalStandar()" 
                    class="px-3 py-2 text-xs rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-3 py-2 text-xs rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>