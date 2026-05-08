// ============================================================
// GLOBAL STATE
// ============================================================

let pendingConfirmAction = null;

// Config select refresh
const SELECT_REFRESH_CONFIG = {
    standar_id: '/standar/data',
};

// ============================================================
// HELPER FETCH WRAPPER (biar gak nulis ulang fetch terus)
// ============================================================

const apiRequest = async (url, options = {}) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    const response = await fetch(url, {
        headers: {
            'X-CSRF-TOKEN': csrfToken?.content,
            'Accept': 'application/json',
            ...options.headers,
        },
        ...options,
    });

    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        throw data;
    }

    return data;
};

// ============================================================
// SELECT BOX SYSTEM (UNIVERSAL)
// ============================================================

window.refreshSelectBox = async (selectId, url = null) => {
    const select = document.getElementById(selectId);
    if (!select) return false;

    const endpoint = url || SELECT_REFRESH_CONFIG[selectId];
    if (!endpoint) return false;

    try {
        const data = await apiRequest(endpoint);

        let items = [];
        if (Array.isArray(data)) items = data;
        else items = data.data || data.standars || data.kategoris || data.units || data.users || [];

        if (!items.length) return false;

        const oldValue = select.value;

        // reset options (keep placeholder)
        select.options.length = 1;

        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nama || item.name || item.label || 'No name';
            select.appendChild(option);
        });

        // restore value if exists
        if ([...select.options].some(o => o.value == oldValue)) {
            select.value = oldValue;
        }

        return true;

    } catch (err) {
        console.error('[refreshSelectBox]', err);
        return false;
    }
};

window.refreshSelectBoxes = async (ids = []) => {
    return Promise.all(ids.map(id => window.refreshSelectBox(id)));
};

window.refreshAllRegisteredSelects = async () => {
    return window.refreshSelectBoxes(Object.keys(SELECT_REFRESH_CONFIG));
};

window.registerSelectBox = (id, url) => {
    SELECT_REFRESH_CONFIG[id] = url;
};

// ============================================================
// MODAL CONFIRM SYSTEM
// ============================================================

window.showConfirmDialog = (title, message, onConfirm) => {
    const modal = document.getElementById('globalConfirmModal');
    if (!modal) return;

    document.getElementById('confirmTitle').innerText = title || 'Konfirmasi';
    document.getElementById('confirmMessage').innerText = message || 'Yakin?';

    pendingConfirmAction = onConfirm;
    modal.classList.remove('hidden');
};

window.closeConfirmDialog = () => {
    document.getElementById('globalConfirmModal')?.classList.add('hidden');
    pendingConfirmAction = null;
};

// ============================================================
// TABLE REFRESH HELPER (OPTIONAL HOOK)
// ============================================================

window.refreshTable = async (tableId) => {
    const el = document.querySelector(tableId);
    if (!el) return false;

    const url = el.dataset.url;
    if (!url) return false;

    try {
        const res = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await res.text();

        const temp = document.createElement('div');
        temp.innerHTML = html;

        const newTable = temp.querySelector(tableId);

        if (!newTable) return false;

        el.innerHTML = newTable.innerHTML;

        return true;

    } catch (err) {
        console.error('[refreshTable]', err);
        return false;
    }
};

// ============================================================
// UNIVERSAL DELETE (ONLY ONE SOURCE OF TRUTH)
// ============================================================

window.executeDelete = async ({
    url,
    tableId = null,
    successMessage = 'Data berhasil dihapus',
    refreshSelects = null,
}) => {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Gagal menghapus data');
        }

        if (window.toast) window.toast.success(data.message || successMessage);
        else toastr.success(data.message || successMessage);

        // refresh select
        if (refreshSelects) {
            const ids = Array.isArray(refreshSelects) ? refreshSelects : [refreshSelects];
            await window.refreshSelectBoxes(ids);
        } else {
            await window.refreshAllRegisteredSelects();
        }

        // refresh table
        if (tableId) {
            const ok = await window.refreshTable(tableId);

            if (!ok) {
                console.warn('Table refresh failed, but NOT reloading page');
            }
        }

    } catch (err) {
        console.error('[executeDelete]', err);

        const msg = err?.message || 'Terjadi kesalahan';

        if (window.toast) window.toast.error(msg);
        else toastr.error(msg);
    }
};

// ============================================================
// PAGE-SPECIFIC WRAPPER (CLEAN & SIMPLE)
// ============================================================

const confirmDelete = (title, message, action) => {
    showConfirmDialog(title, message, async () => {
        await action();
        closeConfirmDialog();
    });
};

// ============================================================
// ENTITY DELETE ACTIONS
// ============================================================

window.confirmDeleteTahunAkademik = (id) => {
    confirmDelete(
        'Konfirmasi Hapus',
        'Yakin ingin menghapus tahun akademik ini?',
        () => executeDelete({
            url: `/setting-tahun-akademik/delete/${id}`,
            tableId: '#tahunAkademikTableContainer',
            successMessage: 'Tahun akademik berhasil dihapus',
        })
    );
};

window.confirmDeleteAuditor = (id) => {
    confirmDelete(
        'Konfirmasi Hapus',
        'Yakin ingin menghapus data auditor ini?',
        () => executeDelete({
            url: `/data-auditor/delete/${id}`,
            tableId: '#auditorTableContainer',
        })
    );
};

window.confirmDeleteStandar = (id) => {
    confirmDelete(
        'Konfirmasi Hapus',
        'Yakin ingin menghapus standar ini?',
        () => executeDelete({
            url: `/standar/delete/${id}`,
            tableId: '#standarTableContainer',
            refreshSelects: 'standar_id',
        })
    );
};

window.confirmDeleteKriteria = (id) => {
    confirmDelete(
        'Konfirmasi Hapus',
        'Yakin ingin menghapus sub kriteria ini?',
        () => executeDelete({
            url: `/setting-kriteria/${id}`,
            tableId: '#kriteria_audit',
            refreshSelects: 'standar_id',
        })
    );
};

window.deleteAksesAuditor = (id) => {
    confirmDelete(
        'Konfirmasi Hapus',
        'Yakin ingin menghapus data auditor ini?',
        () => executeDelete({
            url: `/setting-akses-auditor/${id}`,
            tableId: '#akses_auditor_table',
            refreshSelects: 'user_id',
        })
    );
};

window.deleteMatrix = (id) => {
    confirmDelete(
        'Konfirmasi Hapus',
        'Yakin ingin menghapus data matrix ini?',
        () => executeDelete({
            url: `/matrix/delete/${id}`,
            tableId: '#matrixTableContainer',
        })
    );
};

// window.deletePertanyaanAmiProdi = (id) => {

//     confirmDelete(
//         'Konfirmasi Hapus',
//         'Yakin ingin menghapus indikator ini?',
//         () => executeDelete({
//             url: `/pertanyaan-ami-prodi/${id}`,
//             method: 'DELETE',
//             tableId: '#pertanyaanAmiProdiTableContainer',
//         })
//     );

// };

// ============================================================
// DOM INIT (SIMPLIFIED)
// ============================================================

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('confirmCancelBtn')
        ?.addEventListener('click', window.closeConfirmDialog);

    document.getElementById('confirmBackdrop')
        ?.addEventListener('click', window.closeConfirmDialog);

    document.getElementById('confirmOkBtn')
        ?.addEventListener('click', () => {
            pendingConfirmAction?.();
        });

    document.querySelectorAll('[data-action="delete"]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const url = btn.dataset.url;
            const message = btn.dataset.confirm;

            confirmDelete(
                'Konfirmasi Hapus',
                message,
                () => executeDelete({ url })
            );
        });
    });

    console.log('[Init] system ready');
});