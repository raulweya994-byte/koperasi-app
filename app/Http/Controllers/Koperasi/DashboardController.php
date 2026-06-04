<?php
namespace App\Http\Controllers\Koperasi;
use App\Http\Controllers\Controller;
use App\Models\Bantuan;
use App\Models\Notifikasi;
use App\Models\PenerimaBantuan;
use App\Models\Koperasi;

class DashboardController extends Controller
{
    public function daftar() {
        return view("koperasi.daftar");
    }

    public function index() {
        $user = auth()->user();
        $koperasi = Koperasi::where('user_id', $user->id)->first();

        // Kalau belum ada data koperasi → form pendaftaran
        if (!$koperasi) {
            return redirect()->route('koperasi.daftar');
        }

        // Kalau masih pending → halaman tunggu verifikasi
        if ($koperasi->status_verifikasi === 'pending') {
            return view('koperasi.menunggu', compact('koperasi'));
        }

        // Kalau ditolak → halaman ditolak
        if ($koperasi->status_verifikasi === 'ditolak') {
            return view('koperasi.ditolak', compact('koperasi'));
        }

        // Sudah diverifikasi → dashboard penuh
        $bantuan_aktif   = Bantuan::where('status', 'aktif')->count();
        $riwayat_bantuan = PenerimaBantuan::where('koperasi_id', $koperasi->id)->count();
        $notifikasi_baru = Notifikasi::where('user_id', $user->id)->whereNull('read_at')->count();

        return view('koperasi.dashboard', compact('koperasi','bantuan_aktif','riwayat_bantuan','notifikasi_baru'));
    }

    public function notifikasi() {
        $notifikasi = Notifikasi::where('user_id', auth()->id())->latest()->paginate(15);
        return view('koperasi.notifikasi', compact('notifikasi'));
    }

    public function readNotifikasi(Notifikasi $notifikasi) {
        $notifikasi->update(['read_at' => now()]);
        if ($notifikasi->url) return redirect($notifikasi->url);
        return back();
    }
}
