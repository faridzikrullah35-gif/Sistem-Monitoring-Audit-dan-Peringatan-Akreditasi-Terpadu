<div
  class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6 h-full"
>
  <div class="flex items-center justify-between mb-5">
    <div>
      <h3 class="font-semibold text-gray-800 dark:text-white/90 text-title-sm">Data per Fakultas</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">6 unit terdaftar</p>
    </div>
  </div>

  <div class="space-y-3">
    @php
        $faculties = [
            ['name' => 'Fakultas Teknik', 'active' => 3, 'done' => 1, 'color' => 'blue'],
            ['name' => 'FEB', 'active' => 2, 'done' => 2, 'color' => 'green'],
            ['name' => 'FISIP', 'active' => 0, 'done' => 1, 'pending' => 1, 'color' => 'purple'],
            ['name' => 'FHUKUM', 'active' => 1, 'done' => 0, 'color' => 'amber'],
            ['name' => 'FK', 'active' => 0, 'done' => 0, 'pending' => 1, 'color' => 'red'],
            ['name' => 'FMIPA', 'active' => 1, 'done' => 1, 'color' => 'teal'],
        ];
    @endphp
    @foreach ($faculties as $faculty)
        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-white/[0.02] dark:hover:bg-white/[0.04] transition-colors">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center h-9 w-9 rounded-lg bg-{{ $faculty['color'] }}-100 dark:bg-{{ $faculty['color'] }}-500/10 text-{{ $faculty['color'] }}-600 dark:text-{{ $faculty['color'] }}-400 text-xs font-bold">
                    {{ strtoupper(substr($faculty['name'], 0, 2)) }}
                </span>
                <div>
                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $faculty['name'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        @if (isset($faculty['active']) && $faculty['active'] > 0)
                            {{ $faculty['active'] }} aktif
                        @endif
                        @if (isset($faculty['done']) && $faculty['done'] > 0)
                            {{ isset($faculty['active']) && $faculty['active'] > 0 ? ' · ' : '' }}{{ $faculty['done'] }} selesai
                        @endif
                        @if (isset($faculty['pending']) && $faculty['pending'] > 0)
                            {{ (isset($faculty['active']) && $faculty['active'] > 0) || (isset($faculty['done']) && $faculty['done'] > 0) ? ' · ' : '' }}{{ $faculty['pending'] }} pending
                        @endif
                    </p>
                </div>
            </div>
            <svg class="fill-gray-400 dark:fill-gray-500 w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.96967 10.4697C9.26256 10.1768 9.73744 10.1768 10.0303 10.4697L12 12.4393L13.9697 10.4697C14.2626 10.1768 14.7374 10.1768 15.0303 10.4697C15.3232 10.7626 15.3232 11.2374 15.0303 11.5303L12.5303 14.0303C12.2374 14.3232 11.7626 14.3232 11.4697 14.0303L8.96967 11.5303C8.67678 11.2374 8.67678 10.7626 8.96967 10.4697Z" fill=""/>
            </svg>
        </div>
    @endforeach
  </div>
</div>