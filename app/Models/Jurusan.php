<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
     use HasFactory, Blameable;


    protected $guarded = [];
    protected $table = 'jurusan';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('kategori', 'like', '%' . $search . '%');
        });
    }
    public function fakultas()
    {
        return $this->hasOne(Fakultas::class, 'id', 'fakultas_id');  
    }
}
