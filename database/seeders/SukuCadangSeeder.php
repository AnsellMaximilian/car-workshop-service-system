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
            'nama' => 'Pipa Axeon',
            'harga' => 220000,
            'stok_awal' => 15
        ]);

        DB::table('suku_cadangs')->insert([
            'nama' => 'Stinger',
            'harga' => 250000,
            'stok_awal' =>15
        ]);
    }
}
