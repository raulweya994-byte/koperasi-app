<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sertifikat Koperasi - {{ $koperasi->nama_usaha }}</title>
<style>
/* PRINT BUTTON STYLES */
.print-controls {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    gap: 10px;
    flex-direction: column;
}

.control-group {
    background: white;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.control-label {
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-group {
    display: flex;
    gap: 8px;
}

.btn-print {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    font-family: system-ui, -apple-system, sans-serif;
}

.btn-print:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn-back {
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    font-family: system-ui, -apple-system, sans-serif;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
}

.style-selector {
    display: flex;
    gap: 8px;
    margin-top: 8px;
}

.style-btn {
    flex: 1;
    padding: 8px 12px;
    border: 2px solid #e5e7eb;
    background: white;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: system-ui, -apple-system, sans-serif;
}

.style-btn:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.style-btn.active {
    border-color: #3b82f6;
    background: #3b82f6;
    color: white;
}

@media print {
    .print-controls {
        display: none !important;
    }
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
}

/* BASE STYLES */
@page { margin: 0; size: A4 landscape; }
* { margin:0; padding:0; box-sizing:border-box; }
body { 
    font-family: 'Georgia', 'Times New Roman', serif; 
    background: #f3f4f6; 
    width:297mm; 
    height:210mm; 
    position:relative; 
    overflow:hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* MODERN STYLE */
.certificate-modern {
    width: 297mm;
    height: 210mm;
    background: linear-gradient(135deg, #1a2b5c 0%, #2d4a8c 50%, #1a2b5c 100%);
    position: relative;
    overflow: hidden;
}

/* Curved Accent Top */
.curved-accent-top {
    position: absolute;
    top: -100px;
    right: -100px;
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
    border-radius: 50%;
    opacity: 0.3;
}

/* Curved Accent Bottom */
.curved-accent-bottom {
    position: absolute;
    bottom: -150px;
    left: -150px;
    width: 500px;
    height: 500px;
    background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
    border-radius: 50%;
    opacity: 0.2;
}

/* Diagonal Stripes */
.diagonal-stripe {
    position: absolute;
    width: 200%;
    height: 150px;
    background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 20px,
        rgba(212, 175, 55, 0.1) 20px,
        rgba(212, 175, 55, 0.1) 40px
    );
    transform: rotate(-15deg);
}

.stripe-top {
    top: -50px;
    left: -50%;
}

.stripe-bottom {
    bottom: -50px;
    left: -50%;
}

.pattern-top-left {
    position: absolute;
    top: 0;
    left: 0;
    width: 200px;
    height: 200px;
    background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 15px,
        rgba(212, 175, 55, 0.05) 15px,
        rgba(212, 175, 55, 0.05) 30px
    );
}

.pattern-bottom-right {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: repeating-linear-gradient(
        -45deg,
        transparent,
        transparent 15px,
        rgba(212, 175, 55, 0.05) 15px,
        rgba(212, 175, 55, 0.05) 30px
    );
}

.diagonal-accent {
    position: absolute;
    top: 0;
    right: 0;
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, transparent 30%, rgba(212, 175, 55, 0.15) 30%, rgba(212, 175, 55, 0.15) 70%, transparent 70%);
    transform: rotate(25deg);
}

.cert-content-modern {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 260mm;
    height: 180mm;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    padding: 40px 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    border: 4px solid #d4af37;
}

.corner-decor {
    position: absolute;
    width: 80px;
    height: 80px;
    border: 3px solid #d4af37;
}

.corner-tl {
    top: 20px;
    left: 20px;
    border-right: none;
    border-bottom: none;
}

.corner-tr {
    top: 20px;
    right: 20px;
    border-left: none;
    border-bottom: none;
}

.corner-bl {
    bottom: 20px;
    left: 20px;
    border-right: none;
    border-top: none;
}

.corner-br {
    bottom: 20px;
    right: 20px;
    border-left: none;
    border-top: none;
}

/* Logo in Content Box */
.logo-content-box {
    position: absolute;
    top: 25px;
    left: 35px;
    width: 70px;
    height: 70px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    border: 3px solid #d4af37;
    z-index: 5;
}

.logo-content-box img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.logo-content-text {
    position: absolute;
    top: 100px;
    left: 20px;
    text-align: center;
    width: 100px;
    font-size: 7pt;
    color: #1a2b5c;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    line-height: 1.2;
}

.logo-badge-modern {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
    border: 4px solid #1a2b5c;
}

.logo-badge-modern img {
    width: 60px;
    height: 60px;
    object-fit: contain;
}

.cert-title-modern {
    font-size: 48pt;
    font-weight: 700;
    color: #1a2b5c;
    letter-spacing: 8px;
    text-transform: uppercase;
    margin-bottom: 8px;
    font-family: 'Georgia', serif;
}

.cert-subtitle-modern {
    font-size: 14pt;
    color: #5a6c8f;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 30px;
    font-weight: 400;
}

.cert-divider-modern {
    width: 120px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #d4af37, transparent);
    margin: 20px auto;
}

.cert-label-modern {
    font-size: 12pt;
    color: #5a6c8f;
    margin-bottom: 10px;
    font-style: italic;
}

.cert-name-modern {
    font-size: 32pt;
    font-weight: 700;
    color: #d4af37;
    margin-bottom: 15px;
    font-family: 'Georgia', serif;
    font-style: italic;
    line-height: 1.2;
    text-shadow: 1px 1px 2px rgba(212, 175, 55, 0.2);
}

.cert-desc-modern {
    font-size: 11pt;
    color: #475569;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto 25px;
}

.info-box-modern {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin: 25px 0;
    flex-wrap: wrap;
}

.info-item-modern {
    text-align: center;
}

.info-label-modern {
    font-size: 9pt;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.info-value-modern {
    font-size: 11pt;
    font-weight: 700;
    color: #1a2b5c;
}

.signature-modern {
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
    width: 100%;
}

.sig-box-modern {
    text-align: center;
    width: 180px;
}

.sig-label-modern {
    font-size: 10pt;
    color: #5a6c8f;
    margin-bottom: 50px;
}

.sig-name-modern {
    font-size: 11pt;
    font-weight: 700;
    color: #1a2b5c;
    border-top: 2px solid #d4af37;
    padding-top: 8px;
}

.sig-title-modern {
    font-size: 9pt;
    color: #94a3b8;
    margin-top: 3px;
}

.seal-modern {
    width: 100px;
    height: 100px;
    border: 3px solid #d4af37;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
}

.seal-modern span {
    font-size: 9pt;
    color: #1a2b5c;
    font-weight: 600;
    text-align: center;
}

/* Hide non-active styles */
.certificate-modern.hidden {
    display: none;
}

/* Logo Corner */
.logo-corner {
    position: absolute;
    top: 30px;
    left: 30px;
    width: 100px;
    height: 100px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    border: 3px solid #d4af37;
    z-index: 10;
}

.logo-corner img {
    width: 70px;
    height: 70px;
    object-fit: contain;
}

.logo-corner-text {
    position: absolute;
    top: 140px;
    left: 30px;
    text-align: center;
    width: 100px;
    font-size: 8pt;
    color: #d4af37;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.3;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}
</style>
</head>
<body>

<!-- PRINT CONTROLS -->
<div class="print-controls">
    <div class="control-group">
        <div class="control-label">Pilih Style</div>
        <div class="style-selector">
            <button class="style-btn active" onclick="switchStyle('modern')">Modern</button>
        </div>
    </div>
    
    <div class="control-group">
        <div class="control-label">Aksi</div>
        <div class="btn-group">
            <button onclick="window.print()" class="btn-print">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                    <path d="M6 14h12v8H6z"/>
                </svg>
                Print
            </button>
            <button onclick="autoPrint()" class="btn-print" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                </svg>
                Auto Print
            </button>
        </div>
        <div class="btn-group" style="margin-top: 8px;">
            <a href="{{ route('admin.laporan.sertifikat') }}" class="btn-back" style="width: 100%; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<!-- MODERN CERTIFICATE -->
<div class="certificate-modern" id="cert-modern">
    <div class="pattern-top-left"></div>
    <div class="pattern-bottom-right"></div>
    <div class="diagonal-accent"></div>
    
    <!-- Logo Corner -->
    <div class="logo-corner">
        <img src="{{ asset('logo.png') }}" alt="Logo Kabupaten Tolikara">
    </div>
    <div class="logo-corner-text">
        Kabupaten<br>Tolikara
    </div>
    
    <div class="cert-content-modern">
        <div class="corner-decor corner-tl"></div>
        <div class="corner-decor corner-tr"></div>
        <div class="corner-decor corner-bl"></div>
        <div class="corner-decor corner-br"></div>
        
        <!-- Logo in Content Box -->
        <div class="logo-content-box">
            <img src="{{ asset('logo.png') }}" alt="Logo">
        </div>
        <div class="logo-content-text">
            Kab.<br>Tolikara
        </div>
        
        <div class="logo-badge-modern">
            <img src="{{ asset('logo.png') }}" alt="Logo">
        </div>
        
        <div style="margin-bottom: 15px;">
            <div style="font-size: 11pt; font-weight: 700; color: #1a2b5c; text-transform: uppercase; letter-spacing: 1px;">
                Dinas Perindustrian, Perdagangan, Koperasi
            </div>
            <div style="font-size: 9pt; color: #5a6c8f; margin-top: 3px;">
                Kabupaten Tolikara — Papua Pegunungan
            </div>
        </div>
        
        <div class="cert-title-modern">SERTIFIKAT</div>
        <div class="cert-subtitle-modern">Penghargaan</div>
        
        <div style="font-size: 10pt; color: #5a6c8f; margin-bottom: 20px;">
            Nomor: <strong style="color: #1a2b5c;">{{ $koperasi->no_registrasi }}</strong>
        </div>
        
        <div class="cert-divider-modern"></div>
        
        <div class="cert-label-modern">Dengan bangga dipersembahkan kepada:</div>
        <div class="cert-name-modern">{{ $koperasi->nama_usaha }}</div>
        
        <div class="cert-desc-modern">
            Sebagai bentuk apresiasi atas dedikasi dan kontribusi luar biasa dalam mengembangkan 
            koperasi yang berdampak positif bagi masyarakat. Semoga terus berkembang dan memberikan 
            manfaat yang berkelanjutan.
        </div>
        
        <div style="font-size: 10pt; color: #5a6c8f; margin-bottom: 20px; max-width: 600px;">
            <strong>Alamat:</strong> {{ $koperasi->alamat }}, {{ $koperasi->kelurahan }}, Distrik {{ $koperasi->distrik }}
        </div>
        
        <div class="info-box-modern">
            <div class="info-item-modern">
                <div class="info-label-modern">Pemilik</div>
                <div class="info-value-modern">{{ $koperasi->nama_pemilik }}</div>
            </div>
            <div class="info-item-modern">
                <div class="info-label-modern">Jenis Usaha</div>
                <div class="info-value-modern">{{ $koperasi->jenis_usaha }}</div>
            </div>
            <div class="info-item-modern">
                <div class="info-label-modern">Kategori</div>
                <div class="info-value-modern">{{ strtoupper($koperasi->kategori) }}</div>
            </div>
            <div class="info-item-modern">
                <div class="info-label-modern">Tanggal Verifikasi</div>
                <div class="info-value-modern">{{ $koperasi->verified_at ? \Carbon\Carbon::parse($koperasi->verified_at)->format('d F Y') : \Carbon\Carbon::parse($koperasi->created_at)->format('d F Y') }}</div>
            </div>
        </div>
        
        <div class="signature-modern">
            <div class="sig-box-modern">
                <div class="sig-label-modern">Kepala Dinas</div>
                <div class="sig-name-modern">Nama Terang</div>
                <div class="sig-title-modern">Jabatan</div>
            </div>
            
            <div class="sig-box-modern">
                <div class="seal-modern">
                    <span>CAP<br>DINAS</span>
                </div>
            </div>
            
            <div class="sig-box-modern">
                <div class="sig-label-modern">Sekretaris</div>
                <div class="sig-name-modern">Nama Terang</div>
                <div class="sig-title-modern">Jabatan</div>
            </div>
        </div>
    </div>
</div>

<script>
function switchStyle(style) {
    // Update active button
    document.querySelectorAll('.style-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Show selected certificate
    document.getElementById('cert-modern').classList.toggle('hidden', style !== 'modern');
}

function autoPrint() {
    // Auto print dengan delay kecil
    setTimeout(function() {
        window.print();
    }, 300);
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
        e.preventDefault();
        window.print();
    }
    if (e.key === 'Escape') {
        window.history.back();
    }
});
</script>

</body>
</html>
