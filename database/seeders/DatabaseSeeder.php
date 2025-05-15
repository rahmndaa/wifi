<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            PaketWifiSeeder::class,
            PelangganSeeder::class,
            TagihanSeeder::class,
            PembayaranSeeder::class,
            KomplainSeeder::class,
            AsetSeeder::class,
        ]);
    }
}
