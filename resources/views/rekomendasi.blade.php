@extends('layouts.layout')
@section('container')
<form action="" method="GET" id="rekomendasi">
    <div class="input-group mb-3">
        <label class="input-group-text">Ukuran Kenyamanan</label>
        <select class="form-select" aria-label="Default select example" name="cari_ukuranlayar">
            <option selected>Pilihlah salah satu</option>
            <option value="kecil">Kecil</option>
            <option value="sedang">Sedang</option>
            <option value="besar">Besar</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text">Lama Aktivitas Sehari</label>
        <input type="text" class="form-control">
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text">Fotografi atau Videografi</label>
        <input type="text" class="form-control">
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text">Budget Pembelian</label>
        <input type="text" class="form-control">
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text mt-0">Aplikasi Digunakan</label>
        <select class="selectpicker form-control" multiple aria-label="size 3 select example">
            <option value="1">Figma</option>
            <option value="2">Line</option>
            <option value="3">Whatsapp</option>
            <option value="4">Instagram</option>
            <option value="1">Figma</option>
            <option value="2">Line</option>
            <option value="3">Whatsapp</option>
            <option value="4">Instagram</option>
            <option value="1">Figma</option>
            <option value="2">Line</option>
            <option value="3">Whatsapp</option>
            <option value="4">Instagram</option>
            <option value="1">Figma</option>
            <option value="2">Line</option>
            <option value="3">Whatsapp</option>
            <option value="4">Instagram</option>
            <option value="1">Figma</option>
            <option value="2">Line</option>
            <option value="3">Whatsapp</option>
            <option value="4">Instagram</option>
            <option value="1">Figma</option>
            <option value="2">Line</option>
            <option value="3">Whatsapp</option>
            <option value="4">Instagram</option>
        </select>
    </div>
    <input type="submit" name="rekomendasi" value="Rekomendasi" class="btn btn-primary">
    @if($data['jumlahcari'] == 0)
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
    @elseif($data['resp'] == 1 && $data['jumlahcari'] == 0)
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
    @else
        <h5 class="mt-2">1. Tabel Spesifikasi Handphone</h5>
        <table class="table">
            <thead>
                <tr>
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
            <?php $i = 0;?>
            @foreach($data['resultspesifikasi'] as $item)
            <tbody>
                <tr>
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['nama']}}</td>
                <td>{{ $item['ukuranlayar']}}</td>
                <td>{{ $item['harga']}}</td>
                <td>{{ $item['ram']}}</td>
                <td>{{ $item['kb']}}</td>
                <td>{{ $item['baterai']}}</td>
                <td>{{ $item['memori']}}</td>
                <td>{{ $item['prosesor']}}</td>
                {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                <td>{{ $item['kd']}}</td>
                <td>{{ $item['so']}}</td>
                </tr>
            </tbody>
            <?php $i++;?>
            @endforeach
        </table>
        <h5 class="mt-2">2. Nilai atau Bobot Handphone</h5>
        <table class="table">
            <thead>
                <tr>
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
            <?php $i = 0;?>
            @foreach($data['resultbobot'] as $item)
            <tbody>
                <tr>
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['nama']}}</td>
                <td>{{ $item['ukuranlayar']}}</td>
                <td>{{ $item['harga']}}</td>
                <td>{{ $item['ram']}}</td>
                <td>{{ $item['kb']}}</td>
                <td>{{ $item['baterai']}}</td>
                <td>{{ $item['memori']}}</td>
                <td>{{ $item['prosesor']}}</td>
                {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                <td>{{ $item['kd']}}</td>
                <td>{{ $item['so']}}</td>
                </tr>
            </tbody>
            <?php $i++;?>
            @endforeach
        </table>
        <h5 class="mt-2">3. Normalisasi</h5>
        <table class="table">
            <thead>
                <tr>
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
            <?php $i = 0;?>
            @foreach($data['resultspesifikasi'] as $item)
            <tbody>
                <tr>
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['nama']}}</td>
                <td>{{ $item['ukuranlayar']}}</td>
                <td>{{ $item['harga']}}</td>
                <td>{{ $item['ram']}}</td>
                <td>{{ $item['kb']}}</td>
                <td>{{ $item['baterai']}}</td>
                <td>{{ $item['memori']}}</td>
                <td>{{ $item['prosesor']}}</td>
                {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                <td>{{ $item['kd']}}</td>
                <td>{{ $item['so']}}</td>
                </tr>
            </tbody>
            <?php $i++;?>
            @endforeach
        </table>
        <h5 class="mt-2">4. Perangkingan</h5>
        <table class="table">
            <thead>
                <tr>
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
            <?php $i = 0;?>
            @foreach($data['resultspesifikasi'] as $item)
            <tbody>
                <tr>
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['nama']}}</td>
                <td>{{ $item['ukuranlayar']}}</td>
                <td>{{ $item['harga']}}</td>
                <td>{{ $item['ram']}}</td>
                <td>{{ $item['kb']}}</td>
                <td>{{ $item['baterai']}}</td>
                <td>{{ $item['memori']}}</td>
                <td>{{ $item['prosesor']}}</td>
                {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                <td>{{ $item['kd']}}</td>
                <td>{{ $item['so']}}</td>
                </tr>
            </tbody>
            <?php $i++;?>
            @endforeach
        </table>
        <h5 class="mt-2">5. Hasil</h5>
        <table class="table">
            <thead>
                <tr>
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
            <?php $i = 0;?>
            @foreach($data['resultspesifikasi'] as $item)
            <tbody>
                <tr>
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['nama']}}</td>
                <td>{{ $item['ukuranlayar']}}</td>
                <td>{{ $item['harga']}}</td>
                <td>{{ $item['ram']}}</td>
                <td>{{ $item['kb']}}</td>
                <td>{{ $item['baterai']}}</td>
                <td>{{ $item['memori']}}</td>
                <td>{{ $item['prosesor']}}</td>
                {{-- <td>{{ $data['nilai'][0]['nprosesor']}}</td> --}}
                <td>{{ $item['kd']}}</td>
                <td>{{ $item['so']}}</td>
                </tr>
            </tbody>
            <?php $i++;?>
            @endforeach
        </table>
    @endif
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection