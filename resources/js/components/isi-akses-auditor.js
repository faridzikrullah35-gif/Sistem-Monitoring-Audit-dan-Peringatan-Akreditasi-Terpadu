// resources/js/components/isi-akses-auditor.js

let editingRowId = null;
let originalRowData = {};

window.auditorList = window.auditorList || [];
window.currentAksesId = window.currentAksesId || null;

// =========================
// RESET MODAL
// =========================
window.resetAuditorModalState = function () {
    const form = document.getElementById('auditorForm');

    if (!form) return;

    form.reset();

    const aksesId = document.getElementById('setting_akses_auditor_id');
    if (aksesId) aksesId.value = '';

    form.querySelectorAll('input[type="radio"]').forEach(r => {
        r.checked = false;
    });

    window.dispatchEvent(new Event('reset-auditor-form'));

    const tableBody = document.getElementById('auditor-table-body');
    if (tableBody) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center py-6 text-gray-500">
                    Pilih data untuk melihat auditor
                </td>
            </tr>
        `;
    }

    window.currentAksesId = null;
};

// =========================
// OPEN MODAL
// =========================
window.openAuditorModal = function (id) {
    window.currentAksesId = id;

    const modal = document.getElementById('auditordataModal');
    document.getElementById('setting_akses_auditor_id').value = id;

    modal.classList.remove('hidden');

    window.loadAuditorTable(id);
};

// =========================
// LOAD TABLE
// =========================
window.loadAuditorTable = function (id) {
    if (!id) return;

    const tableBody = document.getElementById('auditor-table-body');

    if (!tableBody) return;

    tableBody.innerHTML = `
        <tr>
            <td colspan="3" class="text-center">Loading...</td>
        </tr>
    `;

    fetch(`/admin/ajax/isi-akses/${id}`)
        .then(res => res.json())
        .then(data => {
            if (id != window.currentAksesId) return;

            let html = '';

            if (!data.length) {
                html = `
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-900">
                        
                        <svg class="w-10 h-10 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>

                        <p class="text-sm font-medium">Belum ada auditor ditambahkan.</p>

                    </td>
                </tr>
                `;
            } else {
                data.forEach(item => {
                    html += `
                        <tr data-id="${item.id}" id="row-${item.id}" data-auditor-id="${item.auditor_id}" data-posisi="${item.posisi}"
                        class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">

                            <td class="px-4 py-3 font-medium" data-field="nama">
                                ${item.auditor?.nama_auditor ?? '-'}
                            </td>

                            <td class="px-4 py-3" data-field="posisi">
                                ${
                                    item.posisi === 'lead_auditor'
                                    ? `<span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Lead Auditor</span>`

                                    : item.posisi === 'anggota'
                                    ? `<span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Anggota</span>`

                                    : item.posisi === 'posisi_kepala_bidang_internal'
                                    ? `<span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Kepala Bidang Internal</span>`

                                    : item.posisi === 'posisi_kepala_lembaga_penjaminan_mutu'
                                    ? `<span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Kepala Lembaga Penjaminan Mutu</span>`

                                    : `<span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">${item.posisi}</span>`
                                }
                            </td>

                            <td class="px-4 py-3 text-center" data-field="aksi">
                                <div class="flex flex-wrap justify-center gap-2">

                                <!-- EDIT -->
                                <button type="button"
                                    onclick="editAuditor(${item.id})"
                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-amber-100 text-amber-700 rounded">

                                    <!-- pencil icon -->
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 4h-7a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>

                                    Edit
                                </button>

                                <!-- DELETE -->
                                <button type="button"
                                    onclick="deleteAuditor(${item.id})"
                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-red-500 text-white rounded"
                                >

                                    <!-- trash icon -->
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 7h12M9 7V4h6v3m1 0v14a2 2 0 01-2 2H8a2 2 0 01-2-2V7h10z" />
                                    </svg>

                                    Delete
                                </button>

                            </td>

                        </tr>
                    `;
                });
            }

            tableBody.innerHTML = html;
        });
};

// =========================
// EDIT MODE
// =========================
window.editAuditor = function (id) {

    const row = document.querySelector(`#row-${id}`);
    if (!row) return;

    const namaCell = row.querySelector('[data-field="nama"]');
    const posisiCell = row.querySelector('[data-field="posisi"]');
    const aksiCell = row.querySelector('[data-field="aksi"]');

    const list = window.auditorList || [];

    const currentNamaId = row.dataset.auditorId;
    const currentPosisi = row.dataset.posisi;

    originalRowData[id] = {
        namaHTML: namaCell.innerHTML,
        posisiHTML: posisiCell.innerHTML
    };

    namaCell.innerHTML = `
        <select id="edit-nama-${id}" class="border rounded px-2 py-1">
            ${list.map(a => `
                <option value="${a.id}" ${a.id == currentNamaId ? 'selected' : ''}>
                    ${a.nama_auditor}
                </option>
            `).join('')}
        </select>
    `;

    posisiCell.innerHTML = `
        <div class="flex gap-4">

            <label class="flex items-center gap-2">
                <input type="radio" name="edit-posisi-${id}" value="lead_auditor"
                    ${currentPosisi === 'lead_auditor' ? 'checked' : ''}>
                <span class="text-sm">Lead</span>
            </label>

            <label class="flex items-center gap-2">
                <input type="radio" name="edit-posisi-${id}" value="anggota"
                    ${currentPosisi === 'anggota' ? 'checked' : ''}>
                <span class="text-sm">Anggota</span>
            </label>

        </div>
    `;

    aksiCell.innerHTML = `
        <div class="flex gap-2 justify-center">
            <button type="button" onclick="saveAuditor(${id})"
                class="px-2 py-1 text-xs bg-green-500 text-white rounded">
                Simpan
            </button>

            <button type="button" onclick="cancelEdit(${id})"
                class="px-2 py-1 text-xs bg-gray-400 text-white rounded">
                Batal
            </button>
        </div>
    `;
};

// =========================
// CANCEL
// =========================
window.cancelEdit = function (id) {

    const row = document.querySelector(`#row-${id}`);
    const original = originalRowData[id];

    if (!row || !original) return;

    row.querySelector('[data-field="nama"]').innerHTML = original.namaHTML;
    row.querySelector('[data-field="posisi"]').innerHTML = original.posisiHTML;

    row.querySelector('[data-field="aksi"]').innerHTML = `
        <button type="button"
            onclick="editAuditor(${id})"
            class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-amber-100 text-amber-700 rounded">
            
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 4h-7a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>

            Edit
        </button>

        <button type="button"
            onclick="deleteAuditor(${id})"
            class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-red-500 text-white rounded">

            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 7h12M9 7V4h6v3m1 0v14a2 2 0 01-2 2H8a2 2 0 01-2-2V7h10z" />
            </svg>

            Delete
        </button>
    `;

    editingRowId = null;
};

// =========================
// SAVE
// =========================
window.saveAuditor = function (id) {

    const namaEl = document.getElementById(`edit-nama-${id}`);
    const namaId = namaEl ? namaEl.value : null;

    const posisi = document.querySelector(
        `input[name="edit-posisi-${id}"]:checked`
    )?.value;

    fetch(`/admin/isi-akses-auditor/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            auditor_id: namaId,
            posisi: posisi
        })
    })
    .then(async (res) => {

        if (!res.ok) {
            const text = await res.text();
            console.error('Server Error:', text);
            throw new Error('Request failed');
        }

        return res.json();
    })
    .then(() => {
        editingRowId = null;
        window.loadAuditorTable(window.currentAksesId);
    })
    .catch(err => {
        console.error(err);
        alert('Gagal update data. Coba lagi.');
    });
};

window.confirmDelete = function (title, message, onConfirm) {

    const modal = document.getElementById('globalConfirmModal');
    const titleEl = document.getElementById('confirmTitle');
    const messageEl = document.getElementById('confirmMessage');
    const okBtn = document.getElementById('confirmOkBtn');
    const cancelBtn = document.getElementById('confirmCancelBtn');
    const backdrop = document.getElementById('confirmBackdrop');

    titleEl.innerText = title || 'Konfirmasi';
    messageEl.innerText = message || 'Yakin ingin melanjutkan?';

    modal.classList.remove('hidden');

    const closeModal = () => {
        modal.classList.add('hidden');
        okBtn.onclick = null;
        cancelBtn.onclick = null;
        backdrop.onclick = null;
    };

    okBtn.onclick = () => {
        closeModal();
        onConfirm?.();
    };

    cancelBtn.onclick = closeModal;
    backdrop.onclick = closeModal;
};

window.deleteAuditor = function (id) {

    confirmDelete(
        'Hapus Auditor',
        'Yakin mau hapus auditor ini?',
        () => {

            fetch(`/admin/isi-akses-auditor/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(async (res) => {

                if (!res.ok) {
                    const text = await res.text();
                    console.error(text);
                    throw new Error();
                }

                return res.json();
            })
            .then(() => {
                window.loadAuditorTable(window.currentAksesId);

                toastr.success('Auditor berhasil dihapus');
            })
            .catch(() => {
                toastr.error('Gagal menghapus data. Coba lagi.');
            });

        }
    );
};

// =========================
// CLOSE MODAL
// =========================
window.closeAuditorModal = function () {
    const modal = document.getElementById('auditordataModal');
    modal.classList.add('hidden');

    window.resetAuditorModalState();
};