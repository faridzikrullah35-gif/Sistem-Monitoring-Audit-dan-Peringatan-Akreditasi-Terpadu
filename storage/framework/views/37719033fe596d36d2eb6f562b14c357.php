

<?php
    use App\Models\ProfilFakultas;

    $profilFakultas = ProfilFakultas::latest('updated_at')->first();
?>

<div class="vmts-card rounded-xl bg-white dark:bg-[#0f172a] p-5 shadow-sm transition-colors duration-300">

    
    <div class="mb-5 flex items-center justify-between">
        <div class="flex items-center gap-3">

            
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 dark:bg-indigo-900/40">
                <svg
                    class="h-5 w-5 text-indigo-600 dark:text-indigo-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>
            </div>

            
            <div>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Visi, Misi, Tujuan & Sasaran
                </h2>

                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Profil Fakultas
                </p>
            </div>

        </div>

        
        <?php if($profilFakultas?->tahun_akademik): ?>
            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300">
                <?php echo e($profilFakultas->tahun_akademik); ?>

            </span>
        <?php endif; ?>
    </div>


    
    <?php if($profilFakultas): ?>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            
            <div class="rounded-xl border border-blue-100 bg-blue-50/50 p-5 dark:border-blue-900/40 dark:bg-blue-900/10">

                
                <div class="mb-3 flex items-center gap-2">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/50">
                        <svg
                            class="h-5 w-5 text-blue-600 dark:text-blue-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                            />
                        </svg>
                    </div>

                    <h3 class="font-semibold text-blue-700 dark:text-blue-400">
                        Visi
                    </h3>

                </div>

                
                <div class="vmts-content">
                    <?php echo $profilFakultas->visi ?: '<span class="italic text-gray-400">Belum ada data visi.</span>'; ?>

                </div>

            </div>


            
            <div class="rounded-xl border border-emerald-100 bg-emerald-50/50 p-5 dark:border-emerald-900/40 dark:bg-emerald-900/10">

                
                <div class="mb-3 flex items-center gap-2">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-900/50">
                        <svg
                            class="h-5 w-5 text-emerald-600 dark:text-emerald-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"
                            />
                        </svg>
                    </div>

                    <h3 class="font-semibold text-emerald-700 dark:text-emerald-400">
                        Misi
                    </h3>

                </div>

                
                <div class="vmts-content">
                    <?php echo $profilFakultas->misi ?: '<span class="italic text-gray-400">Belum ada data misi.</span>'; ?>

                </div>

            </div>


            
            <div class="rounded-xl border border-amber-100 bg-amber-50/50 p-5 dark:border-amber-900/40 dark:bg-amber-900/10">

                
                <div class="mb-3 flex items-center gap-2">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-100 dark:bg-amber-900/50">
                        <svg
                            class="h-5 w-5 text-amber-600 dark:text-amber-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"
                            />
                        </svg>
                    </div>

                    <h3 class="font-semibold text-amber-700 dark:text-amber-400">
                        Tujuan
                    </h3>

                </div>

                
                <div class="vmts-content">
                    <?php echo $profilFakultas->tujuan ?: '<span class="italic text-gray-400">Belum ada data tujuan.</span>'; ?>

                </div>

            </div>


            
            <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-5 dark:border-purple-900/40 dark:bg-purple-900/10">

                
                <div class="mb-3 flex items-center gap-2">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/50">
                        <svg
                            class="h-5 w-5 text-purple-600 dark:text-purple-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 12l5 5L20 7"
                            />
                        </svg>
                    </div>

                    <h3 class="font-semibold text-purple-700 dark:text-purple-400">
                        Sasaran
                    </h3>

                </div>

                
                <div class="vmts-content">
                    <?php echo $profilFakultas->sasaran ?: '<span class="italic text-gray-400">Belum ada data sasaran.</span>'; ?>

                </div>

            </div>

        </div>


    <?php else: ?>

        
        <div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 py-12 dark:border-gray-700">

            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">

                <svg
                    class="h-6 w-6 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>

            </div>

            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                Data VTMS belum tersedia
            </p>

            <p class="mt-1 text-xs text-gray-400">
                Silakan lengkapi profil fakultas terlebih dahulu.
            </p>

        </div>

    <?php endif; ?>

</div>



<style>

    /* ============================================================
       BASE CONTENT
       ============================================================ */

    .vmts-card .vmts-content {
        font-size: 0.875rem;
        line-height: 1.75;
        color: #4b5563;
    }

    .dark .vmts-card .vmts-content {
        color: #d1d5db;
    }


    /* ============================================================
       PARAGRAPH
       ============================================================ */

    .vmts-card .vmts-content p {
        margin: 0 0 0.6rem;
    }

    .vmts-card .vmts-content p:last-child {
        margin-bottom: 0;
    }


    /* ============================================================
       UNORDERED LIST / BULLET
       ============================================================ */

    .vmts-card .vmts-content ul {
        list-style-type: disc !important;
        list-style-position: outside !important;

        margin-top: 0.5rem !important;
        margin-bottom: 0.75rem !important;

        padding-left: 1.5rem !important;
    }


    /* ============================================================
       ORDERED LIST / NUMBERING
       ============================================================ */

    .vmts-card .vmts-content ol {
        list-style-type: decimal !important;
        list-style-position: outside !important;

        margin-top: 0.5rem !important;
        margin-bottom: 0.75rem !important;

        padding-left: 1.5rem !important;
    }


    /* ============================================================
       LIST ITEM
       ============================================================ */

    .vmts-card .vmts-content li {
        display: list-item !important;

        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;

        padding-left: 0.2rem !important;
    }


    /* ============================================================
       NESTED UNORDERED LIST
       ============================================================ */

    .vmts-card .vmts-content ul ul {
        list-style-type: circle !important;

        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .vmts-card .vmts-content ul ul ul {
        list-style-type: square !important;
    }


    /* ============================================================
       NESTED ORDERED LIST
       ============================================================ */

    .vmts-card .vmts-content ol ol {
        list-style-type: lower-alpha !important;

        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .vmts-card .vmts-content ol ol ol {
        list-style-type: lower-roman !important;
    }


    /* ============================================================
       MIXED NESTED LIST
       ============================================================ */

    .vmts-card .vmts-content ol ul {
        list-style-type: disc !important;
    }

    .vmts-card .vmts-content ul ol {
        list-style-type: decimal !important;
    }


    /* ============================================================
       STRONG / BOLD
       ============================================================ */

    .vmts-card .vmts-content strong,
    .vmts-card .vmts-content b {
        font-weight: 700;
        color: #374151;
    }

    .dark .vmts-card .vmts-content strong,
    .dark .vmts-card .vmts-content b {
        color: #f3f4f6;
    }


    /* ============================================================
       ITALIC
       ============================================================ */

    .vmts-card .vmts-content em,
    .vmts-card .vmts-content i {
        font-style: italic;
    }


    /* ============================================================
       LINK
       ============================================================ */

    .vmts-card .vmts-content a {
        color: #4f46e5;
        text-decoration: underline;
    }

    .vmts-card .vmts-content a:hover {
        opacity: 0.8;
    }


    /* ============================================================
       TABLE
       ============================================================ */

    .vmts-card .vmts-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 0.75rem 0;
        font-size: 0.875rem;
    }

    .vmts-card .vmts-content th,
    .vmts-card .vmts-content td {
        border: 1px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
        text-align: left;
    }

    .dark .vmts-card .vmts-content th,
    .dark .vmts-card .vmts-content td {
        border-color: #374151;
    }


    /* ============================================================
       BLOCKQUOTE
       ============================================================ */

    .vmts-card .vmts-content blockquote {
        margin: 0.75rem 0;
        padding-left: 1rem;
        border-left: 3px solid #6366f1;
        color: #6b7280;
        font-style: italic;
    }

    .dark .vmts-card .vmts-content blockquote {
        color: #9ca3af;
    }


    /* ============================================================
       MOBILE
       ============================================================ */

    @media (max-width: 640px) {

        .vmts-card .vmts-content {
            font-size: 0.8125rem;
            line-height: 1.7;
        }

        .vmts-card .vmts-content ul,
        .vmts-card .vmts-content ol {
            padding-left: 1.35rem !important;
        }

    }

</style><?php /**PATH F:\Project-2\audit-app\resources\views/components/dashboard-fakultas/vmts.blade.php ENDPATH**/ ?>