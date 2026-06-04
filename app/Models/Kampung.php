<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kampung extends Model
{
    protected $table = 'kampung';
    protected $fillable = ['distrik_id', 'nama'];

    public function distrik()
    {
        return $this->belongsTo(Distrik::class);
    }
}
