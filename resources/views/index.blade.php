@extends('app')
@section('main')
    @extends('components.main-menu')
    @section('content')
        <h2>Selamat datang kembali, {{ Auth::user()->full_name }}!</h2>

        @if (Auth::user()->role_id == 2)
            @include('layouts.worker.schedule-index')
        @endif
    @endsection
@endsection
