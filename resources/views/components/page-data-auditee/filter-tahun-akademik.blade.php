@props([
    'tahunAkademiks' => []
])

<div class="flex flex-wrap items-center gap-3">

    {{-- LABEL --}}
    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">
        Tahun Akademik
    </label>

    {{-- SELECT FILTER --}}
    <select
        x-model="selectedTahun"
        class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
    >
        <option value="">
            Semua Tahun
        </option>

        @foreach($tahunAkademiks as $tahun)
            <option value="{{ $tahun->id }}">
                {{ $tahun->tahun_akademik }}
                -
                {{ $tahun->semester }}
            </option>
        @endforeach

    </select>

    {{-- RESET BUTTON --}}
    <button
        type="button"
        x-show="selectedTahun !== ''"
        x-transition
        @click="selectedTahun = ''"
        class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-100 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30"
    >

        {{-- ICON --}}
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
        >
            <path
                d="M18 6L6 18M6 6L18 18"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
            />
        </svg>

        <span>Reset</span>

    </button>

</div>