<div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">

    {{-- Tahun Akademik --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400">Tahun Akademik</label>
        <select id="filter-tahun"
                class="dropdown-arrow w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-sky-500">
            <option value="">Pilih Tahun Akademik</option>
            @foreach($tahunAkademiks as $ta)
                <option value="{{ $ta->id }}">{{ $ta->tahun_akademik }} - {{ $ta->semester }}</option>
            @endforeach
        </select>
    </div>

    {{-- Unit --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400">Unit</label>
        <select id="filter-unit"
                class="dropdown-arrow w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-sky-500">
            <option value="">Pilih Unit</option>
            @foreach($units as $unit)
                <option value="{{ $unit }}">{{ $unit }}</option>
            @endforeach
        </select>
    </div>

    {{-- Subunit --}}
    <div>
        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400">Subunit</label>
        <select id="filter-subunit"
                class="dropdown-arrow w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-sky-500">
            <option value="">Pilih Subunit</option>
            @foreach($subUnits as $sub)
                <option value="{{ $sub }}">{{ $sub }}</option>
            @endforeach
        </select>
    </div>

    {{-- Tombol Reset & Cetak --}}
    <div class="flex items-end gap-2">
        <button type="button" id="btn-reset-filter"
                class="hidden w-full rounded-lg bg-gray-200 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
            Reset Filter
        </button>

        <a href="{{ route('hasil-audit.terpenuhi.print', request()->query()) }}"
           target="_blank"
           id="btn-print"
           class="hidden w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white text-center shadow-sm transition hover:bg-blue-700 dark:bg-sky-600 dark:hover:bg-sky-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="inline-block mr-1">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
            Cetak
        </a>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tahun = document.getElementById('filter-tahun');
    const unit = document.getElementById('filter-unit');
    const subunit = document.getElementById('filter-subunit');
    const resetBtn = document.getElementById('btn-reset-filter');
    const printBtn = document.getElementById('btn-print');
    const tableContainer = document.getElementById('table-container');

    function getFilters() {
        return {
            tahun_akademik_id: tahun.value,
            unit: unit.value,
            subunit: subunit.value
        };
    }

    function toggleButtons() {
        const hasFilter = tahun.value || unit.value || subunit.value;
        if (hasFilter) {
            resetBtn.classList.remove('hidden');
            printBtn.classList.remove('hidden');
        } else {
            resetBtn.classList.add('hidden');
            printBtn.classList.add('hidden');
        }
    }

    function updatePrintUrl() {
        const params = new URLSearchParams(getFilters()).toString();
        printBtn.href = `{{ route('hasil-audit.terpenuhi.print') }}?${params}`;
    }

    function fetchData() {
        const params = new URLSearchParams(getFilters()).toString();
        fetch(`{{ route('hasil-audit.terpenuhi.filter') }}?${params}`)
            .then(res => res.text())
            .then(html => {
                tableContainer.innerHTML = html;
            })
            .catch(err => console.error('AJAX Error:', err));
    }

    [tahun, unit, subunit].forEach(el => {
        el.addEventListener('change', function () {
            toggleButtons();
            updatePrintUrl();
            fetchData();
        });
    });

    resetBtn.addEventListener('click', function () {
        tahun.value = '';
        unit.value = '';
        subunit.value = '';
        toggleButtons();
        updatePrintUrl();
        fetchData();
    });

    toggleButtons();
    updatePrintUrl();
});
</script>