@extends('layouts.app')
@section('title', 'Kartu & Sertifikat')

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
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(14, 165, 233, 0.25);
        margin-bottom: 28px;
        overflow: hidden;
        position: relative;
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 400px;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg width='400' height='200' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3Cpattern id='grid' width='40' height='40' patternUnits='userSpaceOnUse'%3E%3Cpath d='M 40 0 L 0 0 0 40' fill='none' stroke='rgba(255,255,255,0.1)' stroke-width='1'/%3E%3C/pattern%3E%3C/defs%3E%3Crect width='400' height='200' fill='url(%23grid)'/%3E%3C/svg%3E");
        opacity: 0.3;
    }
    
    .header-content {
        padding: 32px 36px;
        color: white;
        position: relative;
        z-index: 2;
    }
    
    .header-icon {
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.25);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin-right: 24px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.3);
    }

    .header-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .header-subtitle {
        font-size: 15px;
        opacity: 0.95;
        font-weight: 500;
    }
    
    /* Tab Navigation */
    .tab-navigation {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        padding: 8px;
        margin-bottom: 28px;
        display: flex;
        gap: 8px;
    }
    
    .tab-btn {
        flex: 1;
        padding: 16px 24px;
        border-radius: 12px;
        border: none;
        background: transparent;
        color: #64748b;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }
    
    .tab-btn i {
        font-size: 18px;
    }

    .tab-btn:hover {
        color: #0ea5e9;
        background: #f0f9ff;
    }
    
    .tab-btn.active {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        color: white;
        box-shadow: 0 6px 16px rgba(14, 165, 233, 0.3);
    }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        overflow: hidden;
        display: none;
    }
    
    .content-card.active {
        display: block;
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
        color: #0ea5e9;
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
        border-color: #0ea5e9;
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        outline: none;
    }

    .btn-search {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
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
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
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
        background: linear-gradient(90deg, #0ea5e9 0%, #06b6d4 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .item-card:hover {
        border-color: #0ea5e9;
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(14, 165, 233, 0.15);
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
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 26px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
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
    
    .btn-dokumen-pdf {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
    }
    
    .btn-dokumen-pdf:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
        color: white;
        text-decoration: none;
    }
    
    .btn-dokumen-word {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(6, 182, 212, 0.2);
    }
    
    .btn-dokumen-word:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(6, 182, 212, 0.35);
        color: white;
        text-decoration: none;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.2);
    }
    
    .btn-detail:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(139, 92, 246, 0.35);
        color: white;
        text-decoration: none;
    }
    
    .btn-print {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }
    
    .btn-print:hover {
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

    .badge-ditolak {
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
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
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

    /* Pagination */
    .pagination-wrapper {
        padding: 24px 28px;
        border-top: 2px solid #f1f5f9;
        background: #fafbfc;
    }

    .pagination-info {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
    }

    /* Badge Total */
    .badge-total {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.3);
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
                    <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">Kartu & Sertifikat</h3>
                    <p class="mb-0" style="font-size: 14px; opacity: 0.9;">
                        <i class="fas fa-info-circle mr-2"></i>Download kartu dan sertifikat untuk anggota dan koperasi
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab Navigation --}}
    <div class="tab-navigation">
        <button class="tab-btn active" onclick="switchTab('anggota')">
            <i class="fas fa-users"></i>
            <span>Anggota</span>
        </button>
        <button class="tab-btn" onclick="switchTab('koperasi')">
            <i class="fas fa-store"></i>
            <span>Koperasi</span>
        </button>
    </div>

    {{-- Content Anggota --}}
    <div class="content-card active" id="content-anggota">
        <div class="content-header">
            <h5 class="content-title">
                <i class="fas fa-users"></i>
                Daftar Anggota
                <span class="badge badge-primary ml-2" style="font-size: 12px;">{{ $anggota->total() }} Total</span>
            </h5>
        </div>
        
        <div class="filter-box">
            <form method="GET" action="{{ route('petugas.kartu-sertifikat') }}" class="row align-items-end">
                <div class="col-md-6">
                    <label class="font-weight-600 mb-2" style="font-size: 14px; color: #475569;">
                        <i class="fas fa-search mr-1"></i> Cari Anggota
                    </label>
                    <input type="text" name="search_anggota" class="form-control" placeholder="Nama atau No. Anggota..." value="{{ request('search_anggota') }}" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 16px;">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('petugas.kartu-sertifikat') }}" class="btn btn-secondary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
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
                        <p><i class="fas fa-id-badge mr-1"></i>{{ $a->no_anggota ?? '-' }}</p>
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
                        <span class="badge-custom {{ $a->status == 'Aktif' ? 'badge-aktif' : 'badge-pending' }}">
                            {{ $a->status ?? 'Pending' }}
                        </span>
                    </div>
                </div>
                
                <div class="item-actions">
                    <a href="{{ route('petugas.anggota.download-kartu', $a) }}" class="btn-download btn-kartu" title="Download Kartu" target="_blank">
                        <i class="fas fa-id-card"></i>
                        Kartu
                    </a>
                    <a href="{{ route('petugas.anggota.download-sertifikat', $a) }}" class="btn-download btn-sertifikat" title="Download Sertifikat" target="_blank">
                        <i class="fas fa-certificate"></i>
                        Sertifikat
                    </a>
                    <button type="button" class="btn-download btn-dokumen-pdf" title="Print Dokumen PDF" onclick="printDokumen({{ $a->id }}, 'anggota')">
                        <i class="fas fa-file-pdf"></i>
                        PDF
                    </button>
                    <a href="{{ route('petugas.anggota.download-dokumen', $a) }}" class="btn-download btn-dokumen-word" title="Download Word" download>
                        <i class="fas fa-file-word"></i>
                        Word
                    </a>
                    <a href="{{ route('petugas.anggota.show', $a) }}" class="btn-download btn-detail" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                        Detail
                    </a>
                    <button type="button" class="btn-download btn-print" title="Print" onclick="showPrintModal({{ $a->id }}, '{{ $a->nama }}', 'anggota')">
                        <i class="fas fa-print"></i>
                        Print
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state" style="grid-column: 1 / -1;">
                <i class="fas fa-users"></i>
                <h5>Belum Ada Data Anggota</h5>
                <p>Belum ada data anggota yang terdaftar</p>
            </div>
            @endforelse
        </div>
        
        @if($anggota->hasPages())
        <div style="padding: 20px 24px; border-top: 1px solid #f1f5f9;">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $anggota->firstItem() ?? 0 }}–{{ $anggota->lastItem() ?? 0 }} dari {{ $anggota->total() }} data
                </small>
                <div>
                    {{ $anggota->appends(['search_anggota' => request('search_anggota')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Content Koperasi --}}
    <div class="content-card" id="content-koperasi">
        <div class="content-header">
            <h5 class="content-title">
                <i class="fas fa-store"></i>
                Daftar Koperasi
                <span class="badge badge-primary ml-2" style="font-size: 12px;">{{ $koperasi->total() }} Total</span>
            </h5>
        </div>
        
        <div class="filter-box">
            <form method="GET" action="{{ route('petugas.kartu-sertifikat') }}" class="row align-items-end">
                <input type="hidden" name="tab" value="koperasi">
                <div class="col-md-6">
                    <label class="font-weight-600 mb-2" style="font-size: 14px; color: #475569;">
                        <i class="fas fa-search mr-1"></i> Cari Koperasi
                    </label>
                    <input type="text" name="search_koperasi" class="form-control" placeholder="Nama Koperasi atau No. Registrasi..." value="{{ request('search_koperasi') }}" style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 16px;">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('petugas.kartu-sertifikat') }}?tab=koperasi" class="btn btn-secondary btn-block" style="border-radius: 10px; padding: 10px; font-weight: 600;">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
        
        <div class="grid-container">
            @forelse($koperasi as $k)
            <div class="item-card">
                <div class="item-header">
                    <div class="item-avatar">
                        {{ strtoupper(substr($k->nama_usaha ?? 'K', 0, 1)) }}
                    </div>
                    <div class="item-info">
                        <h5>{{ $k->nama_usaha ?? '-' }}</h5>
                        <p><i class="fas fa-id-badge mr-1"></i>{{ $k->no_registrasi ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="item-details">
                    <div class="detail-row">
                        <span class="detail-label">Pemilik:</span>
                        <span class="detail-value">{{ $k->nama_pemilik ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Jenis:</span>
                        <span class="detail-value">{{ $k->jenis_usaha ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Distrik:</span>
                        <span class="detail-value">{{ $k->distrik ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="badge-custom {{ $k->status_usaha == 'aktif' ? 'badge-aktif' : 'badge-pending' }}">
                            {{ ucfirst($k->status_usaha ?? 'Pending') }}
                        </span>
                    </div>
                </div>
                
                <div class="item-actions">
                    <a href="{{ route('petugas.koperasi.download-kartu', $k) }}" class="btn-download btn-kartu" title="Download Kartu" target="_blank">
                        <i class="fas fa-id-card"></i>
                        Kartu
                    </a>
                    <a href="{{ route('petugas.koperasi.download-sertifikat', $k) }}" class="btn-download btn-sertifikat" title="Download Sertifikat" target="_blank">
                        <i class="fas fa-certificate"></i>
                        Sertifikat
                    </a>
                    <button type="button" class="btn-download btn-dokumen-pdf" title="Print Dokumen PDF" onclick="printDokumen({{ $k->id }}, 'koperasi')">
                        <i class="fas fa-file-pdf"></i>
                        PDF
                    </button>
                    <a href="{{ route('petugas.koperasi.download-dokumen', $k) }}" class="btn-download btn-dokumen-word" title="Download Word" download>
                        <i class="fas fa-file-word"></i>
                        Word
                    </a>
                    <a href="{{ route('petugas.koperasi.show', $k) }}" class="btn-download btn-detail" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                        Detail
                    </a>
                    <button type="button" class="btn-download btn-print" title="Print" onclick="showPrintModal({{ $k->id }}, '{{ $k->nama_usaha }}', 'koperasi')">
                        <i class="fas fa-print"></i>
                        Print
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state" style="grid-column: 1 / -1;">
                <i class="fas fa-store"></i>
                <h5>Belum Ada Data Koperasi</h5>
                <p>Belum ada data koperasi yang terdaftar</p>
            </div>
            @endforelse
        </div>
        
        @if($koperasi->hasPages())
        <div style="padding: 20px 24px; border-top: 1px solid #f1f5f9;">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $koperasi->firstItem() ?? 0 }}–{{ $koperasi->lastItem() ?? 0 }} dari {{ $koperasi->total() }} data
                </small>
                <div>
                    {{ $koperasi->appends(['search_koperasi' => request('search_koperasi'), 'tab' => 'koperasi'])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal Print Options --}}
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 16px 16px 0 0; padding: 20px 24px;">
                <h5 class="modal-title" id="printModalLabel" style="font-weight: 700; font-size: 18px;">
                    <i class="fas fa-print mr-2"></i>Pilih Jenis Print
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
                    <span aria-hidden="true" style="font-size: 28px;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <p class="mb-3" style="color: #64748b; font-size: 14px;">
                    <strong id="printItemName"></strong>
                </p>
                <p class="mb-4" style="color: #94a3b8; font-size: 13px;">
                    Pilih format dokumen yang ingin Anda print:
                </p>
                <div class="row">
                    <div class="col-6 mb-3">
                        <button type="button" class="btn btn-block print-option-btn" onclick="printDocument('kartu')" style="padding: 20px; border-radius: 12px; border: 2px solid #e2e8f0; background: white; transition: all 0.3s ease;">
                            <i class="fas fa-id-card fa-2x mb-2" style="color: #3b82f6;"></i>
                            <div style="font-weight: 600; color: #1e293b; font-size: 14px;">Kartu</div>
                            <small style="color: #94a3b8; font-size: 11px;">ID Card Format</small>
                        </button>
                    </div>
                    <div class="col-6 mb-3">
                        <button type="button" class="btn btn-block print-option-btn" onclick="printDocument('sertifikat')" style="padding: 20px; border-radius: 12px; border: 2px solid #e2e8f0; background: white; transition: all 0.3s ease;">
                            <i class="fas fa-certificate fa-2x mb-2" style="color: #f59e0b;"></i>
                            <div style="font-weight: 600; color: #1e293b; font-size: 14px;">Sertifikat</div>
                            <small style="color: #94a3b8; font-size: 11px;">Certificate A4</small>
                        </button>
                    </div>
                    <div class="col-6 mb-3">
                        <button type="button" class="btn btn-block print-option-btn" onclick="printDocument('dokumen')" style="padding: 20px; border-radius: 12px; border: 2px solid #e2e8f0; background: white; transition: all 0.3s ease;">
                            <i class="fas fa-file-word fa-2x mb-2" style="color: #10b981;"></i>
                            <div style="font-weight: 600; color: #1e293b; font-size: 14px;">Dokumen</div>
                            <small style="color: #94a3b8; font-size: 11px;">Word Format</small>
                        </button>
                    </div>
                    <div class="col-6 mb-3">
                        <button type="button" class="btn btn-block print-option-btn" onclick="printDocument('detail')" style="padding: 20px; border-radius: 12px; border: 2px solid #e2e8f0; background: white; transition: all 0.3s ease;">
                            <i class="fas fa-list-alt fa-2x mb-2" style="color: #8b5cf6;"></i>
                            <div style="font-weight: 600; color: #1e293b; font-size: 14px;">Detail Lengkap</div>
                            <small style="color: #94a3b8; font-size: 11px;">Full Data</small>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.print-option-btn:hover {
    border-color: #10b981 !important;
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
}

.print-option-btn:active {
    transform: translateY(-2px);
}
</style>

@endsection

@push('scripts')
<script>
    let currentPrintId = null;
    let currentPrintType = null;
    
    // Fungsi untuk print dokumen PDF langsung
    function printDokumen(id, type) {
        let url = '';
        if (type === 'anggota') {
            url = `/admin/anggota/${id}/print-dokumen`;
        } else if (type === 'koperasi') {
            url = `/admin/koperasi/${id}/print-dokumen`;
        }
        
        // Open in new window and trigger print
        const printWindow = window.open(url, '_blank');
        if (printWindow) {
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                }, 800);
            };
        }
    }
    
    function showPrintModal(id, name, type) {
        currentPrintId = id;
        currentPrintType = type;
        document.getElementById('printItemName').textContent = name;
        $('#printModal').modal('show');
    }
    
    function printDocument(format) {
        $('#printModal').modal('hide');
        
        let url = '';
        if (currentPrintType === 'anggota') {
            if (format === 'kartu') {
                url = `/admin/anggota/${currentPrintId}/sertifikat?type=kartu`;
            } else if (format === 'sertifikat') {
                url = `/admin/anggota/${currentPrintId}/sertifikat?type=sertifikat`;
            } else if (format === 'dokumen') {
                url = `/admin/anggota/${currentPrintId}/print-dokumen`;
            } else if (format === 'detail') {
                url = `/admin/anggota/${currentPrintId}`;
            }
        } else if (currentPrintType === 'koperasi') {
            if (format === 'kartu') {
                url = `/admin/koperasi/${currentPrintId}/sertifikat?type=kartu`;
            } else if (format === 'sertifikat') {
                url = `/admin/koperasi/${currentPrintId}/sertifikat?type=sertifikat`;
            } else if (format === 'dokumen') {
                url = `/admin/koperasi/${currentPrintId}/print-dokumen`;
            } else if (format === 'detail') {
                url = `/admin/koperasi/${currentPrintId}`;
            }
        }
        
        // Open in new window and trigger print for all formats
        const printWindow = window.open(url, '_blank');
        if (printWindow) {
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                }, 800);
            };
        }
    }
    
    function switchTab(tab) {
        // Update tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Find the clicked button
        const clickedBtn = event.currentTarget;
        clickedBtn.classList.add('active');
        
        // Update content
        document.querySelectorAll('.content-card').forEach(content => {
            content.classList.remove('active');
        });
        
        const targetContent = document.getElementById('content-' + tab);
        if (targetContent) {
            targetContent.classList.add('active');
        }
    }
    
    // Check if tab parameter exists in URL on page load
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if (tab === 'koperasi') {
            const koperasiBtn = document.querySelectorAll('.tab-btn')[1];
            if (koperasiBtn) {
                // Remove active from all
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.content-card').forEach(content => content.classList.remove('active'));
                
                // Add active to koperasi
                koperasiBtn.classList.add('active');
                const koperasiContent = document.getElementById('content-koperasi');
                if (koperasiContent) {
                    koperasiContent.classList.add('active');
                }
            }
        }
    });
</script>
@endpush
