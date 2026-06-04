<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dokumen Koperasi - {{ $koperasi->nama_usaha }}</title>
    <style>
        @page { margin: 2cm; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }
        .kop-surat {
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #059669;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin: 10px 0 5px 0;
            text-transform: uppercase;
            color: #059669;
        }
        .header p {
            font-size: 10pt;
            margin: 3px 0;
            color: #666;
        }
        .section {
            margin: 20px 0;
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        table td {
            padding: 8px 5px;
            vertical-align: top;
            border-bottom: 1px solid #e5e7eb;
        }
        table td:first-child {
            width: 35%;
            font-weight: 600;
            color: #374151;
        }
        table td:nth-child(2) {
            width: 3%;
            text-align: center;
            color: #6b7280;
        }
        table td:last-child {
            color: #111827;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 10pt;
            font-weight: bold;
        }
        .badge-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #f59e0b;
        }
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
        .signature {
            margin-top: 60px;
            text-align: right;
        }
        .signature-line {
            display: inline-block;
            width: 200px;
            border-top: 2px solid #000;
            margin-top: 60px;
        }
        .info-box {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 12px 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .info-box strong {
            color: #059669;
        }
    </style>
</head>
<body>
    {{-- Kop Surat --}}
    <div class="kop-surat">
        <div style="text-align: center; margin-bottom: 20px;">
            {{-- Logo --}}
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('logo.png') }}" alt="Logo DISPERINDAGKOP" style="width: 100px; height: 100px; object-fit: contain;">
            </div>
            
            {{-- Header Text --}}
            <div>
                <h1 style="margin: 0 0 10px 0; font-size: 20pt; font-weight: bold; color: #059669; text-transform: uppercase; letter-spacing: 3px; line-height: 1.5;">
                    PEMERINTAH KABUPATEN TOLIKARA
                </h1>
                <h2 style="margin: 10px 0 15px 0; font-size: 16pt; font-weight: bold; color: #059669; line-height: 1.6;">
                    DINAS PERINDUSTRIAN, PERDAGANGAN<br>
                    DAN KOPERASI
                </h2>
                <p style="margin: 0; font-size: 10pt; color: #475569; line-height: 1.8; font-style: italic;">
                    Jl. Raya Karubaga, Tolikara, Papua Pegunungan<br>
                    Email: disperindagkop@tolikara.go.id | Telp: (0969) 123456
                </p>
            </div>
        </div>
        <div style="border-top: 4px solid #059669; margin-top: 15px; margin-bottom: 5px;"></div>
        <div style="border-top: 1px solid #059669;"></div>
    </div>

    {{-- Header Dokumen --}}
    <div class="header">
        <h1>DOKUMEN DATA KOPERASI</h1>
        <p>No. Dokumen: DOK/{{ $koperasi->no_registrasi }}/{{ \Carbon\Carbon::now()->format('Y') }}</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIT</p>
    </div>

    {{-- Info Box --}}
    <div class="info-box">
        <strong>Status Verifikasi:</strong> 
        @if($koperasi->status_verifikasi == 'diverifikasi')
            <span class="badge badge-success">✓ TERVERIFIKASI</span>
        @elseif($koperasi->status_verifikasi == 'pending')
            <span class="badge badge-warning">⏳ PENDING</span>
        @else
            <span class="badge badge-danger">✗ DITOLAK</span>
        @endif
        | <strong>Status Usaha:</strong> 
        @if($koperasi->status_usaha == 'aktif')
            <span class="badge badge-success">✓ AKTIF</span>
        @else
            <span class="badge badge-danger">✗ TIDAK AKTIF</span>
        @endif
    </div>

    {{-- Data Registrasi --}}
    <div class="section">
        <div class="section-title">I. DATA REGISTRASI</div>
        <table>
            <tr>
                <td>No. Registrasi</td>
                <td>:</td>
                <td><strong>{{ $koperasi->no_registrasi ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>Nama Koperasi/Usaha</td>
                <td>:</td>
                <td>{{ $koperasi->nama_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Usaha</td>
                <td>:</td>
                <td>{{ $koperasi->jenis_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td>{{ $koperasi->kategori_label ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Registrasi</td>
                <td>:</td>
                <td>{{ $koperasi->created_at ? $koperasi->created_at->format('d F Y') : '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Data Pemilik --}}
    <div class="section">
        <div class="section-title">II. DATA PEMILIK</div>
        <table>
            <tr>
                <td>Nama Pemilik</td>
                <td>:</td>
                <td>{{ $koperasi->nama_pemilik ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. KTP</td>
                <td>:</td>
                <td>{{ $koperasi->no_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td>{{ $koperasi->no_telp ?? '-' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $koperasi->email ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Alamat --}}
    <div class="section">
        <div class="section-title">III. ALAMAT USAHA</div>
        <table>
            <tr>
                <td>Alamat Lengkap</td>
                <td>:</td>
                <td>{{ $koperasi->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kelurahan/Desa</td>
                <td>:</td>
                <td>{{ $koperasi->kelurahan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Distrik</td>
                <td>:</td>
                <td>{{ $koperasi->distrik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <td>Tolikara</td>
            </tr>
        </table>
    </div>

    {{-- Data Usaha --}}
    <div class="section">
        <div class="section-title">IV. DATA USAHA</div>
        <table>
            <tr>
                <td>Modal Usaha</td>
                <td>:</td>
                <td>Rp {{ number_format($koperasi->modal_usaha ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Omset per Bulan</td>
                <td>:</td>
                <td>Rp {{ number_format($koperasi->omset_per_bulan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jumlah Karyawan</td>
                <td>:</td>
                <td>{{ $koperasi->jumlah_karyawan ?? '-' }} orang</td>
            </tr>
            <tr>
                <td>Status Usaha</td>
                <td>:</td>
                <td>
                    @if($koperasi->status_usaha == 'aktif')
                        <span class="badge badge-success">AKTIF</span>
                    @else
                        <span class="badge badge-danger">TIDAK AKTIF</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    {{-- Status Verifikasi --}}
    <div class="section">
        <div class="section-title">V. STATUS VERIFIKASI</div>
        <table>
            <tr>
                <td>Status Verifikasi</td>
                <td>:</td>
                <td>
                    @if($koperasi->status_verifikasi == 'diverifikasi')
                        <span class="badge badge-success">TERVERIFIKASI</span>
                    @elseif($koperasi->status_verifikasi == 'pending')
                        <span class="badge badge-warning">PENDING</span>
                    @else
                        <span class="badge badge-danger">DITOLAK</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Tanggal Verifikasi</td>
                <td>:</td>
                <td>{{ $koperasi->verified_at ? $koperasi->verified_at->format('d F Y H:i') : '-' }}</td>
            </tr>
            <tr>
                <td>Diverifikasi Oleh</td>
                <td>:</td>
                <td>{{ $koperasi->verifiedBy?->name ?? '-' }}</td>
            </tr>
            @if($koperasi->catatan_verifikasi)
            <tr>
                <td>Catatan Verifikasi</td>
                <td>:</td>
                <td>{{ $koperasi->catatan_verifikasi }}</td>
            </tr>
            @endif
        </table>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Tolikara, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <div class="signature">
            <p>Mengetahui,</p>
            <p><strong>Kepala Dinas</strong></p>
            <div class="signature-line"></div>
            <p><strong>(........................)</strong></p>
        </div>
    </div>

    {{-- Catatan Kaki --}}
    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ccc; font-size: 9pt; color: #666;">
        <p><em>Dokumen ini dicetak secara otomatis dari Sistem Informasi Koperasi Tolikara</em></p>
        <p><em>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</em></p>
    </div>
</body>
</html>
