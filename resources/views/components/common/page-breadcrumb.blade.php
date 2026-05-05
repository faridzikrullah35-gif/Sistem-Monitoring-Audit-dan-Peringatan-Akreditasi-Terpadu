@props(['pageTitle' => 'Page'])

@php
    $segments = request()->segments();
    $url = url('/');
@endphp

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
        {{ $pageTitle }}
    </h2>

    <nav>
        <ol class="flex items-center gap-1.5">

            {{-- Home --}}
            <li>
                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                   href="{{ url('/dashboard') }}">
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
                $filteredSegments = array_values(array_filter($segments, fn($s) => $s !== 'others'));
            @endphp

            @foreach($filteredSegments as $index => $segment)
                @php
                    $url .= '/' . $segment;
                    $name = ucfirst(str_replace('-', ' ', $segment));
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