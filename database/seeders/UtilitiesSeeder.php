<?php

namespace Database\Seeders;

use App\Models\Utilities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Utilities::create([
            'slug' => 'sejarah', 
        ]);
        Utilities::create([
            'slug' => 'visi-misi', 
        ]);
        Utilities::create([
            'slug' => 'video-url', 
        ]);
        Utilities::create([
            'slug' => 'video-content', 
        ]);
    }
}
