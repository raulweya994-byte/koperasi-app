@extends('layouts.anggota')
@section('title','Kartu Anggota')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Kartu Anggota</li>
@endsection

@push('styles')
<style>
@page {
    margin: 0;
    size: 85.6mm 53.98mm landscape;
}

body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

/* Action Buttons */
.action-buttons {
    text-align: center;
    margin: 40px 0;
}

.btn-action {
    padding: 15px 40px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 800;
    border: none;
    transition: all 0.3s ease;
    margin: 0 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.btn-print {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

.btn-print:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(59, 130, 246, 0.4);
    color: white;
}

.btn-download {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
}

.btn-download:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(16,185,129,0.4);
    color: #fff;
}

/* KARTU ANGGOTA */
.kartu-container {
    width: 85.6mm;
    height: 53.98mm;
    position: relative;
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    overflow: hidden;
    border-radius: 3mm;
    box-sizing: border-box;
    margin: 0 auto;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
}

.kartu-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.08;
    background-image: 
        repeating-linear-gradient(0deg, transparent, transparent 1.5mm, rgba(30,58,138,.1) 1.5mm, rgba(30,58,138,.1) 3mm);
}

.kartu-content {
    position: relative;
    z-index: 2;
    padding: 4mm 5mm;
    color: #1e293b;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
}

/* Header dengan Logo Tunggal */
.kartu-header-with-logo {
    display: flex;
    align-items: center;
    gap: 3mm;
    margin-bottom: 3mm;
}

.kartu-logo-single {
    width: 16mm;
    height: 16mm;
    flex-shrink: 0;
}

.kartu-logo-single img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.kartu-header-text {
    flex: 1;
}

.kartu-header-text h3 {
    margin: 0;
    font-size: 8pt;
    font-weight: bold;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    line-height: 1.3;
}

.kartu-header-text h4 {
    margin: 1mm 0 0 0;
    font-size: 7.5pt;
    font-weight: bold;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: 0.2px;
    line-height: 1.2;
}

/* Body dengan Foto di Kanan */
.kartu-body {
    display: flex;
    gap: 4mm;
    flex: 1;
}

/* Data Identitas Penting di Kiri */
.kartu-data {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.kartu-data table {
    width: 100%;
    font-size: 6.5pt;
    line-height: 1.4;
    border-collapse: collapse;
}

.kartu-data td {
    padding: 1mm 0;
    vertical-align: top;
}

.kartu-data td:first-child {
    width: 18mm;
    color: #475569;
    font-weight: 600;
}

.kartu-data td:nth-child(2) {
    width: 2mm;
    color: #475569;
}

.kartu-data td:last-child {
    color: #1e293b;
    font-weight: bold;
    text-transform: uppercase;
}

/* Foto di Kanan */
.kartu-foto {
    width: 24mm;
    height: 30mm;
    background: white;
    border: 0.5mm solid #94a3b8;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 1mm 3mm rgba(0,0,0,0.2);
    position: relative;
    display: flex;
    flex-direction: column;
    border-radius: 1mm;
}

.kartu-foto img {
    width: 100%;
    flex: 1;
    object-fit: cover;
}

/* Footer */
.kartu-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2mm;
    padding-top: 2mm;
    border-top: 0.5mm solid rgba(30,58,138,0.3);
}

.kartu-no-anggota {
    font-size: 8pt;
    color: #1e293b;
    font-weight: bold;
    letter-spacing: 0.5px;
}

.kartu-tanggal {
    font-size: 7pt;
    color: #475569;
    font-weight: 600;
}

@media print {
    body {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    .action-buttons {
        display: none !important;
    }
    
    .kartu-container {
        box-shadow: none;
    }
}
</style>
@endpush

@section('content')
<div class="container mt-4">
    {{-- Action Buttons --}}
    <div class="action-buttons">
        <button onclick="window.print()" class="btn btn-action btn-print">
            <i class="fas fa-print mr-2"></i>Cetak Kartu
        </button>
        <button onclick="downloadCard()" class="btn btn-action btn-download">
            <i class="fas fa-download mr-2"></i>Download PNG
        </button>
    </div>

    {{-- Kartu Anggota --}}
    <div class="kartu-container" id="kartu-cetak">
        <div class="kartu-pattern"></div>
        <div class="kartu-content">
            {{-- Header dengan 1 Logo di Kiri --}}
            <div class="kartu-header-with-logo">
                <div class="kartu-logo-single">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                </div>
                <div class="kartu-header-text">
                    <h3>PROVINSI PAPUA PEGUNUNGAN</h3>
                    <h4>KABUPATEN TOLIKARA</h4>
                </div>
            </div>
            
            {{-- Body: Data Identitas Lengkap + Foto --}}
            <div class="kartu-body">
                {{-- Data Identitas Lengkap di Kiri --}}
                <div class="kartu-data">
                    <table>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $anggota->nik }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ strtoupper($anggota->nama) }}</td>
                        </tr>
                        <tr>
                            <td>Tempat/Tgl Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($anggota->tempat_lahir) }}, {{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ strtoupper($anggota->alamat_lengkap ?? $anggota->desa) }}</td>
                        </tr>
                        <tr>
                            <td>Desa</td>
                            <td>:</td>
                            <td>{{ strtoupper($anggota->desa) }}</td>
                        </tr>
                        <tr>
                            <td>Distrik</td>
                            <td>:</td>
                            <td>{{ strtoupper($anggota->distrik) }}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>:</td>
                            <td>{{ strtoupper($anggota->kabupaten ?? 'TOLIKARA') }}</td>
                        </tr>
                        <tr>
                            <td>Nama Usaha</td>
                            <td>:</td>
                            <td>{{ strtoupper($anggota->nama_usaha ?? '-') }}</td>
                        </tr>
                    </table>
                </div>
                
                {{-- Foto di Kanan --}}
                <div class="kartu-foto">
                    <img src="{{ $anggota->foto_url }}" alt="Foto" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div style="display:none; width:100%; flex:1; background:#e5e7eb; align-items:center; justify-content:center; color:#9ca3af; font-size:8pt; flex-direction:column;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="8" r="4" fill="#9ca3af"/>
                            <path d="M6 21C6 17.134 8.686 14 12 14C15.314 14 18 17.134 18 21" stroke="#9ca3af" stroke-width="2"/>
                        </svg>
                        <span style="font-size:6pt; margin-top:1mm;">No Photo</span>
                    </div>
                </div>
            </div>
            
            {{-- Footer dengan No. Anggota dan Tanggal --}}
            <div class="kartu-footer">
                <div class="kartu-tanggal">
                    Terdaftar: {{ $anggota->created_at->format('d-m-Y') }}
                </div>
                <div class="kartu-no-anggota">
                    No. Anggota: {{ $anggota->no_anggota }}
                </div>
            </div>
        </div>
    </div>

    {{-- Info Text --}}
    <div class="text-center mt-4 mb-5">
        <p class="text-muted" style="font-size:14px">
            <i class="fas fa-info-circle mr-2"></i>
            Kartu ini dapat dicetak atau didownload untuk keperluan administrasi koperasi
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function downloadCard() {
    const card = document.getElementById('kartu-cetak');
    const buttons = document.querySelector('.action-buttons');
    
    // Hide buttons temporarily
    buttons.style.display = 'none';
    
    html2canvas(card, {
        scale: 3,
        backgroundColor: null,
        logging: false,
        useCORS: true
    }).then(canvas => {
        // Create download link
        const link = document.createElement('a');
        link.download = 'Kartu-Anggota-{{ $anggota->no_anggota }}.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
        
        // Show buttons again
        buttons.style.display = 'block';
    });
}
</script>
@endpush
