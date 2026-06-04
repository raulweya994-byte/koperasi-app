<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use App\Models\PeriodePendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller {

    public function index(Request $request) {
        $q = Anggota::query();
        if ($request->search) $q->where('nama','like',"%{$request->search}%")->orWhere('no_anggota','like',"%{$request->search}%");
        if ($request->status) $q->where('status',$request->status);
        if ($request->distrik) $q->where('distrik',$request->distrik);
        $anggota = $q->orderBy('created_at','desc')->paginate(15)->withQueryString();
        $distrik = Anggota::distinct()->pluck('distrik');
        $stats = [
            'total'    => Anggota::count(),
            'aktif'    => Anggota::where('status','Aktif')->count(),
            'pending'  => Anggota::where('status','Pending')->count(),
            'nonaktif' => Anggota::where('status','Nonaktif')->count(),
        ];
        return view('admin.anggota.index', compact('anggota','distrik','stats'));
    }

    public function create() {
        // Cek apakah ada periode pendaftaran yang aktif
        $periodeAktif = PeriodePendaftaran::getPeriodeAktif();
        
        if (!$periodeAktif) {
            // Jika tidak ada periode aktif, tampilkan halaman khusus
            return view('admin.anggota.pendaftaran-ditutup');
        }
        
        if ($periodeAktif->isKuotaPenuh()) {
            // Jika kuota penuh, tampilkan halaman khusus
            return view('admin.anggota.kuota-penuh', compact('periodeAktif'));
        }
        
        $no = Anggota::generateNoAnggota();
        return view('admin.anggota.create', compact('no', 'periodeAktif'));
    }

    public function store(Request $request) {
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
        
        $request->validate([
            'nik'          => 'required|unique:anggotas,nik|digits_between:15,16',
            'nama'         => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir'=> 'required|date',
            'no_hp'        => 'required',
            'distrik'      => 'required',
            'nama_usaha'   => 'required',
        ]);
        $d = $request->only(['nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','no_hp','email','desa','distrik','kabupaten','alamat_lengkap','nama_komplek_dekat_desa','nama_usaha','modal_usaha','omzet_per_bulan','total_simpanan','keterangan_usaha','status']);
        $d['no_anggota'] = Anggota::generateNoAnggota();
        $d['periode_pendaftaran_id'] = $periodeAktif->id;
        $d['tanggal_bergabung'] = now();
        if ($request->hasFile('foto')) $d['foto'] = $request->file('foto')->store('anggota','public');
        Anggota::create($d);
        return redirect()->route('admin.anggota.index')->with('success','Anggota berhasil ditambah!');
    }

    public function show(Anggota $anggota) {
        // Simpan URL sebelumnya ke session
        if (request()->headers->get('referer')) {
            session(['previous_url' => request()->headers->get('referer')]);
        }
        
        return view('admin.anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota) {
        // Simpan URL sebelumnya ke session
        if (request()->headers->get('referer')) {
            session(['previous_url' => request()->headers->get('referer')]);
        }
        
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota) {
        $request->validate([
            'nik'  => 'required|digits:16|unique:anggotas,nik,'.$anggota->id,
            'nama' => 'required',
        ]);
        
        // Simpan data lama untuk deteksi perubahan
        $dataLama = $anggota->only([
            'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
            'agama', 'no_hp', 'email', 'desa', 'distrik', 'kabupaten', 
            'alamat_lengkap', 'nama_komplek_dekat_desa', 'nama_usaha', 
            'modal_usaha', 'omzet_per_bulan', 'total_simpanan', 
            'keterangan_usaha', 'status', 'foto'
        ]);
        
        $d = $request->only(['nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','no_hp','email','desa','distrik','kabupaten','alamat_lengkap','nama_komplek_dekat_desa','nama_usaha','modal_usaha','omzet_per_bulan','total_simpanan','keterangan_usaha','status']);
        
        if ($request->hasFile('foto')) {
            if ($anggota->foto) Storage::disk('public')->delete($anggota->foto);
            $d['foto'] = $request->file('foto')->store('anggota','public');
        }
        
        // Update data anggota
        $anggota->update($d);
        
        // Deteksi perubahan dan kirim notifikasi
        $perubahanDetail = [];
        $labelField = [
            'nik' => 'NIK',
            'nama' => 'Nama Lengkap',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'no_hp' => 'No. HP',
            'email' => 'Email',
            'desa' => 'Desa',
            'distrik' => 'Distrik',
            'kabupaten' => 'Kabupaten',
            'alamat_lengkap' => 'Alamat Lengkap',
            'nama_komplek_dekat_desa' => 'Nama Komplek/Dekat Desa',
            'nama_usaha' => 'Nama Usaha',
            'modal_usaha' => 'Modal Usaha',
            'omzet_per_bulan' => 'Omzet Per Bulan',
            'total_simpanan' => 'Total Simpanan',
            'keterangan_usaha' => 'Keterangan Usaha',
            'status' => 'Status',
            'foto' => 'Foto Profil'
        ];
        
        foreach ($dataLama as $field => $nilaiLama) {
            $nilaiBaru = $d[$field] ?? $anggota->$field;
            
            // Skip jika tidak ada perubahan
            if ($nilaiLama == $nilaiBaru) continue;
            
            // Format nilai untuk tampilan
            $nilaiLamaFormatted = $nilaiLama;
            $nilaiBaruFormatted = $nilaiBaru;
            
            if (in_array($field, ['modal_usaha', 'omzet_per_bulan', 'total_simpanan'])) {
                $nilaiLamaFormatted = 'Rp ' . number_format($nilaiLama ?? 0, 0, ',', '.');
                $nilaiBaruFormatted = 'Rp ' . number_format($nilaiBaru ?? 0, 0, ',', '.');
            } elseif ($field === 'tanggal_lahir') {
                $nilaiLamaFormatted = $nilaiLama ? \Carbon\Carbon::parse($nilaiLama)->format('d M Y') : '-';
                $nilaiBaruFormatted = $nilaiBaru ? \Carbon\Carbon::parse($nilaiBaru)->format('d M Y') : '-';
            } elseif ($field === 'jenis_kelamin') {
                $nilaiLamaFormatted = $nilaiLama === 'L' ? 'Laki-laki' : 'Perempuan';
                $nilaiBaruFormatted = $nilaiBaru === 'L' ? 'Laki-laki' : 'Perempuan';
            } elseif ($field === 'foto') {
                $nilaiLamaFormatted = $nilaiLama ? 'Ada' : 'Tidak ada';
                $nilaiBaruFormatted = $nilaiBaru ? 'Diperbarui' : 'Tidak ada';
            }
            
            $perubahanDetail[] = [
                'field' => $labelField[$field] ?? $field,
                'lama' => $nilaiLamaFormatted ?: '-',
                'baru' => $nilaiBaruFormatted ?: '-'
            ];
        }
        
        // Kirim notifikasi jika ada perubahan dan anggota punya user_id
        if (count($perubahanDetail) > 0 && $anggota->user_id) {
            $perubahanText = '';
            $jumlahPerubahan = count($perubahanDetail);
            
            // Batasi detail perubahan maksimal 5 item di notifikasi
            $perubahanTampil = array_slice($perubahanDetail, 0, 5);
            
            foreach ($perubahanTampil as $perubahan) {
                $perubahanText .= "• {$perubahan['field']}: {$perubahan['lama']} → {$perubahan['baru']}\n";
            }
            
            if ($jumlahPerubahan > 5) {
                $perubahanText .= "• ... dan " . ($jumlahPerubahan - 5) . " perubahan lainnya\n";
            }
            
            $pesanNotifikasi = "Admin telah memperbarui data Anda:\n\n" . $perubahanText . "\nSilakan cek profil Anda untuk melihat detail lengkap.";
            
            \App\Models\Notifikasi::create([
                'user_id' => $anggota->user_id,
                'judul'   => '📝 Data Anda Diperbarui oleh Admin',
                'pesan'   => $pesanNotifikasi,
                'tipe'    => 'info',
                'link'    => route('anggota.profil'),
                'is_read' => false,
            ]);
            
            return redirect(session('previous_url', route('admin.anggota.index')))->with('success', 'Data anggota berhasil diperbarui dan notifikasi telah dikirim! (' . $jumlahPerubahan . ' perubahan)');
        }
        
        return redirect(session('previous_url', route('admin.anggota.index')))->with('success','Data anggota diperbarui!');
    }

    public function destroy(Anggota $anggota) {
        if ($anggota->foto) Storage::disk('public')->delete($anggota->foto);
        $anggota->delete();
        return redirect()->route('admin.anggota.index')->with('success','Anggota dihapus!');
    }

    public function sertifikat(Anggota $anggota, Request $request) {
        $type = $request->get('type', 'kartu'); // kartu atau sertifikat
        return view('admin.anggota.kartu-sertifikat', compact('anggota', 'type'));
    }
    
    public function downloadDokumen(Anggota $anggota) {
        // Generate HTML content
        $html = view('admin.anggota.dokumen-word', compact('anggota'))->render();
        
        // Set headers for Word download
        $filename = 'Dokumen_Anggota_' . str_replace(' ', '_', $anggota->nama) . '_' . $anggota->no_anggota . '.doc';
        
        return response($html)
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment;filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
    }
    
    public function printDokumen(Anggota $anggota) {
        // Return HTML view for printing (not download)
        return view('admin.anggota.dokumen-word', compact('anggota'));
    }
    
    public function downloadKartu(Anggota $anggota) {
        $type = 'kartu';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.anggota.kartu-sertifikat', compact('anggota', 'type'));
        $pdf->setPaper([0, 0, 242.65, 153], 'landscape'); // 85.6mm x 53.98mm in points
        
        $filename = 'Kartu_Anggota_' . str_replace(' ', '_', $anggota->nama) . '.pdf';
        return $pdf->download($filename);
    }
    
    public function downloadSertifikat(Anggota $anggota) {
        $type = 'sertifikat';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.anggota.kartu-sertifikat', compact('anggota', 'type'));
        $pdf->setPaper('a4', 'portrait'); // A4 Portrait untuk sertifikat 1 halaman
        
        $filename = 'Sertifikat_' . str_replace(' ', '_', $anggota->nama) . '.pdf';
        return $pdf->download($filename);
    }

    public function updateStatus(Request $request, Anggota $anggota) {
        $statusLama = $anggota->status;
        
        // Validasi input
        $request->validate([
            'status' => 'required|in:Aktif,Ditolak',
            'catatan_admin' => 'nullable|string|max:500'
        ]);
        
        // Jika DITOLAK - TIDAK HAPUS akun, hanya update status
        if ($request->status === 'Ditolak') {
            $alasanPenolakan = $request->catatan_admin ?? 'Data tidak sesuai persyaratan';
            
            // Update status anggota menjadi Ditolak (AKUN TETAP ADA)
            $anggota->update([
                'status' => 'Ditolak',
                'catatan_admin' => $alasanPenolakan,
                'tanggal_verifikasi' => now()
            ]);
            
            // Kirim notifikasi ke user - TIDAK LULUS (dengan link ke lengkapi data)
            if ($anggota->user_id) {
                \App\Models\Notifikasi::create([
                    'user_id' => $anggota->user_id,
                    'judul'   => '❌ Pendaftaran Tidak Disetujui',
                    'pesan'   => 'Mohon maaf, pendaftaran Anda belum dapat disetujui. Alasan: ' . $alasanPenolakan . '. Klik tombol "Lengkapi Data" di bawah untuk memperbaiki data Anda dan submit ulang.',
                    'tipe'    => 'warning',
                    'link'    => route('anggota.lengkapi-data'),
                    'is_read' => false,
                ]);
            }
            
            return back()->with('success', 'Pendaftaran ditolak. Notifikasi telah dikirim ke anggota. Anggota dapat melengkapi data dan submit ulang.');
        }
        
        // Jika DITERIMA - Update status menjadi Aktif (LULUS)
        if ($request->status === 'Aktif') {
            $catatan = $request->catatan_admin ?? 'Selamat! Pendaftaran Anda telah disetujui.';
            
            $anggota->update([
                'status' => 'Aktif',
                'catatan_admin' => $catatan,
                'tanggal_verifikasi' => now(),
                'tanggal_bergabung' => now(), // Set tanggal bergabung saat disetujui
            ]);
            
            // Kirim notifikasi ke user - LULUS
            if ($anggota->user_id) {
                $pesan = '🎉 Selamat! Pendaftaran Anda LULUS sebagai Anggota Koperasi. No. Anggota: ' . $anggota->no_anggota . '. Anda sekarang dapat mengakses semua layanan koperasi. Silakan cek kartu anggota Anda di dashboard.';
                
                \App\Models\Notifikasi::create([
                    'user_id' => $anggota->user_id,
                    'judul'   => '✅ Selamat! Pendaftaran Lulus',
                    'pesan'   => $pesan,
                    'tipe'    => 'success',
                    'link'    => route('anggota.dashboard'),
                    'is_read' => false,
                ]);
            }
            
            return back()->with('success', 'Pendaftaran DISETUJUI! Notifikasi telah dikirim ke anggota dengan No. Anggota: ' . $anggota->no_anggota);
        }
        
        return back()->with('error', 'Status tidak valid.');
    }


    public function dokumen(Request $request) {
        try {
            $q = Anggota::with('koperasi');
            
            // Filter pencarian
            if ($request->search) {
                $q->where(function($query) use ($request) {
                    $query->where('nama','like',"%{$request->search}%")
                          ->orWhere('no_anggota','like',"%{$request->search}%")
                          ->orWhere('nik','like',"%{$request->search}%");
                });
            }
            
            // Filter status dokumen
            if ($request->status) {
                if ($request->status == 'lengkap') {
                    $q->whereNotNull('foto_ktp')
                      ->whereNotNull('foto_kk')
                      ->whereNotNull('foto');
                } elseif ($request->status == 'tidak_lengkap') {
                    $q->whereNull('foto_ktp')
                      ->whereNull('foto_kk')
                      ->whereNull('foto');
                } elseif ($request->status == 'sebagian') {
                    $q->where(function($query) {
                        $query->whereNotNull('foto_ktp')
                              ->orWhereNotNull('foto_kk')
                              ->orWhereNotNull('foto');
                    })->where(function($query) {
                        $query->whereNull('foto_ktp')
                              ->orWhereNull('foto_kk')
                              ->orWhereNull('foto');
                    });
                }
            }
            
            $anggota = $q->orderBy('created_at','desc')->paginate(15)->withQueryString();
            
            // Statistik
            $totalAnggota = Anggota::count();
            $dokumenLengkap = Anggota::whereNotNull('foto_ktp')
                ->whereNotNull('foto_kk')
                ->whereNotNull('foto')
                ->count();
            $dokumenTidakLengkap = Anggota::whereNull('foto_ktp')
                ->whereNull('foto_kk')
                ->whereNull('foto')
                ->count();
            $dokumenSebagian = $totalAnggota - $dokumenLengkap - $dokumenTidakLengkap;
            
            return view('admin.anggota.dokumen', compact(
                'anggota', 
                'totalAnggota', 
                'dokumenLengkap', 
                'dokumenTidakLengkap', 
                'dokumenSebagian'
            ));
        } catch (\Exception $e) {
            \Log::error('Error di dokumen(): ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function verifikasi(Request $request) {
        $q = Anggota::query();
        if ($request->search) {
            $q->where('nama','like',"%{$request->search}%")
              ->orWhere('no_anggota','like',"%{$request->search}%");
        }
        if ($request->status) {
            $q->where('status', $request->status);
        }
        
        $anggota = $q->orderBy('created_at','desc')->paginate(12)->withQueryString();
        
        $stats = [
            'total'   => Anggota::count(),
            'pending' => Anggota::where('status','Pending')->count(),
            'aktif'   => Anggota::where('status','Aktif')->count(),
        ];
        
        return view('admin.anggota.verifikasi', compact('anggota', 'stats'));
    }
    
    public function print(Anggota $anggota, Request $request) {
        $type = $request->get('type', 'kartu');
        $judul = 'Kartu Anggota';
        $subJudul = $anggota->no_anggota;
        return view('admin.anggota.partials.Print', compact('anggota','type','judul','subJudul'));
    }
    
    public function kartuSertifikatList(Request $request) {
        try {
            // Query anggota dengan filter
            $query = Anggota::with('koperasi');
            
            // Filter pencarian
            if ($request->filled('search')) {
                $query->where(function($q) use ($request) {
                    $q->where('nama','like',"%{$request->search}%")
                      ->orWhere('no_anggota','like',"%{$request->search}%")
                      ->orWhere('nik','like',"%{$request->search}%");
                });
            }
            
            // Filter status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            
            // Filter distrik
            if ($request->filled('distrik')) {
                $query->where('distrik', $request->distrik);
            }
            
            // Urutkan berdasarkan terbaru
            $anggota = $query->orderBy('created_at','desc')->paginate(12)->withQueryString();
            
            // Daftar distrik untuk filter
            $distrik = Anggota::distinct()->pluck('distrik')->filter()->sort()->values();
            
            // Statistik
            $stats = [
                'total' => Anggota::count(),
                'aktif' => Anggota::where('status', 'Aktif')->count(),
                'pending' => Anggota::where('status', 'Pending')->count(),
            ];
            
            return view('admin.anggota.kartu-sertifikat-list', compact('anggota', 'distrik', 'stats'));
        } catch (\Exception $e) {
            \Log::error('Error in kartuSertifikatList: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
