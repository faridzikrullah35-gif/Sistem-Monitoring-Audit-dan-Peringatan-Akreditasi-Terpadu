<div class="p-5">
    <!-- Container Tabel -->
    <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden bg-white dark:bg-gray-800 shadow-sm">
        <div class="overflow-x-auto">
            <table id="akses_auditor_table" class="w-full text-sm text-left">
                <thead class="text-xs uppercase text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium">Pengguna</th>
                        <th scope="col" class="px-4 py-3 font-medium">Unit</th>
                        <th scope="col" class="px-4 py-3 font-medium">Sub Unit</th>
                        <th scope="col" class="px-4 py-3 font-medium">Tgl. Audit</th>
                        <th scope="col" class="px-4 py-3 font-medium">Tahun Ajaran</th>
                        <th scope="col" class="px-4 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                    
                    @forelse ($akses as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            
                            <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">
                                {{ $item->user->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                {{ $item->user->unit ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                {{ $item->user->sub_unit ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($item->tgl_audit)->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                {{ $item->tahunAkademik->tahun_akademik ?? '-' }} 
                                {{ $item->tahunAkademik->semester ?? '' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    <!-- Isi Akses -->
                                    <button 
                                        type="button" 
                                        onclick="openAuditorModal({{ $item->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 rounded-lg transition"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        Isi Akses
                                    </button>

                                    <!-- Edit -->
                                    <button 
                                        type="button" 
                                        onclick="openModal('edit', {{ $item->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 hover:bg-amber-100 dark:bg-amber-900/20 dark:text-amber-300 rounded-lg transition"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete -->
                                    <button 
                                        type="button"
                                        onclick="deleteAksesAuditor({{ $item->id }})"
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
                                        <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs">Belum ada data audit yang ditambahkan.</p>
                                    </div>
                                </td>
                            </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan 
                {{ $akses->firstItem() ?? 0 }} 
                - 
                {{ $akses->lastItem() ?? 0 }} 
                dari 
                {{ $akses->total() }} data
            </div>

            <!-- Links -->
            <div class="flex items-center gap-1">
                {{ $akses->links('vendor.pagination.tailwind') }}
            </div>

        </div>
    </div>

</div>