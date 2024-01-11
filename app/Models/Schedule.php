<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ship_type_id',
        'working_hours',
        'start_date',
        'completion_date'
    ];

    public function ship_type() {
        return $this->belongsTo(ShipType::class);
    }
}
