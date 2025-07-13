<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data =  [
        [
            'nama'=> "Hj. Djohari Rengur",
            'jabatan'=> "Ketua Yayasan Belan La’u Raly",
            'gambar'=> "/images/gallery/ketua_yayasan.jpeg",
            'kategori'=> "Ketua",
        ],
        [
            'nama'=> "Yakuba Namsa, S.Pd.I., M.Pd",
            'jabatan'=> "Ketua STKIP",
            'gambar'=> "/images/gallery/ketua_stkip.jpeg",
            'kategori'=> "Ketua",
        ],
        [
            'nama'=> "Irma S. Ingratubun, S.Pd., M.Sc",
            'jabatan'=> "Puket I, Bid. Akademik",
            'gambar'=> "/images/foto-Yopi-Tolego.png",
            'kategori'=> "PUKET",
        ],
        [
            'nama'=> "Yuliana Kopong, S.Pd., M.Pd",
            'jabatan'=> "Puket II, Bid. Administrasi Umum dan Keuangan",
            'gambar'=> "/images/foto-Yopi-Tolego.png",
            'kategori'=> "PUKET",
        ],
        [
            'nama'=> "Lodovika Meci, S.Pd., M.Pd",
            'jabatan'=> "Puket III, Bid. Kemahasiswaan",
            'gambar'=> "/images/foto-Yopi-Tolego.png",
            'kategori'=> "PUKET",
        ],
        [
            'nama'=> "Abdul Hamid Warwefubun, S.Pd.",
            'jabatan'=> "Ketua Program Studi PGSD",
            'gambar'=> "/images/foto-Yopi-Tolego.png",
            'kategori'=> "Program Sarjana",
        ],
        [
            'nama'=> "Irma S. Ingratubun, S.Pd., M.Sc",
            'jabatan'=> "Ketua Program Studi PGSD",
            'gambar'=> "/images/foto-Yopi-Tolego.png",
            'kategori'=> "Program Sarjana",
        ],
        [
            'nama'=> "Mahila Rekol, SE",
            'jabatan'=> "Kepala LPM",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Lembaga",
        ],
        [
            'nama'=> "Cici Claudia N. Ohioner, S.Si",
            'jabatan'=> "Sekretaris LPM",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Lembaga",
        ],
        [
            'nama'=> "Samsul B. Narahaubun, M.Pd",
            'jabatan'=> "Kepala LP2M",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Lembaga",
        ],
        [
            'nama'=> "Fahri Rahanar, S.Sos",
            'jabatan'=> "Sekretaris LP2M",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Lembaga",
        ],
        [
            'nama'=> "Mustova Namsa, SH",
            'jabatan'=> "BAAK",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Biro",
        ],
        [
            'nama'=> "Mufala Warwefubun. S.Pd.I., M.Pd",
            'jabatan'=> "TI",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Biro",
        ],
        [
            'nama'=> "Muhlis Warwefubun, S.Pd.I",
            'jabatan'=> "BAUK",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Biro",
        ],
        [
            'nama'=> "Mirah S. Kobarbun, M.Pd",
            'jabatan'=> "Kepala Perpustakaan",
            'gambar'=> "/images/foto-Ferry-Sumual.png",
            'kategori'=> "Biro",
        ],
    ];

      DB::table('struktur_organisasi')->insert($data);

    }
}
