@props(['tahunAkademiks' => []])

<div class="flex flex-wrap items-center gap-3">
    {{-- LABEL --}}
    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">
        Tahun Akademik
    </label>

    {{-- SELECT FILTER --}}
    <select
        x-model="selectedTahun"
        @change="resetPage()"
        class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
    >
        <option value="">Semua Tahun</option>
        @foreach($tahunAkademiks as $tahun)
            <option value="{{ $tahun->id }}">
                {{ $tahun->tahun_akademik }} - {{ $tahun->semester }}
            </option>
        @endforeach
    </select>

    {{-- RESET BUTTON (muncul jika filter aktif) --}}
    <button
        type="button"
        x-show="selectedTahun !== ''"
        x-transition
        @click="
            selectedTahun = '';
            resetPage();
        "
        class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-100 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>Reset</span>
    </button>

    {{-- Tombol Print --}}
    <a
        x-show="selectedTahun !== ''"
        x-transition.opacity.duration.200ms
        :href="`{{ route('auditee.ptk.print') }}?tahun_akademik_id=${selectedTahun}`"
        target="_blank"
        class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
        style="display: none;"
    >
        <svg xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none">
            <path
                d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6v-8z"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
        <span>Cetak</span>
    </a>

</div>