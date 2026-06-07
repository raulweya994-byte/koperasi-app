<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\PengajuanBantuan;
use Illuminate\Http\Request;

class PengajuanBantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanBantuan::with(['koperasi']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_pemohon', 'like', '%'.$request->search.'%')
                  ->orWhere('nama_usaha', 'like', '%'.$request->search.'%')
                  ->orWhere('jenis_bantuan', 'like', '%'.$request->search.'%');
            });
        }

        $pengajuan = $query->latest()->paginate(15);
        $stats = [
            'total'    => PengajuanBantuan::count(),
            'pending'  => PengajuanBantuan::where('status','pending')->count(),
            'disetujui'=> PengajuanBantuan::where('status','disetujui')->count(),
            'ditolak'  => PengajuanBantuan::where('status','ditolak')->count(),
        ];

        return view('pimpinan.pengajuan-bantuan.index', compact('pengajuan','stats'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanBantuan::with('koperasi')->findOrFail($id);
        return view('pimpinan.pengajuan-bantuan.show', compact('pengajuan'));
    }
}
