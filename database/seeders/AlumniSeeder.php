<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Satria Sinurat',
                'jabatan' => 'Pegawai Kementerian ATR/BPN - Kementerian ATR/BPN Kantor Pertanahan',
                'gambar' => '/images/testimonial/testimonial-01.png',
                'motivasi' => 'STKIP EVAV TUAL merupakan tempat dimana saya dipertemukan dengan teman-teman yang datang dari berbagai daerah, Saya mengikuti berbagai sub- organiasi dan juga ikut ke dalam Tim Public Speaking, disana saya berbaur dan saling menjalin relasi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tarisya Ativya Lubis',
                'jabatan' => 'Vice President Consumer Business Area 3 Telkomsel',
                'gambar' => '/images/testimonial/testimonial-03.png',
                'motivasi' => 'Awalnya saya ragu mengambil Prodi Manajemen Informatika di STKIP EVAV TUAL karena terbayang akan mata kuliahnya. Namun ternyata belajar di Prodi Manajemen Informatika di STKIP EVAV TUAL sangatlah menyenangkan karena tenaga pengajar dosen dan karyawan yang sangat ramah dan humble serta fasilitas lengkap membuat saya mudah belajar dan beradaptasi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rizka Dwi Savira',
                'jabatan' => 'PNS - Kejaksaan RI Humbang Hasundutan',
                'gambar' => '/images/testimonial/testimonial-02.png',
                'motivasi' => 'Saya memilih jurusan Teknik Informatika, karena saya tahu dan tidak bisa dipungkiri, kalau jurusan Teknik Informatika sangat dibutuhkan disemua instansi. Kampus yang sudah berdiri sejak tahun 1999 dengan fasilitas yang lengkap membuat saya dapat belajar dengan baik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Beri Suranta Sembiring',
                'jabatan' => 'PNS - Kejaksaan RI Humbang Hasundutan',
                'gambar' => '/images/testimonial/testimonial-04.png',
                'motivasi' => 'Untuk adik-adik yang masih duduk dibangku perkuliahan, harus menekuni mata kuliah yang diajarkan di Kampus, karena semua yang diajarkan sangat berguna di dunia kerja era digital 4.0. Dan bagi adik-adik yang mau kuliah, tetapkan pilihanmu. Tetap semangat dan jangan menyerah..',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('alumni')->insert($data);
    }
}
