@extends('public.layouts.app')
@section('title','Layanan')
@section('content')
<section style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0 40px;color:white;">
    <div class="container text-center">
        <i class="fas fa-concierge-bell fa-2x mb-3 d-block" style="opacity:.8"></i>
        <h2 class="font-weight-bold mb-2">Layanan Kami</h2>
        <p style="opacity:.75">Layanan DISPERINDAGKOP Kabupaten Tolikara untuk pelaku Koperasi</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm text-center h-100" style="border-radius:12px;border-top:4px solid #1a3a6e!important;cursor:pointer;" onclick="location.href='{{ route('public.koperasi') }}'">
                    <div class="card-body p-4">
                        <div style="width:70px;height:70px;border-radius:50%;background:#1a3a6e;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;">
                            <i class="fas fa-store fa-2x text-white"></i>
                        </div>
                        <h5 class="font-weight-bold">Daftar Koperasi</h5>
                        <p class="text-muted small">Daftarkan usaha Anda ke sistem informasi Koperasi Kabupaten Tolikara</p>
                        <a href="{{ route('public.koperasi') }}" class="btn btn-outline-primary btn-sm">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm text-center h-100" style="border-radius:12px;border-top:4px solid #28a745!important;cursor:pointer;" onclick="location.href='{{ route('bantuan-modal') }}'">
                    <div class="card-body p-4">
                        <div style="width:70px;height:70px;border-radius:50%;background:#28a745;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;">
                            <i class="fas fa-hand-holding-usd fa-2x text-white"></i>
                        </div>
                        <h5 class="font-weight-bold">Bantuan Modal</h5>
                        <p class="text-muted small">Ajukan bantuan modal usaha untuk mengembangkan bisnis Anda</p>
                        <a href="{{ route('bantuan-modal') }}" class="btn btn-outline-success btn-sm">Ajukan Bantuan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm text-center h-100" style="border-radius:12px;border-top:4px solid #f5a623!important;cursor:pointer;" onclick="location.href='{{ route('pelatihan') }}'">
                    <div class="card-body p-4">
                        <div style="width:70px;height:70px;border-radius:50%;background:#f5a623;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;">
                            <i class="fas fa-chalkboard-teacher fa-2x text-white"></i>
                        </div>
                        <h5 class="font-weight-bold">Pelatihan</h5>
                        <p class="text-muted small">Ikuti program pelatihan untuk meningkatkan kapasitas usaha Anda</p>
                        <a href="{{ route('pelatihan') }}" class="btn btn-outline-warning btn-sm">Lihat Pelatihan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm text-center h-100" style="border-radius:12px;border-top:4px solid #dc3545!important;cursor:pointer;" onclick="location.href='{{ route('statistik') }}'">
                    <div class="card-body p-4">
                        <div style="width:70px;height:70px;border-radius:50%;background:#dc3545;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;">
                            <i class="fas fa-chart-bar fa-2x text-white"></i>
                        </div>
                        <h5 class="font-weight-bold">Data Statistik</h5>
                        <p class="text-muted small">Lihat data statistik Koperasi Kabupaten Tolikara</p>
                        <a href="{{ route('statistik') }}" class="btn btn-outline-danger btn-sm">Lihat Statistik</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection