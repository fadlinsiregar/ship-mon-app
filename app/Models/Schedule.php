<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'name',
        'ship_type_id',
        'working_hours',
        'start_date',
        'completion_date',
        'user_id'
    ];


}
