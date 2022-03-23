<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanStandarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pemeriksaan_standars')->insert([
            'nama' => 'Cek Koneksi Selang',
            'deskripsi' => 'Membersihkan interori compressor'
        ]);

        DB::table('pemeriksaan_standars')->insert([
            'nama' => 'Cek Bocor',
            'deskripsi' => 'Keluarkan pengempin selang'
        ]);

        DB::table('pemeriksaan_standars')->insert([
            'nama' => 'Cek Keindahan',
            'deskripsi' => 'Mengganti oli'
        ]);
    }
}
