<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'id_paket', 
        'nama_pelanggan', 
        'username', 
        'password',
        'no_whatsapp', 
        'alamat',
        'tanggal_gabung', 
        'status_pelanggan'
    ];

    public function paketWifi()
    {
        return $this->belongsTo(PaketWifi::class, 'id_paket');
    }
    public function komplain()
    {
        return $this->hasMany(Komplain::class, 'id_pelanggan', 'id_pelanggan'); 
    }
    public function aset()
    {
        return $this->hasMany(Aset::class, 'id_pelanggan', 'id_pelanggan');
    }

}
