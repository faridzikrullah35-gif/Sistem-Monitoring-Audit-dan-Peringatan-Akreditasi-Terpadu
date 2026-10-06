{{-- Modal Tambah/Ubah Data Mahasiswa Fakultas --}}
<div id="userModal" tabindex="-1" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6">
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah Data Mahasiswa</h3>
            </div>
            <button type="button" onclick="closeModalMahasiswa()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formMahasiswa" method="POST" class="needs-validation" novalidate data-base-url="{{ url('/fakultas/profile-pd-dikti') }}">
            @csrf
            <input type="hidden" id="mahasiswaId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethod" value="POST" />

            <div class="space-y-5 px-6 py-5">
                {{-- Tahun Akademik --}}
                <div>
                    <label for="tahunAkademik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Akademik <span class="text-red-500">*</span></label>
                    <input type="text" id="tahunAkademik" name="tahun_akademik" required placeholder="Masukkan Tahun Akademik" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Jumlah Mahasiswa --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Mahasiswa <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-3">
                        @foreach(['ta_6' => 'TA-6', 'ta_5' => 'TA-5', 'ta_4' => 'TA-4', 'ta_3' => 'TA-3', 'ta_2' => 'TA-2', 'ta_1' => 'TA-1'] as $field => $label)
                            <div class="flex items-center gap-2">
                                <span class="w-10 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $label }}</span>
                                <input type="number" name="{{ $field }}" id="{{ $field }}" value="0" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                            </div>
                        @endforeach
                        <div class="col-span-2 flex items-center gap-2">
                            <span class="w-10 text-sm font-medium text-gray-600 dark:text-gray-400">TA</span>
                            <input type="number" name="ta" id="ta" value="0" min="0" class="w-full max-w-xs rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                        </div>
                    </div>
                </div>

                {{-- Jumlah Lulusan Akhir TA --}}
                <div>
                    <label for="lulusanAkhir" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Lulusan Akhir TA <span class="text-red-500">*</span></label>
                    <input type="number" name="lulusan_akhir_ta" id="lulusanAkhir" value="0" min="0" class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalMahasiswa()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
                    Batal
                </button>
                <button type="submit" id="btnMahasiswaSubmit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    <span id="btnTextMahasiswa">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity:0; transform:scale(0.95); } to { opacity:1; transform:scale(1); } }
</style>

<script>
const MahasiswaModal = {
    open(id = null) {
        const modal = document.getElementById('userModal');
        const title = document.getElementById('modalFormTitle');
        const form = document.getElementById('formMahasiswa');
        const hiddenId = document.getElementById('mahasiswaId');
        const methodInput = document.getElementById('formMethod');
        const baseUrl = form.dataset.baseUrl;
        const btnText = document.getElementById('btnTextMahasiswa');
        this.resetForm();
        if (id) {
            title.textContent = 'Ubah Data Mahasiswa';
            hiddenId.value = id;
            form.action = baseUrl + '/' + id;
            methodInput.value = 'PUT';
            btnText.textContent = 'Update';
            this.loadEditData(id);
        } else {
            title.textContent = 'Tambah Data Mahasiswa';
            hiddenId.value = '';
            form.action = baseUrl;
            methodInput.value = 'POST';
            btnText.textContent = 'Simpan';
        }
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    },
    close() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        setTimeout(() => this.resetForm(), 0);
    },
    resetForm() {
        const form = document.getElementById('formMahasiswa');
        if (!form) return;
        form.reset();
        document.getElementById('tahunAkademik').value = '';
        document.querySelectorAll('#formMahasiswa input[type="number"]').forEach(input => input.value = 0);
        const hiddenId = document.getElementById('mahasiswaId');
        if (hiddenId) hiddenId.value = '';
        const methodInput = document.getElementById('formMethod');
        if (methodInput) methodInput.value = 'POST';
        form.action = form.dataset.baseUrl;
        const title = document.getElementById('modalFormTitle');
        if (title) title.textContent = 'Tambah Data Mahasiswa';
        const btnText = document.getElementById('btnTextMahasiswa');
        const btn = document.getElementById('btnMahasiswaSubmit');
        if (btnText) btnText.textContent = 'Simpan';
        if (btn) btn.disabled = false;
        const modal = document.getElementById('userModal');
        if (modal) modal.scrollTop = 0;
    },
    async loadEditData(id) {
        try {
            const form = document.getElementById('formMahasiswa');
            const baseUrl = form.dataset.baseUrl;
            const response = await fetch(baseUrl + '/' + id, {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) {
                let errorMessage = 'Gagal mengambil data';
                try {
                    const errorData = await response.json();
                    if (errorData.message) errorMessage = errorData.message;
                } catch (e) {
                    console.error('Response text:', await response.text());
                    errorMessage = `Server error: ${response.status} ${response.statusText}`;
                }
                throw new Error(errorMessage);
            }
            const result = await response.json();
            if (result.success) {
                const data = result.data;
                document.getElementById('tahunAkademik').value = data.tahun_akademik || '';
                document.getElementById('ta_6').value = data.ta_6 ?? 0;
                document.getElementById('ta_5').value = data.ta_5 ?? 0;
                document.getElementById('ta_4').value = data.ta_4 ?? 0;
                document.getElementById('ta_3').value = data.ta_3 ?? 0;
                document.getElementById('ta_2').value = data.ta_2 ?? 0;
                document.getElementById('ta_1').value = data.ta_1 ?? 0;
                document.getElementById('ta').value = data.ta ?? 0;
                document.getElementById('lulusanAkhir').value = data.lulusan_akhir_ta ?? 0;
            } else {
                window.toast.error(result.message || 'Gagal mengambil data');
                this.close();
            }
        } catch (error) {
            console.error('Load Edit Error:', error);
            window.toast.error(error.message || 'Gagal mengambil data mahasiswa.');
            this.close();
        }
    }
};

function openModalMahasiswa(id = null) { MahasiswaModal.open(id); }
function closeModalMahasiswa() { MahasiswaModal.close(); }

function updateMahasiswaTable(data) {
    const tbody = document.getElementById('mahasiswaTableBody');
    if (!tbody || !data) return;
    const id = data.id;
    let row = document.getElementById(`mahasiswaRow-${id}`);
    if (row) {
        row.querySelector('.tahun-akademik').textContent = data.tahun_akademik || '-';
        row.querySelector('.ta-6').textContent = data.ta_6 ?? '-';
        row.querySelector('.ta-5').textContent = data.ta_5 ?? '-';
        row.querySelector('.ta-4').textContent = data.ta_4 ?? '-';
        row.querySelector('.ta-3').textContent = data.ta_3 ?? '-';
        row.querySelector('.ta-2').textContent = data.ta_2 ?? '-';
        row.querySelector('.ta-1').textContent = data.ta_1 ?? '-';
        row.querySelector('.ta').textContent = data.ta ?? '-';
        row.querySelector('.lulusan-akhir').textContent = data.lulusan_akhir_ta ?? '-';
        const editBtn = row.querySelector('.btn-edit-mahasiswa');
        if (editBtn) editBtn.onclick = function() { openModalMahasiswa(data.id); };
        const deleteBtn = row.querySelector('.btn-delete-mahasiswa');
        if (deleteBtn) deleteBtn.onclick = function() { deleteMahasiswa(data.id); };
        return;
    }
    const emptyState = document.getElementById('emptyStateRow');
    if (emptyState) emptyState.remove();
    row = document.createElement('tr');
    row.id = `mahasiswaRow-${id}`;
    row.className = 'transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50';
    row.innerHTML = `
        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90 tahun-akademik">${data.tahun_akademik || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-6">${data.ta_6 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-5">${data.ta_5 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-4">${data.ta_4 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-3">${data.ta_3 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-2">${data.ta_2 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta-1">${data.ta_1 ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 ta">${data.ta ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 lulusan-akhir">${data.lulusan_akhir_ta ?? '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center align-top">
            <div class="flex items-center justify-center gap-1.5">
                <button type="button" class="btn-edit-mahasiswa inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30" title="Edit">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z" /></svg>
                    Edit
                </button>
                <button type="button" class="btn-delete-mahasiswa inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30" title="Hapus">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    Hapus
                </button>
            </div>
        </td>
    `;
    const editBtn = row.querySelector('.btn-edit-mahasiswa');
    if (editBtn) editBtn.onclick = function() { openModalMahasiswa(data.id); };
    const deleteBtn = row.querySelector('.btn-delete-mahasiswa');
    if (deleteBtn) deleteBtn.onclick = function() { deleteMahasiswa(data.id); };
    tbody.appendChild(row);
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formMahasiswa');
    const existingRows = document.querySelectorAll('#mahasiswaTableBody tr:not(#emptyStateRow)');
    existingRows.forEach(row => {
        const id = row.id.replace('mahasiswaRow-', '');
        const editBtn = row.querySelector('.btn-edit-mahasiswa');
        if (editBtn) editBtn.onclick = function() { openModalMahasiswa(id); };
        const deleteBtn = row.querySelector('.btn-delete-mahasiswa');
        if (deleteBtn) deleteBtn.onclick = function() { deleteMahasiswa(id); };
    });
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('mahasiswaId').value;
            const url = this.action;
            const btn = document.getElementById('btnMahasiswaSubmit');
            const btnText = document.getElementById('btnTextMahasiswa');
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
                        console.error('Response text:', await response.text());
                        errorMessage = `Server error: ${response.status} ${response.statusText}`;
                    }
                    throw new Error(errorMessage);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateMahasiswaTable(data.data);
                    window.toast.success(data.message || 'Data mahasiswa berhasil disimpan');
                    MahasiswaModal.close();
                } else {
                    if (data.errors) {
                        let errorMessages = '';
                        Object.values(data.errors).forEach(error => { errorMessages += error.join('\n') + '\n'; });
                        window.toast.error('Validasi gagal:\n' + errorMessages);
                    } else {
                        window.toast.error(data.message || 'Gagal menyimpan data');
                    }
                }
            })
            .catch(error => {
                console.error('Mahasiswa Error:', error);
                window.toast.error(error.message || 'Terjadi kesalahan saat menyimpan data');
            })
            .finally(() => {
                btn.disabled = false;
                btnText.textContent = id ? 'Update' : 'Simpan';
            });
        });
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModalMahasiswa();
    });
});
</script>