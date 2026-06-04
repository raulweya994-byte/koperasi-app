@extends('layouts.app')
@section('title', 'Detail Galeri')

@push('styles')
<style>
    .detail-hero {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(26, 58, 110, 0.15);
        margin-bottom: 30px;
    }
    .detail-hero-image {
        width: 100%;
        max-height: 600px;
        object-fit: contain;
        background: #f3f4f6;
    }
    .detail-hero-video {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }
    .detail-hero-video iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }
    .tipe-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        z-index: 10;
    }
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }
    .info-row {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #f0f4ff;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        flex: 0 0 180px;
        font-weight: 600;
        color: #64748b;
        font-size: 14px;
    }
    .info-value {
        flex: 1;
        color: #1a3a6e;
        font-weight: 600;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div class="page-header-icon">
                                @if($galeri->tipe === 'foto')
                                    <i class="fas fa-image"></i>
                                @else
                                    <i class="fas fa-video"></i>
                                @endif
                            </div>
                            <div>
                                <h3 class="page-header-title">Detail {{ ucfirst($galeri->tipe) }} Galeri</h3>
                                <p class="page-header-subtitle">Informasi lengkap media galeri</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="javascript:history.back()" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Hero Section --}}
            <div class="detail-hero">
                @if($galeri->tipe === 'foto')
                    <span class="tipe-badge" style="background:linear-gradient(135deg,#10b981,#059669);color:white;">
                        <i class="fas fa-image mr-2"></i>FOTO
                    </span>
                    <img src="{{ asset('storage/' . $galeri->foto) }}" 
                         alt="{{ $galeri->judul }}"
                         class="detail-hero-image">
                @else
                    <span class="tipe-badge" style="background:linear-gradient(135deg,#ef4444,#dc2626);color:white;">
                        <i class="fas fa-video mr-2"></i>VIDEO
                    </span>
                    <div class="detail-hero-video">
                        @php
                            $videoId = '';
                            if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $galeri->video_url, $matches)) {
                                $videoId = $matches[1];
                            } elseif (preg_match('/youtu\.be\/([^?]+)/', $galeri->video_url, $matches)) {
                                $videoId = $matches[1];
                            }
                        @endphp
                        @if($videoId)
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                        @else
                            <video controls style="width:100%;height:100%;">
                                <source src="{{ $galeri->video_url }}" type="video/mp4">
                                Browser Anda tidak mendukung video.
                            </video>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Judul --}}
            <div class="content-card mb-4">
                <div class="content-card-body" style="padding:30px">
                    <h2 class="font-weight-bold mb-3" style="color:#1a3a6e;font-size:28px">
                        {{ $galeri->judul }}
                    </h2>
                    @if($galeri->deskripsi)
                        <p class="text-muted mb-0" style="font-size:15px;line-height:1.8">
                            {{ $galeri->deskripsi }}
                        </p>
                    @else
                        <p class="text-muted mb-0" style="font-size:15px;font-style:italic">
                            Tidak ada deskripsi
                        </p>
                    @endif
                </div>
            </div>

            {{-- Info Detail --}}
            <div class="info-card">
                <h5 class="font-weight-bold mb-4" style="color:#1a3a6e">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Detail
                </h5>

                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-layer-group mr-2"></i>Tipe Media
                    </div>
                    <div class="info-value">
                        @if($galeri->tipe === 'foto')
                            <span class="badge" style="background:linear-gradient(135deg,#10b981,#059669);color:white;padding:8px 16px;border-radius:8px;">
                                <i class="fas fa-image mr-1"></i>Foto
                            </span>
                        @else
                            <span class="badge" style="background:linear-gradient(135deg,#ef4444,#dc2626);color:white;padding:8px 16px;border-radius:8px;">
                                <i class="fas fa-video mr-1"></i>Video
                            </span>
                        @endif
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-tag mr-2"></i>Kategori
                    </div>
                    <div class="info-value">
                        <span class="badge badge-info-modern" style="padding:8px 16px;border-radius:8px;">
                            {{ ucfirst($galeri->kategori ?? 'kegiatan') }}
                        </span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-toggle-on mr-2"></i>Status
                    </div>
                    <div class="info-value">
                        @if($galeri->is_active)
                            <span class="badge badge-success-modern" style="padding:8px 16px;border-radius:8px;">
                                <i class="fas fa-check-circle mr-1"></i>Aktif
                            </span>
                        @else
                            <span class="badge badge-secondary" style="padding:8px 16px;border-radius:8px;">
                                <i class="fas fa-times-circle mr-1"></i>Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-sort-numeric-up mr-2"></i>Urutan
                    </div>
                    <div class="info-value">
                        {{ $galeri->urutan }}
                    </div>
                </div>

                @if($galeri->tipe === 'video' && $galeri->video_url)
                <div class="info-row">
                    <div class="info-label">
                        <i class="fab fa-youtube mr-2"></i>URL Video
                    </div>
                    <div class="info-value">
                        <a href="{{ $galeri->video_url }}" target="_blank" class="text-primary" style="word-break:break-all;">
                            {{ $galeri->video_url }}
                        </a>
                    </div>
                </div>
                @endif

                <div class="info-row">
                    <div class="info-label">
                        <i class="far fa-user mr-2"></i>Dibuat Oleh
                    </div>
                    <div class="info-value">
                        {{ $galeri->createdBy?->name ?? 'Admin' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        <i class="far fa-calendar-plus mr-2"></i>Tanggal Dibuat
                    </div>
                    <div class="info-value">
                        {{ $galeri->created_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">
                        <i class="far fa-calendar-check mr-2"></i>Terakhir Diupdate
                    </div>
                    <div class="info-value">
                        {{ $galeri->updated_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="content-card">
                <div class="content-card-body" style="background:#f8f9ff;display:flex;justify-content:space-between;align-items:center;padding:25px 30px">
                    <a href="javascript:history.back()" class="btn btn-secondary btn-modern">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <div class="d-flex gap-2" style="gap:10px">
                        <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-warning-modern">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" 
                                class="btn btn-danger-modern" 
                                onclick="confirmDelete()">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Form (Hidden) --}}
    <form id="deleteForm" action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete() {
    Swal.fire({
        title: 'Hapus Media Galeri?',
        html: `Apakah Anda yakin ingin menghapus:<br><strong>"{{ $galeri->judul }}"</strong>?<br><br><small class="text-danger">Data yang dihapus tidak dapat dikembalikan!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
        reverseButtons: true,
        customClass: {
            popup: 'swal-modern',
            confirmButton: 'btn-modern',
            cancelButton: 'btn-modern'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            document.getElementById('deleteForm').submit();
        }
    });
}
</script>

<style>
.swal-modern {
    border-radius: 16px;
    padding: 20px;
}
.swal2-title {
    color: #1a3a6e;
    font-size: 22px;
    font-weight: 700;
}
.swal2-html-container {
    font-size: 14px;
    color: #64748b;
}
.btn-modern {
    border-radius: 8px;
    padding: 10px 24px;
    font-weight: 600;
    font-size: 14px;
}
</style>
@endpush
