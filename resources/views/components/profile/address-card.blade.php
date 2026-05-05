@php
    $user = auth()->user();

    $country = $user->country ?? '-';
    $city    = $user->city ?? '-';
    $postal  = $user->postal_code ?? '-';
    $tax     = $user->tax_id ?? '-';
@endphp

<div x-data="{ open: false }">
    <div class="p-5 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

            <!-- INFO -->
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
                    Informasi Alamat
                </h4>

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">

                    <div>
                        <p class="mb-2 text-xs text-gray-500">Negara</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ $country }}
                        </p>
                    </div>

                    <div>
                        <p class="mb-2 text-xs text-gray-500">Kota / Provinsi</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ $city }}
                        </p>
                    </div>

                    <div>
                        <p class="mb-2 text-xs text-gray-500">Kode Pos</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                            {{ $postal }}
                        </p>
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <button class="edit-button openModal" data-modal="address">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497Z"/>
                </svg>
                Edit Alamat
            </button>
        </div>
    </div>

    <!-- MODAL -->
    <x-ui.modal x-data="{ open: false }" @open.window="open = true" :isOpen="false" class="max-w-[600px]">
        <div class="w-full rounded-2xl bg-white p-6 dark:bg-gray-900">

            <h4 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">
                Edit Alamat
            </h4>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <div class="grid grid-cols-1 gap-4">

                    <div>
                        <label class="text-sm text-gray-600">Negara</label>
                        <input type="text" name="country" value="{{ $user->country }}"
                            class="w-full mt-1 rounded-lg border px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Kota / Provinsi</label>
                        <input type="text" name="city" value="{{ $user->city }}"
                            class="w-full mt-1 rounded-lg border px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Kode Pos</label>
                        <input type="text" name="postal_code" value="{{ $user->postal_code }}"
                            class="w-full mt-1 rounded-lg border px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Identitas (Opsional)</label>
                        <input type="text" name="tax_id" value="{{ $user->tax_id }}"
                            class="w-full mt-1 rounded-lg border px-3 py-2 text-sm">
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 border rounded-lg text-sm">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </x-ui.modal>
</div>