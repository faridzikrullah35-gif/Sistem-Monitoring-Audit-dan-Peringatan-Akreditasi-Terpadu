@props(['kurikulums'])

<div
    id="kurikulumTableWrapper"
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden"
>
    {{-- HEADER (tanpa tombol tambah) --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <div>
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Daftar Kurikulum</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Data hanya dapat dilihat (view only)</p>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
        <table id="kurikulumTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Dokumen</th>
                    <th scope="col" class="px-6 py-3">Tanggal Penetapan</th>
                    <th scope="col" class="px-6 py-3">Peninjauan Kurikulum</th>
                </tr>
            </thead>
            <tbody id="kurikulumTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($kurikulums as $index => $kurikulum)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors kurikulum-row"
                        data-tahun="{{ $kurikulum->tahun_akademik }}"
                        data-id="{{ $kurikulum->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($kurikulums instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $kurikulums->firstItem() + $index }}
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $kurikulum->tahun_akademik }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($kurikulum->dokumen)
                                <a href="{{ Storage::url($kurikulum->dokumen) }}" target="_blank"
                                   class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Lihat Dokumen
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($kurikulum->tgl_penetapan)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    {{ \Carbon\Carbon::parse($kurikulum->tgl_penetapan)->format('d M Y') }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($kurikulum->peninjauan_kurikulum)
                                {{ $kurikulum->peninjauan_kurikulum }}
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr id="emptyStateRow">
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data Kurikulum</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="border-t border-gray-200 px-6 py-3 dark:border-gray-700">
        <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                @if ($kurikulums instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    @if ($kurikulums->total() > 0)
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">{{ $kurikulums->firstItem() }}</span> - <span class="font-medium text-gray-700 dark:text-gray-200">{{ $kurikulums->lastItem() }}</span> dari <span class="font-medium text-gray-700 dark:text-gray-200">{{ $kurikulums->total() }}</span> data
                    @else
                        Tidak ada data
                    @endif
                @else
                    @if ($kurikulums->count() > 0)
                        Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">1</span> - <span class="font-medium text-gray-700 dark:text-gray-200">{{ $kurikulums->count() }}</span> dari <span class="font-medium text-gray-700 dark:text-gray-200">{{ $kurikulums->count() }}</span> data
                    @else
                        Tidak ada data
                    @endif
                @endif
            </div>
            <div class="flex items-center gap-2">
                <label for="kurikulumPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan Data:</label>
                <select
                    id="kurikulumPerPage"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                    onchange="changeKurikulumPerPage(this.value)"
                >
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua</option>
                </select>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.changeKurikulumPerPage = async function(value) {
    const tableWrapper = document.getElementById('kurikulumTableWrapper');
    if (!tableWrapper) return;

    const url = new URL(window.location.href);

    const filterTahun = url.searchParams.get('filter_tahun_kurikulum');

    if (value === '10') {
        url.searchParams.delete('per_page');
    } else {
        url.searchParams.set('per_page', value);
    }

    if (filterTahun) {
        url.searchParams.set('filter_tahun_kurikulum', filterTahun);
    }

    url.searchParams.delete('kurikulum_page');
    url.searchParams.set('_partial', 'kurikulum');

    try {
        tableWrapper.classList.add('opacity-60', 'pointer-events-none');

        const response = await fetch(url.toString(), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
            }
        });

        if (!response.ok) throw new Error('Gagal memuat data kurikulum.');

        const html = await response.text();
        tableWrapper.outerHTML = html;

        const historyUrl = new URL(url.toString());
        historyUrl.searchParams.delete('_partial');
        window.history.pushState({}, '', historyUrl.toString());

    } catch (error) {
        console.error('Error pagination kurikulum:', error);

        const currentWrapper = document.getElementById('kurikulumTableWrapper');
        if (currentWrapper) {
            currentWrapper.classList.remove('opacity-60', 'pointer-events-none');
        }

        if (window.toast?.error) {
            window.toast.error(error.message || 'Gagal memuat data kurikulum.');
        }
    }
};
</script>
@endpush