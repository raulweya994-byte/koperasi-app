@extends('layouts.app')
@section('title', 'Dashboard Petugas')

@push('styles')
<style>
    /* Stats Cards Modern */
    .stats-card-modern {
        padding: 24px;
        border-radius: 12px;
        color: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }

    .stats-card-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .stats-card-modern .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 5px;
        line-height: 1;
    }

    .stats-card-modern .stats-label {
        font-size: 0.9rem;
        opacity: 0.95;
        font-weight: 600;
    }

    .stats-card-modern .stats-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 3rem;
        opacity: 0.3;
    }

    /* Content Card Modern */
    .content-card-modern {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: none;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .content-card-header-modern {
        padding: 18px 24px;
        background: white;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .content-card-title-modern {
        font-size: 16px;
        font-weight: 700;
        color: #334155;
        margin: 0;
    }

    .content-card-body-modern {
        padding: 24px;
    }

    /* Chart Container */
    .chart-container-modern {
        position: relative;
        height: 300px;
    }

    .chart-container-large {
        height: 350px;
    }

    /* Activity List */
    .activity-item {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 2px;
    }

    .activity-time {
        font-size: 12px;
        color: #94a3b8;
    }

    /* Calendar Simple */
    .calendar-simple {
        background: white;
        border-radius: 8px;
    }

    .calendar-header {
        text-align: center;
        padding: 16px;
        font-weight: 700;
        font-size: 16px;
        color: #1e293b;
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border-bottom: none;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        padding: 16px;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8fafc;
    }

    .calendar-day:hover:not(.header) {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1e40af;
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }

    .calendar-day.today {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        transform: scale(1.1);
    }

    .calendar-day.today:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: scale(1.1);
    }

    .calendar-day.header {
        color: #10b981;
        font-weight: 700;
        font-size: 12px;
        cursor: default;
        background: transparent;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .calendar-day.header:hover {
        background: transparent;
        transform: none;
    }

    .calendar-day.weekend {
        color: #ef4444;
    }

    .calendar-day.other-month {
        opacity: 0.3;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-card-modern .stats-number {
            font-size: 2rem;
        }
        
        .chart-container-modern {
            height: 250px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    @php
        $theme = auth()->user()->theme_preference ?? 'default';
        $themes = [
            'default' => [
                'card1' => 'linear-gradient(135deg,#17a2b8,#138496)',
                'card2' => 'linear-gradient(135deg,#28a745,#218838)',
                'card3' => 'linear-gradient(135deg,#ffc107,#e0a800)',
                'card4' => 'linear-gradient(135deg,#dc3545,#c82333)',
            ],
            'blue' => [
                'card1' => 'linear-gradient(135deg,#3b82f6,#2563eb)',
                'card2' => 'linear-gradient(135deg,#06b6d4,#0891b2)',
                'card3' => 'linear-gradient(135deg,#0ea5e9,#0284c7)',
                'card4' => 'linear-gradient(135deg,#1e40af,#1e3a8a)',
            ],
            'green' => [
                'card1' => 'linear-gradient(135deg,#10b981,#059669)',
                'card2' => 'linear-gradient(135deg,#14b8a6,#0d9488)',
                'card3' => 'linear-gradient(135deg,#22c55e,#16a34a)',
                'card4' => 'linear-gradient(135deg,#15803d,#166534)',
            ],
            'purple' => [
                'card1' => 'linear-gradient(135deg,#8b5cf6,#7c3aed)',
                'card2' => 'linear-gradient(135deg,#a855f7,#9333ea)',
                'card3' => 'linear-gradient(135deg,#c084fc,#a78bfa)',
                'card4' => 'linear-gradient(135deg,#6b21a8,#581c87)',
            ],
            'orange' => [
                'card1' => 'linear-gradient(135deg,#f97316,#ea580c)',
                'card2' => 'linear-gradient(135deg,#fb923c,#f97316)',
                'card3' => 'linear-gradient(135deg,#fdba74,#fb923c)',
                'card4' => 'linear-gradient(135deg,#c2410c,#9a3412)',
            ],
            'red' => [
                'card1' => 'linear-gradient(135deg,#ef4444,#dc2626)',
                'card2' => 'linear-gradient(135deg,#f87171,#ef4444)',
                'card3' => 'linear-gradient(135deg,#fca5a5,#f87171)',
                'card4' => 'linear-gradient(135deg,#b91c1c,#991b1b)',
            ],
        ];
        $colors = $themes[$theme] ?? $themes['default'];
    @endphp
    
    {{-- Stats Cards Row --}}
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-modern" style="background:{{ $colors['card1'] }}">
                <div class="stats-number counter" data-target="{{ $stats['total_koperasi'] }}">0</div>
                <div class="stats-label">Total Koperasi</div>
                <i class="fas fa-store stats-icon"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-modern" style="background:{{ $colors['card2'] }}">
                <div class="stats-number counter" data-target="{{ $stats['koperasi_verified'] }}">0</div>
                <div class="stats-label">Terverifikasi</div>
                <i class="fas fa-check-circle stats-icon"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-modern" style="background:{{ $colors['card3'] }}">
                <div class="stats-number counter" data-target="{{ $stats['koperasi_pending'] }}">0</div>
                <div class="stats-label">Pending Verifikasi</div>
                <i class="fas fa-clock stats-icon"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card-modern" style="background:{{ $colors['card4'] }}">
                <div class="stats-number counter" data-target="{{ $stats['total_bantuan'] }}">0</div>
                <div class="stats-label">Bantuan Aktif</div>
                <i class="fas fa-hand-holding-usd stats-icon"></i>
            </div>
        </div>
    </div>

    {{-- Main Content Row --}}
    <div class="row">
        {{-- Left Column - Chart --}}
        <div class="col-lg-6">
            {{-- Area Chart --}}
            <div class="content-card-modern">
                <div class="content-card-header-modern">
                    <h5 class="content-card-title-modern">
                        <i class="fas fa-chart-area mr-2 text-primary"></i>Koperasi per Distrik
                    </h5>
                    <div>
                        <button class="btn btn-sm btn-primary">Bulan</button>
                    </div>
                </div>
                <div class="content-card-body-modern">
                    @if($koperasiPerDistrik->isNotEmpty())
                    <div class="chart-container-large">
                        <canvas id="chartArea"></canvas>
                    </div>
                    @else
                    <div style="text-align:center;padding:60px 20px;color:#94a3b8">
                        <i class="fas fa-chart-area fa-3x mb-3"></i>
                        <p>Belum ada data</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column - Line Chart --}}
        <div class="col-lg-6">
            {{-- Line Chart --}}
            <div class="content-card-modern">
                <div class="content-card-header-modern">
                    <h5 class="content-card-title-modern">
                        <i class="fas fa-chart-line mr-2 text-info"></i>Trend Pendaftaran (6 Bulan)
                    </h5>
                </div>
                <div class="content-card-body-modern">
                    @if(isset($trendPendaftaran) && $trendPendaftaran->isNotEmpty())
                    <div class="chart-container-large">
                        <canvas id="chartTrend"></canvas>
                    </div>
                    @else
                    <div style="text-align:center;padding:60px 20px;color:#94a3b8">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <p>Belum ada data</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
$(function() {
    // Counter Animation
    $('.counter').each(function() {
        const $this = $(this);
        const target = parseInt($this.data('target'));
        const duration = 1500;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            $this.text(Math.floor(current));
        }, 16);
    });

    // Area Chart
    @if($koperasiPerDistrik->isNotEmpty())
    const ctxArea = document.getElementById('chartArea');
    if (ctxArea) {
        new Chart(ctxArea, {
            type: 'line',
            data: {
                labels: @json($koperasiPerDistrik->pluck('distrik')),
                datasets: [{
                    label: 'Jumlah Koperasi',
                    data: @json($koperasiPerDistrik->pluck('total')),
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    }
    @endif

    // Trend Chart
    @if(isset($trendPendaftaran) && $trendPendaftaran->isNotEmpty())
    const ctxTrend = document.getElementById('chartTrend');
    if (ctxTrend) {
        const dataTrend = @json($trendPendaftaran);
        const labels = dataTrend.map(item => {
            const [year, month] = item.bulan.split('-');
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            return monthNames[parseInt(month) - 1];
        });
        const data = dataTrend.map(item => item.total);
        
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendaftaran',
                    data: data,
                    backgroundColor: 'rgba(6, 182, 212, 0.2)',
                    borderColor: 'rgba(6, 182, 212, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    }
    @endif
});
</script>
@endpush
