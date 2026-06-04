<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Bantuan;
use App\Models\JadwalDistribusi;
use App\Models\Notifikasi;
use App\Models\PenerimaBantuan;
use App\Models\Koperasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Bantuan::with('createdBy');

        if ($request->filled('search')) {
            $query->where('nama_bantuan', 'like', '%' . $request->search . '%')
                ->orWhere('kode_bantuan', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bantuan = $query->latest()->paginate(15)->appends($request->query());

        return view('admin.bantuan.index', compact('bantuan'));
    }

    public function create()
    {
        return view('admin.bantuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bantuan' => 'required|string|max:255',
            'jenis_bantuan' => 'required|in:tunai,barang,pelatihan,lainnya',
            'tahun' => 'required|integer|min:2020|max:2099',
            'periode' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
        ]);

        $bantuan = Bantuan::create([
            'kode_bantuan' => Bantuan::generateKode(),
            'nama_bantuan' => $request->nama_bantuan,
            'jenis_bantuan' => $request->jenis_bantuan,
            'tahun' => $request->tahun,
            'periode' => $request->periode,
            'deskripsi' => $request->deskripsi,
            'anggaran' => $request->anggaran,
            'kuota' => $request->kuota,
            'status' => 'aktif',
            'created_by' => auth()->id(),
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'Bantuan',
            'description' => 'Membuat program bantuan: ' . $bantuan->kode_bantuan,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.bantuan.show', $bantuan)
            ->with('success', 'Program bantuan berhasil dibuat dengan kode ' . $bantuan->kode_bantuan);
    }

    public function show(Bantuan $bantuan)
    {
        $bantuan->load('createdBy', 'penerima.koperasi', 'jadwal.petugas');
        $koperasiTersedia = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->whereNotIn('id', $bantuan->penerima->pluck('koperasi_id'))
            ->get();

        return view('admin.bantuan.show', compact('bantuan', 'koperasiTersedia'));
    }

    public function edit(Bantuan $bantuan)
    {
        return view('admin.bantuan.edit', compact('bantuan'));
    }

    public function update(Request $request, Bantuan $bantuan)
    {
        $request->validate([
            'nama_bantuan' => 'required|string|max:255',
            'jenis_bantuan' => 'required|in:tunai,barang,pelatihan,lainnya',
            'tahun' => 'required|integer|min:2020|max:2099',
            'periode' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'status' => 'required|in:aktif,selesai,dibatalkan',
        ]);

        $bantuan->update($request->only([
            'nama_bantuan',
            'jenis_bantuan',
            'tahun',
            'periode',
            'deskripsi',
            'anggaran',
            'kuota',
            'status',
        ]));

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'Bantuan',
            'description' => 'Mengubah program bantuan: ' . $bantuan->kode_bantuan,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.bantuan.show', $bantuan)
            ->with('success', 'Program bantuan berhasil diperbarui.');
    }

    public function destroy(Bantuan $bantuan)
    {
        $kode = $bantuan->kode_bantuan;
        $bantuan->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'Bantuan',
            'description' => 'Menghapus program bantuan: ' . $kode,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.bantuan.index')
            ->with('success', 'Program bantuan berhasil dihapus.');
    }

    public function penerima(Bantuan $bantuan)
    {
        $bantuan->load('penerima.koperasi');
        $koperasiTersedia = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->whereNotIn('id', $bantuan->penerima->pluck('koperasi_id'))
            ->get();

        $totalPenerima = $bantuan->penerima->count();
        $penerimaByStatus = $bantuan->penerima->groupBy('status')->map->count();
        $totalBantuan = $bantuan->penerima->sum('jumlah_bantuan');
        $programBantuan = \App\Models\Bantuan::all();
        $penerima = $bantuan->penerima;
        return view('admin.bantuan.penerima', compact('bantuan', 'koperasiTersedia', 'totalPenerima', 'penerimaByStatus', 'totalBantuan', 'programBantuan', 'penerima'));
    }

    public function tambahPenerima(Request $request, Bantuan $bantuan)
    {
        $request->validate([
            'koperasi_ids' => 'required|array|min:1',
            'koperasi_ids.*' => 'exists:koperasi,id',
        ]);

        $added = 0;
        $skipped = 0;
        
        foreach ($request->koperasi_ids as $koperasi_id) {
            // Cek duplikasi
            $exists = PenerimaBantuan::where('bantuan_id', $bantuan->id)
                ->where('koperasi_id', $koperasi_id)->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            // Cek kuota
            if ($bantuan->penerima()->count() >= $bantuan->kuota) {
                break;
            }

            $penerima = PenerimaBantuan::create([
                'bantuan_id' => $bantuan->id,
                'koperasi_id' => $koperasi_id,
                'jumlah_bantuan' => 0, // Default 0, bisa diupdate nanti
                'status' => 'pending',
            ]);

            // Kirim notifikasi ke koperasi
            $koperasi = Koperasi::find($koperasi_id);
            if ($koperasi && $koperasi->user_id) {
                Notifikasi::create([
                    'user_id' => $koperasi->user_id,
                    'judul' => 'Terdaftar Sebagai Penerima Bantuan',
                    'pesan' => 'Anda terdaftar sebagai penerima ' . $bantuan->nama_bantuan . '. Silahkan cek jadwal distribusi.',
                    'jenis' => 'success',
                    'link' => route('koperasi.bantuan.riwayat'),
                ]);
            }
            
            $added++;
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'Bantuan',
            'description' => 'Menambah ' . $added . ' penerima bantuan ke ' . $bantuan->kode_bantuan,
            'ip_address' => $request->ip(),
        ]);

        $message = $added . ' koperasi berhasil ditambahkan sebagai penerima bantuan.';
        if ($skipped > 0) {
            $message .= ' ' . $skipped . ' koperasi dilewati (sudah terdaftar).';
        }

        return back()->with('success', $message);
    }

    public function updatePenerima(Request $request, PenerimaBantuan $penerima)
    {
        $request->validate([
            'jumlah_bantuan' => 'required|numeric|min:0',
            'status' => 'required|in:pending,divalidasi,diterima,ditolak',
            'tanggal_penerimaan' => 'nullable|date',
            'catatan' => 'nullable|string|max:500',
        ]);

        $penerima->update([
            'jumlah_bantuan' => $request->jumlah_bantuan,
            'status' => $request->status,
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
            'catatan' => $request->catatan,
            'validated_by' => auth()->id(),
            'validated_at' => now(),
        ]);

        // Kirim notifikasi ke koperasi
        if ($penerima->koperasi && $penerima->koperasi->user_id) {
            $pesan = 'Status bantuan ' . $penerima->bantuan->nama_bantuan . ' diperbarui menjadi ' . $request->status . '.';
            if ($request->status === 'diterima') {
                $pesan = 'Selamat! Bantuan ' . $penerima->bantuan->nama_bantuan . ' sebesar Rp ' . number_format($request->jumlah_bantuan, 0, ',', '.') . ' telah diterima.';
            }

            Notifikasi::create([
                'user_id' => $penerima->koperasi->user_id,
                'judul' => 'Update Status Bantuan',
                'pesan' => $pesan,
                'jenis' => $request->status === 'diterima' ? 'success' : 'info',
                'link' => route('koperasi.bantuan.riwayat'),
            ]);
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'Bantuan',
            'description' => 'Mengupdate penerima bantuan: ' . ($penerima->koperasi->nama_usaha ?? '-'),
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Data penerima bantuan berhasil diperbarui.');
    }

    public function destroyPenerima(PenerimaBantuan $penerima)
    {
        $nama = $penerima->koperasi->nama_usaha ?? '-';
        
        // Kirim notifikasi ke koperasi
        if ($penerima->koperasi && $penerima->koperasi->user_id) {
            Notifikasi::create([
                'user_id' => $penerima->koperasi->user_id,
                'judul' => 'Dihapus dari Penerima Bantuan',
                'pesan' => 'Anda telah dihapus dari daftar penerima ' . $penerima->bantuan->nama_bantuan . '.',
                'jenis' => 'warning',
                'link' => route('koperasi.bantuan.riwayat'),
            ]);
        }
        
        $penerima->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'Bantuan',
            'description' => 'Menghapus penerima bantuan: ' . $nama,
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Penerima bantuan berhasil dihapus.');
    }

    public function penerimaIndex(Request $request)
    {
        $query = PenerimaBantuan::with(['koperasi', 'bantuan']);

        // Filter by program bantuan
        if ($request->filled('bantuan_id')) {
            $query->where('bantuan_id', $request->bantuan_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by koperasi name
        if ($request->filled('search')) {
            $query->whereHas('koperasi', function($q) use ($request) {
                $q->where('nama_usaha', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_pemilik', 'like', '%' . $request->search . '%');
            });
        }

        $penerima = $query->latest()->paginate(15)->appends($request->query());

        // Statistics
        $totalPenerima = PenerimaBantuan::count();
        $penerimaByStatus = PenerimaBantuan::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $totalBantuan = PenerimaBantuan::sum('jumlah_bantuan');

        // Get all program bantuan for filter
        $programBantuan = Bantuan::orderBy('nama_bantuan')->get();

        return view('admin.bantuan.penerima-index', compact(
            'penerima',
            'totalPenerima',
            'penerimaByStatus',
            'totalBantuan',
            'programBantuan'
        ));
    }

    public function penerimaExport(Request $request)
    {
        $query = PenerimaBantuan::with(['koperasi', 'bantuan']);

        // Apply same filters as index
        if ($request->filled('bantuan_id')) {
            $query->where('bantuan_id', $request->bantuan_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->whereHas('koperasi', function($q) use ($request) {
                $q->where('nama_usaha', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_pemilik', 'like', '%' . $request->search . '%');
            });
        }

        $penerima = $query->latest()->get();

        // Create Excel file
        $filename = 'Penerima-Bantuan-' . date('Y-m-d') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create HTML table for Excel with styling
        echo '<html><head><meta charset="UTF-8">';
        echo '<style>';
        echo 'table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; }';
        echo 'th, td { border: 1px solid #000; padding: 8px; text-align: left; }';
        echo '.header { background-color: #10b981; color: white; font-weight: bold; text-align: center; }';
        echo '.title { font-size: 18px; font-weight: bold; text-align: center; padding: 10px; }';
        echo '.subtitle { font-size: 14px; text-align: center; padding: 5px; }';
        echo '.info { font-size: 12px; text-align: center; padding: 5px; color: #666; }';
        echo '.number { text-align: center; }';
        echo '.currency { text-align: right; }';
        echo '.status-pending { background-color: #fef3c7; }';
        echo '.status-diterima { background-color: #d1fae5; }';
        echo '.status-ditolak { background-color: #fee2e2; }';
        echo '.status-divalidasi { background-color: #dbeafe; }';
        echo '</style>';
        echo '</head><body>';
        
        // Header Section
        echo '<table>';
        echo '<tr><td colspan="13" class="title">DAFTAR PENERIMA BANTUAN</td></tr>';
        echo '<tr><td colspan="13" class="subtitle">DISPERINDAGKOP KABUPATEN TOLIKARA</td></tr>';
        echo '<tr><td colspan="13" class="info">Jl. Trikora, Karubaga, Kabupaten Tolikara, Papua Pegunungan</td></tr>';
        echo '<tr><td colspan="13" class="info">Tanggal Cetak: ' . date('d F Y, H:i') . ' WIT</td></tr>';
        echo '<tr><td colspan="13">&nbsp;</td></tr>';
        
        // Table Header
        echo '<tr>';
        echo '<th class="header number">No</th>';
        echo '<th class="header">Nama Koperasi</th>';
        echo '<th class="header">No. Registrasi</th>';
        echo '<th class="header">Pemilik</th>';
        echo '<th class="header">No. HP</th>';
        echo '<th class="header">Distrik</th>';
        echo '<th class="header">Program Bantuan</th>';
        echo '<th class="header number">Tahun</th>';
        echo '<th class="header currency">Jumlah Bantuan (Rp)</th>';
        echo '<th class="header">Status</th>';
        echo '<th class="header">Tanggal Daftar</th>';
        echo '<th class="header">Tanggal Penerimaan</th>';
        echo '<th class="header">Catatan</th>';
        echo '</tr>';
        
        // Table Body
        $totalBantuan = 0;
        foreach ($penerima as $i => $p) {
            $statusClass = 'status-' . $p->status;
            $totalBantuan += $p->jumlah_bantuan;
            
            echo '<tr>';
            echo '<td class="number">' . ($i + 1) . '</td>';
            echo '<td>' . ($p->koperasi?->nama_usaha ?? '-') . '</td>';
            echo '<td>' . ($p->koperasi?->no_registrasi ?? '-') . '</td>';
            echo '<td>' . ($p->koperasi?->nama_pemilik ?? '-') . '</td>';
            echo '<td>' . ($p->koperasi?->no_hp ?? '-') . '</td>';
            echo '<td>' . ($p->koperasi?->distrik ?? '-') . '</td>';
            echo '<td>' . ($p->bantuan?->nama_bantuan ?? '-') . '</td>';
            echo '<td class="number">' . ($p->bantuan?->tahun ?? '-') . '</td>';
            echo '<td class="currency">' . number_format($p->jumlah_bantuan, 2, ',', '.') . '</td>';
            echo '<td class="' . $statusClass . '">' . ucfirst($p->status) . '</td>';
            echo '<td>' . ($p->created_at?->format('d/m/Y H:i') ?? '-') . '</td>';
            echo '<td>' . ($p->tanggal_penerimaan ? \Carbon\Carbon::parse($p->tanggal_penerimaan)->format('d/m/Y') : '-') . '</td>';
            echo '<td>' . ($p->catatan ?? '-') . '</td>';
            echo '</tr>';
        }
        
        // Footer with Total
        echo '<tr style="background-color: #f3f4f6; font-weight: bold;">';
        echo '<td colspan="8" style="text-align: right;">TOTAL BANTUAN:</td>';
        echo '<td class="currency">Rp ' . number_format($totalBantuan, 2, ',', '.') . '</td>';
        echo '<td colspan="4"></td>';
        echo '</tr>';
        
        // Summary
        echo '<tr><td colspan="13">&nbsp;</td></tr>';
        echo '<tr><td colspan="13" class="info">Total Penerima: ' . $penerima->count() . ' Koperasi</td></tr>';
        echo '<tr><td colspan="13" class="info">Dicetak oleh: ' . auth()->user()->name . ' pada ' . date('d F Y, H:i') . ' WIT</td></tr>';
        
        echo '</table>';
        echo '</body></html>';
        exit;
    }

    public function validasiPenerima(Request $request, PenerimaBantuan $penerima)
    {
        $request->validate([
            'status' => 'required|in:divalidasi,diterima,ditolak',
            'tanggal_penerimaan' => 'nullable|date',
            'catatan' => 'nullable|string|max:500',
        ]);

        $penerima->update([
            'status' => $request->status,
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
            'catatan' => $request->catatan,
            'validated_by' => auth()->id(),
            'validated_at' => now(),
        ]);

        // Notifikasi ke Koperasi
        if ($penerima->koperasi && $penerima->koperasi->user_id) {
            $pesan = $request->status === 'diterima'
                ? 'Bantuan ' . $penerima->bantuan->nama_bantuan . ' telah diterima.'
                : 'Status bantuan ' . $penerima->bantuan->nama_bantuan . ' diperbarui menjadi ' . $request->status . '.';

            Notifikasi::create([
                'user_id' => $penerima->koperasi->user_id,
                'judul' => 'Update Status Bantuan',
                'pesan' => $pesan,
                'jenis' => $request->status === 'diterima' ? 'success' : 'info',
                'url' => route('koperasi.bantuan.riwayat'),
            ]);
        }

        return back()->with('success', 'Status penerima bantuan berhasil diperbarui.');
    }

    public function cetakSK(PenerimaBantuan $penerima)
    {
        $penerima->load('koperasi', 'bantuan');
        $pdf = Pdf::loadView('admin.bantuan.pdf.sk', compact('penerima'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('SK-Bantuan-' . $penerima->koperasi->no_registrasi . '.pdf');
    }
}