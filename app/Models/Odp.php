<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odp extends Model
{
    protected $table = 'odps';
    protected $primaryKey = 'id_odp';
    protected $guarded = [];

    // ODP milik 1 ODC
    public function odc()
    {
        return $this->belongsTo(Odc::class, 'id_odc', 'id_odc');
    }

    // 1 ODP memiliki banyak Pelanggan
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_odp', 'id_odp');
    }
}