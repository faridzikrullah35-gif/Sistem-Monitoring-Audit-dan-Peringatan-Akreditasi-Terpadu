<div
    x-data="penggunaFilter()"
    class="bg-white/80 dark:bg-gray-900/60 backdrop-blur-sm rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-200 dark:border-gray-700/50 p-5 transition-colors duration-300"
>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-3">

        {{-- SEARCH --}}
        <div class="relative xl:col-span-2 group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400 group-focus-within:text-indigo-500 dark:text-gray-500 dark:group-focus-within:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
                </svg>
            </div>
            <input
                type="text"
                x-model="filters.search"
                @input.debounce.500ms="fetchData()"
                placeholder="Cari nama pengguna..."
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            >
        </div>

        {{-- ROLE --}}
        <select
            x-model="filters.role"
            @change="fetchData()"
            class="px-4 py-2.5 rounded-xl
                border border-gray-200 dark:border-gray-600
                bg-gray-50 dark:bg-gray-800
                text-sm text-gray-900 dark:text-gray-100
                focus:ring-2 focus:ring-indigo-500
                focus:outline-none"
        >
            <option value="">Semua Role</option>

            @foreach($roles as $role)
                @php
                    $roleName = is_object($role)
                        ? $role->name
                        : (is_array($role)
                            ? ($role['name'] ?? '')
                            : $role);
                @endphp

                @if($roleName)
                    <option
                        value="{{ $roleName }}"
                        class="dark:bg-gray-700 dark:text-gray-100"
                    >
                        {{ ucwords(str_replace('_', ' ', $roleName)) }}
                    </option>
                @endif
            @endforeach
        </select>

        {{-- UNIT --}}
        <select
            x-model="filters.unit"
            @change="loadSubUnit()"
            class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
        >
            <option value="">Semua Unit</option>
            @foreach($units as $unit)
                <option value="{{ $unit }}" class="dark:bg-gray-700 dark:text-gray-100">
                    {{ $unit }}
                </option>
            @endforeach
        </select>

        {{-- SUB UNIT --}}
        <select
            x-model="filters.sub_unit"
            @change="fetchData()"
            class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
        >
            <option value="">Semua Sub Unit</option>
            <template x-for="sub in subUnits" :key="sub">
                <option :value="sub" x-text="sub" class="dark:bg-gray-700 dark:text-gray-100"></option>
            </template>
        </select>

    </div>

    {{-- BUTTON --}}
    <div class="mt-4 flex items-center justify-between">
        <button
            type="button"
            @click="resetFilters()"
            class="px-5 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-sm text-gray-700 dark:text-gray-200 transition-colors"
        >
            Reset Filter
        </button>

        <div x-show="loading" x-transition>
            <svg class="animate-spin h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.3 0 0 5.3 0 12h4z"></path>
            </svg>
        </div>
    </div>
</div>

<script>
function penggunaFilter() {
    return {
        filters: {
            search: '{{ request("search") }}',
            role: '{{ request("role") }}',
            unit: '{{ request("unit") }}',
            sub_unit: '{{ request("sub_unit") }}'
        },
        loading: false,
        subUnits: @json($subUnits),
        allSubUnits: @json($subUnits), // simpan data awal buat reset

        async loadSubUnit() {
            this.filters.sub_unit = '';
            if (!this.filters.unit) {
                this.subUnits = this.allSubUnits;
                this.fetchData();
                return;
            }

            try {
                const response = await fetch(
                    '{{ route("pengguna.sub-unit") }}?unit=' + encodeURIComponent(this.filters.unit)
                );
                this.subUnits = await response.json();
                this.fetchData();
            } catch (error) {
                console.error('Gagal ambil sub unit:', error);
                this.subUnits = [];
            }
        },

        async fetchData(pageUrl = null) {
            this.loading = true;
            try {
                let url = pageUrl || "{{ route('pengguna.index') }}";
                const params = new URLSearchParams();
                if (this.filters.search) params.append('search', this.filters.search);
                if (this.filters.role) params.append('role', this.filters.role);
                if (this.filters.unit) params.append('unit', this.filters.unit);
                if (this.filters.sub_unit) params.append('sub_unit', this.filters.sub_unit);
                params.append('_refresh', Date.now());

                if (params.toString()) url += '?' + params.toString();

                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                document.querySelector('#userTableContainer').innerHTML = data.html;

                const historyUrl = new URL(window.location);
                ['search', 'role', 'unit', 'sub_unit'].forEach(key => {
                    if (this.filters[key]) historyUrl.searchParams.set(key, this.filters[key]);
                    else historyUrl.searchParams.delete(key);
                });
                history.pushState({}, '', historyUrl);

            } catch (error) {
                console.error('Fetch error:', error);
            } finally {
                this.loading = false;
            }
        },

        resetFilters() {
            this.filters = {
                search: '',
                role: '',
                unit: '',
                sub_unit: ''
            };
            this.subUnits = this.allSubUnits; // kembalikan ke data awal
            this.fetchData();
        }
    };
}

window.refreshUserTable = function() {
    document.querySelector('[x-data="penggunaFilter()"]')?.__x?.fetchData();
};

document.addEventListener('click', function(e) {
    const link = e.target.closest('.pagination a');
    if (!link) return;
    e.preventDefault();
    document.querySelector('[x-data="penggunaFilter()"]')?.__x?.fetchData(link.href);
});
</script>