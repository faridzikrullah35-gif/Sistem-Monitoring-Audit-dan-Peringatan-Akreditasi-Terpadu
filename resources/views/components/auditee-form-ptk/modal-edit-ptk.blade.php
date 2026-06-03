<!-- Modal Edit PTK -->
@props(['kategoriTemuan' => []])

<div id="ptkModal" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6">
    <div class="mx-4 w-full max-w-4xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
        
        <!-- Header Modal -->
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <h3 id="ptk-modal-title" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Edit Data PTK
                </h3>
            </div>
            <button type="button" onclick="closePtkModal()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Body -->
        <form id="ptkForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT" />

            <div class="max-h-[70vh] overflow-y-auto px-6 py-5 space-y-5">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <!-- No NCR -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No NCR</label>
                        <input type="text" name="no_ncr" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Klausul / Dokumen -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Klausul / Dokumen</label>
                        <input type="text" name="klausul_dokumen" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Deskripsi / Uraian Temuan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi / Uraian Temuan</label>
                        <textarea name="deskripsi_uraian_temuan" rows="2" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"></textarea>
                    </div>

                    <!-- Kategori Temuan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori Temuan</label>
                        <select name="kategori_temuan" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($kategoriTemuan as $item)
                                <option value="{{ $item->keterangan }}">{{ $item->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status NCR -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status NCR</label>
                        <select name="status_ncr" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                            <input type="text" name="tanggal_selesai" id="ptkTanggalSelesai" class="w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" placeholder="Pilih tanggal">
                        </div>
                    </div>

                    <!-- Rencana Tindakan Perbaikan - Rich Text -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rencana Tindakan Perbaikan (Auditee)</label>
                        <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                            <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onclick="PtkEditor.exec('rencana','bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bold"><b>B</b></button>
                                <button type="button" onclick="PtkEditor.exec('rencana','italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Italic"><i>I</i></button>
                                <button type="button" onclick="PtkEditor.exec('rencana','underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Underline"><u>U</u></button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onclick="PtkEditor.exec('rencana','insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                                </button>
                                <button type="button" onclick="PtkEditor.exec('rencana','insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z" /></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onclick="PtkEditor.exec('rencana','justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Left">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" /></svg>
                                </button>
                                <button type="button" onclick="PtkEditor.exec('rencana','justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Center">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                                </button>
                                <button type="button" onclick="PtkEditor.exec('rencana','justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Right">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                                </button>
                            </div>
                            <div id="ptkRencanaEditor" contenteditable="true" data-placeholder="Tulis rencana tindakan perbaikan di sini..." class="min-h-[100px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"></div>
                        </div>
                        <input type="hidden" name="rencana_tindakan_perbaikan_auditee" id="ptkRencanaHidden" />
                    </div>

                    <!-- Tindakan Pencegahan - Rich Text -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tindakan Pencegahan (Auditee)</label>
                        <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                            <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                                <button type="button" onclick="PtkEditor.exec('tindakan','bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bold"><b>B</b></button>
                                <button type="button" onclick="PtkEditor.exec('tindakan','italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Italic"><i>I</i></button>
                                <button type="button" onclick="PtkEditor.exec('tindakan','underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Underline"><u>U</u></button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onclick="PtkEditor.exec('tindakan','insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Bullet List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                                </button>
                                <button type="button" onclick="PtkEditor.exec('tindakan','insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Numbered List">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z" /></svg>
                                </button>
                                <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                                <button type="button" onclick="PtkEditor.exec('tindakan','justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Left">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" /></svg>
                                </button>
                                <button type="button" onclick="PtkEditor.exec('tindakan','justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Center">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                                </button>
                                <button type="button" onclick="PtkEditor.exec('tindakan','justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700" title="Align Right">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                                </button>
                            </div>
                            <div id="ptkTindakanEditor" contenteditable="true" data-placeholder="Tulis tindakan pencegahan di sini..." class="min-h-[100px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"></div>
                        </div>
                        <input type="hidden" name="tindakan_pencegahan_auditee" id="ptkTindakanHidden" />
                    </div>

                    <!-- Target Perbaikan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Target Perbaikan</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                            <input type="text" name="tanggal_target_perbaikan_auditee" id="ptkTargetPerbaikan" class="w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" placeholder="Pilih tanggal">
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            File Bukti (PDF)
                            <span class="text-xs font-normal text-gray-500 dark:text-gray-400">(maks. 2MB)</span>
                        </label>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                            <button type="button" id="ptkBrowseFileBtn" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                Pilih File PDF
                            </button>
                            <input type="file" accept="application/pdf" name="file_auditee" id="ptkFileInput" class="hidden">
                            <div class="flex items-center gap-2 flex-1 min-w-0">
                                <span id="ptkFileNameDisplay" class="truncate text-sm text-gray-400">Belum ada file dipilih</span>
                                <button type="button" id="ptkClearFileBtn" class="text-red-500 hover:text-red-700 hidden" title="Hapus file">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Format: PDF | Maks. 2MB | Kosongkan jika tidak ingin mengganti</p>
                        <div id="ptkFileError" class="text-xs text-red-600 hidden"></div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closePtkModal()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                    Batal
                </button>
                <button type="submit" id="ptkSubmitBtn" form="ptkForm" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    #ptkRencanaEditor ul, #ptkRencanaEditor ol,
    #ptkTindakanEditor ul, #ptkTindakanEditor ol {
        margin: 0.5em 0;
        padding-left: 1.5em;
    }
    #ptkRencanaEditor ul, #ptkTindakanEditor ul { list-style-type: disc; }
    #ptkRencanaEditor ol, #ptkTindakanEditor ol { list-style-type: decimal; }
    #ptkRencanaEditor li, #ptkTindakanEditor li { margin: 0.25em 0; }
    [contenteditable][data-placeholder]:empty:before {
        content: attr(data-placeholder);
        color: #9ca3af;
    }
</style>

<!-- <script>
    /* =========================================================
    PTK RICH TEXT EDITOR
    ========================================================= */
    const PtkEditor = {
        editors: {
            rencana:  { editor: 'ptkRencanaEditor',  hidden: 'ptkRencanaHidden'  },
            tindakan: { editor: 'ptkTindakanEditor', hidden: 'ptkTindakanHidden' },
        },

        exec(key, command) {
            const el = document.getElementById(this.editors[key].editor);
            if (!el) return;
            el.focus();
            const sel = window.getSelection();
            if (!sel.rangeCount) {
                const range = document.createRange();
                range.selectNodeContents(el);
                range.collapse(false);
                sel.removeAllRanges();
                sel.addRange(range);
            }
            try {
                document.execCommand(command, false, null);
            } catch (e) {
                if (command === 'insertUnorderedList') document.execCommand('insertHTML', false, '<ul><li></li></ul>');
                if (command === 'insertOrderedList')   document.execCommand('insertHTML', false, '<ol><li></li></ol>');
            }
            this.sync(key);
        },

        sync(key) {
            const { editor, hidden } = this.editors[key];
            const el = document.getElementById(editor);
            const hid = document.getElementById(hidden);
            if (el && hid) hid.value = el.innerHTML;
        },

        syncAll() {
            Object.keys(this.editors).forEach(key => this.sync(key));
        },

        set(key, html) {
            const { editor, hidden } = this.editors[key];
            const el = document.getElementById(editor);
            const hid = document.getElementById(hidden);
            if (el) el.innerHTML = html || '';
            if (hid) hid.value = html || '';
        },

        reset() {
            Object.keys(this.editors).forEach(key => this.set(key, ''));
        }
    };

    /* =========================================================
    PTK FLATPICKR
    ========================================================= */
    const PtkDatepicker = {
        instances: [],

        init() {
            this.destroy();
            const config = { dateFormat: 'Y-m-d', altInput: true, altFormat: 'd F Y', allowInput: true, disableMobile: true };
            ['ptkTanggalSelesai', 'ptkTargetPerbaikan'].forEach(id => {
                const el = document.getElementById(id);
                if (el && typeof flatpickr !== 'undefined') {
                    this.instances.push(flatpickr(el, config));
                }
            });
        },

        setDate(index, value) {
            if (value && this.instances[index]) {
                this.instances[index].setDate(value);
            }
        },

        clear() { this.instances.forEach(fp => fp.clear()); },
        destroy() { this.instances.forEach(fp => fp.destroy()); this.instances = []; }
    };

    /* =========================================================
    PTK FILE UPLOAD
    ========================================================= */
    const PtkFileUpload = {
        init() {
            const fileInput  = document.getElementById('ptkFileInput');
            const browseBtn  = document.getElementById('ptkBrowseFileBtn');
            const nameDisplay = document.getElementById('ptkFileNameDisplay');
            const clearBtn   = document.getElementById('ptkClearFileBtn');
            const errorEl    = document.getElementById('ptkFileError');
            if (!fileInput || !browseBtn) return;

            browseBtn.onclick = () => fileInput.click();

            fileInput.onchange = (e) => {
                const file = e.target.files[0];
                errorEl.classList.add('hidden');
                if (!file) { this.resetDisplay(); return; }
                if (file.type !== 'application/pdf') {
                    errorEl.textContent = 'File harus berformat PDF';
                    errorEl.classList.remove('hidden');
                    fileInput.value = '';
                    this.resetDisplay();
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    errorEl.textContent = 'Ukuran file maksimal 2 MB';
                    errorEl.classList.remove('hidden');
                    fileInput.value = '';
                    this.resetDisplay();
                    return;
                }
                nameDisplay.textContent = `${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
                nameDisplay.classList.remove('text-gray-400');
                clearBtn.classList.remove('hidden');
            };

            clearBtn.onclick = () => {
                fileInput.value = '';
                this.resetDisplay();
            };
        },

        resetDisplay() {
            const nameDisplay = document.getElementById('ptkFileNameDisplay');
            const clearBtn    = document.getElementById('ptkClearFileBtn');
            if (nameDisplay) { nameDisplay.textContent = 'Belum ada file dipilih'; nameDisplay.classList.add('text-gray-400'); }
            if (clearBtn) clearBtn.classList.add('hidden');
        },

        setExistingFile(filename) {
            const nameDisplay = document.getElementById('ptkFileNameDisplay');
            const clearBtn    = document.getElementById('ptkClearFileBtn');
            if (!filename) { this.resetDisplay(); return; }
            if (nameDisplay) { nameDisplay.textContent = filename; nameDisplay.classList.remove('text-gray-400'); }
            if (clearBtn) clearBtn.classList.remove('hidden');
        }
    };

    /* =========================================================
    PTK MODAL CONTROLLER
    ========================================================= */
    const PtkModal = {
        open(ptk) {
            const modal = document.getElementById('ptkModal');
            const form  = document.getElementById('ptkForm');

            // Set action URL
            form.action = `/prodi/form-ptk/${ptk.id}`;

            // Reset dulu
            this.resetForm();

            // Isi field biasa
            ['no_ncr', 'klausul_dokumen', 'deskripsi_uraian_temuan',
            'kategori_temuan', 'status_ncr'].forEach(field => {
                const el = form.querySelector(`[name="${field}"]`);
                if (el && ptk[field] !== undefined) el.value = ptk[field] || '';
            });

            // Flatpickr
            PtkDatepicker.init();
            PtkDatepicker.setDate(0, ptk.tanggal_selesai);
            PtkDatepicker.setDate(1, ptk.tanggal_target_perbaikan_auditee);

            // Rich text
            PtkEditor.set('rencana',  ptk.rencana_tindakan_perbaikan_auditee  || '');
            PtkEditor.set('tindakan', ptk.tindakan_pencegahan_auditee || '');

            // File
            PtkFileUpload.setExistingFile(ptk.file_auditee);

            // Show
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        },

        close() {
            const modal = document.getElementById('ptkModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
            this.resetForm();
            PtkDatepicker.destroy();
        },

        resetForm() {
            const form = document.getElementById('ptkForm');
            if (form) form.reset();
            PtkEditor.reset();
            PtkFileUpload.resetDisplay();
        }
    };

    /* =========================================================
    PTK FORM SUBMIT — HANDLER SENDIRI, TIDAK PAKAI ajax-form.js
    ========================================================= */
    document.addEventListener('DOMContentLoaded', () => {

        // File upload init
        PtkFileUpload.init();

        // Submit handler
        const ptkForm = document.getElementById('ptkForm');
        if (!ptkForm) return;

        ptkForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Sync rich text ke hidden sebelum serialize
            PtkEditor.syncAll();

            const submitBtn = document.getElementById('ptkSubmitBtn');
            const originalHtml = submitBtn?.innerHTML;

            // Loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `<svg class="animate-spin h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...`;
            }

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                const formData  = new FormData(ptkForm);

                const response = await fetch(ptkForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken.content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Toast
                    if (window.toast) window.toast.success(data.message);

                    // ✅ Update Alpine data langsung — tidak perlu refresh server
                    window.dispatchEvent(new CustomEvent('ptk-updated', { detail: data.data }));

                    // Tutup modal
                    PtkModal.close();

                } else if (data.errors) {
                    // Validasi error
                    if (window.toast) window.toast.error(data.message || 'Validasi gagal');
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const input = ptkForm.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('border-red-500');
                            const err = document.createElement('div');
                            err.className = 'text-red-500 text-xs mt-1';
                            err.textContent = messages[0];
                            input.parentNode.appendChild(err);
                        }
                    });
                } else {
                    if (window.toast) window.toast.error(data.message || 'Terjadi kesalahan');
                }

            } catch (err) {
                console.error('[PTK Submit Error]', err);
                if (window.toast) window.toast.error('Terjadi kesalahan pada server');
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;
                }
            }
        });
    });

    /* =========================================================
    GLOBAL FUNCTIONS
    ========================================================= */
    function closePtkModal() { PtkModal.close(); }
    function openPtkModal(ptk) { PtkModal.open(ptk); }

    // Listen event dari Alpine (dispatch 'open-ptk-modal')
    window.addEventListener('open-ptk-modal', (e) => {
        if (e.detail) PtkModal.open(e.detail);
    });
</script> -->