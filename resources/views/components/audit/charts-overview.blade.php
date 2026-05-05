<div class="grid grid-cols-1 gap-4 md:gap-6 lg:grid-cols-3">

    {{-- Progress Audit per Bulan (Bar Chart Placeholder) --}}
    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6 lg:col-span-2"
    >
      <div class="flex items-center justify-between mb-6">
        <div>
          <h3 class="font-semibold text-gray-800 dark:text-white/90 text-title-sm">Progress Audit per Bulan</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Jan — Apr 2026</p>
        </div>
        <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
          <span class="flex items-center gap-1.5">
            <span class="h-2.5 w-2.5 rounded-sm bg-blue-500"></span> Selesai
          </span>
          <span class="flex items-center gap-1.5">
            <span class="h-2.5 w-2.5 rounded-sm bg-gray-300 dark:bg-gray-600"></span> Target
          </span>
        </div>
      </div>

      {{-- Dummy Bar Chart (pure CSS) --}}
      <div class="flex items-end justify-between gap-3 h-48 px-2">
        @php
            $months = ['Jan', 'Feb', 'Mar', 'Apr'];
            $completed = [60, 80, 70, 90];
            $targets = [100, 100, 100, 100];
        @endphp
        @foreach ($months as $i => $month)
            <div class="flex-1 flex flex-col items-center gap-1">
                <div class="w-full flex items-end justify-center gap-1.5 h-40">
                    {{-- Target (background bar) --}}
                    <div
                      class="w-5 rounded-t-md bg-gray-200 dark:bg-gray-700"
                      style="height: {{ $targets[$i] }}%"
                    ></div>
                    {{-- Completed (foreground bar) --}}
                    <div
                      class="w-5 rounded-t-md bg-blue-500 transition-all duration-500"
                      style="height: {{ $completed[$i] }}%"
                    ></div>
                </div>
                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $month }}</span>
            </div>
        @endforeach
      </div>
    </div>

    {{-- Status Audit (Pie Chart Placeholder) --}}
    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
    >
      <h3 class="font-semibold text-gray-800 dark:text-white/90 text-title-sm">Status Audit</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Distribusi saat ini</p>

      {{-- Dummy Donut (pure CSS) --}}
      <div class="flex items-center justify-center my-6">
        <div class="relative w-36 h-36">
            <svg viewBox="0 0 36 36" class="w-full h-full -rotate-90">
                {{-- Done: 8/20 = 40% --}}
                <circle cx="18" cy="18" r="14" fill="none" stroke-width="4"
                  class="stroke-green-500 dark:stroke-green-400"
                  stroke-dasharray="35.19 52.78" stroke-dashoffset="0" />
                {{-- On Progress: 7/20 = 35% --}}
                <circle cx="18" cy="18" r="14" fill="none" stroke-width="4"
                  class="stroke-blue-500 dark:stroke-blue-400"
                  stroke-dasharray="30.79 57.19" stroke-dashoffset="-35.19" />
                {{-- Pending: 5/20 = 25% --}}
                <circle cx="18" cy="18" r="14" fill="none" stroke-width="4"
                  class="stroke-amber-500 dark:stroke-amber-400"
                  stroke-dasharray="21.99 65.99" stroke-dashoffset="-65.98" />
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-2xl font-bold text-gray-800 dark:text-white/90">20</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">Total</span>
            </div>
        </div>
      </div>

      {{-- Legend --}}
      <div class="space-y-2.5">
        <div class="flex items-center justify-between">
            <span class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span> Done
            </span>
            <span class="text-sm font-semibold text-gray-800 dark:text-white/90">8</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span> On Progress
            </span>
            <span class="text-sm font-semibold text-gray-800 dark:text-white/90">7</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span> Pending
            </span>
            <span class="text-sm font-semibold text-gray-800 dark:text-white/90">5</span>
        </div>
      </div>
    </div>

</div>