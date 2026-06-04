@extends('public.layouts.app')
@section('title', 'Statistik Koperasi - DISPERINDAGKOP Tolikara')

@push('styles')
<style>
    .stats-hero {
        background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 100%);
        padding: 80px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .stats-hero::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(245, 166, 35, 0.1);
        top: -150px;
        right: -100px;
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .stats-hero-content {
        position: relative;
        z-index: 1;
    }
    
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
        height: 100%;
        border: 2px solid transparent;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(26, 58, 110, 0.15);
        border-color: #f5a623;
    }
    
    .stat-card-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.8rem;
    }
    
    .stat-card-icon.blue {
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        color: #f5a623;
    }
    
    .stat-card-icon.green {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .stat-card-icon.orange {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .stat-card-icon.purple {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
    }
    
    .stat-card-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a3a6e;
        margin-bottom: 8px;
    }
    
    .stat-card-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .chart-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        height: 100%;
    }
    
    .chart-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a3a6e;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f0f2f7;
    }
    
    .chart-container {
        position: relative;
        height: 350px;
    }
    
    .chart-container-small {
        position: relative;
        height: 300px;
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #1a3a6e;
        margin-bottom: 40px;
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .stat-card {
            margin-bottom: 20px;
        }
        
        .chart-container {
            height: 300px;
        }
        
        .chart-container-small {
            height: 250px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="stats-hero">
    <div class="container">
        <div class="stats-hero-content text-center">
            <div style="display: inline-block; padding: 10px 24px; background: rgba(245, 166, 35, 0.2); border-radius: 50px; color: #f5a623; font-size: 13px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 20px; border: 2px solid rgba(245, 166, 35, 0.3);">
                <i class="fas fa-chart-bar mr-2"></i>Data & Statistik
            </div>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 3rem; font-weight: 800; margin-bottom: 20px;">
                Statistik Koperasi
            </h1>
            <p style="font-size: 1.2rem; opacity: 0.9; max-width: 700px; margin: 0 auto;">
                Data dan analisis lengkap perkembangan koperasi di Kabupaten Tolikara
            </p>
        </div>
    </div>
</section>

<!-- Stats Cards -->
<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon blue">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stat-card-value">{{ number_format($stats['total_koperasi']) }}</div>
                    <div class="stat-card-label">Total Koperasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-value">{{ number_format($stats['koperasi_verified']) }}</div>
                    <div class="stat-card-label">Terverifikasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon orange">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-card-value">{{ number_format($stats['koperasi_aktif']) }}</div>
                    <div class="stat-card-label">Koperasi Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon purple">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-value">{{ number_format($stats['total_karyawan']) }}</div>
                    <div class="stat-card-label">Total Karyawan</div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon blue">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="stat-card-value">{{ number_format($stats['total_distrik']) }}</div>
                    <div class="stat-card-label">Distrik</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon green">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-card-value">{{ number_format($stats['koperasi_pending']) }}</div>
                    <div class="stat-card-label">Pending</div>
                </div>
            </div>
    </div>
</section>

<!-- Charts Section -->
<section style="padding: 80px 0;">
    <div class="container">
        <h2 class="section-title">Analisis Data Koperasi</h2>
        
        @if($stats['total_koperasi'] > 0)
        <!-- Row 1: Trend & Status -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="chart-card">
                    <h3 class="chart-card-title">
                        <i class="fas fa-chart-line mr-2" style="color: #f5a623;"></i>
                        Trend Pendaftaran Koperasi (12 Bulan Terakhir)
                    </h3>
                    <div class="chart-container">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="chart-card">
                    <h3 class="chart-card-title">
                        <i class="fas fa-tasks mr-2" style="color: #f5a623;"></i>
                        Status Verifikasi
                    </h3>
                    <div class="chart-container-small">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Row 2: Kategori & Distrik -->
        <div class="row mb-4">
            <div class="col-lg-4 mb-4">
                <div class="chart-card">
                    <h3 class="chart-card-title">
                        <i class="fas fa-layer-group mr-2" style="color: #f5a623;"></i>
                        Kategori Koperasi
                    </h3>
                    <div class="chart-container-small">
                        <canvas id="kategoriChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <div class="chart-card">
                    <h3 class="chart-card-title">
                        <i class="fas fa-map-marker-alt mr-2" style="color: #f5a623;"></i>
                        Top 10 Distrik dengan Koperasi Terbanyak
                    </h3>
                    <div class="chart-container">
                        <canvas id="distrikChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Row 3: Jenis Usaha -->
        <div class="row">
            <div class="col-12">
                <div class="chart-card">
                    <h3 class="chart-card-title">
                        <i class="fas fa-briefcase mr-2" style="color: #f5a623;"></i>
                        Top 10 Jenis Usaha Koperasi
                    </h3>
                    <div class="chart-container">
                        <canvas id="jenisChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <div style="width: 150px; height: 150px; margin: 0 auto 30px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-chart-bar" style="font-size: 4rem; color: #cbd5e1;"></i>
            </div>
            <h3 style="color: #64748b; font-weight: 700; margin-bottom: 16px; font-size: 1.5rem;">
                Belum Ada Data Koperasi
            </h3>
            <p style="color: #94a3b8; font-size: 1rem; max-width: 500px; margin: 0 auto 30px; line-height: 1.7;">
                Grafik dan analisis data akan ditampilkan secara otomatis setelah ada koperasi yang terdaftar di sistem.
            </p>
            <a href="{{ route('register') }}" class="btn-main">
                <i class="fas fa-plus-circle mr-2"></i>Daftarkan Koperasi Pertama
            </a>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Chart Configuration
    const chartColors = {
        primary: '#1a3a6e',
        secondary: '#2d5aa0',
        accent: '#f5a623',
        success: '#10b981',
        warning: '#f59e0b',
        danger: '#ef4444',
        purple: '#8b5cf6',
    };
    
    // Trend Pendaftaran Chart
    const trendData = @json($trendPendaftaran);
    const trendLabels = trendData.map(item => {
        const [year, month] = item.bulan.split('-');
        const date = new Date(year, month - 1);
        return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
    });
    const trendValues = trendData.map(item => item.total);
    
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Jumlah Pendaftaran',
                data: trendValues,
                borderColor: chartColors.accent,
                backgroundColor: 'rgba(245, 166, 35, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: chartColors.accent,
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(26, 58, 110, 0.9)',
                    padding: 12,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: { size: 12 }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: { size: 12 }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
    
    // Status Verifikasi Chart
    const statusData = @json($koperasiPerStatus);
    const statusLabels = statusData.map(item => {
        const labels = {
            'pending': 'Pending',
            'diverifikasi': 'Terverifikasi',
            'ditolak': 'Ditolak'
        };
        return labels[item.status_verifikasi] || item.status_verifikasi;
    });
    const statusValues = statusData.map(item => item.total);
    const statusColors = statusData.map(item => {
        const colors = {
            'pending': chartColors.warning,
            'diverifikasi': chartColors.success,
            'ditolak': chartColors.danger
        };
        return colors[item.status_verifikasi] || chartColors.primary;
    });
    
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusValues,
                backgroundColor: statusColors,
                borderWidth: 3,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '600' },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(26, 58, 110, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                }
            }
        }
    });
    
    // Kategori Chart
    const kategoriData = @json($koperasiPerKategori);
    const kategoriLabels = kategoriData.map(item => {
        const labels = {
            'mikro': 'Usaha Mikro',
            'kecil': 'Usaha Kecil',
            'menengah': 'Usaha Menengah'
        };
        return labels[item.kategori] || item.kategori;
    });
    const kategoriValues = kategoriData.map(item => item.total);
    
    new Chart(document.getElementById('kategoriChart'), {
        type: 'pie',
        data: {
            labels: kategoriLabels,
            datasets: [{
                data: kategoriValues,
                backgroundColor: [
                    chartColors.primary,
                    chartColors.accent,
                    chartColors.success,
                ],
                borderWidth: 3,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '600' },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(26, 58, 110, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                }
            }
        }
    });
    
    // Distrik Chart
    const distrikData = @json($koperasiPerDistrik);
    const distrikLabels = distrikData.map(item => item.distrik);
    const distrikValues = distrikData.map(item => item.total);
    
    new Chart(document.getElementById('distrikChart'), {
        type: 'bar',
        data: {
            labels: distrikLabels,
            datasets: [{
                label: 'Jumlah Koperasi',
                data: distrikValues,
                backgroundColor: chartColors.primary,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(26, 58, 110, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: { size: 12 }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: { size: 11 }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
    
    // Jenis Usaha Chart
    const jenisData = @json($koperasiPerJenis);
    const jenisLabels = jenisData.map(item => item.jenis_usaha);
    const jenisValues = jenisData.map(item => item.total);
    
    new Chart(document.getElementById('jenisChart'), {
        type: 'bar',
        data: {
            labels: jenisLabels,
            datasets: [{
                label: 'Jumlah Koperasi',
                data: jenisValues,
                backgroundColor: chartColors.accent,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(26, 58, 110, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: { size: 12 }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                y: {
                    ticks: {
                        font: { size: 12 }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
