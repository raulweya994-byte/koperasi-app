@extends('layouts.app')
@section('title', 'Detail Program Bantuan')

@push('styles')
<style>
    /* Header Card */
    .detail-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        border: none;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .detail-header-content {
        padding: 30px;
        color: white;
    }
    
    .detail-header-icon {
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
    
    .detail-header-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .detail-header-subtitle {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    /* Info Cards */
    .info-card {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin-bottom: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    .info-card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 24px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .info-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .info-card-body {
        padding: 24px;
    }
    
    /* Info Item */
    .info-item {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        width: 180px;
        font-weight: 600;
        color: #64748b;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .info-value {
        flex: 1;
        color: #1e293b;
        font-size: 14px;
        font-weight: 500;
    }
    
    /* Badge Modern */
    .badge-modern {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .badge-success-modern {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }
    
    .badge-warning-modern {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }
    
    .badge-danger-modern {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }
    
    .badge-info-modern {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }
    
    .badge-secondary-modern {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
    }
    
    /* Action Buttons */
    .action-btn-group {
        display: flex;
        gap: 10px;
    }
    
    .btn-modern {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-edit-modern {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    .btn-edit-modern:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
        color: white;
    }
    
    .btn-back-modern {
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .btn-back-modern:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        color: #475569;
    }
    
    .btn-add-modern {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-add-modern:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        color: white;
    }
    
    /* Table Modern */
    .table-modern {
        margin-bottom: 0;
    }
    
    .table-modern thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #475569;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px;
        border: none;
    }
    
    .table-modern tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }
    
    .table-modern tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Empty State */
    .empty-state-modern {
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
    }
    
    .empty-state-modern i {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
    }
    
    .empty-state-modern h5 {
        color: #64748b;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .empty-state-modern p {
        color: #94a3b8;
        font-size: 14px;
    }
    
    /* Description Box */
    .description-box {
        background: #f8fafc;
        border-left: 4px solid #667eea;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }
    
    .description-box strong {
        color: #475569;
        font-size: 14px;
        display: block;
        margin-bottom: 12px;
    }
    
    .description-box p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 0;
    }
    
    /* Stats Badge */
    .stats-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="detail-header-card">
        <div class="detail-header-content">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="detail-header-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div>
                        <h3 class="detail-header-title">{{ $bantuan->nama_bantuan }}</h3>
                        <p class="detail-header-subtitle">
                            <i class="fas fa-tag mr-2"></i>{{ $bantuan->kode_bantuan }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-calendar mr-2"></i>{{ $bantuan->tahun }}
                        </p>
                    </div>
                </div>
                <div class="action-btn-group d-none d-md-flex">
                    <a href="{{ route('admin.bantuan.edit', $bantuan) }}" class="btn btn-edit-modern">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="javascript:history.back()" class="btn btn-back-modern">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px; border-left: 4px solid #10b981;">
        <i class="fas fa-check-circle mr-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif

    <div class="row">
        {{-- Informasi Program Bantuan --}}
        <div class="col-lg-8">
            <div class="info-card">
                <div class="info-card-header">
                    <h5 class="info-card-title">
                        <i class="fas fa-info-circle text-primary"></i>
                        Informasi Program Bantuan
                    </h5>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-tag text-purple"></i> Kode Bantuan
                        </div>
                        <div class="info-value">
                            <span class="badge badge-modern badge-info-modern">{{ $bantuan->kode_bantuan }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-file-alt text-blue"></i> Nama Bantuan
                        </div>
                        <div class="info-value">{{ $bantuan->nama_bantuan }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-layer-group text-cyan"></i> Jenis
                        </div>
                        <div class="info-value">
                            <span class="badge badge-modern badge-info-modern">
                                {{ ucfirst(str_replace('_', ' ', $bantuan->jenis_bantuan)) }}
                            </span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar text-orange"></i> Tahun
                        </div>
                        <div class="info-value"><strong>{{ $bantuan->tahun }}</strong></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-clock text-teal"></i> Periode
                        </div>
                        <div class="info-value">{{ $bantuan->periode }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-money-bill-wave text-green"></i> Anggaran
                        </div>
                        <div class="info-value">
                            <strong class="text-success">Rp {{ number_format($bantuan->anggaran, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-users text-indigo"></i> Kuota
                        </div>
                        <div class="info-value">
                            <strong>{{ $bantuan->kuota }}</strong> Koperasi
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-toggle-on text-success"></i> Status
                        </div>
                        <div class="info-value">
                            @if($bantuan->status === 'aktif')
                                <span class="badge-modern badge-success-modern">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </span>
                            @else
                                <span class="badge-modern badge-secondary-modern">
                                    <i class="fas fa-times-circle"></i> Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    @if ($bantuan->deskripsi)
                    <div class="description-box">
                        <strong><i class="fas fa-align-left mr-2"></i>Deskripsi Program:</strong>
                        <p>{{ $bantuan->deskripsi }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar Info --}}
        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <h5 class="info-card-title">
                        <i class="fas fa-chart-pie text-success"></i>
                        Statistik
                    </h5>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-user-check text-primary"></i> Dibuat Oleh
                        </div>
                        <div class="info-value">{{ $bantuan->createdBy?->name ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-plus text-info"></i> Tanggal Dibuat
                        </div>
                        <div class="info-value">{{ $bantuan->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-users text-success"></i> Total Penerima
                        </div>
                        <div class="info-value">
                            <span class="stats-badge">
                                {{ $bantuan->penerima->count() }} / {{ $bantuan->kuota }}
                            </span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-percentage text-warning"></i> Persentase
                        </div>
                        <div class="info-value">
                            <strong class="text-primary">
                                {{ $bantuan->kuota > 0 ? round(($bantuan->penerima->count() / $bantuan->kuota) * 100, 1) : 0 }}%
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Penerima Bantuan --}}
    <div class="info-card">
        <div class="info-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="info-card-title">
                    <i class="fas fa-users text-success"></i>
                    Penerima Bantuan
                    <span class="stats-badge ml-2">{{ $bantuan->penerima->count() }} / {{ $bantuan->kuota }}</span>
                </h5>
                @if ($bantuan->penerima->count() < $bantuan->kuota)
                <button class="btn btn-sm btn-add-modern" data-toggle="modal" data-target="#modalTambahPenerima">
                    <i class="fas fa-plus"></i> Tambah Penerima
                </button>
                @endif
            </div>
        </div>
        <div class="info-card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="4%">#</th>
                            <th width="18%">Nama Koperasi</th>
                            <th width="13%">Pemilik</th>
                            <th width="11%">No. HP</th>
                            <th width="12%">Distrik</th>
                            <th width="11%">Jumlah Bantuan</th>
                            <th width="9%">Status</th>
                            <th width="10%">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bantuan->penerima as $i => $penerima)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 12px; font-size: 14px;">
                                        {{ strtoupper(substr($penerima->koperasi?->nama_usaha ?? 'K', 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong style="display: block; color: #1e293b; font-size: 14px;">
                                            {{ $penerima->koperasi?->nama_usaha ?? '-' }}
                                        </strong>
                                        <small class="text-muted" style="font-size: 12px;">
                                            <i class="fas fa-tag mr-1"></i>{{ $penerima->koperasi?->no_registrasi ?? '-' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong style="color: #475569;">{{ $penerima->koperasi?->nama_pemilik ?? '-' }}</strong>
                            </td>
                            <td>
                                <i class="fas fa-phone text-success mr-1"></i>
                                <span style="font-size: 13px;">{{ $penerima->koperasi?->no_hp ?? '-' }}</span>
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                <span style="font-size: 13px;">{{ $penerima->koperasi?->distrik ?? '-' }}</span>
                            </td>
                            <td>
                                @if($penerima->jumlah_bantuan > 0)
                                    <strong class="text-success" style="font-size: 13px;">
                                        Rp {{ number_format($penerima->jumlah_bantuan, 2, ',', '.') }}
                                    </strong>
                                @else
                                    <span class="text-muted" style="font-size: 12px;">
                                        <i class="fas fa-minus"></i> Belum diisi
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $status = $penerima->status ?? 'pending';
                                    $badgeClass = match($status) {
                                        'diterima' => 'badge-success-modern',
                                        'ditolak' => 'badge-danger-modern',
                                        'divalidasi' => 'badge-info-modern',
                                        default => 'badge-warning-modern'
                                    };
                                    $icon = match($status) {
                                        'diterima' => 'fa-check-circle',
                                        'ditolak' => 'fa-times-circle',
                                        'divalidasi' => 'fa-check',
                                        default => 'fa-clock'
                                    };
                                @endphp
                                <span class="badge-modern {{ $badgeClass }}" style="font-size: 11px;">
                                    <i class="fas {{ $icon }}"></i> {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td>
                                <div style="font-size: 12px;">
                                    <i class="far fa-calendar mr-1 text-primary"></i>
                                    {{ $penerima->created_at?->format('d M Y') ?? '-' }}
                                </div>
                                @if($penerima->tanggal_penerimaan)
                                <div style="font-size: 11px; color: #10b981; margin-top: 4px;">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ \Carbon\Carbon::parse($penerima->tanggal_penerimaan)->format('d M Y') }}
                                </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state-modern">
                                    <i class="fas fa-users-slash"></i>
                                    <h5>Belum Ada Penerima</h5>
                                    <p>Belum ada koperasi yang ditambahkan sebagai penerima bantuan</p>
                                    @if ($bantuan->penerima->count() < $bantuan->kuota)
                                    <button class="btn btn-add-modern mt-3" data-toggle="modal" data-target="#modalTambahPenerima">
                                        <i class="fas fa-plus mr-2"></i>Tambah Penerima Sekarang
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($bantuan->penerima->count() > 0)
            <div class="p-3" style="background: #f8fafc; border-top: 2px solid #e9ecef;">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i>
                            Total {{ $bantuan->penerima->count() }} koperasi terdaftar dari {{ $bantuan->kuota }} kuota
                        </small>
                    </div>
                    <div class="col-md-6 text-right">
                        <small class="text-muted">
                            <i class="fas fa-money-bill-wave mr-1 text-success"></i>
                            Total Bantuan: <strong class="text-success">Rp {{ number_format($bantuan->penerima->sum('jumlah_bantuan'), 2, ',', '.') }}</strong>
                        </small>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Jadwal Distribusi --}}
    <div class="info-card">
        <div class="info-card-header">
            <h5 class="info-card-title">
                <i class="fas fa-calendar-check text-info"></i>
                Jadwal Distribusi
            </h5>
        </div>
        <div class="info-card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Tanggal</th>
                            <th>Lokasi</th>
                            <th width="20%">Petugas</th>
                            <th width="12%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bantuan->jadwal as $i => $jadwal)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <i class="far fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                {{ $jadwal->lokasi ?? '-' }}
                            </td>
                            <td>
                                <i class="fas fa-user mr-1"></i>
                                {{ $jadwal->petugas?->name ?? '-' }}
                            </td>
                            <td>
                                @php
                                    $statusJadwal = $jadwal->status ?? 'terjadwal';
                                    $badgeClass = match($statusJadwal) {
                                        'selesai' => 'badge-success-modern',
                                        'batal' => 'badge-danger-modern',
                                        default => 'badge-info-modern'
                                    };
                                    $icon = match($statusJadwal) {
                                        'selesai' => 'fa-check-circle',
                                        'batal' => 'fa-times-circle',
                                        default => 'fa-calendar-alt'
                                    };
                                @endphp
                                <span class="badge-modern {{ $badgeClass }}">
                                    <i class="fas {{ $icon }}"></i> {{ ucfirst($statusJadwal) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state-modern">
                                    <i class="fas fa-calendar-times"></i>
                                    <h5>Belum Ada Jadwal</h5>
                                    <p>Belum ada jadwal distribusi yang dibuat untuk program bantuan ini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Penerima --}}
@if ($bantuan->penerima->count() < $bantuan->kuota)
<div class="modal fade" id="modalTambahPenerima" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 16px 16px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-user-plus mr-2"></i>Tambah Penerima Bantuan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.bantuan.tambahPenerima', $bantuan) }}" method="POST">
                @csrf
                <div class="modal-body" style="padding: 24px;">
                    <div class="alert alert-info" style="border-radius: 10px; border-left: 4px solid #3b82f6;">
                        <i class="fas fa-info-circle mr-2"></i>
                        Pilih koperasi yang sudah terverifikasi dan belum menjadi penerima bantuan ini.
                    </div>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <table class="table table-hover mb-0">
                            <thead style="position: sticky; top: 0; background: #f8fafc; z-index: 10;">
                                <tr>
                                    <th width="5%">
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>Nama Usaha</th>
                                    <th>Pemilik</th>
                                    <th>Jenis Usaha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($koperasiTersedia as $koperasi)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="koperasi_ids[]" value="{{ $koperasi->id }}" class="koperasi-checkbox">
                                    </td>
                                    <td><strong>{{ $koperasi->nama_usaha }}</strong></td>
                                    <td>{{ $koperasi->nama_pemilik }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $koperasi->jenis_usaha ?? '-' }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block" style="opacity: 0.3;"></i>
                                        Tidak ada koperasi tersedia
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #f1f5f9; padding: 20px 24px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; padding: 10px 20px;">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-add-modern" style="padding: 10px 24px;">
                        <i class="fas fa-check mr-2"></i>Tambah Penerima
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Select All Checkbox
    $('#selectAll').on('change', function() {
        $('.koperasi-checkbox').prop('checked', $(this).prop('checked'));
    });
    
    // Update Select All when individual checkbox changes
    $('.koperasi-checkbox').on('change', function() {
        var total = $('.koperasi-checkbox').length;
        var checked = $('.koperasi-checkbox:checked').length;
        $('#selectAll').prop('checked', total === checked);
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
                
                // Submit via form
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
    
    // Success notification
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endpush
