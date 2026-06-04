<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = ['tipe','judul','deskripsi','foto','video_url','kategori','urutan','is_active','created_by'];
    protected $casts = ['is_active' => 'boolean'];
    
    // Relasi ke User (yang upload)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}