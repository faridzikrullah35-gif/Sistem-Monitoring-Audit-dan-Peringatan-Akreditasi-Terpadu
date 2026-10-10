
<section class="cta-section" id="kontak">
    <div class="container">
        <div class="reveal">
            <h2>Siap Melaksanakan Audit Mutu Internal?</h2>
            <p>Kelola seluruh proses AMI secara digital, terstruktur, dan transparan dengan SIMANTAP.</p>
            <?php if(auth()->guard()->check()): ?>
                <!-- <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-white">
                    <i class="fas fa-th-large"></i> Buka Dashboard AMI
                </a> -->
            <?php else: ?>
                <!-- <a href="<?php echo e(route('login')); ?>" class="btn btn-white">
                    <i class="fas fa-sign-in-alt"></i> Masuk ke Sistem AMI SIMANTAP
                </a> -->
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .cta-section {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 80px 0; text-align: center; color: var(--white);
        position: relative; overflow: hidden;
    }
    .cta-section::before {
        content: ''; position: absolute; top: -50%; right: -20%;
        width: 500px; height: 500px; background: rgba(255,255,255,0.04); border-radius: 50%;
    }
    .cta-section .container { position: relative; z-index: 1; }
    .cta-section h2 { font-family: 'Poppins', sans-serif; font-size: 40px; font-weight: 800; margin-bottom: 12px; }
    .cta-section p { font-size: 18px; opacity: 0.85; margin-bottom: 32px; max-width: 540px; margin-left: auto; margin-right: auto; }
    .cta-section .btn-white { padding: 16px 44px; font-size: 16px; }
    @media (max-width: 768px) { .cta-section h2 { font-size: 28px; } }
</style><?php /**PATH F:\Project-2\audit-app\resources\views/components/landing/cta.blade.php ENDPATH**/ ?>