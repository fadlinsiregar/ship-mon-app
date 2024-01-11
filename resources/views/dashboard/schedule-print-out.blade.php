@inject('carbon', 'Carbon\Carbon')
@extends('app')

@section('title', 'Cetak Laporan Pembangunan')

@section('main')
@extends('components.main-menu')

@section('content')
<h1>Cetak Laporan</h1>
<section class="mt-3 p-4 bg-light">
    <form class="row row-cols-lg-auto g-3 align-items-center">
        <div class="col-12">
            <span>Cetak Laporan</span>
        </div>

        <div class="col-12">
            <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
            <select class="form-select" id="inlineFormSelectPref">
                <option selected>Pilih Bulan</option>
                
            </select>
        </div>

        <div class="col-12">
            <label class="visually-hidden" for="inlineFormSelectPref">Bulan</label>
            <select class="form-select" id="inlineFormSelectPref">
                <option selected>Pilih Tahun</option>
                
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
    </form>
</section>
@endsection

@endsection
