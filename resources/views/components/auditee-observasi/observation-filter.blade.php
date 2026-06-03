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