@extends('layouts.layout')
@section('container')
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Spesifikasi</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <p class="mt-2 font-weight-bold">Pencarian berdasarkan spesifikasi</p>   
        <form action="" method="GET" id="carispesifikasi">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3" >
                        <label class="input-group-text">RAM</label>
                        <select class="form-select" aria-label="Default select example" id="cariRAM" name="cariRAM">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listRAM'] as $item)
                                <option value="{{ $item['ram'] }}">{{ str_replace('RAM_','',$item['ram'])}}  GB</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3" >
                        <label class="input-group-text">Baterai</label>
                        <select class="form-select" aria-label="Default select example" id="cariBaterai" name="cariBaterai">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listBaterai'] as $item)
                                <option value="{{ $item['baterai'] }}">{{ str_replace('Baterai_','',$item['baterai']) }} mAh</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">   
                    <div class="input-group mb-3">
                        <label class="input-group-text">Kamera Depan</label>
                        <select class="form-select" aria-label="Default select example"id="cariKameraDepan" name="cariKameraDepan">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listKameraDepan'] as $item)
                                <option value="{{ $item['kameraDepan'] }}">{{ str_replace('KD_','',$item['kameraDepan'])}} MP</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Kamera Belakang</label>
                        <select class="form-select" aria-label="Default select example"id="cariKameraBelakang" name="cariKameraBelakang">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listKameraBelakang'] as $item)
                                <option value="{{ $item['kameraBelakang'] }}">{{ str_replace('KB_','',$item['kameraBelakang'])}} MP</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Memori</label>
                        <select class="form-select" aria-label="Default select example" id="cariMemori" name="cariMemori">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listMemori'] as $item)
                                <option value="{{ $item['memori'] }}">{{ str_replace('Memori_','',$item['memori']) }} GB</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Sistem Operasi</label>
                        <select class="form-select" aria-label="Default select example" id="cariSistemOperasi" name="cariSistemOperasi">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listSistemOperasi'] as $item)
                                <option value="{{ $item['sistemOperasi'] }}">{{ str_replace('_',' ',str_replace('SO_','',$item['sistemOperasi'])) }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Ukuran Layar</label>
                        <select class="form-select" aria-label="Default select example"id="cariUkuranLayar" name="cariUkuranLayar">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listUkuranLayar'] as $item)
                                <option value="{{ $item['ukuranLayar'] }}">{{ str_replace('UkuranLayar_','',$item['ukuranLayar'])}}  inch</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Prosesor</label>
                        <select class="form-select" aria-label="Default select example" id="cariProsesor" name="cariProsesor">
                            <option value="">Pilihlah salah satu</option>
                            @foreach($list['listProsesor'] as $item)
                                <option value="{{ $item['prosesor'] }}">{{ str_replace('_',' ',str_replace('Prosesor_','',$item['prosesor'])) }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Budget Pembelian</label>
                        <input type="text" class="form-control" id="cariHarga" name="cariHarga">
                    </div>
                </div>
            </div>
            <input type="submit" name="cariSpesifikasi" value="Cari" class="btn btn-primary">
            <input type="submit" name="reset" value="Reset" class="btn btn-danger">
        </form>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian</h6>
                </div>
                <div class="card-body">
                    @if($list['resp'] == 0)
                        <h4 class="small font-weight-bold">Belum terdapat pencarian data<span> </h4>
                    @elseif($list['resp'] == 1 && $list['jumlahHandphone'] == 0)
                        <h4 class="small font-weight-bold">Data tidak ditemukan<span></h4>
                    @else
                        @foreach ($list['searching1'] as $item)
                        <ul class="list-group list-group-flush">
                            <a href="/detail_handphone/{{$item['nama']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['nama']) }}</li></a>
                        </ul>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection