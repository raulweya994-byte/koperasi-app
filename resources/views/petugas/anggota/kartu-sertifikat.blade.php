<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $type == 'kartu' ? 'Kartu Anggota' : 'Sertifikat Keanggotaan' }} - {{ $anggota->nama }}</title>
    <style>
        @page {
            margin: 0;
            size: {{ $type == 'kartu' ? '85.6mm 53.98mm landscape' : 'A4 portrait' }};
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        /* KARTU ANGGOTA - IDENTITAS PENTING DENGAN LOGO */
        .kartu-container {
            width: 85.6mm;
            height: 53.98mm;
            position: relative;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            overflow: hidden;
            page-break-after: always;
            border-radius: 3mm;
            box-sizing: border-box;
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

        /* Header dengan Logo */
        .kartu-header-with-logo {
            display: flex;
            align-items: center;
            gap: 3mm;
            margin-bottom: 3mm;
        }

        .kartu-logo-left {
            width: 14mm;
            height: 14mm;
            flex-shrink: 0;
        }

        .kartu-logo-left img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .kartu-header-center {
            flex: 1;
            text-align: center;
        }

        .kartu-header-center h3 {
            margin: 0;
            font-size: 9pt;
            font-weight: bold;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .kartu-header-center h4 {
            margin: 1mm 0 0 0;
            font-size: 8.5pt;
            font-weight: bold;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }

        .kartu-logo-right {
            width: 14mm;
            height: 14mm;
            flex-shrink: 0;
        }

        .kartu-logo-right img {
            width: 100%;
            height: 100%;
            object-fit: contain;
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
            font-size: 7.5pt;
            line-height: 1.5;
            border-collapse: collapse;
        }

        .kartu-data td {
            padding: 1.5mm 0;
            vertical-align: top;
        }

        .kartu-data td:first-child {
            width: 22mm;
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
            width: 26mm;
            height: 32mm;
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

        /* SERTIFIKAT - DALAM 1 HALAMAN */
        .sertifikat-container {
            width: 210mm;
            height: 297mm;
            position: relative;
            background: white;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* Border Emas Luar */
        .sertifikat-border-outer {
            position: absolute;
            top: 5mm;
            left: 5mm;
            right: 5mm;
            bottom: 5mm;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fbbf24 100%);
            border-radius: 8px;
            padding: 3px;
        }

        /* Border Biru Dalam */
        .sertifikat-border-inner {
            width: 100%;
            height: 100%;
            background: white;
            border: 3px solid #1e3a8a;
            border-radius: 6px;
            padding: 15px;
            position: relative;
        }

        /* Logo di Atas Tengah */
        .sertifikat-logo-top {
            text-align: center;
            margin-bottom: 8px;
        }

        .sertifikat-logo-top img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        /* Kop Surat Singkat */
        .sertifikat-kop {
            text-align: center;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .sertifikat-kop h1 {
            margin: 0;
            font-size: 11pt;
            font-weight: bold;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.1;
        }

        .sertifikat-kop h2 {
            margin: 2px 0;
            font-size: 9pt;
            font-weight: bold;
            color: #3b82f6;
            line-height: 1.1;
        }

        .sertifikat-kop p {
            margin: 1px 0;
            font-size: 7pt;
            color: #475569;
            line-height: 1.1;
        }

        /* Watermark */
        .sertifikat-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80pt;
            color: rgba(30, 58, 138, 0.02);
            font-weight: bold;
            z-index: 1;
            letter-spacing: 10px;
        }

        /* Content */
        .sertifikat-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 10px 20px;
        }

        .sertifikat-title {
            font-size: 48pt;
            font-weight: bold;
            color: #1e3a8a;
            margin: 15px 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 12px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .sertifikat-subtitle {
            font-size: 16pt;
            color: #3b82f6;
            margin-bottom: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .sertifikat-text {
            font-size: 11pt;
            line-height: 1.5;
            color: #475569;
            margin: 12px 0;
        }

        .sertifikat-nama {
            font-size: 28pt;
            font-weight: bold;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 15px 0;
            font-style: italic;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            filter: drop-shadow(0 2px 3px rgba(251, 191, 36, 0.3));
        }

        .sertifikat-detail {
            background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%);
            border: 2px solid #3b82f6;
            border-radius: 10px;
            padding: 12px 15px;
            margin: 15px auto;
            max-width: 500px;
            text-align: left;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.1);
        }

        .sertifikat-detail table {
            width: 100%;
            font-size: 10pt;
        }

        .sertifikat-detail td {
            padding: 5px;
            line-height: 1.4;
        }

        .sertifikat-detail td:first-child {
            width: 40%;
            color: #1e3a8a;
            font-weight: 600;
        }

        .sertifikat-detail td:nth-child(2) {
            width: 5%;
            color: #64748b;
        }

        .sertifikat-detail td:last-child {
            color: #1e293b;
            font-weight: bold;
        }

        /* Medal Emas */
        .sertifikat-medal {
            width: 60px;
            height: 60px;
            margin: 15px auto;
        }

        .medal-circle {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fbbf24 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5);
            border: 4px solid #fff;
            position: relative;
        }

        .medal-circle::before {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            z-index: 1;
        }

        .medal-star {
            width: 30px;
            height: 30px;
            background: white;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            z-index: 2;
            position: relative;
        }

        /* Footer Tanda Tangan */
        .sertifikat-footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            padding: 0 40px;
            text-align: center;
        }

        .sertifikat-ttd {
            width: 180px;
        }

        .sertifikat-ttd p {
            margin: 4px 0;
            font-size: 10pt;
            color: #475569;
        }

        .sertifikat-ttd-line {
            border-top: 2px solid #1e3a8a;
            margin-top: 40px;
            padding-top: 6px;
        }

        .sertifikat-ttd-line strong {
            font-size: 11pt;
            color: #1e3a8a;
            font-weight: bold;
        }

        .sertifikat-date {
            margin-top: 15px;
            font-size: 10pt;
            color: #64748b;
            text-align: right;
            padding-right: 40px;
        }

        /* Dekorasi Sudut */
        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 3px solid #fbbf24;
        }

        .corner-decoration.top-left {
            top: 15px;
            left: 15px;
            border-right: none;
            border-bottom: none;
            border-radius: 8px 0 0 0;
        }

        .corner-decoration.top-right {
            top: 15px;
            right: 15px;
            border-left: none;
            border-bottom: none;
            border-radius: 0 8px 0 0;
        }

        .corner-decoration.bottom-left {
            bottom: 15px;
            left: 15px;
            border-right: none;
            border-top: none;
            border-radius: 0 0 0 8px;
        }

        .corner-decoration.bottom-right {
            bottom: 15px;
            right: 15px;
            border-left: none;
            border-top: none;
            border-radius: 0 0 8px 0;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    @if($type == 'kartu')
        {{-- KARTU ANGGOTA - IDENTITAS PENTING DENGAN LOGO --}}
        <div class="kartu-container">
            <div class="kartu-pattern"></div>
            <div class="kartu-content">
                {{-- Header dengan Logo Kiri dan Kanan --}}
                <div class="kartu-header-with-logo">
                    <div class="kartu-logo-left">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    </div>
                    <div class="kartu-header-center">
                        <h3>PROVINSI PAPUA PEGUNUNGAN</h3>
                        <h4>KABUPATEN TOLIKARA</h4>
                    </div>
                    <div class="kartu-logo-right">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    </div>
                </div>
                
                {{-- Body: Data Identitas Penting + Foto --}}
                <div class="kartu-body">
                    {{-- Data Identitas Penting di Kiri --}}
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
                                <td>{{ strtoupper($anggota->desa) }}, {{ strtoupper($anggota->distrik) }}</td>
                            </tr>
                            <tr>
                                <td>Koperasi</td>
                                <td>:</td>
                                <td>{{ strtoupper(optional($anggota->koperasi)->nama_usaha ?? 'KOPERASI TOLIKARA') }}</td>
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
    @else
        {{-- SERTIFIKAT - DALAM 1 HALAMAN --}}
        <div class="sertifikat-container">
            {{-- Border Emas Luar --}}
            <div class="sertifikat-border-outer">
                <div class="sertifikat-border-inner">
                    {{-- Dekorasi Sudut --}}
                    <div class="corner-decoration top-left"></div>
                    <div class="corner-decoration top-right"></div>
                    <div class="corner-decoration bottom-left"></div>
                    <div class="corner-decoration bottom-right"></div>
                    
                    {{-- Watermark --}}
                    <div class="sertifikat-watermark">KOPERASI</div>
                    
                    {{-- Logo di Atas --}}
                    <div class="sertifikat-logo-top">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    </div>
                    
                    {{-- Kop Surat Singkat --}}
                    <div class="sertifikat-kop">
                        <h1>PEMERINTAH KABUPATEN TOLIKARA</h1>
                        <h2>DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI</h2>
                        <p>Jl. Raya Karubaga, Tolikara, Papua Pegunungan | Email: disperindagkop@tolikara.go.id | Telp: (0969) 123456</p>
                    </div>
                    
                    {{-- Content --}}
                    <div class="sertifikat-content">
                        {{-- Title --}}
                        <div class="sertifikat-title">SERTIFIKAT</div>
                        <div class="sertifikat-subtitle">Keanggotaan Koperasi</div>
                        
                        {{-- Content --}}
                        <div class="sertifikat-text">
                            Dengan bangga dipersembahkan kepada:
                        </div>
                        
                        <div class="sertifikat-nama">{{ $anggota->nama }}</div>
                        
                        <div class="sertifikat-detail">
                            <table>
                                <tr>
                                    <td>No. Anggota</td>
                                    <td>:</td>
                                    <td><strong>{{ $anggota->no_anggota }}</strong></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td><strong>{{ $anggota->nik }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><strong>{{ $anggota->tempat_lahir }}, {{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d F Y') : '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><strong>{{ $anggota->distrik }}, Kab. Tolikara</strong></td>
                                </tr>
                                <tr>
                                    <td>Koperasi</td>
                                    <td>:</td>
                                    <td><strong>{{ optional($anggota->koperasi)->nama_usaha ?? 'Koperasi Tolikara' }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="sertifikat-text">
                            Telah terdaftar sebagai <strong>Anggota Resmi Koperasi</strong><br>
                            sejak tanggal <strong>{{ $anggota->tanggal_bergabung ? \Carbon\Carbon::parse($anggota->tanggal_bergabung)->format('d F Y') : \Carbon\Carbon::now()->format('d F Y') }}</strong><br>
                            dan berhak atas segala fasilitas dan kewajiban sebagai anggota koperasi.
                        </div>
                        
                        {{-- Medal --}}
                        <div class="sertifikat-medal">
                            <div class="medal-circle">
                                <div class="medal-star"></div>
                            </div>
                        </div>
                        
                        {{-- Footer --}}
                        <div class="sertifikat-footer">
                            <div class="sertifikat-ttd">
                                <p>Ketua Koperasi</p>
                                <div class="sertifikat-ttd-line">
                                    <strong>{{ optional($anggota->koperasi)->nama_pemilik ?? '(........................)' }}</strong>
                                </div>
                            </div>
                            
                            <div class="sertifikat-ttd">
                                <p>Kepala Dinas</p>
                                <div class="sertifikat-ttd-line">
                                    <strong>(........................)</strong>
                                </div>
                            </div>
                        </div>
                        
                        <div class="sertifikat-date">
                            Tolikara, {{ \Carbon\Carbon::now()->format('d F Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</body>
</html>
