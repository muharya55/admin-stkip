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
        // Utilities::create([
        //     'slug' => 'sejarah', 
        // ]);
        // Utilities::create([
        //     'slug' => 'visi-misi', 
        // ]);
        // Utilities::create([
        //     'slug' => 'video-url', 
        // ]);
        // Utilities::create([
        //     'slug' => 'video-content', 
        // ]);
        Utilities::create(['slug' => 'image-banner']);
        Utilities::create(['slug' => 'text-banner1']);
        Utilities::create(['slug' => 'text-banner2']);
        Utilities::create(['slug' => 'text-banner3']);
        Utilities::create(['slug' => 'ukm-content']);
        Utilities::create(['slug' => 'ukm-image']); 
    }
}
