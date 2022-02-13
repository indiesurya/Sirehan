@extends('layouts.layout')
@section('container')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center px-3">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Data)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
@foreach($handphone['handphone'] as $hp)
    <div class="col-md-3 col-sm-6 mb-2 justify-content-center">
        <div class="card">
            <img src="img/hp1.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $hp['nama_handphone'] }}</h5>
                <?php $nama_handphone = str_replace(' ','_',$hp['nama_handphone']) ?>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="/detail_handphone/{{$nama_handphone}}" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
@endforeach
</div> 
@endsection