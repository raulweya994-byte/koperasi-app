<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::with('user')->orderBy('urutan')->latest()->paginate(15);
        return view('admin.pengumuman.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'isi'       => 'required|string',
            'tanggal'   => 'required|date',
            'hari'      => 'required|string|max:20',
            'jam'       => 'required',
            'tahun'     => 'required|integer|min:2020|max:2100',
            'pembuat'   => 'required|string|max:255',
            'jenis'     => 'nullable|in:info,warning,success,danger',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi',
            'isi.required' => 'Isi pengumuman wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'hari.required' => 'Hari wajib dipilih',
            'jam.required' => 'Jam wajib diisi',
            'tahun.required' => 'Tahun wajib diisi',
            'pembuat.required' => 'Nama pembuat surat wajib diisi',
        ]);

        Pengumuman::create([
            'judul'          => $request->judul,
            'isi'            => $request->isi,
            'tanggal'        => $request->tanggal,
            'hari'           => $request->hari,
            'jam'            => $request->jam,
            'tahun'          => $request->tahun,
            'pembuat'        => $request->pembuat,
            'jenis'          => $request->jenis ?? 'info',
            'tampil_di'      => 'semua',
            'is_aktif'       => $request->has('is_aktif') ? 1 : 0,
            'mulai_tampil'   => null,
            'selesai_tampil' => null,
            'link'           => null,
            'foto'           => null,
            'video'          => null,
            'jenis_video'    => null,
            'urutan'         => 0,
            'user_id'        => auth()->id(),
        ]);

        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function download($id)
    {
        $pengumuman = Pengumuman::with('user')->findOrFail($id);
        
        // Generate PDF menggunakan DomPDF
        $pdf = \PDF::loadView('admin.pengumuman.pdf', compact('pengumuman'))
                   ->setPaper('a4', 'portrait');
        
        $filename = 'Pengumuman_' . \Str::slug($pengumuman->judul) . '_' . date('YmdHis') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function edit(Pengumuman $pengumuman)
    {
        // Cek apakah pengumuman dibuat oleh admin (bukan petugas)
        if ($pengumuman->user && $pengumuman->user->role !== 'admin') {
            return redirect()->route('admin.pengumuman.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit pengumuman ini!');
        }
        
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        // Cek apakah pengumuman dibuat oleh admin
        if ($pengumuman->user && $pengumuman->user->role !== 'admin') {
            return redirect()->route('admin.pengumuman.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit pengumuman ini!');
        }
        
        $request->validate([
            'judul'     => 'required|string|max:255',
            'isi'       => 'required|string',
            'jenis'     => 'required|in:info,warning,success,danger',
            'tampil_di' => 'required|in:ticker,halaman,keduanya',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'jenis_video' => 'required|in:upload,youtube',
        ]);

        $foto  = $pengumuman->foto;
        $video = $pengumuman->video;

        if ($request->hasFile('foto')) {
            if ($foto) Storage::disk('public')->delete($foto);
            $foto = $request->file('foto')->store('pengumuman/foto', 'public');
        }

        if ($request->jenis_video === 'upload' && $request->hasFile('video')) {
            if ($video && !str_starts_with($video, 'http')) Storage::disk('public')->delete($video);
            $video = $request->file('video')->store('pengumuman/video', 'public');
        } elseif ($request->jenis_video === 'youtube') {
            $video = $request->video;
        }

        $pengumuman->update([
            'judul'          => $request->judul,
            'isi'            => $request->isi,
            'jenis'          => $request->jenis,
            'tampil_di'      => $request->tampil_di,
            'is_aktif'       => $request->has('is_aktif'),
            'mulai_tampil'   => $request->mulai_tampil ?: null,
            'selesai_tampil' => $request->selesai_tampil ?: null,
            'link'           => $request->link,
            'foto'           => $foto,
            'video'          => $video,
            'jenis_video'    => $request->jenis_video,
            'urutan'         => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil diupdate!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // Cek apakah pengumuman dibuat oleh admin
        if ($pengumuman->user && $pengumuman->user->role !== 'admin') {
            return redirect()->route('admin.pengumuman.index')
                           ->with('error', 'Anda tidak memiliki akses untuk menghapus pengumuman ini!');
        }
        
        if ($pengumuman->foto) Storage::disk('public')->delete($pengumuman->foto);
        if ($pengumuman->video && !str_starts_with($pengumuman->video, 'http'))
            Storage::disk('public')->delete($pengumuman->video);
        $pengumuman->delete();
        return back()->with('success', 'Pengumuman dihapus.');
    }

    public function toggleAktif(Pengumuman $pengumuman)
    {
        $pengumuman->update(['is_aktif' => !$pengumuman->is_aktif]);
        return back()->with('success', 'Status diubah.');
    }
}
