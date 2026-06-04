<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HalamanStatis extends Model {
    protected $table = 'halaman_statis';
    protected $fillable = ['slug','judul','konten','gambar','icon','status'];
}
