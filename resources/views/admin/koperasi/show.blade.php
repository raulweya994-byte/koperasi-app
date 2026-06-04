@extends('layouts.app')

@section('title', 'Detail Koperasi - ' . $koperasi->nama_usaha)

@push('styles')
<style>
    /* Card Modern */
    .card-modern {
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .card-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 25px;
        border: none;
    }
    
    .card-header-modern h5 {
        margin: 0;
        font-weight: 700;
        font-size: 16px;
    }
    
    .card-body-modern {
        padding: 25px;
    }
    
    /* Info Card */
    .info-card {
        text-align: center;
        padding: 30px 25px;
    }
    
    .info-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
    }
    
    /* List Group Modern */
    .list-group-modern .list-group-item {
        border: none;
        border-bottom: 1px solid #f0f0f0;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .list-group-modern .list-group-item:last-child {
        border-bottom: none;
    }
    
    /* Badge Modern */
    .badge-modern {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Button Modern */
    .btn-modern {
        border-radius: 10px;
        font-weight: 600;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }
    
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* Table Modern */
    .table-modern {
        margin: 0;
    }
    
    .table-modern th {
        font-weight: 600;
        color: #6c757d;
        font-size: 13px;
        padding: 12px 15px;
    }
    
    .table-modern td {
        padding: 12px 15px;
        font-size: 13px;
    }
    
    /* Verifikasi Box */
    .verifikasi-box {
        background: linear-gradient(135deg, #fff9e6 0%, #ffffff 100%);
        border-left: 4px solid #f59e0b;
        border-radius: 12px;
        padding: 25px;
    }
    
    .custom-radio-modern {
        padding: 15px 20px;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }
    
    .custom-radio-modern:hover {
        border-color: #667eea;
        background: #f8f9fa;
    }
    
    .custom-radio-modern input:checked ~ label {
        font-weight: 700;
    }
    
    /* Print Styles */
    @media print {
        /* Hide elements that shouldn't be printed */
        .btn, .btn-modern, button,
        .verifikasi-box,
        .card-header-modern,
        form {
            display: none !important;
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
        
        .print-header img {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
        
        /* Add section headers */
        .card-modern:nth-of-type(2) .card-body-modern::before {
            content: "I. DATA PEMILIK USAHA";
            display: block;
            font-weight: 700;
            font-size: 14px;
            color: #1a3a6e;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #1a3a6e;
        }
        
        .card-modern:nth-of-type(3) .card-body-modern::before {
            content: "II. DATA USAHA";
            display: block;
            font-weight: 700;
            font-size: 14px;
            color: #1a3a6e;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #1a3a6e;
        }
        
        .card-modern:nth-of-type(4) .card-body-modern::before {
            content: "III. RIWAYAT BANTUAN";
            display: block;
            font-weight: 700;
            font-size: 14px;
            color: #1a3a6e;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #1a3a6e;
        }
    }
    .print-header {
        display: none;
    }
    
    @media print {
        .print-header {
            display: block !important;
            page-break-after: avoid;
        }
        
        .print-header img {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
    }
        
        /* Card styling for print */
        .card-modern {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            page-break-inside: avoid;
            margin-bottom: 15px;
        }
        
        .card-modern:first-of-type {
            margin-top: 20px;
        }
        
        .card-body-modern {
            padding: 15px !important;
        }
        
        /* Header */
        h4, h5 {
            page-break-after: avoid;
            color: #000 !important;
        }
        
        h4.font-weight-bold {
            text-align: center;
            font-size: 16px;
            color: #1a3a6e !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        /* Info icon */
        .info-icon {
            background: #667eea !important;
            print-color-adjust: exact;
        }
        
        /* Tables - neat formatting */
        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
        }
        
        table tr {
            border-bottom: 1px solid #e0e0e0;
        }
        
        table td {
            padding: 10px 5px !important;
            font-size: 12px;
            line-height: 1.5;
        }
        
        .text-muted {
            color: #666 !important;
            font-weight: bold;
        }
        
        .font-weight-600, .font-weight-bold {
            color: #000 !important;
        }
        
        /* Badges */
        .badge, .badge-modern {
            border: 1px solid #000;
            padding: 3px 8px;
            font-size: 10px;
            background: white !important;
            color: #000 !important;
        }
        
        /* Icons */
        .fas, .far {
            color: #666 !important;
        }
        
        /* Layout adjustments */
        .row {
            page-break-inside: avoid;
        }
        
        .col-lg-4, .col-lg-8 {
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Section spacing */
        .card-modern + .card-modern {
            margin-top: 20px;
        }
        
        /* Add section titles */
        .card-modern::before {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
            page-break-after: avoid;
        }
        
        /* Remove gradients and backgrounds */
        .card-header-modern,
        .verifikasi-box,
        .info-card {
            background: white !important;
        }
        
        /* Ensure proper spacing */
        .container-fluid {
            padding: 0 !important;
        }
        
        /* Riwayat Bantuan table */
        .table-responsive {
            overflow: visible !important;
        }
        
        .table-hover tbody tr {
            border-bottom: 1px solid #ddd !important;
        }
        
        thead {
            background: #f0f0f0 !important;
            font-weight: bold;
        }
        
        tfoot {
            background: #f0f0f0 !important;
            font-weight: bold;
            border-top: 2px solid #000;
        }
    }
</style>
@endpush

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
            DOKUMEN DATA KOPERASI
        </h3>
        <div style="font-size: 10px; color: #666; line-height: 1.6;">
            No. Dokumen: DOK/KOP{{ str_replace('KOP', '', $koperasi->no_registrasi) }}/{{ date('Y') }}<br>
            Tanggal Cetak: {{ date('d F Y, H:i') }} WIT
        </div>
    </div>
    <div style="border-bottom: 2px solid #1a3a6e; margin-bottom: 20px;"></div>
</div>

<div class="container-fluid">
    {{-- Header dengan Tombol Kembali --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card-modern">
                <div class="card-body-modern" style="padding: 20px 25px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 font-weight-bold" style="color:#1a3a6e">
                                <i class="fas fa-store mr-2"></i>{{ $koperasi->nama_usaha }}
                            </h4>
                            <p class="mb-0 text-muted">
                                <i class="fas fa-id-card mr-2"></i>{{ $koperasi->no_registrasi }}
                            </p>
                        </div>
                        <div>
                            <button onclick="window.print()" class="btn btn-success btn-modern mr-2">
                                <i class="fas fa-print mr-2"></i>Print
                            </button>
                            <a href="javascript:history.back()" class="btn btn-secondary btn-modern">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    {{-- Kolom Kiri --}}
    <div class="col-lg-4">
        {{-- Status & Info Singkat --}}
        <div class="card-modern">
            <div class="card-header-modern" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5><i class="fas fa-info-circle mr-2"></i>Informasi Status</h5>
            </div>
            <div class="card-body-modern">
                <div class="text-center mb-4">
                    <div class="info-icon" style="width: 100px; height: 100px; margin: 0 auto 20px; font-size: 48px;">
                        <i class="fas fa-store"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">{{ $koperasi->nama_usaha }}</h5>
                    <p class="text-muted mb-3">{{ $koperasi->jenis_usaha }}</p>
                    <div class="mb-3">
                        <span class="badge badge-modern badge-{{ $koperasi->kategori === 'mikro' ? 'primary' : ($koperasi->kategori === 'kecil' ? 'success' : 'warning') }}" style="font-size: 13px; padding: 8px 16px;">
                            {{ strtoupper($koperasi->kategori) }}
                        </span>
                    </div>
                    <div>
                        {!! $koperasi->status_verifikasi_label !!}
                        {!! $koperasi->status_usaha_label !!}
                    </div>
                </div>
                
                <table class="table table-borderless mb-0" style="font-size: 13px;">
                    <tr>
                        <td class="text-muted" style="padding: 10px 0;"><i class="fas fa-calendar-plus mr-2"></i>Terdaftar</td>
                        <td class="text-right font-weight-600" style="padding: 10px 0;">{{ $koperasi->created_at->format('d M Y') }}</td>
                    </tr>
                    @if($koperasi->verified_at)
                    <tr>
                        <td class="text-muted" style="padding: 10px 0;"><i class="fas fa-check-circle mr-2"></i>Diverifikasi</td>
                        <td class="text-right font-weight-600" style="padding: 10px 0;">{{ $koperasi->verified_at->format('d M Y') }}</td>
                    </tr>
                    @endif
                    @if($koperasi->verifiedBy)
                    <tr>
                        <td class="text-muted" style="padding: 10px 0;"><i class="fas fa-user-check mr-2"></i>Diverifikasi Oleh</td>
                        <td class="text-right font-weight-600" style="padding: 10px 0;">{{ $koperasi->verifiedBy->name }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan --}}
    <div class="col-lg-8">
        {{-- Verifikasi --}}
        @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
        <div class="card-modern">
            <div class="card-header-modern" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <h5><i class="fas fa-clipboard-check mr-2"></i>Verifikasi Koperasi</h5>
            </div>
            <div class="verifikasi-box">
                <form method="POST" action="{{ route('admin.koperasi.verifikasi', $koperasi) }}">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold mb-3" style="font-size: 14px;">
                            <i class="fas fa-check-double mr-2"></i>Keputusan Verifikasi
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-radio-modern">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="verif_setuju" name="status" value="diverifikasi" class="custom-control-input" required>
                                        <label class="custom-control-label text-success font-weight-bold" for="verif_setuju">
                                            <i class="fas fa-check-circle mr-2"></i>Setujui & Verifikasi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-radio-modern">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="verif_tolak" name="status" value="ditolak" class="custom-control-input" required>
                                        <label class="custom-control-label text-danger font-weight-bold" for="verif_tolak">
                                            <i class="fas fa-times-circle mr-2"></i>Tolak
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" style="font-size: 14px;">
                            <i class="fas fa-comment-alt mr-2"></i>Catatan (opsional)
                        </label>
                        <textarea name="catatan" class="form-control" rows="3"
                                  placeholder="Catatan verifikasi atau alasan penolakan..."
                                  style="border-radius: 10px; border: 1.5px solid #dee2e6;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-modern">
                        <i class="fas fa-paper-plane mr-2"></i>Simpan Keputusan
                    </button>
                </form>
            </div>
        </div>
        @endif

        {{-- Detail Pemilik --}}
        <div class="card-modern">
            <div class="card-header-modern" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h5><i class="fas fa-user mr-2"></i>Data Pemilik Usaha</h5>
            </div>
            <div class="card-body-modern">
                <table class="table table-borderless mb-0" style="font-size: 14px;">
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0; width: 40%;">
                            <i class="fas fa-user mr-2" style="color: #10b981;"></i>Nama Pemilik
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->nama_pemilik }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-id-card mr-2" style="color: #10b981;"></i>No. KTP
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->no_ktp }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-phone mr-2" style="color: #10b981;"></i>Telepon
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->no_telp ?? '-' }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-envelope mr-2" style="color: #10b981;"></i>Email
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->email ?? '-' }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-map-marker-alt mr-2" style="color: #10b981;"></i>Alamat
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->alamat }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-map mr-2" style="color: #10b981;"></i>Distrik
                        </td>
                        <td style="padding: 15px 0;">
                            <span class="badge badge-info" style="font-size: 12px; padding: 6px 12px;">{{ $koperasi->distrik }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-building mr-2" style="color: #10b981;"></i>Kelurahan
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->kelurahan }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Detail Usaha --}}
        <div class="card-modern">
            <div class="card-header-modern" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                <h5><i class="fas fa-chart-line mr-2"></i>Data Usaha</h5>
            </div>
            <div class="card-body-modern">
                <table class="table table-borderless mb-0" style="font-size: 14px;">
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0; width: 40%;">
                            <i class="fas fa-store mr-2" style="color: #3b82f6;"></i>Nama Usaha
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->nama_usaha }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-briefcase mr-2" style="color: #3b82f6;"></i>Jenis Usaha
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->jenis_usaha }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-tags mr-2" style="color: #3b82f6;"></i>Kategori
                        </td>
                        <td style="padding: 15px 0;">
                            <span class="badge badge-{{ $koperasi->kategori === 'mikro' ? 'primary' : ($koperasi->kategori === 'kecil' ? 'success' : 'warning') }}" style="font-size: 12px; padding: 6px 12px;">
                                {{ ucfirst($koperasi->kategori) }}
                            </span>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-money-bill-wave mr-2" style="color: #3b82f6;"></i>Modal Usaha
                        </td>
                        <td class="font-weight-bold" style="padding: 15px 0; color: #10b981;">
                            Rp {{ number_format($koperasi->modal_usaha, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-chart-line mr-2" style="color: #3b82f6;"></i>Omset/Bulan
                        </td>
                        <td class="font-weight-bold" style="padding: 15px 0; color: #3b82f6;">
                            Rp {{ number_format($koperasi->omset_per_bulan, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="padding: 15px 0;">
                            <i class="fas fa-users mr-2" style="color: #3b82f6;"></i>Jumlah Karyawan
                        </td>
                        <td class="font-weight-600" style="padding: 15px 0;">{{ $koperasi->jumlah_karyawan }} orang</td>
                    </tr>
                </table>
                
                @if($koperasi->catatan_verifikasi)
                <div class="alert alert-{{ $koperasi->status_verifikasi === 'ditolak' ? 'danger' : 'info' }} mt-3" style="border-radius: 10px; border-left: 4px solid {{ $koperasi->status_verifikasi === 'ditolak' ? '#dc3545' : '#0dcaf0' }};">
                    <strong><i class="fas fa-info-circle mr-2"></i>Catatan Verifikasi:</strong><br>
                    {{ $koperasi->catatan_verifikasi }}
                </div>
                @endif
            </div>
        </div>

        {{-- Riwayat Bantuan --}}
        <div class="card-modern">
            <div class="card-header-modern" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <h5>
                    <i class="fas fa-history mr-2"></i>Riwayat Bantuan
                    <span class="badge badge-light ml-2" style="font-size: 12px;">{{ $koperasi->penerimaBantuan->count() }}</span>
                </h5>
            </div>
            <div class="card-body-modern p-0">
                @if($koperasi->penerimaBantuan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size: 13px;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 15px; border: none;">No</th>
                                <th style="border: none;">Program Bantuan</th>
                                <th style="border: none;">Tahun</th>
                                <th style="border: none;">Jumlah Bantuan</th>
                                <th style="border: none;">Status</th>
                                <th style="border: none;">Tanggal Terima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($koperasi->penerimaBantuan as $index => $pb)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 15px;">{{ $index + 1 }}</td>
                                <td>
                                    <div class="font-weight-600" style="color: #1f2937;">{{ $pb->bantuan->nama_bantuan }}</div>
                                    <small class="text-muted">{{ $pb->bantuan->jenis_bantuan }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-secondary" style="font-size: 11px; padding: 5px 10px;">
                                        {{ $pb->bantuan->tahun }}
                                    </span>
                                </td>
                                <td>
                                    @if($pb->jumlah_bantuan > 0)
                                        <span class="font-weight-bold" style="color: #10b981;">
                                            Rp {{ number_format($pb->jumlah_bantuan, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pb->status === 'diterima')
                                        <span class="badge badge-success" style="font-size: 11px; padding: 5px 10px;">
                                            <i class="fas fa-check-circle mr-1"></i>Diterima
                                        </span>
                                    @elseif($pb->status === 'divalidasi')
                                        <span class="badge badge-info" style="font-size: 11px; padding: 5px 10px;">
                                            <i class="fas fa-clock mr-1"></i>Divalidasi
                                        </span>
                                    @elseif($pb->status === 'ditolak')
                                        <span class="badge badge-danger" style="font-size: 11px; padding: 5px 10px;">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                    @else
                                        <span class="badge badge-warning" style="font-size: 11px; padding: 5px 10px;">
                                            <i class="fas fa-hourglass-half mr-1"></i>{{ ucfirst($pb->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $pb->tanggal_penerimaan ? $pb->tanggal_penerimaan->format('d M Y') : '-' }}
                                    </small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="background: #f8f9fa;">
                            <tr>
                                <td colspan="3" style="padding: 15px; border: none;">
                                    <strong style="color: #1a3a6e;">Total Bantuan Diterima</strong>
                                </td>
                                <td colspan="3" style="padding: 15px; border: none;">
                                    <strong style="color: #10b981; font-size: 16px;">
                                        Rp {{ number_format($koperasi->penerimaBantuan->where('status', 'diterima')->sum('jumlah_bantuan'), 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                    <h6 class="text-muted">Belum Ada Riwayat Bantuan</h6>
                    <p class="text-muted mb-0">Koperasi ini belum pernah menerima bantuan</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection