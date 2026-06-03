<div id="auditorTableContainer">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIDN/NIK</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Auditor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">Unit</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">Sub Unit</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tahun Aktif</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">Tahun Non Aktif</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    
                    @if($auditors->isEmpty())
                    <!-- KONDISI JIKA DATA MASIH KOSONG -->
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada data auditor</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Silahkan tambahkan data baru menggunakan tombol di atas.</p>
                            </div>
                        </td>
                    </tr>
                    @else
                    <!-- KONDISI JIKA ADA DATA -->
                    @foreach($auditors as $auditor)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white font-mono">
                                {{ $auditor->identity_number }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ strtoupper($auditor->identity_type) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $auditor->nama_auditor }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden lg:table-cell">{{ $auditor->unit }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden lg:table-cell">{{ $auditor->sub_unit }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $auditor->tahun_aktif }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($auditor->status == 'Aktif')
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Aktif</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200">Non Aktif</span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 hidden md:table-cell">
                            {{ $auditor->tahun_non_aktif ?? '-' }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-3">
                                <!-- Tombol Edit (bawa ID untuk keperluan edit) -->
                                <button onclick="openModal('edit', {{ $auditor->id }})" class="flex flex-col items-center gap-1 px-3 py-2 text-xs font-medium rounded-md border border-indigo-200 text-indigo-600 hover:bg-indigo-50 dark:border-indigo-800 dark:text-indigo-400 dark:hover:bg-indigo-900/30 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span>Edit</span>
                                </button>
                                
                                <!-- Tombol Hapus -->
                                <button type="button"
                                    type="button"
                                    onclick="confirmDeleteAuditor({{ $auditor->id }})"
                                    class="flex flex-col items-center gap-1 px-3 py-2 text-xs font-medium rounded-md border border-red-200 text-red-600 hover:bg-red-50 dark:border-red-800 dark:text-red-400 dark:hover:bg-red-900/30 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
        
        <!-- Pagination Dinamis Laravel -->
        <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan {{ $auditors->firstItem() ?? 0 }} - {{ $auditors->lastItem() ?? 0 }} dari {{ $auditors->total() }} data
            </div>
            
            <div class="flex items-center gap-1">
                {{ $auditors->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>