@extends('layouts.app')
@section('title','Rekap Laporan Anggota Koperasi')
@section('page-title','Rekap Laporan Anggota Koperasi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('pimpinan.laporan.index') }}">Laporan</a></li>
<li class="breadcrumb-item active">Rekap Anggota Koperasi</li>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Filter Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#667eea,#764ba2)">
                <div class="card-body p-4">
                    <h5 class="text-white mb-3 font-weight-bold">
                        <i class="fas fa-filter mr-2"></i>Filter Laporan Anggota Koperasi
                    </h5>
                    <p class="text-white mb-3" style="opacity:0.9;font-size:14px">
                        <i class="fas fa-info-circle mr-1"></i>
                        Filter data anggota koperasi berdasarkan distrik, koperasi, dan status pendaftaran
                    </p>
                    <form method="GET" action="{{ route('pimpinan.laporan.koperasi') }}" id="filterForm">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Distrik
                                </label>
                                <select name="distrik" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Distrik</option>
                                    @foreach($distrikList as $d)
                                    <option value="{{ $d }}" {{ request('distrik') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600">
                                    <i class="fas fa-building mr-1"></i>Koperasi
                                </label>
                                <select name="koperasi_id" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Koperasi</option>
                                    @foreach($koperasiList as $kop)
                                    <option value="{{ $kop->id }}" {{ request('koperasi_id') == $kop->id ? 'selected' : '' }}>
                                        {{ $kop->nama_usaha }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600">
                                    <i class="fas fa-check-circle mr-1"></i>Status
                                </label>
                                <select name="status" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600" style="opacity:0">Action</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-light flex-fill" style="border-radius:10px">
                                        <i class="fas fa-search mr-1"></i>Tampilkan
                                    </button>
                                    @if(request()->hasAny(['distrik', 'koperasi_id', 'status']))
                                    <a href="{{ route('pimpinan.laporan.koperasi') }}" class="btn btn-secondary" style="border-radius:10px">
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

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#3b82f6,#2563eb)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ $stats['total'] }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Total Anggota</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#10b981,#059669)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ $stats['aktif'] }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#f59e0b,#d97706)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ $stats['pending'] }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#6b7280,#4b5563)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-ban fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ $stats['nonaktif'] }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Nonaktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Download Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-download mr-2"></i>Download Laporan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('pimpinan.laporan.koperasi.word', ['distrik' => request('distrik'), 'koperasi_id' => request('koperasi_id'), 'status' => request('status')]) }}" 
                               class="btn btn-primary btn-block btn-lg download-btn" 
                               style="border-radius:12px;padding:15px;text-decoration:none">
                                <i class="fas fa-file-word fa-2x mb-2 d-block"></i>
                                <strong>Download Word</strong><br>
                                <small>Format DOCX dengan layout profesional</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('pimpinan.laporan.koperasi.excel', ['distrik' => request('distrik'), 'koperasi_id' => request('koperasi_id'), 'status' => request('status')]) }}" 
                               class="btn btn-success btn-block btn-lg download-btn" 
                               style="border-radius:12px;padding:15px;text-decoration:none">
                                <i class="fas fa-file-excel fa-2x mb-2 d-block"></i>
                                <strong>Download Excel</strong><br>
                                <small>Format XLSX untuk analisis data</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('pimpinan.laporan.koperasi.pdf', ['distrik' => request('distrik'), 'koperasi_id' => request('koperasi_id'), 'status' => request('status')]) }}" 
                               class="btn btn-danger btn-block btn-lg download-btn" 
                               style="border-radius:12px;padding:15px;text-decoration:none">
                                <i class="fas fa-file-pdf fa-2x mb-2 d-block"></i>
                                <strong>Download PDF</strong><br>
                                <small>Format PDF siap cetak</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <button onclick="printAll()" class="btn btn-info btn-block btn-lg download-btn" 
                                    style="border-radius:12px;padding:15px">
                                <i class="fas fa-print fa-2x mb-2 d-block"></i>
                                <strong>Print Laporan</strong><br>
                                <small>Cetak langsung ke printer</small>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Preview Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <div>
                        <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                            <i class="fas fa-table mr-2"></i>Data Anggota Koperasi ({{ $anggota->count() }} Anggota)
                        </h5>
                        <p class="mb-0 mt-2" style="color:#6b7280;font-size:13px">
                            <i class="fas fa-info-circle mr-1"></i>
                            Menampilkan data anggota sesuai form pendaftaran
                        </p>
                    </div>
                    @if(can_create('laporan'))
                    <button onclick="createAnggota()" class="btn btn-primary" style="border-radius:10px">
                        <i class="fas fa-plus mr-1"></i>Tambah Anggota
                    </button>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse:separate;border-spacing:0;min-width:2000px">
                            <thead style="background:linear-gradient(135deg,#1e3a8a,#1e40af);color:white">
                                <tr>
                                    <th style="padding:12px;border:none;width:40px;position:sticky;left:0;background:#1e3a8a;z-index:10">#</th>
                                    <th style="padding:12px;border:none;width:120px;position:sticky;left:40px;background:#1e3a8a;z-index:10">No. Anggota</th>
                                    <th style="padding:12px;border:none;min-width:180px">Nama Lengkap</th>
                                    <th style="padding:12px;border:none;width:150px">NIK</th>
                                    <th style="padding:12px;border:none;width:140px">Tempat, Tgl Lahir</th>
                                    <th style="padding:12px;border:none;width:100px">Jenis Kelamin</th>
                                    <th style="padding:12px;border:none;width:120px">Status Kawin</th>
                                    <th style="padding:12px;border:none;width:120px">Pendidikan</th>
                                    <th style="padding:12px;border:none;width:100px">Agama</th>
                                    <th style="padding:12px;border:none;width:120px">No. HP</th>
                                    <th style="padding:12px;border:none;width:180px">Email</th>
                                    <th style="padding:12px;border:none;min-width:200px">Koperasi</th>
                                    <th style="padding:12px;border:none;width:120px">Distrik</th>
                                    <th style="padding:12px;border:none;min-width:200px">Alamat</th>
                                    <th style="padding:12px;border:none;width:150px">Nama Usaha</th>
                                    <th style="padding:12px;border:none;width:120px">Bidang Usaha</th>
                                    <th style="padding:12px;border:none;width:130px">Simpanan Pokok</th>
                                    <th style="padding:12px;border:none;width:130px">Simpanan Wajib</th>
                                    <th style="padding:12px;border:none;width:100px">Status</th>
                                    <th style="padding:12px;border:none;width:120px">Tgl Bergabung</th>
                                    <th style="padding:12px;border:none;width:80px;position:sticky;right:0;background:#1e3a8a;z-index:10">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($anggota->take(50) as $i => $a)
                                <tr style="border-bottom:1px solid #e5e7eb">
                                    <td style="padding:12px;position:sticky;left:0;background:white;z-index:5">{{ $i+1 }}</td>
                                    <td style="padding:12px;position:sticky;left:40px;background:white;z-index:5">
                                        <span class="badge badge-primary">{{ $a->no_anggota }}</span>
                                    </td>
                                    <td style="padding:12px">
                                        <strong style="color:#1a3a6e">{{ $a->nama ?? $a->nama_lengkap ?? '-' }}</strong>
                                    </td>
                                    <td style="padding:12px">{{ $a->nik ?? '-' }}</td>
                                    <td style="padding:12px">
                                        {{ $a->tempat_lahir ?? '-' }}, 
                                        {{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td style="padding:12px">
                                        @if($a->jenis_kelamin == 'L')
                                            <i class="fas fa-male text-primary mr-1"></i>Laki-laki
                                        @elseif($a->jenis_kelamin == 'P')
                                            <i class="fas fa-female text-danger mr-1"></i>Perempuan
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td style="padding:12px">{{ $a->status_perkawinan ?? '-' }}</td>
                                    <td style="padding:12px">{{ $a->pendidikan_terakhir ?? '-' }}</td>
                                    <td style="padding:12px">{{ $a->agama ?? '-' }}</td>
                                    <td style="padding:12px">
                                        <i class="fas fa-phone text-success mr-1"></i>
                                        {{ $a->no_hp ?? '-' }}
                                    </td>
                                    <td style="padding:12px">
                                        <i class="fas fa-envelope text-info mr-1"></i>
                                        {{ $a->email ?? '-' }}
                                    </td>
                                    <td style="padding:12px;white-space:normal;word-wrap:break-word">
                                        <i class="fas fa-building text-info mr-1"></i>
                                        <span title="{{ $a->koperasi->nama_usaha ?? '-' }}">
                                            {{ $a->koperasi->nama_usaha ?? '-' }}
                                        </span>
                                    </td>
                                    <td style="padding:12px">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ $a->distrik ?? '-' }}
                                    </td>
                                    <td style="padding:12px;white-space:normal;word-wrap:break-word">
                                        {{ $a->alamat_lengkap ?? $a->alamat ?? '-' }}
                                    </td>
                                    <td style="padding:12px">{{ $a->nama_usaha ?? '-' }}</td>
                                    <td style="padding:12px">{{ $a->bidang_usaha ?? '-' }}</td>
                                    <td style="padding:12px;text-align:right">
                                        <strong class="text-primary">Rp {{ number_format($a->simpanan_pokok ?? 0, 0, ',', '.') }}</strong>
                                    </td>
                                    <td style="padding:12px;text-align:right">
                                        <strong class="text-success">Rp {{ number_format($a->simpanan_wajib ?? 0, 0, ',', '.') }}</strong>
                                    </td>
                                    <td style="padding:12px">
                                        @if($a->status == 'Aktif')
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle mr-1"></i>Aktif
                                        </span>
                                        @elseif($a->status == 'Pending')
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                        @elseif($a->status == 'Ditolak')
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                        @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-ban mr-1"></i>Nonaktif
                                        </span>
                                        @endif
                                    </td>
                                    <td style="padding:12px">
                                        {{ $a->tanggal_bergabung ? \Carbon\Carbon::parse($a->tanggal_bergabung)->format('d M Y') : '-' }}
                                    </td>
                                    <td style="padding:12px;position:sticky;right:0;background:white;z-index:5">
                                        <div class="btn-group" role="group">
                                            <button onclick="showDetail({{ $a->id }})" 
                                                    class="btn btn-sm btn-info" 
                                                    style="border-radius:8px 0 0 8px"
                                                    title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if(can_edit('laporan'))
                                            <button onclick="editAnggota({{ $a->id }})" 
                                                    class="btn btn-sm btn-warning" 
                                                    style="border-radius:0"
                                                    title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @endif
                                            @if(can_delete('laporan'))
                                            <button onclick="deleteAnggota({{ $a->id }})" 
                                                    class="btn btn-sm btn-danger" 
                                                    style="border-radius:0 8px 8px 0"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="21" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block" style="opacity:0.3"></i>
                                        <p class="text-muted mb-0">Tidak ada data anggota</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($anggota->count() > 50)
                <div class="card-footer" style="background:white;border-radius:0 0 16px 16px;padding:20px">
                    <div class="alert alert-info mb-0" style="border-radius:10px">
                        <i class="fas fa-info-circle mr-2"></i>
                        Menampilkan 50 dari {{ $anggota->count() }} data. Download laporan untuk melihat semua data.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail --}}
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-detail-header">
                <h5 class="mb-0 font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Detail Anggota
                </h5>
            </div>
            <div class="modal-body" id="modalDetailContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border:none;padding:20px">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:10px">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
                <button type="button" onclick="printDetail()" class="btn btn-info" style="border-radius:10px">
                    <i class="fas fa-print mr-1"></i>Print Detail
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.animate-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.animate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.download-btn {
    transition: all 0.3s ease;
    text-align: center;
}

.download-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.modal-detail-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 20px;
    border-radius: 16px 16px 0 0;
}

.detail-row {
    padding: 12px 0;
    border-bottom: 1px solid #e5e7eb;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #6b7280;
    font-size: 0.9rem;
}

.detail-value {
    font-weight: 500;
    color: #1f2937;
}

/* Sticky columns styling */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table thead th {
    white-space: nowrap;
}

.table tbody td {
    white-space: nowrap;
}

/* Scrollbar styling */
.table-responsive::-webkit-scrollbar {
    height: 10px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Sticky column shadow */
.table tbody tr td:nth-child(1),
.table tbody tr td:nth-child(2) {
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}

.table tbody tr td:last-child {
    box-shadow: -2px 0 5px rgba(0,0,0,0.1);
}
</style>

<script>
// Show detail modal
function showDetail(id) {
    $('#modalDetail').modal('show');
    
    // Fetch detail
    $.ajax({
        url: '/pimpinan/laporan/koperasi/' + id,
        method: 'GET',
        success: function(response) {
            if (response.success) {
                const a = response.data;
                
                // Simpan data untuk print
                currentAnggotaData = a;
                
                let statusBadge = '';
                if (a.status == 'Aktif') {
                    statusBadge = '<span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i>Aktif</span>';
                } else if (a.status == 'Pending') {
                    statusBadge = '<span class="badge badge-warning"><i class="fas fa-clock mr-1"></i>Pending</span>';
                } else {
                    statusBadge = '<span class="badge badge-secondary"><i class="fas fa-ban mr-1"></i>Nonaktif</span>';
                }
                
                let html = `
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="alert alert-info" style="border-radius:10px">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Data Lengkap Pendaftaran Anggota Koperasi</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold mb-3" style="color:#1a3a6e;border-bottom:2px solid #1a3a6e;padding-bottom:8px">
                                <i class="fas fa-user mr-2"></i>DATA PRIBADI
                            </h6>
                            <div class="detail-row">
                                <div class="detail-label">No. Anggota</div>
                                <div class="detail-value"><span class="badge badge-primary">${a.no_anggota}</span></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Nama Lengkap</div>
                                <div class="detail-value"><strong>${a.nama_lengkap}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">NIK</div>
                                <div class="detail-value">${a.nik}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Tempat, Tgl Lahir</div>
                                <div class="detail-value">${a.tempat_lahir}, ${a.tanggal_lahir}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Jenis Kelamin</div>
                                <div class="detail-value">${a.jenis_kelamin == 'L' ? '<i class="fas fa-male text-primary mr-1"></i>Laki-laki' : '<i class="fas fa-female text-danger mr-1"></i>Perempuan'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Status Perkawinan</div>
                                <div class="detail-value">${a.status_perkawinan || '-'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Pendidikan Terakhir</div>
                                <div class="detail-value">${a.pendidikan_terakhir || '-'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Agama</div>
                                <div class="detail-value">${a.agama || '-'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">No. HP</div>
                                <div class="detail-value"><i class="fas fa-phone text-success mr-1"></i>${a.no_hp}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Email</div>
                                <div class="detail-value"><i class="fas fa-envelope text-info mr-1"></i>${a.email}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold mb-3" style="color:#1a3a6e;border-bottom:2px solid #1a3a6e;padding-bottom:8px">
                                <i class="fas fa-building mr-2"></i>DATA KOPERASI & USAHA
                            </h6>
                            <div class="detail-row">
                                <div class="detail-label">Koperasi</div>
                                <div class="detail-value"><i class="fas fa-building text-info mr-1"></i>${a.koperasi_nama || '-'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Distrik</div>
                                <div class="detail-value"><i class="fas fa-map-marker-alt text-danger mr-1"></i>${a.distrik}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Alamat Lengkap</div>
                                <div class="detail-value">${a.alamat}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Nama Usaha</div>
                                <div class="detail-value">${a.nama_usaha || '-'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Bidang Usaha</div>
                                <div class="detail-value">${a.bidang_usaha || '-'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Tanggal Bergabung</div>
                                <div class="detail-value"><i class="fas fa-calendar text-primary mr-1"></i>${a.tanggal_bergabung}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Simpanan Pokok</div>
                                <div class="detail-value text-primary"><strong>Rp ${parseInt(a.simpanan_pokok || 0).toLocaleString('id-ID')}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Simpanan Wajib</div>
                                <div class="detail-value text-success"><strong>Rp ${parseInt(a.simpanan_wajib || 0).toLocaleString('id-ID')}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">${statusBadge}</div>
                            </div>
                        </div>
                    </div>
                `;
                
                $('#modalDetailContent').html(html);
            }
        },
        error: function() {
            $('#modalDetailContent').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

// Print all data
function printAll() {
    const printWindow = window.open('', '', 'height=800,width=1400');
    
    // Get all data
    const data = allAnggotaData;
    const stats = statsData;
    
    // Get logo path - gunakan full URL agar bisa di-load di print window
    const logoPath = '{{ url("logo.png") }}';
    
    let html = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Rekap Data Anggota Koperasi</title>
            <style>
                @media print {
                    @page { size: A4 landscape; margin: 0.8cm; }
                    body { margin: 0; }
                }
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 7px; 
                    line-height: 1.3;
                    color: #333;
                }
                
                /* Header dengan Logo */
                .header-container {
                    display: table;
                    width: 100%;
                    margin-bottom: 10px;
                    border-bottom: 3px double #1a3a6e;
                    padding-bottom: 10px;
                }
                .header-logo {
                    display: table-cell;
                    width: 80px;
                    vertical-align: middle;
                    text-align: center;
                }
                .header-logo img {
                    width: 70px;
                    height: 70px;
                }
                .header-text {
                    display: table-cell;
                    vertical-align: middle;
                    text-align: center;
                }
                .header-text h1 {
                    margin: 0 0 3px 0;
                    font-size: 13px;
                    color: #1a3a6e;
                    font-weight: bold;
                }
                .header-text h2 {
                    margin: 0 0 3px 0;
                    font-size: 14px;
                    color: #1a3a6e;
                    font-weight: bold;
                }
                .header-text p {
                    margin: 2px 0;
                    font-size: 8px;
                    color: #666;
                }
                
                /* Title */
                .title {
                    text-align: center;
                    font-size: 16px;
                    font-weight: bold;
                    color: #1a3a6e;
                    margin: 15px 0 10px 0;
                }
                
                /* Info Section */
                .info-section {
                    margin: 8px 0;
                    padding: 5px;
                    background: #f8f9fa;
                    border-radius: 4px;
                    font-size: 8px;
                }
                
                /* Stats */
                .stats-container {
                    display: table;
                    width: 100%;
                    margin: 10px 0;
                    border-collapse: collapse;
                }
                .stat-box {
                    display: table-cell;
                    width: 25%;
                    text-align: center;
                    padding: 8px;
                    border: 2px solid #1a3a6e;
                    background: #f8f9fa;
                }
                .stat-box .number {
                    font-size: 18px;
                    font-weight: bold;
                    color: #1a3a6e;
                    display: block;
                    margin-bottom: 2px;
                }
                .stat-box .label {
                    font-size: 8px;
                    color: #666;
                    font-weight: bold;
                }
                
                /* Table */
                table { 
                    width: 100%; 
                    border-collapse: collapse; 
                    margin-top: 12px; 
                }
                th { 
                    background: #1a3a6e; 
                    color: white; 
                    padding: 5px 2px; 
                    font-size: 6px; 
                    font-weight: bold;
                    text-align: center;
                    border: 1px solid #000; 
                }
                td { 
                    padding: 3px 2px; 
                    border: 1px solid #ccc; 
                    font-size: 6px; 
                }
                tr:nth-child(even) { 
                    background: #f8f9fa; 
                }
                .text-center { text-align: center; }
                .text-right { text-align: right; }
                .text-left { text-align: left; }
                
                /* Badge */
                .badge { 
                    padding: 2px 4px; 
                    border-radius: 2px; 
                    font-size: 6px; 
                    font-weight: bold; 
                    display: inline-block;
                }
                .badge-success { background: #10b981; color: white; }
                .badge-warning { background: #f59e0b; color: white; }
                .badge-danger { background: #ef4444; color: white; }
                .badge-secondary { background: #6b7280; color: white; }
                
                /* Signature Section */
                .signature-section {
                    margin-top: 30px;
                    text-align: right;
                    padding-right: 50px;
                }
                .signature-box {
                    display: inline-block;
                    text-align: center;
                    min-width: 200px;
                }
                .signature-title {
                    font-size: 8px;
                    margin-bottom: 5px;
                }
                .signature-space {
                    height: 60px;
                }
                .signature-name {
                    font-size: 9px;
                    font-weight: bold;
                    border-bottom: 2px solid #000;
                    display: inline-block;
                    padding: 0 20px 2px 20px;
                    margin-bottom: 2px;
                }
                .signature-title-name {
                    font-size: 8px;
                }
                
                /* Footer */
                .footer { 
                    margin-top: 15px; 
                    padding-top: 8px;
                    border-top: 2px solid #1a3a6e;
                    text-align: center; 
                    font-size: 6px; 
                    color: #999; 
                }
                .footer p { margin: 2px 0; }
            </style>
        </head>
        <body>
            <!-- Header dengan Logo -->
            <table class="header-container" style="width:100%;margin-bottom:10px">
                <tr>
                    <td style="width:90px;text-align:center;vertical-align:middle;padding:5px">
                        <img src="${logoPath}" style="width:70px;height:70px;display:block;margin:0 auto" alt="Logo DISPERINDAGKOP" crossorigin="anonymous">
                    </td>
                    <td style="text-align:center;vertical-align:middle;padding:5px">
                        <h1 style="margin:0 0 3px 0;font-size:13px;color:#1a3a6e;font-weight:bold">PEMERINTAH KABUPATEN TOLIKARA</h1>
                        <h2 style="margin:0 0 3px 0;font-size:14px;color:#1a3a6e;font-weight:bold">DINAS PERINDUSTRIAN, PERDAGANGAN, KOPERASI DAN UMKM</h2>
                        <p style="margin:2px 0;font-size:8px;color:#666">Jl. Raya Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
                    </td>
                    <td style="width:90px"></td>
                </tr>
            </table>
            
            <div style="border-top:2px solid #1a3a6e;padding-top:5px;margin-bottom:10px"></div>
            
            <!-- Title -->
            <div class="title">REKAP DATA ANGGOTA KOPERASI</div>
            
            <!-- Info Section -->
            <div class="info-section">
                <strong>Tanggal Cetak:</strong> ${new Date().toLocaleDateString('id-ID', {day: '2-digit', month: 'long', year: 'numeric'})} - ${new Date().toLocaleTimeString('id-ID')} WIT
            </div>
            
            <!-- Statistics -->
            <div class="stats-container">
                <div class="stat-box">
                    <span class="number">${stats.total}</span>
                    <span class="label">Total Anggota</span>
                </div>
                <div class="stat-box">
                    <span class="number">${stats.aktif}</span>
                    <span class="label">Aktif</span>
                </div>
                <div class="stat-box">
                    <span class="number">${stats.pending}</span>
                    <span class="label">Pending</span>
                </div>
                <div class="stat-box">
                    <span class="number">${stats.nonaktif}</span>
                    <span class="label">Nonaktif</span>
                </div>
            </div>
            
            <!-- Data Table (21 Columns) -->
            <table>
                <thead>
                    <tr>
                        <th style="width:2%">No</th>
                        <th style="width:5%">No. Anggota</th>
                        <th style="width:8%">Nama Lengkap</th>
                        <th style="width:6%">NIK</th>
                        <th style="width:5%">Tempat Lahir</th>
                        <th style="width:4%">Tgl Lahir</th>
                        <th style="width:2%">JK</th>
                        <th style="width:4%">Status Kawin</th>
                        <th style="width:4%">Pendidikan</th>
                        <th style="width:3%">Agama</th>
                        <th style="width:5%">No. HP</th>
                        <th style="width:7%">Email</th>
                        <th style="width:8%">Koperasi</th>
                        <th style="width:4%">Distrik</th>
                        <th style="width:8%">Alamat</th>
                        <th style="width:5%">Nama Usaha</th>
                        <th style="width:4%">Bidang Usaha</th>
                        <th style="width:5%">Simp. Pokok</th>
                        <th style="width:5%">Simp. Wajib</th>
                        <th style="width:3%">Status</th>
                        <th style="width:4%">Tgl Gabung</th>
                    </tr>
                </thead>
                <tbody>
    `;
    
    data.forEach((a, index) => {
        let statusClass = 'secondary';
        if (a.status == 'Aktif') {
            statusClass = 'success';
        } else if (a.status == 'Pending') {
            statusClass = 'warning';
        } else if (a.status == 'Ditolak') {
            statusClass = 'danger';
        }
        
        // Format tanggal lahir
        let tglLahir = '-';
        if (a.tanggal_lahir) {
            const date = new Date(a.tanggal_lahir);
            tglLahir = date.toLocaleDateString('id-ID', {day: '2-digit', month: '2-digit', year: 'numeric'});
        }
        
        // Format tanggal bergabung
        let tglGabung = '-';
        if (a.tanggal_bergabung) {
            const date = new Date(a.tanggal_bergabung);
            tglGabung = date.toLocaleDateString('id-ID', {day: '2-digit', month: '2-digit', year: 'numeric'});
        }
        
        html += `
            <tr>
                <td class="text-center">${index + 1}</td>
                <td class="text-center">${a.no_anggota || '-'}</td>
                <td><strong>${a.nama || a.nama_lengkap || '-'}</strong></td>
                <td>${a.nik || '-'}</td>
                <td>${a.tempat_lahir || '-'}</td>
                <td class="text-center">${tglLahir}</td>
                <td class="text-center">${a.jenis_kelamin == 'L' ? 'L' : (a.jenis_kelamin == 'P' ? 'P' : '-')}</td>
                <td>${a.status_perkawinan || '-'}</td>
                <td>${a.pendidikan_terakhir || '-'}</td>
                <td>${a.agama || '-'}</td>
                <td>${a.no_hp || '-'}</td>
                <td>${a.email || '-'}</td>
                <td>${a.koperasi ? a.koperasi.nama_usaha : '-'}</td>
                <td>${a.distrik || '-'}</td>
                <td>${a.alamat_lengkap || a.alamat || '-'}</td>
                <td>${a.nama_usaha || '-'}</td>
                <td>${a.bidang_usaha || '-'}</td>
                <td class="text-right">Rp ${parseInt(a.simpanan_pokok || 0).toLocaleString('id-ID')}</td>
                <td class="text-right">Rp ${parseInt(a.simpanan_wajib || 0).toLocaleString('id-ID')}</td>
                <td class="text-center"><span class="badge badge-${statusClass}">${a.status || '-'}</span></td>
                <td class="text-center">${tglGabung}</td>
            </tr>
        `;
    });
    
    html += `
                </tbody>
            </table>
            
            <!-- Signature Section -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-title">Karubaga, ${new Date().toLocaleDateString('id-ID', {day: '2-digit', month: 'long', year: 'numeric'})}</div>
                    <div class="signature-title"><strong>Kepala Dinas</strong></div>
                    <div class="signature-space"></div>
                    <div class="signature-name">Wugi Kogoya, S.P</div>
                    <div class="signature-title-name">NIP. -</div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="footer">
                <p>Dokumen ini dicetak secara otomatis pada ${new Date().toLocaleString('id-ID')} WIT</p>
                <p>© ${new Date().getFullYear()} DISPERINDAGKOP Kabupaten Tolikara - Semua Hak Dilindungi</p>
            </div>
        </body>
        </html>
    `;
    
    printWindow.document.write(html);
    printWindow.document.close();
    
    // Wait for content to load then print
    setTimeout(() => {
        printWindow.print();
    }, 500);
}

// Print detail
let currentAnggotaData = null;

function printDetail() {
    if (!currentAnggotaData) {
        alert('Data tidak tersedia');
        return;
    }
    
    const a = currentAnggotaData;
    
    // Create print window
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Detail Anggota - ' + a.nama_lengkap + '</title>');
    printWindow.document.write('<style>body{font-family:Arial;padding:20px}table{width:100%;border-collapse:collapse}td{padding:8px;border-bottom:1px solid #ddd}.label{font-weight:bold;width:200px}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2>Detail Anggota Koperasi</h2>');
    printWindow.document.write('<table>');
    printWindow.document.write('<tr><td class="label">No. Anggota</td><td>' + a.no_anggota + '</td></tr>');
    printWindow.document.write('<tr><td class="label">Nama Lengkap</td><td>' + a.nama_lengkap + '</td></tr>');
    printWindow.document.write('<tr><td class="label">NIK</td><td>' + a.nik + '</td></tr>');
    printWindow.document.write('<tr><td class="label">Koperasi</td><td>' + (a.koperasi_nama || '-') + '</td></tr>');
    printWindow.document.write('<tr><td class="label">Distrik</td><td>' + a.distrik + '</td></tr>');
    printWindow.document.write('<tr><td class="label">Status</td><td>' + a.status + '</td></tr>');
    printWindow.document.write('</table>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

// Data anggota untuk print all
const allAnggotaData = @json($anggota);
const statsData = @json($stats);

// Create Anggota
function createAnggota() {
    window.location.href = '{{ route("pimpinan.anggota-koperasi.create") }}';
}

// Edit Anggota
function editAnggota(id) {
    window.location.href = `/pimpinan/anggota-koperasi/${id}/edit`;
}

// Delete Anggota
function deleteAnggota(id) {
    Swal.fire({
        title: 'Hapus Anggota?',
        text: "Data anggota akan dihapus permanen dari sistem!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="fas fa-trash mr-1"></i>Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times mr-1"></i>Batal',
        customClass: {
            confirmButton: 'btn btn-danger btn-lg',
            cancelButton: 'btn btn-secondary btn-lg'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            $.ajax({
                url: `/pimpinan/anggota-koperasi/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'animated bounceIn'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                },
                error: function(xhr) {
                    let message = 'Terjadi kesalahan saat menghapus data';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                }
            });
        }
    });
}
</script>

@endsection
