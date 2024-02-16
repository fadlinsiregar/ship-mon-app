@extends('app')
@section('main')
<main class="mx-auto mt-3 w-25 p-4" id="login-page">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <section class="text-center">
        <h2 style="color: black;">Masuk Ke</h2>
        <h4>ShipMon</h4>
    </section>

    <form action="/login" method="POST" id="login-form">
        @csrf
        <div class="form-group mt-3 mx-auto">
            <input type="text" class="form-control" name="username" placeholder="Username" autofocus value="{{ old('username') }}" required>
        </div>
        <div class="form-group mt-3 mx-auto">
            <input type="password" class="form-control" name="password" placeholder="Kata Sandi" required>
        </div>
        <div class="form-group mt-3 mx-auto">
            <button type="submit" class="btn btn-custom-primary btn-lg w-100">Masuk</button>
        </div>
    </form>
</main>
@endsection