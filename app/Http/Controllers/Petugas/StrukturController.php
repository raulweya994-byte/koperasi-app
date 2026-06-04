<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StrukturController extends Controller {

    public function index() {
        if (!can_view('struktur')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat Struktur. Hubungi Administrator untuk mendapatkan akses.');
        }

        $anggota = DB::table('struktur_organisasi')->orderBy('urutan')->get();
        $data = $anggota->groupBy('bidang');
        return view('petugas.struktur.index', compact('data'));
    }

    public function create() {
        if (!can_create('struktur')) {
            return redirect()->route('petugas.struktur.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat Struktur. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.struktur.create');
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
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur','public');
        }
        $data['created_at'] = now();
        $data['updated_at'] = now();
        DB::table('struktur_organisasi')->insert($data);
        return redirect()->route('petugas.struktur.index')->with('success','Pegawai ditambahkan!');
    }

    public function edit($id) {
        if (!can_edit('struktur')) {
            return redirect()->route('petugas.struktur.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit Struktur. Hubungi Administrator untuk mendapatkan akses.');
        }

        $anggota = DB::table('struktur_organisasi')->where('id',$id)->first();
        if (!$anggota) abort(404);
        return view('petugas.struktur.edit', compact('anggota'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
        ]);
        $data = $request->only(['nama','jabatan','bidang','nip','sub_jabatan','urutan','deskripsi']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('foto')) {
            $old = DB::table('struktur_organisasi')->where('id',$id)->value('foto');
            if ($old) Storage::disk('public')->delete($old);
            $data['foto'] = $request->file('foto')->store('struktur','public');
        }
        $data['updated_at'] = now();
        DB::table('struktur_organisasi')->where('id',$id)->update($data);
        return redirect()->route('petugas.struktur.index')->with('success','Data diperbarui!');
    }

    public function destroy($id) {
        if (!can_delete('struktur')) {
            return redirect()->route('petugas.struktur.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus Struktur. Hubungi Administrator untuk mendapatkan akses.');
        }

        $old = DB::table('struktur_organisasi')->where('id',$id)->value('foto');
        if ($old) Storage::disk('public')->delete($old);
        DB::table('struktur_organisasi')->where('id',$id)->delete();
        return back()->with('success','Data dihapus!');
    }

    public function bagan() {
        $bagan = Setting::where('key','bagan_struktur')->first();
        return view('petugas.struktur.bagan', compact('bagan'));
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
