<div
    x-data="filterComponent()"
    x-init="init()"
    class="mb-5 flex flex-wrap items-center gap-4 rounded-lg bg-gray-50 p-4 dark:bg-gray-900/50"
>
    {{-- ICON --}}
    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none">
            <path d="M3 6H21M6 12H18M10 18H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <circle cx="18" cy="6" r="2" stroke="currentColor" stroke-width="2"/>
            <circle cx="6" cy="12" r="2" stroke="currentColor" stroke-width="2"/>
            <circle cx="14" cy="18" r="2" stroke="currentColor" stroke-width="2"/>
        </svg>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
            Filter Tahun Akademik:
        </span>
    </div>

    {{-- SELECT --}}
    <select
        x-model="selectedYear"
        @change="filterByYear()"
        class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm
            focus:border-brand-500 focus:outline-none focus:ring-1
            focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
    >
        <option value="semua">Semua Tahun</option>
        @foreach($tahunAkademik as $tahun)
            <option value="{{ $tahun->id }}">
                {{ $tahun->tahun_akademik }} - {{ $tahun->semester }}
            </option>
        @endforeach
    </select>

    {{-- RESET --}}
    <button
        type="button"
        @click="resetFilter()"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-300
            bg-white px-3 py-2 text-sm font-medium text-gray-700
            transition-colors hover:bg-gray-100 dark:border-gray-700
            dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5v5h5M21 19.5v-5h-5M20.49 9A9 9 0 0 0 5.64 5.64L3 9m18 6-2.64 3.36A9 9 0 0 1 3.51 15"/>
        </svg>
        Reset Filter
    </button>

    {{-- BUTTON CETAK (muncul hanya jika tahun dipilih) --}}
    <a
        x-show="showCetak"
        x-transition.opacity.duration.200ms
        :href="`{{ route('form-observasi.print') }}?tahun_akademik_id=${selectedYear}`"
        target="_blank"
        class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-emerald-700 hover:shadow-sm"
        style="display: none;"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6v-8z"/>
        </svg>
        Cetak
    </a>

    {{-- INFO --}}
    <div class="text-xs text-gray-500 dark:text-gray-400">
        <span x-show="selectedYear !== 'semua'">
            Filter tahun akademik aktif
        </span>
        <span x-show="selectedYear === 'semua'">
            Menampilkan semua data
        </span>
    </div>
</div>

<script>
    function filterComponent() {
        return {
            selectedYear: 'semua',
            showCetak: false,   // baru: kontrol visibilitas tombol cetak

            // inisialisasi dari URL parameter (opsional, biar konsisten)
            init() {
                const urlParams = new URLSearchParams(window.location.search);
                const tahunParam = urlParams.get('tahun_akademik_id');
                if (tahunParam && tahunParam !== 'semua') {
                    this.selectedYear = tahunParam;
                    this.showCetak = true;
                    this.filterByYear(); // langsung filter data sesuai parameter
                }
            },

            async filterByYear() {
                // Update visibilitas tombol cetak
                this.showCetak = (this.selectedYear !== 'semua');

                try {
                    let url = new URL('{{ route("form-observasi") }}');
                    if (this.selectedYear !== 'semua') {
                        url.searchParams.set('tahun_akademik_id', this.selectedYear);
                    }

                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();
                    document.getElementById('observationTableContainer').innerHTML = result.table;

                    // Update URL tanpa reload (biar state sinkron)
                    const newUrl = new URL(window.location.href);
                    if (this.selectedYear !== 'semua') {
                        newUrl.searchParams.set('tahun_akademik_id', this.selectedYear);
                    } else {
                        newUrl.searchParams.delete('tahun_akademik_id');
                    }
                    window.history.pushState({}, '', newUrl.toString());

                } catch (error) {
                    console.error('Filter observasi gagal:', error);
                }
            },

            async resetFilter() {
                this.selectedYear = 'semua';
                this.showCetak = false;   // tombol cetak langsung ilang
                await this.filterByYear(); // reload data tanpa filter tahun
            }
        }
    }
</script>