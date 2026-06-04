<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KontakController extends Controller {
    public function index() {
        $pesanList = DB::table('pesan_kontak')->orderByDesc('created_at')->paginate(15);
        return view('admin.kontak.index', compact('pesanList'));
    }
    public function show($id) {
        $pesan = DB::table('pesan_kontak')->where('id', $id)->first() ?? abort(404);
        DB::table('pesan_kontak')->where('id', $id)->update(['dibaca' => 1]);
        return view('admin.kontak.show', compact('pesan'));
    }
    public function destroy($id) {
        DB::table('pesan_kontak')->where('id', $id)->delete();
        return back()->with('success', 'Pesan dihapus.');
    }
}
