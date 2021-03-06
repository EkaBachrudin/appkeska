<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePolice extends Model
{
    use HasFactory;

    protected $table = 'role_police';

    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
