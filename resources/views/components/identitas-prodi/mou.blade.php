@props([
    'dokumenMou'
])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Kerjasama MoU / MoA</h4>
        <button type="button" class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800" onclick="openModal('modalMou')">
            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah
        </button>
    </div>

    <!-- data-url wajib biar refreshTable() gak return false diam-diam -->
    <div id="mouTableContainer" class="overflow-x-auto" data-url="{{ route('prodi.identitas-prodi') }}">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Dokumen</th>
                    <th class="px-4 py-3">File</th>
                    <th class="px-4 py-3">Tgl Penetapan</th>
                    <th class="px-4 py-3">Tgl Revisi</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokumenMou ?? [] as $item)
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $item->nama_dokumen }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ Storage::url($item->file) }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400">
                            {{ basename($item->file) }}
                        </a>
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_penetapan)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $item->tanggal_revisi ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y') : '-' }}</td>
                    <td class="px-4 py-2">{{ $item->keterangan ?? '-' }}</td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex items-center justify-center gap-2">

                            <!-- EDIT -->
                            <button
                                type="button"
                                onclick="openEditModal(
                                    'modalMou',
                                    {{ $item->id }},
                                    '{{ $item->nama_dokumen }}',
                                    '{{ $item->tanggal_penetapan }}',
                                    '{{ $item->tanggal_revisi }}',
                                    '{{ $item->keterangan }}'
                                )"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>

                            <!-- DELETE -->
                            <button
                                type="button"
                                onclick="deleteDokumen({{ $item->id }}, '#mouTableContainer')"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>

                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-gray-500">Belum ada data MoU.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal MOU -->
<div id="modalMou" tabindex="-1" class="modal-overlay fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 p-4" data-table-id="#mouTableContainer">
    <div class="relative mx-auto max-w-md top-20">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah MoU</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 text-sm dark:hover:bg-gray-700 dark:hover:text-white" onclick="closeModal('modalMou')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <form action="{{ route('prodi.identitas-prodi.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="kategori" value="MOU">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" required class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Dokumen</label>
                        <input type="file" name="file" required class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        <small class="text-xs text-gray-500">*Wajib untuk tambah, kosongkan jika tidak ingin mengganti file saat edit</small>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penetapan</label>
                        <input type="text" name="tanggal_penetapan" required class="datepicker mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Revisi</label>
                        <input type="text" name="tanggal_revisi" class="datepicker mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan</label>
                        <textarea name="keterangan" rows="2" class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="mr-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700" onclick="closeModal('modalMou')">Batal</button>
                        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>