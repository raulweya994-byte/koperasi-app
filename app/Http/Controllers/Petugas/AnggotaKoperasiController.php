<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Koperasi;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AnggotaKoperasiController extends Controller
{
    public function index(Request $request)
    {
        // Check permission
        if (!can_view('anggota')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat data anggota. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        $query = Anggota::with(['koperasi', 'user']);
        
        // Filter pencarian
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('no_anggota', 'like', '%' . $request->search . '%')
                  ->orWhere('no_hp', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter berdasarkan koperasi
        if ($request->filled('koperasi_id')) {
            $query->where('koperasi_id', $request->koperasi_id);
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan distrik
        if ($request->filled('distrik')) {
            $query->where('distrik', $request->distrik);
        }
        
        // Filter berdasarkan jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        
        $anggotaKoperasi = $query->latest()->paginate(20)->appends($request->query());
        
        // Statistik
        $stats = [
            'total' => Anggota::count(),
            'aktif' => Anggota::where('status', 'Aktif')->count(),
            'pending' => Anggota::where('status', 'Pending')->count(),
            'nonaktif' => Anggota::where('status', 'Nonaktif')->count(),
            'laki_laki' => Anggota::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Anggota::where('jenis_kelamin', 'P')->count(),
            'total_koperasi' => Koperasi::count(),
            'total_simpanan' => Anggota::sum('total_simpanan'),
            'total_modal' => Koperasi::sum('modal_usaha'),
        ];
        
        // Daftar koperasi untuk filter
        $koperasiList = Koperasi::select('id', 'nama_usaha', 'no_registrasi')
            ->orderBy('nama_usaha')
            ->get();
        
        // Daftar distrik
        $distrikList = Anggota::select('distrik')
            ->distinct()
            ->whereNotNull('distrik')
            ->orderBy('distrik')
            ->pluck('distrik')
            ->toArray();
        
        return view('petugas.anggota-koperasi.index', compact(
            'anggotaKoperasi',
            'stats',
            'koperasiList',
            'distrikList'
        ));
    }
    
    public function show(Anggota $anggotaKoperasi)
    {
        // Check permission
        if (!can_view('anggota')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat detail anggota.');
        }
        
        $anggotaKoperasi->load(['koperasi', 'user', 'simpanans', 'periodePendaftaran']);
        
        return view('petugas.anggota-koperasi.show', compact('anggotaKoperasi'));
    }
    
    public function create()
    {
        // Check permission
        if (!can_create('anggota')) {
            return redirect()->route('petugas.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah anggota. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        // Daftar koperasi aktif
        $koperasiList = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        $distrikList = Koperasi::listDistrik();
        
        return view('petugas.anggota-koperasi.create', compact('koperasiList', 'distrikList'));
    }
    
    public function store(Request $request)
    {
        // Check permission
        if (!can_create('anggota')) {
            return redirect()->route('petugas.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah anggota.');
        }
        
        $validated = $request->validate([
            'koperasi_id' => 'required|exists:koperasi,id',
            'nik' => 'required|string|max:20|unique:anggotas,nik',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string|max:50',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'required|string',
            'desa' => 'nullable|string|max:255',
            'distrik' => 'required|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:50',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'nama_usaha' => 'nullable|string|max:255',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omzet_per_bulan' => 'nullable|numeric|min:0',
            'bidang_usaha' => 'nullable|string|max:255',
            'simpanan_pokok' => 'nullable|numeric|min:0',
            'simpanan_wajib' => 'nullable|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        
        // Generate nomor anggota
        $validated['no_anggota'] = Anggota::generateNoAnggota();
        $validated['status'] = 'Aktif';
        $validated['status_verifikasi'] = 'diverifikasi';
        $validated['created_by'] = auth()->id();
        $validated['tanggal_bergabung'] = now();
        
        // Upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggota', 'public');
        }
        
        if ($request->hasFile('foto_ktp')) {
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('anggota/ktp', 'public');
        }
        
        // Hitung total simpanan
        $validated['total_simpanan'] = ($validated['simpanan_pokok'] ?? 0) + ($validated['simpanan_wajib'] ?? 0);
        
        $anggota = Anggota::create($validated);
        
        // Log aktivitas
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'ANGGOTA_KOPERASI',
            'description' => 'Menambahkan anggota koperasi baru: ' . $anggota->nama . ' (' . $anggota->no_anggota . ')',
            'ip_address' => $request->ip(),
        ]);
        
        return redirect()->route('petugas.anggota-koperasi.show', $anggota)
            ->with('success', 'Data anggota koperasi berhasil ditambahkan dengan nomor: ' . $anggota->no_anggota);
    }
    
    public function edit(Anggota $anggotaKoperasi)
    {
        // Check permission
        if (!can_edit('anggota')) {
            return redirect()->route('petugas.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah data anggota. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        $koperasiList = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        $distrikList = Koperasi::listDistrik();
        
        return view('petugas.anggota-koperasi.edit', compact('anggotaKoperasi', 'koperasiList', 'distrikList'));
    }
    
    public function update(Request $request, Anggota $anggotaKoperasi)
    {
        // Check permission
        if (!can_edit('anggota')) {
            return redirect()->route('petugas.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah data anggota.');
        }
        
        $validated = $request->validate([
            'koperasi_id' => 'required|exists:koperasi,id',
            'nik' => 'required|string|max:20|unique:anggotas,nik,' . $anggotaKoperasi->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string|max:50',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'required|string',
            'desa' => 'nullable|string|max:255',
            'distrik' => 'required|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:50',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'nama_usaha' => 'nullable|string|max:255',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omzet_per_bulan' => 'nullable|numeric|min:0',
            'bidang_usaha' => 'nullable|string|max:255',
            'simpanan_pokok' => 'nullable|numeric|min:0',
            'simpanan_wajib' => 'nullable|numeric|min:0',
            'status' => 'required|in:Aktif,Pending,Nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        
        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($anggotaKoperasi->foto && \Storage::disk('public')->exists($anggotaKoperasi->foto)) {
                \Storage::disk('public')->delete($anggotaKoperasi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('anggota', 'public');
        }
        
        if ($request->hasFile('foto_ktp')) {
            // Hapus foto KTP lama
            if ($anggotaKoperasi->foto_ktp && \Storage::disk('public')->exists($anggotaKoperasi->foto_ktp)) {
                \Storage::disk('public')->delete($anggotaKoperasi->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('anggota/ktp', 'public');
        }
        
        // Hitung total simpanan
        $validated['total_simpanan'] = ($validated['simpanan_pokok'] ?? 0) + ($validated['simpanan_wajib'] ?? 0);
        
        $anggotaKoperasi->update($validated);
        
        // Log aktivitas
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'ANGGOTA_KOPERASI',
            'description' => 'Memperbarui data anggota koperasi: ' . $anggotaKoperasi->nama . ' (' . $anggotaKoperasi->no_anggota . ')',
            'ip_address' => $request->ip(),
        ]);
        
        return redirect()->route('petugas.anggota-koperasi.show', $anggotaKoperasi)
            ->with('success', 'Data anggota koperasi berhasil diperbarui.');
    }
    
    public function destroy(Anggota $anggotaKoperasi)
    {
        // Check permission
        if (!can_delete('anggota')) {
            return redirect()->route('petugas.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus anggota. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        $nama = $anggotaKoperasi->nama;
        $noAnggota = $anggotaKoperasi->no_anggota;
        
        // Hapus foto jika ada
        if ($anggotaKoperasi->foto && \Storage::disk('public')->exists($anggotaKoperasi->foto)) {
            \Storage::disk('public')->delete($anggotaKoperasi->foto);
        }
        
        if ($anggotaKoperasi->foto_ktp && \Storage::disk('public')->exists($anggotaKoperasi->foto_ktp)) {
            \Storage::disk('public')->delete($anggotaKoperasi->foto_ktp);
        }
        
        $anggotaKoperasi->delete();
        
        // Log aktivitas
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'ANGGOTA_KOPERASI',
            'description' => 'Menghapus anggota koperasi: ' . $nama . ' (' . $noAnggota . ')',
            'ip_address' => request()->ip(),
        ]);
        
        return redirect()->route('petugas.anggota-koperasi.index')
            ->with('success', 'Data anggota koperasi berhasil dihapus.');
    }
}
