<?php

namespace App\Http\Controllers;

use App\Models\JenisService;
use Illuminate\Http\Request;

class JenisServiceController extends Controller
{
    public function index()
    {
        return view('jenis-services.index');
    }

    public function show(JenisService $jenisService)
    {
        return view('jenis-services.show', ['jenisService' => $jenisService]);
    }

    public function create()
    {
        return view('jenis-services.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', JenisService::class);

        $request->validate([
            'nama' => 'required|max:25',
            'deskripsi' => 'max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $jenisService = new JenisService;

        $jenisService->nama = $request->nama;
        $jenisService->deskripsi = $request->deskripsi;
        $jenisService->harga = $request->harga;

        $jenisService->save();

        return redirect(route('jenis-services.index'));
    }

    public function edit(JenisService $jenisService)
    {
        $this->authorize('update', $jenisService);

        return view('jenis-services.edit', ['jenisService' => $jenisService]);
    }

    public function update(JenisService $jenisService, Request $request)
    {
        $this->authorize('update', $jenisService);

        $request->validate([
            'nama' => 'required|max:25',
            'deskripsi' => 'max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $jenisService->nama = $request->nama;
        $jenisService->deskripsi = $request->deskripsi;
        $jenisService->harga = $request->harga;

        $jenisService->save();

        return redirect(route('jenis-services.index'));
    }

    public function destroy(JenisService $jenisService)
    {
        $this->authorize('delete', $jenisService);

        $jenisService->delete();

        return redirect(route('jenis-services.index'));
    }
}
