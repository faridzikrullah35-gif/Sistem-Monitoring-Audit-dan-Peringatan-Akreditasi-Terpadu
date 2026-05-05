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
                    data-ajax="1"
                    data-table-id="#userTableContainer"
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
async function openModal(type, id = null) {
    const modal = document.getElementById('userModal');
    const form = document.getElementById('userForm');
    const modalTitle = document.getElementById('modal-title');

    // Reset form & errors
    form.reset();
    clearFormErrors();
    document.getElementById('user_id').value = '';

    // Reset action ke store
    form.action = "{{ route('pengguna.store') }}";
    form.method = "POST";
    
    // Remove any PUT method override if exists
    const methodField = form.querySelector('input[name="_method"]');
    if (methodField) methodField.remove();

    if (type === 'edit' && id) {
        modalTitle.innerText = 'Edit Pengguna';
        
        try {
            const response = await fetch(`/others/pengguna/${id}`);
            if (!response.ok) throw new Error('Gagal mengambil data');
            
            const user = await response.json();

            // Isi form
            document.getElementById('user_id').value = user.id;
            form.querySelector('[name="name"]').value = user.name || '';
            form.querySelector('[name="email"]').value = user.email || '';
            form.querySelector('[name="role"]').value = user.role || '';
            form.querySelector('[name="unit"]').value = user.unit || '';
            form.querySelector('[name="sub_unit"]').value = user.sub_unit || '';

            // Untuk edit, kita perlu method PUT/PATCH
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'POST';
            form.appendChild(methodInput);
            
            form.action = `/others/pengguna/update/${user.id}`;

        } catch (err) {
            console.error(err);
            if (window.toast) {
                window.toast.error('Gagal mengambil data pengguna');
            } else {
                alert('Gagal mengambil data pengguna');
            }
            closeModal();
            return;
        }
    } else {
        modalTitle.innerText = 'Tambah Pengguna Baru';
        form.action = "{{ route('pengguna.store') }}";
    }

    // Tampilkan modal dengan animasi
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent scroll
    
    // Focus ke input pertama
    setTimeout(() => {
        const firstInput = form.querySelector('input:not([type="hidden"]), select');
        if (firstInput) firstInput.focus();
    }, 100);
}

function closeModal() {
    const modal = document.getElementById('userModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
    
    // Reset form saat tutup
    const form = document.getElementById('userForm');
    if (form) {
        form.reset();
        clearFormErrors();
    }
}

function clearFormErrors() {
    const form = document.getElementById('userForm');
    if (!form) return;
    
    form.querySelectorAll('.is-invalid, .border-red-500, .ring-red-500').forEach(el => {
        el.classList.remove('is-invalid', 'border-red-500', 'ring-red-500');
    });
    form.querySelectorAll('.error-message').forEach(el => el.remove());
}

// Close modal dengan ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('userModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeModal();
        }
    }
});

// Klik backdrop nutup modal (sudah ada onclick di HTML)
</script>