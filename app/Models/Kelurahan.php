<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $fillable = ['distrik_id', 'nama'];

    public function distrik()
    {
        return $this->belongsTo(Distrik::class);
    }
}
