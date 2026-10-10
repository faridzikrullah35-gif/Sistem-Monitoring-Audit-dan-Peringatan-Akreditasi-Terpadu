@props([
    'mahasiswa' => null
])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <div class="mb-4 flex items-center justify-between">
    <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90">Jumlah Mahasiswa</h4>
        <div class="flex items-center gap-2">
            {{-- Tombol Print --}}
            <a href="{{ route('prodi.identitas-prodi.mahasiswa.print') }}"
            target="_blank"
            class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition-all duration-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print
            </a>

            {{-- Tombol Tambah --}}
            <button type="button" 
                    class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800" 
                    onclick="openCreateMahasiswaModal()">
                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah
            </button>
        </div>
    </div>

    <div class="relative w-full rounded-lg border border-gray-200 dark:border-gray-700">
        <div id="mahasiswaTableContainer" class="overflow-auto" style="max-height: 600px;">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">No</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Jumlah Mahasiswa</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Tahun Akademik</th>
                        <th class="sticky top-0 z-30 bg-gray-50 px-4 py-3 text-center text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody id="mahasiswaTableBody">
                    @php
                        $jumlahMahasiswa = $mahasiswa && $mahasiswa->exists ? ($mahasiswa->jumlah_mahasiswa ?? 0) : 0;
                        $tahunAkademik = $mahasiswa && $mahasiswa->exists ? ($mahasiswa->tahun_akademik ?? '') : '';
                    @endphp

                    @if($mahasiswa && $mahasiswa->exists && $jumlahMahasiswa > 0)
                    <tr class="border-b border-gray-200 dark:border-gray-700" id="mahasiswaRow-{{ $mahasiswa->id }}">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2" id="jumlahMahasiswa-{{ $mahasiswa->id }}">{{ $jumlahMahasiswa }}</td>
                        <td class="px-4 py-2" id="tahunAkademik-{{ $mahasiswa->id }}">{{ $tahunAkademik ?: '-' }}</td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button"
                                        onclick="openEditMahasiswaModal({{ $mahasiswa->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                                <button type="button"
                                        onclick="deleteMahasiswa({{ $mahasiswa->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @else
                    <tr id="emptyStateRow">
                        <td colspan="4" class="text-center py-8">
                            <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="text-sm font-medium">Belum ada data Mahasiswa</span>
                                <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik tombol Tambah untuk menambahkan data</span>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL MAHASISWA --}}
<div id="modalMahasiswa" 
     tabindex="-1" 
     class="modal-overlay fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 p-4" 
     style="backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);"
     onclick="event.stopPropagation();">
    <div class="relative mx-auto max-w-md top-20" onclick="event.stopPropagation();">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800" onclick="event.stopPropagation();">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalMahasiswaTitle">Tambah Mahasiswa</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 text-sm dark:hover:bg-gray-700 dark:hover:text-white" onclick="closeModal('modalMahasiswa')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <form id="formMahasiswa" method="POST" onsubmit="return handleMahasiswaSubmit(event)">
                    @csrf
                    <input type="hidden" id="formMode" name="mode" value="create">
                    <input type="hidden" id="editId" name="id">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Mahasiswa</label>
                        <input type="number" 
                               name="jumlah_mahasiswa" 
                               id="inputJumlahMahasiswa" 
                               required 
                               min="0" 
                               value="0"
                               class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Akademik</label>
                        <input type="text" 
                               name="tahun_akademik" 
                               id="inputTahunAkademik" 
                               placeholder="Contoh: 2024/2025" 
                               class="mt-1 w-full rounded-lg border border-gray-300 p-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="button" 
                                class="mr-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700" 
                                onclick="closeModal('modalMahasiswa')">
                            Batal
                        </button>
                        <button type="submit" 
                                id="btnMahasiswaSubmit" 
                                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                            <span id="btnText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Include UI Alert --}}
<x-ui.alert />

<script>
    (function() {
        'use strict';

        const ROUTES = {
            store: '{{ route("prodi.identitas-prodi.mahasiswa.store") }}',
            update: (id) => '{{ route("prodi.identitas-prodi.mahasiswa.update", ["id" => ":id"]) }}'.replace(':id', id),
            destroy: (id) => '{{ route("prodi.identitas-prodi.mahasiswa.destroy", ["id" => ":id"]) }}'.replace(':id', id),
        };

        const els = {
            form: document.getElementById('formMahasiswa'),
            mode: document.getElementById('formMode'),
            id: document.getElementById('editId'),
            jumlahMahasiswa: document.getElementById('inputJumlahMahasiswa'),
            tahunAkademik: document.getElementById('inputTahunAkademik'),
            title: document.getElementById('modalMahasiswaTitle'),
            btnText: document.getElementById('btnText'),
            submit: document.getElementById('btnMahasiswaSubmit')
        };

        const clearErrors = () => {
            document.querySelectorAll('#formMahasiswa .is-invalid').forEach(el => {
                el.classList.remove('is-invalid', 'border-red-500');
            });
            document.querySelectorAll('#formMahasiswa .invalid-feedback').forEach(el => el.remove());
        };

        const showErrors = (errors) => {
            for (const [field, messages] of Object.entries(errors)) {
                const input = document.querySelector(`#formMahasiswa [name="${field}"]`);
                if (input) {
                    input.classList.add('is-invalid', 'border-red-500');
                    const div = document.createElement('div');
                    div.className = 'invalid-feedback text-red-500 text-xs mt-1';
                    div.innerText = messages[0];
                    input.parentNode.appendChild(div);
                }
            }
        };

        const resetForm = function() {
            els.form.reset();
            els.mode.value = 'create';
            els.id.value = '';
            els.title.textContent = 'Tambah Mahasiswa';
            els.btnText.textContent = 'Simpan';
            els.jumlahMahasiswa.value = '0';
            els.tahunAkademik.value = '';
            clearErrors();
        };

        function showConfirmDialog(title, message, onConfirm, onCancel) {
            const modal = document.getElementById('globalConfirmModal');
            const titleEl = document.getElementById('confirmTitle');
            const messageEl = document.getElementById('confirmMessage');
            const okBtn = document.getElementById('confirmOkBtn');
            const cancelBtn = document.getElementById('confirmCancelBtn');
            const backdrop = document.getElementById('confirmBackdrop');

            titleEl.textContent = title || 'Konfirmasi Hapus';
            messageEl.textContent = message || 'Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';
            modal.classList.remove('hidden');

            const handleOk = function() {
                modal.classList.add('hidden');
                okBtn.removeEventListener('click', handleOk);
                cancelBtn.removeEventListener('click', handleCancel);
                backdrop.removeEventListener('click', handleBackdrop);
                if (typeof onConfirm === 'function') onConfirm();
            };

            const handleCancel = function() {
                modal.classList.add('hidden');
                okBtn.removeEventListener('click', handleOk);
                cancelBtn.removeEventListener('click', handleCancel);
                backdrop.removeEventListener('click', handleBackdrop);
                if (typeof onCancel === 'function') onCancel();
            };

            const handleBackdrop = function(e) {
                if (e.target === backdrop) {
                    handleCancel();
                }
            };

            okBtn.addEventListener('click', handleOk);
            cancelBtn.addEventListener('click', handleCancel);
            backdrop.addEventListener('click', handleBackdrop);

            const handleEscape = function(e) {
                if (e.key === 'Escape') {
                    handleCancel();
                    document.removeEventListener('keydown', handleEscape);
                }
            };
            document.addEventListener('keydown', handleEscape);
        }

        // ============================================
        // OPEN CREATE MODAL
        // ============================================
        window.openCreateMahasiswaModal = function() {
            resetForm();
            openModal('modalMahasiswa');
        };

        // ============================================
        // OPEN EDIT MODAL - PAKAI DELAY
        // ============================================
        window.openEditMahasiswaModal = function(id) {
            const jumlahEl = document.getElementById(`jumlahMahasiswa-${id}`);
            const tahunEl = document.getElementById(`tahunAkademik-${id}`);
            
            const jumlah = parseInt(jumlahEl?.textContent?.trim() || 0);
            const tahun = tahunEl?.textContent?.trim() || '';
            
            els.mode.value = 'edit';
            els.id.value = id;
            els.title.textContent = 'Edit Mahasiswa';
            els.btnText.textContent = 'Perbarui';
            
            clearErrors();
            
            // Buka modal dulu
            openModal('modalMahasiswa');
            
            // Set value dengan delay setelah modal terbuka
            setTimeout(function() {
                els.jumlahMahasiswa.value = jumlah;
                els.tahunAkademik.value = tahun === '-' ? '' : tahun;
                
                // Trigger change event untuk update UI
                const event = new Event('change', { bubbles: true });
                els.jumlahMahasiswa.dispatchEvent(event);
                els.tahunAkademik.dispatchEvent(event);
            }, 100);
        };

        // ============================================
        // HANDLE SUBMIT
        // ============================================
        window.handleMahasiswaSubmit = function(event) {
            event.preventDefault();
            event.stopPropagation();

            const mode = els.mode.value;
            const id = els.id.value;
            const formData = new FormData(els.form);
            
            clearErrors();

            const url = mode === 'edit' ? ROUTES.update(id) : ROUTES.store;
            const loadingText = mode === 'edit' ? 'Memperbarui...' : 'Menyimpan...';

            els.submit.disabled = true;
            els.btnText.innerHTML = `
                <svg class="animate-spin h-4 w-4 mr-2 inline" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ${loadingText}
            `;

            const cleanData = new FormData();
            cleanData.append('jumlah_mahasiswa', formData.get('jumlah_mahasiswa') || 0);
            cleanData.append('tahun_akademik', formData.get('tahun_akademik') || '');
            
            if (mode === 'edit') {
                cleanData.append('_method', 'PUT');
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: cleanData
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw data;
                return data;
            })
            .then(data => {
                if (data.status) {
                    const msg = mode === 'edit' ? 'Data berhasil diperbarui.' : 'Data berhasil ditambahkan.';
                    toastr?.success(data.message || msg);
                    closeModal('modalMahasiswa');
                    refreshMahasiswaTable();
                } else if (data.errors) {
                    showErrors(data.errors);
                    const msg = Object.values(data.errors).flat().join('\n');
                    toastr?.error(msg);
                } else {
                    toastr?.error(data.message || 'Terjadi kesalahan.');
                }
            })
            .catch(err => {
                const msg = err.errors ? Object.values(err.errors).flat().join('\n') : (err.message || 'Terjadi kesalahan pada server.');
                toastr?.error(msg);
            })
            .finally(() => {
                els.submit.disabled = false;
                els.btnText.textContent = mode === 'edit' ? 'Perbarui' : 'Simpan';
            });

            return false;
        };

        // ============================================
        // DELETE MAHASISWA
        // ============================================
        window.deleteMahasiswa = function(id) {
            showConfirmDialog(
                'Konfirmasi Hapus',
                'Yakin ingin menghapus data Mahasiswa? Nilai akan direset ke 0.',
                function() {
                    const url = ROUTES.destroy(id);

                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(async res => {
                        const data = await res.json();
                        if (!res.ok) throw data;
                        return data;
                    })
                    .then(data => {
                        if (data.status) {
                            toastr?.success('Data Mahasiswa berhasil direset.');
                            refreshMahasiswaTable();
                        } else {
                            toastr?.error(data.message || 'Gagal menghapus data');
                        }
                    })
                    .catch(err => {
                        toastr?.error(err.message || 'Terjadi kesalahan pada server.');
                    });
                },
                function() {}
            );
        };

        // ============================================
        // REFRESH TABLE
        // ============================================
        window.refreshMahasiswaTable = function() {
            const tbody = document.querySelector('#mahasiswaTableBody');
            if (tbody) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-8">
                            <div class="flex items-center justify-center">
                                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="ml-3 text-gray-600 dark:text-gray-400">Memuat data...</span>
                            </div>
                        </td>
                    </tr>
                `;
            }

            fetch('{{ route("prodi.identitas-prodi") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newBody = doc.querySelector('#mahasiswaTableBody');
                const currentBody = document.querySelector('#mahasiswaTableBody');
                
                if (newBody && currentBody) {
                    currentBody.innerHTML = newBody.innerHTML;
                } else {
                    location.reload();
                }
            })
            .catch(() => location.reload());
        };

        // ============================================
        // MODAL HELPERS
        // ============================================
        window.openModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closeModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                resetForm();
            }
        };

        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            .animate-spin {
                animation: spin 1s linear infinite;
            }
        `;
        document.head.appendChild(style);

    })();
</script>