@props(['items' => []])

<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 h-full flex flex-col">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            <h3 class="text-base font-semibold text-gray-800 dark:text-white">Progress Pengerjaan</h3>
        </div>
    </div>

    <div class="space-y-5 flex-1">
        @forelse($items as $item)
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate pr-2">{{ $item['label'] }}</p>
                    <span class="text-xs font-bold {{ $item['progress'] == 100 ? 'text-green-600 dark:text-green-400' : 
                        ($item['progress'] > 50 ? 'text-orange-600 dark:text-orange-400' : 'text-gray-400 dark:text-gray-500') }} flex-shrink-0">
                        {{ $item['progress'] }}%
                    </span>
                </div>
                <x-dashboard-auditor.fields.progress-bar value="{{ $item['progress'] }}" color="{{ $item['progress'] == 100 ? 'green' : ($item['progress'] > 50 ? 'orange' : 'gray') }}" />
                <p class="text-[10px] text-gray-500 dark:text-gray-400">
                    Deadline: {{ $item['deadline'] }}
                </p>
            </div>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">Tidak ada progress</p>
        @endforelse
    </div>
</div>