@extends('app')

@section('title', "Daftar Akun")

@section('main')
<main class="mx-auto mt-3 w-25 p-4" id="login-page">
    <section class="text-center">
        <h3 style="color: black;">Daftar Akun</h3>
        <h4>ShipMon</h4>
    </section>

    <form action="#" method="POST" id="login-form">
        <div class="form-group mt-3 mx-auto">
            <input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap" autofocus>
        </div>
        <div class="form-group mt-3 mx-auto">
            <select name="role" class="form-select">
                <option value="" disabled selected>Pilih....</option>
                <option value="1">Administrator</option>
            </select>
        </div>
        <div class="form-group mt-3 mx-auto">
            <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
        </div>
        <div class="form-group mt-3 mx-auto">
            <input type="password" class="form-control" name="password" placeholder="Kata Sandi">
        </div>
        <div class="form-group mt-3 mx-auto">
            <button type="submit" class="btn btn-custom-primary btn-lg w-100">Masuk</button>
        </div>
    </form>
    <section class="text-center">
        <p>Sudah memiliki akun? <a href="/login">Masuk</a></p>
    </section>
</main>
@endsection