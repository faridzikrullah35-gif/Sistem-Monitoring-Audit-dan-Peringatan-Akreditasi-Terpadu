<div
  class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6 h-full"
>
  <div class="flex items-center justify-between mb-5">
    <div>
      <h3 class="font-semibold text-gray-800 dark:text-white/90 text-title-sm">Activity Log</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Riwayat aktivitas sistem</p>
    </div>
    <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
      Selengkapnya
    </a>
  </div>

  <div class="relative">
    {{-- Timeline line --}}
    <div class="absolute left-[15px] top-2 bottom-2 w-px bg-gray-200 dark:bg-gray-700"></div>

    <div class="space-y-5">
      @php
          $logs = [
              ['user' => 'Admin', 'action' => 'membuat audit baru', 'target' => 'Audit Keuangan FEB', 'time' => '10 menit lalu', 'type' => 'create'],
              ['user' => 'Auditor A', 'action' => 'submit laporan', 'target' => 'Audit IT Infrastruktur FT', 'time' => '2 jam lalu', 'type' => 'submit'],
              ['user' => 'Kepala FISIP', 'action' => 'memperbaiki finding', 'target' => 'Finding #FISIP-003', 'time' => '5 jam lalu', 'type' => 'fix'],
              ['user' => 'Sistem', 'action' => 'mengirim reminder deadline', 'target' => 'Audit Keuangan FEB', 'time' => '1 hari lalu', 'type' => 'system'],
              ['user' => 'Auditor B', 'action' => 'menambahkan temuan baru', 'target' => 'Audit SDM FHUKUM', 'time' => '1 hari lalu', 'type' => 'finding'],
              ['user' => 'Admin', 'action' => 'menutup audit', 'target' => 'Audit Penelitian FISIP', 'time' => '2 hari lalu', 'type' => 'close'],
          ];
      @endphp
      @foreach ($logs as $log)
          <div class="relative flex gap-4">
              {{-- Dot indicator --}}
              <div class="relative z-10 flex-shrink-0 mt-1">
                  @switch($log['type'])
                      @case('create')
                          <span class="block h-[30px] w-[30px] rounded-full bg-blue-100 dark:bg-blue-500/15 flex items-center justify-center">
                              <svg class="fill-blue-600 dark:fill-blue-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.75C12.4142 3.75 12.75 4.08579 12.75 4.5V11.25H19.5C19.9142 11.25 20.25 11.5858 20.25 12C20.25 12.4142 19.9142 12.75 19.5 12.75H12.75V19.5C12.75 19.9142 12.4142 20.25 12 20.25C11.5858 20.25 11.25 19.9142 11.25 19.5V12.75H4.5C4.08579 12.75 3.75 12.4142 3.75 12C3.75 11.5858 4.08579 11.25 4.5 11.25H11.25V4.5C11.25 4.08579 11.5858 3.75 12 3.75Z" fill=""/>
                              </svg>
                          </span>
                      @break
                      @case('submit')
                          <span class="block h-[30px] w-[30px] rounded-full bg-green-100 dark:bg-green-500/15 flex items-center justify-center">
                              <svg class="fill-green-600 dark:fill-green-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2803 8.21967C16.5732 8.51256 16.5732 8.98744 16.2803 9.28033L11.0303 14.5303C10.7374 14.8232 10.2626 14.8232 9.96967 14.5303L7.71967 12.2803C7.42678 11.9874 7.42678 11.5126 7.71967 11.2197C8.01256 10.9268 8.48744 10.9268 8.78033 11.2197L10.5 12.9393L15.2197 8.21967C15.5126 7.92678 15.9874 7.92678 16.2803 8.21967Z" fill=""/>
                              </svg>
                          </span>
                      @break
                      @case('fix')
                          <span class="block h-[30px] w-[30px] rounded-full bg-amber-100 dark:bg-amber-500/15 flex items-center justify-center">
                              <svg class="fill-amber-600 dark:fill-amber-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M11.47 2.46967C11.7626 2.17678 12.2374 2.17678 12.53 2.46967L19.53 9.46967C19.8232 9.76256 19.8232 10.2374 19.53 10.5303L12.53 17.5303C12.2374 17.8232 11.7626 17.8232 11.47 17.5303L4.46967 10.5303C4.17678 10.2374 4.17678 9.76256 4.46967 9.46967L11.47 2.46967ZM12 4.18934L6.18934 10L12 15.8107L17.8107 10L12 4.18934ZM12 19.75C12.4142 19.75 12.75 19.4142 12.75 19V14C12.75 13.5858 12.4142 13.25 12 13.25C11.5858 13.25 11.25 13.5858 11.25 14V19C11.25 19.4142 11.5858 19.75 12 19.75Z" fill=""/>
                              </svg>
                          </span>
                      @break
                      @case('system')
                          <span class="block h-[30px] w-[30px] rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                              <svg class="fill-gray-600 dark:fill-gray-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.25C6.61522 2.25 2.25 6.61522 2.25 12C2.25 17.3848 6.61522 21.75 12 21.75C17.3848 21.75 21.75 17.3848 21.75 12C21.75 6.61522 17.3848 2.25 12 2.25ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12C20.25 16.5563 16.5563 20.25 12 20.25C7.44365 20.25 3.75 16.5563 3.75 12C3.75 7.44365 7.44365 3.75 12 3.75ZM12 7.25C11.5858 7.25 11.25 7.58579 11.25 8V12C11.25 12.4142 11.5858 12.75 12 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V8C12.75 7.58579 12.4142 7.25 12 7.25Z" fill=""/>
                              </svg>
                          </span>
                      @break
                      @case('finding')
                          <span class="block h-[30px] w-[30px] rounded-full bg-red-100 dark:bg-red-500/15 flex items-center justify-center">
                              <svg class="fill-red-600 dark:fill-red-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V3C11.25 2.58579 11.5858 2.25 12 2.25ZM12 16.25C11.4477 16.25 11 16.6977 11 17.25C11 17.8023 11.4477 18.25 12 18.25C12.5523 18.25 13 17.8023 13 17.25C13 16.6977 12.5523 16.25 12 16.25Z" fill=""/>
                              </svg>
                          </span>
                      @break
                      @case('close')
                          <span class="block h-[30px] w-[30px] rounded-full bg-purple-100 dark:bg-purple-500/15 flex items-center justify-center">
                              <svg class="fill-purple-600 dark:fill-purple-400" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.46967 5.46967C5.76256 5.17678 6.23744 5.17678 6.53033 5.46967L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2374 18.8232 17.7626 18.8232 17.4697 18.5303L5.46967 6.53033C5.17678 6.23744 5.17678 5.76256 5.46967 5.46967Z" fill=""/>
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5303 5.46967C18.8232 5.76256 18.8232 6.23744 18.5303 6.53033L6.53033 18.5303C6.23744 18.8232 5.76256 18.8232 5.46967 18.5303C5.17678 18.2374 5.17678 17.7626 5.46967 17.4697L17.4697 5.46967C17.7626 5.17678 18.2374 5.17678 18.5303 5.46967Z" fill=""/>
                              </svg>
                          </span>
                      @break
                  @endswitch
              </div>

              {{-- Content --}}
              <div class="flex-1 min-w-0 pb-1">
                  <p class="text-sm text-gray-800 dark:text-white/90">
                      <span class="font-semibold">{{ $log['user'] }}</span>
                      {{ $log['action'] }}
                  </p>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 truncate">{{ $log['target'] }}</p>
                  <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $log['time'] }}</p>
              </div>
          </div>
      @endforeach
    </div>
  </div>
</div>