<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        // Cek izin view
        if (!can_view('pengumuman')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat pengumuman. Hubungi Administrator untuk mendapatkan akses.');
        }

        $query = Pengumuman::with('user');

        // Filter berdasarkan jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('isi', 'like', '%' . $request->search . '%');
            });
        }

        $pengumuman = $query->orderBy('tanggal', 'desc')
                           ->orderBy('urutan', 'asc')
                           ->paginate(15)
                           ->appends($request->query());

        return view('petugas.pengumuman.index-table', compact('pengumuman'));
    }

    public function create()
    {
        // Cek izin create
        if (!can_create('pengumuman')) {
            return redirect()->route('petugas.pengumuman.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat pengumuman. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.pengumuman.create');
    }

    public function store(Request $request)
    {
        // Cek izin create
        if (!can_create('pengumuman')) {
            return redirect()->route('petugas.pengumuman.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat pengumuman.');
        }

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

        return redirect()->route('petugas.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::with('user')->findOrFail($id);
        return view('petugas.pengumuman.show', compact('pengumuman'));
    }

    public function download($id)
    {
        $pengumuman = Pengumuman::with('user')->findOrFail($id);
        
        // Generate PDF menggunakan DomPDF
        $pdf = \PDF::loadView('petugas.pengumuman.pdf', compact('pengumuman'))
                   ->setPaper('a4', 'portrait');
        
        $filename = 'Pengumuman_' . \Str::slug($pengumuman->judul) . '_' . date('YmdHis') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function edit($id)
    {
        // Cek izin edit
        if (!can_edit('pengumuman')) {
            return redirect()->route('petugas.pengumuman.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit pengumuman. Hubungi Administrator untuk mendapatkan akses.');
        }

        $pengumuman = Pengumuman::findOrFail($id);
        return view('petugas.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        // Cek izin edit
        if (!can_edit('pengumuman')) {
            return redirect()->route('petugas.pengumuman.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit pengumuman.');
        }

        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string|max:255',
            'isi'       => 'required|string',
            'tanggal'   => 'required|date',
            'hari'      => 'required|string|max:20',
            'jam'       => 'required',
            'tahun'     => 'required|integer|min:2020|max:2100',
            'pembuat'   => 'required|string|max:255',
            'jenis'     => 'required|in:info,warning,success,danger',
        ]);

        $pengumuman->update([
            'judul'          => $request->judul,
            'isi'            => $request->isi,
            'tanggal'        => $request->tanggal,
            'hari'           => $request->hari,
            'jam'            => $request->jam,
            'tahun'          => $request->tahun,
            'pembuat'        => $request->pembuat,
            'jenis'          => $request->jenis,
            'is_aktif'       => $request->has('is_aktif') ? 1 : 0,
        ]);

        return redirect()->route('petugas.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Cek izin delete
        if (!can_delete('pengumuman')) {
            return redirect()->route('petugas.pengumuman.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus pengumuman. Hubungi Administrator untuk mendapatkan akses.');
        }

        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->foto) Storage::disk('public')->delete($pengumuman->foto);
        if ($pengumuman->video && !str_starts_with($pengumuman->video, 'http'))
            Storage::disk('public')->delete($pengumuman->video);
        
        $pengumuman->delete();
        
        return redirect()->route('petugas.pengumuman.index')
                       ->with('success', 'Pengumuman berhasil dihapus!');
    }
}
