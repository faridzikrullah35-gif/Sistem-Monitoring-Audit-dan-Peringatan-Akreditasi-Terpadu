@props(['prestasi'])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table id="prestasiTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center w-16">No</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Nama Kegiatan</th>
                    <th scope="col" class="px-6 py-3">Waktu Perolehan</th>
                    <th scope="col" class="px-6 py-3">Tingkat</th>
                    <th scope="col" class="px-6 py-3">Prestasi yang Dicapai</th>
                    <th scope="col" class="px-6 py-3">Link</th>
                </tr>
            </thead>
            <tbody id="prestasiTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($prestasi as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors prestasi-row"
                        data-tahun="{{ $item->tahun_akademik }}"
                        data-tingkat="{{ $item->tingkat }}"
                        data-waktu="{{ $item->waktu_perolehan }}"
                        data-id="{{ $item->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                {{ $item->tahun_akademik }}
                            </span>
                        </td>
                        <td class="px-6 py-4 min-w-[200px] max-w-[350px] whitespace-normal break-words">
                            {{ $item->nama_kegiatan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                {{ $item->waktu_perolehan }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $item->tingkat == 'Internasional' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' :
                                   ($item->tingkat == 'Nasional' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' :
                                   'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                {{ $item->tingkat }}
                            </span>
                        </td>
                        <td class="px-6 py-4 min-w-[200px] max-w-[400px] whitespace-normal break-words">
                            {{ $item->prestasi_dicapai }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->link && $item->link != '#')
                                <a href="{{ $item->link }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                    Lihat Link
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr id="emptyStateRow">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data Prestasi Akademik Mahasiswa</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>