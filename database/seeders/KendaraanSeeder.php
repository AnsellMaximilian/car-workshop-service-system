<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kendaraans')->insert([
            'no_plat' => 'B 333 CD',
            'pelanggan_id' => 1,
            'warna' => 'Merah',
            'tipe_id' => 1,
        ]);

        DB::table('kendaraans')->insert([
            'no_plat' => 'B 444 CD',
            'pelanggan_id' => 2,
            'warna' => 'Biru',
            'tipe_id' => 2,
        ]);

        DB::table('kendaraans')->insert([
            'no_plat' => 'B 666 CD',
            'pelanggan_id' => 1,
            'warna' => 'Kuning',
            'tipe_id' => 3,
        ]);

        DB::table('kendaraans')->insert([
            'no_plat' => 'B 777 CD',
            'pelanggan_id' => 2,
            'warna' => 'Pink',
            'tipe_id' => 4,
        ]);
    }
}
