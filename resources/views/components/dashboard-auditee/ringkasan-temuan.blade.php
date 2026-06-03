{{-- resources/views/components/dashboard-auditee/ringkasan-temuan.blade.php --}}
<div class="rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800">
    <div class="mb-3 flex items-center gap-2">
        <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Ringkasan Temuan Auditor</h2>
    </div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        <div class="rounded-xl border border-red-200 bg-red-50 p-2 text-center dark:border-red-800 dark:bg-red-900/30">
            <p class="text-xs font-bold uppercase text-red-600 dark:text-red-400">NCR Mayor</p>
            <p class="text-3xl font-extrabold text-red-700 dark:text-red-300">2</p>
        </div>
        <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-2 text-center dark:border-yellow-800 dark:bg-yellow-900/30">
            <p class="text-xs font-bold uppercase text-yellow-700 dark:text-yellow-400">NCR Minor</p>
            <p class="text-3xl font-extrabold text-yellow-700 dark:text-yellow-300">5</p>
        </div>
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-2 text-center dark:border-blue-800 dark:bg-blue-900/30">
            <p class="text-xs font-bold uppercase text-blue-600 dark:text-blue-400">Observasi</p>
            <p class="text-3xl font-extrabold text-blue-700 dark:text-blue-300">3</p>
        </div>
        <div class="rounded-xl border border-green-200 bg-green-50 p-2 text-center dark:border-green-800 dark:bg-green-900/30">
            <p class="text-xs font-bold uppercase text-green-600 dark:text-green-400">OFI</p>
            <p class="text-3xl font-extrabold text-green-700 dark:text-green-300">4</p>
        </div>
    </div>
</div>