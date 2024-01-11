<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkStage extends Model
{
    public $timestamps = false; 

    protected $fillable = ['work_stage'];

    public function workSchedules() {
        return $this->hasMany(WorkSchedule::class);
    }

    public function scopeNotExists($query, $id) {
        return $query->whereNotIn('id', WorkSchedule::where('schedule_id', $id)->get(['work_stage_id']));
    }
}
