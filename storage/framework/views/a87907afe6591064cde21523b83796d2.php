<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind Config (extend Inter font) -->
    <script>
        if (typeof tailwind !== 'undefined' && tailwind.config) {
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'system-ui', 'sans-serif'],
                        }
                    }
                }
            };
        }
    </script>

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
                isExpanded: window.innerWidth >= 1280,
                isMobileOpen: false,
                isHovered: false,

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    this.isMobileOpen = false;
                },

                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                },

                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },

                setHovered(val) {
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

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>

<body x-data="{ loaded: true }" x-init="
    $store.sidebar.isExpanded = window.innerWidth >= 1280;
    const checkMobile = () => {
        if (window.innerWidth < 1280) {
            $store.sidebar.setMobileOpen(false);
            $store.sidebar.isExpanded = false;
        } else {
            $store.sidebar.isMobileOpen = false;
            $store.sidebar.isExpanded = true;
        }
    };
    window.addEventListener('resize', checkMobile);
">

    
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
    

    <?php echo $__env->yieldContent('content'); ?>

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
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>



</html><?php /**PATH F:\Project-2\audit-app\resources\views/layouts/fullscreen-layout.blade.php ENDPATH**/ ?>