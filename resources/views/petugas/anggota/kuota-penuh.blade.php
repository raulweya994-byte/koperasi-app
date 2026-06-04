@extends('layouts.app')
@section('title', 'Kuota Pendaftaran Penuh')

@push('styles')
<style>
.quota-container {
    min-height: 75vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
}

.quota-card {
    max-width: 650px;
    width: 100%;
    background: white;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
    overflow: hidden;
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.quota-header {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    padding: 50px 35px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}

.quota-header::before {
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

.quota-icon {
    width: 110px;
    height: 110px;
    background: rgba(255,255,255,0.25);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    animation: pulse 2.5s ease-in-out infinite;
    position: relative;
    z-index: 1;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    50% {
        transform: scale(1.08);
        box-shadow: 0 12px 35px rgba(0,0,0,0.25);
    }
}

.quota-icon i {
    font-size: 55px;
}

.quota-header h2 {
    font-size: 30px;
    font-weight: 800;
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.quota-header p {
    font-size: 17px;
    opacity: 0.95;
    margin: 0;
    position: relative;
    z-index: 1;
}

.quota-body {
    padding: 45px 35px;
    text-align: center;
}

.quota-body h4 {
    color: #1f2937;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 18px;
}

.quota-body p {
    color: #6b7280;
    font-size: 16px;
    line-height: 1.9;
    margin-bottom: 30px;
}

.periode-info {
    background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
    border-left: 5px solid #667eea;
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 30px;
    text-align: left;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
}

.periode-info h5 {
    color: #1e40af;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.periode-info h5 i {
    margin-right: 10px;
    font-size: 18px;
}

.periode-info .info-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid rgba(102, 126, 234, 0.1);
}

.periode-info .info-row:last-child {
    border-bottom: none;
}

.periode-info .info-label {
    color: #4338ca;
    font-weight: 600;
    font-size: 14px;
}

.periode-info .info-value {
    color: #1e40af;
    font-weight: 700;
    font-size: 14px;
}

.info-box {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-left: 5px solid #f59e0b;
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 30px;
    text-align: left;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.15);
}

.info-box .info-header {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.info-box i {
    color: #f59e0b;
    font-size: 24px;
    margin-right: 12px;
}

.info-box strong {
    color: #92400e;
    font-size: 16px;
    font-weight: 700;
}

.info-box p {
    color: #78350f;
    margin: 0;
    font-size: 15px;
    line-height: 1.7;
}

.btn-back {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    border-radius: 14px;
    padding: 16px 36px;
    font-weight: 700;
    font-size: 16px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-back:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
    color: white;
    text-decoration: none;
}

.btn-back i {
    margin-right: 10px;
}

@media (max-width: 768px) {
    .quota-header {
        padding: 40px 25px;
    }
    
    .quota-icon {
        width: 90px;
        height: 90px;
    }
    
    .quota-icon i {
        font-size: 45px;
    }
    
    .quota-header h2 {
        font-size: 24px;
    }
    
    .quota-body {
        padding: 35px 25px;
    }
}
</style>
@endpush

@section('content')
<div class="quota-container">
    <div class="quota-card">
        <div class="quota-header">
            <div class="quota-icon">
                <i class="fas fa-users-slash"></i>
            </div>
            <h2>Kuota Pendaftaran Penuh</h2>
            <p>Maaf, kuota pendaftaran periode ini sudah terpenuhi</p>
        </div>
        
        <div class="quota-body">
            <h4>⚠️ Pendaftaran Tidak Dapat Dilanjutkan</h4>
            <p>Kuota pendaftaran anggota untuk periode ini telah mencapai batas maksimal. Silakan tunggu periode pendaftaran berikutnya atau hubungi admin untuk menambah kuota.</p>
            
            <div class="periode-info">
                <h5><i class="fas fa-calendar-alt"></i>Informasi Periode Aktif</h5>
                <div class="info-row">
                    <span class="info-label">Nama Periode:</span>
                    <span class="info-value">{{ $periodeAktif->nama_periode }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tahun Ajaran:</span>
                    <span class="info-value">{{ $periodeAktif->tahun_ajaran }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Periode:</span>
                    <span class="info-value">
                        {{ $periodeAktif->tanggal_mulai->format('d M Y') }} - 
                        {{ $periodeAktif->tanggal_selesai->format('d M Y') }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kuota Total:</span>
                    <span class="info-value">{{ $periodeAktif->kuota }} orang</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jumlah Pendaftar:</span>
                    <span class="info-value">{{ $periodeAktif->jumlah_pendaftar }} orang</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Sisa Kuota:</span>
                    <span class="info-value" style="color: #dc2626;">0 orang (PENUH)</span>
                </div>
            </div>

            <div class="info-box">
                <div class="info-header">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Solusi</strong>
                </div>
                <p>Admin dapat menambah kuota pendaftaran melalui menu <strong>"Periode Pendaftaran"</strong> dengan mengedit periode yang sedang aktif. Atau tunggu hingga admin membuka periode pendaftaran baru dengan kuota yang lebih besar.</p>
            </div>
            
            <a href="{{ route('petugas.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
