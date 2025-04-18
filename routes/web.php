<?php

use App\Http\Controllers\EditprodukController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/login', function () {
//    return view('login');
//});

Route::get('/beranda', function () {
    return view('beranda');
});


Route::get('/login', [LoginController::class, 'index']);
Route::get('/index', [IndexController::class, 'index']);
Route::get('/editproduk', [EditprodukController::class, 'index']);
Route::get('/keranjang', [KeranjangController::class, 'index']);


Route::get('/informasi_akun', [InformasiAkunController::class, 'index']);
Route::get('/beranda', [BerandaController::class, 'index']);
Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/pencarian', [PencarianController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index']);