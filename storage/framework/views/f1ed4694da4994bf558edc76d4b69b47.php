<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="<?php echo e(__('Pagination Navigation')); ?>" class="flex items-center justify-between my-8">
        
        <div class="flex justify-between flex-1 sm:hidden">
            <?php if($paginator->onFirstPage()): ?>
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-default rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                    <?php echo __('pagination.previous'); ?>

                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-900 transition">
                    <?php echo __('pagination.previous'); ?>

                </a>
            <?php endif; ?>

            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-900 transition">
                    <?php echo __('pagination.next'); ?>

                </a>
            <?php else: ?>
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-default rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                    <?php echo __('pagination.next'); ?>

                </span>
            <?php endif; ?>
        </div>

        
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <?php echo __('Showing'); ?>

                    <?php if($paginator->firstItem()): ?>
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($paginator->firstItem()); ?></span>
                        <?php echo __('to'); ?>

                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($paginator->lastItem()); ?></span>
                    <?php else: ?>
                        <?php echo e($paginator->count()); ?>

                    <?php endif; ?>
                    <?php echo __('of'); ?>

                    <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($paginator->total()); ?></span>
                    <?php echo __('results'); ?>

                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse rounded-xl shadow-sm">
                    
                    <?php if($paginator->onFirstPage()): ?>
                        <span aria-disabled="true" aria-label="<?php echo e(__('pagination.previous')); ?>">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-300 bg-gray-50 border border-gray-200 cursor-default rounded-l-xl dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                            </span>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-l-xl hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 transition" aria-label="<?php echo e(__('pagination.previous')); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                        </a>
                    <?php endif; ?>

                    
                    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if(is_string($element)): ?>
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"><?php echo e($element); ?></span>
                            </span>
                        <?php endif; ?>

                        
                        <?php if(is_array($element)): ?>
                            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($page == $paginator->currentPage()): ?>
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-semibold text-white bg-indigo-600 border border-indigo-600 z-10 dark:bg-indigo-500 dark:border-indigo-500"><?php echo e($page); ?></span>
                                    </span>
                                <?php else: ?>
                                    <a href="<?php echo e($url); ?>" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-600 bg-white border border-gray-300 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 transition" aria-label="<?php echo e(__('Go to page :page', ['page' => $page])); ?>">
                                        <?php echo e($page); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($paginator->hasMorePages()): ?>
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-r-xl hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 transition" aria-label="<?php echo e(__('pagination.next')); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    <?php else: ?>
                        <span aria-disabled="true" aria-label="<?php echo e(__('pagination.next')); ?>">
                            <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-300 bg-gray-50 border border-gray-200 cursor-default rounded-r-xl dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </span>
                        </span>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </nav>
<?php endif; ?><?php /**PATH F:\Project-2\audit-app\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>