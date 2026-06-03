<div class="mt-6 flex flex-wrap gap-6 rounded-md border border-gray-200 bg-gray-50 p-4">
    <template x-for="cat in categories" :key="cat.label">
        <div class="flex-1">
            <div class="text-sm font-medium text-gray-500" x-text="'Total ' + cat.label"></div>
            <div class="text-2xl font-bold" :class="cat.color" x-text="cat.total"></div>
        </div>
    </template>
</div>