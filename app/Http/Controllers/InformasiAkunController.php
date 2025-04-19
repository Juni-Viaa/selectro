<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiAkunController extends Controller
{
    public function index (){
        return view ('informasi_akun');
    }
}
