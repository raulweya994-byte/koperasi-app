<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        if (!can_view('galeri')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat Galeri. Hubungi Administrator untuk mendapatkan akses.');
        }

        $galeri = Galeri::with('createdBy')->orderBy('urutan', 'asc')->paginate(10);
        return view('petugas.galeri.index', compact('galeri'));
    }

    public function create()
    {
        if (!can_create('galeri')) {
            return redirect()->route('petugas.galeri.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat Galeri. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tipe' => 'required|in:foto,video'
        ]);

        $data = [
            'tipe' => $request->tipe,
            'judul' => 'Foto Galeri ' . date('d M Y H:i'), // Auto-generate judul
            'deskripsi' => null,
            'kategori' => 'kegiatan', // Default kategori
            'urutan' => Galeri::max('urutan') + 1, // Auto increment urutan
            'is_active' => true,
            'created_by' => auth()->id() // Simpan user yang upload
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['foto'] = $file->storeAs('galeri', $filename, 'public');
            
            // Update judul dengan nama file asli (tanpa extension)
            $data['judul'] = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        }

        Galeri::create($data);

        return redirect()->route('petugas.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri');
    }

    public function show(Galeri $galeri)
    {
        return view('petugas.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        if (!can_edit('galeri')) {
            return redirect()->route('petugas.galeri.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit Galeri. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable',
            'kategori' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori ?? 'kegiatan',
            'urutan' => $request->urutan ?? $galeri->urutan,
            'is_active' => $request->has('is_active') ? $request->is_active : true
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($galeri->foto && \Storage::disk('public')->exists($galeri->foto)) {
                \Storage::disk('public')->delete($galeri->foto);
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['foto'] = $file->storeAs('galeri', $filename, 'public');
        }

        $galeri->update($data);

        return redirect()->route('petugas.galeri.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Galeri $galeri)
    {
        if (!can_delete('galeri')) {
            return redirect()->route('petugas.galeri.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus Galeri. Hubungi Administrator untuk mendapatkan akses.');
        }

        if ($galeri->foto && \Storage::disk('public')->exists($galeri->foto)) {
            \Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('petugas.galeri.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
