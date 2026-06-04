<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pengumuman - {{ $pengumuman->judul }}</title>
    <style>
        @page {
            margin: 1.5cm 2cm;
            size: A4 portrait;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #000;
        }
        
        .kop-surat img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        
        .kop-surat h3 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0 0 3px 0;
            text-transform: uppercase;
            color: #000;
        }
        
        .kop-surat h4 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0 0 8px 0;
            color: #000;
        }
        
        .kop-surat p {
            font-size: 10pt;
            margin: 2px 0;
            line-height: 1.3;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin: 20px 0 15px 0;
        }
        
        .header h1 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 8px 0;
            text-decoration: underline;
        }
        
        .header h2 {
            font-size: 13pt;
            font-weight: bold;
            margin: 5px 0;
            color: #1a3a6e;
        }
        
        .meta-info {
            background: #f8f9fa;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .meta-info table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .meta-info td {
            padding: 3px 8px;
            font-size: 10pt;
        }
        
        .meta-info td:first-child {
            font-weight: bold;
            width: 120px;
        }
        
        .content {
            text-align: justify;
            margin: 20px 0;
            font-size: 11pt;
            line-height: 1.8;
        }
        
        .content p {
            margin-bottom: 10px;
        }
        
        .signature {
            margin-top: 30px;
            text-align: right;
        }
        
        .signature p {
            margin: 3px 0;
            font-size: 11pt;
        }
        
        .signature .name {
            font-weight: bold;
            font-size: 12pt;
            margin-top: 50px;
            text-decoration: underline;
        }
        
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #666;
            padding: 8px 0;
            border-top: 1px solid #ddd;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 15px;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-info {
            background: #3b82f6;
            color: white;
        }
        
        .badge-warning {
            background: #f59e0b;
            color: white;
        }
        
        .badge-success {
            background: #10b981;
            color: white;
        }
        
        .badge-danger {
            background: #ef4444;
            color: white;
        }
    </style>
</head>
<body>
    {{-- Kop Surat --}}
    <div class="kop-surat">
        <img src="{{ public_path('logo.png') }}" alt="Logo Kabupaten Tolikara">
        <h3>PEMERINTAH KABUPATEN TOLIKARA</h3>
        <h4>DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI</h4>
        <p>Jl. Gatot Subroto No. 1 Karubaga, Kabupaten Tolikara</p>
        <p>Provinsi Papua Pegunungan</p>
        <p>Email: disperindagkop@tolikara.go.id | Telp: (0969) 12345</p>
    </div>

    {{-- Header --}}
    <div class="header">
        <h1>PENGUMUMAN</h1>
        <h2>{{ $pengumuman->judul }}</h2>
        <span class="badge badge-{{ $pengumuman->jenis == 'info' ? 'info' : ($pengumuman->jenis == 'warning' ? 'warning' : ($pengumuman->jenis == 'success' ? 'success' : 'danger')) }}">
            {{ strtoupper($pengumuman->jenis) }}
        </span>
    </div>

    {{-- Meta Info --}}
    <div class="meta-info">
        <table>
            <tr>
                <td>Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>: {{ $pengumuman->hari }}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>: {{ $pengumuman->jam }} WIT</td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>: {{ $pengumuman->tahun }}</td>
            </tr>
            <tr>
                <td>Dibuat oleh</td>
                <td>: {{ $pengumuman->user->name ?? 'Admin' }} ({{ ucfirst($pengumuman->user->role ?? 'admin') }})</td>
            </tr>
        </table>
    </div>

    {{-- Content --}}
    <div class="content">
        {!! nl2br(e($pengumuman->isi)) !!}
    </div>

    {{-- Signature --}}
    @if($pengumuman->pembuat)
    <div class="signature">
        <p>Hormat kami,</p>
        <p class="name">{{ $pengumuman->pembuat }}</p>
    </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis pada {{ now()->format('d F Y, H:i') }} WIT</p>
        <p>Dinas Perindustrian, Perdagangan dan Koperasi Kabupaten Tolikara</p>
    </div>
</body>
</html>
