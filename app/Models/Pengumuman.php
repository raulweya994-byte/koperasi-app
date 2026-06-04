<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = [
        'judul','isi','tanggal','hari','jam','tahun','pembuat',
        'jenis','tampil_di','is_aktif',
        'mulai_tampil','selesai_tampil','link',
        'foto','video','jenis_video','urutan','user_id'
    ];
    protected $casts = [
        'is_aktif'       => 'boolean',
        'mulai_tampil'   => 'datetime',
        'selesai_tampil' => 'datetime',
    ];

    public function user() { return $this->belongsTo(User::class); }

    public function scopeAktif($q) {
        return $q->where('is_aktif', true)
            ->where(function($q){ $q->whereNull('mulai_tampil')->orWhere('mulai_tampil','<=',now()); })
            ->where(function($q){ $q->whereNull('selesai_tampil')->orWhere('selesai_tampil','>=',now()); })
            ->orderBy('urutan');
    }

    public function getYoutubeEmbedAttribute() {
        if(!$this->video) return null;
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/', $this->video, $m);
        return isset($m[1]) ? 'https://www.youtube.com/embed/'.$m[1] : null;
    }
}
