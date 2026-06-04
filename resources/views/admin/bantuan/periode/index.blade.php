@extends('layouts.app')
@section('title', 'Periode Bantuan')

@push('styles')
<style>
    .period-stats-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .period-stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .period-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .period-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .period-card.active {
        border-left: 5px solid #10b981;
        background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
    }
    
    .period-card.inactive {
        border-left: 5px solid #6b7280;
        opacity: 0.85;
    }
    
    .status-badge-large {
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .status-badge-large.active {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        animation: pulse-green 2s infinite;
    }
    
    .status-badge-large.inactive {
        background: #e5e7eb;
        color: #6b7280;
    }
    
    @keyframes pulse-green {
        0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        50% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
    }
    
    .action-btn {
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .filter-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        background: white;
    }
    
    .empty-illustration {
        width: 200px;
        height: 200px;
        margin: 0 auto 30px;
        opacity: 0.3;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border-left: 5px solid #10b981;">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; border-left: 5px solid #ef4444;">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Gagal!</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card period-stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon mx-auto" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="font-weight-bold mb-1" style="color: #2d3748;">{{ \App\Models\PeriodeBantuan::count() }}</h3>
                    <p class="text-muted mb-0" style="font-size: 13px;">Total Periode</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card period-stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon mx-auto" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="font-weight-bold mb-1" style="color: #2d3748;">{{ \App\Models\PeriodeBantuan::where('status', 'aktif')->count() }}</h3>
                    <p class="text-muted mb-0" style="font-size: 13px;">Periode Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card period-stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon mx-auto" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="font-weight-bold mb-1" style="color: #2d3748;">{{ \App\Models\PengajuanBantuan::count() }}</h3>
                    <p class="text-muted mb-0" style="font-size: 13px;">Total Pengajuan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card period-stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon mx-auto" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="font-weight-bold mb-1" style="color: #2d3748;">{{ \App\Models\User::where('role', 'anggota')->count() }}</h3>
                    <p class="text-muted mb-0" style="font-size: 13px;">Total Anggota</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Header & Filter --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card filter-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-1 font-weight-bold" style="color: #1a3a6e;">
                                <i class="fas fa-calendar-check me-2"></i>Kelola Periode Bantuan
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 14px;">
                                Buka/tutup periode penerimaan pengajuan bantuan dari anggota
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.periode-bantuan.create') }}" class="btn btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px; padding: 12px 30px; font-weight: 700;">
                                <i class="fas fa-plus me-2"></i>Tambah Periode
                            </a>
                        </div>
                    </div>
                    
                    {{-- Filter Form --}}
                    <form method="GET" class="mt-3">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label class="font-weight-600" style="font-size: 13px; color: #64748b;">Filter Status</label>
                                <select name="status" class="form-control" style="border-radius: 10px; border: 2px solid #e2e8f0;">
                                    <option value="">📋 Semua Status</option>
                                    <option value="aktif" {{ request('status')=='aktif'?'selected':'' }}>✅ Aktif</option>
                                    <option value="nonaktif" {{ request('status')=='nonaktif'?'selected':'' }}>⏸️ Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.periode-bantuan.index') }}" class="btn btn-secondary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                                    <i class="fas fa-redo me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Periode Cards --}}
    @forelse($periodes as $periode)
    <div class="period-card {{ $periode->status === 'aktif' ? 'active' : 'inactive' }}">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="d-flex align-items-start">
                        <div style="width: 60px; height: 60px; background: {{ $periode->status === 'aktif' ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : '#e5e7eb' }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0;">
                            <i class="fas fa-calendar-alt fa-2x" style="color: {{ $periode->status === 'aktif' ? 'white' : '#9ca3af' }};"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="mb-0 font-weight-bold" style="color: #1a3a6e;">{{ $periode->nama_periode }}</h5>
                                <span class="status-badge-large {{ $periode->status === 'aktif' ? 'active' : 'inactive' }} ml-3">
                                    <i class="fas {{ $periode->status === 'aktif' ? 'fa-check-circle' : 'fa-pause-circle' }}"></i>
                                    {{ $periode->status === 'aktif' ? 'AKTIF' : 'NONAKTIF' }}
                                </span>
                            </div>
                            @if($periode->deskripsi)
                            <p class="text-muted mb-2" style="font-size: 14px;">{{ $periode->deskripsi }}</p>
                            @endif
                            <div class="d-flex flex-wrap gap-3 mt-3">
                                <div>
                                    <small class="text-muted d-block" style="font-size: 11px;">Periode</small>
                                    <strong style="font-size: 13px; color: #475569;">
                                        <i class="far fa-calendar text-primary me-1"></i>
                                        {{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }}
                                    </strong>
                                </div>
                                @if($periode->kuota_penerima)
                                <div class="ml-3">
                                    <small class="text-muted d-block" style="font-size: 11px;">Kuota</small>
                                    <strong style="font-size: 13px; color: #475569;">
                                        <i class="fas fa-users text-info me-1"></i>
                                        {{ $periode->sisaKuota() }} / {{ $periode->kuota_penerima }} tersisa
                                    </strong>
                                </div>
                                @endif
                                <div class="ml-3">
                                    <small class="text-muted d-block" style="font-size: 11px;">Pengajuan</small>
                                    <strong style="font-size: 13px; color: #475569;">
                                        <i class="fas fa-clipboard-list text-warning me-1"></i>
                                        {{ $periode->jumlahPengajuan() }} pengajuan
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 text-right mt-3 mt-lg-0">
                    <div class="d-flex justify-content-end align-items-center gap-2">
                        {{-- Toggle Status Button --}}
                        <form action="{{ route('admin.periode-bantuan.toggle', $periode) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" 
                                    class="action-btn {{ $periode->status === 'aktif' ? 'btn-warning' : 'btn-success' }}"
                                    style="min-width: 120px;"
                                    onclick="return confirm('{{ $periode->status === 'aktif' ? 'Tutup periode ini? Anggota tidak akan bisa mengajukan bantuan.' : 'Buka periode ini? Semua anggota akan mendapat notifikasi.' }}')">
                                <i class="fas {{ $periode->status === 'aktif' ? 'fa-pause' : 'fa-play' }} me-1"></i>
                                {{ $periode->status === 'aktif' ? 'Tutup' : 'Buka' }}
                            </button>
                        </form>
                        
                        {{-- Edit Button --}}
                        <a href="{{ route('admin.periode-bantuan.edit', $periode) }}" 
                           class="action-btn btn-info"
                           title="Edit Periode">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        {{-- Delete Button --}}
                        <button type="button" 
                                class="action-btn btn-danger" 
                                onclick="confirmDelete({{ $periode->id }}, '{{ $periode->nama_periode }}')"
                                title="Hapus Periode">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    @if($periode->status === 'aktif')
                    <div class="mt-3">
                        <div class="alert alert-success mb-0" style="border-radius: 10px; padding: 10px 15px; font-size: 12px;">
                            <i class="fas fa-bell me-1"></i>
                            <strong>Notifikasi Aktif:</strong> Anggota sudah menerima pemberitahuan
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
        <div class="card-body text-center py-5">
            <div class="empty-illustration">
                <i class="fas fa-calendar-times" style="font-size: 120px; color: #e5e7eb;"></i>
            </div>
            <h4 class="font-weight-bold mb-3" style="color: #6b7280;">Belum Ada Periode Bantuan</h4>
            <p class="text-muted mb-4" style="font-size: 16px;">
                Mulai dengan membuat periode bantuan pertama Anda.<br>
                Anggota akan mendapat notifikasi otomatis saat periode dibuka.
            </p>
            <a href="{{ route('admin.periode-bantuan.create') }}" class="btn btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px; padding: 15px 40px; font-weight: 700;">
                <i class="fas fa-plus me-2"></i>Buat Periode Pertama
            </a>
        </div>
    </div>
    @endforelse

    {{-- Pagination --}}
    @if($periodes->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <small class="text-muted">
            Menampilkan {{ $periodes->firstItem() }}–{{ $periodes->lastItem() }} dari {{ $periodes->total() }} periode
        </small>
        <div>
            {{ $periodes->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @endif
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none;">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-trash-alt me-2"></i>Hapus Periode Bantuan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 1;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-warning" style="border-radius: 12px; border-left: 5px solid #f59e0b;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <p class="mb-3" style="font-size: 15px;">Apakah Anda yakin ingin menghapus periode bantuan:</p>
                    <div class="card" style="background: #f8f9fa; border-radius: 12px; border: 2px dashed #dee2e6;">
                        <div class="card-body">
                            <h6 class="mb-0 font-weight-bold" id="deletePeriodeName" style="color: #1a3a6e;"></h6>
                        </div>
                    </div>
                    <div class="alert alert-info mt-3 mb-0" style="border-radius: 12px; font-size: 13px;">
                        <i class="fas fa-info-circle me-1"></i>
                        Periode yang sudah memiliki pengajuan tidak dapat dihapus.
                    </div>
                </div>
                <div class="modal-footer" style="border: none; padding: 20px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; padding: 10px 25px; font-weight: 600;">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger" style="border-radius: 10px; padding: 10px 25px; font-weight: 600;">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(id, name) {
    $('#deletePeriodeName').text(name);
    $('#formHapus').attr('action', '/admin/periode-bantuan/' + id);
    $('#modalHapus').modal('show');
}

// Auto hide alerts after 5 seconds
$(document).ready(function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush

@endsection
