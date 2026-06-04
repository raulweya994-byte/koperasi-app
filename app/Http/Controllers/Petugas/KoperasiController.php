<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Koperasi;
use Illuminate\Http\Request;
class KoperasiController extends Controller
{
    public function index(Request $request) {
        // Check permission
        if (!can_view('koperasi')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat data koperasi. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        // AJAX Check KTP
        if ($request->has('check_ktp')) {
            $noKtp = $request->input('check_ktp');
            $koperasi = Koperasi::where('no_ktp', $noKtp)->first();
            
            if ($koperasi) {
                return response()->json([
                    'exists' => true,
                    'nama' => $koperasi->nama_pemilik,
                    'usaha' => $koperasi->nama_usaha
                ]);
            }
            
            return response()->json(['exists' => false]);
        }
        
        $query = Koperasi::query();
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_usaha','like','%'.$request->search.'%')
                  ->orWhere('nama_pemilik','like','%'.$request->search.'%')
                  ->orWhere('no_registrasi','like','%'.$request->search.'%');
            });
        }
        if ($request->filled('status_verifikasi')) $query->where('status_verifikasi',$request->status_verifikasi);
        if ($request->filled('distrik')) $query->where('distrik',$request->distrik);
        
        $koperasi = $query->latest()->paginate(15)->appends($request->query());
        
        // Hitung statistik
        $stats = [
            'total' => Koperasi::count(),
            'verified' => Koperasi::where('status_verifikasi', 'diverifikasi')->count(),
            'pending' => Koperasi::where('status_verifikasi', 'pending')->count(),
            'rejected' => Koperasi::where('status_verifikasi', 'ditolak')->count(),
        ];
        
        // Daftar distrik
        $distrik = [
            'Karubaga', 'Bokondini', 'Tiom', 'Kembu', 'Bewani', 
            'Bokoneri', 'Geya', 'Nabunage', 'Kanggime', 'Wugi', 
            'Kagime', 'Lainnya'
        ];
        
        return view('petugas.koperasi.index', compact('koperasi', 'stats', 'distrik'));
    }
    public function show(Koperasi $koperasi) { 
        // Check permission
        if (!can_view('koperasi')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat detail koperasi.');
        }
        
        $koperasi->load('dokumen','penerimaBantuan.bantuan'); 
        return view('petugas.koperasi.show', compact('koperasi')); 
    }
    
    public function create() {
        // Check permission
        if (!can_create('koperasi')) {
            return redirect()->route('petugas.koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah koperasi. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        // Cek apakah ada periode pendaftaran yang aktif
        $periodeAktif = \App\Models\PeriodePendaftaranKoperasi::getPeriodeAktif();
        
        if (!$periodeAktif) {
            return redirect()->route('petugas.koperasi.index')
                ->with('error', 'Pendaftaran koperasi baru sedang ditutup. Silakan hubungi admin untuk membuka periode pendaftaran.');
        }
        
        if ($periodeAktif->isKuotaPenuh()) {
            return redirect()->route('petugas.koperasi.index')
                ->with('error', 'Kuota pendaftaran periode ini sudah penuh (' . $periodeAktif->kuota . ' koperasi).');
        }
        
        $distrik = \App\Models\Distrik::orderBy('nama')->get();
        $kelurahan = \App\Models\Kelurahan::orderBy('nama')->get();
        $kampung = \App\Models\Kampung::orderBy('nama')->get();

        return view('petugas.koperasi.create', [
            'distrik' => $distrik,
            'kelurahan' => $kelurahan,
            'kampung' => $kampung,
            'periodeAktif' => $periodeAktif
        ]);
    }
    public function store(Request $request) {
        // Check permission
        if (!can_create('koperasi')) {
            return redirect()->route('petugas.koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah koperasi.');
        }
        
        // Cek periode pendaftaran
        $periodeAktif = \App\Models\PeriodePendaftaranKoperasi::getPeriodeAktif();
        
        if (!$periodeAktif) {
            return back()->with('error', 'Pendaftaran koperasi baru sedang ditutup.')
                ->withInput();
        }
        
        if ($periodeAktif->isKuotaPenuh()) {
            return back()->with('error', 'Kuota pendaftaran periode ini sudah penuh.')
                ->withInput();
        }
        
        // Validasi dengan pesan error yang jelas
        $validated = $request->validate([
            'no_ktp' => 'required|string|max:20|unique:koperasi,no_ktp',
            'nama_pemilik' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'kategori' => 'required|in:mikro,kecil,menengah',
            'alamat' => 'required|string',
            'distrik' => 'required|string',
            'kelurahan' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omset_per_bulan' => 'nullable|numeric|min:0',
            'jumlah_karyawan' => 'nullable|integer|min:0',
        ], [
            'no_ktp.unique' => 'Nomor KTP ini sudah terdaftar. Silakan gunakan nomor KTP yang berbeda.',
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'nama_usaha.required' => 'Nama usaha wajib diisi.',
            'jenis_usaha.required' => 'Jenis usaha wajib dipilih.',
            'kategori.required' => 'Kategori usaha wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'distrik.required' => 'Distrik wajib dipilih.',
            'kelurahan.required' => 'Kelurahan/Kampung wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);
        
        try {
            // Filter nilai null/empty untuk field optional
            $validated['no_telp'] = !empty($validated['no_telp']) && $validated['no_telp'] !== 'null' ? $validated['no_telp'] : null;
            $validated['email'] = !empty($validated['email']) && $validated['email'] !== 'null' ? $validated['email'] : null;
            $validated['modal_usaha'] = !empty($validated['modal_usaha']) ? $validated['modal_usaha'] : 0;
            $validated['omset_per_bulan'] = !empty($validated['omset_per_bulan']) ? $validated['omset_per_bulan'] : 0;
            $validated['jumlah_karyawan'] = !empty($validated['jumlah_karyawan']) ? $validated['jumlah_karyawan'] : 0;
            
            // Generate nomor registrasi yang unik dengan retry mechanism
            $maxAttempts = 10;
            $attempt = 0;
            $noRegistrasi = null;
            
            do {
                $noRegistrasi = Koperasi::generateNoRegistrasi();
                $exists = Koperasi::where('no_registrasi', $noRegistrasi)->exists();
                $attempt++;
            } while ($exists && $attempt < $maxAttempts);
            
            if ($exists) {
                return back()->with('error', 'Gagal generate nomor registrasi. Silakan coba lagi.')
                    ->withInput();
            }
            
            // Buat data koperasi
            $koperasi = Koperasi::create(array_merge($validated, [
                'no_registrasi' => $noRegistrasi,
                'periode_pendaftaran_koperasi_id' => $periodeAktif->id,
                'status_verifikasi' => 'pending',
                'status_usaha' => 'aktif',
            ]));
            
            // Log aktivitas
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'module' => 'KOPERASI',
                'description' => 'Mendaftarkan koperasi baru: ' . $koperasi->nama_usaha . ' (' . $noRegistrasi . ') pada periode ' . $periodeAktif->nama_periode,
                'ip_address' => $request->ip(),
            ]);
            
            return redirect()->route('petugas.koperasi.show', $koperasi)
                ->with('success', 'Data koperasi berhasil didaftarkan dengan nomor registrasi: ' . $noRegistrasi);
                
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangani error database
            if ($e->getCode() == 23000) {
                // Integrity constraint violation
                if (strpos($e->getMessage(), 'no_ktp') !== false) {
                    return back()->with('error', 'Nomor KTP sudah terdaftar. Silakan gunakan nomor KTP yang berbeda.')
                        ->withInput();
                } elseif (strpos($e->getMessage(), 'no_registrasi') !== false) {
                    return back()->with('error', 'Nomor registrasi sudah ada. Silakan coba lagi.')
                        ->withInput();
                } else {
                    return back()->with('error', 'Data yang Anda masukkan sudah terdaftar. Silakan periksa kembali.')
                        ->withInput();
                }
            }
            
            // Error lainnya
            \Log::error('Error saat menyimpan koperasi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                ->withInput();
                
        } catch (\Exception $e) {
            // Tangani error umum
            \Log::error('Error umum saat menyimpan koperasi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan hubungi administrator.')
                ->withInput();
        }
    }
    public function edit(Koperasi $koperasi) { 
        // Check permission
        if (!can_edit('koperasi')) {
            return redirect()->route('petugas.koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah data koperasi. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        $distrik = \App\Models\Distrik::orderBy('nama')->get();
        $kelurahan = \App\Models\Kelurahan::orderBy('nama')->get();
        $kampung = \App\Models\Kampung::orderBy('nama')->get();
        return view('petugas.koperasi.edit', [
            'koperasi' => $koperasi,
            'distrik' => $distrik,
            'kelurahan' => $kelurahan,
            'kampung' => $kampung
        ]);
    }
    
    public function update(Request $request, Koperasi $koperasi) {
        // Check permission
        if (!can_edit('koperasi')) {
            return redirect()->route('petugas.koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah data koperasi.');
        }
        
        $koperasi->update($request->only(['nama_pemilik','nama_usaha','jenis_usaha','kategori','alamat','distrik','kelurahan','no_telp','email','modal_usaha','omset_per_bulan','jumlah_karyawan']));
        return redirect()->route('petugas.koperasi.show',$koperasi)->with('success','Data berhasil diperbarui.');
    }
    
    public function destroy(Koperasi $koperasi) { 
        // Check permission
        if (!can_delete('koperasi')) {
            return redirect()->route('petugas.koperasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus koperasi. Hubungi Administrator untuk mendapatkan akses.');
        }
        
        $koperasi->delete(); 
        return redirect()->route('petugas.koperasi.index')->with('success','Data dihapus.'); 
    }
    public function verifikasi(Request $request, Koperasi $koperasi) {
        $request->validate(['status_verifikasi'=>'required|in:diverifikasi,ditolak']);
        $koperasi->update(['status_verifikasi'=>$request->status_verifikasi,'catatan_verifikasi'=>$request->catatan_verifikasi,'verified_by'=>auth()->id(),'verified_at'=>now()]);
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'update','module'=>'KOPERASI','description'=>'Verifikasi KOPERASI: '.$koperasi->no_registrasi,'ip_address'=>$request->ip()]);
        return back()->with('success','Status verifikasi berhasil diperbarui.');
    }
    public function toggleStatus(Koperasi $koperasi) { $koperasi->update(['status_usaha'=>$koperasi->status_usaha==='aktif'?'tidak aktif':'aktif']); return back()->with('success','Status diperbarui.'); }
    public function uploadDokumen(Request $request, Koperasi $koperasi) {
        $request->validate(['file'=>'required|file|mimes:pdf,jpg,jpeg,png|max:2048','jenis_dokumen'=>'required']);
        $path = $request->file('file')->store('dokumen','public');
        $koperasi->dokumen()->create(['jenis_dokumen'=>$request->jenis_dokumen,'file_path'=>$path,'uploaded_by'=>auth()->id()]);
        return back()->with('success','Dokumen berhasil diupload.');
    }
    
    // Kartu & Sertifikat Methods
    public function downloadKartu(Koperasi $koperasi) {
        $type = 'kartu';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('petugas.koperasi.kartu-sertifikat', compact('koperasi', 'type'));
        $pdf->setPaper([0, 0, 242.65, 153], 'landscape');
        
        $filename = 'Kartu_Koperasi_' . str_replace(' ', '_', $koperasi->nama_usaha) . '.pdf';
        return $pdf->download($filename);
    }
    
    public function downloadSertifikat(Koperasi $koperasi) {
        $type = 'sertifikat';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('petugas.koperasi.kartu-sertifikat', compact('koperasi', 'type'));
        $pdf->setPaper('a4', 'portrait'); // A4 Portrait untuk sertifikat 1 halaman
        
        $filename = 'Sertifikat_Koperasi_' . str_replace(' ', '_', $koperasi->nama_usaha) . '.pdf';
        return $pdf->download($filename);
    }
    
    public function downloadDokumen(Koperasi $koperasi) {
        $html = view('petugas.koperasi.dokumen-word', compact('koperasi'))->render();
        
        $filename = 'Dokumen_Koperasi_' . str_replace(' ', '_', $koperasi->nama_usaha) . '_' . $koperasi->no_registrasi . '.doc';
        
        return response($html)
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment;filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
    }
    
    public function printDokumen(Koperasi $koperasi) {
        // Return HTML view for printing (not download)
        return view('petugas.koperasi.dokumen-word', compact('koperasi'));
    }
}
