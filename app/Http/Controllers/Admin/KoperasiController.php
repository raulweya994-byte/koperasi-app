<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\DokumenKoperasi;
use App\Models\Notifikasi;
use App\Models\Koperasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KoperasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Koperasi::with('user', 'verifiedBy');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_pemilik', 'like', "%{$s}%")
                    ->orWhere('nama_usaha', 'like', "%{$s}%")
                    ->orWhere('no_ktp', 'like', "%{$s}%")
                    ->orWhere('no_registrasi', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status_verifikasi')) {
            $query->where('status_verifikasi', $request->status_verifikasi);
        }

        if ($request->filled('status_usaha')) {
            $query->where('status_usaha', $request->status_usaha);
        }

        if ($request->filled('distrik')) {
            $query->where('distrik', $request->distrik);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $koperasi = $query->latest()->paginate(15)->appends($request->query());
        $stats = [
            'total'        => \App\Models\Koperasi::count(),
            'pending'      => \App\Models\Koperasi::where('status_verifikasi','pending')->count(),
            'diverifikasi' => \App\Models\Koperasi::where('status_verifikasi','diverifikasi')->count(),
            'aktif'        => \App\Models\Koperasi::where('status_usaha','aktif')->count(),
        ];

        return view('admin.koperasi.index', [
            'koperasi' => $koperasi,
            'stats'    => $stats,
            'distrik' => Koperasi::listDistrik(),
            'filters' => $request->only(['search', 'status_verifikasi', 'status_usaha', 'distrik', 'kategori']),
        ]);
    }

    public function create()
    {
        return view('admin.koperasi.create', ['distrik' => Koperasi::listDistrik()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|string|max:20|unique:koperasi,no_ktp',
            'nama_pemilik' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:100',
            'kategori' => 'required|in:mikro,kecil,menengah',
            'alamat' => 'required|string',
            'distrik' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omset_per_bulan' => 'nullable|numeric|min:0',
            'jumlah_karyawan' => 'nullable|integer|min:0',
        ]);

        $validated['no_registrasi'] = Koperasi::generateNoRegistrasi();
        $validated['status_verifikasi'] = 'pending';
        $validated['status_usaha'] = 'aktif';

        if ($request->hasFile('foto_usaha')) {
            $validated['foto_usaha'] = $request->file('foto_usaha')->store('koperasi', 'public');
        }

        $koperasi = Koperasi::create($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'Koperasi',
            'description' => 'Mendaftarkan Koperasi baru: ' . $koperasi->nama_usaha . ' (' . $koperasi->no_registrasi . ')',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.koperasi.show', $koperasi)
            ->with('success', 'Data Koperasi berhasil ditambahkan dengan nomor registrasi ' . $koperasi->no_registrasi);
    }

    public function show(Koperasi $koperasi)
    {
        $koperasi->load('user', 'verifiedBy', 'dokumen', 'penerimaBantuan.bantuan');
        return view('admin.koperasi.show', compact('koperasi'));
    }

    public function edit(Koperasi $koperasi)
    {
        return view('admin.koperasi.edit', [
            'koperasi' => $koperasi,
            'distrik' => Koperasi::listDistrik(),
        ]);
    }

    public function update(Request $request, Koperasi $koperasi)
    {
        $validated = $request->validate([
            'no_ktp' => ['required', 'string', 'max:20', Rule::unique('koperasi', 'no_ktp')->ignore($koperasi->id)],
            'nama_pemilik' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:100',
            'kategori' => 'required|in:mikro,kecil,menengah',
            'alamat' => 'required|string',
            'distrik' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omset_per_bulan' => 'nullable|numeric|min:0',
            'jumlah_karyawan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile("foto_usaha")) {
            if ($koperasi->foto_usaha) {
                \Storage::disk("public")->delete($koperasi->foto_usaha);
            }
            $validated["foto_usaha"] = $request->file("foto_usaha")->store("koperasi", "public");
        }
        $koperasi->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'Koperasi',
            'description' => 'Mengubah data Koperasi: ' . $koperasi->nama_usaha,
            'ip_address' => $request->ip(),
        ]);

        $redirectUrl = url()->previous();
        if (str_contains($redirectUrl, 'laporan')) {
            return redirect()->route('admin.laporan.koperasi')
                ->with('success', 'Data Koperasi berhasil dihapus.');
        }
        return redirect()->route('admin.koperasi.index')
            ->with('success', 'Data Koperasi berhasil diperbarui.');
    }

    public function destroy(Koperasi $koperasi)
    {
        // Hapus dokumen terkait dari storage
        foreach ($koperasi->dokumen as $dok) {
            Storage::disk('public')->delete($dok->path_file);
        }

        $nama = $koperasi->nama_usaha;
        $koperasi->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'Koperasi',
            'description' => 'Menghapus Koperasi: ' . $nama,
            'ip_address' => request()->ip(),
        ]);

        $redirectUrl = url()->previous();
        if (str_contains($redirectUrl, 'laporan')) {
            return redirect()->route('admin.laporan.koperasi')
                ->with('success', 'Data Koperasi berhasil dihapus.');
        }
        return redirect()->route('admin.koperasi.index')
            ->with('success', 'Data Koperasi berhasil dihapus.');
    }

    public function verifikasi(Request $request, Koperasi $koperasi)
    {
        $request->validate([
            'status' => 'required|in:diverifikasi,ditolak',
            'catatan' => 'nullable|string|max:500',
        ]);

        $fotoPath = $koperasi->foto_usaha;
        if ($request->hasFile('foto_usaha')) {
            if ($koperasi->foto_usaha) {
                \Storage::disk('public')->delete($koperasi->foto_usaha);
            }
            $fotoPath = $request->file('foto_usaha')->store('koperasi', 'public');
        }

        $koperasi->update([
            'status_verifikasi' => $request->status,
            'catatan_verifikasi' => $request->catatan,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        // Kirim notifikasi ke Koperasi jika punya akun
        if ($koperasi->user_id) {
            $pesan = $request->status === 'diverifikasi'
                ? 'Koperasi Anda (' . $koperasi->nama_usaha . ') telah berhasil diverifikasi.'
                : 'Verifikasi Koperasi Anda (' . $koperasi->nama_usaha . ') ditolak. Alasan: ' . ($request->catatan ?? '-');

            Notifikasi::create([
                'user_id' => $koperasi->user_id,
                'judul' => 'Status Verifikasi Koperasi',
                'pesan' => $pesan,
                'jenis' => $request->status === 'diverifikasi' ? 'success' : 'danger',
                'url' => route('koperasi.profile'),
            ]);
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'verify',
            'module' => 'Koperasi',
            'description' => 'Verifikasi Koperasi ' . $koperasi->nama_usaha . ' → ' . $request->status,
            'ip_address' => $request->ip(),
        ]);

        $msg = $request->status === 'diverifikasi'
            ? 'Koperasi berhasil diverifikasi.'
            : 'Koperasi ditolak.';

        return back()->with('success', $msg);
    }

    public function toggleStatus(Koperasi $koperasi)
    {
        $newStatus = $koperasi->status_usaha === 'aktif' ? 'tidak aktif' : 'aktif';
        $koperasi->update(['status_usaha' => $newStatus]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'toggle',
            'module' => 'Koperasi',
            'description' => 'Mengubah status usaha ' . $koperasi->nama_usaha . ' menjadi ' . $newStatus,
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Status usaha berhasil diubah menjadi ' . $newStatus . '.');
    }

    public function dokumen(Koperasi $koperasi)
    {
        $koperasi->load('dokumen');
        return view('admin.koperasi.dokumen', compact('koperasi'));
    }

    public function uploadDokumen(Request $request, Koperasi $koperasi)
    {
        $request->validate([
            'jenis_dokumen' => 'required|in:ktp,kk,foto_usaha,surat_izin,lainnya',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $file = $request->file('file');
        $jenis = $request->jenis_dokumen;
        $fileName = time() . '_' . $jenis . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs("uploads/{$jenis}", $fileName, 'public');

        $foto = null;
        if ($request->hasFile('foto_usaha')) {
            $foto = $request->file('foto_usaha')->store('koperasi', 'public');
        }

        DokumenKoperasi::create([
            'koperasi_id' => $koperasi->id,
            'jenis_dokumen' => $jenis,
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => $path,
            'ukuran_file' => $file->getSize(),
        ]);

        // Jika foto_usaha → update tabel koperasi
        if ($jenis === 'foto_usaha') {
            $koperasi->update(['foto_usaha' => $path]);
        }

        return back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function hapusDokumen(DokumenKoperasi $dokumen)
    {
        Storage::disk('public')->delete($dokumen->path_file);
        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
    
    public function downloadDokumen(Koperasi $koperasi) {
        $html = view('admin.koperasi.dokumen-word', compact('koperasi'))->render();
        
        $filename = 'Dokumen_Koperasi_' . str_replace(' ', '_', $koperasi->nama_usaha) . '_' . $koperasi->no_registrasi . '.doc';
        
        return response($html)
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment;filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
    }
    
    public function printDokumen(Koperasi $koperasi) {
        // Return HTML view for printing (not download)
        return view('admin.koperasi.dokumen-word', compact('koperasi'));
    }
    
    public function downloadKartu(Koperasi $koperasi) {
        $type = 'kartu';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.koperasi.kartu-sertifikat', compact('koperasi', 'type'));
        $pdf->setPaper([0, 0, 242.65, 153], 'landscape');
        
        $filename = 'Kartu_Koperasi_' . str_replace(' ', '_', $koperasi->nama_usaha) . '.pdf';
        return $pdf->download($filename);
    }
    
    public function downloadSertifikat(Koperasi $koperasi) {
        $type = 'sertifikat';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.koperasi.kartu-sertifikat', compact('koperasi', 'type'));
        $pdf->setPaper('a4', 'portrait'); // A4 Portrait untuk sertifikat 1 halaman
        
        $filename = 'Sertifikat_Koperasi_' . str_replace(' ', '_', $koperasi->nama_usaha) . '.pdf';
        return $pdf->download($filename);
    }

}
