<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'pesan',
        'file',
        'original_filename',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'integer',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke pengirim
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    // Relasi ke penerima
    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    // Scope untuk chat antara 2 user
    public function scopeBetween($query, $user1, $user2)
    {
        return $query->where(function($q) use ($user1, $user2) {
            $q->where('pengirim_id', $user1)
              ->where('penerima_id', $user2);
        })->orWhere(function($q) use ($user1, $user2) {
            $q->where('pengirim_id', $user2)
              ->where('penerima_id', $user1);
        });
    }

    // Scope untuk pesan yang belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
