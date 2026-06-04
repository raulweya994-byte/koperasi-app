@extends('layouts.app')
@section('title','Laporan')
@section('page-title','Laporan')
@section('breadcrumb')<li class="breadcrumb-item active">Laporan</li>@endsection

@push('styles')
<style>
    /* Modern Stats Card */
    .stats-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        background: white;
        margin-bottom: 20px;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .stats-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-bottom: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .stats-icon-wrapper.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .stats-icon-wrapper.success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }
    
    .stats-icon-wrapper.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .stats-icon-wrapper.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .stats-label {
        font-size: 13px;
        color: #7a92ab;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .stats-number {
        font-size: 36px;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1;
    }
    
    /* Report Card */
    .report-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        background: white;
        margin-bottom: 25px;
        position: relative;
    }
    
    .report-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }
    
    .report-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 35px rgba(0,0,0,0.15);
    }
    
    .report-card-body {
        padding: 35px 25px;
        text-align: center;
    }
    
    .report-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        position: relative;
        animation: pulse-icon 2s infinite;
    }
    
    @keyframes pulse-icon {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .report-icon.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
    
    .report-icon.success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(17, 153, 142, 0.4);
    }
    
    .report-title {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        letter-spacing: 0.3px;
    }
    
    .report-description {
        font-size: 13px;
        color: #7a92ab;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    /* Modern Buttons */
    .btn-modern {
        padding: 12px 28px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        letter-spacing: 0.3px;
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }
    
    .btn-modern:active {
        transform: translateY(0);
    }
    
    .btn-modern i {
        margin-right: 8px;
        font-size: 16px;
    }
    
    .btn-excel {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }
    
    .btn-excel:hover {
        background: linear-gradient(135deg, #0d7a6f 0%, #2dd46a 100%);
        color: white;
    }
    
    .btn-pdf {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .btn-pdf:hover {
        background: linear-gradient(135deg, #e67ff0 0%, #f03d54 100%);
        color: white;
    }
    
    .btn-word {
        background: linear-gradient(135deg, #2b5797 0%, #4a90e2 100%);
        color: white;
    }
    
    .btn-word:hover {
        background: linear-gradient(135deg, #1e4278 0%, #3a7bc8 100%);
        color: white;
    }
    
    .btn-view {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .btn-view:hover {
        background: linear-gradient(135deg, #3a98e8 0%, #00d8e8 100%);
        color: white;
    }
    
    /* Loading Animation */
    .btn-modern.loading {
        pointer-events: none;
        opacity: 0.7;
    }
    
    .btn-modern.loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.6s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* Section Title */
    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
        display: inline-block;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .report-card-body {
            padding: 25px 15px;
        }
        
        .btn-modern {
            padding: 10px 20px;
            font-size: 13px;
            margin: 3px;
        }
    }
</style>
@endpush

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="card-body text-center p-4">
                <div class="stats-icon-wrapper primary mx-auto">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stats-label">Total Koperasi</div>
                <div class="stats-number">{{ $stats['total_koperasi'] }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="card-body text-center p-4">
                <div class="stats-icon-wrapper success mx-auto">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-label">Terverifikasi</div>
                <div class="stats-number">{{ $stats['koperasi_verified'] }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="card-body text-center p-4">
                <div class="stats-icon-wrapper warning mx-auto">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="stats-label">Program Bantuan</div>
                <div class="stats-number">{{ $stats['total_bantuan'] }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <div class="card-body text-center p-4">
                <div class="stats-icon-wrapper info mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-label">Penerima Bantuan</div>
                <div class="stats-number">{{ $stats['penerima_bantuan'] }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Report Cards -->
<h3 class="section-title">
    <i class="fas fa-file-download mr-2"></i>Download Laporan
</h3>

<div class="row mt-4">
    <!-- Laporan Anggota -->
    <div class="col-lg-6">
        <div class="report-card">
            <div class="report-card-body">
                <div class="report-icon success">
                    <i class="fas fa-users"></i>
                </div>
                <h5 class="report-title">Laporan Pendaftaran Anggota</h5>
                <p class="report-description">
                    Download laporan lengkap data pendaftaran anggota koperasi dengan filter distrik, koperasi, dan status
                </p>
                <div class="mt-3">
                    <a href="{{ route('pimpinan.laporan.anggota') }}" 
                       class="btn btn-modern btn-view">
                        <i class="fas fa-chart-bar"></i>Buat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Rekap Laporan Anggota Koperasi -->
    <div class="col-lg-6">
        <div class="report-card">
            <div class="report-card-body">
                <div class="report-icon primary">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h5 class="report-title">Rekap Laporan Anggota Koperasi</h5>
                <p class="report-description">
                    Download rekap laporan data anggota koperasi sesuai form pendaftaran dengan filter distrik, koperasi, dan status
                </p>
                <div class="mt-3">
                    <a href="{{ route('pimpinan.laporan.koperasi') }}" 
                       class="btn btn-modern btn-view">
                        <i class="fas fa-chart-bar"></i>Buat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Laporan Bantuan -->
    <div class="col-lg-6">
        <div class="report-card">
            <div class="report-card-body">
                <div class="report-icon warning">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h5 class="report-title">Laporan Program Bantuan</h5>
                <p class="report-description">
                    Lihat detail laporan program bantuan dan penerima bantuan yang telah disalurkan
                </p>
                <div class="mt-3">
                    <a href="{{ route('pimpinan.laporan.bantuan') }}" 
                       class="btn btn-modern btn-view">
                        <i class="fas fa-eye"></i>Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function handleDownload(button, type) {
    // Tambahkan loading state
    button.classList.add('loading');
    button.style.pointerEvents = 'none';
    
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengunduh ' + type + '...';
    
    // Simulasi download (karena link akan otomatis download)
    setTimeout(() => {
        button.classList.remove('loading');
        button.style.pointerEvents = 'auto';
        button.innerHTML = originalText;
        
        // Tampilkan notifikasi sukses
        showNotification('Download ' + type + ' berhasil dimulai!', 'success');
    }, 2000);
}

function showNotification(message, type) {
    // Buat elemen notifikasi
    const notification = document.createElement('div');
    notification.className = 'alert alert-' + type + ' alert-dismissible fade show';
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    notification.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
    notification.style.borderRadius = '8px';
    notification.innerHTML = `
        <i class="fas fa-check-circle mr-2"></i>${message}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove setelah 3 detik
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endpush
