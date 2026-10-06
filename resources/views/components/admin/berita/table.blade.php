@props(['beritas'])

<div>
    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Manajemen Berita</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola berita dan dokumentasi landing page SIMANTAP.</p>
        </div>
        <button type="button" onclick="openModalBerita()" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-blue-700">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Berita
        </button>
    </div>

    {{-- Tabel --}}
    <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table id="beritaTableContainer" class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Preview</th>
                    <th class="px-6 py-3">Nama File</th>
                    <th class="px-6 py-3">Tipe</th>
                    <th class="px-6 py-3">Diupload Oleh</th>
                    <th class="px-6 py-3">Tanggal Upload</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $key => $berita)
                    @php
                        $extension = strtolower(pathinfo($berita->file ?? '', PATHINFO_EXTENSION));
                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                        $isPdf = $extension === 'pdf';
                        $icon = match ($extension) {
                            'pdf' => 'fa-file-pdf',
                            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' => 'fa-image',
                            default => 'fa-file',
                        };
                        $iconColor = match ($extension) {
                            'pdf' => 'text-red-500',
                            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' => 'text-green-500',
                            default => 'text-blue-500',
                        };
                        $thumbnailUrl = !empty($berita->thumbnail) ? asset('storage/' . ltrim($berita->thumbnail, '/')) : null;
                    @endphp

                    <tr class="border-b bg-white transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $key + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex h-14 w-20 items-center justify-center overflow-hidden rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
                                @if($thumbnailUrl && $isImage)
                                    <img src="{{ $thumbnailUrl }}" alt="{{ $berita->nama_file }}" class="h-full w-full object-cover" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="hidden h-full w-full items-center justify-center {{ $iconColor }}"><i class="fas {{ $icon }} text-xl"></i></div>
                                @elseif($thumbnailUrl && $isPdf)
                                    <img src="{{ $thumbnailUrl }}" alt="{{ $berita->nama_file }}" class="h-full w-full object-cover" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="hidden h-full w-full items-center justify-center {{ $iconColor }}"><i class="fas {{ $icon }} text-xl"></i></div>
                                @else
                                    <i class="fas {{ $icon }} {{ $iconColor }} text-xl"></i>
                                @endif
                            </div>
                        </td>
                        <td class="min-w-[260px] px-6 py-4">
                            <div class="max-w-[350px]">
                                <p class="truncate font-medium text-gray-900 dark:text-white" title="{{ $berita->nama_file }}">{{ $berita->nama_file }}</p>
                                <p class="mt-1 truncate text-xs text-gray-500 dark:text-gray-400">{{ basename($berita->file ?? '-') }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                <i class="fas {{ $icon }} {{ $iconColor }}"></i>
                                {{ strtoupper($extension ?: 'FILE') }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-gray-900 dark:text-white">{{ $berita->diupload_oleh ?? '-' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-gray-900 dark:text-white">{{ $berita->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="flex items-center justify-center gap-1">
                                {{-- Download --}}
                                @if($berita->files->count() > 0)
                                    <a
                                        href="{{ route('setting-landing-page.download', $berita->files->first()->id) }}"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-600 transition hover:bg-blue-100 hover:text-blue-700 dark:bg-blue-500/10 dark:text-blue-400"
                                        title="Download File"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 3v12m0 0l4-4m-4 4l-4-4m-5 9h18"
                                            />
                                        </svg>
                                        Download
                                    </a>
                                @endif

                                {{-- Edit --}}
                                <button
                                    type="button"
                                    onclick="editBerita({{ $berita->id }})"
                                    class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition hover:bg-amber-100 dark:bg-amber-950/30 dark:text-amber-400"
                                    title="Edit"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                    onclick="deleteBerita({{ $berita->id }})"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-100 hover:text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400"
                                    title="Hapus"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 01-1 1v3M4 7h16"
                                        />
                                    </svg>
                                    Hapus
                                </button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                                    <i class="far fa-newspaper text-2xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada berita yang diupload.</p>
                                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Klik tombol "Tambah Berita" untuk menambahkan berita baru.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer --}}
    @if($beritas->count() > 0)
        <div class="mt-4 flex items-center justify-between border-t border-gray-200 pt-4 dark:border-gray-700">
            <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan <span class="font-medium text-gray-700 dark:text-gray-300">{{ $beritas->count() }}</span> berita</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $beritas->count() }}</span> file</p>
        </div>
    @endif
</div>

{{-- Modal --}}
<x-admin.berita.modal />

@push('scripts')
<script>
window.deleteBerita = function(id) {
    confirmDelete('Konfirmasi Hapus', 'Yakin ingin menghapus berita ini?', () => executeDelete({
        url: `/admin/setting-landing-page/delete/${id}`,
        method: 'DELETE',
        tableId: '#beritaTableContainer',
    }));
};

window.previewBeritaAdmin = function(id) {
    window.open(`/admin/setting-landing-page/preview/${id}`, '_blank');
};
</script>
@endpush