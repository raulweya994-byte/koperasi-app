@extends('public.layouts.app')

@section('title', 'Pendaftaran Ditutup')

@section('content')
<div class="page-header" style="background:linear-gradient(135deg,#64748b,#475569);padding:60px 0">
    <div class="container text-center text-white">
        <h1 class="mb-3"><i class="fas fa-lock mr-3"></i>Pendaftaran Anggota</h1>
        <p class="lead">Informasi Periode Pendaftaran</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 20px rgba(0,0,0,0.08)">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="fas fa-calendar-times fa-5x text-muted" style="opacity:0.3"></i>
                        </div>
                        
                        <h3 class="font-weight-bold mb-3" style="color:#1a3a6e">
                            Pendaftaran Sedang Ditutup
                        </h3>
                        
                        @if($periode)
                            <div class="alert alert-warning" style="border-radius:12px">
                                <h6 class="font-weight-bold mb-3">Informasi Periode Terakhir:</h6>
                                <p class="mb-2"><strong>Nama Periode:</strong> {{ $periode->nama_periode }}</p>
                                <p class="mb-2"><strong>Tahun Ajaran:</strong> {{ $periode->tahun_ajaran }}</p>
                                <p class="mb-2"><strong>Periode:</strong> {{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }}</p>
                                <p class="mb-0"><strong>Status:</strong> 
                                    <span class="badge badge-secondary">{{ $periode->status_pendaftaran }}</span>
                                </p>
                            </div>
                        @else
                            <p class="text-muted mb-4">
                                Saat ini belum ada periode pendaftaran yang dibuka. 
                                Silakan hubungi admin untuk informasi lebih lanjut.
                            </p>
                        @endif
                        
                        <div class="mt-4">
                            <a href="{{ route('public.home') }}" class="btn btn-primary">
                                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                            </a>
                            <a href="{{ route('public.kontak') }}" class="btn btn-outline-primary ml-2">
                                <i class="fas fa-phone mr-2"></i>Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4" style="border-radius:16px;border:none;box-shadow:0 4px 20px rgba(0,0,0,0.08)">
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Penting
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check text-success mr-2"></i>
                                Pendaftaran akan dibuka sesuai periode yang ditentukan
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success mr-2"></i>
                                Pantau terus website ini untuk informasi pembukaan pendaftaran
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success mr-2"></i>
                                Siapkan dokumen yang diperlukan sebelum periode dibuka
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-success mr-2"></i>
                                Hubungi kami jika ada pertanyaan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
