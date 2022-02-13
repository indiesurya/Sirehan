@extends('layouts.layout')
@section('container')
    <div class="input-group mb-3">
        <label class="input-group-text">Ukuran Kenyamanan</label>
        <select class="form-select" aria-label="Default select example">
            <option selected>Pilihlah salah satu</option>
            <option value="1">Kecil</option>
            <option value="2">Sedang</option>
            <option value="3">Besar</option>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection