<div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-xl">

    <!-- TABLE -->
    <div class="w-full overflow-x-auto">
        <table id="pertanyaanAmiProdiTableContainer" class="min-w-[800px] w-full text-sm text-left">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-800/80">
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="col" class="px-5 py-2.5 w-[200px] font-semibold text-gray-500 dark:text-gray-400">Elemen</th>
                    <th scope="col" class="px-5 py-2.5 font-semibold text-gray-500 dark:text-gray-400">Indikator</th>
                    <th scope="col" class="px-5 py-2.5 w-16 text-center font-semibold text-gray-500 dark:text-gray-400">Hapus Per-Indikator</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">

                @php
                    $grouped = $dataPertanyaan->groupBy(function ($item) {
                        return $item->isiIndikator->matrix->elemen ?? '-';
                    });
                @endphp

                @forelse($grouped as $elemen => $items)

                    @foreach($items as $index => $item)

                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition-colors duration-150">

                            {{-- ELEMEN --}}
                            @if($index === 0)
                                <td 
                                    rowspan="{{ $items->count() }}"
                                    class="px-5 py-3.5 align-top border-r border-gray-100 dark:border-gray-700"
                                >
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 leading-relaxed">
                                        {{ $elemen }}
                                    </p>
                                </td>
                            @endif

                            {{-- INDIKATOR --}}
                            <td class="px-5 py-3.5">
                                <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed">
                                    {{ $item->isiIndikator->indikator ?? '-' }}
                                </p>
                            </td>

                            {{-- ACTION --}}
                            <td class="px-5 py-3.5 text-center align-middle">

                                <!-- Delete -->
                                <button 
                                    type="button"
                                    onclick="deletePertanyaanAmiProdi({{ $item->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>

                                    <span>Hapus</span>
                                </button>

                            </td>

                        </tr>

                    @endforeach

                @empty

                    <tr>
                        <td colspan="3" class="px-5 py-16">
                            
                            <div class="flex flex-col items-center justify-center text-center">

                                <div class="w-16 h-16 mb-4 rounded-full bg-gray-100 dark:bg-gray-700/50 flex items-center justify-center">
                                    <svg 
                                        class="w-8 h-8 text-gray-400 dark:text-gray-500" 
                                        fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            stroke-width="1.5" 
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                </div>

                                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                                    Data Pertanyaan Kosong
                                </h4>

                                <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs leading-relaxed">
                                    Belum ada data pertanyaan AMI Prodi yang ditambahkan untuk tahun akademik yang dipilih.
                                </p>

                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    <!-- Paginasi -->
    <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">

        <!-- Info -->
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan 
            {{ $dataPertanyaan->firstItem() ?? 0 }}
            -
            {{ $dataPertanyaan->lastItem() ?? 0 }}
            dari
            {{ $dataPertanyaan->total() }} data
        </div>

        <!-- Links -->
        <div class="pagination-wrapper">
            {{ $dataPertanyaan->links('vendor.pagination.tailwind') }}
        </div>

    </div>

</div>