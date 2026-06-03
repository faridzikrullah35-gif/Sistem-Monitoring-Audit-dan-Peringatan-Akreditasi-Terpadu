<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
        <thead class="bg-gray-50 dark:bg-gray-900/50">
            <tr>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">#</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Indikator</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Discussed with</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Recommendations and Improvement Suggestions</th>
                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-800 dark:bg-gray-900">
            @forelse($observasi as $item)
                <tr
                    data-id="{{ $item->id }}"
                    data-indikator="{{ $item->pertanyaanAmiProdi->indikator->indikator ?? '-' }}"
                    data-discussed="{{ strip_tags($item->discussed_with) }}"
                    data-rekomendasi="{{ strip_tags($item->rekomendasi) }}"
                    data-tahun="{{ $item->pertanyaanAmiProdi->tahunAkademik->tahun_akademik ?? '-' }}"
                    class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors"
                >
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 min-w-[200px] whitespace-normal break-words">
                        <div>
                            {{ 
                                $item->pertanyaanAmiProdi->indikator->indikator 
                                ?? $item->pertanyaanAmiUnit->indikator->indikator 
                                ?? '-' 
                            }}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        {!! $item->discussed_with ?: '<span class="text-gray-400 italic dark:text-gray-500">-</span>' !!}
                    </td>

                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        {!! $item->rekomendasi ?: '<span class="text-gray-400 italic dark:text-gray-500">-</span>' !!}
                    </td>
                    
                    <td class="px-4 py-3 text-right text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <!-- EDIT -->
                            <button
                                type="button"
                                onclick="openModalFormObservasi({{ $item->id }})"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                                title="Edit Data"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                    />
                                </svg>

                                Edit
                            </button>

                            <!-- DELETE -->
                            <button 
                                type="button"
                                onclick="deleteObservation({{ $item->id }})"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>

                                Hapus
                            </button>
                        </div>
                    </td>

                </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-10">
                    <div class="flex flex-col items-center justify-center text-center">

                        {{-- ICON --}}
                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                            <svg
                                class="h-8 w-8 text-gray-400 dark:text-gray-500"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h3m5 4H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l3.414 3.414a1 1 0 0 1 .293.707V18a2 2 0 0 1-2 2Z"
                                />
                            </svg>
                        </div>

                        {{-- TEXT --}}
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Belum Ada Data Observasi
                        </h3>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Data observasi yang dibuat auditor akan muncul di sini.
                        </p>

                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="border-t border-gray-200 px-6 py-3 dark:border-gray-700">
        <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">

            {{-- INFO DATA --}}
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan
                {{ $observasi->firstItem() ?? 0 }}
                -
                {{ $observasi->lastItem() ?? 0 }}
                dari
                {{ $observasi->total() }} data
            </div>

            {{-- PAGINATION --}}
            <div class="pagination-wrapper">
                {{ $observasi->links('pagination::tailwind') }}
            </div>

        </div>
    </div>

</div>