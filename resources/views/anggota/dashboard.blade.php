@extends('layouts.anggota')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
<style>
    /* Stats Card */
    .stats-card {
        border-radius: 16px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        height: 100%;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .stats-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* Alert Custom */
    .alert-custom {
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    /* Badge */
    .badge-lg {
        font-size: 13px;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 8px;
    }

    /* Pulse animation */
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.9;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-card {
            margin-bottom: 15px;
        }
        
        .alert-custom .d-flex {
            flex-direction: column !important;
        }
        
        .alert-custom .d-flex > div:first-child {
            margin-bottom: 15px !important;
            margin-right: 0 !important;
        }
    }
</style>
@endpush

@section('content')
{{-- Dashboard Anggota - Updated: <?php echo date('Y-m-d H:i:s'); ?> --}}
<div class="container-fluid">
    
    {{-- Welcome Message untuk Pendaftar Baru --}}
    @if(session('welcome'))
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-success alert-custom" style="border-left: 5px solid #27ae60;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="d-flex align-items-center">
                    <div style="width: 60px; height: 60px; background: #27ae60; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                        <i class="fas fa-check-circle fa-2x text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-2"><i class="fas fa-party-horn mr-2"></i>Selamat Datang di Portal Anggota!</h5>
                        <p class="mb-2">{{ session('success') }}</p>
                        <div class="mt-2">
                            <span class="badge badge-primary badge-lg">
                                <i class="fas fa-id-card mr-1"></i> No. Anggota: {{ session('no_anggota') }}
                            </span>
                            <span class="badge badge-info badge-lg ml-2">
                                <i class="fas fa-envelope mr-1"></i> {{ session('email') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Status Verifikasi - PENDING --}}
    @if($anggota->status === 'Pending')
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-warning alert-custom" style="border-left: 5px solid #f39c12; background: linear-gradient(135deg, #fff9e6 0%, #ffffff 100%);">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="d-flex align-items-start">
                    <div style="width: 60px; height: 60px; background: #f39c12; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0;">
                        <i class="fas fa-clock fa-2x text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-2"><i class="fas fa-hourglass-half mr-2"></i>Pendaftaran Sedang Diproses</h5>
                        <p class="mb-2" style="font-size: 14px;">
                            Terima kasih telah mendaftar! Pendaftaran Anda sedang dalam proses verifikasi oleh admin kami. 
                            Kami akan mengirimkan notifikasi segera setelah proses verifikasi selesai.
                        </p>
                        <div class="alert alert-light mb-0 mt-3" style="border-left: 3px solid #f39c12; border-radius: 8px;">
                            <small>
                                <i class="fas fa-info-circle mr-1"></i>
                                <strong>Catatan:</strong> Anda tetap dapat mengakses semua fitur portal anggota sambil menunggu hasil verifikasi.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Status Verifikasi - DITOLAK --}}
    @if($anggota->status === 'Ditolak')
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-danger alert-custom" style="border-left: 5px solid #e74c3c; background: linear-gradient(135deg, #ffe6e6 0%, #ffffff 100%);">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="d-flex align-items-start">
                    <div style="width: 60px; height: 60px; background: #e74c3c; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0;">
                        <i class="fas fa-times-circle fa-2x text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Pendaftaran Belum Disetujui</h5>
                        <p class="mb-2" style="font-size: 14px;">
                            Mohon maaf, pendaftaran Anda belum dapat disetujui pada periode ini.
                        </p>
                        @if($anggota->catatan_admin)
                        <div class="alert alert-light mb-3" style="border-left: 3px solid #e74c3c; border-radius: 8px;">
                            <strong><i class="fas fa-comment-alt mr-1"></i> Alasan:</strong><br>
                            <span style="font-size: 14px;">{{ $anggota->catatan_admin }}</span>
                        </div>
                        @endif
                        
                        @php
                            $periodeBuka = \App\Models\PeriodePendaftaran::where('status', 'aktif')
                                ->where('tanggal_mulai', '<=', now())
                                ->where('tanggal_selesai', '>=', now())
                                ->first();
                        @endphp
                        
                        <div class="alert alert-info mb-0" style="border-left: 3px solid #3498db; border-radius: 8px;">
                            <small>
                                <i class="fas fa-lightbulb mr-1"></i>
                                <strong>Catatan:</strong> Akun Anda tetap aktif. Anda dapat memperbaiki data melalui menu "Lengkapi Data" di sidebar atau hubungi admin untuk informasi lebih lanjut.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Status Verifikasi - LULUS (Baru Diterima dalam 7 hari) --}}
    @if($anggota->status === 'Aktif' && $anggota->tanggal_verifikasi && $anggota->tanggal_verifikasi->diffInDays(now()) < 7)
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-success alert-custom" style="border-left: 5px solid #27ae60; background: linear-gradient(135deg, #e6f9f0 0%, #ffffff 100%);">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="d-flex align-items-start">
                    <div style="width: 60px; height: 60px; background: #27ae60; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0; animation: pulse 2s infinite;">
                        <i class="fas fa-check-circle fa-2x text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-2">🎉 Selamat! Pendaftaran Anda LULUS!</h5>
                        <p class="mb-2" style="font-size: 14px;">
                            Kami dengan senang hati mengumumkan bahwa pendaftaran Anda telah <strong>DISETUJUI</strong> sebagai Anggota Koperasi resmi!
                        </p>
                        <div class="alert alert-light mb-3" style="border-left: 3px solid #27ae60; border-radius: 8px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><i class="fas fa-id-card mr-1"></i> No. Anggota:</strong><br>
                                    <span class="badge badge-success badge-lg mt-1">{{ $anggota->no_anggota }}</span>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-calendar-check mr-1"></i> Tanggal Verifikasi:</strong><br>
                                    <span class="badge badge-info badge-lg mt-1">{{ $anggota->tanggal_verifikasi->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mb-0" style="border-left: 3px solid #3498db; border-radius: 8px;">
                            <small>
                                <i class="fas fa-star mr-1"></i>
                                <strong>Selamat Bergabung!</strong> Anda sekarang dapat mengakses semua layanan koperasi, termasuk simpanan, pinjaman, dan program lainnya.
                                Silakan cek <a href="{{ route('anggota.kartu') }}" class="alert-link">Kartu Anggota</a> Anda.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="row">
        <!-- Usaha Saya -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card stats-card">
                <div class="card-body text-center p-4">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                        <i class="fas fa-store fa-2x text-white"></i>
                    </div>
                    <h6 class="text-muted mb-2" style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Usaha Saya</h6>
                    <h5 class="font-weight-bold mb-2" style="color: #2c3e50; font-size: 18px;">{{ $anggota->nama_usaha }}</h5>
                    <p class="text-muted mb-1" style="font-size: 13px;">
                        <i class="fas fa-briefcase mr-1"></i>{{ $anggota->bidang_usaha ?? 'Perdagangan / Jasa / Industri' }}
                    </p>
                    <p class="text-muted mb-0" style="font-size: 13px;">
                        <i class="fas fa-chart-line mr-1"></i><strong>Omzet:</strong> Rp {{ number_format($anggota->omzet_per_bulan ?? 0, 2, ',', '.') }}/bln
                    </p>
                </div>
            </div>
        </div>

        <!-- Modal Usaha -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card stats-card">
                <div class="card-body text-center p-4">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #27ae60, #229954);">
                        <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                    </div>
                    <h6 class="text-muted mb-2" style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Modal Usaha</h6>
                    <h5 class="font-weight-bold mb-2" style="color: #2c3e50; font-size: 18px;">Rp {{ number_format($anggota->modal_usaha ?? 0, 2, ',', '.') }}</h5>
                    <p class="text-muted mb-0" style="font-size: 13px;">
                        <i class="fas fa-wallet mr-1"></i>Modal Awal Usaha
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Simpanan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card stats-card">
                <div class="card-body text-center p-4">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                        <i class="fas fa-piggy-bank fa-2x text-white"></i>
                    </div>
                    <h6 class="text-muted mb-2" style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Simpanan</h6>
                    <h5 class="font-weight-bold mb-2" style="color: #2c3e50; font-size: 18px;">Rp {{ number_format($anggota->total_simpanan ?? 0, 0, ',', '.') }}</h5>
                    <div class="mt-3" style="font-size: 11px; text-align: left; background: #f8f9fa; padding: 12px; border-radius: 8px;">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted"><i class="fas fa-circle text-success mr-1" style="font-size: 8px;"></i>Pokok:</span>
                            <strong class="text-success">Rp {{ number_format($simpananPokok ?? 0, 0, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted"><i class="fas fa-circle text-primary mr-1" style="font-size: 8px;"></i>Wajib:</span>
                            <strong class="text-primary">Rp {{ number_format($simpananWajib ?? 0, 0, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted"><i class="fas fa-circle text-warning mr-1" style="font-size: 8px;"></i>Sukarela:</span>
                            <strong class="text-warning">Rp {{ number_format($simpananSukarela ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Jadwal Kegiatan Section --}}
    @if($jadwal->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card" style="border-radius: 16px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                <div class="card-header bg-white" style="border-radius: 16px 16px 0 0; border-bottom: 2px solid #f0f0f0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-calendar-alt mr-2" style="color: #667eea;"></i>Jadwal Kegiatan
                        </h5>
                        <a href="{{ route('anggota.jadwal') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                            <i class="fas fa-eye mr-1"></i>Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        @foreach($jadwal as $item)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100" style="border-radius: 12px; border: 1px solid #e0e0e0; transition: all 0.3s ease;">
                                <div class="card-body p-3">
                                    <div class="d-flex">
                                        <div class="mr-3 text-center" style="min-width: 60px;">
                                            <div style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 10px; padding: 8px;">
                                                <div style="font-size: 20px; font-weight: bold; line-height: 1;">
                                                    {{ $item->tanggal->format('d') }}
                                                </div>
                                                <div style="font-size: 11px; text-transform: uppercase;">
                                                    {{ $item->tanggal->format('M') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="font-weight-bold mb-1" style="font-size: 14px; color: #2c3e50;">
                                                {{ $item->judul }}
                                            </h6>
                                            <p class="text-muted mb-2" style="font-size: 12px;">
                                                <i class="fas fa-clock mr-1"></i>{{ substr($item->jam_mulai, 0, 5) }}
                                                @if($item->jam_selesai)
                                                    - {{ substr($item->jam_selesai, 0, 5) }}
                                                @endif
                                            </p>
                                            @if($item->lokasi)
                                            <p class="text-muted mb-2" style="font-size: 12px;">
                                                <i class="fas fa-map-marker-alt mr-1"></i>{{ Str::limit($item->lokasi, 30) }}
                                            </p>
                                            @endif
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="badge badge-{{ $item->status_color }}" style="font-size: 10px;">
                                                    {{ $item->status_label }}
                                                </span>
                                                <span class="badge badge-light" style="font-size: 10px; border: 1px solid #e0e0e0;">
                                                    <i class="fas fa-tag mr-1"></i>{{ $item->jenis_label }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
// Script untuk animasi atau fitur lain jika diperlukan
</script>
@endpush
@endsection
