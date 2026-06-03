<div id="assignModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    
    <!-- Modal Wrapper -->
    <div class="fixed inset-0 z-10 flex items-center justify-center p-4 overflow-hidden">

        <!-- Modal Content -->
        <div class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl flex flex-col max-h-[90vh] overflow-hidden">

            <form id="assignForm"
                action="{{ route('akses-auditor.store') }}" 
                method="POST" 
                data-ajax="1"
                data-table-id="#akses_auditor_table"
                data-refresh-selects="standar_id,unit_id,kategori_id">

                @csrf

                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Akses Auditor
                    </h3>

                    <button type="button" onclick="closeModal()" 
                        class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Body (Memanggil File Fields) -->
                <div class="px-6 py-5 overflow-y-auto flex-1 min-h-0">
                    @include('components.akses-auditor.fields.access-auditor')
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" onclick="closeModal()" 
                        class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                        Batal
                    </button>
                    <button type="submit" 
                        class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script>
window.routes = {
    aksesAuditorShow: "{{ route('akses-auditor.show', ':id') }}",
    aksesAuditorStore: "{{ route('akses-auditor.store') }}",
    aksesAuditorUpdate: "{{ route('akses-auditor.update', ':id') }}"
};
</script>

<script>
let fpInstance = null;

async function openModal(type = 'create', id = null) {
    const modal = document.getElementById('assignModal');
    const form = modal.querySelector('form');
    const title = document.getElementById('modalTitle');

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');

    // ======================
    // HELPERS
    // ======================
    const removeMethod = () => {
        const old = form.querySelector('input[name="_method"]');
        if (old) old.remove();
    };

    const setInput = (name, value) => {
        const el = form.querySelector(`[name="${name}"]`);
        if (el) el.value = value ?? '';
    };

    const setSelect = (name, value) => {
        const el = form.querySelector(`[name="${name}"]`);
        if (!el) return;

        const val = String(value);

        const option = el.querySelector(`option[value="${val}"]`);

        if (option) {
            el.value = val;
        } else {
            console.warn(`[${name}] option ${val} gak ditemukan`);
        }

        el.dispatchEvent(new Event('change'));
    };

    const clearFields = () => {
        ['unit', 'tahun_akademik', 'tgl_audit'].forEach(name => {
            const el = form.querySelector(`[name="${name}"]`);
            if (el) el.value = '';
        });

        if (fpInstance) fpInstance.clear();
    };

    // ======================
    // DEFAULT STATE
    // ======================
    form.action = '/admin/setting-akses-auditor';
    form.setAttribute('data-method', 'POST');
    removeMethod();

    // INIT DATEPICKER
    if (fpInstance) fpInstance.destroy();

    fpInstance = flatpickr("#tgl_audit", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        appendTo: document.getElementById('assignModal'),
        static: true,
    });

    clearFields();

    // ======================
    // MODE EDIT
    // ======================
    if (type === 'edit' && id) {
        try {
            title.innerText = 'Loading data...';

            const url = window.routes.aksesAuditor.show.replace(':id', id);

            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) throw new Error('Fetch gagal');

            const data = await res.json();
            console.log('DATA:', data);

            setTimeout(() => {
                setSelect('unit', data.unit_id);
                setSelect('tahun_akademik', data.tahun_akademik_id);

                if (fpInstance) {
                    fpInstance.setDate(data.tgl_audit);
                }
            }, 50);

            title.innerText = 'Edit Akses Auditor';

            // 🔥 FIX: pakai route helper
            form.action = window.routes.aksesAuditor.update.replace(':id', id);

            const method = form.querySelector('input[name="_method"]');
            if (method) method.remove();

            const newMethod = document.createElement('input');
            newMethod.type = 'hidden';
            newMethod.name = '_method';
            newMethod.value = 'PUT';
            form.appendChild(newMethod);

        } catch (err) {
            console.error(err);
            window.toast?.error('Gagal mengambil data') || alert('Gagal mengambil data');
            closeModal();
        }
    } else {
        title.innerText = 'Tambah Akses Auditor';

        form.action = window.routes.aksesAuditor.store;
    }
}

function closeModal() {
    const modal = document.getElementById('assignModal');
    const form = document.getElementById('assignForm');

    // tutup modal
    modal.classList.add('hidden');

    document.body.classList.remove('overflow-hidden');
    
    // reset form
    if (form) form.reset();

    document.querySelectorAll('.datepicker').forEach(el => {
        el.value = '';
    });
}
</script>