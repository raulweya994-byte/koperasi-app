@extends('public.layouts.app')
@section('title','Beranda - DISPERINDAGKOP Tolikara')

@section('content')

{{-- ═══════════════════════════════════════════════
     CUSTOM STYLES — hanya untuk halaman beranda
════════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

/* ── FONT & BASE ────────────────────────────────── */
body {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: 15px;           /* ← lebih besar untuk mata */
    line-height: 1.8;
    color: #1e293b;
}

/* ── HERO ──────────────────────────────────────── */
.hero {
    min-height: 620px;
    padding: 130px 0 90px;
    position: relative;
}
.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(245,166,35,.12);
    border: 1px solid rgba(245,166,35,.35);
    color: var(--accent);
    font-size: 12px;           /* ← lebih besar */
    font-weight: 700;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    padding: 7px 18px;
    border-radius: 100px;
    margin-bottom: 22px;
}
.hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: 3.4rem;
    font-weight: 800;
    line-height: 1.15;
    color: #fff;
    margin-bottom: 18px;
}
.hero h1 em { font-style: italic; color: var(--accent); }
.hero-desc {
    font-size: 1.1rem;         /* ← lebih besar */
    color: rgba(255,255,255,.80); /* ← lebih terang */
    line-height: 1.85;
    margin-bottom: 38px;
    max-width: 490px;
}
.btn-hero-primary {
    background: var(--accent);
    color: #1a1a1a !important;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 14.5px;         /* ← lebih besar */
    padding: 15px 32px;
    border-radius: 8px;
    border: none;
    letter-spacing: .2px;
    transition: all .25s;
    box-shadow: 0 4px 20px rgba(245,166,35,.38);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.btn-hero-primary:hover {
    background: #ffb800;
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(245,166,35,.48);
}
.btn-hero-secondary {
    background: rgba(255,255,255,.08);
    color: rgba(255,255,255,.95) !important; /* ← lebih terang */
    border: 1.5px solid rgba(255,255,255,.35);
    padding: 15px 32px;
    border-radius: 8px;
    font-size: 14.5px;
    font-weight: 600;
    transition: all .25s;
    margin-left: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.btn-hero-secondary:hover {
    background: rgba(255,255,255,.18);
    border-color: rgba(255,255,255,.55);
}

/* Hero info card kanan */
.hero-info-card {
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,.16);
    border-radius: 24px;
    padding: 36px 30px;
}
.hero-info-card .card-logo {
    width: 72px; height: 72px;
    background: linear-gradient(135deg, var(--accent), #ffb800);
    border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px;
    box-shadow: 0 8px 24px rgba(245,166,35,.4);
}
.hero-info-card .card-logo i { font-size: 30px; color: #1a1a1a; }
.hero-info-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.18rem;
    color: #fff;
    margin-bottom: 22px;
    line-height: 1.55;
}
.hero-stat-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: rgba(255,255,255,.12);
    border-radius: 14px;
    overflow: hidden;
}
.hero-stat-cell {
    background: rgba(255,255,255,.07);
    padding: 18px 10px;
    text-align: center;
}
.hero-stat-cell strong {
    display: block;
    font-size: 2rem;           /* ← lebih besar */
    font-weight: 800;
    color: var(--accent);
    line-height: 1;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.hero-stat-cell span {
    font-size: 11px;           /* ← lebih besar */
    color: rgba(255,255,255,.65); /* ← lebih terang */
    margin-top: 6px;
    display: block;
    font-weight: 500;
}

/* ── STATS BAR ─────────────────────────────────── */
.stats-bar {
    background: #fff;
    padding: 0;
    border-top: 4px solid var(--accent);
    box-shadow: 0 6px 30px rgba(0,0,0,.08);
}
.stat-item {
    padding: 30px 16px;
    text-align: center;
    border-right: 1px solid #f0f2f7;
    transition: background .2s;
}
.stat-item:last-child { border-right: none; }
.stat-item:hover { background: #fafbff; }
.stat-item i { font-size: 1.6rem; color: var(--accent); margin-bottom: 8px; display: block; }
.stat-item .stat-num {
    font-size: 2.1rem;         /* ← lebih besar */
    font-weight: 800;
    color: var(--primary);
    display: block;
    line-height: 1;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.stat-item .stat-label {
    font-size: 12.5px;         /* ← lebih besar */
    color: #667;
    margin-top: 7px;
    font-weight: 600;
    letter-spacing: .3px;
}

/* ── SECTION GENERIC ───────────────────────────── */
.section { padding: 88px 0; }
.section-alt { background: #f5f7fc; }

.section-title { text-align: center; margin-bottom: 58px; }
.section-title .eyebrow {
    display: inline-block;
    font-size: 11px;           /* ← lebih besar */
    font-weight: 700;
    letter-spacing: 2.2px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 10px;
}
.section-title h2 {
    font-family: 'Playfair Display', serif;
    font-size: 2.4rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 14px;
    line-height: 1.22;
}
.section-title p {
    color: #5a6475;            /* ← lebih gelap = lebih mudah dibaca */
    font-size: 1rem;
    max-width: 480px;
    margin: 0 auto;
    line-height: 1.8;
}
.title-line {
    width: 48px; height: 3px;
    background: linear-gradient(90deg, var(--accent), #ffb800);
    margin: 16px auto 0;
    border-radius: 2px;
}

/* ── LAYANAN ───────────────────────────────────── */
.layanan-item {
    padding: 36px 30px;
    border-radius: 18px;
    background: #fff;
    border: 1.5px solid #eaecf3;
    transition: all .3s cubic-bezier(.22,.61,.36,1);
    height: 100%;
    position: relative;
    overflow: hidden;
}
.layanan-item::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .35s;
}
.layanan-item:hover {
    transform: translateY(-7px);
    box-shadow: 0 20px 50px rgba(26,58,110,.1);
    border-color: transparent;
}
.layanan-item:hover::after { transform: scaleX(1); }
.layanan-item .icon-wrap {
    width: 60px; height: 60px;
    border-radius: 15px;
    margin: 0 0 22px;
    display: flex; align-items: center; justify-content: center;
}
.layanan-item h5 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 12px;
    font-size: 1.1rem;         /* ← lebih besar */
}
.layanan-item p {
    font-size: 14px;           /* ← lebih besar */
    color: #5a6475;            /* ← lebih gelap */
    line-height: 1.8;
    margin: 0;
}

/* ── BERITA CARD ───────────────────────────────── */
.card-news {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
    transition: all .35s cubic-bezier(.22,.61,.36,1);
    overflow: hidden;
    height: 100%;
    background: #fff;
    display: flex;
    flex-direction: column;
    position: relative;
    cursor: pointer;
}
.card-news:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 20px 40px rgba(26,58,110,.15); 
}
.card-news .news-thumb {
    height: 380px;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
    background: linear-gradient(135deg, #667eea, #764ba2);
}
.card-news .news-thumb img { 
    width: 100%; 
    height: 100%; 
    object-fit: cover;
    object-position: center;
    transition: transform .5s ease-out;
    display: block;
}
.card-news:hover .news-thumb img { 
    transform: scale(1.1); 
}
.card-news .news-thumb .thumb-placeholder {
    height: 100%;
    width: 100%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex; 
    align-items: center; 
    justify-content: center;
}
.card-news .news-thumb .thumb-placeholder i {
    font-size: 64px;
    color: rgba(255,255,255,.3);
}

.card-news .news-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
    background: white;
}
.card-news h5 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #1a3a6e;
    margin-bottom: 12px;
    line-height: 1.4;
    transition: color .3s;
}
.card-news:hover h5 {
    color: #2d5aa0;
}
.card-news p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.7;
    flex: 1;
    margin-bottom: 16px;
}
.btn-baca {
    font-size: 14px;
    font-weight: 600;
    color: #1a3a6e;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all .3s;
}
.btn-baca:hover { 
    color: #f5a623; 
    transform: translateX(4px);
}
.btn-baca i { 
    font-size: 12px; 
    transition: transform .3s;
}
.btn-baca:hover i {
    transform: translateX(3px);
}

/* Responsive untuk berita */
@media(max-width:992px){
    .card-news .news-thumb { height: 320px; }
}
@media(max-width:768px){
    .card-news .news-thumb { height: 280px; }
    .card-news h5 { font-size: 16px; }
    .card-news p { font-size: 13px; }
}

/* ── GALERI ────────────────────────────────────── */
.galeri-card-item {
    position: relative;
    width: 100%;
    height: 350px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    transition: all 0.4s ease;
}

.galeri-card-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 45px rgba(0,0,0,0.2);
}

.galeri-card-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.6s ease;
}

.galeri-card-item:hover img {
    transform: scale(1.1);
}

.galeri-card-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.4), transparent);
    padding: 30px 25px;
    transform: translateY(0);
    transition: all 0.4s ease;
}

.galeri-card-content h4 {
    font-size: 20px;
    font-weight: 700;
    color: white;
    margin: 0;
    line-height: 1.4;
    text-shadow: 0 2px 10px rgba(0,0,0,0.5);
}

/* Carousel Controls untuk Galeri */
#galeriCarousel .carousel-control-prev,
#galeriCarousel .carousel-control-next {
    width: 55px;
    height: 55px;
    background: rgba(255,255,255,0.95);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: all 0.3s ease;
}

#galeriCarousel:hover .carousel-control-prev,
#galeriCarousel:hover .carousel-control-next {
    opacity: 1;
}

#galeriCarousel .carousel-control-prev {
    left: -25px;
}

#galeriCarousel .carousel-control-next {
    right: -25px;
}

#galeriCarousel .carousel-control-icon {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

#galeriCarousel .carousel-control-icon i {
    font-size: 22px;
    color: var(--primary);
}

#galeriCarousel .carousel-control-prev:hover,
#galeriCarousel .carousel-control-next:hover {
    background: var(--primary);
}

#galeriCarousel .carousel-control-prev:hover .carousel-control-icon i,
#galeriCarousel .carousel-control-next:hover .carousel-control-icon i {
    color: white;
}

/* Carousel Indicators untuk Galeri */
#galeriCarousel .carousel-indicators {
    bottom: -45px;
    margin-bottom: 0;
}

#galeriCarousel .carousel-indicators li {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(102, 126, 234, 0.3);
    border: none;
    margin: 0 6px;
    transition: all 0.3s ease;
}

#galeriCarousel .carousel-indicators li.active {
    width: 35px;
    border-radius: 6px;
    background: var(--primary);
}

/* Responsive Galeri */
@media(max-width:992px){
    .galeri-card-item {
        height: 300px;
    }
    
    .galeri-card-content h4 {
        font-size: 18px;
    }
}

@media(max-width:768px){
    .galeri-card-item {
        height: 280px;
        border-radius: 14px;
        margin-bottom: 20px;
    }
    
    .galeri-card-overlay {
        padding: 20px;
    }
    
    .galeri-card-content h4 {
        font-size: 16px;
    }
    
    #galeriCarousel .carousel-control-prev,
    #galeriCarousel .carousel-control-next {
        width: 45px;
        height: 45px;
        opacity: 1;
    }
    
    #galeriCarousel .carousel-control-prev {
        left: 10px;
    }
    
    #galeriCarousel .carousel-control-next {
        right: 10px;
    }
    
    #galeriCarousel .carousel-control-icon i {
        font-size: 18px;
    }
    
    #galeriCarousel .carousel-indicators {
        bottom: -35px;
    }
}

/* ── Kontak ───────────────────────────────────────── */
.kontak-item { border-radius: 12px; border: 1.5px solid #e0e6f0; overflow: hidden; margin-bottom: 12px; }
.kontak-question {
    padding: 18px 24px;        /* ← lebih lega */
    cursor: pointer;
    font-weight: 600;
    color: var(--primary);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    font-size: 14.5px;         /* ← lebih besar */
    transition: background .2s;
    gap: 16px;
    line-height: 1.6;
}
.kontak-question:hover { background: #f7f9ff; }
.kontak-icon { flex-shrink: 0; font-size: 12px; transition: transform .3s; }
.kontak-answer {
    padding: 18px 24px;        /* ← lebih lega */
    background: #f7f9ff;
    border-top: 1.5px solid #e0e6f0;
    font-size: 14px;           /* ← lebih besar */
    color: #4a5568;            /* ← lebih gelap */
    line-height: 1.85;
    display: none;
}
.kontak-answer.show { display: block; }
.kontak-item.open .kontak-icon { transform: rotate(180deg); }

/* ── CTA — NAVY ────────────────────────────────── */
.cta-wrap {
    background: linear-gradient(135deg, #0d2240 0%, #1a3a6e 100%); /* ← navy bukan merah */
    padding: 92px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.cta-wrap::before,
.cta-wrap::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
}
.cta-wrap::before { width: 360px; height: 360px; top: -100px; right: -80px; }
.cta-wrap::after  { width: 260px; height: 260px; bottom: -80px; left: -50px; }
.cta-wrap .inner { position: relative; z-index: 1; }
.cta-wrap h2 {
    font-family: 'Playfair Display', serif;
    font-size: 2.55rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 18px;
    line-height: 1.22;
}
.cta-wrap p {
    color: rgba(255,255,255,.82); /* ← lebih terang */
    font-size: 1.08rem;          /* ← lebih besar */
    margin-bottom: 40px;
    max-width: 520px;
    margin-left: auto; margin-right: auto;
    line-height: 1.8;
}
.btn-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 48px;
    background: var(--accent);
    color: #1a1a1a !important;
    border-radius: 9px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all .25s;
    box-shadow: 0 6px 28px rgba(245,166,35,.45);
}
.btn-cta:hover { background: #ffb800; transform: translateY(-2px); text-decoration: none; }

/* ── BUTTON UTAMA ──────────────────────────────── */
.btn-main {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 38px;
    background: var(--primary);
    color: #fff !important;
    border-radius: 9px;
    font-weight: 700;
    font-size: 14.5px;         /* ← lebih besar */
    text-decoration: none;
    transition: all .25s;
    box-shadow: 0 4px 18px rgba(26,58,110,.25);
    letter-spacing: .2px;
}
.btn-main:hover { background: #15306a; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(26,58,110,.32); text-decoration: none; }

/* ── RESPONSIVE ────────────────────────────────── */
@media(max-width:992px){ .hero h1 { font-size: 2.4rem; } }
@media(max-width:768px){
    .hero { padding: 90px 0 64px; min-height: auto; }
    .hero h1 { font-size: 2rem; }
    .hero-desc { max-width: 100%; }
    .section { padding: 64px 0; }
    .section-title h2 { font-size: 1.8rem; }
    .cta-wrap h2 { font-size: 1.85rem; }
    .btn-hero-secondary { margin-left: 0; margin-top: 10px; }
    .stat-item { border-right: none; border-bottom: 1px solid #f0f2f7; }
}
</style>

{{-- ═══════════════════════ HERO ═══════════════════════ --}}
<section class="hero">
<div class="container">
<div class="row align-items-center">
    <div class="col-lg-7 mb-5 mb-lg-0">
        <div class="hero-eyebrow">
            <i class="fas fa-star" style="font-size:9px"></i>
            Portal Resmi DISPERINDAGKOP
        </div>
        <h1>Dinas Perindagkop<br>& Koperasi <em>Tolikara</em></h1>
        <p class="hero-desc">Platform digital untuk mendukung pertumbuhan industri, perdagangan, koperasi dan Koperasi di Kabupaten Tolikara, Papua Pegunungan.</p>
        <div style="display:flex;flex-wrap:wrap;gap:4px">
            <a href="{{ route('public.koperasi') }}" class="btn-hero-primary">
                <i class="fas fa-store"></i> Direktori Koperasi
            </a>
            <a href="{{ route('login') }}" class="btn-hero-secondary">
                <i class="fas fa-sign-in-alt"></i> Portal Login
            </a>
        </div>
    </div>
    <div class="col-lg-5 d-none d-lg-block">
        <div class="hero-info-card">
            <div class="card-logo"><i class="fas fa-store"></i></div>
            <h3 class="text-center">Membangun Ekonomi Lokal<br>yang Berdaya Saing</h3>
            <div class="hero-stat-grid">
                <div class="hero-stat-cell">
                    <strong>{{ $stats['total_koperasi'] }}+</strong>
                    <span>Koperasi Aktif</span>
                </div>
                <div class="hero-stat-cell">
                    <strong>{{ $stats['total_distrik'] }}</strong>
                    <span>Distrik</span>
                </div>
                <div class="hero-stat-cell">
                    <strong>{{ $stats['total_bantuan'] }}</strong>
                    <span>Program Bantuan</span>
                </div>
                <div class="hero-stat-cell">
                    <strong>{{ number_format($stats['total_tenaga']) }}</strong>
                    <span>Tenaga Kerja</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>

{{-- ════════════════════ STATS BAR ════════════════════ --}}
<section class="stats-bar">
<div class="container">
<div class="row">
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <i class="fas fa-store"></i>
            <span class="stat-num">{{ $stats['total_koperasi'] }}</span>
            <div class="stat-label">Total Koperasi Terdaftar</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <i class="fas fa-check-circle"></i>
            <span class="stat-num">{{ $stats['koperasi_verified'] }}</span>
            <div class="stat-label">Koperasi Terverifikasi</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <i class="fas fa-clock"></i>
            <span class="stat-num">{{ $stats['koperasi_pending'] }}</span>
            <div class="stat-label">Menunggu Verifikasi</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <i class="fas fa-hand-holding-usd"></i>
            <span class="stat-num">{{ $stats['bantuan_aktif'] }}</span>
            <div class="stat-label">Bantuan Aktif</div>
        </div>
    </div>
</div>
</div>
</section>

{{-- ══════════════════ BERITA TERBARU ══════════════════ --}}
@if($berita_terbaru->count())
<section class="section" style="padding:80px 0;background:#f8fafc">
<div class="container-fluid" style="max-width:1400px;padding-left:30px;padding-right:30px">
    <div class="section-title">
        <span class="eyebrow">Informasi Terkini</span>
        <h2>Berita Terbaru</h2>
        <p>Informasi dan kegiatan terkini dari DISPERINDAGKOP Tolikara</p>
        <div class="title-line"></div>
    </div>
    <div class="row" style="margin-left:-15px;margin-right:-15px">
    @foreach($berita_terbaru as $b)
        <div class="col-lg-4 col-md-6 mb-4" style="padding-left:15px;padding-right:15px">
            <a href="{{ route('public.berita.detail', $b) }}" class="card-news" style="text-decoration:none;display:block;height:100%">
                <div class="news-thumb" style="height:380px;overflow:hidden;border-radius:16px 16px 0 0;position:relative">
                    @if($b->thumbnail)
                        <img src="{{ asset('storage/'.$b->thumbnail) }}" 
                             alt="{{ $b->judul }}"
                             style="width:100%;height:100%;object-fit:cover;transition:transform 0.4s ease"
                             loading="lazy">
                    @else
                        <div class="thumb-placeholder" style="width:100%;height:100%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center">
                            <i class="fas fa-newspaper" style="font-size:64px;color:rgba(255,255,255,0.3)"></i>
                        </div>
                    @endif
                </div>
                <div class="news-body" style="padding:24px;background:white;border-radius:0 0 16px 16px">
                    <h5 style="color:#1a3a6e;font-weight:700;font-size:18px;margin-bottom:12px;line-height:1.4">
                        {{ Str::limit($b->judul, 70) }}
                    </h5>
                    <p style="color:#64748b;font-size:14px;line-height:1.7;margin-bottom:16px">
                        {{ Str::limit(strip_tags($b->konten), 120) }}
                    </p>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding-top:12px;border-top:1px solid #f1f5f9">
                        <small style="color:#94a3b8;font-size:13px">
                            <i class="far fa-calendar mr-1"></i>
                            {{ $b->created_at->format('d M Y') }}
                        </small>
                        <span class="btn-baca" style="color:#1a3a6e;font-weight:600;font-size:14px">
                            Baca <i class="fas fa-arrow-right ml-1"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    </div>
</div>
</section>
@endif

{{-- ═══════════════════ GALERI KEGIATAN ═══════════════ --}}
@if($galeri->count())
<section class="section section-alt">
<div class="container">
    <div class="section-title">
        <span class="eyebrow">Dokumentasi</span>
        <h2>Galeri Kegiatan</h2>
        <p>Dokumentasi kegiatan dan program DISPERINDAGKOP Tolikara</p>
        <div class="title-line"></div>
    </div>
    
    {{-- Carousel Galeri 3 Kolom --}}
    <div id="galeriCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
        <div class="carousel-inner">
            @php
                $chunks = $galeri->chunk(3);
            @endphp
            
            @foreach($chunks as $index => $chunk)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="row">
                    @foreach($chunk as $g)
                    <div class="col-lg-4 col-md-4 mb-3 mb-lg-0">
                        <div class="galeri-card-item">
                            <img src="{{ asset('storage/'.$g->foto) }}"
                                 alt="{{ $g->judul }}"
                                 onerror="this.src='https://via.placeholder.com/400x300?text=Galeri'">
                            <div class="galeri-card-overlay">
                                <div class="galeri-card-content">
                                    <h4>{{ $g->judul }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        
        {{-- Controls --}}
        <a class="carousel-control-prev" href="#galeriCarousel" role="button" data-slide="prev">
            <span class="carousel-control-icon">
                <i class="fas fa-chevron-left"></i>
            </span>
        </a>
        <a class="carousel-control-next" href="#galeriCarousel" role="button" data-slide="next">
            <span class="carousel-control-icon">
                <i class="fas fa-chevron-right"></i>
            </span>
        </a>
        
        {{-- Indicators --}}
        <ol class="carousel-indicators">
            @foreach($chunks as $index => $chunk)
            <li data-target="#galeriCarousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
    </div>
    
    <div class="text-center mt-5">
        <a href="{{ route('public.galeri') }}" class="btn-main">
            <i class="fas fa-images"></i> Lihat Semua Galeri
        </a>
    </div>
</div>
</section>
@endif

{{-- ════════════════════ KONTAK ════════════════════════ --}}
<section class="section section-alt">
<div class="container">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <span style="display:inline-block;font-size:11px;font-weight:700;letter-spacing:2.2px;text-transform:uppercase;color:var(--accent);margin-bottom:12px">Hubungi Kami</span>
            <h2 style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--primary);margin-bottom:16px;line-height:1.28">Kami Siap Melayani Anda</h2>
            <div style="width:48px;height:3px;background:linear-gradient(90deg,var(--accent),#ffb800);border-radius:2px;margin:0 auto"></div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <div style="background:#fff;border-radius:16px;padding:28px 20px;box-shadow:0 2px 16px rgba(0,0,0,.07);text-align:center;height:100%">
                <div style="width:56px;height:56px;background:#eff6ff;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
                    <i class="fas fa-map-marker-alt fa-lg" style="color:#1a3a6e"></i>
                </div>
                <h6 style="font-weight:700;color:#1a3a6e;margin-bottom:8px">Alamat</h6>
                <p style="font-size:13.5px;color:#4a5568;margin:0">Jl. Raya Karubaga, Kab. Tolikara, Papua Pegunungan</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div style="background:#fff;border-radius:16px;padding:28px 20px;box-shadow:0 2px 16px rgba(0,0,0,.07);text-align:center;height:100%">
                <div style="width:56px;height:56px;background:#fff7ed;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
                    <i class="fas fa-phone fa-lg" style="color:#ea580c"></i>
                </div>
                <h6 style="font-weight:700;color:#1a3a6e;margin-bottom:8px">Telepon</h6>
                <p style="font-size:13.5px;color:#4a5568;margin:0">(0964) 123456</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div style="background:#fff;border-radius:16px;padding:28px 20px;box-shadow:0 2px 16px rgba(0,0,0,.07);text-align:center;height:100%">
                <div style="width:56px;height:56px;background:#f0fdf4;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
                    <i class="fas fa-envelope fa-lg" style="color:#15803d"></i>
                </div>
                <h6 style="font-weight:700;color:#1a3a6e;margin-bottom:8px">Email</h6>
                <p style="font-size:13.5px;color:#4a5568;margin:0">info@disperindagkop.tolikara.go.id</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div style="background:#fff;border-radius:16px;padding:28px 20px;box-shadow:0 2px 16px rgba(0,0,0,.07);text-align:center;height:100%">
                <div style="width:56px;height:56px;background:#fff1f2;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
                    <i class="fas fa-clock fa-lg" style="color:#be123c"></i>
                </div>
                <h6 style="font-weight:700;color:#1a3a6e;margin-bottom:8px">Jam Kerja</h6>
                <p style="font-size:13.5px;color:#4a5568;margin:0">Senin–Jumat<br>08.00–16.00 WIT</p>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="{{ route('public.kontak') }}" class="btn-main">
            <i class="fas fa-envelope mr-2"></i> Kirim Pesan ke Kami
        </a>
    </div>
</div>
</section>

{{-- ════════════ SCRIPTS — hanya 1x @push ════════════ --}}
@push('scripts')
<script>
// ── Kontak accordion ────────────────────────────────
document.querySelectorAll('.kontak-question').forEach(function(q){
    q.addEventListener('click', function(){
        var item   = this.closest('.kontak-item');
        var ans    = this.nextElementSibling;
        var isOpen = ans.classList.contains('show');
        document.querySelectorAll('.kontak-answer').forEach(function(a){ a.classList.remove('show'); });
        document.querySelectorAll('.kontak-item').forEach(function(i){ i.classList.remove('open'); });
        if(!isOpen){ ans.classList.add('show'); item.classList.add('open'); }
    });
});

// ── Jam real-time di topbar ───────────────────────
var _hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
var _bln  = ["Januari","Februari","Maret","April","Mei","Juni",
             "Juli","Agustus","September","Oktober","November","Desember"];
function updateJam(){
    var d  = new Date();
    var el = document.getElementById("jamTopbar");
    if(!el) return;
    el.innerHTML = _hari[d.getDay()] + ", "
                 + String(d.getDate()).padStart(2,"0") + " "
                 + _bln[d.getMonth()] + " "
                 + d.getFullYear()
                 + " &nbsp;|&nbsp; "
                 + String(d.getHours()).padStart(2,"0") + ":"
                 + String(d.getMinutes()).padStart(2,"0") + ":"
                 + String(d.getSeconds()).padStart(2,"0") + " WIT";
}
updateJam();
setInterval(updateJam, 1000);
</script>

@endpush

@endsection