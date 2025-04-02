<?php

use Illuminate\Support\Facades\Route;

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