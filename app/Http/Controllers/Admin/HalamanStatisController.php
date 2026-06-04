<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\HalamanStatis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HalamanStatisController extends Controller
{
    public function index()
    {
        $halamanList = HalamanStatis::all();
        return view('admin.halaman_statis.index', compact('halamanList'));
    }
    public function create()
    {
        return view('admin.halaman_statis.create');
    }
    public function store(Request $request)
    {
        $request->validate(['slug' => 'required|unique:halaman_statis,slug', 'judul' => 'required']);
        $data = $request->only(['slug', 'judul', 'konten', 'icon', 'status']);
        if ($request->hasFile('gambar'))
            $data['gambar'] = $request->file('gambar')->store('halaman', 'public');
        HalamanStatis::create($data);
        return redirect()->route('admin.halaman-statis.index')->with('success', 'Halaman disimpan.');
    }
    public function edit($id)
    {
        $halamanStatis = \App\Models\HalamanStatis::findOrFail($id);

        return view('admin.halaman_statis.edit', compact('halamanStatis'));
    }
    public function update(Request $request, HalamanStatis $halamanStatis)
    {
        $request->validate(['slug' => 'required|unique:halaman_statis,slug,' . $halamanStatis->id, 'judul' => 'required']);
        $data = $request->only(['slug', 'judul', 'konten', 'icon', 'status']);
        if ($request->hasFile('gambar')) {
            if ($halamanStatis->gambar)
                Storage::disk('public')->delete($halamanStatis->gambar);
            $data['gambar'] = $request->file('gambar')->store('halaman', 'public');
        }
        $halamanStatis->update($data);
        return redirect()->route('admin.halaman-statis.index')->with('success', 'Halaman diperbarui.');
    }
    public function destroy(HalamanStatis $halamanStatis)
    {
        if ($halamanStatis->gambar)
            Storage::disk('public')->delete($halamanStatis->gambar);
        $halamanStatis->delete();
        return back()->with('success', 'Halaman dihapus.');
    }
}
