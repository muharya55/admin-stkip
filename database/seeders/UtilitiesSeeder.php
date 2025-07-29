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
        //a
        // Utilities::create(['slug' => 'sejarah']);
        // Utilities::create(['slug' => 'visi-misi']);
        // Utilities::create(['slug' => 'video-url']);
        // Utilities::create(['slug' => 'video-content']);
        // Utilities::create(['slug' => 'image-banner']);
        // Utilities::create(['slug' => 'text-banner1']);
        // Utilities::create(['slug' => 'text-banner2']);
        // Utilities::create(['slug' => 'text-banner3']);
        // Utilities::create(['slug' => 'ukm-content']);
        // Utilities::create(['slug' => 'ukm-image']); 
        // Utilities::create(['slug' => 'whatsapp-icon']); 
        // Utilities::create(['slug' => 'gmail-icon']); 
        // Utilities::create(['slug' => 'youtube-icon']); 
        // Utilities::create(['slug' => 'instagram-icon']); 
        // Utilities::create(['slug' => 'facebook-icon']); 
        // Utilities::create(['slug' => 'email-icon']); 
        // Utilities::create(['slug' => 'telephone-icon']); 
        // Utilities::create(['slug' => 'ormawa-image']); 
        // Utilities::create(['slug' => 'ormawa-text']); 
        // Utilities::create(['slug' => 'location-icon']); 
        Utilities::create(['slug' => 'komunitas-image']); 
        Utilities::create(['slug' => 'komunitas-text']); 
    }
}
