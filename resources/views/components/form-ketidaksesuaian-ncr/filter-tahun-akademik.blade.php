@props([
    'tahunAkademik' => [],
    'tableSelector' => '#tableBody', // Default selector untuk body tabel NCR
    'rowAttribute' => 'data-ta-id',
    'urlParamName' => 'tahun_akademik_id',
    'iconColor' => 'red' // Bisa 'blue', 'red', 'green', dll
])

@php
    $iconColors = [
        'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400',
        'red' => 'bg-red-100 text-red-600 dark:bg-red-500/10 dark:text-red-400',
        'green' => 'bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400',
        'yellow' => 'bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400',
        'purple' => 'bg-purple-100 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400',
    ];
    $iconColorClass = $iconColors[$iconColor] ?? $iconColors['blue'];
@endphp

<div 
    x-data="filterTahunAkademik({
        tableSelector: '{{ $tableSelector }}',
        rowAttribute: '{{ $rowAttribute }}',
        urlParamName: '{{ $urlParamName }}',
        colspan: {{ $attributes->get('colspan', 13) }}
    })" 
    x-init="init()"
    class="mb-5 flex flex-col gap-2 rounded-xl border border-gray-100 bg-gray-50/50 p-4 sm:flex-row sm:items-center sm:justify-between dark:border-gray-800/60 dark:bg-white/[0.02] lg:mb-6"
>
    <div class="flex items-center gap-2.5">
        <div class="flex h-8 w-8 items-center justify-center rounded-lg {{ $iconColorClass }}">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
        </div>

        <div>
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ $attributes->get('title', 'Filter Tahun Akademik') }}
            </p>
            <p class="text-xs text-gray-400 dark:text-gray-500">
                {{ $attributes->get('description', 'Pilih tahun akademik untuk menyaring data') }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <select
            x-model="selectedTahun"
            @change="filterData()"
            class="h-10 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:focus:border-blue-400 dark:focus:ring-blue-500/20"
        >
            <option value="">Semua Tahun Akademik</option>
            @foreach ($tahunAkademik as $tahun)
                @if ($tahun)
                    <option value="{{ $tahun->id }}">
                        {{ $tahun->tahun_akademik ?? '-' }}
                        — {{ ucfirst($tahun->semester ?? '-') }}
                        @if (!empty($tahun->is_active) && $tahun->is_active)
                            (Aktif)
                        @endif
                    </option>
                @endif
            @endforeach
        </select>

        <button
            type="button"
            @click="resetFilter()"
            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:border-gray-700 dark:hover:bg-white/[0.06] dark:hover:text-gray-200"
            title="Reset filter"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182" />
            </svg>
        </button>
    </div>
</div>

<script>
    function filterTahunAkademik(config = {}) {
        return {
            selectedTahun: '',
            tableSelector: config.tableSelector || '#tableBody',
            rowAttribute: config.rowAttribute || 'data-ta-id',
            urlParamName: config.urlParamName || 'tahun_akademik_id',
            colspan: config.colspan || 13,
            
            init() {
                const urlParams = new URLSearchParams(window.location.search);
                const tahunParam = urlParams.get(this.urlParamName);
                if (tahunParam) {
                    this.selectedTahun = tahunParam;
                    this.filterData();
                }
            },
            
            filterData() {
                const val = this.selectedTahun;
                const tableBody = document.querySelector(this.tableSelector);
                if (!tableBody) return;
                
                const rows = tableBody.querySelectorAll('tr:not(#emptyStateRow)');
                let visibleCount = 0;
                
                rows.forEach(row => {
                    const taId = row.getAttribute(this.rowAttribute);
                    if (!val || taId === val) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                this.handleEmptyState(tableBody, visibleCount);
                this.updateUrl();
            },
            
            handleEmptyState(tableBody, visibleCount) {
                let emptyStateRow = document.getElementById('emptyStateRow');
                
                if (visibleCount === 0) {
                    if (!emptyStateRow) {
                        emptyStateRow = document.createElement('tr');
                        emptyStateRow.id = 'emptyStateRow';
                        emptyStateRow.innerHTML = `
                            <td colspan="${this.colspan}" class="px-4 py-14 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75h4.5m-4.5 4.5h4.5M3.75 6.75h16.5v10.5H3.75V6.75z" />
                                    </svg>
                                    <div class="text-center">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Tidak ada data untuk filter ini
                                        </p>
                                        <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">
                                            Coba pilih tahun akademik lain
                                        </p>
                                    </div>
                                </div>
                            </td>
                        `;
                        tableBody.appendChild(emptyStateRow);
                    } else {
                        emptyStateRow.style.display = '';
                    }
                } else {
                    if (emptyStateRow) {
                        emptyStateRow.style.display = 'none';
                    }
                }
            },
            
            updateUrl() {
                const url = new URL(window.location.href);
                if (this.selectedTahun) {
                    url.searchParams.set(this.urlParamName, this.selectedTahun);
                } else {
                    url.searchParams.delete(this.urlParamName);
                }
                window.history.pushState({}, '', url.toString());
            },
            
            resetFilter() {
                this.selectedTahun = '';
                this.filterData();
            }
        }
    }
</script>