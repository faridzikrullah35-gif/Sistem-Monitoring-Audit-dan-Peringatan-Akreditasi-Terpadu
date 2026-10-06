@props(['pengajarans'])

<div
    id="pengajaranTableWrapper"
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden"
>
    {{-- HEADER --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-700">
        <div>
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Daftar Pengajaran</h3>
        </div>
        <button
            type="button"
            onclick="openModalPengajaran('create')"
            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-offset-gray-800"
        >
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
            </svg>
            Tambah Data Pengajaran
        </button>
    </div>

    {{-- TABEL --}}
    <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
        <table id="pengajaranTableContainer" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Tahun Akademik</th>
                    <th scope="col" class="px-6 py-3">Semester</th>
                    <th scope="col" class="px-6 py-3">SK Pengajaran</th>
                    <th scope="col" class="px-6 py-3">Tanggal Penetapan</th>
                    <th scope="col" class="px-6 py-3">Keterangan</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="pengajaranTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($pengajarans as $index => $pengajaran)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors pengajaran-row"
                        data-tahun="{{ $pengajaran->tahun_akademik }}"
                        data-semester="{{ $pengajaran->semester }}"
                        data-id="{{ $pengajaran->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($pengajarans instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $pengajarans->firstItem() + $index }}
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $pengajaran->tahun_akademik }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($pengajaran->semester)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $pengajaran->semester === 'Ganjil'
                                        ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300'
                                        : 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' }}">
                                    {{ $pengajaran->semester }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($pengajaran->sk_pengajaran)
                                <a href="{{ Storage::url($pengajaran->sk_pengajaran) }}" target="_blank"
                                   class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Lihat SK
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($pengajaran->tgl_penetapan)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    {{ \Carbon\Carbon::parse($pengajaran->tgl_penetapan)->format('d M Y') }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($pengajaran->keterangan)
                                {{ $pengajaran->keterangan }}
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" onclick="editPengajaran({{ $pengajaran->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" onclick="deletePengajaran({{ $pengajaran->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyStateRow">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada data Pengajaran</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Klik tombol "Tambah Data Pengajaran" untuk menambahkan data</p>
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
            @if ($pengajarans instanceof \Illuminate\Pagination\LengthAwarePaginator)
                @if ($pengajarans->total() > 0)
                    Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">{{ $pengajarans->firstItem() }}</span> - <span class="font-medium text-gray-700 dark:text-gray-200">{{ $pengajarans->lastItem() }}</span> dari <span class="font-medium text-gray-700 dark:text-gray-200">{{ $pengajarans->total() }}</span> data
                @else
                    Tidak ada data
                @endif
            @else
                @if ($pengajarans->count() > 0)
                    Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200">1</span> - <span class="font-medium text-gray-700 dark:text-gray-200">{{ $pengajarans->count() }}</span> dari <span class="font-medium text-gray-700 dark:text-gray-200">{{ $pengajarans->count() }}</span> data
                @else
                    Tidak ada data
                @endif
            @endif
            </div>
            <div class="flex items-center gap-2">
                <label for="pengajaranPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan Data:</label>
                <select id="pengajaranPerPage"
                        class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                        onchange="changePengajaranPerPage(this.value)">
                    <option value="10" {{ request('per_page_pengajaran', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page_pengajaran') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page_pengajaran') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page_pengajaran') == 100 ? 'selected' : '' }}>100</option>
                    <option value="all" {{ request('per_page_pengajaran') == 'all' ? 'selected' : '' }}>Semua</option>
                </select>
            </div>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
(function () {
    'use strict';

    /**
     * Bangun URL dengan marker _partial=pengajaran + extra params,
     * supaya controller tahu harus return partial pengajaran.
     */
    function buildUrl(extraParams = {}) {
        const url = new URL(window.location.href);

        // marker wajib
        url.searchParams.set('_partial', 'pengajaran');

        // Hapus parameter pagination Kurikulum
        url.searchParams.delete('per_page');
        url.searchParams.delete('kurikulum_page');

        // hapus page lama biar balik ke halaman 1
        url.searchParams.delete('pengajaran_page');

        Object.entries(extraParams).forEach(([k, v]) => {
            url.searchParams.set(k, v);
        });

        return url;
    }

    async function fetchAndReplaceTable(url) {
        const wrapper = document.getElementById('pengajaranTableWrapper');
        if (!wrapper) return;

        try {
            wrapper.classList.add('opacity-60', 'pointer-events-none');

            const res = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            });

            if (!res.ok) throw new Error('Gagal memuat data pengajaran.');

            const html = await res.text();
            wrapper.outerHTML = html;

            const cleanUrl = new URL(url.toString());

            cleanUrl.searchParams.delete('_partial');

            window.history.pushState({}, '', cleanUrl.toString());
        } catch (err) {
            console.error(err);
            const current = document.getElementById('pengajaranTableWrapper');
            current?.classList.remove('opacity-60', 'pointer-events-none');
            if (window.toast?.error) window.toast.error(err.message);
        }
    }

    window.changePengajaranPerPage = function (value) {
        fetchAndReplaceTable(buildUrl({ per_page_pengajaran: value }));
    };

    window.reloadPengajaranTable = function () {
        // Ambil per_page yang sedang aktif biar konsisten
        const sel = document.getElementById('pengajaranPerPage');
        const perPage = sel ? sel.value : (new URL(window.location.href)).searchParams.get('per_page_pengajaran') || '10';

        fetchAndReplaceTable(buildUrl({ per_page_pengajaran: perPage }));
    };
})();
</script>
@endpush
@endonce