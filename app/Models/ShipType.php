<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipType extends Model
{
    public $timestamps = false;

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
