@extends('layouts.app')
@section('title', 'Rekap Bantuan')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center text-white">
                        <div class="page-header-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div>
                            <h3 class="page-header-title">Rekap Bantuan</h3>
                            <p class="page-header-subtitle">Laporan dan statistik program bantuan koperasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-box">
                <form method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select name="tahun" class="form-control">
                                    <option value="">Semua Tahun</option>
                                    @for($y = date('Y'); $y >= 2020; $y--)
                                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary-modern btn-block">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="{{ route('petugas.laporan.bantuan') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="button" 
                                        onclick="printLaporan()" 
                                        class="btn btn-info btn-block" 
                                        title="Print Laporan">
                                    <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <a href="{{ route('petugas.laporan.exportExcel', ['type'=>'bantuan']) }}" 
                                   class="btn btn-success-modern btn-block" 
                                   title="Export Excel">
                                    <i class="fas fa-file-excel"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="{{ route('petugas.laporan.exportWord', ['type'=>'bantuan']) }}" 
                                   class="btn btn-primary-modern btn-block" 
                                   title="Export Word">
                                    <i class="fas fa-file-word mr-1"></i> Word
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tren per Tahun --}}
    @if($bantuanPerTahun->count() > 0)
    <div class="content-card mb-4">
        <div class="content-card-header">
            <h5 class="content-card-title">
                <i class="fas fa-chart-line"></i> Tren Penerima Bantuan per Tahun
            </h5>
        </div>
        <div class="content-card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th width="15%">Tahun</th>
                            <th width="20%">Jumlah Penerima</th>
                            <th width="25%">Total Nilai Bantuan</th>
                            <th width="40%">Grafik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bantuanPerTahun as $b)
                        <tr>
                            <td>
                                <strong style="color:#1a3a6e;font-size:16px">{{ $b->tahun }}</strong>
                            </td>
                            <td>
                                <span class="badge badge-custom badge-green" style="font-size:13px">
                                    <i class="fas fa-users mr-1"></i>{{ $b->total }} orang
                                </span>
                            </td>
                            <td>
                                <strong style="color:#059669">
                                    Rp {{ number_format($b->total_nilai, 0, ',', '.') }}
                                </strong>
                            </td>
                            <td>
                                <div class="progress" style="height:20px;border-radius:10px;background:#e5e7eb">
                                    <div class="progress-bar" 
                                         style="width:{{ $bantuanPerTahun->max('total') > 0 ? ($b->total / $bantuanPerTahun->max('total') * 100) : 0 }}%;background:linear-gradient(135deg,#10b981,#059669);border-radius:10px">
                                        <span style="font-size:11px;font-weight:600">
                                            {{ number_format($bantuanPerTahun->max('total') > 0 ? ($b->total / $bantuanPerTahun->max('total') * 100) : 0, 1) }}%
                                        </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- Tabel Program Bantuan --}}
    <div class="content-card">
        <div class="content-card-header">
            <h5 class="content-card-title">
                <i class="fas fa-list"></i> Daftar Program Bantuan
                <span class="badge badge-custom badge-blue ml-2">{{ $bantuan->total() }}</span>
            </h5>
        </div>
        
        <div class="content-card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Kode</th>
                            <th width="20%">Nama Program</th>
                            <th width="10%">Jenis</th>
                            <th width="8%">Tahun</th>
                            <th width="15%">Anggaran</th>
                            <th width="8%">Kuota</th>
                            <th width="12%">Penerima</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bantuan as $i => $b)
                        <tr>
                            <td>{{ $bantuan->firstItem() + $i }}</td>
                            <td>
                                <code style="background:#dcfce7;color:#059669;padding:4px 8px;border-radius:6px;font-size:11px;font-weight:600">
                                    {{ $b->kode_bantuan }}
                                </code>
                            </td>
                            <td>
                                <strong style="color:#1a3a6e">{{ $b->nama_bantuan }}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="far fa-calendar mr-1"></i>{{ $b->periode }}
                                </small>
                            </td>
                            <td>
                                <span class="badge badge-info-modern">
                                    {{ ucfirst($b->jenis_bantuan) }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $b->tahun }}</strong>
                            </td>
                            <td>
                                <small style="color:#059669;font-weight:600">
                                    Rp {{ number_format($b->anggaran, 0, ',', '.') }}
                                </small>
                            </td>
                            <td>
                                <span class="badge badge-custom badge-purple">
                                    {{ $b->kuota }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $b->jumlah_penerima >= $b->kuota ? 'danger-modern' : 'success-modern' }}">
                                    {{ $b->jumlah_penerima }} / {{ $b->kuota }}
                                </span>
                            </td>
                            <td>
                                @if($b->status === 'aktif')
                                    <span class="status-badge status-active">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @elseif($b->status === 'selesai')
                                    <span class="status-badge status-inactive">
                                        <i class="fas fa-flag-checkered"></i> Selesai
                                    </span>
                                @else
                                    <span class="status-badge status-rejected">
                                        <i class="fas fa-times-circle"></i> Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info-modern" 
                                        onclick="showDetail({{ $b->id }})"
                                        title="Lihat Detail">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">
                                <div class="empty-state">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <h5>Belum Ada Data Bantuan</h5>
                                    <p>Data program bantuan akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($bantuan->hasPages())
        <div class="content-card-body">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $bantuan->firstItem() }}–{{ $bantuan->lastItem() }} dari {{ $bantuan->total() }} program
                </small>
                <div>
                    {{ $bantuan->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal Detail Bantuan --}}
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none">
                <h5 class="modal-title text-white font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Detail Program Bantuan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="modalDetailContent">
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

<script>
// Data untuk print
const allBantuanData = @json($bantuan->items());
const bantuanPerTahunData = @json($bantuanPerTahun);
const filterData = {
    tahun: "{{ request('tahun') }}",
    status: "{{ request('status') }}"
};

function printLaporan() {
    const printWindow = window.open('', '_blank', 'width=1000,height=800');
    
    // Filter info
    let filterText = '';
    if (filterData.tahun) filterText += `Tahun: ${filterData.tahun} | `;
    if (filterData.status) filterText += `Status: ${filterData.status.charAt(0).toUpperCase() + filterData.status.slice(1)} | `;
    if (!filterText) {
        filterText = 'Semua Data';
    } else {
        filterText = filterText.slice(0, -3);
    }
    
    // Generate tren table
    let trenRows = '';
    bantuanPerTahunData.forEach((b, index) => {
        const bgColor = index % 2 === 0 ? '#f8f9fa' : '#ffffff';
        const maxTotal = Math.max(...bantuanPerTahunData.map(item => item.total));
        const percentage = maxTotal > 0 ? (b.total / maxTotal * 100) : 0;
        
        trenRows += `
            <tr style="background:${bgColor}">
                <td style="text-align:center;font-weight:bold;color:#1a3a6e">${b.tahun}</td>
                <td style="text-align:center">
                    <span style="background:#10b981;color:white;padding:4px 10px;border-radius:6px;font-size:11px;font-weight:bold">
                        ${b.total} orang
                    </span>
                </td>
                <td style="font-weight:600;color:#059669">
                    Rp ${new Intl.NumberFormat('id-ID').format(b.total_nilai)}
                </td>
                <td>
                    <div style="background:#e5e7eb;height:20px;border-radius:10px;position:relative">
                        <div style="background:linear-gradient(135deg,#10b981,#059669);width:${percentage}%;height:100%;border-radius:10px;display:flex;align-items:center;justify-content:center">
                            <span style="font-size:10px;color:white;font-weight:600">${percentage.toFixed(1)}%</span>
                        </div>
                    </div>
                </td>
            </tr>
        `;
    });
    
    // Generate bantuan table
    let bantuanRows = '';
    allBantuanData.forEach((b, index) => {
        const bgColor = index % 2 === 0 ? '#f8f9fa' : '#ffffff';
        
        let statusBadge = '';
        let statusColor = '';
        if(b.status === 'aktif') {
            statusBadge = 'Aktif';
            statusColor = '#10b981';
        } else if(b.status === 'selesai') {
            statusBadge = 'Selesai';
            statusColor = '#6b7280';
        } else {
            statusBadge = 'Dibatalkan';
            statusColor = '#ef4444';
        }
        
        bantuanRows += `
            <tr style="background:${bgColor}">
                <td style="text-align:center">${index + 1}</td>
                <td>
                    <code style="background:#dcfce7;color:#059669;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:600">
                        ${b.kode_bantuan}
                    </code>
                </td>
                <td>
                    <strong>${b.nama_bantuan}</strong><br>
                    <small style="color:#6b7280">${b.periode}</small>
                </td>
                <td style="text-align:center">
                    <span style="background:#3b82f6;color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${b.jenis_bantuan.toUpperCase()}
                    </span>
                </td>
                <td style="text-align:center;font-weight:600">${b.tahun}</td>
                <td style="color:#059669;font-weight:600;font-size:11px">
                    Rp ${new Intl.NumberFormat('id-ID').format(b.anggaran)}
                </td>
                <td style="text-align:center">
                    <span style="background:#764ba2;color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${b.kuota}
                    </span>
                </td>
                <td style="text-align:center">
                    <span style="background:${b.jumlah_penerima >= b.kuota ? '#ef4444' : '#10b981'};color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${b.jumlah_penerima} / ${b.kuota}
                    </span>
                </td>
                <td style="text-align:center">
                    <span style="background:${statusColor};color:white;padding:3px 8px;border-radius:4px;font-size:10px;font-weight:bold">
                        ${statusBadge.toUpperCase()}
                    </span>
                </td>
            </tr>
        `;
    });
    
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Laporan Rekap Bantuan</title>
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
                
                .section-title {
                    background: linear-gradient(135deg, #1a3a6e, #2d5a8e);
                    color: white;
                    padding: 8px 12px;
                    border-radius: 6px;
                    margin: 15px 0 10px 0;
                    font-size: 12px;
                    font-weight: bold;
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
                <h3>LAPORAN REKAP BANTUAN KOPERASI</h3>
            </div>
            
            <div class="info-section">
                <p><strong>Filter:</strong> ${filterText}</p>
                <p><strong>Tanggal Cetak:</strong> ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
            </div>
            
            ${bantuanPerTahunData.length > 0 ? `
            <div class="section-title">
                <i class="fas fa-chart-line"></i> TREN PENERIMA BANTUAN PER TAHUN
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width:15%;text-align:center">Tahun</th>
                        <th style="width:20%;text-align:center">Jumlah Penerima</th>
                        <th style="width:25%">Total Nilai Bantuan</th>
                        <th style="width:40%">Grafik Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    ${trenRows}
                </tbody>
            </table>
            ` : ''}
            
            <div class="section-title">
                <i class="fas fa-list"></i> DAFTAR PROGRAM BANTUAN
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width:4%;text-align:center">No</th>
                        <th style="width:10%">Kode</th>
                        <th style="width:22%">Nama Program</th>
                        <th style="width:8%;text-align:center">Jenis</th>
                        <th style="width:6%;text-align:center">Tahun</th>
                        <th style="width:15%">Anggaran</th>
                        <th style="width:8%;text-align:center">Kuota</th>
                        <th style="width:10%;text-align:center">Penerima</th>
                        <th style="width:10%;text-align:center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    ${bantuanRows}
                </tbody>
            </table>
            
            <div class="footer">
                <p><strong>Dokumen ini dicetak pada:</strong> ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })} WIT</p>
                <p style="margin-top: 5px;">© ${new Date().getFullYear()} DISPERINDAGKOP Kabupaten Tolikara - Semua Hak Dilindungi</p>
                <p style="margin-top: 3px;"><em>Total: ${allBantuanData.length} Program Bantuan</em></p>
            </div>
        </body>
        </html>
    `;
    
    printWindow.document.write(printContent);
    printWindow.document.close();
}

function showDetail(bantuanId) {
    $('#modalDetail').modal('show');
    $('#modalDetailContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Memuat data...</p>
        </div>
    `);
    
    $.ajax({
        url: '/admin/laporan/bantuan/' + bantuanId + '/detail',
        method: 'GET',
        success: function(response) {
            $('#modalDetailContent').html(response);
        },
        error: function() {
            $('#modalDetailContent').html(`
                <div class="text-center py-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h5>Gagal Memuat Data</h5>
                    <p class="text-muted">Terjadi kesalahan saat memuat detail bantuan</p>
                    <button class="btn btn-primary" onclick="showDetail(${bantuanId})">
                        <i class="fas fa-redo mr-1"></i>Coba Lagi
                    </button>
                </div>
            `);
        }
    });
}
</script>
@endsection