@extends('public.layouts.app')
@section('title', $koperasi->nama_usaha . ' - DISPERINDAGKOP Tolikara')
@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-store mr-3"></i>Detail Koperasi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('public.home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.koperasi') }}">Direktori Koperasi</a></li>
            <li class="breadcrumb-item active">{{ $koperasi->nama_usaha }}</li>
        </ol>
    </div>
</div>
<section class="section">
<div class="container">
    {{-- Tombol Kembali --}}
    <a href="{{ route('public.koperasi') }}" class="btn btn-primary mb-4">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Direktori
    </a>
    <div class="card border-0 shadow-sm" style="border-radius:14px">
        <div class="card-body p-4">
            <div class="row">
                {{-- Kiri: Info --}}
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge badge-{{ $koperasi->kategori == 'mikro' ? 'info' : ($koperasi->kategori == 'kecil' ? 'warning' : 'success') }} px-3 py-2 mr-3">{{ ucfirst($koperasi->kategori) }}</span>
                        <span class="badge badge-success px-3 py-2">Terverifikasi</span>
                    </div>
                    <h2 class="font-weight-bold mb-1">{{ $koperasi->nama_usaha }}</h2>
                    <p class="text-muted mb-4"><i class="fas fa-id-card mr-2"></i>{{ $koperasi->no_registrasi }}</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Pemilik</small>
                            <strong>{{ $koperasi->nama_pemilik }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Jenis Usaha</small>
                            <strong>{{ $koperasi->jenis_usaha }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Distrik</small>
                            <strong>{{ $koperasi->distrik }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Kelurahan</small>
                            <strong>{{ $koperasi->kelurahan ?? '-' }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">No. Telepon</small>
                            <strong>{{ $koperasi->no_telp ?? '-' }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Jumlah Karyawan</small>
                            <strong>{{ $koperasi->jumlah_karyawan ?? 0 }} orang</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Modal Usaha</small>
                            <strong>Rp {{ number_format($koperasi->modal_usaha ?? 0, 0, ',', '.') }}</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Omset/Bulan</small>
                            <strong>Rp {{ number_format($koperasi->omset_per_bulan ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    @if($koperasi->alamat)
                    <div class="mt-2">
                        <small class="text-muted d-block">Alamat Lengkap</small>
                        <strong>{{ $koperasi->alamat }}</strong>
                    </div>
                    @endif
                </div>
                {{-- Kanan: Gambar --}}
                <div class="col-lg-4 text-center">
                    @if($koperasi->foto_usaha)
                    <img src="{{ asset('storage/'.$koperasi->foto_usaha) }}" 
                         class="img-fluid rounded" 
                         style="max-height:450px;width:100%;object-fit:cover;border-radius:12px">
                    @else
                    <div style="height:400px;background:#f0f4ff;border-radius:12px;display:flex;align-items:center;justify-content:center">
                        <i class="fas fa-store fa-4x" style="color:#cbd5e0"></i>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection