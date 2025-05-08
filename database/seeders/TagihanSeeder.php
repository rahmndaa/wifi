<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagihanSeeder extends Seeder
{
    public function run()
    {
        DB::table('tagihan')->insert([
            ['id_pelanggan' => 1, 'periode_tahun' => 2025, 'periode_bulan' => 3, 'status' => 'belum lunas', 'total_tagihan' => 100000.00],
            ['id_pelanggan' => 2, 'periode_tahun' => 2025, 'periode_bulan' => 3, 'status' => 'lunas', 'total_tagihan' => 250000.00],
        ]);
    }
}
