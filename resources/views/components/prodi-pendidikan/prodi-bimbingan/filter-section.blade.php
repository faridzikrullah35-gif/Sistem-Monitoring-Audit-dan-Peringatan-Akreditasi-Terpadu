@props([
    'bimbingans',
    'tahunBimbinganList',
    'semesterBimbinganList',
])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
    <div class="p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3 flex-wrap">
                <label for="filterTahunAkademikBimbingan" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter Tahun Akademik:
                </label>

                <select
                    id="filterTahunAkademikBimbingan"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[150px]"
                >
                    <option value="">Semua Tahun</option>
                    @foreach($tahunBimbinganList as $tahun)
                        <option
                            value="{{ $tahun }}"
                            {{ request('filter_tahun_bimbingan') === $tahun ? 'selected' : '' }}
                        >
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>

                <label for="filterSemesterBimbingan" class="text-sm font-medium text-gray-700 dark:text-gray-300 ml-2">
                    Semester:
                </label>

                <select
                    id="filterSemesterBimbingan"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500 min-w-[130px]"
                >
                    <option value="">Semua Semester</option>

                    @foreach($semesterBimbinganList as $semester)
                        <option
                            value="{{ $semester }}"
                            {{ request('filter_semester_bimbingan') === $semester ? 'selected' : '' }}
                        >
                            {{ $semester }}
                        </option>
                    @endforeach
                </select>

                <button
                    type="button"
                    onclick="resetFilterBimbingan()"
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
                    <span id="totalDataDisplayBimbingan">Total: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $bimbingans->count() }}</span> data</span>
                </div>

                @if($bimbingans->count() > 0)
                    <div class="text-xs text-gray-400 dark:text-gray-500">
                        <span id="visibleDataDisplayBimbingan">Menampilkan: <span class="font-semibold text-gray-600 dark:text-gray-400">{{ $bimbingans->count() }}</span></span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const filterTahun = document.getElementById(
        'filterTahunAkademikBimbingan'
    );

    const filterSemester = document.getElementById(
        'filterSemesterBimbingan'
    );

    if (filterTahun) {
        filterTahun.addEventListener('change', function () {
            loadBimbinganWithFilter();
        });
    }

    if (filterSemester) {
        filterSemester.addEventListener('change', function () {
            loadBimbinganWithFilter();
        });
    }

});

window.loadBimbinganWithFilter = async function () {

    const tableWrapper = document.getElementById(
        'bimbinganTableWrapper'
    );

    const filterTahun = document.getElementById(
        'filterTahunAkademikBimbingan'
    );

    const filterSemester = document.getElementById(
        'filterSemesterBimbingan'
    );

    if (!tableWrapper) {
        return;
    }

    const url = new URL(window.location.href);

    const tahun = filterTahun
        ? filterTahun.value
        : '';

    const semester = filterSemester
        ? filterSemester.value
        : '';

    if (tahun) {
        url.searchParams.set(
            'filter_tahun_bimbingan',
            tahun
        );
    } else {
        url.searchParams.delete(
            'filter_tahun_bimbingan'
        );
    }

    if (semester) {
        url.searchParams.set(
            'filter_semester_bimbingan',
            semester
        );
    } else {
        url.searchParams.delete(
            'filter_semester_bimbingan'
        );
    }

    // Reset halaman Bimbingan
    url.searchParams.delete(
        'bimbingan_page'
    );

    // Marker partial
    url.searchParams.set(
        '_partial',
        'bimbingan'
    );

    try {

        tableWrapper.classList.add(
            'opacity-60',
            'pointer-events-none'
        );

        const response = await fetch(
            url.toString(),
            {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            }
        );

        if (!response.ok) {
            throw new Error(
                'Gagal memuat data bimbingan.'
            );
        }

        const html = await response.text();

        tableWrapper.outerHTML = html;

        const historyUrl = new URL(
            url.toString()
        );

        historyUrl.searchParams.delete(
            '_partial'
        );

        window.history.pushState(
            {},
            '',
            historyUrl.toString()
        );

    } catch (error) {

        console.error(
            'Error filter bimbingan:',
            error
        );

        const currentWrapper =
            document.getElementById(
                'bimbinganTableWrapper'
            );

        if (currentWrapper) {
            currentWrapper.classList.remove(
                'opacity-60',
                'pointer-events-none'
            );
        }

        if (window.toast?.error) {
            window.toast.error(
                error.message ||
                'Gagal memuat data bimbingan.'
            );
        }
    }
};

window.resetFilterBimbingan = function () {

    const filterTahun =
        document.getElementById(
            'filterTahunAkademikBimbingan'
        );

    const filterSemester =
        document.getElementById(
            'filterSemesterBimbingan'
        );

    if (filterTahun) {
        filterTahun.value = '';
    }

    if (filterSemester) {
        filterSemester.value = '';
    }

    loadBimbinganWithFilter();
};
</script>
@endpush