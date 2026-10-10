@props([
    'pkm',
    'tahunList',
    'tingkatList',
    'prodi' => [],
    'filterProdi' => null,
    'filterTahun' => null,
    'filterTingkat' => null,
    'filterMahasiswa' => null,
])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
    <div class="p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3 flex-wrap">

                {{-- Filter Prodi --}}
                <label for="filterProdiPkm" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Prodi:
                </label>
                <select
                    id="filterProdiPkm"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[180px]"
                >
                    <option value="">Semua Prodi</option>
                    @foreach($prodi as $p)
                        <option
                            value="{{ $p->id }}"
                            {{ (string) $filterProdi === (string) $p->id ? 'selected' : '' }}
                        >
                            {{ $p->sub_unit ?? $p->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Tahun Akademik --}}
                <label for="filterTahunPkm" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Tahun Akademik:
                </label>
                <select
                    id="filterTahunPkm"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    @foreach($tahunList as $tahun)
                        <option
                            value="{{ $tahun }}"
                            {{ (string) $filterTahun === (string) $tahun ? 'selected' : '' }}
                        >
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Tingkat --}}
                <label for="filterTingkatPkm" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    Tingkat:
                </label>
                <select
                    id="filterTingkatPkm"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[130px]"
                >
                    <option value="">Semua Tingkat</option>
                    @foreach($tingkatList as $tingkat)
                        <option
                            value="{{ $tingkat }}"
                            {{ (string) $filterTingkat === (string) $tingkat ? 'selected' : '' }}
                        >
                            {{ $tingkat }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Melibatkan Mahasiswa --}}
                <label for="filterMahasiswaPkm" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    Melibatkan Mahasiswa:
                </label>
                <select
                    id="filterMahasiswaPkm"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[130px]"
                >
                    <option value="">Semua</option>
                    <option value="1" {{ (string) $filterMahasiswa === '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ (string) $filterMahasiswa === '0' ? 'selected' : '' }}>Tidak</option>
                </select>

                <button
                    type="button"
                    onclick="resetFilterPkm()"
                    class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset Filter
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span id="totalDataDisplayPkm">Total: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $pkm instanceof \Illuminate\Pagination\LengthAwarePaginator ? $pkm->total() : $pkm->count() }}</span> data</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        ['filterTahunPkm', 'filterProdiPkm', 'filterTingkatPkm', 'filterMahasiswaPkm']
            .forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('change', applyFilterPkm);
            });
    });

    function applyFilterPkm() {
        const wrapper = document.getElementById('pkmTableWrapper');
        if (!wrapper) return;

        const fTahun   = document.getElementById('filterTahunPkm');
        const fProdi   = document.getElementById('filterProdiPkm');
        const fTingkat = document.getElementById('filterTingkatPkm');
        const fMhs     = document.getElementById('filterMahasiswaPkm');

        const url = new URL(window.location.href);

        const tahun     = fTahun   ? fTahun.value   : '';
        const prodiId   = fProdi   ? fProdi.value   : '';
        const tingkat   = fTingkat ? fTingkat.value : '';
        const melibatkan = fMhs    ? fMhs.value     : '';

        if (tahun)       url.searchParams.set('filter_tahun_akademik', tahun);
        else             url.searchParams.delete('filter_tahun_akademik');

        if (prodiId)     url.searchParams.set('filter_prodi', prodiId);
        else             url.searchParams.delete('filter_prodi');

        if (tingkat)     url.searchParams.set('filter_tingkat', tingkat);
        else             url.searchParams.delete('filter_tingkat');

        if (melibatkan !== '') url.searchParams.set('filter_melibatkan_mahasiswa', melibatkan);
        else                   url.searchParams.delete('filter_melibatkan_mahasiswa');

        url.searchParams.delete('pkm_page');
        url.searchParams.set('_partial', 'pkm');

        fetchAndReplacePkmTable(url);
    }

    async function fetchAndReplacePkmTable(url) {
        const wrapper = document.getElementById('pkmTableWrapper');
        if (!wrapper) return;

        try {
            wrapper.classList.add('opacity-60', 'pointer-events-none');

            const res = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            });

            if (!res.ok) throw new Error('Gagal memuat data PKM.');

            const html = await res.text();
            wrapper.outerHTML = html;

            const cleanUrl = new URL(url.toString());
            cleanUrl.searchParams.delete('_partial');
            window.history.pushState({}, '', cleanUrl.toString());

            document.dispatchEvent(new Event('pkm:table:reloaded'));
        } catch (err) {
            console.error(err);
            const current = document.getElementById('pkmTableWrapper');
            current?.classList.remove('opacity-60', 'pointer-events-none');
            if (window.toast?.error) window.toast.error(err.message);
        }
    }

    window.resetFilterPkm = function () {
        const fTahun   = document.getElementById('filterTahunPkm');
        const fProdi   = document.getElementById('filterProdiPkm');
        const fTingkat = document.getElementById('filterTingkatPkm');
        const fMhs     = document.getElementById('filterMahasiswaPkm');

        if (fTahun)   fTahun.value = '';
        if (fProdi)   fProdi.value = '';
        if (fTingkat) fTingkat.value = '';
        if (fMhs)     fMhs.value = '';

        applyFilterPkm();
    };
})();

// ============================================================
//  HANDLE PRINT PKM FAKULTAS (filter-aware)
// ============================================================
window.handlePrintPkmFakultas = function(event) {
    if (event) event.preventDefault();

    // Baca filter yang aktif dari select element
    const filterProdi     = document.getElementById('filterProdiPkm')?.value || '';
    const filterTahun     = document.getElementById('filterTahunPkm')?.value || '';
    const filterTingkat   = document.getElementById('filterTingkatPkm')?.value || '';
    const filterMahasiswa = document.getElementById('filterMahasiswaPkm')?.value ?? '';

    // Base URL print
    const baseUrl = '{{ route("fakultas.pkm.print") }}';

    // Bangun query string
    const params = new URLSearchParams();
    if (filterProdi)     params.append('filter_prodi', filterProdi);
    if (filterTahun)     params.append('filter_tahun_akademik', filterTahun);
    if (filterTingkat)   params.append('filter_tingkat', filterTingkat);
    if (filterMahasiswa !== '') params.append('filter_melibatkan_mahasiswa', filterMahasiswa);

    const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;

    // Buka tab baru
    window.open(url, '_blank');
    return false;
};
</script>
@endpush