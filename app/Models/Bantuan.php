<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $table = 'bantuan';
    protected $fillable = [
        'kode_bantuan','nama_bantuan','jenis_bantuan','tahun','periode',
        'deskripsi','anggaran','kuota','status','created_by',
    ];
    protected $casts = ['anggaran' => 'decimal:2'];

    public function createdBy()     { return $this->belongsTo(User::class, 'created_by'); }
    public function penerima()      { return $this->hasMany(PenerimaBantuan::class); }
    public function jadwal()        { return $this->hasMany(JadwalDistribusi::class); }

    public function getJumlahPenerimaAttribute(): int
    {
        return $this->penerima()->where('status','diterima')->count();
    }

    public static function generateKode(): string
    {
        $year = date('Y');
        $count = static::whereYear('created_at', $year)->count() + 1;
        return 'BNT-' . $year . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}