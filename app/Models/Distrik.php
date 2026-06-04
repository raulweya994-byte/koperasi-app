<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Distrik extends Model
{
    protected $table = 'distrik';
    protected $fillable = ['kode', 'nama', 'ibu_kota'];

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function kampung()
    {
        return $this->hasMany(Kampung::class);
    }
}
