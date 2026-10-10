@props([
    'dosenFakultas' => [],
    'dosenProdi'    => [],
    'prodi'         => [],
])

@php
    $totalAll = ($dosenFakultas ?? collect())->count() + ($dosenProdi ?? collect())->count();
    $baseOptions = [5, 10, 25, 50, 100];
    $perPageOptions = [];
    foreach ($baseOptions as $opt) {
        if ($opt < $totalAll) $perPageOptions[] = $opt;
    }
    if ($totalAll > 0) $perPageOptions[] = $totalAll;
    $defaultPerPage = $totalAll > 10 ? 10 : ($totalAll > 0 ? $totalAll : 10);
@endphp

<div>
    {{-- HEADER --}}
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Data Dosen</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Data dosen Fakultas & Prodi</p>
        </div>
        <div class="flex items-center gap-2">
            <select id="filterProdiDosen"
                class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                onchange="filterDosenByProdi(this.value)">
                <option value="fakultas">Data Fakultas</option>
                <option value="all">Semua Prodi</option>
                @foreach($prodi as $p)
                    <option value="prodi-{{ $p->id }}">{{ $p->sub_unit ?? $p->name }}</option>
                @endforeach
            </select>

            <button type="button" onclick="openModalDosen()"
                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white transition-all duration-200 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah
            </button>
        </div>
    </div>

    {{-- TOOLBAR --}}
    <div class="mb-3 flex flex-col items-center justify-between gap-3 rounded-lg border border-gray-200 bg-white px-4 py-2.5 dark:border-gray-700 dark:bg-gray-800 sm:flex-row">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Menampilkan: <span id="dosenDataInfoLabel" class="font-semibold text-gray-800 dark:text-gray-200">Data Fakultas</span>
            &middot; Total: <span id="dosenTotalDisplay" class="font-semibold text-gray-800 dark:text-gray-200">0</span> data
        </div>
        <div class="flex items-center gap-2">
            <label for="dosenPerPage" class="text-sm text-gray-500 dark:text-gray-400">Tampilkan:</label>
            <select id="dosenPerPage"
                class="rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                @if($totalAll > 0)
                    @foreach($perPageOptions as $option)
                        @php
                            $isAll = $option === $totalAll;
                            $isSelected = $option === $defaultPerPage;
                        @endphp
                        <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }}>
                            @if($isAll && $totalAll > 100) Semua ({{ $totalAll }})
                            @elseif($isAll) Semua
                            @else {{ $option }}
                            @endif
                        </option>
                    @endforeach
                @else
                    <option value="10">10</option>
                @endif
            </select>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div id="dosenTableScroll" class="overflow-auto" style="max-height: 600px;">
            <table id="sdmdosenTableContainer" class="w-max min-w-[1800px] border-collapse text-sm">
                <thead>
                    <tr>
                        <th rowspan="2" class="sticky top-0 z-30 w-12 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">No</th>
                        <th rowspan="2" class="sticky top-0 z-30 min-w-[220px] whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Prodi</th>
                        <th rowspan="2" class="sticky top-0 z-30 min-w-[220px] whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Nama</th>
                        <th colspan="5" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Pendidikan</th>
                        <th colspan="2" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Sertifikasi & Jabatan</th>
                        <th colspan="2" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Posisi/Jabatan</th>
                        <th colspan="4" class="sticky top-0 z-30 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Status & Identitas</th>
                        <th rowspan="2" class="sticky top-0 z-30 w-32 whitespace-nowrap border border-gray-400 bg-gray-100 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400">Aksi</th>
                    </tr>
                    <tr>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Latar Pendidikan</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 100px;">Doktor</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 110px;">Magister</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 100px;">Sarjana</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Instansi Asal</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 130px;">Sertifikasi</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Jabatan Akademik</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">Posisi/Jabatan</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 120px;">Tgl Mulai</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 180px;">SK Dosen Tetap</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 120px;">Status</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 140px;">NIDN</th>
                        <th class="sticky z-30 whitespace-nowrap border border-gray-400 bg-gray-50 px-4 py-2 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:bg-gray-900 dark:text-gray-400" style="top: 37px; min-width: 140px;">NUPTK</th>
                    </tr>
                </thead>
                <tbody id="dosenTableBody" class="bg-white dark:bg-gray-900">

                    {{-- ============ DATA FAKULTAS ============ --}}
                    @forelse($dosenFakultas ?? [] as $item)
                        <tr class="dosen-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                            data-source="fakultas"
                            data-user-id="{{ $item->users_id }}"
                            data-id="{{ $item->id }}">
                            <td class="no border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"></td>
                            <td class="border border-gray-400 px-4 py-2 text-sm font-medium">
                                <span class="inline-flex items-center whitespace-nowrap rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/20 dark:text-blue-300">Fakultas</span>
                            </td>
                            <td class="nama min-w-[220px] border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-200 dark:bg-gray-700">
                                        <svg class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                    <span class="whitespace-nowrap">{{ $item->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="latar-pendidikan min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->latar_pendidikan ?? '-' }}</td>
                            <td class="doktor min-w-[100px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->doktor ?? '-' }}</td>
                            <td class="magister min-w-[110px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->magister ?? '-' }}</td>
                            <td class="sarjana min-w-[100px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->sarjana ?? '-' }}</td>
                            <td class="instansi-asal min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->nama_instansi_asal ?? '-' }}</td>
                            <td class="sertifikasi min-w-[130px] border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                @php $isYa = ($item->sertifikasi ?? 'Tidak') === 'Ya'; @endphp
                                <span class="inline-flex items-center whitespace-nowrap rounded-full px-2.5 py-0.5 text-xs font-medium {{ $isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                    {{ $item->sertifikasi ?? 'Tidak' }}
                                </span>
                            </td>
                            <td class="jabatan-akademik min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->jabatan_akademik ?? '-' }}</td>
                            <td class="posisi-jabatan min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->posisi_jabatan ?? '-' }}</td>
                            <td class="tgl-mulai min-w-[120px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ $item->terhitung_mulai_tanggal ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="sk-dosen min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->sk_dosen_tetap ?? '-' }}</td>
                            <td class="status min-w-[120px] border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                @php $isAktif = ($item->status ?? 'Aktif') === 'Aktif'; @endphp
                                <span class="inline-flex items-center whitespace-nowrap rounded-full px-2.5 py-0.5 text-xs font-medium {{ $isAktif ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-800/50 dark:text-gray-400' }}">
                                    {{ $item->status ?? 'Aktif' }}
                                </span>
                            </td>
                            <td class="nidn min-w-[140px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->nidn ?? '-' }}</td>
                            <td class="nuptk min-w-[140px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->nuptk ?? '-' }}</td>
                            <td class="border border-gray-400 px-4 py-2 text-center align-top">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" class="btn-edit-dosen inline-flex items-center gap-1 rounded-lg border border-yellow-200/50 bg-yellow-50 px-2.5 py-1.5 text-xs font-medium text-yellow-700 transition-all duration-200 hover:bg-yellow-100 dark:border-yellow-800/30 dark:bg-yellow-900/20 dark:text-yellow-300 dark:hover:bg-yellow-900/40" title="Edit" data-id="{{ $item->id }}">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button type="button" class="btn-delete-dosen inline-flex items-center gap-1 rounded-lg border border-red-200/50 bg-red-50 px-2.5 py-1.5 text-xs font-medium text-red-700 transition-all duration-200 hover:bg-red-100 dark:border-red-800/30 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/40" title="Hapus" data-id="{{ $item->id }}">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="dosen-empty fakultas-empty">
                            <td colspan="17" class="border border-gray-400 px-4 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Dosen Fakultas</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                    {{-- ============ DATA PRODI ============ --}}
                    @forelse($dosenProdi ?? [] as $item)
                        <tr class="dosen-row transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50"
                            data-source="prodi"
                            data-user-id="{{ $item->users_id }}"
                            data-id="{{ $item->id }}">
                            <td class="no border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300"></td>
                            <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ optional($item->user)->sub_unit ?? '-' }}
                            </td>
                            <td class="nama min-w-[220px] border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 flex-shrink-0 rounded-full bg-gray-200 dark:bg-gray-700">
                                        <svg class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                    <span class="whitespace-nowrap">{{ $item->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="latar-pendidikan min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->latar_pendidikan ?? '-' }}</td>
                            <td class="doktor min-w-[100px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->doktor ?? '-' }}</td>
                            <td class="magister min-w-[110px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->magister ?? '-' }}</td>
                            <td class="sarjana min-w-[100px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->sarjana ?? '-' }}</td>
                            <td class="instansi-asal min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->nama_instansi_asal ?? '-' }}</td>
                            <td class="sertifikasi min-w-[130px] border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                @php $isYa = ($item->sertifikasi ?? 'Tidak') === 'Ya'; @endphp
                                <span class="inline-flex items-center whitespace-nowrap rounded-full px-2.5 py-0.5 text-xs font-medium {{ $isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                    {{ $item->sertifikasi ?? 'Tidak' }}
                                </span>
                            </td>
                            <td class="jabatan-akademik min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->jabatan_akademik ?? '-' }}</td>
                            <td class="posisi-jabatan min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->posisi_jabatan ?? '-' }}</td>
                            <td class="tgl-mulai min-w-[120px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ $item->terhitung_mulai_tanggal ? \Carbon\Carbon::parse($item->terhitung_mulai_tanggal)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="sk-dosen min-w-[180px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->sk_dosen_tetap ?? '-' }}</td>
                            <td class="status min-w-[120px] border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                @php $isAktif = ($item->status ?? 'Aktif') === 'Aktif'; @endphp
                                <span class="inline-flex items-center whitespace-nowrap rounded-full px-2.5 py-0.5 text-xs font-medium {{ $isAktif ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-800/50 dark:text-gray-400' }}">
                                    {{ $item->status ?? 'Aktif' }}
                                </span>
                            </td>
                            <td class="nidn min-w-[140px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->nidn ?? '-' }}</td>
                            <td class="nuptk min-w-[140px] whitespace-nowrap border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $item->nuptk ?? '-' }}</td>
                            <td class="border border-gray-400 px-4 py-2 text-center align-top">
                                <span class="inline-flex items-center whitespace-nowrap rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">Read-only</span>
                            </td>
                        </tr>
                    @empty
                        <tr class="dosen-empty prodi-empty" style="display:none;">
                            <td colspan="17" class="border border-gray-400 px-4 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Dosen Prodi</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="dosenPaginationContainer" class="mt-4"></div>
</div>

@push('scripts')
<script>
window.dosenPaginationState = {
    currentPage: 1,
    perPage: {{ $defaultPerPage }},
    filter: 'fakultas',
    totalData: 0
};

window.filterDosenByProdi = function(value) {
    window.dosenPaginationState.filter = value;
    window.dosenPaginationState.currentPage = 1;
    renderDosenPagination();
};

function getVisibleDosenRows() {
    const s = window.dosenPaginationState;
    const all = Array.from(document.querySelectorAll('.dosen-row'));
    if (s.filter === 'fakultas') return all.filter(r => r.dataset.source === 'fakultas');
    if (s.filter === 'all')      return all.filter(r => r.dataset.source === 'prodi');
    if (s.filter.startsWith('prodi-')) {
        const pid = String(s.filter.replace('prodi-', '')).trim();
        return all.filter(r => r.dataset.source === 'prodi' && String(r.dataset.userId).trim() === pid);
    }
    return [];
}

window.renderDosenPagination = function() {
    const s = window.dosenPaginationState;
    const allRows = Array.from(document.querySelectorAll('.dosen-row'));
    allRows.forEach(r => r.style.display = 'none');

    const visible = getVisibleDosenRows();
    s.totalData = visible.length;

    // Label info
    const infoLabel = document.getElementById('dosenDataInfoLabel');
    const totalDisplay = document.getElementById('dosenTotalDisplay');
    if (totalDisplay) totalDisplay.textContent = s.totalData;
    if (s.filter === 'fakultas') infoLabel.textContent = 'Data Fakultas';
    else if (s.filter === 'all') infoLabel.textContent = 'Semua Prodi';
    else if (s.filter.startsWith('prodi-')) {
        const opt = document.querySelector(`#filterProdiDosen option[value="${s.filter}"]`);
        infoLabel.textContent = opt ? opt.textContent : 'Prodi';
    }

    const totalPages = Math.ceil(s.totalData / s.perPage) || 1;
    if (s.currentPage > totalPages) s.currentPage = totalPages;
    if (s.currentPage < 1) s.currentPage = 1;

    const startIndex = (s.currentPage - 1) * s.perPage;
    const endIndex   = Math.min(startIndex + s.perPage, s.totalData);

    visible.forEach((row, idx) => {
        if (idx >= startIndex && idx < endIndex) {
            row.style.display = '';
            const td = row.querySelector('td.no');
            if (td) td.textContent = idx + 1;
        }
    });

    // Empty state
    const fakEmpty = document.querySelector('.dosen-empty.fakultas-empty');
    const prodiEmpty = document.querySelector('.dosen-empty.prodi-empty');
    if (fakEmpty) fakEmpty.style.display = (s.filter === 'fakultas' && s.totalData === 0) ? '' : 'none';
    if (prodiEmpty) prodiEmpty.style.display = (s.filter !== 'fakultas' && s.totalData === 0) ? '' : 'none';

    renderDosenControls(s.currentPage, totalPages, s.totalData, startIndex, endIndex);
};

function renderDosenControls(currentPage, totalPages, totalData, from, to) {
    const container = document.getElementById('dosenPaginationContainer');
    if (!container) return;
    if (totalData === 0) { container.innerHTML = ''; return; }

    const fromDisplay = from + 1;
    let html = `
        <div class="flex flex-col items-center justify-between gap-3 rounded-lg border border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800 sm:flex-row">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan <span class="font-semibold text-gray-700 dark:text-gray-300">${fromDisplay}</span>
                sampai <span class="font-semibold text-gray-700 dark:text-gray-300">${to}</span>
                dari <span class="font-semibold text-gray-700 dark:text-gray-300">${totalData}</span> data
            </div>`;

    if (totalPages > 1) {
        html += `<nav class="flex items-center gap-1">`;
        html += `<button type="button" onclick="goToDosenPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-sm font-medium transition-colors
                ${currentPage <= 1 ? 'cursor-not-allowed text-gray-300 dark:text-gray-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200'}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>`;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        if (endPage - startPage + 1 < maxVisiblePages) startPage = Math.max(1, endPage - maxVisiblePages + 1);

        if (startPage > 1) {
            html += createDosenPageButton(1, currentPage);
            if (startPage > 2) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
        }
        for (let i = startPage; i <= endPage; i++) html += createDosenPageButton(i, currentPage);
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span class="px-2 text-gray-400 dark:text-gray-500">...</span>`;
            html += createDosenPageButton(totalPages, currentPage);
        }

        html += `<button type="button" onclick="goToDosenPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}
            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-sm font-medium transition-colors
                ${currentPage >= totalPages ? 'cursor-not-allowed text-gray-300 dark:text-gray-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200'}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button></nav>`;
    }
    html += `</div>`;
    container.innerHTML = html;
}

function createDosenPageButton(page, currentPage) {
    const isActive = page === currentPage;
    return `<button type="button" onclick="goToDosenPage(${page})"
        class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-sm font-medium transition-colors
            ${isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200'}">
        ${page}
    </button>`;
}

window.goToDosenPage = function(page) {
    const s = window.dosenPaginationState;
    const totalPages = Math.ceil(s.totalData / s.perPage) || 1;
    if (page < 1 || page > totalPages || page === s.currentPage) return;
    s.currentPage = page;
    renderDosenPagination();
    document.getElementById('sdmdosenTableContainer')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

document.addEventListener('DOMContentLoaded', function() {
    const sel = document.getElementById('dosenPerPage');
    if (sel) sel.addEventListener('change', function() {
        window.dosenPaginationState.perPage = parseInt(this.value);
        window.dosenPaginationState.currentPage = 1;
        renderDosenPagination();
    });
    window.dosenPaginationState.filter = 'fakultas';
    renderDosenPagination();
});

// ============================================================
//  HANDLE PRINT SDM DOSEN FAKULTAS (filter-aware)
// ============================================================
window.handlePrintSdmDosenFakultas = function(event) {
    if (event) event.preventDefault();

    const state = window.dosenPaginationState || {};
    const filterSource = state.filter || 'fakultas';

    const baseUrl = '{{ route("fakultas.profile-sdm.dosen.print") }}';
    const params = new URLSearchParams();
    if (filterSource) params.append('filter_source', filterSource);

    const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
    window.open(url, '_blank');
    return false;
};
</script>
@endpush