<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            $judul = $faker->sentence(5);
            DB::table('artikel')->insert([
                'judul'     => $judul,
                'slug'      => Str::slug($judul) . '-' . $i,
                'image'     => '/images/berita/berita-1.jpeg',
                'thumbnail' => '/images/berita/berita-1.jpeg',
                'kategori'  => $faker->randomElement(['Berita Kampus', 'Agenda', 'Informasi']),
                'penulis'   => $faker->name(),
                'content'   => '<p>' . implode('</p><p>', $faker->paragraphs(4)) . '</p>',
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
        }
    }
}
