<div id="userModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 py-10">
            <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all flex flex-col">
                
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Skor Baru</h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Form Body -->
                <form 
                    method="POST"
                    action="{{ route('setting-score.store') }}"
                    data-ajax="1"
                    data-table-id="#settingScoreTableContainer"
                    id="settingScoreForm"
                    class="flex flex-col flex-1"
                >
                    <div class="px-6 py-5 space-y-5 flex-1">
                        @csrf
                        <x-setting-skor.fields.score-input />
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                        <button type="button" onclick="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(type = 'create', id = null) {

        const modal = document.getElementById('userModal');
        const title = document.getElementById('modal-title');

        const form = document.getElementById('settingScoreForm');

        const scoreInput = document.getElementById('score_value');
        const descriptionInput = document.getElementById('description');

        const generateNcrInput = document.getElementById('generate_ncr');

        // =========================
        // HAPUS METHOD PUT LAMA
        // =========================
        let methodInput = document.getElementById('method-put');

        if (methodInput) {
            methodInput.remove();
        }

        // tampilkan modal
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // reset form
        form.reset();

        generateNcrInput.checked = false;

        // =========================
        // MODE CREATE
        // =========================
        if (type === 'create') {

            title.innerText = 'Tambah Skor Baru';

            form.action = `/admin/setting-score/store`;

            return;
        }

        // =========================
        // MODE EDIT
        // =========================
        title.innerText = 'Edit Data Skor';

        fetch(`/admin/setting-score/edit/${id}`)
            .then(response => response.json())
            .then(response => {

                const data = response.data;

                // action update
                form.action = `/admin/setting-score/update/${id}`;

                // inject PUT
                form.insertAdjacentHTML(
                    'beforeend',
                    '<input type="hidden" name="_method" value="PUT" id="method-put">'
                );

                // isi form
                scoreInput.value = data.nilai_score;
                descriptionInput.value = data.keterangan;

                generateNcrInput.checked = !!data.generate_ncr;
            })
            .catch(error => {
                console.error(error);
                alert('Gagal mengambil data.');
            });
    }

    function closeModal() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>