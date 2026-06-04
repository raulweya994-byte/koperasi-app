<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->get('tipe', 'all'); // all, foto, video
        
        $query = Galeri::with('createdBy');
        
        if ($tipe !== 'all') {
            $query->where('tipe', $tipe);
        }
        
        $galeri = $query->orderBy('urutan', 'asc')->paginate(10);
        
        return view('admin.galeri.index', compact('galeri', 'tipe'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:foto,video',
            'foto' => $request->tipe === 'foto' ? 'required|image|mimes:jpg,jpeg,png,gif|max:2048' : 'nullable',
            'video_url' => $request->tipe === 'video' ? 'required|url' : 'nullable',
            'judul' => $request->tipe === 'video' ? 'required|max:255' : 'nullable',
            'deskripsi' => 'nullable',
            'kategori' => 'nullable|string'
        ]);

        $data = [
            'tipe' => $request->tipe,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori ?? 'kegiatan',
            'urutan' => Galeri::max('urutan') + 1,
            'is_active' => true,
            'created_by' => auth()->id()
        ];

        if ($request->tipe === 'foto' && $request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['foto'] = $file->storeAs('galeri', $filename, 'public');
            
            // Auto-generate judul dari nama file (tanpa extension dan timestamp)
            $originalName = $file->getClientOriginalName();
            $data['judul'] = pathinfo($originalName, PATHINFO_FILENAME);
            
        } elseif ($request->tipe === 'video') {
            $data['judul'] = $request->judul;
            $data['video_url'] = $request->video_url;
            // Generate thumbnail from video URL if YouTube
            if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $request->video_url, $matches)) {
                $data['foto'] = 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
            } elseif (preg_match('/youtu\.be\/([^?]+)/', $request->video_url, $matches)) {
                $data['foto'] = 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
            }
        }

        Galeri::create($data);

        $message = $request->tipe === 'foto' ? 'Foto berhasil ditambahkan ke galeri' : 'Video berhasil ditambahkan ke galeri';
        return redirect()->route('admin.galeri.index')
            ->with('success', $message);
    }

    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'tipe' => 'required|in:foto,video',
            'foto' => $request->tipe === 'foto' ? 'nullable|image|mimes:jpg,jpeg,png|max:2048' : 'nullable',
            'video_url' => $request->tipe === 'video' ? 'required|url' : 'nullable',
            'judul' => $request->tipe === 'video' ? 'required|max:255' : 'nullable',
            'deskripsi' => 'nullable',
            'kategori' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $data = [
            'tipe' => $request->tipe,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori ?? 'kegiatan',
            'urutan' => $request->urutan ?? $galeri->urutan,
            'is_active' => $request->has('is_active') ? $request->is_active : true
        ];

        if ($request->tipe === 'foto') {
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($galeri->foto && \Storage::disk('public')->exists($galeri->foto)) {
                    \Storage::disk('public')->delete($galeri->foto);
                }
                
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $data['foto'] = $file->storeAs('galeri', $filename, 'public');
                
                // Auto-generate judul dari nama file baru
                $originalName = $file->getClientOriginalName();
                $data['judul'] = pathinfo($originalName, PATHINFO_FILENAME);
            } else {
                // Jika tidak upload foto baru, pertahankan judul lama
                $data['judul'] = $galeri->judul;
            }
            $data['video_url'] = null;
        } elseif ($request->tipe === 'video') {
            $data['judul'] = $request->judul;
            $data['video_url'] = $request->video_url;
            // Generate thumbnail from video URL if YouTube
            if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $request->video_url, $matches)) {
                $data['foto'] = 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
            } elseif (preg_match('/youtu\.be\/([^?]+)/', $request->video_url, $matches)) {
                $data['foto'] = 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
            }
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto && \Storage::disk('public')->exists($galeri->foto)) {
            \Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
