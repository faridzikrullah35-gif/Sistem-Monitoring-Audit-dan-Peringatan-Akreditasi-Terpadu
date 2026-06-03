// =========================
// STATE
// =========================
const state = {
    tempIndikators: [],
    editingId: null,
};

// =========================
// INIT
// =========================
document.addEventListener('DOMContentLoaded', initIndikatorModule);

function initIndikatorModule() {
    const form = document.getElementById('indikatorForm');
    if (form) form.addEventListener('submit', handleIndikatorSubmit);
}

// =========================
// HELPERS
// =========================
const el = (id) => document.getElementById(id);

const getCSRF = () =>
    document.querySelector('meta[name="csrf-token"]')?.content;

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// =========================
// SUBMIT
// =========================
async function handleIndikatorSubmit(e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    const input = el('indikator_input')?.value.trim();
    if (!input) return window.toast?.error('Indikator tidak boleh kosong');

    try {
        const res = await fetch(e.target.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': getCSRF() },
            body: new FormData(e.target),
        });

        const result = await res.json();
        window.toast?.success(result.message);

        resetInput();
        resetEditMode();
        await syncIndikatorFromDB();

    } catch (err) {
        console.error(err);
        window.toast?.error('Gagal menyimpan data');
    }
}

// =========================
// SYNC
// =========================
async function syncIndikatorFromDB() {
    const elemenId = el('indikator_elemen_id')?.value;

    const res = await fetch(`/admin/indikator/by-elemen/${elemenId}`);
    const result = await res.json();

    state.tempIndikators = (result.data || []).map(item => ({
        id: item.id,
        text: item.indikator,
    }));

    renderIndikatorTable();
}

// =========================
// EDIT MODE
// =========================
function editIndikatorRow(id) {
    const item = state.tempIndikators.find(i => i.id === id);
    if (!item) return;

    state.editingId = id;

    el('indikator_input').value = item.text;
    el('indikator_input').focus();
    el('indikatorLabel').textContent = 'Edit Indikator';

    renderIndikatorTable();
}

function resetEditMode() {
    state.editingId = null;

    resetInput();
    if (el('indikatorLabel')) {
        el('indikatorLabel').textContent = 'Tambah Indikator';
    }
}

function resetInput() {
    const input = el('indikator_input');
    if (input) input.value = '';
}

function cancelEditRow() {
    resetEditMode();
    renderIndikatorTable();
}

// =========================
// UPDATE
// =========================
function saveEditRow(id) {
    const text = el('indikator_input')?.value.trim();
    if (!text) return;

    fetch(`/admin/indikator/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRF(),
        },
        body: JSON.stringify({ indikator_input: text }),
    })
        .then(r => r.json())
        .then(res => {
            window.toast?.success(res.message);

            const item = state.tempIndikators.find(i => i.id === id);
            if (item) item.text = text;

            resetEditMode();
            renderIndikatorTable();
        });
}

// =========================
// DELETE
// =========================
function deleteIndikatorRow(id) {
    window.confirmDelete(
        'Hapus Indikator',
        'Yakin mau hapus indikator ini? Data tidak bisa dikembalikan.',
        () => {
            fetch(`/admin/indikator/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': getCSRF() },
            })
                .then(r => r.json())
                .then(res => {
                    window.toast?.success(res.message);

                    state.tempIndikators =
                        state.tempIndikators.filter(i => i.id !== id);

                    renderIndikatorTable();
                });
        }
    );
}

// =========================
// RENDER TABLE
// =========================
function renderIndikatorTable() {
    const tbody = el('indikatorTableBody');
    if (!tbody) return;

    tbody
        .querySelectorAll('tr:not(#indikatorEmptyRow):not(#loadingRow)')
        .forEach(r => r.remove());

    if (!state.tempIndikators.length) {
        setTableState('empty');
        return;
    }

    setTableState('data');

    state.tempIndikators.forEach((item, index) => {
        const isEditing =
            String(state.editingId) === String(item.id);

        const tr = document.createElement('tr');
        tr.className =
            'hover:bg-gray-50/80 dark:hover:bg-gray-700/20 transition-colors duration-150';

        tr.innerHTML = `
            <td class="px-4 py-3 text-center text-xs font-mono text-gray-400">
                ${index + 1}
            </td>

            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                ${escapeHtml(item.text)}
            </td>

            <td class="px-4 py-3">
    <div class="flex items-center justify-center gap-2">
        ${
            isEditing
                ? `
                <button
                    type="button"
                    onclick="saveEditRow(${item.id})"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium text-green-700 bg-green-50 rounded-lg hover:bg-green-100 transition"
                >
                    Simpan Edit
                </button>

                <button
                    type="button"
                    onclick="cancelEditRow()"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition"
                >
                    Batal
                </button>
            `
                : `
                <button
                    type="button"
                    onclick="editIndikatorRow(${item.id})"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium text-amber-700 bg-amber-50 rounded-lg hover:bg-amber-100 transition"
                >
                    Edit
                </button>

                <button
                    type="button"
                    onclick="deleteIndikatorRow(${item.id})"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition"
                >
                    Hapus
                </button>
            `
        }
    </div>
</td>
        `;

        tbody.appendChild(tr);
    });
}

// =========================
// TABLE STATE
// =========================
function setTableState(stateType) {
    const loading = el('loadingRow');
    const empty = el('indikatorEmptyRow');

    if (!loading || !empty) return;

    loading.classList.toggle('hidden', stateType !== 'loading');
    empty.classList.toggle('hidden', stateType === 'data');
}

// =========================
// MODAL CONTROL
// =========================
async function openIndikatorModal(elemenId, elemenLabel) {
    const modal = el('indikatorModal');
    const form = el('indikatorForm');

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');

    state.tempIndikators = [];
    renderIndikatorTable();

    el('indikator_elemen_id').value = elemenId ?? '';
    el('indikator_elemen_label').textContent = elemenLabel ?? '-';

    form.action = '/admin/indikator/store';

    if (elemenId) await syncIndikatorFromDB();
}

function closeIndikatorModal() {
    el('indikatorModal')?.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');

    state.tempIndikators = [];
    state.editingId = null;
}

document.addEventListener('DOMContentLoaded', () => {
    initIndikatorModule();
    exposeToWindow();
});

// =========================
// EXPORT TO GLOBAL (ONLY WHAT HTML NEEDS)
// =========================
function exposeToWindow() {
    window.editIndikatorRow = editIndikatorRow;
    window.deleteIndikatorRow = deleteIndikatorRow;
    window.saveEditRow = saveEditRow;
    window.cancelEditRow = cancelEditRow;
    window.openIndikatorModal = openIndikatorModal;
    window.closeIndikatorModal = closeIndikatorModal;
}