@props(['name' => 'score', 'value' => ''])

<div class="relative w-16 mx-auto">
    <input 
        type="number" 
        name="{{ $name }}" 
        id="{{ $name }}"
        value="{{ $value }}"
        min="1" 
        max="4" 
        step="1"
        oninput="validateScore(this)"
        class="w-full h-10 text-center text-base font-bold border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
    >
</div>

<script>
function validateScore(input) {
    const val = parseFloat(input.value);
    // Kalau kosong biarkan
    if (input.value === "") return;
    
    // Kalau lebih dari 4 atau kurang dari 1, reset
    if (val > 4 || val < 1) {
        input.value = "";
        input.classList.add('ring-2', 'ring-red-500', 'border-red-500');
        setTimeout(() => {
            input.classList.remove('ring-2', 'ring-red-500', 'border-red-500');
        }, 1000);
    }
}
</script>