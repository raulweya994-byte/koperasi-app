<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $anggota = collect();
        $jadwal = collect();
        if ($q) {
            $anggota = Anggota::where('nama', 'like', "%$q%")
                ->orWhere('no_anggota', 'like', "%$q%")
                ->limit(10)->get();
            $jadwal = Jadwal::where('judul', 'like', "%$q%")
                ->orWhere('lokasi', 'like', "%$q%")
                ->limit(10)->get();
        }
        return view('petugas.search', compact('q', 'anggota', 'jadwal'));
    }
}
