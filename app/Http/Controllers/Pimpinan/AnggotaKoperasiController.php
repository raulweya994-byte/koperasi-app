<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Koperasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaKoperasiController extends Controller
{
    public function index(Request $request)
    {
        // Check permission - use 'anggota' module
        if (!can_view('anggota')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Data Anggota Koperasi. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        $query = Anggota::with(['koperasi', 'user']);
        
        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('no_anggota', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan distrik
        if ($request->filled('distrik')) {
            $query->where('distrik', $request->distrik);
        }
        
        // Filter berdasarkan koperasi
        if ($request->filled('koperasi_id')) {
            $query->where('koperasi_id', $request->koperasi_id);
        }
        
        $anggota = $query->latest()->paginate(20);
        
        // Stats
        $stats = [
            'total' => Anggota::count(),
            'aktif' => Anggota::where('status', 'Aktif')->count(),
            'nonaktif' => Anggota::where('status', 'Nonaktif')->count(),
            'pending' => Anggota::where('status', 'Pending')->count(),
        ];
        
        // List untuk filter
        $distrikList = ['Karubaga', 'Bokondini', 'Kanggime', 'Kembu', 'Kondaga', 'Wunim', 'Wari', 'Wina', 'Wugi', 'Wulik', 'Dow', 'Dundu', 'Egiam', 'Gearek', 'Geya', 'Gilubandu', 'Goyage', 'Gundagi', 'Kai', 'Kamboneri', 'Kuari', 'Kubu', 'Kumbiagama', 'Kumo', 'Nabunage', 'Nelawi', 'Numba', 'Nunggawi', 'Panaga', 'Poganeri', 'Tagime', 'Tagineri', 'Telenggeme', 'Timori', 'Umagi', 'Wakuwo', 'Wenam', 'Wollo', 'Yuko', 'Yuneri'];
        
        $koperasiList = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        return view('pimpinan.anggota-koperasi.index', compact('anggota', 'stats', 'distrikList', 'koperasiList'));
    }
    
    public function show($id)
    {
        // Check permission - use 'anggota' module
        if (!can_view('anggota')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat detail Anggota Koperasi.');
        }
        
        $anggota = Anggota::with(['koperasi', 'user'])->findOrFail($id);
        
        return view('pimpinan.anggota-koperasi.show', compact('anggota'));
    }
    
    public function create()
    {
        // Check permission
        if (!can_create('anggota')) {
            return redirect()->route('pimpinan.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah Anggota Koperasi. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        // Cek apakah ada periode pendaftaran yang aktif
        $periodeAktif = \App\Models\PeriodePendaftaran::getPeriodeAktif();
        
        if (!$periodeAktif) {
            // Jika tidak ada periode aktif, tampilkan halaman khusus
            return view('pimpinan.anggota-koperasi.pendaftaran-ditutup');
        }
        
        if ($periodeAktif->isKuotaPenuh()) {
            // Jika kuota penuh, tampilkan halaman khusus
            return view('pimpinan.anggota-koperasi.kuota-penuh', compact('periodeAktif'));
        }
        
        $koperasiList = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        $distrikList = ['Karubaga', 'Bokondini', 'Kanggime', 'Kembu', 'Kondaga', 'Wunim', 'Wari', 'Wina', 'Wugi', 'Wulik', 'Dow', 'Dundu', 'Egiam', 'Gearek', 'Geya', 'Gilubandu', 'Goyage', 'Gundagi', 'Kai', 'Kamboneri', 'Kuari', 'Kubu', 'Kumbiagama', 'Kumo', 'Nabunage', 'Nelawi', 'Numba', 'Nunggawi', 'Panaga', 'Poganeri', 'Tagime', 'Tagineri', 'Telenggeme', 'Timori', 'Umagi', 'Wakuwo', 'Wenam', 'Wollo', 'Yuko', 'Yuneri'];
        
        return view('pimpinan.anggota-koperasi.create', compact('koperasiList', 'distrikList', 'periodeAktif'));
    }
    
    public function store(Request $request)
    {
        // Check permission
        if (!can_create('anggota')) {
            return redirect()->route('pimpinan.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah Anggota Koperasi.');
        }
        
        // Cek periode pendaftaran
        $periodeAktif = \App\Models\PeriodePendaftaran::getPeriodeAktif();
        
        if (!$periodeAktif) {
            return back()->with('error', 'Pendaftaran anggota baru sedang ditutup.')
                ->withInput();
        }
        
        if ($periodeAktif->isKuotaPenuh()) {
            return back()->with('error', 'Kuota pendaftaran periode ini sudah penuh.')
                ->withInput();
        }
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:anggotas,nik',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'agama' => 'nullable|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'distrik' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'koperasi_id' => 'nullable|exists:koperasis,id',
            'nama_usaha' => 'nullable|string|max:255',
            'bidang_usaha' => 'nullable|string|max:255',
            'simpanan_pokok' => 'nullable|numeric|min:0',
            'simpanan_wajib' => 'nullable|numeric|min:0',
            'status' => 'required|in:Aktif,Pending,Nonaktif',
            'tanggal_bergabung' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Generate no_anggota
        $validated['no_anggota'] = Anggota::generateNoAnggota();
        $validated['created_by'] = auth()->id();
        $validated['periode_pendaftaran_id'] = $periodeAktif->id;
        
        // Handle foto upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggota', 'public');
        }
        
        Anggota::create($validated);
        
        // Update jumlah pendaftar
        $periodeAktif->increment('jumlah_pendaftar');
        
        return redirect()->route('pimpinan.anggota-koperasi.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        // Check permission
        if (!can_edit('anggota')) {
            return redirect()->route('pimpinan.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit Anggota Koperasi. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        $anggota = Anggota::findOrFail($id);
        
        $koperasiList = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        $distrikList = ['Karubaga', 'Bokondini', 'Kanggime', 'Kembu', 'Kondaga', 'Wunim', 'Wari', 'Wina', 'Wugi', 'Wulik', 'Dow', 'Dundu', 'Egiam', 'Gearek', 'Geya', 'Gilubandu', 'Goyage', 'Gundagi', 'Kai', 'Kamboneri', 'Kuari', 'Kubu', 'Kumbiagama', 'Kumo', 'Nabunage', 'Nelawi', 'Numba', 'Nunggawi', 'Panaga', 'Poganeri', 'Tagime', 'Tagineri', 'Telenggeme', 'Timori', 'Umagi', 'Wakuwo', 'Wenam', 'Wollo', 'Yuko', 'Yuneri'];
        
        return view('pimpinan.anggota-koperasi.edit', compact('anggota', 'koperasiList', 'distrikList'));
    }
    
    public function update(Request $request, $id)
    {
        // Check permission
        if (!can_edit('anggota')) {
            return redirect()->route('pimpinan.anggota-koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit Anggota Koperasi.');
        }
        
        $anggota = Anggota::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:anggotas,nik,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'agama' => 'nullable|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'distrik' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'koperasi_id' => 'nullable|exists:koperasis,id',
            'nama_usaha' => 'nullable|string|max:255',
            'bidang_usaha' => 'nullable|string|max:255',
            'simpanan_pokok' => 'nullable|numeric|min:0',
            'simpanan_wajib' => 'nullable|numeric|min:0',
            'status' => 'required|in:Aktif,Pending,Nonaktif',
            'tanggal_bergabung' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $validated['foto'] = $request->file('foto')->store('anggota', 'public');
        }
        
        $anggota->update($validated);
        
        return redirect()->route('pimpinan.anggota-koperasi.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        // Check permission
        if (!can_delete('anggota')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus Anggota Koperasi.'
            ], 403);
        }
        
        try {
            $anggota = Anggota::findOrFail($id);
            
            // Delete foto if exists
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            
            $anggota->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
