@props([
    'auditPtk'
])

<div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800">
    <table id="tableNCRContainer" class="w-full min-w-[2000px] text-left text-sm">

        {{-- =========================
            TABLE HEAD
        ========================== --}}
        <thead>
            <tr class="border-b border-gray-200 bg-gray-50 dark:border-gray-800 dark:bg-white/[0.02]">

                {{-- NO NCR --}}
                <th class="sticky left-0 z-10 w-[150px] whitespace-nowrap border-r border-gray-200 bg-gray-50 px-4 py-3 font-medium text-gray-500 dark:border-gray-800 dark:bg-gray-900/95 dark:text-gray-400">
                    No. NCR
                </th>

                {{-- INDIKATOR --}}
                <th class="w-[220px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Indikator
                </th>

                {{-- KLAUSUL --}}
                <th class="w-[180px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Klausul/Dokumen
                </th>

                {{-- DESKRIPSI URAIAN TEMUAN --}}
                <th class="w-[260px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Deskripsi / Uraian Temuan
                </th>

                {{-- ANALISIS PENYEBAB --}}
                <th class="w-[220px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Analisis Penyebab
                    <br>
                </th>

                {{-- AKIBAT --}}
                <th class="w-[220px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Akibat
                    <br>
                </th>

                {{-- KATEGORI --}}
                <th class="w-[140px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Kategori Temuan
                </th>

                {{-- RENCANA TINDAKAN PERBAIKAN --}}
                <th class="w-[220px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Rencana Tindakan Perbaikan
                    <br>
                    <span class="text-xs text-blue-500">(Auditee)</span>
                </th>

                {{-- TARGET --}}
                <th class="w-[170px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Tanggal Target Perbaikan
                    <br>
                    <span class="text-xs text-blue-500">(Auditee)</span>
                </th>

                {{-- PENCEGAHAN --}}
                <th class="w-[220px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Tindakan Pencegahan
                    <br>
                    <span class="text-xs text-blue-500">(Auditee)</span>
                </th>

                {{-- FILE --}}
                <th class="w-[120px] whitespace-nowrap px-3 py-3 text-center font-medium text-gray-500 dark:text-gray-400">
                    File
                    <br>
                    <span class="text-xs text-blue-500">(Auditee)</span>
                </th>

                {{-- TGL SELESAI --}}
                <th class="w-[120px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Tgl Selesai
                </th>

                {{-- STATUS --}}
                <th class="w-[160px] whitespace-nowrap px-3 py-3 font-medium text-gray-500 dark:text-gray-400">
                    Status Verifikasi
                </th>

                {{-- AKSI --}}
                <th class="sticky right-0 z-10 w-[100px] whitespace-nowrap border-l border-gray-200 bg-gray-50 px-3 py-3 text-right font-medium text-gray-500 dark:border-gray-800 dark:bg-gray-900/95 dark:text-gray-400">
                    Aksi
                </th>

            </tr>
        </thead>

        {{-- =========================
            TABLE BODY
        ========================== --}}
        <tbody
            id="tableBody"
            class="divide-y divide-gray-100 dark:divide-gray-800/60"
        >

            {{-- =========================================
                LOOP DATA DATABASE
            ========================================== --}}
            @forelse ($auditPtk as $item)

                <x-form-ketidaksesuaian-ncr.fields.table-row

                    :index="$loop->iteration"

                    :dataId="$item->id"
                    
                    :tahunAkademikId="
                        $item->pertanyaanAmiProdi?->tahun_akademik_id
                        ?? $item->pertanyaanAmiUnit?->tahun_akademik_id
                        ?? ''
                    "

                    :noNcr="$item->no_ncr"

                    :indikator="$item->pertanyaanAmiProdi->indikator->indikator ?? '-'"

                    :klausul="$item->klausul_dokumen"

                    :deskripsiTemuan="$item->deskripsi_uraian_temuan"

                    :kategori="$item->kategori_temuan"

                    :analisisPenyebab="$item->analisis_penyebab ?? ''"

                    :akibat="$item->akibat ?? ''"

                    :rencanaPerbaikan="$item->rencana_tindakan_perbaikan_auditee ?? ''"

                    :tanggalTargetPerbaikan="$item->tanggal_target_perbaikan_auditee ?? ''"

                    :tindakanPencegahan="$item->tindakan_pencegahan_auditee ?? ''"

                    :file="$item->file_auditee ?? ''"

                    :tglSelesai="$item->tanggal_selesai"

                    :statusVerifikasi="$item->status_ncr"

                />

            @empty

                {{-- EMPTY STATE --}}
                <tr>
                    <td colspan="13" class="px-4 py-14">

                        <div class="flex flex-col items-center gap-3">

                            {{-- ICON --}}
                            <svg
                                class="h-12 w-12 text-gray-300 dark:text-gray-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                />
                            </svg>

                            {{-- TEXT --}}
                            <div class="text-center">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Data PTK tidak ditemukan
                                </p>

                                <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">
                                    Belum ada data audit PTK yang tersedia
                                </p>
                            </div>

                        </div>

                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- =========================
        PAGINATION
    ========================= --}}
        <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">

            {{-- INFO DATA --}}
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan
                {{ $auditPtk->firstItem() ?? 0 }}
                -
                {{ $auditPtk->lastItem() ?? 0 }}
                dari
                {{ $auditPtk->total() }} data
            </div>

            {{-- LINKS --}}
            <div class="pagination-wrapper">
                {{ $auditPtk->links('pagination::tailwind') }}
            </div>

        </div>

</div>