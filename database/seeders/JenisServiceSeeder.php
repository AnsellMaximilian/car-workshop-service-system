<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_services')->insert([
            'nama' => 'Bersih Compressor',
            'harga' => 300000,
            'deskripsi' => 'Membersihkan interori compressor'
        ]);

        DB::table('jenis_services')->insert([
            'nama' => 'Flushing',
            'harga' => 200000,
            'deskripsi' => 'Keluarkan pengempin selang'
        ]);

        DB::table('jenis_services')->insert([
            'nama' => 'Ganti Oli',
            'harga' => 100000,
            'deskripsi' => 'Mengganti oli'
        ]);
    }
}
