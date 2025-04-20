<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditprodukController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use app\Http\Controllers\dashboardController;
use app\Http\Controllers\EditPesananController;
use app\Http\Controllers\GantiPasswordController;
use app\Http\Controllers\KonfirmasiPesananController;
use app\Http\Controllers\PesananController;

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
Route::get('/editproduk', [EditprodukController::class, 'eproduk']);
Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::get('/editpesanan', [EditprodukController::class, 'epesanan']);
Route::get('/gantipassword', [EditprodukController::class, 'gantipassword']);
Route::get('/konfirmasipesanan', [EditprodukController::class, 'konfirmasipesanan']);
Route::get('/pesanan', [EditprodukController::class, 'pesanan']);
Route::get('/dashboard', [EditprodukController::class, 'dashboard']);


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



