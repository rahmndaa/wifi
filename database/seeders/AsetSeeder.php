<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsetSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('aset')->insert([
            [
                'nama_aset' => 'Router TP-Link Archer C6',
                'tipe_aset' => 'Router',
                'merk' => 'TP-Link',
                'status_aset' => 'digunakan',
                'id_pelanggan' => 1, // diasumsikan pelanggan dengan ID 1 sudah ada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_aset' => 'Modem ZTE F670L',
                'tipe_aset' => 'Modem',
                'merk' => 'ZTE',
                'status_aset' => 'tersedia',
                'id_pelanggan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_aset' => 'Kabel Fiber Optik 100m',
                'tipe_aset' => 'Kabel',
                'merk' => null,
                'status_aset' => 'rusak',
                'id_pelanggan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
