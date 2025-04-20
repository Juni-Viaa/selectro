<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class migrasi_pblController extends Controller
{
    public function tampilSatuProduk()
    {
        $produk = DB::table('produk')->where('id_produk', 15)->first();
        return view('deskripsi_produk', ['produk' => $produk]);
    }
}