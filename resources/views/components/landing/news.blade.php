{{-- resources/views/components/landing/news.blade.php --}}
@props(['beritas'])

<section class="section-padding" id="berita" style="background: var(--white);">
    <div class="container">

        {{-- HEADER --}}
        <div class="text-center reveal">
            <span class="section-label">Berita & Artikel</span>
            <h2 class="section-title">Informasi <span>Terbaru</span></h2>
            <p class="section-desc mx-auto">Update kegiatan, pencapaian, dan pengumuman dari LPM UM Banjarmasin.</p>
        </div>

        {{-- DAFTAR BERITA --}}
        <div class="berita-grid">
            @forelse($beritas as $key => $berita)
                @php
                    $filePath = $berita->file ?? '';
                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    $icon = match ($extension) {
                        'pdf' => 'fa-file-pdf',
                        'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' => 'fa-image',
                        default => 'fa-file-alt',
                    };
                    $thumbnailUrl = !empty($berita->thumbnail) ? asset('storage/' . ltrim($berita->thumbnail, '/')) : null;
                    $judul = trim($berita->nama_file ?? 'Berita LPM UM Banjarmasin');
                @endphp

                <article class="berita-card reveal" style="transition-delay: {{ $key * 0.1 }}s;">
                    {{-- THUMBNAIL --}}
                    <div class="berita-thumb">
                        @if($thumbnailUrl)
                            <img src="{{ $thumbnailUrl }}" alt="{{ $judul }}" loading="lazy" onerror="this.style.display='none'; this.parentElement.querySelector('.berita-thumb-fallback').style.display='flex';">
                            <div class="berita-thumb-fallback" style="display: none;" aria-hidden="true"><i class="fas {{ $icon }}"></i></div>
                        @else
                            <div class="berita-thumb-fallback" aria-hidden="true"><i class="fas {{ $icon }}"></i></div>
                        @endif
                    </div>

                    {{-- CONTENT --}}
                    <div class="berita-body">
                        <span class="berita-date"><i class="far fa-calendar-alt"></i> {{ $berita->created_at?->translatedFormat('d F Y') }}</span>
                        <h4 title="{{ $judul }}" class="berita-title">{{ $judul }}</h4>
                        <p class="berita-file-info">
                            <i class="fas fa-paperclip"></i> Dokumentasi berita
                            @if($extension) <span class="berita-file-separator">•</span> <span>{{ strtoupper($extension) }}</span> @endif
                        </p>
                        <button type="button" class="berita-read-more berita-preview-btn" data-preview-url="{{ route('setting-landing-page.preview', $berita->id) }}" data-title="{{ $judul }}" aria-label="Baca selengkapnya: {{ $judul }}">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>
            @empty
                <div class="berita-empty reveal">
                    <div class="berita-empty-icon"><i class="far fa-newspaper"></i></div>
                    <h4>Belum Ada Berita</h4>
                    <p>Informasi terbaru dari LPM UM Banjarmasin akan ditampilkan di sini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- MODAL PREVIEW BERITA --}}
<div id="beritaPreviewModal" class="berita-preview-modal" aria-hidden="true">
    <div class="berita-preview-backdrop" data-close-preview></div>
    <div class="berita-preview-dialog" role="dialog" aria-modal="true" aria-labelledby="beritaPreviewTitle">
        <header class="berita-preview-header">
            <div class="berita-preview-heading">
                <div class="berita-preview-icon"><i id="beritaPreviewIcon" class="fas fa-file"></i></div>
                <div class="berita-preview-heading-text">
                    <span class="berita-preview-label">Berita & Artikel</span>
                    <h3 id="beritaPreviewTitle">Preview Berita</h3>
                </div>
            </div>
            <button type="button" class="berita-preview-close" data-close-preview aria-label="Tutup preview">
                <i class="fas fa-times"></i>
            </button>
        </header>
        <div class="berita-preview-content">
            <div id="beritaPreviewLoading" class="berita-preview-loading">
                <div class="berita-preview-spinner"></div>
                <span>Memuat berita...</span>
            </div>
            <div id="beritaPdfViewer" class="berita-pdf-viewer" hidden></div>
            <div id="beritaImageViewer" class="berita-image-viewer" hidden>
                <img id="beritaImageViewerImg" alt="">
            </div>
        </div>
    </div>
</div>

<style>
    .berita-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 30px; margin-top: 48px; }
    .berita-card { overflow: hidden; background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); transition: var(--transition); }
    .berita-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(15, 76, 129, 0.10); }
    .berita-thumb { position: relative; width: 100%; height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden; background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
    .berita-thumb img { width: 100%; height: 100%; display: block; object-fit: cover; transition: transform 0.4s ease; }
    .berita-card:hover .berita-thumb img { transform: scale(1.05); }
    .berita-thumb-fallback { position: absolute; inset: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 48px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
    .berita-body { padding: 24px; }
    .berita-date { display: inline-flex; align-items: center; gap: 6px; color: var(--text-light); font-size: 13px; font-weight: 500; }
    .berita-title { display: -webkit-box; min-height: 81px; margin: 8px 0 10px; overflow: hidden; font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; line-height: 1.5; -webkit-box-orient: vertical; -webkit-line-clamp: 3; }
    .berita-file-info { display: flex; align-items: center; flex-wrap: wrap; gap: 6px; margin-bottom: 14px; color: var(--text-light); font-size: 13px; }
    .berita-file-info i { color: var(--primary); }
    .berita-file-separator { opacity: 0.6; }
    .berita-read-more { display: inline-flex; align-items: center; gap: 6px; padding: 0; border: 0; background: transparent; color: var(--primary); font-family: inherit; font-size: 14px; font-weight: 600; cursor: pointer; transition: gap 0.2s ease, color 0.2s ease; }
    .berita-read-more:hover { gap: 12px; }
    .berita-read-more:focus-visible { outline: 2px solid var(--primary); outline-offset: 4px; border-radius: 4px; }
    .berita-empty { grid-column: 1 / -1; padding: 60px 20px; text-align: center; background: #f8fafc; border-radius: var(--radius); }
    .berita-empty-icon { width: 72px; height: 72px; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; border-radius: 50%; background: #dbeafe; color: var(--primary); font-size: 30px; }
    .berita-empty h4 { margin-bottom: 6px; font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; }
    .berita-empty p { color: var(--text-light); font-size: 14px; }

    .berita-preview-modal { position: fixed; inset: 0; z-index: 99999; display: none; align-items: center; justify-content: center; padding: 24px; }
    .berita-preview-modal.active { display: flex; }
    .berita-preview-backdrop { position: absolute; inset: 0; background: rgba(15, 23, 42, 0.72); backdrop-filter: blur(6px); }
    .berita-preview-dialog { position: relative; z-index: 2; width: min(1100px, 100%); height: min(90vh, 900px); display: flex; flex-direction: column; overflow: hidden; background: var(--white); border-radius: 18px; box-shadow: 0 30px 80px rgba(0, 0, 0, 0.25); opacity: 0; transform: translateY(20px) scale(0.98); transition: opacity 0.25s ease, transform 0.25s ease; }
    .berita-preview-modal.active .berita-preview-dialog { opacity: 1; transform: translateY(0) scale(1); }
    .berita-preview-header { min-height: 76px; display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 14px 20px; background: var(--white); border-bottom: 1px solid #e5e7eb; }
    .berita-preview-heading { min-width: 0; display: flex; align-items: center; gap: 12px; }
    .berita-preview-icon { width: 44px; height: 44px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: #dbeafe; color: var(--primary); font-size: 20px; }
    .berita-preview-heading-text { min-width: 0; }
    .berita-preview-label { display: block; margin-bottom: 3px; color: var(--text-light); font-size: 11px; font-weight: 600; line-height: 1.2; letter-spacing: 0.05em; text-transform: uppercase; }
    .berita-preview-header h3 { max-width: 700px; margin: 0; overflow: hidden; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; line-height: 1.4; text-overflow: ellipsis; white-space: nowrap; }
    .berita-preview-close { width: 40px; height: 40px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; padding: 0; border: 0; border-radius: 10px; background: #f1f5f9; color: #475569; cursor: pointer; font-size: 17px; transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease; }
    .berita-preview-close:hover { background: #e2e8f0; color: #0f172a; transform: rotate(90deg); }
    .berita-preview-content { position: relative; flex: 1; min-height: 0; overflow: auto; background: #525252; }
    .berita-pdf-viewer { width: 100%; min-height: 100%; padding: 28px 20px 40px; }
    .berita-pdf-page { display: block; width: min(850px, 100%); height: auto; margin: 0 auto 24px; background: white; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.20); }
    .berita-image-viewer { width: 100%; min-height: 100%; display: flex; align-items: center; justify-content: center; padding: 28px 20px; }
    .berita-image-viewer img { max-width: 100%; max-height: 80vh; object-fit: contain; border-radius: 6px; background: white; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.20); }
    .berita-preview-loading { position: absolute; inset: 0; z-index: 5; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; background: #f8fafc; color: var(--text-light); font-size: 14px; }
    .berita-preview-spinner { width: 34px; height: 34px; border: 3px solid #dbeafe; border-top-color: var(--primary); border-radius: 50%; animation: beritaPreviewSpin 0.8s linear infinite; }
    @keyframes beritaPreviewSpin { to { transform: rotate(360deg); } }
    body.berita-preview-open { overflow: hidden; }
    @media (max-width: 1024px) { .berita-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 768px) {
        .berita-grid { grid-template-columns: 1fr; }
        .berita-thumb { height: 220px; }
        .berita-preview-modal { padding: 10px; }
        .berita-preview-dialog { width: 100%; height: 94vh; border-radius: 14px; }
        .berita-preview-header { min-height: 66px; padding: 10px 12px; }
        .berita-preview-icon { width: 38px; height: 38px; font-size: 17px; }
        .berita-preview-header h3 { max-width: 230px; font-size: 14px; }
        .berita-pdf-viewer { padding: 15px 8px 25px; }
        .berita-pdf-page { margin-bottom: 15px; }
        .berita-image-viewer { padding: 15px 8px; }
    }
</style>

{{-- PDF.JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.10.38/pdf.min.mjs" type="module"></script>

<script type="module">
    import * as pdfjsLib from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.10.38/pdf.min.mjs';

    const modal = document.getElementById('beritaPreviewModal');
    const pdfViewer = document.getElementById('beritaPdfViewer');
    const imageViewer = document.getElementById('beritaImageViewer');
    const imageViewerImg = document.getElementById('beritaImageViewerImg');
    const loading = document.getElementById('beritaPreviewLoading');
    const title = document.getElementById('beritaPreviewTitle');
    const icon = document.getElementById('beritaPreviewIcon');

    if (!modal || !pdfViewer || !imageViewer || !imageViewerImg || !loading || !title || !icon) {
        console.warn('[Berita Preview] Elemen modal tidak ditemukan.');
    } else {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.10.38/pdf.worker.min.mjs';

        let currentObjectUrl = null;

        function resetViewers() {
            pdfViewer.innerHTML = '';
            pdfViewer.hidden = true;
            imageViewerImg.removeAttribute('src');
            imageViewerImg.alt = '';
            imageViewer.hidden = true;
            icon.className = 'fas fa-file';
            if (currentObjectUrl) {
                URL.revokeObjectURL(currentObjectUrl);
                currentObjectUrl = null;
            }
        }

        function base64ToBlob(base64, mime) {
            const byteCharacters = atob(base64);
            const byteNumbers = new Uint8Array(byteCharacters.length);
            for (let i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            return new Blob([byteNumbers], { type: mime });
        }

        async function renderPdf(blob) {
            const buffer = await blob.arrayBuffer();
            const pdf = await pdfjsLib.getDocument({ data: buffer }).promise;
            pdfViewer.hidden = false;
            icon.className = 'fas fa-file-pdf';
            for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                const page = await pdf.getPage(pageNumber);
                const viewport = page.getViewport({ scale: 1.5 });
                const canvas = document.createElement('canvas');
                canvas.className = 'berita-pdf-page';
                const context = canvas.getContext('2d');
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                pdfViewer.appendChild(canvas);
                await page.render({ canvasContext: context, viewport: viewport }).promise;
            }
        }

        function renderImage(blob, altText) {
            currentObjectUrl = URL.createObjectURL(blob);
            imageViewerImg.src = currentObjectUrl;
            imageViewerImg.alt = altText || 'Preview berita';
            imageViewer.hidden = false;
            icon.className = 'fas fa-image';
        }

        async function openPreview(previewUrl, beritaTitle) {
            title.textContent = beritaTitle || 'Preview Berita';
            resetViewers();
            loading.style.display = 'flex';
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('berita-preview-open');

            try {
                const response = await fetch(previewUrl, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);

                const payload = await response.json();
                if (!payload || !payload.data || !payload.mime) {
                    throw new Error('Response preview tidak valid.');
                }

                const blob = base64ToBlob(payload.data, payload.mime);

                if (payload.mime === 'application/pdf') {
                    await renderPdf(blob);
                } else if (payload.mime.startsWith('image/')) {
                    renderImage(blob, beritaTitle);
                } else {
                    throw new Error(`Tipe file tidak didukung: ${payload.mime}`);
                }

                loading.style.display = 'none';
            } catch (error) {
                console.error('[Berita Preview]', error);
                closePreview();
            }
        }

        function closePreview() {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('berita-preview-open');
            setTimeout(() => {
                resetViewers();
                loading.style.display = 'flex';
            }, 250);
        }

        document.querySelectorAll('.berita-preview-btn').forEach(button => {
            button.addEventListener('click', function() {
                const previewUrl = this.dataset.previewUrl;
                const beritaTitle = this.dataset.title || 'Preview Berita';
                if (!previewUrl) return;
                openPreview(previewUrl, beritaTitle);
            });
        });

        modal.querySelectorAll('[data-close-preview]').forEach(element => {
            element.addEventListener('click', closePreview);
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && modal.classList.contains('active')) {
                closePreview();
            }
        });

        window.addEventListener('beforeunload', () => {
            if (currentObjectUrl) {
                URL.revokeObjectURL(currentObjectUrl);
                currentObjectUrl = null;
            }
        });
    }
</script>