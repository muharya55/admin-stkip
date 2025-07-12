<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory, Blameable;


    protected $guarded = [];
    protected $table = 'siswa';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', '%' . $search . '%')
                ->orWhere('nomor_induk_siswa', 'like', '%' . $search . '%');
        });
    }
    public function kelascustom()
    {
        return $this->hasMany(SiswaKelas::class, 'kode_siswa', 'kode')->select('kode_siswa', 'kode_kelas');
    }
    // public function kelas()
    // {
    //     return $this->hasMany(SiswaKelas::class, 'kode_siswa', 'kode');
    // }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kode_kelas', 'kode');
    }
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'kode_siswa', 'kode');
    }
    public function currentKelas($kode_siswa)
    {
        $filter  = getCurrentSemester() == 'genap' ? 'tahun_akhir' : 'tahun_awal';

        return SiswaKelas::where('kode_siswa', $kode_siswa)->with('kelas.tahunAjaran')
            ->whereHas('kelas', function ($query) use ($filter) {
                $query->whereHas('tahunAjaran', function ($subQuery) use ($filter) {
                    $subQuery->where($filter, date('Y'));
                });
            })->first();
    }
}
