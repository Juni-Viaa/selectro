<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Sesuaikan jika berbeda

    protected $fillable = [
        'nama_produk',
        'kategori_produk',
        'harga_produk',
        'stok_produk',
        'deskripsi_produk',
        'gambar_produk',
    ];
}