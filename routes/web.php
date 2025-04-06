<?php

use App\Http\Controllers\EditprodukController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index']);
Route::get('/index', [IndexController::class, 'index']);
Route::get('/editproduk', [EditprodukController::class, 'index']);
Route::get('/keranjang', [KeranjangController::class, 'index']);

