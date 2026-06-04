@extends('layouts.app')
@section('title','Laporan Pendaftaran Anggota Koperasi')
@section('page-title','Laporan Pendaftaran Anggota Koperasi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('pimpinan.laporan.index') }}">Laporan</a></li>
<li class="breadcrumb-item active">Pendaftaran Anggota</li>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Filter Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#667eea,#764ba2)">
                <div class="card-body p-4">
                    <h5 class="text-white mb-3 font-weight-bold">
                        <i class="fas fa-filter mr-2"></i>Filter Laporan
                    </h5>
                    <form method="GET" action="{{ route('pimpinan.laporan.anggota') }}" id="filterForm">
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
                                    <a href="{{ route('pimpinan.laporan.anggota') }}" class="btn btn-secondary" style="border-radius:10px">
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
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('pimpinan.laporan.anggota.word', ['distrik' => request('distrik'), 'koperasi_id' => request('koperasi_id'), 'status' => request('status')]) }}" 
                               class="btn btn-primary btn-block btn-lg download-btn" 
                               style="border-radius:12px;padding:15px;text-decoration:none">
                                <i class="fas fa-file-word fa-2x mb-2 d-block"></i>
                                <strong>Download Word</strong><br>
                                <small>Format DOCX dengan layout profesional</small>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('pimpinan.laporan.anggota.excel', ['distrik' => request('distrik'), 'koperasi_id' => request('koperasi_id'), 'status' => request('status')]) }}" 
                               class="btn btn-success btn-block btn-lg download-btn" 
                               style="border-radius:12px;padding:15px;text-decoration:none">
                                <i class="fas fa-file-excel fa-2x mb-2 d-block"></i>
                                <strong>Download Excel</strong><br>
                                <small>Format XLSX untuk analisis data</small>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
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
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-table mr-2"></i>Preview Data ({{ $anggota->count() }} Anggota)
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse:separate;border-spacing:0">
                            <thead style="background:linear-gradient(135deg,#1e3a8a,#1e40af);color:white">
                                <tr>
                                    <th style="padding:15px;border:none">#</th>
                                    <th style="padding:15px;border:none">No. Anggota</th>
                                    <th style="padding:15px;border:none">Nama Lengkap</th>
                                    <th style="padding:15px;border:none">NIK</th>
                                    <th style="padding:15px;border:none">Koperasi</th>
                                    <th style="padding:15px;border:none">Distrik</th>
                                    <th style="padding:15px;border:none">Status</th>
                                    <th style="padding:15px;border:none">Tgl Bergabung</th>
                                    <th style="padding:15px;border:none">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($anggota->take(50) as $i => $a)
                                <tr style="border-bottom:1px solid #e5e7eb">
                                    <td style="padding:15px">{{ $i+1 }}</td>
                                    <td style="padding:15px">
                                        <span class="badge badge-primary">{{ $a->no_anggota }}</span>
                                    </td>
                                    <td style="padding:15px">
                                        <strong style="color:#1a3a6e">{{ $a->nama_lengkap }}</strong>
                                    </td>
                                    <td style="padding:15px">{{ $a->nik }}</td>
                                    <td style="padding:15px">
                                        <i class="fas fa-building text-info mr-1"></i>
                                        {{ $a->koperasi->nama_usaha ?? '-' }}
                                    </td>
                                    <td style="padding:15px">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                        {{ $a->distrik }}
                                    </td>
                                    <td style="padding:15px">
                                        @if($a->status == 'Aktif')
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle mr-1"></i>Aktif
                                        </span>
                                        @elseif($a->status == 'Pending')
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                        @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-ban mr-1"></i>Nonaktif
                                        </span>
                                        @endif
                                    </td>
                                    <td style="padding:15px">
                                        {{ $a->tanggal_bergabung ? \Carbon\Carbon::parse($a->tanggal_bergabung)->format('d M Y') : '-' }}
                                    </td>
                                    <td style="padding:15px">
                                        <button onclick="showDetail({{ $a->id }})" 
                                                class="btn btn-sm btn-info" 
                                                style="border-radius:8px">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
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
</style>

<script>
// Show detail modal
function showDetail(id) {
    $('#modalDetail').modal('show');
    
    // Fetch detail
    $.ajax({
        url: '/pimpinan/laporan/anggota/' + id,
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
                        <div class="col-md-6">
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
                                <div class="detail-value">${a.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">No. HP</div>
                                <div class="detail-value"><i class="fas fa-phone text-success mr-1"></i>${a.no_hp}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-row">
                                <div class="detail-label">Koperasi</div>
                                <div class="detail-value"><i class="fas fa-building text-info mr-1"></i>${a.koperasi_nama || '-'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Distrik</div>
                                <div class="detail-value"><i class="fas fa-map-marker-alt text-danger mr-1"></i>${a.distrik}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Alamat</div>
                                <div class="detail-value">${a.alamat}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Simpanan Pokok</div>
                                <div class="detail-value text-primary"><strong>Rp ${parseInt(a.simpanan_pokok || 0).toLocaleString('id-ID')}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Simpanan Wajib</div>
                                <div class="detail-value text-primary"><strong>Rp ${parseInt(a.simpanan_wajib || 0).toLocaleString('id-ID')}</strong></div>
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
    // Implementation for print all
    window.print();
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
</script>

@endsection
