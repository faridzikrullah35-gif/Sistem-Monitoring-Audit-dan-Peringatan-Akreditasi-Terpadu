@props(['tahunAkademiks'])

<div class="mb-5 flex flex-wrap items-center gap-3">

    {{-- FILTER --}}
    <select
        x-model="tahunAkademikId"
        @change="filterData(1)"
        class="h-11 min-w-[240px] rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
    >
        <option value="">
            Semua Tahun Akademik
        </option>

        @foreach ($tahunAkademiks as $tahun)
            <option value="{{ $tahun->id }}">
                {{ $tahun->tahun_akademik }} - {{ $tahun->semester }}
            </option>
        @endforeach
    </select>

    {{-- RESET --}}
    <button
        x-show="tahunAkademikId"
        @click="resetFilter"
        type="button"
        class="inline-flex h-11 items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 text-sm font-medium text-red-600"
    >
        Reset Filter
    </button>

    {{-- CETAK (muncul jika tahun dipilih) --}}
    <a
        x-show="tahunAkademikId"
        x-transition.opacity.duration.200ms
        :href="`{{ route('auditee-observasi.print') }}?tahun_akademik_id=${tahunAkademikId}`"
        target="_blank"
        class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-emerald-700"
        style="display: none;"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6v-8z"/>
        </svg>
        Cetak
    </a>

</div>

<script>

    function observationFilter() {

        return {

            tahunAkademikId: '{{ request("tahun_akademik_id") }}',

            isLoading: false,

            async filterData(page = 1) {

                this.isLoading = true;

                try {

                    const url = new URL(window.location.href);

                    // FILTER
                    if (this.tahunAkademikId) {

                        url.searchParams.set(
                            'tahun_akademik_id',
                            this.tahunAkademikId
                        );

                    } else {

                        url.searchParams.delete('tahun_akademik_id');

                    }

                    // PAGE
                    url.searchParams.set('page', page);

                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Gagal memuat data');
                    }

                    const html = await response.text();

                    // REPLACE TABLE
                    document
                        .getElementById('observation-table')
                        .innerHTML = html;

                    // UPDATE URL
                    window.history.pushState({}, '', url);

                } catch (error) {

                    console.error(error);

                } finally {

                    this.isLoading = false;

                }
            },

            resetFilter() {

                this.tahunAkademikId = '';

                this.filterData(1);
            }
        }
    }

    // ==========================================
    // AJAX PAGINATION
    // ==========================================
    document.addEventListener('click', function (e) {

        const link = e.target.closest('.pagination-wrapper a');

        if (!link) return;

        e.preventDefault();

        // KIRIM EVENT KE COMPONENT
        window.dispatchEvent(new CustomEvent('observation-page-change', {
            detail: {
                page: new URL(link.href)
                    .searchParams
                    .get('page') || 1
            }
        }));
    });

    // ==========================================
    // LISTENER GLOBAL
    // ==========================================
    window.addEventListener('observation-page-change', (event) => {

        const component = document
            .querySelector('[x-data="observationFilter()"]');

        if (!component || !component._x_dataStack) return;

        component
            ._x_dataStack[0]
            .filterData(event.detail.page);
    });

</script>