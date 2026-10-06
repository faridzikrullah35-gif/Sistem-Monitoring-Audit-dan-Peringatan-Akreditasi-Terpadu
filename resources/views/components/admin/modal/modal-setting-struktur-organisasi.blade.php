{{-- ============================================================
    MODAL FORM - TAMBAH / EDIT STRUKTUR ORGANISASI
   ============================================================ --}}
<div id="strukturModal" class="fixed inset-0 z-50 hidden items-start justify-center overflow-y-auto bg-black/50 backdrop-blur-sm py-6">
    <div class="mx-4 w-full max-w-lg animate-[fadeIn_0.2s_ease-out] rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                    <svg class="h-4.5 w-4.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656-.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 id="modalStrukturTitle" class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Tambah Anggota Struktur
                </h3>
            </div>
            <button type="button" onclick="closeModalStruktur()" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-white/[0.06] dark:hover:text-white/70">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        {{--
            PENTING - fix double submit:
            Atribut "data-ajax" SENGAJA TIDAK dipasang di sini. Form ini sudah
            punya handler submit custom sendiri (lihat <script> di bawah) yang
            melakukan fetch() secara manual. Jika ada handler AJAX global lain
            di aplikasi yang otomatis menangani semua form[data-ajax="1"], dan
            atribut itu tetap dipasang, form ini akan ke-submit DUA KALI:
            sekali oleh handler global, sekali oleh script custom di bawah.
            Data "data-table-id" tetap dipakai (dibaca manual oleh script ini
            untuk memanggil window.refreshTable), jadi tetap dipertahankan.
        --}}
        <form id="strukturForm"
              action="{{ route('admin.setting-struktur.store') }}"
              method="POST"
              enctype="multipart/form-data"
              data-table-id="#strukturTableContainer">

            @csrf
            <input type="hidden" id="strukturId" name="id" value="" />
            <input type="hidden" name="_method" id="formMethodStruktur" value="POST" />

            <div class="space-y-4 px-6 py-5">

                {{-- Nama --}}
                <div>
                    <label for="nama" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama anggota" required
                           class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                </div>

                {{-- Jabatan --}}
                <div>
                    <label for="jabatan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="jabatan" name="jabatan" placeholder="Contoh: Kepala LPM" required
                           class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                </div>

                {{-- Parent ID (Atasan) --}}
                <div>
                    <label for="parent_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Atasan / Bagian Induk
                    </label>
                    <select id="parent_id" name="parent_id"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300">
                        <option value="">— Tidak memiliki atasan —</option>
                        @foreach($strukturs as $struktur)
                            <option value="{{ $struktur->id }}">{{ $struktur->nama }} — {{ $struktur->jabatan }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih atasan jika anggota ini berada di bawah jabatan tertentu.</p>
                </div>

                {{-- Foto --}}
                <div>
                    <label for="foto" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Foto</label>
                    <div class="flex items-center gap-4">
                        <div id="fotoPreview" class="hidden shrink-0">
                            <img id="fotoPreviewImg" src="#" alt="Preview" class="h-16 w-16 rounded-full border-2 border-gray-200 object-cover dark:border-gray-600">
                        </div>
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/gif"
                               class="flex-1 rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:border-gray-700 dark:bg-white/[0.04] dark:file:bg-blue-900/30 dark:file:text-blue-400" />
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG, GIF. Maks 2MB.</p>
                    <input type="hidden" id="fotoLama" name="foto_lama" value="" />
                </div>

                {{-- Urutan --}}
                <div>
                    <label for="urutan" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Urutan Tampilan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="urutan" name="urutan" placeholder="Contoh: 1" min="0" required
                           class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-gray-700 dark:bg-white/[0.04] dark:text-gray-300" />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Angka lebih kecil tampil lebih dahulu.</p>
                </div>

                {{-- Status Aktif --}}
                <div class="flex items-center justify-between border-t border-gray-100 pt-4 dark:border-gray-800">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Status Struktur</label>
                        <p id="statusAktifDescription" class="text-xs text-gray-500 dark:text-gray-400">Aktif untuk ditampilkan di publik</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span id="statusLabel" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</span>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="checkbox" id="is_active_struktur" name="is_active" value="1" checked class="peer sr-only">
                            <div class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800"></div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" onclick="closeModalStruktur()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    Batal
                </button>
                <button type="submit" id="submitButtonStruktur" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 disabled:cursor-not-allowed disabled:opacity-60">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    <span id="submitTextStruktur">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    #fotoPreview.show { display: block; }
    #fotoPreview { display: none; flex-shrink: 0; }
    #parent_id option:disabled { color: #9ca3af; background-color: #f3f4f6; }
    .dark #parent_id option:disabled { color: #6b7280; background-color: #1f2937; }
</style>

<script>
(function () {
    // ==========================================
    // GUARD ANTI DOUBLE-INIT
    // ------------------------------------------
    // Fix double submit (penyebab #2): jika partial modal ini ter-include
    // atau ter-render ulang lebih dari sekali di halaman yang sama (mis.
    // lewat navigasi AJAX/tab-switch tanpa reload penuh), blok script ini
    // bisa jalan berkali-kali dan menempelkan banyak "submit" listener ke
    // form yang sama -> satu kali klik "Simpan" memicu beberapa fetch
    // sekaligus. window.__strukturModalInitialized memastikan seluruh
    // inisialisasi (termasuk semua addEventListener di bawah) hanya
    // berjalan SATU KALI walau script-nya sempat dieksekusi ulang.
    // ==========================================
    if (window.__strukturModalInitialized) {
        // Tetap perbarui data terbaru untuk dropdown/edit tanpa re-bind listener
        window.__strukturData = @json($strukturs);
        return;
    }
    window.__strukturModalInitialized = true;

    // ==========================================
    // GLOBAL DATA
    // ==========================================
    window.__strukturData = @json($strukturs);
    let isSubmittingStruktur = false;

    function strukturData() {
        return window.__strukturData || [];
    }

    // ==========================================
    // UTILITY
    // ==========================================
    function getDescendantIds(structureId) {
        const descendants = new Set();
        function collectChildren(parentId) {
            strukturData().forEach(item => {
                if (item.parent_id !== null && Number(item.parent_id) === Number(parentId)) {
                    if (!descendants.has(Number(item.id))) {
                        descendants.add(Number(item.id));
                        collectChildren(item.id);
                    }
                }
            });
        }
        collectChildren(structureId);
        return descendants;
    }

    function prepareParentOptions(currentId = null) {
        const select = document.getElementById('parent_id');
        if (!select) return;
        const descendantIds = currentId ? getDescendantIds(currentId) : new Set();
        Array.from(select.options).forEach(option => {
            if (!option.value) { option.disabled = false; return; }
            const optionId = Number(option.value);
            const isSelf = currentId && optionId === Number(currentId);
            const isDescendant = descendantIds.has(optionId);
            if (isSelf || isDescendant) {
                option.disabled = true;
                if (isSelf) {
                    option.textContent = option.textContent.replace(' (Tidak dapat dipilih)', '') + ' (Tidak dapat dipilih)';
                } else {
                    option.textContent = option.textContent.replace(' (Bawahan)', '') + ' (Bawahan)';
                }
            } else {
                option.disabled = false;
                option.textContent = option.textContent.replace(' (Tidak dapat dipilih)', '').replace(' (Bawahan)', '');
            }
        });
    }

    // ==========================================
    // MODAL CONTROLLER
    // ==========================================
    const StrukturModal = {
        open(id = null) {
            const modal = document.getElementById('strukturModal');
            const title = document.getElementById('modalStrukturTitle');
            const hiddenId = document.getElementById('strukturId');
            const form = document.getElementById('strukturForm');
            const methodInput = document.getElementById('formMethodStruktur');
            const submitText = document.getElementById('submitTextStruktur');

            // Reset form
            this.resetForm();

            if (id) {
                title.textContent = 'Edit Anggota Struktur';
                hiddenId.value = id;
                methodInput.value = 'PUT';
                form.action = `/admin/setting-struktur/${id}`;
                submitText.textContent = 'Update';
                this.loadEditData(id);
            } else {
                title.textContent = 'Tambah Anggota Struktur';
                hiddenId.value = '';
                methodInput.value = 'POST';
                form.action = "{{ route('admin.setting-struktur.store') }}";
                submitText.textContent = 'Simpan';
                prepareParentOptions(null);
                document.getElementById('is_active_struktur').checked = true;
                this.updateStatusLabel(true);
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        },

        close() {
            const modal = document.getElementById('strukturModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
            this.resetForm();
        },

        resetForm() {
            const form = document.getElementById('strukturForm');
            if (!form) return;
            form.reset();
            document.getElementById('strukturId').value = '';
            document.getElementById('fotoPreview').classList.remove('show');
            document.getElementById('fotoPreviewImg').src = '#';
            document.getElementById('fotoLama').value = '';
            document.getElementById('foto').value = '';
            document.getElementById('is_active_struktur').checked = true;
            this.updateStatusLabel(true);
            // Reset parent select
            const parentSelect = document.getElementById('parent_id');
            if (parentSelect) {
                parentSelect.value = '';
                prepareParentOptions(null);
            }
        },

        updateStatusLabel(checked) {
            const label = document.getElementById('statusLabel');
            const desc = document.getElementById('statusAktifDescription');
            if (label) label.textContent = checked ? 'Aktif' : 'Nonaktif';
            if (desc) desc.textContent = checked ? 'Aktif untuk ditampilkan di publik' : 'Nonaktif, tidak ditampilkan';
        },

        async loadEditData(id) {
            try {
                const struktur = strukturData().find(item => Number(item.id) === Number(id));
                if (!struktur) throw new Error('Data tidak ditemukan');

                document.getElementById('nama').value = struktur.nama || '';
                document.getElementById('jabatan').value = struktur.jabatan || '';
                document.getElementById('urutan').value = struktur.urutan ?? '';
                prepareParentOptions(struktur.id);
                document.getElementById('parent_id').value = struktur.parent_id ?? '';
                document.getElementById('is_active_struktur').checked = Boolean(struktur.is_active);
                this.updateStatusLabel(Boolean(struktur.is_active));
                document.getElementById('fotoLama').value = struktur.foto || '';

                if (struktur.foto) {
                    const img = document.getElementById('fotoPreviewImg');
                    img.src = `/storage/struktur_organisasi/${struktur.foto}`;
                    document.getElementById('fotoPreview').classList.add('show');
                } else {
                    document.getElementById('fotoPreview').classList.remove('show');
                }
            } catch (error) {
                console.error(error);
                alert('Gagal memuat data struktur.');
                this.close();
            }
        }
    };

    // ==========================================
    // FUNGSI GLOBAL UNTUK DIPANGGIL DARI TOMBOL
    // ==========================================
    window.openCreateModalStruktur = function () {
        StrukturModal.open(null);
    };

    window.openEditModalStruktur = function (id) {
        StrukturModal.open(id);
    };

    window.closeModalStruktur = function () {
        StrukturModal.close();
    };

    // ==========================================
    // SUBMIT HANDLER
    // ==========================================
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('strukturForm');
        if (!form) return;

        // Preview foto
        document.getElementById('foto')?.addEventListener('change', function () {
            const file = this.files[0];
            const preview = document.getElementById('fotoPreview');
            const img = document.getElementById('fotoPreviewImg');
            if (!file) { preview.classList.remove('show'); img.src = '#'; return; }
            const reader = new FileReader();
            reader.onload = function (e) { img.src = e.target.result; preview.classList.add('show'); };
            reader.readAsDataURL(file);
        });

        // Toggle status
        document.getElementById('is_active_struktur')?.addEventListener('change', function () {
            StrukturModal.updateStatusLabel(this.checked);
        });

        // Submit via AJAX
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            // Hentikan propagasi ke listener lain yang mungkin terpasang pada
            // form/event submit yang sama (mis. handler AJAX global generik)
            // supaya submit ini benar-benar hanya diproses SATU KALI di sini.
            e.stopImmediatePropagation();

            const submitBtn = document.getElementById('submitButtonStruktur');

            // Guard ganda: cek flag DAN status tombol (disabled) sekaligus,
            // supaya klik ganda / trigger submit ganda tetap diabaikan.
            if (isSubmittingStruktur || submitBtn?.disabled) return;
            isSubmittingStruktur = true;

            const originalText = submitBtn?.innerHTML || 'Simpan';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-4 w-4 mr-2 inline" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menyimpan...
                `;
            }

            try {
                const formData = new FormData(this);
                const method = document.getElementById('formMethodStruktur').value || 'POST';
                if (method === 'PUT') {
                    formData.set('_method', 'PUT');
                }

                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    // Tutup modal
                    StrukturModal.close();
                    // Notifikasi sukses
                    if (typeof toastr?.success === 'function') {
                        toastr.success(data.message || 'Data berhasil disimpan!');
                    } else if (typeof showNotification === 'function') {
                        showNotification('success', data.message || 'Data berhasil disimpan!');
                    } else {
                        alert(data.message || 'Data berhasil disimpan!');
                    }
                    // Refresh tabel (jika ada fungsi global)
                    const tableId = this.dataset.tableId;
                    if (tableId && typeof window.refreshTable === 'function') {
                        window.refreshTable(tableId);
                    }
                } else {
                    if (typeof toastr?.error === 'function') {
                        toastr.error(data.message || 'Terjadi kesalahan!');
                    } else if (typeof showNotification === 'function') {
                        showNotification('error', data.message || 'Terjadi kesalahan!');
                    } else {
                        alert(data.message || 'Terjadi kesalahan!');
                    }
                }
            } catch (error) {
                console.error(error);
                if (typeof toastr?.error === 'function') {
                    toastr.error('Gagal menyimpan data. Silakan coba lagi.');
                } else if (typeof showNotification === 'function') {
                    showNotification('error', 'Gagal menyimpan data. Silakan coba lagi.');
                } else {
                    alert('Gagal menyimpan data. Silakan coba lagi.');
                }
            } finally {
                isSubmittingStruktur = false;
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            }
        });
    });
})();
</script>