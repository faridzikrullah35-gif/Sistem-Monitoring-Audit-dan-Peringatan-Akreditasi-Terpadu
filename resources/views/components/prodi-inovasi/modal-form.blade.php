{{-- Modal Form Inovasi --}}
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
                    Tambah Data Inovasi
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalInovasi()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="formInovasi"
            action="{{ route('prodi.inovasi.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#inovasiTableContainer">

            @csrf
            @method('POST')

            <input type="hidden" id="inovasiId" name="id" value="" />
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

                {{-- Nama Dosen --}}
                <div>
                    <label for="nama_dosen" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Dosen <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="nama_dosen"
                        name="nama_dosen"
                        required
                        placeholder="Masukkan nama dosen"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Nama Inovasi --}}
                <div>
                    <label for="nama_inovasi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Inovasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="nama_inovasi"
                        name="nama_inovasi"
                        required
                        placeholder="Masukkan nama inovasi"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Jenis Inovasi --}}
                <div>
                    <label for="jenis_inovasi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jenis Inovasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="jenis_inovasi"
                        name="jenis_inovasi"
                        required
                        placeholder="Contoh: Produk, Metode, Sistem, Teknologi, dll"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- HKI --}}
                <div>
                    <label for="hki" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        HKI
                    </label>
                    <input type="text"
                        id="hki"
                        name="hki"
                        placeholder="Contoh: Paten, Hak Cipta, Merek Dagang, dll"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Isi jika inovasi memiliki HKI</p>
                </div>

                {{-- Nomor HKI --}}
                <div>
                    <label for="nomor_hki" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nomor HKI
                    </label>
                    <input type="text"
                        id="nomor_hki"
                        name="nomor_hki"
                        placeholder="Masukkan nomor HKI"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Produk/Prototype --}}
                <div>
                    <label for="produk_prototype" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Produk / Prototype <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="produk_prototype"
                        name="produk_prototype"
                        required
                        rows="2"
                        placeholder="Deskripsikan produk atau prototype yang dihasilkan"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    ></textarea>
                </div>

                {{-- Pengguna/Mitra --}}
                <div>
                    <label for="pengguna_mitra" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pengguna / Mitra <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="pengguna_mitra"
                        name="pengguna_mitra"
                        required
                        placeholder="Masukkan pengguna atau mitra inovasi"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Link Bukti --}}
                <div>
                    <label for="link_bukti" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Link Bukti
                    </label>
                    <input type="url"
                        id="link_bukti"
                        name="link_bukti"
                        placeholder="https://..."
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Link bukti dokumentasi inovasi</p>
                </div>

            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalInovasi()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    id="submitInovasiBtn"
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
    const form = document.getElementById('formInovasi');
    const title = document.getElementById('modalFormTitle');
    const methodField = document.getElementById('methodField');
    const inovasiId = document.getElementById('inovasiId');

    window.openModalFormInovasi = function(action, data) {
        form.reset();
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());

        if (action === 'create') {
            title.textContent = 'Tambah Data Inovasi';
            methodField.value = 'POST';
            inovasiId.value = '';
            form.action = "{{ route('prodi.inovasi.store') }}";
        } else if (action === 'edit' && data) {
            title.textContent = 'Edit Data Inovasi';
            methodField.value = 'PUT';
            inovasiId.value = data.id;
            form.action = `/prodi/inovasi/${data.id}`;

            document.getElementById('tahun_akademik').value = data.tahun_akademik || '';
            document.getElementById('nama_dosen').value = data.nama_dosen || '';
            document.getElementById('nama_inovasi').value = data.nama_inovasi || '';
            document.getElementById('jenis_inovasi').value = data.jenis_inovasi || '';
            document.getElementById('hki').value = data.hki || '';
            document.getElementById('nomor_hki').value = data.nomor_hki || '';
            document.getElementById('produk_prototype').value = data.produk_prototype || '';
            document.getElementById('pengguna_mitra').value = data.pengguna_mitra || '';
            document.getElementById('link_bukti').value = data.link_bukti || '';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.closeModalInovasi = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());
    };

    window.editInovasi = function(id) {
        fetch(`/prodi/inovasi/${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.openModalFormInovasi('edit', data.data);
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

    window.deleteInovasi = function(id) {
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
        confirmMessage.textContent = 'Yakin ingin menghapus data Inovasi ini? Tindakan ini tidak dapat dibatalkan.';
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

            fetch(`/prodi/inovasi/${id}`, {
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
                        TableRefresh.refresh('#inovasiTableContainer');
                    } else if (typeof window.refreshInovasiTable === 'function') {
                        window.refreshInovasiTable();
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
            window.closeModalInovasi();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.closeModalInovasi();
        }
    });

})();
</script>