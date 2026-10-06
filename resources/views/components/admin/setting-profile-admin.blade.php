<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
            Profile Admin
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Informasi profile admin yang digunakan pada sistem SIMANTAP.
        </p>
    </div>

    {{-- Profile Card --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm
                dark:border-gray-700 dark:bg-gray-800">
        {{-- Profile Header --}}
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center">
            {{-- Avatar --}}
            <div class="flex h-24 w-24 shrink-0 items-center justify-center
                        rounded-full bg-gray-100 dark:bg-gray-700">
                <svg
                    class="h-12 w-12 text-gray-400 dark:text-gray-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                    />
                </svg>
            </div>

            {{-- Info --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Profile Admin
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi akun administrator sistem.
                </p>
            </div>
        </div>

        {{-- View Only Information --}}
        <div class="mt-8 space-y-6">
            {{-- Nama --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                        Nama
                    </label>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-sm text-gray-900 dark:text-white py-2 px-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                        {{ auth()->user()->name ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- Email --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                        Email
                    </label>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-sm text-gray-900 dark:text-white py-2 px-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                        {{ auth()->user()->email ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- Role --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                        Role
                    </label>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-sm text-gray-900 dark:text-white py-2 px-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                        @if(auth()->user()->role == 'admin')
                            <span class="inline-flex rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400">
                                Administrator
                            </span>
                        @elseif(auth()->user()->role == 'superadmin')
                            <span class="inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                                Super Administrator
                            </span>
                        @else
                            <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                {{ ucfirst(auth()->user()->role ?? 'User') }}
                            </span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Dibuat Pada --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                        Akun Dibuat
                    </label>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-sm text-gray-900 dark:text-white py-2 px-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                        {{ auth()->user()->created_at ? \Carbon\Carbon::parse(auth()->user()->created_at)->format('d F Y H:i:s') : '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>