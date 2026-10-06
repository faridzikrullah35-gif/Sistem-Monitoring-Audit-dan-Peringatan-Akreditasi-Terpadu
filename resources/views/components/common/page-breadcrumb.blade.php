@props(['pageTitle' => 'Page'])

@php
    $segments = request()->segments();
    $url = url('/');
    
    // Mapping untuk mengubah segment URL menjadi label yang lebih baik
    $segmentLabels = [
        'sarpras' => 'Sarana Prasarana',
        // Tambahkan mapping lain jika diperlukan
        // 'ptk' => 'PTK',
        // 'akreditasi' => 'Akreditasi',
    ];
@endphp

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
        {{ $pageTitle }}
    </h2>

    <nav>
        <ol class="flex items-center gap-1.5">

            {{-- Home --}}
            @php
                $dashboardRoute = match(auth()->user()->role) {
                    'admin'      => 'admin.dashboard',
                    'auditor'    => 'auditor.dashboard',
                    'prodi'      => 'prodi.dashboard',
                    'unit_kerja' => 'auditor.dashboard',
                    default      => 'auditor.dashboard',
                };
            @endphp

            <li>
                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                href="{{ route($dashboardRoute) }}">

                    Home

                    <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none">
                        <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                            stroke="currentColor"
                            stroke-width="1.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </svg>

                </a>
            </li>

            {{-- Dynamic segments --}}
            @php
                $hiddenSegments = [
                    'others',
                    auth()->user()->role,
                ];

                $filteredSegments = array_values(array_filter(
                    $segments,
                    fn($s) => !in_array($s, $hiddenSegments)
                ));
            @endphp

            @foreach($filteredSegments as $index => $segment)
                @php
                    $url .= '/' . $segment;
                    
                    // Cek apakah ada mapping khusus untuk segment ini
                    $name = $segmentLabels[$segment] ?? ucfirst(str_ireplace('ptk', 'PTK', str_replace('-', ' ', $segment)));
                    
                    // Jika segment adalah 'sarpras' dan ini adalah segment terakhir, 
                    // dan pageTitle mengandung "Kelola", tampilkan "Kelola Sarana Prasarana"
                    if ($segment === 'sarpras' && $loop->last && str_contains($pageTitle, 'Kelola')) {
                        $name = 'Kelola Sarana Prasarana';
                    }
                @endphp

                @if($loop->last)
                    <li class="text-sm text-gray-800 dark:text-white/90">
                        {{ $name }}
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}"
                        class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $name }}
                        </a>
                    </li>

                    <li class="text-gray-400">/</li>
                @endif
            @endforeach

        </ol>
    </nav>
</div>