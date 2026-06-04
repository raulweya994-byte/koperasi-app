@extends('layouts.app')
@section('title', 'Detail Anggota - ' . $anggota->nama_lengkap)

@section('content')
{{-- Print Header - Only visible when printing --}}
<div class="print-header">
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
        <tr>
            <td style="width: 100%; text-align: center; padding: 15px 0;">
                <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 85px; height: auto; display: inline-block; margin-bottom: 12px;">
                <div style="font-size: 15px; font-weight: 700; color: #1a3a6e; margin-bottom: 3px; letter-spacing: 0.8px; line-height: 1.3;">
                    PEMERINTAH KABUPATEN TOLIKARA
                </div>
                <div style="font-size: 14px; font-weight: 700; color: #3b82f6; margin-bottom: 8px; letter-spacing: 0.5px; line-height: 1.2;">
                    DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI
                </div>
                <div style="font-size: 10px; color: #666; line-height: 1.6;">
                    Jl. Raya Karubaga, Tolikara, Papua Pegunungan<br>
                    Email: disperindagkop@tolikara.go.id | Telp: (0969) 123456
                </div>
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 3px solid #1a3a6e; padding-top: 8px;"></td>
        </tr>
    </table>
    
    <div style="text-align: center; margin: 20px 0 15px 0;">
        <h3 style="font-size: 17px; font-weight: 700; color: #1a3a6e; text-transform: uppercase; letter-spacing: 2px; margin: 0 0 10px 0;">
            DOKUMEN DATA ANGGOTA KOPERASI
        </h3>
        <div style="font-size: 10px; color: #666; line-height: 1.6;">
            No. Dokumen: DOK/AGT{{ str_replace('AGT', '', $anggota->no_anggota) }}/{{ date('Y') }}<br>
            Tanggal Cetak: {{ date('d F Y, H:i') }} WIT
        </div>
    </div>
    <div style="border-bottom: 2px solid #1a3a6e; margin-bottom: 20px;"></div>
</div>

<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div class="page-header-icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Detail Anggota</h3>
                                <p class="page-header-subtitle">Informasi lengkap data anggota koperasi</p>
                            </div>
                        </div>
                        <div>
                            <button onclick="window.print()" class="btn btn-success btn-sm me-2">
                                <i class="fas fa-print me-1"></i> Print
                            </button>
                            <a href="{{ route('pimpinan.anggota-koperasi.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Header dengan Foto --}}
    <div class="row mb-4">
        <div class="col-md-4 text-center">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-4">
                    <div class="mb-3" style="display: flex; justify-content: center; align-items: center;">
                        @if($anggota->foto)
                            <img src="{{ asset('storage/' . $anggota->foto) }}" 
                                 class="rounded" 
                                 style="width: 200px; height: 250px; object-fit: cover; object-position: center; border: 3px solid #e0e0e0;">
                        @else
                            <div class="rounded d-flex align-items-center justify-content-center" 
                                 style="width: 200px; height: 250px; background: #e0e0e0; border: 3px solid #ccc;">
                                <i class="fas fa-user" style="font-size: 80px; color: #999;"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">{{ $anggota->nama_lengkap }}</h5>
                    <span class="badge badge-primary px-3 py-2 mb-2" style="font-size:0.9rem">
                        {{ $anggota->no_anggota }}
                    </span>
                    <br>
                    @if($anggota->status == 'Pending')
                    <span class="badge badge-warning px-3 py-2" style="font-size:0.9rem">
                        <i class="fas fa-clock mr-1"></i>Menunggu Verifikasi
                    </span>
                    @elseif($anggota->status == 'Aktif')
                    <span class="badge badge-success px-3 py-2" style="font-size:0.9rem">
                        <i class="fas fa-check-circle mr-1"></i>Aktif
                    </span>
                    @elseif($anggota->status == 'Nonaktif')
                    <span class="badge badge-secondary px-3 py-2" style="font-size:0.9rem">
                        <i class="fas fa-ban mr-1"></i>Nonaktif
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            {{-- Tabs --}}
            <ul class="nav nav-tabs" id="detailTabs" role="tablist" style="border-bottom:2px solid #e0e0e0">
                <li class="nav-item">
                    <a class="nav-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab">
                        <i class="fas fa-user mr-2"></i>Data Pribadi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="usaha-tab" data-toggle="tab" href="#usaha" role="tab">
                        <i class="fas fa-store mr-2"></i>Data Usaha
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="keuangan-tab" data-toggle="tab" href="#keuangan" role="tab">
                        <i class="fas fa-money-bill-wave mr-2"></i>Keuangan
                    </a>
                </li>
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-3" id="detailTabsContent">
                {{-- Data Pribadi --}}
                <div class="tab-pane fade show active" id="pribadi" role="tabpanel">
                    <div class="card border-0 shadow-sm" style="border-radius:12px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">NIK</label>
                                    <div class="font-weight-600">{{ $anggota->nik ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Tempat, Tgl Lahir</label>
                                    <div class="font-weight-600">
                                        {{ $anggota->tempat_lahir ?? '-' }}, 
                                        {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') : '-' }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Jenis Kelamin</label>
                                    <div class="font-weight-600">{{ $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Status Kawin</label>
                                    <div class="font-weight-600">{{ $anggota->status_kawin ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Pendidikan</label>
                                    <div class="font-weight-600">{{ $anggota->pendidikan ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Agama</label>
                                    <div class="font-weight-600">{{ $anggota->agama ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">No. HP</label>
                                    <div class="font-weight-600">
                                        <i class="fas fa-phone text-success mr-1"></i>{{ $anggota->no_hp ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Email</label>
                                    <div class="font-weight-600">
                                        <i class="fas fa-envelope text-primary mr-1"></i>{{ $anggota->email ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Alamat Lengkap</label>
                                    <div class="font-weight-600">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ $anggota->alamat ?? '-' }}
                                        <br>
                                        <small class="text-muted">
                                            Kampung: {{ $anggota->kampung ?? '-' }}, 
                                            Distrik: {{ $anggota->distrik ?? '-' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Usaha --}}
                <div class="tab-pane fade" id="usaha" role="tabpanel">
                    <div class="card border-0 shadow-sm" style="border-radius:12px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Nama Usaha</label>
                                    <div class="font-weight-600">{{ $anggota->nama_usaha ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Bidang Usaha</label>
                                    <div class="font-weight-600">{{ $anggota->bidang_usaha ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Koperasi</label>
                                    <div class="font-weight-600">
                                        <i class="fas fa-building text-info mr-1"></i>
                                        {{ $anggota->koperasi->nama_usaha ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Tanggal Bergabung</label>
                                    <div class="font-weight-600">
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $anggota->tanggal_bergabung ? \Carbon\Carbon::parse($anggota->tanggal_bergabung)->format('d M Y') : '-' }}
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Alamat Tempat Usaha</label>
                                    <div class="font-weight-600">{{ $anggota->alamat_usaha ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keuangan --}}
                <div class="tab-pane fade" id="keuangan" role="tabpanel">
                    <div class="card border-0 shadow-sm" style="border-radius:12px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Simpanan Pokok</label>
                                    <div class="font-weight-600 text-primary">
                                        <i class="fas fa-piggy-bank mr-1"></i>
                                        Rp {{ number_format($anggota->simpanan_pokok ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Simpanan Wajib</label>
                                    <div class="font-weight-600 text-primary">
                                        <i class="fas fa-piggy-bank mr-1"></i>
                                        Rp {{ number_format($anggota->simpanan_wajib ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Total Simpanan</label>
                                    <div class="font-weight-bold text-success" style="font-size:1.5rem">
                                        <i class="fas fa-wallet mr-2"></i>
                                        Rp {{ number_format(($anggota->simpanan_pokok ?? 0) + ($anggota->simpanan_wajib ?? 0), 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Nama Ahli Waris</label>
                                    <div class="font-weight-600">{{ $anggota->nama_ahli_waris ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Informasi Tambahan --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius:12px;background:#f8f9fa">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <small class="text-muted d-block">Tanggal Daftar</small>
                            <div class="font-weight-600">
                                <i class="far fa-calendar mr-1 text-primary"></i>
                                {{ $anggota->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <small class="text-muted d-block">Status</small>
                            <div class="font-weight-600">
                                @if($anggota->status == 'Aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @elseif($anggota->status == 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
    padding: 12px 20px;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    color: #1a3a6e;
    background: #f8f9fa;
}

.nav-tabs .nav-link.active {
    color: #1a3a6e;
    background: white;
    border-bottom: 3px solid #1a3a6e;
}

.tab-content {
    min-height: 300px;
}

/* Print Styles */
@media print {
    /* Hide elements that shouldn't be printed */
    .page-header-card .btn,
    .nav-tabs,
    button,
    .modal,
    .alert {
        display: none !important;
    }
    
    /* Show all tab content when printing */
    .tab-pane {
        display: block !important;
        opacity: 1 !important;
        page-break-inside: avoid;
    }
    
    /* Page setup */
    @page {
        margin: 1.5cm;
        size: A4 portrait;
    }
    
    body {
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
    }
    
    /* Show print header only when printing */
    .print-header {
        display: none;
    }
    
    @media print {
        .print-header {
            display: block !important;
            page-break-after: avoid;
        }
    }
}
</style>

@endsection
