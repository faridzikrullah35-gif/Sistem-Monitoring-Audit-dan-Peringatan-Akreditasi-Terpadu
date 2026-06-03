<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8"
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
                    Tambah Data
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalFormPeriksa('userModal')"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form id="formPeriksa"
            action="{{ route('form-daftar-periksa.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#formPeriksaTableContainer">

            @csrf

            @method('POST')

            <input type="hidden" id="periksaId" name="id" value="" />

            <div class="space-y-5 px-6 py-5">

                {{-- Baris: Pilih Kriteria + Elemen + Indikator --}}
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

                    {{-- Pilih Kriteria --}}
                    <div>
                        <label for="kriteria"
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Kriteria <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="kriteria"
                            name="kriteria_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>
                                Pilih Kriteria
                            </option>

                            @foreach ($kriteriaList as $kriteria)
                                <option value="{{ $kriteria->id }}">
                                    {{ $kriteria->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Elemen --}}
                    <div>
                        <label for="elemen"
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Elemen <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="elemen"
                            name="matrixs_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>
                                Pilih Elemen
                            </option>
                        </select>
                    </div>

                    {{-- Pilih Indikator --}}
                    <div>
                        <label for="indikator"
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Indikator <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="indikator"
                            name="isi_indikator_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>
                                Pilih Indikator
                            </option>
                        </select>
                    </div>

                </div>

                {{-- Field: Deskripsi / Uraian Temuan --}}
                <div>
                    <label for="uraian_temuan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Deskripsi / Uraian Temuan <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="uraian_temuan"
                        name="uraian_temuan"
                        rows="3"
                        placeholder="Masukkan deskripsi atau uraian temuan"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    ></textarea>
                </div>

                {{-- Field: Analisis Penyebab --}}
                <div>
                    <label for="analisis_penyebab" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Analisis Penyebab <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="analisis_penyebab"
                        name="analisis_penyebab"
                        rows="3"
                        placeholder="Masukkan analisis penyebab"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    ></textarea>
                </div>

                {{-- Field: Akibat --}}
                <div>
                    <label for="akibat" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Akibat <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="akibat"
                        name="akibat"
                        rows="3"
                        placeholder="Masukkan akibat dari temuan"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    ></textarea>
                </div>

                {{-- Pilih Score --}}
                <div>
                    <label for="score"
                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pilih Score <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="score"
                        name="setting_score_id"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected>
                            Pilih Score
                        </option>

                        @foreach ($settingScores as $score)
                            <option value="{{ $score->id }}">
                                {{ $score->nilai_score }} - {{ $score->keterangan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Field: Panduan Pengisian (Rich Text Editor) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Panduan Pengisian <span class="text-red-500">*(Opsional. Boleh Di Isi atau Tidak Di Isi)</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        {{-- Toolbar --}}
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                            <button type="button" onclick="execCmd('bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Bold">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z" /></svg>
                            </button>
                            <button type="button" onclick="execCmd('italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Italic">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10 4h4m-2 0v16m-4 0h8" /></svg>
                            </button>
                            <button type="button" onclick="execCmd('underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Underline">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14" /></svg>
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>

                            <button type="button" onclick="execCmd('insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Bullet List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                            </button>
                            <button type="button" onclick="execCmd('insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Numbered List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z" /></svg>
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>

                            <button type="button" onclick="execCmd('justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Align Left">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" /></svg>
                            </button>
                            <button type="button" onclick="execCmd('justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Align Center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                            </button>
                            <button type="button" onclick="execCmd('justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Align Right">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                            </button>
                        </div>

                        {{-- Content Editable Area --}}
                        <div
                            id="panduanEditor"
                            contenteditable="true"
                            data-placeholder="Tulis panduan pengisian di sini..."
                            class="min-h-[140px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300 empty:before:text-gray-400 empty:before:dark:text-gray-500"
                            style="empty:before:content: attr(data-placeholder);"
                        ></div>
                    </div>
                    <input type="hidden" name="panduan_pengisian" id="panduanHidden" value="" />
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalFormPeriksa('userModal')"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    onclick="syncEditorToHidden()"
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
    /* Untuk editor panduan pengisian */
    #panduanEditor ul, #panduanEditor ol {
        margin: 0.5em 0;
        padding-left: 1.5em;
    }
    #panduanEditor ul {
        list-style-type: disc;
    }
    #panduanEditor ol {
        list-style-type: decimal;
    }
    #panduanEditor li {
        margin: 0.25em 0;
    }
</style>

<script>
    const matrixs = @json($matrixs);
    console.log(matrixs);
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const kriteriaSelect = document.getElementById('kriteria');
        const elemenSelect = document.getElementById('elemen');
        const indikatorSelect = document.getElementById('indikator');

        // pilih kriteria
        kriteriaSelect.addEventListener('change', function () {

            const kriteriaId = this.value;

            elemenSelect.innerHTML =
                `<option value="" disabled selected>
                    Pilih Elemen
                </option>`;

            indikatorSelect.innerHTML =
                `<option value="" disabled selected>
                    Pilih Indikator
                </option>`;

            const filteredMatrix = matrixs.filter(item => {

                return item.kriteria_audit &&
                    item.kriteria_audit.standar &&
                    item.kriteria_audit.standar.id == kriteriaId;
            });

            filteredMatrix.forEach(item => {

                elemenSelect.innerHTML += `
                    <option value="${item.id}">
                        ${item.elemen}
                    </option>
                `;
            });
        });

        // pilih elemen
        elemenSelect.addEventListener('change', function () {

            const matrixId = this.value;

            indikatorSelect.innerHTML =
                `<option value="" disabled selected>
                    Pilih Indikator
                </option>`;

            const selectedMatrix = matrixs.find(item =>
                item.id == matrixId
            );

            console.log(selectedMatrix);

            if (
                selectedMatrix &&
                selectedMatrix.isi_indikator &&
                selectedMatrix.isi_indikator.length > 0
            ) {

                selectedMatrix.isi_indikator.forEach(item => {

                    indikatorSelect.innerHTML += `
                        <option value="${item.id}">
                            ${item.indikator}
                        </option>
                    `;
                });
            }
        });

    });
</script>

<script>
    function execCmd(command) {
        const editor = document.getElementById('panduanEditor');
        if (!editor) return;

        // Fokuskan editor
        editor.focus();

        // Pastikan ada selection (range) agar perintah execCommand bekerja
        let selection = window.getSelection();
        if (selection.rangeCount === 0) {
            let range = document.createRange();
            range.selectNodeContents(editor);
            range.collapse(false); // letakkan kursor di akhir
            selection.removeAllRanges();
            selection.addRange(range);
        }

        try {
            document.execCommand(command, false, null);
        } catch (e) {
            console.error('ExecCommand error:', e);
            // Fallback untuk list jika perintah gagal (opsional)
            if (command === 'insertUnorderedList') {
                document.execCommand('insertHTML', false, '<ul><li>Item baru</li></ul>');
            } else if (command === 'insertOrderedList') {
                document.execCommand('insertHTML', false, '<ol><li>Item baru</li></ol>');
            }
        }

        // Trigger event input (jika diperlukan untuk sinkronisasi)
        editor.dispatchEvent(new Event('input', { bubbles: true }));
    }

    function cleanEditorHtml(html) {
        const div = document.createElement('div');
        div.innerHTML = html;

        // hapus semua atribut aneh
        div.querySelectorAll('*').forEach(el => {

            [...el.attributes].forEach(attr => {
                if (
                    attr.name.startsWith('data-') ||
                    attr.name.startsWith('style') // optional kalau mau bersihin total
                ) {
                    el.removeAttribute(attr.name);
                }
            });

            // optional: buang empty <i> dari editor junk
            if (el.tagName === 'I' && el.attributes.length > 0) {
                el.replaceWith(...el.childNodes);
            }
        });

        return div.innerHTML;
    }

    function syncEditorToHidden() {
        const editor = document.getElementById('panduanEditor');
        const hidden = document.getElementById('panduanHidden');

        hidden.value = cleanEditorHtml(editor.innerHTML);
    }

    function openModalFormPeriksa(id = null, rowData = null) {
        const modal = document.getElementById('userModal');
        const title = document.getElementById('modalFormTitle');
        const kriteriaSelect = document.getElementById('kriteria');
        const elemenSelect = document.getElementById('elemen');
        const indikatorSelect = document.getElementById('indikator');
        const hiddenId = document.getElementById('periksaId');
        const editor = document.getElementById('panduanEditor');
        const form = document.getElementById('formPeriksa');

        // =====================
        // MODE EDIT
        // =====================
        if (id && id !== 'null') {

            title.textContent = 'Edit Data';
            hiddenId.value = id;

            // =========================
            // 1. INSTANT FILL (DARI ROW)
            // =========================
            if (rowData) {

                // TEXT FIELD
                document.getElementById('uraian_temuan').value = rowData.uraian_temuan ?? '';
                document.getElementById('analisis_penyebab').value = rowData.analisis_penyebab ?? '';
                document.getElementById('akibat').value = rowData.akibat ?? '';
                document.getElementById('score').value = rowData.setting_score_id ?? '';

                editor.innerHTML = cleanEditorHtml(rowData.panduan_pengisian ?? '');

                // =========================
                // DROPDOWN (INI YANG KAMU MAU)
                // =========================

                // 1. Kriteria
                if (kriteriaSelect && rowData.kriteria_id) {
                    kriteriaSelect.value = rowData.kriteria_id;
                    triggerEvent(kriteriaSelect, 'change');
                }

                // 2. Elemen (nunggu dependent load)
                setTimeout(() => {
                    if (elemenSelect && rowData.matrixs_id) {
                        elemenSelect.value = rowData.matrixs_id;
                        triggerEvent(elemenSelect, 'change');
                    }

                    // 3. Indikator (paling dalam)
                    setTimeout(() => {
                        if (indikatorSelect && rowData.isi_indikator_id) {
                            indikatorSelect.value = rowData.isi_indikator_id;
                        }
                    }, 150);

                }, 150);
            }

            // =========================
            // 2. OPTIONAL: FETCH DETAIL (kalau mau lengkap relasi)
            // =========================
            fetch(`/auditor/form-daftar-periksa/${id}/edit`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {

                if (!data.success) return;

                const item = data.data;

                // AUTO DETECT (PRODI / UNIT)
                const pertanyaan =
                    item.pertanyaan_ami_prodi
                    ?? item.pertanyaan_ami_unit;

                // relasi aman
                const indikator = pertanyaan?.isi_indikator;
                const matrix = indikator?.matrix;
                const kriteria = matrix?.kriteria_audit?.standar;

                // text field
                document.getElementById('uraian_temuan').value =
                    item.uraian_temuan ?? '';

                document.getElementById('analisis_penyebab').value =
                    item.analisis_penyebab ?? '';

                document.getElementById('akibat').value =
                    item.akibat ?? '';

                document.getElementById('score').value =
                    item.setting_score_id ?? '';

                editor.innerHTML =
                    cleanEditorHtml(item.panduan_pengisian ?? '');

                // =========================
                // AUTO SELECT DROPDOWN
                // =========================

                // 1. kriteria
                if (kriteria?.id) {

                    document.getElementById('kriteria').value =
                        kriteria.id;

                    triggerEvent(
                        document.getElementById('kriteria'),
                        'change'
                    );
                }

                // 2. elemen
                setTimeout(() => {

                    if (matrix?.id) {

                        document.getElementById('elemen').value =
                            matrix.id;

                        triggerEvent(
                            document.getElementById('elemen'),
                            'change'
                        );
                    }

                    // 3. indikator
                    setTimeout(() => {

                        if (indikator?.id) {

                            document.getElementById('indikator').value =
                                indikator.id;
                        }

                    }, 150);

                }, 150);
            });

            form.action = `/auditor/form-daftar-periksa/${id}`;
            const methodField = document.querySelector('input[name="_method"]');
            if (methodField) methodField.value = 'PUT';
        }
        // =====================
        // MODE CREATE
        // =====================
        else {

            title.textContent = 'Tambah Data';

            hiddenId.value = '';
            form.action = "{{ route('form-daftar-periksa.store') }}";

            const methodField = document.querySelector('input[name="_method"]');
            if (methodField) methodField.value = 'POST';

            document.getElementById('kriteria').selectedIndex = 0;
            document.getElementById('elemen').innerHTML = '<option value="" disabled selected>Pilih Elemen</option>';
            document.getElementById('indikator').innerHTML = '<option value="" disabled selected>Pilih Indikator</option>';

            document.getElementById('uraian_temuan').value = '';
            document.getElementById('analisis_penyebab').value = '';
            document.getElementById('akibat').value = '';
            document.getElementById('score').selectedIndex = 0;

            editor.innerHTML = '';
        }

        // show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModalFormPeriksa() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function triggerEvent(element, eventName) {
        if (!element) return;

        element.dispatchEvent(
            new Event(eventName, {
                bubbles: true,
                cancelable: true
            })
        );
    }
</script>