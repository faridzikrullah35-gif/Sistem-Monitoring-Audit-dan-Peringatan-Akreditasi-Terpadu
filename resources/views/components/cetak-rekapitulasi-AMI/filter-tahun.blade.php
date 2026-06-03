@props(['tahunList' => []])

<div class="flex flex-wrap items-center gap-4 rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center gap-2">
        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Akademik :</span>
    </div>
    <select id="tahun_akademik_select" x-model="selectedTahunId" @change="fetchData(); updateTahunName()"
            class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
        <option value="">Pilih Tahun Akademik</option>
        @foreach($tahunList as $tahun)
            <option value="{{ $tahun->id }}">{{ $tahun->nama_tahun }} {{ $tahun->semester ?? '' }}</option>
        @endforeach
    </select>
</div>