@props(['struktur', 'level' => 0])

@php
    // Warna & ukuran kartu mengikuti kedalaman level, siklus: root -> tier1 -> tier2 -> leaf (seterusnya tetap leaf)
    $levelKey = match (true) {
        $level === 0 => 'root',
        $level === 1 => 'tier1',
        $level === 2 => 'tier2',
        default => 'leaf',
    };

    $childrenCount = $struktur->children->count();
    $hasChildren = $childrenCount > 0;
    $childrenId = 'oc-children-' . $struktur->id;
@endphp

@once
<style>
    /* ===================== Variabel warna org chart ===================== */
    .oc-tree {
        --oc-root: var(--primary, #1d4e89);
        --oc-tier1: var(--secondary, #2f5bb7);
        --oc-tier2: #2a8fd6;
        --oc-leaf: #4caf6e;
        --oc-line: #d1d5db;
    }
    .dark .oc-tree { --oc-line: #4b5563; }

    /* ===================== Wrapper pohon ===================== */
    .oc-node {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    /* ===================== Kartu ===================== */
    /* Lebar mengikuti konten (auto), dibatasi min/max agar tetap rapi.
       Teks tidak dipotong (ellipsis) — dibiarkan wrap ke baris baru bila
       melebihi max-width, sehingga tidak ada data yang hilang dari tampilan. */
    .oc-card {
        position: relative;
        z-index: 2;
        display: inline-grid;
        grid-template-columns: auto 1fr;
        grid-template-rows: auto auto;
        width: max-content;
        min-width: 190px;
        max-width: 300px;
        background: var(--white, #fff);
        border: 1px solid var(--oc-line);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .dark .oc-card { background: #1f2937; }
    .oc-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px -10px rgba(15, 23, 42, 0.18);
        z-index: 3;
    }
    .oc-card--root { min-width: 260px; max-width: 400px; }
    .oc-card--leaf { min-width: 190px; max-width: 300px; }

    /* Titik status aktif/nonaktif */
    .oc-status {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        border: 2px solid var(--white, #fff);
        z-index: 4;
    }
    .oc-status--active { background: #10b981; }
    .oc-status--inactive { background: #9ca3af; }

    /* ===================== Foto ===================== */
    .oc-photo {
        grid-row: 1 / 3;
        width: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f4f9;
        border-right: 1px solid var(--oc-line);
        flex-shrink: 0;
    }
    .dark .oc-photo { background: #111827; }
    .oc-card--root .oc-photo { width: 74px; }
    .oc-photo img {
        width: 40px; height: 40px; border-radius: 50%;
        object-fit: cover; flex-shrink: 0;
    }
    .oc-card--root .oc-photo img { width: 52px; height: 52px; }
    .oc-photo svg { width: 24px; height: 24px; color: #9ca3af; }
    .oc-card--root .oc-photo svg { width: 30px; height: 30px; }

    /* ===================== Label & Nama ===================== */
    .oc-info { display: flex; flex-direction: column; min-width: 0; }
    .oc-label {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        color: #fff;
        padding: 8px 12px;
        white-space: normal;
        overflow-wrap: break-word;
        word-break: break-word;
        line-height: 1.35;
    }
    .oc-label--root { background: var(--oc-root); font-size: 13px; padding: 12px 14px; }
    .oc-label--tier1 { background: var(--oc-tier1); }
    .oc-label--tier2 { background: var(--oc-tier2); }
    .oc-label--leaf { background: var(--oc-leaf); }

    .oc-name {
        font-family: 'Inter', sans-serif;
        font-style: italic;
        font-size: 13px;
        color: #1f2937;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        flex: 1;
        white-space: normal;
        overflow-wrap: break-word;
        word-break: break-word;
        line-height: 1.35;
    }
    .dark .oc-name { color: #f3f4f6; }
    .oc-card--root .oc-name { font-size: 14px; padding: 10px 14px; }

    /* ===================== Connector (garis + tombol toggle) ===================== */
    .oc-connector {
        position: relative;
        width: 1px;
        height: 34px;
        background: var(--oc-line);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .oc-toggle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid var(--oc-line);
        background: var(--white, #fff);
        color: #6b7280;
        font-size: 13px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        transition: transform 0.2s ease, color 0.2s ease, border-color 0.2s ease;
    }
    .dark .oc-toggle { background: #1f2937; }
    .oc-toggle:hover { color: var(--oc-root); border-color: var(--oc-root); transform: scale(1.1); }

    /* ===================== Baris children ===================== */
    .oc-children {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
        gap: 24px 32px;
        position: relative;
        padding-top: 34px;
    }

    /* garis horizontal (bus) — hanya jika lebih dari satu anak */
    .oc-children--multi::before {
        content: '';
        position: absolute;
        top: 0;
        left: 8%;
        right: 8%;
        height: 1px;
        background: var(--oc-line);
    }

    /* garis vertikal dari bus/garis parent turun ke tiap anak */
    .oc-children > .oc-node::before {
        content: '';
        position: absolute;
        top: -34px;
        left: 50%;
        width: 1px;
        height: 34px;
        background: var(--oc-line);
        transform: translateX(-50%);
    }

    .oc-hidden { display: none !important; }

    /* ===================== Responsif ===================== */
    @media (max-width: 640px) {
        .oc-children { gap: 16px 20px; padding-top: 24px; }
        .oc-children > .oc-node::before { top: -24px; height: 24px; }
        .oc-connector { height: 24px; }
        .oc-card { min-width: 160px; }
        .oc-card--root { min-width: 220px; }
    }
</style>

<script>
(function () {
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.oc-toggle');
        if (!btn) return;

        var targetId = btn.getAttribute('data-target');
        var target = document.getElementById(targetId);
        if (!target) return;

        var willHide = !target.classList.contains('oc-hidden');
        target.classList.toggle('oc-hidden', willHide);
        btn.textContent = willHide ? '+' : '\u2212';
    });
})();
</script>
@endonce

<div class="oc-tree oc-node">
    {{-- Kartu anggota --}}
    <div class="oc-card oc-card--{{ $levelKey }}">
        <span class="oc-status {{ $struktur->is_active ? 'oc-status--active' : 'oc-status--inactive' }}"></span>

        <div class="oc-photo">
            @if($struktur->foto)
                <img src="{{ asset('storage/struktur_organisasi/' . $struktur->foto) }}" alt="{{ $struktur->nama }}">
            @else
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>
                </svg>
            @endif
        </div>

        <div class="oc-info">
            <span class="oc-label oc-label--{{ $levelKey }}">{{ $struktur->jabatan }}</span>
            <span class="oc-name">{{ $struktur->nama }}</span>
        </div>
    </div>

    {{-- Children (rekursif) --}}
    @if($hasChildren)
        <div class="oc-connector">
            <button type="button" class="oc-toggle" data-target="{{ $childrenId }}" aria-label="Perluas/tutup">&minus;</button>
        </div>
        <div class="oc-children {{ $childrenCount > 1 ? 'oc-children--multi' : '' }}" id="{{ $childrenId }}">
            @foreach($struktur->children as $child)
                <x-admin.struktur.organization-node :struktur="$child" :level="$level + 1" />
            @endforeach
        </div>
    @endif
</div>