<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\PendaftaranService;
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

        if(count(PendaftaranService::getAllNotContinued()) <= 0 ){
            return redirect(route('pendaftaran-services.index'))->with('error', 'Daftar service terlebih dahulu.');
        }
        
        return view('services.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Service::class);

        $request->validate([
            'pendaftaran_service_id' => 'required|exists:pendaftaran_services,id'
        ]);

        $service = new Service;

        $service->waktu_mulai = now();
        $service->pendaftaran_service_id = $request->pendaftaran_service_id;

        $service->save();

        return redirect(route('services.show', $service->id));
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

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        return redirect(route('services.index'));
    }
}
