<div class="mt-3">
    <h4>Jadwal Terbaru</h4>
    @foreach ($schedules as $schedule)
        <div class="p-4 bg-light">
            <h4>{{ $schedule->name }}</h4>
            <h6>Project Manager: {{ $schedule->full_name }}</h6>
            <a href="{{ route('schedules.details', ['id' => $schedule->id]) }}" class="btn btn-primary">Rincian</a>
        </div>
    @endforeach
</div>
