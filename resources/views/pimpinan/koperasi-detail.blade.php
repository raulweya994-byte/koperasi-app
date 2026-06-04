@extends('layouts.app')
@section('title','Detail Koperasi')
@section('page-title','Detail Koperasi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('pimpinan.koperasi') }}">Koperasi</a></li>
<li class="breadcrumb-item active">{{ $koperasi->nama_usaha }}</li>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Back Button --}}
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('pimpinan.koperasi') }}" class="btn btn-secondary" style="border-radius:10px">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>

    {{-- Header Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#3b82f6,#2563eb)">
                <div class="card-body p-4 text-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-2 font-weight-bold">{{ $koperasi->nama_usaha }}</h3>
                            <p class="mb-2" style="opacity:0.9">
                                <i class="fas fa-user mr-2"></i>{{ $koperasi->nama_pemilik }}
                            </p>
                            <p class="mb-0" style="opacity:0.9">
                                <i class="fas fa-map-marker-alt mr-2"></i>{{ $koperasi->alamat }}, {{ $koperasi->distrik }}
                            </p>
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="mb-2">
                                <span class="badge badge-light" style="font-size:14px;padding:8px 16px">
                                    {{ $koperasi->no_registrasi }}
                                </span>
                            </div>
                            <div>{!! $koperasi->status_verifikasi_label !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Informasi Umum --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Umum
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Nama Usaha</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $koperasi->nama_usaha }}</p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Nama Pemilik</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $koperasi->nama_pemilik }}</p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">No. KTP</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $koperasi->no_ktp }}</p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Jenis Usaha</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $koperasi->jenis_usaha }}</p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Kategori</label>
                        <p class="mb-0">
                            <span class="badge badge-{{ $koperasi->kategori == 'mikro' ? 'primary' : ($koperasi->kategori == 'kecil' ? 'success' : 'warning') }}" style="font-size:13px;padding:6px 14px">
                                {{ ucfirst($koperasi->kategori) }}
                            </span>
                        </p>
                    </div>
                    <div class="info-item">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Status Usaha</label>
                        <p class="mb-0">{!! $koperasi->status_usaha_label !!}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kontak & Lokasi --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-map-marker-alt mr-2"></i>Kontak & Lokasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Alamat</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $koperasi->alamat }}</p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Distrik</label>
                        <p class="mb-0">
                            <span class="badge badge-info" style="font-size:13px;padding:6px 14px">
                                <i class="fas fa-map-marker-alt mr-1"></i>{{ $koperasi->distrik }}
                            </span>
                        </p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Kelurahan</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $koperasi->kelurahan }}</p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">No. Telepon</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-phone mr-2 text-success"></i>{{ $koperasi->no_telp }}
                        </p>
                    </div>
                    <div class="info-item">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Email</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-envelope mr-2 text-primary"></i>{{ $koperasi->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informasi Keuangan --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-money-bill-wave mr-2"></i>Informasi Keuangan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Modal Usaha</label>
                        <p class="mb-0 font-weight-bold" style="font-size:18px;color:#10b981">
                            Rp {{ number_format($koperasi->modal_usaha, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Omset Per Bulan</label>
                        <p class="mb-0 font-weight-bold" style="font-size:18px;color:#3b82f6">
                            Rp {{ number_format($koperasi->omset_per_bulan, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="info-item">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Jumlah Karyawan</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-users mr-2 text-info"></i>{{ $koperasi->jumlah_karyawan }} Orang
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Verifikasi --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-check-circle mr-2"></i>Status Verifikasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Status</label>
                        <p class="mb-0">{!! $koperasi->status_verifikasi_label !!}</p>
                    </div>
                    @if($koperasi->verified_at)
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Tanggal Verifikasi</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-calendar mr-2 text-success"></i>{{ $koperasi->verified_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    @endif
                    @if($koperasi->verifiedBy)
                    <div class="info-item mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Diverifikasi Oleh</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-user-check mr-2 text-primary"></i>{{ $koperasi->verifiedBy->name }}
                        </p>
                    </div>
                    @endif
                    @if($koperasi->catatan_verifikasi)
                    <div class="info-item">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Catatan</label>
                        <div class="alert alert-info mb-0" style="border-radius:10px">
                            {{ $koperasi->catatan_verifikasi }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Foto Usaha --}}
        @if($koperasi->foto_usaha)
        <div class="col-12 mb-4">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-image mr-2"></i>Foto Usaha
                    </h5>
                </div>
                <div class="card-body p-4 text-center">
                    <img src="{{ asset('storage/'.$koperasi->foto_usaha) }}" alt="Foto Usaha" class="img-fluid" style="max-height:400px;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
                </div>
            </div>
        </div>
        @endif

        {{-- Riwayat Bantuan --}}
        @if($koperasi->penerimaBantuan->count() > 0)
        <div class="col-12 mb-4">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-hand-holding-heart mr-2"></i>Riwayat Bantuan
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background:#f8f9fa">
                                <tr>
                                    <th style="padding:15px">#</th>
                                    <th>Nama Bantuan</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($koperasi->penerimaBantuan as $i => $pb)
                                <tr style="border-bottom:1px solid #e5e7eb">
                                    <td style="padding:15px">{{ $i+1 }}</td>
                                    <td>
                                        <div class="font-weight-600" style="color:#1f2937">{{ $pb->bantuan->nama_bantuan }}</div>
                                    </td>
                                    <td>
                                        <span class="badge badge-info" style="font-size:11px;padding:5px 10px">
                                            {{ ucfirst($pb->bantuan->jenis_bantuan) }}
                                        </span>
                                    </td>
                                    <td class="font-weight-600">
                                        @if($pb->bantuan->jenis_bantuan == 'uang')
                                            Rp {{ number_format($pb->jumlah_diterima, 0, ',', '.') }}
                                        @else
                                            {{ $pb->jumlah_diterima }} {{ $pb->bantuan->satuan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($pb->status == 'diterima')
                                            <span class="badge badge-success">Diterima</span>
                                        @elseif($pb->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $pb->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.info-item {
    padding-bottom: 12px;
    border-bottom: 1px solid #e5e7eb;
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    transform: scale(1.01);
    transition: all 0.3s;
}
</style>
@endsection
