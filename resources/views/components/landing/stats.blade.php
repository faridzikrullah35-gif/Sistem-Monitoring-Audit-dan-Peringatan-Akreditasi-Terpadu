{{-- resources/views/components/landing/stats.blade.php --}}

{{-- STATISTIK ROW 1: Akreditasi Nasional (DINAMIS) --}}
<section class="statistik">
    <div class="container">
        <div class="text-center reveal" style="margin-bottom: 10px;">
            <span class="section-label">Akreditasi Nasional</span>
        </div>
        <div class="stat-grid">
            @forelse($nasionalStats as $nama => $jumlah)
                <div class="stat-item reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="number">
                        <span class="counter" data-target="{{ $jumlah }}">0</span>
                        <span class="suffix"></span>
                    </div>
                    <p class="label">{{ $nama }}</p>
                </div>
            @empty
                <div class="stat-item reveal">
                    <div class="number"><span>0</span></div>
                    <p class="label">Belum ada data</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- STATISTIK ROW 2: Akreditasi Internasional (DINAMIS) --}}
<section class="statistik" style="border-top: none; background: var(--white);">
    <div class="container">
        <div class="text-center reveal" style="margin-bottom: 10px;">
            <span class="section-label">Akreditasi Internasional</span>
        </div>
        <div class="stat-grid">
            @forelse($internasionalStats as $nama => $jumlah)
                <div class="stat-item reveal" style="transition-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="number">
                        <span class="counter" data-target="{{ $jumlah }}">0</span>
                        <span class="suffix"></span>
                    </div>
                    <p class="label">{{ $nama }}</p>
                </div>
            @empty
                <div class="stat-item reveal">
                    <div class="number"><span>0</span></div>
                    <p class="label">Belum ada data</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- CSS --}}
<style>
    .statistik { 
        background: var(--white); 
        border-bottom: 1px solid rgba(0,0,0,0.04); 
    }
    
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        padding: 30px 0 40px;
    }
    
    .stat-item { 
        text-align: center; 
        padding: 10px; 
    }
    
    .stat-item .number {
        font-family: 'Poppins', sans-serif;
        font-size: 38px; 
        font-weight: 800; 
        color: var(--primary); 
        line-height: 1.2;
    }
    
    .stat-item .number .suffix { 
        font-size: 24px; 
    }
    
    .stat-item .label { 
        font-size: 14px; 
        color: var(--text-light); 
        font-weight: 500; 
        margin-top: 4px;
        word-wrap: break-word;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stat-grid { 
            grid-template-columns: repeat(3, 1fr); 
            gap: 12px; 
        }
        .stat-item .number { 
            font-size: 28px; 
        }
    }
    
    @media (max-width: 480px) {
        .stat-grid { 
            grid-template-columns: repeat(2, 1fr); 
            gap: 8px; 
        }
        .stat-item { 
            padding: 8px; 
        }
        .stat-item .number { 
            font-size: 22px; 
        }
    }
</style>