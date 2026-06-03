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
                    Tambah Data
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalFormNCR()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form
            id="formNCR"
            action="{{ route('form-ketidaksesuaian-ncr.store') }}"
            method="POST"
            enctype="multipart/form-data"
            data-ajax="1"
            data-table-id="#tableNCRContainer"
        >

            @csrf
        
            @method('POST')
        
            <input type="hidden" id="ncrId" name="id" value="" />

            <div class="space-y-4 px-6 py-5">

                {{-- Baris 1: No. NCR --}}
                <div>
                    <label for="noNcr" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        No. NCR <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="noNcr"
                        name="no_ncr"
                        placeholder="Contoh: NCR-001/2025"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Baris 2: Kriteria + Elemen --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    {{-- Kriteria --}}
                    <div>
                        <label for="kriteria"
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kriteria <span class="text-red-500">*</span>
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

                    {{-- Elemen --}}
                    <div>
                        <label for="elemen"
                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Elemen <span class="text-red-500">*</span>
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

                </div>

                {{-- Baris 3: Indikator --}}
                <div>
                    <label for="indikator"
                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pilih Indikator <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="indikator"
                        name="pertanyaan_ami_prodi_id"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected>
                            Pilih Indikator
                        </option>
                    </select>

                    <input type="hidden" id="isiIndikatorId" name="isi_indikator_id" value="" />

                </div>

                {{-- Baris 4: Klausul/Dokumen --}}
                <div>
                    <label for="klausul" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Klausul/Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="klausul"
                        name="klausul_dokumen"
                        placeholder="Masukkan klausul atau dokumen referensi"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Baris 5: Deskripsi Uraian Temuan (Rich Text) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Deskripsi Uraian Temuan <span class="text-red-500">*</span>
                    </label>
                    <div class="overflow-hidden rounded-lg border border-gray-300 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-0.5 border-b border-gray-200 bg-gray-50 px-2 py-1.5 dark:border-gray-700 dark:bg-white/[0.02]">
                            <button type="button" onclick="execNcrCmd('bold')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Bold">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z" /></svg>
                            </button>
                            <button type="button" onclick="execNcrCmd('italic')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Italic">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10 4h4m-2 0v16m-4 0h8" /></svg>
                            </button>
                            <button type="button" onclick="execNcrCmd('underline')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Underline">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4v7a5 5 0 0 0 10 0V4M5 20h14" /></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execNcrCmd('insertUnorderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Bullet List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                            </button>
                            <button type="button" onclick="execNcrCmd('insertOrderedList')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Numbered List">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm0 5.25h.008v.008H3.75V12Zm0 5.25h.008v.008H3.75v-.008Z" /></svg>
                            </button>
                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>
                            <button type="button" onclick="execNcrCmd('justifyLeft')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Align Left">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" /></svg>
                            </button>
                            <button type="button" onclick="execNcrCmd('justifyCenter')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Align Center">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                            </button>
                            <button type="button" onclick="execNcrCmd('justifyRight')" class="inline-flex h-7 w-7 items-center justify-center rounded text-gray-500 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:hover:bg-white/[0.08] dark:hover:text-gray-300" title="Align Right">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5" /></svg>
                            </button>
                        </div>
                        <div
                            id="ncrUraianEditor"
                            contenteditable="true"
                            data-placeholder="Tulis deskripsi uraian temuan di sini..."
                            class="min-h-[120px] px-4 py-3 text-sm text-gray-700 outline-none dark:text-gray-300"
                            style="empty:before:content: attr(data-placeholder); empty:before:text-gray-400; empty:before:dark:text-gray-500;"
                        ></div>
                    </div>
                    <input type="hidden" name="deskripsi_uraian_temuan" id="ncrUraianHidden" value="" />
                </div>

                {{-- Baris 6: Kategori Temuan + Tanggal Selesai (FLATPICKR) --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="kategoriTemuan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kategori Temuan <span class="text-red-500">*</span>
                        </label>
                        <select id="kategoriTemuan" name="kategori_temuan" required class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                            <option value="" disabled selected>
                                Pilih Kategori
                            </option>
                                @foreach($kategoriTemuan as $item)
                                    <option value="{{ $item->keterangan }}">
                                        {{ $item->keterangan }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tanggalSelesai" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Selesai
                        </label>
                        <div class="relative">
                            {{-- Icon Calendar --}}
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="tanggalSelesai"
                                name="tanggal_selesai"
                                placeholder="Pilih tanggal"
                                class="datepicker w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-3.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                            />
                        </div>
                    </div>
                </div>

                {{-- Baris 7: Status Open/Close --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Status
                    </label>

                    <div class="flex gap-4">

                        {{-- OPEN --}}
                        <label class="flex cursor-pointer items-center gap-2">

                            <input
                                type="radio"
                                name="status_ncr"
                                value="Open"
                                class="peer sr-only"
                                checked
                            />

                            <div
                                class="relative h-5 w-9 rounded-full bg-gray-300 transition-all duration-200
                                    after:absolute after:left-[2px] after:top-[2px]
                                    after:h-4 after:w-4 after:rounded-full
                                    after:bg-white after:shadow-sm after:transition-all after:duration-200
                                    peer-checked:bg-emerald-500 peer-checked:after:translate-x-4
                                    dark:bg-gray-600 dark:peer-checked:bg-emerald-500"
                            ></div>

                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Open
                            </span>

                        </label>


                        {{-- CLOSE --}}
                        <label class="flex cursor-pointer items-center gap-2">

                            <input
                                type="radio"
                                name="status_ncr"
                                value="Close"
                                class="peer sr-only"
                            />

                            <div
                                class="relative h-5 w-9 rounded-full bg-gray-300 transition-all duration-200
                                    after:absolute after:left-[2px] after:top-[2px]
                                    after:h-4 after:w-4 after:rounded-full
                                    after:bg-white after:shadow-sm after:transition-all after:duration-200
                                    peer-checked:bg-red-500 peer-checked:after:translate-x-4
                                    dark:bg-gray-600 dark:peer-checked:bg-red-500"
                            ></div>

                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Close
                            </span>

                        </label>

                    </div>
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalFormNCR()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    onclick="syncNcrEditorToHidden()"
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
    /* Untuk editor deskripsi uraian temuan (NCR) */
    #ncrUraianEditor ul, #ncrUraianEditor ol {
        margin: 0.5em 0;
        padding-left: 1.5em;
    }
    #ncrUraianEditor ul {
        list-style-type: disc;
    }
    #ncrUraianEditor ol {
        list-style-type: decimal;
    }
    #ncrUraianEditor li {
        margin: 0.25em 0;
    }
</style>

<script>
    const matrixs = @json($matrixs);
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const kriteriaSelect = document.getElementById('kriteria');
    const elemenSelect = document.getElementById('elemen');
    const indikatorSelect = document.getElementById('indikator');

    // =========================
    // PILIH KRITERIA
    // =========================
    kriteriaSelect.addEventListener('change', function () {

        const kriteriaId = this.value;

        elemenSelect.innerHTML = `
            <option value="" disabled selected>
                Pilih Elemen
            </option>
        `;

        indikatorSelect.innerHTML = `
            <option value="" disabled selected>
                Pilih Indikator
            </option>
        `;

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

    // =========================
    // PILIH ELEMEN
    // =========================
    elemenSelect.addEventListener('change', function () {
        const matrixId = this.value;
        
        indikatorSelect.innerHTML = `<option value="" disabled selected>Pilih Indikator</option>`;
        
        const selectedMatrix = matrixs.find(item => item.id == matrixId);
        
        if (selectedMatrix?.isi_indikator?.length > 0) {
            selectedMatrix.isi_indikator.forEach(item => {
                let pertanyaanAmiProdiId = null;
                if (item.pertanyaan_ami_prodi?.length > 0) {
                    pertanyaanAmiProdiId = item.pertanyaan_ami_prodi[0].id;
                }
                
                indikatorSelect.innerHTML += `
                    <option 
                        value="${pertanyaanAmiProdiId}" 
                        data-isi_indikator_id="${item.id}"
                    >
                        ${item.indikator}
                    </option>
                `;
            });
        }
    });

    // =========================
    // KETIKA INDIKATOR BERUBAH
    // =========================
    if (indikatorSelect) {
        indikatorSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const isiIndikatorId = selectedOption.getAttribute('data-isi_indikator_id');
            
            const hiddenField = document.getElementById('isiIndikatorId');
            if (hiddenField) {
                hiddenField.value = isiIndikatorId;
            }
        });
    }

});
</script>

<script>
    // ==========================================
    // GLOBAL VARIABLES
    // ==========================================
    let ncrFlatpickr = null;
    let isEditMode = false;
    let editDataCache = null;

    // ==========================================
    // RICH TEXT EDITOR FUNCTIONS (PERBAIKAN)
    // ==========================================
    function execNcrCmd(command) {
        const editor = document.getElementById('ncrUraianEditor');
        if (!editor) return;

        // Fokus ke editor
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

        // Trigger input event (opsional, untuk sinkronisasi)
        editor.dispatchEvent(new Event('input', { bubbles: true }));
    }

    function syncNcrEditorToHidden() {
        const editor = document.getElementById('ncrUraianEditor');
        const hidden = document.getElementById('ncrUraianHidden');
        if (editor && hidden) {
            hidden.value = editor.innerHTML;
        }
    }

    // ==========================================
    // RESET FORM FUNCTION
    // ==========================================
    function resetNCRForm() {
        const textFields = ['noNcr', 'klausul', 'isiIndikatorId'];
        textFields.forEach(fieldId => {
            const el = document.getElementById(fieldId);
            if (el) el.value = '';
        });

        const selects = ['kriteria', 'elemen', 'indikator', 'kategoriTemuan'];
        selects.forEach(selectId => {
            const el = document.getElementById(selectId);
            if (el && el.options && el.options.length > 0) {
                el.selectedIndex = 0;
                const changeEvent = new Event('change', { bubbles: true });
                el.dispatchEvent(changeEvent);
            }
        });

        const editor = document.getElementById('ncrUraianEditor');
        if (editor) editor.innerHTML = '';
        
        const hiddenUraian = document.getElementById('ncrUraianHidden');
        if (hiddenUraian) hiddenUraian.value = '';

        const openRadio = document.querySelector('input[name="status_ncr"][value="Open"]');
        if (openRadio) openRadio.checked = true;

        if (ncrFlatpickr) ncrFlatpickr.clear();

        const ncrId = document.getElementById('ncrId');
        if (ncrId) ncrId.value = '';
    }

    // ==========================================
    // LOAD ELEMEN BASED ON KRITERIA
    // ==========================================
    function loadElemenByKriteria(kriteriaId, selectedElemenId = null) {
        const elemenSelect = document.getElementById('elemen');
        if (!elemenSelect) return Promise.reject('Elemen select not found');

        return new Promise((resolve) => {
            elemenSelect.innerHTML = '<option value="" disabled selected>Pilih Elemen</option>';
            
            if (!kriteriaId) {
                resolve(null);
                return;
            }

            const filteredMatrix = matrixs.filter(item => {
                return item.kriteria_audit &&
                       item.kriteria_audit.standar &&
                       item.kriteria_audit.standar.id == kriteriaId;
            });

            filteredMatrix.forEach(item => {
                elemenSelect.innerHTML += `<option value="${item.id}">${item.elemen}</option>`;
            });

            if (selectedElemenId && filteredMatrix.some(item => item.id == selectedElemenId)) {
                elemenSelect.value = selectedElemenId;
                const changeEvent = new Event('change', { bubbles: true });
                elemenSelect.dispatchEvent(changeEvent);
                resolve(selectedElemenId);
            } else {
                resolve(null);
            }
        });
    }

    // ==========================================
    // LOAD INDIKATOR BASED ON ELEMEN
    // ==========================================
    function loadIndikatorByElemen(elemenId, selectedPertanyaanId = null, selectedIsiIndikatorId = null) {
        const indikatorSelect = document.getElementById('indikator');
        if (!indikatorSelect) return Promise.reject('Indikator select not found');

        return new Promise((resolve) => {
            indikatorSelect.innerHTML = '<option value="" disabled selected>Pilih Indikator</option>';
            
            if (!elemenId) {
                resolve(null);
                return;
            }

            const selectedMatrix = matrixs.find(item => item.id == elemenId);

            if (selectedMatrix && selectedMatrix.isi_indikator && selectedMatrix.isi_indikator.length > 0) {
                selectedMatrix.isi_indikator.forEach(item => {
                    let pertanyaanAmiProdiId = null;
                    if (item.pertanyaan_ami_prodi && item.pertanyaan_ami_prodi.length > 0) {
                        pertanyaanAmiProdiId = item.pertanyaan_ami_prodi[0].id;
                    }
                    
                    indikatorSelect.innerHTML += `
                        <option 
                            value="${pertanyaanAmiProdiId}" 
                            data-isi_indikator_id="${item.id}"
                        >
                            ${item.indikator}
                        </option>
                    `;
                });
            }

            if (selectedPertanyaanId) {
                for (let i = 0; i < indikatorSelect.options.length; i++) {
                    if (indikatorSelect.options[i].value == selectedPertanyaanId) {
                        indikatorSelect.selectedIndex = i;
                        break;
                    }
                }
                
                const hiddenField = document.getElementById('isiIndikatorId');
                if (hiddenField && selectedIsiIndikatorId) {
                    hiddenField.value = selectedIsiIndikatorId;
                }
                
                resolve(selectedPertanyaanId);
            } else {
                resolve(null);
            }
        });
    }

    // ==========================================
    // LOAD ALL DATA FOR EDIT MODE
    // ==========================================
    async function loadEditDataToForm(id) {
        try {
            const response = await fetch(`/auditor/form-ketidaksesuaian-ncr/${id}/edit`);
            if (!response.ok) throw new Error('Network response was not ok');
            const result = await response.json();
            const data = result.data;
            
            const noNcrInput = document.getElementById('noNcr');
            if (noNcrInput) noNcrInput.value = data.no_ncr ?? '';
            
            const klausulInput = document.getElementById('klausul');
            if (klausulInput) klausulInput.value = data.klausul_dokumen ?? '';
            
            const isiIndikatorIdField = document.getElementById('isiIndikatorId');
            if (isiIndikatorIdField) isiIndikatorIdField.value = data.isi_indikator_id ?? '';
            
            const kategoriSelect = document.getElementById('kategoriTemuan');
            if (kategoriSelect && data.kategori_temuan) {
                kategoriSelect.value = data.kategori_temuan;
            }
            
            if (data.status_ncr) {
                const radio = document.querySelector(`input[name="status_ncr"][value="${data.status_ncr}"]`);
                if (radio) radio.checked = true;
            }
            
            const editor = document.getElementById('ncrUraianEditor');
            if (editor) editor.innerHTML = data.deskripsi_uraian_temuan ?? '';

            const hiddenUraian = document.getElementById('ncrUraianHidden');
            if (hiddenUraian) hiddenUraian.value = data.deskripsi_uraian_temuan ?? '';

            const kriteriaSelect = document.getElementById('kriteria');
            if (kriteriaSelect && data.kriteria_id) {
                kriteriaSelect.value = data.kriteria_id;
                
                await loadElemenByKriteria(data.kriteria_id, data.matrixs_id);
                await new Promise(resolve => setTimeout(resolve, 150));
                
                if (data.matrixs_id) {
                    await loadIndikatorByElemen(
                        data.matrixs_id,
                        data.pertanyaan_ami_prodi_id ?? data.pertanyaan_ami_unit_id,
                        data.isi_indikator_id
                    );
                }
            }

            if (data.tanggal_selesai) {
                setTimeout(() => {
                    if (ncrFlatpickr) {
                        ncrFlatpickr.setDate(data.tanggal_selesai, false);
                    } else {
                        const tglInput = document.getElementById('tanggalSelesai');
                        if (tglInput) {
                            tglInput.value = data.tanggal_selesai;
                        }
                    }
                }, 200);
            }
            
        } catch (error) {
            console.error('Error fetching NCR data:', error);
            alert('Gagal mengambil data NCR.');
        }
    }

    // ==========================================
    // OPEN MODAL FUNCTION
    // ==========================================
    async function openModalFormNCR(id = null) {
        const modal = document.getElementById('userModal');
        const title = document.getElementById('modalFormTitle');
        const hiddenId = document.getElementById('ncrId');
        const form = document.getElementById('formNCR');

        document.getElementById('noNcr').value = '';
        document.getElementById('kriteria').selectedIndex = 0;
        document.getElementById('elemen').innerHTML = '<option value="" disabled selected>Pilih Elemen</option>';
        document.getElementById('indikator').innerHTML = '<option value="" disabled selected>Pilih Indikator</option>';
        document.getElementById('klausul').value = '';
        document.getElementById('ncrUraianEditor').innerHTML = '';
        document.getElementById('ncrUraianHidden').value = '';
        document.getElementById('kategoriTemuan').selectedIndex = 0;
        document.getElementById('isiIndikatorId').value = '';
        
        document.querySelectorAll('input[name="status_ncr"]').forEach(radio => {
            radio.checked = false;
        });

        if (id) {
            title.textContent = 'Ubah Data';
            hiddenId.value = id;
            
            form.action = `/auditor/form-ketidaksesuaian-ncr/${id}`;
            
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';
            
            await loadEditDataToForm(id);
            
        } else {
            title.textContent = 'Tambah Data';
            hiddenId.value = '';
            
            form.action = "{{ route('form-ketidaksesuaian-ncr.store') }}";
            
            let methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }
        }

        if (ncrFlatpickr) ncrFlatpickr.clear();

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // ==========================================
    // CLOSE MODAL FUNCTION
    // ==========================================
    function closeModalFormNCR() {
        const modal = document.getElementById('userModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        resetNCRForm();
    }

    // ==========================================
    // EVENT LISTENERS FOR DEPENDENT SELECTS
    // ==========================================
    function initDependentSelects() {
        const kriteriaSelect = document.getElementById('kriteria');
        const elemenSelect = document.getElementById('elemen');
        const indikatorSelect = document.getElementById('indikator');

        if (kriteriaSelect) {
            kriteriaSelect.addEventListener('change', async function() {
                const kriteriaId = this.value;
                await loadElemenByKriteria(kriteriaId, null);
            });
        }

        if (elemenSelect) {
            elemenSelect.addEventListener('change', async function() {
                const elemenId = this.value;
                await loadIndikatorByElemen(elemenId, null, null);
            });
        }

        if (indikatorSelect) {
            indikatorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const isiIndikatorId = selectedOption ? selectedOption.getAttribute('data-isi_indikator_id') : null;
                
                const hiddenField = document.getElementById('isiIndikatorId');
                if (hiddenField) {
                    hiddenField.value = isiIndikatorId;
                }
            });
        }
    }

    // ==========================================
    // FLATPICKR INITIALIZATION
    // ==========================================
    function initFlatpickr() {
        const tanggalInput = document.getElementById('tanggalSelesai');
        if (tanggalInput && typeof flatpickr !== 'undefined') {
            ncrFlatpickr = flatpickr("#tanggalSelesai", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d F Y",
                allowInput: true,
                disableMobile: true,
                onOpen: function(selectedDates, dateStr, instance) {
                    if (instance.calendarContainer) {
                        instance.calendarContainer.style.zIndex = '9999';
                    }
                }
            });
        }
    }

    // ==========================================
    // DOM CONTENT LOADED
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        initFlatpickr();
        initDependentSelects();
    });
</script>