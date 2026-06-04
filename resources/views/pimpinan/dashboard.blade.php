@extends('layouts.app')
@section('title','Dashboard Pimpinan')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.css">
<style>
@php
    $pimpinanTheme = get_pimpinan_theme();
    $card1Color = $pimpinanTheme['card1_color'] ?? '#14b8a6';
    $card2Color = $pimpinanTheme['card2_color'] ?? '#22c55e';
    $card3Color = $pimpinanTheme['card3_color'] ?? '#eab308';
    $card4Color = $pimpinanTheme['card4_color'] ?? '#ef4444';
@endphp

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.dashboard-container {
    padding: 25px;
    background: #f5f7fa;
    min-height: 100vh;
}

/* Top Stats Cards - 4 Columns */
.top-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 25px 30px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}

.stat-card.card1 {
    background: linear-gradient(135deg, {{ $card1Color }} 0%, {{ $card1Color }}dd 100%);
    color: white;
}

.stat-card.card2 {
    background: linear-gradient(135deg, {{ $card2Color }} 0%, {{ $card2Color }}dd 100%);
    color: white;
}

.stat-card.card3 {
    background: linear-gradient(135deg, {{ $card3Color }} 0%, {{ $card3Color }}dd 100%);
    color: white;
}

.stat-card.card4 {
    background: linear-gradient(135deg, {{ $card4Color }} 0%, {{ $card4Color }}dd 100%);
    color: white;
}

.stat-card-content {
    flex: 1;
}

.stat-card-value {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 5px;
    line-height: 1;
}

.stat-card-label {
    font-size: 14px;
    font-weight: 600;
    opacity: 0.95;
    text-transform: capitalize;
}

.stat-card-icon {
    font-size: 48px;
    opacity: 0.3;
    margin-left: 15px;
}

/* Charts Grid */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.chart-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.chart-card h3 {
    font-size: 16px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.chart-wrapper {
    position: relative;
    height: 300px;
}

/* Bottom Grid */
.bottom-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 20px;
}

.progress-card, .table-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.progress-card h3, .table-card h3 {
    font-size: 16px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Progress Items */
.progress-item {
    margin-bottom: 20px;
}

.progress-item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.progress-item-label {
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
}

.progress-item-value {
    font-size: 14px;
    font-weight: 700;
    color: #667eea;
}

.progress-bar-wrapper {
    height: 8px;
    background: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 0.3s ease;
}

.progress-bar-fill.green { background: linear-gradient(90deg, #10b981, #34d399); }
.progress-bar-fill.orange { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
.progress-bar-fill.red { background: linear-gradient(90deg, #ef4444, #f87171); }
.progress-bar-fill.blue { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
.progress-bar-fill.purple { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
.progress-bar-fill.pink { background: linear-gradient(90deg, #ec4899, #f472b6); }

/* Table */
.custom-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
}

.custom-table thead th {
    font-size: 12px;
    font-weight: 700;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 12px;
    border: none;
    background: transparent;
}

.custom-table tbody tr {
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.custom-table tbody tr:hover {
    background: #e9ecef;
    transform: scale(1.01);
}

.custom-table tbody td {
    padding: 15px 12px;
    border: none;
    font-size: 14px;
    color: #2c3e50;
}

.custom-table tbody td:first-child {
    border-radius: 8px 0 0 8px;
}

.custom-table tbody td:last-child {
    border-radius: 0 8px 8px 0;
}

.status-badge {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    min-width: 80px;
}

.status-badge.success {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.warning {
    background: #fef3c7;
    color: #92400e;
}

.status-badge.danger {
    background: #fee2e2;
    color: #991b1b;
}

.status-badge.info {
    background: #dbeafe;
    color: #1e40af;
}

.action-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
}

.action-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

@media (max-width: 1200px) {
    .top-stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bottom-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 15px;
    }
    
    .top-stats {
        grid-template-columns: 1fr;
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card-value {
        font-size: 28px;
    }
    
    .stat-card-icon {
        font-size: 36px;
    }
}
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <!-- Top Stats Cards - 4 Columns with Dynamic Colors -->
    <div class="top-stats">
        <div class="stat-card card1">
            <div class="stat-card-content">
                <div class="stat-card-value">{{ $stats['total_koperasi'] }}</div>
                <div class="stat-card-label">Total Koperasi</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-store"></i>
            </div>
        </div>
        
        <div class="stat-card card2">
            <div class="stat-card-content">
                <div class="stat-card-value">{{ $stats['koperasi_verified'] }}</div>
                <div class="stat-card-label">Terverifikasi</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        
        <div class="stat-card card3">
            <div class="stat-card-content">
                <div class="stat-card-value">{{ $stats['pending_verifikasi'] }}</div>
                <div class="stat-card-label">Pending Verifikasi</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        
        <div class="stat-card card4">
            <div class="stat-card-content">
                <div class="stat-card-value">{{ $stats['penerima_bantuan'] }}</div>
                <div class="stat-card-label">Bantuan Aktif</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-hand-holding-heart"></i>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="charts-grid">
        <!-- Bar Chart -->
        <div class="chart-card">
            <h3>Bar Chart (Grafik Batang)</h3>
            <div class="chart-wrapper">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="chart-card">
            <h3>Line Chart (Grafik Garis)</h3>
            <div class="chart-wrapper">
                <canvas id="areaChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="chart-card">
            <h3>Pie Chart (Grafik Lingkaran)</h3>
            <div class="chart-wrapper">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bottom Grid -->
    <div class="bottom-grid">
        <!-- Progress List -->
        <div class="progress-card">
            <h3>Progress Status</h3>
            
            <div class="progress-item">
                <div class="progress-item-header">
                    <span class="progress-item-label">Koperasi Aktif</span>
                    <span class="progress-item-value">{{ $progressData['koperasi_aktif'] }}%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill green" style="width: {{ $progressData['koperasi_aktif'] }}%"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-item-header">
                    <span class="progress-item-label">Anggota Terverifikasi</span>
                    <span class="progress-item-value">{{ $progressData['anggota_verified'] }}%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill orange" style="width: {{ $progressData['anggota_verified'] }}%"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-item-header">
                    <span class="progress-item-label">Laporan Selesai</span>
                    <span class="progress-item-value">{{ $progressData['laporan_selesai'] }}%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill red" style="width: {{ $progressData['laporan_selesai'] }}%"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-item-header">
                    <span class="progress-item-label">Jadwal Terlaksana</span>
                    <span class="progress-item-value">{{ $progressData['jadwal_selesai'] }}%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill blue" style="width: {{ $progressData['jadwal_selesai'] }}%"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-item-header">
                    <span class="progress-item-label">Bantuan Tersalurkan</span>
                    <span class="progress-item-value">{{ $progressData['bantuan_tersalurkan'] }}%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill purple" style="width: {{ $progressData['bantuan_tersalurkan'] }}%"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-item-header">
                    <span class="progress-item-label">Pelatihan Selesai</span>
                    <span class="progress-item-value">{{ $progressData['pelatihan_selesai'] }}%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill pink" style="width: {{ $progressData['pelatihan_selesai'] }}%"></div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="table-card">
            <h3>Data Koperasi Terbaru</h3>
            @if($koperasiTerbaru->count() > 0)
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA KOPERASI</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($koperasiTerbaru as $index => $kop)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kop->nama_koperasi }}</td>
                        <td>
                            @if($kop->status_verifikasi == 'diverifikasi')
                                <span class="status-badge success">Aktif</span>
                            @elseif($kop->status_verifikasi == 'pending')
                                <span class="status-badge warning">Pending</span>
                            @elseif($kop->status_verifikasi == 'ditolak')
                                <span class="status-badge danger">Ditolak</span>
                            @else
                                <span class="status-badge info">Review</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pimpinan.koperasi.show', $kop->id) }}" class="action-link">
                                View <i class="fas fa-arrow-right"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center py-4">
                <p class="text-muted">Belum ada data koperasi</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Data dari database
const koperasiPerKategori = @json($koperasiPerKategori);
const koperasiPerDistrik = @json($koperasiPerDistrik);
const statusCounts = @json($statusCounts);

// Bar Chart - Koperasi per Distrik (Top 7)
const barCtx = document.getElementById('barChart').getContext('2d');
const distrikLabels = koperasiPerDistrik.slice(0, 7).map(item => item.distrik || 'Tidak Ada');
const distrikData = koperasiPerDistrik.slice(0, 7).map(item => item.total);

new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: distrikLabels,
        datasets: [{
            label: 'Jumlah Koperasi',
            data: distrikData,
            backgroundColor: '{{ $card1Color }}',
            borderRadius: 8,
            barThickness: 40
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
                    color: '#f0f0f0'
                },
                ticks: {
                    stepSize: 1
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Area Chart - Koperasi per Kategori
const areaCtx = document.getElementById('areaChart').getContext('2d');
const kategoriLabels = koperasiPerKategori.map(item => item.kategori || 'Lainnya');
const kategoriData = koperasiPerKategori.map(item => item.total);

new Chart(areaCtx, {
    type: 'line',
    data: {
        labels: kategoriLabels,
        datasets: [{
            label: 'Jumlah Koperasi',
            data: kategoriData,
            backgroundColor: 'rgba(102, 126, 234, 0.3)',
            borderColor: '{{ $card1Color }}',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
                    color: '#f0f0f0'
                },
                ticks: {
                    stepSize: 1
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Pie Chart - Status Koperasi
const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'doughnut',
    data: {
        labels: ['Aktif', 'Pending', 'Ditolak', 'Review'],
        datasets: [{
            data: [
                statusCounts.aktif,
                statusCounts.pending,
                statusCounts.nonaktif,
                statusCounts.review
            ],
            backgroundColor: [
                '{{ $card2Color }}',
                '{{ $card3Color }}',
                '{{ $card4Color }}',
                '#94a3b8'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush
