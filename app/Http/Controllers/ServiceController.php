<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index');
    }

    public function show(Service $service)
    {
        return view('services.show', ['service' => $service]);
    }

    public function create()
    {
        $this->authorize('create', Service::class);
        
        return view('services.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Service::class);

        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'keluhan' => 'max:255',
        ]);

        $service = new Service;

        $service->kendaraan_id = $request->kendaraan_id;
        $service->keluhan = $request->keluhan;
        $service->tanggal_pendaftaran = now();
        $service->user_id = request()->user()->id;

        $service->save();

        return redirect(route('services.index'));
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);

        return view('services.edit', ['service' => $service]);
    }

    public function update(Service $service, Request $request)
    {
        $this->authorize('update', $service);

        $request->validate([
            'nama' => 'required|max:25',
            'harga' => 'required|numeric|min:0',
        ]);

        $service->nama = $request->nama;
        $service->harga = $request->harga;

        $service->save();

        return redirect(route('services.index'));
    }

    public function invoice(Service $service)
    {
        return view('services.faktur', ['service' => $service]);
    }
}
