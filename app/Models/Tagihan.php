<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    public $timestamps = false;

    protected $fillable = [
        'id_pelanggan',
        'periode_tahun',
        'periode_bulan',
        'status',
        'total_tagihan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
    public function paketwifi()
    {
        return $this->belongsTo(PaketWifi::class, 'id_paket');
    }
    public function pembayaran()
    {
    return $this->hasOne(\App\Models\Pembayaran::class, 'id_tagihan');
    }
    
}
