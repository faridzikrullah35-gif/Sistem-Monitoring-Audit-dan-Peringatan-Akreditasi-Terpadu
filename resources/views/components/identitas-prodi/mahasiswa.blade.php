<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
    <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white/90">Jumlah Mahasiswa</h4>
    <form action="{{ route('prodi.identitas-prodi.mahasiswa.update') }}" method="POST" class="flex items-end gap-4">
        @csrf
        @method('PUT')
        <div class="flex-1">
            <label for="jumlah_mahasiswa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Mahasiswa</label>
            <input type="number" id="jumlah_mahasiswa" name="jumlah_mahasiswa" value="{{ old('jumlah_mahasiswa', $profil->jumlah_mahasiswa ?? 0) }}" class="mt-1 w-full rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
        </div>
        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Update</button>
    </form>
</div>