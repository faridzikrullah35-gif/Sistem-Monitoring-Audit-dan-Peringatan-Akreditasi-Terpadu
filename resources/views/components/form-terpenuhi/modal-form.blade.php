<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data Terpenuhi
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalFormTerpenuhi()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form
            id="formTerpenuhi"
            action="{{ route('form-terpenuhi.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#terpenuhiTableContainer"
        >
            @csrf
            <input type="hidden" id="terpenuhiId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethod" value="POST" />

            <div class="space-y-4 px-6 py-5">

                {{-- Kriteria + Elemen --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    {{-- Kriteria --}}
                    <div>
                        <label for="kriteria" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kriteria <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="kriteria"
                            name="kriteria_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Pilih Kriteria</option>
                            @foreach ($kriteriaList as $kriteria)
                                <option value="{{ $kriteria->id }}">
                                    {{ $kriteria->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Elemen --}}
                    <div>
                        <label for="elemen" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Elemen <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="elemen"
                            name="matrixs_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Pilih Elemen</option>
                        </select>
                    </div>
                </div>

                {{-- Indikator --}}
                <div>
                    <label for="indikator" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pilih Indikator <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="indikator"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected>Pilih Indikator</option>
                    </select>
                    <input type="hidden" id="isiIndikatorId" name="isi_indikator_id" value="" />
                    <input type="hidden" id="prodiInput" name="pertanyaan_ami_prodi_id" value="" />
                    <input type="hidden" id="unitInput" name="pertanyaan_ami_unit_id" value="" />
                </div>

                {{-- Discussed with (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Discussed with <span class="text-red-500">*</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-gray-800/50">
                            <!-- Tombol toolbar - warna sudah adaptif -->
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Bold"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Italic"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Underline"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg></button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Bullet List"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Numbered List"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg></button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Align Left"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Align Center"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('discussed', 'justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Align Right"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg></button>
                        </div>
                        <div
                            id="discussedWithEditor"
                            contenteditable="true"
                            data-placeholder="Siapa yang mendiskusikan? (bisa di-format)"
                            class="min-h-[80px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300 dark:bg-gray-900"
                        ></div>
                    </div>
                    <input type="hidden" name="discussed_with" id="discussedWithHidden" value="" />
                </div>

                {{-- Recommendations (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Recommendations and Improvement Suggestions <span class="text-red-500">*</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-gray-800/50">
                            <!-- toolbar sama seperti di atas, gunakan class dark: -->
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Bold"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6zM6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Italic"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M10 4h4m-2 0v16m-4 0h8"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Underline"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14"/></svg></button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Bullet List"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Numbered List"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z"/></svg></button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Align Left"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Align Center"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg></button>
                            <button type="button" onclick="execTerpenuhiCmd('recommendations', 'justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200" title="Align Right"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg></button>
                        </div>
                        <div
                            id="recommendationsEditor"
                            contenteditable="true"
                            data-placeholder="Masukkan rekomendasi dan saran perbaikan..."
                            class="min-h-[120px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300 dark:bg-gray-900"
                        ></div>
                    </div>
                    <input type="hidden" name="rekomendasi" id="recommendationsHidden" value="" />
                </div>
            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalFormTerpenuhi()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    #discussedWithEditor ul, #discussedWithEditor ol,
    #recommendationsEditor ul, #recommendationsEditor ol {
        margin: 0.5em 0;
        padding-left: 1.5em;
    }
    #discussedWithEditor ul, #recommendationsEditor ul {
        list-style-type: disc;
    }
    #discussedWithEditor ol, #recommendationsEditor ol {
        list-style-type: decimal;
    }
    #discussedWithEditor li, #recommendationsEditor li {
        margin: 0.25em 0;
    }
    [contenteditable][data-placeholder]:empty:before {
        content: attr(data-placeholder);
        color: #9ca3af;
    }
    .dark [contenteditable][data-placeholder]:empty:before {
        color: #6b7280;
    }
</style>

<script>
    const matrixsTerpenuhi = @json($matrixs);
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const kriteriaSelect = document.getElementById('kriteria');
        const elemenSelect = document.getElementById('elemen');
        const indikatorSelect = document.getElementById('indikator');
        const formTerpenuhi = document.getElementById('formTerpenuhi');
        if (formTerpenuhi) {
            formTerpenuhi.addEventListener('submit', () => {
                TerpenuhiEditor.syncToHidden();
            }, true);
        }

        kriteriaSelect.addEventListener('change', function () {
            const kriteriaId = this.value;
            elemenSelect.innerHTML = '<option value="" disabled selected>Pilih Elemen</option>';
            indikatorSelect.innerHTML = '<option value="" disabled selected>Pilih Indikator</option>';
            const filteredMatrix = matrixsTerpenuhi.filter(item => {
                return item.kriteria_audit &&
                    item.kriteria_audit.standar &&
                    item.kriteria_audit.standar.id == kriteriaId;
            });
            filteredMatrix.forEach(item => {
                elemenSelect.innerHTML += `<option value="${item.id}">${item.elemen}</option>`;
            });
        });

        elemenSelect.addEventListener('change', function () {
            const matrixId = this.value;
            indikatorSelect.innerHTML = '<option value="" disabled selected>Pilih Indikator</option>';
            const selectedMatrix = matrixsTerpenuhi.find(item => item.id == matrixId);
            if (selectedMatrix?.isi_indikator?.length > 0) {
                selectedMatrix.isi_indikator.forEach(item => {
                    if (item.pertanyaan_ami_prodi?.length > 0) {
                        const p = item.pertanyaan_ami_prodi[0];
                        indikatorSelect.innerHTML += `
                            <option 
                                value="${p.id}" 
                                data-type="prodi"
                                data-isi_indikator_id="${item.id}"
                            >
                                ${item.indikator}
                            </option>
                        `;
                    }
                    if (item.pertanyaan_ami_unit?.length > 0) {
                        const u = item.pertanyaan_ami_unit[0];
                        indikatorSelect.innerHTML += `
                            <option 
                                value="${u.id}" 
                                data-type="unit"
                                data-isi_indikator_id="${item.id}"
                            >
                                ${item.indikator}
                            </option>
                        `;
                    }
                });
            }
        });

        if (indikatorSelect) {
            indikatorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const isiIndikatorId = selectedOption.dataset.isi_indikator_id;
                const type = selectedOption.dataset.type;
                const value = selectedOption.value;

                const hiddenField = document.getElementById('isiIndikatorId');
                if (hiddenField) hiddenField.value = isiIndikatorId;

                const prodiInput = document.getElementById('prodiInput');
                const unitInput = document.getElementById('unitInput');
                if (type === 'unit') {
                    if (unitInput) unitInput.value = value;
                    if (prodiInput) prodiInput.value = '';
                } else {
                    if (prodiInput) prodiInput.value = value;
                    if (unitInput) unitInput.value = '';
                }
            });
        }
    });
</script>

<script>
    const TerpenuhiEditor = {
        getEditor(id) {
            return document.getElementById(id === 'discussed' ? 'discussedWithEditor' : 'recommendationsEditor');
        },
        execCommand(editorId, command) {
            const editor = this.getEditor(editorId);
            if (!editor) return;
            editor.focus();
            const selection = window.getSelection();
            if (selection.rangeCount === 0) {
                const range = document.createRange();
                range.selectNodeContents(editor);
                range.collapse(false);
                selection.removeAllRanges();
                selection.addRange(range);
            }
            document.execCommand(command, false, null);
            editor.dispatchEvent(new Event('input', { bubbles: true }));
        },
        syncToHidden() {
            document.getElementById('discussedWithHidden').value = document.getElementById('discussedWithEditor').innerHTML;
            document.getElementById('recommendationsHidden').value = document.getElementById('recommendationsEditor').innerHTML;
        },
        reset() {
            document.getElementById('discussedWithEditor').innerHTML = '';
            document.getElementById('recommendationsEditor').innerHTML = '';
            this.syncToHidden();
        }
    };

    const TerpenuhiModal = {
        open(id = null) {
            const modal = document.getElementById('userModal');
            const title = document.getElementById('modalFormTitle');
            const hiddenId = document.getElementById('terpenuhiId');
            const form = document.getElementById('formTerpenuhi');
            this.resetForm();
            if (id) {
                title.textContent = 'Ubah Data Terpenuhi';
                hiddenId.value = id;
                form.action = `/auditor/form-terpenuhi/${id}`;
                this.ensureMethod(form, 'PUT');
                this.loadEditData(id);
            } else {
                title.textContent = 'Tambah Data Terpenuhi';
                hiddenId.value = '';
                form.action = "{{ route('form-terpenuhi.store') }}";
                this.removeMethod(form);
            }
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        },
        close() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            this.resetForm();
        },
        resetForm() {
            document.getElementById('kriteria').selectedIndex = 0;
            document.getElementById('elemen').innerHTML = '<option value="" disabled selected>Pilih Elemen</option>';
            document.getElementById('indikator').innerHTML = '<option value="" disabled selected>Pilih Indikator</option>';
            document.getElementById('isiIndikatorId').value = '';
            TerpenuhiEditor.reset();
        },
        ensureMethod(form, method) {
            let input = form.querySelector('input[name="_method"]');
            if (!input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_method';
                form.appendChild(input);
            }
            input.value = method;
        },
        removeMethod(form) {
            const input = form.querySelector('input[name="_method"]');
            if (input) input.remove();
        },
        async loadEditData(id) {
            try {
                const res = await fetch(`/auditor/form-terpenuhi/${id}/edit`, {
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });

                const json = await res.json();

                if (!res.ok) throw new Error(json.message || json.error || 'Gagal load data');

                const { data } = json;

                // STEP 1 - kriteria
                const kriteriaSelect = document.getElementById('kriteria');
                kriteriaSelect.value = data.kriteria_id;
                kriteriaSelect.dispatchEvent(new Event('change'));

                await new Promise(r => setTimeout(r, 150));

                // STEP 2 - elemen
                const elemenSelect = document.getElementById('elemen');
                elemenSelect.value = data.matrixs_id;
                elemenSelect.dispatchEvent(new Event('change'));

                await new Promise(r => setTimeout(r, 200));

                // STEP 3 - indikator
                const indikatorSelect = document.getElementById('indikator');

                [...indikatorSelect.options].forEach(opt => {
                    if (opt.value == data.selected_indikator_id) {
                        opt.selected = true;
                    }
                });

                indikatorSelect.dispatchEvent(new Event('change'));

                // STEP 4 - rich text
                document.getElementById('discussedWithEditor').innerHTML =
                    data.discussed_with || '';
                document.getElementById('recommendationsEditor').innerHTML =
                    data.rekomendasi || '';

                TerpenuhiEditor.syncToHidden();

            } catch (err) {
                console.error(err);
                alert('Gagal mengambil data terpenuhi');
            }
        }
    };

    function openModalFormTerpenuhi(id = null) { TerpenuhiModal.open(id); }
    function closeModalFormTerpenuhi() { TerpenuhiModal.close(); }
    function execTerpenuhiCmd(editorId, command) { TerpenuhiEditor.execCommand(editorId, command); }
    function syncTerpenuhiEditors() { TerpenuhiEditor.syncToHidden(); }
</script>