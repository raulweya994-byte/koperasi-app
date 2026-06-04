<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model {
    protected $table = 'anggotas';
    protected $fillable = [
        'user_id','no_anggota','nik','no_ktp','nama','nama_lengkap','tempat_lahir','tanggal_lahir',
        'jenis_kelamin','agama','no_hp','email','desa','distrik','kabupaten',
        'alamat','alamat_lengkap','nama_komplek_dekat_desa','nama_usaha','modal_usaha',
        'omzet_per_bulan','total_simpanan','keterangan_usaha','foto','foto_ktp','status',
        'status_keanggotaan','catatan_admin','tanggal_verifikasi','koperasi_id','created_by',
        // Field baru
        'status_perkawinan','pendidikan_terakhir','pekerjaan','kode_pos','koordinat_gps',
        'status_kepemilikan_rumah','bidang_usaha','lama_berdiri_usaha',
        'jumlah_karyawan','alamat_tempat_usaha','legalitas_usaha',
        'nama_bank','nomor_rekening','nama_pemilik_rekening','npwp','nama_ibu_kandung',
        'nama_ahli_waris','hubungan_ahli_waris','no_hp_ahli_waris','nik_ahli_waris',
        'tanggal_bergabung','simpanan_pokok','simpanan_wajib',
        'foto_tanda_tangan','foto_kk','foto_lokasi_usaha','foto_selfie_ktp',
        'periode_pendaftaran_id'
    ];
    protected $casts = ['tanggal_lahir'=>'date','tanggal_verifikasi'=>'datetime'];

    public function user() { return $this->belongsTo(User::class); }
    public function periodePendaftaran() { return $this->belongsTo(PeriodePendaftaran::class); }
    public function koperasi() { return $this->belongsTo(Koperasi::class); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function simpanans() { return $this->hasMany(Simpanan::class); }



    public function getFotoUrlAttribute() {
        if (!$this->foto) {
            // Tidak ada foto, return placeholder
            return asset('images/no-photo.png');
        }
        
        // Cek berbagai kemungkinan path foto
        $possiblePaths = [
            // Path 1: storage/anggota/filename.jpg
            'storage/' . $this->foto,
            // Path 2: anggota/filename.jpg (sudah include folder)
            'storage/' . ltrim($this->foto, '/'),
            // Path 3: filename.jpg saja
            'storage/anggota/' . basename($this->foto),
        ];
        
        foreach ($possiblePaths as $path) {
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }
        
        // Jika file tidak ditemukan di public, cek di storage/app/public
        $storagePath = storage_path('app/public/' . ltrim($this->foto, '/'));
        if (file_exists($storagePath)) {
            return asset('storage/' . ltrim($this->foto, '/'));
        }
        
        // Default: Placeholder jika foto tidak ditemukan
        return asset('images/no-photo.png');
    }
    public function getUmurAttribute() {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : '-';
    }
    public static function generateNoAnggota() {
        $year = date('Y'); $month = date('m');
        $last = self::where('no_anggota','like',"AG{$year}{$month}%")->orderBy('no_anggota','desc')->first();
        $seq = $last ? (intval(substr($last->no_anggota,-4))+1) : 1;
        return "AG{$year}{$month}".str_pad($seq,4,'0',STR_PAD_LEFT);
    }
}
