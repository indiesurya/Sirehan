<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HandphoneController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PenjelajahanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/pencarian', [PencarianController::class, 'searching']);

Route::get('/rekomendasi', function () {
    return view('rekomendasi', [
        'title' => 'Fitur Rekomendasi',
        'page' => 'rekomendasi'
    ]);
});
Route::get('/penjelajahan', [PenjelajahanController::class, 'browsing']);

Route::get('/dashboard',[DashboardController::class, 'index']);

Route::get('/tes', function() {
    return view('tes');
});

Route::get('/detail_handphone/{nama_handphone}', [HandphoneController::class, 'detail']);