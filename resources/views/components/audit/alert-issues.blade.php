<div
  class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6 h-full"
>
  <div class="flex items-center justify-between mb-5">
    <div>
      <h3 class="font-semibold text-gray-800 dark:text-white/90 text-title-sm">Alert & Issues</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Butuh perhatian segera</p>
    </div>
    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-error-50 text-xs font-bold text-error-600 dark:bg-error-500/15 dark:text-error-400">
      3
    </span>
  </div>

  <div class="space-y-3">

    {{-- High Risk Alert --}}
    <div class="flex gap-3 p-3 rounded-xl bg-red-50 border border-red-100 dark:bg-red-500/5 dark:border-red-500/10">
      <div class="flex-shrink-0 mt-0.5">
        <span class="flex items-center justify-center h-6 w-6 rounded-full bg-red-100 dark:bg-red-500/20">
          <svg class="fill-red-600 dark:fill-red-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V3C11.25 2.58579 11.5858 2.25 12 2.25ZM12 16.25C11.4477 16.25 11 16.6977 11 17.25C11 17.8023 11.4477 18.25 12 18.25C12.5523 18.25 13 17.8023 13 17.25C13 16.6977 12.5523 16.25 12 16.25Z" fill=""/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.25 12C2.25 6.61522 6.61522 2.25 12 2.25C17.3848 2.25 21.75 6.61522 21.75 12C21.75 17.3848 17.3848 21.75 12 21.75C6.61522 21.75 2.25 17.3848 2.25 12ZM12 3.75C7.44365 3.75 3.75 7.44365 3.75 12C3.75 16.5563 7.44365 20.25 12 20.25C16.5563 20.25 20.25 16.5563 20.25 12C20.25 7.44365 16.5563 3.75 12 3.75Z" fill=""/>
          </svg>
        </span>
      </div>
      <div>
        <p class="text-sm font-medium text-red-800 dark:text-red-300">Temuan High Risk</p>
        <p class="text-xs text-red-600 dark:text-red-400 mt-0.5">2 temuan di FEB belum ditindaklanjuti sejak 30 hari</p>
      </div>
    </div>

    {{-- Deadline Alert --}}
    <div class="flex gap-3 p-3 rounded-xl bg-amber-50 border border-amber-100 dark:bg-amber-500/5 dark:border-amber-500/10">
      <div class="flex-shrink-0 mt-0.5">
        <span class="flex items-center justify-center h-6 w-6 rounded-full bg-amber-100 dark:bg-amber-500/20">
          <svg class="fill-amber-600 dark:fill-amber-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.25C6.61522 2.25 2.25 6.61522 2.25 12C2.25 17.3848 6.61522 21.75 12 21.75C17.3848 21.75 21.75 17.3848 21.75 12C21.75 6.61522 17.3848 2.25 12 2.25ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12C20.25 16.5563 16.5563 20.25 12 20.25C7.44365 20.25 3.75 16.5563 3.75 12C3.75 7.44365 7.44365 3.75 12 3.75ZM12 7.25C11.5858 7.25 11.25 7.58579 11.25 8V12C11.25 12.4142 11.5858 12.75 12 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V8C12.75 7.58579 12.4142 7.25 12 7.25Z" fill=""/>
          </svg>
        </span>
      </div>
      <div>
        <p class="text-sm font-medium text-amber-800 dark:text-amber-300">Deadline Minggu Ini</p>
        <p class="text-xs text-amber-600 dark:text-amber-400 mt-0.5">Audit Keuangan FEB deadline 28 Apr 2025</p>
      </div>
    </div>

    {{-- All Clear --}}
    <div class="flex gap-3 p-3 rounded-xl bg-green-50 border border-green-100 dark:bg-green-500/5 dark:border-green-500/10">
      <div class="flex-shrink-0 mt-0.5">
        <span class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100 dark:bg-green-500/20">
          <svg class="fill-green-600 dark:fill-green-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.25C6.61522 2.25 2.25 6.61522 2.25 12C2.25 17.3848 6.61522 21.75 12 21.75C17.3848 21.75 21.75 17.3848 21.75 12C21.75 6.61522 17.3848 2.25 12 2.25ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12C20.25 16.5563 16.5563 20.25 12 20.25C7.44365 20.25 3.75 16.5563 3.75 12C3.75 7.44365 7.44365 3.75 12 3.75ZM16.2803 8.21967C16.5732 8.51256 16.5732 8.98744 16.2803 9.28033L11.0303 14.5303C10.7374 14.8232 10.2626 14.8232 9.96967 14.5303L7.71967 12.2803C7.42678 11.9874 7.42678 11.5126 7.71967 11.2197C8.01256 10.9268 8.48744 10.9268 8.78033 11.2197L10.5 12.9393L15.2197 8.21967C15.5126 7.92678 15.9874 7.92678 16.2803 8.21967Z" fill=""/>
          </svg>
        </span>
      </div>
      <div>
        <p class="text-sm font-medium text-green-800 dark:text-green-300">Fakultas Teknik Aman</p>
        <p class="text-xs text-green-600 dark:text-green-400 mt-0.5">Semua audit FT sudah selesai, 0 finding</p>
      </div>
    </div>

  </div>
</div>