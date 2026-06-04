@extends('public.layouts.app')
@section('title', 'Profil Dinas')

@push('styles')
<style>
    .profil-hero {
        background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 100%);
        padding: 80px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .profil-hero::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        top: -150px;
        right: -100px;
    }
    
    .profil-hero::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.03);
        bottom: -100px;
        left: -80px;
    }
    
    .profil-hero .container {
        position: relative;
        z-index: 1;
    }
    
    .profil-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        background: white;
    }
    
    .profil-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(26, 58, 110, 0.15);
    }
    
    .profil-card-img {
        height: 200px;
        position: relative;
        overflow: hidden;
    }
    
    .profil-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .profil-card:hover .profil-card-img img {
        transform: scale(1.08);
    }
    
    .profil-card-img-placeholder {
        height: 100%;
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .profil-card-img-placeholder::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 30% 50%, rgba(245, 166, 35, 0.15), transparent 60%);
    }
    
    .profil-card-img-placeholder i {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.25);
        position: relative;
        z-index: 1;
    }
    
    .profil-card-body {
        padding: 28px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    
    .profil-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a3a6e;
        margin-bottom: 14px;
        line-height: 1.4;
    }
    
    .profil-card-text {
        color: #5a6475;
        font-size: 14px;
        line-height: 1.75;
        flex: 1;
        margin-bottom: 20px;
    }
    
    .profil-card-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        color: white !important;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s;
        align-self: flex-start;
        box-shadow: 0 4px 15px rgba(26, 58, 110, 0.2);
    }
    
    .profil-card-link:hover {
        background: linear-gradient(135deg, #15306a, #2550a0);
        transform: translateX(4px);
        box-shadow: 0 6px 20px rgba(26, 58, 110, 0.3);
        text-decoration: none;
    }
    
    .profil-card-link i {
        transition: transform 0.3s;
    }
    
    .profil-card:hover .profil-card-link i {
        transform: translateX(4px);
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #94a3b8;
    }
    
    .empty-state-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .empty-state-icon i {
        font-size: 3.5rem;
        color: #cbd5e1;
    }
    
    .section-intro {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 50px;
    }
    
    .section-intro p {
        color: #64748b;
        font-size: 15px;
        line-height: 1.8;
    }
    
    @media (max-width: 768px) {
        .profil-hero {
            padding: 60px 0 40px;
        }
        
        .profil-card-img {
            height: 180px;
        }
        
        .profil-card-body {
            padding: 22px;
        }
    }
</style>
@endpush

@section('content')
<section class="profil-hero">
    <div class="container text-center">
        <div class="mb-3">
            <span style="display: inline-block; padding: 8px 20px; background: rgba(245, 166, 35, 0.2); border-radius: 50px; color: #f5a623; font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;">
                <i class="fas fa-building mr-2"></i>Tentang Kami
            </span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 16px;">
            Profil Dinas
        </h1>
        <p style="font-size: 1.1rem; opacity: 0.85; max-width: 600px; margin: 0 auto; line-height: 1.7;">
            Mengenal lebih dekat Dinas Perindustrian, Perdagangan, dan Koperasi Kabupaten Tolikara
        </p>
    </div>
</section>

<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="section-intro">
            <p>
                Temukan informasi lengkap mengenai visi, misi, struktur organisasi, dan berbagai program unggulan 
                yang kami jalankan untuk memajukan perekonomian daerah melalui pemberdayaan koperasi dan UMKM.
            </p>
        </div>
        
        <div class="row">
            @forelse($halaman as $h)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="profil-card">
                    <div class="profil-card-img">
                        @if($h->gambar)
                            <img src="{{ asset('storage/'.$h->gambar) }}" alt="{{ $h->judul }}">
                        @else
                            <div class="profil-card-img-placeholder">
                                <i class="{{ $h->icon ?? 'fas fa-file-alt' }}"></i>
                            </div>
                        @endif
                    </div>
                    <div class="profil-card-body">
                        <h3 class="profil-card-title">{{ $h->judul }}</h3>
                        <p class="profil-card-text">
                            {{ Str::limit(strip_tags($h->konten), 140) }}
                        </p>
                        <a href="{{ route('public.halaman', $h->slug) }}" class="profil-card-link">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h4 style="color: #64748b; font-weight: 600; margin-bottom: 12px;">
                        Belum Ada Halaman Profil
                    </h4>
                    <p style="color: #94a3b8; font-size: 15px;">
                        Halaman profil sedang dalam proses pengembangan. Silakan kembali lagi nanti.
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection