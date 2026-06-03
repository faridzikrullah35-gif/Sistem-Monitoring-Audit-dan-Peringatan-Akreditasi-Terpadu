{{-- resources/views/components/dashboard-auditee/notifikasi.blade.php --}}
<div class="rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800">
    <div class="mb-3 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Notifikasi</h2>
        </div>
        <span id="notifTime" class="text-xs text-gray-400 dark:text-gray-500"></span>
    </div>
    <div id="notificationList" class="max-h-64 space-y-3 overflow-y-auto">
        <div class="py-2 text-center text-gray-400 dark:text-gray-500">Memuat notifikasi...</div>
    </div>
</div>

@push('scripts')
<script>
    // polling notifikasi dengan dark mode styling di dalamnya (sama seperti sebelumnya)
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('notificationList');
        const timeSpan = document.getElementById('notifTime');
        let pool = [
            { text: "Auditor menambahkan observasi baru", type: "warning" },
            { text: "Deadline tinggal 3 hari!", type: "danger" },
            { text: "Dokumen bukti ditolak", type: "danger" },
            { text: "Temuan NCR Mayor perlu revisi", type: "error" },
            { text: "OFI untuk peningkatan borang", type: "info" }
        ];
        function render(notifs) {
            if(!container) return;
            if(notifs.length===0) { container.innerHTML='<div class="py-2 text-center text-gray-400 dark:text-gray-500">Tidak ada notifikasi</div>'; return; }
            container.innerHTML = notifs.map(n => {
                let bg = 'bg-blue-50 border-l-4 border-blue-400 dark:bg-blue-900/20 dark:border-blue-600';
                if(n.type==='danger') bg = 'bg-red-50 border-l-4 border-red-500 dark:bg-red-900/20 dark:border-red-600';
                else if(n.type==='warning') bg = 'bg-yellow-50 border-l-4 border-yellow-500 dark:bg-yellow-900/20 dark:border-yellow-600';
                else if(n.type==='error') bg = 'bg-orange-50 border-l-4 border-orange-600 dark:bg-orange-900/20 dark:border-orange-600';
                return `<div class="${bg} rounded-lg p-3 text-sm"><p class="font-medium dark:text-white">${n.text}</p><p class="mt-1 text-xs text-gray-400 dark:text-gray-400">${n.time||'baru'}</p></div>`;
            }).join('');
        }
        function update() {
            const now = new Date();
            timeSpan.innerText = `Update: ${now.toLocaleTimeString()}`;
            const newNotif = { ...pool[Math.floor(Math.random()*pool.length)], id:Date.now(), time:now.toLocaleTimeString() };
            let stored = JSON.parse(localStorage.getItem('notifListAuditee') || '[]');
            stored.unshift(newNotif);
            if(stored.length>5) stored.pop();
            localStorage.setItem('notifListAuditee', JSON.stringify(stored));
            render(stored);
        }
        if(!localStorage.getItem('notifListAuditee')) localStorage.setItem('notifListAuditee', JSON.stringify([{ text:"Selamat datang, PRODI! Selesaikan evaluasi diri.", type:"info", time:"awal"}]));
        render(JSON.parse(localStorage.getItem('notifListAuditee')));
        setInterval(update, 30000);
        setTimeout(update, 1000);
    });
</script>
@endpush