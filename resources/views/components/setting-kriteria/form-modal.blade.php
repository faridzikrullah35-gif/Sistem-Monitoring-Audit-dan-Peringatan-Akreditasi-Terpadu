<div id="userModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 py-10">
            <div class="relative w-full max-w-lg bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all flex flex-col">
                
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Sub-Kriteria</h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form id="kriteriaForm" 
                    action="{{ route('setting-kriteria.store') }}" 
                    method="POST" 
                    data-ajax
                    data-table-id="#kriteria_audit"
                    class="flex flex-col flex-1">
                    @csrf
                    
                    <!-- Untuk update method PUT -->
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <input type="hidden" name="kriteria_id" id="kriteriaId">

                    <div class="px-6 py-5 space-y-5 flex-1">
                        <x-setting-kriteria.fields.main-data :standars="$standars" />
                    </div>

                    <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                        <button type="button" onclick="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                            Simpan Kriteria
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
        const form = document.getElementById('kriteriaForm');
        const title = document.getElementById('modal-title');

        const methodInput = document.getElementById('formMethod');
        const idInput = document.getElementById('kriteriaId');

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // ======================
        // RESET STATE (WAJIB)
        // ======================
        form.action = '/admin/setting-kriteria';
        methodInput.value = 'POST';
        idInput.value = '';

        // clear field manual
        const clearFields = () => {
            const fields = ['standar_id', 'sub_kriteria'];

            fields.forEach(name => {
                const el = form.querySelector(`[name="${name}"]`);
                if (el) el.value = '';
            });
        };

        clearFields();

        // ======================
        // MODE EDIT
        // ======================
        if (type === 'edit' && id) {
            try {
                title.innerText = 'Edit Sub-Kriteria';

                const url = window.routes.settingKriteria.show.replace(':id', id);

                const res = await fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const result = await res.json();
                const data = result.data;

                if (!data) throw new Error('Data tidak ditemukan');

                const set = (name, value) => {
                    const el = form.querySelector(`[name="${name}"]`);
                    if (el) el.value = value ?? '';
                };

                set('standar_id', data.standar_id);
                set('sub_kriteria', data.sub_kriteria);

                idInput.value = data.id;

                // switch ke update pakai route helper
                form.action = window.routes.settingKriteria.update.replace(':id', data.id);

                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) {
                    methodInput.value = 'PUT';
                }

            } catch (err) {
                console.error(err);
                window.toast?.error('Gagal ambil data kriteria') || alert('Gagal ambil data kriteria');
                closeModal();
            }
        } else {
            title.innerText = 'Tambah Sub-Kriteria';

            form.action = window.routes.settingKriteria.store;
        }
    }

    function closeModal() {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('kriteriaForm');

        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');

        form.reset();
    }
</script>