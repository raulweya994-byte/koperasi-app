<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Cek izin view
        if (!can_view('berita')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat berita. Hubungi Administrator untuk mendapatkan akses.');
        }

        $query = Berita::with('createdBy');

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
            });
        }

        $berita = $query->latest('published_at')
                       ->paginate(15)
                       ->appends($request->query());

        return view('petugas.berita.index-table', compact('berita'));
    }

    public function create()
    {
        // Cek izin create
        if (!can_create('berita')) {
            return redirect()->route('petugas.berita.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat berita. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.berita.create');
    }

    public function store(Request $request)
    {
        // Cek izin create
        if (!can_create('berita')) {
            return redirect()->route('petugas.berita.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat berita.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:umum,koperasi,pelatihan,bantuan',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('berita', 'public');
        }

        $berita = Berita::create([
            'judul' => $request->judul,
            'slug' => Berita::generateSlug($request->judul),
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'status' => 'publish',
            'thumbnail' => $thumbnailPath,
            'created_by' => auth()->id(),
            'published_at' => now(),
        ]);

        return redirect()->route('petugas.berita.index')
            ->with('success', 'Berita berhasil disimpan dan dipublikasikan.');
    }

    public function show($id)
    {
        $berita = Berita::with('createdBy')->findOrFail($id);
        
        // Increment views (optional)
        $berita->increment('views');
        
        return view('petugas.berita.show', compact('berita'));
    }

    public function edit($id)
    {
        // Cek izin edit
        if (!can_edit('berita')) {
            return redirect()->route('petugas.berita.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit berita. Hubungi Administrator untuk mendapatkan akses.');
        }

        $berita = Berita::findOrFail($id);
        return view('petugas.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        // Cek izin edit
        if (!can_edit('berita')) {
            return redirect()->route('petugas.berita.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit berita.');
        }

        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:umum,koperasi,pelatihan,bantuan',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $thumbnailPath = $berita->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('petugas.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cek izin delete
        if (!can_delete('berita')) {
            return redirect()->route('petugas.berita.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus berita. Hubungi Administrator untuk mendapatkan akses.');
        }

        $berita = Berita::findOrFail($id);

        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }
        $berita->delete();

        return redirect()->route('petugas.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
