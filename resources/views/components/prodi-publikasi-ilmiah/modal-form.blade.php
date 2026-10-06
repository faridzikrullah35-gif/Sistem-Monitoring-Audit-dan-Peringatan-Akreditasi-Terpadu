{{-- Modal Form Publikasi Ilmiah --}}
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
                    Tambah Data Publikasi Ilmiah
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalPublikasi()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="formPublikasi"
            action="{{ route('prodi.publikasi-ilmiah.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#publikasiTableContainer">

            @csrf
            @method('POST')

            <input type="hidden" id="publikasiId" name="id" value="" />
            <input type="hidden" id="methodField" name="_method" value="POST" />

            <div class="space-y-5 px-6 py-5">

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

                {{-- NIDN --}}
                <div>
                    <label for="nidn" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        NIDN
                    </label>
                    <input type="text"
                        id="nidn"
                        name="nidn"
                        placeholder="Masukkan NIDN"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Judul Artikel --}}
                <div>
                    <label for="judul_artikel" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Judul Artikel <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="judul_artikel"
                        name="judul_artikel"
                        required
                        placeholder="Masukkan judul artikel"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Jenis Publikasi --}}
                <div>
                    <label for="jenis_publikasi" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jenis Publikasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="jenis_publikasi"
                        name="jenis_publikasi"
                        required
                        placeholder="Contoh: Jurnal, Prosiding, dll"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Nama Jurnal/Prosiding --}}
                <div>
                    <label for="nama_jurnal_prosiding" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Jurnal / Prosiding <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="nama_jurnal_prosiding"
                        name="nama_jurnal_prosiding"
                        required
                        placeholder="Masukkan nama jurnal atau prosiding"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- ISSN --}}
                <div>
                    <label for="issn" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        ISSN
                    </label>
                    <input type="text"
                        id="issn"
                        name="issn"
                        placeholder="Masukkan ISSN"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Volume/No --}}
                <div>
                    <label for="volume_no" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Volume / No
                    </label>
                    <input type="text"
                        id="volume_no"
                        name="volume_no"
                        placeholder="Contoh: Vol. 10, No. 2"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- SINTA/Scopus --}}
                <div>
                    <label for="sinta_scopus" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        SINTA / Scopus
                    </label>
                    <input type="text"
                        id="sinta_scopus"
                        name="sinta_scopus"
                        placeholder="Contoh: SINTA 1, Scopus Q2, dll"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Penulis ke- --}}
                <div>
                    <label for="penulis_ke" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Penulis ke-
                    </label>
                    <input type="text"
                        id="penulis_ke"
                        name="penulis_ke"
                        placeholder="Contoh: 1, 2, 3, atau korespondensi"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- TAHUN AKADEMIK - TAMBAHKAN --}}
                <div>
                    <label for="tahun_akademik" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tahun Akademik <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="tahun_akademik"
                        name="tahun_akademik"
                        required
                        placeholder="Contoh: 2024/2025 atau 2024-2025"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: Tahun Awal/Tahun Akhir (contoh: 2024/2025 atau 2024-2025)</p>
                </div>

                {{-- Link Artikel --}}
                <div>
                    <label for="link_artikel" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Link Artikel
                    </label>
                    <input type="url"
                        id="link_artikel"
                        name="link_artikel"
                        placeholder="https://..."
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalPublikasi()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    id="submitPublikasiBtn"
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
    const form = document.getElementById('formPublikasi');
    const title = document.getElementById('modalFormTitle');
    const methodField = document.getElementById('methodField');
    const publikasiId = document.getElementById('publikasiId');

    window.openModalFormPublikasi = function(action, data) {
        form.reset();
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());

        if (action === 'create') {
            title.textContent = 'Tambah Data Publikasi Ilmiah';
            methodField.value = 'POST';
            publikasiId.value = '';
            form.action = "{{ route('prodi.publikasi-ilmiah.store') }}";
        } else if (action === 'edit' && data) {
            title.textContent = 'Edit Data Publikasi Ilmiah';
            methodField.value = 'PUT';
            publikasiId.value = data.id;
            form.action = `/prodi/publikasi-ilmiah/${data.id}`;

            document.getElementById('nama_dosen').value = data.nama_dosen || '';
            document.getElementById('nidn').value = data.nidn || '';
            document.getElementById('judul_artikel').value = data.judul_artikel || '';
            document.getElementById('jenis_publikasi').value = data.jenis_publikasi || '';
            document.getElementById('nama_jurnal_prosiding').value = data.nama_jurnal_prosiding || '';
            document.getElementById('issn').value = data.issn || '';
            document.getElementById('volume_no').value = data.volume_no || '';
            document.getElementById('sinta_scopus').value = data.sinta_scopus || '';
            document.getElementById('penulis_ke').value = data.penulis_ke || '';
            document.getElementById('tahun_akademik').value = data.tahun_akademik || ''; // TAMBAHKAN
            document.getElementById('link_artikel').value = data.link_artikel || '';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.closeModalPublikasi = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());
    };

    window.editPublikasi = function(id) {
        fetch(`/prodi/publikasi-ilmiah/${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.openModalFormPublikasi('edit', data.data);
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

    window.deletePublikasi = function(id) {
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
        confirmMessage.textContent = 'Yakin ingin menghapus data Publikasi Ilmiah ini? Tindakan ini tidak dapat dibatalkan.';
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

            fetch(`/prodi/publikasi-ilmiah/${id}`, {
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
                        TableRefresh.refresh('#publikasiTableContainer');
                    } else if (typeof window.refreshPublikasiTable === 'function') {
                        window.refreshPublikasiTable();
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
            window.closeModalPublikasi();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.closeModalPublikasi();
        }
    });

})();
</script>