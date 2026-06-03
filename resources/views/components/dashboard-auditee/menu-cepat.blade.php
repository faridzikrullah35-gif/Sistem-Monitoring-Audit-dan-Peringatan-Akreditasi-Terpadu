{{-- resources/views/components/dashboard-auditee/menu-cepat.blade.php --}}
<div class="rounded-xl bg-white p-5 shadow-sm dark:bg-gray-800">
    <div class="mb-3 flex items-center gap-2">
        <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Menu Cepat</h2>
    </div>
    <div class="grid grid-cols-2 gap-3">
        <button data-modal="modalEval" class="flex items-center justify-center gap-1 rounded-xl bg-blue-50 p-3 text-sm font-medium text-blue-700 transition hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            Isi Evaluasi
        </button>
        <!-- tombol lain dengan dark mode serupa -->
        <button data-modal="modalUpload" class="flex items-center justify-center gap-1 rounded-xl bg-green-50 p-3 text-sm font-medium text-green-700 transition hover:bg-green-100 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/50">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
            Upload Dokumen
        </button>
        <button data-modal="modalTemuan" class="flex items-center justify-center gap-1 rounded-xl bg-red-50 p-3 text-sm font-medium text-red-700 transition hover:bg-red-100 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
            Lihat Temuan
        </button>
        <button data-modal="modalCetak" class="flex items-center justify-center gap-1 rounded-xl bg-gray-100 p-3 text-sm font-medium text-gray-700 transition hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
            Cetak Rekap
        </button>
        <button data-modal="modalRiwayat" class="col-span-2 flex items-center justify-center gap-1 rounded-xl bg-purple-50 p-3 text-sm font-medium text-purple-700 transition hover:bg-purple-100 dark:bg-purple-900/30 dark:text-purple-300 dark:hover:bg-purple-900/50">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Riwayat Audit
        </button>
    </div>
</div>

@push('scripts')
<script>
    // Modal handler (sama seperti sebelumnya, tidak perlu diubah)
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('[id^="modal"]');
        function openModal(id) { const modal = document.getElementById(id); if(modal) modal.classList.remove('hidden'); }
        function closeAllModals() { modals.forEach(m => m.classList.add('hidden')); }
        document.querySelectorAll('[data-modal]').forEach(btn => btn.addEventListener('click', (e) => openModal(btn.getAttribute('data-modal'))));
        document.querySelectorAll('.close-modal').forEach(btn => btn.addEventListener('click', closeAllModals));
        modals.forEach(m => m.addEventListener('click', (e) => { if(e.target === m) closeAllModals(); }));
    });
</script>
@endpush