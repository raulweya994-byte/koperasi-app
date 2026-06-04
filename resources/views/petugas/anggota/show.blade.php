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
    
    {{-- Print: Anggota Info Header --}}
    <div style="text-align: center; margin-bottom: 20px; padding: 15px; background: #f8f9fa; border: 2px solid #1a3a6e; border-radius: 8px;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 25%; text-align: center; vertical-align: top; padding: 10px;">
                    <img src="{{ $anggota->foto_url }}" style="width: 140px; height: 170px; object-fit: cover; border: 3px solid #1a3a6e; border-radius: 8px;">
                </td>
                <td style="width: 75%; text-align: left; vertical-align: top; padding: 10px 20px;">
                    <h2 style="margin: 0 0 8px 0; color: #1a3a6e; font-size: 18px; font-weight: 700;">{{ $anggota->nama }}</h2>
                    <table style="width: 100%; font-size: 11px; line-height: 1.8;">
                        <tr>
                            <td style="width: 35%; color: #666; font-weight: 600;">No. Anggota</td>
                            <td style="width: 5%;">:</td>
                            <td style="font-weight: 700; color: #1a3a6e;">{{ $anggota->no_anggota }}</td>
                        </tr>
                        <tr>
                            <td style="color: #666; font-weight: 600;">NIK</td>
                            <td>:</td>
                            <td style="font-weight: 600;">{{ $anggota->nik }}</td>
                        </tr>
                        <tr>
                            <td style="color: #666; font-weight: 600;">Tempat, Tgl Lahir</td>
                            <td>:</td>
                            <td style="font-weight: 600;">{{ $anggota->tempat_lahir }}, {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') : '-' }} ({{ $anggota->umur }} tahun)</td>
                        </tr>
                        <tr>
                            <td style="color: #666; font-weight: 600;">Jenis Kelamin</td>
                            <td>:</td>
                            <td style="font-weight: 600;">{{ $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <td style="color: #666; font-weight: 600;">No. HP</td>
                            <td>:</td>
                            <td style="font-weight: 600;">{{ $anggota->no_hp }}</td>
                        </tr>
                        <tr>
                            <td style="color: #666; font-weight: 600;">Koperasi</td>
                            <td>:</td>
                            <td style="font-weight: 700; color: #1a3a6e;">{{ $anggota->koperasi ? $anggota->koperasi->nama_usaha : '-' }}</td>
                        </tr>
                        <tr>
                            <td style="color: #666; font-weight: 600;">Status</td>
                            <td>:</td>
                            <td>
                                <span style="padding: 3px 10px; border: 1px solid #333; border-radius: 4px; font-weight: 700; font-size: 10px;
                                    @if($anggota->status == 'Aktif') background: #10b981; color: white;
                                    @elseif($anggota->status == 'Pending') background: #f59e0b; color: white;
                                    @elseif($anggota->status == 'Nonaktif') background: #6b7280; color: white;
                                    @else background: #ef4444; color: white; @endif">
                                    {{ strtoupper($anggota->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="container-fluid">
    {{-- Simple Header with Back Button Only --}}
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0" style="color: #1a3a6e; font-weight: 700;">
                    <i class="fas fa-user-circle mr-2"></i>Detail Anggota Koperasi
                </h4>
                <div>
                    <button onclick="window.print()" class="btn btn-success btn-sm mr-2">
                        <i class="fas fa-print mr-1"></i> Print
                    </button>
                    <a href="{{ route('petugas.anggota.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <hr style="border-top: 2px solid #1a3a6e; margin-top: 10px;">
        </div>
    </div>

    {{-- Data Anggota dengan Foto --}}
    <div class="row mb-4">
        <div class="col-md-3 text-center">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-3">
                    <div class="mb-2">
                        <img src="{{ $anggota->foto_url }}" 
                             class="rounded" 
                             style="width: 100%; max-width: 180px; height: 220px; object-fit: cover; object-position: center; border: 3px solid #1a3a6e;">
                    </div>
                    <h5 class="font-weight-bold mb-2" style="color:#1a3a6e; font-size: 16px;">{{ $anggota->nama }}</h5>
                    <span class="badge badge-primary px-3 py-1 mb-2" style="font-size:0.85rem">
                        {{ $anggota->no_anggota }}
                    </span>
                    <br>
                    @if($anggota->status == 'Pending')
                    <span class="badge badge-warning px-3 py-1" style="font-size:0.85rem">
                        <i class="fas fa-clock mr-1"></i>Menunggu Verifikasi
                    </span>
                    @elseif($anggota->status == 'Aktif')
                    <span class="badge badge-success px-3 py-1" style="font-size:0.85rem">
                        <i class="fas fa-check-circle mr-1"></i>Aktif
                    </span>
                    @elseif($anggota->status == 'Nonaktif')
                    <span class="badge badge-secondary px-3 py-1" style="font-size:0.85rem">
                        <i class="fas fa-user-slash mr-1"></i>Nonaktif
                    </span>
                    @elseif($anggota->status == 'Ditolak')
                    <span class="badge badge-danger px-3 py-1" style="font-size:0.85rem">
                        <i class="fas fa-times-circle mr-1"></i>Ditolak
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-9">
            {{-- Tabs --}}
            <ul class="nav nav-tabs" id="detailTabs" role="tablist" style="border-bottom:2px solid #1a3a6e">
                <li class="nav-item">
                    <a class="nav-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab" style="font-weight: 600;">
                        <i class="fas fa-user mr-1"></i>Data Pribadi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="usaha-tab" data-toggle="tab" href="#usaha" role="tab" style="font-weight: 600;">
                        <i class="fas fa-store mr-1"></i>Data Usaha
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="keuangan-tab" data-toggle="tab" href="#keuangan" role="tab" style="font-weight: 600;">
                        <i class="fas fa-money-bill-wave mr-1"></i>Keuangan
                    </a>
                </li>
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-2" id="detailTabsContent">
                {{-- Data Pribadi --}}
                <div class="tab-pane fade show active" id="pribadi" role="tabpanel">
                    <div class="card border-0 shadow-sm" style="border-radius:10px">
                        <div class="card-header" style="background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%); border-radius: 10px 10px 0 0;">
                            <h6 class="mb-0 text-white font-weight-bold">
                                <i class="fas fa-user-circle mr-2"></i>Informasi Pribadi
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">NIK</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->nik ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Tempat, Tgl Lahir</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        {{ $anggota->tempat_lahir ?? '-' }}, 
                                        {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') : '-' }}
                                        @if($anggota->tanggal_lahir)
                                        <span class="text-muted">({{ $anggota->umur }} tahun)</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Jenis Kelamin</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        @if($anggota->jenis_kelamin == 'L')
                                        <i class="fas fa-mars text-primary mr-1"></i>Laki-laki
                                        @else
                                        <i class="fas fa-venus text-danger mr-1"></i>Perempuan
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Status Perkawinan</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->status_perkawinan ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Pendidikan Terakhir</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="fas fa-graduation-cap text-info mr-1"></i>{{ $anggota->pendidikan_terakhir ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Agama</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->agama ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">No. HP</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="fab fa-whatsapp text-success mr-1"></i>{{ $anggota->no_hp ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Email</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="fas fa-envelope text-primary mr-1"></i>{{ $anggota->user ? $anggota->user->email : ($anggota->email ?? '-') }}
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Alamat Lengkap</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ $anggota->alamat_lengkap ?? '-' }}
                                        <br>
                                        <small class="text-muted" style="font-size: 0.85rem;">
                                            Desa: {{ $anggota->desa ?? '-' }} | 
                                            Distrik: {{ $anggota->distrik ?? '-' }} | 
                                            Kab: {{ $anggota->kabupaten ?? 'Tolikara' }}
                                        </small>
                                    </div>
                                </div>
                                @if($anggota->koperasi)
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Koperasi</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="fas fa-building text-primary mr-1"></i>
                                        {{ $anggota->koperasi->nama_usaha }}
                                    </div>
                                </div>
                                @endif
                                @if($anggota->nama_ahli_waris)
                                <div class="col-12">
                                    <hr style="border-top: 1px dashed #ddd;">
                                    <h6 class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 700;">
                                        <i class="fas fa-user-friends mr-1"></i>Data Ahli Waris
                                    </h6>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Nama Ahli Waris</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->nama_ahli_waris }}</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Hubungan</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->hubungan_ahli_waris ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">No. HP Ahli Waris</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="fab fa-whatsapp text-success mr-1"></i>{{ $anggota->no_hp_ahli_waris ?? '-' }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Usaha --}}
                <div class="tab-pane fade" id="usaha" role="tabpanel">
                    <div class="card border-0 shadow-sm" style="border-radius:10px">
                        <div class="card-header" style="background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%); border-radius: 10px 10px 0 0;">
                            <h6 class="mb-0 text-white font-weight-bold">
                                <i class="fas fa-store mr-2"></i>Informasi Usaha
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Nama Usaha</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->nama_usaha ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Bidang Usaha</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->bidang_usaha ?? '-' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Modal Usaha</label>
                                    <div class="font-weight-600 text-success" style="font-size: 0.95rem;">
                                        <i class="fas fa-money-bill-wave mr-1"></i>
                                        Rp {{ number_format($anggota->modal_usaha ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Omzet per Bulan</label>
                                    <div class="font-weight-600 text-info" style="font-size: 0.95rem;">
                                        <i class="fas fa-chart-line mr-1"></i>
                                        Rp {{ number_format($anggota->omzet_per_bulan ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Alamat Usaha</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ $anggota->alamat_usaha ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Keterangan Usaha</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">{{ $anggota->keterangan_usaha ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keuangan --}}
                <div class="tab-pane fade" id="keuangan" role="tabpanel">
                    <div class="card border-0 shadow-sm" style="border-radius:10px">
                        <div class="card-header" style="background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%); border-radius: 10px 10px 0 0;">
                            <h6 class="mb-0 text-white font-weight-bold">
                                <i class="fas fa-wallet mr-2"></i>Informasi Keuangan
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Simpanan Pokok</label>
                                    <div class="font-weight-bold text-primary" style="font-size: 1.1rem;">
                                        <i class="fas fa-piggy-bank mr-1"></i>
                                        Rp {{ number_format($anggota->simpanan_pokok ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Simpanan Wajib</label>
                                    <div class="font-weight-bold text-warning" style="font-size: 1.1rem;">
                                        <i class="fas fa-piggy-bank mr-1"></i>
                                        Rp {{ number_format($anggota->simpanan_wajib ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <hr style="border-top: 2px dashed #ddd; margin: 10px 0;">
                                    <label class="text-muted mb-1" style="font-size:0.9rem; font-weight: 700;">Total Simpanan</label>
                                    <div class="font-weight-bold text-success" style="font-size:1.8rem;">
                                        <i class="fas fa-wallet mr-2"></i>
                                        Rp {{ number_format($anggota->total_simpanan ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                @if($anggota->tanggal_bergabung)
                                <div class="col-md-12">
                                    <label class="text-muted mb-1" style="font-size:0.8rem; font-weight: 600;">Tanggal Bergabung</label>
                                    <div class="font-weight-600" style="font-size: 0.95rem;">
                                        <i class="far fa-calendar-check text-success mr-1"></i>
                                        {{ \Carbon\Carbon::parse($anggota->tanggal_bergabung)->format('d F Y') }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Informasi Tambahan --}}
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius:10px;background:#f8f9fa">
                <div class="card-body p-3">
                    <h6 class="text-muted mb-3" style="font-weight: 700; font-size: 0.9rem;">
                        <i class="fas fa-info-circle mr-1"></i>Informasi Tambahan
                    </h6>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <small class="text-muted d-block" style="font-size: 0.75rem; font-weight: 600;">Tanggal Daftar</small>
                            <div class="font-weight-600" style="font-size: 0.9rem;">
                                <i class="far fa-calendar mr-1 text-primary"></i>
                                {{ $anggota->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                        @if($anggota->tanggal_verifikasi)
                        <div class="col-md-4 mb-2">
                            <small class="text-muted d-block" style="font-size: 0.75rem; font-weight: 600;">Tanggal Verifikasi</small>
                            <div class="font-weight-600" style="font-size: 0.9rem;">
                                <i class="far fa-calendar-check mr-1 text-success"></i>
                                {{ \Carbon\Carbon::parse($anggota->tanggal_verifikasi)->format('d M Y, H:i') }}
                            </div>
                        </div>
                        @endif
                        <div class="col-md-4 mb-2">
                            <small class="text-muted d-block" style="font-size: 0.75rem; font-weight: 600;">Terakhir Diupdate</small>
                            <div class="font-weight-600" style="font-size: 0.9rem;">
                                <i class="far fa-clock mr-1 text-info"></i>
                                {{ $anggota->updated_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                        @if($anggota->catatan_admin)
                        <div class="col-md-12 mt-2">
                            <div class="alert alert-info mb-0" style="border-radius:8px; padding: 10px 15px;">
                                <strong style="font-size: 0.85rem;"><i class="fas fa-comment mr-1"></i>Catatan Admin:</strong>
                                <br><span style="font-size: 0.85rem;">{{ $anggota->catatan_admin }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Compact and Clean Styling */
.font-weight-600 {
    font-weight: 600;
}

/* Hide print header on screen */
.print-header {
    display: none;
}

/* Tab Styling */
.nav-tabs {
    border-bottom: 2px solid #1a3a6e;
}

.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
    padding: 10px 18px;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.nav-tabs .nav-link:hover {
    color: #1a3a6e;
    background: #f0f5ff;
    border-radius: 8px 8px 0 0;
}

.nav-tabs .nav-link.active {
    color: #ffffff !important;
    background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%);
    border-radius: 8px 8px 0 0;
}

.tab-content {
    min-height: 250px;
}

/* Card Headers */
.card-header h6 {
    font-size: 0.95rem;
}

/* Print Styles */
@media print {
    /* Show print header */
    .print-header {
        display: block !important;
        page-break-after: avoid;
    }
    
    .print-header * {
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
    }
    
    /* Hide screen elements */
    .container-fluid > .row:first-child,
    .nav-tabs,
    .btn,
    button,
    a.btn {
        display: none !important;
    }
    
    /* Hide photo sidebar (already in print header) */
    .col-md-3 {
        display: none !important;
    }
    
    /* Make content full width */
    .col-md-9 {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
        padding: 0 !important;
    }
    
    /* CRITICAL: Show ALL tab panes */
    .tab-content {
        display: block !important;
    }
    
    .tab-pane {
        display: block !important;
        opacity: 1 !important;
        height: auto !important;
        overflow: visible !important;
        visibility: visible !important;
    }
    
    .tab-pane.fade {
        display: block !important;
        opacity: 1 !important;
    }
    
    .tab-pane.fade:not(.show) {
        display: block !important;
        opacity: 1 !important;
    }
    
    /* Force show each section */
    #pribadi,
    #usaha,
    #keuangan {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        height: auto !important;
        page-break-inside: avoid;
        margin-bottom: 15px !important;
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
    
    /* Container */
    .container-fluid {
        padding: 0 !important;
        max-width: 100%;
    }
    
    /* Card styling */
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
        page-break-inside: avoid;
        margin-bottom: 12px !important;
        display: block !important;
    }
    
    .card-body {
        padding: 10px !important;
        display: block !important;
    }
    
    .card-header {
        background: #1a3a6e !important;
        color: white !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        padding: 6px 10px !important;
        border-bottom: 2px solid #1a3a6e !important;
        display: block !important;
    }
    
    .card-header h6 {
        color: white !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }
    
    /* Section separators */
    #pribadi::before {
        content: "═══════════════════════════════════════════════════════════════";
        display: block;
        color: #1a3a6e;
        margin: 10px 0 8px 0;
        font-size: 10px;
        letter-spacing: -0.5px;
    }
    
    #usaha::before {
        content: "═══════════════════════════════════════════════════════════════";
        display: block;
        color: #1a3a6e;
        margin: 15px 0 8px 0;
        font-size: 10px;
        letter-spacing: -0.5px;
    }
    
    #keuangan::before {
        content: "═══════════════════════════════════════════════════════════════";
        display: block;
        color: #1a3a6e;
        margin: 15px 0 8px 0;
        font-size: 10px;
        letter-spacing: -0.5px;
    }
    
    /* Data rows */
    .row {
        display: flex !important;
        flex-wrap: wrap !important;
        page-break-inside: avoid;
    }
    
    .col-md-6,
    .col-md-12,
    .col-12 {
        display: block !important;
        margin-bottom: 8px !important;
        page-break-inside: avoid;
    }
    
    .col-md-6 {
        width: 48% !important;
        float: left !important;
        padding-right: 10px !important;
    }
    
    .col-12,
    .col-md-12 {
        width: 100% !important;
        clear: both !important;
    }
    
    label {
        font-weight: 600 !important;
        font-size: 9px !important;
        color: #666 !important;
        margin-bottom: 2px !important;
        display: block !important;
    }
    
    .font-weight-600,
    .font-weight-bold {
        font-size: 10px !important;
        color: #000 !important;
        line-height: 1.3 !important;
        display: block !important;
    }
    
    /* Icons */
    .fas,
    .far,
    .fab {
        font-size: 8px !important;
    }
    
    /* Remove color classes for print */
    .text-primary,
    .text-success,
    .text-warning,
    .text-info,
    .text-danger,
    .text-muted {
        color: #000 !important;
    }
    
    /* Alert box */
    .alert {
        border: 1px solid #ddd !important;
        background: #f8f9fa !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        padding: 8px !important;
        page-break-inside: avoid;
        display: block !important;
    }
    
    /* Info section */
    .row.mt-3 {
        page-break-inside: avoid;
        margin-top: 12px !important;
        display: block !important;
    }
    
    .row.mt-3::before {
        content: "═══════════════════════════════════════════════════════════════";
        display: block;
        color: #1a3a6e;
        margin: 15px 0 8px 0;
        font-size: 10px;
        letter-spacing: -0.5px;
    }
    
    /* Small text */
    small {
        font-size: 8px !important;
    }
    
    /* HR hidden */
    hr {
        display: none !important;
    }
    
    /* Badge */
    .badge {
        border: 1px solid #333;
        padding: 2px 6px;
        font-size: 8px;
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
    }
    
    /* Spacing */
    .mb-2,
    .mb-3,
    .mb-4 {
        margin-bottom: 6px !important;
    }
    
    .mt-2,
    .mt-3 {
        margin-top: 6px !important;
    }
    
    .p-3 {
        padding: 8px !important;
    }
}
</style>

@endsection
