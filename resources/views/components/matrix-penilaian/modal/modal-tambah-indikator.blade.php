<div id="indikatorModal" class="fixed inset-0 z-50 hidden" aria-labelledby="indikatorModal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeIndikatorModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="relative w-full max-w-3xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl flex flex-col" style="max-height: 85vh;">
                
                <!-- Header - FIXED -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-indigo-50 dark:bg-indigo-900/30">
                            <svg class="w-4.5 h-4.5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </span>
                        <h3 id="indikatorModal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Isi Indikator</h3>
                    </div>
                    <button type="button" onclick="closeIndikatorModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- BODY - SCROLLABLE -->
                <div class="flex-1 overflow-y-auto px-6 py-5">
                    <form method="POST" 
                        action="{{ route('indikator.store') }}"
                        data-ajax="1"
                        data-table-id="#indikatorTableContainer"
                        id="indikatorForm"
                    >
                        <input type="hidden" name="id" id="indikator_id">
                        @csrf
                        <input type="hidden" name="elemen_id" id="indikator_elemen_id">

                        <div class="space-y-5">
                            <!-- Judul Elemen -->
                            <div class="px-4 py-3 bg-indigo-50/70 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800/40 rounded-xl">
                                <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 mb-1">Elemen</p>
                                <p id="indikator_elemen_label" class="text-sm font-medium text-gray-800 dark:text-gray-200">-</p>
                            </div>

                            <!-- Input Tambah Indikator -->
                            <div>
                                <label id="indikatorLabel" for="indikator_input" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                    Tambah Indikator
                                </label>
                                <textarea 
                                    name="indikator_input" 
                                    id="indikator_input" 
                                    rows="3" 
                                    placeholder="Tuliskan deskripsi indikator, lalu klik tombol Tambah..." 
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 transition-all duration-150 resize-none"></textarea>
                            </div>

                            <!-- Tabel Indikator -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Daftar Indikator</label>
                                <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                                    <div class="overflow-x-auto">
                                        <table id="indikatorTableContainer" class="w-full text-sm text-left min-w-[600px]">
                                            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-900/60 border-b border-gray-200 dark:border-gray-700">
                                                <tr>
                                                    <th scope="col" class="px-4 py-2.5 w-14 text-center font-semibold text-gray-500 dark:text-gray-400">#</th>
                                                    <th scope="col" class="px-4 py-2.5 font-semibold text-gray-500 dark:text-gray-400">Indikator</th>
                                                    <th scope="col" class="px-4 py-2.5 w-24 text-center font-semibold text-gray-500 dark:text-gray-400">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="indikatorTableBody" class="divide-y divide-gray-100 dark:divide-gray-700/50">
                                                <tr id="loadingRow" class="hidden">
                                                    <td colspan="3" class="text-center py-6 text-sm text-gray-500">Loading...</td>
                                                </tr>
                                                <tr id="indikatorEmptyRow">
                                                    <td colspan="3" class="px-4 py-8 text-center">
                                                        <svg class="w-8 h-8 mx-auto text-gray-300 dark:text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                        </svg>
                                                        <p class="text-xs text-gray-400 dark:text-gray-500">Belum ada indikator ditambahkan</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer - FIXED -->
                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <button type="button" onclick="closeIndikatorModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </button>
                    <button type="submit" form="indikatorForm" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/app.js'])