@props(['inovasi'])

<div
    id="inovasiTableWrapper"
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden"
>
    {{-- HEADER --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <div>
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Daftar Inovasi</h3>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
        <table id="inovasiTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Nama Dosen</th>
                    <th scope="col" class="px-6 py-3">Nama Inovasi</th>
                    <th scope="col" class="px-6 py-3">Jenis Inovasi</th>
                    <th scope="col" class="px-6 py-3">HKI</th>
                    <th scope="col" class="px-6 py-3">No. HKI</th>
                    <th scope="col" class="px-6 py-3">Produk/Prototype</th>
                    <th scope="col" class="px-6 py-3">Pengguna/Mitra</th>
                    <th scope="col" class="px-6 py-3">Bukti</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($inovasi as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($inovasi instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $inovasi->firstItem() + $index }}
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                {{ optional($item->user)->sub_unit ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->tahun_akademik ?? '-' }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $item->nama_dosen ?? '-' }}</td>
                        <td class="px-6 py-4 max-w-sm">{{ $item->nama_inovasi ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->jenis_inovasi)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $item->jenis_inovasi }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->hki)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    {{ $item->hki }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->nomor_hki ?? '-' }}</td>
                        <td class="px-6 py-4 max-w-sm">{{ $item->produk_prototype ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $item->pengguna_mitra ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($item->link_bukti)
                                <a href="{{ $item->link_bukti }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Buka
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr id="emptyStateRow">
                        <td colspan="11" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data Inovasi dari prodi</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER + PAGINATION --}}
    <div class="border-t border-gray-200 px-6 py-3 dark:border-gray-700">
        <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                @if ($inovasi instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    @if ($inovasi->total() > 0)
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">{{ $inovasi->firstItem() }}</span> - <span class="font-medium text-gray-700 dark:text-gray-200">{{ $inovasi->lastItem() }}</span> dari <span class="font-medium text-gray-700 dark:text-gray-200">{{ $inovasi->total() }}</span> data
                    @else
                        Tidak ada data
                    @endif
                @else
                    @if ($inovasi->count() > 0)
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">1</span> - <span class="font-medium text-gray-700 dark:text-gray-200">{{ $inovasi->count() }}</span> dari <span class="font-medium text-gray-700 dark:text-gray-200">{{ $inovasi->count() }}</span> data
                    @else
                        Tidak ada data
                    @endif
                @endif
            </div>
            <div class="flex items-center gap-2">
                <label for="inovasiPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan Data:</label>
                <select id="inovasiPerPage"
                        class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                        onchange="changeInovasiPerPage(this.value)">
                    <option value="10"  {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25"  {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50"  {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua</option>
                </select>
            </div>
        </div>

        @if ($inovasi instanceof \Illuminate\Pagination\LengthAwarePaginator && $inovasi->hasPages())
            <div class="mt-3 pagination-wrapper">
                {{ $inovasi->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>

@once
@push('scripts')
<script>
(function () {
    'use strict';

    function buildUrl(extraParams = {}) {
        const url = new URL(window.location.href);

        url.searchParams.set('_partial', 'inovasi');

        if (!extraParams.page) {
            url.searchParams.delete('inovasi_page');
        }

        Object.entries(extraParams).forEach(([k, v]) => {
            url.searchParams.set(k, v);
        });

        return url;
    }

    async function fetchAndReplaceTable(url) {
        const wrapper = document.getElementById('inovasiTableWrapper');
        if (!wrapper) return;

        try {
            wrapper.classList.add('opacity-60', 'pointer-events-none');

            const res = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            });

            if (!res.ok) throw new Error('Gagal memuat data inovasi.');

            const html = await res.text();
            wrapper.outerHTML = html;

            const cleanUrl = new URL(url.toString());
            cleanUrl.searchParams.delete('_partial');
            window.history.pushState({}, '', cleanUrl.toString());

            attachPaginationListeners();
        } catch (err) {
            console.error(err);
            const current = document.getElementById('inovasiTableWrapper');
            current?.classList.remove('opacity-60', 'pointer-events-none');
            if (window.toast?.error) window.toast.error(err.message);
        }
    }

    function attachPaginationListeners() {
        const wrapper = document.getElementById('inovasiTableWrapper');
        if (!wrapper) return;

        const links = wrapper.querySelectorAll('.pagination-wrapper a');
        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                if (!href) return;

                const url = new URL(href);
                url.searchParams.set('_partial', 'inovasi');

                fetchAndReplaceTable(url);
            });
        });
    }

    window.changeInovasiPerPage = function (value) {
        fetchAndReplaceTable(buildUrl({ per_page: value }));
    };

    window.reloadInovasiTable = function () {
        const sel = document.getElementById('inovasiPerPage');
        const perPage = sel ? sel.value : (new URL(window.location.href)).searchParams.get('per_page') || '10';
        fetchAndReplaceTable(buildUrl({ per_page: perPage }));
    };

    document.addEventListener('DOMContentLoaded', attachPaginationListeners);
    document.addEventListener('inovasi:table:reloaded', attachPaginationListeners);
})();
</script>
@endpush
@endonce