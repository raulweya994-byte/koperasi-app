<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaBantuan extends Model
{
    protected $table = 'penerima_bantuan';
    protected $fillable = [
        'bantuan_id','koperasi_id','tanggal_penerimaan','jumlah_bantuan',
        'status','catatan','validated_by','validated_at',
    ];
    protected $casts = [
        'tanggal_penerimaan' => 'date',
        'validated_at'       => 'datetime',
        'jumlah_bantuan'     => 'decimal:2',
    ];

    public function bantuan()    { return $this->belongsTo(Bantuan::class); }
    public function koperasi()       { return $this->belongsTo(Koperasi::class); }
    public function validatedBy(){ return $this->belongsTo(User::class, 'validated_by'); }
}