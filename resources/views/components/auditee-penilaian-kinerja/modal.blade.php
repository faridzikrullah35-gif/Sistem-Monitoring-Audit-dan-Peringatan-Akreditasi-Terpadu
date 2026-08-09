{{-- resources/views/components/auditee-penilaian-kinerja/modal.blade.php --}}

@props([
    'matrixs'      => collect(),
    'settingScores'=> collect(),
    'standarList'  => collect(),
])

<div id="userModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8">
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Penilaian Kinerja
                </h3>
            </div>
            <button type="button"
                onclick="closeModalPenilaianKinerja()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formPenilaianModal"
            action="{{ route('prodi.penilaian-kinerja.store') }}"
            method="POST"
            enctype="multipart/form-data"
            data-ajax="1"
            data-table-id="#penilaianTableContainer">

            @csrf
            @method('POST')
            <input type="hidden" id="penilaianIdModal" name="id" value="" />

            <div class="space-y-5 px-6 py-5">

                {{-- Cascading: Standar -> Elemen -> Indikator --}}
                <div class="grid grid-cols-1 gap-4">

                    {{-- Pilih Standar (dulu Kriteria) --}}
                    <div>
                        <label for="standar_modal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Standar / Kriteria <span class="text-red-500">*</span>
                        </label>
                        <select id="standar_modal"
                            name="standar_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:focus:border-blue-500 dark:focus:ring-blue-500/20">
                            <option value="" disabled selected>Pilih Standar / Kriteria</option>
                            @foreach ($standarList as $standar)
                                <option value="{{ $standar->id }}">{{ $standar->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Elemen --}}
                    <div>
                        <label for="elemen_modal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Elemen <span class="text-red-500">*</span>
                        </label>
                        <select id="elemen_modal"
                            name="matrixs_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:focus:border-blue-500 dark:focus:ring-blue-500/20">
                            <option value="" disabled selected>Pilih Elemen</option>
                        </select>
                    </div>

                    {{-- Pilih Indikator --}}
                    <div>
                        <label for="indikator_modal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Indikator <span class="text-red-500">*</span>
                        </label>
                        <select id="indikator_modal"
                            name="isi_indikator_id"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:focus:border-blue-500 dark:focus:ring-blue-500/20">
                            <option value="" disabled selected>Pilih Indikator</option>
                        </select>

                        {{-- PREVIEW INDIKATOR --}}
                        <div id="previewIndikatorModal"
                            class="hidden mt-3 rounded-lg border border-blue-200 dark:border-blue-700 bg-blue-50 dark:bg-blue-900/20 p-3">
                            <p class="text-xs font-semibold text-blue-600 dark:text-blue-300 mb-1">
                                Preview Indikator
                            </p>
                            <p id="previewIndikatorTextModal"
                                class="text-sm leading-6 text-gray-700 dark:text-gray-200">
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi / Uraian --}}
                <div>
                    <label for="deskripsi_modal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Deskripsi / Uraian <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi_modal"
                        name="deskripsi"
                        rows="4"
                        placeholder="Tuliskan deskripsi atau uraian penilaian kinerja..."
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:placeholder-gray-500 dark:focus:border-blue-500 dark:focus:ring-blue-500/20"></textarea>
                </div>

                {{-- Pilih Score --}}
                <div>
                    <label for="score_modal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pilih Score <span class="text-red-500">*</span>
                    </label>
                    <select id="score_modal"
                        name="setting_score_id"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:focus:border-blue-500 dark:focus:ring-blue-500/20">
                        <option value="" disabled selected>Pilih Score</option>
                        @foreach ($settingScores as $score)
                            <option value="{{ $score->id }}">
                                {{ $score->nilai_score }} - {{ $score->keterangan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Upload File PDF --}}
                <div>
                    <label for="file_modal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upload File PDF <span class="text-red-500">*</span>
                        <span class="text-xs font-normal text-gray-400 dark:text-gray-500">(Maksimal 2MB)</span>
                    </label>
                    <input type="file"
                        id="file_modal"
                        name="file"
                        accept=".pdf"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:focus:border-blue-500 dark:focus:ring-blue-500/20 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-500/10 dark:file:text-blue-400" />
                    <p id="fileInfo" class="mt-1 text-xs text-gray-500 dark:text-gray-400"></p>
                </div>

            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button"
                    onclick="closeModalPenilaianKinerja()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Simpan Penilaian
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    const matrixs = @json($matrixs);

    // =============================================
    // ROUTE TEMPLATES
    // =============================================
    const editUrlTemplate   = @json(route('prodi.penilaian-kinerja.edit', ['id' => 'ID_PLACEHOLDER']));
    const updateUrlTemplate = @json(route('prodi.penilaian-kinerja.update', ['id' => 'ID_PLACEHOLDER']));

    // =============================================
    // BUILD CASCADING: STANDAR -> ELEMEN -> INDIKATOR
    // =============================================
    document.addEventListener('DOMContentLoaded', () => {
        const standarSelect = document.getElementById('standar_modal');
        const elemenSelect = document.getElementById('elemen_modal');
        const indikatorSelect = document.getElementById('indikator_modal');

        standarSelect.addEventListener('change', function () {
            const standarId = this.value;

            elemenSelect.innerHTML = `<option value="" disabled selected>Pilih Elemen</option>`;
            indikatorSelect.innerHTML = `<option value="" disabled selected>Pilih Indikator</option>`;
            hidePreviewIndikatorModal();

            const filteredMatrix = matrixs.filter(item =>
                item.kriteria_audit &&
                item.kriteria_audit.standar &&
                item.kriteria_audit.standar.id == standarId
            );

            filteredMatrix.forEach(item => {
                elemenSelect.innerHTML += `
                    <option value="${item.id}">${item.elemen}</option>
                `;
            });
        });

        elemenSelect.addEventListener('change', function () {
            const matrixId = this.value;

            indikatorSelect.innerHTML = `<option value="" disabled selected>Pilih Indikator</option>`;
            hidePreviewIndikatorModal();

            const selectedMatrix = matrixs.find(item => item.id == matrixId);

            if (selectedMatrix && selectedMatrix.isi_indikator && selectedMatrix.isi_indikator.length > 0) {
                selectedMatrix.isi_indikator.forEach((item, index) => {
                    const indikatorTeks = item.indikator;
                    indikatorSelect.innerHTML += `
                        <option value="${item.id}"
                                data-indikator-teks="${indikatorTeks.replace(/"/g, '&quot;')}">
                            ${index + 1}. ${indikatorTeks}
                        </option>
                    `;
                });
            }
        });

        indikatorSelect.addEventListener('change', function () {
            triggerIndikatorPreviewModal();
        });
    });

    // =============================================
    // FUNGSI PREVIEW INDIKATOR
    // =============================================
    function triggerIndikatorPreviewModal() {
        const select = document.getElementById('indikator_modal');
        const selectedOption = select.options[select.selectedIndex];
        const preview = document.getElementById('previewIndikatorModal');
        const previewText = document.getElementById('previewIndikatorTextModal');

        if (selectedOption && selectedOption.value && selectedOption.dataset.indikatorTeks) {
            previewText.textContent = selectedOption.dataset.indikatorTeks;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
            previewText.textContent = '';
        }
    }

    function hidePreviewIndikatorModal() {
        const preview = document.getElementById('previewIndikatorModal');
        if (preview) preview.classList.add('hidden');
        const previewText = document.getElementById('previewIndikatorTextModal');
        if (previewText) previewText.textContent = '';
    }

    // =============================================
    // OPEN / CLOSE MODAL
    // =============================================
    function openModalPenilaianKinerja(id = null, rowData = null) {
        const modal = document.getElementById('userModal');
        const title = document.getElementById('modalFormTitle');
        const form = document.getElementById('formPenilaianModal');
        const hiddenId = document.getElementById('penilaianIdModal');
        const standarSelect = document.getElementById('standar_modal');
        const elemenSelect = document.getElementById('elemen_modal');
        const indikatorSelect = document.getElementById('indikator_modal');
        const deskripsi = document.getElementById('deskripsi_modal');
        const scoreSelect = document.getElementById('score_modal');
        const fileInput = document.getElementById('file_modal');
        const fileInfo = document.getElementById('fileInfo');

        // Reset preview
        hidePreviewIndikatorModal();

        // Reset form (kecuali file input, kita reset di akhir)
        form.reset();
        hiddenId.value = '';
        fileInfo.textContent = '';
        fileInput.value = '';
        fileInput.required = true;

        // =====================
        // MODE EDIT
        // =====================
        if (id && id !== 'null') {
            title.textContent = 'Edit Penilaian Kinerja';
            hiddenId.value = id;

            form.action = updateUrlTemplate.replace('ID_PLACEHOLDER', id);

            const methodField = form.querySelector('input[name="_method"]');
            if (methodField) methodField.value = 'PUT';

            // 1. INSTANT FILL DARI ROW (kalau ada data dari tabel)
            if (rowData) {
                deskripsi.value = rowData.deskripsi ?? '';
                scoreSelect.value = rowData.setting_score_id ?? '';
                if (rowData.file_path) {
                    const fileName = rowData.file_path.split('/').pop();
                    fileInfo.textContent = 'File saat ini: ' + fileName;
                }
                // Set dropdown standar
                if (standarSelect && rowData.kriteria_id) {
                    standarSelect.value = rowData.kriteria_id;
                    triggerEvent(standarSelect, 'change');
                }

                setTimeout(() => {
                    if (elemenSelect && rowData.matrixs_id) {
                        elemenSelect.value = rowData.matrixs_id;
                        triggerEvent(elemenSelect, 'change');
                    }

                    setTimeout(() => {
                        if (indikatorSelect && rowData.isi_indikator_id) {
                            indikatorSelect.value = rowData.isi_indikator_id;
                            triggerIndikatorPreviewModal();
                        }
                    }, 150);
                }, 150);
            }

            // 2. FETCH DETAIL LENGKAP (override instant fill)
            fetch(editUrlTemplate.replace('ID_PLACEHOLDER', id), {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;
                const item = data.data;

                const indikator = item.isi_indikator;
                const matrix = indikator?.matrix;
                const kriteria = matrix?.kriteria_audit?.standar; // ini adalah Standar

                deskripsi.value = item.deskripsi ?? '';
                scoreSelect.value = item.setting_score_id ?? '';
                if (item.file_path) {
                    const fileName = item.file_path.split('/').pop();
                    fileInfo.textContent = 'File saat ini: ' + fileName;
                }

                if (kriteria?.id) {
                    standarSelect.value = kriteria.id;
                    triggerEvent(standarSelect, 'change');
                }

                setTimeout(() => {
                    if (matrix?.id) {
                        elemenSelect.value = matrix.id;
                        triggerEvent(elemenSelect, 'change');
                    }

                    setTimeout(() => {
                        if (indikator?.id) {
                            indikatorSelect.value = indikator.id;
                            triggerIndikatorPreviewModal();
                        }
                    }, 150);
                }, 150);
            })
            .catch(err => console.error('Error fetching data:', err));

            fileInput.required = false;

        }
        // =====================
        // MODE CREATE
        // =====================
        else {
            title.textContent = 'Tambah Penilaian Kinerja';
            form.action = "{{ route('prodi.penilaian-kinerja.store') }}";
            const methodField = form.querySelector('input[name="_method"]');
            if (methodField) methodField.value = 'POST';

            standarSelect.selectedIndex = 0;
            elemenSelect.innerHTML = '<option value="" disabled selected>Pilih Elemen</option>';
            indikatorSelect.innerHTML = '<option value="" disabled selected>Pilih Indikator</option>';
            deskripsi.value = '';
            scoreSelect.selectedIndex = 0;
            fileInput.value = '';
            fileInfo.textContent = '';
            fileInput.required = true;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModalPenilaianKinerja() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        hidePreviewIndikatorModal();
    }

    function triggerEvent(element, eventName) {
        if (!element) return;
        element.dispatchEvent(new Event(eventName, { bubbles: true, cancelable: true }));
    }

    // Tutup modal dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModalPenilaianKinerja();
    });

    // Validasi ukuran file sebelum submit
    document.getElementById('formPenilaianModal').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('file_modal');
        if (fileInput.files.length > 0) {
            const fileSize = fileInput.files[0].size;
            const maxSize = 2 * 1024 * 1024;
            if (fileSize > maxSize) {
                alert('Ukuran file melebihi 2MB. Silakan pilih file yang lebih kecil.');
                e.preventDefault();
                return false;
            }
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-\[fadeIn_0\.2s_ease-out\] {
        animation: fadeIn 0.2s ease-out;
    }
</style>