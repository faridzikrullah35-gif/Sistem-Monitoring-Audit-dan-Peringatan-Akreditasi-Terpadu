<div id="tahunAkademikTableContainer">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tahun Akademik</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Semester</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    
                    @if($tahunAkademiks->isEmpty())
                    <!-- KONDISI JIKA DATA MASIH KOSONG -->
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada data tahun akademik</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Silahkan tambahkan data baru menggunakan tombol di atas.</p>
                            </div>
                        </td>
                    </tr>
                    @else
                    <!-- LOOPING DATA DARI DATABASE -->
                    @foreach($tahunAkademiks as $ta)
                    
                    <!-- Background Baris berubah biru muda jika status Aktif -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors {{ $ta->status == 'Aktif' ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <!-- Icon dinamis: Kilat (biru) jika aktif, Kalender (abu) jika nonaktif -->
                                <div class="w-10 h-10 rounded-lg {{ $ta->status == 'Aktif' ? 'bg-blue-100 dark:bg-blue-900' : 'bg-gray-100 dark:bg-gray-700' }} flex items-center justify-center">
                                    @if($ta->status == 'Aktif')
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <!-- Font Bold jika aktif, Medium jika nonaktif -->
                                <span class="text-sm {{ $ta->status == 'Aktif' ? 'font-bold text-gray-900 dark:text-white' : 'font-medium text-gray-700 dark:text-gray-300' }}">{{ $ta->tahun_akademik }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm {{ $ta->status == 'Aktif' ? 'text-gray-800 dark:text-gray-200 font-medium' : 'text-gray-600 dark:text-gray-400' }}">{{ $ta->semester }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($ta->status == 'Aktif')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">

                                <!-- Edit -->
                                <button 
                                    type="button"
                                    onclick="openModal('edit', {{ $ta->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>

                                    <span>Edit</span>
                                </button>

                                <!-- Delete -->
                                <button 
                                    type="button"
                                    onclick="deleteTahunAkademik({{ $ta->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                                >
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
        
        <!-- Pagination Dinamis -->
        <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan {{ $tahunAkademiks->firstItem() ?? 0 }} - {{ $tahunAkademiks->lastItem() ?? 0 }} dari {{ $tahunAkademiks->total() }} data
            </div>
            
            <div class="flex items-center gap-1">
                {{ $tahunAkademiks->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>