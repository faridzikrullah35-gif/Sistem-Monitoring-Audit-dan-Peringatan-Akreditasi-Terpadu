@extends('layouts.fullscreen-layout')

@section('title', 'Login | SIMANTAP')

@section('content')
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">

    {{-- ============================================================ --}}
    {{-- BACKGROUND PANEL — Full screen, always visible               --}}
    {{-- ============================================================ --}}
    <div class="absolute inset-0 bg-cover bg-center"
     style="background-image: url('/images/img/background.jpg');">
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    {{-- ============================================================ --}}
    {{-- FLOATING FORM CARD — mengambang di atas background           --}}
    {{-- ============================================================ --}}
    <div class="relative z-20 w-full max-w-md mx-4 sm:mx-6
                bg-white/95 backdrop-blur-xl
                rounded-2xl shadow-2xl shadow-black/20
                border border-white/50
                p-7 sm:p-9">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/img/logo.png') }}" 
                alt="Logo SIMANTAP"
                class="h-20 sm:h-34 w-auto object-contain">
        </div>

        <!-- Heading -->
        <div class="mb-8 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">
                Selamat Datang
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Silakan login menggunakan akun Anda untuk mengakses dashboard sistem audit.
            </p>
        </div>

        {{-- Error banner --}}
        @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 rounded-xl bg-red-50 border border-red-200 px-4 py-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 shrink-0 mt-0.5"></i>
                <span class="text-sm text-red-700 font-medium">{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Form -->
        <form id="loginForm" action="{{ route('login.submit') }}" method="POST" class="space-y-5" novalidate>
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i data-lucide="mail" class="w-[18px] h-[18px] text-gray-400"></i>
                    </span>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required
                           class="block w-full rounded-xl border border-gray-200 bg-gray-50/60 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-400 transition-all duration-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20" />
                </div>
                @error('email')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <i data-lucide="info" class="w-3 h-3"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i data-lucide="lock" class="w-[18px] h-[18px] text-gray-400"></i>
                    </span>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           required
                           class="block w-full rounded-xl border border-gray-200 bg-gray-50/60 py-3 pl-11 pr-11 text-sm text-gray-900 placeholder-gray-400 transition-all duration-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20" />
                    <button type="button" id="togglePwd"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer"
                            aria-label="Toggle password visibility">
                        <i data-lucide="eye" id="eyeIcon" class="w-[18px] h-[18px]"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <i data-lucide="info" class="w-3 h-3"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" id="submitBtn"
                    class="relative w-full flex items-center justify-center gap-2 rounded-xl bg-indigo-600 py-3 px-6 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition-all duration-200 hover:bg-indigo-700 hover:shadow-indigo-700/30 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 overflow-hidden">
                <span id="btnText">Login</span>
                <i data-lucide="arrow-right" id="btnArrow" class="w-4 h-4"></i>
                <svg id="btnSpinner" class="hidden animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>
        </form>
    </div>

    <div class="absolute bottom-4 left-0 w-full px-4 text-center z-20">
        <p class="inline-block text-xs md:text-sm text-white/80 leading-relaxed backdrop-blur-sm bg-black/20 px-3 py-1.5 rounded-lg">
            © {{ date('Y') }} Developed by Muhammad Farid Zikrullah 
            <br class="md:hidden">
            - Sistem Audit Internal - Lembaga Penjaminan Mutu - UMBJM
        </p>
    </div>

</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // =========================
    // INIT LUCIDE ICONS
    // =========================
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // =========================
    // PASSWORD TOGGLE (SAFE)
    // =========================
    const togglePwd = document.getElementById('togglePwd');
    const pwdInput  = document.getElementById('password');
    const eyeIcon   = document.getElementById('eyeIcon');

    let pwdVisible = false;

    if (togglePwd && pwdInput && eyeIcon) {
        togglePwd.addEventListener('click', () => {
            pwdVisible = !pwdVisible;

            pwdInput.type = pwdVisible ? 'text' : 'password';

            eyeIcon.setAttribute(
                'data-lucide',
                pwdVisible ? 'eye-off' : 'eye'
            );

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    }

    // =========================
    // FORM VALIDATION (SAFE)
    // =========================
    const form       = document.getElementById('loginForm');
    const btnText    = document.getElementById('btnText');
    const btnArrow   = document.getElementById('btnArrow');
    const btnSpinner = document.getElementById('btnSpinner');
    const submitBtn  = document.getElementById('submitBtn');

    if (!form) return;

    form.addEventListener('submit', (e) => {

        const email = document.getElementById('email');
        const password = document.getElementById('password');

        if (!email || !password) return;

        // kosong validation
        if (!email.value.trim() || !password.value.trim()) {
            e.preventDefault();
            if (window.showError) {
                window.showError('Harap isi semua field sebelum login.');
            }
            return;
        }

        // email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email.value.trim())) {
            e.preventDefault();
            if (window.showError) {
                window.showError('Format email tidak valid.');
            }
            return;
        }

        // =========================
        // LOADING STATE (SAFE)
        // =========================
        if (btnText) btnText.classList.add('hidden');
        if (btnArrow) btnArrow.classList.add('hidden');
        if (btnSpinner) btnSpinner.classList.remove('hidden');

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-80');
        }
    });

});
</script>
@endpush

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-12px); }
    }
    .float-anim { animation: float 4s ease-in-out infinite; }
</style>
@endsection