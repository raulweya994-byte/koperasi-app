@extends('layouts.app')
@section('title','Laporan Data Koperasi')
@section('page-title','Laporan Data Koperasi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.laporan.index') }}">Laporan</a></li>
<li class="breadcrumb-item active">Data Koperasi</li>
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
                    <form method="GET" action="{{ route('admin.laporan.koperasi') }}" id="filterForm">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Distrik
                                </label>
                                <select name="distrik" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Distrik</option>
                                    @foreach(\App\Models\Koperasi::listDistrik() as $d)
                                    <option value="{{ $d }}" {{ request('distrik') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600">
                                    <i class="fas fa-tag mr-1"></i>Kategori
                                </label>
                                <select name="kategori" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Kategori</option>
                                    <option value="mikro" {{ request('kategori') == 'mikro' ? 'selected' : '' }}>Mikro</option>
                                    <option value="kecil" {{ request('kategori') == 'kecil' ? 'selected' : '' }}>Kecil</option>
                                    <option value="menengah" {{ request('kategori') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600">
                                    <i class="fas fa-check-circle mr-1"></i>Status
                                </label>
                                <select name="status" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Status</option>
                                    <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-white mb-2 font-weight-600" style="opacity:0">Action</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-light flex-fill" style="border-radius:10px">
                                        <i class="fas fa-search mr-1"></i>Tampilkan
                                    </button>
                                    @if(request()->hasAny(['distrik', 'kategori', 'status']))
                                    <a href="{{ route('admin.laporan.koperasi') }}" class="btn btn-secondary" style="border-radius:10px">
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

    {{-- Download Buttons --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body p-4">
                    <h5 class="mb-3 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-download mr-2"></i>Download Laporan
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.laporan.exportWord', array_merge(['type'=>'koperasi'], request()->only(['distrik', 'kategori', 'status']))) }}" 
                               class="btn btn-primary btn-block btn-lg download-btn" 
                               style="border-radius:12px;padding:15px;text-decoration:none">
                                <i class="fas fa-file-word fa-2x mb-2 d-block"></i>
                                <strong>Download Word</strong>
                                <p class="mb-0 mt-1" style="font-size:12px;opacity:0.9">Format DOCX dengan layout profesional</p>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.laporan.exportExcel', array_merge(['type'=>'koperasi'], request()->only(['distrik', 'kategori', 'status']))) }}" 
                               class="btn btn-success btn-block btn-lg download-btn" 
                               style="border-radius:12px;padding:15px;text-decoration:none">
                                <i class="fas fa-file-excel fa-2x mb-2 d-block"></i>
                                <strong>Download Excel</strong>
                                <p class="mb-0 mt-1" style="font-size:12px;opacity:0.9">Format XLSX untuk analisis data</p>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button type="button" onclick="printAllData()" 
                                    class="btn btn-info btn-block btn-lg download-btn" 
                                    style="border-radius:12px;padding:15px;border:none">
                                <i class="fas fa-print fa-2x mb-2 d-block"></i>
                                <strong>Print Laporan</strong>
                                <p class="mb-0 mt-1" style="font-size:12px;opacity:0.9">Cetak langsung semua data</p>
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
                <div class="card-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 font-weight-bold text-white">
                            <i class="fas fa-table mr-2"></i>Preview Data Koperasi
                        </h5>
                        <span class="badge badge-light" style="font-size:14px;padding:8px 15px">
                            <i class="fas fa-database mr-1"></i>{{ $koperasi->count() }} Koperasi
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse:separate;border-spacing:0">
                            <thead style="background:linear-gradient(135deg,#1a1a1a,#2d2d2d);position:sticky;top:0;z-index:10">
                                <tr>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600;text-align:center">#</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600">No. Registrasi</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600">Nama Usaha / Pemilik</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600">Jenis Usaha</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600">Lokasi</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600;text-align:center">Kategori</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600;text-align:center">Status</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600;text-align:center">Tanggal</th>
                                    <th style="padding:15px;color:#fff;border:none;font-weight:600;text-align:center;width:180px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($koperasi->take(50) as $i => $k)
                                <tr style="border-bottom:2px solid #e5e7eb;transition:all 0.3s ease" 
                                    onmouseover="this.style.background='linear-gradient(135deg,#f0f9ff,#e0f2fe)';this.style.transform='scale(1.01)'" 
                                    onmouseout="this.style.background='';this.style.transform='scale(1)'">
                                    <td style="padding:15px;text-align:center;font-weight:600;color:#6b7280">
                                        {{ $i+1 }}
                                    </td>
                                    <td style="padding:15px">
                                        <div class="d-flex align-items-center">
                                            <div class="badge-modern" style="background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;padding:6px 12px;border-radius:8px;font-size:11px;font-weight:600">
                                                {{ $k->no_registrasi }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:15px">
                                        <div style="line-height:1.6">
                                            <div style="font-weight:700;color:#1a1a1a;font-size:14px;margin-bottom:4px">
                                                <i class="fas fa-store mr-1" style="color:#667eea"></i>{{ $k->nama_usaha }}
                                            </div>
                                            <div style="font-size:12px;color:#6b7280">
                                                <i class="fas fa-user mr-1"></i>{{ $k->nama_pemilik }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:15px">
                                        <span style="color:#374151;font-size:13px">{{ $k->jenis_usaha }}</span>
                                    </td>
                                    <td style="padding:15px">
                                        <div style="line-height:1.6">
                                            <div style="font-weight:600;color:#1a1a1a;font-size:13px;margin-bottom:3px">
                                                <i class="fas fa-map-marker-alt mr-1" style="color:#ef4444"></i>{{ $k->distrik }}
                                            </div>
                                            <div style="font-size:11px;color:#9ca3af">
                                                {{ $k->kelurahan }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:15px;text-align:center">
                                        @if($k->kategori == 'mikro')
                                            <span class="badge-kategori" style="background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;padding:6px 12px;border-radius:20px;font-size:11px;font-weight:600;display:inline-block">
                                                <i class="fas fa-circle mr-1" style="font-size:6px"></i>Mikro
                                            </span>
                                        @elseif($k->kategori == 'kecil')
                                            <span class="badge-kategori" style="background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:6px 12px;border-radius:20px;font-size:11px;font-weight:600;display:inline-block">
                                                <i class="fas fa-circle mr-1" style="font-size:6px"></i>Kecil
                                            </span>
                                        @else
                                            <span class="badge-kategori" style="background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;padding:6px 12px;border-radius:20px;font-size:11px;font-weight:600;display:inline-block">
                                                <i class="fas fa-circle mr-1" style="font-size:6px"></i>Menengah
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding:15px;text-align:center">
                                        @if($k->status_verifikasi === 'diverifikasi')
                                            <div class="status-badge-modern" style="background:#d1fae5;color:#065f46;padding:8px 12px;border-radius:10px;font-size:11px;font-weight:600;display:inline-block;border:2px solid #10b981">
                                                <i class="fas fa-check-circle mr-1"></i>Terverifikasi
                                            </div>
                                        @elseif($k->status_verifikasi === 'pending')
                                            <div class="status-badge-modern" style="background:#fef3c7;color:#92400e;padding:8px 12px;border-radius:10px;font-size:11px;font-weight:600;display:inline-block;border:2px solid #f59e0b">
                                                <i class="fas fa-clock mr-1"></i>Pending
                                            </div>
                                        @else
                                            <div class="status-badge-modern" style="background:#fee2e2;color:#991b1b;padding:8px 12px;border-radius:10px;font-size:11px;font-weight:600;display:inline-block;border:2px solid #ef4444">
                                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                                            </div>
                                        @endif
                                    </td>
                                    <td style="padding:15px;text-align:center">
                                        <div style="font-size:12px;color:#6b7280">
                                            <i class="far fa-calendar mr-1"></i>{{ $k->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td style="padding:15px;text-align:center">
                                        <div class="btn-group-modern" style="display:flex;gap:5px;justify-content:center">
                                            <button type="button" 
                                                    class="btn-action-modern btn-detail" 
                                                    onclick="showDetailKoperasi({{ $k->id }})"
                                                    title="Lihat Detail"
                                                    style="background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;border:none;padding:8px 12px;border-radius:8px;cursor:pointer;transition:all 0.3s">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('admin.koperasi.edit', $k->id) }}" 
                                               class="btn-action-modern btn-edit" 
                                               title="Edit Data"
                                               style="background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;border:none;padding:8px 12px;border-radius:8px;text-decoration:none;display:inline-block;transition:all 0.3s">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn-action-modern btn-delete" 
                                                    onclick="confirmDelete({{ $k->id }}, '{{ $k->nama_usaha }}')"
                                                    title="Hapus Data"
                                                    style="background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;border:none;padding:8px 12px;border-radius:8px;cursor:pointer;transition:all 0.3s">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div style="padding:40px">
                                            <i class="fas fa-inbox fa-4x mb-3 d-block" style="color:#e5e7eb"></i>
                                            <h5 style="color:#6b7280;font-weight:600">Tidak Ada Data</h5>
                                            <p style="color:#9ca3af;font-size:14px">Belum ada data koperasi yang tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($koperasi->count() > 50)
                <div class="card-footer" style="background:linear-gradient(135deg,#f0f9ff,#e0f2fe);border-radius:0 0 16px 16px;padding:20px;border:none">
                    <div class="alert mb-0" style="background:linear-gradient(135deg,#dbeafe,#bfdbfe);border:2px solid #3b82f6;border-radius:12px;padding:15px">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fa-2x mr-3" style="color:#2563eb"></i>
                            <div>
                                <strong style="color:#1e40af;font-size:14px">Informasi Preview</strong>
                                <p class="mb-0" style="color:#1e3a8a;font-size:13px">
                                    Menampilkan 50 dari {{ $koperasi->count() }} data. Download laporan Excel atau Word untuk melihat semua data lengkap.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.download-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: block;
}

.download-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    text-decoration: none;
}

.download-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.download-btn:hover::before {
    width: 300px;
    height: 300px;
}

.table-hover tbody tr:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.gap-2 {
    gap: 8px;
}

.btn-action-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}

.btn-action-modern:active {
    transform: translateY(-1px);
}

.badge-modern {
    transition: all 0.3s ease;
}

.badge-modern:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(102,126,234,0.4);
}

.badge-kategori {
    transition: all 0.3s ease;
}

.badge-kategori:hover {
    transform: scale(1.1);
}

.status-badge-modern {
    transition: all 0.3s ease;
}

.status-badge-modern:hover {
    transform: scale(1.05);
}

/* Smooth scroll */
.table-responsive {
    scroll-behavior: smooth;
}

/* Custom scrollbar */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #764ba2, #667eea);
}
</style>

{{-- Modal Detail Koperasi --}}
<div class="modal fade" id="modalDetailKoperasi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none">
                <h5 class="modal-title text-white font-weight-bold">
                    <i class="fas fa-store mr-2"></i>Detail Koperasi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="modalDetailKoperasiContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat data...</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Form Hapus --}}
<form id="deleteForm" method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>

<script>
// Data koperasi untuk print all
const allKoperasiData = @json($koperasi);
const filterData = {
    distrik: "{{ request('distrik') }}",
    kategori: "{{ request('kategori') }}",
    status: "{{ request('status') }}"
};

function printAllData() {
    const printWindow = window.open('', '_blank', 'width=1000,height=800');
    
    // Filter info
    let filterText = '';
    if (filterData.distrik) filterText += `Distrik: ${filterData.distrik} | `;
    if (filterData.kategori) filterText += `Kategori: ${filterData.kategori.charAt(0).toUpperCase() + filterData.kategori.slice(1)} | `;
    if (filterData.status) filterText += `Status: ${filterData.status.charAt(0).toUpperCase() + filterData.status.slice(1)} | `;
    if (!filterText) {
        filterText = 'Semua Data';
    } else {
        filterText = filterText.slice(0, -3); // Remove last " | "
    }
    
    // Calculate stats
    const statsData = {
        total: allKoperasiData.length,
        diverifikasi: allKoperasiData.filter(k => k.status_verifikasi === 'diverifikasi').length,
        pending: allKoperasiData.filter(k => k.status_verifikasi === 'pending').length,
        ditolak: allKoperasiData.filter(k => k.status_verifikasi === 'ditolak').length
    };
    
    // Generate table rows
    let tableRows = '';
    allKoperasiData.forEach((k, index) => {
        let statusBadge = '';
        let statusColor = '';
        if(k.status_verifikasi === 'diverifikasi') {
            statusBadge = 'Diverifikasi';
            statusColor = '#10b981';
        } else if(k.status_verifikasi === 'pending') {
            statusBadge = 'Pending';
            statusColor = '#f59e0b';
        } else {
            statusBadge = 'Ditolak';
            statusColor = '#ef4444';
        }
        
        let kategoriColor = '';
        if(k.kategori === 'mikro') {
            kategoriColor = '#3b82f6';
        } else if(k.kategori === 'kecil') {
            kategoriColor = '#10b981';
        } else {
            kategoriColor = '#f59e0b';
        }
        
        const bgColor = index % 2 === 0 ? '#f8f9fa' : '#ffffff';
        
        tableRows += `
            <tr style="background:${bgColor}">
                <td style="text-align:center">${index + 1}</td>
                <td>${k.no_registrasi || '-'}</td>
                <td><strong>${k.nama_usaha || '-'}</strong></td>
                <td>${k.nama_pemilik || '-'}</td>
                <td>${k.distrik || '-'}</td>
                <td style="text-align:center">
                    <span style="background:${kategoriColor};color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${k.kategori ? k.kategori.toUpperCase() : '-'}
                    </span>
                </td>
                <td style="text-align:center">
                    <span style="background:${statusColor};color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${statusBadge.toUpperCase()}
                    </span>
                </td>
                <td style="text-align:center">${k.created_at ? new Date(k.created_at).toLocaleDateString('id-ID') : '-'}</td>
            </tr>
        `;
    });
    
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Laporan Data Koperasi</title>
            <style>
                @media print {
                    @page {
                        size: A4 landscape;
                        margin: 15mm;
                    }
                    body {
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .no-print {
                        display: none !important;
                    }
                }
                
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body {
                    font-family: 'Arial', sans-serif;
                    font-size: 11px;
                    line-height: 1.4;
                    color: #333;
                    padding: 15px;
                }
                
                .header {
                    border-bottom: 3px solid #1a3a6e;
                    padding-bottom: 12px;
                    margin-bottom: 20px;
                    display: flex;
                    align-items: center;
                    gap: 15px;
                }
                
                .header-logo {
                    flex-shrink: 0;
                    width: 80px;
                    height: 80px;
                }
                
                .header-logo img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }
                
                .header-text {
                    flex: 1;
                    text-align: center;
                }
                
                .header-text h1 {
                    color: #1a3a6e;
                    font-size: 18px;
                    margin-bottom: 4px;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                
                .header-text h2 {
                    color: #1a3a6e;
                    font-size: 14px;
                    margin-bottom: 6px;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                
                .header-text p {
                    color: #666;
                    font-size: 10px;
                    margin: 2px 0;
                }
                
                .header-logo-right {
                    flex-shrink: 0;
                    width: 80px;
                    height: 80px;
                }
                
                .header-logo-right img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }
                
                .title {
                    text-align: center;
                    margin: 15px 0;
                    padding: 10px;
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    color: white;
                    border-radius: 6px;
                }
                
                .title h3 {
                    font-size: 14px;
                    font-weight: bold;
                    margin: 0;
                }
                
                .info-section {
                    margin-bottom: 15px;
                    padding: 10px;
                    background: #f8f9fa;
                    border-radius: 6px;
                    border-left: 4px solid #1a3a6e;
                }
                
                .info-section p {
                    margin: 3px 0;
                    font-size: 10px;
                }
                
                .stats-grid {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 10px;
                    margin-bottom: 15px;
                }
                
                .stat-box {
                    padding: 10px;
                    border-radius: 6px;
                    text-align: center;
                    color: white;
                }
                
                .stat-box h4 {
                    font-size: 20px;
                    margin-bottom: 3px;
                }
                
                .stat-box p {
                    font-size: 10px;
                    margin: 0;
                }
                
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 15px;
                    font-size: 10px;
                }
                
                table thead {
                    background: #1a3a6e;
                    color: white;
                }
                
                table th {
                    padding: 8px 5px;
                    text-align: left;
                    font-weight: bold;
                    border: 1px solid #1a3a6e;
                }
                
                table td {
                    padding: 6px 5px;
                    border: 1px solid #dee2e6;
                }
                
                .footer {
                    margin-top: 20px;
                    padding-top: 10px;
                    border-top: 2px solid #e5e7eb;
                    text-align: center;
                    color: #6b7280;
                    font-size: 9px;
                }
                
                .print-button {
                    position: fixed;
                    top: 15px;
                    right: 15px;
                    padding: 10px 20px;
                    background: #3b82f6;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    cursor: pointer;
                    font-size: 13px;
                    font-weight: bold;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    z-index: 1000;
                }
                
                .print-button:hover {
                    background: #2563eb;
                }
            </style>
        </head>
        <body>
            <button class="print-button no-print" onclick="window.print()">
                🖨️ Print Laporan
            </button>
            
            <div class="header">
                <div class="header-logo">
                    <img src="{{ asset('images/logo-tolikara.png') }}" alt="Logo Tolikara" onerror="this.style.display='none'">
                </div>
                <div class="header-text">
                    <h1>PEMERINTAH KABUPATEN TOLIKARA</h1>
                    <h2>DINAS PERINDUSTRIAN, PERDAGANGAN, KOPERASI DAN UMKM</h2>
                    <p>Jl. Raya Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
                    <p>Email: disperindagkop@tolikara.go.id | Telp: (0969) 12345</p>
                </div>
                <div class="header-logo-right">
                    <img src="{{ asset('images/logo-koperasi.png') }}" alt="Logo Koperasi" onerror="this.style.display='none'">
                </div>
            </div>
            
            <div class="title">
                <h3>LAPORAN DATA KOPERASI</h3>
            </div>
            
            <div class="info-section">
                <p><strong>Filter:</strong> ${filterText}</p>
                <p><strong>Tanggal Cetak:</strong> ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-box" style="background:#3b82f6">
                    <h4>${statsData.total}</h4>
                    <p>Total Koperasi</p>
                </div>
                <div class="stat-box" style="background:#10b981">
                    <h4>${statsData.diverifikasi}</h4>
                    <p>Diverifikasi</p>
                </div>
                <div class="stat-box" style="background:#f59e0b">
                    <h4>${statsData.pending}</h4>
                    <p>Pending</p>
                </div>
                <div class="stat-box" style="background:#ef4444">
                    <h4>${statsData.ditolak}</h4>
                    <p>Ditolak</p>
                </div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width:4%;text-align:center">No</th>
                        <th style="width:12%">No. Registrasi</th>
                        <th style="width:22%">Nama Usaha</th>
                        <th style="width:18%">Pemilik</th>
                        <th style="width:14%">Distrik</th>
                        <th style="width:10%;text-align:center">Kategori</th>
                        <th style="width:12%;text-align:center">Status</th>
                        <th style="width:8%;text-align:center">Tgl Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableRows}
                </tbody>
            </table>
            
            <div class="footer">
                <p><strong>Dokumen ini dicetak pada:</strong> ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })} WIT</p>
                <p style="margin-top: 5px;">© ${new Date().getFullYear()} DISPERINDAGKOP Kabupaten Tolikara - Semua Hak Dilindungi</p>
                <p style="margin-top: 3px;"><em>Total: ${allKoperasiData.length} Koperasi</em></p>
            </div>
        </body>
        </html>
    `;
    
    printWindow.document.write(printContent);
    printWindow.document.close();
}

function showDetailKoperasi(koperasiId) {
    $('#modalDetailKoperasi').modal('show');
    $('#modalDetailKoperasiContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Memuat data...</p>
        </div>
    `);
    
    $.ajax({
        url: '/admin/koperasi/' + koperasiId,
        method: 'GET',
        success: function(response) {
            // Extract content from the response
            const parser = new DOMParser();
            const doc = parser.parseFromString(response, 'text/html');
            const content = doc.querySelector('.container-fluid');
            
            if (content) {
                $('#modalDetailKoperasiContent').html(content.innerHTML);
            } else {
                $('#modalDetailKoperasiContent').html(`
                    <div class="p-4">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Tidak dapat memuat detail koperasi
                        </div>
                    </div>
                `);
            }
        },
        error: function() {
            $('#modalDetailKoperasiContent').html(`
                <div class="text-center py-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h5>Gagal Memuat Data</h5>
                    <p class="text-muted">Terjadi kesalahan saat memuat detail koperasi</p>
                    <button class="btn btn-primary" onclick="showDetailKoperasi(${koperasiId})">
                        <i class="fas fa-redo mr-1"></i>Coba Lagi
                    </button>
                </div>
            `);
        }
    });
}

function confirmDelete(koperasiId, namaUsaha) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `Apakah Anda yakin ingin menghapus koperasi:<br><strong>${namaUsaha}</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash mr-1"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
        reverseButtons: true,
        customClass: {
            popup: 'animated fadeInDown faster',
            confirmButton: 'btn btn-danger btn-lg px-4 mx-2',
            cancelButton: 'btn btn-secondary btn-lg px-4 mx-2'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            const form = document.getElementById('deleteForm');
            form.action = '/admin/koperasi/' + koperasiId;
            form.submit();
        }
    });
}

// Show success/error message if exists
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false,
        customClass: {
            popup: 'animated fadeInDown faster'
        }
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
@endif
</script>
@endsection
