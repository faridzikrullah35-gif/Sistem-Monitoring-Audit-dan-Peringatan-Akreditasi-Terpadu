<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white/90">Jumlah DTPS</h4>
    <form action="{{ route('prodi.identitas-prodi.dtps.update') }}" method="POST" class="grid grid-cols-2 gap-4 md:grid-cols-3">
        @csrf
        @method('PUT')
        <div>
            <label for="magister" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Magister</label>
            <input type="number" id="magister" name="jumlah_dtps_magister" value="{{ old('jumlah_dtps_magister', $profil->jumlah_dtps_magister ?? 0) }}" class="mt-1 w-full rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
        </div>
        <div>
            <label for="doktor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doktor</label>
            <input type="number" id="doktor" name="jumlah_dtps_doktor" value="{{ old('jumlah_dtps_doktor', $profil->jumlah_dtps_doktor ?? 0) }}" class="mt-1 w-full rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
        </div>
        <div>
            <label for="aa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">AA</label>
            <input type="number" id="aa" name="jumlah_aa" value="{{ old('jumlah_aa', $profil->jumlah_aa ?? 0) }}" class="mt-1 w-full rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
        </div>
        <div>
            <label for="lk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LK</label>
            <input type="number" id="lk" name="jumlah_lk" value="{{ old('jumlah_lk', $profil->jumlah_lk ?? 0) }}" class="mt-1 w-full rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
        </div>
        <div>
            <label for="gb" class="block text-sm font-medium text-gray-700 dark:text-gray-300">GB</label>
            <input type="number" id="gb" name="jumlah_gb" value="{{ old('jumlah_gb', $profil->jumlah_gb ?? 0) }}" class="mt-1 w-full rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
        </div>
        <div class="flex items-end justify-end">
            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>