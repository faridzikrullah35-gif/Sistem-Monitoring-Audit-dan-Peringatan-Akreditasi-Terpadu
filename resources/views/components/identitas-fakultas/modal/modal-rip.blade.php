<!-- Modal RIP -->
<div id="modalRip" 
     tabindex="-1" 
     class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6"
>
    <div class="mx-4 w-full max-w-md animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
        
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 id="modalRipTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Rencana Induk Pengembangan
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalRip()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formRip" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethodRip" value="POST">
            <input type="hidden" name="id" id="editIdRip" value="">
            <input type="hidden" name="kategori" value="RIP">
            <input type="hidden" name="old_file" id="oldFileRip" value="">
            
            <div class="space-y-5 px-6 py-5">
                
                <!-- Nama Dokumen -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_dokumen" id="namaDokumenRip" required 
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400"
                        placeholder="Masukkan nama dokumen..."
                    />
                </div>

                <!-- File Dokumen -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        File Dokumen <span class="text-red-500" id="fileRequired">*</span>
                    </label>
                    <input type="file" name="file" id="fileRip" 
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/20 dark:file:text-blue-300"
                    />
                    <small class="text-xs text-gray-500 dark:text-gray-400">*Wajib untuk tambah, kosongkan jika tidak ingin mengganti file saat edit</small>
                    <div id="currentFileInfo" class="hidden mt-2 text-xs text-gray-600 dark:text-gray-400">
                        File saat ini: <span id="currentFileName" class="font-medium"></span>
                    </div>
                </div>

                <!-- Tanggal Penetapan -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Penetapan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tanggal_penetapan" id="tanggalPenetapanRip" required 
                        class="flatpickr-date w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400"
                        placeholder="dd/mm/yyyy"
                    />
                </div>

                <!-- Tanggal Revisi -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Revisi
                    </label>
                    <input type="text" name="tanggal_revisi" id="tanggalRevisiRip" 
                        class="flatpickr-date w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400"
                        placeholder="dd/mm/yyyy"
                    />
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Keterangan
                    </label>
                    <textarea name="keterangan" id="keteranganRip" rows="3" 
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400"
                        placeholder="Masukkan keterangan (opsional)..."
                    ></textarea>
                </div>

            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalRip()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button
                    type="submit"
                    id="btnRipSubmit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="btnRipText">Simpan</span>
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

    #ripTableBody td {
        vertical-align: middle;
    }

    #ripTableBody tr:hover td {
        background-color: rgba(59, 130, 246, 0.02);
    }

    .dark #ripTableBody tr:hover td {
        background-color: rgba(59, 130, 246, 0.05);
    }

    /* Flatpickr custom dark mode */
    .flatpickr-calendar.dark {
        background: #1f2937 !important;
        border-color: #374151 !important;
    }
    .flatpickr-calendar.dark .flatpickr-day {
        color: #d1d5db !important;
    }
    .flatpickr-calendar.dark .flatpickr-day.selected {
        background: #3b82f6 !important;
        border-color: #3b82f6 !important;
    }
    .flatpickr-calendar.dark .flatpickr-day:hover {
        background: #374151 !important;
    }
</style>

<script>
// ==========================================
// MODAL CONTROLLER
// ==========================================
const RipModal = {
    open(id = null) {
        const modal = document.getElementById('modalRip');
        const title = document.getElementById('modalRipTitle');
        const form = document.getElementById('formRip');
        const hiddenId = document.getElementById('editIdRip');
        const methodInput = document.getElementById('formMethodRip');
        const fileInput = document.getElementById('fileRip');
        const fileRequired = document.getElementById('fileRequired');
        const currentFileInfo = document.getElementById('currentFileInfo');

        this.resetForm();

        if (id) {
            // MODE EDIT → pakai route dokumen update
            title.textContent = 'Ubah Rencana Induk Pengembangan';
            hiddenId.value = id;
            form.action = `/fakultas/identitas-fakultas/dokumen/${id}`;
            methodInput.value = 'PUT';
            fileRequired.textContent = '(kosongkan jika tidak ingin mengganti)';
            fileInput.removeAttribute('required');
        } else {
            // MODE TAMBAH → pakai route dokumen store
            title.textContent = 'Tambah Rencana Induk Pengembangan';
            hiddenId.value = '';
            form.action = '/fakultas/identitas-fakultas/dokumen';
            methodInput.value = 'POST';
            fileRequired.textContent = '*';
            fileInput.setAttribute('required', 'required');
            currentFileInfo.classList.add('hidden');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    },

    close() {
        const modal = document.getElementById('modalRip');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        setTimeout(() => {
            this.resetForm();
        }, 0);
    },

    resetForm() {
        const form = document.getElementById('formRip');
        if (form) {
            form.reset();
            form.action = '/fakultas/identitas-fakultas/dokumen';
        }

        // Reset flatpickr dengan aman
        const instances = window.flatpickrInstances;
        if (instances && Array.isArray(instances)) {
            instances.forEach(fp => {
                if (fp && typeof fp.clear === 'function') {
                    fp.clear();
                }
            });
        }

        const hiddenId = document.getElementById('editIdRip');
        if (hiddenId) hiddenId.value = '';

        const methodInput = document.getElementById('formMethodRip');
        if (methodInput) methodInput.value = 'POST';

        const title = document.getElementById('modalRipTitle');
        if (title) title.textContent = 'Tambah Rencana Induk Pengembangan';

        const btnText = document.getElementById('btnRipText');
        const btn = document.getElementById('btnRipSubmit');
        if (btnText) btnText.textContent = 'Simpan';
        if (btn) btn.disabled = false;

        const fileRequired = document.getElementById('fileRequired');
        const fileInput = document.getElementById('fileRip');
        if (fileRequired) fileRequired.textContent = '*';
        if (fileInput) {
            fileInput.setAttribute('required', 'required');
            fileInput.value = '';
        }

        const currentFileInfo = document.getElementById('currentFileInfo');
        if (currentFileInfo) currentFileInfo.classList.add('hidden');

        const oldFile = document.getElementById('oldFileRip');
        if (oldFile) oldFile.value = '';

        const modal = document.getElementById('modalRip');
        if (modal) modal.scrollTop = 0;
    }
};

// ==========================================
// FUNGSI GLOBAL
// ==========================================
function openModalRip(id = null) {
    RipModal.open(id);
}

function closeModalRip() {
    RipModal.close();
}

// ==========================================
// EDIT LANGSUNG (dari parameter)
// ==========================================
function openEditRipDirect(id, nama_dokumen = '', tanggal_penetapan = '', tanggal_revisi = '', keterangan = '', file = '') {
    const modal = document.getElementById('modalRip');
    const title = document.getElementById('modalRipTitle');
    const form = document.getElementById('formRip');
    const hiddenId = document.getElementById('editIdRip');
    const methodInput = document.getElementById('formMethodRip');
    const btnText = document.getElementById('btnRipText');
    const fileRequired = document.getElementById('fileRequired');
    const fileInput = document.getElementById('fileRip');
    const currentFileInfo = document.getElementById('currentFileInfo');
    const currentFileName = document.getElementById('currentFileName');

    RipModal.resetForm();

    // ==============================
    // SET DATA EDIT
    // ==============================
    document.getElementById('namaDokumenRip').value = nama_dokumen || '';
    document.getElementById('oldFileRip').value = file || '';
    document.getElementById('keteranganRip').value = keterangan || '';

    // Set flatpickr dengan aman
    const instances = window.flatpickrInstances;
    if (instances && Array.isArray(instances) && instances.length >= 2) {
        const fpPenetapan = instances[0];
        const fpRevisi = instances[1];
        
        if (fpPenetapan && typeof fpPenetapan.setDate === 'function') {
            if (tanggal_penetapan) fpPenetapan.setDate(tanggal_penetapan);
            else fpPenetapan.clear();
        }
        
        if (fpRevisi && typeof fpRevisi.setDate === 'function') {
            if (tanggal_revisi) fpRevisi.setDate(tanggal_revisi);
            else fpRevisi.clear();
        }
    }

    // Tampilkan file saat ini
    if (file) {
        currentFileInfo.classList.remove('hidden');
        const fileName = file.split('/').pop();
        currentFileName.textContent = fileName;
    } else {
        currentFileInfo.classList.add('hidden');
    }

    title.textContent = 'Ubah Rencana Induk Pengembangan';
    btnText.textContent = 'Update';
    hiddenId.value = id;
    form.action = `/fakultas/identitas-fakultas/dokumen/${id}`;
    methodInput.value = 'PUT';
    fileRequired.textContent = '(kosongkan jika tidak ingin mengganti)';
    fileInput.removeAttribute('required');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

// ==========================================
// SINKRONISASI DATASET DARI DOM (FALLBACK)
// ==========================================
function syncRipRowDataset(row) {
    if (!row) return;
    
    const getValue = (selector) => {
        const cell = row.querySelector(selector);
        return cell ? cell.textContent.trim() : '';
    };

    row.dataset.nama_dokumen = row.dataset.nama_dokumen || getValue('.nama-dokumen-value');
    row.dataset.tanggal_penetapan = row.dataset.tanggal_penetapan || getValue('.tanggal-penetapan-value');
    row.dataset.tanggal_revisi = row.dataset.tanggal_revisi || getValue('.tanggal-revisi-value');
    row.dataset.keterangan = row.dataset.keterangan || getValue('.keterangan-value');
}

// ==========================================
// PASANG EVENT EDIT PADA ROW
// ==========================================
function setupRipEditButton(row) {
    const editBtn = row.querySelector('.btn-edit-rip');
    if (!editBtn) return;

    editBtn.onclick = function(e) {
        e.preventDefault();
        openEditRipFromRow(row);
    };
}

// ==========================================
// EDIT DARI ROW (BACA DATASET)
// ==========================================
function openEditRipFromRow(row) {
    if (!row) return;

    syncRipRowDataset(row);

    const id = row.id.replace('ripRow-', '');
    const nama_dokumen = row.dataset.nama_dokumen || '';
    const tanggal_penetapan = row.dataset.tanggal_penetapan || '';
    const tanggal_revisi = row.dataset.tanggal_revisi || '';
    const keterangan = row.dataset.keterangan || '';
    const file = row.dataset.file || '';

    console.log('📝 Data RIP dari dataset:', { id, nama_dokumen, tanggal_penetapan, tanggal_revisi, keterangan, file });

    openEditRipDirect(id, nama_dokumen, tanggal_penetapan, tanggal_revisi, keterangan, file);
}

// ==========================================
// UPDATE TABEL RIP TANPA RELOAD
// ==========================================
function updateRipTable(data) {
    const tbody = document.getElementById('ripTableBody');
    if (!tbody || !data) return;
    const id = data.id;
    let row = document.getElementById(`ripRow-${id}`);

    const formatDate = (date) => {
        if (!date) return '-';
        const d = new Date(date);
        return d.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
    };

    if (row) {
        row.dataset.nama_dokumen = data.nama_dokumen || '';
        row.dataset.tanggal_penetapan = data.tanggal_penetapan || '';
        row.dataset.tanggal_revisi = data.tanggal_revisi || '';
        row.dataset.keterangan = data.keterangan || '';
        row.dataset.file = data.file || '';

        row.querySelector('.nama-dokumen-value').textContent = data.nama_dokumen || '';
        row.querySelector('.tanggal-penetapan-value').textContent = formatDate(data.tanggal_penetapan);
        row.querySelector('.tanggal-revisi-value').textContent = data.tanggal_revisi ? formatDate(data.tanggal_revisi) : '-';
        row.querySelector('.keterangan-value').textContent = data.keterangan || '-';
        
        const link = row.querySelector('a');
        if (link && data.file) link.href = data.file;

        setupRipEditButton(row);
        console.log('✅ Row RIP updated');
        return;
    }

    // BUAT ROW BARU
    const emptyState = document.getElementById('emptyStateRipRow');
    if (emptyState) emptyState.remove();

    row = document.createElement('tr');
    row.id = `ripRow-${id}`;
    row.dataset.nama_dokumen = data.nama_dokumen || '';
    row.dataset.tanggal_penetapan = data.tanggal_penetapan || '';
    row.dataset.tanggal_revisi = data.tanggal_revisi || '';
    row.dataset.keterangan = data.keterangan || '';
    row.dataset.file = data.file || '';

    row.className = 'border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors';

    const rows = tbody.querySelectorAll('tr');
    const no = rows.length + 1;

    row.innerHTML = `
        <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">${no}</span>
        </td>
        <td class="px-4 py-3 nama-dokumen-value">${data.nama_dokumen || ''}</td>
        <td class="px-4 py-3">
            <a href="${data.file || '#'}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400">
                Download PDF
            </a>
        </td>
        <td class="px-4 py-3 tanggal-penetapan-value">${formatDate(data.tanggal_penetapan)}</td>
        <td class="px-4 py-3 tanggal-revisi-value">${data.tanggal_revisi ? formatDate(data.tanggal_revisi) : '-'}</td>
        <td class="px-4 py-3 keterangan-value">${data.keterangan || '-'}</td>
        <td class="px-4 py-3 text-center">
            <div class="flex items-center justify-center gap-1.5">
                <button type="button" class="btn-edit-rip inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30" title="Edit">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                    </svg> Edit
                </button>
                <button type="button" onclick="deleteRip(${id})" class="btn-delete-rip inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30" title="Hapus">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg> Hapus
                </button>
            </div>
        </td>
    `;

    setupRipEditButton(row);
    tbody.appendChild(row);
}

// ==========================================
// DELETE RIP
// ==========================================
function deleteRip(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        return;
    }

    fetch(`/fakultas/identitas-fakultas/dokumen/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(async response => {
        const data = await response.json();
        if (!response.ok) throw new Error(data.message || 'Terjadi kesalahan pada server.');
        return data;
    })
    .then(data => {
        if (!data.status) {
            window.toast.error(data.message || 'Gagal menghapus data');
            return;
        }
        
        const row = document.getElementById(`ripRow-${id}`);
        if (row) row.remove();
        
        const tbody = document.getElementById('ripTableBody');
        if (tbody && tbody.querySelectorAll('tr').length === 0) {
            tbody.innerHTML = `
                <tr id="emptyStateRipRow">
                    <td colspan="7" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="text-sm font-medium">Belum ada data Rencana Induk Pengembangan</span>
                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik tombol Tambah untuk menambahkan data</span>
                        </div>
                    </td>
                </tr>
            `;
        }
        
        window.toast.success(data.message || 'Data berhasil dihapus');
    })
    .catch(error => {
        console.error('RIP Delete Error:', error);
        window.toast.error(error.message || 'Terjadi kesalahan saat menghapus data');
    });
}

// ==========================================
// DOMContentLoaded
// ==========================================
document.addEventListener('DOMContentLoaded', function() {

    const formRip = document.getElementById('formRip');

    // ==========================================
    // INISIALISASI FLATPICKR
    // ==========================================
    const dateInputs = document.querySelectorAll('#modalRip .flatpickr-date');
    if (dateInputs.length > 0 && typeof flatpickr !== 'undefined') {
        window.flatpickrInstances = [];
        dateInputs.forEach(input => {
            const fp = flatpickr(input, {
                dateFormat: "Y-m-d",
                altFormat: "d/m/Y",
                altInput: true,
                allowInput: true,
                disableMobile: true,
                locale: { firstDayOfWeek: 1 }
            });
            if (fp) {
                window.flatpickrInstances.push(fp);
            }
        });
    } else {
        // Pastikan array tetap ada meskipun tidak ada flatpickr
        window.flatpickrInstances = [];
    }

    // ==========================================
    // INISIALISASI ROW EXISTING
    // ==========================================
    const existingRows = document.querySelectorAll('#ripTableBody tr:not(#emptyStateRipRow)');
    existingRows.forEach(row => {
        syncRipRowDataset(row);
        setupRipEditButton(row);
    });

    // ==========================================
    // SUBMIT FORM
    // ==========================================
    if (formRip) {
        formRip.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const id = document.getElementById('editIdRip').value;
            const url = this.action;
            const btn = document.getElementById('btnRipSubmit');
            const btnText = document.getElementById('btnRipText');

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
                    window.toast.error(data.message || 'Gagal menyimpan data');
                    return;
                }
                updateRipTable(data.data);
                window.toast.success(data.message || 'Data RIP berhasil disimpan');
                RipModal.close();
            })
            .catch(error => {
                console.error('RIP Error:', error);
                window.toast.error(error.message || 'Terjadi kesalahan saat menyimpan data');
            })
            .finally(() => {
                btn.disabled = false;
                btnText.textContent = id ? 'Update' : 'Simpan';
            });
        });
    }

});
</script>