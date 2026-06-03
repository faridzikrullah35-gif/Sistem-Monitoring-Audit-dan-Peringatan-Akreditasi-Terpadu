<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
    
    <!-- Total Audit Ditugaskan -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full">Semua</span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">8</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Tugas Audit</p>
    </div>

    <!-- Audit Selesai -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-xs font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-0.5 rounded-full flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                62.5%
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">5</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Sudah Selesai</p>
    </div>

    <!-- Audit Belum Selesai -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">3</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dalam Proses</p>
    </div>

    <!-- Deadline Mendekat -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-red-200 dark:border-red-900/50 p-5 shadow-sm hover:shadow-md transition-shadow bg-gradient-to-br from-red-50 to-white dark:from-red-900/10 dark:to-gray-800">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
            </div>
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
            </span>
        </div>
        <p class="text-3xl font-bold text-red-600 dark:text-red-400">2</p>
        <p class="text-sm text-red-500 dark:text-red-400 mt-1 font-medium">Deadline Minggu Ini</p>
    </div>

</div>