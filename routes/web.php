<?php

use App\Http\Controllers\keranjangController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\editprodukController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index']);
Route::get('/index', [IndexController::class, 'index']);
Route::get('/keranjang', [keranjangController::class, 'index']);
Route::get('/editproduk', [editprodukController::class, 'index']);

