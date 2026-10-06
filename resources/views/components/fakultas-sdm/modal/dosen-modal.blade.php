{{-- Modal Tambah/Ubah Data Dosen --}}
<div
    id="userModalDosen"
    tabindex="-1"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="modalFormTitleDosen" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data Dosen
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalDosen()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form
            id="formDosen"
            method="POST"
            class="needs-validation"
            novalidate
            data-base-url="{{ url('/fakultas/profile-sdm/dosen') }}"
        >
            @csrf
            <input type="hidden" id="dosenId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethodDosen" value="POST" />

            <div class="space-y-5 px-6 py-5">

                {{-- Nama Dosen --}}
                <div>
                    <label for="namaDosen" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Dosen <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nama"
                        id="namaDosen"
                        required
                        placeholder="Masukkan nama dosen"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Latar Pendidikan --}}
                <div>
                    <label for="latarPendidikan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Latar Pendidikan <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="latar_pendidikan"
                        id="latarPendidikan"
                        required
                        placeholder="Contoh: S3 Pendidikan, S2 Manajemen, S1 Teknik Informatika"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Doktor --}}
                <div>
                    <label for="doktor" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Doktor
                    </label>
                    <input
                        type="text"
                        name="doktor"
                        id="doktor"
                        placeholder="Contoh: S3 Pendidikan"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    />
                </div>

                {{-- Magister --}}
                <div>
                    <label for="magister" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Magister
                    </label>
                    <input
                        type="text"
                        name="magister"
                        id="magister"
                        placeholder="Contoh: S2 Manajemen"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    />
                </div>

                {{-- Sarjana --}}
                <div>
                    <label for="sarjana" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sarjana
                    </label>
                    <input
                        type="text"
                        name="sarjana"
                        id="sarjana"
                        placeholder="Contoh: S1 Teknik Informatika"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    />
                </div>

                {{-- Nama Instansi Asal --}}
                <div>
                    <label for="instansiAsal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Instansi Asal
                    </label>
                    <input
                        type="text"
                        name="nama_instansi_asal"
                        id="instansiAsal"
                        placeholder="Masukkan nama instansi asal"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    />
                </div>

                {{-- Sertifikasi --}}
                <div>
                    <label for="sertifikasi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sertifikasi <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="sertifikasi"
                        name="sertifikasi"
                        required
                        class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected>Pilih Sertifikasi</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                {{-- Jabatan Akademik --}}
                <div>
                    <label for="jabatanAkademik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jabatan Akademik
                    </label>
                    <select
                        id="jabatanAkademik"
                        name="jabatan_akademik"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected>Pilih Jabatan Akademik</option>
                        <option value="Profesor">Profesor</option>
                        <option value="Lektor Kepala">Lektor Kepala</option>
                        <option value="Lektor">Lektor</option>
                        <option value="Asisten Ahli">Asisten Ahli</option>
                        <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                    </select>
                </div>

                {{-- SK Dosen Tetap --}}
                <div>
                    <label for="skDosenTetap" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        SK Dosen Tetap
                    </label>
                    <input
                        type="text"
                        name="sk_dosen_tetap"
                        id="skDosenTetap"
                        placeholder="Masukkan nomor SK dosen tetap"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    />
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tugas Belajar">Tugas Belajar</option>
                        <option value="Non Aktif">Non Aktif</option>
                    </select>
                </div>

                {{-- NIDN --}}
                <div>
                    <label for="nidn" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        NIDN
                    </label>
                    <input
                        type="text"
                        name="nidn"
                        id="nidn"
                        placeholder="Masukkan NIDN (10 digit)"
                        maxlength="10"
                        pattern="[0-9]{10}"
                        title="NIDN harus 10 digit angka"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">NIDN terdiri dari 10 digit angka</p>
                </div>

                {{-- NUPTK --}}
                <div>
                    <label for="nuptk" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        NUPTK
                    </label>
                    <input
                        type="text"
                        name="nuptk"
                        id="nuptk"
                        placeholder="Masukkan NUPTK (16 digit)"
                        maxlength="16"
                        pattern="[0-9]{16}"
                        title="NUPTK harus 16 digit angka"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">NUPTK terdiri dari 16 digit angka</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalDosen()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button
                    type="submit"
                    id="btnDosenSubmit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="btnTextDosen">Simpan</span>
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
</style>

<script>
// ==========================================
// MODAL CONTROLLER
// ==========================================
const DosenModal = {
    open(id = null) {
        const modal = document.getElementById('userModalDosen');
        const title = document.getElementById('modalFormTitleDosen');
        const form = document.getElementById('formDosen');
        const hiddenId = document.getElementById('dosenId');
        const methodInput = document.getElementById('formMethodDosen');
        const baseUrl = form.dataset.baseUrl;
        const btnText = document.getElementById('btnTextDosen');

        this.resetForm();

        if (id) {
            title.textContent = 'Ubah Data Dosen';
            hiddenId.value = id;
            form.action = baseUrl + '/' + id;
            methodInput.value = 'PUT';
            btnText.textContent = 'Update';
            this.loadEditData(id);
        } else {
            title.textContent = 'Tambah Data Dosen';
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
        const modal = document.getElementById('userModalDosen');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        setTimeout(() => {
            this.resetForm();
        }, 0);
    },

    resetForm() {
        document.getElementById('formDosen').reset();
        document.getElementById('namaDosen').value = '';
        document.getElementById('latarPendidikan').value = '';
        document.getElementById('doktor').value = '';
        document.getElementById('magister').value = '';
        document.getElementById('sarjana').value = '';
        document.getElementById('instansiAsal').value = '';
        document.getElementById('sertifikasi').selectedIndex = 0;
        document.getElementById('jabatanAkademik').selectedIndex = 0;
        document.getElementById('skDosenTetap').value = '';
        document.getElementById('status').selectedIndex = 0;
        document.getElementById('nidn').value = '';
        document.getElementById('nuptk').value = '';

        const hiddenId = document.getElementById('dosenId');
        if (hiddenId) hiddenId.value = '';

        const methodInput = document.getElementById('formMethodDosen');
        if (methodInput) methodInput.value = 'POST';

        const form = document.getElementById('formDosen');
        if (form) form.action = '/fakultas/profile-sdm/dosen';

        const title = document.getElementById('modalFormTitleDosen');
        if (title) title.textContent = 'Tambah Data Dosen';

        const btnText = document.getElementById('btnTextDosen');
        const btn = document.getElementById('btnDosenSubmit');
        if (btnText) btnText.textContent = 'Simpan';
        if (btn) btn.disabled = false;

        const modal = document.getElementById('userModalDosen');
        if (modal) modal.scrollTop = 0;
    },

    async loadEditData(id) {
        try {
            const form = document.getElementById('formDosen');
            const baseUrl = form.dataset.baseUrl;

            const response = await fetch(`${baseUrl}/${id}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                let errorMessage = `Gagal mengambil data dosen (${response.status})`;

                try {
                    const contentType = response.headers.get('content-type') || '';

                    if (contentType.includes('application/json')) {
                        const errorData = await response.json();

                        if (errorData.message) {
                            errorMessage = errorData.message;
                        }
                    } else {
                        const text = await response.text();
                        console.error('Server Response:', text);
                    }
                } catch (parseError) {
                    console.error('Error parsing response:', parseError);
                }

                throw new Error(errorMessage);
            }

            const result = await response.json();

            if (!result.success) {
                throw new Error(
                    result.message || 'Gagal mengambil data dosen.'
                );
            }

            const data = result.data;

            document.getElementById('namaDosen').value =
                data.nama ?? '';

            document.getElementById('latarPendidikan').value =
                data.latar_pendidikan ?? '';

            document.getElementById('doktor').value =
                data.doktor ?? '';

            document.getElementById('magister').value =
                data.magister ?? '';

            document.getElementById('sarjana').value =
                data.sarjana ?? '';

            document.getElementById('instansiAsal').value =
                data.nama_instansi_asal ?? '';

            document.getElementById('sertifikasi').value =
                data.sertifikasi ?? '';

            document.getElementById('jabatanAkademik').value =
                data.jabatan_akademik ?? '';

            document.getElementById('skDosenTetap').value =
                data.sk_dosen_tetap ?? '';

            document.getElementById('status').value =
                data.status ?? '';

            document.getElementById('nidn').value =
                data.nidn ?? '';

            document.getElementById('nuptk').value =
                data.nuptk ?? '';

            console.log('✅ Data dosen berhasil dimuat:', data);

        } catch (error) {
            console.error('Load Edit Error:', error);

            window.toast.error(
                error.message || 'Gagal mengambil data dosen.'
            );

            this.close();
        }
    }
};

// ==========================================
// FUNGSI GLOBAL
// ==========================================
function openModalDosen(id = null) {
    DosenModal.open(id);
}

function closeModalDosen() {
    DosenModal.close();
}

// ==========================================
// UPDATE TABEL DOSEN TANPA RELOAD
// ==========================================
function updateDosenTable(data) {
    const tbody = document.getElementById('dosenTableBody');
    if (!tbody || !data) return;

    const id = data.id;
    let row = document.getElementById(`dosenRow-${id}`);

    if (row) {
        row.querySelector('.nama').textContent = data.nama || '-';
        row.querySelector('.latar-pendidikan').textContent = data.latar_pendidikan || '-';
        row.querySelector('.doktor').textContent = data.doktor || '-';
        row.querySelector('.magister').textContent = data.magister || '-';
        row.querySelector('.sarjana').textContent = data.sarjana || '-';
        row.querySelector('.instansi-asal').textContent = data.nama_instansi_asal || '-';

        // Sertifikasi
        const sertifikasiCell = row.querySelector('.sertifikasi');
        const isYa = data.sertifikasi === 'Ya';
        sertifikasiCell.innerHTML = `
            <span class="inline-flex items-center rounded-full ${isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'} px-2.5 py-0.5 text-xs font-medium">
                <span class="mr-1.5 inline-block h-1.5 w-1.5 rounded-full ${isYa ? 'bg-green-600 dark:bg-green-400' : 'bg-red-600 dark:bg-red-400'}"></span>
                ${data.sertifikasi || 'Tidak'}
            </span>
        `;

        row.querySelector('.jabatan').textContent = data.jabatan_akademik || '-';
        row.querySelector('.sk-dosen').textContent = data.sk_dosen_tetap || '-';

        // Status
        const statusCell = row.querySelector('.status');
        const isAktif = data.status === 'Aktif';
        statusCell.innerHTML = `
            <span class="inline-flex items-center rounded-full ${isAktif ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-800/50 dark:text-gray-400'} px-2.5 py-0.5 text-xs font-medium">
                ${data.status || 'Aktif'}
            </span>
        `;

        row.querySelector('.nidn').textContent = data.nidn || '-';
        row.querySelector('.nuptk').textContent = data.nuptk || '-';

        // UPDATE BUTTON EDIT
        const editBtn = row.querySelector('.btn-edit-dosen');
        if (editBtn) {
            editBtn.onclick = function() {
                openModalDosen(data.id);
            };
        }

        // UPDATE BUTTON DELETE
        const deleteBtn = row.querySelector('.btn-delete-dosen');
        if (deleteBtn) {
            deleteBtn.onclick = function() {
                deleteDosen(data.id);
            };
        }

        console.log('✅ Dosen row updated');
        return;
    }

    // BUAT ROW BARU
    const emptyState = document.getElementById('emptyStateDosenRow');
    if (emptyState) emptyState.remove();

    const existingRows = tbody.querySelectorAll('tr');
    const nextNo = existingRows.length + 1;

    row = document.createElement('tr');
    row.id = `dosenRow-${id}`;
    row.className = 'transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50';

    const isYa = data.sertifikasi === 'Ya';
    const isAktif = data.status === 'Aktif';

    row.innerHTML = `
        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-700 dark:text-gray-300 no">${nextNo}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm font-medium text-gray-800 dark:text-white/90 nama">
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                    <svg class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                ${data.nama || '-'}
            </div>
        </td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 latar-pendidikan">${data.latar_pendidikan || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 doktor">${data.doktor || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 magister">${data.magister || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sarjana">${data.sarjana || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 instansi-asal">${data.nama_instansi_asal || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sertifikasi">
            <span class="inline-flex items-center rounded-full ${isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'} px-2.5 py-0.5 text-xs font-medium">
                <span class="mr-1.5 inline-block h-1.5 w-1.5 rounded-full ${isYa ? 'bg-green-600 dark:bg-green-400' : 'bg-red-600 dark:bg-red-400'}"></span>
                ${data.sertifikasi || 'Tidak'}
            </span>
        </td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 jabatan">${data.jabatan_akademik || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sk-dosen">${data.sk_dosen_tetap || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 status">
            <span class="inline-flex items-center rounded-full ${isAktif ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-800/50 dark:text-gray-400'} px-2.5 py-0.5 text-xs font-medium">
                ${data.status || 'Aktif'}
            </span>
        </td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 nidn">${data.nidn || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 nuptk">${data.nuptk || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center align-top">
            <div class="flex items-center justify-center gap-1.5">
                <button type="button" class="btn-edit-dosen inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30" title="Edit">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                    </svg> Edit
                </button>
                <button type="button" class="btn-delete-dosen inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30" title="Hapus">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg> Hapus
                </button>
            </div>
        </td>
    `;

    // PASANG EVENT
    const editBtn = row.querySelector('.btn-edit-dosen');
    if (editBtn) {
        editBtn.onclick = function() {
            openModalDosen(data.id);
        };
    }

    const deleteBtn = row.querySelector('.btn-delete-dosen');
    if (deleteBtn) {
        deleteBtn.onclick = function() {
            deleteDosen(data.id);
        };
    }

    tbody.appendChild(row);
}

// ==========================================
// DOMContentLoaded
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formDosen');

    // INISIALISASI ROW YANG SUDAH ADA
    const existingRows = document.querySelectorAll('#dosenTableBody tr:not(#emptyStateDosenRow)');
    existingRows.forEach(row => {
        const editBtn = row.querySelector('.btn-edit-dosen');
        if (editBtn) {
            const id = row.id.replace('dosenRow-', '');
            editBtn.onclick = function() {
                openModalDosen(id);
            };
        }

        const deleteBtn = row.querySelector('.btn-delete-dosen');
        if (deleteBtn) {
            const id = row.id.replace('dosenRow-', '');
            deleteBtn.onclick = function() {
                deleteDosen(id);
            };
        }
    });

    // SUBMIT FORM
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const id = document.getElementById('dosenId').value;
            const url = this.action;
            const btn = document.getElementById('btnDosenSubmit');
            const btnText = document.getElementById('btnTextDosen');

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
                const data = await response.json();
                return data;
            })
            .then(data => {
                if (data.success) {
                    updateDosenTable(data.data);
                    window.toast.success(data.message || 'Data dosen berhasil disimpan');
                    DosenModal.close();
                } else {
                    if (data.errors) {
                        let errorMessages = '';
                        Object.values(data.errors).forEach(error => {
                            errorMessages += error.join('\n') + '\n';
                        });
                        window.toast.error('Validasi gagal:\n' + errorMessages);
                    } else {
                        window.toast.error(data.message || 'Gagal menyimpan data');
                    }
                }
            })
            .catch(error => {
                console.error('Dosen Error:', error);
                window.toast.error(error.message || 'Terjadi kesalahan saat menyimpan data');
            })
            .finally(() => {
                btn.disabled = false;
                btnText.textContent = id ? 'Update' : 'Simpan';
            });
        });
    }

    // ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModalDosen();
    });
});
</script>