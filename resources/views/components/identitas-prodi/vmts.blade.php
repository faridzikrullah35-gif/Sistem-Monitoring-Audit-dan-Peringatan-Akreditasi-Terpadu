@props([
    'profil'
])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">VMTS</h4>
        <button type="button" class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800" onclick="openModal('modalVmts')">
            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah
        </button>
    </div>

    <div id="vmtsTableContainer" class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Visi</th>
                    <th class="px-4 py-3">Misi</th>
                    <th class="px-4 py-3">Tujuan</th>
                    <th class="px-4 py-3">Sasaran</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($profil && $profil->visi)
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-2">1</td>

                    <td class="px-4 py-2">
                        <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_li]:mb-1">
                            {!! $profil->visi !!}
                        </div>
                    </td>

                    <td class="px-4 py-2">
                        <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_li]:mb-1">
                            {!! $profil->misi !!}
                        </div>
                    </td>

                    <td class="px-4 py-2">
                        <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_li]:mb-1">
                            {!! $profil->tujuan !!}
                        </div>
                    </td>

                    <td class="px-4 py-2">
                        <div class="max-w-none break-words [&_p]:mb-2 [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_li]:mb-1">
                            {!! $profil->sasaran !!}
                        </div>
                    </td>

                    <td class="px-4 py-2 text-center">
                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                onclick="openEditModalVmts(
                                    'modalVmts',
                                    {{ $profil->id }},
                                    {{ json_encode($profil->visi) }},
                                    {{ json_encode($profil->misi) }},
                                    {{ json_encode($profil->tujuan) }},
                                    {{ json_encode($profil->sasaran) }}
                                )"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.586-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                                </svg>
                                Edit
                            </button>

                            <button
                                type="button"
                                onclick="deleteProfileProdi({{ $profil->id }}, '#vmtsTableContainer')"
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
                @else
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">
                        Belum ada data VMTS.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal VMTS (Tambah / Edit) -->
<div id="modalVmts" tabindex="-1" class="modal-overlay fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 p-4" data-table-id="#vmtsTableContainer">
    <div class="relative mx-auto max-w-2xl top-10"> <!-- Lebar lebih besar karena rich text -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalVmtsTitle">Tambah VMTS</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 text-sm dark:hover:bg-gray-700 dark:hover:text-white" onclick="closeModal('modalVmts')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <form id="formVmts" action="{{ route('prodi.identitas-prodi.vmts.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="id" id="editId" value="">

                    <!-- Visi -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Visi</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">

                                <button
                                    type="button"
                                    onmousedown="event.preventDefault()"
                                    onclick="execCmdModal('visiEditorModal', 'bold')"
                                    class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white"
                                    title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/>
                                    </svg>
                                </button>

                                <button
                                    type="button"
                                    onmousedown="event.preventDefault()"
                                    onclick="execCmdModal('visiEditorModal', 'italic')"
                                    class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white"
                                    title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path d="M10 4h4m-2 0v16m-4 0h8"/>
                                    </svg>
                                </button>

                                <button
                                    type="button"
                                    onmousedown="event.preventDefault()"
                                    onclick="execCmdModal('visiEditorModal', 'underline')"
                                    class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white"
                                    title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/>
                                    </svg>
                                </button>

                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>

                                <button
                                    type="button"
                                    onmousedown="event.preventDefault()"
                                    onclick="execCmdModal('visiEditorModal', 'insertUnorderedList')"
                                    class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white"
                                    title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                    </svg>
                                </button>

                                <button
                                    type="button"
                                    onmousedown="event.preventDefault()"
                                    onclick="execCmdModal('visiEditorModal', 'insertOrderedList')"
                                    class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white"
                                    title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/>
                                    </svg>
                                </button>

                            </div>
                            <div
                                id="visiEditorModal"
                                contenteditable="true"
                                data-placeholder="Masukkan Visi..."
                                class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                            >
                            </div>
                            <input type="hidden" name="visi" id="visiHiddenModal" value="" />
                        </div>
                    </div>

                    <!-- Misi -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Misi</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onclick="execCmdModal('misiEditorModal', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('misiEditorModal', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('misiEditorModal', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onclick="execCmdModal('misiEditorModal', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('misiEditorModal', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                                </button>
                            </div>
                            <div
                                id="misiEditorModal"
                                contenteditable="true"
                                data-placeholder="Masukkan Misi..."
                                class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                            ></div>
                            <input type="hidden" name="misi" id="misiHiddenModal" value="" />
                        </div>
                    </div>

                    <!-- Tujuan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tujuan</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onclick="execCmdModal('tujuanEditorModal', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('tujuanEditorModal', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('tujuanEditorModal', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onclick="execCmdModal('tujuanEditorModal', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('tujuanEditorModal', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                                </button>
                            </div>
                            <div
                                id="tujuanEditorModal"
                                contenteditable="true"
                                data-placeholder="Masukkan Tujuan..."
                                class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                            ></div>
                            <input type="hidden" name="tujuan" id="tujuanHiddenModal" value="" />
                        </div>
                    </div>

                    <!-- Sasaran -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sasaran</label>
                        <div class="rich-editor-wrapper">
                            <div class="rich-editor-toolbar flex flex-wrap items-center gap-0.5 rounded-t-lg border border-b-0 border-gray-300 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onclick="execCmdModal('sasaranEditorModal', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bold">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('sasaranEditorModal', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Italic">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('sasaranEditorModal', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Underline">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onclick="execCmdModal('sasaranEditorModal', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </button>
                                <button type="button" onclick="execCmdModal('sasaranEditorModal', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-white" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg>
                                </button>
                            </div>
                            <div
                                id="sasaranEditorModal"
                                contenteditable="true"
                                data-placeholder="Masukkan Sasaran..."
                                class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                            ></div>
                            <input type="hidden" name="sasaran" id="sasaranHiddenModal" value="" />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" class="mr-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700" onclick="closeModal('modalVmts')">Batal</button>
                        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>