{{-- Modal Form Prestasi Akademik Mahasiswa --}}
<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data Prestasi Akademik Mahasiswa
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalPrestasi()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="formPrestasi"
            action="{{ route('prodi.prestasi-akademik-mahasiswa.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#prestasiTableContainer">

            @csrf
            @method('POST')

            <input type="hidden" id="prestasiId" name="id" value="" />
            <input type="hidden" id="methodField" name="_method" value="POST" />

            <div class="space-y-5 px-6 py-5">

                {{-- Tahun Akademik --}}
                <div>
                    <label for="tahun_akademik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tahun Akademik <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="tahun_akademik"
                        name="tahun_akademik"
                        required
                        placeholder="Contoh: 2024/2025 atau 2024-2025"
                        pattern="^\d{4}[/-]\d{4}$"
                        title="Format: 2024/2025 atau 2024-2025"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: Tahun Awal/Tahun Akhir (contoh: 2024/2025 atau 2024-2025)</p>
                </div>

                {{-- Nama Kegiatan --}}
                <div>
                    <label for="nama_kegiatan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="nama_kegiatan"
                        name="nama_kegiatan"
                        required
                        placeholder="Masukkan nama kegiatan"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Waktu Perolehan --}}
                <div>
                    <label for="waktu_perolehan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Waktu Perolehan <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                        id="waktu_perolehan"
                        name="waktu_perolehan"
                        required
                        min="2000"
                        max="{{ date('Y') }}"
                        placeholder="Contoh: 2024"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Masukkan tahun perolehan prestasi (contoh: 2024)</p>
                </div>

                {{-- Tingkat --}}
                <div>
                    <label for="tingkat" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tingkat <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="tingkat"
                        name="tingkat"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:focus:border-blue-500"
                    >
                        <option value="">Pilih Tingkat</option>
                        <option value="Lokal/Wilayah">Lokal/Wilayah</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>

                {{-- Prestasi yang Dicapai --}}
                <div>
                    <label for="prestasi_dicapai" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Prestasi yang Dicapai <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="prestasi_dicapai"
                        name="prestasi_dicapai"
                        required
                        rows="3"
                        placeholder="Deskripsikan prestasi yang dicapai"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    ></textarea>
                </div>

                {{-- Link (Baru) --}}
                <div>
                    <label for="link" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Link <span class="text-gray-400 text-xs">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <input type="url"
                            id="link"
                            name="link"
                            placeholder="https://example.com/sertifikat"
                            class="w-full rounded-lg border border-gray-300 bg-white pl-10 pr-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                        />
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Masukkan URL link untuk dokumentasi prestasi (contoh: https://example.com/sertifikat)
                    </p>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">
                        <span class="font-medium">Tips:</span> Pastikan link dimulai dengan http:// atau https://
                    </p>
                </div>

            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalPrestasi()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    id="submitPrestasiBtn"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
(function() {
    'use strict';

    const modal = document.getElementById('userModal');
    const form = document.getElementById('formPrestasi');
    const title = document.getElementById('modalFormTitle');
    const methodField = document.getElementById('methodField');
    const prestasiId = document.getElementById('prestasiId');

    window.openModalFormPrestasi = function(action, data) {
        form.reset();
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());

        if (action === 'create') {
            title.textContent = 'Tambah Data Prestasi Akademik Mahasiswa';
            methodField.value = 'POST';
            prestasiId.value = '';
            form.action = "{{ route('prodi.prestasi-akademik-mahasiswa.store') }}";
        } else if (action === 'edit' && data) {
            title.textContent = 'Edit Data Prestasi Akademik Mahasiswa';
            methodField.value = 'PUT';
            prestasiId.value = data.id;
            form.action = `/prodi/prestasi-akademik-mahasiswa/${data.id}`;

            document.getElementById('tahun_akademik').value = data.tahun_akademik || '';
            document.getElementById('nama_kegiatan').value = data.nama_kegiatan || '';
            document.getElementById('waktu_perolehan').value = data.waktu_perolehan || '';
            document.getElementById('tingkat').value = data.tingkat || '';
            document.getElementById('prestasi_dicapai').value = data.prestasi_dicapai || '';
            document.getElementById('link').value = data.link || '';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.closeModalPrestasi = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());
    };

    window.editPrestasi = function(id) {
        fetch(`/prodi/prestasi-akademik-mahasiswa/${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.openModalFormPrestasi('edit', data.data);
                } else {
                    if (window.toast) window.toast.error(data.message || 'Gagal mengambil data');
                    else alert(data.message || 'Gagal mengambil data');
                }
            })
            .catch(() => {
                if (window.toast) window.toast.error('Terjadi kesalahan saat mengambil data');
                else alert('Terjadi kesalahan saat mengambil data');
            });
    };

    window.deletePrestasi = function(id) {
        const modalConfirm = document.getElementById('globalConfirmModal');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        const confirmTitle = document.getElementById('confirmTitle');
        const confirmMessage = document.getElementById('confirmMessage');

        if (!modalConfirm || !cancelBtn || !okBtn) {
            console.error('Global confirm modal tidak ditemukan.');
            return;
        }

        confirmTitle.textContent = 'Konfirmasi Hapus';
        confirmMessage.textContent = 'Yakin ingin menghapus data Prestasi Akademik Mahasiswa ini? Tindakan ini tidak dapat dibatalkan.';
        okBtn.textContent = 'Hapus';

        modalConfirm.classList.remove('hidden');

        const newCancelBtn = cancelBtn.cloneNode(true);
        const newOkBtn = okBtn.cloneNode(true);

        cancelBtn.replaceWith(newCancelBtn);
        okBtn.replaceWith(newOkBtn);

        newCancelBtn.addEventListener('click', function() {
            modalConfirm.classList.add('hidden');
        });

        newOkBtn.addEventListener('click', function() {
            newOkBtn.disabled = true;
            newOkBtn.textContent = 'Menghapus...';

            fetch(`/prodi/prestasi-akademik-mahasiswa/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) {
                    throw new Error(data.message || 'Gagal menghapus data.');
                }
                return data;
            })
            .then(data => {
                modalConfirm.classList.add('hidden');

                if (data.success) {
                    if (window.toast) window.toast.success(data.message);
                    else alert(data.message);

                    if (typeof TableRefresh !== 'undefined' && typeof TableRefresh.refresh === 'function') {
                        TableRefresh.refresh('#prestasiTableContainer');
                    } else if (typeof window.refreshPrestasiTable === 'function') {
                        window.refreshPrestasiTable();
                    } else {
                        location.reload();
                    }
                } else {
                    if (window.toast) window.toast.error(data.message || 'Gagal menghapus data.');
                    else alert(data.message || 'Gagal menghapus data.');
                }
            })
            .catch(error => {
                modalConfirm.classList.add('hidden');
                if (window.toast) window.toast.error(error.message || 'Terjadi kesalahan saat menghapus data.');
                else alert(error.message || 'Terjadi kesalahan saat menghapus data.');
            })
            .finally(() => {
                newOkBtn.disabled = false;
                newOkBtn.textContent = 'Hapus';
            });
        });
    };

    document.addEventListener('app:success', function(e) {
        if (!modal.classList.contains('hidden') && modal.classList.contains('flex')) {
            window.closeModalPrestasi();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.closeModalPrestasi();
        }
    });

})();
</script>