<!-- Modal MOU -->
<div id="modalMou" tabindex="-1" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6">
    <div class="mx-4 w-full max-w-md animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
        
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 id="modalMouTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah MoU / MoA</h3>
            </div>
            <button type="button" onclick="closeModalMou()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formMou" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethodMou" value="POST">
            <input type="hidden" name="id" id="editIdMou" value="">
            <input type="hidden" name="kategori" value="MOU">
            <input type="hidden" name="old_file" id="oldFileMou" value="">
            
            <div class="space-y-5 px-6 py-5">
                {{-- Nama Dokumen --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dokumen <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_dokumen" id="namaDokumenMou" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400" placeholder="Masukkan nama dokumen..." />
                </div>

                {{-- File Dokumen --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">File Dokumen <span class="text-red-500" id="fileRequiredMou">*</span></label>
                    <input type="file" name="file" id="fileMou" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/20 dark:file:text-blue-300" />
                    <small class="text-xs text-gray-500 dark:text-gray-400">*Wajib untuk tambah, kosongkan jika tidak ingin mengganti file saat edit</small>
                    <div id="currentFileInfoMou" class="hidden mt-2 text-xs text-gray-600 dark:text-gray-400">File saat ini: <span id="currentFileNameMou" class="font-medium"></span></div>
                </div>

                {{-- Tanggal Penetapan --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penetapan <span class="text-red-500">*</span></label>
                    <input type="text" name="tanggal_penetapan" id="tanggalPenetapanMou" required class="flatpickr-date w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400" placeholder="dd/mm/yyyy" />
                </div>

                {{-- Tanggal Berakhir --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Berakhir</label>
                    <input type="text" name="tanggal_revisi" id="tanggalRevisiMou" class="flatpickr-date w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400" placeholder="dd/mm/yyyy" />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Isi tanggal berakhir masa berlaku dokumen kerjasama.</p>
                </div>

                {{-- Tingkat Kerjasama --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat (Wilayah/Lokal, nasional, internasional)</label>
                    <textarea name="keterangan" id="keteranganMou" rows="3" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-400" placeholder="Masukkan tingkat kerjasama, misalnya: Wilayah/Lokal, Nasional, atau Internasional..."></textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Wilayah/Lokal, Nasional, atau Internasional.</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalMou()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    Batal
                </button>
                <button type="submit" id="btnMouSubmit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    <span id="btnMouText">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity:0; transform:scale(0.95); } to { opacity:1; transform:scale(1); } }
    #mouTableBody td { vertical-align: middle; }
    #mouTableBody tr:hover td { background-color: rgba(59, 130, 246, 0.02); }
    .dark #mouTableBody tr:hover td { background-color: rgba(59, 130, 246, 0.05); }
    .flatpickr-calendar.dark { background: #1f2937 !important; border-color: #374151 !important; }
    .flatpickr-calendar.dark .flatpickr-day { color: #d1d5db !important; }
    .flatpickr-calendar.dark .flatpickr-day.selected { background: #3b82f6 !important; border-color: #3b82f6 !important; }
    .flatpickr-calendar.dark .flatpickr-day:hover { background: #374151 !important; }
</style>

<script>
function formatMouDate(date) {
    if (!date) return '-';
    const value = String(date).slice(0, 10);
    const parts = value.split('-');
    if (parts.length === 3) {
        const [year, month, day] = parts;
        if (year && month && day) return `${day}/${month}/${year}`;
    }
    const d = new Date(date);
    if (isNaN(d.getTime())) return '-';
    return d.toLocaleDateString('id-ID');
}

function getExpiryHtml(date) {
    if (!date) return '<span class="text-gray-400 dark:text-gray-500">-</span>';
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const value = String(date).slice(0, 10);
    const parts = value.split('-');
    if (parts.length !== 3) return '<span class="text-gray-400 dark:text-gray-500">-</span>';
    const [year, month, day] = parts.map(Number);
    if (!year || !month || !day) return '<span class="text-gray-400 dark:text-gray-500">-</span>';
    const end = new Date(year, month - 1, day);
    end.setHours(0, 0, 0, 0);
    const diff = Math.round((end - today) / 86400000);
    if (diff > 0) return `<span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700 dark:bg-green-900/30 dark:text-green-400">${diff} hari lagi</span>`;
    if (diff === 0) return `<span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">Kadaluarsa hari ini</span>`;
    return `<span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">Kadaluarsa ${Math.abs(diff)} hari lalu</span>`;
}

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
}

const MouModal = {
    open(id = null) {
        const modal = document.getElementById('modalMou');
        const title = document.getElementById('modalMouTitle');
        const form = document.getElementById('formMou');
        const hiddenId = document.getElementById('editIdMou');
        const methodInput = document.getElementById('formMethodMou');
        const fileInput = document.getElementById('fileMou');
        const fileRequired = document.getElementById('fileRequiredMou');
        const currentFileInfo = document.getElementById('currentFileInfoMou');
        if (!modal || !form) { console.error('Modal MOU tidak ditemukan.'); return; }
        this.resetForm();
        if (id) {
            title.textContent = 'Ubah MoU / MoA';
            hiddenId.value = id;
            form.action = `/fakultas/identitas-fakultas/dokumen/${id}`;
            methodInput.value = 'PUT';
            fileRequired.textContent = '(kosongkan jika tidak ingin mengganti)';
            fileInput.removeAttribute('required');
        } else {
            title.textContent = 'Tambah MoU / MoA';
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
        const modal = document.getElementById('modalMou');
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        setTimeout(() => this.resetForm(), 0);
    },
    resetForm() {
        const form = document.getElementById('formMou');
        if (form) { form.reset(); form.action = '/fakultas/identitas-fakultas/dokumen'; }
        const instances = window.flatpickrInstancesMou;
        if (instances && Array.isArray(instances)) {
            instances.forEach(fp => { if (fp && typeof fp.clear === 'function') fp.clear(); });
        }
        const hiddenId = document.getElementById('editIdMou');
        if (hiddenId) hiddenId.value = '';
        const methodInput = document.getElementById('formMethodMou');
        if (methodInput) methodInput.value = 'POST';
        const title = document.getElementById('modalMouTitle');
        if (title) title.textContent = 'Tambah MoU / MoA';
        const btnText = document.getElementById('btnMouText');
        const btn = document.getElementById('btnMouSubmit');
        if (btnText) btnText.textContent = 'Simpan';
        if (btn) btn.disabled = false;
        const fileRequired = document.getElementById('fileRequiredMou');
        const fileInput = document.getElementById('fileMou');
        if (fileRequired) fileRequired.textContent = '*';
        if (fileInput) { fileInput.setAttribute('required', 'required'); fileInput.value = ''; }
        const currentFileInfo = document.getElementById('currentFileInfoMou');
        if (currentFileInfo) currentFileInfo.classList.add('hidden');
        const currentFileName = document.getElementById('currentFileNameMou');
        if (currentFileName) currentFileName.textContent = '';
        const oldFile = document.getElementById('oldFileMou');
        if (oldFile) oldFile.value = '';
        const modal = document.getElementById('modalMou');
        if (modal) modal.scrollTop = 0;
    }
};

function openModalMou(id = null) { MouModal.open(id); }
function closeModalMou() { MouModal.close(); }

function openEditMouDirect(id, nama_dokumen = '', tanggal_penetapan = '', tanggal_revisi = '', keterangan = '', file = '') {
    const modal = document.getElementById('modalMou');
    const title = document.getElementById('modalMouTitle');
    const form = document.getElementById('formMou');
    const hiddenId = document.getElementById('editIdMou');
    const methodInput = document.getElementById('formMethodMou');
    const btnText = document.getElementById('btnMouText');
    const fileRequired = document.getElementById('fileRequiredMou');
    const fileInput = document.getElementById('fileMou');
    const currentFileInfo = document.getElementById('currentFileInfoMou');
    const currentFileName = document.getElementById('currentFileNameMou');
    if (!modal || !form) { console.error('Modal MOU tidak ditemukan.'); return; }
    MouModal.resetForm();
    const namaInput = document.getElementById('namaDokumenMou');
    const oldFileInput = document.getElementById('oldFileMou');
    const keteranganInput = document.getElementById('keteranganMou');
    if (namaInput) namaInput.value = nama_dokumen || '';
    if (oldFileInput) oldFileInput.value = file || '';
    if (keteranganInput) keteranganInput.value = keterangan || '';
    const instances = window.flatpickrInstancesMou;
    if (instances && Array.isArray(instances) && instances.length >= 2) {
        const fpPenetapan = instances[0];
        const fpBerakhir = instances[1];
        if (fpPenetapan && typeof fpPenetapan.setDate === 'function') {
            if (tanggal_penetapan) fpPenetapan.setDate(tanggal_penetapan);
            else fpPenetapan.clear();
        }
        if (fpBerakhir && typeof fpBerakhir.setDate === 'function') {
            if (tanggal_revisi) fpBerakhir.setDate(tanggal_revisi);
            else fpBerakhir.clear();
        }
    }
    if (file) {
        if (currentFileInfo) currentFileInfo.classList.remove('hidden');
        if (currentFileName) {
            const fileName = String(file).split('/').pop();
            currentFileName.textContent = fileName;
        }
    } else {
        if (currentFileInfo) currentFileInfo.classList.add('hidden');
        if (currentFileName) currentFileName.textContent = '';
    }
    title.textContent = 'Ubah MoU / MoA';
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

function syncMouRowDataset(row) {
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

function setupMouEditButton(row) {
    if (!row) return;
    const editBtn = row.querySelector('.btn-edit-mou');
    if (!editBtn) return;
    editBtn.onclick = function(e) { e.preventDefault(); openEditMouFromRow(row); };
}

function openEditMouFromRow(row) {
    if (!row) return;
    syncMouRowDataset(row);
    const id = row.id.replace('mouRow-', '');
    const nama_dokumen = row.dataset.nama_dokumen || '';
    const tanggal_penetapan = row.dataset.tanggal_penetapan || '';
    const tanggal_revisi = row.dataset.tanggal_revisi || '';
    const keterangan = row.dataset.keterangan || '';
    const file = row.dataset.file || '';
    openEditMouDirect(id, nama_dokumen, tanggal_penetapan, tanggal_revisi, keterangan, file);
}

function updateMouFileCell(cell, fileUrl) {
    if (!cell) return;
    if (fileUrl) {
        cell.innerHTML = `
            <a href="${escapeHtml(fileUrl)}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Download PDF
            </a>
        `;
    } else {
        cell.innerHTML = `<span class="text-gray-400 dark:text-gray-500">File tidak tersedia</span>`;
    }
}

function updateMouTable(data) {
    const tbody = document.getElementById('mouTableBody');
    if (!tbody || !data) return;
    const id = data.id;
    if (!id) { console.error('Data MOU tidak memiliki ID:', data); return; }
    let row = document.getElementById(`mouRow-${id}`);
    const fileUrl = data.file || data.file_path || '';
    if (row) {
        row.dataset.nama_dokumen = data.nama_dokumen || '';
        row.dataset.tanggal_penetapan = data.tanggal_penetapan || '';
        row.dataset.tanggal_revisi = data.tanggal_revisi || '';
        row.dataset.keterangan = data.keterangan || '';
        row.dataset.file = fileUrl;
        const namaCell = row.querySelector('.nama-dokumen-value');
        if (namaCell) namaCell.textContent = data.nama_dokumen || '';
        const penetapanCell = row.querySelector('.tanggal-penetapan-value');
        if (penetapanCell) penetapanCell.textContent = formatMouDate(data.tanggal_penetapan);
        const revisiCell = row.querySelector('.tanggal-revisi-value');
        if (revisiCell) revisiCell.textContent = data.tanggal_revisi ? formatMouDate(data.tanggal_revisi) : '-';
        const expiryCell = row.querySelector('.sisa-kadaluarsa-value');
        if (expiryCell) expiryCell.innerHTML = getExpiryHtml(data.tanggal_revisi);
        const keteranganCell = row.querySelector('.keterangan-value');
        if (keteranganCell) keteranganCell.textContent = data.keterangan || '-';
        const fileCell = row.querySelector('.file-value');
        if (fileCell) updateMouFileCell(fileCell, fileUrl);
        setupMouEditButton(row);
        return;
    }
    const emptyState = document.getElementById('emptyStateMouRow');
    if (emptyState) emptyState.remove();
    row = document.createElement('tr');
    row.id = `mouRow-${id}`;
    row.dataset.nama_dokumen = data.nama_dokumen || '';
    row.dataset.tanggal_penetapan = data.tanggal_penetapan || '';
    row.dataset.tanggal_revisi = data.tanggal_revisi || '';
    row.dataset.keterangan = data.keterangan || '';
    row.dataset.file = fileUrl;
    row.className = 'border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors';
    const existingRows = tbody.querySelectorAll('tr');
    const no = existingRows.length + 1;
    const fileHtml = fileUrl
        ? `<a href="${escapeHtml(fileUrl)}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            Download PDF
        </a>`
        : `<span class="text-gray-400 dark:text-gray-500">File tidak tersedia</span>`;
    row.innerHTML = `
        <td class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">${no}</span>
        </td>
        <td class="px-4 py-3 nama-dokumen-value">${escapeHtml(data.nama_dokumen || '')}</td>
        <td class="px-4 py-3 file-value">${fileHtml}</td>
        <td class="px-4 py-3 tanggal-penetapan-value">${formatMouDate(data.tanggal_penetapan)}</td>
        <td class="px-4 py-3 tanggal-revisi-value">${data.tanggal_revisi ? formatMouDate(data.tanggal_revisi) : '-'}</td>
        <td class="px-4 py-3 sisa-kadaluarsa-value">${getExpiryHtml(data.tanggal_revisi)}</td>
        <td class="px-4 py-3 keterangan-value">${escapeHtml(data.keterangan || '-')}</td>
        <td class="px-4 py-3 text-center">
            <div class="flex items-center justify-center gap-1.5">
                <button type="button" class="btn-edit-mou inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30" title="Edit">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 002 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z" /></svg>
                    Edit
                </button>
                <button type="button" onclick="deleteMou(${id})" class="btn-delete-mou inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30" title="Hapus">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    Hapus
                </button>
            </div>
        </td>
    `;
    setupMouEditButton(row);
    tbody.appendChild(row);
}

document.addEventListener('DOMContentLoaded', function() {
    const formMou = document.getElementById('formMou');
    const dateInputs = document.querySelectorAll('#modalMou .flatpickr-date');
    if (dateInputs.length > 0 && typeof flatpickr !== 'undefined') {
        window.flatpickrInstancesMou = [];
        dateInputs.forEach(input => {
            const fp = flatpickr(input, {
                dateFormat: 'Y-m-d',
                altFormat: 'd/m/Y',
                altInput: true,
                allowInput: true,
                disableMobile: true,
                locale: { firstDayOfWeek: 1 }
            });
            if (fp) window.flatpickrInstancesMou.push(fp);
        });
    } else {
        window.flatpickrInstancesMou = [];
    }
    const existingRows = document.querySelectorAll('#mouTableBody tr:not(#emptyStateMouRow)');
    existingRows.forEach(row => {
        syncMouRowDataset(row);
        setupMouEditButton(row);
    });
    if (formMou) {
        formMou.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('editIdMou').value;
            const url = this.action;
            const btn = document.getElementById('btnMouSubmit');
            const btnText = document.getElementById('btnMouText');
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
                updateMouTable(data.data);
                window.toast.success(data.message || 'Data MOU berhasil disimpan');
                MouModal.close();
            })
            .catch(error => {
                console.error('MOU Error:', error);
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