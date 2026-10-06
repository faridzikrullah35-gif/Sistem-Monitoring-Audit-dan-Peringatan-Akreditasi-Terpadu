{{-- resources/views/components/dashboard-auditee/timeline-audit.blade.php --}}
<div class="rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800">
    <div class="mb-3 flex items-center gap-2">
        <svg class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Timeline Audit</h2>
    </div>
    <div class="flex flex-wrap justify-between gap-2 text-center text-sm md:flex-nowrap">
        <div class="flex flex-1 items-center justify-center gap-1 rounded-lg bg-green-100 p-2 dark:bg-green-900/40">
            <svg class="h-4 w-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            <span class="dark:text-green-200">Pembukaan Audit</span>
        </div>
        <div class="flex flex-1 items-center justify-center gap-1 rounded-lg bg-green-100 p-2 dark:bg-green-900/40">
            <svg class="h-4 w-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            <span class="dark:text-green-200">Isi Evaluasi</span>
        </div>
        <div class="flex flex-1 items-center justify-center gap-1 rounded-lg bg-blue-100 p-2 dark:bg-blue-900/40">
            <svg class="h-4 w-4 animate-spin text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
            <span class="dark:text-blue-200">Pemeriksaan Auditor</span>
        </div>
        <div class="flex flex-1 items-center justify-center gap-1 rounded-lg bg-gray-100 p-2 text-gray-500 dark:bg-gray-700 dark:text-gray-400">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Tindak Lanjut
        </div>
        <div class="flex flex-1 items-center justify-center gap-1 rounded-lg bg-gray-100 p-2 text-gray-500 dark:bg-gray-700 dark:text-gray-400">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Penutupan Audit
        </div>
    </div>
</div>