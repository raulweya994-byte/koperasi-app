@extends('layouts.app')
@section('title', 'Kuota Pendaftaran Penuh')

@push('styles')
<style>
.quota-container {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}
.quota-card {
    max-width: 700px;
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    background: white;
}
.quota-header {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    padding: 50px 30px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}
.quota-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}
.quota-icon {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    backdrop-filter: blur(10px);
}
.quota-icon i {
    font-size: 48px;
}
.quota-body {
    padding: 40px 30px;
}
.quota-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin: 25px 0;
}
.stat-box {
    background: #f3f4f6;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
}
.stat-box .label {
    font-size: 13px;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}
.stat-box .value {
    font-size: 32px;
    font-weight: 700;
    color: #1f2937;
}
.info-box {
    background: #dbeafe;
    border-left: 4px solid #3b82f6;
    padding: 20px;
    border-radius: 8px;
    margin: 25px 0;
}
.info-box i {
    color: #3b82f6;
    font-size: 20px;
    margin-right: 10px;
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
            <h2 class="mb-2" style="font-size: 1.8rem; font-weight: 700;">Kuota Pendaftaran Penuh</h2>
            <p class="mb-0" style="font-size: 1rem; opacity: 0.95;">Periode pendaftaran saat ini sudah mencapai batas maksimal</p>
        </div>
        
        <div class="quota-body">
            <div class="alert alert-warning" style="border-radius: 12px; border: none; background: #fef3c7; color: #92400e;">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <strong>Kuota Sudah Penuh</strong>
                <p class="mb-0 mt-2">Pendaftaran untuk periode <strong>{{ $periodeAktif->nama_periode }}</strong> telah mencapai kuota maksimal. Silakan tunggu periode pendaftaran berikutnya atau hubungi admin untuk menambah kuota.</p>
            </div>

            <h5 class="mt-4 mb-3" style="color: #1f2937; font-weight: 600;">
                <i class="fas fa-chart-bar mr-2" style="color: #f59e0b;"></i>
                Informasi Periode Aktif:
            </h5>

            <div class="quota-stats">
                <div class="stat-box">
                    <div class="label">Kuota Tersedia</div>
                    <div class="value" style="color: #f59e0b;">{{ $periodeAktif->kuota }}</div>
                </div>
                <div class="stat-box">
                    <div class="label">Sudah Terdaftar</div>
                    <div class="value" style="color: #ef4444;">{{ $periodeAktif->jumlah_pendaftar }}</div>
                </div>
            </div>

            <div style="background: #f9fafb; padding: 20px; border-radius: 12px; margin: 20px 0;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-weight: 600; color: #4b5563;">Periode:</span>
                    <span style="color: #1f2937;">{{ $periodeAktif->nama_periode }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-weight: 600; color: #4b5563;">Tanggal Mulai:</span>
                    <span style="color: #1f2937;">{{ \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->format('d M Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: 600; color: #4b5563;">Tanggal Berakhir:</span>
                    <span style="color: #1f2937;">{{ \Carbon\Carbon::parse($periodeAktif->tanggal_berakhir)->format('d M Y') }}</span>
                </div>
            </div>

            <div class="info-box">
                <i class="fas fa-lightbulb"></i>
                <strong>Solusi untuk Admin:</strong>
                <p class="mb-0 mt-2">Admin dapat menambah kuota periode pendaftaran melalui menu <strong>"Periode Pendaftaran"</strong> atau membuat periode pendaftaran baru dengan kuota yang lebih besar.</p>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('pimpinan.dashboard') }}" class="btn btn-secondary btn-lg" style="border-radius: 10px; padding: 12px 30px; font-weight: 600;">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
