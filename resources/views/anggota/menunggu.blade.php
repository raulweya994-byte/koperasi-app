@extends('layouts.anggota')

@section('title', 'Menunggu Verifikasi')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Card Status Verifikasi -->
            <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                <!-- Header dengan Gradient -->
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="mb-3">
                        <div class="status-icon-wrapper">
                            <i class="fas fa-clock fa-4x pulse-animation"></i>
                        </div>
                    </div>
                    <h2 class="mb-2 font-weight-bold">Menunggu Verifikasi</h2>
                    <p class="mb-0" style="font-size: 1.1rem;">Pendaftaran Anda sedang ditinjau oleh tim kami</p>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    @if($anggota)
                    <!-- Informasi Pendaftaran -->
                    <div class="alert alert-info border-0 shadow-sm" style="border-radius: 10px;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fa-2x mr-3"></i>
                            <div>
                                <h5 class="mb-1 font-weight-bold">Informasi Pendaftaran Anda</h5>
                                <p class="mb-0">Data Anda telah berhasil tersimpan dan sedang dalam proses verifikasi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pendaftaran -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-id-card text-primary mr-2"></i>
                                <div>
                                    <small class="text-muted d-block">No. Anggota</small>
                                    <strong class="text-primary" style="font-size: 1.1rem;">{{ $anggota->no_anggota }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-user text-success mr-2"></i>
                                <div>
                                    <small class="text-muted d-block">Nama Lengkap</small>
                                    <strong>{{ $anggota->nama }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-phone text-info mr-2"></i>
                                <div>
                                    <small class="text-muted d-block">No. HP</small>
                                    <strong>{{ $anggota->no_hp }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-calendar text-warning mr-2"></i>
                                <div>
                                    <small class="text-muted d-block">Tanggal Daftar</small>
                                    <strong>{{ $anggota->created_at->format('d M Y, H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Proses -->
                    <div class="mt-4 p-4" style="background: #f8f9fa; border-radius: 10px;">
                        <h5 class="font-weight-bold mb-4"><i class="fas fa-tasks mr-2"></i>Proses Verifikasi</h5>
                        <div class="timeline">
                            <div class="timeline-item completed">
                                <div class="timeline-marker">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="font-weight-bold">Pendaftaran Berhasil</h6>
                                    <small class="text-muted">{{ $anggota->created_at->format('d M Y, H:i') }}</small>
                                </div>
                            </div>

                            <div class="timeline-item active">
                                <div class="timeline-marker">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="font-weight-bold">Sedang Ditinjau Admin</h6>
                                    <small class="text-muted">Proses verifikasi data dan dokumen</small>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="font-weight-bold">Keputusan Verifikasi</h6>
                                    <small class="text-muted">Menunggu persetujuan admin</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="alert alert-warning border-0 shadow-sm mt-4" style="border-radius: 10px;">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                            <div>
                                <h6 class="font-weight-bold mb-2">Harap Diperhatikan:</h6>
                                <ul class="mb-0 pl-3">
                                    <li>Proses verifikasi membutuhkan waktu 1-3 hari kerja</li>
                                    <li>Pastikan nomor HP Anda aktif untuk dihubungi</li>
                                    <li>Anda akan menerima notifikasi setelah verifikasi selesai</li>
                                    <li>Periksa email dan notifikasi secara berkala</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Jika belum ada data anggota -->
                    <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 10px;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle fa-2x mr-3"></i>
                            <div>
                                <h5 class="mb-1 font-weight-bold">Data Tidak Ditemukan</h5>
                                <p class="mb-0">Silakan hubungi administrator untuk informasi lebih lanjut</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        <a href="{{ route('anggota.profil') }}" class="btn btn-outline-primary btn-lg px-5" style="border-radius: 25px;">
                            <i class="fas fa-user mr-2"></i>Lihat Data Profil
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline ml-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-lg px-5" style="border-radius: 25px;">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">
                        <i class="fas fa-phone mr-2"></i>Butuh bantuan? Hubungi kami di 
                        <strong>0812-3456-7890</strong> atau 
                        <a href="mailto:support@disperindagkop.go.id">support@disperindagkop.go.id</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Pulse Animation */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
}

.pulse-animation {
    animation: pulse 2s infinite;
}

/* Info Item */
.info-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.info-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.info-item i {
    font-size: 1.5rem;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 40px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -32px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

.timeline-item.active .timeline-marker {
    background: #ffc107;
    border-color: #ffc107;
    color: white;
    animation: pulse 2s infinite;
}

.timeline-content h6 {
    margin-bottom: 5px;
    color: #495057;
}

.timeline-item.completed .timeline-content h6 {
    color: #28a745;
}

.timeline-item.active .timeline-content h6 {
    color: #ffc107;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header h2 {
        font-size: 1.5rem;
    }
    
    .btn-lg {
        font-size: 0.9rem;
        padding: 10px 20px !important;
    }
}
</style>
@endsection
