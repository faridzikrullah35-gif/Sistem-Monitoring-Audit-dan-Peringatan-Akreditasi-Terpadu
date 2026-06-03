<!-- MODAL -->
<div id="matrixModal" class="fixed inset-0 z-50 hidden" aria-labelledby="matrixModal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeMatrixModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 py-10">
            <div class="relative w-full max-w-lg bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all flex flex-col">
                
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-indigo-50 dark:bg-indigo-900/30">
                            <svg class="w-4.5 h-4.5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </span>
                        <h3 id="matrixModal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Matrix</h3>
                    </div>
                    <button type="button" onclick="closeMatrixModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Form -->
                <form method="POST" 
                    action="{{ route('matrix.store') }}" 
                    data-ajax="1"
                    data-table-id="#matrixTableContainer"
                    id="matrixForm">
                    <input type="hidden" name="id" id="matrix_id">
                    <div class="px-6 py-5 space-y-5 flex-1">
                        @csrf

                        <!-- Pilih Kriteria -->
                        <div>
                            <label for="kriteria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                Pilih Kriteria
                            </label>

                            <select name="kriteria" id="kriteria" required
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 dark:focus:ring-indigo-500/30 dark:focus:border-indigo-500 transition-all duration-150">

                                <option value="" disabled selected>Pilih kriteria...</option>

                                @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">
                                        {{ $kriteria->standar->nama ?? 'Tanpa Nama' }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Elemen -->
                        <div>
                            <label for="elemen" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Elemen</label>
                            <textarea name="elemen" id="elemen" rows="4" required placeholder="Tuliskan deskripsi elemen..." class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 dark:focus:ring-indigo-500/30 dark:focus:border-indigo-500 transition-all duration-150 resize-none placeholder-gray-400 dark:placeholder-gray-500"></textarea>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                        <button type="button" onclick="closeMatrixModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    window.openMatrixModal = async function (type = 'create', id = null) {
        const modal = document.getElementById('matrixModal');
        const form = document.querySelector('#matrixModal form');
        const title = document.getElementById('matrixModal-title');

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // reset
        form.action = window.routes.matrixPenilaian.store;
        document.getElementById('matrix_id').value = '';
        document.getElementById('kriteria').value = '';
        document.getElementById('elemen').value = '';

    if (type === 'edit' && id) {
        try {
            title.innerText = 'Edit Matrix';

            const url = window.routes.matrixPenilaian.show.replace(':id', id);

            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await res.json();
            const data = result;

            document.getElementById('kriteria').value = data.kriteria ?? '';
            document.getElementById('elemen').value = data.elemen ?? '';
            document.getElementById('matrix_id').value = data.id;

                title.innerText = 'Edit Matrix';

                form.action = window.routes.matrixPenilaian.update.replace(':id', data.id);

            } catch (err) {
                console.error(err);
                window.toast?.error('Gagal mengambil data matrix') || alert('Gagal mengambil data matrix');
                closeModal();
            }
        } else {
            title.innerText = 'Tambah Matrix';
        }
    };

    window.closeMatrixModal = function() {
        const modal = document.getElementById('matrixModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    function closeMatrixModal() {
        window.closeMatrixModal();
    }
</script>