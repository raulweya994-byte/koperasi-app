@extends('layouts.anggota')

@section('title', 'Pendaftaran Ditolak')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Card Status Ditolak -->
            <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                <!-- Header dengan Gradient Merah -->
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                    <div class="mb-3">
                        <div class="status-icon-wrapper">
                            <i class="fas fa-times-circle fa-4x shake-animation"></i>
                        </div>
                    </div>
                    <h2 class="mb-2 font-weight-bold">Pendaftaran Ditolak</h2>
                    <p class="mb-0" style="font-size: 1.1rem;">Mohon maaf, pendaftaran Anda tidak dapat diproses</p>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <!-- Alert Ditolak -->
                    <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 10px;">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                            <div class="flex-grow-1">
                                <h5 class="mb-2 font-weight-bold">Alasan Penolakan:</h5>
                                <p class="mb-0" style="font-size: 1.05rem;">
                                    @if($anggota->catatan_admin)
                                        {{ $anggota->catatan_admin }}
                                    @else
                                        Data yang Anda berikan tidak memenuhi persyaratan yang ditentukan. Silakan hubungi admin untuk informasi lebih lanjut.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pendaftaran -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-id-card text-danger mr-2"></i>
                                <div>
                                    <small class="text-muted d-block">No. Anggota</small>
                                    <strong class="text-danger" style="font-size: 1.1rem;">{{ $anggota->no_anggota }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-user text-secondary mr-2"></i>
                                <div>
                                    <small class="text-muted d-block">Nama Lengkap</small>
                                    <strong>{{ $anggota->nama }}</strong>
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

                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-clock text-danger mr-2"></i>
                                <div>
                                    <small class="text-muted d-block">Tanggal Ditolak</small>
                                    <strong>{{ $anggota->tanggal_verifikasi ? $anggota->tanggal_verifikasi->format('d M Y, H:i') : '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Langkah Selanjutnya -->
                    <div class="mt-4 p-4" style="background: #f8f9fa; border-radius: 10px;">
                        <h5 class="font-weight-bold mb-3"><i class="fas fa-lightbulb mr-2 text-warning"></i>Apa yang Harus Dilakukan?</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="action-card">
                                    <div class="action-icon bg-primary">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h6 class="font-weight-bold mt-3">Hubungi Admin</h6>
                                    <p class="text-muted small mb-0">Tanyakan detail alasan penolakan dan persyaratan yang diperlukan</p>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="action-card">
                                    <div class="action-icon bg-success">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <h6 class="font-weight-bold mt-3">Lengkapi Dokumen</h6>
                                    <p class="text-muted small mb-0">Siapkan dokumen dan data yang sesuai dengan persyaratan</p>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="action-card">
                                    <div class="action-icon bg-warning">
                                        <i class="fas fa-redo"></i>
                                    </div>
                                    <h6 class="font-weight-bold mt-3">Daftar Ulang</h6>
                                    <p class="text-muted small mb-0">Setelah melengkapi persyaratan, Anda dapat mendaftar kembali</p>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="action-card">
                                    <div class="action-icon bg-info">
                                        <i class="fas fa-question-circle"></i>
                                    </div>
                                    <h6 class="font-weight-bold mt-3">Minta Bantuan</h6>
                                    <p class="text-muted small mb-0">Tim kami siap membantu Anda melalui chat atau telepon</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak Informasi -->
                    <div class="alert alert-info border-0 shadow-sm mt-4" style="border-radius: 10px;">
                        <div class="text-center">
                            <h6 class="font-weight-bold mb-3"><i class="fas fa-headset mr-2"></i>Hubungi Kami</h6>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <i class="fas fa-phone text-primary mr-2"></i>
                                    <strong>0812-3456-7890</strong>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <i class="fas fa-envelope text-success mr-2"></i>
                                    <strong>support@disperindagkop.go.id</strong>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <i class="fab fa-whatsapp text-success mr-2"></i>
                                    <strong>0812-3456-7890</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        <a href="{{ route('anggota.profil') }}" class="btn btn-outline-primary btn-lg px-5 mb-2" style="border-radius: 25px;">
                            <i class="fas fa-user mr-2"></i>Lihat Data Profil
                        </a>
                        <a href="{{ route('anggota.chat.index') }}" class="btn btn-primary btn-lg px-5 mb-2" style="border-radius: 25px;">
                            <i class="fas fa-comments mr-2"></i>Chat dengan Admin
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-lg px-5 mb-2" style="border-radius: 25px;">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-2"></i>
                        Anda dapat mendaftar ulang setelah melengkapi persyaratan yang diperlukan
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Shake Animation */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.shake-animation {
    animation: shake 0.5s;
    animation-iteration-count: 1;
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

/* Action Card */
.action-card {
    text-align: center;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.action-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header h2 {
        font-size: 1.5rem;
    }
    
    .btn-lg {
        font-size: 0.9rem;
        padding: 10px 20px !important;
        display: block;
        width: 100%;
    }
}
</style>
@endsection
