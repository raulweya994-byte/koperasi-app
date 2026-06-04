<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeBantuan;
use Illuminate\Http\Request;

class PeriodeBantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = PeriodeBantuan::with('creator');
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $periodes = $query->latest()->paginate(15)->appends($request->query());
        
        return view('admin.bantuan.periode.index', compact('periodes'));
    }

    public function create()
    {
        return view('admin.bantuan.periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota_penerima' => 'nullable|integer|min:1',
            'anggaran_total' => 'nullable|numeric|min:0',
        ]);

        PeriodeBantuan::create([
            'nama_periode' => $request->nama_periode,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'nonaktif',
            'kuota_penerima' => $request->kuota_penerima,
            'anggaran_total' => $request->anggaran_total,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.periode-bantuan.index')
            ->with('success', 'Periode bantuan berhasil ditambahkan.');
    }

    public function edit(PeriodeBantuan $periodeBantuan)
    {
        return view('admin.bantuan.periode.edit', compact('periodeBantuan'));
    }

    public function update(Request $request, PeriodeBantuan $periodeBantuan)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota_penerima' => 'nullable|integer|min:1',
            'anggaran_total' => 'nullable|numeric|min:0',
        ]);

        $periodeBantuan->update($request->only([
            'nama_periode',
            'deskripsi',
            'tanggal_mulai',
            'tanggal_selesai',
            'kuota_penerima',
            'anggaran_total',
        ]));

        return redirect()->route('admin.periode-bantuan.index')
            ->with('success', 'Periode bantuan berhasil diperbarui.');
    }

    public function toggleStatus(PeriodeBantuan $periodeBantuan)
    {
        $oldStatus = $periodeBantuan->status;
        
        // Jika akan diaktifkan, nonaktifkan periode lain
        if ($periodeBantuan->status === 'nonaktif') {
            PeriodeBantuan::where('status', 'aktif')->update(['status' => 'nonaktif']);
        }

        $periodeBantuan->update([
            'status' => $periodeBantuan->status === 'aktif' ? 'nonaktif' : 'aktif'
        ]);

        $newStatus = $periodeBantuan->status;
        $statusText = $newStatus === 'aktif' ? 'diaktifkan' : 'dinonaktifkan';
        
        // KIRIM NOTIFIKASI KE SEMUA ANGGOTA
        if ($newStatus === 'aktif') {
            // Periode DIBUKA - Kirim notifikasi ke semua anggota
            $this->sendNotificationToAllAnggota(
                'Periode Bantuan Dibuka!',
                "Periode bantuan \"{$periodeBantuan->nama_periode}\" telah dibuka. Segera ajukan kebutuhan bantuan Anda sebelum {$periodeBantuan->tanggal_selesai->format('d M Y')}.",
                route('anggota.kebutuhan-bantuan'),
                'success',
                'calendar-check'
            );
        } else {
            // Periode DITUTUP - Kirim notifikasi ke semua anggota
            $this->sendNotificationToAllAnggota(
                'Periode Bantuan Ditutup',
                "Periode bantuan \"{$periodeBantuan->nama_periode}\" telah ditutup. Terima kasih atas partisipasi Anda.",
                route('anggota.dashboard'),
                'warning',
                'calendar-times'
            );
        }
        
        return back()->with('success', "Periode bantuan berhasil {$statusText}. Notifikasi telah dikirim ke semua anggota.");
    }
    
    /**
     * Kirim notifikasi ke semua anggota
     */
    private function sendNotificationToAllAnggota($judul, $pesan, $url, $jenis, $icon)
    {
        // Ambil semua user dengan role anggota
        $anggotaUsers = \App\Models\User::where('role', 'anggota')->get();
        
        foreach ($anggotaUsers as $user) {
            \App\Models\Notifikasi::create([
                'user_id' => $user->id,
                'judul' => $judul,
                'pesan' => $pesan,
                'url' => $url,
                'jenis' => $jenis,
                'icon' => $icon,
                'is_read' => false,
            ]);
        }
    }

    public function destroy(PeriodeBantuan $periodeBantuan)
    {
        // Cek apakah ada pengajuan terkait
        if ($periodeBantuan->pengajuanBantuan()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus periode yang sudah memiliki pengajuan.');
        }

        $periodeBantuan->delete();
        
        return redirect()->route('admin.periode-bantuan.index')
            ->with('success', 'Periode bantuan berhasil dihapus.');
    }
}
