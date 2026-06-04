<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KoperasiController as AdminKoperasi;
use App\Http\Controllers\Admin\BantuanController as AdminBantuan;
use App\Http\Controllers\Admin\PeriodeBantuanController;
use App\Http\Controllers\Admin\BeritaController as AdminBerita;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumuman;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Admin\GaleriController as AdminGaleri;
use App\Http\Controllers\Admin\JadwalController as AdminJadwal;
use App\Http\Controllers\Admin\PelatihanController as AdminPelatihan;
use App\Http\Controllers\Admin\KontakController as AdminKontak;
use App\Http\Controllers\Admin\HalamanStatisController as AdminHalamanStatis;
use App\Http\Controllers\Admin\StrukturController as AdminStruktur;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\SimpananController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\KoperasiController as PetugasKoperasi;
use App\Http\Controllers\Petugas\AnggotaKoperasiController as PetugasAnggotaKoperasi;
use App\Http\Controllers\Petugas\BantuanController as PetugasBantuan;
use App\Http\Controllers\Petugas\GaleriController as PetugasGaleri;
use App\Http\Controllers\Petugas\PelatihanController as PetugasPelatihan;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporan;
use App\Http\Controllers\Petugas\UserController as PetugasUser;
use App\Http\Controllers\Petugas\SettingController as PetugasSetting;
use App\Http\Controllers\Petugas\KontakController as PetugasKontak;
use App\Http\Controllers\Petugas\StrukturController as PetugasStruktur;
use App\Http\Controllers\Petugas\HalamanStatisController as PetugasHalamanStatis;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboard;
use App\Http\Controllers\Pimpinan\LaporanController as PimpinanLaporan;
use App\Http\Controllers\Koperasi\DashboardController as KoperasiDashboard;
use App\Http\Controllers\Koperasi\ProfileController as KoperasiProfile;
use App\Http\Controllers\Koperasi\BantuanController as KoperasiBantuan;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PendaftaranAnggotaController;
use App\Http\Controllers\Admin\PeriodePendaftaranController;

// ================= PUBLIC ROUTES =================
Route::get("/", [PublicController::class, "home"])->name("public.home");
Route::get("/tentang", [PublicController::class, "tentang"])->name("public.tentang");
Route::get("/profil", [PublicController::class, "profil"])->name("profil");
Route::get("/profil/{slug}", [PublicController::class, "halaman"])->name("public.halaman");
Route::get("/layanan", [PublicController::class, "layanan"])->name("layanan");
Route::get("/pelatihan", [PublicController::class, "pelatihan"])->name("pelatihan");
Route::get("/pelatihan/{pelatihan}/daftar", [PublicController::class, "pelatihanDaftar"])->name("pelatihan.daftar");
Route::post("/pelatihan/{pelatihan}/daftar", [PublicController::class, "pelatihanDaftarStore"])->name("pelatihan.daftar.store");
Route::get("/bantuan-modal", [PublicController::class, "bantuanModal"])->name("bantuan-modal");
Route::post("/bantuan-modal", [PublicController::class, "bantuanModalStore"])->middleware("throttle:5,1")->name("bantuan-modal.store");
Route::get("/statistik", [PublicController::class, "statistik"])->name("statistik");
Route::get("/statistik-koperasi", [PublicController::class, "statistikKoperasi"])->name("statistik.koperasi");
Route::get("/daftar-koperasi", [PublicController::class, "daftarKoperasi"])->name("daftar-koperasi");
Route::middleware("auth")->group(function() {
    Route::get("/daftar-anggota", [PublicController::class, "daftarAnggota"])->name("daftar-anggota");
    Route::post("/daftar-anggota", [PublicController::class, "daftarAnggotaStore"])->name("daftar-anggota.store");
});
Route::get("/direktori-koperasi", [PublicController::class, "koperasi"])->name("public.koperasi");
Route::get("/direktori-koperasi/{koperasi}", [PublicController::class, "koperasiDetail"])->name("public.koperasi.detail");
Route::get("/berita", [PublicController::class, "berita"])->name("public.berita");
Route::get("/berita/{berita}", [PublicController::class, "beritaDetail"])->name("public.berita.detail");
Route::get("/galeri", [PublicController::class, "galeri"])->name("public.galeri");
Route::get("/jadwal", function () {
    $jadwal = \App\Models\Jadwal::where("is_publik", true)->aktif()->latest("tanggal")->paginate(12);
    return view("public.jadwal", compact("jadwal"));
})->name("public.jadwal");
Route::get("/pengumuman", [PublicController::class, "pengumuman"])->name("public.pengumuman");
Route::get("/pengumuman/{id}/detail", [PublicController::class, "pengumumanDetail"])->name("public.pengumuman.detail");
Route::get("/pengumuman/{id}/download", [PublicController::class, "downloadPengumuman"])->name("public.pengumuman.download");
Route::get("/kontak", [PublicController::class, "kontak"])->name("public.kontak");
Route::post("/kontak", [PublicController::class, "kontakStore"])->middleware("throttle:10,1")->name("public.kontak.store");

// ================= PENDAFTARAN ANGGOTA PUBLIC =================
Route::get("/pendaftaran-anggota", [PendaftaranAnggotaController::class, "landing"])->name("pendaftaran.landing");
Route::get("/pendaftaran-anggota/form", [PendaftaranAnggotaController::class, "index"])->name("pendaftaran.form");
Route::post("/pendaftaran-anggota", [PendaftaranAnggotaController::class, "store"])->middleware("throttle:5,1")->name("pendaftaran.store");
Route::get("/pendaftaran-anggota/success", [PendaftaranAnggotaController::class, "success"])->name("pendaftaran.success");

// ================= AUTH ROUTES =================
Route::middleware("guest")->group(function () {
    Route::get("/login", [LoginController::class, "showLoginForm"])->name("login");
    Route::post("/login", [LoginController::class, "login"])->name("login.post");
    // Route::get("/register", [LoginController::class, "showRegisterForm"])->name("register");
    // Route::post("/register", [LoginController::class, "register"])->name("register.post");
    Route::get("/forgot-password", [LoginController::class, "showForgotForm"])->name("password.request");
    Route::post("/forgot-password", [LoginController::class, "sendResetLink"])->name("password.email");
    Route::get("/reset-password/{token}", [LoginController::class, "showResetForm"])->name("password.reset");
    Route::post("/reset-password", [LoginController::class, "resetPassword"])->name("password.update");
});

Route::post("/logout", [LoginController::class, "logout"])->name("logout")->middleware("auth");

Route::get("/dashboard", function () {
    return match (auth()->user()->role) {
        "admin"    => redirect("/admin/dashboard"),
        "petugas"  => redirect("/petugas/dashboard"),
        "pimpinan" => redirect("/pimpinan/dashboard"),
        "koperasi" => redirect("/koperasi-portal/dashboard"),
        "anggota"  => redirect("/anggota-portal/dashboard"),
        default    => abort(403),
    };
})->middleware("auth")->name("dashboard");

// ================= NOTIFIKASI =================
Route::middleware("auth")->group(function () {
    Route::get("/notifikasi", [NotifikasiController::class, "index"])->name("notifikasi.index");
    Route::get("/notifikasi/unread", [NotifikasiController::class, "unread"])->name("notifikasi.unread");
    Route::post("/notifikasi/read-all", [NotifikasiController::class, "readAll"])->name("notifikasi.readAll");
    Route::post("/notifikasi/{notifikasi}/read", [NotifikasiController::class, "read"])->name("notifikasi.read");
    Route::delete("/notifikasi/{notifikasi}", [NotifikasiController::class, "destroy"])->name("notifikasi.destroy");
    
    // API routes for auto-hide notifications
    Route::post("/api/notifications/auto-hide", [NotifikasiController::class, "autoHide"])->name("api.notifications.autoHide");
    Route::post("/api/notifications/{id}/read", [NotifikasiController::class, "markAsRead"])->name("api.notifications.markAsRead");
});

// ================= ADMIN ROUTES =================
Route::prefix("admin")->middleware(["auth","role:admin"])->name("admin.")->group(function () {
    Route::get("/dashboard", [AdminDashboard::class, "index"])->name("dashboard");
    Route::resource("koperasi", AdminKoperasi::class);
    Route::post("/koperasi/{koperasi}/verifikasi", [AdminKoperasi::class, "verifikasi"])->name("koperasi.verifikasi");
    Route::post("/koperasi/{koperasi}/toggle-status", [AdminKoperasi::class, "toggleStatus"])->name("koperasi.toggleStatus");
    Route::get("/koperasi/{koperasi}/dokumen", [AdminKoperasi::class, "dokumen"])->name("koperasi.dokumen");
    Route::get("/koperasi/{koperasi}/download-dokumen", [AdminKoperasi::class, "downloadDokumen"])->name("koperasi.download-dokumen");
    Route::get("/koperasi/{koperasi}/print-dokumen", [AdminKoperasi::class, "printDokumen"])->name("koperasi.print-dokumen");
    Route::get("/koperasi/{koperasi}/download-kartu", [AdminKoperasi::class, "downloadKartu"])->name("koperasi.download-kartu");
    Route::get("/koperasi/{koperasi}/download-sertifikat", [AdminKoperasi::class, "downloadSertifikat"])->name("koperasi.download-sertifikat");
    Route::post("/koperasi/{koperasi}/upload-dokumen", [AdminKoperasi::class, "uploadDokumen"])->name("koperasi.uploadDokumen");
    Route::delete("/koperasi/dokumen/{dokumen}", [AdminKoperasi::class, "hapusDokumen"])->name("koperasi.hapusDokumen");
    
    // Periode Bantuan Routes
    Route::resource("periode-bantuan", PeriodeBantuanController::class);
    Route::post("/periode-bantuan/{periodeBantuan}/toggle", [PeriodeBantuanController::class, "toggleStatus"])->name("periode-bantuan.toggle");
    
    // Pengumuman Routes - Custom routes harus sebelum resource
    Route::get("/pengumuman/{pengumuman}/download", [AdminPengumuman::class, "download"])->name("pengumuman.download");
    Route::post("/pengumuman/{pengumuman}/toggle", [AdminPengumuman::class, "toggle"])->name("pengumuman.toggle");
    Route::resource("pengumuman", AdminPengumuman::class);
    
    Route::resource("bantuan", AdminBantuan::class);
    Route::get("/penerima-bantuan", [AdminBantuan::class, "penerimaIndex"])->name("penerima-bantuan.index");
    Route::get("/penerima-bantuan/export", [AdminBantuan::class, "penerimaExport"])->name("penerima-bantuan.export");
    Route::get("/bantuan/{bantuan}/penerima", [AdminBantuan::class, "penerima"])->name("bantuan.penerima");
    Route::post("/bantuan/{bantuan}/tambah-penerima", [AdminBantuan::class, "tambahPenerima"])->name("bantuan.tambahPenerima");
    Route::put("/bantuan/penerima/{penerima}", [AdminBantuan::class, "updatePenerima"])->name("bantuan.updatePenerima");
    Route::delete("/bantuan/penerima/{penerima}", [AdminBantuan::class, "destroyPenerima"])->name("bantuan.destroyPenerima");
    Route::post("/bantuan/penerima/{penerima}/validasi", [AdminBantuan::class, "validasiPenerima"])->name("bantuan.validasiPenerima");
    Route::get("/bantuan/penerima/{penerima}/cetak-sk", [AdminBantuan::class, "cetakSk"])->name("bantuan.cetakSk");
    Route::resource("berita", AdminBerita::class)->parameters(["berita" => "berita"]);
    Route::post("/berita/{berita}/publish", [AdminBerita::class, "publish"])->name("berita.publish");
    
    // Galeri Routes
    Route::get("/galeri/foto", function () {
        $galeri = \App\Models\Galeri::where("tipe","foto")->paginate(8);
        return view("admin.galeri.index", compact("galeri"));
    })->name("admin.galeri.foto");
    Route::get("/galeri/video", function () {
        $galeri = \App\Models\Galeri::where("tipe","video")->paginate(8);
        return view("admin.galeri.index", compact("galeri"));
    })->name("admin.galeri.video");
    Route::resource("galeri", AdminGaleri::class);
    Route::resource("jadwal", AdminJadwal::class);
    Route::post("/jadwal/{jadwal}/status", [AdminJadwal::class, "updateStatus"])->name("jadwal.updateStatus");
    Route::resource("pelatihan", AdminPelatihan::class);
    Route::get("/pelatihan/{pelatihan}/peserta", [AdminPelatihan::class, "peserta"])->name("pelatihan.peserta");
    Route::put("/pelatihan/peserta/{pendaftaran}/status", [AdminPelatihan::class, "updateStatusPeserta"])->name("pelatihan.peserta.status");
    Route::get("/kontak", [AdminKontak::class, "index"])->name("kontak.index");
    Route::get("/kontak/create", [AdminKontak::class, "create"])->name("kontak.create");
    Route::post("/kontak", [AdminKontak::class, "store"])->name("kontak.store");
    Route::get("/kontak/{id}", [AdminKontak::class, "show"])->name("kontak.show");
    Route::delete("/kontak/{id}", [AdminKontak::class, "destroy"])->name("kontak.destroy");
    Route::resource("halaman-statis", AdminHalamanStatis::class);
    Route::resource("struktur", AdminStruktur::class);
    Route::get("/struktur-bagan", [AdminStruktur::class, "bagan"])->name("struktur.bagan");
    Route::post("/struktur-bagan", [AdminStruktur::class, "uploadBagan"])->name("struktur.bagan.upload");
    Route::delete("/struktur-bagan", [AdminStruktur::class, "hapusBagan"])->name("struktur.bagan.hapus");
    Route::get("/laporan", [AdminLaporan::class, "index"])->name("laporan.index");
    Route::get("/laporan/koperasi", [AdminLaporan::class, "koperasi"])->name("laporan.koperasi");
    Route::get("/laporan/koperasi/word", [AdminLaporan::class, "exportKoperasiWord"])->name("laporan.koperasi.word");
    Route::get("/laporan/koperasi/excel", [AdminLaporan::class, "exportKoperasiExcelWithFilter"])->name("laporan.koperasi.excel");
    Route::get("/laporan/bantuan", [AdminLaporan::class, "bantuan"])->name("laporan.bantuan");
    Route::get("/laporan/bantuan/{id}/detail", [AdminLaporan::class, "bantuanDetail"])->name("laporan.bantuan.detail");
    Route::get("/laporan/sertifikat", [AdminLaporan::class, "sertifikat"])->name("laporan.sertifikat");
    Route::get("/laporan/sertifikat/{koperasi}/cetak", [AdminLaporan::class, "cetakSertifikat"])->name("laporan.cetakSertifikat");
    Route::get("/laporan/export-pdf", [AdminLaporan::class, "exportPdf"])->name("laporan.exportPdf");
    Route::get("/laporan/export-excel", [AdminLaporan::class, "exportExcel"])->name("laporan.exportExcel");
    Route::get("/laporan/export-word", [AdminLaporan::class, "exportWord"])->name("laporan.exportWord");
    Route::get("/users", [AdminUser::class, "index"])->name("users.index");
    Route::get("/users/create", [AdminUser::class, "create"])->name("users.create");
    Route::post("/users", [AdminUser::class, "store"])->name("users.store");
    Route::get("/users/{user}", [AdminUser::class, "show"])->name("users.show");
    Route::get("/users/{user}/edit", [AdminUser::class, "edit"])->name("users.edit");
    Route::put("/users/{user}", [AdminUser::class, "update"])->name("users.update");
    Route::delete("/users/{user}", [AdminUser::class, "destroy"])->name("users.destroy");
    Route::post("/users/{user}/toggle-active", [AdminUser::class, "toggleActive"])->name("users.toggleActive");
    
    // Periode Pendaftaran Anggota
    Route::resource("periode-pendaftaran", PeriodePendaftaranController::class);
    Route::post("/periode-pendaftaran/{periodePendaftaran}/toggle", [PeriodePendaftaranController::class, "toggleStatus"])->name("periode-pendaftaran.toggle");
    
    Route::get("/activity-log", [AdminUser::class, "activityLog"])->name("users.activityLog");
    Route::get("/activity-log/{id}", [AdminUser::class, "activityLogDetail"])->name("users.activityLog.detail");
    Route::delete("/activity-log/{id}", [AdminUser::class, "activityLogDestroy"])->name("users.activityLog.destroy");
    Route::get("/profile", [AdminUser::class, "profile"])->name("profile");
    Route::put("/profile", [AdminUser::class, "updateProfile"])->name("profile.update");
    Route::get("/settings", [AdminSetting::class, "index"])->name("settings.index");
    Route::put("/settings", [AdminSetting::class, "update"])->name("settings.update");
    Route::resource("anggota", AnggotaController::class)->parameters(["anggota" => "anggota"]);
    Route::get("/anggota-verifikasi", [AnggotaController::class, "verifikasi"])->name("anggota.verifikasi");
    Route::get("/anggota-dokumen", [AnggotaController::class, "dokumen"])->name("anggota.dokumen");
    Route::get("/kartu-sertifikat", [AnggotaController::class, "kartuSertifikatList"])->name("kartu-sertifikat");
    Route::get("/anggota/{anggota}/sertifikat", [AnggotaController::class, "sertifikat"])->name("anggota.sertifikat");
    Route::get("/anggota/{anggota}/download-dokumen", [AnggotaController::class, "downloadDokumen"])->name("anggota.download-dokumen");
    Route::get("/anggota/{anggota}/print-dokumen", [AnggotaController::class, "printDokumen"])->name("anggota.print-dokumen");
    Route::get("/anggota/{anggota}/download-kartu", [AnggotaController::class, "downloadKartu"])->name("anggota.download-kartu");
    Route::get("/anggota/{anggota}/download-sertifikat", [AnggotaController::class, "downloadSertifikat"])->name("anggota.download-sertifikat");
    Route::put("/anggota/{anggota}/status", [AnggotaController::class, "updateStatus"])->name("anggota.status");
    Route::post("/simpanan", [SimpananController::class, "store"])->name("simpanan.store");
    Route::get("/pengajuan-bantuan", [\App\Http\Controllers\Admin\PengajuanBantuanController::class, "index"])->name("pengajuan-bantuan.index");
    Route::get("/pengajuan-bantuan/{pengajuan_bantuan}", [\App\Http\Controllers\Admin\PengajuanBantuanController::class, "show"])->name("pengajuan-bantuan.show");
    Route::put("/pengajuan-bantuan/{pengajuan_bantuan}", [\App\Http\Controllers\Admin\PengajuanBantuanController::class, "update"])->name("pengajuan-bantuan.update");
    Route::delete("/pengajuan-bantuan/{pengajuan_bantuan}", [\App\Http\Controllers\Admin\PengajuanBantuanController::class, "destroy"])->name("pengajuan-bantuan.destroy");
    
    // Chat Routes
    Route::get("/chat", [\App\Http\Controllers\Admin\ChatController::class, "index"])->name("chat.index");
    Route::get("/chat/{userId}", [\App\Http\Controllers\Admin\ChatController::class, "show"])->name("chat.show");
    Route::post("/chat", [\App\Http\Controllers\Admin\ChatController::class, "store"])->name("chat.store");
    Route::put("/chat/{id}", [\App\Http\Controllers\Admin\ChatController::class, "update"])->name("chat.update");
    Route::delete("/chat/{id}", [\App\Http\Controllers\Admin\ChatController::class, "destroy"])->name("chat.destroy");
    Route::get("/chat-file/{id}/download", [\App\Http\Controllers\Admin\ChatController::class, "downloadFile"])->name("chat.download");
    Route::get("/chat-messages/{userId}", [\App\Http\Controllers\Admin\ChatController::class, "getMessages"])->name("chat.messages");
    Route::get("/chat-search", [\App\Http\Controllers\Admin\ChatController::class, "searchUsers"])->name("chat.search");
    
    // Izin Akses Routes
    Route::get("/izin-akses", [\App\Http\Controllers\Admin\IzinAksesController::class, "index"])->name("izin-akses.index");
    Route::get("/izin-akses/{role}/edit", [\App\Http\Controllers\Admin\IzinAksesController::class, "edit"])->name("izin-akses.edit");
    Route::put("/izin-akses/{role}", [\App\Http\Controllers\Admin\IzinAksesController::class, "update"])->name("izin-akses.update");
    Route::delete("/izin-akses/{role}/reset", [\App\Http\Controllers\Admin\IzinAksesController::class, "reset"])->name("izin-akses.reset");
    Route::get("/izin-akses/{role}/set-default", [\App\Http\Controllers\Admin\IzinAksesController::class, "setDefault"])->name("izin-akses.set-default");
    
    // System Settings Routes
    Route::get("/settings", [\App\Http\Controllers\Admin\SystemSettingController::class, "index"])->name("settings.index");
    Route::put("/settings", [\App\Http\Controllers\Admin\SystemSettingController::class, "update"])->name("settings.update");
    Route::get("/settings/reset", [\App\Http\Controllers\Admin\SystemSettingController::class, "reset"])->name("settings.reset");
});

// ================= PETUGAS ROUTES =================
Route::prefix("petugas")->middleware(["auth","role:petugas"])->name("petugas.")->group(function () {
    Route::get("/dashboard", [PetugasDashboard::class, "index"])->name("dashboard");
    Route::get("/profile", [PetugasDashboard::class, "profile"])->name("profile");
    Route::put("/profile", [PetugasDashboard::class, "updateProfile"])->name("profile.update");
    Route::resource("koperasi", PetugasKoperasi::class);
    Route::post("/koperasi/{koperasi}/verifikasi", [PetugasKoperasi::class, "verifikasi"])->name("koperasi.verifikasi");
    Route::post("/koperasi/{koperasi}/toggle-status", [PetugasKoperasi::class, "toggleStatus"])->name("koperasi.toggleStatus");
    Route::post("/koperasi/{koperasi}/upload-dokumen", [PetugasKoperasi::class, "uploadDokumen"])->name("koperasi.uploadDokumen");
    Route::resource("bantuan", PetugasBantuan::class);
    Route::get("/bantuan/{bantuan}/penerima", [PetugasBantuan::class, "penerima"])->name("bantuan.penerima");
    Route::post("/bantuan/{bantuan}/tambah-penerima", [PetugasBantuan::class, "tambahPenerima"])->name("bantuan.tambahPenerima");
    Route::post("/bantuan/penerima/{penerima}/validasi", [PetugasBantuan::class, "validasiPenerima"])->name("bantuan.validasiPenerima");
    Route::get("/bantuan/penerima/{penerima}/cetak-sk", [PetugasBantuan::class, "cetakSk"])->name("bantuan.cetakSk");
    Route::get("/bantuan/{bantuan}/konfirmasi", [PetugasBantuan::class, "konfirmasi"])->name("bantuan.konfirmasi");
    Route::post("/bantuan/penerima/{penerima}/konfirmasi", [PetugasBantuan::class, "konfirmasiPenyaluran"])->name("bantuan.konfirmasiPenyaluran");
    Route::resource("/jadwal", \App\Http\Controllers\Petugas\JadwalController::class);
    Route::post("/jadwal/{jadwal}/status", [\App\Http\Controllers\Petugas\JadwalController::class, "updateStatus"])->name("jadwal.updateStatus");
    
    // Anggota Routes
    Route::resource("anggota", \App\Http\Controllers\Petugas\AnggotaController::class)->parameters([
        'anggota' => 'anggota'
    ]);
    
    // Anggota Koperasi Routes (Gabungan Data Anggota & Koperasi)
    Route::resource("anggota-koperasi", \App\Http\Controllers\Petugas\AnggotaKoperasiController::class)->parameters([
        'anggota-koperasi' => 'anggotaKoperasi'
    ]);
    
    // Kartu & Sertifikat Routes
    Route::get("/kartu-sertifikat", [\App\Http\Controllers\Petugas\AnggotaController::class, "kartuSertifikatList"])->name("kartu-sertifikat");
    Route::get("/anggota/{anggota}/download-kartu", [\App\Http\Controllers\Petugas\AnggotaController::class, "downloadKartu"])->name("anggota.download-kartu");
    Route::get("/anggota/{anggota}/download-sertifikat", [\App\Http\Controllers\Petugas\AnggotaController::class, "downloadSertifikat"])->name("anggota.download-sertifikat");
    Route::get("/anggota/{anggota}/download-dokumen", [\App\Http\Controllers\Petugas\AnggotaController::class, "downloadDokumen"])->name("anggota.download-dokumen");
    Route::get("/anggota/{anggota}/print-dokumen", [\App\Http\Controllers\Petugas\AnggotaController::class, "printDokumen"])->name("anggota.print-dokumen");
    
    // Koperasi Kartu & Sertifikat Routes
    Route::get("/koperasi/{koperasi}/download-kartu", [PetugasKoperasi::class, "downloadKartu"])->name("koperasi.download-kartu");
    Route::get("/koperasi/{koperasi}/download-sertifikat", [PetugasKoperasi::class, "downloadSertifikat"])->name("koperasi.download-sertifikat");
    Route::get("/koperasi/{koperasi}/download-dokumen", [PetugasKoperasi::class, "downloadDokumen"])->name("koperasi.download-dokumen");
    Route::get("/koperasi/{koperasi}/print-dokumen", [PetugasKoperasi::class, "printDokumen"])->name("koperasi.print-dokumen");
    
    // Chat Routes
    Route::get("/chat", [\App\Http\Controllers\Petugas\ChatController::class, "index"])->name("chat.index");
    Route::get("/chat/{userId}", [\App\Http\Controllers\Petugas\ChatController::class, "show"])->name("chat.show");
    Route::post("/chat", [\App\Http\Controllers\Petugas\ChatController::class, "store"])->name("chat.store");
    Route::put("/chat/{id}", [\App\Http\Controllers\Petugas\ChatController::class, "update"])->name("chat.update");
    Route::delete("/chat/{id}", [\App\Http\Controllers\Petugas\ChatController::class, "destroy"])->name("chat.destroy");
    
    // Pengumuman Routes
    Route::get("/pengumuman/{pengumuman}/download", [\App\Http\Controllers\Petugas\PengumumanController::class, "download"])->name("pengumuman.download");
    Route::resource("/pengumuman", \App\Http\Controllers\Petugas\PengumumanController::class)->names([
        'index' => 'pengumuman.index',
        'create' => 'pengumuman.create',
        'store' => 'pengumuman.store',
        'show' => 'pengumuman.show',
        'edit' => 'pengumuman.edit',
        'update' => 'pengumuman.update',
        'destroy' => 'pengumuman.destroy',
    ]);
    
    // Berita Routes
    Route::resource("/berita", \App\Http\Controllers\Petugas\BeritaController::class)->names([
        'index' => 'berita.index',
        'create' => 'berita.create',
        'store' => 'berita.store',
        'show' => 'berita.show',
        'edit' => 'berita.edit',
        'update' => 'berita.update',
        'destroy' => 'berita.destroy',
    ]);
    
    // Galeri Routes
    Route::resource("/galeri", \App\Http\Controllers\Petugas\GaleriController::class);
    
    // Pelatihan Routes
    Route::resource("/pelatihan", \App\Http\Controllers\Petugas\PelatihanController::class);
    Route::get("/pelatihan/{pelatihan}/peserta", [\App\Http\Controllers\Petugas\PelatihanController::class, "peserta"])->name("pelatihan.peserta");
    Route::post("/pelatihan/{pelatihan}/tambah-peserta", [\App\Http\Controllers\Petugas\PelatihanController::class, "tambahPeserta"])->name("pelatihan.tambahPeserta");
    Route::delete("/pelatihan/peserta/{peserta}", [\App\Http\Controllers\Petugas\PelatihanController::class, "hapusPeserta"])->name("pelatihan.hapusPeserta");
    Route::get("/pelatihan/{pelatihan}/cetak-sertifikat/{peserta}", [\App\Http\Controllers\Petugas\PelatihanController::class, "cetakSertifikat"])->name("pelatihan.cetakSertifikat");
    
    // Laporan Routes
    Route::get("/laporan", [\App\Http\Controllers\Petugas\LaporanController::class, "index"])->name("laporan.index");
    Route::get("/laporan/koperasi", [\App\Http\Controllers\Petugas\LaporanController::class, "koperasi"])->name("laporan.koperasi");
    Route::get("/laporan/anggota", [\App\Http\Controllers\Petugas\LaporanController::class, "anggota"])->name("laporan.anggota");
    Route::get("/laporan/bantuan", [\App\Http\Controllers\Petugas\LaporanController::class, "bantuan"])->name("laporan.bantuan");
    Route::get("/laporan/pelatihan", [\App\Http\Controllers\Petugas\LaporanController::class, "pelatihan"])->name("laporan.pelatihan");
    Route::get("/laporan/export-pdf", [\App\Http\Controllers\Petugas\LaporanController::class, "exportPdf"])->name("laporan.exportPdf");
    Route::get("/laporan/export-excel", [\App\Http\Controllers\Petugas\LaporanController::class, "exportExcel"])->name("laporan.exportExcel");
    
    // User Routes
    Route::resource("/user", \App\Http\Controllers\Petugas\UserController::class);
    Route::post("/user/{user}/toggle-status", [\App\Http\Controllers\Petugas\UserController::class, "toggleStatus"])->name("user.toggleStatus");
    Route::post("/user/{user}/reset-password", [\App\Http\Controllers\Petugas\UserController::class, "resetPassword"])->name("user.resetPassword");
    
    // Setting Routes
    Route::get("/settings", [\App\Http\Controllers\Petugas\SettingController::class, "index"])->name("settings.index");
    Route::post("/settings/update-theme", [\App\Http\Controllers\Petugas\SettingController::class, "updateTheme"])->name("settings.update-theme");
    Route::get("/setting", [\App\Http\Controllers\Petugas\SettingController::class, "index"])->name("setting.index");
    Route::put("/setting", [\App\Http\Controllers\Petugas\SettingController::class, "update"])->name("setting.update");
    
    // Kontak Routes
    Route::resource("/kontak", \App\Http\Controllers\Petugas\KontakController::class)->only(['index', 'show', 'destroy']);
    Route::post("/kontak/{kontak}/balas", [\App\Http\Controllers\Petugas\KontakController::class, "balas"])->name("kontak.balas");
    Route::post("/kontak/{kontak}/mark-read", [\App\Http\Controllers\Petugas\KontakController::class, "markAsRead"])->name("kontak.markAsRead");
    
    // Struktur Organisasi Routes
    Route::resource("/struktur", \App\Http\Controllers\Petugas\StrukturController::class);
    Route::post("/struktur/reorder", [\App\Http\Controllers\Petugas\StrukturController::class, "reorder"])->name("struktur.reorder");
    
    // Halaman Statis Routes
    Route::resource("/halaman-statis", \App\Http\Controllers\Petugas\HalamanStatisController::class);
    Route::post("/halaman-statis/{halamanStatis}/toggle-status", [\App\Http\Controllers\Petugas\HalamanStatisController::class, "toggleStatus"])->name("halaman-statis.toggleStatus");
    
    // Activity Log Routes
    Route::get("/activity-log", [\App\Http\Controllers\Petugas\ActivityLogController::class, "index"])->name("activity-log.index");
    Route::get("/activity-log/{id}", [\App\Http\Controllers\Petugas\ActivityLogController::class, "show"])->name("activity-log.show");
    Route::delete("/activity-log/{id}", [\App\Http\Controllers\Petugas\ActivityLogController::class, "destroy"])->name("activity-log.destroy");
    Route::delete("/activity-log-all/delete", [\App\Http\Controllers\Petugas\ActivityLogController::class, "deleteAll"])->name("activity-log.deleteAll");
});

// ================= PIMPINAN ROUTES =================
Route::prefix("pimpinan")->middleware(["auth","role:pimpinan"])->name("pimpinan.")->group(function () {
    Route::get("/dashboard", [PimpinanDashboard::class, "index"])->name("dashboard");
    Route::get("/koperasi", [PimpinanDashboard::class, "koperasi"])->name("koperasi");
    Route::get("/koperasi/{koperasi}", [PimpinanDashboard::class, "showKoperasi"])->name("koperasi.show");
    
    // Anggota Koperasi Routes - CRUD lengkap
    Route::get("/anggota-koperasi", [\App\Http\Controllers\Pimpinan\AnggotaKoperasiController::class, "index"])->name("anggota-koperasi.index");
    Route::get("/anggota-koperasi/create", [\App\Http\Controllers\Pimpinan\AnggotaKoperasiController::class, "create"])->name("anggota-koperasi.create");
    Route::post("/anggota-koperasi", [\App\Http\Controllers\Pimpinan\AnggotaKoperasiController::class, "store"])->name("anggota-koperasi.store");
    Route::get("/anggota-koperasi/{id}/edit", [\App\Http\Controllers\Pimpinan\AnggotaKoperasiController::class, "edit"])->name("anggota-koperasi.edit");
    Route::put("/anggota-koperasi/{id}", [\App\Http\Controllers\Pimpinan\AnggotaKoperasiController::class, "update"])->name("anggota-koperasi.update");
    Route::delete("/anggota-koperasi/{id}", [\App\Http\Controllers\Pimpinan\AnggotaKoperasiController::class, "destroy"])->name("anggota-koperasi.destroy");
    Route::get("/anggota-koperasi/{id}", [\App\Http\Controllers\Pimpinan\AnggotaKoperasiController::class, "show"])->name("anggota-koperasi.show");
    
    Route::get("/laporan", [PimpinanLaporan::class, "index"])->name("laporan.index");
    Route::get("/laporan/koperasi", [PimpinanLaporan::class, "koperasi"])->name("laporan.koperasi");
    // Export routes MUST come before {id} route to avoid route conflict
    Route::get("/laporan/koperasi/export/word", [PimpinanLaporan::class, "exportKoperasiWord"])->name("laporan.koperasi.word");
    Route::get("/laporan/koperasi/export/excel", [PimpinanLaporan::class, "exportKoperasiExcel"])->name("laporan.koperasi.excel");
    Route::get("/laporan/koperasi/export/pdf", [PimpinanLaporan::class, "exportKoperasiPdf"])->name("laporan.koperasi.pdf");
    Route::get("/laporan/koperasi/{id}", [PimpinanLaporan::class, "koperasiDetail"])->name("laporan.koperasi.detail");
    Route::get("/laporan/anggota", [PimpinanLaporan::class, "anggota"])->name("laporan.anggota");
    // Export routes MUST come before {id} route to avoid route conflict
    Route::get("/laporan/anggota/export/word", [PimpinanLaporan::class, "exportAnggotaWord"])->name("laporan.anggota.word");
    Route::get("/laporan/anggota/export/excel", [PimpinanLaporan::class, "exportAnggotaExcel"])->name("laporan.anggota.excel");
    Route::get("/laporan/anggota/{id}", [PimpinanLaporan::class, "anggotaDetail"])->name("laporan.anggota.detail");
    
    // Bantuan routes - CRUD routes must come before {id} route
    Route::get("/laporan/bantuan/create", [PimpinanLaporan::class, "bantuanCreate"])->name("laporan.bantuan.create");
    Route::post("/laporan/bantuan", [PimpinanLaporan::class, "bantuanStore"])->name("laporan.bantuan.store");
    Route::get("/laporan/bantuan/{id}/edit", [PimpinanLaporan::class, "bantuanEdit"])->name("laporan.bantuan.edit");
    Route::put("/laporan/bantuan/{id}", [PimpinanLaporan::class, "bantuanUpdate"])->name("laporan.bantuan.update");
    Route::get("/laporan/bantuan", [PimpinanLaporan::class, "bantuan"])->name("laporan.bantuan");
    Route::get("/laporan/bantuan/{id}", [PimpinanLaporan::class, "bantuanDetail"])->name("laporan.bantuan.detail");
    Route::delete("/laporan/bantuan/{id}", [PimpinanLaporan::class, "bantuanDelete"])->name("laporan.bantuan.delete");
    
    Route::get("/laporan/export-pdf", [PimpinanLaporan::class, "exportPdf"])->name("laporan.exportPdf");
    Route::get("/laporan/export-excel", [PimpinanLaporan::class, "exportExcel"])->name("laporan.exportExcel");
    Route::get("/jadwal", [\App\Http\Controllers\Pimpinan\DashboardController::class, "jadwal"])->name("jadwal.index");
    Route::get("/activity-log", [PimpinanDashboard::class, "activityLog"])->name("activity.log");
    Route::get("/activity-log/{id}/detail", [PimpinanDashboard::class, "activityLogDetail"])->name("activity.log.detail");
    Route::delete("/activity-log/{id}", [PimpinanDashboard::class, "activityLogDelete"])->name("activity.log.delete");
    Route::post("/activity-log/delete-all", [PimpinanDashboard::class, "activityLogDeleteAll"])->name("activity.log.deleteAll");
    
    // Chat Routes
    Route::get("/chat", [\App\Http\Controllers\Pimpinan\ChatController::class, "index"])->name("chat.index");
    Route::post("/chat/send", [\App\Http\Controllers\Pimpinan\ChatController::class, "send"])->name("chat.send");
    Route::get("/chat/messages/{userId}", [\App\Http\Controllers\Pimpinan\ChatController::class, "getMessages"])->name("chat.messages");
    Route::put("/chat/update/{id}", [\App\Http\Controllers\Pimpinan\ChatController::class, "update"])->name("chat.update");
    Route::delete("/chat/delete/{id}", [\App\Http\Controllers\Pimpinan\ChatController::class, "delete"])->name("chat.delete");
    
    Route::get("/profile", [PimpinanDashboard::class, "profile"])->name("profile");
    Route::put("/profile", [PimpinanDashboard::class, "updateProfile"])->name("profile.update");
    
    // Settings Routes
    Route::get("/settings", [\App\Http\Controllers\Pimpinan\SettingController::class, "index"])->name("settings.index");
    Route::post("/settings/update-theme", [\App\Http\Controllers\Pimpinan\SettingController::class, "updateTheme"])->name("settings.update-theme");
});

// ================= KOPERASI PORTAL =================
Route::middleware(["auth","role:koperasi"])->prefix("koperasi-portal")->name("koperasi.")->group(function () {
    Route::get('/daftar', [App\Http\Controllers\Koperasi\DashboardController::class, 'daftar'])->name('daftar');
    Route::get("/dashboard", [KoperasiDashboard::class, "index"])->name("dashboard");
    Route::get("/profile", [KoperasiProfile::class, "show"])->name("profile");
    Route::put("/profile", [KoperasiProfile::class, "update"])->name("profile.update");
    Route::post("/profile/upload-dokumen", [KoperasiProfile::class, "uploadDokumen"])->name("profile.uploadDokumen");
    Route::get("/bantuan", [KoperasiBantuan::class, "index"])->name("bantuan.index");
    Route::get("/bantuan/{bantuan}", [KoperasiBantuan::class, "show"])->name("bantuan.show");
    Route::get("/riwayat", [KoperasiBantuan::class, "riwayat"])->name("bantuan.riwayat");
    Route::get("/jadwal", [KoperasiBantuan::class, "jadwal"])->name("bantuan.jadwal");
    Route::get("/pengajuan-bantuan", [KoperasiBantuan::class, "pengajuan"])->name("bantuan.pengajuan");
    Route::post("/pengajuan-bantuan", [KoperasiBantuan::class, "pengajuanStore"])->name("bantuan.pengajuan.store");
    Route::get("/notifikasi", [KoperasiDashboard::class, "notifikasi"])->name("notifikasi");
    Route::post("/notifikasi/{notifikasi}/read", [KoperasiDashboard::class, "readNotifikasi"])->name("notifikasi.read");
    Route::get("/chat", [\App\Http\Controllers\Koperasi\ChatController::class, "index"])->name("chat.index");
    Route::get("/chat/{userId}", [\App\Http\Controllers\Koperasi\ChatController::class, "show"])->name("chat.show");
    Route::post("/chat", [\App\Http\Controllers\Koperasi\ChatController::class, "store"])->name("chat.store");
    Route::put("/chat/{id}", [\App\Http\Controllers\Koperasi\ChatController::class, "update"])->name("chat.update");
    Route::delete("/chat/{id}", [\App\Http\Controllers\Koperasi\ChatController::class, "destroy"])->name("chat.destroy");
});

// ================= ANGGOTA =================
Route::get("/anggota/{anggota}/print", [AnggotaController::class, "print"])->name("anggota.print");
// Portal Anggota
Route::middleware(['auth','role:anggota'])->prefix('anggota-portal')->name('anggota.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'dashboard'])->name('dashboard');
    Route::get('/kartu', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'kartu'])->name('kartu');
    Route::get('/profil', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'profil'])->name('profil');
    Route::put('/profil', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'profilUpdate'])->name('profil.update');
    Route::get('/pengumuman', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'pengumuman'])->name('pengumuman');
    Route::get('/jadwal', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'jadwal'])->name('jadwal');
    Route::get('/jadwal/{id}/detail', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'jadwalDetail'])->name('jadwal.detail');
    
    // Kebutuhan Bantuan
    Route::get('/kebutuhan-bantuan', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'kebutuhanBantuan'])->name('kebutuhan-bantuan');
    Route::post('/kebutuhan-bantuan', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'kebutuhanBantuanStore'])->name('kebutuhan-bantuan.store');
    
    // Lengkapi Data (untuk anggota yang ditolak)
    Route::get('/lengkapi-data', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'lengkapiData'])->name('lengkapi-data');
    Route::post('/lengkapi-data', [App\Http\Controllers\Anggota\PortalAnggotaController::class, 'lengkapiDataUpdate'])->name('lengkapi-data.update');
    
    // Chat Routes
    Route::get('/chat', [App\Http\Controllers\Anggota\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{adminId}', [App\Http\Controllers\Anggota\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat', [App\Http\Controllers\Anggota\ChatController::class, 'store'])->name('chat.store');
    Route::put('/chat/{id}', [App\Http\Controllers\Anggota\ChatController::class, 'update'])->name('chat.update');
    Route::delete('/chat/{id}', [App\Http\Controllers\Anggota\ChatController::class, 'destroy'])->name('chat.destroy');
    Route::get('/chat-file/{id}/view', [App\Http\Controllers\Anggota\ChatController::class, 'viewFile'])->name('chat.file.view');
    Route::get('/chat-file/{id}/download', [App\Http\Controllers\Anggota\ChatController::class, 'downloadFile'])->name('chat.file.download');
});

// Dokumen Anggota
Route::get('/admin/anggota-dokumen', [App\Http\Controllers\Admin\AnggotaController::class, 'dokumen'])->name('admin.anggota.dokumen')->middleware(['auth','role:admin']);
