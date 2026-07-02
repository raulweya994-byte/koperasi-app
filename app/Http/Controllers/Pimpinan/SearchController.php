<?php
namespace App\Http\Controllers\Pimpinan;
use App\Http\Controllers\Controller;
use App\Models\Koperasi;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $koperasi = collect();
        $anggota = collect();
        if ($q) {
            $koperasi = Koperasi::where('nama_usaha', 'like', "%$q%")
                ->orWhere('nama_pemilik', 'like', "%$q%")
                ->limit(10)->get();
            $anggota = Anggota::where('nama', 'like', "%$q%")
                ->orWhere('no_anggota', 'like', "%$q%")
                ->limit(10)->get();
        }
        return view('pimpinan.search', compact('q', 'koperasi', 'anggota'));
    }
}
