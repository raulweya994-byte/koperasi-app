<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul', 'slug', 'thumbnail', 'konten',
        'kategori', 'status', 'created_by', 'published_at', 'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Fix route model binding
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function generateSlug(string $judul): string
    {
        $slug = Str::slug($judul);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }
}