<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odc extends Model
{
    protected $table = 'odcs';
    protected $primaryKey = 'id_odc';
    protected $guarded = [];

    // 1 ODC memiliki banyak ODP
    public function odps()
    {
        return $this->hasMany(Odp::class, 'id_odc', 'id_odc');
    }
}