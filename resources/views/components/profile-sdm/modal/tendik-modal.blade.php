{{-- Modal Tambah/Ubah Data Tendik --}}
<div
    id="userModalTendik"
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
                <h3 id="modalFormTitleTendik" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data Tendik
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalTendik()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form
            id="formTendik"
            method="POST"
            class="needs-validation"
            novalidate
            data-base-url="{{ url('/prodi/profile-sdm/tendik') }}"
        >
            @csrf
            <input type="hidden" id="tendikId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethodTendik" value="POST" />

            <div class="space-y-5 px-6 py-5">

                {{-- Nama Tendik --}}
                <div>
                    <label for="namaTendik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama" 
                        id="namaTendik" 
                        required
                        placeholder="Masukkan nama tenaga kependidikan"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Posisi / Jabatan --}}
                <div>
                    <label for="posisiTendik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Posisi / Jabatan <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="posisi" 
                        id="posisiTendik" 
                        required
                        placeholder="Contoh: Kepala Tata Usaha, Staf Administrasi, Bendahara"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Terhitung Mulai Tanggal dengan Flatpickr --}}
                <div>
                    <label for="tmtTendik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Terhitung Mulai Tgl <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="terhitung_mulai_tanggal" 
                        id="tmtTendik" 
                        required
                        placeholder="Pilih tanggal"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500 flatpickr-input"
                        readonly
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
                        placeholder="Contoh: S1 Administrasi, D3 Manajemen, SMA/SMK"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Sertifikasi --}}
                <div>
                    <label for="sertifikasiTendik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sertifikasi <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="sertifikasiTendik"
                        name="sertifikasi"
                        required
                        class="w-full max-w-xs rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="" disabled selected>Pilih Sertifikasi</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                {{-- SK Pegawai Tetap --}}
                <div>
                    <label for="skPegawaiTetap" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        SK Pegawai Tetap <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="sk_pegawai_tetap" 
                        id="skPegawaiTetap" 
                        required
                        placeholder="Masukkan nomor SK pegawai tetap"
                        class="w-full max-w-xs rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300"
                    />
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalTendik()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button
                    type="submit"
                    id="btnTendikSubmit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="btnTextTendik">Simpan</span>
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

    /* Styling Flatpickr untuk dark mode */
    .dark .flatpickr-calendar {
        background: #1f2937 !important;
        border-color: #374151 !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5) !important;
    }

    .dark .flatpickr-calendar .flatpickr-months .flatpickr-month,
    .dark .flatpickr-calendar .flatpickr-weekdays,
    .dark .flatpickr-calendar .flatpickr-weekday,
    .dark .flatpickr-calendar .flatpickr-day {
        color: #e5e7eb !important;
    }

    .dark .flatpickr-calendar .flatpickr-day.selected,
    .dark .flatpickr-calendar .flatpickr-day.selected:hover {
        background: #3b82f6 !important;
        border-color: #3b82f6 !important;
    }

    .dark .flatpickr-calendar .flatpickr-day:hover {
        background: #374151 !important;
    }

    .dark .flatpickr-calendar .flatpickr-day.prevMonthDay,
    .dark .flatpickr-calendar .flatpickr-day.nextMonthDay {
        color: #6b7280 !important;
    }

    .dark .flatpickr-calendar .flatpickr-day.today {
        border-color: #3b82f6 !important;
    }

    .dark .flatpickr-calendar .flatpickr-current-month .flatpickr-monthDropdown-months,
    .dark .flatpickr-calendar .flatpickr-current-month input.cur-year {
        color: #e5e7eb !important;
    }

    .dark .flatpickr-calendar .flatpickr-current-month .flatpickr-monthDropdown-months option {
        background: #1f2937 !important;
        color: #e5e7eb !important;
    }
</style>

<script>
// ==========================================
// INIT FLATPICKR
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi Flatpickr untuk input tanggal
    const tmtInput = document.getElementById('tmtTendik');
    if (tmtInput && typeof flatpickr !== 'undefined') {
        const tmtPicker = flatpickr(tmtInput, {
            dateFormat: 'd/m/Y',
            allowInput: false,
            disableMobile: true,
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                },
                months: {
                    shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                }
            }
        });
        // Simpan instance untuk digunakan nanti
        window.tmtPicker = tmtPicker;
    }
});

// ==========================================
// MODAL CONTROLLER
// ==========================================
const TendikModal = {
    open(id = null) {
        const modal = document.getElementById('userModalTendik');
        const title = document.getElementById('modalFormTitleTendik');
        const form = document.getElementById('formTendik');
        const hiddenId = document.getElementById('tendikId');
        const methodInput = document.getElementById('formMethodTendik');
        const baseUrl = form.dataset.baseUrl;
        const btnText = document.getElementById('btnTextTendik');

        this.resetForm();

        if (id) {
            title.textContent = 'Ubah Data Tendik';
            hiddenId.value = id;
            form.action = baseUrl + '/' + id;
            methodInput.value = 'PUT';
            btnText.textContent = 'Update';
            this.loadEditData(id);
        } else {
            title.textContent = 'Tambah Data Tendik';
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
        const modal = document.getElementById('userModalTendik');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        setTimeout(() => {
            this.resetForm();
        }, 0);
    },

    resetForm() {
        const form = document.getElementById('formTendik');
        if (form) form.reset();
        
        const elNama = document.getElementById('namaTendik');
        const elPosisi = document.getElementById('posisiTendik');
        const elTMT = document.getElementById('tmtTendik');
        const elLatar = document.getElementById('latarPendidikan');
        const elSertifikasi = document.getElementById('sertifikasiTendik');
        const elSK = document.getElementById('skPegawaiTetap');
        
        if (elNama) elNama.value = '';
        if (elPosisi) elPosisi.value = '';
        if (elTMT) {
            // Clear Flatpickr value
            if (window.tmtPicker) {
                window.tmtPicker.clear();
            } else {
                elTMT.value = '';
            }
        }
        if (elLatar) elLatar.value = '';
        if (elSertifikasi) elSertifikasi.selectedIndex = 0;
        if (elSK) elSK.value = '';

        const hiddenId = document.getElementById('tendikId');
        if (hiddenId) hiddenId.value = '';

        const methodInput = document.getElementById('formMethodTendik');
        if (methodInput) methodInput.value = 'POST';

        const formEl = document.getElementById('formTendik');
        if (formEl) formEl.action = '/prodi/profile-sdm/tendik';

        const title = document.getElementById('modalFormTitleTendik');
        if (title) title.textContent = 'Tambah Data Tendik';

        const btnText = document.getElementById('btnTextTendik');
        const btn = document.getElementById('btnTendikSubmit');
        if (btnText) btnText.textContent = 'Simpan';
        if (btn) btn.disabled = false;

        const modal = document.getElementById('userModalTendik');
        if (modal) modal.scrollTop = 0;
    },

    async loadEditData(id) {
        try {
            const form = document.getElementById('formTendik');
            const baseUrl = form.dataset.baseUrl;
            const response = await fetch(baseUrl + '/' + id);
            
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
                
                setTimeout(() => {
                    const elNama = document.getElementById('namaTendik');
                    const elPosisi = document.getElementById('posisiTendik');
                    const elTMT = document.getElementById('tmtTendik');
                    const elLatar = document.getElementById('latarPendidikan');
                    const elSertifikasi = document.getElementById('sertifikasiTendik');
                    const elSK = document.getElementById('skPegawaiTetap');
                    
                    if (elNama) {
                        elNama.value = data.nama || '';
                        elNama.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                    if (elPosisi) {
                        elPosisi.value = data.posisi || '';
                        elPosisi.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                    if (elTMT) {
                        if (data.terhitung_mulai_tanggal) {
                            // Format date to DD/MM/YYYY for Flatpickr
                            const date = new Date(data.terhitung_mulai_tanggal);
                            const day = String(date.getDate()).padStart(2, '0');
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const year = date.getFullYear();
                            const formattedDate = `${day}/${month}/${year}`;
                            
                            if (window.tmtPicker) {
                                window.tmtPicker.setDate(formattedDate, false, 'd/m/Y');
                            } else {
                                elTMT.value = formattedDate;
                            }
                        } else {
                            if (window.tmtPicker) {
                                window.tmtPicker.clear();
                            } else {
                                elTMT.value = '';
                            }
                        }
                        elTMT.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                    if (elLatar) {
                        elLatar.value = data.latar_pendidikan || '';
                        elLatar.dispatchEvent(new Event('input', { bubbles: true }));
                        elLatar.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                    if (elSertifikasi) {
                        elSertifikasi.value = data.sertifikasi || '';
                        elSertifikasi.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                    if (elSK) {
                        elSK.value = data.sk_pegawai_tetap || '';
                        elSK.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                    
                    const allLatarInputs = document.querySelectorAll('input[name="latar_pendidikan"]');
                    if (allLatarInputs.length > 1) {
                        allLatarInputs.forEach((input) => {
                            input.value = data.latar_pendidikan || '';
                        });
                    }
                }, 150);
                
            } else {
                window.toast.error(result.message || 'Gagal mengambil data');
                this.close();
            }
        } catch (error) {
            console.error('Load Edit Error:', error);
            window.toast.error(error.message || 'Gagal mengambil data tendik.');
            this.close();
        }
    }
};

// ==========================================
// FUNGSI GLOBAL
// ==========================================
function openModalTendik(id = null) {
    TendikModal.open(id);
}

function closeModalTendik() {
    TendikModal.close();
}

// ==========================================
// DELETE TENDIK
// ==========================================
function deleteTendik(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data tendik ini?')) {
        return;
    }

    const url = '/prodi/profile-sdm/tendik/' + id;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(async response => {
        if (!response.ok) {
            let errorMessage = 'Gagal menghapus data';
            try {
                const errorData = await response.json();
                if (errorData.message) errorMessage = errorData.message;
            } catch (e) {
                errorMessage = `Server error: ${response.status} ${response.statusText}`;
            }
            throw new Error(errorMessage);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.toast.success(data.message || 'Data tendik berhasil dihapus');
            // Remove row from table
            const row = document.getElementById('tendikRow-' + id);
            if (row) row.remove();
            
            // Update numbering
            const tbody = document.getElementById('tendikTableBody');
            const rows = tbody.querySelectorAll('tr:not(#emptyStateTendikRow)');
            rows.forEach((row, index) => {
                const noCell = row.querySelector('.no');
                if (noCell) noCell.textContent = index + 1;
            });
            
            // Show empty state if no rows
            if (rows.length === 0) {
                const emptyState = document.createElement('tr');
                emptyState.id = 'emptyStateTendikRow';
                emptyState.innerHTML = `
                    <td colspan="8" class="border border-gray-400 px-4 py-10 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum Ada Data Tendik</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data tenaga kependidikan akan muncul di sini setelah ditambahkan</p>
                        </div>
                    </td>
                `;
                tbody.appendChild(emptyState);
            }
        } else {
            window.toast.error(data.message || 'Gagal menghapus data');
        }
    })
    .catch(error => {
        console.error('Delete Error:', error);
        window.toast.error(error.message || 'Terjadi kesalahan saat menghapus data');
    });
}

// ==========================================
// UPDATE TABEL TENDIK TANPA RELOAD
// ==========================================
function updateTendikTable(data) {
    const tbody = document.getElementById('tendikTableBody');
    if (!tbody || !data) return;
    
    const id = data.id;
    let row = document.getElementById(`tendikRow-${id}`);

    if (row) {
        // Update existing row
        row.querySelector('.nama').innerHTML = `
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                    <svg class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                ${data.nama || '-'}
            </div>
        `;
        row.querySelector('.posisi').textContent = data.posisi || '-';
        row.querySelector('.tmt').textContent = data.terhitung_mulai_tanggal ? new Date(data.terhitung_mulai_tanggal).toLocaleDateString('id-ID') : '-';
        row.querySelector('.latar-pendidikan').textContent = data.latar_pendidikan || '-';
        
        const sertifikasiCell = row.querySelector('.sertifikasi');
        const isYa = data.sertifikasi === 'Ya';
        sertifikasiCell.innerHTML = `
            <span class="inline-flex items-center rounded-full ${isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'} px-2.5 py-0.5 text-xs font-medium">
                <span class="mr-1.5 inline-block h-1.5 w-1.5 rounded-full ${isYa ? 'bg-green-600 dark:bg-green-400' : 'bg-red-600 dark:bg-red-400'}"></span>
                ${data.sertifikasi || 'Tidak'}
            </span>
        `;
        
        row.querySelector('.sk-pegawai').textContent = data.sk_pegawai_tetap || '-';

        const editBtn = row.querySelector('.btn-edit-tendik');
        if (editBtn) {
            editBtn.onclick = function() {
                openModalTendik(data.id);
            };
        }

        const deleteBtn = row.querySelector('.btn-delete-tendik');
        if (deleteBtn) {
            deleteBtn.onclick = function() {
                deleteTendik(data.id);
            };
        }

        return;
    }

    const emptyState = document.getElementById('emptyStateTendikRow');
    if (emptyState) emptyState.remove();

    const existingRows = tbody.querySelectorAll('tr');
    const nextNo = existingRows.length + 1;

    row = document.createElement('tr');
    row.id = `tendikRow-${id}`;
    row.className = 'transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50';

    const isYa = data.sertifikasi === 'Ya';
    const tmtFormatted = data.terhitung_mulai_tanggal ? new Date(data.terhitung_mulai_tanggal).toLocaleDateString('id-ID') : '-';

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
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 posisi">${data.posisi || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 tmt">${tmtFormatted}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 latar-pendidikan">${data.latar_pendidikan || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sertifikasi">
            <span class="inline-flex items-center rounded-full ${isYa ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'} px-2.5 py-0.5 text-xs font-medium">
                <span class="mr-1.5 inline-block h-1.5 w-1.5 rounded-full ${isYa ? 'bg-green-600 dark:bg-green-400' : 'bg-red-600 dark:bg-red-400'}"></span>
                ${data.sertifikasi || 'Tidak'}
            </span>
        </td>
        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 sk-pegawai">${data.sk_pegawai_tetap || '-'}</td>
        <td class="border border-gray-400 px-4 py-2 text-center align-top">
            <div class="flex items-center justify-center gap-1.5">
                <button type="button" class="btn-edit-tendik inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/40 transition-all duration-200 border border-yellow-200/50 dark:border-yellow-800/30" title="Edit">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z"/>
                    </svg> Edit
                </button>
                <button type="button" class="btn-delete-tendik inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all duration-200 border border-red-200/50 dark:border-red-800/30" title="Hapus">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg> Hapus
                </button>
            </div>
        </td>
    `;

    const editBtn = row.querySelector('.btn-edit-tendik');
    if (editBtn) {
        editBtn.onclick = function() {
            openModalTendik(data.id);
        };
    }

    const deleteBtn = row.querySelector('.btn-delete-tendik');
    if (deleteBtn) {
        deleteBtn.onclick = function() {
            deleteTendik(data.id);
        };
    }

    tbody.appendChild(row);
}

// ==========================================
// DOMContentLoaded
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formTendik');

    const existingRows = document.querySelectorAll('#tendikTableBody tr:not(#emptyStateTendikRow)');
    existingRows.forEach(row => {
        const editBtn = row.querySelector('.btn-edit-tendik');
        if (editBtn) {
            const id = row.id.replace('tendikRow-', '');
            editBtn.onclick = function() {
                openModalTendik(id);
            };
        }

        const deleteBtn = row.querySelector('.btn-delete-tendik');
        if (deleteBtn) {
            const id = row.id.replace('tendikRow-', '');
            deleteBtn.onclick = function() {
                deleteTendik(id);
            };
        }
    });

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const id = document.getElementById('tendikId').value;
            const url = this.action;
            const btn = document.getElementById('btnTendikSubmit');
            const btnText = document.getElementById('btnTextTendik');

            btn.disabled = true;
            btnText.textContent = 'Menyimpan...';

            // Ambil nilai dari Flatpickr dan konversi ke format YYYY-MM-DD
            const tmtInput = document.getElementById('tmtTendik');
            if (tmtInput && window.tmtPicker) {
                const selectedDate = window.tmtPicker.selectedDates[0];
                if (selectedDate) {
                    const year = selectedDate.getFullYear();
                    const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
                    const day = String(selectedDate.getDate()).padStart(2, '0');
                    formData.set('terhitung_mulai_tanggal', `${year}-${month}-${day}`);
                } else {
                    formData.set('terhitung_mulai_tanggal', '');
                }
            }

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
                    updateTendikTable(data.data);
                    window.toast.success(data.message || 'Data tendik berhasil disimpan');
                    TendikModal.close();
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
                console.error('Tendik Error:', error);
                window.toast.error(error.message || 'Terjadi kesalahan saat menyimpan data');
            })
            .finally(() => {
                btn.disabled = false;
                btnText.textContent = id ? 'Update' : 'Simpan';
            });
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModalTendik();
    });
});
</script>