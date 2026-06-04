@extends('layouts.app')
@section('title', 'Data Koperasi')

@section('content')
<div class="container-fluid">
    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-blue">
                <div class="stats-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>Total Koperasi</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-orange">
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['pending'] }}</h3>
                    <p>Menunggu Verifikasi</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-green">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['diverifikasi'] }}</h3>
                    <p>Terverifikasi</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-teal">
                <div class="stats-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['aktif'] }}</h3>
                    <p>Koperasi Aktif</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-box">
                <form method="GET" action="{{ route('admin.koperasi.index') }}" id="filterForm">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cari Koperasi</label>
                                <div class="search-box-modern">
                                    <i class="fas fa-search"></i>
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Nama, No. Reg, Pemilik..." value="{{ $filters['search'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Status Verifikasi</label>
                                <select name="status_verifikasi" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="pending" {{ ($filters['status_verifikasi'] ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diverifikasi" {{ ($filters['status_verifikasi'] ?? '') === 'diverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                    <option value="ditolak" {{ ($filters['status_verifikasi'] ?? '') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Status Usaha</label>
                                <select name="status_usaha" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="aktif" {{ ($filters['status_usaha'] ?? '') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak aktif" {{ ($filters['status_usaha'] ?? '') === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Distrik</label>
                                <select name="distrik" class="form-control">
                                    <option value="">Semua Distrik</option>
                                    @foreach($distrik as $d)
                                        <option value="{{ $d }}" {{ ($filters['distrik'] ?? '') === $d ? 'selected' : '' }}>{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="mikro" {{ ($filters['kategori'] ?? '') === 'mikro' ? 'selected' : '' }}>Mikro</option>
                                    <option value="kecil" {{ ($filters['kategori'] ?? '') === 'kecil' ? 'selected' : '' }}>Kecil</option>
                                    <option value="menengah" {{ ($filters['kategori'] ?? '') === 'menengah' ? 'selected' : '' }}>Menengah</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary-modern btn-block">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if(array_filter($filters ?? []))
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.koperasi.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-redo"></i> Reset Filter
                            </a>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Download Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#10b981,#059669)">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h5 class="text-white mb-2 font-weight-bold">
                                <i class="fas fa-download mr-2"></i>Download Laporan Data Koperasi
                            </h5>
                            <p class="text-white mb-0" style="opacity:0.9;font-size:13px">
                                Export data koperasi ke format Excel atau Word dengan filter yang diterapkan. Data akan otomatis terdownload sesuai format yang dipilih.
                            </p>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" 
                                            onclick="printKoperasi()" 
                                            class="btn btn-light btn-block download-btn-modern">
                                        <i class="fas fa-print fa-2x mb-2 d-block" style="color:#3b82f6"></i>
                                        <strong style="font-size:14px">Print</strong>
                                        <p class="mb-0 mt-1" style="font-size:11px;opacity:0.7">Cetak Data</p>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('admin.laporan.exportExcel', array_merge(['type'=>'koperasi'], $filters ?? [])) }}" 
                                       class="btn btn-light btn-block download-btn-modern">
                                        <i class="fas fa-file-excel fa-2x mb-2 d-block" style="color:#10b981"></i>
                                        <strong style="font-size:14px">Excel</strong>
                                        <p class="mb-0 mt-1" style="font-size:11px;opacity:0.7">Format XLSX</p>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('admin.laporan.exportWord', array_merge(['type'=>'koperasi'], $filters ?? [])) }}" 
                                       class="btn btn-light btn-block download-btn-modern">
                                        <i class="fas fa-file-word fa-2x mb-2 d-block" style="color:#2b579a"></i>
                                        <strong style="font-size:14px">Word</strong>
                                        <p class="mb-0 mt-1" style="font-size:11px;opacity:0.7">Format DOCX</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title mb-0">
                        <i class="fas fa-list"></i> Daftar Koperasi
                        <span class="badge badge-primary ml-2">{{ $koperasi->total() }}</span>
                    </h5>
                </div>
                <div class="content-card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>No. Registrasi</th>
                                    <th>Nama Usaha / Pemilik</th>
                                    <th>Jenis Usaha</th>
                                    <th>Distrik</th>
                                    <th>Kategori</th>
                                    <th>Status Verifikasi</th>
                                    <th>Status Usaha</th>
                                    <th>Tanggal</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($koperasi as $i => $u)
                                <tr>
                                    <td>{{ $koperasi->firstItem() + $i }}</td>
                                    <td>
                                        <span class="badge badge-blue">{{ $u->no_registrasi }}</span>
                                    </td>
                                    <td>
                                        <div class="list-item-title">{{ $u->nama_usaha }}</div>
                                        <div class="list-item-subtitle">
                                            <i class="fas fa-user mr-1"></i>{{ $u->nama_pemilik }}
                                        </div>
                                    </td>
                                    <td>{{ $u->jenis_usaha }}</td>
                                    <td>
                                        <span class="badge badge-custom badge-purple">{{ $u->distrik }}</span>
                                    </td>
                                    <td>
                                        @if($u->kategori === 'mikro')
                                            <span class="badge badge-custom badge-blue">Mikro</span>
                                        @elseif($u->kategori === 'kecil')
                                            <span class="badge badge-custom badge-green">Kecil</span>
                                        @else
                                            <span class="badge badge-custom badge-orange">Menengah</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($u->status_verifikasi === 'diverifikasi')
                                            <span class="status-badge status-active">
                                                <i class="fas fa-check-circle"></i> Terverifikasi
                                            </span>
                                        @elseif($u->status_verifikasi === 'pending')
                                            <span class="status-badge status-pending">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        @else
                                            <span class="status-badge status-inactive">
                                                <i class="fas fa-times-circle"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($u->status_usaha === 'aktif')
                                            <span class="status-badge status-active">
                                                <i class="fas fa-check"></i> Aktif
                                            </span>
                                        @else
                                            <span class="status-badge status-inactive">
                                                <i class="fas fa-times"></i> Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="list-item-meta">
                                            <i class="far fa-calendar mr-1"></i>{{ $u->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.koperasi.show', $u) }}" 
                                               class="btn btn-sm btn-info-modern" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.koperasi.download-dokumen', $u) }}" 
                                               class="btn btn-sm btn-success-modern" title="Print Dokumen" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <a href="{{ route('admin.koperasi.edit', $u) }}" 
                                               class="btn btn-sm btn-warning-modern" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.koperasi.destroy', $u) }}" style="display:inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-modern btn-delete" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h5>Tidak Ada Data</h5>
                                            <p>Belum ada data koperasi yang tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($koperasi->hasPages())
                <div class="content-card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $koperasi->firstItem() }}–{{ $koperasi->lastItem() }} dari {{ $koperasi->total() }} data
                        </small>
                        <div>
                            {{ $koperasi->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.download-btn-modern {
    border-radius: 12px;
    padding: 15px 10px;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-decoration: none;
    display: block;
    text-align: center;
}

.download-btn-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    text-decoration: none;
}

.download-btn-modern strong {
    color: #1f2937;
    font-size: 14px;
}

.download-btn-modern p {
    color: #6b7280;
    margin: 0;
}

.download-btn-modern i {
    transition: all 0.3s ease;
}

.download-btn-modern:hover i {
    transform: scale(1.1);
}
</style>
@endpush

@push('scripts')
<script>
// Data untuk print
const allKoperasiData = @json($koperasi->items());
const statsData = {
    total: {{ $koperasi->total() }},
    pending: {{ $koperasi->where('status_verifikasi', 'pending')->count() }},
    diverifikasi: {{ $koperasi->where('status_verifikasi', 'diverifikasi')->count() }},
    aktif: {{ $koperasi->where('status_usaha', 'aktif')->count() }}
};
const filterData = @json($filters ?? []);

function printKoperasi() {
    const printWindow = window.open('', '_blank', 'width=1000,height=800');
    
    // Filter info
    let filterText = '';
    if (filterData.search) filterText += `Pencarian: "${filterData.search}" | `;
    if (filterData.status_verifikasi) filterText += `Status Verifikasi: ${filterData.status_verifikasi.charAt(0).toUpperCase() + filterData.status_verifikasi.slice(1)} | `;
    if (filterData.status_usaha) filterText += `Status Usaha: ${filterData.status_usaha.charAt(0).toUpperCase() + filterData.status_usaha.slice(1)} | `;
    if (filterData.distrik) filterText += `Distrik: ${filterData.distrik} | `;
    if (filterData.kategori) filterText += `Kategori: ${filterData.kategori.charAt(0).toUpperCase() + filterData.kategori.slice(1)} | `;
    
    if (!filterText) {
        filterText = 'Semua Data';
    } else {
        filterText = filterText.slice(0, -3);
    }
    
    // Generate table rows
    let tableRows = '';
    allKoperasiData.forEach((k, index) => {
        let statusVerifikasiBadge = '';
        let statusVerifikasiColor = '';
        if(k.status_verifikasi === 'diverifikasi') {
            statusVerifikasiBadge = 'Terverifikasi';
            statusVerifikasiColor = '#10b981';
        } else if(k.status_verifikasi === 'pending') {
            statusVerifikasiBadge = 'Pending';
            statusVerifikasiColor = '#f59e0b';
        } else {
            statusVerifikasiBadge = 'Ditolak';
            statusVerifikasiColor = '#ef4444';
        }
        
        let statusUsahaBadge = k.status_usaha === 'aktif' ? 'Aktif' : 'Tidak Aktif';
        let statusUsahaColor = k.status_usaha === 'aktif' ? '#10b981' : '#6b7280';
        
        let kategoriColor = '';
        if(k.kategori === 'mikro') {
            kategoriColor = '#3b82f6';
        } else if(k.kategori === 'kecil') {
            kategoriColor = '#10b981';
        } else {
            kategoriColor = '#f59e0b';
        }
        
        const bgColor = index % 2 === 0 ? '#f8f9fa' : '#ffffff';
        const createdDate = k.created_at ? new Date(k.created_at).toLocaleDateString('id-ID') : '-';
        
        tableRows += `
            <tr style="background:${bgColor}">
                <td style="text-align:center">${index + 1}</td>
                <td>
                    <code style="background:#dbeafe;color:#1e40af;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:600">
                        ${k.no_registrasi || '-'}
                    </code>
                </td>
                <td>
                    <strong>${k.nama_usaha || '-'}</strong><br>
                    <small style="color:#6b7280">${k.nama_pemilik || '-'}</small>
                </td>
                <td>${k.jenis_usaha || '-'}</td>
                <td>
                    <span style="background:#764ba2;color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${k.distrik || '-'}
                    </span>
                </td>
                <td style="text-align:center">
                    <span style="background:${kategoriColor};color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${k.kategori ? k.kategori.toUpperCase() : '-'}
                    </span>
                </td>
                <td style="text-align:center">
                    <span style="background:${statusVerifikasiColor};color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${statusVerifikasiBadge.toUpperCase()}
                    </span>
                </td>
                <td style="text-align:center">
                    <span style="background:${statusUsahaColor};color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${statusUsahaBadge.toUpperCase()}
                    </span>
                </td>
                <td style="text-align:center">${createdDate}</td>
            </tr>
        `;
    });
    
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Data Koperasi - Kabupaten Tolikara</title>
            <style>
                @media print {
                    @page {
                        size: A4 landscape;
                        margin: 15mm;
                    }
                    body {
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .no-print {
                        display: none !important;
                    }
                }
                
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body {
                    font-family: 'Arial', sans-serif;
                    font-size: 11px;
                    line-height: 1.4;
                    color: #333;
                    padding: 15px;
                }
                
                .header {
                    border-bottom: 3px solid #1a3a6e;
                    padding-bottom: 12px;
                    margin-bottom: 20px;
                    display: flex;
                    align-items: center;
                    gap: 15px;
                }
                
                .header-logo {
                    flex-shrink: 0;
                    width: 80px;
                    height: 80px;
                }
                
                .header-logo img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }
                
                .header-text {
                    flex: 1;
                    text-align: center;
                }
                
                .header-text h1 {
                    color: #1a3a6e;
                    font-size: 18px;
                    margin-bottom: 4px;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                
                .header-text h2 {
                    color: #1a3a6e;
                    font-size: 14px;
                    margin-bottom: 6px;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                
                .header-text p {
                    color: #666;
                    font-size: 10px;
                    margin: 2px 0;
                }
                
                .header-logo-right {
                    flex-shrink: 0;
                    width: 80px;
                    height: 80px;
                }
                
                .header-logo-right img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }
                
                .title {
                    text-align: center;
                    margin: 15px 0;
                    padding: 10px;
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    color: white;
                    border-radius: 6px;
                }
                
                .title h3 {
                    font-size: 14px;
                    font-weight: bold;
                    margin: 0;
                }
                
                .info-section {
                    margin-bottom: 15px;
                    padding: 10px;
                    background: #f8f9fa;
                    border-radius: 6px;
                    border-left: 4px solid #1a3a6e;
                }
                
                .info-section p {
                    margin: 3px 0;
                    font-size: 10px;
                }
                
                .stats-grid {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 10px;
                    margin-bottom: 15px;
                }
                
                .stat-box {
                    padding: 10px;
                    border-radius: 6px;
                    text-align: center;
                    color: white;
                }
                
                .stat-box h4 {
                    font-size: 20px;
                    margin-bottom: 3px;
                }
                
                .stat-box p {
                    font-size: 10px;
                    margin: 0;
                }
                
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 15px;
                    font-size: 10px;
                }
                
                table thead {
                    background: #1a3a6e;
                    color: white;
                }
                
                table th {
                    padding: 8px 5px;
                    text-align: left;
                    font-weight: bold;
                    border: 1px solid #1a3a6e;
                }
                
                table td {
                    padding: 6px 5px;
                    border: 1px solid #dee2e6;
                }
                
                .footer {
                    margin-top: 20px;
                    padding-top: 10px;
                    border-top: 2px solid #e5e7eb;
                    text-align: center;
                    color: #6b7280;
                    font-size: 9px;
                }
                
                .print-button {
                    position: fixed;
                    top: 15px;
                    right: 15px;
                    padding: 10px 20px;
                    background: #3b82f6;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    cursor: pointer;
                    font-size: 13px;
                    font-weight: bold;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    z-index: 1000;
                }
                
                .print-button:hover {
                    background: #2563eb;
                }
            </style>
        </head>
        <body>
            <button class="print-button no-print" onclick="window.print()">
                🖨️ Print Dokumen
            </button>
            
            <div class="header">
                <div class="header-logo">
                    <img src="{{ asset('images/logo-tolikara.png') }}" alt="Logo Tolikara" onerror="this.style.display='none'">
                </div>
                <div class="header-text">
                    <h1>PEMERINTAH KABUPATEN TOLIKARA</h1>
                    <h2>DINAS PERINDUSTRIAN, PERDAGANGAN, KOPERASI DAN UMKM</h2>
                    <p>Jl. Raya Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
                    <p>Email: disperindagkop@tolikara.go.id | Telp: (0969) 12345</p>
                </div>
                <div class="header-logo-right">
                    <img src="{{ asset('images/logo-koperasi.png') }}" alt="Logo Koperasi" onerror="this.style.display='none'">
                </div>
            </div>
            
            <div class="title">
                <h3>DATA KOPERASI KABUPATEN TOLIKARA</h3>
            </div>
            
            <div class="info-section">
                <p><strong>Filter:</strong> ${filterText}</p>
                <p><strong>Tanggal Cetak:</strong> ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-box" style="background:#3b82f6">
                    <h4>${statsData.total}</h4>
                    <p>Total Koperasi</p>
                </div>
                <div class="stat-box" style="background:#f59e0b">
                    <h4>${statsData.pending}</h4>
                    <p>Menunggu Verifikasi</p>
                </div>
                <div class="stat-box" style="background:#10b981">
                    <h4>${statsData.diverifikasi}</h4>
                    <p>Terverifikasi</p>
                </div>
                <div class="stat-box" style="background:#14b8a6">
                    <h4>${statsData.aktif}</h4>
                    <p>Koperasi Aktif</p>
                </div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width:4%;text-align:center">No</th>
                        <th style="width:11%">No. Registrasi</th>
                        <th style="width:20%">Nama Usaha / Pemilik</th>
                        <th style="width:15%">Jenis Usaha</th>
                        <th style="width:10%;text-align:center">Distrik</th>
                        <th style="width:10%;text-align:center">Kategori</th>
                        <th style="width:12%;text-align:center">Status Verifikasi</th>
                        <th style="width:10%;text-align:center">Status Usaha</th>
                        <th style="width:8%;text-align:center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableRows}
                </tbody>
            </table>
            
            <div class="footer">
                <p><strong>Dokumen ini dicetak pada:</strong> ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })} WIT</p>
                <p style="margin-top: 5px;">© ${new Date().getFullYear()} DISPERINDAGKOP Kabupaten Tolikara - Semua Hak Dilindungi</p>
                <p style="margin-top: 3px;"><em>Total: ${allKoperasiData.length} Koperasi</em></p>
            </div>
        </body>
        </html>
    `;
    
    printWindow.document.write(printContent);
    printWindow.document.close();
}

$(document).ready(function() {
    // Konfirmasi hapus
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data koperasi akan dihapus permanen!",
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
