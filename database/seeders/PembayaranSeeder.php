<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('pembayaran')->insert([
            ['id_tagihan' => 2, 'metode_pembayaran' => 'transfer', 'bukti_transfer' => 'bukti_transfer_001.jpg'],
        ]);
    }
}
