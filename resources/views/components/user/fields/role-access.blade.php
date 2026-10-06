<div>
    <h4 class="mb-4 border-b border-gray-200 pb-2 text-sm font-semibold text-gray-800 dark:border-gray-700 dark:text-gray-200">
        Role / Hak Akses
    </h4>

    <label
        for="role"
        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300"
    >
        Pilih Role
        <span class="text-red-500">*</span>
    </label>

    <select
        id="role"
        name="role"
        required
        class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
    >
        <option value="" disabled selected>
            -- Pilih Hak Akses --
        </option>

        @foreach($roles as $role)
            <option value="{{ $role->name }}">
                {{ ucwords(str_replace('_', ' ', $role->name)) }}
            </option>
        @endforeach
    </select>
</div>