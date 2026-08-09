<div 
    x-data="pertanyaanFilter()"
    class="p-4 lg:p-5 bg-gray-50/50 dark:bg-gray-900/20"
>
    <!-- Baris 1: Dropdown Filter -->
    <div class="flex flex-col lg:flex-row flex-wrap gap-3">

        <!-- Filter Tahun -->
        <div class="w-full lg:flex-1 min-w-[180px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                Tahun Akademik
            </label>
            <select 
                x-model="tahun"
                @change="fetchData()"
                class="w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Semua Tahun Akademik</option>
                @foreach($tahunAkademik as $item)
                    <option value="{{ $item->id }}">{{ $item->tahun_akademik }} - {{ $item->semester }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filter Kriteria -->
        <div class="w-full lg:flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                Kriteria
            </label>
            <select 
                x-model="kriteria"
                @change="fetchData()"
                class="w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Semua Kriteria</option>
                @foreach($kriteria as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filter Akses -->
        <div class="w-full lg:flex-1 min-w-[220px]">
            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                Akses (Role - Unit - Sub Unit)
            </label>
            <select 
                x-model="aksesFilter"
                @change="fetchData()"
                class="w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Semua Akses</option>
                @foreach($filterAksesOptions as $option)
                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <!-- Baris 2: Tombol Aksi -->
    <div class="flex flex-wrap items-center justify-between gap-2 mt-4">
        <div class="flex flex-wrap gap-2">
            <!-- Reset Filter -->
            <button 
                @click="resetFilter"
                type="button"
                class="h-9 px-4 text-sm font-medium bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-white rounded-lg transition"
            >
                Reset Filter
            </button>

            <!-- Hapus Data Filter -->
            <button 
                x-show="tahun || kriteria || aksesFilter"
                x-transition
                type="button"
                @click="deleteFiltered()"
                class="h-9 px-4 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-lg transition"
            >
                Hapus Data Filter
            </button>
        </div>

        <!-- Delete All -->
        <button
            type="button"
            @click="deleteAllGlobal()"
            class="h-9 px-4 text-sm font-medium bg-red-700 hover:bg-red-800 text-white rounded-lg transition flex items-center gap-2 shadow-sm"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7L18.132 19.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.994-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
            </svg>
            Delete All Data Tabel
        </button>
    </div>
</div>

<script>
function pertanyaanFilter() {
    return {
        tahun: '',
        kriteria: '',
        aksesFilter: '',

        async fetchData(pageUrl = null) {
            try {
                let url = pageUrl || '{{ route("pertanyaan-ami-prodi.index") }}';
                const params = new URLSearchParams();

                if (this.tahun) params.append('tahun_id', this.tahun);
                if (this.kriteria) params.append('kriteria_id', this.kriteria);
                if (this.aksesFilter) params.append('akses_filter', this.aksesFilter);

                if (params.toString()) url += '?' + params.toString();

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
            this.aksesFilter = '';
            this.fetchData();
        },

        async deleteFiltered() {
            confirmDelete(
                'Hapus Data Terfilter',
                'Yakin mau hapus semua data sesuai filter saat ini?',
                async () => {
                    const params = new URLSearchParams();

                    if (this.tahun) params.append('tahun_id', this.tahun);
                    if (this.kriteria) params.append('kriteria_id', this.kriteria);
                    if (this.aksesFilter) params.append('akses_filter', this.aksesFilter);

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
        window.scrollTo({ top: 0, behavior: 'smooth' });
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
    setTimeout(() => { el.remove(); }, 3000);
};
</script>