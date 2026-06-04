@extends('layouts.app')
@section('title', 'Penerima Bantuan')

@push('styles')
<style>
    /* Header Card */
    .penerima-header-card {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 16px;
        border: none;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .penerima-header-content {
        padding: 30px;
        color: white;
    }
    
    .penerima-header-icon {
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
    .stats-card-penerima {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 24px;
        transition: all 0.3s ease;
        height: 100%;
        margin-bottom: 20px;
    }
    
    .stats-card-penerima:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    .stats-icon-penerima {
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
    .table-penerima {
        margin-bottom: 0;
    }
    
    .table-penerima thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #475569;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px;
        border: none;
    }
    
    .table-penerima tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }
    
    .table-penerima tbody tr:hover {
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
    
    .badge-pending {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .badge-divalidasi {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    
    .badge-diterima {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .badge-ditolak {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    /* Action Buttons */
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
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        color: white;
    }
    
    /* Empty State */
    .empty-state-penerima {
        text-align: center;
        padding: 80px 20px;
        color: #94a3b8;
    }
    
    .empty-state-penerima i {
        font-size: 80px;
        margin-bottom: 24px;
        opacity: 0.3;
    }
    
    .empty-state-penerima h5 {
        color: #64748b;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 20px;
    }
    
    .empty-state-penerima p {
        color: #94a3b8;
        font-size: 14px;
    }
    
    /* Koperasi Info */
    .koperasi-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .koperasi-avatar {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 18px;
        flex-shrink: 0;
    }
    
    .koperasi-details strong {
        display: block;
        color: #1e293b;
        font-size: 14px;
        margin-bottom: 2px;
    }
    
    .koperasi-details small {
        color: #64748b;
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="penerima-header-card">
        <div class="penerima-header-content">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="penerima-header-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">Penerima Bantuan</h3>
                        <p class="mb-0" style="font-size: 14px; opacity: 0.9;">
                            <i class="fas fa-list mr-2"></i>Kelola data penerima bantuan dari semua program
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
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-penerima">
                <div class="stats-icon-penerima" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="fas fa-users text-white"></i>
                </div>
                <div class="stats-value" style="color: #10b981;">
                    {{ $totalPenerima }}
                </div>
                <div class="stats-label">Total Penerima</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-penerima">
                <div class="stats-icon-penerima" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fas fa-clock text-white"></i>
                </div>
                <div class="stats-value" style="color: #f59e0b;">
                    {{ $penerimaByStatus['pending'] ?? 0 }}
                </div>
                <div class="stats-label">Menunggu Validasi</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-penerima">
                <div class="stats-icon-penerima" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="stats-value" style="color: #3b82f6;">
                    {{ $penerimaByStatus['diterima'] ?? 0 }}
                </div>
                <div class="stats-label">Sudah Diterima</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-penerima">
                <div class="stats-icon-penerima" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
                <div class="stats-value" style="color: #8b5cf6; font-size: 20px;">
                    Rp {{ number_format($totalBantuan / 1000000, 1) }}M
                </div>
                <div class="stats-label">Total Bantuan</div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-box-modern">
        <form method="GET" action="{{ route('admin.penerima-bantuan.index') }}" id="filterForm">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label class="font-weight-600 mb-2" style="font-size: 14px; color: #475569;">
                        <i class="fas fa-hand-holding-usd mr-1"></i> Program Bantuan
                    </label>
                    <select name="bantuan_id" class="form-control" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 16px;">
                        <option value="">Semua Program</option>
                        @foreach($programBantuan as $program)
                        <option value="{{ $program->id }}" {{ request('bantuan_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->nama_bantuan }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="font-weight-600 mb-2" style="font-size: 14px; color: #475569;">
                        <i class="fas fa-filter mr-1"></i> Status
                    </label>
                    <select name="status" class="form-control" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 16px;">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="divalidasi" {{ request('status') == 'divalidasi' ? 'selected' : '' }}>Divalidasi</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="font-weight-600 mb-2" style="font-size: 14px; color: #475569;">
                        <i class="fas fa-search mr-1"></i> Cari Koperasi
                    </label>
                    <input type="text" name="search" class="form-control" placeholder="Nama koperasi..." value="{{ request('search') }}" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 16px;">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.penerima-bantuan.index') }}" class="btn btn-secondary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Action & Export Buttons --}}
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPenerima" style="border-radius: 10px; padding: 10px 24px; font-weight: 600; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                <i class="fas fa-plus-circle mr-2"></i>Tambah Penerima Baru
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-success" onclick="exportExcel()" style="border-radius: 10px 0 0 10px; padding: 10px 20px; font-weight: 600;">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </button>
            <button type="button" class="btn btn-danger" onclick="exportPDF()" style="border-radius: 0; padding: 10px 20px; font-weight: 600;">
                <i class="fas fa-file-pdf mr-2"></i>Export PDF
            </button>
            <button type="button" class="btn btn-primary" onclick="window.print()" style="border-radius: 0 10px 10px 0; padding: 10px 20px; font-weight: 600;">
                <i class="fas fa-print mr-2"></i>Print
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-card-modern">
        <div class="table-card-header">
            <h5 class="table-card-title">
                <i class="fas fa-list text-success"></i>
                Daftar Penerima Bantuan
                <span class="badge badge-primary ml-2" style="font-size: 12px;">{{ $penerima->total() }} Total</span>
            </h5>
        </div>
        <div class="table-responsive">
            <table class="table table-penerima">
                <thead>
                    <tr>
                        <th width="3%">#</th>
                        <th width="15%">Nama Koperasi</th>
                        <th width="12%">Pemilik</th>
                        <th width="9%">No. HP</th>
                        <th width="8%">Distrik</th>
                        <th width="13%">Program Bantuan</th>
                        <th width="10%">Jumlah Bantuan</th>
                        <th width="7%">Status</th>
                        <th width="9%">Tgl Daftar</th>
                        <th width="9%">Tgl Terima</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penerima as $i => $p)
                    <tr>
                        <td>{{ $penerima->firstItem() + $i }}</td>
                        <td>
                            <div class="koperasi-info">
                                <div class="koperasi-avatar">
                                    {{ strtoupper(substr($p->koperasi?->nama_usaha ?? 'K', 0, 1)) }}
                                </div>
                                <div class="koperasi-details">
                                    <strong>{{ $p->koperasi?->nama_usaha ?? '-' }}</strong>
                                    <small><i class="fas fa-tag mr-1"></i>{{ $p->koperasi?->no_registrasi ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong style="color: #475569;">{{ $p->koperasi?->nama_pemilik ?? '-' }}</strong>
                        </td>
                        <td>
                            @if($p->koperasi?->no_hp)
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-phone text-success" style="font-size: 12px;"></i>
                                <span style="font-size: 13px; font-weight: 500;">{{ $p->koperasi->no_hp }}</span>
                            </div>
                            @else
                            <span class="text-muted" style="font-size: 12px;">
                                <i class="fas fa-phone-slash"></i> Tidak ada
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($p->koperasi?->distrik)
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-map-marker-alt text-danger" style="font-size: 12px;"></i>
                                <span style="font-size: 13px;">{{ $p->koperasi->distrik }}</span>
                            </div>
                            @else
                            <span class="text-muted" style="font-size: 12px;">-</span>
                            @endif
                        </td>
                        <td>
                            <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); padding: 8px 12px; border-radius: 8px; border-left: 3px solid #10b981;">
                                <strong style="color: #065f46; font-size: 13px; display: block; margin-bottom: 2px;">
                                    {{ $p->bantuan?->nama_bantuan ?? '-' }}
                                </strong>
                                <small style="color: #047857; font-size: 11px;">
                                    <i class="fas fa-calendar mr-1"></i>Tahun {{ $p->bantuan?->tahun ?? '-' }}
                                </small>
                            </div>
                        </td>
                        <td>
                            @if($p->jumlah_bantuan > 0)
                                <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); padding: 8px 12px; border-radius: 8px; text-align: right;">
                                    <strong class="text-success" style="font-size: 14px; display: block;">
                                        Rp {{ number_format($p->jumlah_bantuan, 0, ',', '.') }}
                                    </strong>
                                    <small style="color: #059669; font-size: 10px;">
                                        {{ number_format($p->jumlah_bantuan / 1000000, 2) }} Juta
                                    </small>
                                </div>
                            @else
                                <div style="background: #f8fafc; padding: 8px 12px; border-radius: 8px; text-align: center;">
                                    <span class="text-muted" style="font-size: 12px;">
                                        <i class="fas fa-hourglass-half"></i> Belum diisi
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td>
                            @php
                                $badgeClass = match($p->status) {
                                    'diterima' => 'badge-diterima',
                                    'ditolak' => 'badge-ditolak',
                                    'divalidasi' => 'badge-divalidasi',
                                    default => 'badge-pending'
                                };
                                $icon = match($p->status) {
                                    'diterima' => 'fa-check-circle',
                                    'ditolak' => 'fa-times-circle',
                                    'divalidasi' => 'fa-check',
                                    default => 'fa-clock'
                                };
                            @endphp
                            <span class="badge-status-modern {{ $badgeClass }}">
                                <i class="fas {{ $icon }}"></i> {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 8px 12px; border-radius: 8px;">
                                <div style="font-size: 12px; color: #92400e; font-weight: 600; margin-bottom: 2px;">
                                    <i class="far fa-calendar mr-1"></i>
                                    {{ $p->created_at?->format('d/m/Y') ?? '-' }}
                                </div>
                                <small style="color: #b45309; font-size: 10px;">
                                    <i class="far fa-clock mr-1"></i>{{ $p->created_at?->format('H:i') ?? '-' }} WIT
                                </small>
                            </div>
                        </td>
                        <td>
                            @if($p->tanggal_penerimaan)
                            <div style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); padding: 8px 12px; border-radius: 8px;">
                                <div style="font-size: 12px; color: #065f46; font-weight: 600;">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ \Carbon\Carbon::parse($p->tanggal_penerimaan)->format('d/m/Y') }}
                                </div>
                                <small style="color: #047857; font-size: 10px;">
                                    Sudah diterima
                                </small>
                            </div>
                            @else
                            <div style="background: #f1f5f9; padding: 8px 12px; border-radius: 8px; text-align: center;">
                                <span class="text-muted" style="font-size: 11px;">
                                    <i class="fas fa-hourglass-half"></i> Belum diterima
                                </span>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 6px; justify-content: center;">
                                <button type="button" class="btn btn-sm btn-info btn-detail-penerima" 
                                    data-id="{{ $p->id }}"
                                    data-koperasi="{{ $p->koperasi?->nama_usaha ?? '-' }}"
                                    data-pemilik="{{ $p->koperasi?->nama_pemilik ?? '-' }}"
                                    data-no-hp="{{ $p->koperasi?->no_hp ?? '-' }}"
                                    data-distrik="{{ $p->koperasi?->distrik ?? '-' }}"
                                    data-no-reg="{{ $p->koperasi?->no_registrasi ?? '-' }}"
                                    data-program="{{ $p->bantuan?->nama_bantuan ?? '-' }}"
                                    data-tahun="{{ $p->bantuan?->tahun ?? '-' }}"
                                    data-jumlah="{{ number_format($p->jumlah_bantuan, 2, ',', '.') }}"
                                    data-status="{{ ucfirst($p->status) }}"
                                    data-tgl-daftar="{{ $p->created_at?->format('d/m/Y H:i') ?? '-' }}"
                                    data-tgl-terima="{{ $p->tanggal_penerimaan ? \Carbon\Carbon::parse($p->tanggal_penerimaan)->format('d/m/Y') : 'Belum diterima' }}"
                                    data-catatan="{{ $p->catatan ?? 'Tidak ada catatan' }}"
                                    title="Lihat Detail" 
                                    style="border-radius: 6px; padding: 6px 12px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none;">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning btn-edit-penerima" 
                                    data-id="{{ $p->id }}"
                                    data-koperasi-id="{{ $p->koperasi_id }}"
                                    data-bantuan-id="{{ $p->bantuan_id }}"
                                    data-jumlah="{{ $p->jumlah_bantuan }}"
                                    data-status="{{ $p->status }}"
                                    data-tanggal="{{ $p->tanggal_penerimaan }}"
                                    data-catatan="{{ $p->catatan }}"
                                    title="Edit Data" 
                                    style="border-radius: 6px; padding: 6px 12px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; color: white;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger btn-hapus-penerima" 
                                    data-id="{{ $p->id }}" 
                                    data-nama="{{ $p->koperasi?->nama_usaha }}" 
                                    title="Hapus" 
                                    style="border-radius: 6px; padding: 6px 12px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11">
                            <div class="empty-state-penerima">
                                <i class="fas fa-users-slash"></i>
                                <h5>Belum Ada Data</h5>
                                <p>Belum ada data penerima bantuan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($penerima->hasPages())
        <div class="card-footer bg-white" style="padding: 20px 24px;">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $penerima->firstItem() }}–{{ $penerima->lastItem() }} dari {{ $penerima->total() }} data
                </small>
                <div>
                    {{ $penerima->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal Tambah Penerima --}}
<div class="modal fade" id="modalTambahPenerima" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <form action="{{ route('admin.bantuan.tambahPenerima', ['bantuan' => 1]) }}" method="POST" id="formTambahPenerima">
                @csrf
                <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-plus-circle mr-2"></i>Tambah Penerima Bantuan Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-hand-holding-usd mr-2 text-success"></i>Program Bantuan <span class="text-danger">*</span>
                        </label>
                        <select name="bantuan_id" id="tambah_bantuan_id" class="form-control" required style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;">
                            <option value="">-- Pilih Program Bantuan --</option>
                            @foreach($programBantuan as $program)
                            <option value="{{ $program->id }}">{{ $program->nama_bantuan }} (Tahun {{ $program->tahun }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-building mr-2 text-primary"></i>Koperasi <span class="text-danger">*</span>
                        </label>
                        <select name="koperasi_ids[]" id="tambah_koperasi_id" class="form-control" required style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;">
                            <option value="">-- Pilih Koperasi --</option>
                            @foreach(\App\Models\Koperasi::where('status_verifikasi', 'diverifikasi')->where('status_usaha', 'aktif')->get() as $kop)
                            <option value="{{ $kop->id }}">{{ $kop->nama_usaha }} - {{ $kop->nama_pemilik }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Pilih koperasi yang akan menerima bantuan</small>
                    </div>
                    <div class="alert alert-info" style="border-radius: 10px; border-left: 4px solid #3b82f6;">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Catatan:</strong> Setelah menambahkan penerima, Anda dapat mengatur jumlah bantuan dan status melalui tombol <strong>Edit</strong>.
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #f1f5f9; padding: 20px 30px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; padding: 10px 24px; font-weight: 600;">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success" style="border-radius: 8px; padding: 10px 24px; font-weight: 600; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                        <i class="fas fa-save mr-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Penerima --}}
<div class="modal fade" id="modalEditPenerima" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <form action="" method="POST" id="formEditPenerima">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>Edit Data Penerima Bantuan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <input type="hidden" name="penerima_id" id="edit_penerima_id">
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-hand-holding-usd mr-2 text-success"></i>Program Bantuan <span class="text-danger">*</span>
                        </label>
                        <select name="bantuan_id" id="edit_bantuan_id" class="form-control" required style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;">
                            <option value="">-- Pilih Program Bantuan --</option>
                            @foreach($programBantuan as $program)
                            <option value="{{ $program->id }}">{{ $program->nama_bantuan }} (Tahun {{ $program->tahun }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-building mr-2 text-primary"></i>Koperasi <span class="text-danger">*</span>
                        </label>
                        <select name="koperasi_id" id="edit_koperasi_id" class="form-control" required style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;">
                            <option value="">-- Pilih Koperasi --</option>
                            @foreach(\App\Models\Koperasi::where('status_verifikasi', 'diverifikasi')->where('status_usaha', 'aktif')->get() as $kop)
                            <option value="{{ $kop->id }}">{{ $kop->nama_usaha }} - {{ $kop->nama_pemilik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-money-bill-wave mr-2 text-success"></i>Jumlah Bantuan (Rp) <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="jumlah_bantuan" id="edit_jumlah_bantuan" class="form-control" required min="0" step="1000" placeholder="Contoh: 5000000" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;">
                        <small class="text-muted">Masukkan jumlah bantuan dalam Rupiah</small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-calendar mr-2 text-warning"></i>Tanggal Penerimaan
                        </label>
                        <input type="date" name="tanggal_penerimaan" id="edit_tanggal_penerimaan" class="form-control" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;">
                        <small class="text-muted">Kosongkan jika belum diterima</small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-info-circle mr-2 text-info"></i>Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" id="edit_status" class="form-control" required style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;">
                            <option value="pending">Pending</option>
                            <option value="divalidasi">Divalidasi</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600" style="color: #475569; font-size: 14px;">
                            <i class="fas fa-sticky-note mr-2 text-purple"></i>Catatan
                        </label>
                        <textarea name="catatan" id="edit_catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..." style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px 16px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #f1f5f9; padding: 20px 30px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; padding: 10px 24px; font-weight: 600;">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning" style="border-radius: 8px; padding: 10px 24px; font-weight: 600; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; color: white;">
                        <i class="fas fa-save mr-2"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Detail Penerima --}}
<div class="modal fade" id="modalDetailPenerima" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border-radius: 16px 16px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Detail Penerima Bantuan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <div class="row">
                    <div class="col-md-6">
                        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                            <h6 style="color: #475569; font-weight: 700; margin-bottom: 16px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <i class="fas fa-building mr-2 text-primary"></i>Informasi Koperasi
                            </h6>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #64748b; font-size: 12px; display: block; margin-bottom: 4px;">Nama Koperasi</small>
                                <strong id="detail-koperasi" style="color: #1e293b; font-size: 14px;"></strong>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #64748b; font-size: 12px; display: block; margin-bottom: 4px;">No. Registrasi</small>
                                <span id="detail-no-reg" style="color: #475569; font-size: 13px;"></span>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #64748b; font-size: 12px; display: block; margin-bottom: 4px;">Pemilik</small>
                                <span id="detail-pemilik" style="color: #475569; font-size: 13px;"></span>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #64748b; font-size: 12px; display: block; margin-bottom: 4px;">No. HP</small>
                                <span id="detail-no-hp" style="color: #475569; font-size: 13px;">
                                    <i class="fas fa-phone text-success mr-1"></i><span id="detail-hp-value"></span>
                                </span>
                            </div>
                            <div>
                                <small style="color: #64748b; font-size: 12px; display: block; margin-bottom: 4px;">Distrik</small>
                                <span id="detail-distrik" style="color: #475569; font-size: 13px;">
                                    <i class="fas fa-map-marker-alt text-danger mr-1"></i><span id="detail-distrik-value"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: #f0fdf4; padding: 20px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #10b981;">
                            <h6 style="color: #065f46; font-weight: 700; margin-bottom: 16px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <i class="fas fa-hand-holding-usd mr-2 text-success"></i>Informasi Bantuan
                            </h6>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #064e3b; font-size: 12px; display: block; margin-bottom: 4px;">Program Bantuan</small>
                                <strong id="detail-program" style="color: #065f46; font-size: 14px;"></strong>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #064e3b; font-size: 12px; display: block; margin-bottom: 4px;">Tahun</small>
                                <span id="detail-tahun" style="color: #047857; font-size: 13px;"></span>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #064e3b; font-size: 12px; display: block; margin-bottom: 4px;">Jumlah Bantuan</small>
                                <strong id="detail-jumlah" style="color: #059669; font-size: 16px;">Rp </strong>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <small style="color: #064e3b; font-size: 12px; display: block; margin-bottom: 4px;">Status</small>
                                <span id="detail-status" style="font-size: 13px;"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="background: #fef3c7; padding: 20px; border-radius: 12px; border-left: 4px solid #f59e0b;">
                    <h6 style="color: #92400e; font-weight: 700; margin-bottom: 16px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fas fa-calendar-alt mr-2 text-warning"></i>Informasi Tanggal
                    </h6>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 12px;">
                            <small style="color: #78350f; font-size: 12px; display: block; margin-bottom: 4px;">Tanggal Pendaftaran</small>
                            <span id="detail-tgl-daftar" style="color: #92400e; font-size: 13px;">
                                <i class="far fa-calendar mr-1"></i><span id="detail-tgl-daftar-value"></span>
                            </span>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 12px;">
                            <small style="color: #78350f; font-size: 12px; display: block; margin-bottom: 4px;">Tanggal Penerimaan</small>
                            <span id="detail-tgl-terima" style="color: #92400e; font-size: 13px;">
                                <i class="fas fa-check-circle mr-1"></i><span id="detail-tgl-terima-value"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div style="background: #ede9fe; padding: 20px; border-radius: 12px; margin-top: 20px; border-left: 4px solid #8b5cf6;">
                    <h6 style="color: #5b21b6; font-weight: 700; margin-bottom: 12px; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fas fa-sticky-note mr-2 text-purple"></i>Catatan
                    </h6>
                    <p id="detail-catatan" style="color: #6b21a8; font-size: 13px; margin-bottom: 0; line-height: 1.6;"></p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 2px solid #f1f5f9; padding: 20px 30px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; padding: 10px 24px; font-weight: 600;">
                    <i class="fas fa-times mr-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Print Styles --}}
<style media="print">
    @page {
        size: landscape;
        margin: 1cm;
    }
    
    .penerima-header-card,
    .filter-box-modern,
    .btn-group,
    .btn-action,
    .card-footer,
    .sidebar,
    .main-header,
    .main-footer {
        display: none !important;
    }
    
    .table-card-modern {
        box-shadow: none !important;
        border: 1px solid #000;
    }
    
    .table-penerima {
        font-size: 10px;
    }
    
    .table-penerima thead th {
        background: #f0f0f0 !important;
        color: #000 !important;
        border: 1px solid #000 !important;
    }
    
    .table-penerima tbody td {
        border: 1px solid #000 !important;
    }
    
    .badge-status-modern {
        border: 1px solid #000;
        padding: 2px 6px;
    }
    
    .stats-card-penerima {
        page-break-inside: avoid;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script>
// Export to Excel
function exportExcel() {
    Swal.fire({
        title: 'Mengekspor ke Excel...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Get current filter parameters
    const params = new URLSearchParams(window.location.search);
    params.append('export', 'excel');
    
    // Redirect to export URL
    window.location.href = '{{ route("admin.penerima-bantuan.export") }}?' + params.toString();
    
    setTimeout(() => {
        Swal.close();
    }, 2000);
}

// Export to PDF
function exportPDF() {
    Swal.fire({
        title: 'Mengekspor ke PDF...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape');
    
    // Add Logo (if exists)
    const logoUrl = '{{ asset("images/logo-tolikara.png") }}';
    const img = new Image();
    img.src = logoUrl;
    
    img.onload = function() {
        // Logo
        doc.addImage(img, 'PNG', 14, 10, 25, 25);
        
        // Header
        doc.setFontSize(18);
        doc.setFont(undefined, 'bold');
        doc.text('DAFTAR PENERIMA BANTUAN', 148, 18, { align: 'center' });
        
        doc.setFontSize(12);
        doc.setFont(undefined, 'normal');
        doc.text('DISPERINDAGKOP KABUPATEN TOLIKARA', 148, 25, { align: 'center' });
        
        doc.setFontSize(10);
        doc.text('Jl. Trikora, Karubaga, Kabupaten Tolikara, Papua Pegunungan', 148, 31, { align: 'center' });
        doc.text('Tanggal Cetak: ' + new Date().toLocaleDateString('id-ID', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        }), 148, 37, { align: 'center' });
        
        // Line separator
        doc.setLineWidth(0.5);
        doc.line(14, 40, 283, 40);
        
        // Get table data
        const tableData = [];
        const rows = document.querySelectorAll('.table-penerima tbody tr');
        
        rows.forEach((row, index) => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1) {
                // Extract phone number properly
                const phoneCell = cells[3];
                const phoneSpan = phoneCell.querySelector('span[style*="font-weight: 500"]');
                const phoneNumber = phoneSpan ? phoneSpan.textContent.trim() : (phoneCell.textContent.includes('Tidak ada') ? '-' : phoneCell.textContent.trim());
                
                // Extract distrik properly
                const distrikCell = cells[4];
                const distrikSpan = distrikCell.querySelector('span[style*="font-size: 13px"]');
                const distrik = distrikSpan ? distrikSpan.textContent.trim() : (distrikCell.textContent.trim() === '-' ? '-' : distrikCell.textContent.trim());
                
                tableData.push([
                    (index + 1).toString(),
                    cells[1].querySelector('.koperasi-details strong')?.textContent.trim() || '-',
                    cells[2].textContent.trim(),
                    phoneNumber,
                    distrik,
                    cells[5].querySelector('strong')?.textContent.trim() || '-',
                    cells[6].querySelector('strong')?.textContent.trim() || cells[6].textContent.trim(),
                    cells[7].textContent.trim(),
                    cells[8].textContent.trim().replace(/\s+/g, ' '),
                    cells[9].textContent.trim().replace(/\s+/g, ' ')
                ]);
            }
        });
        
        // Create table
        doc.autoTable({
            startY: 45,
            head: [['#', 'Nama Koperasi', 'Pemilik', 'No. HP', 'Distrik', 'Program', 'Jumlah', 'Status', 'Tgl Daftar', 'Tgl Terima']],
            body: tableData,
            styles: {
                fontSize: 8,
                cellPadding: 3,
                lineColor: [200, 200, 200],
                lineWidth: 0.1
            },
            headStyles: {
                fillColor: [16, 185, 129],
                textColor: 255,
                fontStyle: 'bold',
                halign: 'center',
                fontSize: 9
            },
            alternateRowStyles: {
                fillColor: [248, 250, 252]
            },
            columnStyles: {
                0: { cellWidth: 10, halign: 'center' },
                1: { cellWidth: 45 },
                2: { cellWidth: 35 },
                3: { cellWidth: 25 },
                4: { cellWidth: 22 },
                5: { cellWidth: 38 },
                6: { cellWidth: 30, halign: 'right' },
                7: { cellWidth: 22, halign: 'center' },
                8: { cellWidth: 25, halign: 'center' },
                9: { cellWidth: 25, halign: 'center' }
            },
            didDrawPage: function(data) {
                // Footer
                const pageCount = doc.internal.getNumberOfPages();
                const pageSize = doc.internal.pageSize;
                const pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
                
                doc.setFontSize(8);
                doc.setTextColor(128);
                doc.text('Halaman ' + doc.internal.getCurrentPageInfo().pageNumber + ' dari ' + pageCount, 
                    data.settings.margin.left, pageHeight - 10);
                doc.text('Dicetak oleh: {{ auth()->user()->name }}', 
                    pageSize.width - data.settings.margin.right - 50, pageHeight - 10);
            }
        });
        
        // Save PDF
        doc.save('Penerima-Bantuan-' + new Date().toISOString().slice(0,10) + '.pdf');
        
        Swal.close();
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'File PDF berhasil diunduh',
            timer: 2000,
            showConfirmButton: false
        });
    };
    
    img.onerror = function() {
        // If logo fails to load, continue without logo
        generatePDFWithoutLogo(doc);
    };
}

function generatePDFWithoutLogo(doc) {
    // Header without logo
    doc.setFontSize(18);
    doc.setFont(undefined, 'bold');
    doc.text('DAFTAR PENERIMA BANTUAN', 148, 18, { align: 'center' });
    
    doc.setFontSize(12);
    doc.setFont(undefined, 'normal');
    doc.text('DISPERINDAGKOP KABUPATEN TOLIKARA', 148, 25, { align: 'center' });
    
    doc.setFontSize(10);
    doc.text('Jl. Trikora, Karubaga, Kabupaten Tolikara, Papua Pegunungan', 148, 31, { align: 'center' });
    doc.text('Tanggal Cetak: ' + new Date().toLocaleDateString('id-ID', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    }), 148, 37, { align: 'center' });
    
    doc.setLineWidth(0.5);
    doc.line(14, 40, 283, 40);
    
    const tableData = [];
    const rows = document.querySelectorAll('.table-penerima tbody tr');
    
    rows.forEach((row, index) => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 1) {
            // Extract phone number properly
            const phoneCell = cells[3];
            const phoneSpan = phoneCell.querySelector('span[style*="font-weight: 500"]');
            const phoneNumber = phoneSpan ? phoneSpan.textContent.trim() : (phoneCell.textContent.includes('Tidak ada') ? '-' : phoneCell.textContent.trim());
            
            // Extract distrik properly
            const distrikCell = cells[4];
            const distrikSpan = distrikCell.querySelector('span[style*="font-size: 13px"]');
            const distrik = distrikSpan ? distrikSpan.textContent.trim() : (distrikCell.textContent.trim() === '-' ? '-' : distrikCell.textContent.trim());
            
            tableData.push([
                (index + 1).toString(),
                cells[1].querySelector('.koperasi-details strong')?.textContent.trim() || '-',
                cells[2].textContent.trim(),
                phoneNumber,
                distrik,
                cells[5].querySelector('strong')?.textContent.trim() || '-',
                cells[6].querySelector('strong')?.textContent.trim() || cells[6].textContent.trim(),
                cells[7].textContent.trim(),
                cells[8].textContent.trim().replace(/\s+/g, ' '),
                cells[9].textContent.trim().replace(/\s+/g, ' ')
            ]);
        }
    });
    
    doc.autoTable({
        startY: 45,
        head: [['#', 'Nama Koperasi', 'Pemilik', 'No. HP', 'Distrik', 'Program', 'Jumlah', 'Status', 'Tgl Daftar', 'Tgl Terima']],
        body: tableData,
        styles: {
            fontSize: 8,
            cellPadding: 3,
            lineColor: [200, 200, 200],
            lineWidth: 0.1
        },
        headStyles: {
            fillColor: [16, 185, 129],
            textColor: 255,
            fontStyle: 'bold',
            halign: 'center',
            fontSize: 9
        },
        alternateRowStyles: {
            fillColor: [248, 250, 252]
        },
        columnStyles: {
            0: { cellWidth: 10, halign: 'center' },
            1: { cellWidth: 45 },
            2: { cellWidth: 35 },
            3: { cellWidth: 25 },
            4: { cellWidth: 22 },
            5: { cellWidth: 38 },
            6: { cellWidth: 30, halign: 'right' },
            7: { cellWidth: 22, halign: 'center' },
            8: { cellWidth: 25, halign: 'center' },
            9: { cellWidth: 25, halign: 'center' }
        },
        didDrawPage: function(data) {
            const pageCount = doc.internal.getNumberOfPages();
            const pageSize = doc.internal.pageSize;
            const pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
            
            doc.setFontSize(8);
            doc.setTextColor(128);
            doc.text('Halaman ' + doc.internal.getCurrentPageInfo().pageNumber + ' dari ' + pageCount, 
                data.settings.margin.left, pageHeight - 10);
            doc.text('Dicetak oleh: {{ auth()->user()->name }}', 
                pageSize.width - data.settings.margin.right - 50, pageHeight - 10);
        }
    });
    
    doc.save('Penerima-Bantuan-' + new Date().toISOString().slice(0,10) + '.pdf');
    
    Swal.close();
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'File PDF berhasil diunduh',
        timer: 2000,
        showConfirmButton: false
    });
}

$(document).ready(function() {
    // Update form action when bantuan is selected
    $('#tambah_bantuan_id').on('change', function() {
        var bantuanId = $(this).val();
        if (bantuanId) {
            $('#formTambahPenerima').attr('action', '/admin/bantuan/' + bantuanId + '/tambah-penerima');
        }
    });
    
    // Edit Penerima
    $('.btn-edit-penerima').on('click', function() {
        var id = $(this).data('id');
        var koperasiId = $(this).data('koperasi-id');
        var bantuanId = $(this).data('bantuan-id');
        var jumlah = $(this).data('jumlah');
        var status = $(this).data('status');
        var tanggal = $(this).data('tanggal');
        var catatan = $(this).data('catatan');
        
        $('#edit_penerima_id').val(id);
        $('#edit_koperasi_id').val(koperasiId);
        $('#edit_bantuan_id').val(bantuanId);
        $('#edit_jumlah_bantuan').val(jumlah);
        $('#edit_status').val(status);
        $('#edit_tanggal_penerimaan').val(tanggal);
        $('#edit_catatan').val(catatan);
        
        // Update form action
        $('#formEditPenerima').attr('action', '/admin/bantuan/penerima/' + id);
        
        $('#modalEditPenerima').modal('show');
    });
    
    // Detail Penerima
    $('.btn-detail-penerima').on('click', function() {
        $('#detail-koperasi').text($(this).data('koperasi'));
        $('#detail-no-reg').text($(this).data('no-reg'));
        $('#detail-pemilik').text($(this).data('pemilik'));
        $('#detail-hp-value').text($(this).data('no-hp'));
        $('#detail-distrik-value').text($(this).data('distrik'));
        $('#detail-program').text($(this).data('program'));
        $('#detail-tahun').text($(this).data('tahun'));
        $('#detail-jumlah').html('Rp ' + $(this).data('jumlah'));
        
        var status = $(this).data('status');
        var statusBadge = '';
        if (status === 'Diterima') {
            statusBadge = '<span class="badge" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px;"><i class="fas fa-check-circle mr-1"></i>' + status + '</span>';
        } else if (status === 'Ditolak') {
            statusBadge = '<span class="badge" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px;"><i class="fas fa-times-circle mr-1"></i>' + status + '</span>';
        } else if (status === 'Divalidasi') {
            statusBadge = '<span class="badge" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px;"><i class="fas fa-check mr-1"></i>' + status + '</span>';
        } else {
            statusBadge = '<span class="badge" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px;"><i class="fas fa-clock mr-1"></i>' + status + '</span>';
        }
        $('#detail-status').html(statusBadge);
        
        $('#detail-tgl-daftar-value').text($(this).data('tgl-daftar'));
        $('#detail-tgl-terima-value').text($(this).data('tgl-terima'));
        $('#detail-catatan').text($(this).data('catatan'));
        
        $('#modalDetailPenerima').modal('show');
    });
    
    // Hapus Penerima
    $('.btn-hapus-penerima').on('click', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        
        Swal.fire({
            title: 'Hapus Penerima?',
            html: `Apakah Anda yakin ingin menghapus:<br><strong>${nama}</strong><br>dari daftar penerima bantuan?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                var form = $('<form>', {
                    'method': 'POST',
                    'action': `/admin/bantuan/penerima/${id}`
                });
                
                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': '{{ csrf_token() }}'
                }));
                
                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_method',
                    'value': 'DELETE'
                }));
                
                $('body').append(form);
                form.submit();
            }
        });
    });
    
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});
</script>
@endpush
