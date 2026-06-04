@extends('layouts.app')
@section('title', 'Kartu & Sertifikat Anggota')

@push('styles')
<style>
    /* Main Container */
    .main-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 24px;
    }

    /* Header Card */
    .header-card {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.25);
        margin-bottom: 28px;
        overflow: hidden;
        position: relative;
    }
    
    .header-content {
        padding: 28px 36px;
        color: white;
        position: relative;
        z-index: 2;
    }
    
    .header-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.25);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-right: 20px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.3);
    }

    .header-title {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        border: 2px solid #f1f5f9;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        border-color: #0ea5e9;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 12px;
    }

    .stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
    }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        overflow: hidden;
    }
    
    .content-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 24px 28px;
        border-bottom: 3px solid #e2e8f0;
    }
    
    .content-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .content-title i {
        color: #10b981;
    }
    
    /* Filter Box */
    .filter-box {
        padding: 24px 28px;
        border-bottom: 2px solid #f1f5f9;
        background: #fafbfc;
    }

    .filter-label {
        font-weight: 700;
        font-size: 14px;
        color: #475569;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-input {
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        padding: 12px 18px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .filter-input:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        outline: none;
    }

    .btn-search {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .btn-reset {
        background: #f1f5f9;
        color: #64748b;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-reset:hover {
        background: #e2e8f0;
        color: #475569;
        transform: translateY(-2px);
    }
    
    /* Grid Cards */
    .grid-container {
        padding: 28px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
    }
    
    .item-card {
        background: white;
        border: 2px solid #f1f5f9;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .item-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981 0%, #059669 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .item-card:hover {
        border-color: #10b981;
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(16, 185, 129, 0.15);
    }

    .item-card:hover::before {
        transform: scaleX(1);
    }
    
    .item-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .item-avatar {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 26px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .item-info h5 {
        margin: 0 0 6px 0;
        font-size: 17px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.3;
    }
    
    .item-info p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .item-details {
        margin-bottom: 18px;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 13px;
        border-bottom: 1px solid #f8fafc;
    }

    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        color: #64748b;
        font-weight: 600;
    }
    
    .detail-value {
        color: #1e293b;
        font-weight: 700;
        text-align: right;
    }
    
    .item-actions {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
    
    .btn-download {
        padding: 11px 14px;
        border-radius: 10px;
        border: none;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
    }
    
    .btn-kartu {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
    }
    
    .btn-kartu:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
        color: white;
        text-decoration: none;
    }
    
    .btn-sertifikat {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);
    }
    
    .btn-sertifikat:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
        color: white;
        text-decoration: none;
    }
    
    .btn-dokumen {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }
    
    .btn-dokumen:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
        color: white;
        text-decoration: none;
    }
    
    /* Badge */
    .badge-custom {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-aktif {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }
    
    .badge-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
    }

    .badge-nonaktif {
        background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        color: #991b1b;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 100px 20px;
        color: #94a3b8;
    }
    
    .empty-state i {
        font-size: 100px;
        margin-bottom: 24px;
        opacity: 0.4;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .empty-state h5 {
        font-size: 20px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: #94a3b8;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="header-card">
        <div class="header-content">
            <div class="d-flex align-items-center">
                <div class="header-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div>
                    <h3 class="header-title">Kartu & Sertifikat Anggota</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-label">Total Anggota</div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-label">Anggota Aktif</div>
            <div class="stat-value">{{ $stats['aktif'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-label">Menunggu Verifikasi</div>
            <div class="stat-value">{{ $stats['pending'] }}</div>
        </div>
    </div>

    {{-- Content Anggota --}}
    <div class="content-card">
        <div class="content-header">
            <h5 class="content-title">
                <i class="fas fa-users"></i>
                Daftar Anggota Koperasi
                <span class="badge badge-primary ml-2" style="font-size: 12px;">{{ $anggota->total() }} Total</span>
            </h5>
        </div>
        
        <div class="filter-box">
            <form method="GET" action="{{ route('admin.kartu-sertifikat') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="filter-label">
                            <i class="fas fa-search"></i> Cari Anggota
                        </label>
                        <input type="text" name="search" class="form-control filter-input" placeholder="Nama, No. Anggota, atau NIK..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">
                            <i class="fas fa-filter"></i> Status
                        </label>
                        <select name="status" class="form-control filter-input">
                            <option value="">Semua Status</option>
                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">
                            <i class="fas fa-map-marker-alt"></i> Distrik
                        </label>
                        <select name="distrik" class="form-control filter-input">
                            <option value="">Semua Distrik</option>
                            @foreach($distrik as $d)
                                <option value="{{ $d }}" {{ request('distrik') == $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="filter-label" style="opacity: 0;">Action</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-search flex-fill">
                                <i class="fas fa-search mr-1"></i>Cari
                            </button>
                            <a href="{{ route('admin.kartu-sertifikat') }}" class="btn btn-reset">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="grid-container">
            @forelse($anggota as $a)
            <div class="item-card">
                <div class="item-header">
                    <div class="item-avatar">
                        {{ strtoupper(substr($a->nama ?? 'A', 0, 1)) }}
                    </div>
                    <div class="item-info">
                        <h5>{{ $a->nama ?? '-' }}</h5>
                        <p><i class="fas fa-id-badge"></i>{{ $a->no_anggota ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="item-details">
                    <div class="detail-row">
                        <span class="detail-label">NIK:</span>
                        <span class="detail-value">{{ $a->nik ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Distrik:</span>
                        <span class="detail-value">{{ $a->distrik ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Koperasi:</span>
                        <span class="detail-value">{{ optional($a->koperasi)->nama_usaha ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="badge-custom {{ $a->status == 'Aktif' ? 'badge-aktif' : ($a->status == 'Pending' ? 'badge-pending' : 'badge-nonaktif') }}">
                            {{ $a->status ?? 'Pending' }}
                        </span>
                    </div>
                </div>
                
                <div class="item-actions">
                    <a href="{{ route('admin.anggota.sertifikat', ['anggota' => $a, 'type' => 'kartu']) }}" class="btn-download btn-kartu" title="Kartu Anggota" target="_blank">
                        <i class="fas fa-id-card"></i>
                        Kartu
                    </a>
                    <a href="{{ route('admin.anggota.sertifikat', ['anggota' => $a, 'type' => 'sertifikat']) }}" class="btn-download btn-sertifikat" title="Sertifikat Keanggotaan" target="_blank">
                        <i class="fas fa-certificate"></i>
                        Sertifikat
                    </a>
                    <a href="{{ route('admin.anggota.print-dokumen', $a) }}" class="btn-download btn-dokumen" title="Dokumen Lengkap" target="_blank">
                        <i class="fas fa-file-alt"></i>
                        Dokumen
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-state" style="grid-column: 1 / -1;">
                <i class="fas fa-users"></i>
                <h5>Belum Ada Data Anggota</h5>
                <p>Belum ada data anggota yang terdaftar di sistem</p>
            </div>
            @endforelse
        </div>
        
        @if($anggota->hasPages())
        <div style="padding: 20px 24px; border-top: 2px solid #f1f5f9; background: #fafbfc;">
            <div class="d-flex justify-content-between align-items-center">
                <small style="color: #64748b; font-weight: 600;">
                    Menampilkan {{ $anggota->firstItem() ?? 0 }}–{{ $anggota->lastItem() ?? 0 }} dari {{ $anggota->total() }} data
                </small>
                <div>
                    {{ $anggota->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
