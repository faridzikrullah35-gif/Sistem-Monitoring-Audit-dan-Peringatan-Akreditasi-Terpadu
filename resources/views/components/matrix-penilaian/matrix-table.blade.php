<div class="overflow-x-auto">
    <div id="matrixTableContainer">

        <table id="matrixTableContainer" class="w-full text-sm text-left">
            <thead class="text-xs uppercase bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700/60">
                <tr>
                    <th scope="col" class="px-5 py-3.5 min-w-[280px] font-semibold text-gray-600 dark:text-gray-400">Kriteria</th>
                    <th scope="col" class="px-5 py-3.5 min-w-[320px] font-semibold text-gray-600 dark:text-gray-400">Elemen</th>
                    <th scope="col" class="px-5 py-3.5 w-40 text-center font-semibold text-gray-600 dark:text-gray-400">Aksi</th>
                </tr>
            </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60">

                    @forelse ($matrixs as $matrix)
                        <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-800/20 transition-colors duration-150">
                            
                            <!-- Standar -->
                            <td class="px-5 py-4">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                    {{ $matrix->kriteriaAudit->standar->nama ?? '-' }}
                                </p>
                            </td>

                            <!-- Elemen -->
                            <td class="px-5 py-4">
                                <span class="text-sm font-normal text-gray-800 dark:text-white">
                                    {{ $matrix->elemen }}
                                </span>
                            </td>

                            <!-- Action -->
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    <!-- Isi Indikator -->
                                    <button 
                                        onclick="openIndikatorModal({{ $matrix->id }}, `{{ $matrix->elemen }}`)"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/30 hover:bg-indigo-100 dark:hover:bg-indigo-900/40 rounded-lg transition-colors"
                                    >
                                        <!-- Icon -->
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg>
                                        Tambah Indikator
                                    </button>

                                    <!-- Edit -->
                                    <button 
                                        onclick="openMatrixModal('edit', {{ $matrix->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete -->
                                    <button 
                                        type="button"
                                        onclick="deleteMatrix({{ $matrix->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>

                                        <span>Hapus</span>
                                    </button>

                                </div>
                            </td>

                        </tr>

                    @empty
                            <tr>
                                <td colspan="6" class="px-4 py-16">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <!-- Ilustrasi SVG -->
                                        <div class="w-16 h-16 mb-4 rounded-full bg-gray-100 dark:bg-gray-700/50 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Data Audit Kosong</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs">Belum ada data matrix yang ditambahkan.</p>
                                    </div>
                                </td>
                            </tr>
                    @endforelse
                </tbody>
            </tbody>
        </table>
    </div>

    <!-- Paginasi -->
    <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
        
        <!-- Info -->
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan 
            {{ $matrixs->firstItem() ?? 0 }} 
            - 
            {{ $matrixs->lastItem() ?? 0 }} 
            dari 
            {{ $matrixs->total() }} data
        </div>

        <!-- Links -->
        <div class="flex items-center gap-1">
            {{ $matrixs->links('vendor.pagination.tailwind') }}
        </div>

    </div>

</div>