<?php

use App\Http\Controllers\EditprodukController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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


Route::get('/informasi_akun', function () {
    return view('informasi_akun');
});

Route::get('/laporan', function () {
    return view('laporan');
});

Route::get('/pencarian', function () {
    return view('pencarian');
});

Route::get('/list_produk', function () {
    return view('produk');
});
