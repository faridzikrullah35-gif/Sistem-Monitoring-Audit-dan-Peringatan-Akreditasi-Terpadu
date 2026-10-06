{{-- Modal Tambah/Ubah Data Dosen --}}
<div id="userModal" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8">
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="modalFormTitleDosen" class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah Data Dosen</h3>
            </div>
            <button type="button" onclick="closeModalDosen()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formDosen" action="{{ route('prodi.dosen.store') }}" method="POST" data-ajax="1" data-table-id="#sdmdosenTableContainer">
            @csrf
            <input type="hidden" id="dosenId" name="id" value="" />
            <input type="hidden" id="methodFieldDosen" name="_method" value="POST" />

            <div class="space-y-5 px-6 py-5">
                {{-- Nama Dosen --}}
                <div>
                    <label for="namaDosen" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dosen <span class="text-red-500">*</span></label>
                    <input type="text" id="namaDosen" name="nama" required placeholder="Masukkan nama dosen" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Latar Pendidikan --}}
                <div>
                    <label for="latarPendidikan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Latar Pendidikan <span class="text-red-500">*</span></label>
                    <input type="text" id="latarPendidikan" name="latar_pendidikan" required placeholder="Contoh: S3 Pendidikan, S2 Manajemen, S1 Teknik Informatika" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Doktor --}}
                <div>
                    <label for="doktor" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Doktor</label>
                    <input type="text" id="doktor" name="doktor" placeholder="Contoh: S3 Pendidikan" class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Magister --}}
                <div>
                    <label for="magister" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Magister</label>
                    <input type="text" id="magister" name="magister" placeholder="Contoh: S2 Manajemen" class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Sarjana --}}
                <div>
                    <label for="sarjana" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Sarjana</label>
                    <input type="text" id="sarjana" name="sarjana" placeholder="Contoh: S1 Teknik Informatika" class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Nama Instansi Asal --}}
                <div>
                    <label for="instansiAsal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Instansi Asal</label>
                    <input type="text" id="instansiAsal" name="nama_instansi_asal" placeholder="Masukkan nama instansi asal" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Sertifikasi --}}
                <div>
                    <label for="sertifikasi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Sertifikasi <span class="text-red-500">*</span></label>
                    <select id="sertifikasi" name="sertifikasi" required class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                        <option value="" disabled selected>Pilih Sertifikasi</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                {{-- Jabatan Akademik --}}
                <div>
                    <label for="jabatanAkademik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jabatan Akademik</label>
                    <select id="jabatanAkademik" name="jabatan_akademik" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                        <option value="" disabled selected>Pilih Jabatan Akademik</option>
                        <option value="Profesor">Profesor</option>
                        <option value="Lektor Kepala">Lektor Kepala</option>
                        <option value="Lektor">Lektor</option>
                        <option value="Asisten Ahli">Asisten Ahli</option>
                        <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                    </select>
                </div>

                {{-- Posisi/Jabatan --}}
                <div>
                    <label for="posisiJabatan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Posisi/Jabatan</label>
                    <input type="text" id="posisiJabatan" name="posisi_jabatan" placeholder="Contoh: Ketua Program Studi, Sekretaris Jurusan, Dosen Tetap" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Terhitung Mulai Tanggal --}}
                <div>
                    <label for="terhitungMulaiTanggal" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Terhitung Mulai Tanggal</label>
                    <div class="relative">
                        <input type="text" id="terhitungMulaiTanggal" name="terhitung_mulai_tanggal" placeholder="Pilih tanggal mulai" autocomplete="off" readonly class="w-full max-w-xs cursor-pointer rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0021 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tanggal mulai berlaku posisi/jabatan</p>
                </div>

                {{-- SK Dosen Tetap --}}
                <div>
                    <label for="skDosenTetap" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">SK Dosen Tetap</label>
                    <input type="text" id="skDosenTetap" name="sk_dosen_tetap" placeholder="Masukkan nomor SK dosen tetap" class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tugas Belajar">Tugas Belajar</option>
                        <option value="Non Aktif">Non Aktif</option>
                    </select>
                </div>

                {{-- NIDN --}}
                <div>
                    <label for="nidn" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">NIDN</label>
                    <input type="text" id="nidn" name="nidn" placeholder="Masukkan NIDN (10 digit)" maxlength="10" pattern="[0-9]{10}" title="NIDN harus 10 digit angka" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">NIDN terdiri dari 10 digit angka</p>
                </div>

                {{-- NUPTK --}}
                <div>
                    <label for="nuptk" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">NUPTK</label>
                    <input type="text" id="nuptk" name="nuptk" placeholder="Masukkan NUPTK (16 digit)" maxlength="16" pattern="[0-9]{16}" title="NUPTK harus 16 digit angka" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500" />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">NUPTK terdiri dari 16 digit angka</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalDosen()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button type="submit" id="btnDosenSubmit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="btnDosenSubmitText">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
</style>

<script>
(function() {
    'use strict';

    const modal = document.getElementById('userModal');
    const form = document.getElementById('formDosen');
    const title = document.getElementById('modalFormTitleDosen');
    const methodField = document.getElementById('methodFieldDosen');
    const dosenId = document.getElementById('dosenId');
    const submitText = document.getElementById('btnDosenSubmitText');
    const dateInput = document.getElementById('terhitungMulaiTanggal');
    let flatpickrInstance = null;

    function clearValidationErrors() {
        document.querySelectorAll('#formDosen .border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('#formDosen .text-red-500.text-xs').forEach(el => el.remove());
    }

    function destroyFlatpickr() {
        if (flatpickrInstance) { flatpickrInstance.destroy(); flatpickrInstance = null; }
    }

    function initFlatpickr(selectedDate = null) {
        if (!dateInput || typeof flatpickr === 'undefined') return;
        destroyFlatpickr();
        flatpickrInstance = flatpickr(dateInput, {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd/m/Y',
            allowInput: false,
            disableMobile: true,
            locale: {
                firstDayOfWeek: 1,
                weekdays: { shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'], longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] },
                months: { shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'], longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] }
            }
        });
        if (selectedDate) flatpickrInstance.setDate(selectedDate, false);
    }

    function resetFormDosen() {
        form.reset();
        dosenId.value = '';
        methodField.value = 'POST';
        form.action = "{{ route('prodi.dosen.store') }}";
        title.textContent = 'Tambah Data Dosen';
        submitText.textContent = 'Simpan';
        clearValidationErrors();
        destroyFlatpickr();
        setTimeout(() => initFlatpickr(), 0);
    }

    window.openModalDosen = function(action = 'create', data = null) {
        if (action !== 'edit') action = 'create';
        form.reset();
        clearValidationErrors();
        destroyFlatpickr();

        if (action === 'create') {
            title.textContent = 'Tambah Data Dosen';
            submitText.textContent = 'Simpan';
            methodField.value = 'POST';
            dosenId.value = '';
            form.action = "{{ route('prodi.dosen.store') }}";
            document.getElementById('namaDosen').value = '';
            document.getElementById('latarPendidikan').value = '';
            document.getElementById('doktor').value = '';
            document.getElementById('magister').value = '';
            document.getElementById('sarjana').value = '';
            document.getElementById('instansiAsal').value = '';
            document.getElementById('sertifikasi').value = '';
            document.getElementById('jabatanAkademik').value = '';
            document.getElementById('posisiJabatan').value = '';
            document.getElementById('skDosenTetap').value = '';
            document.getElementById('status').value = '';
            document.getElementById('nidn').value = '';
            document.getElementById('nuptk').value = '';
            initFlatpickr();
        }

        if (action === 'edit' && data) {
            title.textContent = 'Edit Data Dosen';
            submitText.textContent = 'Perbarui';
            methodField.value = 'PUT';
            dosenId.value = data.id || '';
            form.action = `/prodi/profile-sdm/dosen/${data.id}`;
            document.getElementById('namaDosen').value = data.nama ?? '';
            document.getElementById('latarPendidikan').value = data.latar_pendidikan ?? '';
            document.getElementById('doktor').value = data.doktor ?? '';
            document.getElementById('magister').value = data.magister ?? '';
            document.getElementById('sarjana').value = data.sarjana ?? '';
            document.getElementById('instansiAsal').value = data.nama_instansi_asal ?? '';
            document.getElementById('sertifikasi').value = data.sertifikasi ?? '';
            document.getElementById('jabatanAkademik').value = data.jabatan_akademik ?? '';
            document.getElementById('posisiJabatan').value = data.posisi_jabatan ?? '';
            document.getElementById('skDosenTetap').value = data.sk_dosen_tetap ?? '';
            document.getElementById('status').value = data.status ?? 'Aktif';
            document.getElementById('nidn').value = data.nidn ?? '';
            document.getElementById('nuptk').value = data.nuptk ?? '';
            initFlatpickr(data.terhitung_mulai_tanggal ?? null);
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.tambahDosen = function() { window.openModalDosen('create'); };

    window.closeModalDosen = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        clearValidationErrors();
        destroyFlatpickr();
    };

    window.editDosen = function(id) {
        if (!id) { console.error('ID dosen tidak ditemukan.'); return; }
        fetch(`/prodi/profile-sdm/dosen/${id}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Gagal mengambil data dosen.');
            return data;
        })
        .then(data => {
            if (data.success) { window.openModalDosen('edit', data.data); }
            else { throw new Error(data.message || 'Gagal mengambil data dosen.'); }
        })
        .catch(error => {
            console.error(error);
            if (window.toast) { window.toast.error(error.message || 'Terjadi kesalahan saat mengambil data.'); }
            else { alert(error.message || 'Terjadi kesalahan saat mengambil data.'); }
        });
    };

    window.deleteDosen = function(id) {
        const modalConfirm = document.getElementById('globalConfirmModal');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        const confirmTitle = document.getElementById('confirmTitle');
        const confirmMessage = document.getElementById('confirmMessage');
        if (!modalConfirm || !cancelBtn || !okBtn) { console.error('Global confirm modal tidak ditemukan.'); return; }
        confirmTitle.textContent = 'Konfirmasi Hapus';
        confirmMessage.textContent = 'Yakin ingin menghapus data Dosen ini? Tindakan ini tidak dapat dibatalkan.';
        okBtn.textContent = 'Hapus';
        modalConfirm.classList.remove('hidden');

        const newCancelBtn = cancelBtn.cloneNode(true);
        const newOkBtn = okBtn.cloneNode(true);
        cancelBtn.replaceWith(newCancelBtn);
        okBtn.replaceWith(newOkBtn);

        newCancelBtn.addEventListener('click', function() { modalConfirm.classList.add('hidden'); });

        newOkBtn.addEventListener('click', function() {
            newOkBtn.disabled = true;
            newOkBtn.textContent = 'Menghapus...';
            fetch(`/prodi/profile-sdm/dosen/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Gagal menghapus data.');
                return data;
            })
            .then(data => {
                modalConfirm.classList.add('hidden');
                if (data.success) {
                    if (window.toast) { window.toast.success(data.message || 'Data berhasil dihapus.'); }
                    else { alert(data.message || 'Data berhasil dihapus.'); }
                    if (typeof TableRefresh !== 'undefined' && typeof TableRefresh.refresh === 'function') {
                        TableRefresh.refresh('#sdmdosenTableContainer');
                    } else { location.reload(); }
                } else { throw new Error(data.message || 'Gagal menghapus data.'); }
            })
            .catch(error => {
                console.error(error);
                modalConfirm.classList.add('hidden');
                if (window.toast) { window.toast.error(error.message || 'Terjadi kesalahan saat menghapus data.'); }
                else { alert(error.message || 'Terjadi kesalahan saat menghapus data.'); }
            })
            .finally(() => { newOkBtn.disabled = false; newOkBtn.textContent = 'Hapus'; });
        });
    };

    document.addEventListener('click', function(e) {
        const addBtn = e.target.closest('.btn-tambah-dosen, .btn-add-dosen');
        if (addBtn) { e.preventDefault(); window.openModalDosen('create'); return; }
        const editBtn = e.target.closest('.btn-edit-dosen');
        if (editBtn) { e.preventDefault(); const id = editBtn.dataset.id; if (id) window.editDosen(id); return; }
        const deleteBtn = e.target.closest('.btn-delete-dosen');
        if (deleteBtn) { e.preventDefault(); const id = deleteBtn.dataset.id; if (id) window.deleteDosen(id); return; }
        if (e.target === modal) window.closeModalDosen();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) window.closeModalDosen();
    });
})();
</script>