<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'role_id',
        'username',
        'password'
    ];

    public $timestamps = false;

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function schedule() {
        return $this->hasMany(Schedule::class);
    }

    public function scopeRoles() {

    }
}
