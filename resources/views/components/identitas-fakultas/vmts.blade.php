@props([
    'profil'
])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">VMTS</h4>
        <button type="button" class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800" onclick="openModalVmts()">
            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah
        </button>
    </div>

    <div id="vmtsTableContainer" class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-center w-[50px]">No</th>
                    <th class="px-4 py-3 min-w-[200px] align-top">Visi</th>
                    <th class="px-4 py-3 min-w-[200px] align-top">Misi</th>
                    <th class="px-4 py-3 min-w-[200px] align-top">Tujuan</th>
                    <th class="px-4 py-3 min-w-[200px] align-top">Sasaran</th>
                    <th class="px-4 py-3 min-w-[150px] align-top">File</th>
                    <th class="px-4 py-3 text-center min-w-[130px] align-top">Tgl Penetapan</th>
                    <th class="px-4 py-3 text-center w-[120px] align-top">Aksi</th>
                </tr>
            </thead>
            <tbody id="vmtsTableBody">
                @if($profil && $profil->visi)
                <tr
                    class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors"
                    id="vmtsRow-{{ $profil->id }}"
                    data-file="{{ $profil->file ?? '' }}"
                    data-tgl-penetapan="{{ $profil->tgl_penetapan?->format('Y-m-d') ?? '' }}"
                >
                    <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 align-top">
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">1</span>
                    </td>
                    <td class="px-4 py-3 visi-value align-top" data-id="{{ $profil->id }}">
                        <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                            [&_p]:mb-1.5 
                            [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5 
                            [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 
                            [&_li]:mb-0.5 
                            [&_strong]:font-semibold 
                            [&_em]:italic 
                            [&_u]:underline 
                            [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5 
                            [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5 
                            [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1 
                            [&_table]:w-full [&_table]:border-collapse 
                            [&_td]:border [&_td]:p-1.5 
                            [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold 
                            [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                            {!! $profil->visi !!}
                        </div>
                    </td>
                    <td class="px-4 py-3 misi-value align-top" data-id="{{ $profil->id }}">
                        <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                            [&_p]:mb-1.5 
                            [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5 
                            [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 
                            [&_li]:mb-0.5 
                            [&_strong]:font-semibold 
                            [&_em]:italic 
                            [&_u]:underline 
                            [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5 
                            [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5 
                            [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1 
                            [&_table]:w-full [&_table]:border-collapse 
                            [&_td]:border [&_td]:p-1.5 
                            [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold 
                            [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                            {!! $profil->misi !!}
                        </div>
                    </td>
                    <td class="px-4 py-3 tujuan-value align-top" data-id="{{ $profil->id }}">
                        <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                            [&_p]:mb-1.5 
                            [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5 
                            [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 
                            [&_li]:mb-0.5 
                            [&_strong]:font-semibold 
                            [&_em]:italic 
                            [&_u]:underline 
                            [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5 
                            [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5 
                            [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1 
                            [&_table]:w-full [&_table]:border-collapse 
                            [&_td]:border [&_td]:p-1.5 
                            [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold 
                            [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                            {!! $profil->tujuan !!}
                        </div>
                    </td>
                    <td class="px-4 py-3 sasaran-value align-top" data-id="{{ $profil->id }}">
                        <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300
                            [&_p]:mb-1.5 
                            [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5 
                            [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 
                            [&_li]:mb-0.5 
                            [&_strong]:font-semibold 
                            [&_em]:italic 
                            [&_u]:underline 
                            [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5 
                            [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5 
                            [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1 
                            [&_table]:w-full [&_table]:border-collapse 
                            [&_td]:border [&_td]:p-1.5 
                            [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold 
                            [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                            {!! $profil->sasaran !!}
                        </div>
                    </td>
                    <td class="px-4 py-3 align-top">
                        @if($profil->file)
                            <a
                                href="{{ asset('storage/' . ltrim($profil->file, '/')) }}"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1.5 text-xs font-medium text-blue-700 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/40"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0 3-3m-3 3-3-3m8.5 8H6.5A2.5 2.5 0 0 1 4 18.5v-13A2.5 2.5 0 0 1 6.5 3h7.086a2.5 2.5 0 0 1 1.768.732l3.914 3.914A2.5 2.5 0 0 1 20 9.414V18.5a2.5 2.5 0 0 1-2.5 2.5Z"/>
                                </svg>
                                Lihat File
                            </a>
                        @else
                            <span class="text-xs text-gray-400 dark:text-gray-500">
                                Tidak ada file
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-center align-top">
                        @if($profil->tgl_penetapan)
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                {{ $profil->tgl_penetapan->format('d/m/Y') }}
                            </span>
                        @else
                            <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center align-top">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button" 
                                class="btn-edit-vmts inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30" 
                                title="Edit">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                                </svg> Edit
                            </button>
                            <button
                                type="button"
                                onclick="deleteProfileFakultas({{ $profil->id }}, 'vmtsTableContainer')"
                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30"
                                title="Hapus"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @else
                <tr id="emptyStateRow">
                    <td colspan="8" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data VMTS</span>
                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik tombol Tambah untuk menambahkan data</span>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Include Modal Components -->
@include('components.identitas-fakultas.modal.modal-vmts')