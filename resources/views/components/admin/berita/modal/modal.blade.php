{{-- MODAL TAMBAH / EDIT BERITA --}}
<div id="beritaModal" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 px-4 py-6 backdrop-blur-sm">
    <div class="my-auto w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- HEADER --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div>
                    <h3 id="modalBeritaTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah Berita</h3>
                    <p id="modalBeritaSubtitle" class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Tambahkan berita baru ke landing page</p>
                </div>
            </div>
            <button type="button" onclick="closeModalBerita()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70" aria-label="Tutup modal">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- FORM --}}
        <form id="beritaForm" action="{{ route('setting-landing-page.store') }}" method="POST" enctype="multipart/form-data" data-ajax="1" data-table-id="#beritaTableContainer">
            @csrf
            <input type="hidden" id="beritaId" name="id" value="" />
            <input type="hidden" id="formMethodBerita" name="_method" value="POST" />

            {{-- BODY --}}
            <div class="space-y-5 px-6 py-5">

                {{-- JUDUL --}}
                <div>
                    <label for="nama_file" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_file" name="nama_file" required autocomplete="off" placeholder="Masukkan judul berita" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-white/85 dark:placeholder-gray-500" />
                    <p id="namaFileHint" class="mt-1.5 hidden text-xs text-blue-600 dark:text-blue-400">Semua file yang dipilih akan disimpan dengan judul yang sama.</p>
                </div>

                {{-- UPLOAD FILE --}}
                <div>
                    <div class="mb-1.5 flex items-center justify-between">
                        <label for="fileInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Berita <span class="text-red-500">*</span></label>
                        <span id="uploadModeLabel" class="text-xs text-gray-500 dark:text-gray-400">Bisa upload beberapa file</span>
                    </div>

                    {{-- DROPZONE --}}
                    <div id="dropzoneArea" class="relative flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 px-6 py-8 text-center transition-all hover:border-blue-400 hover:bg-blue-50/50 dark:border-gray-700 dark:bg-white/[0.02] dark:hover:border-blue-500 dark:hover:bg-blue-500/5">
                        <input type="file" id="fileInput" name="file[]" multiple required class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.svg,.webp,.txt,.zip,.rar" />
                        <div id="uploadIcon" class="mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-500/10">
                            <svg class="h-7 w-7 text-blue-500 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-medium text-blue-600 dark:text-blue-400">Klik untuk upload</span> atau drag & drop</p>
                        <p id="uploadDescription" class="mt-1 text-xs text-gray-500 dark:text-gray-500">Bisa memilih lebih dari 1 file</p>
                        <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-600">PDF, JPG, PNG, DOC, XLS, PPT, ZIP, dll. Maks. 10MB/file</p>
                    </div>

                    {{-- PREVIEW --}}
                    <div id="filePreviewContainer" class="mt-3 hidden space-y-2"></div>
                </div>

                {{-- INFORMASI UPLOADER --}}
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-white/[0.02]">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-500/10">
                            <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <div class="min-w-0 text-sm">
                            <div class="flex flex-wrap items-center gap-1.5">
                                <span class="font-medium text-gray-800 dark:text-white/90">{{ auth()->user()->name }}</span>
                                <span class="text-gray-400">•</span>
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">{{ auth()->user()->role }}</span>
                            </div>
                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ now()->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                {{-- CATATAN --}}
                <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-3.5 dark:border-yellow-900/30 dark:bg-yellow-900/10">
                    <div class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <div class="text-xs leading-relaxed text-yellow-800 dark:text-yellow-300">
                            <p id="modalBeritaNote">Pada mode tambah, Anda dapat memilih beberapa file sekaligus. File akan disimpan di storage dan dapat digunakan sebagai lampiran berita.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalBerita()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                    Keluar
                </button>
                <button type="submit" id="submitBeritaButton" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-60 dark:focus:ring-offset-gray-900">
                    <svg id="submitBeritaIcon" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    <span id="submitBeritaText">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(() => {
    'use strict';

    const CONFIG = {
        maxFileSize: 10 * 1024 * 1024,
        allowedExtensions: ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'txt', 'zip', 'rar'],
        storeUrl: @json(route('setting-landing-page.store')),
        updateUrl: id => `/admin/setting-landing-page/update/${id}`,
        showUrl: id => `/admin/setting-landing-page/${id}`,
    };

    let selectedFiles = [];
    let modalMode = 'create';

    const $ = id => document.getElementById(id);

    function getElements() {
        return {
            modal: $('beritaModal'),
            form: $('beritaForm'),
            title: $('modalBeritaTitle'),
            subtitle: $('modalBeritaSubtitle'),
            hiddenId: $('beritaId'),
            method: $('formMethodBerita'),
            titleInput: $('nama_file'),
            fileInput: $('fileInput'),
            preview: $('filePreviewContainer'),
            dropzone: $('dropzoneArea'),
            hint: $('namaFileHint'),
            modeLabel: $('uploadModeLabel'),
            description: $('uploadDescription'),
            note: $('modalBeritaNote'),
            submitButton: $('submitBeritaButton'),
            submitText: $('submitBeritaText'),
        };
    }

    function showModal() {
        const el = getElements();
        if (!el.modal) { console.error('Modal berita tidak ditemukan.'); return; }
        el.modal.classList.remove('hidden');
        el.modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function hideModal() {
        const el = getElements();
        if (!el.modal) return;
        el.modal.classList.add('hidden');
        el.modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    function resetForm() {
        const el = getElements();
        if (!el.form) return;
        el.form.reset();
        el.hiddenId.value = '';
        el.method.value = 'POST';
        el.form.action = CONFIG.storeUrl;
        selectedFiles = [];
        syncFileInput();
        resetDropzone();
        renderSelectedFiles();
    }

    function setCreateMode() {
        const el = getElements();
        modalMode = 'create';
        el.title.textContent = 'Tambah Berita';
        el.subtitle.textContent = 'Tambahkan berita baru ke landing page';
        el.submitText.textContent = 'Simpan';
        el.method.value = 'POST';
        el.form.action = CONFIG.storeUrl;
        el.fileInput.required = true;
        el.fileInput.multiple = true;
        el.modeLabel.textContent = 'Bisa upload beberapa file';
        el.description.textContent = 'Bisa memilih lebih dari 1 file';
        el.note.textContent = 'Pada mode edit, Anda dapat mengganti semua file berita sekaligus.';
    }

    function setEditMode(data, id) {
        const el = getElements();
        modalMode = 'edit';
        el.title.textContent = 'Edit Berita';
        el.subtitle.textContent = 'Perbarui informasi berita';
        el.submitText.textContent = 'Update';
        el.hiddenId.value = id;
        el.method.value = 'PUT';
        el.form.action = CONFIG.updateUrl(id);
        el.titleInput.value = data.nama_file ?? '';
        el.fileInput.required = false;
        el.fileInput.multiple = false;
        el.modeLabel.textContent = 'Ganti file berita';
        el.description.textContent = 'Pilih 1 file baru untuk menggantikan file lama';
        el.note.textContent = 'Pada mode edit, file baru hanya digunakan untuk menggantikan file yang sedang tersimpan. Jika tidak memilih file baru, file lama tetap digunakan.';
        selectedFiles = [];
        syncFileInput();
        if (data.nama_file) {
            renderExistingFilePreview(data.nama_file);
        } else {
            renderSelectedFiles();
        }
    }

    function openModalBerita() {
        resetForm();
        setCreateMode();
        showModal();
        setTimeout(() => getElements().titleInput?.focus(), 100);
    }

    function closeModalBerita() { hideModal(); }

    async function editBerita(id) {
        if (!id) { console.error('ID berita tidak ditemukan.'); return; }
        try {
            const response = await fetch(CONFIG.showUrl(id), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            const data = await response.json();
            resetForm();
            setEditMode(data, id);
            showModal();
            setTimeout(() => getElements().titleInput?.focus(), 100);
        } catch (error) {
            console.error('[editBerita]', error);
            alert('Gagal mengambil data berita.');
        }
    }

    function handleFileSelect(event) {
        const files = Array.from(event.target.files || []);
        if (!files.length) return;
        addFiles(files);
    }

    function handleFileDrop(event) {
        event.preventDefault();
        const dropzone = getElements().dropzone;
        dropzone?.classList.remove('border-blue-500', 'bg-blue-50/50', 'dark:bg-blue-500/10');
        const files = Array.from(event.dataTransfer?.files || []);
        if (!files.length) return;
        addFiles(files);
    }

    function addFiles(files) {
        const isEdit = modalMode === 'edit';
        if (isEdit) {
            const file = files[0];
            if (!file) return;
            if (!validateFile(file)) return;
            selectedFiles = [file];
        } else {
            for (const file of files) {
                if (!validateFile(file)) continue;
                const duplicate = selectedFiles.some(existing =>
                    existing.name === file.name && existing.size === file.size && existing.lastModified === file.lastModified
                );
                if (duplicate) continue;
                selectedFiles.push(file);
            }
        }
        syncFileInput();
        renderSelectedFiles();
        updateDropzoneState();
    }

    function validateFile(file) {
        if (file.size > CONFIG.maxFileSize) {
            alert(`File "${file.name}" terlalu besar.\n\nMaksimal ukuran file adalah 10MB.`);
            return false;
        }
        const extension = getExtension(file.name);
        if (extension && !CONFIG.allowedExtensions.includes(extension)) {
            alert(`Format file "${file.name}" tidak diperbolehkan.`);
            return false;
        }
        return true;
    }

    function removeFile(index) {
        if (index < 0 || index >= selectedFiles.length) return;
        selectedFiles.splice(index, 1);
        syncFileInput();
        renderSelectedFiles();
        updateDropzoneState();
    }

    function syncFileInput() {
        const el = getElements();
        if (!el.fileInput) return;
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        el.fileInput.files = dataTransfer.files;
        updateTitleHint();
    }

    function renderSelectedFiles() {
        const el = getElements();
        if (!el.preview) return;
        if (!selectedFiles.length) {
            el.preview.innerHTML = '';
            el.preview.classList.add('hidden');
            return;
        }
        el.preview.classList.remove('hidden');
        el.preview.innerHTML = selectedFiles.map((file, index) => renderFilePreviewItem(file.name, formatFileSize(file.size), index)).join('');
    }

    function renderExistingFilePreview(fileName) {
        const el = getElements();
        if (!el.preview) return;
        el.preview.classList.remove('hidden');
        el.preview.innerHTML = renderFilePreviewItem(fileName, 'File saat ini', null);
        updateDropzoneState(true);
    }

    function renderFilePreviewItem(name, sizeLabel, removeIndex = null) {
        const extension = getExtension(name);
        const icon = getFileIcon(extension);
        const removeButton = removeIndex !== null
            ? `<button type="button" onclick="removeFile(${removeIndex})" class="rounded-lg p-1.5 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70" aria-label="Hapus file">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>`
            : '';
        return `
            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-white/[0.04]">
                <div class="flex min-w-0 items-center gap-3">
                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg ${icon.bg} ${icon.color}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-gray-800 dark:text-white/90" title="${escapeHtml(name)}">${escapeHtml(name)}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${escapeHtml(sizeLabel)}</p>
                    </div>
                </div>
                ${removeButton}
            </div>
        `;
    }

    function getFileIcon(extension) {
        const map = {
            pdf: { color: 'text-red-500', bg: 'bg-red-100 dark:bg-red-500/10' },
            doc: { color: 'text-blue-700', bg: 'bg-blue-100 dark:bg-blue-500/10' },
            docx: { color: 'text-blue-700', bg: 'bg-blue-100 dark:bg-blue-500/10' },
            xls: { color: 'text-green-700', bg: 'bg-green-100 dark:bg-green-500/10' },
            xlsx: { color: 'text-green-700', bg: 'bg-green-100 dark:bg-green-500/10' },
            ppt: { color: 'text-orange-600', bg: 'bg-orange-100 dark:bg-orange-500/10' },
            pptx: { color: 'text-orange-600', bg: 'bg-orange-100 dark:bg-orange-500/10' },
            jpg: { color: 'text-green-500', bg: 'bg-green-100 dark:bg-green-500/10' },
            jpeg: { color: 'text-green-500', bg: 'bg-green-100 dark:bg-green-500/10' },
            png: { color: 'text-green-500', bg: 'bg-green-100 dark:bg-green-500/10' },
            gif: { color: 'text-green-500', bg: 'bg-green-100 dark:bg-green-500/10' },
            svg: { color: 'text-purple-500', bg: 'bg-purple-100 dark:bg-purple-500/10' },
            webp: { color: 'text-purple-500', bg: 'bg-purple-100 dark:bg-purple-500/10' },
            zip: { color: 'text-yellow-600', bg: 'bg-yellow-100 dark:bg-yellow-500/10' },
            rar: { color: 'text-yellow-600', bg: 'bg-yellow-100 dark:bg-yellow-500/10' },
            txt: { color: 'text-gray-500', bg: 'bg-gray-100 dark:bg-gray-500/10' }
        };
        return map[extension] ?? { color: 'text-blue-500', bg: 'bg-blue-100 dark:bg-blue-500/10' };
    }

    function getExtension(filename) {
        if (!filename || !filename.includes('.')) return '';
        return filename.split('.').pop().toLowerCase();
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const units = ['Bytes', 'KB', 'MB', 'GB'];
        const index = Math.floor(Math.log(bytes) / Math.log(1024));
        return parseFloat((bytes / Math.pow(1024, index)).toFixed(2)) + ' ' + units[index];
    }

    function updateTitleHint() {
        const el = getElements();
        if (!el.hint) return;
        if (modalMode === 'create' && selectedFiles.length > 1) {
            el.hint.classList.remove('hidden');
        } else {
            el.hint.classList.add('hidden');
        }
    }

    function updateDropzoneState(existing = false) {
        const el = getElements();
        if (!el.dropzone) return;
        el.dropzone.classList.remove('border-green-400', 'bg-green-50/50', 'dark:bg-green-500/5');
        if (existing || selectedFiles.length > 0) {
            el.dropzone.classList.add('border-green-400', 'bg-green-50/50', 'dark:bg-green-500/5');
        }
    }

    function resetDropzone() {
        const el = getElements();
        if (!el.dropzone) return;
        el.dropzone.classList.remove('border-blue-500', 'bg-blue-50/50', 'dark:bg-blue-500/10', 'border-green-400', 'bg-green-50/50', 'dark:bg-green-500/5');
    }

    function setDragState(active) {
        const el = getElements();
        if (!el.dropzone) return;
        if (active) {
            el.dropzone.classList.add('border-blue-500', 'bg-blue-50/50', 'dark:bg-blue-500/10');
        } else {
            el.dropzone.classList.remove('border-blue-500', 'bg-blue-50/50', 'dark:bg-blue-500/10');
        }
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    function validateBeforeSubmit() {
        const el = getElements();
        const title = el.titleInput.value.trim();
        if (!title) {
            alert('Judul berita wajib diisi.');
            el.titleInput.focus();
            return false;
        }
        if (
            modalMode === 'create' &&
            selectedFiles.length === 0
        ) {
            alert('Silakan pilih minimal satu file.');
            return false;
        }
        return true;
    }

    function initializeBeritaModal() {
        const el = getElements();
        if (!el.form || !el.dropzone || !el.fileInput) return;

        el.dropzone.addEventListener('click', event => {
            if (event.target.closest('button')) return;
            el.fileInput.click();
        });

        el.fileInput.addEventListener('change', handleFileSelect);

        el.dropzone.addEventListener('dragover', event => { event.preventDefault(); setDragState(true); });
        el.dropzone.addEventListener('dragleave', event => { event.preventDefault(); setDragState(false); });
        el.dropzone.addEventListener('drop', handleFileDrop);

        el.form.addEventListener('submit', event => {
            if (!validateBeforeSubmit()) {
                event.preventDefault();
                return;
            }
            if (modalMode === 'edit' && selectedFiles.length === 0) {
                el.fileInput.required = false;
            }
        });

        document.addEventListener('keydown', event => {
            if (event.key !== 'Escape') return;
            if (el.modal && !el.modal.classList.contains('hidden')) closeModalBerita();
        });
    }

    window.openModalBerita = openModalBerita;
    window.closeModalBerita = closeModalBerita;
    window.editBerita = editBerita;
    window.removeFile = removeFile;
    window.handleFileSelect = handleFileSelect;
    window.handleFileDrop = handleFileDrop;
    window.openModal = openModalBerita;
    window.closeModal = closeModalBerita;

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeBeritaModal);
    } else {
        initializeBeritaModal();
    }
})();
</script>
@endpush