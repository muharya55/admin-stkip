<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

// class SiswaImport implements ToModel  
class SiswaImport implements ToCollection  
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $rows = [];

    public function collection(Collection $rows)
    {
        $collection = collect($rows);

        $collection->shift();

        $this->rows = $collection;
    }
    public function insertData()
    {
        
        foreach ($this->rows as $key => $value) {
            $kelas =  Kelas::where('kode',$value[6])->first();
            if (!isset($kelas)) {
                return [
                    'message' => "Kode Kelas ". $value[6] . ' Tidak Terdaftar',
                    'success' => false,
                ];
            }
            $siswa =  Siswa::where('nomor_induk_siswa',$value[0])->first();
            
            $timestamp = ($value[3] - 25569) * 86400; // Menghitung timestamp dengan mengurangi epoch Excel dan mengalikan dengan detik per hari
         
            $kode =  generateRandomString(10);
            $data = [
                'kode'=>$kode,
                'nomor_induk_siswa'=>$value[0],
                'nama_lengkap'=>$value[1],
                'alamat'=>$value[2],
                'tanggal_lahir'=> date('Y-m-d', $timestamp),
                'jenis_kelamin'=>$value[4],
                'biaya'=>$value[5],
                'kode_kelas'=>$value[6],
            ];
            if (!isset($siswa)) {
                Siswa::create($data);
            }else{
                $siswa->update($data);
            }
 
        }
        return [
            'message' => "Data Berhasil Ditambahkan",
            'success' => true,
        ]; 
    }
     
}
