<?php
namespace App\Http\Controllers\Pimpinan;
use App\Http\Controllers\Controller;
use App\Models\Bantuan;
use App\Models\PenerimaBantuan;
use App\Models\Koperasi;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index() {
        // Dashboard should be accessible by default for Pimpinan
        // No permission check needed for dashboard view
        
        $totalKoperasi = Koperasi::count();
        $koperasiVerified = Koperasi::where('status_verifikasi','diverifikasi')->count();
        
        // Hitung bantuan aktif - SAMA SEPERTI ADMIN (program bantuan yang aktif)
        $bantuanAktif = Bantuan::where('status', 'aktif')->count();
        
        // Debug: Cek semua data bantuan
        $totalBantuan = Bantuan::count();
        $bantuanNonAktif = Bantuan::where('status', '!=', 'aktif')->count();
        
        // Log untuk debugging
        \Log::info('Dashboard Pimpinan - Bantuan Stats:', [
            'total_program_bantuan' => $totalBantuan,
            'program_aktif' => $bantuanAktif,
            'program_non_aktif' => $bantuanNonAktif
        ]);
        
        // Stats untuk 4 cards
        $stats = [
            'total_koperasi' => $totalKoperasi,
            'koperasi_verified' => $koperasiVerified,
            'pending_verifikasi' => $totalKoperasi - $koperasiVerified,
            'total_anggota' => \App\Models\Anggota::count(),
            'total_laporan' => ActivityLog::count(),
            'total_bantuan' => Bantuan::count(),
            'penerima_bantuan' => $bantuanAktif  // Program bantuan aktif (sama seperti Admin)
        ];
        
        // Data untuk charts
        $koperasiPerKategori = Koperasi::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->get();
            
        $koperasiPerDistrik = Koperasi::selectRaw('distrik, COUNT(*) as total')
            ->groupBy('distrik')
            ->orderByDesc('total')
            ->take(10)
            ->get();
        
        // Data untuk progress bars (real dari database)
        $totalKoperasiCount = Koperasi::count();
        $koperasiAktif = Koperasi::where('status_verifikasi', 'diverifikasi')->count();
        $koperasiAktifPercent = $totalKoperasiCount > 0 ? round(($koperasiAktif / $totalKoperasiCount) * 100) : 0;
        
        // Anggota terverifikasi - gunakan kolom yang ada (status_keanggotaan atau status)
        $totalAnggotaCount = \App\Models\Anggota::count();
        $anggotaVerified = \App\Models\Anggota::where('status', 'Aktif')->count();
        $anggotaVerifiedPercent = $totalAnggotaCount > 0 ? round(($anggotaVerified / $totalAnggotaCount) * 100) : 0;
        
        // Laporan selesai - gunakan query yang lebih aman
        $totalLaporanCount = ActivityLog::count();
        $laporanSelesai = ActivityLog::where('action', 'view')->count(); // Ganti dengan action yang ada
        $laporanSelesaiPercent = $totalLaporanCount > 0 ? round(($laporanSelesai / $totalLaporanCount) * 100) : 0;
        
        // Jadwal selesai - cek apakah tabel jadwal ada
        $totalJadwal = \App\Models\Jadwal::count();
        $jadwalSelesai = \App\Models\Jadwal::where('status', 'selesai')->count();
        $jadwalSelesaiPercent = $totalJadwal > 0 ? round(($jadwalSelesai / $totalJadwal) * 100) : 0;
        
        $totalBantuanCount = PenerimaBantuan::count();
        $bantuanTersalurkan = PenerimaBantuan::where('status', 'diterima')->count();
        $bantuanTersalurkanPercent = $totalBantuanCount > 0 ? round(($bantuanTersalurkan / $totalBantuanCount) * 100) : 0;
        
        // Pelatihan selesai - cek apakah tabel pelatihan ada
        $totalPelatihan = \App\Models\Pelatihan::count();
        $pelatihanSelesai = \App\Models\Pelatihan::where('status', 'selesai')->count();
        $pelatihanSelesaiPercent = $totalPelatihan > 0 ? round(($pelatihanSelesai / $totalPelatihan) * 100) : 0;
        
        $progressData = [
            'koperasi_aktif' => $koperasiAktifPercent,
            'anggota_verified' => $anggotaVerifiedPercent,
            'laporan_selesai' => $laporanSelesaiPercent,
            'jadwal_selesai' => $jadwalSelesaiPercent,
            'bantuan_tersalurkan' => $bantuanTersalurkanPercent,
            'pelatihan_selesai' => $pelatihanSelesaiPercent,
        ];
        
        // Data koperasi terbaru untuk table
        $koperasiTerbaru = Koperasi::with('user')
            ->latest()
            ->take(6)
            ->get();
        
        // Data untuk pie chart (status koperasi)
        $statusCounts = [
            'aktif' => Koperasi::where('status_verifikasi', 'diverifikasi')->count(),
            'pending' => Koperasi::where('status_verifikasi', 'pending')->count(),
            'nonaktif' => Koperasi::where('status_verifikasi', 'ditolak')->count(),
            'review' => Koperasi::whereNull('status_verifikasi')->count(),
        ];
        
        return view('pimpinan.dashboard', compact(
            'stats',
            'koperasiPerKategori',
            'koperasiPerDistrik',
            'progressData',
            'koperasiTerbaru',
            'statusCounts'
        ));
    }
    public function koperasi(Request $request) {
        // Check permission
        if (!can_view('koperasi')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Data Koperasi. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        $query = Koperasi::query();
        if ($request->filled('distrik')) $query->where('distrik',$request->distrik);
        if ($request->filled('kategori')) $query->where('kategori',$request->kategori);
        if ($request->filled('status')) $query->where('status_verifikasi',$request->status);
        $koperasi = $query->latest()->paginate(20)->appends($request->query());
        return view('pimpinan.koperasi', ['koperasi'=>$koperasi,'distrik'=>Koperasi::listDistrik()]);
    }
    public function showKoperasi(Koperasi $koperasi) { 
        // Check permission
        if (!can_view('koperasi')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat detail Koperasi.');
        }
        
        $koperasi->load('penerimaBantuan.bantuan'); 
        return view('pimpinan.koperasi-detail', compact('koperasi')); 
    }
    public function profile() { $user = auth()->user(); return view('pimpinan.profile', compact('user')); }

    public function jadwal(Request $request) {
        // Check permission
        if (!can_view('jadwal')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Jadwal. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        $query = \App\Models\Jadwal::with('petugas');
        
        // Filter by jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('tanggal', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('tanggal', '<=', $request->date_to);
        }
        
        $jadwal = $query->orderBy("tanggal", "desc")->paginate(15)->appends($request->query());
        return view("pimpinan.jadwal", compact("jadwal"));
    }
    
    public function activityLog(Request $request) {
        // Check permission - use 'laporan' module since activity_log is not in modules list
        if (!can_view('laporan')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Log Aktivitas. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        $query = ActivityLog::with('user');
        
        // Filter by user role (admin, petugas, etc)
        if ($request->filled('role')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }
        
        // Filter by module
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('action', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('name', 'like', '%'.$request->search.'%');
                  });
            });
        }
        
        $logs = $query->latest('created_at')->paginate(50)->appends($request->query());
        
        // Stats
        $stats = [
            'total' => ActivityLog::count(),
            'today' => ActivityLog::whereDate('created_at', today())->count(),
            'this_week' => ActivityLog::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => ActivityLog::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
        ];
        
        // Get unique modules for filter
        $modules = ActivityLog::select('module')->distinct()->pluck('module');
        
        return view('pimpinan.activity-log', compact('logs', 'stats', 'modules'));
    }
    
    public function activityLogDetail($id) {
        // Check permission - use 'laporan' module
        if (!can_view('laporan')) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki izin untuk melihat detail log aktivitas.'], 403);
        }
        
        $log = ActivityLog::with('user')->findOrFail($id);
        return response()->json($log);
    }
    
    public function activityLogDelete($id) {
        // Check permission - use 'laporan' module
        if (!can_delete('laporan')) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki izin untuk menghapus log aktivitas.'], 403);
        }
        
        try {
            $log = ActivityLog::findOrFail($id);
            $log->delete();
            return response()->json(['success' => true, 'message' => 'Log aktivitas berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus log: ' . $e->getMessage()], 500);
        }
    }
    
    public function activityLogDeleteAll(Request $request) {
        // Check permission - use 'laporan' module
        if (!can_delete('laporan')) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki izin untuk menghapus log aktivitas.'], 403);
        }
        
        try {
            $query = ActivityLog::query();
            
            // Apply same filters as index
            if ($request->filled('role')) {
                $query->whereHas('user', function($q) use ($request) {
                    $q->where('role', $request->role);
                });
            }
            if ($request->filled('module')) {
                $query->where('module', $request->module);
            }
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }
            
            $count = $query->count();
            $query->delete();
            
            return response()->json(['success' => true, 'message' => "$count log aktivitas berhasil dihapus"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus log: ' . $e->getMessage()], 500);
        }
    }
    public function updateProfile(Request $request) {
        $user = auth()->user();
        $request->validate(['name'=>'required','email'=>'required|email|unique:users,email,'.$user->id,'password'=>'nullable|min:8|confirmed']);
        $data = $request->only(['name','email','phone']);
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
            $data['profile_photo'] = $request->file('profile_photo')->store('foto_profil','public');
        }
        if ($request->filled('password')) $data['password'] = Hash::make($request->password);
        $user->update($data);
        return back()->with('success','Profil berhasil diperbarui.');
    }
}
