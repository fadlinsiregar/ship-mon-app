@extends('app')
@section('main')
    @extends('components.main-menu')
@section('content')
    <h1>Rincian</h1>
    <section id="table-details" class="bg-light card" style="border-radius: 15px">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p>Nama Pembangunan</p>
                    <p>Jam Pengerjaan / hari</p>
                    <p>Waktu Pengerjaan</p>
                </div>
                <div class="col-6">
                    <p>{{ $schedule->name }}</p>
                    <p>{{ $schedule->working_hours }} jam</p>
                    <p>{{ formatDate($schedule->start_date) }} &mdash;
                        {{ formatDate($schedule->completion_date) }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    @if (Auth::user()->role_id == 1)
        @include('layouts.project-manager.schedule-details', [
            'workStagesOptions' => $workStagesOptions,
            'workStages' => $workStages,
            'completedWorkSchedules' => $completedWorkSchedules,
            'ongoingWorkSchedule' => $ongoingWorkSchedule,
        ])
    @else
        @include('layouts.worker.schedule-details', [
            'ongoingWorkSchedule' => $ongoingWorkSchedule
        ])
    @endif
@endsection
@endsection
