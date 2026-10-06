<div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">

    <div>
        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400">Tahun Akademik <span class="text-red-500">*</span></label>
        <select id="filter-tahun"
                class="dropdown-arrow w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-sky-500">
            <option value="">Pilih Tahun Akademik</option>
            @foreach($tahunAkademiks as $ta)
                <option value="{{ $ta->id }}">{{ $ta->tahun_akademik }} - {{ $ta->semester }}</option>
            @endforeach
        </select>
    </div>

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

    <div>
        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400">Subunit</label>
        <select id="filter-subunit"
                class="dropdown-arrow w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:ring-sky-500">
            <option value="">Pilih Subunit</option>
        </select>
    </div>

    <div class="flex items-end gap-2">
        <button type="button" id="btn-reset-filter"
                class="hidden w-full rounded-lg bg-gray-200 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
            Reset Filter
        </button>

        <a href="#"
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

    const subUnitData = @json($subUnitsByUnit);

    // Cek apakah tahun akademik sudah dipilih
    function hasYearFilter() {
        return tahun.value !== '';
    }

    function hasActiveFilter() {
        return hasYearFilter();
    }

    function updateSubunitOptions(selectedUnit = null) {
        // Reset dropdown dengan opsi default
        subunit.innerHTML = '<option value="">Pilih Subunit</option>';
        
        // Tambahkan opsi "Semua Data"
        const allOption = document.createElement('option');
        allOption.value = 'all';
        allOption.textContent = 'Semua Data';
        subunit.appendChild(allOption);
        
        // Tambahkan subunit dari database
        if (selectedUnit && subUnitData[selectedUnit]) {
            const subunits = subUnitData[selectedUnit];
            subunits.forEach(sub => {
                const option = document.createElement('option');
                option.value = sub;
                option.textContent = sub;
                subunit.appendChild(option);
            });
        }
    }

    function getFilters() {
        return {
            tahun_akademik_id: tahun.value,
            unit: unit.value,
            subunit: subunit.value
        };
    }

    function toggleButtons() {
        const hasFilter = hasActiveFilter();
        if (hasFilter) {
            resetBtn.classList.remove('hidden');
            printBtn.classList.remove('hidden');
            printBtn.classList.remove('pointer-events-none', 'opacity-50');
        } else {
            resetBtn.classList.add('hidden');
            printBtn.classList.add('hidden');
        }
    }

    function updatePrintUrl() {
        const params = new URLSearchParams(getFilters()).toString();
        if (tahun.value) {
            printBtn.href = `{{ route('fakultas.hasil-audit.rekapitulasi.print') }}?${params}`;
        } else {
            printBtn.href = '#';
        }
    }

    function fetchData() {
        const params = new URLSearchParams(getFilters()).toString();
        
        if (!tahun.value) {
            tableContainer.innerHTML = `
                <div class="mt-5 overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">No. NCR</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tgl. Audit</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Bagian</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Macam Temuan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Uraian Temuan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tgl. Target</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Tgl. Verifikasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Auditor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-600 dark:text-gray-300">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            <tr>
                                <td colspan="11" class="py-12 text-center">
                                    <div class="flex flex-col items-center text-gray-400 dark:text-gray-500">
                                        <svg class="mb-3 h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                        </svg>
                                        <p class="text-sm font-medium">Pilih Tahun Akademik terlebih dahulu</p>
                                        <p class="text-xs">Tahun Akademik wajib dipilih untuk menampilkan rekapitulasi data</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;
            return;
        }

        fetch(`{{ route('fakultas.hasil-audit.rekapitulasi.filter') }}?${params}&_=${Date.now()}`, {
            headers: {
                'Cache-Control': 'no-cache, no-store, must-revalidate',
                'Pragma': 'no-cache',
                'Expires': '0'
            }
        })
        .then(res => res.json())
        .then(result => {
            tableContainer.innerHTML = result.table;
        })
        .catch(err => console.error('AJAX Error:', err));
    }

    // Event Listeners
    unit.addEventListener('change', function () {
        updateSubunitOptions(this.value);
        toggleButtons();
        updatePrintUrl();
        fetchData();
    });

    tahun.addEventListener('change', function () {
        toggleButtons();
        updatePrintUrl();
        fetchData();
    });

    subunit.addEventListener('change', function () {
        toggleButtons();
        updatePrintUrl();
        fetchData();
    });

    resetBtn.addEventListener('click', function () {
        tahun.value = '';
        unit.value = '';
        subunit.value = '';
        updateSubunitOptions(null);
        toggleButtons();
        updatePrintUrl();
        fetchData();
    });

    // Inisialisasi
    const initialUnit = unit.value || null;
    updateSubunitOptions(initialUnit);
    toggleButtons();
    updatePrintUrl();

    // Jika tahun sudah terpilih (misal dari URL), fetch data
    if (hasYearFilter()) {
        fetchData();
    }
});
</script>