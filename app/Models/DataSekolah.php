<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    use HasFactory;

    protected $table = 'data_sekolahs';

    protected $guarded = [];

    public function fasilitas(){
        return $this->hasMany(DataFasilitas::class);
    }

    public function guru(){
        return $this->hasMany(DataGuru::class);
    }

    public function siswa(){
        return $this->hasMany(DataSiswa::class);
    }

    public function roleSekolah()
    {
        return $this->belongsTo(RoleSekolah::class);
    }
}
