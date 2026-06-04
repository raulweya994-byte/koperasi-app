@extends('layouts.anggota')
@section('title', 'Jadwal Kegiatan')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Jadwal Kegiatan</li>
@endsection

@push('styles')
<style>
.jadwal-header-card {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 20px rgba(26, 58, 110, 0.2);
    margin-bottom: 30px;
}

.stats-card {
    border-radius: 16px;
    border: none;
    padding: 25px;
    color: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    align-items: center;
    gap: 20px;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stats-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    flex-shrink: 0;
}

.stats-content h3 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 5px;
}

.stats-content p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.95rem;
}

.schedule-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border-left: 5px solid #1a3a6e;
}

.schedule-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.schedule-card.past {
    opacity: 0.7;
    border-left-color: #9ca3af;
}

.schedule-date {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-bottom: 2px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.date-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    padding: 15px 20px;
    border-radius: 12px;
    min-width: 80px;
}

.date-box .day {
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
}

.date-box .month {
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-top: 5px;
}

.date-box .year {
    font-size: 0.85rem;
    opacity: 0.9;
}

.schedule-status {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: flex-end;
}

.schedule-body {
    padding: 25px;
    flex: 1;
}

.schedule-title {
    color: #1a3a6e;
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 20px;
    line-height: 1.4;
}

.schedule-details {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 15px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #6b7280;
    font-size: 0.95rem;
}

.detail-item i {
    width: 20px;
    color: #1a3a6e;
    font-size: 16px;
}

.schedule-description {
    color: #6b7280;
    line-height: 1.6;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #e5e7eb;
    font-size: 0.9rem;
}

.schedule-footer {
    padding: 20px;
    background: #f9fafb;
    border-top: 1px solid #e5e7eb;
}

.btn-detail {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 58, 110, 0.3);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.empty-state i {
    font-size: 64px;
    color: #d1d5db;
    margin-bottom: 20px;
}

.empty-state h5 {
    color: #1f2937;
    font-weight: 700;
    margin-bottom: 10px;
}

.empty-state p {
    color: #6b7280;
    margin: 0;
}

.badge-jenis {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

.badge-status {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

@media (max-width: 768px) {
    .stats-card {
        margin-bottom: 15px;
    }
    
    .schedule-date {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .schedule-status {
        align-items: center;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="jadwal-header-card">
        <div class="card-body p-4">
            <div class="d-flex align-items-center text-white">
                <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                    <i class="fas fa-calendar-alt fa-2x"></i>
                </div>
                <div>
                    <h3 class="mb-1 font-weight-bold">Jadwal Kegiatan</h3>
                    <p class="mb-0" style="opacity:0.9">Jadwal kegiatan dan acara koperasi</p>
                </div>
            </div>
        </div>
    </div>


    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stats-card" style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0)">
                <div class="stats-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $jadwal->total() }}</h3>
                    <p>Total Jadwal</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card" style="background:linear-gradient(135deg,#10b981,#059669)">
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $jadwal->where('status', 'dijadwalkan')->count() }}</h3>
                    <p>Dijadwalkan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card" style="background:linear-gradient(135deg,#3b82f6,#2563eb)">
                <div class="stats-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $jadwal->where('tanggal', '>=', now())->count() }}</h3>
                    <p>Akan Datang</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card" style="background:linear-gradient(135deg,#fbbf24,#f59e0b)">
                <div class="stats-icon">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $jadwal->where('status', 'selesai')->count() }}</h3>
                    <p>Selesai</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal List --}}

    <div class="row">
        @forelse($jadwal as $item)
        <div class="col-md-6 mb-4">
            <div class="schedule-card {{ $item->tanggal < now()->startOfDay() ? 'past' : '' }}">
                <div class="schedule-date">
                    <div class="date-box">
                        <span class="day">{{ $item->tanggal->format('d') }}</span>
                        <span class="month">{{ $item->tanggal->format('M') }}</span>
                        <span class="year">{{ $item->tanggal->format('Y') }}</span>
                    </div>
                    <div class="schedule-status">
                        <span class="badge badge-jenis badge-{{ $item->jenis_color }}">
                            <i class="fas fa-tag mr-1"></i>{{ $item->jenis_label }}
                        </span>
                        <span class="badge badge-status badge-{{ $item->status_color }}">
                            <i class="fas fa-circle mr-1" style="font-size:8px"></i>{{ $item->status_label }}
                        </span>
                    </div>
                </div>
                
                <div class="schedule-body">
                    <h5 class="schedule-title">{{ $item->judul }}</h5>
                    
                    <div class="schedule-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ substr($item->jam_mulai,0,5) }}{{ $item->jam_selesai ? " - ".substr($item->jam_selesai,0,5) : "" }} WIT</span>
                        </div>
                        @if($item->lokasi)
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $item->lokasi }}</span>
                        </div>
                        @endif
                        @if($item->petugas)
                        <div class="detail-item">
                            <i class="fas fa-user-tie"></i>
                            <span>{{ $item->petugas->name }}</span>
                        </div>
                        @endif
                    </div>
                    
                    @if($item->deskripsi)
                    <p class="schedule-description">
                        {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                    </p>
                    @endif
                </div>
                
                <div class="schedule-footer">
                    <button type="button" class="btn-detail" onclick="showScheduleDetail({{ $item->id }})">
                        <i class="fas fa-info-circle mr-2"></i>Detail Lengkap
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h5>Belum Ada Jadwal</h5>
                <p>Jadwal kegiatan akan muncul di sini ketika tersedia</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($jadwal->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center mt-3">
                {{ $jadwal->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Modal Detail --}}
<div class="modal fade" id="modalScheduleDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);color:white;border-radius:16px 16px 0 0">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-calendar-alt mr-2"></i>Detail Jadwal Kegiatan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="scheduleDetailContent">
                <div class="text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                    <p class="mt-3">Memuat data...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function showScheduleDetail(id) {
    $('#modalScheduleDetail').modal('show');
    $('#scheduleDetailContent').html('<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-3x text-primary"></i><p class="mt-3">Memuat data...</p></div>');
    
    // Fetch detail via AJAX
    $.get(`/anggota-portal/jadwal/${id}/detail`, function(response) {
        let html = `
            <div class="detail-header mb-4">
                <div class="mb-3">
                    <h4 class="font-weight-bold mb-3" style="color:#1a3a6e">${response.judul}</h4>
                    <div class="d-flex gap-2 flex-wrap mb-3">
                        <span class="badge badge-${response.jenis_color}">
                            <i class="fas fa-tag mr-1"></i>${response.jenis_label}
                        </span>
                        <span class="badge badge-${response.status_color}">
                            <i class="fas fa-circle mr-1" style="font-size:8px"></i>${response.status_label}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="detail-content">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3" style="background:#f9fafb;border-radius:12px">
                            <i class="fas fa-calendar text-primary mr-3" style="font-size:24px"></i>
                            <div>
                                <small class="text-muted d-block">Tanggal</small>
                                <strong>${response.tanggal_formatted}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3" style="background:#f9fafb;border-radius:12px">
                            <i class="fas fa-clock text-success mr-3" style="font-size:24px"></i>
                            <div>
                                <small class="text-muted d-block">Waktu</small>
                                <strong>${response.jam_mulai} - ${response.jam_selesai || '-'} WIT</strong>
                            </div>
                        </div>
                    </div>
                    ${response.lokasi ? `
                    <div class="col-md-12 mb-3">
                        <div class="d-flex align-items-center p-3" style="background:#f9fafb;border-radius:12px">
                            <i class="fas fa-map-marker-alt text-danger mr-3" style="font-size:24px"></i>
                            <div>
                                <small class="text-muted d-block">Lokasi</small>
                                <strong>${response.lokasi}</strong>
                            </div>
                        </div>
                    </div>
                    ` : ''}
                    ${response.petugas ? `
                    <div class="col-md-12 mb-3">
                        <div class="d-flex align-items-center p-3" style="background:#f9fafb;border-radius:12px">
                            <i class="fas fa-user-tie text-warning mr-3" style="font-size:24px"></i>
                            <div>
                                <small class="text-muted d-block">Petugas</small>
                                <strong>${response.petugas}</strong>
                            </div>
                        </div>
                    </div>
                    ` : ''}
                </div>
                
                ${response.deskripsi ? `
                <div class="mt-4">
                    <h6 class="font-weight-bold mb-3" style="color:#1a3a6e">
                        <i class="fas fa-info-circle mr-2"></i>Deskripsi Kegiatan
                    </h6>
                    <div class="p-3" style="background:#f9fafb;border-radius:12px;line-height:1.8">
                        ${response.deskripsi}
                    </div>
                </div>
                ` : ''}
                
                ${response.catatan ? `
                <div class="mt-4">
                    <h6 class="font-weight-bold mb-3" style="color:#1a3a6e">
                        <i class="fas fa-sticky-note mr-2"></i>Catatan
                    </h6>
                    <div class="p-3" style="background:#fff3cd;border-radius:12px;line-height:1.8">
                        ${response.catatan}
                    </div>
                </div>
                ` : ''}
            </div>
        `;
        $('#scheduleDetailContent').html(html);
    }).fail(function() {
        $('#scheduleDetailContent').html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle mr-2"></i>Gagal memuat data jadwal</div>');
    });
}
</script>
@endpush
