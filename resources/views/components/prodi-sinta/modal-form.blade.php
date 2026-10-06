{{-- Modal Form SINTA --}}
<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-8"
>
    <div class="mx-4 w-full max-w-2xl animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 id="modalFormTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Data SINTA
                </h3>
            </div>
            <button
                type="button"
                onclick="closeModalSinta()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body Form --}}
        <form id="formSinta"
            action="{{ route('prodi.sinta.store') }}"
            method="POST"
            data-ajax="1"
            data-table-id="#sintaTableContainer">

            @csrf
            @method('POST')

            <input type="hidden" id="sintaId" name="id" value="" />
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
                        placeholder="Contoh: 2024/2025"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Dosen Terdata Sinta --}}
                <div>
                    <label for="dosen_terdata_sinta" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Dosen Terdata Sinta <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="dosen_terdata_sinta"
                        name="dosen_terdata_sinta"
                        required
                        maxlength="255"
                        placeholder="Masukkan nama dosen terdata Sinta"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- SINTA Score 3 Tahun --}}
                <div>
                    <label for="sinta_score_3_tahun" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        SINTA Score 3 Tahun <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                        id="sinta_score_3_tahun"
                        name="sinta_score_3_tahun"
                        required
                        min="0"
                        step="0.01"
                        placeholder="0"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- SINTA Score Overall --}}
                <div>
                    <label for="sinta_score_overall" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        SINTA Score Overall <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                        id="sinta_score_overall"
                        name="sinta_score_overall"
                        required
                        min="0"
                        step="0.01"
                        placeholder="0"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Index --}}
                <div>
                    <label for="index" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Index <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                        id="index"
                        name="index"
                        required
                        min="0"
                        step="0.1"
                        placeholder="0"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

                {{-- Link SINTA --}}
                <div>
                    <label for="link_sinta" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Link SINTA
                    </label>
                    <input type="url"
                        id="link_sinta"
                        name="link_sinta"
                        placeholder="https://sinta.kemdikbud.go.id/..."
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-500"
                    />
                </div>

            </div>

            {{-- Footer Modal --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button
                    type="button"
                    onclick="closeModalSinta()"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Keluar
                </button>
                <button
                    type="submit"
                    id="submitSintaBtn"
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
    const form = document.getElementById('formSinta');
    const title = document.getElementById('modalFormTitle');
    const methodField = document.getElementById('methodField');
    const sintaId = document.getElementById('sintaId');

    // ==========================================
    // OPEN / CLOSE MODAL
    // ==========================================
    window.openModalFormSinta = function(action, data) {
        form.reset();
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());

        if (action === 'create') {
            title.textContent = 'Tambah Data SINTA';
            methodField.value = 'POST';
            sintaId.value = '';
            form.action = "{{ route('prodi.sinta.store') }}";
        } else if (action === 'edit' && data) {
            title.textContent = 'Edit Data SINTA';
            methodField.value = 'PUT';
            sintaId.value = data.id;
            form.action = `/prodi/sinta/${data.id}`;

            document.getElementById('tahun_akademik').value = data.tahun_akademik || '';
            document.getElementById('dosen_terdata_sinta').value = data.dosen_terdata_sinta || '';
            document.getElementById('sinta_score_3_tahun').value = data.sinta_score_3_tahun || '';
            document.getElementById('sinta_score_overall').value = data.sinta_score_overall || '';
            document.getElementById('index').value = data.index || '';
            document.getElementById('link_sinta').value = data.link_sinta || '';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    window.closeModalSinta = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        document.querySelectorAll('.text-red-500.text-xs').forEach(el => el.remove());
    };

    // ==========================================
    // EDIT & DELETE
    // ==========================================
    window.editSinta = function(id) {
        fetch(`/prodi/sinta/${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.openModalFormSinta('edit', data.data);
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

    window.deleteSinta = function(id) {
        const modal = document.getElementById('globalConfirmModal');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        const title = document.getElementById('confirmTitle');
        const message = document.getElementById('confirmMessage');

        if (!modal || !cancelBtn || !okBtn) {
            console.error('Global confirm modal tidak ditemukan.');
            return;
        }

        // Set isi modal
        title.textContent = 'Konfirmasi Hapus';
        message.textContent = 'Yakin ingin menghapus data SINTA ini? Tindakan ini tidak dapat dibatalkan.';
        okBtn.textContent = 'Hapus';

        // Tampilkan modal
        modal.classList.remove('hidden');

        // Hindari event listener menumpuk
        const newCancelBtn = cancelBtn.cloneNode(true);
        const newOkBtn = okBtn.cloneNode(true);

        cancelBtn.replaceWith(newCancelBtn);
        okBtn.replaceWith(newOkBtn);

        // Tombol Batal
        newCancelBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // Tombol Hapus
        newOkBtn.addEventListener('click', function() {

            // Disable tombol agar tidak double click
            newOkBtn.disabled = true;
            newOkBtn.textContent = 'Menghapus...';

            fetch(`/prodi/sinta/${id}`, {
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
                // Tutup modal
                modal.classList.add('hidden');

                if (data.success) {
                    if (window.toast) {
                        window.toast.success(data.message);
                    } else {
                        alert(data.message);
                    }

                    // Refresh tabel
                    if (
                        typeof TableRefresh !== 'undefined' &&
                        typeof TableRefresh.refresh === 'function'
                    ) {
                        TableRefresh.refresh('#sintaTableContainer');
                    } else if (
                        typeof window.refreshSintaTable === 'function'
                    ) {
                        window.refreshSintaTable();
                    } else {
                        location.reload();
                    }
                } else {
                    if (window.toast) {
                        window.toast.error(
                            data.message || 'Gagal menghapus data.'
                        );
                    } else {
                        alert(data.message || 'Gagal menghapus data.');
                    }
                }
            })
            .catch(error => {
                modal.classList.add('hidden');

                if (window.toast) {
                    window.toast.error(
                        error.message || 'Terjadi kesalahan saat menghapus data.'
                    );
                } else {
                    alert(
                        error.message || 'Terjadi kesalahan saat menghapus data.'
                    );
                }
            })
            .finally(() => {
                newOkBtn.disabled = false;
                newOkBtn.textContent = 'Hapus';
            });
        });
    };

    // ==========================================
    // TUTUP MODAL OTOMATIS SAAT SUBMIT BERHASIL
    // ==========================================
    document.addEventListener('app:success', function(e) {
        if (!modal.classList.contains('hidden') && modal.classList.contains('flex')) {
            window.closeModalSinta();
        }
    });

    // ==========================================
    // ESC CLOSE
    // ==========================================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.closeModalSinta();
        }
    });

})();
</script>