@extends('app')

@section('title', 'Jadwal')

@section('main')
    @extends('components.main-menu')
@section('content')
    <section class="container mt-3">
        <h1>Jadwal Pembangunan</h1>
        @if(session('message'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> {{ session('message') }}
            </div>
        @endif
        <section id="schedules" class="">
            <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addConstructionModal">Tambah
                Pembangunan Kapal
            </button>
            <section id="schedules-list">
                @foreach ($schedules as $schedule)
                    <div class="p-4 bg-light mt-3 d-flex align-items-center">
                        <div class="col-4">
                            <h4>{{ $schedule->name }}</h4>
                            <p><i class="bi bi-calendar-event"></i> {{ formatDate($schedule->start_date) }} &mdash;
                                {{ formatDate($schedule->completion_date) }}</p>
                        </div>
                        <div class="col-2 offset-6">
                            <a href="{{ route('schedules.details', ['id' => $schedule->id]) }}"
                                class="btn btn-custom-schedule btn-lg" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-title="Rincian"><i class="bi bi-info-lg"></i></a>
                            <a href="#" class="btn btn-custom-schedule btn-lg" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Ubah"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" class="btn btn-custom-schedule btn-lg" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Hapus Jadwal"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                @endforeach
            </section>
        </section>
        <div class="modal fade" id="addConstructionModal" tabindex="-1" aria-labelledby="addConstructionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addConstructionModalLabel">Tambah Pembangunan Kapal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <form action="{{ route('schedules.create') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Pembangunan</label>
                                <input type="text" name="name" id="name" class="form-control" required autofocus>
                            </div>
                            <div class="form-group mt-2">
                                <label for="working_hours">Jam Pengerjaan per Hari</label>
                                <input type="number" name="working_hours" class="form-control" id="working_hours" min="1" max="24" required>
                            </div>
                            <div class="row form-group mt-2">
                                <div class="col">
                                    <label for="start_date">Tanggal Mulai</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="completion_date">Tanggal Selesai</label>
                                    <input type="date" name="completion_date" id="completion_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@endsection
