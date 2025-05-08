<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWifi extends Model
{
    use HasFactory;
    
    protected $table = 'paket_wifi';
    protected $primaryKey = 'id_paket';
    public $timestamps = false;

    protected $fillable = ['nama_paket', 'kecepatan', 'harga'];

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_paket');
    }
    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_paket');
    }
}
