<div 
    x-data="pertanyaanFilter()"
    class="p-4 lg:p-5 bg-gray-50/50 dark:bg-gray-900/20"
>
    <div class="flex flex-col lg:flex-row gap-3">

        <!-- Filter Tahun -->
        <div class="w-full lg:w-56">

            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                Tahun Akademik
            </label>

            <select 
                x-model="tahun"
                @change="fetchData()"
                class="w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">
                    Semua Tahun Akademik
                </option>

                @foreach($tahunAkademik as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->tahun_akademik }} - {{ $item->semester }}
                    </option>
                @endforeach

            </select>
        </div>

        <!-- Filter Kriteria -->
        <div class="w-full lg:w-64">

            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                Kriteria
            </label>

            <select 
                x-model="kriteria"
                @change="fetchData()"
                class="w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">
                    Semua Kriteria
                </option>

                @foreach($kriteria as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->nama }}
                    </option>
                @endforeach

            </select>
        </div>

        <!-- Reset -->
        <div class="flex items-end justify-between w-full gap-2">

            <!-- LEFT SIDE -->
            <div class="flex items-end gap-2">

                <!-- Reset Filter -->
                <button 
                    @click="resetFilter"
                    type="button"
                    class="h-9 px-4 text-sm font-medium bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-white rounded-lg transition"
                >
                    Reset Filter
                </button>

                <!-- Delete Filter -->
                <button 
                    x-show="tahun || kriteria"
                    x-transition
                    type="button"
                    @click="deleteFiltered()"
                    class="h-9 px-4 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-lg transition"
                >
                    Hapus Data Filter
                </button>

            </div>

            <!-- RIGHT SIDE -->
            <div class="flex items-end">

                <button
                    type="button"
                    @click="deleteAllGlobal()"
                    class="h-9 px-4 text-sm font-medium bg-red-700 hover:bg-red-800 text-white rounded-lg transition flex items-center gap-2 shadow-sm"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2c-4.97 0-9 3.58-9 8 0 3.53 2.59 6.5 6.13 7.34L9 22h6l-.13-4.66C18.41 16.5 21 13.53 21 10c0-4.42-4.03-8-9-8zm-3 8a1 1 0 110-2 1 1 0 010 2zm6 0a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>

                    Delete All Data Tabel
                </button>

            </div>

        </div>

    </div>
</div>

<script>
function pertanyaanFilter() {
    return {

        tahun: '',
        kriteria: '',

        async fetchData(pageUrl = null) {

            try {

                let url = pageUrl || '{{ route("pertanyaan-ami-prodi.index") }}';

                const params = new URLSearchParams();

                if (this.tahun) {
                    params.append('tahun_id', this.tahun);
                }

                if (this.kriteria) {
                    params.append('kriteria_id', this.kriteria);
                }

                if (params.toString()) {
                    url += '?' + params.toString();
                }

                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const html = await response.text();

                document.querySelector('#pertanyaanTableContainer').innerHTML = html;

            } catch (error) {

                console.error(error);

            }
        },

        resetFilter() {

            this.tahun = '';
            this.kriteria = '';

            this.fetchData();
        },

        async deleteFiltered() {

            confirmDelete(
                'Hapus Data Terfilter',
                'Yakin mau hapus semua data sesuai filter saat ini?',
                async () => {

                    const params = new URLSearchParams();

                    if (this.tahun) {
                        params.append('tahun_id', this.tahun);
                    }

                    if (this.kriteria) {
                        params.append('kriteria_id', this.kriteria);
                    }

                    const url = `{{ route('pertanyaan-ami-prodi.delete-filtered') }}?` + params.toString();

                    try {

                        const response = await fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            }
                        });

                        const result = await response.json();

                        if (result.success) {

                            window.toast.success(result.message);

                            // reload data setelah delete
                            this.fetchData();

                        } else {

                            window.toast.error(result.message);

                        }

                    } catch (error) {

                        console.error(error);
                        window.toast.error('Terjadi kesalahan');

                    }
                }
            );
        },

        async deleteAllGlobal() {

            const url = '/admin/pertanyaan-ami-prodi/delete-all';

            confirmDelete(
                '⚠ Hapus Semua Data',
                'Ini akan menghapus SEMUA data pertanyaan AMI Prodi. Tindakan ini tidak bisa dibatalkan. Lanjutkan?',
                async () => {

                    try {

                        const response = await fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            }
                        });

                        const result = await response.json();

                        if (result.success) {

                            window.toast.success(result.message);

                            // refresh data table
                            this.fetchData();

                        } else {

                            window.toast.error(result.message);

                        }

                    } catch (error) {

                        console.error(error);

                        window.toast.error('Terjadi kesalahan saat menghapus semua data.');

                    }

                }
            );
        }

    }
}
</script>

<script>

document.addEventListener('click', async function(e) {

    const link = e.target.closest('.pagination a');

    if (!link) return;

    e.preventDefault();

    try {

        const response = await fetch(link.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();

        document.querySelector('#pertanyaanTableContainer').innerHTML = html;

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    } catch (error) {

        console.error(error);

    }
});

window.showToast = function(type, message) {

    const colors = {
        success: 'bg-green-600',
        error: 'bg-red-600',
        info: 'bg-blue-600',
    };

    const el = document.createElement('div');
    el.className = `${colors[type] || 'bg-gray-800'} text-white px-4 py-2 rounded-lg shadow-lg fixed top-5 right-5 z-50`;
    el.innerText = message;

    document.body.appendChild(el);

    setTimeout(() => {
        el.remove();
    }, 3000);
};

</script>