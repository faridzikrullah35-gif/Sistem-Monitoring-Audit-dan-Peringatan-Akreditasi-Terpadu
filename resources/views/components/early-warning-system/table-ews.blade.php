<div class="overflow-x-auto">
    <div class="mb-4 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Daftar Akreditasi</h3>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <button id="btn-create-ews"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Data
            </button>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table id="ewsTableContainer" class="w-full text-sm text-left text-gray-700 dark:text-white">
            <thead class="bg-gray-50 text-xs uppercase text-gray-800 dark:bg-gray-700 dark:text-white">
                <tr>
                    <th class="px-4 py-3 whitespace-nowrap">#</th>
                    <th class="px-4 py-3 whitespace-nowrap">Jenjang</th>
                    <th class="px-4 py-3 whitespace-nowrap">Unit</th>
                    <th class="px-4 py-3 whitespace-nowrap">Sub Unit</th>
                    <th class="px-4 py-3 whitespace-nowrap">SK Akreditasi</th>
                    <th class="px-4 py-3 whitespace-nowrap">Tahun SK</th>
                    <th class="px-4 py-3 whitespace-nowrap">Peringkat</th>
                    <th class="px-4 py-3 whitespace-nowrap">Tgl. Kadaluarsa</th>
                    <th class="px-4 py-3 whitespace-nowrap">Status Kadaluarsa</th>
                    <th class="px-4 py-3 whitespace-nowrap">Sisa Kadaluarsa</th>
                    <th class="px-4 py-3 whitespace-nowrap">Akreditasi Nasional</th>
                    <th class="px-4 py-3 whitespace-nowrap">Akreditasi Internasional</th>
                    <th class="px-4 py-3 whitespace-nowrap">Keterangan</th>
                    <th class="px-4 py-3 whitespace-nowrap">Upcoming TS-3</th>
                    <th class="px-4 py-3 whitespace-nowrap">Upcoming TS-2</th>
                    <th class="px-4 py-3 whitespace-nowrap">Upcoming TS-1</th>
                    <th class="px-4 py-3 whitespace-nowrap">Upcoming TS</th>
                    <th class="px-4 py-3 whitespace-nowrap">Tanggal Pendampingan</th>
                    <th class="px-4 py-3 whitespace-nowrap">LED</th>
                    <th class="px-4 py-3 whitespace-nowrap">LKPT</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($akreditasis as $akreditasi)
                    @php
                        $status = $akreditasi->status_daluwarsa;
                        $sisa = $akreditasi->sisa_kadaluarsa;
                    @endphp
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->program }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                            {{ $akreditasi->unit }}
                        </td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                            {{ $akreditasi->sub_unit }}
                        </td>
                        <td class="px-4 py-3">{{ $akreditasi->nomor_sk }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->tanggal_sk ? \Carbon\Carbon::parse($akreditasi->tanggal_sk)->translatedFormat('d F Y') : '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->peringkat_akreditasi }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($akreditasi->tanggal_kadaluarsa)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            @if($status == 'Kadaluarsa')
                                <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">Kadaluarsa</span>
                            @elseif($status == 'Segera')
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Segera</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($sisa < 0)
                                <span class="inline-flex items-center rounded-md bg-red-100 px-3 py-1 text-xs font-semibold text-red-700 dark:bg-red-900/30 dark:text-red-300">
                                    Kadaluarsa
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-md bg-green-100 px-3 py-1 text-xs font-semibold text-green-700 dark:bg-green-900/30 dark:text-green-300">
                                    {{ $akreditasi->sisa_kadaluarsa_format }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $akreditasi->akreditasi_nasional ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->akreditasi_internasional ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->keterangan ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->upcoming_ts3 ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->upcoming_ts2 ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->upcoming_ts1 ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->upcoming_ts ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $akreditasi->tanggal_pendampingan ? \Carbon\Carbon::parse($akreditasi->tanggal_pendampingan)->format('d/m/Y') : '-' }}</td>
                        <td class="px-4 py-3">
                            @if($akreditasi->led)
                                <a href="{{ Storage::url($akreditasi->led) }}" target="_blank" class="text-blue-600 hover:underline">Download PDF</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($akreditasi->lkpt)
                                <a href="{{ Storage::url($akreditasi->lkpt) }}" target="_blank" class="text-blue-600 hover:underline">Download PDF</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <!-- EDIT -->
                                <button
                                    type="button"
                                    class="btn-edit-ews inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors"
                                    data-id="{{ $akreditasi->id }}"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit
                                </button>

                                <!-- DELETE -->
                                <button
                                    type="button"
                                    onclick="deleteAkreditasi({{ $akreditasi->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="21" class="px-6 py-10">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-20 h-20 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21a2.25 2.25 0 002.25-2.25V7.5a2.25 2.25 0 00-.659-1.591l-3-3A2.25 2.25 0 0016.5 2.25H6A2.25 2.25 0 003.75 4.5v14.25A2.25 2.25 0 006 21h13.5z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 2.25V6a1.5 1.5 0 001.5 1.5h3.75"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 11.25h6M9 15h6"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Akreditasi</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Klik tombol <b>Tambah Data</b> untuk menambahkan data akreditasi pertama.
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-700 dark:text-white">
            Menampilkan
            {{ $akreditasis->firstItem() ?? 0 }}
            -
            {{ $akreditasis->lastItem() ?? 0 }}
            dari
            {{ $akreditasis->total() }}
            data
        </div>
        <div class="pagination-wrapper">
            {{ $akreditasis->links('pagination::tailwind') }}
        </div>
    </div>
</div>

<script>
    function deleteAkreditasi(id) {
        if (!confirm('Yakin ingin menghapus data ini?')) return;

        fetch(`/admin/early-warning-system/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil dihapus!');
                location.reload();
            } else {
                alert('Gagal menghapus data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan.');
        });
    }
</script>