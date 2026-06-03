<div class="overflow-x-auto">
    <table id="formPeriksaTableContainer" class="w-full text-left text-sm">
        <thead>
            <tr class="border-b border-gray-200 bg-gray-50 dark:border-gray-800 dark:bg-white/[0.02]">
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 w-12">#</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">Deskripsi / Uraian Temuan</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">Analisis Penyebab</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">Akibat</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">Indikator</th>
                <th class="whitespace-nowrap px-4 py-3.5 text-center font-medium text-gray-500 dark:text-gray-400 w-20">Skor</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400">Panduan Pengisian</th>
                <th class="whitespace-nowrap px-4 py-3.5 text-right font-medium text-gray-500 dark:text-gray-400 w-24">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60" id="tableBody">

            @forelse ($pertanyaan as $index => $item)
                {{-- TAMBAHKAN data-ta-id DI SINI --}}
                <tr class="border-b border-gray-100 transition hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-white/[0.03]"
                    data-ta-id="{{
                        $item->pertanyaanAmiProdi?->tahun_akademik_id
                        ?? $item->pertanyaanAmiUnit?->tahun_akademik_id
                        ?? ''
                    }}">

                    {{-- NO --}}
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 whitespace-normal break-words">
                        {{ $index + 1 }}
                    </td>

                    {{-- DESKRIPSI / TEMUAN --}}
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 min-w-[260px] whitespace-normal break-words">
                        <div>
                            {{ $item->uraian_temuan ?? '-' }}
                        </div>
                    </td>

                    {{-- ANALISIS PENYEBAB --}}
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 min-w-[260px] whitespace-normal break-words">
                        <div>
                            {{ $item->analisis_penyebab ?? '-' }}
                        </div>
                    </td>

                    {{-- AKIBAT --}}
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 min-w-[200px] whitespace-normal break-words">
                        <div>
                            {{ $item->akibat ?? '-' }}
                        </div>
                    </td>

                    {{-- INDIKATOR (dari relasi isi_indikator) --}}
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 min-w-[200px] whitespace-normal break-words">
                        <div>
                            {{ 
                                $item->pertanyaanAmiProdi?->isiIndikator?->indikator
                                ?? $item->pertanyaanAmiUnit?->isiIndikator?->indikator
                                ?? '-'
                            }}
                        </div>
                    </td>

                    {{-- SCORE --}}
                    <td class="px-4 py-3 text-center whitespace-nowrap">

                        @php
                            $score = $item->score;

                            $nilai = trim($score->nilai_score ?? '');

                            $badgeColor = match(true) {

                                str_contains($nilai, '0 - 1') =>
                                    'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300',

                                str_contains($nilai, '2') =>
                                    'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300',

                                str_contains($nilai, '3') =>
                                    'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300',

                                str_contains($nilai, '4') =>
                                    'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300',

                                default =>
                                    'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300',
                            };
                        @endphp

                        @if($score)
                            <span class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-xs font-semibold {{ $badgeColor }}">
                                {{ $score->nilai_score }} - {{ $score->keterangan }}
                            </span>
                        @else
                            <span class="text-xs text-gray-400">-</span>
                        @endif

                    </td>

                    {{-- PANDUAN --}}
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 min-w-[220px] whitespace-normal break-words">
                        <div>
                            {!! $item->panduan_pengisian !!}
                        </div>
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">

                            <!-- EDIT -->
                            <button 
                                onclick='openModalFormPeriksa(
                                    {{ $item->id }},
                                    {{ $item->pertanyaan_ami_prodi_id ?? "null" }},
                                    @json($item)
                                )'
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit
                            </button>

                            <!-- DELETE -->
                            <button 
                                type="button"
                                onclick="deletePertanyaan({{ $item->id }})"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-10 text-center">
                        <div class="flex flex-col items-center gap-2 text-gray-400 dark:text-gray-500">
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.75 9.75h4.5m-4.5 4.5h4.5M3.75 6.75h16.5v10.5H3.75V6.75z" />
                            </svg>
                            <div class="text-sm font-medium">Data belum tersedia</div>
                            <div class="text-xs">Silakan tambahkan data audit terlebih dahulu</div>
                        </div>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <!-- Paginasi -->
    <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan
            {{ $pertanyaan->firstItem() ?? 0 }}
            -
            {{ $pertanyaan->lastItem() ?? 0 }}
            dari
            {{ $pertanyaan->total() }} data
        </div>
        <div class="pagination-wrapper">
            {{ $pertanyaan->links('pagination::tailwind') }}
        </div>
    </div>
</div>