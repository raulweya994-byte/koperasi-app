<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul ?? 'Dokumen Anggota' }} - {{ $anggota->nama_lengkap }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 12pt;
            color: #222;
            background: #fff;
        }
        .page { padding: 20mm 18mm; min-height: 100vh; }

        /* ORG HEADER */
        .org-header { text-align: center; margin-bottom: 16px; }
        .org-header img { height: 60px; margin-bottom: 8px; }
        .org-name { font-size: 15pt; font-weight: 700; color: #1e3a5f; text-transform: uppercase; }
        .org-sub { font-size: 10pt; color: #555; margin-top: 2px; }
        .doc-title { font-size: 14pt; font-weight: 700; text-transform: uppercase; margin-top: 8px; letter-spacing: 0.5px; }
        .doc-no { font-size: 10pt; color: #555; margin-top: 3px; }
        hr { border: 0; border-top: 2px solid #1e3a5f; margin: 10px 0; }
        hr.thin { border-top: 1px solid #ccc; }

        /* MEMBER BAR */
        .member-bar { display: flex; align-items: center; gap: 14px; background: #eff6ff; border-radius: 8px; padding: 0.9rem; margin: 1rem 0; }
        .m-avatar { width: 52px; height: 52px; border-radius: 50%; background: #1e3a5f; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; flex-shrink: 0; }
        .m-name { font-size: 14pt; font-weight: 700; color: #1e3a5f; }
        .m-id { font-size: 10pt; color: #555; margin-top: 2px; }
        .badge-aktif { display:inline-block;background:#dcfce7;color:#166534;font-size:9pt;padding:2px 10px;border-radius:20px;margin-top:4px; }
        .badge-pending { display:inline-block;background:#fef9c3;color:#92400e;font-size:9pt;padding:2px 10px;border-radius:20px;margin-top:4px; }

        /* GRID */
        .data-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin: 0.75rem 0; }
        .section { margin-bottom: 0.75rem; }
        .sec-label { font-size: 9pt; font-weight: 700; color: #1e5fa8; text-transform: uppercase; letter-spacing: .5px; border-bottom: 1px solid #ddd; padding-bottom: 3px; margin-bottom: 6px; }
        .field { display: flex; justify-content: space-between; font-size: 10pt; padding: 3px 0; border-bottom: 1px dashed #f0f0f0; }
        .fl { color: #718096; }
        .fv { font-weight: 600; }

        /* FIN CARDS */
        .fin-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin: 1rem 0; }
        .fin-card { background: #f0f5ff; border-radius: 8px; padding: 0.75rem; text-align: center; }
        .fc-num { font-size: 12pt; font-weight: 700; color: #1e5fa8; }
        .fc-lbl { font-size: 8pt; color: #718096; margin-top: 3px; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; font-size: 10pt; margin: 0.75rem 0; }
        thead th { background: #1e3a5f; color: #fff; padding: 7px 10px; text-align: left; font-weight: 600; }
        tbody td { padding: 6px 10px; border-bottom: 1px solid #eee; }
        tfoot td { background: #eff6ff; font-weight: 700; padding: 7px 10px; }
        .text-success { color: #16a34a; }
        .text-center { text-align: center; }
        .text-end { text-align: right; }

        /* BIODATA */
        .biodata-table { width: 100%; font-size: 11pt; border-collapse: collapse; }
        .biodata-table td { padding: 5px 4px; border-bottom: 1px solid #f0f0f0; }
        .bt-label { color: #555; width: 190px; }
        .bt-section { background: #1e3a5f; color: #fff; padding: 6px 8px; font-weight: 700; font-size: 10pt; text-transform: uppercase; }

        /* KARTU ANGGOTA */
        .id-card {
            max-width: 320px;
            background: linear-gradient(135deg, #1e3a5f, #2563ab);
            color: #fff;
            border-radius: 12px;
            padding: 1.25rem;
            margin: 0.5rem auto;
        }
        .id-org { font-size: 8pt; opacity: .8; text-align: center; letter-spacing: 1px; text-transform: uppercase; }
        .id-title { font-size: 12pt; font-weight: 700; text-align: center; margin-top: 4px; }
        .id-body { display: flex; gap: 14px; margin-top: 14px; align-items: center; }
        .id-avatar { width: 60px; height: 60px; border-radius: 8px; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 700; flex-shrink: 0; }
        .id-nm { font-size: 13pt; font-weight: 700; }
        .id-sub { font-size: 9pt; opacity: .8; margin-top: 2px; }
        .id-foot { display: flex; justify-content: space-between; font-size: 9pt; opacity: .7; border-top: 1px solid rgba(255,255,255,.3); margin-top: 12px; padding-top: 8px; }

        /* KONTRAK */
        .contract { font-size: 11pt; line-height: 1.9; color: #333; }
        .contract p { margin-bottom: 0.75rem; }
        .pihak { background: #f8fafc; border-left: 4px solid #1e5fa8; padding: 0.75rem 1rem; margin: 0.75rem 0; }

        /* TTD */
        .ttd { display: flex; justify-content: space-between; margin-top: 2.5rem; font-size: 11pt; }
        .ttd-space { height: 65px; }
        .ttd-line { border-top: 1px solid #222; padding-top: 4px; font-weight: 600; }

        /* PRINT */
        @media print {
            body { margin: 0; }
            .page { padding: 15mm; }
            .no-print { display: none !important; }
            @page { margin: 0; }
        }

        /* SCREEN ONLY */
        @media screen {
            body { background: #f3f4f6; }
            .page { max-width: 800px; margin: 20px auto; background: #fff; box-shadow: 0 2px 20px rgba(0,0,0,.1); border-radius: 4px; }
            .top-bar { background: #1e3a5f; color: #fff; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
            .btn-print { background: #fff; color: #1e3a5f; border: none; padding: 7px 18px; border-radius: 6px; font-weight: 600; cursor: pointer; }
        }
    </style>
</head>
<body>

{{-- Top bar (screen only) --}}
<div class="top-bar no-print">
    <span>{{ $judul ?? 'Dokumen' }} — {{ $anggota->nama_lengkap }}</span>
    <div style="display:flex;gap:8px;">
        <button class="btn-print" onclick="window.print()">&#128424; Cetak</button>
        <button class="btn-print" onclick="window.close()">✕ Tutup</button>
    </div>
</div>

<div class="page">

    {{-- ORG HEADER --}}
    <div class="org-header">
        <div class="org-name">DISPERINDAGKOP Kabupaten Tolikara</div>
        <div class="org-sub">Sistem Informasi Perindustrian, Perdagangan, Koperasi dan UMKM</div>
        <hr>
        <div class="doc-title">{{ $judul ?? 'Dokumen Anggota' }}</div>
        @if(isset($subJudul))<div class="doc-no">{{ $subJudul }}</div>@endif
    </div>

    {{-- ============ KARTU ANGGOTA ============ --}}
    @if(($type ?? 'kartu') == 'kartu')
    <div class="id-card">
        <div class="id-org">Koperasi DISPERINDAGKOP Kab. Tolikara</div>
        <div class="id-title">KARTU TANDA ANGGOTA Koperasi</div>
        <div class="id-body">
            <div class="id-avatar">
                {{ strtoupper(substr($anggota->nama_lengkap,0,1)) }}{{ strtoupper(substr(strrchr($anggota->nama_lengkap,' '),1,1) ?? '') }}
            </div>
            <div>
                <div class="id-nm">{{ strtoupper($anggota->nama_lengkap) }}</div>
                <div class="id-sub">No: {{ $anggota->no_anggota }}</div>
                <div class="id-sub">NIK: {{ $anggota->nik }}</div>
                <div class="id-sub">Usaha: {{ $anggota->nama_usaha ?? '-' }}</div>
                <div class="id-sub">{{ $anggota->desa }}, {{ $anggota->distrik }}</div>
            </div>
        </div>
        <div class="id-foot">
            <span>Bergabung: {{ $anggota->created_at->format('d M Y') }}</span>
            <span>Status: {{ ucfirst($anggota->status) }}</span>
        </div>
    </div>
    @endif

    {{-- ============ DETAIL / SEMUA ============ --}}
    @if(in_array($type, ['detail', 'semua']))
    <div class="member-bar">
        <div class="m-avatar">{{ strtoupper(substr($anggota->nama_lengkap,0,1)) }}{{ strtoupper(substr(strrchr($anggota->nama_lengkap,' '),1,1) ?? '') }}</div>
        <div>
            <div class="m-name">{{ strtoupper($anggota->nama_lengkap) }}</div>
            <div class="m-id">{{ $anggota->no_anggota }} &bull; NIK: {{ $anggota->nik }}</div>
            @if($anggota->status == 'aktif')
            <span class="badge-aktif">Aktif</span>
            @else
            <span class="badge-pending">{{ ucfirst($anggota->status) }}</span>
            @endif
        </div>
    </div>
    <div class="data-grid">
        <div>
            <div class="section">
                <div class="sec-label">Data Pribadi</div>
                <div class="field"><span class="fl">Tempat Lahir</span><span class="fv">{{ $anggota->tempat_lahir }}</span></div>
                <div class="field"><span class="fl">Tanggal Lahir</span><span class="fv">{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d F Y') }}</span></div>
                <div class="field"><span class="fl">Jenis Kelamin</span><span class="fv">{{ ucfirst($anggota->jenis_kelamin) }}</span></div>
                <div class="field"><span class="fl">Agama</span><span class="fv">{{ $anggota->agama ?? '-' }}</span></div>
                <div class="field"><span class="fl">No. HP</span><span class="fv">{{ $anggota->no_hp }}</span></div>
                <div class="field"><span class="fl">Email</span><span class="fv">{{ $anggota->email ?? '-' }}</span></div>
            </div>
            <div class="section">
                <div class="sec-label">Alamat</div>
                <div class="field"><span class="fl">Desa</span><span class="fv">{{ $anggota->desa }}</span></div>
                <div class="field"><span class="fl">Distrik</span><span class="fv">{{ $anggota->distrik }}</span></div>
                <div class="field"><span class="fl">Kabupaten</span><span class="fv">{{ $anggota->kabupaten ?? 'Tolikara' }}</span></div>
                <div class="field"><span class="fl">Alamat</span><span class="fv">{{ $anggota->alamat_lengkap ?? '-' }}</span></div>
            </div>
        </div>
        <div>
            <div class="section">
                <div class="sec-label">Data Usaha & Keuangan</div>
                <div class="field"><span class="fl">Nama Usaha</span><span class="fv">{{ $anggota->nama_usaha ?? '-' }}</span></div>
                <div class="field"><span class="fl">Modal Usaha</span><span class="fv text-success">Rp {{ number_format($anggota->modal_usaha??0,0,',','.') }}</span></div>
                <div class="field"><span class="fl">Omzet/Bulan</span><span class="fv text-success">Rp {{ number_format($anggota->omzet_per_bulan??0,0,',','.') }}</span></div>
                <div class="field"><span class="fl">Total Simpanan</span><span class="fv text-success">Rp {{ number_format($anggota->total_simpanan??0,0,',','.') }}</span></div>
                <div class="field"><span class="fl">Keterangan</span><span class="fv">{{ $anggota->keterangan_usaha ?? '-' }}</span></div>
            </div>
        </div>
    </div>
    @endif

    {{-- ============ LAPORAN SIMPANAN / SEMUA ============ --}}
    @if(in_array($type, ['simpanan', 'semua']))
    @if($type == 'simpanan')
    <div class="member-bar">
        <div class="m-avatar">{{ strtoupper(substr($anggota->nama_lengkap,0,1)) }}{{ strtoupper(substr(strrchr($anggota->nama_lengkap,' '),1,1) ?? '') }}</div>
        <div>
            <div class="m-name">{{ strtoupper($anggota->nama_lengkap) }}</div>
            <div class="m-id">{{ $anggota->no_anggota }}</div>
        </div>
    </div>
    <div class="fin-cards">
        <div class="fin-card"><div class="fc-num">Rp {{ number_format($anggota->total_simpanan??0,0,',','.') }}</div><div class="fc-lbl">Total Simpanan</div></div>
        <div class="fin-card"><div class="fc-num">{{ $simpananList->count() }}</div><div class="fc-lbl">Transaksi</div></div>
        <div class="fin-card"><div class="fc-num">Rp {{ number_format($anggota->modal_usaha??0,0,',','.') }}</div><div class="fc-lbl">Modal Usaha</div></div>
        <div class="fin-card"><div class="fc-num">{{ ucfirst($anggota->status) }}</div><div class="fc-lbl">Status</div></div>
    </div>
    @else
    <div class="sec-label" style="margin-top:1rem;">Riwayat Simpanan</div>
    @endif
    <table>
        <thead>
            <tr><th>No</th><th>Tanggal</th><th>Jenis Simpanan</th><th>Jumlah</th><th>Keterangan</th></tr>
        </thead>
        <tbody>
            @forelse($simpananList as $i => $s)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                <td>{{ $s->jenis_simpanan }}</td>
                <td class="text-success" style="font-weight:600;">Rp {{ number_format($s->jumlah,0,',','.') }}</td>
                <td>{{ $s->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center" style="padding:1rem;color:#999;">Belum ada data simpanan</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end">TOTAL SIMPANAN</td>
                <td class="text-success" style="font-weight:700;">Rp {{ number_format($anggota->total_simpanan??0,0,',','.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    @endif

    {{-- ============ BIODATA LENGKAP ============ --}}
    @if($type == 'biodata')
    <table class="biodata-table">
        <tr><td class="bt-label">Nama Lengkap</td><td>: <strong>{{ strtoupper($anggota->nama_lengkap) }}</strong></td></tr>
        <tr><td class="bt-label">No. Anggota</td><td>: {{ $anggota->no_anggota }}</td></tr>
        <tr><td class="bt-label">NIK</td><td>: {{ $anggota->nik }}</td></tr>
        <tr><td class="bt-label">Tempat Lahir</td><td>: {{ $anggota->tempat_lahir }}</td></tr>
        <tr><td class="bt-label">Tanggal Lahir</td><td>: {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d F Y') }}</td></tr>
        <tr><td class="bt-label">Jenis Kelamin</td><td>: {{ ucfirst($anggota->jenis_kelamin) }}</td></tr>
        <tr><td class="bt-label">Agama</td><td>: {{ $anggota->agama ?? '-' }}</td></tr>
        <tr><td class="bt-label">No. HP / WhatsApp</td><td>: {{ $anggota->no_hp }}</td></tr>
        <tr><td class="bt-label">Email</td><td>: {{ $anggota->email ?? '-' }}</td></tr>
        <tr><td colspan="2" class="bt-section">Alamat</td></tr>
        <tr><td class="bt-label">Desa/Kelurahan</td><td>: {{ $anggota->desa }}</td></tr>
        <tr><td class="bt-label">Distrik/Kecamatan</td><td>: {{ $anggota->distrik }}</td></tr>
        <tr><td class="bt-label">Kabupaten/Kota</td><td>: {{ $anggota->kabupaten ?? 'Tolikara' }}</td></tr>
        <tr><td class="bt-label">Alamat Lengkap</td><td>: {{ $anggota->alamat_lengkap ?? '-' }}</td></tr>
        <tr><td class="bt-label">Nama Kompleks</td><td>: {{ $anggota->nama_kompleks ?? '-' }}</td></tr>
        <tr><td colspan="2" class="bt-section">Data Usaha & Keuangan</td></tr>
        <tr><td class="bt-label">Nama Usaha</td><td>: {{ $anggota->nama_usaha ?? '-' }}</td></tr>
        <tr><td class="bt-label">Modal Usaha</td><td>: Rp {{ number_format($anggota->modal_usaha??0,0,',','.') }}</td></tr>
        <tr><td class="bt-label">Omzet Per Bulan</td><td>: Rp {{ number_format($anggota->omzet_per_bulan??0,0,',','.') }}</td></tr>
        <tr><td class="bt-label">Total Simpanan</td><td>: Rp {{ number_format($anggota->total_simpanan??0,0,',','.') }}</td></tr>
        <tr><td class="bt-label">Keterangan Usaha</td><td>: {{ $anggota->keterangan_usaha ?? '-' }}</td></tr>
        <tr><td class="bt-label">Status Keanggotaan</td><td>: {{ ucfirst($anggota->status) }}</td></tr>
        <tr><td class="bt-label">Tanggal Daftar</td><td>: {{ $anggota->created_at->format('d F Y') }}</td></tr>
    </table>
    <div class="ttd">
        <div>
            <div>Yang Bersangkutan,</div>
            <div class="ttd-space"></div>
            <div class="ttd-line">{{ $anggota->nama_lengkap }}</div>
            <div style="font-size:10pt;color:#666;">Anggota</div>
        </div>
        <div style="text-align:right;">
            <div>Tolikara, {{ now()->format('d F Y') }}</div>
            <div>Ketua Koperasi,</div>
            <div class="ttd-space"></div>
            <div class="ttd-line">____________________</div>
        </div>
    </div>
    @endif

    {{-- ============ KONTRAK ============ --}}
    @if($type == 'kontrak')
    <div class="contract">
        <p>Pada hari ini, <strong>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</strong>, yang bertanda tangan di bawah ini:</p>
        <div class="pihak">
            <p><strong>Pihak Pertama (Koperasi)</strong><br>
            Nama &nbsp;&nbsp;: DISPERINDAGKOP Kabupaten Tolikara<br>
            Alamat : Kabupaten Tolikara, Papua Pegunungan</p>
        </div>
        <div class="pihak">
            <p><strong>Pihak Kedua (Anggota)</strong><br>
            Nama &nbsp;&nbsp;: {{ strtoupper($anggota->nama_lengkap) }}<br>
            NIK &nbsp;&nbsp;&nbsp;: {{ $anggota->nik }}<br>
            Alamat : {{ $anggota->alamat_lengkap ?? $anggota->desa.', '.$anggota->distrik }}</p>
        </div>
        <p>Telah sepakat membuat Perjanjian Keanggotaan Koperasi sebagai berikut:</p>
        <p><strong>Pasal 1 — Keanggotaan</strong><br>
        Pihak Kedua diterima sebagai Anggota Koperasi dengan Nomor Anggota <strong>{{ $anggota->no_anggota }}</strong>, terhitung sejak <strong>{{ $anggota->created_at->format('d F Y') }}</strong>.</p>
        <p><strong>Pasal 2 — Hak Anggota</strong><br>
        Anggota berhak mendapatkan layanan koperasi, hadir dalam Rapat Anggota, memperoleh laporan keuangan berkala, dan menikmati manfaat program koperasi.</p>
        <p><strong>Pasal 3 — Kewajiban Anggota</strong><br>
        Anggota wajib membayar simpanan wajib setiap bulan, mematuhi AD/ART Koperasi, dan berpartisipasi aktif dalam kegiatan koperasi.</p>
        <p><strong>Pasal 4 — Data Usaha</strong><br>
        Nama Usaha: {{ $anggota->nama_usaha ?? '-' }}<br>
        Modal Usaha: Rp {{ number_format($anggota->modal_usaha??0,0,',','.') }}<br>
        Total Simpanan: Rp {{ number_format($anggota->total_simpanan??0,0,',','.') }}</p>
        <p><strong>Pasal 5 — Penyelesaian Sengketa</strong><br>
        Sengketa diselesaikan secara musyawarah, atau sesuai peraturan perundang-undangan yang berlaku.</p>
    </div>
    <div class="ttd">
        <div>
            <div>Pihak Kedua,</div>
            <div class="ttd-space"></div>
            <div class="ttd-line">{{ $anggota->nama_lengkap }}</div>
            <div style="font-size:10pt;color:#666;">Anggota</div>
        </div>
        <div style="text-align:right;">
            <div>Pihak Pertama,</div>
            <div class="ttd-space"></div>
            <div class="ttd-line">____________________</div>
            <div style="font-size:10pt;color:#666;">Ketua Koperasi</div>
        </div>
    </div>
    @endif

    {{-- FOOTER --}}
    <div style="margin-top:2rem;text-align:center;font-size:9pt;color:#999;border-top:1px solid #eee;padding-top:8px;">
        &copy; {{ now()->year }} DISPERINDAGKOP Kabupaten Tolikara &bull; Dicetak: {{ now()->format('d/m/Y H:i') }}
    </div>

</div>

<script>
    @if(request('autoprint'))
    window.onload = function() { window.print(); };
    @endif
</script>
</body>
</html>
@if(in_array($type, ['premium','semua']))
{{-- SERTIFIKAT PREMIUM --}}
<div class="sertifikat-premium {{ $type==='semua'?'page-break':'' }}">
    <div class="premium-content" style="text-align:center;">
        <h2>SERTIFIKAT ANGGOTA</h2>
        <p>Dengan ini menyatakan bahwa:</p>
        <h3>{{ strtoupper($anggota->nama) }}</h3>
        <p>No. Anggota: {{ $anggota->no_anggota }}</p>
        <p>Merupakan anggota resmi koperasi</p>
        <br><br>
        <p>Karubaga, {{ now()->format('d M Y') }}</p>
        <br><br>
        <p><b>Kepala Dinas</b></p>
    </div>
</div>
@endif

