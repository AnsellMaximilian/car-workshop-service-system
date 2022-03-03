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
        return view('suku-cadangs.edit', ['sukuCadang' => $sukuCadang]);
    }

    public function update(SukuCadang $sukuCadang, Request $request)
    {
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
