{{-- resources/views/components/landing/mitra.blade.php --}}
<section class="section-padding" id="mitra" style="background: var(--white);">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-label">Mitra Kami</span>
            <h2 class="section-title">Lembaga <span>Akreditasi</span></h2>
            <p class="section-desc mx-auto">Bekerja sama dengan lembaga akreditasi nasional dan internasional terpercaya.</p>
        </div>
        <div class="mitra-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap:30px; margin-top:40px; align-items:center;">
            <img src="{{ asset('images/mitra/banpt.png') }}" alt="BAN-PT" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/lamteknik.png') }}" alt="LAM Teknik" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/lamptkes.png') }}" alt="LAM-PTKes" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/lamemba.png') }}" alt="LAMEMBA" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/lamdik.png') }}" alt="LAMDIK" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/laminfokom.png') }}" alt="LAMINFOKOM" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/fibaa.png') }}" alt="FIBAA" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/asiin.png') }}" alt="ASIIN" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
            <img src="{{ asset('images/mitra/iabee.png') }}" alt="IABEE" style="max-width:100px; margin:0 auto; filter:grayscale(100%); opacity:0.7; transition: var(--transition);" onerror="this.style.display='none'">
        </div>
    </div>
</section>

<style>
    .mitra-grid img:hover { filter: grayscale(0%) !important; opacity: 1 !important; transform: scale(1.05); }
</style>