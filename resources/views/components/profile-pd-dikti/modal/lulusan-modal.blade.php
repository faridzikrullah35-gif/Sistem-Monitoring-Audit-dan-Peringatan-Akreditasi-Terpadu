{{-- Modal Tambah/Ubah Data Lulusan --}}
<div id="userModalLulusan" tabindex="-1" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6">
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="modalFormTitleLulusan" class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah Data Lulusan</h3>
            </div>
            <button type="button" onclick="closeModalLulusan()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formLulusan" method="POST" class="needs-validation" novalidate data-base-url="{{ url('/fakultas/profile-pd-dikti/lulusan') }}">
            @csrf
            <input type="hidden" id="lulusanId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethodLulusan" value="POST" />

            <div class="space-y-5 px-6 py-5">

                {{-- Nama Prodi --}}
                <div>
                    <label for="namaProdi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Prodi <span class="text-red-500">*</span></label>
                    <input type="text" id="namaProdi" name="nama_prodi" required placeholder="Masukkan Nama Program Studi" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Jumlah Lulusan per TA --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Lulusan <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-10 text-sm font-medium text-gray-600 dark:text-gray-400">TA-3</span>
                            <input type="number" name="ta_3" id="ta_3_lulusan" value="0" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-10 text-sm font-medium text-gray-600 dark:text-gray-400">TA-2</span>
                            <input type="number" name="ta_2" id="ta_2_lulusan" value="0" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-10 text-sm font-medium text-gray-600 dark:text-gray-400">TA-1</span>
                            <input type="number" name="ta_1" id="ta_1_lulusan" value="0" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-10 text-sm font-medium text-gray-600 dark:text-gray-400">TA</span>
                            <input type="number" name="ta" id="ta_lulusan" value="0" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                        </div>
                    </div>
                </div>

                {{-- Preview Persentase Penurunan --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Preview Persentase Penurunan</label>
                    <div class="rounded-lg border border-blue-200 bg-blue-50 p-3 dark:border-blue-700 dark:bg-blue-900/20">
                        <p class="text-sm font-semibold text-blue-600 dark:text-blue-300"><span id="previewPenurunan">0%</span></p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">* Dihitung dari ((TA-1 - TA) / TA-1) × 100</p>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalLulusan()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
                    Batal
                </button>
                <button type="submit" id="btnLulusanSubmit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    <span id="btnTextLulusan">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity:0; transform:scale(0.95); } to { opacity:1; transform:scale(1); } }
</style>

<script>
const LULUSAN_BASE_URL = @json(url('/fakultas/profile-pd-dikti/lulusan'));

function updatePreviewPenurunan() {
    const ta_1 = parseInt(document.getElementById('ta_1_lulusan')?.value) || 0;
    const ta = parseInt(document.getElementById('ta_lulusan')?.value) || 0;
    const preview = document.getElementById('previewPenurunan');
    if (!preview) return;
    if (ta_1 > 0) {
        const penurunan = ((ta_1 - ta) / ta_1) * 100;
        const formatted = penurunan.toFixed(2);
        let warna = 'text-blue-600 dark:text-blue-300';
        if (penurunan > 50) warna = 'text-red-600 dark:text-red-400';
        else if (penurunan > 25) warna = 'text-yellow-600 dark:text-yellow-400';
        else if (penurunan > 0) warna = 'text-green-600 dark:text-green-400';
        preview.innerHTML = `<span class="${warna}">${formatted}%</span>`;
    } else {
        preview.textContent = '0%';
    }
}

const LulusanModal = {
    open(id = null) {
        const modal = document.getElementById('userModalLulusan');
        const title = document.getElementById('modalFormTitleLulusan');
        const form = document.getElementById('formLulusan');
        const hiddenId = document.getElementById('lulusanId');
        const methodInput = document.getElementById('formMethodLulusan');
        const btnText = document.getElementById('btnTextLulusan');
        if (!modal || !form) { console.error('Modal lulusan tidak ditemukan.'); return; }
        this.resetForm();
        if (id) {
            title.textContent = 'Ubah Data Lulusan';
            hiddenId.value = id;
            form.action = `${LULUSAN_BASE_URL}/${id}`;
            methodInput.value = 'PUT';
            btnText.textContent = 'Update';
            this.loadEditData(id);
        } else {
            title.textContent = 'Tambah Data Lulusan';
            hiddenId.value = '';
            form.action = LULUSAN_BASE_URL;
            methodInput.value = 'POST';
            btnText.textContent = 'Simpan';
        }
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        setTimeout(updatePreviewPenurunan, 100);
    },
    close() {
        const modal = document.getElementById('userModalLulusan');
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        setTimeout(() => this.resetForm(), 0);
    },
    resetForm() {
        const form = document.getElementById('formLulusan');
        if (form) form.reset();
        const namaProdi = document.getElementById('namaProdi');
        const ta3 = document.getElementById('ta_3_lulusan');
        const ta2 = document.getElementById('ta_2_lulusan');
        const ta1 = document.getElementById('ta_1_lulusan');
        const ta = document.getElementById('ta_lulusan');
        const preview = document.getElementById('previewPenurunan');
        if (namaProdi) namaProdi.value = '';
        if (ta3) ta3.value = 0;
        if (ta2) ta2.value = 0;
        if (ta1) ta1.value = 0;
        if (ta) ta.value = 0;
        if (preview) preview.textContent = '0%';
        const hiddenId = document.getElementById('lulusanId');
        if (hiddenId) hiddenId.value = '';
        const methodInput = document.getElementById('formMethodLulusan');
        if (methodInput) methodInput.value = 'POST';
        if (form) form.action = LULUSAN_BASE_URL;
        const title = document.getElementById('modalFormTitleLulusan');
        if (title) title.textContent = 'Tambah Data Lulusan';
        const btnText = document.getElementById('btnTextLulusan');
        const btn = document.getElementById('btnLulusanSubmit');
        if (btnText) btnText.textContent = 'Simpan';
        if (btn) btn.disabled = false;
        const modal = document.getElementById('userModalLulusan');
        if (modal) modal.scrollTop = 0;
    },
    async loadEditData(id) {
        try {
            const url = `${LULUSAN_BASE_URL}/${id}`;
            const response = await fetch(url, {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) {
                let errorMessage = 'Gagal mengambil data';
                try {
                    const errorData = await response.json();
                    if (errorData.message) errorMessage = errorData.message;
                } catch (e) {
                    const text = await response.text();
                    console.error('Response text:', text);
                    errorMessage = `Server error: ${response.status} ${response.statusText}`;
                }
                throw new Error(errorMessage);
            }
            const result = await response.json();
            if (result.success) {
                const data = result.data;
                document.getElementById('namaProdi').value = data.nama_prodi || '';
                document.getElementById('ta_3_lulusan').value = data.ta_3 ?? 0;
                document.getElementById('ta_2_lulusan').value = data.ta_2 ?? 0;
                document.getElementById('ta_1_lulusan').value = data.ta_1 ?? 0;
                document.getElementById('ta_lulusan').value = data.ta ?? 0;
                setTimeout(updatePreviewPenurunan, 100);
            } else {
                if (window.toast) window.toast.error(result.message || 'Gagal mengambil data');
                this.close();
            }
        } catch (error) {
            console.error('Load Edit Error:', error);
            if (window.toast) window.toast.error(error.message || 'Gagal mengambil data lulusan.');
            this.close();
        }
    }
};

function openModalLulusan(id = null) { LulusanModal.open(id); }
function closeModalLulusan() { LulusanModal.close(); }

function updateLulusanTable(data) {
    const tbody = document.getElementById('lulusanTableBody');
    if (!tbody || !data) return;
    const id = data.id;
    let row = document.getElementById(`lulusanRow-${id}`);
    const penurunanValue = Number(data.persentase_penurunan) || 0;
    if (row) {
        const namaProdi = row.querySelector('.nama-prodi');
        const ta3 = row.querySelector('.ta-3');
        const ta2 = row.querySelector('.ta-2');
        const ta1 = row.querySelector('.ta-1');
        const ta = row.querySelector('.ta');
        const penurunanCell = row.querySelector('.penurunan');
        if (namaProdi) namaProdi.textContent = data.nama_prodi || '-';
        if (ta3) ta3.textContent = data.ta_3 ?? '-';
        if (ta2) ta2.textContent = data.ta_2 ?? '-';
        if (ta1) ta1.textContent = data.ta_1 ?? '-';
        if (ta) ta.textContent = data.ta ?? '-';
        let warna = 'text-green-600 dark:text-green-400';
        if (penurunanValue > 50) warna = 'text-red-600 dark:text-red-400';
        else if (penurunanValue > 25) warna = 'text-yellow-600 dark:text-yellow-400';
        if (penurunanCell) penurunanCell.innerHTML = `<span class="${warna}">${penurunanValue.toFixed(2)}%</span>`;
        const editBtn = row.querySelector('.btn-edit-lulusan');
        if (editBtn) editBtn.onclick = function() { openModalLulusan(data.id); };
        const deleteBtn = row.querySelector('.btn-delete-lulusan');
        if (deleteBtn) deleteBtn.onclick = function() { deleteLulusan(data.id); };
        return;
    }
    const emptyState = document.getElementById('emptyStateLulusanRow');
    if (emptyState) emptyState.remove();
    const existingRows = tbody.querySelectorAll('tr');
    const nextNo = existingRows.length + 1;
    row = document.createElement('tr');
    row.id = `lulusanRow-${id}`;
    row.className = 'transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50';
    let warna = 'text-green-600 dark:text-green-400';
    if (penurunanValue > 50) warna = 'text-red-600 dark:text-red-400';
    else if (penurunanValue > 25) warna = 'text-yellow-600 dark:text-yellow-400';
    row.innerHTML = `
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no">${nextNo}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90 nama-prodi">${data.nama_prodi || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-3">${data.ta_3 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-2">${data.ta_2 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-1">${data.ta_1 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta">${data.ta ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm font-medium penurunan"><span class="${warna}">${penurunanValue.toFixed(2)}%</span></td>
        <td class="border border-gray-400 px-4 py-2 text-center align-top">
            <div class="flex items-center justify-center gap-1.5">
                <button type="button" class="btn-edit-lulusan inline-flex items-center gap-1 rounded-lg border border-yellow-200/50 bg-yellow-50 px-2.5 py-1.5 text-xs font-medium text-yellow-700 transition-all duration-200 hover:bg-yellow-100 dark:border-yellow-800/30 dark:bg-yellow-900/20 dark:text-yellow-300 dark:hover:bg-yellow-900/40" title="Edit">Edit</button>
                <button type="button" class="btn-delete-lulusan inline-flex items-center gap-1 rounded-lg border border-red-200/50 bg-red-50 px-2.5 py-1.5 text-xs font-medium text-red-700 transition-all duration-200 hover:bg-red-100 dark:border-red-800/30 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/40" title="Hapus">Hapus</button>
            </div>
        </td>
    `;
    const editBtn = row.querySelector('.btn-edit-lulusan');
    if (editBtn) editBtn.onclick = function() { openModalLulusan(data.id); };
    const deleteBtn = row.querySelector('.btn-delete-lulusan');
    if (deleteBtn) deleteBtn.onclick = function() { deleteLulusan(data.id); };
    tbody.appendChild(row);
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formLulusan');
    const ta1Input = document.getElementById('ta_1_lulusan');
    const taInput = document.getElementById('ta_lulusan');
    if (ta1Input) ta1Input.addEventListener('input', updatePreviewPenurunan);
    if (taInput) taInput.addEventListener('input', updatePreviewPenurunan);
    const existingRows = document.querySelectorAll('#lulusanTableBody tr:not(#emptyStateLulusanRow)');
    existingRows.forEach(row => {
        const editBtn = row.querySelector('.btn-edit-lulusan');
        if (editBtn) {
            const id = row.id.replace('lulusanRow-', '');
            editBtn.onclick = function() { openModalLulusan(id); };
        }
        const deleteBtn = row.querySelector('.btn-delete-lulusan');
        if (deleteBtn) {
            const id = row.id.replace('lulusanRow-', '');
            deleteBtn.onclick = function() { deleteLulusan(id); };
        }
    });
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('lulusanId').value;
            const url = this.action;
            const btn = document.getElementById('btnLulusanSubmit');
            const btnText = document.getElementById('btnTextLulusan');
            btn.disabled = true;
            btnText.textContent = 'Menyimpan...';
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(async response => {
                if (!response.ok) {
                    let errorMessage = 'Terjadi kesalahan pada server.';
                    try {
                        const errorData = await response.json();
                        if (errorData.message) errorMessage = errorData.message;
                        if (errorData.errors) {
                            const errors = Object.values(errorData.errors).flat().join('\n');
                            errorMessage = errors;
                        }
                    } catch (e) {
                        const text = await response.text();
                        console.error('Response text:', text);
                        errorMessage = `Server error: ${response.status} ${response.statusText}`;
                    }
                    throw new Error(errorMessage);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateLulusanTable(data.data);
                    if (window.toast) window.toast.success(data.message || 'Data lulusan berhasil disimpan');
                    LulusanModal.close();
                } else {
                    if (data.errors) {
                        let errorMessages = '';
                        Object.values(data.errors).forEach(error => { errorMessages += error.join('\n') + '\n'; });
                        if (window.toast) window.toast.error('Validasi gagal:\n' + errorMessages);
                    } else {
                        if (window.toast) window.toast.error(data.message || 'Gagal menyimpan data');
                    }
                }
            })
            .catch(error => {
                console.error('Lulusan Error:', error);
                if (window.toast) window.toast.error(error.message || 'Terjadi kesalahan saat menyimpan data');
            })
            .finally(() => {
                btn.disabled = false;
                btnText.textContent = id ? 'Update' : 'Simpan';
            });
        });
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModalLulusan();
    });
});
</script>