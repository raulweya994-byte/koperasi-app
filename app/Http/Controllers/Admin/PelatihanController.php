<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Pelatihan;
use App\Models\PendaftaranPelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihan = Pelatihan::withCount('pendaftaran')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
        return view('admin.pelatihan.index', compact('pelatihan'));
    }

    public function create()
    {
        return view('admin.pelatihan.create');
    }

    public function show(Pelatihan $pelatihan)
    {
        $pelatihan->loadCount('pendaftaran');

        $pesertaDiterima = $pelatihan->pendaftaran()->where('status', 'diterima')->count();
        $pesertaMenunggu = $pelatihan->pendaftaran()->where('status', 'menunggu')->count();
        $pesertaDitolak = $pelatihan->pendaftaran()->where('status', 'ditolak')->count();

        return view('admin.pelatihan.show', compact('pelatihan', 'pesertaDiterima', 'pesertaMenunggu', 'pesertaDitolak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:dibuka,berlangsung,ditutup,selesai',
            'syarat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ], [
            'judul.required' => 'Judul pelatihan wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pelatihan', 'public');
        }

        Pelatihan::create($validated);

        return redirect()->route('admin.pelatihan.index')
            ->with('success', 'Pelatihan berhasil ditambahkan!');
    }

    public function edit(Pelatihan $pelatihan)
    {
        return view('admin.pelatihan.edit', compact('pelatihan'));
    }

    public function update(Request $request, Pelatihan $pelatihan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:dibuka,berlangsung,ditutup,selesai',
            'syarat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ], [
            'judul.required' => 'Judul pelatihan wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pelatihan->foto && Storage::disk('public')->exists($pelatihan->foto)) {
                Storage::disk('public')->delete($pelatihan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pelatihan', 'public');
        }

        $pelatihan->update($validated);

        return redirect()->route('admin.pelatihan.index')
            ->with('success', 'Pelatihan berhasil diperbarui!');
    }

    public function destroy(Pelatihan $pelatihan)
    {
        // Hapus foto jika ada
        if ($pelatihan->foto && Storage::disk('public')->exists($pelatihan->foto)) {
            Storage::disk('public')->delete($pelatihan->foto);
        }

        $pelatihan->delete();

        return redirect()->route('admin.pelatihan.index')
            ->with('success', 'Pelatihan berhasil dihapus!');
    }

    public function peserta(Pelatihan $pelatihan)
    {
        $peserta = $pelatihan->pendaftaran()
            ->with('koperasi')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.pelatihan.peserta', compact('pelatihan', 'peserta'));
    }

    public function updateStatusPeserta(Request $request, PendaftaranPelatihan $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'catatan' => 'nullable|string'
        ]);

        $pendaftaran->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Status peserta berhasil diperbarui!');
    }
}