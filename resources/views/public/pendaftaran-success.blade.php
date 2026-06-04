@extends('public.layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="page-header" style="background:linear-gradient(135deg,#10b981,#059669);padding:60px 0">
    <div class="container text-center text-white">
        <h1 class="mb-3"><i class="fas fa-check-circle mr-3"></i>Pendaftaran Berhasil!</h1>
        <p class="lead">Selamat, Anda telah terdaftar sebagai anggota koperasi</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 20px rgba(0,0,0,0.08)">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <div style="width:100px;height:100px;margin:0 auto;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-check fa-3x text-white"></i>
                            </div>
                        </div>
                        
                        <h3 class="font-weight-bold mb-3" style="color:#1a3a6e">
                            Pendaftaran Anda Berhasil!
                        </h3>
                        
                        <p class="text-muted mb-4">
                            Terima kasih telah mendaftar sebagai anggota koperasi. 
                            Data Anda sedang menunggu verifikasi dari admin.
                        </p>
                        
                        <div class="alert alert-info" style="border-radius:12px;text-align:left">
                            <h6 class="font-weight-bold mb-3">
                                <i class="fas fa-info-circle mr-2"></i>Informasi Pendaftaran Anda:
                            </h6>
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td width="150"><strong>Nama:</strong></td>
                                    <td>{{ session('nama') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Anggota:</strong></td>
                                    <td><span class="badge badge-primary" style="font-size:14px">{{ session('no_anggota') }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>
                                        <i class="fas fa-envelope text-primary mr-1"></i>{{ session('email') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge badge-warning" style="font-size:14px">
                                            <i class="fas fa-clock mr-1"></i>Menunggu Verifikasi Admin
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="alert alert-warning" style="border-radius:12px">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Penting:</strong> Admin akan memeriksa data Anda terlebih dahulu. 
                            Anda akan menerima notifikasi melalui email setelah verifikasi selesai.
                            Setelah disetujui, Anda dapat login menggunakan email dan password yang Anda daftarkan.
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('public.home') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                            </a>
                            <a href="{{ route('pendaftaran.landing') }}" class="btn btn-outline-primary btn-lg ml-2">
                                <i class="fas fa-info-circle mr-2"></i>Info Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4" style="border-radius:16px;border:none;box-shadow:0 4px 20px rgba(0,0,0,0.08)">
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">
                            <i class="fas fa-list-check mr-2"></i>Langkah Selanjutnya
                        </h5>
                        <div class="timeline">
                            <div class="timeline-item mb-3">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <div style="width:40px;height:40px;background:#10b981;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Pendaftaran Diterima</h6>
                                        <p class="text-muted mb-0">Data Anda telah masuk ke sistem dan menunggu verifikasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <div style="width:40px;height:40px;background:#fbbf24;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Admin Memeriksa Data</h6>
                                        <p class="text-muted mb-0">Admin akan memeriksa kelengkapan dan kebenaran data Anda (1-3 hari kerja)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <div style="width:40px;height:40px;background:#3b82f6;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Notifikasi Hasil Verifikasi</h6>
                                        <p class="text-muted mb-0">Anda akan menerima email notifikasi apakah pendaftaran diterima atau ditolak</p>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <div style="width:40px;height:40px;background:#8b5cf6;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Akses Dashboard Anggota</h6>
                                        <p class="text-muted mb-0">Setelah disetujui, login menggunakan email dan password Anda untuk mengakses dashboard</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
