<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\PeriodePendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PendaftaranAnggotaController extends Controller
{
    public function landing()
    {
        // Ambil periode aktif untuk ditampilkan di banner
        $periode = PeriodePendaftaran::aktif()->first();
        
        // Ambil pengumuman terbaru terkait koperasi (5 pengumuman terakhir)
        $pengumuman = \App\Models\Pengumuman::where('is_aktif', true)
            ->where(function($query) {
                $query->whereNull('mulai_tampil')
                      ->orWhere('mulai_tampil', '<=', now());
            })
            ->where(function($query) {
                $query->whereNull('selesai_tampil')
                      ->orWhere('selesai_tampil', '>=', now());
            })
            ->latest()
            ->take(5)
            ->get();
        
        return view('public.pendaftaran-landing', compact('periode', 'pengumuman'));
    }

    public function index()
    {
        $periode = PeriodePendaftaran::aktif()->first();
        
        if (!$periode || !$periode->is_buka) {
            return view('public.pendaftaran-tutup', compact('periode'));
        }

        return view('public.pendaftaran-anggota', compact('periode'));
    }

    public function store(Request $request)
    {
        // Cek periode aktif
        $periode = PeriodePendaftaran::aktif()->first();
        
        if (!$periode || !$periode->is_buka) {
            return redirect()->back()->with('error', 'Pendaftaran sedang ditutup');
        }

        // Validasi dengan pesan error yang jelas
        $validated = $request->validate([
            // Identitas Pribadi
            'nik' => 'required|string|size:16|unique:anggotas,nik',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'required|in:Lajang,Menikah,Cerai',
            'pendidikan_terakhir' => 'required|string',
            'agama' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            
            // Alamat
            'desa' => 'nullable|string|max:100',
            'distrik' => 'required|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'alamat_lengkap' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'koordinat_gps' => 'nullable|string|max:100',
            'status_kepemilikan_rumah' => 'nullable|in:Milik Sendiri,Sewa,Ikut Orang Tua,Kontrak',
            
            // Usaha
            'nama_usaha' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:100',
            'lama_berdiri_usaha' => 'nullable|integer|min:0',
            'jumlah_karyawan' => 'nullable|integer|min:0',
            'modal_usaha' => 'nullable|numeric|min:0',
            'omzet_per_bulan' => 'nullable|numeric|min:0',
            'alamat_tempat_usaha' => 'nullable|string',
            'legalitas_usaha' => 'nullable|string|max:100',
            'keterangan_usaha' => 'nullable|string',
            
            // Keuangan (OPSIONAL - Bisa diisi nanti)
            'nama_bank' => 'nullable|string|max:100',
            'nomor_rekening' => 'nullable|string|max:50',
            'nama_pemilik_rekening' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:20',
            
            // Ahli Waris
            'nama_ahli_waris' => 'required|string|max:255',
            'hubungan_ahli_waris' => 'required|string|max:50',
            'no_hp_ahli_waris' => 'required|string|max:15',
            'nik_ahli_waris' => 'required|string|size:16',
            
            // Simpanan
            'simpanan_pokok' => 'nullable|numeric|min:0',
            'simpanan_wajib' => 'nullable|numeric|min:0',
            
            // Files
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            // Custom error messages - Data Pribadi
            'nik.required' => 'NIK wajib diisi',
            'nik.size' => 'NIK harus 16 digit',
            'nik.unique' => 'NIK sudah terdaftar. Jika ini adalah kesalahan, hubungi admin.',
            'nama.required' => 'Nama lengkap wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih',
            'status_perkawinan.in' => 'Status perkawinan tidak valid. Pilih: Lajang, Menikah, atau Cerai',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib dipilih',
            'agama.required' => 'Agama wajib dipilih',
            'no_hp.required' => 'Nomor HP/WhatsApp wajib diisi',
            'email.required' => 'Email wajib diisi untuk login',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar. Gunakan email lain atau login jika sudah punya akun.',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            
            // Alamat
            'distrik.required' => 'Distrik wajib dipilih',
            
            // Usaha
            'nama_usaha.required' => 'Nama usaha wajib diisi',
            'bidang_usaha.required' => 'Bidang usaha wajib dipilih',
            
            // Ahli Waris
            'nama_ahli_waris.required' => 'Nama ahli waris wajib diisi',
            'hubungan_ahli_waris.required' => 'Hubungan keluarga wajib dipilih',
            'no_hp_ahli_waris.required' => 'Nomor HP ahli waris wajib diisi',
            'nik_ahli_waris.required' => 'NIK ahli waris wajib diisi',
            'nik_ahli_waris.size' => 'NIK ahli waris harus 16 digit',
            
            // Foto
            'foto.required' => 'Foto diri wajib diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Foto harus format JPG, JPEG, atau PNG',
            'foto.max' => 'Ukuran foto maksimal 2MB',
        ]);

        DB::beginTransaction();
        try {
            // Generate nomor anggota yang UNIK dengan retry mechanism
            $maxAttempts = 10;
            $attempt = 0;
            $noAnggota = null;
            
            do {
                // Format: AGT + Tahun + Bulan + 4 digit urut
                $year = date('Y');
                $month = date('m');
                
                // Cari nomor terakhir di bulan ini
                $lastAnggota = Anggota::where('no_anggota', 'like', "AGT{$year}{$month}%")
                    ->orderBy('no_anggota', 'desc')
                    ->first();
                
                if ($lastAnggota) {
                    // Ambil 4 digit terakhir dan tambah 1
                    $lastNumber = (int)substr($lastAnggota->no_anggota, -4);
                    $nextNumber = $lastNumber + 1;
                } else {
                    // Mulai dari 1 jika belum ada di bulan ini
                    $nextNumber = 1;
                }
                
                $noAnggota = 'AGT' . $year . $month . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
                
                // Cek apakah nomor sudah ada
                $exists = Anggota::where('no_anggota', $noAnggota)->exists();
                $attempt++;
                
            } while ($exists && $attempt < $maxAttempts);
            
            // Jika masih duplicate setelah 10 kali coba, gunakan timestamp
            if ($exists) {
                $noAnggota = 'AGT' . date('YmdHis');
            }

            // Upload files
            $filePaths = [];
            if ($request->hasFile('foto')) {
                $filePaths['foto'] = $request->file('foto')->store('anggota', 'public');
            }

            // Create User Account dengan Email dan Password yang diinput user
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'], // Email yang diinput user
                'password' => Hash::make($validated['password']), // Password yang diinput user
                'role' => 'anggota',
            ]);

            // Hapus field yang tidak ada di tabel anggotas
            unset($validated['password']);
            unset($validated['password_confirmation']);
            unset($validated['email']); // Email sudah disimpan di tabel users

            // Set default values untuk field yang mungkin kosong
            $defaults = [
                'lama_berdiri_usaha' => $validated['lama_berdiri_usaha'] ?? 0,
                'jumlah_karyawan' => $validated['jumlah_karyawan'] ?? 0,
                'modal_usaha' => $validated['modal_usaha'] ?? 0,
                'omzet_per_bulan' => $validated['omzet_per_bulan'] ?? 0,
                'simpanan_pokok' => $validated['simpanan_pokok'] ?? 0,
                'simpanan_wajib' => $validated['simpanan_wajib'] ?? 0,
                'kabupaten' => $validated['kabupaten'] ?? 'Tolikara',
            ];

            // Merge defaults dengan validated data
            $validated = array_merge($defaults, $validated);

            // Hanya ambil field yang benar-benar ada di tabel anggotas
            $allowedFields = [
                'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'no_hp',
                'desa', 'distrik', 'kabupaten', 'alamat_lengkap', 'kode_pos', 'koordinat_gps',
                'status_kepemilikan_rumah', 'status_perkawinan', 'pendidikan_terakhir',
                'nama_usaha', 'bidang_usaha', 'lama_berdiri_usaha', 'jumlah_karyawan',
                'modal_usaha', 'omzet_per_bulan', 'alamat_tempat_usaha', 'legalitas_usaha',
                'keterangan_usaha', 'nama_bank', 'nomor_rekening', 'nama_pemilik_rekening', 'npwp',
                'nama_ahli_waris', 'hubungan_ahli_waris', 'no_hp_ahli_waris', 'nik_ahli_waris',
                'simpanan_pokok', 'simpanan_wajib'
            ];

            // Filter hanya field yang diizinkan
            $filteredData = [];
            foreach ($allowedFields as $field) {
                if (isset($validated[$field])) {
                    $filteredData[$field] = $validated[$field];
                }
            }

            // Create Anggota - STATUS PENDING (Menunggu Verifikasi Admin)
            $anggotaData = array_merge($filteredData, $filePaths, [
                'no_anggota' => $noAnggota,
                'periode_pendaftaran_id' => $periode->id,
                'user_id' => $user->id,
                'status' => 'Pending', // PENDING - Menunggu verifikasi admin
                'tanggal_bergabung' => now(), // Set tanggal bergabung saat pendaftaran
                'created_by' => null, // Pendaftaran mandiri
                'total_simpanan' => ($filteredData['simpanan_pokok'] ?? 0) + ($filteredData['simpanan_wajib'] ?? 0),
            ]);

            // Log data yang akan disimpan untuk debugging
            \Log::info('Pendaftaran Anggota - Data yang akan disimpan', [
                'no_anggota' => $noAnggota,
                'nik' => $anggotaData['nik'] ?? 'N/A',
                'nama' => $anggotaData['nama'] ?? 'N/A',
                'user_id' => $user->id,
                'data_keys' => array_keys($anggotaData),
            ]);

            $anggota = Anggota::create($anggotaData);

            // Update jumlah pendaftar
            $periode->increment('jumlah_pendaftar');

            DB::commit();

            // AUTO-LOGIN setelah pendaftaran berhasil
            auth()->login($user);

            // Redirect ke dashboard anggota (langsung masuk)
            return redirect()->route('anggota.dashboard')
                ->with([
                    'success' => 'Selamat! Pendaftaran Anda berhasil dengan nomor anggota: ' . $noAnggota . '. Silakan tunggu verifikasi dari admin.',
                    'welcome' => true,
                    'no_anggota' => $noAnggota,
                    'status_pending' => true,
                ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error - Laravel akan handle otomatis dengan redirect back
            throw $e;
            
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            
            // Log error detail untuk debugging
            \Log::error('Pendaftaran Anggota - Database Error', [
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage(),
                'sql' => $e->getSql() ?? 'N/A',
                'bindings' => $e->getBindings() ?? [],
            ]);
            
            // Tangani error duplicate entry
            if ($e->getCode() == 23000) {
                $errorMessage = $e->getMessage();
                
                if (strpos($errorMessage, 'nik') !== false || strpos($errorMessage, 'Duplicate entry') !== false && strpos($errorMessage, 'nik') !== false) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['nik' => 'NIK yang Anda masukkan sudah terdaftar. Silakan gunakan NIK yang berbeda atau hubungi admin jika ini adalah kesalahan.'])
                        ->with('error', 'NIK yang Anda masukkan sudah terdaftar.');
                        
                } elseif (strpos($errorMessage, 'email') !== false || strpos($errorMessage, 'users_email_unique') !== false) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['email' => 'Email yang Anda masukkan sudah terdaftar. Silakan gunakan email yang berbeda atau login jika Anda sudah memiliki akun.'])
                        ->with('error', 'Email yang Anda masukkan sudah terdaftar.');
                        
                } elseif (strpos($errorMessage, 'no_anggota') !== false) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan sistem dalam generate nomor anggota. Silakan coba lagi dalam beberapa saat.');
                        
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Data yang Anda masukkan sudah terdaftar. Silakan periksa kembali NIK dan Email Anda. Detail: ' . $errorMessage);
                }
            }
            
            // Error lainnya
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan database: ' . $e->getMessage() . '. Silakan coba lagi atau hubungi administrator.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log error untuk debugging
            \Log::error('Pendaftaran Anggota - General Error', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memproses pendaftaran: ' . $e->getMessage() . '. Silakan coba lagi atau hubungi administrator.');
        }
    }

    public function success()
    {
        if (!session('success')) {
            return redirect()->route('pendaftaran.landing');
        }

        return view('public.pendaftaran-success');
    }
}
