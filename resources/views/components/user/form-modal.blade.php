<div id="userModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    <!-- Backdrop (Blur) -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

    <!-- Container Scroll Baru (Triwul Center Aligned) -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 py-10">
            
            <!-- Modal Panel -->
            <div class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all flex flex-col">
                
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Pengguna Baru
                    </h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Form Body -->
                <form 
                    id="userForm"
                    action="{{ route('pengguna.store') }}"
                    method="POST"
                >
                    @csrf

                    <input type="hidden" name="id" id="user_id">

                    <div class="px-6 py-5 space-y-5 flex-1">

                        <x-user.fields.basic-info />
                        <x-user.fields.role-access />

                    </div>

                    <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
    
                        <!-- Batal -->
                        <button 
                            type="button" 
                            onclick="closeModal()"
                            class="px-4 py-2 text-sm font-medium rounded-lg 
                                text-gray-700 bg-gray-100 hover:bg-gray-200 
                                dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600
                                transition-all duration-200
                                focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                        >
                            Batal
                        </button>

                        <!-- Simpan -->
                        <button 
                            type="submit"
                            id="submitBtn"
                            class="px-4 py-2 text-sm font-medium rounded-lg 
                                text-white bg-blue-600 hover:bg-blue-700 
                                shadow-sm hover:shadow-md
                                transition-all duration-200
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                        >
                            Simpan
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
// ============================================================
// 1. FUNGSI MODAL (open, close, clear errors)
// ============================================================

async function openModal(type, id = null) {
    const modal = document.getElementById('userModal');
    const form = document.getElementById('userForm');
    const modalTitle = document.getElementById('modal-title');

    // Reset form & errors
    form.reset();
    clearFormErrors();
    document.getElementById('user_id').value = '';

    // hapus method override lama kalau ada
    const oldMethod = form.querySelector('input[name="_method"]');
    if (oldMethod) oldMethod.remove();

    // tetap POST (method spoofing ditangani lewat _method kalau perlu)
    form.method = "POST";

    if (type === 'edit' && id) {
        modalTitle.innerText = 'Edit Pengguna';

        try {
            const url = window.routes.pengguna.show.replace(':id', id);

            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data');

            const user = await response.json();

            document.getElementById('user_id').value = user.id;
            form.querySelector('[name="name"]').value = user.name || '';
            form.querySelector('[name="email"]').value = user.email || '';
            form.querySelector('[name="role"]').value = user.role || '';
            form.querySelector('[name="unit"]').value = user.unit || '';
            form.querySelector('[name="sub_unit"]').value = user.sub_unit || '';

            // method spoofing Laravel
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';

            form.appendChild(methodInput);

            form.action = window.routes.pengguna.update.replace(':id', id);

        } catch (err) {
            console.error(err);
            window.toast?.error('Gagal mengambil data pengguna') || alert('Gagal mengambil data pengguna');
            closeModal();
            return;
        }
    } else {
        modalTitle.innerText = 'Tambah Pengguna Baru';
        form.action = window.routes.pengguna.store;
    }

    // tampilkan modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    // focus input pertama
    setTimeout(() => {
        const firstInput = form.querySelector('input:not([type="hidden"]), select');
        if (firstInput) firstInput.focus();
    }, 100);
}

function closeModal() {
    const modal = document.getElementById('userModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';

    const form = document.getElementById('userForm');
    if (form) {
        form.reset();
        clearFormErrors();
    }
}

function clearFormErrors() {
    const form = document.getElementById('userForm');
    if (!form) return;

    form.querySelectorAll('.is-invalid, .border-red-500, .ring-red-500')
        .forEach(el => {
            el.classList.remove('is-invalid', 'border-red-500', 'ring-red-500');
        });

    form.querySelectorAll('.error-message').forEach(el => el.remove());
}

// ESC close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('userModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeModal();
        }
    }
});

// ============================================================
// 2. AJAX SUBMIT FORM (TANPA RELOAD)
// ============================================================

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('userForm');
    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault(); // Cegah reload halaman

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="inline w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        `;

        // Bersihkan error sebelumnya
        clearFormErrors();

        try {
            // Ambil data form
            const formData = new FormData(form);
            const url = form.action;

            // Kirim via fetch
            const response = await fetch(url, {
                method: 'POST', // selalu POST, method spoofing via _method
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    // Jangan set 'Content-Type', biar FormData yang set boundary
                },
                body: formData
            });

            const result = await response.json();

            // Kalau response status bukan 2xx, lempar error
            if (!response.ok) {
                // Cek apakah ada error validasi (422)
                if (response.status === 422) {
                    // Tampilkan error per field
                    if (result.errors) {
                        for (const [field, messages] of Object.entries(result.errors)) {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('border-red-500', 'ring-red-500');
                                // Tampilkan pesan error di bawah input
                                const errorMsg = document.createElement('p');
                                errorMsg.className = 'error-message text-red-500 text-xs mt-1';
                                errorMsg.textContent = messages[0];
                                input.parentNode.appendChild(errorMsg);
                            }
                        }
                    }
                    throw new Error('Periksa kembali data yang dimasukkan.');
                }
                // Error lain
                throw new Error(result.message || 'Terjadi kesalahan saat menyimpan data.');
            }

            // Sukses!
            if (result.message) {
                window.toast?.success(result.message) || alert(result.message);
            }

            // Tutup modal
            closeModal();

            // REFRESH TABEL TANPA RELOAD (standalone, gak pake table-refresh.js)
            await reloadUserTableOnly();

        } catch (error) {
            console.error('Submit error:', error);
            window.toast?.error(error.message) || alert(error.message);
        } finally {
            // Kembalikan tombol ke keadaan semula
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
});

// ============================================================
// 3. FUNGSI REFRESH TABEL — STANDALONE
// ============================================================

async function reloadUserTableOnly() {
    const container = document.getElementById('userTableContainer');
    if (!container) {
        window.location.reload();
        return;
    }

    try {
        // Pakai URL halaman saat ini, biar filter/search/pagination aktif tetap kebawa
        const fetchUrl = window.location.href;

        const response = await fetch(fetchUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });

        if (!response.ok) throw new Error('Gagal refresh tabel');

        const data = await response.json();

        if (!data.html) throw new Error('Response tidak berisi html');

        // Parse HTML string yang dikirim balik controller
        const doc = new DOMParser().parseFromString(data.html, 'text/html');

        const newContainer = doc.getElementById('userTableContainer');

        if (newContainer) {
            container.innerHTML = newContainer.innerHTML;
        } else {
            // fallback kalau struktur beda dari yang diharapkan
            container.innerHTML = data.html;
        }

    } catch (error) {
        console.error('[ReloadUserTable] Error:', error);
        // Fallback aman: reload halaman kalau AJAX refresh gagal
        window.location.reload();
    }
}
</script>