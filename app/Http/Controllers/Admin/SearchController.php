<?php
namespace App\Http\Controllers\Admin;
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
                ->orWhere('no_registrasi', 'like', "%$q%")
                ->limit(10)->get();

            $anggota = Anggota::where('nama', 'like', "%$q%")
                ->orWhere('no_anggota', 'like', "%$q%")
                ->orWhere('nik', 'like', "%$q%")
                ->limit(10)->get();
        }

        return view('admin.search', compact('q', 'koperasi', 'anggota'));
    }
}
