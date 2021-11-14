<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $guarded = [];

    public function rolePolice(){
        return $this->hasOne(RolePolice::class);
    }

    public function roleSekolah()
    {
        return $this->belongsTo(RoleSekolah::class);
    }
}
