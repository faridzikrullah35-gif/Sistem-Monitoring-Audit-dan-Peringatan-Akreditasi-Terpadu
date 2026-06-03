<div  
    class="sticky top-0 z-10 bg-white dark:bg-gray-900 p-4 lg:p-5 border-b border-gray-200 dark:border-gray-700"
>
    <div class="flex flex-col md:flex-row gap-3">

        <!-- Dropdown Kriteria -->
        <div class="flex-1">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                Kriteria
            </label>

            <select 
                x-model="kriteria"
                @change="fetchData"
                class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                <option value="">Semua Kriteria</option>

                @foreach ($kriterias as $kriteria)
                    <option value="{{ $kriteria->id }}">
                        {{ $kriteria->standar->nama ?? 'Tanpa Nama' }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Reset -->
        <div class="flex items-end">
            <button 
                @click="resetFilter"
                type="button"
                class="w-full md:w-auto px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition"
            >
                Reset
            </button>
        </div>

    </div>
</div>

<script>
function matrixFilter() {
    return {
        kriteria: '',

        async fetchData() {
            try {
                let url = '/admin/matriks-penilaian';

                if (this.kriteria) {
                    url += `?kriteria_id=${this.kriteria}`;
                }

                const res = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const html = await res.text();

                document.querySelector('#matrixTableContainer').innerHTML = html;

            } catch (err) {
                console.error(err);
            }
        },

        resetFilter() {
            this.kriteria = '';
            this.fetchData();
        }
    }
}
</script>