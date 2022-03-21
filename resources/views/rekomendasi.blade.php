@extends('layouts.layout')
@section('container')
<form action="" method="GET" id="rekomendasi">
    <div class="row">
        <div class="col-md-5">
            <div class="input-group mb-3">
                <label class="input-group-text">Ukuran Kenyamanan</label>
                <select class="form-select" aria-label="Default select example" name="cariUkuranLayar">
                    <option value="">Pilihlah salah satu</option>
                    <option value="kecil">Kecil</option>
                    <option value="sedang">Sedang</option>
                    <option value="besar">Besar</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="bobotUl">
        </div>
        <div class="col-md-5">
            <div class="input-group mb-3">
                <label class="input-group-text">Lama Travelling</label>
                <input type="text" class="form-control" name="cariBaterai" >
            </div>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="bobotBaterai">
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="input-group mb-3">
                <label class="input-group-text">Budget Pembelian</label>
                <input type="text" class="form-control" name="cariHarga" >
            </div>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="bobotHarga">
        </div>
        <div class="col-md-5">
            <div class="input-group mb-3">
                <label class="input-group-text">Hobi Fotografi</label>
                <select class="form-select" aria-label="Default select example" name="cariKamera">
                    <option value=''>Pilihlah salah satu</option>
                    <option value="1">Iya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="bobotKamera">
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="input-group mb-3">
                <label class="input-group-text mt-0">Aplikasi Digunakan</label>
                <select class="form-control selectpicker" multiple name="cariAplikasi[]">
                    @foreach($data['rowAplikasi'] as $item)
                        <option value="{{ $item['aplikasi'] }}">{{ str_replace('_',' ',$item['aplikasi']) }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="bobotAplikasi">
        </div>
    </div>
    <input type="submit" name="rekomendasi" value="Rekomendasi" class="btn btn-primary">
    <input type="submit" name="reset" value="Reset" class="btn btn-danger">
    @if($data['jumlahCari'] == 0 && $data['resp'] == 0)
    <div class="row">
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Belum terdapat pencarian data<span> </h4>
                </div>
            </div>
        </div>
    </div>             
    @elseif($data['resp'] == 1 && $data['jumlahCari'] == 0)
    <div class="row">
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Tidak terdapat pencarian data<span> </h4>
                </div>
            </div>
        </div>
    </div>
    @else
        <h6 class="mt-4 mb-3">1. Tabel Spesifikasi Handphone</h6>
        <table class="table table-hover">
            <thead>
                <tr style="background-color: #4E73DF; color:white; text-center" class="">
                <th scope="col">No</th>
                <th scope="col">Nama Handphone</th>
                <th scope="col">Ukuran Layar</th>
                <th scope="col">Harga</th>
                <th scope="col">RAM</th>
                <th scope="col">Kamera Belakang</th>
                <th scope="col">Baterai</th>
                <th scope="col">Memori</th>
                <th scope="col">Prosesor</th>
                <th scope="col">Kamera Depan</th>
                <th scope="col">Sistem Operasi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;?>
            @foreach($data['resultspesifikasi'] as $item)
                <tr class="table-<?php if($i%2==0) {
                    echo "secondary";
                }else{
                    echo "light";
                }?>">
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ str_replace('_',' ',$item['nama'])}}</td>
                <td>{{ str_replace('UkuranLayar_','',$item['ukuranlayar'])}}</td>
                <td>{{ $item['harga']}}</td>
                <td>{{ str_replace('RAM_','',$item['ram'])}}</td>
                <td>{{ str_replace('KB_','',$item['kb'])}}</td>
                <td>{{ str_replace('Baterai_','',$item['baterai'])}}</td>
                <td>{{ str_replace('Memori_','',$item['memori'])}}</td>
                <td>{{ str_replace('_',' ',$item['prosesor'])}}</td>
                {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                <td>{{ str_replace('KD_','',$item['kd'])}}</td>
                <td>{{ str_replace('_',' ',$item['so'])}}</td>
                </tr>
            <?php $i++;?>
            @endforeach
            </tbody>
        </table>
        <h6 class="mt-4 mb-3">2. Nilai atau Bobot Handphone</h6>
        <table class="table table-hover">
            <thead>
                <tr style="background-color: #4E73DF; color:white; text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Handphone</th>
                <th scope="col">Ukuran Layar</th>
                <th scope="col">Harga</th>
                <th scope="col">RAM</th>
                <th scope="col">Kamera Belakang</th>
                <th scope="col">Baterai</th>
                <th scope="col">Memori</th>
                <th scope="col">Prosesor</th>
                <th scope="col">Kamera Depan</th>
                <th scope="col">Sistem Operasi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;?>
            @foreach($data['resultbobot'] as $item)
                <tr class="table-<?php if($i%2==0) {
                    echo "secondary";
                }else{
                    echo "light";
                }?>">
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ str_replace('_',' ',$item['nama'])}}</td>
                    <td>{{ $item['Ukuran_Layar']}}</td>
                    <td>{{ $item['Harga']}}</td>
                    <td>{{ $item['RAM']}}</td>
                    <td>{{ intval($item['Kamera_Belakang'])}}</td>
                    <td>{{ $item['Baterai']}}</td>
                    <td>{{ $item['Memori']}}</td>
                    <td>{{ $item['Prosesor']}}</td>
                    {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                    <td>{{ $item['Kamera_Depan']}}</td>
                    <td>{{ $item['Sistem_Operasi']}}</td>
                </tr>
            <?php $i++;?>
            @endforeach
            </tbody>
        </table>
        <h6 class="mt-4 mb-3">3. Normalisasi</h6>
        <table class="table table-hover">
            <thead>
                <tr style="background-color: #4E73DF; color:white; text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Handphone</th>
                    <th scope="col">Ukuran Layar</th>
                    <th scope="col">Harga</th>
                    <th scope="col">RAM</th>
                    <th scope="col">Kamera Belakang</th>
                    <th scope="col">Baterai</th>
                    <th scope="col">Memori</th>
                    <th scope="col">Prosesor</th>
                    <th scope="col">Kamera Depan</th>
                    <th scope="col">Sistem Operasi</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;?>
            @foreach($data['resultnormalisasi'] as $item)
                <tr class="table-<?php if($i%2==0) {
                    echo "secondary";
                }else{
                    echo "light";
                }?>">
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ str_replace('_',' ',$item['nama'])}}</td>
                    <td>{{ $item['Ukuran_Layar']}}</td>
                    <td>{{ $item['Harga']}}</td>
                    <td>{{ $item['RAM']}}</td>
                    <td>{{ $item['Kamera_Belakang']}}</td>
                    <td>{{ $item['Baterai']}}</td>
                    <td>{{ $item['Memori']}}</td>
                    <td>{{ $item['Prosesor']}}</td>
                    {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                    <td>{{ $item['Kamera_Depan']}}</td>
                    <td>{{ $item['Sistem_Operasi']}}</td>
                </tr>
            <?php $i++;?>
            @endforeach
            </tbody>
        </table>
        <h6 class="mt-4 mb-3">4. Hasil Pembobotan</h6>
        <table class="table table-hover">
            <thead>
                <tr style="background-color: #4E73DF; color:white; text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Handphone</th>
                <th scope="col">Hasil</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;?>
            @foreach($data['resultranking'] as $item)
                <tr class="table-<?php if($i%2==0) {
                    echo "secondary";
                }else{
                    echo "light";
                }?>">
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ str_replace('_',' ',$item['nama'])}}</td>
                    <td>{{ $item['total']}}</td>
                </tr>
            <?php $i++;?>
            @endforeach
            </tbody>
        </table>
        <h6 class="mt-4 mb-3">5. Ranking</h6>
        <table class="table table-hover">
            <thead>
                <tr style="background-color: #4E73DF; color:white; text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Handphone</th>
                <th scope="col">Hasil</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;?>
            @foreach($data['resultSAW'] as $item)
                <tr class="table-<?php if($i%2==0) {
                    echo "secondary";
                }else{
                    echo "light";
                }?>">
                    <th scope="row">{{ $i+1 }}</th>
                    <td> <a style="text-decoration:none; color:black;" href="/detail_handphone/{{$item['nama']}}">{{ str_replace('_',' ',$item['nama'])}}</a></td>
                    <td>{{ $item['total']}}</td>
                </tr>
            <?php $i++;?>
            @endforeach
            </tbody>
        </table>
    @endif
</form>

<script>
    var select = document.getElementById('cariAplikasi');
    multi(select,[]);
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection