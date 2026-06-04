<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $p->judul }}</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #1a3a6e;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
        }
        .header h4 {
            margin: 5px 0;
            font-size: 11pt;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header h3 {
            margin: 5px 0;
            font-size: 14pt;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 10pt;
        }
        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #f5a623, transparent);
            margin: 15px 0;
        }
        .pengumuman-label {
            text-align: center;
            font-size: 11pt;
            font-weight: bold;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #666;
            margin: 20px 0 10px;
        }
        .title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            color: #1a3a6e;
            margin: 15px 0;
            line-height: 1.4;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-left: 10px;
        }
        .badge-info { background: #3b82f6; color: white; }
        .badge-penting { background: #fbbf24; color: white; }
        .badge-urgent { background: #ef4444; color: white; }
        .date-info {
            text-align: center;
            background: #f0f4ff;
            padding: 10px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 11pt;
            color: #1a3a6e;
            font-weight: 600;
        }
        .content {
            background: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #1a3a6e;
            margin: 20px 0;
            text-align: justify;
            white-space: pre-line;
        }
        .pembuat {
            text-align: right;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .pembuat p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 10pt;
            color: #6b7280;
        }
    </style>
</head>
<body>
    {{-- Header Surat --}}
    <div class="header">
        <h4>Pemerintah Kabupaten Tolikara</h4>
        <h3>DINAS PERINDUSTRIAN, PERDAGANGAN & KOPERASI</h3>
        <p>Jl. Raya Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
        <div class="divider"></div>
    </div>

    {{-- Pengumuman Label --}}
    <div class="pengumuman-label">PENGUMUMAN</div>

    {{-- Judul --}}
    <div class="title">
        {{ $p->judul }}
        @if($p->jenis)
        <span class="badge badge-{{ $p->jenis }}">{{ strtoupper($p->jenis) }}</span>
        @endif
    </div>

    {{-- Tanggal --}}
    @if($p->tanggal && $p->hari && $p->jam && $p->tahun)
    <div class="date-info">
        {{ $p->hari }}, {{ \Carbon\Carbon::parse($p->tanggal)->isoFormat('D MMMM') }} {{ $p->tahun }} | {{ $p->jam }} WIT
    </div>
    @else
    <div class="date-info">
        {{ $p->created_at->isoFormat('dddd, D MMMM Y') }}
    </div>
    @endif

    {{-- Isi Pengumuman --}}
    <div class="content">
        {{ $p->isi }}
    </div>

    {{-- Link --}}
    @if($p->link)
    <div style="background:#e0f2fe;padding:15px;border-radius:8px;margin:20px 0;border-left:4px solid #0284c7">
        <strong style="color:#0369a1">Link Terkait:</strong><br>
        <span style="color:#0284c7;word-break:break-all">{{ $p->link }}</span>
    </div>
    @endif

    {{-- Pembuat --}}
    @if($p->pembuat)
    <div class="pembuat">
        <p style="font-size:11pt;color:#666">Hormat kami,</p>
        <p style="font-size:13pt;font-weight:bold;color:#1a3a6e">{{ $p->pembuat }}</p>
    </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>Pengumuman ini sah dan resmi dari DISPERINDAGKOP Kabupaten Tolikara</p>
        <p>Dicetak pada: {{ now()->isoFormat('dddd, D MMMM Y HH:mm') }} WIT</p>
    </div>
</body>
</html>
