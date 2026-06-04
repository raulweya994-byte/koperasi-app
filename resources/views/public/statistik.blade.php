@extends('public.layouts.app')
@section('title','Data Statistik')

@section('content')
<section style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0 40px;color:white;">
    <div class="container text-center">
        <i class="fas fa-chart-bar fa-2x mb-3 d-block" style="opacity:.8"></i>
        <h2 class="font-weight-bold mb-2">Data Statistik Koperasi</h2>
        <p style="opacity:.75">Kabupaten Tolikara {{ date('Y') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px;border-top:4px solid #1a3a6e!important;">
                    <h2 class="font-weight-bold mb-1" style="color:#1a3a6e;">{{ $stats['total_koperasi'] }}</h2>
                    <p class="text-muted mb-0">Total Koperasi</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px;border-top:4px solid #28a745!important;">
                    <h2 class="font-weight-bold mb-1" style="color:#28a745;">{{ $stats['koperasi_verified'] }}</h2>
                    <p class="text-muted mb-0">Koperasi Terverifikasi</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px;border-top:4px solid #f5a623!important;">
                    <h2 class="font-weight-bold mb-1" style="color:#f5a623;">{{ $stats['total_distrik'] }}</h2>
                    <p class="text-muted mb-0">Distrik</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px;border-top:4px solid #dc3545!important;">
                    <h2 class="font-weight-bold mb-1" style="color:#dc3545;">{{ $stats['total_tenaga'] }}</h2>
                    <p class="text-muted mb-0">Total Tenaga Kerja</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius:12px;">
                    <div class="card-header font-weight-bold" style="background:#1a3a6e;color:white;border-radius:12px 12px 0 0;">
                        <i class="fas fa-chart-bar mr-2"></i>Koperasi per Distrik
                    </div>
                    <div class="card-body">
                        <canvas id="chartDistrik" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius:12px;">
                    <div class="card-header font-weight-bold" style="background:#1a3a6e;color:white;border-radius:12px 12px 0 0;">
                        <i class="fas fa-chart-pie mr-2"></i>Kategori Koperasi
                    </div>
                    <div class="card-body">
                        <canvas id="chartKategori" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('chartDistrik'), {
        type: 'bar',
        data: {
            labels: @json($koperasiPerDistrik->pluck('distrik')),
            datasets: [{
                label: 'Jumlah Koperasi',
                data: @json($koperasiPerDistrik->pluck('total')),
                backgroundColor: 'rgba(26,58,110,0.75)',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: @json($koperasiPerKategori->pluck('kategori')->map(fn($k) => ucfirst($k))),
            datasets: [{
                data: @json($koperasiPerKategori->pluck('total')),
                backgroundColor: ['#1a3a6e','#28a745','#f5a623','#dc3545'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
});
</script>
@endsection
