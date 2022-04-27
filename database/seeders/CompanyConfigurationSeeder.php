<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_configurations')->insert([
            'rekening_bca' => '7120345499',
            'rekening_bni' => '0295746109',
            'no_telp' => '021-55790472',
            'hp_1' => '0877 8801 3666',
            'hp_2' => '0813 8959 9265',
            'email' => 'hermanto11@gmail.com',
            'alamat' => 'JI. Teuku Umar No. 18, Cimone, Tangerang'
        ]);
    }
}
