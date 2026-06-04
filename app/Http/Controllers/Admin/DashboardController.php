<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Anggota;
use App\Models\Bantuan;
use App\Models\Berita;
use App\Models\PenerimaBantuan;
use App\Models\Koperasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Pastikan user adalah admin
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                Log::warning('Unauthorized dashboard access attempt', [
                    'user_id' => auth()->id(),
                    'role' => auth()->user()->role ?? 'guest'
                ]);
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }

            // Statistik Koperasi, Bantuan, Penerima, Anggota, dll
            $stats = [
                'total_koperasi' => Koperasi::count(),
                'koperasi_verified' => Koperasi::where('status_verifikasi', 'diverifikasi')->count(),
                'koperasi_pending' => Koperasi::where('status_verifikasi', 'pending')->count(),
                'koperasi_ditolak' => Koperasi::where('status_verifikasi', 'ditolak')->count(),
                'koperasi_aktif' => Koperasi::where('status_usaha', 'aktif')->count(),
                'total_anggota' => Anggota::count(),
                'anggota_aktif' => Anggota::where('status', 'aktif')->count(),
                'anggota_pending' => Anggota::where('status', 'pending')->count(),
                'anggota_ditolak' => Anggota::where('status', 'Ditolak')->count(),
                'total_users' => User::count(),
                'total_bantuan' => Bantuan::count(),
                'bantuan_aktif' => Bantuan::where('status', 'aktif')->count(),
                'penerima_bantuan' => PenerimaBantuan::where('status', 'diterima')->count(),
            ];
            
            // Cek periode pendaftaran aktif
            $periodePendaftaranAktif = \App\Models\PeriodePendaftaran::where('status', 'aktif')
                ->where('tanggal_mulai', '<=', now())
                ->where('tanggal_selesai', '>=', now())
                ->first();
            
            // Anggota ditolak yang bisa update (periode masih buka)
            $anggotaDitolakBisaUpdate = 0;
            if ($periodePendaftaranAktif) {
                $anggotaDitolakBisaUpdate = Anggota::where('status', 'Ditolak')->count();
            }

            // Grafik: koperasi per distrik (top 10)
            $koperasiPerDistrik = Koperasi::select('distrik', DB::raw('COUNT(*) as total'))
                ->whereNotNull('distrik')
                ->groupBy('distrik')
                ->orderByDesc('total')
                ->limit(10)
                ->get();

            // Grafik: koperasi per kategori
            $koperasiPerKategori = Koperasi::select('kategori', DB::raw('COUNT(*) as total'))
                ->whereNotNull('kategori')
                ->groupBy('kategori')
                ->get();

            // Grafik: Bantuan per tahun
            $bantuanPerTahun = PenerimaBantuan::join('bantuan', 'penerima_bantuan.bantuan_id', '=', 'bantuan.id')
                ->select('bantuan.tahun', DB::raw('COUNT(*) as total'))
                ->where('penerima_bantuan.status', 'diterima')
                ->groupBy('bantuan.tahun')
                ->orderBy('bantuan.tahun')
                ->get();

            // Grafik: Trend pendaftaran koperasi (6 bulan terakhir)
            $trendPendaftaran = Koperasi::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, COUNT(*) as total')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('bulan')
                ->orderBy('bulan', 'asc')
                ->get();

            // Anggota terbaru menunggu konfirmasi
            $pendingAnggota = Anggota::where('status', 'pending')
                ->latest()
                ->limit(5)
                ->get();

            // Koperasi terbaru menunggu verifikasi
            $pendingKoperasi = Koperasi::where('status_verifikasi', 'pending')
                ->latest()
                ->limit(5)
                ->get();

            // Aktivitas terbaru
            $recentActivity = ActivityLog::with('user')
                ->latest()
                ->limit(8)
                ->get();

            // Berita terbaru (draft)
            $draftBerita = Berita::where('status', 'draft')->count();

            return view('admin.dashboard.index', compact(
                'stats',
                'koperasiPerDistrik',
                'koperasiPerKategori',
                'bantuanPerTahun',
                'trendPendaftaran',
                'pendingKoperasi',
                'recentActivity',
                'draftBerita',
                'periodePendaftaranAktif',
                'anggotaDitolakBisaUpdate',
                'pendingAnggota'
            ));
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat memuat dashboard: ' . $e->getMessage());
        }
    }
}