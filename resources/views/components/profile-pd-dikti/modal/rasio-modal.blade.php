{{-- Modal Tambah/Ubah Data Rasio --}}
<div id="userModalRasio" tabindex="-1" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6">
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 id="modalFormTitleRasio" class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah Data Rasio</h3>
            </div>
            <button type="button" onclick="closeModalRasio()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formRasio" method="POST" class="needs-validation" novalidate data-base-url="{{ url('/fakultas/profile-pd-dikti/rasio') }}">
            @csrf
            <input type="hidden" id="rasioId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethodRasio" value="POST" />

            <div class="space-y-5 px-6 py-5">
                {{-- Jumlah Dosen Tetap --}}
                <div>
                    <label for="jumlahDosenTetap" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Dosen Tetap <span class="text-red-500">*</span></label>
                    <input
                        type="number"
                        name="jumlah_dosen"
                        id="jumlahDosenTetap"
                        value="0"
                        min="0"
                        required
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    />
                </div>

                {{-- Jumlah Mahasiswa --}}
                <div>
                    <label for="jumlahMahasiswa" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Mahasiswa <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_mahasiswa" id="jumlahMahasiswa" value="0" min="0" required class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                </div>

                {{-- Preview Rasio --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Preview Rasio</label>
                    <div class="rounded-lg border border-blue-200 bg-blue-50 p-3 dark:border-blue-700 dark:bg-blue-900/20">
                        <p class="text-sm font-semibold text-blue-600 dark:text-blue-300"><span id="previewRasio">1 : 0.00</span></p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">* Rasio dihitung otomatis dari jumlah mahasiswa / jumlah dosen tetap</p>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalRasio()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    Batal
                </button>
                <button type="submit" id="btnRasioSubmit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    <span id="btnTextRasio">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity:0; transform:scale(0.95); } to { opacity:1; transform:scale(1); } }
</style>

<script>
    function updatePreviewRasio() {
        const dosenInput = document.getElementById('jumlahDosenTetap');
        const mahasiswaInput = document.getElementById('jumlahMahasiswa');
        const preview = document.getElementById('previewRasio');
        if (!dosenInput || !mahasiswaInput || !preview) return;
        const dosen = parseInt(dosenInput.value) || 0;
        const mahasiswa = parseInt(mahasiswaInput.value) || 0;
        if (dosen > 0) {
            const rasio = mahasiswa / dosen;
            preview.textContent = `1 : ${rasio.toFixed(2)}`;
        } else {
            preview.textContent = '1 : 0.00';
        }
    }

    const RasioModal = {
        open(id = null) {
            const modal = document.getElementById('userModalRasio');
            const title = document.getElementById('modalFormTitleRasio');
            const form = document.getElementById('formRasio');
            const hiddenId = document.getElementById('rasioId');
            const methodInput = document.getElementById('formMethodRasio');
            const btnText = document.getElementById('btnTextRasio');
            if (!modal || !form) { console.error('Modal rasio tidak ditemukan.'); return; }
            const baseUrl = form.dataset.baseUrl;
            this.resetForm();
            if (id) {
                title.textContent = 'Ubah Data Rasio';
                hiddenId.value = id;
                form.action = `${baseUrl}/${id}`;
                methodInput.value = 'PUT';
                btnText.textContent = 'Update';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                this.loadEditData(id);
            } else {
                title.textContent = 'Tambah Data Rasio';
                hiddenId.value = '';
                form.action = baseUrl;
                methodInput.value = 'POST';
                btnText.textContent = 'Simpan';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                setTimeout(() => updatePreviewRasio(), 50);
            }
        },
        close() {
            const modal = document.getElementById('userModalRasio');
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            setTimeout(() => this.resetForm(), 0);
        },
        resetForm() {
            const form = document.getElementById('formRasio');
            if (!form) return;
            form.reset();
            document.getElementById('jumlahDosenTetap').value = 0;
            document.getElementById('jumlahMahasiswa').value = 0;
            document.getElementById('previewRasio').textContent = '1 : 0.00';
            document.getElementById('rasioId').value = '';
            document.getElementById('formMethodRasio').value = 'POST';
            form.action = form.dataset.baseUrl;
            document.getElementById('modalFormTitleRasio').textContent = 'Tambah Data Rasio';
            document.getElementById('btnTextRasio').textContent = 'Simpan';
            document.getElementById('btnRasioSubmit').disabled = false;
            const modal = document.getElementById('userModalRasio');
            if (modal) modal.scrollTop = 0;
        },
        async loadEditData(id) {
            try {
                const form = document.getElementById('formRasio');
                const baseUrl = form.dataset.baseUrl;
                const response = await fetch(`${baseUrl}/${id}`, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) {
                    let errorMessage = 'Gagal mengambil data rasio.';
                    try {
                        const errorData = await response.json();
                        if (errorData.message) errorMessage = errorData.message;
                    } catch (e) {
                        errorMessage = `Server error: ${response.status} ${response.statusText}`;
                    }
                    throw new Error(errorMessage);
                }
                const result = await response.json();
                if (!result.success) throw new Error(result.message || 'Gagal mengambil data rasio.');
                const data = result.data;
                document.getElementById('jumlahDosenTetap').value = data.jumlah_dosen ?? 0;
                document.getElementById('jumlahMahasiswa').value = data.jumlah_mahasiswa ?? 0;
                updatePreviewRasio();
            } catch (error) {
                console.error('Load Rasio Error:', error);
                if (window.toast && typeof window.toast.error === 'function') {
                    window.toast.error(error.message || 'Gagal mengambil data rasio.');
                }
                this.close();
            }
        }
    };

    function openModalRasio(id = null) { RasioModal.open(id); }
    function closeModalRasio() { RasioModal.close(); }

    function updateRasioTable(data) {
        const tbody = document.getElementById('rasioTableBody');
        if (!tbody || !data) return;
        const id = data.id;
        let row = document.getElementById(`rasioRow-${id}`);
        const rasioValue = Number(data.rasio) || 0;
        if (row) {
            const jumlahDosen = row.querySelector('.jumlah-dosen');
            const jumlahMahasiswa = row.querySelector('.jumlah-mahasiswa');
            const rasio = row.querySelector('.rasio-value');
            if (jumlahDosen) jumlahDosen.textContent = data.jumlah_dosen ?? 0;
            if (jumlahMahasiswa) jumlahMahasiswa.textContent = data.jumlah_mahasiswa ?? 0;
            if (rasio) rasio.textContent = `1 : ${rasioValue.toFixed(2)}`;
            const editBtn = row.querySelector('.btn-edit-rasio');
            if (editBtn) editBtn.onclick = function() { openModalRasio(data.id); };
            const deleteBtn = row.querySelector('.btn-delete-rasio');
            if (deleteBtn) deleteBtn.onclick = function() { deleteRasio(data.id); };
            return;
        }
        const emptyState = document.getElementById('emptyStateRasioRow');
        if (emptyState) emptyState.remove();
        const existingRows = tbody.querySelectorAll('tr');
        const nextNo = existingRows.length + 1;
        row = document.createElement('tr');
        row.id = `rasioRow-${id}`;
        row.className = 'transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50';
        row.innerHTML = `
            <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 no">${nextNo}</td>
            <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 jumlah-dosen">${data.jumlah_dosen ?? 0}</td>
            <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 jumlah-mahasiswa">${data.jumlah_mahasiswa ?? 0}</td>
            <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90 rasio-value">1 : ${rasioValue.toFixed(2)}</td>
            <td class="border border-gray-400 px-4 py-2 text-center align-top">
                <div class="flex items-center justify-center gap-1.5">
                    <button type="button" class="btn-edit-rasio inline-flex items-center gap-1 rounded-lg border border-yellow-200/50 bg-yellow-50 px-2.5 py-1.5 text-xs font-medium text-yellow-700 transition-all duration-200 hover:bg-yellow-100 dark:border-yellow-800/30 dark:bg-yellow-900/20 dark:text-yellow-300 dark:hover:bg-yellow-900/40" title="Edit">Edit</button>
                    <button type="button" class="btn-delete-rasio inline-flex items-center gap-1 rounded-lg border border-red-200/50 bg-red-50 px-2.5 py-1.5 text-xs font-medium text-red-700 transition-all duration-200 hover:bg-red-100 dark:border-red-800/30 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/40" title="Hapus">Hapus</button>
                </div>
            </td>
        `;
        const editBtn = row.querySelector('.btn-edit-rasio');
        if (editBtn) editBtn.onclick = function() { openModalRasio(data.id); };
        const deleteBtn = row.querySelector('.btn-delete-rasio');
        if (deleteBtn) deleteBtn.onclick = function() { deleteRasio(data.id); };
        tbody.appendChild(row);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formRasio');
        const dosenInput = document.getElementById('jumlahDosenTetap');
        const mahasiswaInput = document.getElementById('jumlahMahasiswa');
        if (dosenInput) dosenInput.addEventListener('input', updatePreviewRasio);
        if (mahasiswaInput) mahasiswaInput.addEventListener('input', updatePreviewRasio);
        const existingRows = document.querySelectorAll('#rasioTableBody tr:not(#emptyStateRasioRow)');
        existingRows.forEach(row => {
            const editBtn = row.querySelector('.btn-edit-rasio');
            if (editBtn) {
                const id = row.id.replace('rasioRow-', '');
                editBtn.onclick = function() { openModalRasio(id); };
            }
            const deleteBtn = row.querySelector('.btn-delete-rasio');
            if (deleteBtn) {
                const id = row.id.replace('rasioRow-', '');
                deleteBtn.onclick = function() { deleteRasio(id); };
            }
        });
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const id = document.getElementById('rasioId').value;
                const url = this.action;
                const btn = document.getElementById('btnRasioSubmit');
                const btnText = document.getElementById('btnTextRasio');
                btn.disabled = true;
                btnText.textContent = 'Menyimpan...';
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (!csrfToken) throw new Error('CSRF token tidak ditemukan.');
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });
                    let result;
                    try { result = await response.json(); } catch (error) {
                        throw new Error(`Server mengembalikan response tidak valid (${response.status}).`);
                    }
                    if (!response.ok) {
                        if (result.errors) {
                            const errors = Object.values(result.errors).flat().join('\n');
                            throw new Error(errors);
                        }
                        throw new Error(result.message || `Server error: ${response.status}`);
                    }
                    if (!result.success) throw new Error(result.message || 'Gagal menyimpan data rasio.');
                    updateRasioTable(result.data);
                    if (window.toast && typeof window.toast.success === 'function') {
                        window.toast.success(result.message || 'Data rasio berhasil disimpan.');
                    }
                    RasioModal.close();
                } catch (error) {
                    console.error('Rasio Error:', error);
                    if (window.toast && typeof window.toast.error === 'function') {
                        window.toast.error(error.message || 'Terjadi kesalahan saat menyimpan data rasio.');
                    }
                } finally {
                    btn.disabled = false;
                    btnText.textContent = id ? 'Update' : 'Simpan';
                }
            });
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModalRasio();
        });
    });
</script>