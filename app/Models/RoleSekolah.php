<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleSekolah extends Model
{
    use HasFactory;

    protected $table = 'role_sekolahs';

    protected $guarded = [];

    public function role()
    {
        return $this->hasMany(Role::class);
    }

    public function sekolah()
    {
        return $this->hasMany(DataSekolah::class);
    }
}

