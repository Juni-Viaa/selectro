<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateAkunController extends Controller
{
    public function edit()
    {
        $user = User::first(); // sementara ambil data user pertama
        return view('update_akun', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id); // nanti ini bisa disesuaikan

        if (!$user) {
            return redirect('/update_akun')->with('error', 'User tidak ditemukan!');
        }

        $user->update($request->only('username', 'email', 'phone', 'address'));

        return redirect('/update_akun')->with('success', 'Data berhasil diperbarui!');
    }
}
