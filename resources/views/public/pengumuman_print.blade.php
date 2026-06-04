<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $p->judul }} - DISPERINDAGKOP Tolikara</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            line-height: 1.8;
            color: #333;
            background: #f8f9fa;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
            color: white;
            padding: 50px 50px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            top: -80px;
            right: -80px;
        }
        
        .header::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -60px;
            left: -60px;
        }
        
        .logo-badge {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f5a623, #fdb944);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 15px rgba(245,166,35,0.4);
            position: relative;
            z-index: 1;
        }
        
        .logo-badge img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
        
        .logo-icon {
            font-size: 40px;
            color: #1a3a6e;
        }
        
        .header h4 {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }
        
        .header h3 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            line-height: 1.3;
        }
        
        .header p {
            font-size: 13px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .divider {
            height: 3px;
            background: linear-gradient(90deg, transparent, #f5a623, #fdb944, #f5a623, transparent);
            margin: 25px auto 0;
            max-width: 500px;
            position: relative;
            z-index: 1;
        }
        
        .body {
            padding: 60px 60px 50px;
        }
        
        .pengumuman-label {
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 20px;
            position: relative;
        }
        
        .pengumuman-label::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #1a3a6e, #f5a623);
            margin: 10px auto 0;
            border-radius: 2px;
        }
        
        .title {
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: #1a3a6e;
            margin-bottom: 25px;
            line-height: 1.4;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: 10px;
        }
        
        .badge-info { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
        .badge-penting { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; }
        .badge-urgent { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
        
        .date-info {
            text-align: center;
            background: #f0f4ff;
            padding: 12px 24px;
            border-radius: 100px;
            margin: 25px auto;
            font-size: 13px;
            color: #1a3a6e;
            font-weight: 600;
            display: inline-block;
            width: auto;
        }
        
        .date-container {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .content {
            background: #f8f9fa;
            padding: 35px;
            border-radius: 15px;
            border-left: 5px solid #1a3a6e;
            margin: 35px 0;
            text-align: justify;
            white-space: pre-line;
            line-height: 2.2;
            font-size: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .link-box {
            background: #e0f2fe;
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
            border-left: 4px solid #0284c7;
        }
        
        .link-box strong {
            color: #0369a1;
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }
        
        .link-box a {
            color: #0284c7;
            font-weight: 700;
            word-break: break-all;
            text-decoration: none;
        }
        
        .pembuat {
            text-align: right;
            margin-top: 50px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }
        
        .pembuat p:first-child {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .pembuat p:last-child {
            font-size: 17px;
            font-weight: 700;
            color: #1a3a6e;
        }
        
        .footer {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 25px 50px;
            text-align: center;
            border-top: 3px solid #1a3a6e;
            font-size: 12px;
            color: #6b7280;
        }
        
        .footer p {
            margin: 8px 0;
        }
        
        .footer p:first-child {
            font-weight: 700;
            color: #1a3a6e;
            font-size: 13px;
        }
        
        .print-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(26,58,110,0.4);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .print-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 30px rgba(26,58,110,0.5);
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .container {
                box-shadow: none;
                border-radius: 0;
            }
            
            .print-button {
                display: none;
            }
            
            @page {
                margin: 1.5cm;
            }
        }
        
        @media (max-width: 768px) {
            .body {
                padding: 40px 25px;
            }
            
            .header {
                padding: 40px 25px 30px;
            }
            
            .title {
                font-size: 22px;
            }
            
            .content {
                padding: 25px;
                font-size: 14px;
            }
            
            .footer {
                padding: 20px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header Surat --}}
        <div class="header">
            <div class="logo-badge">
                {{-- Gunakan icon building sebagai logo --}}
                <div class="logo-icon">
                    🏛️
                </div>
            </div>
            <h4>Pemerintah Kabupaten Tolikara</h4>
            <h3>DINAS PERINDUSTRIAN, PERDAGANGAN & KOPERASI</h3>
            <p>Jl. Raya Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
            <div class="divider"></div>
        </div>

        {{-- Body --}}
        <div class="body">
            <div class="pengumuman-label">PENGUMUMAN</div>

            <div class="title">
                {{ $p->judul }}
                @if($p->jenis)
                <span class="badge badge-{{ $p->jenis }}">{{ strtoupper($p->jenis) }}</span>
                @endif
            </div>

            <div class="date-container">
                @if($p->tanggal && $p->hari && $p->jam && $p->tahun)
                <div class="date-info">
                    📅 {{ $p->hari }}, {{ \Carbon\Carbon::parse($p->tanggal)->isoFormat('D MMMM') }} {{ $p->tahun }} | 🕐 {{ $p->jam }} WIT
                </div>
                @else
                <div class="date-info">
                    📅 {{ $p->created_at->isoFormat('dddd, D MMMM Y') }}
                </div>
                @endif
            </div>

            <div class="content">{{ $p->isi }}</div>

            @if($p->link)
            <div class="link-box">
                <strong>🔗 Link Terkait:</strong>
                <a href="{{ $p->link }}" target="_blank">{{ $p->link }}</a>
            </div>
            @endif

            @if($p->pembuat)
            <div class="pembuat">
                <p>Hormat kami,</p>
                <p>{{ $p->pembuat }}</p>
            </div>
            @endif
        </div>

        {{-- Footer --}}
        <div class="footer">
            <p><strong>✓ Pengumuman ini sah dan resmi dari DISPERINDAGKOP Kabupaten Tolikara</strong></p>
            <p>Dicetak pada: {{ now()->isoFormat('dddd, D MMMM Y HH:mm') }} WIT</p>
        </div>
    </div>

    {{-- Print Button --}}
    <button class="print-button" onclick="window.print()">
        🖨️ Cetak / Simpan PDF
    </button>

    <script>
        // Auto print dialog on load (optional)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 500);
        // };
    </script>
</body>
</html>
