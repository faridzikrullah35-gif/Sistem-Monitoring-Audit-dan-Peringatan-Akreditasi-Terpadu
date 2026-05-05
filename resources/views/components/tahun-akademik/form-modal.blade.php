<div id="userModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 py-10">
            <div class="relative w-full max-w-lg bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all flex flex-col">
                
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Periode Baru</h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Form Body -->
                <form method="POST" 
                    action="{{ route('tahun-akademik.store') }}" 
                    data-ajax="1"
                    data-table-id="#tahunAkademikTableContainer"
                    id="tahunAkademikForm"
                    >
                    <div class="px-6 py-5 space-y-5 flex-1">
                        @csrf
                        <x-tahun-akademik.fields.period-data />
                        <x-tahun-akademik.fields.status-toggle />
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                        <button type="button" onclick="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                            Simpan Periode
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

        // RESET DEFAULT
        form.reset();
        form.action = "{{ route('tahun-akademik.store') }}";

        if (type === 'edit' && id) {
            title.innerText = 'Edit Tahun Akademik';

            try {
                const res = await fetch(`/setting-tahun-akademik/${id}`);
                const result = await res.json();

                const data = result.data;

                // ISI FORM
                document.querySelector('input[name="tahun_akademik"]').value = data.tahun_akademik ?? '';
                document.querySelector('select[name="semester"]').value = data.semester ?? '';

                // STATUS TOGGLE
                const isActive = data.status === 'Aktif';
                const value = document.getElementById('statusValue');
                const text = document.getElementById('statusText');
                const toggle = document.getElementById('statusToggle');
                const dot = document.getElementById('toggleDot');

                if (isActive) {
                    toggle.classList.remove('bg-gray-300', 'dark:bg-gray-600');
                    toggle.classList.add('bg-blue-600');
                    dot.classList.add('translate-x-5');
                    dot.classList.remove('translate-x-0');
                    text.innerText = 'Aktif';
                    value.value = 'Aktif';
                } else {
                    toggle.classList.remove('bg-blue-600');
                    toggle.classList.add('bg-gray-300', 'dark:bg-gray-600');
                    dot.classList.add('translate-x-0');
                    dot.classList.remove('translate-x-5');
                    text.innerText = 'Nonaktif';
                    value.value = 'Non Aktif';
                }

                // UBAH ACTION KE UPDATE
                form.action = `/setting-tahun-akademik/update/${id}`;

            } catch (err) {
                console.error(err);
                if (window.toast) {
                    window.toast.error('Gagal mengambil data');
                } else {
                    toastr.error('Gagal mengambil data');
                }
            }

        } else {
            title.innerText = 'Tambah Periode Baru';
        }
    }

    function closeModal() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // ========== EXPOSE KE WINDOW (PENTING UNTUK AJAX) ==========
    window.closeModal = closeModal;
    window.openModal = openModal;
    // ============================================================
</script>