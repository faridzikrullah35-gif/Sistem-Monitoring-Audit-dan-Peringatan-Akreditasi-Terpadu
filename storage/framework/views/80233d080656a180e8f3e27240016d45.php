<!-- Modal VMTS -->
<div id="modalVmts" 
     tabindex="-1" 
     class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
        
        
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="modalVmtsTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah VMTS
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalVmts()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        
        <form id="formVmts" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" id="formMethodVmts" value="POST">
            <input type="hidden" name="id" id="editId" value="">
            
            <div class="space-y-5 px-6 py-5">
                
                <!-- Visi -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Visi <span class="text-red-500">*</span>
                    </label>
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
                        <div id="visiEditorModal" contenteditable="true" data-placeholder="Masukkan Visi..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                        <input type="hidden" name="visi" id="visiHiddenModal" value="" />
                    </div>
                </div>

                <!-- Misi -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Misi <span class="text-red-500">*</span>
                    </label>
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
                        <div id="misiEditorModal" contenteditable="true" data-placeholder="Masukkan Misi..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                        <input type="hidden" name="misi" id="misiHiddenModal" value="" />
                    </div>
                </div>

                <!-- Tujuan -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tujuan <span class="text-red-500">*</span>
                    </label>
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
                        <div id="tujuanEditorModal" contenteditable="true" data-placeholder="Masukkan Tujuan..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                        <input type="hidden" name="tujuan" id="tujuanHiddenModal" value="" />
                    </div>
                </div>

                <!-- Sasaran -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sasaran <span class="text-red-500">*</span>
                    </label>
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
                        <div id="sasaranEditorModal" contenteditable="true" data-placeholder="Masukkan Sasaran..." class="min-h-[80px] w-full rounded-b-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"></div>
                        <input type="hidden" name="sasaran" id="sasaranHiddenModal" value="" />
                    </div>
                </div>

                
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        File Pendukung VMTS
                    </label>

                    <input
                        type="file"
                        name="file"
                        id="fileVmts"
                        accept=".pdf,.jpg,.jpeg,.png"
                        class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    >

                    <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                        Format: PDF, JPG, JPEG, PNG. Maksimal 5 MB.
                    </p>

                    
                    <div id="existingVmtsFile" class="mt-2"></div>
                </div>

                
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Penetapan
                    </label>

                    <input
                        type="text"
                        name="tgl_penetapan"
                        id="tglPenetapanVmts"
                        placeholder="Pilih tanggal penetapan"
                        autocomplete="off"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    >
                </div>

            </div>

            
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalVmts()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button
                    type="submit"
                    id="btnVmtsSubmit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="btnText">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

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

    #vmtsTableBody td {
        vertical-align: top;
    }

    #vmtsTableBody tr:hover td {
        background-color: rgba(59, 130, 246, 0.02);
    }

    .dark #vmtsTableBody tr:hover td {
        background-color: rgba(59, 130, 246, 0.05);
    }

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

<script>
    const VmtsModal = {
        open(id = null) {
            const modal = document.getElementById('modalVmts');
            const title = document.getElementById('modalVmtsTitle');
            const form = document.getElementById('formVmts');
            const hiddenId = document.getElementById('editId');
            const methodInput = document.getElementById('formMethodVmts');
            const btnText = document.getElementById('btnText');
            this.resetForm();
            if (id) {
                title.textContent = 'Ubah VMTS';
                btnText.textContent = 'Update';
                hiddenId.value = id;
                form.action = `/fakultas/identitas-fakultas/vmts/${id}`;
                methodInput.value = 'PUT';
            } else {
                title.textContent = 'Tambah VMTS';
                btnText.textContent = 'Simpan';
                hiddenId.value = '';
                form.action = '/fakultas/identitas-fakultas/vmts';
                methodInput.value = 'POST';
            }
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        },
        close() {
            const modal = document.getElementById('modalVmts');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            setTimeout(() => this.resetForm(), 0);
        },
        resetForm() {
            ['visiEditorModal', 'misiEditorModal', 'tujuanEditorModal', 'sasaranEditorModal'].forEach(id => {
                const editor = document.getElementById(id);
                if (editor) { editor.innerHTML = ''; editor.blur(); }
            });
            ['visiHiddenModal', 'misiHiddenModal', 'tujuanHiddenModal', 'sasaranHiddenModal'].forEach(id => {
                const input = document.getElementById(id);
                if (input) input.value = '';
            });
            const fileInput = document.getElementById('fileVmts');
            if (fileInput) fileInput.value = '';
            const existingFile = document.getElementById('existingVmtsFile');
            if (existingFile) existingFile.innerHTML = '';
            if (window.flatpickrVmts) {
                window.flatpickrVmts.clear();
            } else {
                const tanggalInput = document.getElementById('tglPenetapanVmts');
                if (tanggalInput) tanggalInput.value = '';
            }
            const editId = document.getElementById('editId');
            if (editId) editId.value = '';
            const methodInput = document.getElementById('formMethodVmts');
            if (methodInput) methodInput.value = 'POST';
            const form = document.getElementById('formVmts');
            if (form) form.action = '/fakultas/identitas-fakultas/vmts';
            const title = document.getElementById('modalVmtsTitle');
            if (title) title.textContent = 'Tambah VMTS';
            const btnText = document.getElementById('btnText');
            const btn = document.getElementById('btnVmtsSubmit');
            if (btnText) btnText.textContent = 'Simpan';
            if (btn) btn.disabled = false;
            const modal = document.getElementById('modalVmts');
            if (modal) modal.scrollTop = 0;
        }
    };

    function openModalVmts(id = null) { VmtsModal.open(id); }
    function closeModalVmts() { VmtsModal.close(); }

    function renderFile(file) {
        if (!file) return `<span class="text-xs text-gray-400 dark:text-gray-500">Tidak ada file</span>`;
        const cleanFile = String(file).replace(/^\/+/, '');
        const fileUrl = `/storage/${cleanFile}`;
        const fileName = cleanFile.split('/').pop();
        return `
            <a href="${fileUrl}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1.5 text-xs font-medium text-blue-600 transition-colors hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/40" title="${fileName}">
                <svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0118 8.414V19a2 2 0 01-2 2z" />
                </svg>
                Lihat File
            </a>
        `;
    }

    function renderTanggal(tanggal) {
        if (!tanggal) return '-';
        const parts = String(tanggal).split('-');
        if (parts.length === 3) return `${parts[2]}/${parts[1]}/${parts[0]}`;
        return tanggal;
    }

    function openEditModalVmtsDirect(id, visi = '', misi = '', tujuan = '', sasaran = '', file = '', tglPenetapan = '') {
        const modal = document.getElementById('modalVmts');
        const title = document.getElementById('modalVmtsTitle');
        const form = document.getElementById('formVmts');
        const hiddenId = document.getElementById('editId');
        const methodInput = document.getElementById('formMethodVmts');
        const btnText = document.getElementById('btnText');
        VmtsModal.resetForm();
        Object.entries({ visiEditorModal: visi || '', misiEditorModal: misi || '', tujuanEditorModal: tujuan || '', sasaranEditorModal: sasaran || '' }).forEach(([editorId, value]) => {
            const editor = document.getElementById(editorId);
            if (editor) editor.innerHTML = value;
        });
        const visiHidden = document.getElementById('visiHiddenModal');
        const misiHidden = document.getElementById('misiHiddenModal');
        const tujuanHidden = document.getElementById('tujuanHiddenModal');
        const sasaranHidden = document.getElementById('sasaranHiddenModal');
        if (visiHidden) visiHidden.value = visi || '';
        if (misiHidden) misiHidden.value = misi || '';
        if (tujuanHidden) tujuanHidden.value = tujuan || '';
        if (sasaranHidden) sasaranHidden.value = sasaran || '';
        const existingFile = document.getElementById('existingVmtsFile');
        if (existingFile) {
            if (file) {
                const cleanFile = String(file).replace(/^\/+/, '');
                const fileUrl = `/storage/${cleanFile}`;
                const fileName = cleanFile.split('/').pop();
                existingFile.innerHTML = `
                    <div class="flex items-center gap-2 rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 dark:border-blue-800/30 dark:bg-blue-900/10">
                        <svg class="h-4 w-4 shrink-0 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0118 8.414V19a2 2 0 01-2 2z" />
                        </svg>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-gray-500 dark:text-gray-400">File saat ini</p>
                            <a href="${fileUrl}" target="_blank" rel="noopener noreferrer" class="block truncate text-sm font-medium text-blue-600 hover:underline dark:text-blue-400" title="${fileName}">${fileName}</a>
                        </div>
                    </div>
                `;
            } else {
                existingFile.innerHTML = '';
            }
        }
        if (window.flatpickrVmts) {
            if (tglPenetapan) window.flatpickrVmts.setDate(tglPenetapan, false);
            else window.flatpickrVmts.clear();
        } else {
            const tanggalInput = document.getElementById('tglPenetapanVmts');
            if (tanggalInput) tanggalInput.value = tglPenetapan || '';
        }
        title.textContent = 'Ubah VMTS';
        btnText.textContent = 'Update';
        hiddenId.value = id;
        form.action = `/fakultas/identitas-fakultas/vmts/${id}`;
        methodInput.value = 'PUT';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function syncRowDataset(row) {
        if (!row) return;
        const getRaw = (selector) => {
            const cell = row.querySelector(selector);
            if (!cell) return '';
            const prose = cell.querySelector('.prose');
            return prose ? prose.innerHTML : cell.innerHTML;
        };
        row.dataset.visi = getRaw('.visi-value') || row.dataset.visi || '';
        row.dataset.misi = getRaw('.misi-value') || row.dataset.misi || '';
        row.dataset.tujuan = getRaw('.tujuan-value') || row.dataset.tujuan || '';
        row.dataset.sasaran = getRaw('.sasaran-value') || row.dataset.sasaran || '';
        row.dataset.file = row.dataset.file || '';
        row.dataset.tglPenetapan = row.dataset.tglPenetapan || '';
    }

    function setupEditButton(row) {
        if (!row) return;
        const editBtn = row.querySelector('.btn-edit-vmts');
        if (!editBtn) return;
        editBtn.onclick = function(e) {
            e.preventDefault();
            openEditModalFromRow(row);
        };
    }

    function openEditModalFromRow(row) {
        if (!row) return;
        syncRowDataset(row);
        const id = row.id.replace('vmtsRow-', '');
        const visi = row.dataset.visi || '';
        const misi = row.dataset.misi || '';
        const tujuan = row.dataset.tujuan || '';
        const sasaran = row.dataset.sasaran || '';
        const file = row.dataset.file || '';
        const tglPenetapan = row.dataset.tglPenetapan || '';
        openEditModalVmtsDirect(id, visi, misi, tujuan, sasaran, file, tglPenetapan);
    }

    function renderContent(content) {
        return `
            <div class="prose prose-sm dark:prose-invert max-w-none break-words text-gray-700 dark:text-gray-300 [&_p]:mb-1.5 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-1.5 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-1.5 [&_li]:mb-0.5 [&_strong]:font-semibold [&_em]:italic [&_u]:underline [&_h1]:text-base [&_h1]:font-bold [&_h1]:mb-1.5 [&_h2]:text-sm [&_h2]:font-semibold [&_h2]:mb-1.5 [&_h3]:text-sm [&_h3]:font-semibold [&_h3]:mb-1 [&_table]:w-full [&_table]:border-collapse [&_td]:border [&_td]:p-1.5 [&_th]:border [&_th]:p-1.5 [&_th]:font-semibold [&_blockquote]:border-l-4 [&_blockquote]:border-gray-300 [&_blockquote]:pl-3 [&_blockquote]:italic">
                ${content || ''}
            </div>
        `;
    }

    function updateVmtsTable(data) {
        const tbody = document.getElementById('vmtsTableBody');
        if (!tbody || !data) return;
        const id = data.id;
        let row = document.getElementById(`vmtsRow-${id}`);
        if (row) {
            row.dataset.visi = data.visi || '';
            row.dataset.misi = data.misi || '';
            row.dataset.tujuan = data.tujuan || '';
            row.dataset.sasaran = data.sasaran || '';
            row.dataset.file = data.file || '';
            row.dataset.tglPenetapan = data.tgl_penetapan || '';
            const visiCell = row.querySelector('.visi-value');
            const misiCell = row.querySelector('.misi-value');
            const tujuanCell = row.querySelector('.tujuan-value');
            const sasaranCell = row.querySelector('.sasaran-value');
            if (visiCell) visiCell.innerHTML = renderContent(data.visi);
            if (misiCell) misiCell.innerHTML = renderContent(data.misi);
            if (tujuanCell) tujuanCell.innerHTML = renderContent(data.tujuan);
            if (sasaranCell) sasaranCell.innerHTML = renderContent(data.sasaran);
            const fileCell = row.querySelector('.file-value');
            if (fileCell) fileCell.innerHTML = renderFile(data.file);
            const tanggalCell = row.querySelector('.tanggal-value');
            if (tanggalCell) tanggalCell.innerHTML = renderTanggal(data.tgl_penetapan);
            setupEditButton(row);
            return;
        }
        const emptyState = document.getElementById('emptyStateRow');
        if (emptyState) emptyState.remove();
        row = document.createElement('tr');
        row.id = `vmtsRow-${id}`;
        row.dataset.visi = data.visi || '';
        row.dataset.misi = data.misi || '';
        row.dataset.tujuan = data.tujuan || '';
        row.dataset.sasaran = data.sasaran || '';
        row.dataset.file = data.file || '';
        row.dataset.tglPenetapan = data.tgl_penetapan || '';
        row.className = 'border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors';
        row.innerHTML = `
            <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 align-top">
                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">1</span>
            </td>
            <td class="px-4 py-3 visi-value align-top">${renderContent(data.visi)}</td>
            <td class="px-4 py-3 misi-value align-top">${renderContent(data.misi)}</td>
            <td class="px-4 py-3 tujuan-value align-top">${renderContent(data.tujuan)}</td>
            <td class="px-4 py-3 sasaran-value align-top">${renderContent(data.sasaran)}</td>
            <td class="px-4 py-3 file-value align-top text-center">${renderFile(data.file)}</td>
            <td class="px-4 py-3 tanggal-value align-top text-center text-sm text-gray-700 dark:text-gray-300">${renderTanggal(data.tgl_penetapan)}</td>
            <td class="px-4 py-3 text-center align-top">
                <div class="flex items-center justify-center gap-1.5">
                    <button type="button" class="btn-edit-vmts inline-flex items-center gap-1 rounded-lg border border-yellow-200/50 bg-yellow-50 px-2.5 py-1.5 text-xs font-medium text-yellow-700 transition-all duration-200 hover:bg-yellow-100 dark:border-yellow-800/30 dark:bg-yellow-900/20 dark:text-yellow-300 dark:hover:bg-yellow-900/40" title="Edit">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z" /></svg>
                        Edit
                    </button>
                    <button type="button" class="btn-delete-vmts inline-flex items-center gap-1 rounded-lg border border-red-200/50 bg-red-50 px-2.5 py-1.5 text-xs font-medium text-red-700 transition-all duration-200 hover:bg-red-100 dark:border-red-800/30 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/40" title="Hapus">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Hapus
                    </button>
                </div>
            </td>
        `;
        setupEditButton(row);
        const deleteBtn = row.querySelector('.btn-delete-vmts');
        if (deleteBtn) deleteBtn.onclick = function() { deleteVmts(data.id); };
        tbody.appendChild(row);
    }

    function openEditModalVmts(modalId, id, visi, misi, tujuan, sasaran, file = '', tglPenetapan = '') {
        openEditModalVmtsDirect(id, visi, misi, tujuan, sasaran, file, tglPenetapan);
    }

    function execCmdModal(editorId, command) {
        const editor = document.getElementById(editorId);
        if (!editor) return;
        editor.focus();
        document.execCommand(command, false, null);
        updateHiddenInputs();
    }

    function updateHiddenInputs() {
        ['visiEditorModal', 'misiEditorModal', 'tujuanEditorModal', 'sasaranEditorModal'].forEach((editorId, index) => {
            const editor = document.getElementById(editorId);
            const hidden = document.getElementById(['visiHiddenModal', 'misiHiddenModal', 'tujuanHiddenModal', 'sasaranHiddenModal'][index]);
            if (editor && hidden) {
                const content = editor.innerHTML.trim();
                hidden.value = content === '' || content === '<br>' ? '' : content;
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const formVmts = document.getElementById('formVmts');
        const tanggalVmts = document.getElementById('tglPenetapanVmts');
        if (tanggalVmts && typeof flatpickr !== 'undefined') {
            window.flatpickrVmts = flatpickr(tanggalVmts, {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd/m/Y',
                allowInput: true
            });
        }
        const existingRows = document.querySelectorAll('#vmtsTableBody tr:not(#emptyStateRow)');
        existingRows.forEach(row => {
            syncRowDataset(row);
            setupEditButton(row);
        });
        if (formVmts) {
            formVmts.addEventListener('submit', function(e) {
                e.preventDefault();
                updateHiddenInputs();
                const formData = new FormData(this);
                const id = document.getElementById('editId').value;
                const url = this.action;
                const btn = document.getElementById('btnVmtsSubmit');
                const btnText = document.getElementById('btnText');
                btn.disabled = true;
                btnText.textContent = 'Menyimpan...';
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'Terjadi kesalahan pada server.');
                    return data;
                })
                .then(data => {
                    if (!data.status) {
                        if (window.toast && typeof window.toast.error === 'function') {
                            window.toast.error(data.message || 'Gagal menyimpan data');
                        }
                        return;
                    }
                    updateVmtsTable(data.data);
                    if (window.toast && typeof window.toast.success === 'function') {
                        window.toast.success(data.message || 'VMTS berhasil disimpan');
                    }
                    VmtsModal.close();
                })
                .catch(error => {
                    console.error('VMTS Error:', error);
                    if (window.toast && typeof window.toast.error === 'function') {
                        window.toast.error(error.message || 'Terjadi kesalahan saat menyimpan data');
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btnText.textContent = id ? 'Update' : 'Simpan';
                });
            });
        }
        ['visiEditorModal', 'misiEditorModal', 'tujuanEditorModal', 'sasaranEditorModal'].forEach(id => {
            const editor = document.getElementById(id);
            if (editor) {
                editor.setAttribute('data-placeholder', editor.getAttribute('data-placeholder') || '');
                editor.addEventListener('input', updateHiddenInputs);
                editor.addEventListener('blur', updateHiddenInputs);
            }
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('modalVmts');
                if (modal && !modal.classList.contains('hidden')) closeModalVmts();
            }
        });
    });
</script><?php /**PATH F:\Project-2\audit-app\resources\views/components/identitas-fakultas/modal/modal-vmts.blade.php ENDPATH**/ ?>