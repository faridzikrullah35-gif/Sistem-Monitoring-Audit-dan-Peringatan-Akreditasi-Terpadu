<form 
    x-data="filterComponent()" 
    @submit.prevent="applyFilters"
    class="bg-white/80 dark:bg-gray-900/60 backdrop-blur-sm rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-200 dark:border-gray-700/50 p-5 transition-colors duration-300"
>
    <div class="flex flex-col md:flex-row gap-3">

        <!-- Search -->
        <div class="relative flex-1 group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg 
                    class="w-4 h-4 text-gray-400 dark:text-gray-500 group-focus-within:text-indigo-500 dark:group-focus-within:text-indigo-400 transition-colors" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="filters.search"
                @input.debounce.500ms="applyFilters"
                placeholder="Cari nama, email..."
                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 dark:focus:ring-indigo-400/50 dark:focus:border-indigo-400 transition-all duration-200"
            >
        </div>

        <!-- Role -->
        <select 
            x-model="filters.role"
            @change="applyFilters"
            class="px-4 py-2.5 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 dark:focus:ring-indigo-400/50 dark:focus:border-indigo-400 transition-all duration-200 cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22%236b7280%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20clip-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E')] bg-no-repeat bg-[position:right_0.75rem_center] bg-[length:1.25rem_1.25rem] pr-10 dark:bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22%239ca3af%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20clip-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E')]"
        >
            <option value="">Semua Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role }}" class="dark:bg-gray-800 dark:text-gray-200">
                    {{ ucfirst(str_replace('_', ' ', $role)) }}
                </option>
            @endforeach
        </select>

        <!-- Reset Button -->
        <button 
            type="button"
            @click="resetFilters"
            class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-xl text-sm text-gray-700 dark:text-gray-200 transition-all duration-200"
        >
            Reset Filter
        </button>

        <!-- Loading Indicator (opsional) -->
        <div x-show="loading" class="flex items-center px-4">
            <svg class="animate-spin h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

    </div>
</form>

<!-- Alpine Component Script -->
<script>
function filterComponent() {
    return {
        filters: {
            search: '{{ request('search') }}',
            role: '{{ request('role') }}',
            status: '{{ request('status') }}'
        },
        loading: false,
        
        async applyFilters() {
            this.loading = true;
            
            const container = document.querySelector('#userTableContainer');
            if (!container) return;
            
            // Loading state
            container.innerHTML = `
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-8 text-center">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Memuat data...</p>
                    </div>
                </div>
            `;
            
            try {
                const params = new URLSearchParams();
                if (this.filters.search) params.append('search', this.filters.search);
                if (this.filters.role) params.append('role', this.filters.role);
                if (this.filters.status) params.append('status', this.filters.status);
                params.append('_refresh', Date.now());
                
                const response = await fetch(`/others/pengguna?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                // 🔥 UPDATE CONTAINER DENGAN DATA BARU
                if (data.html) {
                    container.innerHTML = data.html;
                    console.log('✅ Table updated dengan data baru');
                } else {
                    console.warn('No html in response:', data);
                }
                
                // Update URL tanpa reload
                const url = new URL(window.location.href);
                if (this.filters.search) url.searchParams.set('search', this.filters.search);
                else url.searchParams.delete('search');
                
                if (this.filters.role) url.searchParams.set('role', this.filters.role);
                else url.searchParams.delete('role');
                
                window.history.pushState({}, '', url);
                
            } catch (error) {
                console.error('Filter error:', error);
                container.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-red-200 dark:border-red-800 p-8 text-center">
                        <p class="text-red-600 dark:text-red-400">Gagal memuat data: ${error.message}</p>
                    </div>
                `;
            } finally {
                this.loading = false;
            }
        },
        
        resetFilters() {
            this.filters = { search: '', role: '', status: '' };
            this.applyFilters();
        }
    }
}
</script>