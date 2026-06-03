<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

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
    
    <link rel="icon" href="{{ asset('favicon.ico') }}">
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

    {{-- preloader --}}
    <x-common.preloader/>

    <div class="flex-1 xl:flex">
        @include('layouts.backdrop')
        @include('layouts.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out"
            :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">

            <!-- HEADER -->
            @include('layouts.app-header')

            <!-- CONTENT + FOOTER WRAPPER -->
            <div class="flex flex-col flex-1 overflow-hidden">

                <!-- SCROLL AREA -->
                <div class="p-4 md:p-6">
                    
                    <!-- CONTAINER -->
                    <div class="max-w-screen-xl mx-auto w-full">
                        @yield('content')
                    </div>

                </div>

                <!-- FOOTER -->
                @include('layouts.app-footer')

            </div>

        </div>

    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            @if(session('success'))
                window.toast.success(@json(session('success')));
            @endif

            @if(session('error'))
                window.toast.error(@json(session('error')));
            @endif

            @if(session('info'))
                window.toast.info(@json(session('info')));
            @endif

            @if(session('warning'))
                window.toast.warning(@json(session('warning')));
            @endif

        });
    </script>

<x-ui.alert />

@include('layouts.routes.pengguna')
@include('layouts.routes.data-auditor')
@include('layouts.routes.tahun-akademik')
@include('layouts.routes.setting-kriteria')
@include('layouts.routes.setting-akses-auditor')
@include('layouts.routes.matrix-penilaian')

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

</body>
@stack('scripts')

</html>
