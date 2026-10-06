@props(['akses'])

<div id="tableFakultasContainer" class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">User</th>
                <th scope="col" class="px-6 py-3">Fakultas</th>
                <th scope="col" class="px-6 py-3">Sub Unit</th>
                <th scope="col" class="px-6 py-3">Level Akses</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Keterangan</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @forelse($akses as $key => $item)
                <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" data-id="{{ $item->id }}">
                    {{-- No --}}
                    <td class="px-6 py-4">
                        {{ $akses->firstItem() + $key }}
                    </td>

                    {{-- User --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-sm font-medium text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                                {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">
                                    {{ $item->user->name ?? 'User tidak ditemukan' }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $item->user->email ?? '' }}
                                </p>
                            </div>
                        </div>
                    </td>

                    {{-- Fakultas --}}
                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-800 dark:text-gray-200">
                            {{ $item->fakultas }}
                        </span>
                    </td>

                    {{-- Sub Unit - FIX: handle array dengan benar --}}
                    <td class="px-6 py-4">
                        @php
                            // Normalisasi data sub_unit
                            $subUnits = [];
                            if (is_null($item->sub_unit)) {
                                $subUnits = [];
                            } elseif (is_array($item->sub_unit)) {
                                $subUnits = $item->sub_unit;
                            } elseif (is_string($item->sub_unit)) {
                                // Coba parse JSON
                                $decoded = json_decode($item->sub_unit, true);
                                if (is_array($decoded)) {
                                    $subUnits = $decoded;
                                } else {
                                    $subUnits = [$item->sub_unit];
                                }
                            }
                        @endphp

                        @if(empty($subUnits))
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700 dark:bg-green-900 dark:text-green-300">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Semua Sub Unit
                            </span>
                        @elseif(count($subUnits) === 1)
                            <span class="text-gray-700 dark:text-gray-300">
                                {{ $subUnits[0] }}
                            </span>
                        @else
                            <div class="flex flex-wrap gap-1">
                                @foreach($subUnits as $subUnit)
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-300">
                                        {{ $subUnit }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </td>

                    {{-- Level Akses --}}
                    <td class="px-6 py-4">
                        @php
                            $levelColors = [
                                'read' => 'blue',
                                'write' => 'yellow',
                            ];
                            $levelLabels = [
                                'read' => 'Baca/Melihat',
                                'write' => 'Tulis',
                            ];
                            $color = $levelColors[$item->level_akses] ?? 'gray';
                            $label = $levelLabels[$item->level_akses] ?? $item->level_akses;
                        @endphp
                        <span class="inline-flex rounded-full bg-{{ $color }}-100 px-3 py-1 text-xs font-medium text-{{ $color }}-700 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-300">
                            {{ $label }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium
                            {{ $item->is_active 
                                ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' 
                                : 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>

                    {{-- Keterangan --}}
                    <td class="px-6 py-4">
                        <span class="text-gray-700 dark:text-gray-300">
                            {{ $item->keterangan ?? '-' }}
                        </span>
                    </td>

                    {{-- ==================== AKSI ==================== --}}
                    <td class="whitespace-nowrap px-4 py-4 text-sm align-top">
                        <div class="flex items-center gap-1">

                            {{-- Edit --}}
                            <button
                                type="button"
                                onclick="openEditModal(
                                    '{{ $item->id }}',
                                    '{{ $item->user_id }}',
                                    '{{ addslashes($item->fakultas) }}',
                                    '{{ addslashes(json_encode($subUnits)) }}',
                                    '{{ $item->level_akses }}',
                                    '{{ $item->is_active }}',
                                    '{{ addslashes($item->keterangan) }}'
                                )"
                                class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition-all duration-200 hover:bg-amber-100 hover:shadow-sm dark:bg-amber-950/30 dark:text-amber-400 dark:hover:bg-amber-900/40"
                                title="Edit Data"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Edit
                            </button>

                            {{-- Hapus --}}
                            <button
                                type="button"
                                onclick="deleteHakAkses(
                                    '{{ $item->id }}',
                                    '{{ addslashes($item->fakultas) }}',
                                    '{{ route('admin.setting-hak-akses-fakultas.destroy', ['id' => $item->id]) }}'
                                )"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition-all hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20"
                                title="Hapus Data"
                            >
                                <svg
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
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
                    <td colspan="8" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center gap-4">
                            <svg class="h-16 w-16 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div class="text-center">
                                <p class="text-base font-medium text-gray-700 dark:text-gray-300">
                                    Belum Ada Data Setting Hak Akses Fakultas
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Silahkan tambahkan data baru melalui tombol "Tambah Akses"
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="border-t border-gray-200 px-6 py-3 dark:border-gray-700">
        <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan
                {{ $akses->firstItem() ?? 0 }}
                -
                {{ $akses->lastItem() ?? 0 }}
                dari
                {{ $akses->total() }} data
            </div>
            @if($akses->hasPages())
                <div class="pagination-wrapper">
                    {{ $akses->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
</div>