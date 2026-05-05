<form 
    action="{{ route('profile.update') }}" 
    method="POST" 
    enctype="multipart/form-data"
    data-ajax
>
@csrf

<div id="profileModal"
    class="fixed inset-0 flex items-center justify-center z-50 opacity-0 scale-95 pointer-events-none transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] p-4 sm:p-6">

    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- Modal -->
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh] z-10">

        <!-- Header -->
        <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-100">
            <h2 id="modalTitle" class="text-lg font-bold text-gray-900"></h2>
            <button type="button" id="closeModalBtn"
                class="w-8 h-8 rounded-full bg-gray-100 hover:bg-red-50 hover:text-red-500 flex items-center justify-center">
                ✕
            </button>
        </div>

        <!-- CONTENT -->
        <div class="p-6 overflow-y-auto">

            <!-- INFO -->
            <div class="modal-section hidden space-y-4" id="section-info">

                <input type="text" name="name"
                    value="{{ auth()->user()->name }}"
                    placeholder="Nama"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm">

                <input type="email" name="email"
                    value="{{ auth()->user()->email }}"
                    placeholder="Email"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm">

                <input type="text" name="phone"
                    placeholder="No HP"
                    class="w-full border rounded-xl px-4 py-2.5 text-sm">
            </div>

            <!-- ADDRESS -->
            <div class="modal-section hidden space-y-4" id="section-address">
                <input type="text" name="country" placeholder="Negara" class="w-full border rounded-xl px-4 py-2.5 text-sm">
                <input type="text" name="city" placeholder="Kota" class="w-full border rounded-xl px-4 py-2.5 text-sm">
                <input type="text" name="postal_code" placeholder="Kode Pos" class="w-full border rounded-xl px-4 py-2.5 text-sm">
            </div>

            <!-- PHOTO -->
            <div class="modal-section hidden" id="section-photo">
                <div id="uploadBox"
                    class="relative flex flex-col items-center justify-center border-2 border-dashed rounded-xl p-8 text-center cursor-pointer">

                    <img id="previewImage" class="hidden max-h-48 mb-4 rounded-lg" />

                    <div id="uploadPlaceholder">
                        <p class="text-sm text-gray-500">Klik / drag foto</p>
                    </div>

                    <!-- FIX DISINI -->
                    <input id="fileInput" name="photo" type="file"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        accept="image/*">
                </div>
            </div>

            <!-- PHOTO VIEWER (FULL PREVIEW) -->
            <div class="modal-section hidden" id="section-photo-view">
                <div class="flex flex-col items-center gap-4">
                    <!-- Preview besar -->
                    <div class="max-h-[60vh] overflow-auto rounded-xl border shadow-md">
                        <img id="fullPreviewImage"
                            src="{{ auth()->user()->photo 
                                    ? asset('storage/' . auth()->user()->photo) 
                                    : asset('images/default-avatar.png') }}"
                            class="w-auto max-w-full object-contain">
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex gap-3 w-full">
                        <!-- Edit -->
                        <button type="button"
                            id="btnEditPhoto"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-xl">
                            Edit Foto
                        </button>
                        <!-- Delete -->
                        <button type="button"
                            id="btnDeletePhoto"
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-xl">
                            Hapus Foto
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="p-6 border-t">
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2.5 rounded-xl">
                Simpan Perubahan
            </button>
        </div>

    </div>
</div>

<div id="confirmModal"
    class="fixed inset-0 flex items-center justify-center z-[60] opacity-0 scale-95 pointer-events-none transition-all duration-200">

    <!-- backdrop -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- box -->
    <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-6 relative z-10 text-center">

        <h2 class="text-lg font-bold text-gray-900 mb-2">Hapus Foto?</h2>
        <p class="text-sm text-gray-500 mb-6">
            Foto profil akan dihapus permanen.
        </p>

        <div class="flex gap-3">

            <button id="cancelDelete"
                class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200">
                Batal
            </button>

            <button id="confirmDelete"
                class="flex-1 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white">
                Hapus
            </button>

        </div>

    </div>
</div>

</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // =========================
    // MODAL ELEMENT
    // =========================
    const modal = document.getElementById('profileModal');
    const closeBtn = document.getElementById('closeModalBtn');
    const title = document.getElementById('modalTitle');

    // Sections
    const sections = {
        info: document.getElementById('section-info'),
        address: document.getElementById('section-address'),
        photo: document.getElementById('section-photo'),
        photoView: document.getElementById('section-photo-view')
    };

    const titles = {
        info: "Edit Informasi Pengguna",
        address: "Edit Alamat",
        photo: "Edit Foto Profil",
        photoView: "Preview Foto Profil"
    };

    // =========================
    // OPEN MODAL
    // =========================
    document.querySelectorAll('.openModal').forEach(btn => {
        btn.addEventListener('click', () => {

            const type = btn.dataset.modal;

            // hide all sections
            Object.values(sections).forEach(sec => {
                if (sec) sec.classList.add('hidden');
            });

            // show target section
            if (sections[type]) {
                sections[type].classList.remove('hidden');
            }

            title.innerText = titles[type] ?? "Modal";

            modal.classList.remove('opacity-0','scale-95','pointer-events-none');
        });
    });

    // =========================
    // CLOSE MODAL
    // =========================
    closeBtn?.addEventListener('click', () => {
        modal.classList.add('opacity-0','scale-95','pointer-events-none');
    });

    // =========================
    // IMAGE PREVIEW UPLOAD
    // =========================
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('previewImage');
    const placeholder = document.getElementById('uploadPlaceholder');
    const uploadBox = document.getElementById('uploadBox');

    if (fileInput && preview && uploadBox) {

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('File harus berupa gambar!');
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                alert('Max file 5MB!');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder?.classList.add('hidden');

                uploadBox.classList.remove('p-8');
                uploadBox.classList.add('p-4');
            };

            reader.readAsDataURL(file);
        });

        // DRAG & DROP
        uploadBox.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadBox.classList.add('border-indigo-500');
        });

        uploadBox.addEventListener('dragleave', () => {
            uploadBox.classList.remove('border-indigo-500');
        });

        uploadBox.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadBox.classList.remove('border-indigo-500');

            const file = e.dataTransfer.files[0];
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        });
    }

    // =========================
    // PHOTO VIEW ACTION
    // =========================
    const confirmModal = document.getElementById('confirmModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');

    btnEditPhoto?.addEventListener('click', () => {

        sections.photoView?.classList.add('hidden');
        sections.photo?.classList.remove('hidden');

        title.innerText = "Edit Foto Profil";
    });

    btnDeletePhoto?.addEventListener('click', () => {
        confirmModal?.classList.remove('opacity-0','scale-95','pointer-events-none');
    });

    cancelDelete?.addEventListener('click', () => {
        confirmModal?.classList.add('opacity-0','scale-95','pointer-events-none');
    });

    confirmDelete?.addEventListener('click', async () => {

        try {

            const res = await fetch("{{ route('profile.delete-photo') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            });

            const data = await res.json().catch(() => ({}));

            if (res.ok) {
                showSuccess(data.message ?? "Foto berhasil dihapus");

                setTimeout(() => location.reload(), 700);

            } else {
                showError(data.message ?? "Gagal hapus foto");
            }

        } catch (err) {
            showError("Server error");
        } finally {
            confirmModal?.classList.add('opacity-0','scale-95','pointer-events-none');
        }

    });

});
</script>
@endpush