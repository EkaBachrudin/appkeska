<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFasilitas extends Model
{
    use HasFactory;

    protected $table = 'data_fasilitas';

    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo(DataSekolah::class);
    }
}
