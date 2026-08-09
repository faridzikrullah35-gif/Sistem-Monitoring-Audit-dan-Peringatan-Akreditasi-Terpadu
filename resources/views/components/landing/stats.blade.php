{{-- resources/views/components/landing/stats.blade.php --}}
{{-- STATISTIK ROW 1: Akreditasi Nasional --}}
<section class="statistik">
    <div class="container">
        <div class="text-center reveal" style="margin-bottom: 10px;">
            <span class="section-label">Akreditasi Nasional</span>
        </div>
        <div class="stat-grid">
            <div class="stat-item reveal">
                <div class="number"><span class="counter" data-target="36">0</span><span class="suffix"></span></div>
                <p class="label">Unggul</p>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.1s;">
                <div class="number"><span class="counter" data-target="1">0</span><span class="suffix"></span></div>
                <p class="label">Peringkat A</p>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.2s;">
                <div class="number"><span class="counter" data-target="6">0</span><span class="suffix"></span></div>
                <p class="label">Baik Sekali</p>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.3s;">
                <div class="number"><span class="counter" data-target="4">0</span><span class="suffix"></span></div>
                <p class="label">Peringkat Baik/B</p>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.4s;">
                <div class="number"><span class="counter" data-target="23">0</span><span class="suffix"></span></div>
                <p class="label">Prodi Baru</p>
            </div>
        </div>
    </div>
</section>

{{-- STATISTIK ROW 2: Akreditasi Internasional --}}
<section class="statistik" style="border-top: none; background: var(--white);">
    <div class="container">
        <div class="text-center reveal" style="margin-bottom: 10px;">
            <span class="section-label">Akreditasi Internasional</span>
        </div>
        <div class="stat-grid">
            <div class="stat-item reveal">
                <div class="number"><span class="counter" data-target="9">0</span><span class="suffix"></span></div>
                <p class="label">FIBAA</p>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.1s;">
                <div class="number"><span class="counter" data-target="5">0</span><span class="suffix"></span></div>
                <p class="label">ASIIN</p>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.2s;">
                <div class="number"><span class="counter" data-target="1">0</span><span class="suffix"></span></div>
                <p class="label">IABEE</p>
            </div>
            <div class="stat-item reveal" style="transition-delay:0.3s;">
                <div class="number"><span class="counter" data-target="4">0</span><span class="suffix"></span></div>
                <p class="label">AUN-QA</p>
            </div>
        </div>
    </div>
</section>

<style>
    .statistik { background: var(--white); border-bottom: 1px solid rgba(0,0,0,0.04); }
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 items for row 1, 4 for row 2 */
        gap: 20px;
        padding: 30px 0 40px;
    }
    .stat-item { text-align: center; padding: 10px; }
    .stat-item .number {
        font-family: 'Poppins', sans-serif;
        font-size: 38px; font-weight: 800; color: var(--primary); line-height: 1.2;
    }
    .stat-item .number .suffix { font-size: 24px; }
    .stat-item .label { font-size: 14px; color: var(--text-light); font-weight: 500; margin-top: 4px; }
    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .stat-item .number { font-size: 28px; }
    }
    @media (max-width: 480px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; }
        .stat-item { padding: 8px; }
        .stat-item .number { font-size: 22px; }
    }
</style>