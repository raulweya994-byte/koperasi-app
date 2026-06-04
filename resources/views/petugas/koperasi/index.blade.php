@extends('layouts.app')
@section('title', 'Data Koperasi')

@push('styles')
<style>
/* Stats Card Modern */
.stats-card-modern {
    border-radius: 16px;
    padding: 25px;
    color: white;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.stats-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stats-card-body {
    position: relative;
    z-index: 2;
}

.stats-number {
    font-size: 36px;
    font-weight: 800;
    margin-bottom: 5px;
}

.stats-label {
    font-size: 14px;
    opacity: 0.95;
    font-weight: 600;
}

.stats-icon-wrapper {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.2;
}

/* Filter Card */
.filter-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    padding: 25px;
    margin-bottom: 25px;
}

/* Table Modern */
.table-modern {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.table-modern thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.table-modern thead th {
    border: none;
    padding: 15px 12px;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #ffffff !important;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.table-modern tbody td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f0f0;
    font-size: 13px;
}

.table-modern tbody tr:hover {
    background: #f8f9ff;
}

/* Badge Custom */
.badge-custom {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 600;
}

.badge-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
.badge-green { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-yellow { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-red { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
.badge-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }

/* Status Badge */
.status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-verified {
    background: #d1fae5;
    color: #065f46;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

/* Action Buttons */
.action-btn-group {
    display: flex;
    gap: 5px;
}

.btn-sm {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
}

/* Action Buttons */
.action-btn-group {
    display: flex;
    gap: 5px;
}

.btn-sm {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.2s;
}

.btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-info {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border: none;
    color: white;
}

.btn-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border: none;
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
    color: white;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state i {
    font-size: 64px;
    color: #e0e7ff;
    margin-bottom: 20px;
}

.empty-state h5 {
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 10px;
}

.empty-state p {
    color: #9ca3af;
    font-size: 14px;
}

@media (max-width: 768px) {
    .stats-number {
        font-size: 28px;
    }
    
    .table-modern {
        font-size: 11px;
    }
    
    .table-modern thead th,
    .table-modern tbody td {
        padding: 8px 6px;
        font-size: 11px;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['total'] }}</div>
                    <div class="stats-label">Total Koperasi</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-store fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #10b981, #059669);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['verified'] }}</div>
                    <div class="stats-label">Terverifikasi</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['pending'] }}</div>
                    <div class="stats-label">Menunggu Verifikasi</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card-modern" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <div class="stats-card-body">
                    <div class="stats-number">{{ $stats['rejected'] }}</div>
                    <div class="stats-label">Ditolak</div>
                    <div class="stats-icon-wrapper">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(16,185,129,0.2)">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(239,68,68,0.2)">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    {{-- Filter Card --}}
    <div class="filter-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="font-weight: 700; color: #1f2937;">
                <i class="fas fa-filter mr-2"></i>Filter & Export Data
            </h5>
            <div class="d-flex align-items-center">
                @if(can_create('koperasi'))
                    <a href="{{ route('petugas.koperasi.create') }}" class="btn btn-success btn-sm mr-2" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-plus mr-1"></i>Tambah Koperasi
                    </a>
                @endif
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm" onclick="exportExcel()">
                        <i class="fas fa-file-excel mr-1"></i>Excel
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="exportPDFKoperasi()">
                        <i class="fas fa-file-pdf mr-1"></i>PDF
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="exportWordKoperasi()">
                        <i class="fas fa-file-word mr-1"></i>Word
                    </button>
                    <button type="button" class="btn btn-info btn-sm" onclick="printDataKoperasi()">
                        <i class="fas fa-print mr-1"></i>Print
                    </button>
                </div>
            </div>
        </div>
        <form method="GET" action="{{ route('petugas.koperasi.index') }}" id="filterForm">
            <div class="row align-items-end">
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold" style="font-size: 13px; color: #495057;">
                        <i class="fas fa-search mr-1"></i>Pencarian
                    </label>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama usaha, pemilik, no. registrasi..." value="{{ request('search') }}" style="border-radius: 8px; border: 1.5px solid #dee2e6;">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold" style="font-size: 13px; color: #495057;">
                        <i class="fas fa-filter mr-1"></i>Status
                    </label>
                    <select name="status_verifikasi" class="form-control" style="border-radius: 8px; border: 1.5px solid #dee2e6;">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status_verifikasi')=='pending'?'selected':'' }}>Pending</option>
                        <option value="diverifikasi" {{ request('status_verifikasi')=='diverifikasi'?'selected':'' }}>Terverifikasi</option>
                        <option value="ditolak" {{ request('status_verifikasi')=='ditolak'?'selected':'' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold" style="font-size: 13px; color: #495057;">
                        <i class="fas fa-map-marker-alt mr-1"></i>Distrik
                    </label>
                    <select name="distrik" class="form-control" style="border-radius: 8px; border: 1.5px solid #dee2e6;">
                        <option value="">Semua Distrik</option>
                        @foreach($distrik as $d)
                        <option value="{{ $d }}" {{ request('distrik')==$d?'selected':'' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                </div>
                <div class="col-md-2 mb-3">
                    <a href="{{ route('petugas.koperasi.index') }}" class="btn btn-secondary btn-block" style="border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-redo mr-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="table-modern">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 150px;">No. Registrasi</th>
                        <th>Nama Usaha</th>
                        <th>Pemilik</th>
                        <th>Distrik</th>
                        <th>Jenis Usaha</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($koperasi as $i => $k)
                <tr>
                    <td><strong class="text-muted">{{ $koperasi->firstItem() + $i }}</strong></td>
                    <td><strong class="text-primary">{{ $k->no_registrasi }}</strong></td>
                    <td>
                        <strong>{{ $k->nama_usaha }}</strong><br>
                        <small class="text-muted">{{ $k->alamat_usaha ?? '-' }}</small>
                    </td>
                    <td>
                        <strong>{{ $k->nama_pemilik }}</strong><br>
                        <small class="text-muted"><i class="fab fa-whatsapp text-success mr-1"></i>{{ $k->no_hp }}</small>
                    </td>
                    <td><small>{{ $k->distrik }}</small></td>
                    <td><small>{{ $k->jenis_usaha ?? '-' }}</small></td>
                    <td>
                        @if($k->kategori === 'mikro')
                        <span class="badge-custom badge-blue">Mikro</span>
                        @elseif($k->kategori === 'kecil')
                        <span class="badge-custom badge-green">Kecil</span>
                        @else
                        <span class="badge-custom badge-yellow">Menengah</span>
                        @endif
                    </td>
                    <td>
                        @if($k->status_verifikasi === 'diverifikasi')
                        <span class="status-badge status-verified">Terverifikasi</span>
                        @elseif($k->status_verifikasi === 'pending')
                        <span class="status-badge status-pending">Pending</span>
                        @else
                        <span class="status-badge status-rejected">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btn-group">
                            @if(can_view('koperasi'))
                                <a href="{{ route('petugas.koperasi.show', $k) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endif
                            
                            @if(can_edit('koperasi'))
                                <a href="{{ route('petugas.koperasi.edit', $k) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            
                            @if(can_delete('koperasi'))
                                <form action="{{ route('petugas.koperasi.destroy', $k) }}" method="POST" style="display:inline" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <i class="fas fa-store"></i>
                            <h5>Tidak Ada Data Koperasi</h5>
                            <p>Belum ada data koperasi yang terdaftar</p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        
        @if($koperasi->hasPages())
        <div style="padding: 20px; border-top: 1px solid #f0f0f0;">
            {{ $koperasi->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="{{ asset('js/export-with-logo.js') }}"></script>

<script>
// Export to Excel (tanpa logo, langsung export tabel)
function exportExcel() {
    const table = document.querySelector('.table-modern table');
    const wb = XLSX.utils.table_to_book(table, {sheet: "Data Koperasi"});
    
    // Hapus kolom aksi
    const ws = wb.Sheets["Data Koperasi"];
    const range = XLSX.utils.decode_range(ws['!ref']);
    for (let R = range.s.r; R <= range.e.r; ++R) {
        const cell_address = XLSX.utils.encode_cell({r: R, c: range.e.c});
        delete ws[cell_address];
    }
    range.e.c--;
    ws['!ref'] = XLSX.utils.encode_range(range);
    
    XLSX.writeFile(wb, 'Data_Koperasi_' + new Date().toISOString().slice(0,10) + '.xlsx');
}

// Fungsi PDF, Word, dan Print sudah dipindahkan ke file export-with-logo.js
// dengan nama: exportPDFKoperasi(), exportWordKoperasi(), printDataKoperasi()

function confirmDelete(event) {
    event.preventDefault();
    const form = event.target;
    
    Swal.fire({
        title: 'Hapus Koperasi?',
        text: "Data koperasi akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    
    return false;
}
</script>
@endpush
