<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perans')->insert([
            'kode_peran' => 'ADMN',
            'nama_peran' => 'Front Desk (Admin)'
        ]);
        DB::table('perans')->insert([
            'kode_peran' => 'KBKL',
            'nama_peran' => 'Kepala Bengkel'
        ]);
        DB::table('perans')->insert([
            'kode_peran' => 'KGDG',
            'nama_peran' => 'Kepala Gudang'
        ]);
    }
}
