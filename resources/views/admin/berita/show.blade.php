@extends('layouts.app')
@section('title', 'Detail Berita')

@push('styles')
<style>
    /* Header Card Modern */
    .detail-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .detail-header-modern::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .detail-header-icon {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.25);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-right: 18px;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .detail-header-modern h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    /* Alert Modern */
    .alert-modern {
        border-radius: 12px;
        border: none;
        padding: 16px 22px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .alert-success-modern {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-success-modern i {
        font-size: 20px;
    }

    /* Content Card Modern */
    .content-card-modern {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
        margin-bottom: 24px;
    }

    /* Thumbnail Hero */
    .thumbnail-hero {
        position: relative;
        width: 100%;
        height: 450px;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .thumbnail-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-overlay-gradient {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
    }

    .thumbnail-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 35px 40px;
        color: white;
        z-index: 2;
    }

    .thumbnail-title {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.2;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    /* Article Content Section */
    .article-content-section {
        padding: 40px;
    }

    /* Meta Info Card */
    .meta-info-card {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 12px;
        padding: 25px 30px;
        margin-bottom: 35px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .meta-icon {
        width: 45px;
        height: 45px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        font-size: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        flex-shrink: 0;
    }

    .meta-content {
        flex: 1;
    }

    .meta-label {
        font-size: 11px;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
    }

    .meta-value {
        font-size: 14px;
        color: #1f2937;
        font-weight: 700;
    }

    /* Content Box */
    .content-box {
        background: #ffffff;
        border: 2px solid #f3f4f6;
        border-radius: 12px;
        padding: 35px;
        margin-bottom: 30px;
        position: relative;
    }

    .content-box::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(to bottom, #667eea, #764ba2);
        border-radius: 12px 0 0 12px;
    }

    .content-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .content-title i {
        color: #667eea;
        font-size: 20px;
    }

    .article-text {
        font-size: 16px;
        line-height: 1.9;
        color: #374151;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .article-text p {
        margin-bottom: 18px;
    }

    .article-text p:last-child {
        margin-bottom: 0;
    }

    /* Action Buttons */
    .action-buttons-bottom {
        display: flex;
        justify-content: center;
        gap: 12px;
        padding: 30px 40px;
        background: #f9fafb;
        border-top: 2px solid #f3f4f6;
        flex-wrap: wrap;
    }

    .btn-action-modern {
        border-radius: 12px;
        padding: 14px 28px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .btn-action-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }

    .btn-edit-modern {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .btn-delete-modern {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .btn-back-modern {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
    }

    /* Status Badge */
    .status-badge-detail {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        z-index: 3;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .status-badge-detail.status-publish {
        background: rgba(16, 185, 129, 0.95);
        color: white;
    }

    .status-badge-detail.status-draft {
        background: rgba(245, 158, 11, 0.95);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-header-modern {
            padding: 20px 25px;
        }

        .detail-header-icon {
            width: 50px;
            height: 50px;
            font-size: 24px;
            margin-right: 15px;
        }

        .detail-header-modern h1 {
            font-size: 20px;
        }

        .thumbnail-hero {
            height: 300px;
        }

        .thumbnail-info {
            padding: 25px 20px;
        }

        .thumbnail-title {
            font-size: 24px;
        }

        .article-content-section {
            padding: 25px 20px;
        }

        .meta-info-card {
            padding: 20px;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .content-box {
            padding: 25px 20px;
        }

        .article-text {
            font-size: 15px;
        }

        .action-buttons-bottom {
            padding: 20px;
            flex-direction: column;
        }

        .btn-action-modern {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="detail-header-modern">
        <div class="d-flex align-items-center">
            <div class="detail-header-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <h1>Detail Berita</h1>
        </div>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert-modern alert-success-modern">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Content Card --}}
    <div class="content-card-modern">
        {{-- Thumbnail Hero Section --}}
        @if ($berita->thumbnail)
        <div class="thumbnail-hero">
            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}">
            <div class="thumbnail-overlay-gradient"></div>
            
            {{-- Status Badge --}}
            @if($berita->status === 'publish')
                <div class="status-badge-detail status-publish">
                    <i class="fas fa-check-circle"></i>
                    Published
                </div>
            @else
                <div class="status-badge-detail status-draft">
                    <i class="fas fa-clock"></i>
                    Draft
                </div>
            @endif
            
            <div class="thumbnail-info">
                <h2 class="thumbnail-title">{{ $berita->judul }}</h2>
            </div>
        </div>
        @endif

        {{-- Article Content Section --}}
        <div class="article-content-section">
            {{-- Title (if no thumbnail) --}}
            @if (!$berita->thumbnail)
            <div style="margin-bottom:30px">
                <h2 style="font-size:32px;font-weight:800;color:#1f2937;margin-bottom:15px">
                    {{ $berita->judul }}
                </h2>
                @if($berita->status === 'publish')
                    <span class="status-badge-detail status-publish" style="position:static">
                        <i class="fas fa-check-circle"></i>
                        Published
                    </span>
                @else
                    <span class="status-badge-detail status-draft" style="position:static">
                        <i class="fas fa-clock"></i>
                        Draft
                    </span>
                @endif
            </div>
            @endif

            {{-- Meta Info Card --}}
            <div class="meta-info-card">
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="meta-content">
                        <div class="meta-label">Penulis</div>
                        <div class="meta-value">{{ $berita->createdBy?->name ?? 'Admin' }}</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="meta-content">
                        <div class="meta-label">Dibuat</div>
                        <div class="meta-value">{{ $berita->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="meta-content">
                        <div class="meta-label">Terakhir Update</div>
                        <div class="meta-value">{{ $berita->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="meta-content">
                        <div class="meta-label">Kategori</div>
                        <div class="meta-value">{{ ucfirst($berita->kategori ?? 'Umum') }}</div>
                    </div>
                </div>
            </div>

            {{-- Content Box --}}
            <div class="content-box">
                <div class="content-title">
                    <i class="fas fa-align-left"></i>
                    Konten Berita
                </div>
                <div class="article-text">
                    {{ $berita->konten }}
                </div>
            </div>
        </div>

        {{-- Action Buttons Bottom --}}
        <div class="action-buttons-bottom">
            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-action-modern btn-edit-modern">
                <i class="fas fa-edit"></i>Edit Berita
            </a>
            <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" style="display:inline" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn-action-modern btn-delete-modern btn-delete-confirm">
                    <i class="fas fa-trash"></i>Hapus Berita
                </button>
            </form>
            <a href="javascript:history.back()" class="btn-action-modern btn-back-modern">
                <i class="fas fa-arrow-left"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Konfirmasi hapus
    $('.btn-delete-confirm').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Berita akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
