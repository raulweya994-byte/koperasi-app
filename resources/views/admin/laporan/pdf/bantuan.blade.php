<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bantuan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }

        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { font-size: 16px; font-weight: bold; }
        .header p { font-size: 11px; color: #555; margin-top: 4px; }

        .meta { margin-bottom: 15px; font-size: 11px; }
        .meta span { margin-right: 20px; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #2d6a4f; color: white; padding: 7px 8px; text-align: left; font-size: 10px; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; vertical-align: top; font-size: 10px; }
        tr:nth-child(even) { background-color: #f5f5f5; }

        .badge { padding: 2px 8px; border-radius: 3px; font-size: 9px; font-weight: bold; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-secondary { background: #e2e3e5; color: #383d41; }
        .badge-danger { background: #f8d7da; color: #721c24; }

        .penerima-list { margin: 0; padding-left: 12px; }
        .penerima-list li { margin-bottom: 2px; }

        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #777; }
        .ttd { margin-top: 40px; display: flex; justify-content: flex-end; }
        .ttd-box { text-align: center; width: 200px; }
        .ttd-box .garis { margin-top: 60px; border-top: 1px solid #333; padding-top: 4px; }

        .summary { margin-bottom: 15px; display: flex; gap: 15px; }
        .summary-item { background: #f0f0f0; padding: 8px 12px; border-radius: 4px; flex: 1; text-align: center; }
        .summary-item .val { font-size: 18px; font-weight: bold; color: #2d6a4f; }
        .summary-item .lbl { font-size: 9px; color: #666; }
    </style>
</head>
<body>

    <div class="header"><img src="http://127.0.0.1:8000/images/logo-tolikara.png" style="width:55px;height:55px;object-fit:contain;margin-bottom:8px;display:block;margin-left:auto;margin-right:auto;">
        <h2>LAPORAN PROGRAM BANTUAN Koperasi</h2>
        <p>DINAS PERINDUSTRIAN, PERDAGANGAN DAN Koperasi</p>
        <p>KABUPATEN TOLIKARA</p>
    </div>

    <div class="meta">
        <span>Tanggal Cetak: {{ date('d F Y, H:i') }} WIB</span>
        <span>Total Program: {{ $data->count() }}</span>
        <span>Dicetak oleh: {{ auth()->user()->name }}</span>
    </div>

    {{-- Summary --}}
    <table style="margin-bottom:15px;">
        <tr>
            <th style="width:25%">Total Program</th>
            <th style="width:25%">Total Anggaran</th>
            <th style="width:25%">Total Penerima</th>
            <th style="width:25%">Program Aktif</th>
        </tr>
        <tr>
            <td><strong>{{ $data->count() }} Program</strong></td>
            <td><strong>Rp {{ number_format($data->sum('anggaran'), 0, ',', '.') }}</strong></td>
            <td><strong>{{ $data->sum(fn($b) => $b->penerima->count()) }} Koperasi</strong></td>
            <td><strong>{{ $data->where('status', 'aktif')->count() }} Program</strong></td>
        </tr>
    </table>

    {{-- Detail per Program --}}
    @foreach ($data as $i => $bantuan)
    <table>
        <thead>
            <tr>
                <th colspan="6">
                    {{ $i + 1 }}. {{ $bantuan->nama_bantuan }}
                    ({{ $bantuan->kode_bantuan }})
                    — {{ ucfirst($bantuan->status) }}
                </th>
            </tr>
            <tr>
                <th style="background:#4a8c6f">Jenis</th>
                <th style="background:#4a8c6f">Tahun</th>
                <th style="background:#4a8c6f">Periode</th>
                <th style="background:#4a8c6f">Anggaran</th>
                <th style="background:#4a8c6f">Kuota</th>
                <th style="background:#4a8c6f">Terisi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ ucfirst($bantuan->jenis_bantuan) }}</td>
                <td>{{ $bantuan->tahun }}</td>
                <td>{{ $bantuan->periode }}</td>
                <td>Rp {{ number_format($bantuan->anggaran, 0, ',', '.') }}</td>
                <td>{{ $bantuan->kuota }}</td>
                <td>{{ $bantuan->penerima->count() }}</td>
            </tr>
        </tbody>
    </table>

    @if ($bantuan->penerima->count() > 0)
    <table style="margin-top:-15px; margin-bottom:20px;">
        <thead>
            <tr style="background:#eee;">
                <th style="background:#eee; color:#333; width:30px">#</th>
                <th style="background:#eee; color:#333">Nama Koperasi</th>
                <th style="background:#eee; color:#333">Pemilik</th>
                <th style="background:#eee; color:#333">Status Penerimaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bantuan->penerima as $j => $penerima)
            <tr>
                <td>{{ $j + 1 }}</td>
                <td>{{ $penerima->koperasi?->nama_usaha ?? '-' }}</td>
                <td>{{ $penerima->koperasi?->nama_pemilik ?? '-' }}</td>
                <td>
                    <span class="badge {{ match($penerima->status) {
                        'diterima','divalidasi' => 'badge-success',
                        'ditolak' => 'badge-danger',
                        default => 'badge-secondary'
                    } }}">
                        {{ ucfirst($penerima->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @endforeach

    <div class="footer">
        <div class="ttd">
            <div class="ttd-box">
                <p>Tolikara, {{ date('d F Y') }}</p>
                <p>Kepala Dinas</p>
                <div class="garis">
                    <p><strong>(__________________)</strong></p>
                    <p>NIP. ___________________</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>