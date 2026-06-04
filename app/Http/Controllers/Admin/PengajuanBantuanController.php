<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBantuan;
use Illuminate\Http\Request;

class PengajuanBantuanController extends Controller
{
    public function index(Request $request)
    {
        $q = PengajuanBantuan::with(['anggota', 'koperasi', 'periodeBantuan']);
        
        if ($request->status)
            $q->where('status', $request->status);
            
        if ($request->search)
            $q->where('nama_pemohon', 'like', '%'.$request->search.'%');
        
        $pengajuan = $q->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.pengajuan_bantuan.index', compact('pengajuan'));
    }
    public function show(PengajuanBantuan $pengajuanBantuan)
    {
        $pengajuanBantuan->load(['anggota', 'koperasi', 'periodeBantuan']);
        return view('admin.pengajuan_bantuan.show', compact('pengajuanBantuan'));
    }
    public function update(Request $request, PengajuanBantuan $pengajuanBantuan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,disetujui,ditolak',
            'catatan_admin' => 'nullable|string'
        ]);
        
        $pengajuanBantuan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);
        
        // Kirim notifikasi ke koperasi atau anggota
        $message = $request->status === 'disetujui'
            ? 'Pengajuan bantuan Anda telah disetujui!'
            : 'Pengajuan bantuan Anda ditolak. ' . ($request->catatan_admin ?? '');

        $userId = null;
        if ($pengajuanBantuan->koperasi_id) {
            $koperasi = \App\Models\Koperasi::find($pengajuanBantuan->koperasi_id);
            $userId = $koperasi->user_id ?? null;
        } elseif ($pengajuanBantuan->anggota_id) {
            $userId = $pengajuanBantuan->anggota->user_id ?? null;
        }

        if ($userId) {
            \App\Models\Notifikasi::create([
                'user_id' => $userId,
                'judul'   => 'Status Pengajuan Bantuan',
                'pesan'   => $message,
                'link'    => '/koperasi-portal/riwayat',
                'is_read' => false
            ]);
        }
        
        return redirect()->route('admin.pengajuan-bantuan.show', $pengajuanBantuan)
            ->with('success', 'Status pengajuan berhasil diperbarui!');
    }
    public function destroy(PengajuanBantuan $pengajuanBantuan)
    {
        $pengajuanBantuan->delete();
        return redirect()->route('admin.pengajuan-bantuan.index')->with('success', 'Data dihapus!');
    }
}