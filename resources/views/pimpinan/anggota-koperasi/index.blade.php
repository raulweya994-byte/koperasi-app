@extends('layouts.app')
@section('title', 'Data Anggota Koperasi')

@push('styles')
<style>
    /* Stats Cards Modern */
    .stats-card-modern {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }
    
    .stats-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .stats-card-body {
        padding: 25px;
        color: white;
        position: relative;
        min-height: 120px;
    }
    
    .stats-icon-wrapper {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stats-number {
        font-size: 36px;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 8px;
    }
    
    .stats-label {
        font-size: 14px;
        opacity: 0.95;
        font-weight: 500;
    }
    
    /* Filter Box */
    .filter-box-modern {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    /* Table Modern */
    .table-modern-wrapper {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .table-modern-header {
        padding: 20px 25px;
        border-bottom: 2px solid #f0f0f0;
        background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
    }
    
    .table-modern-header h5 {
        margin: 0;
        color: #ffffff !important;
        font-weight: 800 !important;
        font-size: 17px !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .table-modern-header h5 i {
        color: #ffffff !important;
    }
    
    .table-modern {
        margin: 0;
        font-size: 14px;
    }
    
    .table-modern thead th {
        background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%) !important;
        color: #ffffff !important;
        border: none;
        font-size: 12px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 12px;
        white-space: nowrap;
        text-align: center;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }
    
    .table-modern tbody td {
        padding: 16px 14px;
        vertical-align: middle;
        font-size: 15px;
        border-bottom: 1px solid #f0f0f0;
        color: #111827;
        font-weight: 600;
        line-height: 1.6;
    }
    
    .table-modern tbody td strong {
        font-weight: 800;
        color: #000000;
    }
    
    .table-modern tbody td small {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }
    
    .table-modern tbody tr {
        transition: all 0.2s ease;
    }
    
    .table-modern tbody tr:hover {
        background: #f0fdf4;
    }
    
    /* Action Buttons */
    .action-btn-group {
        display: flex;
        gap: 6px;
        justify-content: center;
    }
    
    .action-btn-group .btn {
        padding: 10px 14px;
        font-size: 14px;
        border-radius: 8px;
        border: none !important;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    
    .action-btn-group .btn-info {
        background: #3b82f6 !important;
        background-color: #3b82f6 !important;
        color: white !important;
    }
    
    .action-btn-group .btn-info:hover {
        background: #2563eb !important;
        background-color: #2563eb !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }
    
    /* Badge Modern */
    .status-badge {
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        display: inline-block;
    }
    
    .status-active {
        background: #10b981;
        color: white;
    }
    
    .status-pending {
        background: #f59e0b;
        color: white;
    }
    
    .status-inactive {
        background: #ef4444;
        color: white;
    }
    
    .badge-custom {
        padding: 4px 10px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
    }
    
    .badge-blue {
        background: #3b82f6;
        color: white;
    }
    
    .badge-purple {
        background: #a855f7;
        color: white;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 60px;
        color: #e5e7eb;
        margin-bottom: 15px;
    }
    
    .empty-state h5 {
        color: #374151;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        color: #9ca3af;
        margin-bottom: 15px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stats-card-modern {
            margin-bottom: 15px;
        }
        
        .stats-number {
            font-size: 28px;
        }
        
        .stats-icon-wrapper {
            width: 50px;
            height: 50px;
        }
        
        .filter-box-modern {
            padding: 20px;
        }
        
        .table-modern thead th,
        .table-modern tbody td {
            padding: 10px 8px;
            font-size: 11px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Permission Status Alert --}}
    @php
        $hasAnyPermission = can_view('anggota') || can_create('anggota') || can_edit('anggota') || can_delete('anggota');
    @endphp

    @if(!$hasAnyPermission)
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-warning" style="border-radius:12px;border:none;box-shadow:0 4px 12px rgba(0,0,0,0.08);background:linear-gradient(135deg,#fff3cd,#ffe69c);border-left:5px solid #ffc107">
                <div class="d-flex align-items-center">
                    <div style="font-size:48px;color:#ffc107;margin-right:20px">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading mb-2" style="color:#856404;font-weight:700">
                            <i class="fas fa-lock mr-2"></i>Akses Terbatas
                        </h5>
                        <p class="mb-2" style="color:#856404;font-size:14px">
                            Anda belum memiliki izin untuk mengelola Data Anggota Koperasi. 
                            Silakan hubungi <strong>Administrator</strong> untuk mendapatkan akses berikut:
                        </p>
                        <ul class="mb-0" style="color:#856404;font-size:13px">
                            <li><i class="fas fa-eye mr-1"></i> Lihat Detail Anggota</li>
                            <li><i class="fas fa-plus mr-1"></i> Tambah Anggota Baru</li>
                            <li><i class="fas fa-edit mr-1"></i> Edit Data Anggota</li>
                            <li><i class="fas fa-trash mr-1"></i> Hapus Data Anggota</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-info" style="border-radius:12px;border:none;box-shadow:0 4px 12px rgba(0,0,0,0.08);background:linear-gradient(135deg,#d1ecf1,#bee5eb);border-left:5px solid #17a2b8">
                <div class="d-flex align-items-center">
                    <div style="font-size:32px;color:#17a2b8;margin-right:15px">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div style="flex:1">
                        <h6 class="mb-2" style="color:#0c5460;font-weight:700">
                            <i class="fas fa-check-circle mr-1"></i>Status Izin Akses Anda
                        </h6>
                        <div class="row" style="font-size:13px">
                            <div class="col-md-3">
                                @if(can_view('anggota'))
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460"><i class="fas fa-eye mr-1"></i>Lihat Detail</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-eye mr-1"></i>Lihat Detail</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if(can_create('anggota'))
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460"><i class="fas fa-plus mr-1"></i>Tambah Anggota</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-plus mr-1"></i>Tambah Anggota</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if(can_edit('anggota'))
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460"><i class="fas fa-edit mr-1"></i>Edit Data</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-edit mr-1"></i>Edit Data</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if(can_delete('anggota'))
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460"><i class="fas fa-trash mr-1"></i>Hapus Data</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-trash mr-1"></i>Hapus Data</span>
                                @endif
                            </div>
                        </div>
                        <p class="mb-0 mt-2" style="color:#0c5460;font-size:12px">
                            <i class="fas fa-info-circle mr-1"></i>
                            Tombol yang tidak diizinkan tidak akan tampil di tabel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['total'] }}</div>
                    <div class="stats-label">Total Anggota</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #10b981, #059669);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['aktif'] }}</div>
                    <div class="stats-label">Anggota Aktif</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['nonaktif'] }}</div>
                    <div class="stats-label">Anggota Nonaktif</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-user-times fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['pending'] }}</div>
                    <div class="stats-label">Menunggu Verifikasi</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Box --}}
    <div class="filter-box-modern">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-1" style="font-weight: 700; color: #1f2937;">
                    <i class="fas fa-filter mr-2"></i>Filter Data Anggota
                </h5>
                <p class="text-muted mb-0" style="font-size: 13px;">Cari dan filter data anggota sesuai kebutuhan</p>
            </div>
        </div>
        <form method="GET" action="{{ route('pimpinan.anggota-koperasi.index') }}" id="filterForm">
            <div class="row align-items-end">
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold" style="font-size: 13px; color: #495057;">
                        <i class="fas fa-search mr-1"></i>Pencarian
                    </label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama, NIK, atau nomor anggota..." 
                           value="{{ request('search') }}"
                           style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 10px 15px;">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold" style="font-size: 13px; color: #495057;">
                        <i class="fas fa-info-circle mr-1"></i>Status
                    </label>
                    <select name="status" class="form-control" style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 10px 15px;">
                        <option value="">Semua Status</option>
                        @foreach(['Aktif','Pending','Nonaktif'] as $s)
                        <option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold" style="font-size: 13px; color: #495057;">
                        <i class="fas fa-map-marker-alt mr-1"></i>Distrik
                    </label>
                    <select name="distrik" class="form-control" style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 10px 15px;">
                        <option value="">Semua Distrik</option>
                        @foreach($distrikList as $d)
                        <option value="{{ $d }}" {{ request('distrik')==$d?'selected':'' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; font-weight: 600; padding: 10px;">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                </div>
                <div class="col-md-2 mb-3">
                    <a href="{{ route('pimpinan.anggota-koperasi.index') }}" class="btn btn-secondary btn-block" style="border-radius: 10px; font-weight: 600; padding: 10px;">
                        <i class="fas fa-redo mr-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="table-modern-wrapper">
        <div class="table-modern-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list mr-2"></i>Daftar Anggota Koperasi</h5>
            @if(can_create('anggota'))
            <a href="{{ route('pimpinan.anggota-koperasi.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus mr-1"></i>Tambah Anggota
            </a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-modern table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:100px;">No. Anggota</th>
                        <th style="width:60px;">Foto</th>
                        <th style="width:180px;">Data Pribadi</th>
                        <th style="width:120px;">Tempat, Tgl Lahir</th>
                        <th style="width:80px;">JK</th>
                        <th style="width:100px;">Status Kawin</th>
                        <th style="width:100px;">Pendidikan</th>
                        <th style="width:80px;">Agama</th>
                        <th style="width:120px;">Kontak</th>
                        <th style="width:120px;">Alamat</th>
                        <th style="width:150px;">Koperasi</th>
                        <th style="width:150px;">Usaha</th>
                        <th style="width:120px;">Bidang Usaha</th>
                        <th style="width:150px;">Ahli Waris</th>
                        <th style="width:120px;">Simpanan Pokok</th>
                        <th style="width:120px;">Simpanan Wajib</th>
                        <th style="width:120px;">Total Simpanan</th>
                        <th style="width:100px;">Tgl Bergabung</th>
                        <th style="width:80px;">Status</th>
                        <th style="width:80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($anggota as $a)
                <tr>
                    <td><strong class="text-primary" style="font-size:11px;">{{ $a->no_anggota }}</strong></td>
                    <td class="text-center">
                        <img src="{{ $a->foto_url }}" class="img-circle" width="40" height="40" style="object-fit:cover;border:2px solid #e0e6ff;">
                    </td>
                    <td>
                        <strong style="font-size:12px;">{{ $a->nama }}</strong><br>
                        <small class="text-muted" style="font-size:10px;"><i class="fas fa-id-card mr-1"></i>{{ $a->nik }}</small>
                    </td>
                    <td>
                        <small style="font-size:11px;">{{ $a->tempat_lahir }}</small><br>
                        <small class="text-muted" style="font-size:10px;">{{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->format('d M Y') : '-' }}</small><br>
                        <small class="text-info" style="font-size:10px;">({{ $a->umur }} thn)</small>
                    </td>
                    <td class="text-center">
                        @if($a->jenis_kelamin === 'L')
                        <span class="badge badge-custom badge-blue" style="font-size:9px;"><i class="fas fa-mars"></i> L</span>
                        @else
                        <span class="badge badge-custom badge-purple" style="font-size:9px;"><i class="fas fa-venus"></i> P</span>
                        @endif
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->status_perkawinan === 'Lajang')
                            <span class="badge badge-info" style="font-size:9px;">Lajang</span>
                            @elseif($a->status_perkawinan === 'Menikah')
                            <span class="badge badge-success" style="font-size:9px;">Menikah</span>
                            @elseif($a->status_perkawinan === 'Cerai')
                            <span class="badge badge-warning" style="font-size:9px;">Cerai</span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </small>
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->pendidikan_terakhir)
                            <span class="badge badge-primary" style="font-size:9px;"><i class="fas fa-graduation-cap mr-1"></i>{{ $a->pendidikan_terakhir }}</span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </small>
                    </td>
                    <td><small style="font-size:10px;">{{ $a->agama ?? '-' }}</small></td>
                    <td>
                        <small style="font-size:10px;"><i class="fab fa-whatsapp text-success mr-1"></i>{{ $a->no_hp }}</small><br>
                        @if($a->user && $a->user->email)
                        <small class="text-muted" style="font-size:9px;"><i class="fas fa-envelope mr-1"></i>{{ Str::limit($a->user->email, 20) }}</small>
                        @endif
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->desa)<i class="fas fa-map-marker-alt text-danger mr-1"></i>{{ $a->desa }}<br>@endif
                            <strong>{{ $a->distrik ?? '-' }}</strong><br>
                            <span class="text-muted">{{ $a->kabupaten ?? 'Tolikara' }}</span>
                        </small>
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->koperasi)
                            <i class="fas fa-building text-primary mr-1"></i><strong>{{ Str::limit($a->koperasi->nama_usaha, 25) }}</strong>
                            @else
                            <span class="text-muted">Belum terdaftar</span>
                            @endif
                        </small>
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->nama_usaha)
                            <i class="fas fa-store text-success mr-1"></i>{{ Str::limit($a->nama_usaha, 25) }}
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </small>
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->bidang_usaha)
                            <span class="badge badge-secondary" style="font-size:9px;">{{ $a->bidang_usaha }}</span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </small>
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->nama_ahli_waris)
                            <i class="fas fa-user-friends text-info mr-1"></i><strong>{{ Str::limit($a->nama_ahli_waris, 20) }}</strong><br>
                            <span class="text-muted">({{ $a->hubungan_ahli_waris }})</span><br>
                            <span class="text-muted">{{ $a->no_hp_ahli_waris }}</span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </small>
                    </td>
                    <td class="text-right">
                        <small class="text-success font-weight-bold" style="font-size:11px;">
                            Rp {{ number_format($a->simpanan_pokok ?? 0, 0, ',', '.') }}
                        </small>
                    </td>
                    <td class="text-right">
                        <small class="text-warning font-weight-bold" style="font-size:11px;">
                            Rp {{ number_format($a->simpanan_wajib ?? 0, 0, ',', '.') }}
                        </small>
                    </td>
                    <td class="text-right">
                        <small class="text-primary font-weight-bold" style="font-size:11px;">
                            Rp {{ number_format($a->total_simpanan ?? 0, 0, ',', '.') }}
                        </small>
                    </td>
                    <td>
                        <small style="font-size:10px;">
                            @if($a->tanggal_bergabung)
                            <i class="fas fa-calendar-alt text-muted mr-1"></i>{{ \Carbon\Carbon::parse($a->tanggal_bergabung)->format('d M Y') }}
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </small>
                    </td>
                    <td class="text-center">
                        @if($a->status === 'Aktif')
                        <span class="status-badge status-active">Aktif</span>
                        @elseif($a->status === 'Pending')
                        <span class="status-badge status-pending">Pending</span>
                        @else
                        <span class="status-badge status-inactive">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btn-group">
                            @if(can_view('anggota'))
                            <a href="{{ route('pimpinan.anggota-koperasi.show', $a) }}" class="btn btn-sm btn-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endif
                            @if(can_edit('anggota'))
                            <a href="{{ route('pimpinan.anggota-koperasi.edit', $a) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                            @if(can_delete('anggota'))
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteAnggota({{ $a->id }})" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="20">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h5>Tidak Ada Data</h5>
                            <p>Belum ada anggota koperasi yang tersedia</p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
                @if($anggota->count() > 0)
                <tfoot style="background: #f8f9fa;">
                    <tr>
                        <td colspan="14" class="text-right font-weight-bold" style="padding: 15px 12px; font-size:12px;">TOTAL</td>
                        <td class="font-weight-bold text-success text-right" style="padding: 15px 12px; font-size:12px;">
                            Rp {{ number_format($anggota->sum('simpanan_pokok'),0,',','.') }}
                        </td>
                        <td class="font-weight-bold text-warning text-right" style="padding: 15px 12px; font-size:12px;">
                            Rp {{ number_format($anggota->sum('simpanan_wajib'),0,',','.') }}
                        </td>
                        <td class="font-weight-bold text-primary text-right" style="padding: 15px 12px; font-size:12px;">
                            Rp {{ number_format($anggota->sum('total_simpanan'),0,',','.') }}
                        </td>
                        <td colspan="3" style="padding: 15px 12px;"></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($anggota->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $anggota->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function deleteAnggota(id) {
    Swal.fire({
        title: 'Hapus Anggota?',
        text: "Data anggota akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/pimpinan/anggota-koperasi/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    let message = 'Terjadi kesalahan saat menghapus data';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: message
                    });
                }
            });
        }
    });
}
</script>
@endpush
