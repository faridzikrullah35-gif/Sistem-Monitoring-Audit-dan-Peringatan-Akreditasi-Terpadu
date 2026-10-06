<div class="overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-50 dark:bg-gray-800">
                <th class="border-b border-gray-200 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                    NO
                </th>
                <th class="border-b border-gray-200 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                    NO DOKUMEN
                </th>
                <th class="border-b border-gray-200 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                    TANGGAL TERBIT
                </th>
                <th class="border-b border-gray-200 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                    NO REVISI
                </th>
                <th class="border-b border-gray-200 px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                    AKSI
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($settingHeaderCetak as $index => $setting)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-700 dark:border-gray-700 dark:text-gray-300">
                        {{ $loop->iteration }}
                    </td>
                    <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-700 dark:border-gray-700 dark:text-gray-300">
                        {{ $setting->no_dokumen }}
                    </td>
                    <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-700 dark:border-gray-700 dark:text-gray-300">
                        {{ $setting->tanggal_terbit->format('d-m-Y') }}
                    </td>
                    <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-700 dark:border-gray-700 dark:text-gray-300">
                        {{ $setting->no_revisi }}
                    </td>
                    <td class="border-b border-gray-200 px-4 py-3 text-center dark:border-gray-700">
                        <!-- EDIT -->
                        <button
                            type="button"
                            onclick="openModalSetting('{{ $setting->id }}', {
                                no_dokumen: '{{ $setting->no_dokumen }}',
                                tanggal_terbit: '{{ $setting->tanggal_terbit->format('Y-m-d') }}',
                                no_revisi: '{{ $setting->no_revisi }}'
                            })"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200"
                        >
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536M4 20h4l10.5-10.5a2.121 2.121 0 00-3-3L5 17v3z"
                                />
                            </svg>
                            Edit
                        </button>
                        <!-- DELETE -->
                        <button
                            type="button"
                            onclick="deleteSetting({{ $setting->id }})"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                />
                            </svg>
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center">
                            <svg class="h-12 w-12 text-gray-300 dark:text-gray-600 mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <p>Belum ada data setting header cetak.</p>
                            <p class="text-xs">Klik tombol "Tambah Setting" untuk menambahkan.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginasi --}}
    <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Menampilkan
            {{ $settingHeaderCetak->firstItem() ?? 0 }}
            -
            {{ $settingHeaderCetak->lastItem() ?? 0 }}
            dari
            {{ $settingHeaderCetak->total() }} data
        </div>
        <div class="pagination-wrapper">
            {{ $settingHeaderCetak->links('pagination::tailwind') }}
        </div>
    </div>
</div>