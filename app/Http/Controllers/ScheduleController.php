<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ScheduleWorker;
use App\Models\User;
use App\Models\WorkSchedule;
use App\Models\WorkStage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user']);
    }

    public function index()
    {
        $schedules = Schedule::where('user_id', $this->getUserId())->get();

        return view('schedules.index')->with([
            'title' => 'Jadwal',
            'schedules' => $schedules,
        ]);
    }

    public function show($id)
    {
        $schedule = $this->getSchedule($id);

        $workStages = WorkStage::all();

        $workStagesOptions = WorkStage::notExists($id)->get();

        $workSchedules = WorkSchedule::where('schedule_id', $id);

        $ongoingWorkSchedule = WorkSchedule::join('work_stages', 'work_schedules.work_stage_id', '=', 'work_stages.id')
            ->where('work_schedules.status', 'in progress')
            ->where('work_schedules.schedule_id', $schedule->id)
            ->orderByDesc('completion_date')
            ->select(['work_schedules.id', 'work_schedules.start_date', 'work_stages.name'])
            ->first();

        return view('schedules.details')->with([
            'title' => $schedule->name,
            'schedule' => $schedule,
            'workStages' => $workStages,
            'workStagesOptions' => $workStagesOptions,
            'workSchedules' => $workSchedules->get(),
            'completedWorkSchedules' => $workSchedules->completed()->get(),
            'ongoingWorkSchedule' => $ongoingWorkSchedule,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'working_hours' => 'numeric',
            'start_date' => 'required|date',
            'completion_date' => 'required|date'
        ]);

        $schedule = Schedule::create([
            'name' => $request->name,
            'working_hours' => $request->working_hours,
            'start_date' => $request->start_date,
            'completion_date' => $request->completion_date,
            'user_id' => $this->getUserId(),
        ]);

        return $schedule->exists
            ? redirect()->route('schedules.details', ['id' => $schedule->id])->with('message', 'Berhasil menambahkan jadwal baru!')
            : redirect()->back()->with('message', 'Gagal menambahkan data!');
    }

    public function storeWorkSchedule($id, Request $request)
    {
        $schedule = $this->getSchedule($id);

        // Menambahkan sesuai hari kerja
        $latestWorkSchedule = WorkSchedule::where('schedule_id', $id)
            ->latestSchedule()
            ->first();

        if ($latestWorkSchedule == null) {
            $startDate = $schedule->start_date;
        } else {
            $startDate = Carbon::parse($latestWorkSchedule->completion_date)->addDay()->format('Y-m-d');
        }

        $completionDate = Carbon::parse($startDate)->addWeekdays($request->days)->format('Y-m-d');

        $workSchedule = WorkSchedule::create([
            'work_stage_id' => $request->work_stage,
            'schedule_id' => $schedule->id,
            'start_date' => $startDate,
            'completion_date' => $completionDate,
        ]);

        return $workSchedule->exists
            ? redirect()->back()->with('success', 'Berhasil menambahkan data pekerjaan!')
            : redirect()->back()->with('failed', 'Gagal menambahkan data!');
    }

    public function finishWorkSchedule($id, Request $request)
    {
        $workSchedule = WorkSchedule::where('schedule_id', $id)
            ->where('work_stage_id', $request->work_stage_id)
            ->first();

        $workSchedule->status = 'completed';
        $workSchedule->completed_at = now()->format('Y-m-d');

        return $workSchedule->save()
            ? redirect()->back()->with('success', 'Jadwal diselesaikan!')
            : redirect()->back()->with('failed', 'Gagal menyimpan data!');
    }

    public function getWorkers($id)
    {
        $schedule = $this->getSchedule($id);

        $workers = User::join('schedule_workers', 'users.id', 'schedule_workers.worker_id')
            ->where('schedule_workers.schedule_id', $schedule->id)
            ->select(['users.id', 'users.username', 'users.full_name'])
            ->get();

        $availableWorkers = User::where('role_id', 2)->get();

        return view('schedules.users')->with([
            'title' => 'Tim Pekerja',
            'schedule' => $schedule,
            'workers' => $workers,
            'availableWorkers' => $availableWorkers,
        ]);
    }

    public function storeUser($id, Request $request)
    {
        $messages = [
            'username.unique' => 'Username sudah digunakan',
            'password.min' => 'Kata sandi minimal 7 karakter',
            'password.confirmed' => 'Password tidak cocok',
        ];

        $request->validate([
            'username' => 'required|string|unique:users,pk',
        ], $messages);

        $newUser = User::create([
            'full_name' => $request->full_name,
            'role_id' => 2,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $scheduleId = $id;
        $workerId = $newUser->id;
        $projectManagerId = $this->getUserId();

        User::create([
            'schedule_id' => $scheduleId,
            'worker_id' => $workerId,
            'project_manager_id' => $projectManagerId,
        ]);

        $type = ($newUser->exists) ? 'message' : 'error';
        $desc = ($newUser->exists) ? 'Berhasil menambahkan anggota tim!' : 'Gagal menambahkan anggota tim!';

        return back()->with($type, $desc);
    }

    public function addUserToWorkers($id, Request $request) {
        $workerId = $request->id;
        $scheduleId = $id;
        $projectManagerId = $this->getUserId();

        ScheduleWorker::create([
            'schedule_id' => $scheduleId,
            'worker_id' => $workerId,
            'project_manager_id' => $projectManagerId,
        ]);

        return back()->with('');
    }

    private function getSchedule($id) {
        return Schedule::find($id);
    }

    private function getUserId() {
        return auth()->user()->id;
    }
}
