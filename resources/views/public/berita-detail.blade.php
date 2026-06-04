@extends('public.layouts.app')
@section('title', $berita->judul . ' - DISPERINDAGKOP Tolikara')

@push('styles')
<style>
/* Hero Section */
.berita-detail-hero {
    background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 50%, #3d6ab0 100%);
    padding: 60px 0 40px;
    color: #fff;
}

/* Main Content */
.berita-detail-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.berita-detail-image {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
}

.berita-detail-content {
    padding: 40px;
}

.berita-meta {
    display: flex;
    align-items: center;
    gap: 25px;
    padding: 20px 40px;
    background: linear-gradient(to right, #f8f9fa, #ffffff);
    border-bottom: 2px solid #e5e7eb;
    flex-wrap: wrap;
}

.berita-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #6b7280;
    font-weight: 600;
}

.berita-meta-item i {
    color: #1a3a6e;
    font-size: 16px;
}

.berita-title {
    font-size: 32px;
    font-weight: 900;
    color: #1a3a6e;
    line-height: 1.4;
    margin-bottom: 30px;
}

.berita-content {
    font-size: 16px;
    line-height: 2;
    color: #374151;
    text-align: justify;
}

.berita-content p {
    margin-bottom: 20px;
}

.berita-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 25px 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.berita-content h2,
.berita-content h3,
.berita-content h4 {
    color: #1a3a6e;
    font-weight: 800;
    margin-top: 30px;
    margin-bottom: 15px;
}

.berita-content ul,
.berita-content ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.berita-content li {
    margin-bottom: 10px;
}

.berita-content blockquote {
    border-left: 5px solid #1a3a6e;
    padding: 20px 25px;
    background: #f8f9fa;
    margin: 25px 0;
    border-radius: 0 12px 12px 0;
    font-style: italic;
    color: #4b5563;
}

/* Sidebar */
.sidebar-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-bottom: 30px;
    position: sticky;
    top: 20px;
}

.sidebar-header {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    padding: 20px 25px;
    font-size: 16px;
    font-weight: 800;
}

.berita-lainnya-item {
    display: flex;
    gap: 15px;
    padding: 20px 25px;
    border-bottom: 1px solid #f3f4f6;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s;
}

.berita-lainnya-item:last-child {
    border-bottom: none;
}

.berita-lainnya-item:hover {
    background: #f8f9fa;
    transform: translateX(5px);
}

.berita-lainnya-thumb {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    display: flex;
    align-items: center;
    justify-content: center;
}

.berita-lainnya-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.berita-lainnya-content h6 {
    font-size: 14px;
    font-weight: 700;
    color: #1a3a6e;
    line-height: 1.5;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.berita-lainnya-date {
    font-size: 12px;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Back Button */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(107,114,128,0.3);
}

.btn-back:hover {
    transform: translateX(-5px);
    box-shadow: 0 6px 25px rgba(107,114,128,0.4);
    color: white;
    text-decoration: none;
}

@media (max-width: 768px) {
    .berita-title {
        font-size: 24px;
    }
    
    .berita-detail-content {
        padding: 25px;
    }
    
    .berita-meta {
        padding: 15px 25px;
    }
    
    .sidebar-card {
        position: relative;
        top: 0;
    }
}
</style>
@endpush

@section('content')
{{-- Hero Section --}}
<div class="berita-detail-hero">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-3" style="font-size:14px">
                <li class="breadcrumb-item">
                    <a href="{{ route('public.home') }}" style="color:rgba(255,255,255,0.8)">
                        <i class="fas fa-home mr-1"></i>Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('public.berita') }}" style="color:rgba(255,255,255,0.8)">Berita</a>
                </li>
                <li class="breadcrumb-item active" style="color:white">Detail Berita</li>
            </ol>
        </nav>
        <h1 style="font-size:2rem;font-weight:900;margin:0;text-shadow:0 2px 10px rgba(0,0,0,0.2)">
            {{ Str::limit($berita->judul, 100) }}
        </h1>
    </div>
</div>

{{-- Main Content --}}
<section style="padding:60px 0;background:linear-gradient(to bottom, #f8f9fa, #ffffff)">
    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8 mb-4">
                <div class="berita-detail-card">
                    {{-- Featured Image --}}
                    @if($berita->thumbnail)
                    <img src="{{ asset('storage/'.$berita->thumbnail) }}" 
                         alt="{{ $berita->judul }}" 
                         class="berita-detail-image">
                    @endif

                    {{-- Meta Info --}}
                    <div class="berita-meta">
                        <div class="berita-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $berita->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="berita-meta-item">
                            <i class="fas fa-eye"></i>
                            <span>{{ $berita->views ?? 0 }} views</span>
                        </div>
                        <div class="berita-meta-item">
                            <i class="fas fa-user"></i>
                            <span>{{ $berita->penulis ?? 'Admin' }}</span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="berita-detail-content">
                        <h1 class="berita-title">{{ $berita->judul }}</h1>
                        <div class="berita-content">
                            {!! $berita->konten !!}
                        </div>
                    </div>
                </div>

                {{-- Back Button --}}
                <a href="{{ route('public.berita') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Daftar Berita</span>
                </a>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="sidebar-card">
                    <div class="sidebar-header">
                        <i class="fas fa-newspaper mr-2"></i>
                        Berita Lainnya
                    </div>
                    <div>
                        @forelse($lainnya as $l)
                        <a href="{{ route('public.berita.detail', $l) }}" class="berita-lainnya-item">
                            <div class="berita-lainnya-thumb">
                                @if($l->thumbnail)
                                <img src="{{ asset('storage/'.$l->thumbnail) }}" alt="{{ $l->judul }}">
                                @else
                                <i class="fas fa-newspaper" style="color:#9ca3af;font-size:24px"></i>
                                @endif
                            </div>
                            <div class="berita-lainnya-content">
                                <h6>{{ Str::limit($l->judul, 60) }}</h6>
                                <div class="berita-lainnya-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $l->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            <small>Belum ada berita lainnya</small>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
