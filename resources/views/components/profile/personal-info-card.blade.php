<div x-data="{saveProfile(){
    console.log('Saving profile...');
}}">
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
                    Informasi Pengguna
                </h4>

                @php
                    $nameParts = explode(' ', auth()->user()->name);
                    $name = $nameParts[0] ?? '-';
                @endphp

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">

                    <!-- First Name -->
                    <div>
                        <p class="mb-2 text-xs text-gray-500">Nama</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ $name }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <p class="mb-2 text-xs text-gray-500">Email</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <p class="mb-2 text-xs text-gray-500">No. Telepon</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ auth()->user()->phone ?? '-' }}
                        </p>
                    </div>

                    <!-- Bio -->
                    <div>
                        <p class="mb-2 text-xs text-gray-500">Peran / Jabatan</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ auth()->user()->role ?? 'User' }}
                        </p>
                    </div>

                </div>
            </div>

            <!-- Button -->
            <button class="edit-button openModal" data-modal="info">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497Z"/>
                </svg>
                Edit Profile
            </button>

        </div>
    </div>
</div>