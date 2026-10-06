<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Alpine.js -->
    

    <!-- Theme Store -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                        'light';
                    this.theme = savedTheme || systemTheme;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const body = document.body;
                    if (this.theme === 'dark') {
                        html.classList.add('dark');
                        body.classList.add('dark', 'bg-gray-900');
                    } else {
                        html.classList.remove('dark');
                        body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });

            Alpine.store('sidebar', {
                // Initialize based on screen size
                isExpanded: window.innerWidth >= 1280, // true for desktop, false for mobile
                isMobileOpen: false,
                isHovered: false,

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    // When toggling desktop sidebar, ensure mobile menu is closed
                    this.isMobileOpen = false;
                },

                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                    // Don't modify isExpanded when toggling mobile menu
                },

                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },

                setHovered(val) {
                    // Only allow hover effects on desktop when sidebar is collapsed
                    if (window.innerWidth >= 1280 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>

    <!-- Apply dark mode immediately to prevent flash -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.body.classList.add('dark', 'bg-gray-900');
            } else {
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('dark', 'bg-gray-900');
            }
        })();
    </script>
    
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
</head>

<body
    class="min-h-screen flex flex-col"
    x-data="{ loaded: true }"
    x-init="
        $store.header.init();

        $store.sidebar.isExpanded = window.innerWidth >= 1280;

        const checkMobile = () => {
            if (window.innerWidth < 1280) {
                $store.sidebar.isMobileOpen = false;
                $store.sidebar.isExpanded = false;
            } else {
                $store.sidebar.isMobileOpen = false;
                $store.sidebar.isExpanded = true;
            }
        };

        window.addEventListener('resize', checkMobile);
        checkMobile();
    "
>

    
    <?php if (isset($component)) { $__componentOriginal33757e58bef6aaec67779bf03774fc2d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal33757e58bef6aaec67779bf03774fc2d = $attributes; } ?>
<?php $component = App\View\Components\Common\Preloader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.preloader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Common\Preloader::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal33757e58bef6aaec67779bf03774fc2d)): ?>
<?php $attributes = $__attributesOriginal33757e58bef6aaec67779bf03774fc2d; ?>
<?php unset($__attributesOriginal33757e58bef6aaec67779bf03774fc2d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal33757e58bef6aaec67779bf03774fc2d)): ?>
<?php $component = $__componentOriginal33757e58bef6aaec67779bf03774fc2d; ?>
<?php unset($__componentOriginal33757e58bef6aaec67779bf03774fc2d); ?>
<?php endif; ?>

    <div class="flex-1 xl:flex">
        <?php echo $__env->make('layouts.backdrop', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out"
            :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">

            <!-- HEADER -->
            <?php echo $__env->make('layouts.app-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- CONTENT + FOOTER WRAPPER -->
            <div class="flex flex-col flex-1 overflow-hidden">

                <!-- SCROLL AREA -->
                <div class="p-4 md:p-6">
                    
                    <!-- CONTAINER -->
                    <div class="max-w-screen-xl mx-auto w-full">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>

                </div>

                <!-- FOOTER -->
                <?php echo $__env->make('layouts.app-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            </div>

        </div>

    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            <?php if(session('success')): ?>
                window.toast.success(<?php echo json_encode(session('success'), 15, 512) ?>);
            <?php endif; ?>

            <?php if(session('error')): ?>
                window.toast.error(<?php echo json_encode(session('error'), 15, 512) ?>);
            <?php endif; ?>

            <?php if(session('info')): ?>
                window.toast.info(<?php echo json_encode(session('info'), 15, 512) ?>);
            <?php endif; ?>

            <?php if(session('warning')): ?>
                window.toast.warning(<?php echo json_encode(session('warning'), 15, 512) ?>);
            <?php endif; ?>

        });
    </script>

<?php if (isset($component)) { $__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3 = $attributes; } ?>
<?php $component = App\View\Components\Ui\Alert::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Ui\Alert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3)): ?>
<?php $attributes = $__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3; ?>
<?php unset($__attributesOriginal024700bb3b1afbadbf97b6cf5efa18f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3)): ?>
<?php $component = $__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3; ?>
<?php unset($__componentOriginal024700bb3b1afbadbf97b6cf5efa18f3); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.routes.pengguna', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.routes.data-auditor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.routes.tahun-akademik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.routes.setting-kriteria', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.routes.setting-akses-auditor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.routes.matrix-penilaian', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
flatpickr(".datepicker", {
    dateFormat: "Y-m-d", // format ke backend Laravel
    altInput: true,
    altFormat: "d F Y",
    allowInput: true
});
</script>

<?php echo $__env->yieldPushContent('modals'); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH F:\Project-2\audit-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>