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

    {{-- ============================================================ --}}
    {{-- TABLE SCROLL CONTAINER                                       --}}
    {{-- ============================================================ --}}
    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">

        <div
            id="vmtsTableContainer"
            class="overflow-auto"
            style="max-height: 600px;"
        >
            <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-center text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 w-[50px]">No</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Visi</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Misi</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Tujuan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[200px] align-top">Sasaran</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[160px] align-top">File</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 min-w-[140px] align-top">Tgl Penetapan</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-center text-xs uppercase text-gray-700 dark:bg-gray-900 dark:text-gray-300 w-[120px] align-top">Aksi</th>
                    </tr>
                </thead>
                <tbody id="vmtsTableBody">
                    @if($profil && $profil->visi)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors" id="vmtsRow-{{ $profil->id }}">
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
                        <td class="px-4 py-3 file-value align-top" data-id="{{ $profil->id }}">
                            @if($profil->file)
                                <a
                                    href="{{ asset('storage/' . ltrim($profil->file, '/')) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a2 2 0 00-.586-1.414l-5.414-5.414A2 2 0 0011.586 2H7a2 2 0 00-2 2v15a2 2 0 002 2z"/>
                                    </svg>
                                    Lihat File
                                </a>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">Tidak ada file</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 tgl-penetapan-value align-top" data-id="{{ $profil->id }}">
                            @if($profil->tgl_penetapan)
                                {{ \Carbon\Carbon::parse($profil->tgl_penetapan)->format('d/m/Y') }}
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center align-top">
                            <div class="flex items-center justify-center gap-1.5">
                                <button
                                    type="button"
                                    onclick="openEditModalVmts(
                                        'modalVmts',
                                        {{ $profil->id }},
                                        @js($profil->visi),
                                        @js($profil->misi),
                                        @js($profil->tujuan),
                                        @js($profil->sasaran),
                                        @js($profil->file),
                                        @js($profil->tgl_penetapan?->format('Y-m-d'))
                                    )"
                                    data-file="{{ $profil->file }}"
                                    data-tgl-penetapan="{{ $profil->tgl_penetapan }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30"
                                    title="Edit"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                                    </svg>
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    onclick="deleteVmts({{ $profil->id }}, '#vmtsTableContainer')"
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
    {{-- /TABLE SCROLL CONTAINER --}}
</div>

{{-- ==================== MODAL VMTS ==================== --}}
<div id="modalVmts" 
     tabindex="-1" 
     class="modal-overlay fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 p-4" 
     style="backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);"
     onclick="event.stopPropagation();">
    <div class="relative mx-auto max-w-2xl top-10" onclick="event.stopPropagation();">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800" onclick="event.stopPropagation();">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalVmtsTitle">Tambah VMTS</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 text-sm dark:hover:bg-gray-700 dark:hover:text-white" onclick="closeModal('modalVmts')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <form id="formVmts" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="id" id="editId" value="">
                    
                    {{-- Visi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Visi</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('visiEditorModal', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('visiEditorModal', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('visiEditorModal', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('visiEditorModal', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('visiEditorModal', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                                </button>
                            </div>
                            <div id="visiEditorModal" contenteditable="true" data-placeholder="Masukkan Visi..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                            <input type="hidden" name="visi" id="visiHiddenModal" value="" />
                        </div>
                    </div>

                    {{-- Misi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Misi</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('misiEditorModal', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('misiEditorModal', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('misiEditorModal', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('misiEditorModal', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('misiEditorModal', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                                </button>
                            </div>
                            <div id="misiEditorModal" contenteditable="true" data-placeholder="Masukkan Misi..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                            <input type="hidden" name="misi" id="misiHiddenModal" value="" />
                        </div>
                    </div>

                    {{-- Tujuan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tujuan</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('tujuanEditorModal', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('tujuanEditorModal', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('tujuanEditorModal', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('tujuanEditorModal', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('tujuanEditorModal', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                                </button>
                            </div>
                            <div id="tujuanEditorModal" contenteditable="true" data-placeholder="Masukkan Tujuan..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                            <input type="hidden" name="tujuan" id="tujuanHiddenModal" value="" />
                        </div>
                    </div>

                    {{-- Sasaran --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sasaran</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('sasaranEditorModal', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('sasaranEditorModal', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('sasaranEditorModal', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('sasaranEditorModal', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </button>
                                <button type="button" onmousedown="event.preventDefault()" onclick="execCmdModal('sasaranEditorModal', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                                </button>
                            </div>
                            <div id="sasaranEditorModal" contenteditable="true" data-placeholder="Masukkan Sasaran..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                            <input type="hidden" name="sasaran" id="sasaranHiddenModal" value="" />
                        </div>
                    </div>

                    {{-- File --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            File
                        </label>

                        <input
                            type="file"
                            name="file"
                            id="fileVmts"
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white text-sm text-gray-700
                                file:mr-4 file:border-0 file:bg-gray-100 file:px-4 file:py-2
                                file:text-sm file:font-medium file:text-gray-700
                                hover:file:bg-gray-200
                                dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300
                                dark:file:bg-gray-700 dark:file:text-gray-200"
                        >

                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Format yang diperbolehkan: PDF, JPG, JPEG, PNG.
                        </p>

                        <div id="currentFileVmts" class="mt-2 text-sm"></div>
                    </div>

                    {{-- Tanggal Penetapan --}}
                    <div class="mb-4">
                        <label
                            for="tglPenetapanVmts"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Tgl Penetapan
                        </label>

                        <input
                            type="text"
                            name="tgl_penetapan"
                            id="tglPenetapanVmts"
                            placeholder="Pilih tanggal penetapan"
                            autocomplete="off"
                            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5
                                text-sm text-gray-700 outline-none
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                        >
                    </div>

                    <div class="flex justify-end">
                        <button type="button" class="mr-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700" onclick="closeModal('modalVmts')">Batal</button>
                        <button type="submit" id="btnVmtsSubmit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                            <span id="btnText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr('#tglPenetapanVmts', {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd/m/Y',
            allowInput: true
        });
    });
</script>

<style>
    .rich-editor-wrapper [contenteditable] ul {
        list-style-type: disc !important;
        list-style-position: outside !important;
        padding-left: 24px !important;
        margin: 8px 0 !important;
    }

    .rich-editor-wrapper [contenteditable] ol {
        list-style-type: decimal !important;
        list-style-position: outside !important;
        padding-left: 24px !important;
        margin: 8px 0 !important;
    }

    .rich-editor-wrapper [contenteditable] li {
        display: list-item !important;
    }

    /* Fix alignment untuk konten di tabel */
    #vmtsTableBody td {
        vertical-align: top;
    }

    /* Hover effect untuk row */
    #vmtsTableBody tr:hover td {
        background-color: rgba(59, 130, 246, 0.02);
    }

    .dark #vmtsTableBody tr:hover td {
        background-color: rgba(59, 130, 246, 0.05);
    }

    /* Prose styling untuk konten rich text */
    .prose ul, 
    .prose ol {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .prose li {
        margin-bottom: 0.125rem !important;
    }

    .prose p {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .prose p:first-child {
        margin-top: 0 !important;
    }

    .prose p:last-child {
        margin-bottom: 0 !important;
    }
</style>