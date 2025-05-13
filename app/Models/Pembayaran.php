<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';  
        protected $primaryKey = 'id_pembayaran';
    
        protected $fillable = [
            'id_tagihan',
            'metode_pembayaran',
            'bukti_transfer',
            'tanggal_bayar',
        ];

    public function tagihan()
    {
    return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }
  
}

