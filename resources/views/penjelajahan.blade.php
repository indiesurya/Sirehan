@extends('layouts.layout')
@section('container')
<form action="" method="GET" id="cari_spesifikasi">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <label class="input-group-text">Merek</label>
                <select class="form-select" aria-label="Default select example" id="browse" name="browse">
                    <option value="">Pilihlah salah satu</option>
                    @foreach($data['merek'] as $item)
                        <option value="{{ $item['merek'] }}">{{ $item['merek'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <input type="submit" name="browsing" value="Jelajah" class="btn btn-primary">
    <input type="submit" name="reset" value="Reset" class="btn btn-danger">
</form>
<div class="row">
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Penjelajahan</h6>
                </div>
                <div class="card-body">
                    @if($data['resp'] == 0)
                        <h4 class="small font-weight-bold">Belum terdapat pencarian data<span> </h4>
                    @elseif($data['resp'] == 1 && $data['jumlahbrowse'] == 0)
                        <h4 class="small font-weight-bold">Data tidak ditemukan<span></h4>
                    @else
                        @foreach ($data['result'] as $item)
                        <ul class="list-group list-group-flush">
                            <a href="/detail_handphone/{{$item['browse']}}" class="list-group-item list-group-item-action">{{ str_replace('_',' ',$item['browse']) }}</li></a>
                        </ul>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection