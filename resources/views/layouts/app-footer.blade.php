<footer class="mt-auto border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-3">

        <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 text-center md:text-left leading-relaxed">
            © {{ date('Y') }} Developed by Muhammad Farid Zikrullah <br class="md:hidden">
            - Sistem Audit Internal - Lembaga Penjaminan Mutu - UMBJM
        </p>

        <div class="flex items-center justify-center md:justify-end text-xs md:text-sm text-gray-500 dark:text-gray-400">
            <span class="px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-800">
                v{{ config('app.version', '0.0.1') }}
            </span>
        </div>

    </div>
</footer>