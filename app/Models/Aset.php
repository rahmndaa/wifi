<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'aset';
    protected $primaryKey = 'id_aset';
    public $timestamps = true;

    protected $fillable = [
        'nama_aset',
        'tipe_aset',
        'merk',
        'status_aset',
        'id_pelanggan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
