{{-- resources/views/components/dashboard-auditee/status-cards.blade.php --}}
<div class="grid grid-cols-1 gap-4 md:grid-cols-4">
    <!-- Kartu 1 -->
    <div class="rounded-xl border-l-4 border-blue-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Tahun Akademik Aktif</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">2025 - Genap</div>
    </div>
    <!-- Kartu 2 -->
    <div class="rounded-xl border-l-4 border-green-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Status Audit</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-green-600 dark:text-green-400">Sedang Berjalan</div>
    </div>
    <!-- Kartu 3 -->
    <div class="rounded-xl border-l-4 border-orange-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Deadline Pengisian</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-orange-600 dark:text-orange-400">30 Mei 2026</div>
    </div>
    <!-- Kartu 4 -->
    <div class="rounded-xl border-l-4 border-purple-500 bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
            <span class="text-sm text-gray-500 dark:text-gray-400">Progress Pengisian</span>
        </div>
        <div class="mt-1 text-2xl font-bold text-purple-600 dark:text-purple-400">75%</div>
        <div class="mt-2 h-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-2 w-[75%] rounded-full bg-purple-500"></div>
        </div>
    </div>
</div>