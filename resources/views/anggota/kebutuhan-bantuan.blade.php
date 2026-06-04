@extends('layouts.anggota')
@section('title', 'List Kebutuhan Bantuan')

@push('styles')
<style>
    /* ===== GENERAL STYLES ===== */
    body {
        background: #f8f9fa;
    }
    
    /* ===== NO PERIOD CARD ===== */
    .no-period-wrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .no-period-card {
        border-radius: 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 60px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .no-period-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .calendar-icon-wrapper {
        position: relative;
        z-index: 1;
        margin-bottom: 40px;
    }
    
    .calendar-icon-large {
        font-size: 140px;
        color: rgba(255,255,255,0.3);
        animation: float 4s ease-in-out infinite;
        filter: drop-shadow(0 10px 30px rgba(0,0,0,0.2));
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        25% { transform: translateY(-15px) rotate(-5deg); }
        75% { transform: translateY(-15px) rotate(5deg); }
    }
    
    .no-period-content {
        position: relative;
        z-index: 1;
    }
    
    .no-period-title {
        color: white;
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .no-period-text {
        color: rgba(255,255,255,0.95);
        font-size: 18px;
        line-height: 1.8;
        max-width: 650px;
        margin: 0 auto 40px;
    }
    
    .info-badge {
        background: rgba(255,255,255,0.95);
        border-radius: 20px;
        padding: 25px 40px;
        display: inline-block;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
    }
    
    .info-badge-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        animation: pulse-icon 2s infinite;
    }
    
    @keyframes pulse-icon {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
        50% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(102, 126, 234, 0); }
    }
    
    .btn-back-home {
        background: white;
        color: #667eea;
        border: none;
        border-radius: 15px;
        padding: 18px 50px;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .btn-back-home:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        color: #667eea;
    }
    
    /* ===== PERIOD ACTIVE CARD ===== */
    .period-card {
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
    
    .period-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    
    .countdown-box {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .countdown-number {
        font-size: 56px;
        font-weight: 900;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        text-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    /* ===== FORM CARD ===== */
    .form-card {
        border-radius: 25px;
        border: none;
        box-shadow: 0 15px 50px rgba(0,0,0,0.1);
    }
    
    .form-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 25px 25px 0 0 !important;
        padding: 30px 35px;
        border: none;
    }
    
    .form-group label {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 14px;
    }
    
    .form-control {
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        padding: 14px 18px;
        transition: all 0.3s;
        font-size: 15px;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 15px;
        padding: 18px 50px;
        font-weight: 700;
        font-size: 17px;
        transition: all 0.3s;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }
    
    /* ===== STATUS CARDS ===== */
    .status-card {
        border-radius: 25px;
        border: none;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 50px;
        box-shadow: 0 15px 50px rgba(16, 185, 129, 0.3);
    }
    
    .warning-card {
        border-radius: 25px;
        border: none;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 50px;
        box-shadow: 0 15px 50px rgba(245, 158, 11, 0.3);
    }
    
    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .no-period-card {
            padding: 60px 30px;
        }
        
        .no-period-title {
            font-size: 28px;
        }
        
        .no-period-text {
            font-size: 16px;
        }
        
        .calendar-icon-large {
            font-size: 100px;
        }
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }
    
    /* ===== STATUS CARDS ===== */
    .status-card {
        border-radius: 25px;
        border: none;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 50px;
        box-shadow: 0 15px 50px rgba(16, 185, 129, 0.3);
    }
    
    .warning-card {
        border-radius: 25px;
        border: none;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 50px;
        box-shadow: 0 15px 50px rgba(245, 158, 11, 0.3);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px; border-left: 5px solid #10b981;">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 15px; border-left: 5px solid #ef4444;">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Gagal!</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    @php
        $periodeAktif = \App\Models\PeriodeBantuan::aktif()->first();
        $anggota = \App\Models\Anggota::where('user_id', auth()->id())->first();
    @endphp

    @if(!$periodeAktif)
    {{-- ========================================
         TIDAK ADA PERIODE AKTIF - REDESIGNED
    ======================================== --}}
    <div class="no-period-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="no-period-card">
                        <div class="calendar-icon-wrapper">
                            <i class="fas fa-calendar-times calendar-icon-large"></i>
                        </div>
                        
                        <div class="no-period-content">
                            <h1 class="no-period-title">
                                Belum Ada Periode Bantuan Aktif
                            </h1>
                            
                            <p class="no-period-text">
                                Saat ini belum ada periode penerimaan pengajuan bantuan yang dibuka oleh admin.<br>
                                <strong>Jangan khawatir!</strong> Anda akan mendapat notifikasi otomatis ketika periode baru dibuka.
                            </p>
                            
                            <div class="info-badge">
                                <div class="info-badge-icon">
                                    <i class="fas fa-bell fa-2x text-white"></i>
                                </div>
                                <h5 class="mb-2 font-weight-bold" style="color: #1a3a6e;">Notifikasi Otomatis</h5>
                                <p class="mb-0" style="color: #64748b; font-size: 14px;">
                                    Kami akan mengirimkan pemberitahuan langsung ke akun Anda<br>
                                    segera setelah admin membuka periode bantuan baru
                                </p>
                            </div>
                            
                            <div class="mt-5">
                                <a href="{{ route('anggota.dashboard') }}" class="btn btn-back-home">
                                    <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                                </a>
                            </div>
                            
                            <div class="mt-4">
                                <small style="color: rgba(255,255,255,0.8); font-size: 13px;">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Hubungi admin jika Anda memiliki pertanyaan
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    {{-- ========================================
         ADA PERIODE AKTIF
    ======================================== --}}
    
    {{-- Info Periode --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card period-card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3">
                                <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="font-weight-bold mb-1">{{ $periodeAktif->nama_periode }}</h3>
                                    @if($periodeAktif->deskripsi)
                                    <p class="mb-0 opacity-75">{{ $periodeAktif->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-calendar-alt fa-2x me-3 opacity-75"></i>
                                        <div>
                                            <small class="d-block opacity-75" style="font-size: 12px;">Periode Pendaftaran</small>
                                            <strong style="font-size: 16px;">
                                                {{ $periodeAktif->tanggal_mulai->format('d M Y') }} - 
                                                {{ $periodeAktif->tanggal_selesai->format('d M Y') }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                @if($periodeAktif->kuota_penerima)
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users fa-2x me-3 opacity-75"></i>
                                        <div>
                                            <small class="d-block opacity-75" style="font-size: 12px;">Kuota Tersedia</small>
                                            <strong style="font-size: 16px;">
                                                {{ $periodeAktif->sisaKuota() }} / {{ $periodeAktif->kuota_penerima }} orang
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-4 text-center mt-4 mt-lg-0">
                            <div class="countdown-box">
                                <div class="countdown-number">
                                    {{ $periodeAktif->tanggal_selesai->diffInDays(now()) }}
                                </div>
                                <p class="mb-0 mt-2" style="color: #64748b; font-weight: 600; font-size: 14px;">
                                    Hari Tersisa
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $sudahMengajukan = \App\Models\PengajuanBantuan::where('anggota_id', $anggota->id)
            ->where('periode_bantuan_id', $periodeAktif->id)
            ->exists();
    @endphp

    @if($sudahMengajukan)
    {{-- ========================================
         SUDAH MENGAJUKAN
    ======================================== --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card status-card">
                <div class="text-center">
                    <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-check-circle fa-4x"></i>
                    </div>
                    <h3 class="font-weight-bold mb-3">Pengajuan Anda Sudah Tercatat!</h3>
                    <p class="mb-4" style="font-size: 16px; opacity: 0.95;">
                        Terima kasih telah mengajukan kebutuhan bantuan untuk periode ini.<br>
                        Silakan tunggu proses verifikasi dari admin kami.
                    </p>
                    <div class="alert alert-light d-inline-block">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        <strong>Status:</strong> <span class="badge badge-warning">Menunggu Verifikasi</span>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('anggota.dashboard') }}" class="btn btn-light btn-lg" style="border-radius: 12px; padding: 15px 40px; font-weight: 700;">
                            <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @elseif($periodeAktif->kuota_penerima && $periodeAktif->sisaKuota() <= 0)
    {{-- ========================================
         KUOTA HABIS
    ======================================== --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card warning-card">
                <div class="text-center">
                    <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-exclamation-triangle fa-4x"></i>
                    </div>
                    <h3 class="font-weight-bold mb-3">Kuota Sudah Penuh</h3>
                    <p class="mb-4" style="font-size: 16px; opacity: 0.95;">
                        Maaf, kuota penerima bantuan untuk periode ini sudah terpenuhi.<br>
                        Silakan tunggu pengumuman periode berikutnya.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('anggota.dashboard') }}" class="btn btn-light btn-lg" style="border-radius: 12px; padding: 15px 40px; font-weight: 700;">
                            <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @else
    {{-- ========================================
         FORM PENGAJUAN
    ======================================== --}}
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card form-card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Form Pengajuan Kebutuhan Bantuan
                    </h4>
                    <p class="mb-0 mt-2 opacity-75" style="font-size: 14px;">
                        Isi formulir di bawah ini dengan lengkap dan benar
                    </p>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('anggota.kebutuhan-bantuan.store') }}" method="POST">
                        @csrf
                        
                        <div class="alert alert-info" style="border-radius: 12px; border-left: 5px solid #3b82f6;">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Informasi:</strong> Pastikan semua data yang Anda isi sudah benar dan lengkap sebelum mengirim pengajuan.
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user text-primary me-1"></i>
                                        Nama Pemohon <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="nama_pemohon" 
                                           class="form-control @error('nama_pemohon') is-invalid @enderror" 
                                           value="{{ old('nama_pemohon', $anggota->nama) }}"
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                    @error('nama_pemohon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-phone text-success me-1"></i>
                                        No. HP <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="no_hp" 
                                           class="form-control @error('no_hp') is-invalid @enderror" 
                                           value="{{ old('no_hp', $anggota->no_hp) }}"
                                           placeholder="08xxxxxxxxxx"
                                           required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-envelope text-danger me-1"></i>
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $anggota->email) }}"
                                           placeholder="email@example.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-store text-info me-1"></i>
                                Nama Usaha <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_usaha" 
                                   class="form-control @error('nama_usaha') is-invalid @enderror" 
                                   value="{{ old('nama_usaha', $anggota->nama_usaha) }}"
                                   placeholder="Nama usaha/koperasi Anda"
                                   required>
                            @error('nama_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-hand-holding-usd text-warning me-1"></i>
                                        Jenis Bantuan <span class="text-danger">*</span>
                                    </label>
                                    <select name="jenis_bantuan" 
                                            class="form-control @error('jenis_bantuan') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Pilih Jenis Bantuan --</option>
                                        <option value="Modal Usaha" {{ old('jenis_bantuan')=='Modal Usaha'?'selected':'' }}>💰 Modal Usaha</option>
                                        <option value="Peralatan" {{ old('jenis_bantuan')=='Peralatan'?'selected':'' }}>🛠️ Peralatan</option>
                                        <option value="Pelatihan" {{ old('jenis_bantuan')=='Pelatihan'?'selected':'' }}>📚 Pelatihan</option>
                                        <option value="Lainnya" {{ old('jenis_bantuan')=='Lainnya'?'selected':'' }}>📦 Lainnya</option>
                                    </select>
                                    @error('jenis_bantuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-money-bill-wave text-success me-1"></i>
                                        Jumlah Bantuan Diajukan (Rp) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           name="jumlah_diajukan" 
                                           class="form-control @error('jumlah_diajukan') is-invalid @enderror" 
                                           value="{{ old('jumlah_diajukan') }}"
                                           min="0"
                                           step="100000"
                                           placeholder="Contoh: 5000000"
                                           required>
                                    @error('jumlah_diajukan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-clipboard-list text-purple me-1"></i>
                                Tujuan Penggunaan <span class="text-danger">*</span>
                            </label>
                            <textarea name="tujuan_penggunaan" 
                                      class="form-control @error('tujuan_penggunaan') is-invalid @enderror" 
                                      rows="5"
                                      placeholder="Jelaskan secara detail untuk apa bantuan ini akan digunakan. Contoh: Untuk membeli mesin produksi, renovasi toko, membeli bahan baku, dll."
                                      required>{{ old('tujuan_penggunaan') }}</textarea>
                            @error('tujuan_penggunaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb me-1"></i>
                                Semakin detail penjelasan Anda, semakin mudah proses verifikasi
                            </small>
                        </div>

                        <div class="alert alert-warning" style="border-radius: 12px; border-left: 5px solid #f59e0b;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong> Pastikan data yang Anda isi sudah benar. Pengajuan yang sudah dikirim tidak dapat diubah atau dibatalkan.
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-primary btn-submit text-white">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pengajuan
                            </button>
                            <a href="{{ route('anggota.dashboard') }}" class="btn btn-secondary btn-lg" style="border-radius: 12px; padding: 15px 40px; font-weight: 700;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
</div>
@endsection
