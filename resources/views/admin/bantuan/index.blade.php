@extends('layouts.app')
@section('title', 'Daftar Program Bantuan')

@push('styles')
<style>
    /* Action Buttons */
    .btn-group .btn {
        padding: 6px 12px;
        font-size: 13px;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .btn-group .btn-info {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    
    .btn-group .btn-info:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }
    
    .btn-group .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .btn-group .btn-warning:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    }
    
    .btn-group .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-group .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    }
    
    /* Table hover effect */
    .table-modern tbody tr {
        transition: all 0.3s ease;
    }
    
    .table-modern tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    /* Badge improvements */
    .badge-custom {
        padding: 6px 12px;
        font-size: 11px;
        font-weight: 600;
        border-radius: 6px;
        letter-spacing: 0.3px;
    }
    
    .badge-purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }
    
    .badge-blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    
    /* Status badge */
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .status-active {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }
    
    /* Tooltip custom */
    .tooltip-inner {
        background-color: #1f2937;
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 6px;
    }
    
    .tooltip.bs-tooltip-top .arrow::before {
        border-top-color: #1f2937;
    }
    
    .tooltip.bs-tooltip-bottom .arrow::before {
        border-bottom-color: #1f2937;
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
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Daftar Program Bantuan</h3>
                                <p class="page-header-subtitle">Kelola program bantuan untuk koperasi</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('admin.bantuan.create') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-plus"></i> Tambah Program
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-blue">
                <div class="stats-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $bantuan->total() }}</h3>
                    <p>Total Bantuan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-green">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $bantuan->where('status', 'aktif')->count() }}</h3>
                    <p>Bantuan Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-orange">
                <div class="stats-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $bantuan->where('tahun', date('Y'))->count() }}</h3>
                    <p>Tahun Ini</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-cyan">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $bantuan->sum(fn($b) => $b->penerima->count()) }}</h3>
                    <p>Penerima</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-box">
                <form method="GET" action="{{ route('admin.bantuan.index') }}">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cari Program Bantuan</label>
                                <div class="search-box-modern">
                                    <i class="fas fa-search"></i>
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Nama / kode bantuan..." value="{{ request('search') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="tahun" class="form-control"
                                       placeholder="Tahun" value="{{ request('tahun') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary-modern btn-block">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="{{ route('admin.bantuan.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title mb-0">
                        <i class="fas fa-list"></i> Daftar Program Bantuan
                    </h5>
                </div>
                <div class="content-card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="12%">Kode</th>
                                    <th>Nama Bantuan</th>
                                    <th>Jenis</th>
                                    <th width="8%">Tahun</th>
                                    <th width="10%">Status</th>
                                    <th>Dibuat Oleh</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bantuan as $item)
                                <tr>
                                    <td>{{ $bantuan->firstItem() + $loop->index }}</td>
                                    <td>
                                        <span class="badge badge-custom badge-purple">{{ $item->kode_bantuan }}</span>
                                    </td>
                                    <td>
                                        <div class="list-item-title">{{ $item->nama_bantuan }}</div>
                                        @if($item->periode)
                                        <div class="list-item-subtitle">
                                            <i class="far fa-calendar mr-1"></i>{{ $item->periode }}
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-custom badge-blue">
                                            {{ ucfirst(str_replace('_', ' ', $item->jenis_bantuan)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="text-primary">{{ $item->tahun }}</strong>
                                    </td>
                                    <td>
                                        @if($item->status === 'aktif')
                                            <span class="status-badge status-active">
                                                <i class="fas fa-check-circle"></i> Aktif
                                            </span>
                                        @else
                                            <span class="status-badge status-inactive">
                                                <i class="fas fa-times-circle"></i> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="list-item-subtitle">
                                            <i class="fas fa-user mr-1"></i>{{ $item->createdBy?->name ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.bantuan.show', $item) }}" 
                                               class="btn btn-sm btn-info" 
                                               data-toggle="tooltip" 
                                               title="Lihat Detail"
                                               style="border-radius: 6px 0 0 6px;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.bantuan.edit', $item) }}" 
                                               class="btn btn-sm btn-warning" 
                                               data-toggle="tooltip" 
                                               title="Edit Data"
                                               style="border-radius: 0;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger btn-delete" 
                                                    data-toggle="tooltip" 
                                                    title="Hapus Data"
                                                    data-id="{{ $item->id }}"
                                                    data-nama="{{ $item->nama_bantuan }}"
                                                    style="border-radius: 0 6px 6px 0;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $item->id }}" 
                                              method="POST" 
                                              action="{{ route('admin.bantuan.destroy', $item) }}" 
                                              style="display:none">
                                            @csrf @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h5>Tidak Ada Data</h5>
                                            <p>Belum ada program bantuan yang tersedia</p>
                                            <a href="{{ route('admin.bantuan.create') }}" class="btn btn-primary-modern">
                                                <i class="fas fa-plus"></i> Tambah Program Bantuan
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($bantuan->hasPages())
                <div class="content-card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $bantuan->firstItem() }}–{{ $bantuan->lastItem() }} dari {{ $bantuan->total() }} data
                        </small>
                        <div>
                            {{ $bantuan->links('pagination::bootstrap-4') }}
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
    
    // Konfirmasi hapus dengan SweetAlert2
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `Apakah Anda yakin ingin menghapus program bantuan:<br><strong>${nama}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-danger btn-lg px-4',
                cancelButton: 'btn btn-secondary btn-lg px-4 mr-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit form
                $('#delete-form-' + id).submit();
            }
        });
    });
    
    // Success message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif
    
    // Error message
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#3b82f6'
        });
    @endif
});
</script>
@endpush
