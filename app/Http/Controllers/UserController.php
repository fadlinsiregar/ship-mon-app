<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'user']);
    }

    public function index() {
        $schedules = Schedule::join('schedule_workers', 'schedule_workers.schedule_id', '=', 'schedules.id')
        ->join('users', 'users.id', '=', 'schedules.user_id')
        ->where('schedule_workers.worker_id', $this->getUserId())
        ->select('schedules.id', 'schedules.name', 'users.full_name')
        ->get();

        return view('index')->with([
            'title' => 'Dashboard',
            'schedules' => $schedules,
        ]);
    }

    public function profile() {
        $user = User::find($this->getUserId());
        return true;
    }

    private function getUserId() {
        return auth()->user()->id;
    }
}
