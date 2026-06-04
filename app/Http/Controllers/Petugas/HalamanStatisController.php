<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\HalamanStatis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HalamanStatisController extends Controller
{
    public function index()
    {
        if (!can_view('halamanstatis')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat HalamanStatis. Hubungi Administrator untuk mendapatkan akses.');
        }

        $halamanList = HalamanStatis::all();
        return view('petugas.halaman_statis.index', compact('halamanList'));
    }
    public function create()
    {
        if (!can_create('halamanstatis')) {
            return redirect()->route('petugas.halamanstatis.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat HalamanStatis. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.halaman_statis.create');
    }
    public function store(Request $request)
    {
        $request->validate(['slug' => 'required|unique:halaman_statis,slug', 'judul' => 'required']);
        $data = $request->only(['slug', 'judul', 'konten', 'icon', 'status']);
        if ($request->hasFile('gambar'))
            $data['gambar'] = $request->file('gambar')->store('halaman', 'public');
        HalamanStatis::create($data);
        return redirect()->route('petugas.halaman-statis.index')->with('success', 'Halaman disimpan.');
    }
    public function edit($id)
    {
        if (!can_edit('halamanstatis')) {
            return redirect()->route('petugas.halamanstatis.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit HalamanStatis. Hubungi Administrator untuk mendapatkan akses.');
        }

        $halamanStatis = \App\Models\HalamanStatis::findOrFail($id);

        return view('petugas.halaman_statis.edit', compact('halamanStatis'));
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
        return redirect()->route('petugas.halaman-statis.index')->with('success', 'Halaman diperbarui.');
    }
    public function destroy(HalamanStatis $halamanStatis)
    {
        if (!can_delete('halamanstatis')) {
            return redirect()->route('petugas.halamanstatis.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus HalamanStatis. Hubungi Administrator untuk mendapatkan akses.');
        }

        if ($halamanStatis->gambar)
            Storage::disk('public')->delete($halamanStatis->gambar);
        $halamanStatis->delete();
        return back()->with('success', 'Halaman dihapus.');
    }
}
