@extends('public.layouts.app')
@section('title', 'Profil Koperasi - DISPERINDAGKOP Tolikara')

@push('styles')
<style>
    .hero-koperasi {
        background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 100%);
        padding: 100px 0 80px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .hero-koperasi::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: rgba(245, 166, 35, 0.1);
        top: -200px;
        right: -150px;
        animation: float 6s ease-in-out infinite;
    }
    
    .hero-koperasi::after {
        content: '';
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        bottom: -120px;
        left: -100px;
        animation: float 8s ease-in-out infinite reverse;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
    }
    
    .hero-badge {
        display: inline-block;
        padding: 10px 24px;
        background: rgba(245, 166, 35, 0.2);
        border-radius: 50px;
        color: #f5a623;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 20px;
        border: 2px solid rgba(245, 166, 35, 0.3);
    }
    
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto 40px;
        line-height: 1.8;
    }
    
    .stats-section {
        background: white;
        margin-top: -60px;
        position: relative;
        z-index: 10;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }
    
    .stat-box {
        text-align: center;
        padding: 30px 20px;
        border-radius: 16px;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .stat-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1a3a6e, #f5a623);
        transform: scaleX(0);
        transition: transform 0.3s;
    }
    
    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(26, 58, 110, 0.15);
    }
    
    .stat-box:hover::before {
        transform: scaleX(1);
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(26, 58, 110, 0.2);
    }
    
    .stat-icon i {
        font-size: 2rem;
        color: #f5a623;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a3a6e;
        margin-bottom: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    .stat-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .content-section {
        padding: 80px 0;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-badge {
        display: inline-block;
        padding: 8px 20px;
        background: #eff6ff;
        border-radius: 50px;
        color: #1a3a6e;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a3a6e;
        margin-bottom: 16px;
    }
    
    .section-description {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
    }
    
    .info-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(26, 58, 110, 0.12);
        border-color: #f5a623;
    }
    
    .info-card-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #f5a623, #ffb800);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        box-shadow: 0 8px 20px rgba(245, 166, 35, 0.3);
    }
    
    .info-card-icon i {
        font-size: 1.8rem;
        color: white;
    }
    
    .info-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a3a6e;
        margin-bottom: 16px;
    }
    
    .info-card-text {
        color: #5a6475;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 0;
    }
    
    .koperasi-card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.35s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .koperasi-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(26, 58, 110, 0.15);
    }
    
    .koperasi-card-header {
        height: 180px;
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .koperasi-card-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 30% 50%, rgba(245, 166, 35, 0.2), transparent 70%);
    }
    
    .koperasi-card-header i {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.3);
        position: relative;
        z-index: 1;
    }
    
    .koperasi-card-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .koperasi-badge {
        display: inline-block;
        padding: 6px 14px;
        background: #eff6ff;
        color: #1a3a6e;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        align-self: flex-start;
    }
    
    .koperasi-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .koperasi-card-info {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .koperasi-card-info i {
        color: #f5a623;
        width: 16px;
    }
    
    .koperasi-card-link {
        margin-top: auto;
        padding-top: 20px;
    }
    
    .btn-view {
        display: block;
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        color: white !important;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-view:hover {
        background: linear-gradient(135deg, #15306a, #2550a0);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26, 58, 110, 0.3);
        text-decoration: none;
    }
    
    .cta-section {
        background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 100%);
        padding: 80px 0;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .cta-section::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        top: -150px;
        right: -100px;
    }
    
    .cta-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }
    
    .cta-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
    }
    
    .cta-text {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 40px;
        background: #f5a623;
        color: #1a1a1a !important;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 8px 25px rgba(245, 166, 35, 0.4);
    }
    
    .btn-cta:hover {
        background: #ffb800;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(245, 166, 35, 0.5);
        text-decoration: none;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .stats-section {
            padding: 30px 20px;
            margin-top: -40px;
        }
        
        .stat-box {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .info-card {
            padding: 30px 20px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-koperasi">
    <div class="container">
        <div class="hero-content text-center">
            <div class="hero-badge">
                <i class="fas fa-handshake mr-2"></i>Koperasi Tolikara
            </div>
            <h1 class="hero-title">
                Profil Koperasi<br>Kabupaten Tolikara
            </h1>
            <p class="hero-subtitle">
                Membangun ekonomi kerakyatan melalui pemberdayaan koperasi yang kuat, mandiri, 
                dan berdaya saing untuk kesejahteraan masyarakat Tolikara
            </p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<div class="container">
    <div class="stats-section">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_koperasi'] }}</div>
                    <div class="stat-label">Total Koperasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $stats['koperasi_verified'] }}</div>
                    <div class="stat-label">Terverifikasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-number">{{ $stats['koperasi_aktif'] }}</div>
                    <div class="stat-label">Koperasi Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="stat-number">{{ $stats['total_distrik'] }}</div>
                    <div class="stat-label">Distrik</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<section class="content-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-info-circle mr-2"></i>Tentang Koperasi
            </div>
            <h2 class="section-title">Apa Itu Koperasi?</h2>
            <p class="section-description">
                Koperasi adalah badan usaha yang beranggotakan orang-seorang atau badan hukum koperasi 
                dengan melandaskan kegiatannya berdasarkan prinsip koperasi sekaligus sebagai gerakan ekonomi rakyat
            </p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="info-card-title">Tujuan Koperasi</h3>
                    <p class="info-card-text">
                        Memajukan kesejahteraan anggota pada khususnya dan masyarakat pada umumnya, 
                        serta ikut membangun tatanan perekonomian nasional dalam rangka mewujudkan 
                        masyarakat yang maju, adil, dan makmur.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="info-card-title">Prinsip Koperasi</h3>
                    <p class="info-card-text">
                        Keanggotaan bersifat sukarela dan terbuka, pengelolaan dilakukan secara demokratis, 
                        pembagian sisa hasil usaha dilakukan secara adil sebanding dengan besarnya jasa 
                        usaha masing-masing anggota.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="info-card-title">Manfaat Koperasi</h3>
                    <p class="info-card-text">
                        Meningkatkan pendapatan anggota, menyediakan kebutuhan anggota dengan harga terjangkau, 
                        memberikan pinjaman dengan bunga rendah, dan menciptakan lapangan kerja bagi masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Koperasi Terbaru Section -->
@if($koperasiTerbaru->count() > 0)
<section class="content-section" style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-star mr-2"></i>Koperasi Terbaru
            </div>
            <h2 class="section-title">Koperasi yang Baru Bergabung</h2>
            <p class="section-description">
                Daftar koperasi terbaru yang telah terverifikasi dan aktif di Kabupaten Tolikara
            </p>
        </div>
        
        <div class="row">
            @foreach($koperasiTerbaru as $kop)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="koperasi-card">
                    <div class="koperasi-card-header">
                        @if($kop->foto_usaha)
                        <img src="{{ asset('storage/'.$kop->foto_usaha) }}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;z-index:2;">
                        @endif
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="koperasi-card-body">
                        <span class="koperasi-badge">{{ $kop->kategori ?? 'Koperasi' }}</span>
                        <h3 class="koperasi-card-title">{{ $kop->nama_usaha }}</h3>
                        <div class="koperasi-card-info">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $kop->distrik }}</span>
                        </div>
                        <div class="koperasi-card-info">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $kop->jenis_usaha }}</span>
                        </div>
                        <div class="koperasi-card-link">
                            <a href="{{ route('public.koperasi.detail', $kop->id) }}" class="btn-view">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('public.koperasi') }}" class="btn-main">
                <i class="fas fa-th-large mr-2"></i>Lihat Semua Koperasi
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Daftarkan Koperasi Anda</h2>
            <p class="cta-text">
                Bergabunglah dengan jaringan koperasi di Kabupaten Tolikara dan dapatkan berbagai 
                manfaat serta dukungan untuk mengembangkan usaha Anda
            </p>
            <a href="{{ route('pendaftaran.landing') }}" class="btn-cta">
                <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
