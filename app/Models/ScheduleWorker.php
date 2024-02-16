<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleWorker extends Model
{
    protected $table = 'schedule_workers';

    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'worker_id',
        'project_manager_id',
    ];

    public function schedules() {
        return $this->belongsToMany(Schedule::class);
    }
}
