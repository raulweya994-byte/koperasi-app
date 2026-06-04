@extends('layouts.app')
@section('title', 'Detail Berita')

@section('content')
<div class="container-fluid">
    {{-- Back Button --}}
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('petugas.berita.index') }}" class="btn btn-secondary" style="border-radius:8px">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    {{-- Berita Detail --}}
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-sm" style="border-radius:16px;border:none;overflow:hidden">
                {{-- Thumbnail --}}
                @if($berita->thumbnail)
                <div style="position:relative;background:#000">
                    <img src="{{ asset('storage/'.$berita->thumbnail) }}" 
                         alt="{{ $berita->judul }}" 
                         class="img-fluid w-100 thumbnail-image"
                         style="max-height:500px;object-fit:contain;cursor:pointer"
                         onclick="openLightbox(this.src)">
                    <div style="position:absolute;top:20px;right:20px;z-index:10">
                        <span class="badge badge-success text-white" style="font-size:14px;padding:10px 20px;border-radius:25px;box-shadow:0 4px 8px rgba(0,0,0,0.2)">
                            <i class="fas fa-tag mr-2"></i>{{ strtoupper($berita->kategori) }}
                        </span>
                    </div>
                    <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top, rgba(0,0,0,0.9), transparent);padding:40px 30px;z-index:10">
                        <h2 class="text-white font-weight-bold mb-2" style="text-shadow:2px 2px 4px rgba(0,0,0,0.5)">{{ $berita->judul }}</h2>
                        <p class="text-white mb-0" style="opacity:0.9;font-size:14px">
                            <i class="fas fa-expand-alt mr-2"></i>Klik foto untuk memperbesar
                        </p>
                    </div>
                </div>
                @else
                <div style="background:linear-gradient(135deg,#10b981,#059669);padding:60px 30px;position:relative">
                    <div style="position:absolute;top:20px;right:20px">
                        <span class="badge badge-light" style="font-size:14px;padding:10px 20px;border-radius:25px">
                            <i class="fas fa-tag mr-2"></i>{{ strtoupper($berita->kategori) }}
                        </span>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-newspaper fa-4x text-white mb-3" style="opacity:0.5"></i>
                        <h2 class="text-white font-weight-bold mb-0">{{ $berita->judul }}</h2>
                    </div>
                </div>
                @endif

                {{-- Meta Info --}}
                <div class="card-body" style="background:#f8f9fa;border-bottom:1px solid #e5e7eb;padding:20px 30px">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-2 mb-md-0">
                            <div class="d-flex align-items-center">
                                <i class="far fa-user text-success mr-2"></i>
                                <div>
                                    <small class="text-muted d-block" style="font-size:11px">Penulis</small>
                                    <strong style="font-size:14px">{{ $berita->createdBy->name ?? 'Admin' }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 mb-md-0">
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar text-success mr-2"></i>
                                <div>
                                    <small class="text-muted d-block" style="font-size:11px">Dipublikasikan</small>
                                    <strong style="font-size:14px">{{ $berita->published_at ? $berita->published_at->format('d M Y, H:i') : '-' }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="far fa-eye text-success mr-2"></i>
                                <div>
                                    <small class="text-muted d-block" style="font-size:11px">Dibaca</small>
                                    <strong style="font-size:14px">{{ $berita->views ?? 0 }} kali</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="card-body p-4" style="padding:40px !important">
                    <div class="berita-content">
                        {!! nl2br(e($berita->konten)) !!}
                    </div>
                </div>

                {{-- Footer --}}
                <div class="card-footer" style="background:#f8f9fa;border-top:1px solid #e5e7eb;padding:20px 30px">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mb-2 mb-md-0">
                            <small class="text-muted">
                                <i class="far fa-clock mr-1"></i>
                                Terakhir diupdate: {{ $berita->updated_at->format('d M Y, H:i') }}
                            </small>
                        </div>
                        <a href="{{ route('petugas.berita.index') }}" class="btn btn-success text-white" style="border-radius:8px">
                            <i class="fas fa-list mr-2"></i>Lihat Semua Berita
                        </a>
                    </div>
                </div>
            </div>

            {{-- Share Section (Optional) --}}
            <div class="card shadow-sm mt-4" style="border-radius:16px;border:none">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-3">
                        <i class="fas fa-share-alt text-success mr-2"></i>Bagikan Berita
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" style="border-radius:8px" onclick="shareToFacebook()">
                            <i class="fab fa-facebook-f mr-1"></i>Facebook
                        </button>
                        <button class="btn btn-outline-info" style="border-radius:8px" onclick="shareToTwitter()">
                            <i class="fab fa-twitter mr-1"></i>Twitter
                        </button>
                        <button class="btn btn-outline-success" style="border-radius:8px" onclick="shareToWhatsApp()">
                            <i class="fab fa-whatsapp mr-1"></i>WhatsApp
                        </button>
                        <button class="btn btn-outline-secondary" style="border-radius:8px" onclick="copyLink()">
                            <i class="fas fa-link mr-1"></i>Salin Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()" style="display:none">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
    <div class="lightbox-caption" id="lightbox-caption"></div>
</div>

<style>
.thumbnail-image {
    transition: transform 0.3s ease;
}

.thumbnail-image:hover {
    transform: scale(1.02);
}

/* Lightbox Styles */
.lightbox {
    position: fixed;
    z-index: 9999;
    padding-top: 50px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.95);
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.lightbox-content {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 85vh;
    object-fit: contain;
    animation: zoomIn 0.3s;
}

@keyframes zoomIn {
    from { transform: scale(0.8); }
    to { transform: scale(1); }
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 40px;
    color: #fff;
    font-size: 50px;
    font-weight: bold;
    transition: 0.3s;
    cursor: pointer;
    z-index: 10000;
}

.lightbox-close:hover,
.lightbox-close:focus {
    color: #f59e0b;
}

.lightbox-caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #fff;
    padding: 20px;
    font-size: 16px;
}

.berita-content {
    font-size: 17px;
    line-height: 1.9;
    color: #374151;
}

.berita-content p {
    margin-bottom: 1.5rem;
}

.berita-content h1,
.berita-content h2,
.berita-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #1f2937;
    font-weight: 700;
}

.berita-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 1.5rem 0;
    cursor: pointer;
    transition: transform 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.berita-content img:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.berita-content blockquote {
    border-left: 4px solid #10b981;
    padding-left: 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
}
</style>

@push('scripts')
<script>
// Lightbox Functions
function openLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const caption = document.getElementById('lightbox-caption');
    
    lightbox.style.display = 'block';
    lightboxImg.src = src;
    caption.innerHTML = '{{ $berita->judul }}';
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
    
    // Restore body scroll
    document.body.style.overflow = 'auto';
}

// Close lightbox with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});

// Make all images in content clickable
document.addEventListener('DOMContentLoaded', function() {
    const contentImages = document.querySelectorAll('.berita-content img');
    contentImages.forEach(img => {
        img.style.cursor = 'pointer';
        img.onclick = function() {
            openLightbox(this.src);
        };
    });
});

// Share Functions
function shareToFacebook() {
    const url = encodeURIComponent(window.location.href);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
}

function shareToTwitter() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('{{ $berita->judul }}');
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
}

function shareToWhatsApp() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('{{ $berita->judul }} - ');
    window.open(`https://wa.me/?text=${text}${url}`, '_blank');
}

function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        // Show success message
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check mr-1"></i>Tersalin!';
        btn.classList.remove('btn-outline-secondary');
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-secondary');
        }, 2000);
    }).catch(() => {
        alert('Gagal menyalin link');
    });
}
</script>
@endpush
@endsection
