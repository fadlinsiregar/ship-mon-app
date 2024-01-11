<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'full_name',
        'username',
    ];

    public $timestamps = false;

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
