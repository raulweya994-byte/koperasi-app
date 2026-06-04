@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Administrator')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>

{{-- ===== SECTION KONFIRMASI PENDAFTARAN ===== --}}
<div class="row mt-3">
    {{-- Konfirmasi Koperasi Pending --}}
    <div class="col-lg-6">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-check mr-2"></i>Konfirmasi Pendaftaran Koperasi
                </h3>
                <div class="card-tools">
                    @if($stats['koperasi_pending'] > 0)
                    <span class="badge badge-warning">{{ $stats['koperasi_pending'] }} Menunggu</span>
                    @endif
                    <a href="{{ route('admin.koperasi.index') }}" class="btn btn-sm btn-warning ml-2">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Koperasi</th>
                            <th>Pemilik</th>
                            <th>Distrik</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingKoperasi as $k)
                        <tr>
                            <td><strong>{{ $k->nama_usaha }}</strong></td>
                            <td>{{ $k->nama_pemilik }}</td>
                            <td><span class="badge badge-secondary">{{ $k->distrik }}</span></td>
                            <td><small>{{ $k->created_at->format('d/m/Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.koperasi.show', $k) }}" class="btn btn-xs btn-primary">
                                    <i class="fas fa-eye"></i> Review
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">
                            <i class="fas fa-check-circle text-success mr-2"></i>Semua koperasi sudah diverifikasi
                        </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Konfirmasi Anggota Pending --}}
    <div class="col-lg-6">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>Konfirmasi Pendaftaran Anggota
                </h3>
                <div class="card-tools">
                    @if($stats['anggota_pending'] > 0)
                    <span class="badge badge-info">{{ $stats['anggota_pending'] }} Menunggu</span>
                    @endif
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-sm btn-info ml-2">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Anggota</th>
                            <th>No. Anggota</th>
                            <th>Distrik</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingAnggota as $a)
                        <tr>
                            <td><strong>{{ $a->nama }}</strong></td>
                            <td><span class="badge badge-secondary">{{ $a->no_anggota }}</span></td>
                            <td>{{ $a->distrik }}</td>
                            <td><small>{{ $a->created_at->format('d/m/Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.anggota.show', $a) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i> Review
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">
                            <i class="fas fa-check-circle text-success mr-2"></i>Tidak ada anggota yang menunggu konfirmasi
                        </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css"/>
<style>
#peta-admin { height:350px; width:100%; z-index:1; }
.leaflet-container { z-index:1 !important; }

/* Grafik styling - ukuran lebih kecil dan rapi */
#chartDistrik { max-height: 250px !important; }
#chartKategori { max-height: 220px !important; }

.card-body canvas {
    max-height: 280px;
}
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-primary">
            <div class="inner"><h3>{{ number_format($stats['total_koperasi']) }}</h3><p>Total Koperasi Terdaftar</p></div>
            <div class="icon"><i class="fas fa-store"></i></div>
            <a href="{{ route('admin.koperasi.index') }}" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-success">
            <div class="inner"><h3>{{ number_format($stats['koperasi_verified']) }}</h3><p>Koperasi Terverifikasi</p></div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <a href="{{ route('admin.koperasi.index') }}" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-warning">
            <div class="inner"><h3>{{ number_format($stats['koperasi_pending']) }}</h3><p>Menunggu Verifikasi</p></div>
            <div class="icon"><i class="fas fa-clock"></i></div>
            <a href="{{ route('admin.koperasi.index') }}" class="small-box-footer">Proses sekarang <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-danger">
            <div class="inner"><h3>{{ number_format($stats['bantuan_aktif']) }}</h3><p>Bantuan Aktif</p></div>
            <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
            <a href="{{ route('admin.bantuan.index') }}" class="small-box-footer">Lihat bantuan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-7">
        <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Koperasi per Distrik</h3></div>
            <div class="card-body"><canvas id="chartDistrik" style="height:250px"></canvas></div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card card-success card-outline">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Kategori Koperasi</h3></div>
            <div class="card-body">
                <canvas id="chartKategori" style="height:220px"></canvas>
                <div class="mt-3">
                    @foreach($koperasiPerKategori as $k)
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-capitalize font-weight-bold">{{ $k->kategori }}</span>
                        <span class="badge badge-{{ $k->kategori==='mikro'?'primary':($k->kategori==='kecil'?'success':'warning') }}">{{ $k->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-7">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock mr-2"></i>Koperasi Menunggu Verifikasi</h3>
                <div class="card-tools"><a href="{{ route('admin.koperasi.index') }}" class="btn btn-sm btn-warning">Lihat Semua</a></div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="thead-light"><tr><th>No. Reg</th><th>Nama Usaha</th><th>Distrik</th><th>Tanggal</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse($pendingKoperasi as $u)
                    <tr>
                        <td><small class="text-muted">{{ $u->no_registrasi }}</small></td>
                        <td><strong>{{ $u->nama_usaha }}</strong><br><small class="text-muted">{{ $u->nama_pemilik }}</small></td>
                        <td><span class="badge badge-secondary">{{ $u->distrik }}</span></td>
                        <td><small>{{ $u->created_at->format('d M Y') }}</small></td>
                        <td><a href="{{ route('admin.koperasi.show', $u) }}" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">Tidak ada Koperasi yang menunggu</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-history mr-2"></i>Aktivitas Terbaru</h3>
                <div class="card-tools"><a href="{{ route('admin.users.activityLog') }}" class="btn btn-sm btn-info">Semua</a></div>
            </div>
            <div class="card-body p-0">
                <div class="p-3" style="max-height:320px;overflow-y:auto">
                    @foreach($recentActivity as $log)
                    <div class="d-flex align-items-start mb-3">
                        <span class="badge badge-{{ $log->action==='login'?'success':($log->action==='delete'?'danger':'primary') }} mr-2 mt-1">{{ $log->action }}</span>
                        <div>
                            <div style="font-size:12px"><strong>{{ $log->user->name ?? 'System' }}</strong> — {{ $log->description }}</div>
                            <small class="text-muted">{{ $log->created_at->format('d M H:i') }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="info-box shadow-sm"><span class="info-box-icon bg-primary"><i class="fas fa-store"></i></span>
        <div class="info-box-content"><span class="info-box-text">Koperasi Aktif</span><span class="info-box-number">{{ number_format($stats['koperasi_aktif']) }}</span></div></div>
    </div>
    <div class="col-md-3">
        <div class="info-box shadow-sm"><span class="info-box-icon bg-danger"><i class="fas fa-times-circle"></i></span>
        <div class="info-box-content"><span class="info-box-text">Koperasi Ditolak</span><span class="info-box-number">{{ number_format($stats['koperasi_ditolak']) }}</span></div></div>
    </div>
    <div class="col-md-3">
        <div class="info-box shadow-sm"><span class="info-box-icon bg-success"><i class="fas fa-hand-holding-usd"></i></span>
        <div class="info-box-content"><span class="info-box-text">Program Bantuan Aktif</span><span class="info-box-number">{{ number_format($stats['bantuan_aktif']) }}</span></div></div>
    </div>
    <div class="col-md-3">
        <div class="info-box shadow-sm"><span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
        <div class="info-box-content"><span class="info-box-text">Total Pengguna</span><span class="info-box-number">{{ number_format($stats['total_users']) }}</span></div></div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-map-marked-alt mr-2"></i>Peta Sebaran Koperasi Kabupaten Tolikara</h3>
            </div>
            <div class="card-body p-0">
                <div id="peta-admin"></div>
            </div>
            <div class="card-footer">
                <div class="row text-center" style="font-size:13px">
                    <div class="col-4"><i class="fas fa-circle mr-1" style="color:#1a3a6e"></i>Terverifikasi</div>
                    <div class="col-4"><i class="fas fa-circle mr-1" style="color:#f5a623"></i>Menunggu</div>
                    <div class="col-4"><i class="fas fa-circle mr-1" style="color:#dc3545"></i>Ditolak</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== SECTION KONFIRMASI PENDAFTARAN ===== --}}
<div class="row mt-3">
    {{-- Konfirmasi Koperasi Pending --}}
    <div class="col-lg-6">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-check mr-2"></i>Konfirmasi Pendaftaran Koperasi
                </h3>
                <div class="card-tools">
                    @if($stats['koperasi_pending'] > 0)
                    <span class="badge badge-warning">{{ $stats['koperasi_pending'] }} Menunggu</span>
                    @endif
                    <a href="{{ route('admin.koperasi.index') }}" class="btn btn-sm btn-warning ml-2">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Koperasi</th>
                            <th>Pemilik</th>
                            <th>Distrik</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingKoperasi as $k)
                        <tr>
                            <td><strong>{{ $k->nama_usaha }}</strong></td>
                            <td>{{ $k->nama_pemilik }}</td>
                            <td><span class="badge badge-secondary">{{ $k->distrik }}</span></td>
                            <td><small>{{ $k->created_at->format('d/m/Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.koperasi.show', $k) }}" class="btn btn-xs btn-primary">
                                    <i class="fas fa-eye"></i> Review
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">
                            <i class="fas fa-check-circle text-success mr-2"></i>Semua koperasi sudah diverifikasi
                        </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Konfirmasi Anggota Pending --}}
    <div class="col-lg-6">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>Konfirmasi Pendaftaran Anggota
                </h3>
                <div class="card-tools">
                    @if($stats['anggota_pending'] > 0)
                    <span class="badge badge-info">{{ $stats['anggota_pending'] }} Menunggu</span>
                    @endif
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-sm btn-info ml-2">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Anggota</th>
                            <th>No. Anggota</th>
                            <th>Distrik</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingAnggota as $a)
                        <tr>
                            <td><strong>{{ $a->nama }}</strong></td>
                            <td><span class="badge badge-secondary">{{ $a->no_anggota }}</span></td>
                            <td>{{ $a->distrik }}</td>
                            <td><small>{{ $a->created_at->format('d/m/Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.anggota.show', $a) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i> Review
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">
                            <i class="fas fa-check-circle text-success mr-2"></i>Tidak ada anggota yang menunggu konfirmasi
                        </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
$(function(){
    // Bar Chart dengan warna berbeda-beda untuk setiap bar
    const distrikLabels = @json($koperasiPerDistrik->pluck('distrik'));
    const distrikData = @json($koperasiPerDistrik->pluck('total'));
    
    // Array warna yang berbeda untuk setiap bar
    const barColors = [
        '#3b82f6', // Blue
        '#8b5cf6', // Purple
        '#ec4899', // Pink
        '#f59e0b', // Orange
        '#10b981', // Green
        '#06b6d4', // Cyan
        '#ef4444', // Red
        '#6366f1', // Indigo
        '#14b8a6', // Teal
        '#f97316', // Deep Orange
        '#a855f7', // Violet
        '#22c55e'  // Light Green
    ];
    
    new Chart($('#chartDistrik'),{
        type:'bar',
        data:{
            labels: distrikLabels,
            datasets:[{
                label:'Jumlah Koperasi',
                data: distrikData,
                backgroundColor: barColors.slice(0, distrikLabels.length),
                borderRadius: 8,
                borderWidth: 0
            }]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false,
            plugins:{
                legend:{display:false},
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 12 },
                    cornerRadius: 6
                }
            },
            scales:{
                y:{
                    beginAtZero:true,
                    ticks:{stepSize:1},
                    grid: { color: '#f1f5f9' }
                },
                x:{
                    grid: { display: false }
                }
            }
        }
    });
    
    new Chart($('#chartKategori'),{
        type:'doughnut',
        data:{
            labels:@json($koperasiPerKategori->pluck('kategori')->map(fn($k)=>ucfirst($k))),
            datasets:[{
                data:@json($koperasiPerKategori->pluck('total')),
                backgroundColor:['#007bff','#28a745','#ffc107'],
                borderWidth:2
            }]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false,
            plugins:{legend:{position:'bottom'}}
        }
    });

    var koperasiData = @json($koperasiPerDistrik);
    var koord = {"Karubaga":[-3.610,138.462],"Bokondini":[-3.648,138.672],"Tiom":[-3.680,138.395],"Kembu":[-3.580,138.520],"Bewani":[-3.700,138.395],"Bokoneri":[-3.670,138.500],"Geya":[-3.550,138.560],"Nabunage":[-3.720,138.440],"Kanggime":[-3.540,138.340]};

    var map = L.map('peta-admin',{scrollWheelZoom:false}).setView([-3.620,138.480],9);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution:'OpenStreetMap'}).addTo(map);

    $.each(koperasiData,function(i,v){
        var c=koord[v.distrik]; if(!c) return;
        L.marker(c,{icon:L.divIcon({className:'',
            html:'<div style="background:#1a3a6e;color:#fff;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:800;border:3px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,0.3)">'+v.total+'</div>',
            iconAnchor:[18,18]
        })}).addTo(map).bindPopup('<b>Distrik '+v.distrik+'</b><br>Total: '+v.total+' Koperasi');
    });

    setTimeout(function(){ map.invalidateSize(); }, 500);
});
</script>
@endpush
