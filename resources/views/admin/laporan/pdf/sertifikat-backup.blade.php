<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sertifikat Koperasi - {{ $koperasi->nama_usaha }}</title>
<style>
/* PRINT BUTTON STYLES - Hidden saat print */
.print-controls {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    gap: 10px;
}

.btn-print {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-print:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn-back {
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
}

/* Hide controls saat print */
@media print {
    .print-controls {
        display: none !important;
    }
    
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
}

/* SERTIFIKAT STYLES */
@page { margin: 0; size: A4 landscape; }
* { margin:0; padding:0; box-sizing:border-box; }
body { 
    font-family: 'Times New Roman', serif; 
    background: #fff; 
    width:297mm; 
    height:210mm; 
    position:relative; 
    overflow:hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* BORDER ORNAMENT */
.outer-border { 
    position:absolute; 
    top:8mm; 
    left:8mm; 
    right:8mm; 
    bottom:8mm; 
    border:4px solid #1a3a6e;
    box-shadow: inset 0 0 20px rgba(26, 58, 110, 0.1);
}

.inner-border { 
    position:absolute; 
    top:11mm; 
    left:11mm; 
    right:11mm; 
    bottom:11mm; 
    border:2px solid #f5a623;
    box-shadow: 0 0 10px rgba(245, 166, 35, 0.2);
}

/* CORNER DECORATIONS */
.corner-decoration {
    position: absolute;
    width: 25mm;
    height: 25mm;
    border: 3px solid #f5a623;
}

.corner-tl {
    top: 8mm;
    left: 8mm;
    border-right: none;
    border-bottom: none;
}

.corner-tr {
    top: 8mm;
    right: 8mm;
    border-left: none;
    border-bottom: none;
}

.corner-bl {
    bottom: 8mm;
    left: 8mm;
    border-right: none;
    border-top: none;
}

.corner-br {
    bottom: 8mm;
    right: 8mm;
    border-left: none;
    border-top: none;
}

/* WATERMARK */
.watermark { 
    position:absolute; 
    top:50%; 
    left:50%; 
    transform:translate(-50%,-50%) rotate(-30deg); 
    font-size:90px; 
    color:rgba(26,58,110,.04); 
    font-weight:900; 
    white-space:nowrap; 
    letter-spacing:15px; 
    z-index:0;
    text-transform: uppercase;
}

/* CONTENT */
.content { 
    position:absolute; 
    top:0; 
    left:0; 
    right:0; 
    bottom:0; 
    display:flex; 
    flex-direction:column; 
    align-items:center; 
    justify-content:center; 
    padding:20mm 30mm; 
    z-index:1; 
    text-align:center;
}

.header-logos { 
    display:flex; 
    align-items:center; 
    justify-content:center; 
    gap:25px; 
    margin-bottom:8mm;
}

.logo-circle { 
    width:20mm; 
    height:20mm; 
    background:white;
    border-radius:50%; 
    display:flex; 
    align-items:center; 
    justify-content:center; 
    border:3px solid #f5a623;
    box-shadow: 0 4px 15px rgba(245, 166, 35, 0.3);
    padding: 2px;
}

.logo-circle img {
    width: 16mm;
    height: 16mm;
    object-fit: contain;
}

.instansi { 
    text-align:center;
    max-width: 180mm;
}

.instansi .dinas { 
    font-size:12pt; 
    font-weight:700; 
    color:#1a3a6e; 
    letter-spacing:1.5px; 
    text-transform:uppercase;
    line-height: 1.3;
}

.instansi .kabupaten { 
    font-size:10pt; 
    color:#555;
    margin-top: 2px;
}

.divider-gold { 
    width:140mm; 
    height:4px; 
    background:linear-gradient(90deg,transparent,#f5a623,#1a3a6e,#f5a623,transparent); 
    margin:5mm auto;
    border-radius: 2px;
}

.judul-sertifikat { 
    font-size:32pt; 
    font-weight:900; 
    color:#1a3a6e; 
    letter-spacing:6px; 
    text-transform:uppercase; 
    margin-bottom:3mm;
    text-shadow: 2px 2px 4px rgba(26, 58, 110, 0.1);
}

.sub-judul { 
    font-size:11pt; 
    color:#888; 
    letter-spacing:3px; 
    text-transform:uppercase; 
    margin-bottom:6mm;
}

.nomor { 
    font-size:10pt; 
    color:#555; 
    margin-bottom:7mm;
    padding: 6px 20px;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 20px;
    display: inline-block;
    border: 1px solid #bae6fd;
}

.nomor span { 
    color:#1a3a6e; 
    font-weight:700;
    font-size: 11pt;
}

.diberikan-kepada { 
    font-size:11pt; 
    color:#555; 
    margin-bottom:3mm;
    font-style: italic;
}

.nama-usaha { 
    font-size:24pt; 
    font-weight:900; 
    color:#1a3a6e; 
    margin-bottom:2mm; 
    font-style:italic;
    text-shadow: 1px 1px 2px rgba(26, 58, 110, 0.1);
    line-height: 1.2;
}

.nama-pemilik { 
    font-size:11pt; 
    color:#444; 
    margin-bottom:2mm;
}

.alamat-usaha { 
    font-size:10pt; 
    color:#777; 
    margin-bottom:6mm;
    max-width: 200mm;
    line-height: 1.4;
}

.divider-thin { 
    width:100mm; 
    height:1px; 
    background:linear-gradient(90deg,transparent,#ccc,transparent); 
    margin:4mm auto;
}

.info-row { 
    display:flex; 
    justify-content:center; 
    gap:25mm; 
    margin-bottom:7mm;
    flex-wrap: wrap;
}

.info-item { 
    text-align:center;
    min-width: 45mm;
}

.info-item .label { 
    font-size:8pt; 
    color:#999; 
    text-transform:uppercase; 
    letter-spacing:1px;
    margin-bottom: 3px;
}

.info-item .value { 
    font-size:10pt; 
    font-weight:700; 
    color:#1a3a6e;
}

.badge-kategori { 
    display:inline-block; 
    background:linear-gradient(135deg, #1a3a6e 0%, #2451a3 100%); 
    color:#fff; 
    padding:4px 16px; 
    border-radius:20px; 
    font-size:9pt; 
    font-weight:700; 
    letter-spacing:1px;
    box-shadow: 0 2px 8px rgba(26, 58, 110, 0.3);
}

.footer-sertifikat { 
    display:flex; 
    justify-content:space-between; 
    align-items:flex-end; 
    width:100%; 
    margin-top:5mm;
}

.ttd-box { 
    text-align:center; 
    width:65mm;
}

.ttd-box .ttd-title { 
    font-size:9pt; 
    color:#555; 
    margin-bottom:20mm;
}

.ttd-box .ttd-name { 
    font-weight:700; 
    color:#1a3a6e; 
    font-size:10pt; 
    border-top:2px solid #333; 
    padding-top:5px;
    display: inline-block;
    min-width: 50mm;
}

.ttd-box .ttd-nip { 
    font-size:8pt; 
    color:#777;
    margin-top: 2px;
}

.qr-box { 
    text-align:center; 
    width:35mm;
}

.qr-placeholder { 
    width:25mm; 
    height:25mm; 
    border:2px solid #1a3a6e; 
    margin:0 auto 4px; 
    display:flex; 
    align-items:center; 
    justify-content:center;
    border-radius: 4px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.qr-placeholder span { 
    font-size:8pt; 
    color:#1a3a6e;
    font-weight: 600;
}

.qr-label { 
    font-size:7pt; 
    color:#999;
}

.stamp-area { 
    width:65mm; 
    text-align:center;
}

.stamp-circle { 
    width:40mm; 
    height:40mm; 
    border:2px dashed #1a3a6e; 
    border-radius:50%; 
    margin:0 auto; 
    display:flex; 
    align-items:center; 
    justify-content:center;
    background: radial-gradient(circle, rgba(26, 58, 110, 0.02) 0%, transparent 70%);
}

.stamp-circle span { 
    font-size:8pt; 
    color:#1a3a6e;
    font-weight: 600;
    letter-spacing: 1px;
}

.valid-date { 
    font-size:8pt; 
    color:#888;
    margin-top: 3mm;
}

.valid-date strong { 
    color:#1a3a6e;
}
</style>
</head>
<body>

<!-- PRINT CONTROLS -->
<div class="print-controls">
    <button onclick="window.print()" class="btn-print">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
            <path d="M6 14h12v8H6z"/>
        </svg>
        Print Sertifikat
    </button>
    <a href="{{ route('admin.laporan.sertifikat') }}" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>
</div>

<!-- SERTIFIKAT CONTAINER -->
<div class="watermark">DISPERINDAGKOP</div>
<div class="outer-border"></div>
<div class="inner-border"></div>

<!-- Corner Decorations -->
<div class="corner-decoration corner-tl"></div>
<div class="corner-decoration corner-tr"></div>
<div class="corner-decoration corner-bl"></div>
<div class="corner-decoration corner-br"></div>

<div class="content">
    <!-- HEADER -->
    <div class="header-logos">
        <div class="logo-circle">
            <img src="{{ asset('logo.png') }}" alt="Logo Tolikara">
        </div>
        <div class="instansi">
            <div class="dinas">Dinas Perindustrian, Perdagangan, Koperasi</div>
            <div class="kabupaten">Kabupaten Tolikara — Papua Pegunungan</div>
        </div>
        <div class="logo-circle">
            <img src="{{ asset('logo.png') }}" alt="Logo Dinas">
        </div>
    </div>

    <div class="divider-gold"></div>

    <div class="judul-sertifikat">SERTIFIKAT</div>
    <div class="sub-judul">Nomor Induk Berusaha Koperasi</div>
    <div class="nomor">Nomor: <span>{{ $koperasi->no_registrasi }}</span></div>

    <div class="diberikan-kepada">Diberikan kepada:</div>
    <div class="nama-usaha">{{ $koperasi->nama_usaha }}</div>
    <div class="nama-pemilik">Pemilik: <strong>{{ $koperasi->nama_pemilik }}</strong></div>
    <div class="alamat-usaha">{{ $koperasi->alamat }}, {{ $koperasi->kelurahan }}, Distrik {{ $koperasi->distrik }}</div>

    <div class="divider-thin"></div>

    <div class="info-row">
        <div class="info-item">
            <div class="label">Jenis Usaha</div>
            <div class="value">{{ $koperasi->jenis_usaha }}</div>
        </div>
        <div class="info-item">
            <div class="label">Kategori</div>
            <div class="value"><span class="badge-kategori">{{ strtoupper($koperasi->kategori) }}</span></div>
        </div>
        <div class="info-item">
            <div class="label">Tgl. Verifikasi</div>
            <div class="value">{{ $koperasi->verified_at ? \Carbon\Carbon::parse($koperasi->verified_at)->format('d F Y') : \Carbon\Carbon::parse($koperasi->created_at)->format('d F Y') }}</div>
        </div>
        <div class="info-item">
            <div class="label">Berlaku Hingga</div>
            <div class="value">{{ \Carbon\Carbon::now()->addYears(3)->format('d F Y') }}</div>
        </div>
    </div>

    <!-- FOOTER TTD -->
    <div class="footer-sertifikat">
        <div class="ttd-box">
            <div class="ttd-title">Kepala Dinas,</div>
            <div class="ttd-name">.............................</div>
            <div class="ttd-nip">NIP. .........................</div>
        </div>
        <div class="qr-box">
            <div class="qr-placeholder">
                <span>QR CODE</span>
            </div>
            <div class="qr-label">Scan untuk verifikasi</div>
        </div>
        <div class="stamp-area">
            <div class="stamp-circle">
                <span>CAP DINAS</span>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script>
// Auto focus untuk print
window.onload = function() {
    // Optional: Auto print saat halaman dimuat (uncomment jika diinginkan)
    // setTimeout(function() { window.print(); }, 500);
};

// Keyboard shortcut
document.addEventListener('keydown', function(e) {
    // Ctrl+P atau Cmd+P
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
        e.preventDefault();
        window.print();
    }
    
    // ESC untuk kembali
    if (e.key === 'Escape') {
        window.history.back();
    }
});
</script>
