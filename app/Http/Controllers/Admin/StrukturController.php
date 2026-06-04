<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StrukturController extends Controller {

    public function index() {
        $anggota = DB::table('struktur_organisasi')->orderBy('urutan')->get();
        $data = $anggota->groupBy('bidang');
        return view('admin.struktur.index', compact('data'));
    }

    public function create() {
        return view('admin.struktur.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'bidang'  => 'required|string',
            'urutan'  => 'nullable|integer',
            'foto'    => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['nama','jabatan','bidang','nip','sub_jabatan','urutan','deskripsi']);
        $data['is_active'] = 1;
        $data['urutan'] = $request->filled('urutan') ? (int)$request->urutan : 0;
        $data['sub_jabatan'] = $request->filled('sub_jabatan') ? $request->sub_jabatan : null;
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur','public');
        }
        $data['created_at'] = now();
        $data['updated_at'] = now();
        DB::table('struktur_organisasi')->insert($data);
        return redirect()->route('admin.struktur.index')->with('success','Pegawai ditambahkan!');
    }

    public function edit($id) {
        $anggota = DB::table('struktur_organisasi')->where('id',$id)->first();
        if (!$anggota) abort(404);
        return view('admin.struktur.edit', compact('anggota'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
        ]);
        $data = $request->only(['nama','jabatan','bidang','nip','sub_jabatan','urutan','deskripsi']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['urutan'] = $request->filled('urutan') ? (int)$request->urutan : 0;
        $data['sub_jabatan'] = $request->filled('sub_jabatan') ? $request->sub_jabatan : null;
        if ($request->hasFile('foto')) {
            $old = DB::table('struktur_organisasi')->where('id',$id)->value('foto');
            if ($old) Storage::disk('public')->delete($old);
            $data['foto'] = $request->file('foto')->store('struktur','public');
        }
        $data['updated_at'] = now();
        DB::table('struktur_organisasi')->where('id',$id)->update($data);
        return redirect()->route('admin.struktur.index')->with('success','Data diperbarui!');
    }

    public function destroy($id) {
        $old = DB::table('struktur_organisasi')->where('id',$id)->value('foto');
        if ($old) Storage::disk('public')->delete($old);
        DB::table('struktur_organisasi')->where('id',$id)->delete();
        return back()->with('success','Data dihapus!');
    }

    public function bagan() {
        $bagan = Setting::where('key','bagan_struktur')->first();
        return view('admin.struktur.bagan', compact('bagan'));
    }

    public function uploadBagan(Request $request) {
        $request->validate(['foto'=>'required|image|max:5120']);
        $path = $request->file('foto')->store('struktur','public');
        Setting::updateOrCreate(['key'=>'bagan_struktur'],['value'=>$path]);
        return back()->with('success','Bagan berhasil diupload!');
    }

    public function hapusBagan() {
        $s = Setting::where('key','bagan_struktur')->first();
        if ($s && $s->value) Storage::disk('public')->delete($s->value);
        Setting::where('key','bagan_struktur')->delete();
        return back()->with('success','Bagan dihapus!');
    }
}
