<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ShipType;
use App\Models\WorkSchedule;
use App\Models\WorkStage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        return view('dashboard.schedules')->with([
            'schedules' => $schedules,
        ]);
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);

        $workStages = WorkStage::all();

        $workStagesOptions = WorkStage::notExists($schedule->id)->get();

        $workSchedules = WorkSchedule::where('schedule_id', $schedule->id);

        return view('dashboard.schedule-details')->with([
            'schedule' => $schedule,
            'workStages' => $workStages,
            'workStagesOptions' => $workStagesOptions,
            'workSchedules' => $workSchedules->get(),
            'completedWorkSchedules' => $workSchedules->completed()->get(),
            'ongoingWorkSchedule' => $workSchedules->inProgress()->latestSchedule()->first(),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ship_type' => 'required',
            'working_hours' => 'numeric',
            'start_date' => 'required|date',
            'completion_date' => 'required|date'
        ]);

        $schedule = Schedule::create([
            'name' => $request->name,
            'ship_type_id' => $request->ship_type,
            'working_hours' => $request->working_hours,
            'start_date' => $request->start_date,
            'completion_date' => $request->completion_date
        ]);

        return $schedule->exists
            ? redirect()->route('schedules.details', ['id' => $schedule->id])
            : redirect()->back()->with('message', 'Gagal menambahkan data!');
    }

    public function storeWorkSchedule($id, Request $request)
    {
        $schedule = Schedule::find($id);

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
}
