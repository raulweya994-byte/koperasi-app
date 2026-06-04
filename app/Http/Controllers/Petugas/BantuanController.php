<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Bantuan;
use App\Models\PenerimaBantuan;
use App\Models\Koperasi;
use App\Models\ActivityLog;
use App\Models\Notifikasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index(Request $request) {
        if (!can_view('bantuan')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat data bantuan');
        }
        
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
        return view('petugas.bantuan.index', compact('bantuan'));
    }

    public function create() {
        if (!can_create('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat bantuan');
        }
        return view('petugas.bantuan.create');
    }

    public function store(Request $request) {
        if (!can_create('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat bantuan');
        }
        
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

        return redirect()->route('petugas.bantuan.show', $bantuan)
            ->with('success', 'Program bantuan berhasil dibuat dengan kode ' . $bantuan->kode_bantuan);
    }

    public function show(Bantuan $bantuan) {
        if (!can_view('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk melihat detail bantuan');
        }
        
        $bantuan->load('createdBy', 'penerima.koperasi', 'jadwal.petugas');
        $koperasiTersedia = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->whereNotIn('id', $bantuan->penerima->pluck('koperasi_id'))
            ->get();

        return view('petugas.bantuan.show', compact('bantuan', 'koperasiTersedia'));
    }

    public function edit(Bantuan $bantuan) {
        if (!can_edit('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit bantuan');
        }
        return view('petugas.bantuan.edit', compact('bantuan'));
    }

    public function update(Request $request, Bantuan $bantuan) {
        if (!can_edit('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit bantuan');
        }
        
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

        return redirect()->route('petugas.bantuan.show', $bantuan)
            ->with('success', 'Program bantuan berhasil diperbarui.');
    }

    public function destroy(Bantuan $bantuan) {
        if (!can_delete('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus bantuan');
        }
        
        $kode = $bantuan->kode_bantuan;
        $bantuan->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'Bantuan',
            'description' => 'Menghapus program bantuan: ' . $kode,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('petugas.bantuan.index')
            ->with('success', 'Program bantuan berhasil dihapus.');
    }

    public function penerima(Bantuan $bantuan) {
        if (!can_view('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk melihat penerima bantuan');
        }
        
        $bantuan->load('penerima.koperasi');
        $koperasiTersedia = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->whereNotIn('id', $bantuan->penerima->pluck('koperasi_id'))
            ->get();

        $totalPenerima = $bantuan->penerima->count();
        $penerimaByStatus = $bantuan->penerima->groupBy('status')->map->count()->toArray();
        $totalBantuan = $bantuan->penerima->sum('jumlah_bantuan') ?? 0;
        $penerima = $bantuan->penerima;
        $allBantuan = \App\Models\Bantuan::all();
        $programBantuan = $allBantuan;
        $distrik = \App\Models\Koperasi::distinct()->pluck('distrik');
        return view('petugas.bantuan.penerima', compact('bantuan', 'koperasiTersedia', 'totalPenerima', 'penerimaByStatus', 'totalBantuan', 'penerima', 'allBantuan', 'programBantuan', 'distrik'));
    }

    public function tambahPenerima(Request $request, Bantuan $bantuan) {
        if (!can_create('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah penerima bantuan');
        }
        
        $request->validate([
            'koperasi_ids' => 'required|array|min:1',
            'koperasi_ids.*' => 'exists:koperasi,id',
        ]);

        $added = 0;
        $skipped = 0;
        
        foreach ($request->koperasi_ids as $koperasi_id) {
            $exists = PenerimaBantuan::where('bantuan_id', $bantuan->id)
                ->where('koperasi_id', $koperasi_id)->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            if ($bantuan->penerima()->count() >= $bantuan->kuota) {
                break;
            }

            $penerima = PenerimaBantuan::create([
                'bantuan_id' => $bantuan->id,
                'koperasi_id' => $koperasi_id,
                'jumlah_bantuan' => 0,
                'status' => 'pending',
            ]);

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

    public function validasiPenerima(Request $request, PenerimaBantuan $penerima) {
        if (!can_approve('bantuan')) {
            return redirect()->route('petugas.bantuan.index')
                ->with('error', 'Anda tidak memiliki izin untuk memvalidasi penerima bantuan');
        }
        
        $request->validate([
            'status' => 'required|in:divalidasi,diterima,ditolak',
            'jumlah_bantuan' => 'nullable|numeric|min:0',
            'tanggal_penerimaan' => 'nullable|date',
            'catatan' => 'nullable|string|max:500',
        ]);

        $updateData = [
            'status' => $request->status,
            'validated_by' => auth()->id(),
            'validated_at' => now(),
        ];
        
        if ($request->filled('jumlah_bantuan')) {
            $updateData['jumlah_bantuan'] = $request->jumlah_bantuan;
        }
        if ($request->filled('tanggal_penerimaan')) {
            $updateData['tanggal_penerimaan'] = $request->tanggal_penerimaan;
        }
        if ($request->filled('catatan')) {
            $updateData['catatan'] = $request->catatan;
        }

        $penerima->update($updateData);

        if ($penerima->koperasi && $penerima->koperasi->user_id) {
            $pesan = $request->status === 'diterima'
                ? 'Selamat! Bantuan ' . $penerima->bantuan->nama_bantuan . ' telah diterima.'
                : 'Status bantuan ' . $penerima->bantuan->nama_bantuan . ' diperbarui menjadi ' . $request->status . '.';

            Notifikasi::create([
                'user_id' => $penerima->koperasi->user_id,
                'judul' => 'Update Status Bantuan',
                'pesan' => $pesan,
                'jenis' => $request->status === 'diterima' ? 'success' : 'info',
                'link' => route('koperasi.bantuan.riwayat'),
            ]);
        }

        return back()->with('success', 'Status penerima bantuan berhasil diperbarui.');
    }
    
    public function cetakSK(PenerimaBantuan $penerima) {
        $penerima->load('koperasi', 'bantuan');
        $pdf = Pdf::loadView('petugas.bantuan.pdf.sk', compact('penerima'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('SK-Bantuan-' . $penerima->koperasi->no_registrasi . '.pdf');
    }
    public function konfirmasi(Bantuan $bantuan) {
        $bantuan->load("penerima.koperasi");
        $penerima = $bantuan->penerima;
        $stats = [
            "total"        => $penerima->count(),
            "tersalurkan"  => $penerima->where("status_penyaluran","tersalurkan")->count(),
            "tidak_hadir"  => $penerima->where("status_penyaluran","tidak_hadir")->count(),
            "belum"        => $penerima->where("status_penyaluran","belum")->count(),
        ];
        $stats["progres"] = $stats["total"] > 0 ? round(($stats["tersalurkan"] / $stats["total"]) * 100) : 0;
        return view("petugas.bantuan.konfirmasi", compact("bantuan","penerima","stats"));
    }

    public function konfirmasiPenyaluran(Request $request, \App\Models\PenerimaBantuan $penerima) {
        $request->validate([
            "status_penyaluran" => "required|in:tersalurkan,tidak_hadir",
        ]);
        $penerima->update([
            "status_penyaluran"  => $request->status_penyaluran,
            "waktu_konfirmasi"   => now(),
            "dikonfirmasi_oleh"  => auth()->id(),
            "catatan_konfirmasi" => $request->catatan_konfirmasi,
            "status"             => $request->status_penyaluran === "tersalurkan" ? "diterima" : "pending",
        ]);
        return back()->with("success", "Konfirmasi penyaluran berhasil disimpan!");
    }

}
