@props(['strukturs' => []])

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Struktur Organisasi</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola data struktur organisasi LPM UM Banjarmasin.</p>
        </div>
        <button type="button" onclick="openCreateModalStruktur()" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <i class="fas fa-plus mr-2"></i>
            Tambah Anggota
        </button>
    </div>

    {{-- ORGANIZATION CHART --}}
    <div id="strukturChartContainer" class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        {{-- Chart Header --}}
        <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-700">
            <div class="flex items-start gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 0 0-5.356-1.857M17 20H7m10 0v-2a3 3 0 0 0-.356-1.857M7 20H2v-2a3 3 0 0 1 5.356-1.857M7 20v-2a3 3 0 0 1 .356-1.857M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm6 3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM7 10a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800 dark:text-white">Struktur Organisasi</h2>
                </div>
            </div>
        </div>

        {{-- CHART BODY --}}
        <div class="relative overflow-x-auto">
            @php
                $rootStructures = collect($strukturs)
                    ->filter(function ($struktur) {
                        return is_null($struktur->parent_id) && (bool) $struktur->is_active;
                    })
                    ->sortBy('urutan');
            @endphp

            @if($rootStructures->count() > 0)
                <div class="min-w-max bg-gray-50/50 px-10 py-12 dark:bg-gray-900/20">
                    <div class="flex justify-center gap-10">
                        @foreach($rootStructures as $root)
                            <x-admin.struktur.organization-node :struktur="$root" />
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Empty Chart --}}
                <div class="flex min-h-[320px] flex-col items-center justify-center px-6 py-12 text-center">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                        <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 0 0-5.356-1.857M17 20H7m10 0v-2a3 3 0 0 0-.356-1.857M7 20H2v-2a3 3 0 0 1 5.356-1.857M7 20v-2a3 3 0 0 1 .356-1.857m0 0a5.002 5.002 0 0 1 9.288 0M15 7a3 3 0 1 1-6 0 3 3 0 0 1-6 0z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Struktur Organisasi Aktif</h3>
                    <p class="mt-1 max-w-md text-sm text-gray-500 dark:text-gray-400">Tambahkan anggota organisasi dan tentukan hubungan atasannya untuk membangun struktur.</p>
                    <button type="button" onclick="openCreateModalStruktur()" class="mt-5 inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Anggota
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- DATA MANAGEMENT / TABLE --}}
    <div id="strukturTableContainer" class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        {{-- Table Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <div>
                <h2 class="text-base font-bold text-gray-800 dark:text-white">Data Anggota Organisasi</h2>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Kelola nama, jabatan, foto, posisi, dan status anggota.</p>
            </div>
            <div class="rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                {{ count($strukturs) }} Anggota
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="w-12 whitespace-nowrap px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">No</th>
                        <th class="min-w-[150px] px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Foto</th>
                        <th class="min-w-[200px] px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Nama</th>
                        <th class="min-w-[200px] px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Jabatan</th>
                        <th class="min-w-[180px] px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Atasan</th>
                        <th class="w-24 whitespace-nowrap px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Urutan</th>
                        <th class="w-28 whitespace-nowrap px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                        <th class="w-32 whitespace-nowrap px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($strukturs as $index => $struktur)
                        <tr class="align-top transition hover:bg-gray-50 dark:hover:bg-gray-700/50" data-id="{{ $struktur->id }}" data-nama="{{ htmlspecialchars($struktur->nama ?? '', ENT_QUOTES, 'UTF-8') }}" data-jabatan="{{ htmlspecialchars($struktur->jabatan ?? '', ENT_QUOTES, 'UTF-8') }}" data-foto="{{ $struktur->foto ?? '' }}" data-is-active="{{ $struktur->is_active ? '1' : '0' }}" data-urutan="{{ $struktur->urutan ?? 0 }}" data-parent-id="{{ $struktur->parent_id ?? '' }}">
                            {{-- No --}}
                            <td class="whitespace-nowrap px-4 py-4 text-center text-sm text-gray-900 dark:text-white">{{ $index + 1 }}</td>

                            {{-- Foto --}}
                            <td class="px-4 py-4">
                                @if($struktur->foto)
                                    <img src="{{ asset('storage/struktur_organisasi/' . $struktur->foto) }}" alt="{{ $struktur->nama }}" class="h-12 w-12 rounded-full border-2 border-gray-200 object-cover dark:border-gray-600">
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-200 text-gray-400 dark:bg-gray-700">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama --}}
                            <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $struktur->nama }}</td>

                            {{-- Jabatan --}}
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $struktur->jabatan }}</td>

                            {{-- Atasan --}}
                            <td class="px-4 py-4">
                                @if($struktur->parent)
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                                            <i class="fas fa-arrow-up text-[10px]"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $struktur->parent->nama }}</p>
                                            <p class="text-[11px] text-gray-400 dark:text-gray-500">{{ $struktur->parent->jabatan }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-400">
                                        <i class="fas fa-crown text-[10px]"></i>
                                        Posisi Utama
                                    </span>
                                @endif
                            </td>

                            {{-- Urutan --}}
                            <td class="whitespace-nowrap px-4 py-4 text-center text-sm text-gray-700 dark:text-gray-300">{{ $struktur->urutan }}</td>

                            {{-- Status --}}
                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                @if($struktur->is_active)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button type="button" onclick="openEditModalStruktur({{ $struktur->id }})" class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition hover:bg-amber-100 dark:bg-amber-950/30 dark:text-amber-400" title="Edit Data">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
                                    </button>

                                    <button type="button" onclick="deleteStruktur({{ $struktur->id }})" class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400" title="Hapus">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                        <i class="fas fa-users text-2xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Struktur Organisasi</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Klik tombol "Tambah Anggota" untuk menambahkan data baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL --}}
    <x-admin.modal.modal-setting-struktur-organisasi :strukturs="$strukturs" />

</div>