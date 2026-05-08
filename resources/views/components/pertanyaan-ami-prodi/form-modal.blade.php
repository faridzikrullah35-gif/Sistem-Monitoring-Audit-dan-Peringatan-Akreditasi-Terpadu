<div id="userModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 py-10">
            <div class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all flex flex-col">
                
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Isi Data Baru</h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form 
                    method="POST" 
                    action="{{ route('pertanyaan-ami-prodi.store') }}" 
                    data-ajax="1"
                    data-table-id="#pertanyaanAmiProdiTableContainer"
                    id="pertanyaanAmiProdiForm"
                    class="flex flex-col flex-1"
                >
                    <div class="px-6 py-5 space-y-5 flex-1">
                        @csrf
                        <x-pertanyaan-ami-prodi.fields.question-data 
                            :kriteria="$kriteria"
                            :tahunAkademik="$tahunAkademik"
                        />
                    </div>

                    <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                        <button type="button" onclick="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                            Simpan Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(type) {
        const modal = document.getElementById('userModal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); 
        const title = document.getElementById('modal-title');
        title.innerText = type === 'edit' ? 'Edit Data' : 'Isi Data Baru';
    }

    function closeModal() {
        const modal = document.getElementById('userModal');
        const form = modal.querySelector('form');

        // Hide modal
        modal.classList.add('hidden');

        // Enable scroll body lagi
        document.body.classList.remove('overflow-hidden');

        // Reset form
        if (form) {
            form.reset();
        }

        // Reset semua checkbox
        const checkboxes = modal.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    }
</script>