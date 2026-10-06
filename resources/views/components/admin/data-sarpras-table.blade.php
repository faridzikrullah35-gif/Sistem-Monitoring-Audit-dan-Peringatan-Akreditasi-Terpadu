@props(['sarpras' => []])

{{-- Tabel --}}
<div
    id="sarprasTableContainer"
    class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden"
>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

            {{-- ==================== HEADER ==================== --}}
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-12">
                        No
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[150px]">
                        Kode
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 min-w-[200px]">
                        Nama Sarana Prasarana
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">
                        Status
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-24">
                        Jumlah
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">
                        Dibuat Oleh
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 whitespace-nowrap w-32">
                        Aksi
                    </th>
                </tr>
            </thead>

            {{-- ==================== BODY ==================== --}}
            <tbody id="sarprasTableBody" class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                @forelse($sarpras as $index => $item)
                <tr
                    class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition align-top"
                    data-id="{{ $item->id }}"
                >
                    {{-- No --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 dark:text-white text-center align-top">
                        {{ $index + 1 }}
                    </td>

                    {{-- KODE --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                        <span class="font-medium text-gray-900 dark:text-white">
                            {{ $item->kode }}
                        </span>
                    </td>

                    {{-- NAMA SARPRAS --}}
                    <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                        {{ $item->nama_sarpras }}
                    </td>

                    {{-- STATUS --}}
                    <td class="whitespace-nowrap px-4 py-4 align-top">
                        @php
                            $statusColors = [
                                'baik' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                'rusak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                'perbaikan' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                            ];
                            $statusColor = $statusColors[strtolower($item->status)] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400';
                        @endphp
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusColor }}">
                            {{ $item->status }}
                        </span>
                    </td>

                    {{-- JUMLAH --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 text-center align-top">
                        {{ $item->jumlah }}
                    </td>

                    {{-- DIBUAT OLEH --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-700 dark:text-gray-300 align-top">
                        {{ $item->user->name ?? '-' }}
                    </td>

                    {{-- AKSI --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                        <div class="flex items-center gap-1">
                            {{-- Edit --}}
                            <button
                                onclick="openModalFormSarpras('edit', {{ $item->id }})"
                                class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                                title="Edit Data"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                    />
                                </svg>
                                Edit
                            </button>

                            {{-- Hapus --}}
                            <button
                                type="button"
                                onclick="deleteSarpras({{ $item->id }})"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center justify-center text-center">
                            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                <svg
                                    class="h-8 w-8 text-gray-400 dark:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                                    />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Belum Ada Data SARPRAS
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Klik tombol "Tambah SARPRAS" untuk membuat data baru.
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>