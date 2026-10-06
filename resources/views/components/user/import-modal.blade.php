{{-- Modal Import Excel User --}}
<div 
    id="importExcelModal" 
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white p-6 shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Modal Header --}}
        <div class="mb-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm dark:bg-emerald-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1 M8 12l4 4m0 0l4-4m-4 4V4" />
                    </svg>
                </div>
                <div>
                    <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                        Import User Excel
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tambahkan pengguna secara massal melalui Excel</p>
                </div>
            </div>

            {{-- Close --}}
            <button 
                type="button" 
                onclick="closeModalImportExcel()" 
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="space-y-4">

            {{-- Info --}}
            <div class="flex gap-3 rounded-xl border border-emerald-100 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/30">
                <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01 M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Perhatikan format Excel</p>
                    <p class="mt-1 text-sm text-emerald-700 dark:text-emerald-400">Gunakan template yang telah disediakan agar data pengguna dapat diproses dengan benar.</p>
                    <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-400">Pastikan nama kolom dan penulisan role sesuai dengan contoh yang tersedia.</p>
                </div>
            </div>

            {{-- Download Template --}}
            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900/40">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3 M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Template Excel</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Gunakan format yang sesuai</p>
                    </div>
                </div>
                <a href="{{ route('admin.users.import.template') }}" class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-emerald-700 transition-colors hover:bg-emerald-100 hover:text-emerald-800 dark:text-emerald-400 dark:hover:bg-emerald-900/30 dark:hover:text-emerald-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1 m-8-4l4 4m0 0l4-4m-4 4V4" />
                    </svg>
                    Download
                </a>
            </div>

            {{-- Upload Area --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">File Excel</label>

                <label for="importExcelFile" id="excelUploadArea" class="group flex h-40 w-full cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 transition-all hover:border-emerald-500 hover:bg-emerald-50/50 dark:border-gray-600 dark:bg-gray-900/30 dark:hover:bg-emerald-950/20">
                    
                    {{-- Default Upload State --}}
                    <div id="excelUploadPlaceholder" class="flex flex-col items-center justify-center">
                        <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition-transform group-hover:scale-105 dark:bg-emerald-900/40 dark:text-emerald-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16V4m0 0L8 8m4-4l4 4 M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Klik untuk memilih file</p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format .xlsx atau .xls • Maksimal 10 MB</p>
                    </div>

                    {{-- Selected File State --}}
                    <div id="excelSelectedState" class="hidden flex-col items-center justify-center">
                        <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3h10l4 4v14a1 1 0 01-1 1H5a1 1 0 01-1-1V4a1 1 0 011-1z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 3v5h5" />
                            </svg>
                        </div>
                        <p id="selectedExcelFileName" class="max-w-[90%] truncate text-sm font-semibold text-gray-800 dark:text-gray-200"></p>
                        <p id="selectedExcelFileSize" class="mt-1 text-xs text-gray-500 dark:text-gray-400"></p>
                        <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400">Klik untuk mengganti file</p>
                    </div>

                    <input id="importExcelFile" name="file" type="file" accept=".xlsx,.xls" class="hidden">
                </label>

                {{-- Remove File --}}
                <div id="selectedExcelFile" class="mt-3 hidden items-center justify-between rounded-lg border border-emerald-200 bg-emerald-50 p-3 dark:border-emerald-900/50 dark:bg-emerald-950/30">
                    <div class="flex min-w-0 items-center gap-3">
                        <div class="flex-shrink-0 text-emerald-600 dark:text-emerald-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p id="selectedExcelFileNameBottom" class="truncate text-sm font-medium text-gray-800 dark:text-gray-200"></p>
                            <p id="selectedExcelFileSizeBottom" class="text-xs text-gray-500 dark:text-gray-400"></p>
                        </div>
                    </div>
                    <button type="button" onclick="removeExcelFile()" class="ml-3 flex-shrink-0 text-gray-400 transition-colors hover:text-red-500 dark:text-gray-500 dark:hover:text-red-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button" onclick="closeModalImportExcel()" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 dark:border-gray-700 dark:bg-white/[0.05] dark:text-gray-300 dark:hover:bg-white/[0.08]">
                Batal
            </button>
            <button type="button" id="btnImportExcel" disabled onclick="importExcelUser()" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1 m-8-4l4 4m0 0l4-4m-4 4V4" />
                </svg>
                <span id="btnImportExcelText">Import User</span>
            </button>
        </div>

    </div>
</div>

<script>
    // =====================================================
    // OPEN MODAL IMPORT EXCEL
    // =====================================================
    function openModalExcel(type) {
        if (type !== 'import') return;

        const modal = document.getElementById('importExcelModal');
        if (!modal) return;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // Reset form upload
        resetExcelUpload();
    }

    // =====================================================
    // CLOSE MODAL IMPORT EXCEL
    // =====================================================
    function closeModalImportExcel() {
        const modal = document.getElementById('importExcelModal');
        if (!modal) return;
        
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    // =====================================================
    // EXCEL UPLOAD HANDLER
    // =====================================================
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('importExcelFile');
        const placeholder = document.getElementById('excelUploadPlaceholder');
        const selectedState = document.getElementById('excelSelectedState');
        const fileName = document.getElementById('selectedExcelFileName');
        const fileSize = document.getElementById('selectedExcelFileSize');
        const selectedExcelFile = document.getElementById('selectedExcelFile');
        const selectedExcelFileName = document.getElementById('selectedExcelFileNameBottom');
        const selectedExcelFileSize = document.getElementById('selectedExcelFileSizeBottom');
        const btnImportExcel = document.getElementById('btnImportExcel');
        const maxSize = 10 * 1024 * 1024;

        if (!input) return;

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) {
                resetExcelUpload();
                return;
            }

            const allowedExtensions = ['xlsx', 'xls'];
            const extension = file.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(extension)) {
                alert('Format file tidak valid.\n\nSilakan pilih file Excel dengan format .xlsx atau .xls.');
                this.value = '';
                resetExcelUpload();
                return;
            }

            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar.\n\nMaksimal ukuran file adalah 10 MB.');
                this.value = '';
                resetExcelUpload();
                return;
            }

            // Tampilkan file di upload area
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            placeholder.classList.add('hidden');
            selectedState.classList.remove('hidden');

            // Tampilkan file di bagian bawah
            if (selectedExcelFile) {
                selectedExcelFile.classList.remove('hidden');
            }
            if (selectedExcelFileName) {
                selectedExcelFileName.textContent = file.name;
            }
            if (selectedExcelFileSize) {
                selectedExcelFileSize.textContent = formatFileSize(file.size);
            }

            // Aktifkan button import
            if (btnImportExcel) {
                btnImportExcel.disabled = false;
            }
        });

        window.removeExcelFile = function () {
            input.value = '';
            resetExcelUpload();
        };

        function resetExcelUpload() {
            placeholder.classList.remove('hidden');
            selectedState.classList.add('hidden');
            fileName.textContent = '';
            fileSize.textContent = '';
            if (selectedExcelFile) {
                selectedExcelFile.classList.add('hidden');
            }
            if (selectedExcelFileName) {
                selectedExcelFileName.textContent = '';
            }
            if (selectedExcelFileSize) {
                selectedExcelFileSize.textContent = '';
            }
            if (btnImportExcel) {
                btnImportExcel.disabled = true;
            }
        }

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }
    });

    // =====================================================
    // IMPORT EXCEL USER (RELOAD HALAMAN)
    // =====================================================
    function importExcelUser() {
        const input = document.getElementById('importExcelFile');
        const button = document.getElementById('btnImportExcel');
        const buttonText = document.getElementById('btnImportExcelText');

        if (!input || !input.files.length) {
            window.toast?.warning('Silakan pilih file Excel terlebih dahulu.');
            return;
        }

        const file = input.files[0];

        if (file.size > 10 * 1024 * 1024) {
            window.toast?.error('Ukuran file maksimal 10 MB.');
            return;
        }

        const extension = file.name.split('.').pop().toLowerCase();
        if (!['xlsx', 'xls'].includes(extension)) {
            window.toast?.error('File harus berformat .xlsx atau .xls.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);

        button.disabled = true;
        buttonText.textContent = 'Mengimport...';

        fetch("{{ route('admin.users.import') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(async response => {
            const contentType = response.headers.get('content-type') || '';
            let data = {};

            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                console.error('Server mengembalikan response bukan JSON:', text.substring(0, 500));
                throw new Error(`Server error (HTTP ${response.status}).`);
            }

            if (!response.ok) {
                if (response.status === 422) {
                    if (data.errors) {
                        const messages = Object.values(data.errors).flat().join('\n');
                        throw new Error(messages);
                    }
                    throw new Error(data.message || 'Data yang dikirim tidak valid.');
                }
                throw new Error(data.message || `Import gagal (HTTP ${response.status}).`);
            }

            return data;
        })
        .then(data => {
            // Tampilkan toast sukses
            window.toast?.success(data.message || 'Data pengguna berhasil diimport.');

            // Tutup modal
            closeModalImportExcel();

            // Reset file
            if (typeof window.removeExcelFile === 'function') {
                window.removeExcelFile();
            }

            // Reload halaman setelah toast muncul
            setTimeout(() => {
                window.location.reload();
            }, 800);
        })
        .catch(error => {
            console.error('[Import Excel Error]', error);
            window.toast?.error(error.message || 'Terjadi kesalahan saat melakukan import.');

            button.disabled = false;
            buttonText.textContent = 'Import User';
        });
    }

    // =====================================================
    // ESC CLOSE
    // =====================================================
    document.addEventListener('keydown', function(event) {
        if (event.key !== 'Escape') return;
        const modal = document.getElementById('importExcelModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeModalImportExcel();
        }
    });
</script>