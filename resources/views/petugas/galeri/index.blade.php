@extends('layouts.app')
@section('title', 'Galeri Kegiatan')

@push('styles')
<style>
    .foto-thumbnail {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.12);
        cursor: pointer;
        transition: all 0.3s;
    }
    .foto-thumbnail:hover {
        transform: scale(1.08);
        box-shadow: 0 5px 15px rgba(0,0,0,0.25);
    }
    
    .table-modern tbody tr {
        transition: all 0.2s;
    }
    .table-modern tbody tr:hover {
        background: #f8f9ff;
        transform: translateX(2px);
    }
    
    .btn-action-group {
        display: flex;
        gap: 5px;
        justify-content: center;
    }
    
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .btn-action i {
        font-size: 13px;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: white;
    }
    .btn-detail:hover {
        background: linear-gradient(135deg, #0891b2, #0e7490);
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    .btn-edit:hover {
        background: linear-gradient(135deg, #d97706, #b45309);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }
    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
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
                                <i class="fas fa-images"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Galeri Kegiatan</h3>
                                <p class="page-header-subtitle">Kelola dokumentasi foto kegiatan dan program</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.galeri.create') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-plus"></i> Tambah Foto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success-modern alert-dismissible fade show">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    {{-- Table Galeri --}}
    <div class="content-card">
        <div class="content-card-header">
            <h5 class="content-card-title">
                <i class="fas fa-list"></i> Daftar Foto Galeri
            </h5>
        </div>
        
        <div class="content-card-body p-0">
            @if($galeri->count() > 0)
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="5%" style="padding: 15px;">No</th>
                            <th width="12%" style="padding: 15px;">Foto</th>
                            <th width="23%" style="padding: 15px;">Judul</th>
                            <th width="28%" style="padding: 15px;">Deskripsi</th>
                            <th width="10%" style="padding: 15px;">Kategori</th>
                            <th width="10%" style="padding: 15px;">Tanggal</th>
                            <th width="12%" class="text-center" style="padding: 15px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galeri as $index => $item)
                        <tr>
                            <td style="padding: 15px; vertical-align: middle;">
                                <strong style="color: #1a3a6e;">{{ $galeri->firstItem() + $index }}</strong>
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <img src="{{ asset('storage/' . $item->foto) }}" 
                                     alt="{{ $item->judul }}"
                                     class="foto-thumbnail"
                                     data-toggle="modal" 
                                     data-target="#viewModal{{ $item->id }}">
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <strong style="color: #1a3a6e; font-size: 14px;">{{ $item->judul }}</strong>
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <span class="text-muted" style="font-size: 13px; line-height: 1.6;">
                                    {{ $item->deskripsi ? Str::limit($item->deskripsi, 100) : '-' }}
                                </span>
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <span class="badge badge-info-modern" style="font-size: 12px; padding: 6px 12px;">
                                    {{ ucfirst($item->kategori ?? 'kegiatan') }}
                                </span>
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <small class="text-muted" style="font-size: 12px;">
                                    <i class="far fa-calendar mr-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </td>
                            <td class="text-center" style="padding: 15px; vertical-align: middle;">
                                <div class="btn-action-group">
                                    <button type="button" 
                                            class="btn-action btn-detail"
                                            data-toggle="modal" 
                                            data-target="#viewModal{{ $item->id }}"
                                            title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('petugas.galeri.edit', $item) }}" 
                                       class="btn-action btn-edit"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn-action btn-delete"
                                            onclick="confirmDelete({{ $item->id }}, '{{ $item->judul }}')"
                                            title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        {{-- View Modal --}}
                        <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content modal-modern">
                                    <div class="modal-header" style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);color:white;border-radius:16px 16px 0 0">
                                        <h5 class="modal-title font-weight-bold">
                                            <i class="fas fa-image mr-2"></i>{{ $item->judul }}
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="padding:30px">
                                        <img src="{{ asset('storage/' . $item->foto) }}" 
                                             alt="{{ $item->judul }}" 
                                             style="width:100%;border-radius:12px;margin-bottom:20px;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                                        
                                        @if($item->deskripsi)
                                        <div class="mb-3">
                                            <h6 class="font-weight-bold" style="color:#1a3a6e">
                                                <i class="fas fa-align-left mr-2"></i>Deskripsi:
                                            </h6>
                                            <p class="text-muted">{{ $item->deskripsi }}</p>
                                        </div>
                                        @endif
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <small class="text-muted">Kategori:</small><br>
                                                    <span class="badge badge-info-modern">
                                                        {{ ucfirst($item->kategori ?? 'kegiatan') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <small class="text-muted">Status:</small><br>
                                                    <span class="badge badge-success-modern">
                                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        
                                        <div class="d-flex justify-content-between text-muted" style="font-size:13px">
                                            <span>
                                                <i class="far fa-calendar mr-1"></i>
                                                {{ $item->created_at->format('d F Y, H:i') }}
                                            </span>
                                            <span>
                                                <i class="far fa-user mr-1"></i>
                                                {{ $item->createdBy?->name ?? 'Admin' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="border-top:1px solid #eef;background:#f8f9ff">
                                        <a href="{{ route('petugas.galeri.edit', $item) }}" class="btn btn-warning-modern">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">
                                            <i class="fas fa-times"></i> Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h5>Belum Ada Foto Galeri</h5>
                <p>Mulai tambahkan foto kegiatan dan dokumentasi program Anda</p>
                <a href="{{ route('petugas.galeri.create') }}" class="btn btn-primary-modern">
                    <i class="fas fa-plus"></i> Tambah Foto Pertama
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Pagination --}}
    @if($galeri->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $galeri->links('pagination::bootstrap-4', ['class' => 'pagination-modern']) }}
            </div>
        </div>
    </div>
    @endif

    {{-- Delete Form (Hidden) --}}
    <form id="deleteForm" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id, judul) {
    Swal.fire({
        title: 'Hapus Foto Galeri?',
        html: `Apakah Anda yakin ingin menghapus foto:<br><strong>"${judul}"</strong>?<br><br><small class="text-danger">Foto yang dihapus tidak dapat dikembalikan!</small>`,
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
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit delete form
            const form = document.getElementById('deleteForm');
            form.action = `/admin/galeri/${id}`;
            form.submit();
        }
    });
}

// Success message
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false,
        customClass: {
            popup: 'swal-modern'
        }
    });
@endif
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
