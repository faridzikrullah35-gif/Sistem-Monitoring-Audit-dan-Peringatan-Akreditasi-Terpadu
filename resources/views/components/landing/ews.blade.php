{{-- resources/views/components/landing/ews.blade.php --}}
<section class="section-padding" id="ews" style="background: linear-gradient(135deg, #fef2f2, #ffffff);">
    <div class="container text-center reveal">
        <span class="section-label" style="color: #dc2626;">Peringatan Dini</span>
        <h2 class="section-title">Early Warning System <span>Akreditasi</span></h2>
        <p class="section-desc mx-auto" style="max-width: 700px;">
            Pantau status akreditasi program studi secara real-time. Dapatkan notifikasi dini 
            jika ada indikator yang perlu perhatian, sehingga tindakan perbaikan bisa segera dilakukan.
        </p>
        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 30px;">
            <a href="{{ route('ews.index') }}" class="btn btn-danger">
                <i class="fas fa-arrow-right"></i> Cek Status Akreditasi
            </a>
        </div>
        {{-- EWS Preview Card --}}
        <div style="margin-top: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; max-width: 800px; margin-left: auto; margin-right: auto;">
            <div style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-left: 4px solid #22c55e;">
                <h4 style="font-size:14px; color:#22c55e;"><i class="fas fa-check-circle"></i> Aman</h4>
                <p style="font-size:12px; color:var(--text-light);">12 Prodi</p>
            </div>
            <div style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-left: 4px solid #eab308;">
                <h4 style="font-size:14px; color:#eab308;"><i class="fas fa-clock"></i> Perhatian</h4>
                <p style="font-size:12px; color:var(--text-light);">3 Prodi</p>
            </div>
            <div style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-left: 4px solid #dc2626;">
                <h4 style="font-size:14px; color:#dc2626;"><i class="fas fa-times-circle"></i> Kritis</h4>
                <p style="font-size:12px; color:var(--text-light);">1 Prodi</p>
            </div>
        </div>
    </div>
</section>