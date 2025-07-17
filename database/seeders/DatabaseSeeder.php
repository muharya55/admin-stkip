<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UtilitiesSeeder::class);
        // $this->call(ArtikelSeeder::class);
        // $this->call(AlumniSeeder::class);
        // $this->call(GaleriSeeder::class);
        // $this->call(StrukturOrganisasiSeeder::class);
    }
}
