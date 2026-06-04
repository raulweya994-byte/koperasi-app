<?php
namespace App\Http\Controllers\Anggota;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Pengumuman;
use App\Models\Jadwal;

class PortalAnggotaController extends Controller {

    public function dashboard() {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->first();
        
        // Jika belum ada data anggota, redirect ke halaman error
        if (!$anggota) {
            return redirect()->route('login')->with('error', 'Data anggota tidak ditemukan. Silakan hubungi admin.');
        }
        
        // LANGSUNG MASUK DASHBOARD - tidak cek status
        // Status hanya untuk informasi, bukan untuk membatasi akses
        
        // Hitung simpanan dari tabel simpanans
        $simpananDariTransaksi = \App\Models\Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');
        
        // Ambil simpanan pokok dan wajib dari field anggota (data awal saat pendaftaran)
        $simpananPokok = ($anggota->simpanan_pokok ?? 0) + \App\Models\Simpanan::where('anggota_id', $anggota->id)
            ->where('jenis_simpanan', 'Simpanan Pokok')
            ->sum('jumlah');
            
        $simpananWajib = ($anggota->simpanan_wajib ?? 0) + \App\Models\Simpanan::where('anggota_id', $anggota->id)
            ->where('jenis_simpanan', 'Simpanan Wajib')
            ->sum('jumlah');
            
        $simpananSukarela = \App\Models\Simpanan::where('anggota_id', $anggota->id)
            ->where('jenis_simpanan', 'Simpanan Sukarela')
            ->sum('jumlah');
        
        // Total simpanan = simpanan awal (pokok + wajib dari field anggota) + transaksi simpanan
        $totalSimpanan = ($anggota->simpanan_pokok ?? 0) + ($anggota->simpanan_wajib ?? 0) + $simpananDariTransaksi;
        
        // Update field total_simpanan di anggota jika berbeda
        if ($anggota->total_simpanan != $totalSimpanan) {
            $anggota->total_simpanan = $totalSimpanan;
            $anggota->save();
        }
        
        // Ambil pengumuman terbaru
        $pengumuman = Pengumuman::where('is_aktif', true)
            ->latest()
            ->take(5)
            ->get();
        
        // Ambil jadwal kegiatan publik yang akan datang
        $jadwal = Jadwal::where('is_publik', true)
            ->whereIn('status', ['dijadwalkan', 'berlangsung'])
            ->where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->take(5)
            ->get();
        
        return view('anggota.dashboard', compact('anggota', 'pengumuman', 'jadwal', 'simpananPokok', 'simpananWajib', 'simpananSukarela'));
    }

    public function kartu() {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        return view('anggota.kartu', compact('anggota'));
    }

    public function profil() {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        return view('anggota.profil', compact('anggota'));
    }

    public function profilUpdate(\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        
        $request->validate([
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'distrik' => 'required|string|max:50',
            'desa' => 'nullable|string|max:50',
            'alamat_lengkap' => 'nullable|string',
            'nama_usaha' => 'required|string|max:100',
            'bidang_usaha' => 'nullable|string|max:100',
            'modal_usaha' => 'nullable|numeric',
            'omzet_per_bulan' => 'nullable|numeric',
            'total_simpanan' => 'nullable|numeric',
            'keterangan_usaha' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $data = $request->except(['foto', '_token', '_method']);
        
        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($anggota->foto && \Storage::disk('public')->exists($anggota->foto)) {
                \Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }
        
        $anggota->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!'
        ]);
    }

    public function pengumuman() {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        
        $pengumuman = Pengumuman::where('is_aktif', true)
            ->latest()
            ->paginate(10);
        
        return view('anggota.pengumuman', compact('anggota', 'pengumuman'));
    }

    public function jadwal() {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        
        $jadwal = Jadwal::where('is_publik', true)
            ->whereIn('status', ['dijadwalkan', 'berlangsung', 'selesai'])
            ->orderBy('tanggal', 'desc')
            ->paginate(12);
        
        return view('anggota.jadwal', compact('anggota', 'jadwal'));
    }

    public function jadwalDetail($id) {
        $jadwal = Jadwal::where('is_publik', true)->findOrFail($id);
        
        return response()->json([
            'id' => $jadwal->id,
            'judul' => $jadwal->judul,
            'deskripsi' => $jadwal->deskripsi,
            'jenis' => $jadwal->jenis,
            'jenis_label' => $jadwal->jenis_label,
            'jenis_color' => $jadwal->jenis_color,
            'tanggal' => $jadwal->tanggal->format('Y-m-d'),
            'tanggal_formatted' => $jadwal->tanggal->format('d F Y'),
            'jam_mulai' => substr($jadwal->jam_mulai, 0, 5),
            'jam_selesai' => $jadwal->jam_selesai ? substr($jadwal->jam_selesai, 0, 5) : null,
            'lokasi' => $jadwal->lokasi,
            'status' => $jadwal->status,
            'status_label' => $jadwal->status_label,
            'status_color' => $jadwal->status_color,
            'catatan' => $jadwal->catatan,
            'petugas' => $jadwal->petugas ? $jadwal->petugas->name : null,
        ]);
    }

    public function lengkapiData() {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        
        // Cek apakah ada periode pendaftaran yang aktif
        $periodeBuka = \App\Models\PeriodePendaftaran::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->first();
        
        return view('anggota.lengkapi-data', compact('anggota', 'periodeBuka'));
    }

    public function lengkapiDataUpdate(\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        
        // Cek apakah ada periode pendaftaran yang aktif
        $periodeBuka = \App\Models\PeriodePendaftaran::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->first();
        
        // Jika tidak ada periode buka, tidak bisa update
        if (!$periodeBuka) {
            return back()->with('error', 'Maaf, saat ini tidak ada periode pendaftaran yang aktif. Silakan tunggu pengumuman periode berikutnya.');
        }
        
        // Validasi lengkap seperti pendaftaran
        $validated = $request->validate([
            // Identitas Pribadi
            'nik' => 'required|string|size:16|unique:anggotas,nik,' . $anggota->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'required|in:Lajang,Menikah,Cerai',
            'pendidikan_terakhir' => 'required|string',
            'agama' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email',
            
            // Alamat
            'desa' => 'nullable|string|max:100',
            'distrik' => 'required|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'alamat_lengkap' => 'nullable|string',
            
            // Usaha
            'nama_usaha' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:100',
            'lama_berdiri_usaha' => 'nullable|integer|min:0',
            'jumlah_karyawan' => 'nullable|integer|min:0',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omzet_per_bulan' => 'nullable|numeric|min:0',
            'alamat_tempat_usaha' => 'nullable|string',
            'keterangan_usaha' => 'nullable|string',
            
            // Keuangan
            'nama_bank' => 'nullable|string|max:100',
            'nomor_rekening' => 'nullable|string|max:50',
            'nama_pemilik_rekening' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|size:15',
            
            // Ahli Waris
            'nama_ahli_waris' => 'required|string|max:255',
            'hubungan_ahli_waris' => 'required|string|max:50',
            'no_hp_ahli_waris' => 'required|string|max:15',
            'nik_ahli_waris' => 'required|string|size:16',
            
            // Simpanan
            'simpanan_pokok' => 'required|numeric|min:0',
            'simpanan_wajib' => 'required|numeric|min:0',
            
            // Files
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        
        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            if ($anggota->foto && \Storage::disk('public')->exists($anggota->foto)) {
                \Storage::disk('public')->delete($anggota->foto);
            }
            $validated['foto'] = $request->file('foto')->store('anggota', 'public');
        }
        
        // Update data anggota
        $validated['status'] = 'Pending'; // Ubah status kembali ke Pending untuk verifikasi ulang
        $validated['catatan_admin'] = null; // Hapus catatan penolakan lama
        $validated['tanggal_verifikasi'] = null; // Reset tanggal verifikasi
        
        $anggota->update($validated);
        
        // Update email user jika berubah
        if ($user->email !== $validated['email']) {
            $user->update(['email' => $validated['email']]);
        }
        
        return redirect()->route('anggota.dashboard')
            ->with('success', 'Data berhasil dilengkapi dan dikirim untuk verifikasi ulang. Silakan tunggu verifikasi dari admin.');
    }

    public function kebutuhanBantuan() {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        
        return view('anggota.kebutuhan-bantuan', compact('anggota'));
    }

    public function kebutuhanBantuanStore(\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();
        
        // Cek periode aktif
        $periode = \App\Models\PeriodeBantuan::aktif()->first();
        if (!$periode) {
            return back()->with('error', 'Periode bantuan tidak aktif atau sudah berakhir.');
        }
        
        // Cek kuota
        if ($periode->kuota_penerima && $periode->sisaKuota() <= 0) {
            return back()->with('error', 'Kuota penerima bantuan sudah penuh.');
        }
        
        // Cek sudah mengajukan
        $sudahMengajukan = \App\Models\PengajuanBantuan::where('anggota_id', $anggota->id)
            ->where('periode_bantuan_id', $periode->id)
            ->exists();
            
        if ($sudahMengajukan) {
            return back()->with('error', 'Anda sudah mengajukan bantuan untuk periode ini.');
        }
        
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_bantuan' => 'required|string',
            'jumlah_diajukan' => 'required|numeric|min:0',
            'tujuan_penggunaan' => 'required|string',
        ]);
        
        // Simpan pengajuan
        \App\Models\PengajuanBantuan::create([
            'periode_bantuan_id' => $periode->id,
            'anggota_id' => $anggota->id,
            'nama_pemohon' => $request->nama_pemohon,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'nama_usaha' => $request->nama_usaha,
            'jenis_bantuan' => $request->jenis_bantuan,
            'jumlah_diajukan' => $request->jumlah_diajukan,
            'tujuan_penggunaan' => $request->tujuan_penggunaan,
            'status' => 'pending',
        ]);
        
        return redirect()->route('anggota.kebutuhan-bantuan')
            ->with('success', 'Pengajuan bantuan berhasil dikirim. Silakan tunggu proses verifikasi dari admin.');
    }
}
