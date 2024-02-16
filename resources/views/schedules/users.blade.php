@extends('app')
@section('main')
    @extends('components.main-menu')
@section('content')
    <h1>Tim Pekerja {{ $schedule->name }}</h1>
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @elseif (session('message'))
        <div class="alert alert-success">
            <i class="bi bi-exclamation-triangle"></i> {{ session('message') }}
        </div>
    @endif

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah Anggota Tim</button>
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUserModalLabel">Tambah Anggota Tim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('schedules.store_worker', ['id' => $schedule->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="full_name">Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Konfirmasi Kata Sandi</label>
                            <input type="password" name="confirmation_password" id="confirmation_password" class="form-control" required>
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

    @if (count($workers) > 0)
        @foreach ($workers as $worker)
        <div class="bg-light p-4 mt-3">
            <h4>{{ $worker->full_name }}</h4>
            <p><i class="bi bi-person"></i> {{ $worker->username }}</p>
        </div>
        @endforeach
    @else
        <br>
        <p class="mt-2"><strong style="color: red">Belum ada daftar pekerja!</strong></p>
        <p>Silakan mengklik Tambah Anggota Tim atau menambahkan pekerja dari daftar di bawah ini!</p>
    @endif

    <section class="mt-3">
        <h3>Daftar Pekerja yang Tersedia</h3>
        @if (count($availableWorkers) > 0)
            @foreach ($availableWorkers as $worker)
                <div class="bg-light p-4 mt-3">
                    <h4>{{ $worker->full_name }}</h4>
                    <p><i class="bi bi-person"></i> {{ $worker->username }}</p>
                    <form action="{{ route('schedules.add_user_to_workers', ['id' => $schedule->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $worker->id }}">
                        <button type="submit" class="btn btn-success">Tambah ke Jadwal</button>
                    </form>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@endsection
