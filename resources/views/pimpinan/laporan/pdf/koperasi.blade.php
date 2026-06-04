<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Data Anggota Koperasi</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0.8cm;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 7px;
            line-height: 1.2;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 3px double #1a3a6e;
            padding-bottom: 10px;
        }
        
        .header-table {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .header-table td {
            vertical-align: middle;
        }
        
        .logo {
            width: 70px;
            height: 70px;
        }
        
        .header h1 {
            margin: 0 0 3px 0;
            font-size: 13px;
            color: #1a3a6e;
            font-weight: bold;
        }
        
        .header h2 {
            margin: 0 0 3px 0;
            font-size: 14px;
            color: #1a3a6e;
            font-weight: bold;
        }
        
        .header p {
            margin: 2px 0;
            font-size: 8px;
            color: #666;
        }
        
        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #1a3a6e;
            margin: 15px 0;
        }
        
        .info-section {
            margin: 10px 0;
            padding: 6px;
            background: #f8f9fa;
            border-radius: 4px;
        }
        
        .info-section p {
            margin: 2px 0;
            font-size: 8px;
        }
        
        .stats-container {
            display: table;
            width: 100%;
            margin: 12px 0;
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
        
        .stat-box.aktif {
            border-color: #10b981;
        }
        
        .stat-box.aktif .number {
            color: #10b981;
        }
        
        .stat-box.pending {
            border-color: #f59e0b;
        }
        
        .stat-box.pending .number {
            color: #f59e0b;
        }
        
        .stat-box.nonaktif {
            border-color: #6b7280;
        }
        
        .stat-box.nonaktif .number {
            color: #6b7280;
        }
        
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
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-left {
            text-align: left;
        }
        
        .badge {
            padding: 2px 4px;
            border-radius: 2px;
            font-size: 6px;
            font-weight: bold;
            display: inline-block;
        }
        
        .badge-success {
            background: #10b981;
            color: white;
        }
        
        .badge-warning {
            background: #f59e0b;
            color: white;
        }
        
        .badge-danger {
            background: #ef4444;
            color: white;
        }
        
        .badge-secondary {
            background: #6b7280;
            color: white;
        }
        
        .footer {
            margin-top: 12px;
            padding-top: 8px;
            border-top: 2px solid #1a3a6e;
            text-align: center;
            font-size: 6px;
            color: #999;
        }
        
        .footer p {
            margin: 2px 0;
        }
    </style>
</head>
<body>
    {{-- Header with Logo --}}
    <table class="header-table">
        <tr>
            <td style="width: 80px; text-align: center;">
                @php
                    $logoPath = public_path('assets/img/logo.png');
                    if (!file_exists($logoPath)) {
                        $logoPath = public_path('logo.png');
                    }
                @endphp
                @if(file_exists($logoPath))
                    <img src="{{ $logoPath }}" class="logo" alt="Logo">
                @endif
            </td>
            <td style="text-align: center;">
                <h1>PEMERINTAH KABUPATEN TOLIKARA</h1>
                <h2>DINAS PERINDUSTRIAN, PERDAGANGAN, KOPERASI DAN UMKM</h2>
                <p>Jl. Raya Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
            </td>
            <td style="width: 80px;"></td>
        </tr>
    </table>
    
    <div class="header" style="border-top: 2px solid #1a3a6e; padding-top: 5px;"></div>
    
    {{-- Title --}}
    <div class="title">REKAP DATA ANGGOTA KOPERASI</div>
    
    {{-- Info Section --}}
    <div class="info-section">
        <p><strong>Filter:</strong> {{ $filterText }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>
    
    {{-- Statistics --}}
    <div class="stats-container">
        <div class="stat-box">
            <span class="number">{{ $stats['total'] }}</span>
            <span class="label">Total Anggota</span>
        </div>
        <div class="stat-box aktif">
            <span class="number">{{ $stats['aktif'] }}</span>
            <span class="label">Aktif</span>
        </div>
        <div class="stat-box pending">
            <span class="number">{{ $stats['pending'] }}</span>
            <span class="label">Pending</span>
        </div>
        <div class="stat-box nonaktif">
            <span class="number">{{ $stats['nonaktif'] }}</span>
            <span class="label">Nonaktif</span>
        </div>
    </div>
    
    {{-- Data Table (21 Columns) --}}
    <table>
        <thead>
            <tr>
                <th style="width: 2%;">No</th>
                <th style="width: 5%;">No. Anggota</th>
                <th style="width: 8%;">Nama Lengkap</th>
                <th style="width: 6%;">NIK</th>
                <th style="width: 5%;">Tempat Lahir</th>
                <th style="width: 4%;">Tgl Lahir</th>
                <th style="width: 2%;">JK</th>
                <th style="width: 4%;">Status Kawin</th>
                <th style="width: 4%;">Pendidikan</th>
                <th style="width: 3%;">Agama</th>
                <th style="width: 5%;">No. HP</th>
                <th style="width: 7%;">Email</th>
                <th style="width: 8%;">Koperasi</th>
                <th style="width: 4%;">Distrik</th>
                <th style="width: 8%;">Alamat</th>
                <th style="width: 5%;">Nama Usaha</th>
                <th style="width: 4%;">Bidang Usaha</th>
                <th style="width: 5%;">Simp. Pokok</th>
                <th style="width: 5%;">Simp. Wajib</th>
                <th style="width: 3%;">Status</th>
                <th style="width: 4%;">Tgl Gabung</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $a)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $a->no_anggota ?? '-' }}</td>
                <td><strong>{{ $a->nama ?? $a->nama_lengkap ?? '-' }}</strong></td>
                <td>{{ $a->nik ?? '-' }}</td>
                <td>{{ $a->tempat_lahir ?? '-' }}</td>
                <td class="text-center">{{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                <td class="text-center">{{ $a->jenis_kelamin == 'L' ? 'L' : ($a->jenis_kelamin == 'P' ? 'P' : '-') }}</td>
                <td>{{ $a->status_perkawinan ?? '-' }}</td>
                <td>{{ $a->pendidikan_terakhir ?? '-' }}</td>
                <td>{{ $a->agama ?? '-' }}</td>
                <td>{{ $a->no_hp ?? '-' }}</td>
                <td>{{ $a->email ?? '-' }}</td>
                <td>{{ $a->koperasi->nama_usaha ?? '-' }}</td>
                <td>{{ $a->distrik ?? '-' }}</td>
                <td>{{ $a->alamat_lengkap ?? $a->alamat ?? '-' }}</td>
                <td>{{ $a->nama_usaha ?? '-' }}</td>
                <td>{{ $a->bidang_usaha ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($a->simpanan_pokok ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($a->simpanan_wajib ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">
                    @if($a->status == 'Aktif')
                        <span class="badge badge-success">Aktif</span>
                    @elseif($a->status == 'Pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($a->status == 'Ditolak')
                        <span class="badge badge-danger">Ditolak</span>
                    @else
                        <span class="badge badge-secondary">Nonaktif</span>
                    @endif
                </td>
                <td class="text-center">{{ $a->tanggal_bergabung ? \Carbon\Carbon::parse($a->tanggal_bergabung)->format('d/m/Y') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="21" class="text-center" style="padding: 15px;">
                    Tidak ada data anggota
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    {{-- Footer --}}
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis pada {{ date('d F Y, H:i:s') }} WIT</p>
        <p>© {{ date('Y') }} DISPERINDAGKOP Kabupaten Tolikara - Semua Hak Dilindungi</p>
    </div>
    
    {{-- Signature Section --}}
    <div style="margin-top:30px;text-align:right;padding-right:50px">
        <div style="display:inline-block;text-align:center;min-width:200px">
            <p style="font-size:8px;margin-bottom:5px">Karubaga, {{ date('d F Y') }}</p>
            <p style="font-size:8px;margin-bottom:5px"><strong>Kepala Dinas</strong></p>
            <div style="height:60px"></div>
            <p style="font-size:9px;font-weight:bold;border-bottom:2px solid #000;display:inline-block;padding:0 20px 2px 20px;margin-bottom:2px">Wugi Kogoya, S.P</p>
            <p style="font-size:8px;margin:0">NIP. -</p>
        </div>
    </div>
</body>
</html>
