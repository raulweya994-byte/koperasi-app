<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Berita;
use App\Models\Kontak;
use App\Models\Galeri;
use App\Models\HalamanStatis;
use App\Models\Koperasi;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $stats = [
            // Statistik utama seperti di admin dashboard
            'total_koperasi'        => Koperasi::count(),
            'koperasi_verified'     => Koperasi::where('status_verifikasi','diverifikasi')->count(),
            'koperasi_pending'      => Koperasi::where('status_verifikasi','pending')->count(),
            'bantuan_aktif'         => Bantuan::where('status','aktif')->count(),
            
            // Statistik tambahan untuk halaman depan
            'total_bantuan'         => Bantuan::where('status','selesai')->count(),
            'total_distrik'         => Koperasi::distinct('distrik')->count('distrik'),
            'total_tenaga'          => Koperasi::sum('jumlah_karyawan'),
        ];
        $berita_terbaru = Berita::where('status','publish')->latest()->take(6)->get();
        $galeri         = Galeri::latest()->take(6)->get();
        $kontaks        = Kontak::orderBy('urutan')->take(5)->get();
        return view('public.home', compact('stats','berita_terbaru','galeri','kontaks'));
    }

    
    public function profil()
    {
        $halaman = \App\Models\HalamanStatis::where('status', 'aktif')->get();
        return view('public.profil', compact('halaman'));
    }

        public function halaman($slug) {
        if($slug === "struktur" || $slug === "struktur-organisasi") return view("public.struktur");
        if($slug === "visi-misi") return view("public.visi-misi");
        if($slug === "perdagangan") return view("public.perdagangan");
        if($slug === "perindustrian") return view("public.perindustrian");
        if($slug === "komitmen") return view("public.komitmen");
        if($slug === "koperasi") {
            $stats = [
                "total_koperasi" => \App\Models\Koperasi::count(),
                "koperasi_verified" => \App\Models\Koperasi::where("status_verifikasi","diverifikasi")->count(),
                "koperasi_aktif" => \App\Models\Koperasi::where("status_usaha","aktif")->count(),
                "total_distrik" => \App\Models\Koperasi::distinct("distrik")->count("distrik"),
            ];
            $koperasiTerbaru = \App\Models\Koperasi::where("status_verifikasi","diverifikasi")
                ->where("status_usaha","aktif")
                ->latest()
                ->take(6)
                ->get();
            return view("public.profil-koperasi", compact("stats", "koperasiTerbaru"));
        }
        $halaman = \App\Models\HalamanStatis::where("slug",$slug)->whereIn("status",["aktif","dibuka"])->firstOrFail();
        return view("public.halaman", compact("halaman"));
    }

    
    public function layanan() {
        return view("public.layanan");
    }

    public function pelatihan() {
        $pelatihan = \App\Models\Pelatihan::whereIn("status",["aktif","dibuka"])->orderBy("tanggal_mulai")->get();
        return view("public.pelatihan", compact("pelatihan"));
    }

    public function pelatihanDaftar(\App\Models\Pelatihan $pelatihan) {
        return view("public.pelatihan_daftar", compact("pelatihan"));
    }

    public function pelatihanDaftarStore(\Illuminate\Http\Request $request, \App\Models\Pelatihan $pelatihan) {
        $request->validate(["nama_peserta"=>"required","no_hp"=>"required"]);
        \App\Models\PendaftaranPelatihan::create([
            "pelatihan_id"=>$pelatihan->id,
            "nama_peserta"=>$request->nama_peserta,
            "no_hp"=>$request->no_hp,
            "email"=>$request->email,
            "nama_usaha"=>$request->nama_usaha,
        ]);
        return back()->with("success","Pendaftaran berhasil! Kami akan menghubungi Anda segera.");
    }

    public function bantuanModal() {
        return view("public.bantuan_modal");
    }

    public function bantuanModalStore(\Illuminate\Http\Request $request) {
        $request->validate(["nama_pemohon"=>"required","no_hp"=>"required","nama_usaha"=>"required","jenis_bantuan"=>"required","tujuan_penggunaan"=>"required"]);
        \App\Models\PengajuanBantuan::create($request->only(["nama_pemohon","no_hp","email","nama_usaha","jenis_bantuan","jumlah_diajukan","tujuan_penggunaan"]));
        return back()->with("success","Pengajuan berhasil dikirim! Kami akan memproses pengajuan Anda.");
    }

    public function statistik() {
        $stats = [
            "total_koperasi" => \App\Models\Koperasi::count(),
            "koperasi_verified" => \App\Models\Koperasi::where("status_verifikasi","diverifikasi")->count(),
            "total_distrik" => \App\Models\Koperasi::distinct("distrik")->count(),
            "total_tenaga" => \App\Models\Koperasi::sum("jumlah_karyawan") ?? 0,
        ];
        $koperasiPerDistrik = \App\Models\Koperasi::selectRaw("distrik, COUNT(*) as total")->groupBy("distrik")->orderBy("total","desc")->get();
        $koperasiPerKategori = \App\Models\Koperasi::selectRaw("kategori, COUNT(*) as total")->groupBy("kategori")->get();
        return view("public.statistik", compact("stats","koperasiPerDistrik","koperasiPerKategori"));
    }

    public function statistikKoperasi() {
        // Data Statistik Umum
        $stats = [
            "total_koperasi" => \App\Models\Koperasi::count(),
            "koperasi_verified" => \App\Models\Koperasi::where("status_verifikasi","diverifikasi")->count(),
            "koperasi_aktif" => \App\Models\Koperasi::where("status_usaha","aktif")->count(),
            "koperasi_pending" => \App\Models\Koperasi::where("status_verifikasi","pending")->count(),
            "total_distrik" => \App\Models\Koperasi::distinct("distrik")->count("distrik"),
            "total_karyawan" => \App\Models\Koperasi::sum("jumlah_karyawan") ?? 0,
            "total_modal" => \App\Models\Koperasi::sum("modal_usaha") ?? 0,
            "total_omset" => \App\Models\Koperasi::sum("omset_per_bulan") ?? 0,
        ];

        // Koperasi per Distrik (Top 10)
        $koperasiPerDistrik = \App\Models\Koperasi::selectRaw("distrik, COUNT(*) as total")
            ->whereNotNull("distrik")
            ->groupBy("distrik")
            ->orderBy("total","desc")
            ->limit(10)
            ->get();

        // Koperasi per Kategori
        $koperasiPerKategori = \App\Models\Koperasi::selectRaw("kategori, COUNT(*) as total")
            ->whereNotNull("kategori")
            ->groupBy("kategori")
            ->get();

        // Koperasi per Status Verifikasi
        $koperasiPerStatus = \App\Models\Koperasi::selectRaw("status_verifikasi, COUNT(*) as total")
            ->groupBy("status_verifikasi")
            ->get();

        // Koperasi per Jenis Usaha (Top 10)
        $koperasiPerJenis = \App\Models\Koperasi::selectRaw("jenis_usaha, COUNT(*) as total")
            ->whereNotNull("jenis_usaha")
            ->groupBy("jenis_usaha")
            ->orderBy("total","desc")
            ->limit(10)
            ->get();

        // Trend Pendaftaran per Bulan (12 bulan terakhir)
        $trendPendaftaran = \App\Models\Koperasi::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(*) as total")
            ->where("created_at", ">=", now()->subMonths(12))
            ->groupBy("bulan")
            ->orderBy("bulan")
            ->get();

        return view("public.statistik-koperasi", compact(
            "stats",
            "koperasiPerDistrik",
            "koperasiPerKategori",
            "koperasiPerStatus",
            "koperasiPerJenis",
            "trendPendaftaran"
        ));
    }

    public function daftarKoperasi() {
        return redirect()->route("register");
    }

    
    public function daftarAnggota() {
        // Cek apakah pendaftaran dibuka
        $buka = \App\Models\Setting::where("key","pendaftaran_buka")->value("value");
        $mulai = \App\Models\Setting::where("key","pendaftaran_mulai")->value("value");
        $selesai = \App\Models\Setting::where("key","pendaftaran_selesai")->value("value");
        $sekarang = now()->toDateString();
        $aktif = $buka == "1" && $sekarang >= $mulai && $sekarang <= $selesai;
        return view("public.daftar_anggota", compact("aktif","mulai","selesai"));
    }

    public function daftarAnggotaStore(\Illuminate\Http\Request $request) {
        $request->validate([
            "nik"           => "required|unique:anggotas,nik|digits:16",
            "nama"          => "required",
            "tempat_lahir"  => "required",
            "tanggal_lahir" => "required|date",
            "no_hp"         => "required",
            "distrik"       => "required",
            "nama_usaha"    => "required",
        ]);
        $d = $request->only(["nik","nama","tempat_lahir","tanggal_lahir","jenis_kelamin","agama","no_hp","email","distrik","kabupaten","alamat_lengkap","nama_usaha","modal_usaha","omzet_per_bulan","total_simpanan","keterangan_usaha"]);
        $d["desa"] = $request->desa ?: "-";
        $d["no_anggota"] = \App\Models\Anggota::generateNoAnggota();
        $d["status"] = "Pending";
        if ($request->hasFile("foto")) $d["foto"] = $request->file("foto")->store("anggota","public");
        $anggota = \App\Models\Anggota::create($d);
        return back()->with("success","Pendaftaran berhasil! Menunggu verifikasi admin.")->with("no_anggota", $anggota->no_anggota);
    }

    public function tentang()
    {
        return view('public.tentang');
    }

    public function koperasi(Request $request)
    {
        $query = Koperasi::with('dokumen')->where('status_verifikasi','diverifikasi')->where('status_usaha','aktif');
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_usaha','like','%'.$request->search.'%')
                  ->orWhere('jenis_usaha','like','%'.$request->search.'%')
                  ->orWhere('nama_pemilik','like','%'.$request->search.'%');
            });
        }
        if ($request->filled('kategori')) $query->where('kategori', $request->kategori);
        if ($request->filled('distrik'))  $query->where('distrik',  $request->distrik);
        $koperasi    = $query->latest()->paginate(12)->appends($request->query());
        $distrik = Koperasi::listDistrik();
        return view('public.koperasi', compact('koperasi','distrik'));
    }

    public function koperasiDetail(Koperasi $koperasi)
    {
        abort_if($koperasi->status_verifikasi !== 'diverifikasi', 404);
        return view('public.koperasi-detail', compact('koperasi'));
    }
    public function downloadPengumuman($id)
    {
        $pengumuman = \App\Models\Pengumuman::findOrFail($id);
        
        try {
            // Try to generate PDF with DomPDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('public.pengumuman_pdf', ['p' => $pengumuman])
                ->setPaper('a4', 'portrait');
            $filename = 'Pengumuman-' . \Str::slug($pengumuman->judul) . '.pdf';
            return $pdf->download($filename);
        } catch (\Exception $e) {
            // If PDF generation fails (e.g., GD extension not installed),
            // return HTML view that can be printed as PDF by browser
            return view('public.pengumuman_print', ['p' => $pengumuman]);
        }
    }

    public function berita(Request $request)
    {
        $query = Berita::where('status','publish');
        if ($request->filled('search')) {
            $query->where('judul','like','%'.$request->search.'%');
        }
        $berita  = $query->latest()->paginate(9)->appends($request->query());
        $populer = Berita::where('status','publish')->orderByDesc('views')->take(5)->get();
        return view('public.berita', compact('berita','populer'));
    }

    public function beritaDetail(Berita $berita)
    {
        abort_if($berita->status !== 'publish', 404);
        $berita->increment('views');
        $lainnya = Berita::where('status','publish')
                         ->where('id','!=',$berita->id)->latest()->take(3)->get();
        return view('public.berita-detail', compact('berita','lainnya'));
    }

    public function galeri(Request $request)
    {
        $q = Galeri::latest();
        if ($request->tipe) $q = $q->where('tipe', $request->tipe);
        $galeri = $q->paginate(12);
        $tipe = $request->tipe;
        return view('public.galeri', compact('galeri', 'tipe'));
    }

    
    public function pengumuman(\Illuminate\Http\Request $request)
    {
        $pengumuman = \App\Models\Pengumuman::where('is_aktif', true)
            ->whereIn('tampil_di', ['semua', 'anggota'])
            ->orderBy('urutan')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Get selected pengumuman ID from query string
        $selectedId = $request->get('id');
        
        return view("public.pengumuman", compact("pengumuman", "selectedId"));
    }

    public function pengumumanDetail($id)
    {
        $pengumuman = \App\Models\Pengumuman::where('is_aktif', true)
            ->whereIn('tampil_di', ['semua', 'anggota'])
            ->findOrFail($id);
        
        return response()->json([
            'id' => $pengumuman->id,
            'judul' => $pengumuman->judul,
            'isi' => $pengumuman->isi,
            'jenis' => $pengumuman->jenis,
            'tanggal' => $pengumuman->tanggal,
            'tanggal_formatted' => $pengumuman->tanggal ? \Carbon\Carbon::parse($pengumuman->tanggal)->isoFormat('D MMMM') : null,
            'hari' => $pengumuman->hari,
            'jam' => $pengumuman->jam,
            'tahun' => $pengumuman->tahun,
            'pembuat' => $pengumuman->pembuat,
            'foto' => $pengumuman->foto,
            'link' => $pengumuman->link,
            'created_at' => $pengumuman->created_at->isoFormat('dddd, D MMMM Y'),
        ]);
    }

    public function kontak()
    {
        $kontaks = Kontak::orderBy('urutan')->get();
        return view('public.kontak', compact('kontaks'));
    }


    public function kontakStore(Request $request)
    {
        $request->validate([
            "nama"    => "required|string|max:100",
            "email"   => "required|email|max:100",
            "telepon" => "nullable|string|max:20",
            "subjek"  => "required|string|max:150",
            "pesan"   => "required|string|min:10",
        ], [
            "nama.required"   => "Nama lengkap wajib diisi.",
            "email.required"  => "Email wajib diisi.",
            "email.email"     => "Format email tidak valid.",
            "subjek.required" => "Subjek wajib diisi.",
            "pesan.required"  => "Pesan wajib diisi.",
            "pesan.min"       => "Pesan minimal 10 karakter.",
        ]);

        // Simpan ke database (tabel pesan_kontak)
        \DB::table("pesan_kontak")->insert([
            "nama"       => $request->nama,
            "email"      => $request->email,
            "telepon"    => $request->telepon,
            "subjek"     => $request->subjek,
            "pesan"      => $request->pesan,
            "created_at" => now(),
            "updated_at" => now(),

            
        ]);
        

        return redirect()->route("public.kontak")
                         ->with("success", "Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.");
    }
}

