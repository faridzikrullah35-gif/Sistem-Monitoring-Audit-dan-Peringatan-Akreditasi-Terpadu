{{-- resources/views/components/auditee-penilaian-kinerja/table.blade.php --}}
@props(['dataPenilaian'])

<div class="overflow-x-auto">
    <table id="penilaianTableContainer" class="w-full text-left text-sm table-auto">
        <thead>
            <tr class="border-b border-gray-200 bg-gray-50 dark:border-gray-800 dark:bg-white/[0.02]">
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 w-12 align-middle">#</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 w-[15%] align-middle">Standar / Kriteria</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 w-[15%] align-middle">Elemen</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 w-[20%] align-middle">Indikator</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 text-center w-[10%] align-middle">Score</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 w-[25%] align-middle">Deskripsi / Uraian</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 text-center w-[10%] align-middle">File PDF</th>
                <th class="whitespace-nowrap px-4 py-3.5 font-medium text-gray-500 dark:text-gray-400 text-center w-[15%] align-middle">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60" id="tableBody">
            @forelse ($dataPenilaian as $index => $item)
                @php
                    $indikator = $item->isiIndikator;
                    $matrix = $indikator?->matrix;
                    $kriteria = $matrix?->kriteriaAudit?->standar;
                    $score = $item->score;
                    $filePath = $item->file_path;
                @endphp
                <tr class="border-b border-gray-100 transition hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-white/[0.03]">
                    <td class="px-4 py-3.5 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap align-top">{{ $index + 1 }}</td>
                    <td class="px-4 py-3.5 text-sm text-gray-700 dark:text-gray-300 break-words align-top max-w-[200px]">{{ $kriteria->nama ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-sm text-gray-700 dark:text-gray-300 break-words align-top max-w-[200px]">{{ $matrix->elemen ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-sm text-gray-700 dark:text-gray-300 break-words align-top max-w-[250px]">{{ $indikator->indikator ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-center whitespace-nowrap align-top">
                        @if($score)
                            @php
                                $nilai = $score->nilai_score;
                                $keterangan = $score->keterangan;
                                $badgeColor = match(true) {
                                    $nilai >= 4 => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300',
                                    $nilai >= 3 => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300',
                                    $nilai >= 2 => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300',
                                    $nilai >= 1 => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300',
                                    default => 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300',
                                };
                            @endphp
                            <span class="inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-semibold {{ $badgeColor }} min-w-[60px]">
                                {{ $nilai }} - {{ $keterangan }}
                            </span>
                        @else
                            <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-sm text-gray-700 dark:text-gray-300 break-words align-top max-w-[300px]">
                        {{ $item->deskripsi }}
                    </td>
                    <td class="px-4 py-3.5 text-center whitespace-nowrap align-top">
                        @if($filePath)
                            <a href="{{ Storage::url($filePath) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Lihat PDF
                            </a>
                        @else
                            <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-center whitespace-nowrap align-top">
                        <div class="flex items-center justify-center gap-2">
                            @php
                                $indikator = $item->isiIndikator;
                                $matrix    = $indikator->matrix ?? null;
                                $kriteria  = $matrix->kriteriaAudit->standar ?? null;

                                $editData = [
                                    'deskripsi'        => $item->deskripsi,
                                    'setting_score_id' => $item->setting_score_id,
                                    'file_path'        => $item->file_path,
                                    'kriteria_id'      => $kriteria->id ?? '',
                                    'matrixs_id'       => $matrix->id ?? '',
                                    'isi_indikator_id' => $item->isi_indikator_id,
                                ];
                            @endphp

                            <button
                                type="button"
                                onclick="openModalPenilaianKinerja(
                                    {{ $item->id }},
                                    {{ Js::from($editData) }}
                                )"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors">

                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>

                                Edit
                            </button>

                            <button type="button" onclick="deletePenilaianKinerja({{ $item->id }})"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200">
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
                    <td colspan="8" class="px-4 py-10 text-center align-middle">
                        <div class="flex flex-col items-center gap-2 text-gray-400 dark:text-gray-500">
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 9.75h4.5m-4.5 4.5h4.5M3.75 6.75h16.5v10.5H3.75V6.75z" />
                            </svg>
                            <div class="text-sm font-medium">Belum ada data penilaian</div>
                            <div class="text-xs">Silakan tambahkan penilaian dengan tombol "Tambah Penilaian"</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="border-t border-gray-200 px-6 py-3 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan {{ $dataPenilaian->firstItem() ?? 0 }} - {{ $dataPenilaian->lastItem() ?? 0 }}
            dari {{ $dataPenilaian->total() }} data
        </div>
        <div class="pagination-wrapper">
            {{ $dataPenilaian->links('pagination::tailwind') }}
        </div>
    </div>
</div>