<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KontakController extends Controller {
    public function index() {
        if (!can_view('kontak')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat Kontak. Hubungi Administrator untuk mendapatkan akses.');
        }

        $pesanList = DB::table('pesan_kontak')->orderByDesc('created_at')->paginate(15);
        return view('petugas.kontak.index', compact('pesanList'));
    }
    public function show($id) {
        $pesan = DB::table('pesan_kontak')->where('id', $id)->first() ?? abort(404);
        DB::table('pesan_kontak')->where('id', $id)->update(['dibaca' => 1]);
        return view('petugas.kontak.show', compact('pesan'));
    }
    public function destroy($id) {
        if (!can_delete('kontak')) {
            return redirect()->route('petugas.kontak.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus Kontak. Hubungi Administrator untuk mendapatkan akses.');
        }

        DB::table('pesan_kontak')->where('id', $id)->delete();
        return back()->with('success', 'Pesan dihapus.');
    }
}
