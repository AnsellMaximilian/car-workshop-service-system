<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\Tipe;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        return view('kendaraans.index');
    }

    public function create()
    {
        $this->authorize('create', Kendaraan::class);

        return view('kendaraans.create', [
            'pelanggans' => Pelanggan::all(),
            'tipes' => Tipe::all(),
        ]);
    }

    public function store(Request $request)
    {

        $this->authorize('create', Kendaraan::class);

        $request->validate([
            'no_plat' => 'required|max:20|unique:kendaraans',
            'tipe_id' => 'required|exists:tipes,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
        ]);

        $kendaraan = new Kendaraan;

        $kendaraan->no_plat = $request->no_plat;
        $kendaraan->tipe_id = $request->tipe_id;
        $kendaraan->pelanggan_id = $request->pelanggan_id;
        $kendaraan->warna = $request->warna;

        $kendaraan->save();

        return redirect(route('kendaraans.index'));
    }

    public function edit(Kendaraan $kendaraan)
    {

        $this->authorize('update', Kendaraan::class);

        return view('kendaraans.edit', ['kendaraan' => $kendaraan]);
    }

    public function update(Kendaraan $kendaraan, Request $request)
    {
        $this->authorize('update', Kendaraan::class);


        $request->validate([
            // 'no_plat' => 'required|max:20|unique:kendaraans',
            'tipe_id' => 'required|exists:tipes,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
        ]);

        // $kendaraan->no_plat = $request->no_plat;
        $kendaraan->tipe_id = $request->tipe_id;
        $kendaraan->pelanggan_id = $request->pelanggan_id;
        $kendaraan->warna = $request->warna;

        $kendaraan->save();

        return redirect(route('kendaraans.index'));
    }
}
