@extends('layouts.app')
@section('title', 'Pendaftaran Ditutup')

@push('styles')
<style>
.closed-container {
    min-height: 75vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
}

.closed-card {
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

.closed-header {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    padding: 50px 35px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}

.closed-header::before {
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

.closed-icon {
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

.closed-icon i {
    font-size: 55px;
}

.closed-header h2 {
    font-size: 30px;
    font-weight: 800;
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.closed-header p {
    font-size: 17px;
    opacity: 0.95;
    margin: 0;
    position: relative;
    z-index: 1;
}

.closed-body {
    padding: 45px 35px;
    text-align: center;
}

.closed-body h4 {
    color: #1f2937;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 18px;
}

.closed-body p {
    color: #6b7280;
    font-size: 16px;
    line-height: 1.9;
    margin-bottom: 30px;
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

.steps-guide {
    background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 30px;
    text-align: left;
}

.steps-guide h5 {
    color: #1e40af;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.steps-guide h5 i {
    margin-right: 10px;
    font-size: 18px;
}

.steps-guide ol {
    margin: 0;
    padding-left: 20px;
    color: #3730a3;
}

.steps-guide li {
    margin-bottom: 8px;
    font-size: 14px;
    line-height: 1.6;
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
    .closed-header {
        padding: 40px 25px;
    }
    
    .closed-icon {
        width: 90px;
        height: 90px;
    }
    
    .closed-icon i {
        font-size: 45px;
    }
    
    .closed-header h2 {
        font-size: 24px;
    }
    
    .closed-body {
        padding: 35px 25px;
    }
}
</style>
@endpush

@section('content')
<div class="closed-container">
    <div class="closed-card">
        <div class="closed-header">
            <div class="closed-icon">
                <i class="fas fa-door-closed"></i>
            </div>
            <h2>Pendaftaran Sedang Ditutup</h2>
            <p>Maaf, saat ini pendaftaran anggota baru belum dibuka</p>
        </div>
        
        <div class="closed-body">
            <h4>🚫 Tidak Ada Periode Pendaftaran Aktif</h4>
            <p>Pendaftaran anggota koperasi baru sementara ditutup. Admin perlu membuka periode pendaftaran terlebih dahulu sebelum Anda dapat mendaftarkan anggota baru.</p>
            
            <div class="info-box">
                <div class="info-header">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Informasi Penting</strong>
                </div>
                <p>Admin dapat membuka periode pendaftaran melalui menu <strong>"Periode Pendaftaran"</strong> di dashboard admin. Setelah periode dibuka dan aktif, form pendaftaran akan otomatis tersedia untuk Anda.</p>
            </div>

            <div class="steps-guide">
                <h5><i class="fas fa-clipboard-list"></i>Langkah untuk Admin:</h5>
                <ol>
                    <li>Login sebagai Admin</li>
                    <li>Buka menu <strong>"Periode Pendaftaran"</strong></li>
                    <li>Klik <strong>"Tambah Periode Baru"</strong></li>
                    <li>Isi data periode (nama, tanggal mulai/selesai, kuota)</li>
                    <li>Aktifkan periode pendaftaran</li>
                    <li>Form pendaftaran akan otomatis tersedia</li>
                </ol>
            </div>
            
            <a href="{{ route('petugas.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
