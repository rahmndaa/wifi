<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketWifiSeeder extends Seeder
{
    public function run()
    {
        DB::table('paket_wifi')->insert([
            ['nama_paket' => 'Basic', 'kecepatan' => '10 Mbps', 'harga' => 100000.00],
            ['nama_paket' => 'Standard', 'kecepatan' => '50 Mbps', 'harga' => 250000.00],
            ['nama_paket' => 'Premium', 'kecepatan' => '100 Mbps', 'harga' => 300000.00]
        ]);
    }
}
