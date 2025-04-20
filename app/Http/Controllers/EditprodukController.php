<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditprodukController extends Controller
{
    public function eproduk()
    {
        return view('Editproduk');
    }

    public function epesanan()
    {
        return view('Editpesanan');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function gantipassword()
    {
        return view('gantipassword');
    }

    public function konfirmasipesanan()
    {
        return view('konfirmasipesanan');
    }

    public function pesanan()
    {
        return view('pesanan');
    }


}
