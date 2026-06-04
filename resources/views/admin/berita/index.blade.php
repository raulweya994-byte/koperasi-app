@extends('layouts.app')
@section('title', 'Manajemen Berita & Artikel')

@push('styles')
<style>
    /* Page Header Card Modern */
    .page-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        overflow: hidden;
        position: relative;
    }

    .page-header-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .page-header-card .card-body {
        padding: 28px 30px;
        position: relative;
        z-index: 1;
    }

    .page-header-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.25);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .page-header-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .page-header-subtitle {
        font-size: 14px;
        opacity: 0.95;
        margin: 0;
    }

    .btn-modern {
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .btn-light.btn-modern {
        background: white;
        color: #667eea;
    }

    .btn-light.btn-modern:hover {
        background: #f8f9fa;
        color: #667eea;
    }

    /* Alert Modern */
    .alert-success-modern {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        border: none;
        border-left: 4px solid #10b981;
        border-radius: 12px;
        padding: 15px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .alert-success-modern i {
        font-size: 18px;
        margin-right: 10px;
    }

    .alert-success-modern .close {
        color: #065f46;
        opacity: 0.7;
    }

    /* Content Card Modern */
    .content-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
    }

    .content-card-header {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        padding: 20px 28px;
        border-bottom: 2px solid #e8ebf7;
    }

    .content-card-title {
        font-size: 17px;
        font-weight: 700;
        color: #495057;
    }

    .content-card-title i {
        color: #667eea;
        margin-right: 8px;
    }

    .content-card-body {
        padding: 0;
    }

    /* Table Modern */
    .table-modern {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-modern thead {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .table-modern thead th {
        padding: 18px 20px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        white-space: nowrap;
    }

    .table-modern thead th:first-child {
        border-radius: 0;
    }

    .table-modern thead th:last-child {
        border-radius: 0;
    }

    .table-modern tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }

    .table-modern tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .table-modern tbody td {
        padding: 20px;
        vertical-align: middle;
        border: none;
        font-size: 14px;
        color: #374151;
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    /* Table Cell Styles */
    .table-cell-number {
        text-align: center;
        font-weight: 700;
        color: #667eea;
        font-size: 15px;
    }

    .table-cell-image img {
        width: 100px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .table-cell-image .image-placeholder {
        width: 100px;
        height: 70px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    .table-cell-content {
        max-width: 400px;
    }

    .table-cell-title {
        font-size: 15px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 6px;
        line-height: 1.4;
        display: block;
    }

    .table-cell-description {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 8px;
        display: block;
    }

    .table-cell-meta {
        font-size: 12px;
        color: #9ca3af;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-cell-meta i {
        color: #667eea;
        margin-right: 4px;
    }

    .table-cell-meta .meta-separator {
        color: #d1d5db;
    }

    /* Badge Custom */
    .badge-custom {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-purple {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .badge-blue {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
    }

    /* Status Badge */
    .status-badge {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .status-active {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
    }

    .status-pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn-info-modern {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .btn-info-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        color: white;
    }

    .btn-warning-modern {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .btn-warning-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        color: white;
    }

    .btn-danger-modern {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .btn-danger-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        color: white;
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 72px;
        color: #e5e7eb;
        margin-bottom: 20px;
        opacity: 0.6;
    }

    .empty-state h5 {
        color: #374151;
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .empty-state p {
        color: #9ca3af;
        margin-bottom: 20px;
        font-size: 14px;
    }

    /* Pagination */
    .pagination {
        margin: 0;
    }

    .page-link {
        border-radius: 8px;
        margin: 0 3px;
        border: 1px solid #e5e7eb;
        color: #667eea;
        font-weight: 600;
    }

    .page-link:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: #667eea;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header-card .card-body {
            padding: 20px 25px;
        }

        .page-header-icon {
            width: 60px;
            height: 60px;
            font-size: 28px;
            margin-right: 15px;
        }

        .page-header-title {
            font-size: 20px;
        }

        .page-header-subtitle {
            font-size: 13px;
        }

        .content-card-body {
            padding: 0;
        }

        .empty-state {
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 56px;
        }

        .status-badge {
            font-size: 11px;
            padding: 6px 10px;
        }

        .table-modern thead th {
            padding: 14px 12px;
            font-size: 11px;
        }

        .table-modern tbody td {
            padding: 15px 12px;
            font-size: 13px;
        }

        .table-cell-image img,
        .table-cell-image .image-placeholder {
            width: 80px;
            height: 60px;
        }

        .table-cell-title {
            font-size: 14px;
        }

        .table-cell-description {
            font-size: 12px;
        }

        .table-cell-meta {
            font-size: 11px;
        }

        .action-buttons {
            gap: 6px;
        }

        .btn-info-modern,
        .btn-warning-modern,
        .btn-danger-modern {
            padding: 6px 10px;
            font-size: 12px;
        }
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
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Manajemen Berita & Artikel</h3>
                                <p class="page-header-subtitle">Kelola semua berita dan artikel yang dipublikasikan</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('admin.berita.create') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-plus"></i> Tulis Berita Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success-modern alert-dismissible fade show">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Berita List --}}
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title mb-0">
                        <i class="fas fa-list"></i> Daftar Berita & Artikel
                    </h5>
                </div>
                <div class="content-card-body">
                    @if($berita->count() > 0)
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th style="width: 120px;">Gambar</th>
                                    <th>Judul & Deskripsi</th>
                                    <th style="width: 150px;">Status</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($berita as $item)
                                <tr>
                                    <td class="table-cell-number">
                                        {{ $berita->firstItem() + $loop->index }}
                                    </td>
                                    
                                    <td class="table-cell-image">
                                        @if ($item->thumbnail)
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                                 alt="Thumbnail">
                                        @else
                                            <div class="image-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td class="table-cell-content">
                                        <span class="table-cell-title">
                                            {{ Str::limit($item->judul, 80) }}
                                        </span>
                                        <span class="table-cell-description">
                                            {{ Str::limit(strip_tags($item->konten), 120) }}
                                        </span>
                                        <div class="table-cell-meta">
                                            <span class="badge badge-custom badge-blue">
                                                {{ ucfirst($item->kategori ?? 'Umum') }}
                                            </span>
                                            <span>
                                                <i class="fas fa-user"></i>{{ $item->createdBy?->name ?? '-' }}
                                            </span>
                                            <span class="meta-separator">•</span>
                                            <span>
                                                <i class="far fa-calendar"></i>{{ $item->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td class="text-center">
                                        @if($item->status === 'publish')
                                            <span class="status-badge status-active">
                                                <i class="fas fa-check-circle"></i>Published
                                            </span>
                                        @else
                                            <span class="status-badge status-pending">
                                                <i class="fas fa-clock"></i>Draft
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <div class="action-buttons" style="justify-content: center;">
                                            <a href="{{ route('admin.berita.show', $item) }}" 
                                               class="btn btn-sm btn-info-modern" 
                                               title="Detail"
                                               data-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.berita.edit', $item) }}" 
                                               class="btn btn-sm btn-warning-modern" 
                                               title="Edit"
                                               data-toggle="tooltip">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.berita.destroy', $item) }}" 
                                                  method="POST" 
                                                  style="display:inline"
                                                  class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger-modern btn-delete" 
                                                        title="Hapus"
                                                        data-toggle="tooltip">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <h5>Belum Ada Berita</h5>
                        <p>Mulai tulis berita atau artikel pertama Anda</p>
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary-modern">
                            <i class="fas fa-plus"></i> Tulis Berita Baru
                        </a>
                    </div>
                    @endif
                </div>
                @if($berita->hasPages())
                <div class="content-card-body" style="padding: 20px 28px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $berita->firstItem() }}–{{ $berita->lastItem() }} dari {{ $berita->total() }} berita
                        </small>
                        <div>
                            {{ $berita->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Konfirmasi hapus
    $('.btn-delete').on('click', function(e) {
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
