@extends("layouts.app")
@section("title","Jadwal Kegiatan")
@section("page-title","Jadwal Kegiatan")
@section("breadcrumb")
<li class="breadcrumb-item active">Jadwal</li>
@endsection

@section("content")
<div class="container-fluid">
    {{-- Filter Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body p-4">
                    <h5 class="mb-3 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-filter mr-2"></i>Filter Jadwal
                    </h5>
                    <form method="GET" action="{{ route('pimpinan.jadwal.index') }}" id="filterForm">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-tag mr-1"></i>Jenis Kegiatan
                                </label>
                                <select name="jenis" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Jenis</option>
                                    <option value="kunjungan_lapangan" {{ request('jenis') == 'kunjungan_lapangan' ? 'selected' : '' }}>Kunjungan Lapangan</option>
                                    <option value="pelatihan_pembinaan" {{ request('jenis') == 'pelatihan_pembinaan' ? 'selected' : '' }}>Pelatihan & Pembinaan</option>
                                    <option value="rapat_koordinasi" {{ request('jenis') == 'rapat_koordinasi' ? 'selected' : '' }}>Rapat Koordinasi</option>
                                    <option value="distribusi_bantuan" {{ request('jenis') == 'distribusi_bantuan' ? 'selected' : '' }}>Distribusi Bantuan</option>
                                    <option value="lainnya" {{ request('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-info-circle mr-1"></i>Status
                                </label>
                                <select name="status" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Status</option>
                                    <option value="dijadwalkan" {{ request('status') == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                    <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-calendar mr-1"></i>Dari Tanggal
                                </label>
                                <input type="date" name="date_from" class="form-control" style="border-radius:10px" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-calendar mr-1"></i>Sampai
                                </label>
                                <input type="date" name="date_to" class="form-control" style="border-radius:10px" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="font-weight-600 mb-2" style="opacity:0">Action</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary flex-fill" style="border-radius:10px">
                                        <i class="fas fa-search mr-1"></i>Filter
                                    </button>
                                    @if(request()->hasAny(['jenis', 'status', 'date_from', 'date_to']))
                                    <a href="{{ route('pimpinan.jadwal.index') }}" class="btn btn-secondary" style="border-radius:10px">
                                        <i class="fas fa-redo"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                            <i class="fas fa-list mr-2"></i>Daftar Jadwal Kegiatan
                        </h5>
                        <span class="badge badge-primary" style="font-size:13px;padding:8px 16px">
                            {{ $jadwal->total() }} Jadwal
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background:#f8f9fa">
                                <tr>
                                    <th style="padding:15px;width:50px">#</th>
                                    <th>Judul Kegiatan</th>
                                    <th style="width:180px">Jenis</th>
                                    <th style="width:150px">Tanggal</th>
                                    <th style="width:150px">Petugas</th>
                                    <th style="width:120px">Status</th>
                                    <th style="width:100px" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwal as $i => $j)
                                <tr style="border-bottom:1px solid #e5e7eb">
                                    <td style="padding:15px">{{ $jadwal->firstItem()+$i }}</td>
                                    <td>
                                        <div class="font-weight-600" style="color:#1f2937;font-size:14px">
                                            {{ $j->judul }}
                                        </div>
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $j->lokasi }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $j->jenis_color }}" style="font-size:11px;padding:6px 12px">
                                            {{ $j->jenis_label }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="font-weight-600" style="font-size:14px">
                                            <i class="fas fa-calendar mr-1 text-primary"></i>{{ $j->tanggal->format("d M Y") }}
                                        </div>
                                        @if($j->waktu_mulai)
                                        <small class="text-muted">
                                            <i class="fas fa-clock mr-1"></i>{{ $j->waktu_mulai }} - {{ $j->waktu_selesai }}
                                        </small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($j->petugas)
                                        <div class="font-weight-600" style="font-size:13px">
                                            <i class="fas fa-user mr-1 text-info"></i>{{ $j->petugas->name }}
                                        </div>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $j->status_color }}" style="font-size:11px;padding:6px 12px">
                                            {{ $j->status_label }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary" 
                                                style="border-radius:8px;padding:6px 14px"
                                                data-toggle="modal" 
                                                data-target="#detailModal{{ $j->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block" style="opacity:0.3"></i>
                                        <p class="text-muted mb-0">Belum ada jadwal kegiatan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($jadwal->hasPages())
                <div class="card-footer" style="background:white;border-radius:0 0 16px 16px;padding:20px">
                    {{ $jadwal->links("pagination::bootstrap-4") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Detail Modals --}}
@foreach($jadwal as $j)
<div class="modal fade" id="detailModal{{ $j->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none">
                <h5 class="modal-title text-white font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Detail Jadwal Kegiatan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Judul Kegiatan</label>
                        <p class="mb-0 font-weight-600" style="font-size:16px;color:#1a3a6e">{{ $j->judul }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Jenis Kegiatan</label>
                        <p class="mb-0">
                            <span class="badge badge-{{ $j->jenis_color }}" style="font-size:13px;padding:6px 14px">
                                {{ $j->jenis_label }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Status</label>
                        <p class="mb-0">
                            <span class="badge badge-{{ $j->status_color }}" style="font-size:13px;padding:6px 14px">
                                {{ $j->status_label }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Tanggal</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-calendar mr-2 text-primary"></i>{{ $j->tanggal->format("d F Y") }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Waktu</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-clock mr-2 text-success"></i>{{ $j->waktu_mulai ?? '-' }} - {{ $j->waktu_selesai ?? '-' }}
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Lokasi</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-map-marker-alt mr-2 text-danger"></i>{{ $j->lokasi }}
                        </p>
                    </div>
                    @if($j->petugas)
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Petugas</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-user mr-2 text-info"></i>{{ $j->petugas->name }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Kontak Petugas</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-phone mr-2 text-success"></i>{{ $j->petugas->phone ?? '-' }}
                        </p>
                    </div>
                    @endif
                    @if($j->deskripsi)
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Deskripsi</label>
                        <div class="alert alert-info mb-0" style="border-radius:10px">
                            {{ $j->deskripsi }}
                        </div>
                    </div>
                    @endif
                    @if($j->catatan)
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Catatan</label>
                        <div class="alert alert-warning mb-0" style="border-radius:10px">
                            {{ $j->catatan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer" style="border:none;padding:20px">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:10px">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.animate-card {
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    transform: scale(1.01);
    transition: all 0.3s;
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    border-radius: 8px;
    margin: 0 3px;
    border: none;
    color: #1a3a6e;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
}

.gap-2 {
    gap: 8px;
}
</style>
@endsection
