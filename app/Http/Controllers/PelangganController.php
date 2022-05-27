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
        $this->authorize('create', Pelanggan::class);

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

    public function destroy(Pelanggan $pelanggan)
    {
        $this->authorize('delete', $pelanggan);

        if(count($pelanggan->pendaftaran_services) > 0){
            return redirect(route('pelanggans.index'))->with('error', 'Tidak bisa dihapus.');
        }
        
        $pelanggan->delete();
        return redirect(route('pelanggans.index'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        $this->authorize('update', $pelanggan);

        return view('pelanggans.edit', ['pelanggan' => $pelanggan]);
    }

    public function update(Pelanggan $pelanggan, Request $request)
    {
        $this->authorize('update', $pelanggan);

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
