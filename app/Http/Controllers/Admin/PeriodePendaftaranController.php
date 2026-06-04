<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodePendaftaran;
use Illuminate\Http\Request;

class PeriodePendaftaranController extends Controller
{
    public function index()
    {
        $periode = PeriodePendaftaran::latest()->paginate(10);
        return view('admin.periode-pendaftaran.index', compact('periode'));
    }

    public function create()
    {
        return view('admin.periode-pendaftaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'kuota' => 'nullable|integer|min:1',
        ]);

        $validated['status'] = 'nonaktif';
        $validated['jumlah_pendaftar'] = 0;

        PeriodePendaftaran::create($validated);

        return redirect()->route('admin.periode-pendaftaran.index')
            ->with('success', 'Periode pendaftaran berhasil dibuat');
    }

    public function edit(PeriodePendaftaran $periodePendaftaran)
    {
        return view('admin.periode-pendaftaran.edit', compact('periodePendaftaran'));
    }

    public function update(Request $request, PeriodePendaftaran $periodePendaftaran)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'kuota' => 'nullable|integer|min:1',
        ]);

        $periodePendaftaran->update($validated);

        return redirect()->route('admin.periode-pendaftaran.index')
            ->with('success', 'Periode pendaftaran berhasil diupdate');
    }

    public function toggleStatus(PeriodePendaftaran $periodePendaftaran)
    {
        // Jika akan diaktifkan, nonaktifkan periode lain
        if ($periodePendaftaran->status === 'nonaktif') {
            PeriodePendaftaran::where('status', 'aktif')->update(['status' => 'nonaktif']);
            $periodePendaftaran->update(['status' => 'aktif']);
            $message = 'Periode pendaftaran berhasil dibuka';
        } else {
            $periodePendaftaran->update(['status' => 'nonaktif']);
            $message = 'Periode pendaftaran berhasil ditutup';
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy(PeriodePendaftaran $periodePendaftaran)
    {
        if ($periodePendaftaran->anggota()->count() > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus periode yang sudah memiliki pendaftar');
        }

        $periodePendaftaran->delete();
        return redirect()->route('admin.periode-pendaftaran.index')
            ->with('success', 'Periode pendaftaran berhasil dihapus');
    }
}
