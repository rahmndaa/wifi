<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komplain extends Model
{
    use HasFactory;

    protected $table = 'komplain';
    protected $primaryKey = 'id_komplain'; // Sesuaikan dengan nama kolom primary key di migrasi
    public $timestamps = false;

    protected $fillable = [
        'id_pelanggan',
        'deskripsi',
        'tanggal_komplain',
        'status',
        'tanggal_komplain_selesai',
        'bukti_komplain',
        'balasan_admin',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
