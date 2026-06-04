<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dokumen Anggota - {{ $anggota->nama }}</title>
    <style>
        @page {
            margin: 2cm;
        }
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
            border-bottom: 3px solid #1e3a8a;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin: 10px 0 5px 0;
            text-transform: uppercase;
            color: #1e3a8a;
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
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
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
        .foto-container {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
        }
        .foto-container img {
            max-width: 200px;
            max-height: 250px;
            border: 3px solid #1e3a8a;
            padding: 5px;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 12px 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .info-box strong {
            color: #1e3a8a;
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
                <h1 style="margin: 0 0 10px 0; font-size: 20pt; font-weight: bold; color: #1e3a8a; text-transform: uppercase; letter-spacing: 3px; line-height: 1.5;">
                    PEMERINTAH KABUPATEN TOLIKARA
                </h1>
                <h2 style="margin: 10px 0 15px 0; font-size: 16pt; font-weight: bold; color: #1e3a8a; line-height: 1.6;">
                    DINAS PERINDUSTRIAN, PERDAGANGAN<br>
                    DAN KOPERASI
                </h2>
                <p style="margin: 0; font-size: 10pt; color: #475569; line-height: 1.8; font-style: italic;">
                    Jl. Raya Karubaga, Tolikara, Papua Pegunungan<br>
                    Email: disperindagkop@tolikara.go.id | Telp: (0969) 123456
                </p>
            </div>
        </div>
        <div style="border-top: 4px solid #1e3a8a; margin-top: 15px; margin-bottom: 5px;"></div>
        <div style="border-top: 1px solid #1e3a8a;"></div>
    </div>

    {{-- Header Dokumen --}}
    <div class="header">
        <h1>DOKUMEN DATA ANGGOTA KOPERASI</h1>
        <p>No. Dokumen: DOK/{{ $anggota->no_anggota }}/{{ \Carbon\Carbon::now()->format('Y') }}</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIT</p>
    </div>

    {{-- Foto --}}
    @if($anggota->foto)
    <div class="foto-container">
        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto {{ $anggota->nama }}">
        <p style="margin-top:10px;"><em><strong>Foto Anggota</strong></em></p>
    </div>
    @endif

    {{-- Info Box --}}
    <div class="info-box">
        <strong>Status Keanggotaan:</strong> 
        @if($anggota->status == 'Aktif')
            <span class="badge badge-success">✓ AKTIF</span>
        @elseif($anggota->status == 'Pending')
            <span class="badge badge-warning">⏳ PENDING</span>
        @else
            <span class="badge badge-danger">✗ NONAKTIF</span>
        @endif
        | <strong>No. Anggota:</strong> {{ $anggota->no_anggota }}
    </div>

    {{-- Data Pribadi --}}
    <div class="section">
        <div class="section-title">I. DATA PRIBADI</div>
        <table>
            <tr>
                <td>No. Anggota</td>
                <td>:</td>
                <td><strong>{{ $anggota->no_anggota ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $anggota->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $anggota->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $anggota->tempat_lahir ?? '-' }}, {{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>:</td>
                <td>{{ $anggota->umur ?? '-' }} tahun</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $anggota->agama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>{{ $anggota->status_perkawinan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td>{{ $anggota->pendidikan_terakhir ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Kontak --}}
    <div class="section">
        <div class="section-title">II. INFORMASI KONTAK</div>
        <table>
            <tr>
                <td>No. HP/WhatsApp</td>
                <td>:</td>
                <td>{{ $anggota->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $anggota->email ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Alamat --}}
    <div class="section">
        <div class="section-title">III. ALAMAT</div>
        <table>
            <tr>
                <td>Desa</td>
                <td>:</td>
                <td>{{ $anggota->desa ?? '-' }}</td>
            </tr>
            <tr>
                <td>Distrik</td>
                <td>:</td>
                <td>{{ $anggota->distrik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <td>{{ $anggota->kabupaten ?? 'Tolikara' }}</td>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td>{{ $anggota->kode_pos ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat Lengkap</td>
                <td>:</td>
                <td>{{ $anggota->alamat_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nama Komplek/Dekat Desa</td>
                <td>:</td>
                <td>{{ $anggota->nama_komplek_dekat_desa ?? '-' }}</td>
            </tr>
            <tr>
                <td>Koordinat GPS</td>
                <td>:</td>
                <td>{{ $anggota->koordinat_gps ?? '-' }}</td>
            </tr>
            <tr>
                <td>Status Kepemilikan Rumah</td>
                <td>:</td>
                <td>{{ $anggota->status_kepemilikan_rumah ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Data Usaha --}}
    <div class="section">
        <div class="section-title">IV. DATA USAHA</div>
        <table>
            <tr>
                <td>Nama Usaha</td>
                <td>:</td>
                <td>{{ $anggota->nama_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Bidang Usaha</td>
                <td>:</td>
                <td>{{ $anggota->bidang_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Lama Berdiri Usaha</td>
                <td>:</td>
                <td>{{ $anggota->lama_berdiri_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jumlah Karyawan</td>
                <td>:</td>
                <td>{{ $anggota->jumlah_karyawan ?? '-' }} orang</td>
            </tr>
            <tr>
                <td>Alamat Tempat Usaha</td>
                <td>:</td>
                <td>{{ $anggota->alamat_tempat_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Legalitas Usaha</td>
                <td>:</td>
                <td>{{ $anggota->legalitas_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Modal Usaha</td>
                <td>:</td>
                <td>Rp {{ number_format($anggota->modal_usaha ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Omzet per Bulan</td>
                <td>:</td>
                <td>Rp {{ number_format($anggota->omzet_per_bulan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Keterangan Usaha</td>
                <td>:</td>
                <td>{{ $anggota->keterangan_usaha ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Data Keuangan --}}
    <div class="section">
        <div class="section-title">V. DATA KEUANGAN & PERBANKAN</div>
        <table>
            <tr>
                <td>Simpanan Pokok</td>
                <td>:</td>
                <td>Rp {{ number_format($anggota->simpanan_pokok ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Simpanan Wajib</td>
                <td>:</td>
                <td>Rp {{ number_format($anggota->simpanan_wajib ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Simpanan</td>
                <td>:</td>
                <td>Rp {{ number_format($anggota->total_simpanan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Nama Bank</td>
                <td>:</td>
                <td>{{ $anggota->nama_bank ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nomor Rekening</td>
                <td>:</td>
                <td>{{ $anggota->nomor_rekening ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nama Pemilik Rekening</td>
                <td>:</td>
                <td>{{ $anggota->nama_pemilik_rekening ?? '-' }}</td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td>:</td>
                <td>{{ $anggota->npwp ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Data Ahli Waris --}}
    <div class="section">
        <div class="section-title">VI. DATA AHLI WARIS</div>
        <table>
            <tr>
                <td>Nama Ahli Waris</td>
                <td>:</td>
                <td>{{ $anggota->nama_ahli_waris ?? '-' }}</td>
            </tr>
            <tr>
                <td>Hubungan</td>
                <td>:</td>
                <td>{{ $anggota->hubungan_ahli_waris ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIK Ahli Waris</td>
                <td>:</td>
                <td>{{ $anggota->nik_ahli_waris ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. HP Ahli Waris</td>
                <td>:</td>
                <td>{{ $anggota->no_hp_ahli_waris ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Status Keanggotaan --}}
    <div class="section">
        <div class="section-title">VII. STATUS KEANGGOTAAN</div>
        <table>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>
                    @if($anggota->status == 'Aktif')
                        <span class="badge badge-success">AKTIF</span>
                    @elseif($anggota->status == 'Pending')
                        <span class="badge badge-warning">PENDING</span>
                    @else
                        <span class="badge badge-danger">NONAKTIF</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Tanggal Bergabung</td>
                <td>:</td>
                <td>{{ $anggota->tanggal_bergabung ? \Carbon\Carbon::parse($anggota->tanggal_bergabung)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Verifikasi</td>
                <td>:</td>
                <td>{{ $anggota->tanggal_verifikasi ? $anggota->tanggal_verifikasi->format('d F Y H:i') : '-' }}</td>
            </tr>
            <tr>
                <td>Koperasi</td>
                <td>:</td>
                <td>{{ $anggota->koperasi?->nama_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td>Periode Pendaftaran</td>
                <td>:</td>
                <td>{{ $anggota->periodePendaftaran?->nama ?? '-' }}</td>
            </tr>
            @if($anggota->catatan_admin)
            <tr>
                <td>Catatan Admin</td>
                <td>:</td>
                <td>{{ $anggota->catatan_admin }}</td>
            </tr>
            @endif
        </table>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Tolikara, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <div class="signature">
            <p>Mengetahui,</p>
            <p><strong>Ketua Koperasi</strong></p>
            <div class="signature-line"></div>
            <p><strong>{{ $anggota->koperasi?->nama_ketua ?? '(........................)' }}</strong></p>
        </div>
    </div>

    {{-- Catatan Kaki --}}
    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ccc; font-size: 9pt; color: #666;">
        <p><em>Dokumen ini dicetak secara otomatis dari Sistem Informasi Koperasi Tolikara</em></p>
        <p><em>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</em></p>
    </div>
</body>
</html>
