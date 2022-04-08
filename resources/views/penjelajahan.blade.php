@extends('layouts.layout')
@section('container')
<form action="" method="GET" id="cari_spesifikasi">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <label class="input-group-text">Merek</label>
                <select class="form-select" aria-label="Default select example" id="browse" name="browse">
                    <option value="">Pilihlah salah satu</option>
                        <option value="aplikasi">Aplikasi</option>
                        <option value="handphone">Handphone</option>
                        <option value="merek">Merek</option>
                </select>
            </div>
        </div>
    </div>
    <input type="submit" name="browsing" value="Jelajah" class="btn btn-primary" id="submit">
    <input type="submit" name="reset" value="Reset" class="btn btn-danger">
</form>
{{-- @dd($data) --}}
{{-- @dd($data['resp'], $data['jumlahbrowse']) --}}
@if($data['resp']>=1 && $data['data']['penjelajahan'] == 'aplikasi')
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headAplikasi">Aplikasi</h6>
            </div>
            <div class="card-body" id="bodyAplikasi">
                <div class="row">
                @foreach ($data['data']['listAplikasi'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Aplikasi'}}/{{$item['aplikasi']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['aplikasi']) }}</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'handphone')
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headMemori">Memori</h6>
            </div>
            <div class="card-body" id="bodyMemori">
                <div class="row">
                @foreach ($data['data']['listMemori'] as $item)
                <div class="col-md-2 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Memori'}}/{{$item['memori']}}" class="list-group-item list-group-item-action">{{ str_replace('Memori_',' ',$item['memori']) }} GB</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headRAM">RAM</h6>
            </div>
            <div class="card-body" id="bodyRAM">
                <div class="row">
                @foreach ($data['data']['listRAM'] as $item)
                <div class="col-md-2 d-inline-block">
                <div class="list-group list-group-flush">
                    <a href="/jelajah/{{'RAM'}}/{{$item['ram']}}" class="list-group-item list-group-item-action">{{ str_replace('RAM_',' ',$item['ram']) }} GB</li></a>
                </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headBaterai">Baterai</h6>
            </div>
            <div class="card-body" id="bodyBaterai">
                <div class="row">
                @foreach ($data['data']['listBaterai'] as $item)
                <div class="col-md-2 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Baterai'}}/{{$item['baterai']}}" class="list-group-item list-group-item-action">{{ str_replace('Baterai_',' ',$item['baterai']) }}</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headSistemOperasi">Sistem Operasi</h6>
            </div>
            <div class="card-body" id="bodySistemOperasi">
                <div class="row">
                @foreach ($data['data']['listSistemOperasi'] as $item)
                <div class="col-md-2 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'SistemOperasi'}}/{{$item['sistemOperasi']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['sistemOperasi']) }}</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headKameraBelakang">Kamera Belakang</h6>
            </div>
            <div class="card-body" id="bodyKameraBelakang">
                <div class="row">
                @foreach ($data['data']['listKameraBelakang'] as $item)
                <div class="col-md-2 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'KameraBelakang'}}/{{$item['kameraBelakang']}}" class="list-group-item list-group-item-action">{{ str_replace('KB_',' ',$item['kameraBelakang']) }} MP</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headKameraDepan">Kamera Depan</h6>
            </div>
            <div class="card-body" id="bodyKameraDepan">
                <div class="row">
                @foreach ($data['data']['listKameraDepan'] as $item)
                <div class="col-md-2 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'KameraDepan'}}/{{$item['kameraDepan']}}" class="list-group-item list-group-item-action">{{ str_replace('KD_',' ',$item['kameraDepan']) }} MP</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mb-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headUkuranLayar">Ukuran Layar</h6>
            </div>
            <div class="card-body" id="bodyUkuranLayar">
                <div class="row">
                @foreach ($data['data']['listUkuranLayar'] as $item)
                <div class="col-md-2 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'UkuranLayar'}}/{{$item['ukuranLayar']}}" class="list-group-item list-group-item-action">{{ str_replace('UkuranLayar_',' ',$item['ukuranLayar']) }} inch</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12 mb-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headProsesor">Prosesor</h6>
            </div>
            <div class="card-body d-flex" id="bodyProsesor">
                <div class="row">
                @foreach ($data['data']['listProsesor'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{'Prosesor'}}/{{$item['prosesor']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['prosesor']) }}</li></a>
                </ul>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($data['resp']>=1 && $data['data']['penjelajahan'] == 'merek')
<div class="row">
    <div class="col-lg-12 mb-1 mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="headMerek">Merek</h6>
            </div>
            <div class="card-body" id="bodyMerek">
                <div class="row">
                @foreach ($data['data']['listMerek'] as $item)
                <div class="col-md-3 d-inline-block">
                <ul class="list-group list-group-flush">
                    <a href="/jelajah/{{ 'Merek' }}/{{$item['merek']}}" class="list-group-item list-group-item-action">{{ str_replace('Merek_',' ',$item['merek']) }}</li></a>
                </ul>
                </div>
                @endforeach 
                </div>  
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        //Memori
        $('#bodyMemori').hide();
        $('#bodyMemori').slideDown('slow').delay(1500);
        $('#headMemori').click(function(){
            $('#bodyMemori').slideToggle();
        })

        //RAM
        $('#bodyRAM').hide();
        $('#bodyRAM').slideDown('slow').delay(1500);
        $('#headRAM').click(function(){
            $('#bodyRAM').slideToggle();
        })

        $('#bodyProsesor').hide();
        $('#bodyProsesor').slideDown('slow').delay(1500);
        $('#headProsesor').click(function(){
            $('#bodyProsesor').slideToggle();
        })

        $('#bodyKameraBelakang').hide();
        $('#bodyKameraBelakang').slideDown('slow').delay(1500);
        $('#headKameraBelakang').click(function(){
            $('#bodyKameraBelakang').slideToggle();
        })

        $('#bodyKameraDepan').hide();
        $('#bodyKameraDepan').slideDown('slow').delay(1500);
        $('#headKameraDepan').click(function(){
            $('#bodyKameraDepan').slideToggle();
        })

        $('#bodyUkuranLayar').hide();
        $('#bodyUkuranLayar').slideDown('slow').delay(1500);
        $('#headUkuranLayar').click(function(){
            $('#bodyUkuranLayar').slideToggle();
        })
        $('#bodySistemOperasi').hide();
        $('#bodySistemOperasi').slideDown('slow').delay(1500);
        $('#headSistemOperasi').click(function(){
            $('#bodySistemOperasi').slideToggle();
        })
        

        $('#bodyBaterai').hide();
        $('#bodyBaterai').slideDown('slow').delay(1500);
        $('#headBaterai').click(function(){
            $('#bodyBaterai').slideToggle();
        })

        $('#bodyMerek').hide();
        $('#bodyMerek').slideDown('slow').delay(1500);
        $('#headMerek').click(function(){
            $('#bodyMerek').slideToggle();
        })

        $('#bodyAplikasi').hide();
        $('#bodyAplikasi').slideDown('slow').delay(1500);
        $('#headAplikasi').click(function(){
            $('#bodyAplikasi').slideToggle();
        })
    })
</script>
@endsection