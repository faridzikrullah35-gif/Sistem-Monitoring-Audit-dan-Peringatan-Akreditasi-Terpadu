{{-- resources/views/components/auditee-daftar-periksa/daftar-periksa-table.blade.php --}}
@props(['daftarPeriksas'])

<div
    x-data="{
        data: @js($daftarPeriksas),
        selectedTahun: '',  <!-- variabel ini akan di-binding dari parent jika ada -->
        currentPage: 1,
        perPage: 5,

        get filtered() {
            if (!this.selectedTahun) return this.data;
            return this.data.filter(item =>
                item.pertanyaan_ami_prodi?.tahun_akademik_id == this.selectedTahun
            );
        },

        get totalPages() {
            return Math.ceil(this.filtered.length / this.perPage) || 1;
        },

        get paginatedPeriksas() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filtered.slice(start, start + this.perPage);
        },

        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        },

        resetPage() {
            this.currentPage = 1;
        }
    }"
    x-init="$watch('selectedTahun', () => resetPage())"
    class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-800"
>
    <table class="w-full table-fixed border-separate border-spacing-0 text-sm">
        <thead>
            <tr class="bg-gray-50 dark:bg-gray-800/50">
                <th class="w-[5%] px-4 py-3 text-left text-xs font-semibold uppercase text-gray-700 dark:text-gray-200">#</th>
                <th class="w-[20%] px-4 py-3 text-left text-xs font-semibold uppercase text-gray-700 dark:text-gray-200">Tujuan</th>
                <th class="w-[25%] px-4 py-3 text-left text-xs font-semibold uppercase text-gray-700 dark:text-gray-200">Indikator</th>
                <th class="w-[20%] px-4 py-3 text-left text-xs font-semibold uppercase text-gray-700 dark:text-gray-200">Lingkup</th>
                <th class="w-[10%] px-4 py-3 text-left text-xs font-semibold uppercase text-gray-700 dark:text-gray-200">Skor</th>
                <th class="w-[20%] px-4 py-3 text-left text-xs font-semibold uppercase text-gray-700 dark:text-gray-200">Panduan</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(item, index) in paginatedPeriksas" :key="item.id">
                <tr class="align-top border-b border-gray-100 hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-900/40">
                    {{-- NO --}}
                    <td class="break-words px-4 py-4 text-sm text-gray-700 dark:text-gray-300"
                        x-text="((currentPage - 1) * perPage) + index + 1"></td>

                    {{-- TUJUAN --}}
                    <td class="break-words px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                        <div class="line-clamp-3 leading-relaxed"
                             x-text="item.pertanyaan_ami_prodi?.indikator?.matrix?.kriteria_audit?.standar?.nama || '-'">
                        </div>
                    </td>

                    {{-- INDIKATOR --}}
                    <td class="break-words px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                        <div class="line-clamp-3 leading-relaxed"
                             x-text="item.pertanyaan_ami_prodi?.indikator?.indikator || '-'">
                        </div>
                    </td>

                    {{-- LINGKUP --}}
                    <td class="break-words px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                        <div class="line-clamp-3 leading-relaxed"
                             x-text="item.pertanyaan_ami_prodi?.indikator?.matrix?.elemen || '-'">
                        </div>
                    </td>

                    {{-- SKOR --}}
                    <td class="break-words px-4 py-4 text-sm">
                        <div class="flex flex-col gap-2">
                            <div class="inline-flex w-fit items-center gap-2 rounded-full bg-brand-50 px-3 py-1 text-brand-700 dark:bg-brand-500/10 dark:text-brand-300">
                                <span x-text="item.score?.nilai_score || '-'"></span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400"
                                  x-text="item.score?.keterangan || '-'"></span>
                        </div>
                    </td>

                    {{-- PANDUAN --}}
                    <td class="break-words px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                        <div class="line-clamp-3 leading-relaxed"
                             x-html="item.panduan_pengisian || '-'">
                        </div>
                    </td>
                </tr>
            </template>

            {{-- EMPTY STATE --}}
            <tr x-show="filtered.length === 0">
                <td colspan="6" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                    <div class="flex flex-col items-center gap-2">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <span>Tidak ada data.</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="flex flex-col items-center justify-between gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800 sm:flex-row">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Menampilkan
            <span class="font-medium text-gray-800 dark:text-gray-200"
                x-text="filtered.length ? ((currentPage - 1) * perPage) + 1 : 0">
            </span>
            -
            <span class="font-medium text-gray-800 dark:text-gray-200"
                x-text="Math.min(currentPage * perPage, filtered.length)">
            </span>
            dari
            <span class="font-medium text-gray-800 dark:text-gray-200"
                x-text="filtered.length">
            </span>
            data
        </div>

        <div class="flex flex-wrap gap-2">
            <button
                class="rounded-md border border-gray-300 px-3 py-1 text-sm text-gray-700 hover:bg-gray-100 disabled:opacity-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800"
                @click="changePage(currentPage - 1)"
                :disabled="currentPage === 1"
            >
                Prev
            </button>

            <template x-for="page in totalPages" :key="page">
                <button
                    class="rounded-md border px-3 py-1 text-sm"
                    :class="{
                        'border-gray-300 bg-white text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700': page !== currentPage,
                        'border-transparent bg-gray-900 text-white dark:bg-gray-100 dark:text-gray-900': page === currentPage
                    }"
                    @click="changePage(page)"
                    x-text="page"
                ></button>
            </template>

            <button
                class="rounded-md border border-gray-300 px-3 py-1 text-sm text-gray-700 hover:bg-gray-100 disabled:opacity-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800"
                @click="changePage(currentPage + 1)"
                :disabled="currentPage === totalPages"
            >
                Next
            </button>
        </div>
    </div>
</div>