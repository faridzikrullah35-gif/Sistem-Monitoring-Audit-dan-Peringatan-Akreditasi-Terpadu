{{-- 
    PARTIAL: pages/landing/partials/structure-node.blade.php
    Digunakan untuk merender satu node dan children-nya secara rekursif.
--}}

@props(['node', 'level' => 0])

<div class="tree-node level-{{ $level }} {{ $node->children->count() > 1 ? 'has-multiple-children' : '' }}">
    {{-- Card --}}
    <div class="node-card">
        @if($node->foto)
            <img src="{{ asset('storage/struktur_organisasi/' . $node->foto) }}"
                 alt="{{ $node->nama }}"
                 class="avatar"
                 onerror="this.src='{{ asset('images/default-avatar.png') }}'">
        @else
            <div class="avatar" style="display:flex; align-items:center; justify-content:center; font-size:28px; color:#94a3b8;">
                👤
            </div>
        @endif

        <div class="badge">{{ $node->jabatan }}</div>
        <h4>{{ $node->nama }}</h4>
    </div>

    {{-- Children (rekursif) --}}
    @if($node->children->count())
        <div class="children-wrapper">
            @foreach($node->children as $child)
                @include('pages.landing.partials.structure-node', ['node' => $child, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>