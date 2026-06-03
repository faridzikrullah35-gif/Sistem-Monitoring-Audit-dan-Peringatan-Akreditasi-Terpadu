@props(['value' => 0, 'color' => 'blue'])

@php
    // Mapping warna berdasarkan prop $color
    $colors = [
        'blue' => 'bg-blue-500',
        'green' => 'bg-green-500',
        'orange' => 'bg-orange-500',
        'red' => 'bg-red-500',
        'gray' => 'bg-gray-300 dark:bg-gray-600',
    ];
    
    $barColor = $colors[$color] ?? $colors['blue'];
    $bgColor = 'bg-gray-200 dark:bg-gray-700';
@endphp

<div class="w-full h-2.5 rounded-full {{ $bgColor }} overflow-hidden">
    <div 
        class="h-full rounded-full {{ $barColor }} transition-all duration-500 ease-out" 
        style="width: {{ $value }}%">
    </div>
</div>