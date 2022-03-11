<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SukuCadangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suku_cadangs')->insert([
            'nama' => 'Compressor',
            'harga' => 3000000,
            'stok_awal' => 15
        ]);

        DB::table('suku_cadangs')->insert([
            'nama' => 'Flushing',
            'harga' => 200000,
            'stok_awal' => 15
        ]);

        DB::table('suku_cadangs')->insert([
            'nama' => 'Ganti Oli',
            'harga' => 100000,
            'stok_awal' =>15
        ]);
    }
}
