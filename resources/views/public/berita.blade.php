@extends('public.layouts.app')
@section('title','Berita - DISPERINDAGKOP Tolikara')

@push('styles')
<style>
/* Hero Section */
.berita-hero {
    background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 50%, #3d6ab0 100%);
    padding: 80px 0 60px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.berita-hero::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245,166,35,0.15), transparent);
    top: -200px;
    right: -150px;
    animation: float 8s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Search Box */
.search-box-modern {
    background: white;
    border-radius: 50px;
    padding: 8px 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 40px;
}

.search-box-modern input {
    border: none;
    outline: none;
    flex: 1;
    font-size: 15px;
    padding: 8px 0;
}

.search-box-modern button {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    border: none;
    color: white;
    padding: 10px 30px;
    border-radius: 50px;
    font-weight: 700;
    transition: all 0.3s;
}

.search-box-modern button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(26,58,110,0.4);
}

/* Card Berita */
.card-berita {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0,0,0,0.05);
}

.card-berita:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(26,58,110,0.15);
}

.card-berita-image {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
}

.card-berita-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.card-berita:hover .card-berita-image img {
    transform: scale(1.1);
}

.card-berita-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(26,58,110,0.4);
}

.card-berita-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-berita-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    font-size: 13px;
    color: #6b7280;
}

.card-berita-meta i {
    color: #1a3a6e;
}

.card-berita-title {
    font-size: 18px;
    font-weight: 800;
    color: #1a3a6e;
    line-height: 1.5;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-berita-excerpt {
    color: #6b7280;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 20px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.btn-read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    align-self: flex-start;
}

.btn-read-more:hover {
    transform: translateX(5px);
    box-shadow: 0 6px 20px rgba(26,58,110,0.3);
    color: white;
    text-decoration: none;
}

.btn-read-more i {
    transition: transform 0.3s;
}

.btn-read-more:hover i {
    transform: translateX(3px);
}

/* Sidebar */
.sidebar-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-bottom: 30px;
    border: 1px solid rgba(0,0,0,0.05);
}

.sidebar-card-header {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    padding: 20px 25px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.sidebar-card-header h6 {
    margin: 0;
    font-size: 16px;
    font-weight: 800;
}

.sidebar-card-header i {
    font-size: 18px;
    color: #f5a623;
}

.berita-populer-item {
    display: flex;
    gap: 15px;
    padding: 20px 25px;
    border-bottom: 1px solid #f3f4f6;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s;
}

.berita-populer-item:last-child {
    border-bottom: none;
}

.berita-populer-item:hover {
    background: #f8f9fa;
    transform: translateX(5px);
}

.berita-populer-thumb {
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

.berita-populer-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.berita-populer-content h6 {
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

.berita-populer-date {
    font-size: 12px;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 100px 20px;
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.08);
}

.empty-icon {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
}

.empty-icon i {
    font-size: 50px;
    color: #9ca3af;
}

/* Pagination */
.pagination {
    gap: 8px;
}

.pagination .page-link {
    border-radius: 10px;
    border: 2px solid #e5e7eb;
    color: #1a3a6e;
    font-weight: 700;
    padding: 10px 18px;
    transition: all 0.3s;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #f0f4ff, #e0e7ff);
    border-color: #1a3a6e;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    border-color: #1a3a6e;
    box-shadow: 0 4px 15px rgba(26,58,110,0.3);
}

@media (max-width: 768px) {
    .card-berita-image {
        height: 180px;
    }
    
    .card-berita-title {
        font-size: 16px;
    }
}
</style>
@endpush

@section('content')
{{-- Hero Section --}}
<div class="berita-hero">
    <div class="container" style="position:relative;z-index:1">
        <div class="text-center">
            <div style="width:80px;height:80px;background:linear-gradient(135deg,rgba(245,166,35,0.25),rgba(251,191,36,0.25));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;backdrop-filter:blur(15px);border:3px solid rgba(255,255,255,0.2)">
                <i class="fas fa-newspaper fa-2x" style="color:#f5a623"></i>
            </div>
            <h1 style="font-size:2.5rem;font-weight:900;margin-bottom:15px;text-shadow:0 4px 20px rgba(0,0,0,0.3)">
                Berita & Informasi
            </h1>
            <p style="font-size:1.1rem;opacity:0.95;max-width:600px;margin:0 auto">
                Berita terkini dan informasi seputar DISPERINDAGKOP Kabupaten Tolikara
            </p>
        </div>
    </div>
</div>

{{-- Main Content --}}
<section style="padding:80px 0;background:linear-gradient(to bottom, #f8f9fa, #ffffff)">
    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8 mb-4">
                {{-- Search Box --}}
                <form method="GET" action="{{ route('public.berita') }}">
                    <div class="search-box-modern">
                        <i class="fas fa-search" style="color:#6b7280;font-size:18px"></i>
                        <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}">
                        <button type="submit">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                    </div>
                </form>

                {{-- Berita Grid --}}
                <div class="row">
                    @forelse($berita as $b)
                    <div class="col-md-6 mb-4">
                        <div class="card-berita">
                            <div class="card-berita-image">
                                @if($b->thumbnail)
                                <img src="{{ Str::startsWith($b->thumbnail, 'http') ? $b->thumbnail : asset('storage/'.$b->thumbnail) }}" alt="{{ $b->judul }}">
                                @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-newspaper fa-3x" style="color:#9ca3af"></i>
                                </div>
                                @endif
                            </div>
                            <div class="card-berita-body">
                                <div class="card-berita-meta">
                                    <span>
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $b->created_at->format('d M Y') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-eye mr-1"></i>
                                        {{ $b->views ?? 0 }} views
                                    </span>
                                </div>
                                <h5 class="card-berita-title">{{ $b->judul }}</h5>
                                <p class="card-berita-excerpt">{{ Str::limit(strip_tags($b->isi), 120) }}</p>
                                <a href="{{ route('public.berita.detail', $b) }}" class="btn-read-more">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <h5 style="font-weight:700;color:#374151;margin-bottom:10px">Belum Ada Berita</h5>
                            <p style="color:#6b7280;margin:0">Saat ini belum ada berita yang tersedia</p>
                        </div>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($berita->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $berita->links('pagination::bootstrap-4') }}
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Berita Populer --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="fas fa-fire"></i>
                        <h6>Berita Populer</h6>
                    </div>
                    <div>
                        @forelse($populer as $p)
                        <a href="{{ route('public.berita.detail', $p) }}" class="berita-populer-item">
                            <div class="berita-populer-thumb">
                                @if($p->thumbnail)
                                <img src="{{ asset('storage/'.$p->thumbnail) }}" alt="{{ $p->judul }}">
                                @else
                                <i class="fas fa-newspaper" style="color:#9ca3af;font-size:24px"></i>
                                @endif
                            </div>
                            <div class="berita-populer-content">
                                <h6>{{ Str::limit($p->judul, 60) }}</h6>
                                <div class="berita-populer-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $p->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            <small>Belum ada berita populer</small>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
