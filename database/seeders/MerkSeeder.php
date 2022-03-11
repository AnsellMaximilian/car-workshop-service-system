<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('merks')->insert([
            'merk' => 'Toyota'
        ]);
        DB::table('merks')->insert([
            'merk' => 'Honda'
        ]);
        DB::table('merks')->insert([
            'merk' => 'Hyundai'
        ]);
        DB::table('merks')->insert([
            'merk' => 'Nissan'
        ]);
    }
}
