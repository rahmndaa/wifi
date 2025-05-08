<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KomplainSeeder extends Seeder
{
    public function run()
    {
        DB::table('komplain')->insert([
            [
                'id_pelanggan' => 1,
                'deskripsi' => 'Jaringan sering putus-putus.',
                'tanggal_komplain' => '2025-03-10',
                'status' => 'menunggu',
            ],
        ]);
    }
}
