@props(['pkm'])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table id="pkmTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">No</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Nama Dosen</th>
                    <th scope="col" class="px-6 py-3">NIDN</th>
                    <th scope="col" class="px-6 py-3">Judul PKM</th>
                    <th scope="col" class="px-6 py-3">Lokasi Mitra</th>
                    <th scope="col" class="px-6 py-3">Tingkat</th>
                    <th scope="col" class="px-6 py-3">Sumber Dana</th>
                    <th scope="col" class="px-6 py-3 text-center">Mahasiswa</th>
                    <th scope="col" class="px-6 py-3">Luaran</th>
                    <th scope="col" class="px-6 py-3">Link Bukti</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="pkmTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($pkm as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors pkm-row" 
                        data-tahun="{{ $item->tahun_akademik }}"
                        data-tingkat="{{ $item->tingkat }}"
                        data-mahasiswa="{{ $item->melibatkan_mahasiswa ? '1' : '0' }}"
                        data-id="{{ $item->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                {{ $item->tahun_akademik }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $item->nama_dosen }}
                        </td>
                        <td class="px-6 py-4">{{ $item->nidn ?? '-' }}</td>
                        <td class="px-6 py-4 min-w-[250px] max-w-[400px] whitespace-normal break-words">
                            {{ $item->judul_pkm }}
                        </td>
                        <td class="px-6 py-4 min-w-[200px] max-w-[300px] whitespace-normal break-words">
                            {{ $item->lokasi_mitra }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $item->tingkat == 'Internasional' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : 
                                   ($item->tingkat == 'Nasional' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 
                                   'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                {{ $item->tingkat }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $item->sumber_dana }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($item->melibatkan_mahasiswa)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Ya
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Tidak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 min-w-[150px] max-w-[250px] whitespace-normal break-words">
                            {{ $item->luaran }}
                        </td>
                        <td class="px-6 py-4">
                            @if($item->link_bukti)
                                <a href="{{ $item->link_bukti }}" 
                                   target="_blank" 
                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 underline-offset-2 hover:underline inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Lihat
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <button 
                                    type="button"
                                    onclick="editPKM({{ $item->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors"
                                    title="Edit"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    Edit
                                </button>
                                <button 
                                    type="button"
                                    onclick="deletePKM({{ $item->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                                    title="Hapus"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyStateRow">
                        <td colspan="12" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data PKM</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Klik tombol "Tambah PKM" untuk menambahkan data</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>