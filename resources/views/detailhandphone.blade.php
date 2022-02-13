`
@extends('layouts.layout')
@section('container')
<style>
    span{
        font-weight: bold;
    }
</style>
@foreach ($detail as $dtl)
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
        <img src="{{ asset('img/hp1.png')}}" class="img-fluid rounded-start mt-3" alt="...">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h3 class="card-title mb-4">{{ $dtl['nama']}}</h3>
            <h5 class="mb-3">Spesification :</h5>
            <p class="card-text">
                <span>RAM :</span>
                {{ $dtl['ram']}} GB
            </p>
            <p class="card-text">
                <span>Baterai :</span>
                {{ $dtl['baterai']}} mAh
            </p>
            <p class="card-text">
                <span>Memori :</span>
                {{ $dtl['memori']}} GB
            </p>
            <p class="card-text">
                <span>Prosesor :</span>
                {{ $dtl['prosesor']}} 
            </p>
            <p class="card-text">
                <span>Sistem Operasi :</span>
                {{ $dtl['sistemoperasi']}} 
            </p>
            <p class="card-text">
                <span>Kamera Depan :</span>
                {{ $dtl['kameradepan']}} MP 
            </p>
            <p class="card-text">
                <span>Kamera Belakang :</span>
                {{ $dtl['kamerabelakang']}} MP
            </p>
            <p class="card-text">
                <span>Ukuran Layar :</span>
                {{ $dtl['ukuranlayar']}} inci
            </p>
            <p class="card-text">
                <span>Harga :</span>
                Rp.{{ $dtl['harga']}}
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
        </div>
    </div>
</div>
@endforeach
@endsection
