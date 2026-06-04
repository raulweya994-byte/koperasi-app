<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodePendaftaranKoperasi;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PeriodePendaftaranKoperasiController extends Controller
{
    public function index()
    {
        $periode = PeriodePendaftaranKoperasi::with('createdBy')
            ->withCount('koperasi')
            ->latest()
            ->paginate(15);
        
        return view('admin.periode-pendaftaran-koperasi.index', compact('periode'));
    }

    public function create()
    {
        return view('admin.periode-pendaftaran-koperasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        // Jika is_active true, nonaktifkan periode lain
        if ($request->is_active) {
            PeriodePendaftaranKoperasi::where('is_active', true)->update(['is_active' => false]);
        }

        $periode = PeriodePendaftaranKoperasi::create(array_merge($validated, [
            'created_by' => auth()->id(),
        ]));

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'PERIODE_PENDAFTARAN_KOPERASI',
            'description' => 'Membuat periode pendaftaran koperasi: ' . $periode->nama_periode,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.periode-pendaftaran-koperasi.index')
            ->with('success', 'Periode pendaftaran koperasi berhasil dibuat.');
    }

    public function edit(PeriodePendaftaranKoperasi $periodePendaftaranKoperasi)
    {
        return view('admin.periode-pendaftaran-koperasi.edit', [
            'periode' => $periodePendaftaranKoperasi
        ]);
    }

    public function update(Request $request, PeriodePendaftaranKoperasi $periodePendaftaranKoperasi)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        // Jika is_active true, nonaktifkan periode lain
        if ($request->is_active) {
            PeriodePendaftaranKoperasi::where('id', '!=', $periodePendaftaranKoperasi->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $periodePendaftaranKoperasi->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'PERIODE_PENDAFTARAN_KOPERASI',
            'description' => 'Mengupdate periode pendaftaran koperasi: ' . $periodePendaftaranKoperasi->nama_periode,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.periode-pendaftaran-koperasi.index')
            ->with('success', 'Periode pendaftaran koperasi berhasil diperbarui.');
    }

    public function destroy(PeriodePendaftaranKoperasi $periodePendaftaranKoperasi)
    {
        $nama = $periodePendaftaranKoperasi->nama_periode;
        $periodePendaftaranKoperasi->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'PERIODE_PENDAFTARAN_KOPERASI',
            'description' => 'Menghapus periode pendaftaran koperasi: ' . $nama,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.periode-pendaftaran-koperasi.index')
            ->with('success', 'Periode pendaftaran koperasi berhasil dihapus.');
    }

    public function toggleStatus(PeriodePendaftaranKoperasi $periodePendaftaranKoperasi)
    {
        // Jika akan diaktifkan, nonaktifkan periode lain
        if (!$periodePendaftaranKoperasi->is_active) {
            PeriodePendaftaranKoperasi::where('id', '!=', $periodePendaftaranKoperasi->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $periodePendaftaranKoperasi->update([
            'is_active' => !$periodePendaftaranKoperasi->is_active
        ]);

        $status = $periodePendaftaranKoperasi->is_active ? 'diaktifkan' : 'dinonaktifkan';

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'PERIODE_PENDAFTARAN_KOPERASI',
            'description' => 'Periode pendaftaran koperasi ' . $periodePendaftaranKoperasi->nama_periode . ' ' . $status,
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Status periode berhasil diperbarui.');
    }
}
