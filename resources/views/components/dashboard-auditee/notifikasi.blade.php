{{-- resources/views/components/dashboard-auditee/notifikasi.blade.php --}}
@props([
    'notifications' => []
])

<div class="flex h-full min-h-[700px] flex-col rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800">
    <div class="mb-3 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Notifikasi Akreditasi & Audit</h2>
            <span class="ml-2 rounded-full bg-red-500 px-2 py-0.5 text-xs text-white">
                {{ count($notifications) }}
            </span>
        </div>
        <span id="notifTime" class="text-xs text-gray-400 dark:text-gray-500"></span>
    </div>
    <div id="notificationList" class="flex-1 space-y-3 overflow-y-auto pr-2">
        @if(count($notifications) > 0)
            @foreach($notifications as $notif)
                <div class="{{ $notif['bg_class'] ?? 'bg-blue-50 border-l-4 border-blue-400 dark:bg-blue-900/20 dark:border-blue-600' }} rounded-lg p-3 text-sm transition-all hover:shadow-md">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5">
                            {!! $notif['icon'] ?? '<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' !!}
                        </div>
                        <div class="flex-1">
                            <p class="font-medium dark:text-white">{{ $notif['message'] }}</p>
                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-400">{{ $notif['time'] ?? 'baru' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="py-10 text-center text-gray-400 dark:text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="mt-2">Tidak ada notifikasi</p>
                <p class="text-xs">Semua dalam keadaan baik</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('notificationList');
        const timeSpan = document.getElementById('notifTime');

        function updateTime() {
            const now = new Date();
            timeSpan.innerText = `Update: ${now.toLocaleTimeString('id-ID')}`;
        }

        function refreshNotifications() {
            fetch('{{ route("prodi.notifications") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.notifications && data.notifications.length > 0) {
                        container.innerHTML = data.notifications.map(n => {
                            return `<div class="${n.bg_class} rounded-lg p-3 text-sm transition-all hover:shadow-md">
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5">
                                        ${n.icon || '<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'}
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium dark:text-white">${n.message}</p>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-400">${n.time}</p>
                                    </div>
                                </div>
                            </div>`;
                        }).join('');
                    } else {
                        container.innerHTML = `<div class="py-10 text-center text-gray-400 dark:text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2">Tidak ada notifikasi</p>
                            <p class="text-xs">Semua dalam keadaan baik</p>
                        </div>`;
                    }
                    updateTime();
                })
                .catch(error => {
                    console.error('Error fetching notifications:', error);
                });
        }

        setInterval(updateTime, 30000);
        updateTime();
        setInterval(refreshNotifications, 60000);
    });
</script>
@endpush