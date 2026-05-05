<div id="userModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 py-10">
            <div class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all flex flex-col">
                
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Data Auditor Baru</h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form method="POST" 
                    action="{{ route('data-auditor.store') }}" 
                    data-ajax="1"
                    data-table-id="#auditorTableContainer"
                    id="auditorForm"
                    >
                    <input type="hidden" name="id" id="auditor_id">
                    <div class="px-6 py-5 space-y-5 flex-1">
                        @csrf
                        <x-data-auditor.fields.personal-data />
                    </div>

                    <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                        <button type="button" onclick="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                            Simpan Data
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
        const form = document.querySelector('#userModal form');
        const title = document.getElementById('modal-title');

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // RESET DEFAULT STATE
        form.action = '/data-auditor/store';
        form.setAttribute('data-method', 'POST');
        document.getElementById('auditor_id').value = '';

        // CLEAR FORM SAFELY (tanpa reset flicker issue)
        const clearFields = () => {
            const fields = [
                'identity_number',
                'identity_type',
                'nama_auditor',
                'unit',
                'sub_unit',
                'tahun_aktif',
                'status',
                'tahun_non_aktif'
            ];

            fields.forEach(name => {
                const el = form.querySelector(`[name="${name}"]`);
                if (el) el.value = '';
            });
        };

        clearFields();

        // ======================
        // MODE EDIT
        // ======================
        if (type === 'edit') {
            try {
                title.innerText = 'Edit Data Auditor';

                // AMBIL DATA FRESH DARI DB (ANTI STALE DATA)
                const res = await fetch(`/data-auditor/${id}`);
                const result = await res.json();

                const auditor = result.data;

                if (!auditor) throw new Error('Data tidak ditemukan');

                // fill form safely
                const set = (name, value) => {
                    const el = form.querySelector(`[name="${name}"]`);
                    if (el) el.value = value ?? '';
                };

                const typeSelect = form.querySelector('[name="identity_type"]');
                if (typeSelect) {
                    typeSelect.value = auditor.identity_type;
                }

                set('identity_number', auditor.identity_number);
                set('identity_type', auditor.identity_type);
                set('nama_auditor', auditor.nama_auditor);
                set('unit', auditor.unit);
                set('sub_unit', auditor.sub_unit);
                set('tahun_aktif', auditor.tahun_aktif);
                set('status', auditor.status);
                set('tahun_non_aktif', auditor.tahun_non_aktif);

                document.getElementById('auditor_id').value = auditor.id;

                // switch ke update route
                form.action = `/data-auditor/update/${auditor.id}`;

            } catch (err) {
                console.error(err);
                window.toast?.error('Gagal mengambil data auditor');
                closeModal();
            }
        } else {
            title.innerText = 'Tambah Data Auditor Baru';
        }
    }

    window.closeModal = function() {
    const modal = document.getElementById('userModal');
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    };

    function closeModal() {
        window.closeModal();
    }
</script>