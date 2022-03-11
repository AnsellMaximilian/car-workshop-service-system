<?php

namespace Database\Seeders;

use App\Models\Merk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipes')->insert([
            'tipe' => 'Prius',
            'merk_id' => Merk::where('merk', 'Toyota')->first()->id
        ]);
        DB::table('tipes')->insert([
            'tipe' => 'Atoz',
            'merk_id' => Merk::where('merk', 'Hyundai')->first()->id
        ]);
        DB::table('tipes')->insert([
            'tipe' => 'Grand Livina',
            'merk_id' => Merk::where('merk', 'Nissan')->first()->id

        ]);
        DB::table('tipes')->insert([
            'tipe' => 'Civic',
            'merk_id' => Merk::where('merk', 'Honda')->first()->id
        ]);
    }
}
