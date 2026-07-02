<?php
namespace App\Http\Controllers;
use App\Models\Koperasi;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class PublicSearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $koperasi = collect();
        $berita = collect();
        $pengumuman = collect();
        $jadwal = collect();

        if ($q) {
            $koperasi = Koperasi::where('status_verifikasi', 'terverifikasi')
                ->where(function($query) use ($q) {
                    $query->where('nama_usaha', 'like', "%$q%")
                          ->orWhere('distrik', 'like', "%$q%");
                })->limit(10)->get();

            $berita = Berita::where('status', 'published')
                ->where(function($query) use ($q) {
                    $query->where('judul', 'like', "%$q%")
                          ->orWhere('isi', 'like', "%$q%");
                })->limit(5)->get();

            $pengumuman = Pengumuman::where('judul', 'like', "%$q%")
                ->limit(5)->get();

            $jadwal = Jadwal::where('is_publik', true)
                ->whereIn('status', ['dijadwalkan', 'berlangsung'])
                ->where(function($query) use ($q) {
                    $query->where('judul', 'like', "%$q%")
                          ->orWhere('lokasi', 'like', "%$q%");
                })->limit(5)->get();
        }

        return view('public.search', compact('q', 'koperasi', 'berita', 'pengumuman', 'jadwal'));
    }
}
