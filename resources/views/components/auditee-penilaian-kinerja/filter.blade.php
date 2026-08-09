{{-- resources/views/components/auditee-penilaian-kinerja/filter.blade.php --}}
@props(['standarList'])

<div class="mb-5 rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
    <form id="filterForm" method="GET" action="{{ route('prodi.penilaian-kinerja.index') }}">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            {{-- Standar --}}
            <div>
                <label for="filterStandar" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Standar / Kriteria
                </label>
                <select id="filterStandar" name="standar"
                    class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm transition-all focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:focus:border-blue-400 dark:focus:ring-blue-500/20">
                    <option value="">Semua Standar / Kriteria</option>
                    @foreach($standarList as $standar)
                        <option value="{{ $standar->id }}" {{ request('standar') == $standar->id ? 'selected' : '' }}>
                            {{ $standar->nama ?? 'Standar #'.$standar->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Urutkan + Reset --}}
            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <label for="filterSort" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Urutkan
                    </label>
                    <select id="filterSort" name="sort"
                        class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm transition-all focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:focus:border-blue-400 dark:focus:ring-blue-500/20">
                        <option value="terbaru" {{ request('sort', 'terbaru') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort', 'terbaru') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                <button type="button" id="resetFilterBtn"
                    class="inline-flex h-10 items-center justify-center rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filterForm');
        const standarSelect = document.getElementById('filterStandar');
        const sortSelect = document.getElementById('filterSort');
        const resetBtn = document.getElementById('resetFilterBtn');
        const tableContainer = document.getElementById('tableContainer');

        if (!tableContainer) {
            console.warn('Container #tableContainer tidak ditemukan.');
            return;
        }

        // Fungsi untuk mengambil data via AJAX
        function fetchFilteredData() {
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData).toString();
            const url = filterForm.action + '?' + params;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {
                tableContainer.innerHTML = html;
                // Setelah konten baru dimuat, kita perlu memastikan event delegation tetap berfungsi
                // (sudah diatur di bawah)
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                // Optional: tampilkan notifikasi error ke user
            });
        }

        // Event listener untuk perubahan dropdown
        standarSelect.addEventListener('change', fetchFilteredData);
        sortSelect.addEventListener('change', fetchFilteredData);

        // Reset filter
        resetBtn.addEventListener('click', function () {
            standarSelect.value = '';
            sortSelect.value = 'terbaru';
            fetchFilteredData();
        });

        // ============================================
        // Event delegation untuk pagination
        // Karena setelah AJAX, link pagination baru akan muncul,
        // kita tangkap klik di document dan filter target di dalam tableContainer
        // ============================================
        document.addEventListener('click', function (e) {
            const target = e.target.closest('a');
            if (!target) return;
            // Pastikan link ada di dalam tableContainer dan memiliki href
            if (!tableContainer.contains(target)) return;
            const href = target.getAttribute('href');
            if (!href) return;

            // Cegah navigasi default
            e.preventDefault();

            // Fetch URL pagination dengan header AJAX
            fetch(href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Pagination request failed');
                return response.text();
            })
            .then(html => {
                tableContainer.innerHTML = html;
                // Scroll ke atas tabel agar user tidak kehilangan konteks
                tableContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            })
            .catch(error => {
                console.error('Error loading pagination:', error);
            });
        });
    });
</script>