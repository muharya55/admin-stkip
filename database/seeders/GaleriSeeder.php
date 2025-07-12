<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'gambar'=> '/images/gallery/galeri-4.JPG', 
                'deskripsi'=> 'category-two' ,
  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gambar'=> '/images/gallery/galeri-3.JPG', 
                'deskripsi'=> 'category-two' ,
  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
               'gambar'=> '/images/gallery/galeri-2.JPG', 
               'deskripsi'=> 'category-two' ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gambar'=> '/images/gallery/galeri-1.JPG',
                'deskripsi'=> 'category-one' ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gambar'=> '/images/gallery/galeri-5.webp',
                'deskripsi'=> 'category-one',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'gambar'=> '/images/gallery/galeri-6.webp', 
                'deskripsi'=> 'category-one' ,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ];

        DB::table('galeri')->insert($data);
    }
}
