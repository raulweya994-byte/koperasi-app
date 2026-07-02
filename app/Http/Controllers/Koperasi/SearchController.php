<?php
namespace App\Http\Controllers\Koperasi;
use App\Http\Controllers\Controller;
use App\Models\Bantuan;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $bantuan = collect();
        $jadwal = collect();
        if ($q) {
            $bantuan = Bantuan::where('nama_bantuan', 'like', "%$q%")
                ->where('status', 'aktif')
                ->limit(10)->get();
            $jadwal = Jadwal::where('judul', 'like', "%$q%")
                ->whereIn('status', ['dijadwalkan', 'berlangsung'])
                ->where('is_publik', true)
                ->limit(10)->get();
        }
        return view('koperasi.search', compact('q', 'bantuan', 'jadwal'));
    }
}
