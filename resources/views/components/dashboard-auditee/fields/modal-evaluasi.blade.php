{{-- resources/views/components/dashboard-auditee/fields/modal-evaluasi.blade.php --}}
<div id="modalEval" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="mx-4 w-full max-w-md rounded-xl bg-white p-6 shadow-2xl dark:bg-gray-800">
        <h3 class="mb-3 text-xl font-bold text-gray-800 dark:text-white">Isi Evaluasi Diri</h3>
        <textarea rows="4" class="w-full rounded-lg border p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Tulis evaluasi diri PRODI ..."></textarea>
        <div class="mt-4 flex justify-end gap-2">
            <button class="close-modal rounded-lg bg-gray-200 px-4 py-2 dark:bg-gray-700 dark:text-gray-300">Batal</button>
            <button class="rounded-lg bg-blue-600 px-4 py-2 text-white">Simpan</button>
        </div>
    </div>
</div>