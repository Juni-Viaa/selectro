<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeskripsiProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\UpdateAkunController;
use App\Http\Controllers\TambahProdukController;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/login', function () {
//    return view('login');
//});

Route::get('/beranda', function () {
    return view('beranda');
});

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

Route::get('/deskripsi_produk', [DeskripsiProdukController::class, 'tampilSatuProduk']);

Route::get('/update_akun', [UpdateAkunController::class, 'edit']);
Route::post('/update_akun', [UpdateAkunController::class, 'update']);

Route::get('/tambah_produk', [TambahProdukController::class, 'index'])->name('produk.create');
Route::post('/tambah_produk', [TambahProdukController::class, 'store'])->name('produk.store');

Route::get('/pembayaran', [App\Http\Controllers\PembayaranController::class, 'index']);
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index']);


Route::get('/pratikum5', function () {
    return view('pratikum5');
});

Route::get('/migrasi_pbl', [DeskripsiProdukController::class, 'tampilSatuProduk']);