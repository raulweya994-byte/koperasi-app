@extends('layouts.app')
@section('title', 'Pengajuan Kebutuhan Bantuan')

@push('styles')
<style>
    /* Header Card */
    .pengajuan-header-card {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 16px;
        border: none;
        box-shadow: 0 8px 24px rgba(139, 92, 246, 0.3);
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .pengajuan-header-content {
        padding: 30px;
        color: white;
    }
    
    .pengajuan-header-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-right: 20px;
        backdrop-filter: blur(10px);
    }
    
    /* Stats Cards */
    .stats-card-pengajuan {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 24px;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .stats-card-pengajuan:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    .stats-icon-pengajuan {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 16px;
    }
    
    .stats-value {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    
    .stats-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
    }
    
    /* Filter Box */
    .filter-box-modern {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 24px;
        margin-bottom: 24px;
    }
    
    /* Table Card */
    .table-card-modern {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .table-card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 24px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .table-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    /* Table Modern */
    .table-pengajuan {
        margin-bottom: 0;
    }
    
    .table-pengajuan thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #475569;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px;
        border: none;
    }
    
    .table-pengajuan tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }
    
    .table-pengajuan tbody tr:hover {
        background-color: #f8fafc;
    }
    
    /* Badge Status */
    .badge-status-modern {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .badge-menunggu {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .badge-disetujui {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .badge-ditolak {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .badge-diproses {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    
    /* Action Buttons */
    .btn-action-group {
        display: flex;
        gap: 6px;
    }
    
    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    
    .btn-detail:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        color: white;
    }
    
    .btn-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .btn-approve:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        color: white;
    }
    
    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-reject:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        color: white;
    }
    
    /* Empty State */
    .empty-state-pengajuan {
        text-align: center;
        padding: 80px 20px;
        color: #94a3b8;
    }
    
    .empty-state-pengajuan i {
        font-size: 80px;
        margin-bottom: 24px;
        opacity: 0.3;
    }
    
    .empty-state-pengajuan h5 {
        color: #64748b;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 20px;
    }
    
    .empty-state-pengajuan p {
        color: #94a3b8;
        font-size: 14px;
    }
    
    /* User Info */
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
    }
    
    .user-details strong {
        display: block;
        color: #1e293b;
        font-size: 14px;
        margin-bottom: 2px;
    }
    
    .user-details small {
        color: #64748b;
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="pengajuan-header-card">
        <div class="pengajuan-header-content">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="pengajuan-header-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">Pengajuan Kebutuhan Bantuan</h3>
                        <p class="mb-0" style="font-size: 14px; opacity: 0.9;">
                            <i class="fas fa-users mr-2"></i>Kelola pengajuan bantuan dari anggota koperasi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px; border-left: 4px solid #10b981;">
        <i class="fas fa-check-circle mr-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-pengajuan">
                <div class="stats-icon-pengajuan" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fas fa-clock text-white"></i>
                </div>
                <div class="stats-value" style="color: #f59e0b;">
                    {{ $pengajuan->where('status', 'menunggu')->count() }}
                </div>
                <div class="stats-label">Menunggu Verifikasi</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-pengajuan">
                <div class="stats-icon-pengajuan" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                    <i class="fas fa-spinner text-white"></i>
                </div>
                <div class="stats-value" style="color: #3b82f6;">
                    {{ $pengajuan->where('status', 'diproses')->count() }}
                </div>
                <div class="stats-label">Sedang Diproses</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-pengajuan">
                <div class="stats-icon-pengajuan" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
                <div class="stats-value" style="color: #10b981;">
                    {{ $pengajuan->where('status', 'disetujui')->count() }}
                </div>
                <div class="stats-label">Disetujui</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-pengajuan">
                <div class="stats-icon-pengajuan" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                    <i class="fas fa-times-circle text-white"></i>
                </div>
                <div class="stats-value" style="color: #ef4444;">
                    {{ $pengajuan->where('status', 'ditolak')->count() }}
                </div>
                <div class="stats-label">Ditolak</div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-box-modern">
        <form method="GET" action="{{ route('admin.pengajuan-bantuan.index') }}">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label class="font-weight-600 mb-2" style="font-size: 14px; color: #475569;">
                        <i class="fas fa-filter mr-1"></i> Filter Status
                    </label>
                    <select name="status" class="form-control" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 16px;" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach(['menunggu'=>'Menunggu Verifikasi','diproses'=>'Sedang Diproses','disetujui'=>'Disetujui','ditolak'=>'Ditolak'] as $v=>$l)
                        <option value="{{ $v }}" {{ request('status')==$v?'selected':'' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="font-weight-600 mb-2" style="font-size: 14px; color: #475569;">
                        <i class="fas fa-search mr-1"></i> Cari Pemohon
                    </label>
                    <input type="text" name="search" class="form-control" placeholder="Nama pemohon..." value="{{ request('search') }}" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 16px;">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.pengajuan-bantuan.index') }}" class="btn btn-secondary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="table-card-modern">
        <div class="table-card-header">
            <h5 class="table-card-title">
                <i class="fas fa-list text-purple"></i>
                Daftar Pengajuan Bantuan
                <span class="badge badge-primary ml-2" style="font-size: 12px;">{{ $pengajuan->total() }} Total</span>
            </h5>
        </div>
        <div class="table-responsive">
            <table class="table table-pengajuan">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Pemohon</th>
                        <th width="15%">Nama Usaha</th>
                        <th width="12%">Jenis Bantuan</th>
                        <th width="12%">Jumlah</th>
                        <th width="10%">Periode</th>
                        <th width="10%">Status</th>
                        <th width="16%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuan as $i=>$p)
                    <tr>
                        <td>{{ $pengajuan->firstItem() + $i }}</td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($p->anggota->nama ?? $p->nama_pemohon ?? 'A', 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <strong>{{ $p->anggota->nama ?? $p->nama_pemohon ?? '-' }}</strong>
                                    <small><i class="fas fa-phone mr-1"></i>{{ $p->anggota->no_hp ?? $p->no_hp ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $p->anggota->nama_usaha ?? $p->nama_usaha ?? '-' }}</strong>
                        </td>
                        <td>
                            <span class="badge badge-info" style="padding: 6px 12px; border-radius: 6px;">
                                {{ ucfirst($p->jenis_bantuan ?? 'Umum') }}
                            </span>
                        </td>
                        <td>
                            <strong class="text-success">
                                {{ $p->jumlah_diajukan ? 'Rp '.number_format($p->jumlah_diajukan,0,',','.') : '-' }}
                            </strong>
                        </td>
                        <td>
                            <small class="text-muted">
                                <i class="far fa-calendar mr-1"></i>
                                {{ $p->periodeBantuan->nama_periode ?? '-' }}
                            </small>
                        </td>
                        <td>
                            @php
                                $statusClass = match($p->status) {
                                    'disetujui' => 'badge-disetujui',
                                    'ditolak' => 'badge-ditolak',
                                    'diproses' => 'badge-diproses',
                                    default => 'badge-menunggu'
                                };
                                $statusIcon = match($p->status) {
                                    'disetujui' => 'fa-check-circle',
                                    'ditolak' => 'fa-times-circle',
                                    'diproses' => 'fa-spinner',
                                    default => 'fa-clock'
                                };
                            @endphp
                            <span class="badge-status-modern {{ $statusClass }}">
                                <i class="fas {{ $statusIcon }}"></i>
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-action-group">
                                <a href="{{ route('admin.pengajuan-bantuan.show', $p) }}" 
                                   class="btn-action btn-detail"
                                   data-toggle="tooltip"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($p->status === 'menunggu')
                                <button type="button" 
                                        class="btn-action btn-approve btn-approve-pengajuan"
                                        data-id="{{ $p->id }}"
                                        data-nama="{{ $p->anggota->nama ?? $p->nama_pemohon }}"
                                        data-toggle="tooltip"
                                        title="Setujui">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" 
                                        class="btn-action btn-reject btn-reject-pengajuan"
                                        data-id="{{ $p->id }}"
                                        data-nama="{{ $p->anggota->nama ?? $p->nama_pemohon }}"
                                        data-toggle="tooltip"
                                        title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state-pengajuan">
                                <i class="fas fa-inbox"></i>
                                <h5>Belum Ada Pengajuan</h5>
                                <p>Belum ada pengajuan bantuan dari anggota</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengajuan->hasPages())
        <div class="card-footer bg-white" style="padding: 20px 24px;">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $pengajuan->firstItem() }}–{{ $pengajuan->lastItem() }} dari {{ $pengajuan->total() }} data
                </small>
                <div>
                    {{ $pengajuan->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Approve Pengajuan
    $('.btn-approve-pengajuan').on('click', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        
        Swal.fire({
            title: 'Setujui Pengajuan?',
            html: `Apakah Anda yakin ingin menyetujui pengajuan dari:<br><strong>${nama}</strong>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-check mr-2"></i>Ya, Setujui!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-success btn-lg px-4',
                cancelButton: 'btn btn-secondary btn-lg px-4 mr-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit via AJAX
                $.ajax({
                    url: `/admin/pengajuan-bantuan/${id}`,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: 'disetujui',
                        catatan_admin: 'Pengajuan disetujui'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pengajuan telah disetujui',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat memproses pengajuan'
                        });
                    }
                });
            }
        });
    });
    
    // Reject Pengajuan
    $('.btn-reject-pengajuan').on('click', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        
        Swal.fire({
            title: 'Tolak Pengajuan?',
            html: `
                <p>Apakah Anda yakin ingin menolak pengajuan dari:<br><strong>${nama}</strong>?</p>
                <textarea id="catatan-tolak" class="form-control mt-3" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-times mr-2"></i>Ya, Tolak!',
            cancelButtonText: '<i class="fas fa-arrow-left mr-2"></i>Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-danger btn-lg px-4',
                cancelButton: 'btn btn-secondary btn-lg px-4 mr-2'
            },
            buttonsStyling: false,
            preConfirm: () => {
                const catatan = document.getElementById('catatan-tolak').value;
                if (!catatan) {
                    Swal.showValidationMessage('Mohon masukkan alasan penolakan');
                }
                return catatan;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit via AJAX
                $.ajax({
                    url: `/admin/pengajuan-bantuan/${id}`,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: 'ditolak',
                        catatan_admin: result.value
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pengajuan telah ditolak',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat memproses pengajuan'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush
