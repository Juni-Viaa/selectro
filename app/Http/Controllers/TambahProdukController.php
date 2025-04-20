<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;

class TambahProdukController extends Controller
{
    public function index()
    {
        return view('tambah_produk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'stok_produk' => 'required|integer',
            'deskripsi_produk' => 'required|string',
            'gambar_produk' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Upload gambar
        $path = $request->file('gambar_produk')->store('produk', 'public');

        // Simpan ke database
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_produk' => $request->kategori_produk,
            'harga_produk' => $request->harga_produk,
            'stok_produk' => $request->stok_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'gambar_produk' => $path,
        ]);

        return redirect()->route('produk.create')->with('success', 'Produk berhasil ditambahkan!');
    }
}
