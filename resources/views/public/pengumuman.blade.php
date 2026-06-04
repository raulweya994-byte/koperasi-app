@extends('public.layouts.app')
@section('title','Pengumuman - DISPERINDAGKOP Tolikara')

@push('styles')
<style>
.pengumuman-hero {
    background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 50%, #3d6ab0 100%);
    padding: 100px 0 80px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.pengumuman-hero::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245,166,35,0.15), transparent);
    top: -250px;
    right: -200px;
    animation: float 8s ease-in-out infinite;
}

.pengumuman-hero::after {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(16,185,129,0.12), transparent);
    bottom: -200px;
    left: -150px;
    animation: float 10s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-30px) scale(1.05); }
}

.hero-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, rgba(245,166,35,0.25), rgba(251,191,36,0.25));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    backdrop-filter: blur(15px);
    border: 3px solid rgba(255,255,255,0.2);
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); box-shadow: 0 8px 32px rgba(0,0,0,0.15); }
    50% { transform: scale(1.05); box-shadow: 0 12px 40px rgba(245,166,35,0.3); }
}

/* Featured Pengumuman (Kiri) */
.featured-pengumuman {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 15px 60px rgba(26,58,110,0.12);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    position: sticky;
    top: 20px;
    border: 1px solid rgba(26,58,110,0.08);
}

.featured-pengumuman:hover {
    box-shadow: 0 20px 80px rgba(26,58,110,0.18);
    transform: translateY(-2px);
}

.featured-header {
    background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 50%, #3d6ab0 100%);
    padding: 30px 35px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.featured-header::before {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245,166,35,0.2), transparent);
    top: -60px;
    right: -60px;
    animation: rotate 15s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.logo-badge {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #f5a623 0%, #fdb944 50%, #f5a623 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    box-shadow: 0 6px 25px rgba(245,166,35,0.5);
    position: relative;
    z-index: 1;
    animation: glow 3s ease-in-out infinite;
}

@keyframes glow {
    0%, 100% { box-shadow: 0 6px 25px rgba(245,166,35,0.5); }
    50% { box-shadow: 0 8px 35px rgba(245,166,35,0.7), 0 0 20px rgba(245,166,35,0.3); }
}

.featured-body {
    padding: 35px;
    max-height: calc(100vh - 300px);
    overflow-y: auto;
    background: linear-gradient(to bottom, #ffffff, #fafbfc);
}

.featured-body::-webkit-scrollbar {
    width: 8px;
}

.featured-body::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #f1f3f5, #e9ecef);
    border-radius: 10px;
}

.featured-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    border-radius: 10px;
    transition: all 0.3s;
}

.featured-body::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #2d5aa0, #3d6ab0);
}

.featured-label {
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
    background: linear-gradient(135deg, #1a3a6e, #f5a623);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 15px;
    text-align: center;
    position: relative;
}

.featured-label::after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #1a3a6e, #f5a623);
    margin: 10px auto 0;
    border-radius: 2px;
}

.featured-title {
    font-size: 22px;
    font-weight: 900;
    color: #1a3a6e;
    line-height: 1.5;
    margin-bottom: 20px;
    text-align: center;
    text-shadow: 0 2px 4px rgba(26,58,110,0.05);
}

.jenis-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-left: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: badge-pop 0.5s ease-out;
}

@keyframes badge-pop {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); opacity: 1; }
}

.badge-info { 
    background: linear-gradient(135deg, #3b82f6, #2563eb); 
    color: white;
    box-shadow: 0 4px 15px rgba(59,130,246,0.4);
}
.badge-penting { 
    background: linear-gradient(135deg, #3b82f6, #2563eb); 
    color: white;
    box-shadow: 0 4px 15px rgba(59,130,246,0.4);
}
.badge-warning { 
    background: linear-gradient(135deg, #3b82f6, #2563eb); 
    color: white;
    box-shadow: 0 4px 15px rgba(59,130,246,0.4);
}
.badge-urgent { 
    background: linear-gradient(135deg, #ef4444, #dc2626); 
    color: white;
    box-shadow: 0 4px 15px rgba(239,68,68,0.4);
    animation: urgent-pulse 2s ease-in-out infinite;
}

@keyframes urgent-pulse {
    0%, 100% { box-shadow: 0 4px 15px rgba(239,68,68,0.4); }
    50% { box-shadow: 0 6px 25px rgba(239,68,68,0.6); }
}

.date-badge {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #f0f4ff, #e0e7ff);
    border-radius: 100px;
    font-size: 13px;
    color: #1a3a6e;
    font-weight: 700;
    margin-bottom: 25px;
    border: 2px solid rgba(26,58,110,0.1);
    box-shadow: 0 4px 15px rgba(26,58,110,0.08);
}

.featured-content {
    background: linear-gradient(to right, #f8f9fa, #ffffff);
    padding: 25px;
    border-radius: 16px;
    border-left: 5px solid #1a3a6e;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
}

.featured-content:hover {
    box-shadow: 0 6px 30px rgba(0,0,0,0.08);
    transform: translateX(3px);
}

.featured-text {
    color: #374151;
    line-height: 2;
    font-size: 15px;
    text-align: justify;
    margin: 0;
    white-space: pre-line;
}

.featured-image {
    text-align: center;
    margin-bottom: 25px;
    position: relative;
}

.featured-image img {
    max-width: 100%;
    height: auto;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    transition: all 0.4s ease;
}

.featured-image img:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 40px rgba(0,0,0,0.2);
}

.featured-link {
    background: linear-gradient(135deg, #e0f2fe, #dbeafe);
    padding: 20px;
    border-radius: 16px;
    margin-bottom: 25px;
    border-left: 5px solid #0284c7;
    box-shadow: 0 4px 15px rgba(2,132,199,0.1);
    transition: all 0.3s ease;
}

.featured-link:hover {
    box-shadow: 0 6px 25px rgba(2,132,199,0.15);
    transform: translateX(3px);
}

.featured-pembuat {
    text-align: right;
    margin-top: 30px;
    padding-top: 25px;
    border-top: 2px solid #e5e7eb;
}

.action-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 25px;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 800;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn-action::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-action:hover::before {
    width: 300px;
    height: 300px;
}

.btn-action i {
    position: relative;
    z-index: 1;
    font-size: 16px;
}

.btn-action span {
    position: relative;
    z-index: 1;
}

.btn-download {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    color: #fff;
    box-shadow: 0 6px 20px rgba(220,38,38,0.35);
}

.btn-download:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(220,38,38,0.5);
    color: #fff;
    text-decoration: none;
}

.btn-whatsapp {
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: #fff;
    box-shadow: 0 6px 20px rgba(37,211,102,0.35);
}

.btn-whatsapp:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(37,211,102,0.5);
    color: #fff;
}

.btn-twitter {
    background: linear-gradient(135deg, #1DA1F2, #0C85D0);
    color: #fff;
    box-shadow: 0 6px 20px rgba(29,161,242,0.35);
}

.btn-twitter:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(29,161,242,0.5);
    color: #fff;
}

.btn-copy {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: #fff;
    box-shadow: 0 6px 20px rgba(107,114,128,0.35);
}

.btn-copy:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(107,114,128,0.5);
    color: #fff;
}

/* List Pengumuman (Kanan) */
.pengumuman-list-title {
    font-size: 20px;
    font-weight: 900;
    color: #1a3a6e;
    margin-bottom: 25px;
    padding-bottom: 18px;
    border-bottom: 4px solid transparent;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(90deg, #1a3a6e, #f5a623) border-box;
    border-bottom: 4px solid;
    display: flex;
    align-items: center;
    gap: 12px;
}

.pengumuman-list-title i {
    font-size: 22px;
    color: #f5a623;
}

.pengumuman-list-container {
    max-height: calc(100vh - 200px);
    overflow-y: auto;
    padding-right: 12px;
}

.pengumuman-list-container::-webkit-scrollbar {
    width: 8px;
}

.pengumuman-list-container::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #f1f3f5, #e9ecef);
    border-radius: 10px;
}

.pengumuman-list-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    border-radius: 10px;
    transition: all 0.3s;
}

.pengumuman-list-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #2d5aa0, #3d6ab0);
}

.pengumuman-item {
    background: #fff;
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-left: 5px solid #e5e7eb;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.pengumuman-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 100%;
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    transform: scaleY(0);
    transition: transform 0.4s ease;
}

.pengumuman-item:hover {
    transform: translateX(8px);
    box-shadow: 0 8px 35px rgba(26,58,110,0.15);
    border-left-color: #1a3a6e;
}

.pengumuman-item:hover::before {
    transform: scaleY(1);
}

.pengumuman-item.active {
    border-left-color: #f5a623;
    background: linear-gradient(135deg, #fff9e6 0%, #fffbf0 50%, #fff 100%);
    box-shadow: 0 8px 35px rgba(245,166,35,0.25);
    transform: translateX(8px);
}

.pengumuman-item.active::before {
    background: linear-gradient(135deg, #f5a623, #fdb944);
    transform: scaleY(1);
}

.pengumuman-item.active::after {
    content: '📌';
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 20px;
    animation: pin-bounce 0.6s ease-out;
}

@keyframes pin-bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.item-title {
    font-size: 17px;
    font-weight: 800;
    color: #1a3a6e;
    line-height: 1.5;
    margin: 0;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s;
}

.pengumuman-item:hover .item-title {
    color: #2d5aa0;
}

.item-date {
    font-size: 12px;
    color: #6b7280;
    white-space: nowrap;
    margin-left: 12px;
    background: #f3f4f6;
    padding: 5px 12px;
    border-radius: 8px;
    font-weight: 600;
}

.item-excerpt {
    color: #6b7280;
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 18px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.item-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.item-badge {
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.item-link {
    color: #1a3a6e;
    font-size: 14px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s;
}

.pengumuman-item:hover .item-link {
    color: #f5a623;
    gap: 10px;
}

.item-link i {
    transition: transform 0.3s;
}

.pengumuman-item:hover .item-link i {
    transform: translateX(3px);
}

.empty-state {
    text-align: center;
    padding: 100px 20px;
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.08);
    border: 2px dashed #e5e7eb;
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
    animation: empty-float 3s ease-in-out infinite;
}

@keyframes empty-float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.95);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 24px;
    z-index: 10;
    backdrop-filter: blur(5px);
}

.loading-overlay i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@media (max-width: 991px) {
    .featured-pengumuman {
        position: relative;
        top: 0;
        margin-bottom: 30px;
    }
    
    .featured-body {
        max-height: none;
    }
    
    .pengumuman-list-container {
        max-height: none;
    }
}

@media (max-width: 768px) {
    .featured-body {
        padding: 20px;
    }
    
    .featured-title {
        font-size: 18px;
    }
    
    .item-title {
        font-size: 14px;
    }
}

.pagination .page-link {
    border-radius: 10px;
    margin: 0 5px;
    border: 2px solid #e5e7eb;
    color: #1a3a6e;
    font-weight: 700;
    padding: 10px 18px;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #f0f4ff, #e0e7ff);
    border-color: #1a3a6e;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    border: 2px solid #1a3a6e;
    box-shadow: 0 4px 15px rgba(26,58,110,0.3);
}

/* Toast Notification */
.copy-toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 18px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(16,185,129,0.5);
    font-weight: 800;
    font-size: 15px;
    z-index: 9999;
    opacity: 0;
    transform: translateY(30px) scale(0.9);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.copy-toast.show {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.copy-toast::before {
    content: '\f00c';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    margin-right: 12px;
    font-size: 18px;
}
</style>
@endpush

@section('content')
{{-- Hero Section --}}
<div class="pengumuman-hero">
    <div class="container" style="position:relative;z-index:1">
        <div class="text-center">
            <div class="hero-icon">
                <i class="fas fa-bullhorn fa-3x" style="color:#f5a623"></i>
            </div>
            <h1 style="font-size:3rem;font-weight:900;margin-bottom:18px;text-shadow:0 4px 20px rgba(0,0,0,0.3);letter-spacing:-1px">
                Pengumuman Resmi
            </h1>
            <p style="font-size:1.2rem;opacity:0.95;max-width:700px;margin:0 auto;line-height:1.6;font-weight:500">
                Informasi terkini dan pengumuman penting dari DISPERINDAGKOP Kabupaten Tolikara
            </p>
            <div style="margin-top:25px;display:flex;justify-content:center;gap:15px;flex-wrap:wrap">
                <span style="background:rgba(255,255,255,0.2);padding:8px 20px;border-radius:100px;font-size:14px;font-weight:700;backdrop-filter:blur(10px)">
                    <i class="fas fa-check-circle mr-2"></i>Terpercaya
                </span>
                <span style="background:rgba(255,255,255,0.2);padding:8px 20px;border-radius:100px;font-size:14px;font-weight:700;backdrop-filter:blur(10px)">
                    <i class="fas fa-clock mr-2"></i>Update Berkala
                </span>
                <span style="background:rgba(255,255,255,0.2);padding:8px 20px;border-radius:100px;font-size:14px;font-weight:700;backdrop-filter:blur(10px)">
                    <i class="fas fa-shield-alt mr-2"></i>Resmi
                </span>
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<section style="padding:80px 0;background:linear-gradient(to bottom, #f8f9fa, #ffffff);position:relative">
    {{-- Decorative elements --}}
    <div style="position:absolute;top:50px;left:5%;width:100px;height:100px;background:linear-gradient(135deg,rgba(26,58,110,0.05),transparent);border-radius:50%;"></div>
    <div style="position:absolute;bottom:100px;right:8%;width:150px;height:150px;background:linear-gradient(135deg,rgba(245,166,35,0.05),transparent);border-radius:50%;"></div>
    
    <div class="container" style="position:relative;z-index:1">
        @if($pengumuman->count() > 0)
        <div class="row">
            {{-- Featured Pengumuman (Kiri) - Lebih Lebar --}}
            <div class="col-lg-8 mb-4">
                <div class="featured-pengumuman" id="featuredPengumuman">
                    {{-- Content will be loaded here --}}
                </div>
            </div>

            {{-- List Pengumuman Lainnya (Kanan) --}}
            <div class="col-lg-4">
                <h4 class="pengumuman-list-title">
                    <i class="fas fa-list-ul"></i>
                    <span>Semua Pengumuman</span>
                </h4>
                
                <div class="pengumuman-list-container">
                    @foreach($pengumuman as $index => $p)
                    <div class="pengumuman-item" 
                         data-id="{{ $p->id }}"
                         onclick="loadPengumuman({{ $p->id }}, this)">
                        <div class="item-header">
                            <h5 class="item-title">{{ $p->judul }}</h5>
                            <span class="item-date">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $p->created_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <p class="item-excerpt">{{ Str::limit(strip_tags($p->isi), 100) }}</p>
                        
                        <div class="item-footer">
                            @if($p->jenis)
                            <span class="item-badge badge-{{ $p->jenis }}">
                                {{ in_array($p->jenis, ['warning', 'penting']) ? 'Info' : ucfirst($p->jenis) }}
                            </span>
                            @endif
                            <span class="item-link">
                                Baca Detail <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if($pengumuman->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $pengumuman->links('pagination::bootstrap-4') }}
        </div>
        @endif

        @else
        {{-- Empty State --}}
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-bullhorn fa-3x" style="color:#9ca3af"></i>
            </div>
            <h5 style="font-weight:700;color:#374151;margin-bottom:10px">Belum Ada Pengumuman</h5>
            <p style="color:#6b7280;margin:0">Saat ini belum ada pengumuman yang tersedia</p>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
// Load first pengumuman on page load
$(document).ready(function() {
    @if($pengumuman->count() > 0)
        @if(isset($selectedId) && $selectedId)
            // Load selected pengumuman from URL
            const selectedItem = $(`.pengumuman-item[data-id="{{ $selectedId }}"]`);
            if (selectedItem.length > 0) {
                loadPengumuman({{ $selectedId }}, selectedItem[0]);
            } else {
                // If not found, load first
                loadPengumuman({{ $pengumuman->first()->id }}, $('.pengumuman-item').first()[0]);
            }
        @else
            // Load first pengumuman
            loadPengumuman({{ $pengumuman->first()->id }}, $('.pengumuman-item').first()[0]);
        @endif
    @endif
});

function loadPengumuman(id, element) {
    // Remove active class from all items
    $('.pengumuman-item').removeClass('active');
    
    // Add active class to clicked item
    $(element).addClass('active');
    
    // Show loading
    $('#featuredPengumuman').html(`
        <div class="loading-overlay">
            <div class="text-center">
                <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                <p style="color:#1a3a6e;font-weight:600">Memuat pengumuman...</p>
            </div>
        </div>
    `);
    
    // Scroll to top on mobile
    if ($(window).width() < 992) {
        $('html, body').animate({
            scrollTop: $('#featuredPengumuman').offset().top - 100
        }, 500);
    }
    
    // Fetch pengumuman detail
    $.ajax({
        url: `/pengumuman/${id}/detail`,
        method: 'GET',
        success: function(data) {
            renderPengumuman(data);
        },
        error: function() {
            $('#featuredPengumuman').html(`
                <div class="alert alert-danger m-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Gagal memuat pengumuman. Silakan coba lagi.
                </div>
            `);
        }
    });
}

function renderPengumuman(data) {
    let dateHtml = '';
    if (data.tanggal && data.hari && data.jam && data.tahun) {
        dateHtml = `
            <div class="date-badge">
                <i class="fas fa-calendar-day" style="color:#1a3a6e"></i>
                <span>${data.hari}, ${data.tanggal_formatted} ${data.tahun}</span>
                <span style="opacity:0.3">|</span>
                <i class="fas fa-clock" style="color:#1a3a6e"></i>
                <span>${data.jam} WIT</span>
            </div>
        `;
    } else {
        dateHtml = `
            <div class="date-badge">
                <i class="fas fa-calendar-alt" style="color:#1a3a6e"></i>
                <span>${data.created_at}</span>
            </div>
        `;
    }
    
    let html = `
        <div class="featured-header">
            <div style="position:relative;z-index:1">
                 <img src="{{ asset('logo.png') }}" alt="Logo SIPPKT" class="logo-img" style="height: 40px; margin-right: 8px;">
                
                </div>
                <h6 style="font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:5px;opacity:0.9">
                    Pemerintah Kabupaten Tolikara
                </h6>
                <h5 style="font-size:14px;font-weight:800;margin:0">
                    DISPERINDAGKOP
                </h5>
            </div>
        </div>

        <div class="featured-body">
            <h6 class="featured-label">PENGUMUMAN</h6>
            <h3 class="featured-title">
                ${data.judul}
                ${data.jenis ? `<span class="jenis-badge badge-${data.jenis}">${data.jenis === 'warning' || data.jenis === 'penting' ? 'INFO' : data.jenis.toUpperCase()}</span>` : ''}
            </h3>
            
            <div class="text-center">
                ${dateHtml}
            </div>

            <div class="featured-content">
                <p class="featured-text">${data.isi}</p>
            </div>

            ${data.foto ? `
            <div class="featured-image">
                <img src="/storage/${data.foto}" alt="${data.judul}">
            </div>
            ` : ''}

            ${data.link ? `
            <div class="featured-link">
                <div style="display:flex;align-items:center;gap:12px">
                    <i class="fas fa-link" style="color:#0284c7;font-size:20px"></i>
                    <div style="flex:1">
                        <small style="color:#0369a1;font-weight:600;display:block;margin-bottom:5px">Link Terkait:</small>
                        <a href="${data.link}" target="_blank" style="color:#0284c7;font-weight:700;word-break:break-all">${data.link}</a>
                    </div>
                </div>
            </div>
            ` : ''}

            ${data.pembuat ? `
            <div class="featured-pembuat">
                <p style="font-size:14px;color:#666;margin-bottom:8px">Hormat kami,</p>
                <p style="font-size:16px;font-weight:700;color:#1a3a6e;margin:0">${data.pembuat}</p>
            </div>
            ` : ''}

            <div class="action-buttons" style="justify-content:flex-end;margin-top:30px">
                <a href="/pengumuman/${data.id}/download" target="_blank" class="btn-action btn-download">
                    <i class="fas fa-file-pdf"></i>
                    <span>Download PDF</span>
                </a>
                <button onclick="shareWhatsApp('${data.judul.replace(/'/g, "\\'")}', '${data.id}')" class="btn-action btn-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </button>
                <button onclick="shareTwitter('${data.judul.replace(/'/g, "\\'")}', '${data.id}')" class="btn-action btn-twitter">
                    <i class="fab fa-twitter"></i>
                    <span>Twitter</span>
                </button>
                <button onclick="copyLink('${data.id}')" class="btn-action btn-copy">
                    <i class="fas fa-link"></i>
                    <span>Copy Link</span>
                </button>
            </div>
        </div>
    `;
    
    $('#featuredPengumuman').html(html);
}

function shareWhatsApp(title, id) {
    const url = window.location.origin + '/pengumuman?id=' + id;
    const text = encodeURIComponent(`*${title}*\n\nPengumuman dari DISPERINDAGKOP Kabupaten Tolikara\n\n${url}`);
    window.open(`https://wa.me/?text=${text}`, '_blank');
}

function shareFacebook(id) {
    const url = window.location.origin + '/pengumuman?id=' + id;
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank', 'width=600,height=400');
}

function shareTwitter(title, id) {
    const url = window.location.origin + '/pengumuman?id=' + id;
    const text = encodeURIComponent(`${title} - Pengumuman dari DISPERINDAGKOP Kabupaten Tolikara`);
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(url)}`, '_blank', 'width=600,height=400');
}

function copyLink(id) {
    const url = window.location.origin + '/pengumuman?id=' + id;
    navigator.clipboard.writeText(url).then(() => {
        // Show toast notification
        const toast = $('<div class="copy-toast">Link berhasil disalin!</div>');
        $('body').append(toast);
        setTimeout(() => {
            toast.addClass('show');
        }, 100);
        setTimeout(() => {
            toast.removeClass('show');
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    }).catch(err => {
        alert('Gagal menyalin link. Silakan coba lagi.');
    });
}
</script>
@endpush
