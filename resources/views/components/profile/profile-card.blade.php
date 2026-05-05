@php
    $user = auth()->user();
    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff';
    $hasPhoto = !empty($user->photo) && $user->photo !== 'null';
    
    // Tambahkan timestamp agar browser tidak menampilkan cache foto lama
    $photoUrl = $hasPhoto ? asset('storage/' . $user->photo) . '?v=' . time() : $fallbackAvatar;
@endphp

<div x-data="{ open: false }">
    <div class="mb-6 rounded-2xl border border-gray-200 p-5 lg:p-6 dark:border-gray-800">
        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">

            {{-- PROFILE --}}
            <div class="flex w-full flex-col items-center gap-6 xl:flex-row">

                <!-- Foto -->
                <div class="h-24 w-24 overflow-hidden rounded-full border-2 border-indigo-500 shadow-md cursor-pointer openModal"
                    data-modal="photoView">
                    <img 
                        data-user-photo
                        src="{{ $photoUrl }}"
                        class="h-full w-full object-cover"
                    />
                </div>

                <!-- Info -->
                <div class="text-center xl:text-left">
                    <h4 class="mb-1 text-xl font-semibold text-gray-800 dark:text-white/90">
                        {{ $user->name }}
                    </h4>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->email }}
                    </p>

                    <p class="text-sm text-gray-400 mt-1">
                        Sistem Audit Internal
                    </p>
                </div>
            </div>

            <!-- Button Edit -->
            <button class="edit-button openModal" data-modal="photo">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497Z"/>
                </svg>
                Edit Foto
            </button>
        </div>
    </div>
</div>