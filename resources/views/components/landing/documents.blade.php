{{-- resources/views/components/landing/documents.blade.php --}}
<section class="section-padding" id="dokumen" style="background: var(--bg);">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-label">Dokumen Mutu</span>
            <h2 class="section-title">Unduh <span>Dokumen</span></h2>
            <p class="section-desc mx-auto">Akses dokumen standar, SOP, dan panduan mutu secara digital.</p>
        </div>

        <div class="dokumen-grid">
            <div class="dokumen-card reveal"><div class="icon"><i class="fas fa-book"></i></div><h4>Manual Mutu</h4><a href="#" class="dl-btn"><i class="fas fa-download"></i> Download PDF</a></div>
            <div class="dokumen-card reveal" style="transition-delay:0.1s;"><div class="icon"><i class="fas fa-file-pdf"></i></div><h4>SOP Audit AMI</h4><a href="#" class="dl-btn"><i class="fas fa-download"></i> Download</a></div>
            <div class="dokumen-card reveal" style="transition-delay:0.2s;"><div class="icon"><i class="fas fa-scroll"></i></div><h4>Standar SPMI</h4><a href="#" class="dl-btn"><i class="fas fa-download"></i> Download</a></div>
            <div class="dokumen-card reveal" style="transition-delay:0.3s;"><div class="icon"><i class="fas fa-clipboard-check"></i></div><h4>Pedoman AMI</h4><a href="#" class="dl-btn"><i class="fas fa-download"></i> Download</a></div>
        </div>
    </div>
</section>

<style>
    .dokumen-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; margin-top: 48px; }
    .dokumen-card { background: var(--white); border-radius: var(--radius); padding: 28px 20px; text-align: center; transition: var(--transition); border: 1px solid rgba(0,0,0,0.04); }
    .dokumen-card:hover { transform: translateY(-4px); border-color: var(--primary); box-shadow: 0 12px 30px rgba(15,76,129,0.06); }
    .dokumen-card .icon { font-size: 40px; color: var(--primary); margin-bottom: 10px; }
    .dokumen-card h4 { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; }
    .dokumen-card .dl-btn { display: inline-flex; align-items: center; gap: 6px; margin-top: 10px; font-size: 14px; font-weight: 600; color: var(--secondary); transition: var(--transition); }
    .dokumen-card .dl-btn:hover { color: var(--primary); gap: 10px; }
</style>