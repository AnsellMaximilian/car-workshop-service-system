<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            PeranSeeder::class,
            UserSeeder::class,
            PelangganSeeder::class,
            MerkSeeder::class,
            TipeSeeder::class,
            KendaraanSeeder::class,
            JenisServiceSeeder::class,
            SukuCadangSeeder::class,
            PemeriksaanStandarSeeder::class,
            CompanyConfigurationSeeder::class
        ]);
    }
}
