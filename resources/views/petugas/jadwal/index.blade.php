@extends("layouts.app")
@section("title","Manajemen Jadwal")
@section("page-title","Jadwal")
@section("breadcrumb")
<li class="breadcrumb-item active">Jadwal</li>
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

.filter-card {
    background: white;
    border-radius: 16px;
    border: none;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    margin-bottom: 25px;
}

.filter-select {
    border-radius: 10px;
    border: 2px solid #e5e7eb;
    padding: 10px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.filter-select:focus {
    border-color: #1a3a6e;
    box-shadow: 0 0 0 3px rgba(26, 58, 110, 0.1);
}

.btn-filter {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 58, 110, 0.3);
    color: white;
}

.btn-reset {
    background: #f3f4f6;
    color: #6b7280;
    border: none;
    border-radius: 10px;
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-reset:hover {
    background: #e5e7eb;
    color: #374151;
}

.btn-create-jadwal {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 28px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-create-jadwal:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    color: white;
}

.table-card {
    background: white;
    border-radius: 16px;
    border: none;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    overflow: hidden;
}

.table-card .table {
    margin-bottom: 0;
}

.table-card thead th {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    color: #1a3a6e;
    font-weight: 700;
    border: none;
    padding: 15px;
    font-size: 0.9rem;
}

.table-card tbody td {
    padding: 15px;
    vertical-align: middle;
    border-top: 1px solid #f3f4f6;
}

.table-card tbody tr:hover {
    background: #f9fafb;
}

.btn-action {
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
    font-size: 0.85rem;
}

.btn-view {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

.btn-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    color: white;
}

.btn-edit {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    color: white;
}

.btn-delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.btn-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    color: white;
}

.badge-custom {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
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
</style>
@endpush

@section("content")
<div class="container-fluid">
    {{-- Header --}}
    <div class="jadwal-header-card">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center text-white flex-wrap">
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="mb-1 font-weight-bold">Manajemen Jadwal</h3>
                        <p class="mb-0" style="opacity:0.9;font-size:0.95rem">Kelola jadwal kegiatan dan acara koperasi</p>
                    </div>
                </div>
                <a href="{{ route('petugas.jadwal.create') }}" class="btn btn-create-jadwal">
                    <i class="fas fa-plus mr-2"></i>Buat Jadwal Baru
                </a>
            </div>
        </div>
    </div>

    @if(session("success"))
    <div class="alert alert-success alert-dismissible fade show" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(16,185,129,0.2)">
        <i class="fas fa-check-circle mr-2"></i>{{ session("success") }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    {{-- Filter Card --}}
    <div class="filter-card">
        <div class="card-body p-3">
            <form class="row align-items-end">
                <div class="col-md-4 mb-2">
                    <label class="font-weight-600 mb-2" style="color:#1a3a6e;font-size:0.9rem">
                        <i class="fas fa-tag mr-1"></i>Jenis Kegiatan
                    </label>
                    <select name="jenis" class="form-control filter-select">
                        <option value="">Semua Jenis</option>
                        <option value="verifikasi" {{ request("jenis")=="verifikasi"?"selected":"" }}>Verifikasi Lapangan</option>
                        <option value="pelatihan" {{ request("jenis")=="pelatihan"?"selected":"" }}>Pelatihan/Pembinaan</option>
                        <option value="penilaian_bantuan" {{ request("jenis")=="penilaian_bantuan"?"selected":"" }}>Penilaian Bantuan</option>
                        <option value="rapat" {{ request("jenis")=="rapat"?"selected":"" }}>Rapat/Pertemuan</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="font-weight-600 mb-2" style="color:#1a3a6e;font-size:0.9rem">
                        <i class="fas fa-info-circle mr-1"></i>Status
                    </label>
                    <select name="status" class="form-control filter-select">
                        <option value="">Semua Status</option>
                        <option value="dijadwalkan" {{ request("status")=="dijadwalkan"?"selected":"" }}>Dijadwalkan</option>
                        <option value="berlangsung" {{ request("status")=="berlangsung"?"selected":"" }}>Berlangsung</option>
                        <option value="selesai" {{ request("status")=="selesai"?"selected":"" }}>Selesai</option>
                        <option value="dibatalkan" {{ request("status")=="dibatalkan"?"selected":"" }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <button type="submit" class="btn btn-filter mr-2">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <a href="{{ route('petugas.jadwal.index') }}" class="btn btn-reset">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="120">Tanggal</th>
                        <th>Jadwal</th>
                        <th width="150">Jenis</th>
                        <th width="120">Petugas</th>
                        <th width="120">Status</th>
                        <th width="100">Publik</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($jadwal as $j)
                <tr>
                    <td>
                        <div class="font-weight-bold" style="color:#1a3a6e">{{ $j->tanggal->format("d M Y") }}</div>
                        <small class="text-muted">{{ substr($j->jam_mulai,0,5) }}{{ $j->jam_selesai ? " - ".substr($j->jam_selesai,0,5) : "" }}</small>
                    </td>
                    <td>
                        <div class="font-weight-bold" style="color:#1a3a6e">{{ $j->judul }}</div>
                        @if($j->lokasi)
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $j->lokasi }}
                        </small>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-custom badge-{{ $j->jenis_color }}">
                            {{ $j->jenis_label }}
                        </span>
                    </td>
                    <td>
                        <small>{{ $j->petugas->name ?? "-" }}</small>
                    </td>
                    <td>
                        <span class="badge badge-custom badge-{{ $j->status_color }}">
                            {{ $j->status_label }}
                        </span>
                    </td>
                    <td>
                        @if($j->is_publik)
                            <span class="badge badge-custom badge-success">
                                <i class="fas fa-globe"></i> Ya
                            </span>
                        @else
                            <span class="badge badge-custom badge-secondary">Internal</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('petugas.jadwal.show',$j) }}" class="btn btn-action btn-view" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('petugas.jadwal.edit',$j) }}" class="btn btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('petugas.jadwal.destroy',$j) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf @method("DELETE")
                            <button type="submit" class="btn btn-action btn-delete" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-calendar-times"></i>
                            <h5>Belum Ada Jadwal</h5>
                            <p>Klik tombol "Buat Jadwal Baru" untuk menambahkan jadwal kegiatan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        
        @if($jadwal->hasPages())
        <div class="card-footer bg-white border-top">
            <div class="d-flex justify-content-center">
                {{ $jadwal->links("pagination::bootstrap-4") }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

