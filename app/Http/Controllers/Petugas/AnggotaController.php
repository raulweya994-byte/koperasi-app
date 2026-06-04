<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Koperasi;
use App\Models\PeriodePendaftaran;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        if (!can_view('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat data anggota');
        }
        
        $query = Anggota::with(['koperasi', 'periodePendaftaran']);
        
        // Filter
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('no_ktp', 'like', '%' . $request->search . '%')
                  ->orWhere('no_anggota', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('distrik')) {
            $query->where('distrik', $request->distrik);
        }
        
        if ($request->filled('koperasi_id')) {
            $query->where('koperasi_id', $request->koperasi_id);
        }
        
        $anggota = $query->latest()->paginate(15)->appends($request->query());
        $koperasi = Koperasi::where('status_verifikasi', 'diverifikasi')->get();
        
        // Hitung statistik
        $stats = [
            'total' => Anggota::count(),
            'aktif' => Anggota::where('status', 'Aktif')->count(),
            'nonaktif' => Anggota::where('status', 'Nonaktif')->count(),
            'pending' => Anggota::where('status', 'Pending')->count(),
            'ditolak' => Anggota::where('status', 'Ditolak')->count(),
        ];
        
        // Daftar distrik
        $distrik = [
            'Karubaga', 'Bokondini', 'Tiom', 'Kembu', 'Bewani', 
            'Bokoneri', 'Geya', 'Nabunage', 'Kanggime', 'Wugi', 
            'Kagime', 'Lainnya'
        ];
        
        return view('petugas.anggota.index', compact('anggota', 'koperasi', 'stats', 'distrik'));
    }

    public function create()
    {
        if (!can_create('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk menambah data anggota');
        }
        
        // Cek apakah ada periode pendaftaran yang aktif
        $periodeAktif = PeriodePendaftaran::getPeriodeAktif();
        
        if (!$periodeAktif) {
            // Jika tidak ada periode aktif, tampilkan halaman khusus
            return view('petugas.anggota.pendaftaran-ditutup');
        }
        
        if ($periodeAktif->isKuotaPenuh()) {
            // Jika kuota penuh, tampilkan halaman khusus
            return view('petugas.anggota.kuota-penuh', compact('periodeAktif'));
        }
        
        // Ambil koperasi yang sudah diverifikasi
        $koperasi = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        return view('petugas.anggota.create', [
            'koperasi' => $koperasi,
            'periodeAktif' => $periodeAktif
        ]);
    }

    public function store(Request $request)
    {
        if (!can_create('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk menambah data anggota');
        }
        
        // Cek periode pendaftaran
        $periodeAktif = PeriodePendaftaran::getPeriodeAktif();
        
        if (!$periodeAktif) {
            return back()->with('error', 'Pendaftaran anggota baru sedang ditutup.')
                ->withInput();
        }
        
        if ($periodeAktif->isKuotaPenuh()) {
            return back()->with('error', 'Kuota pendaftaran periode ini sudah penuh.')
                ->withInput();
        }
        
        $validated = $request->validate([
            'koperasi_id' => 'required|exists:koperasi,id',
            'nik' => 'required|string|size:16|unique:anggotas,nik',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'required|in:Lajang,Menikah,Cerai',
            'pendidikan_terakhir' => 'required|string',
            'agama' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'desa' => 'nullable|string|max:255',
            'distrik' => 'required|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'nama_komplek_dekat_desa' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'nama_ibu_kandung' => 'nullable|string|max:255',
            'simpanan_pokok' => 'nullable|numeric|min:0',
            'simpanan_wajib' => 'nullable|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        
        // Buat user account terlebih dahulu
        $user = \App\Models\User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'anggota',
            'is_active' => true,
            'phone' => $validated['no_hp'],
        ]);
        
        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggota/foto', 'public');
        }
        
        // Generate nomor anggota
        $noAnggota = Anggota::generateNoAnggota();
        
        // Buat data anggota dengan user_id
        $anggota = Anggota::create(array_merge($validated, [
            'user_id' => $user->id,
            'no_anggota' => $noAnggota,
            'periode_pendaftaran_id' => $periodeAktif->id,
            'tanggal_bergabung' => now(),
            'status' => 'Pending',
            'created_by' => auth()->id(),
        ]));
        
        // Log aktivitas
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'ANGGOTA',
            'description' => 'Mendaftarkan anggota baru: ' . $anggota->nama . ' (' . $noAnggota . ') dengan akun user: ' . $user->email,
            'ip_address' => $request->ip(),
        ]);
        
        return redirect()->route('petugas.anggota.index')
            ->with('success', 'Anggota koperasi berhasil didaftarkan dengan nomor: ' . $noAnggota . '. Akun login telah dibuat dengan email: ' . $user->email);
    }

    public function show(Anggota $anggota)
    {
        if (!can_view('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat detail anggota');
        }
        
        $anggota->load(['koperasi', 'periodePendaftaran', 'createdBy']);
        return view('petugas.anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        if (!can_edit('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit data anggota');
        }
        
        $koperasi = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        return view('petugas.anggota.edit', compact('anggota', 'koperasi'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        if (!can_edit('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk mengupdate data anggota');
        }
        
        $validated = $request->validate([
            'koperasi_id' => 'required|exists:koperasi,id',
            'nik' => 'required|string|size:16|unique:anggotas,nik,' . $anggota->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'required|in:Lajang,Menikah,Cerai',
            'pendidikan_terakhir' => 'required|string|max:255',
            'agama' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'desa' => 'nullable|string|max:255',
            'distrik' => 'required|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'nama_komplek_dekat_desa' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'nama_usaha' => 'nullable|string|max:255',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omzet_per_bulan' => 'nullable|numeric|min:0',
            'keterangan_usaha' => 'nullable|string',
            'nama_ibu_kandung' => 'nullable|string|max:255',
            'simpanan_pokok' => 'nullable|numeric|min:0',
            'simpanan_wajib' => 'nullable|numeric|min:0',
            'total_simpanan' => 'nullable|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|in:Aktif,Pending,Nonaktif,Ditolak',
        ]);
        
        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $validated['foto'] = $request->file('foto')->store('anggota/foto', 'public');
        }
        
        // Update data anggota
        $anggota->update($validated);
        
        // Update email user jika ada perubahan
        if ($anggota->user_id && $request->filled('email')) {
            $user = \App\Models\User::find($anggota->user_id);
            if ($user && $user->email !== $request->email) {
                $user->update([
                    'email' => $request->email,
                    'name' => $validated['nama'],
                    'phone' => $validated['no_hp'],
                ]);
            }
        }
        
        // Log aktivitas
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'ANGGOTA',
            'description' => 'Mengupdate data anggota: ' . $anggota->nama . ' (' . $anggota->no_anggota . ')',
            'ip_address' => $request->ip(),
        ]);
        
        return redirect()->route('petugas.anggota.index')
            ->with('success', 'Data anggota berhasil diupdate');
    }

    public function destroy(Anggota $anggota)
    {
        if (!can_delete('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus data anggota');
        }
        
        // Hapus foto jika ada
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        
        // Hapus user account jika ada
        if ($anggota->user_id) {
            \App\Models\User::find($anggota->user_id)->delete();
        }
        
        // Log aktivitas
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'ANGGOTA',
            'description' => 'Menghapus anggota: ' . $anggota->nama . ' (' . $anggota->no_anggota . ')',
            'ip_address' => request()->ip(),
        ]);
        
        $anggota->delete();
        
        return redirect()->route('petugas.anggota.index')
            ->with('success', 'Data anggota berhasil dihapus');
    }
    
    // Kartu & Sertifikat Methods
    public function kartuSertifikatList(Request $request) {
        if (!can_view('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat kartu & sertifikat');
        }
        
        try {
            // Query anggota
            $qAnggota = Anggota::with('koperasi');
            if ($request->search_anggota) {
                $qAnggota->where(function($query) use ($request) {
                    $query->where('nama','like',"%{$request->search_anggota}%")
                          ->orWhere('no_anggota','like',"%{$request->search_anggota}%");
                });
            }
            $anggota = $qAnggota->orderBy('created_at','desc')->paginate(12)->withQueryString();
            
            // Query koperasi
            $qKoperasi = \App\Models\Koperasi::query();
            if ($request->search_koperasi) {
                $qKoperasi->where(function($query) use ($request) {
                    $query->where('nama_usaha','like',"%{$request->search_koperasi}%")
                          ->orWhere('no_registrasi','like',"%{$request->search_koperasi}%");
                });
            }
            $koperasi = $qKoperasi->orderBy('created_at','desc')->paginate(12)->withQueryString();
            
            return view('petugas.anggota.kartu-sertifikat-list', compact('anggota', 'koperasi'));
        } catch (\Exception $e) {
            \Log::error('Error in kartuSertifikatList: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function downloadKartu(Anggota $anggota) {
        if (!can_view('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk download kartu');
        }
        
        $type = 'kartu';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('petugas.anggota.kartu-sertifikat', compact('anggota', 'type'));
        $pdf->setPaper([0, 0, 242.65, 153], 'landscape'); // 85.6mm x 53.98mm in points
        
        $filename = 'Kartu_Anggota_' . str_replace(' ', '_', $anggota->nama) . '.pdf';
        return $pdf->download($filename);
    }
    
    public function downloadSertifikat(Anggota $anggota) {
        if (!can_view('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk download sertifikat');
        }
        
        $type = 'sertifikat';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('petugas.anggota.kartu-sertifikat', compact('anggota', 'type'));
        $pdf->setPaper('a4', 'portrait'); // A4 Portrait untuk sertifikat 1 halaman
        
        $filename = 'Sertifikat_' . str_replace(' ', '_', $anggota->nama) . '.pdf';
        return $pdf->download($filename);
    }
    
    public function downloadDokumen(Anggota $anggota) {
        if (!can_view('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk download dokumen');
        }
        
        // Generate HTML content
        $html = view('petugas.anggota.dokumen-word', compact('anggota'))->render();
        
        // Set headers for Word download
        $filename = 'Dokumen_Anggota_' . str_replace(' ', '_', $anggota->nama) . '_' . $anggota->no_anggota . '.doc';
        
        return response($html)
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment;filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
    }
    
    public function printDokumen(Anggota $anggota) {
        if (!can_view('anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk print dokumen');
        }
        
        // Return HTML view for printing (not download)
        return view('petugas.anggota.dokumen-word', compact('anggota'));
    }
}
