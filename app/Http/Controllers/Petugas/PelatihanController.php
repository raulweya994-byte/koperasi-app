<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Pelatihan;
use App\Models\PendaftaranPelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelatihanController extends Controller
{
    public function index()
    {
        if (!can_view('pelatihan')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat Pelatihan. Hubungi Administrator untuk mendapatkan akses.');
        }

        $pelatihan = Pelatihan::withCount('pendaftaran')->orderBy('tanggal_mulai', 'desc')->get();
        return view('petugas.pelatihan.index', compact('pelatihan'));
    }
    public function create()
    {
        if (!can_create('pelatihan')) {
            return redirect()->route('petugas.pelatihan.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat Pelatihan. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.pelatihan.create');
    }
    public function store(Request $request)
    {
        $request->validate(['judul' => 'required', 'tanggal_mulai' => 'required|date']);
        $d = $request->only(['judul', 'deskripsi', 'penyelenggara', 'tanggal_mulai', 'tanggal_selesai', 'lokasi', 'kuota', 'status', 'syarat']);
        if ($request->hasFile('foto'))
            $d['foto'] = $request->file('foto')->store('pelatihan', 'public');
        Pelatihan::create($d);
        return redirect()->route('petugas.pelatihan.index')->with('success', 'Pelatihan berhasil ditambah!');
    }
    public function edit(Pelatihan $pelatihan)
    {
        if (!can_edit('pelatihan')) {
            return redirect()->route('petugas.pelatihan.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit Pelatihan. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.pelatihan.edit', compact('pelatihan'));
    }
    public function update(Request $request, Pelatihan $pelatihan)
    {
        $request->validate(['judul' => 'required', 'tanggal_mulai' => 'required|date']);
        $d = $request->only(['judul', 'deskripsi', 'penyelenggara', 'tanggal_mulai', 'tanggal_selesai', 'lokasi', 'kuota', 'status', 'syarat']);
        if ($request->hasFile('foto')) {
            if ($pelatihan->foto)
                Storage::disk('public')->delete($pelatihan->foto);
            $d['foto'] = $request->file('foto')->store('pelatihan', 'public');
        }
        $pelatihan->update($d);
        return redirect()->route('petugas.pelatihan.index')->with('success', 'Pelatihan diperbarui!');
    }
    public function destroy(Pelatihan $pelatihan)
    {
        if (!can_delete('pelatihan')) {
            return redirect()->route('petugas.pelatihan.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus Pelatihan. Hubungi Administrator untuk mendapatkan akses.');
        }

        if ($pelatihan->foto)
            Storage::disk('public')->delete($pelatihan->foto);
        $pelatihan->delete();
        return redirect()->route('petugas.pelatihan.index')->with('success', 'Pelatihan dihapus!');
    }
    public function peserta(Pelatihan $pelatihan)
    {
        $peserta = $pelatihan->pendaftaran()->orderBy('created_at', 'desc')->get();
        return view('petugas.pelatihan.peserta', compact('pelatihan', 'peserta'));
    }
    public function updateStatusPeserta(Request $request, PendaftaranPelatihan $pendaftaran)
    {
        $pendaftaran->update(['status' => $request->status, 'catatan' => $request->catatan]);
        return back()->with('success', 'Status peserta diperbarui!');
    }
}