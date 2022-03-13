<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
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

        if(count(Kendaraan::all()) <= 0 ){
            return redirect(route('kendaraans.index'))->with('error', 'Daftar kendaraan terlebih dahulu.');
        }
        
        return view('services.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Service::class);

        $request->validate([
            'no_plat' => 'required',
            'keluhan' => 'max:255',
            'pelanggan_id' => 'required|exists:pelanggans,id'
        ]);

        $service = new Service;

        $service->no_plat = $request->no_plat;
        $service->keluhan = $request->keluhan;
        $service->pelanggan_id = $request->pelanggan_id;
        $service->tanggal = now();
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
        if($service->service_selesai){
            return view('services.faktur', ['service' => $service]);
        }else{
            return back()->with('error', 'Selesaikan service dahulu.');
        }
    }
}
