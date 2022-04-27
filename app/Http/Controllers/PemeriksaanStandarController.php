<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanStandar;
use Illuminate\Http\Request;

class PemeriksaanStandarController extends Controller
{
    public function index()
    {
        return view('pemeriksaan-standars.index');
    }

    public function show(PemeriksaanStandar $pemeriksaanStandar)
    {
        return view('pemeriksaan-standars.show', ['pemeriksaanStandar' => $pemeriksaanStandar]);
    }

    public function create()
    {
        return view('pemeriksaan-standars.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', PemeriksaanStandar::class);

        $request->validate([
            'nama' => 'required|max:25',
            'deskripsi' => 'max:255',
        ]);

        $pemeriksaanStandar = new PemeriksaanStandar;

        $pemeriksaanStandar->nama = $request->nama;
        $pemeriksaanStandar->deskripsi = $request->deskripsi;

        $pemeriksaanStandar->save();

        return redirect(route('pemeriksaan-standars.index'));
    }

    public function edit(PemeriksaanStandar $pemeriksaanStandar)
    {
        $this->authorize('update', $pemeriksaanStandar);

        return view('pemeriksaan-standars.edit', ['pemeriksaanStandar' => $pemeriksaanStandar]);
    }

    public function update(PemeriksaanStandar $pemeriksaanStandar, Request $request)
    {
        $this->authorize('update', $pemeriksaanStandar);

        $request->validate([
            'nama' => 'required|max:25',
            'deskripsi' => 'max:255',
        ]);

        $pemeriksaanStandar->nama = $request->nama;
        $pemeriksaanStandar->deskripsi = $request->deskripsi;

        $pemeriksaanStandar->save();

        return redirect(route('pemeriksaan-standars.index'));
    }

    public function destroy(PemeriksaanStandar $pemeriksaanStandar)
    {
        $this->authorize('delete', $pemeriksaanStandar);

        $pemeriksaanStandar->delete();

        return redirect(route('pemeriksaan-standars.index'));
    }
}
