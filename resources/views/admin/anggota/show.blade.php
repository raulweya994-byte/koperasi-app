@extends('layouts.app')
@section('title', 'Detail Anggota - ' . $anggota->nama)

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
                            <a href="{{ session('previous_url', route('admin.anggota.index')) }}" class="btn btn-light btn-sm">
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
                        <img src="{{ $anggota->foto_url }}" 
                             class="rounded" 
                             style="width: 200px; height: 250px; object-fit: cover; object-position: center; border: 3px solid #e0e0e0;">
                    </div>
                    <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">{{ $anggota->nama }}</h5>
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
                    @elseif($anggota->status == 'Ditolak')
                    <span class="badge badge-danger px-3 py-2" style="font-size:0.9rem">
                        <i class="fas fa-times-circle mr-1"></i>Ditolak
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
                                        {{ $anggota->alamat_lengkap ?? '-' }}
                                        <br>
                                        <small class="text-muted">
                                            Desa: {{ $anggota->desa ?? '-' }}, 
                                            Distrik: {{ $anggota->distrik ?? '-' }}, 
                                            Kab: {{ $anggota->kabupaten ?? 'Tolikara' }}
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
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Modal Usaha</label>
                                    <div class="font-weight-600 text-success">
                                        <i class="fas fa-money-bill-wave mr-1"></i>
                                        Rp {{ number_format($anggota->modal_usaha ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Omzet per Bulan</label>
                                    <div class="font-weight-600 text-info">
                                        <i class="fas fa-chart-line mr-1"></i>
                                        Rp {{ number_format($anggota->omzet_per_bulan ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Lama Berdiri Usaha</label>
                                    <div class="font-weight-600">{{ $anggota->lama_berdiri_usaha ?? '-' }} tahun</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Jumlah Karyawan</label>
                                    <div class="font-weight-600">{{ $anggota->jumlah_karyawan ?? '-' }} orang</div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Alamat Tempat Usaha</label>
                                    <div class="font-weight-600">{{ $anggota->alamat_tempat_usaha ?? '-' }}</div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Keterangan Usaha</label>
                                    <div class="font-weight-600">{{ $anggota->keterangan_usaha ?? '-' }}</div>
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
                                        Rp {{ number_format($anggota->total_simpanan ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Nama Bank</label>
                                    <div class="font-weight-600">{{ $anggota->nama_bank ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Nomor Rekening</label>
                                    <div class="font-weight-600">{{ $anggota->nomor_rekening ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">Nama Pemilik Rekening</label>
                                    <div class="font-weight-600">{{ $anggota->nama_pemilik_rekening ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.85rem">NPWP</label>
                                    <div class="font-weight-600">{{ $anggota->npwp ?? '-' }}</div>
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
                        @if($anggota->tanggal_verifikasi)
                        <div class="col-md-4 mb-2">
                            <small class="text-muted d-block">Tanggal Verifikasi</small>
                            <div class="font-weight-600">
                                <i class="far fa-calendar-check mr-1 text-success"></i>
                                {{ \Carbon\Carbon::parse($anggota->tanggal_verifikasi)->format('d M Y, H:i') }}
                            </div>
                        </div>
                        @endif
                        @if($anggota->catatan_admin)
                        <div class="col-md-12 mt-2">
                            <div class="alert alert-info mb-0" style="border-radius:8px">
                                <strong><i class="fas fa-comment mr-1"></i>Catatan Admin:</strong>
                                <br>{{ $anggota->catatan_admin }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Verifikasi (Hanya untuk Status Pending) --}}
    @if($anggota->status == 'Pending')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius:12px;background:linear-gradient(135deg,#fef3c7,#fde68a)">
                <div class="card-body text-center py-4">
                    <h5 class="font-weight-bold mb-3" style="color:#92400e">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Verifikasi Pendaftaran Anggota
                    </h5>
                    <p class="mb-4" style="color:#78350f">
                        Setelah memeriksa semua data di atas, silakan pilih tindakan:
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <button type="button" 
                                    class="btn btn-success btn-lg w-100" 
                                    style="border-radius:10px;font-weight:700;box-shadow:0 4px 12px rgba(16,185,129,0.3)"
                                    onclick="terimaAnggota({{ $anggota->id }}, '{{ $anggota->nama }}')">
                                <i class="fas fa-check-circle mr-2"></i>TERIMA
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" 
                                    class="btn btn-danger btn-lg w-100" 
                                    style="border-radius:10px;font-weight:700;box-shadow:0 4px 12px rgba(239,68,68,0.3)"
                                    onclick="tolakAnggota({{ $anggota->id }}, '{{ $anggota->nama }}')">
                                <i class="fas fa-times-circle mr-2"></i>TOLAK
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.anggota.verifikasi') }}" 
                               class="btn btn-secondary btn-lg w-100" 
                               style="border-radius:10px;font-weight:700">
                                <i class="fas fa-arrow-left mr-2"></i>KEMBALI
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Terima --}}
    <div class="modal fade" id="modalTerima" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 12px;">
                <form id="formTerima" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-check-circle me-2"></i>Terima Pendaftaran</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin <strong>MENERIMA</strong> pendaftaran anggota:</p>
                        <div class="alert alert-success">
                            <h5 id="namaAnggotaTerima" class="mb-0"></h5>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>
                        <input type="hidden" name="status" value="Aktif">
                        <div class="alert alert-info">
                            <i class="fas fa-bell me-2"></i>
                            <small>Notifikasi otomatis akan dikirim ke anggota bahwa pendaftaran mereka <strong>LULUS</strong>.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-1"></i> Ya, Terima
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div class="modal fade" id="modalTolak" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 12px;">
                <form id="formTolak" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="fas fa-times-circle me-2"></i>Tolak Pendaftaran</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin <strong>MENOLAK</strong> pendaftaran anggota:</p>
                        <div class="alert alert-danger">
                            <h5 id="namaAnggotaTolak" class="mb-0"></h5>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Jelaskan alasan penolakan..." required></textarea>
                            <small class="text-muted">Alasan ini akan dikirim ke anggota melalui notifikasi.</small>
                        </div>
                        <input type="hidden" name="status" value="Ditolak">
                        <div class="alert alert-warning">
                            <i class="fas fa-bell me-2"></i>
                            <small>Notifikasi otomatis akan dikirim ke anggota bahwa pendaftaran mereka <strong>TIDAK LULUS</strong> dengan alasan yang Anda berikan. Anggota dapat mengakses menu <strong>"Lengkapi Data"</strong> untuk memperbaiki data dan submit ulang.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i> Ya, Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function terimaAnggota(id, nama) {
        document.getElementById('namaAnggotaTerima').textContent = nama;
        document.getElementById('formTerima').action = '/admin/anggota/' + id + '/status';
        new bootstrap.Modal(document.getElementById('modalTerima')).show();
    }

    function tolakAnggota(id, nama) {
        document.getElementById('namaAnggotaTolak').textContent = nama;
        document.getElementById('formTolak').action = '/admin/anggota/' + id + '/status';
        new bootstrap.Modal(document.getElementById('modalTolak')).show();
    }
    </script>
    @endif
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
        
        .print-header img {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
        
        /* Hide screen elements */
        .page-header-card,
        .nav-tabs,
        button,
        .modal,
        .alert,
        .btn {
            display: none !important;
        }
        
        /* Show all tab content */
        .tab-pane {
            display: block !important;
            opacity: 1 !important;
            page-break-inside: avoid;
        }
        
        /* Style data sections */
        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            page-break-inside: avoid;
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 15px !important;
        }
        
        /* Add section headers */
        #pribadi::before {
            content: "I. DATA PRIBADI";
            display: block;
            font-weight: 700;
            font-size: 14px;
            color: #1a3a6e;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #1a3a6e;
        }
        
        #usaha::before {
            content: "II. DATA USAHA";
            display: block;
            font-weight: 700;
            font-size: 14px;
            color: #1a3a6e;
            margin: 20px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #1a3a6e;
        }
        
        #keuangan::before {
            content: "III. DATA KEUANGAN";
            display: block;
            font-weight: 700;
            font-size: 14px;
            color: #1a3a6e;
            margin: 20px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #1a3a6e;
        }
        
        /* Data rows */
        .col-md-6, .col-md-12, .col-12 {
            margin-bottom: 12px;
        }
        
        label {
            font-weight: 600;
            font-size: 11px;
            color: #666;
            margin-bottom: 3px;
        }
        
        .font-weight-600, .font-weight-bold {
            font-size: 12px;
            color: #000;
            line-height: 1.5;
        }
        
        /* Icons */
        .fas, .far {
            color: #666 !important;
            font-size: 10px;
        }
        
        /* Remove backgrounds */
        .card-body {
            background: white !important;
        }
        
        /* Container */
        .container-fluid {
            padding: 0 !important;
        }
        
        /* Row spacing */
        .row {
            page-break-inside: avoid;
        }
    }
</style>

@endsection
