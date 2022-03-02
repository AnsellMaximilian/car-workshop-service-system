<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        return view('pelanggans.index');
    }

    public function create()
    {
        return view('pelanggans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'noTelp' => 'required|max:15',
            'email' => 'max:255|email',
        ]);

        $pelanggan = new Pelanggan;

        $pelanggan->nama = $request->nama;
        $pelanggan->noTelp = $request->noTelp;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;

        $pelanggan->save();

        return redirect(route('pelanggans.index'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggans.edit', ['pelanggan' => $pelanggan]);
    }

    public function update(Pelanggan $pelanggan, Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'noTelp' => 'required|max:15',
            'email' => 'max:255|email',
        ]);

        $pelanggan->nama = $request->nama;
        $pelanggan->noTelp = $request->noTelp;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;

        $pelanggan->save();

        return redirect(route('pelanggans.index'));
    }
}
