@extends('layouts.app')
@section('title', 'Pendaftaran Sedang Ditutup')

@push('styles')
<style>
.closed-container {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}
.closed-card {
    max-width: 700px;
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    background: white;
}
.closed-header {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    padding: 50px 30px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}
.closed-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}
.closed-icon {
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
.closed-icon i {
    font-size: 48px;
}
.closed-body {
    padding: 40px 30px;
}
.info-box {
    background: #fef3c7;
    border-left: 4px solid #f59e0b;
    padding: 20px;
    border-radius: 8px;
    margin: 25px 0;
}
.info-box i {
    color: #f59e0b;
    font-size: 20px;
    margin-right: 10px;
}
.steps-list {
    list-style: none;
    padding: 0;
    margin: 25px 0;
}
.steps-list li {
    padding: 12px 0;
    padding-left: 35px;
    position: relative;
    color: #4b5563;
    line-height: 1.6;
}
.steps-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 18px;
    width: 20px;
    height: 20px;
    background: #3b82f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.steps-list li::after {
    content: attr(data-number);
    position: absolute;
    left: 6px;
    top: 18px;
    color: white;
    font-size: 11px;
    font-weight: 700;
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
            <h2 class="mb-2" style="font-size: 1.8rem; font-weight: 700;">Pendaftaran Sedang Ditutup</h2>
            <p class="mb-0" style="font-size: 1rem; opacity: 0.95;">Maaf, saat ini pendaftaran anggota baru belum dibuka</p>
        </div>
        
        <div class="closed-body">
            <div class="alert alert-danger" style="border-radius: 12px; border: none; background: #fee2e2; color: #991b1b;">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Tidak Ada Periode Pendaftaran Aktif</strong>
                <p class="mb-0 mt-2">Pendaftaran anggota koperasi baru sementara ditutup. Admin perlu membuka periode pendaftaran terlebih dahulu sebelum Anda dapat mendaftarkan anggota baru.</p>
            </div>

            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <strong>Informasi Periode Pendaftaran</strong>
                <p class="mb-0 mt-2">Admin dapat membuka periode pendaftaran melalui menu <strong>"Periode Pendaftaran"</strong> di dashboard admin. Setelah periode dibuka dan diaktifkan, form pendaftaran akan otomatis tersedia untuk Anda.</p>
            </div>

            <h5 class="mt-4 mb-3" style="color: #1f2937; font-weight: 600;">
                <i class="fas fa-clipboard-list mr-2" style="color: #3b82f6;"></i>
                Langkah untuk Admin:
            </h5>
            <ol class="steps-list">
                <li data-number="1">Login sebagai Admin ke dashboard</li>
                <li data-number="2">Buka menu <strong>"Periode Pendaftaran"</strong> di dashboard admin</li>
                <li data-number="3">Klik <strong>"Tambah Periode Baru"</strong></li>
                <li data-number="4">Isi data periode (nama, tanggal mulai, tanggal berakhir, kuota)</li>
                <li data-number="5">Aktifkan periode pendaftaran</li>
                <li data-number="6">Form pendaftaran akan otomatis tersedia untuk Anda</li>
            </ol>

            <div class="text-center mt-4">
                <a href="{{ route('pimpinan.dashboard') }}" class="btn btn-primary btn-lg" style="border-radius: 10px; padding: 12px 40px; font-weight: 600;">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
