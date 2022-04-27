<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\PendaftaranService;
use Illuminate\Http\Request;

class PendaftaranServiceController extends Controller
{
    public function index()
    {
        return view('pendaftaran-services.index');
    }

    public function create()
    {
        return view('pendaftaran-services.create', [
            'pelanggans' => Pelanggan::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', PendaftaranService::class);

        return redirect(route('pendaftarans-services.index'));
    }

    public function destroy(PendaftaranService $pendaftaranService)
    {
        $this->authorize('delete', $pendaftaranService);

        $pendaftaranService->delete();

        return redirect(route('pendaftaran-services.index'));
    }

    public function edit(PendaftaranService $pendaftaranService)
    {
        $this->authorize('update', $pendaftaranService);

        return view('pendaftaran-services.edit', ['pendaftaranService' => $pendaftaranService]);
    }

    public function update(PendaftaranService $pendaftaranService, Request $request)
    {
        $this->authorize('update', $pendaftaranService);

        // $request->validate([
        //     'nama' => 'required|max:50',
        //     'noTelp' => 'required|max:15',
        //     'email' => 'max:255|email',
        // ]);

        // $pendaftaranService->nama = $request->nama;
        // $pendaftaranService->noTelp = $request->noTelp;
        // $pendaftaranService->email = $request->email;
        // $pendaftaranService->alamat = $request->alamat;

        // $pendaftaranService->save();

        // return redirect(route('pendaftaranServices.index'));
    }

    public function show(PendaftaranService $pendaftaranService)
    {
        return view('pendaftaran-services.show', [
            'pendaftaranService' => $pendaftaranService
        ]);
    }
}
