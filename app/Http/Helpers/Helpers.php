<?php

// composer dump-autoload

function format_uang($angka)
{
    return number_format($angka, 0, ',', '.');
}
function getCurrentSemester()
{
    return date('n') < 6 ? 'genap' : 'ganjil';
}
function formatRupiah($angka)
{
    // Menggunakan number_format untuk format angka
    $formattedAngka = number_format($angka, 0, ',', '.');
    return 'Rp. ' . $formattedAngka;
}
function generateRandomString($length = 7)
{
    // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!&?_#';
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function extractIntegerFromString($string)
{
    // Hapus karakter non-digit, titik, dan spasi Unicode
    $cleanedString = preg_replace('/[^0-9]/u', '', $string);

    // Konversi string yang telah dibersihkan menjadi integer
    return (int)$cleanedString;
}
function createSlug($string, $char = '_')
{
    // Menambahkan pemisah untuk huruf kecil diikuti huruf besar
    $string = preg_replace('/([a-z])([A-Z])/', '$1' . $char . '$2', $string);

    // Mengganti spasi dengan karakter pemisah
    $string = str_replace(' ', $char, $string);

    // Ubah ke huruf kecil
    $string = strtolower($string);

    return $string;
}

function terbilang($angka)
{
    $angka = abs($angka);
    $baca  = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $terbilang = '';

    if ($angka < 12) { // 0 - 11
        $terbilang = ' ' . $baca[$angka];
    } elseif ($angka < 20) { // 12 - 19
        $terbilang = terbilang($angka - 10) . ' belas';
    } elseif ($angka < 100) { // 20 - 99
        $terbilang = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
    } elseif ($angka < 200) { // 100 - 199
        $terbilang = ' seratus' . terbilang($angka - 100);
    } elseif ($angka < 1000) { // 200 - 999
        $terbilang = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
    } elseif ($angka < 2000) { // 1.000 - 1.999
        $terbilang = ' seribu' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) { // 2.000 - 999.999
        $terbilang = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) { // 1000000 - 999.999.990
        $terbilang = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
    }

    return $terbilang;
}

function tanggal_indonesia($tgl, $tampil_hari = true, $bulan_tahun = false)
{
    $nama_hari  = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jum\'at',
        'Sabtu'
    );
    $nama_bulan = array(
        1 =>
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $tahun   = substr($tgl, 0, 4);
    $bulan   = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text    = '';

    if ($bulan_tahun) {
        $text       .= "$bulan $tahun";
        return $text;
    }
    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari        = $nama_hari[$urutan_hari];
        $text       .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text       .= "$tanggal $bulan $tahun";
    }

    return $text;
}

function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}

function hapus_titik($inputAmount)
{
    return str_replace('.', '', $inputAmount);
}

function tambahkanRentangAngka($angka)
{
    $rentang = [];
    $jumlahAngka = count($angka);

    $i = 0;
    while ($i < $jumlahAngka) {
        $dari = $angka[$i];
        $sampai = $dari;

        while ($i < $jumlahAngka - 1 && $angka[$i + 1] - $angka[$i] == 1) {
            $sampai = $angka[$i + 1];
            $i++;
        }

        $rentang[] = ['dari' => $dari, 'sampai' => $sampai];
        $i++;
    }

    return $rentang;
}
function tanggal_indonesia_detik($tgl, $tampil_hari = true)
{
    $nama_hari  = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jum\'at',
        'Sabtu'
    );
    $nama_bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $tahun   = substr($tgl, 0, 4);
    $bulan   = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);

    // Mendapatkan waktu
    $jam     = substr($tgl, 11, 2);
    $menit   = substr($tgl, 14, 2);
    $detik   = substr($tgl, 17, 2);

    $text    = '';

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari        = $nama_hari[$urutan_hari];
        $text       .= "$hari, $tanggal $bulan $tahun $jam:$menit:$detik";
    } else {
        $text       .= "$tanggal $bulan $tahun $jam:$menit:$detik";
    }

    return $text;
}
