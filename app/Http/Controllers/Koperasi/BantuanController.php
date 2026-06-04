<?php
namespace App\Http\Controllers\Koperasi;
use App\Http\Controllers\Controller;
use App\Models\Bantuan;
use App\Models\JadwalDistribusi;
use App\Models\PenerimaBantuan;
use App\Models\Koperasi;
use App\Models\PeriodeBantuan;
use App\Models\PengajuanBantuan;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index() { 
        $bantuan = Bantuan::where('status','aktif')->latest()->paginate(10); 
        return view('koperasi.bantuan.index', compact('bantuan')); 
    }
    
    public function show(Bantuan $bantuan) {
        $koperasi = Koperasi::where('user_id',auth()->id())->first();
        $sudahDaftar = $koperasi ? PenerimaBantuan::where('bantuan_id',$bantuan->id)->where('koperasi_id',$koperasi->id)->exists() : false;
        return view('koperasi.bantuan.show', compact('bantuan','sudahDaftar'));
    }
    
    public function riwayat() {
        $koperasi = Koperasi::where('user_id',auth()->id())->first();
        $riwayat = $koperasi ? PenerimaBantuan::where('koperasi_id',$koperasi->id)->with('bantuan')->latest()->paginate(10) : collect();
        return view('koperasi.bantuan.riwayat', compact('riwayat'));
    }
    
    public function jadwal() {
        $jadwal = JadwalDistribusi::where('status','terjadwal')->latest()->paginate(10);
        return view('koperasi.bantuan.jadwal', compact('jadwal'));
    }
    
    public function pengajuan() {
        return view('koperasi.bantuan.pengajuan');
    }
    
    public function pengajuanStore(Request $request) {
        $request->validate([
            'periode_bantuan_id' => 'required|exists:periode_bantuan,id',
            'nama_pemohon' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_bantuan' => 'required|string',
            'jumlah_diajukan' => 'required|numeric|min:0',
            'tujuan_penggunaan' => 'required|string',
        ]);
        
        // Cek periode aktif
        $periode = PeriodeBantuan::find($request->periode_bantuan_id);
        if (!$periode || !$periode->isAktif()) {
            return back()->with('error', 'Periode bantuan tidak aktif atau sudah berakhir.');
        }
        
        // Cek kuota
        if ($periode->kuota_penerima && $periode->sisaKuota() <= 0) {
            return back()->with('error', 'Kuota penerima bantuan sudah penuh.');
        }
        
        // Cek koperasi
        $koperasi = Koperasi::where('user_id', auth()->id())->first();
        if (!$koperasi) {
            return back()->with('error', 'Data koperasi tidak ditemukan.');
        }
        
        // Cek sudah mengajukan
        $sudahMengajukan = PengajuanBantuan::where('koperasi_id', $koperasi->id)
            ->where('periode_bantuan_id', $periode->id)
            ->exists();
            
        if ($sudahMengajukan) {
            return back()->with('error', 'Anda sudah mengajukan bantuan untuk periode ini.');
        }
        
        // Simpan pengajuan
        PengajuanBantuan::create([
            'periode_bantuan_id' => $request->periode_bantuan_id,
            'koperasi_id' => $koperasi->id,
            'nama_pemohon' => $request->nama_pemohon,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'nama_usaha' => $request->nama_usaha,
            'jenis_bantuan' => $request->jenis_bantuan,
            'jumlah_diajukan' => $request->jumlah_diajukan,
            'tujuan_penggunaan' => $request->tujuan_penggunaan,
            'status' => 'menunggu',
        ]);
        
        return redirect()->route('koperasi.bantuan.pengajuan')
            ->with('success', 'Pengajuan bantuan berhasil dikirim. Silakan tunggu proses verifikasi dari admin.');
    }
}
