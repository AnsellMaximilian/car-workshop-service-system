<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggans')->insert([
            'nama' => 'Robert Edwin House',
            'noTelp' => '088888',
            'email' => 'house@robco.com',
            'alamat' => 'Lucky 38, New Vegas'
        ]);

        DB::table('pelanggans')->insert([
            'nama' => 'Michael M. Scott',
            'noTelp' => '08844888',
            'email' => 'michael@dundermifflin.com',
            'alamat' => 'Dunder Mifflin, Scranton'
        ]);
    }
}
