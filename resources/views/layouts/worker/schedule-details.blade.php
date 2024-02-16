<div class="card mt-3">
    <h5 class="card-header bg-primary text-light">Jadwal Saat Ini</h5>
    <div class="card-body">
        <div class="row">
            @if ($ongoingWorkSchedule != null)
                <div class="col-6">
                    <p>
                    <p>{{ $ongoingWorkSchedule->name }}</p>
                    <p>{{ formatDate($ongoingWorkSchedule->start_date) }} &mdash;
                        {{ formatDate($ongoingWorkSchedule->completion_date) }} </p>
                    </p>
                </div>
                <form action="{{ route('schedules.finish_work_schedule', ['id' => $schedule->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="work_stage_id" value="{{ $ongoingWorkSchedule->work_stage_id }}">
                    <button type="submit" class="btn btn-success">Selesai</button>
                </form>
            @else
                <p>Tidak ada jadwal saat ini!</p>
            @endif
        </div>
    </div>
</div>
