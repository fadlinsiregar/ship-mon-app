<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    protected $fillable = [
        'work_stage_id',
        'schedule_id',
        'start_date',
        'completion_date'
    ];

    public function workStage() {
        return $this->belongsTo(WorkStage::class);
    }

    public function scopeLatestSchedule($query) {
        return $query->orderBy('completion_date', 'desc');
    }

    public function scopeScheduled($query) {
        return $query->where('status', 'scheduled');
    }

    public function scopeInProgress($query) {
        return $query->where('status', 'in progress');
    }

    public function scopeCompleted($query) {
        return $query->where('status', 'completed');
    }
}