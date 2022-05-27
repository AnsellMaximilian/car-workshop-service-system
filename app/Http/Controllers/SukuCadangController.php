<?php

namespace App\Http\Controllers;

use App\Models\SukuCadang;
use Illuminate\Http\Request;

class SukuCadangController extends Controller
{
    public function index()
    {
        return view('suku-cadangs.index');
    }

    public function show(SukuCadang $sukuCadang)
    {
        return view('suku-cadangs.show', ['sukuCadang' => $sukuCadang]);
    }

    public function create()
    {
        return view('suku-cadangs.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', SukuCadang::class);
        
        $request->validate([
            'nama' => 'required|max:25',
            'stok_awal' => 'numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $sukuCadang = new SukuCadang();

        $sukuCadang->nama = $request->nama;
        $sukuCadang->stok_awal = $request->stok_awal;
        $sukuCadang->harga = $request->harga;

        $sukuCadang->save();

        return redirect(route('suku-cadangs.index'));
    }

    public function edit(SukuCadang $sukuCadang)
    {
        $this->authorize('update', $sukuCadang);

        return view('suku-cadangs.edit', ['sukuCadang' => $sukuCadang]);
    }

    public function destroy(SukuCadang $sukuCadang)
    {
        $this->authorize('delete', $sukuCadang);

        if(
            count($sukuCadang->penggantian_suku_cadangs) > 0 ||
            count($sukuCadang->pengeluaran_suku_cadangs) > 0 ||
            count($sukuCadang->pemasukkan_suku_cadangs) > 0 ||
            count($sukuCadang->perkiraan_suku_cadangs) > 0 
        ) {
            return redirect(route('suku-cadangs.index'))->with('error', 'Tidak bisa dihapus.');
        }

        $sukuCadang->delete();

        return redirect(route('suku-cadangs.index'));
    }

    public function update(SukuCadang $sukuCadang, Request $request)
    {
        $this->authorize('update', $sukuCadang);

        $request->validate([
            'nama' => 'required|max:25',
            'harga' => 'required|numeric|min:0',
        ]);

        $sukuCadang->nama = $request->nama;
        $sukuCadang->harga = $request->harga;

        $sukuCadang->save();

        return redirect(route('suku-cadangs.index'));
    }
}
