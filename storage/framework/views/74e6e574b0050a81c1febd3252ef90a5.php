
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['notifications' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['notifications' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="relative" id="notification-dropdown">

    
    <button id="notification-button" type="button" class="relative flex items-center justify-center text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:text-dark-900 h-11 w-11 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
        
        <span id="notification-badge" class="absolute right-0 top-0.5 z-10 h-2 w-2 rounded-full bg-orange-400" style="display: <?php echo e(count($notifications) > 0 ? 'block' : 'none'); ?>;">
            <span class="absolute inline-flex w-full h-full bg-orange-400 rounded-full opacity-75 -z-10 animate-ping"></span>
        </span>
        
        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z"/></svg>
    </button>

    
    <div id="notification-panel" class="absolute -right-[240px] mt-[17px] flex h-[480px] w-[350px] flex-col rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark sm:w-[361px] lg:right-0" style="display: none;">

        
        <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100 dark:border-gray-800">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Notifikasi
                <span id="notification-count" class="ml-2 text-sm text-gray-500 dark:text-gray-400" style="display: <?php echo e(count($notifications) > 0 ? 'inline' : 'none'); ?>;">(<span id="notification-count-number"><?php echo e(count($notifications)); ?></span>)</span>
            </h5>
            <div class="flex items-center gap-2">
                <button id="notification-refresh" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white" type="button" title="Refresh">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                </button>
                <button id="notification-close" class="text-gray-500 dark:text-gray-400" type="button" title="Tutup">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92788 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4865 17.7782 17.7792C17.4854 18.0721 17.0105 17.7792 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z" fill="currentColor" />
                    </svg>
                </button>
            </div>
        </div>

        
        <ul id="notification-list" class="flex flex-col h-auto overflow-y-auto custom-scrollbar"></ul>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('notification-dropdown');
    if (!container) return;

    const button = document.getElementById('notification-button');
    const panel = document.getElementById('notification-panel');
    const closeButton = document.getElementById('notification-close');
    const refreshButton = document.getElementById('notification-refresh');
    const badge = document.getElementById('notification-badge');
    const countElement = document.getElementById('notification-count');
    const countNumber = document.getElementById('notification-count-number');
    const list = document.getElementById('notification-list');

    const notificationsUrl = <?php echo json_encode(route('prodi.notifications'), 15, 512) ?>;
    let notifications = <?php echo json_encode($notifications, 15, 512) ?>;

    function getIcon(bgClass) {
        if (bgClass && bgClass.includes('danger')) {
            return `<svg class="h-5 w-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>`;
        }
        if (bgClass && bgClass.includes('warning')) {
            return `<svg class="h-5 w-5 text-yellow-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>`;
        }
        if (bgClass && bgClass.includes('success')) {
            return `<svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`;
        }
        return `<svg class="h-5 w-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`;
    }

    function renderNotifications() {
        list.innerHTML = '';
        if (!notifications || notifications.length === 0) {
            list.innerHTML = `<li><div class="py-10 text-center text-gray-400 dark:text-gray-500"><svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><p class="mt-2 text-sm font-medium">Tidak ada notifikasi</p><p class="text-xs">Semua dalam keadaan baik</p></div></li>`;
            countElement.style.display = 'none';
            return;
        }

        notifications.forEach(function(notification) {
            const item = document.createElement('li');
            item.innerHTML = `
                <a href="${notification.url || '#'}" class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5">
                    <span class="relative flex items-center justify-center w-full h-10 max-w-10 rounded-full z-1 bg-gray-100 dark:bg-gray-700">${getIcon(notification.bg_class)}</span>
                    <span class="block flex-1">
                        <span class="mb-1.5 block text-theme-sm text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-800 dark:text-white/90">${escapeHtml(notification.message || '')}</span></span>
                        <span class="flex items-center gap-2 text-gray-500 text-theme-xs dark:text-gray-400">${escapeHtml(notification.time || '')}</span>
                    </span>
                </a>
            `;
            list.appendChild(item);
        });

        countElement.style.display = 'inline';
        countNumber.textContent = notifications.length;
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value;
        return div.innerHTML;
    }

    function updateBadge(show) {
        badge.style.display = show ? 'block' : 'none';
    }

    async function refreshNotifications() {
        try {
            refreshButton.disabled = true;
            refreshButton.style.opacity = '0.5';
            const response = await fetch(notificationsUrl, {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) throw new Error('Gagal mengambil notifikasi.');
            const data = await response.json();
            if (Array.isArray(data.notifications)) {
                notifications = data.notifications;
                renderNotifications();
                updateBadge(notifications.length > 0);
            }
        } catch (error) {
            console.error('Error fetching notifications:', error);
        } finally {
            refreshButton.disabled = false;
            refreshButton.style.opacity = '1';
        }
    }

    function openDropdown() {
        panel.style.display = 'flex';
        updateBadge(false);
    }

    function closeDropdown() {
        panel.style.display = 'none';
    }

    function toggleDropdown() {
        const isOpen = panel.style.display === 'flex';
        if (isOpen) closeDropdown();
        else openDropdown();
    }

    button.addEventListener('click', async function(event) {
        event.stopPropagation();
        const isOpen = panel.style.display === 'flex';
        if (isOpen) {
            closeDropdown();
            return;
        }
        await refreshNotifications();
        openDropdown();
    });

    closeButton.addEventListener('click', function() { closeDropdown(); });
    refreshButton.addEventListener('click', function() { refreshNotifications(); });

    document.addEventListener('click', function(event) {
        if (!container.contains(event.target)) closeDropdown();
    });

    renderNotifications();
    setInterval(function() { refreshNotifications(); }, 60000);
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH F:\Project-2\audit-app\resources\views/components/header/notification-dropdown.blade.php ENDPATH**/ ?>