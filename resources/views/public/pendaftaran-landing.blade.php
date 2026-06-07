@extends('public.layouts.app')

@section('title', 'Portal Anggota Koperasi')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
    }
    .hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: white;
    }
    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    .hero-subtitle {
        font-size: 1.3rem;
        opacity: 0.95;
        margin-bottom: 40px;
    }
    .choice-section {
        margin-top: -80px;
        position: relative;
        z-index: 2;
    }
    .choice-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 40px;
        max-width: 500px;
        margin: 0 auto;
    }
    .choice-card {
        background: white;
        border-radius: 20px;
        padding: 40px 35px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .choice-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #1a3a6e, #2d5aa0);
    }
    .choice-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .choice-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: white;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }
    .choice-card.login .choice-icon {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }
    .choice-card.register .choice-icon {
        background: linear-gradient(135deg, #10b981, #059669);
    }
    .choice-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1a3a6e;
        margin-bottom: 12px;
    }
    .choice-description {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 20px;
        line-height: 1.5;
    }
    .choice-features {
        text-align: left;
        margin-bottom: 25px;
    }
    .choice-features li {
        padding: 8px 0;
        color: #475569;
        font-size: 0.9rem;
    }
    .choice-features li i {
        color: #10b981;
        margin-right: 10px;
        width: 20px;
    }
    .btn-choice {
        display: inline-block;
        padding: 12px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    .btn-choice.login {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    .btn-choice.login:hover {
        box-shadow: 0 6px 25px rgba(59, 130, 246, 0.5);
        transform: translateY(-2px);
        color: white;
    }
    .btn-choice.register {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    .btn-choice.register:hover {
        box-shadow: 0 6px 25px rgba(16, 185, 129, 0.5);
        transform: translateY(-2px);
        color: white;
    }
    .choice-card .form-control {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 10px 14px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .choice-card .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    .choice-card .form-label {
        text-align: left;
        display: block;
        font-weight: 600;
        color: #374151;
        font-size: 0.85rem;
        margin-bottom: 6px;
    }
    .choice-card .form-group {
        margin-bottom: 15px;
    }
    .info-section {
        padding: 80px 0;
        background: #f8f9fa;
    }
    .info-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: all 0.3s;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    .info-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-bottom: 20px;
    }
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        .choice-container {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .choice-card {
            padding: 40px 30px;
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.9;
            transform: scale(1.05);
        }
    }
</style>

{{-- Hero Section --}}
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="mb-4">
                <i class="fas fa-users fa-4x" style="opacity:0.9"></i>
            </div>
            
            @if($periode && $periode->status === 'aktif')
                {{-- Jika Pendaftaran DIBUKA --}}
                <h1 class="hero-title">Portal Anggota Koperasi</h1>
                <p class="hero-subtitle">
                    Bergabunglah dengan koperasi kami dan nikmati berbagai manfaat keanggotaan
                </p>
                
                {{-- Pengumuman Periode Pendaftaran --}}
                <div style="max-width:700px;margin:30px auto 0;background:rgba(255,255,255,0.15);backdrop-filter:blur(10px);border-radius:16px;padding:20px 30px;border:2px solid rgba(255,255,255,0.2);box-shadow:0 8px 32px rgba(0,0,0,0.1)">
                    <div style="display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:12px">
                        <span style="background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700;letter-spacing:0.5px;box-shadow:0 4px 12px rgba(16,185,129,0.4)">
                            <i class="fas fa-calendar-check mr-1"></i>PENDAFTARAN DIBUKA
                        </span>
                        <span style="background:linear-gradient(135deg,#f5a623,#fdb944);color:#1a3a6e;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700;box-shadow:0 4px 12px rgba(245,166,35,0.4)">
                            <i class="fas fa-graduation-cap mr-1"></i>{{ $periode->tahun_ajaran }}
                        </span>
                    </div>
                    <h4 style="color:#fff;font-weight:800;font-size:20px;margin:0 0 10px;text-shadow:2px 2px 4px rgba(0,0,0,0.2)">
                        {{ $periode->nama_periode }}
                    </h4>
                    <div style="display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:20px;color:rgba(255,255,255,0.95);font-size:14px">
                        <span>
                            <i class="fas fa-clock mr-1"></i>
                            <strong>{{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d M') }}</strong> - 
                            <strong>{{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y') }}</strong>
                        </span>
                        @if($periode->kuota)
                        <span style="background:rgba(255,255,255,0.2);padding:4px 12px;border-radius:12px">
                            <i class="fas fa-users mr-1"></i>
                            Kuota: <strong>{{ $periode->sisa_kuota }}/{{ $periode->kuota }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            @else
                {{-- Jika Pendaftaran DITUTUP atau Belum Ada Periode --}}
                <h1 class="hero-title">Pendaftaran Anggota Koperasi</h1>
                
                @if($periode && $periode->status === 'nonaktif')
                    {{-- Ada periode tapi ditutup --}}
                    <p class="hero-subtitle" style="margin-bottom:20px">
                        Pendaftaran anggota baru saat ini sedang ditutup
                    </p>
                    
                    <div style="max-width:650px;margin:20px auto 0;background:rgba(251,191,36,0.2);backdrop-filter:blur(10px);border-radius:16px;padding:24px 32px;border:2px solid rgba(251,191,36,0.3);box-shadow:0 8px 32px rgba(0,0,0,0.1)">
                        <div style="display:flex;align-items:center;justify-content:center;gap:14px;margin-bottom:14px">
                            <div style="width:48px;height:48px;background:rgba(251,191,36,0.3);border-radius:12px;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-lock" style="font-size:22px;color:#fbbf24"></i>
                            </div>
                            <div style="text-align:left">
                                <h5 style="color:#fff;font-weight:800;font-size:18px;margin:0 0 4px">
                                    Pendaftaran Sementara Ditutup
                                </h5>
                                <p style="color:rgba(255,255,255,0.9);font-size:14px;margin:0">
                                    Periode terakhir: <strong>{{ $periode->nama_periode }}</strong>
                                </p>
                            </div>
                        </div>
                        <div style="background:rgba(255,255,255,0.15);border-radius:10px;padding:14px;margin-top:16px">
                            <div style="display:flex;align-items:center;justify-content:center;gap:16px;flex-wrap:wrap;color:rgba(255,255,255,0.95);font-size:13px">
                                <span>
                                    <i class="fas fa-calendar mr-1"></i>
                                    Tahun Ajaran: <strong>{{ $periode->tahun_ajaran }}</strong>
                                </span>
                                <span>
                                    <i class="fas fa-clock mr-1"></i>
                                    Ditutup: <strong>{{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y') }}</strong>
                                </span>
                            </div>
                        </div>
                        <p style="color:rgba(255,255,255,0.85);font-size:13px;margin:16px 0 0;text-align:center">
                            <i class="fas fa-info-circle mr-1"></i>
                            Nantikan pembukaan periode pendaftaran berikutnya. Pantau terus pengumuman kami!
                        </p>
                    </div>
                @else
                    {{-- Belum ada periode sama sekali --}}
                    <p class="hero-subtitle" style="margin-bottom:20px">
                        Pendaftaran anggota baru belum dibuka
                    </p>
                    
                    <div style="max-width:600px;margin:20px auto 0;background:rgba(148,163,184,0.2);backdrop-filter:blur(10px);border-radius:16px;padding:28px 32px;border:2px solid rgba(148,163,184,0.3);box-shadow:0 8px 32px rgba(0,0,0,0.1)">
                        <div style="display:flex;flex-direction:column;align-items:center;gap:16px">
                            <div style="width:64px;height:64px;background:rgba(148,163,184,0.3);border-radius:16px;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-calendar-times" style="font-size:28px;color:#94a3b8"></i>
                            </div>
                            <div style="text-align:center">
                                <h5 style="color:#fff;font-weight:800;font-size:19px;margin:0 0 8px">
                                    Belum Ada Periode Pendaftaran
                                </h5>
                                <p style="color:rgba(255,255,255,0.9);font-size:14px;margin:0 0 16px;line-height:1.6">
                                    Saat ini belum ada periode pendaftaran anggota baru yang dibuka.<br>
                                    Silakan hubungi admin atau pantau pengumuman untuk informasi lebih lanjut.
                                </p>
                                <div style="display:flex;align-items:center;justify-content:center;gap:12px;margin-top:16px">
                                    <a href="{{ route('public.kontak') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.2);color:#fff;padding:10px 20px;border-radius:50px;font-weight:600;font-size:13px;text-decoration:none;transition:all 0.3s" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                                        <i class="fas fa-envelope"></i>
                                        <span>Hubungi Kami</span>
                                    </a>
                                    <a href="{{ route('public.pengumuman') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.2);color:#fff;padding:10px 20px;border-radius:50px;font-weight:600;font-size:13px;text-decoration:none;transition:all 0.3s" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                                        <i class="fas fa-bullhorn"></i>
                                        <span>Lihat Pengumuman</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

{{-- Choice Section --}}
<section class="choice-section">
    <div class="container">
        <div class="choice-container">
            {{-- Login Card --}}
            <div class="choice-card login">
                <div class="choice-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <h2 class="choice-title">Sudah Punya Akun?</h2>
                <p class="choice-description">
                    Masuk ke akun Anda untuk mengakses dashboard anggota dan berbagai layanan koperasi
                </p>
                <ul class="choice-features list-unstyled">
                    <li><i class="fas fa-check-circle"></i> Akses dashboard pribadi</li>
                    <li><i class="fas fa-check-circle"></i> Lihat data keanggotaan</li>
                    <li><i class="fas fa-check-circle"></i> Cek simpanan & pinjaman</li>
                    <li><i class="fas fa-check-circle"></i> Informasi jadwal & pengumuman</li>
                </ul>

                {{-- Login Form --}}
                <form action="{{ route('login.post') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">
                            Username/Email <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="email" class="form-control" required 
                               placeholder="Masukkan email atau username">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">
                            Kata Sandi <span class="text-danger">*</span>
                        </label>
                        <div style="position:relative">
                            <input type="password" name="password" class="form-control" required 
                                   id="passwordInput"
                                   placeholder="Masukkan kata sandi">
                            <button type="button" onclick="togglePassword()" 
                                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#9ca3af;cursor:pointer">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label style="font-size:0.9rem;color:#64748b;margin:0">
                            <input type="checkbox" name="remember"> Ingat saya
                        </label>
                        <a href="{{ route('pendaftaran.form') }}" style="color:#10b981;font-size:0.9rem;text-decoration:none;font-weight:600">
                            <i class="fas fa-user-plus mr-1"></i>Daftar Sekarang
                        </a>
                    </div>
                    <button type="submit" class="btn btn-choice login">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk Sekarang
                    </button>
                </form>
            </div>

            

            
        </div>
    </div>
</section>

{{-- Info Section --}}
<section class="info-section">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="font-weight-bold" style="color:#1a3a6e;font-size:2rem">Keuntungan Menjadi Anggota</h3>
            <p class="text-muted" style="font-size:1.1rem">Nikmati berbagai manfaat eksklusif untuk anggota koperasi</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">Simpanan & Pinjaman</h5>
                    <p class="text-muted mb-0">Kelola simpanan dan ajukan pinjaman dengan bunga rendah dan proses cepat</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">Pelatihan Gratis</h5>
                    <p class="text-muted mb-0">Akses pelatihan dan workshop untuk pengembangan usaha dan keterampilan</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">Bantuan Modal</h5>
                    <p class="text-muted mb-0">Dapatkan bantuan modal usaha dan subsidi untuk mengembangkan bisnis Anda</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">Komunitas</h5>
                    <p class="text-muted mb-0">Bergabung dengan komunitas pengusaha dan perluas jaringan bisnis Anda</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">Sisa Hasil Usaha</h5>
                    <p class="text-muted mb-0">Dapatkan pembagian SHU (Sisa Hasil Usaha) setiap tahun dari koperasi</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">Perlindungan</h5>
                    <p class="text-muted mb-0">Perlindungan dan jaminan untuk anggota serta keluarga dari koperasi</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Pengumuman Section --}}
@if($pengumuman && $pengumuman->count() > 0)
<section style="padding:80px 0;background:#fff">
    <div class="container">
        <div class="text-center mb-5">
            <div style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);color:#fff;padding:8px 20px;border-radius:30px;margin-bottom:16px;box-shadow:0 4px 15px rgba(26,58,110,0.3)">
                <i class="fas fa-bullhorn"></i>
                <span style="font-size:12px;font-weight:700;letter-spacing:0.5px">PENGUMUMAN TERBARU</span>
            </div>
            <h3 class="font-weight-bold" style="color:#1a3a6e;font-size:2rem;margin-bottom:12px">Informasi & Pengumuman Koperasi</h3>
            <p class="text-muted" style="font-size:1.1rem">Tetap update dengan informasi terbaru dari koperasi kami</p>
        </div>
        
        <div class="row">
            @foreach($pengumuman as $index => $item)
            <div class="col-lg-{{ $index === 0 ? '12' : '6' }} mb-4">
                <div class="card" style="border:none;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);transition:all 0.3s;height:100%" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 35px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)'">
                    <div style="height:4px;background:linear-gradient(90deg,#1a3a6e,#f5a623,#10b981)"></div>
                    <div class="card-body" style="padding:{{ $index === 0 ? '32px' : '24px' }}">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div style="flex:1">
                                <div class="d-flex align-items-center gap-2 mb-2" style="flex-wrap:wrap">
                                    @if($item->jenis)
                                    <span style="background:linear-gradient(135deg,{{ $item->jenis === 'urgent' ? '#f43f5e,#dc2626' : ($item->jenis === 'penting' ? '#f59e0b,#d97706' : '#667eea,#764ba2') }});color:#fff;padding:4px 12px;border-radius:12px;font-size:11px;font-weight:700;letter-spacing:0.3px{{ $item->jenis === 'urgent' ? ';animation:pulse 2s infinite' : '' }}">
                                        <i class="fas fa-{{ $item->jenis === 'urgent' ? 'exclamation-triangle' : ($item->jenis === 'penting' ? 'exclamation-circle' : 'info-circle') }} mr-1"></i>{{ strtoupper($item->jenis) }}
                                    </span>
                                    @endif
                                    <span style="color:#94a3b8;font-size:12px;font-weight:600">
                                        <i class="fas fa-calendar-alt mr-1"></i>{{ $item->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <h4 style="color:#1a3a6e;font-weight:800;font-size:{{ $index === 0 ? '1.5rem' : '1.2rem' }};margin-bottom:12px;line-height:1.3">
                                    {{ $item->judul }}
                                </h4>
                                <p style="color:#64748b;font-size:{{ $index === 0 ? '15px' : '14px' }};line-height:1.6;margin-bottom:16px">
                                    {{ Str::limit(strip_tags($item->isi), $index === 0 ? 200 : 120) }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            @if($item->link)
                            <a href="{{ $item->link }}" target="_blank" style="display:inline-flex;align-items:center;gap:8px;color:#1a3a6e;font-weight:700;font-size:14px;text-decoration:none;transition:all 0.2s" onmouseover="this.style.color='#f5a623';this.querySelector('i').style.transform='translateX(4px)'" onmouseout="this.style.color='#1a3a6e';this.querySelector('i').style.transform=''">
                                <span>Baca Selengkapnya</span>
                                <i class="fas fa-arrow-right" style="transition:transform 0.2s"></i>
                            </a>
                            @else
                            <a href="{{ route('public.pengumuman') }}" style="display:inline-flex;align-items:center;gap:8px;color:#1a3a6e;font-weight:700;font-size:14px;text-decoration:none;transition:all 0.2s" onmouseover="this.style.color='#f5a623';this.querySelector('i').style.transform='translateX(4px)'" onmouseout="this.style.color='#1a3a6e';this.querySelector('i').style.transform=''">
                                <span>Lihat Detail</span>
                                <i class="fas fa-arrow-right" style="transition:transform 0.2s"></i>
                            </a>
                            @endif
                            @if($item->foto)
                            <span style="display:inline-flex;align-items:center;gap:6px;background:#f1f5f9;color:#475569;padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600">
                                <i class="fas fa-image"></i>
                                <span>Foto</span>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('public.pengumuman') }}" class="btn btn-lg" style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);color:#fff;border:none;border-radius:50px;padding:14px 40px;font-weight:700;font-size:15px;box-shadow:0 4px 15px rgba(26,58,110,0.3);transition:all 0.3s" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(26,58,110,0.4)'" onmouseout="this.style.transform='';this.style.boxShadow='0 4px 15px rgba(26,58,110,0.3)'">
                <i class="fas fa-list mr-2"></i>Lihat Semua Pengumuman
            </a>
        </div>
    </div>
</section>
@endif

{{-- CTA Section --}}
<section style="padding:60px 0;background:linear-gradient(135deg,#1a3a6e,#2d5aa0)">
    <div class="container text-center text-white">
        <h3 class="font-weight-bold mb-3" style="font-size:2rem">Siap Bergabung?</h3>
        <p class="mb-4" style="font-size:1.2rem;opacity:0.9">Daftar sekarang dan mulai nikmati berbagai keuntungan keanggotaan</p>
        <a href="{{ route('pendaftaran.form') }}" class="btn btn-light btn-lg" style="border-radius:50px;padding:15px 50px;font-weight:700">
            <i class="fas fa-rocket mr-2"></i>Mulai Pendaftaran
        </a>
    </div>
</section>

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}
</script>
@endpush

@endsection
