<?php

namespace App\Http\Controllers;

use App\Models\FakturService;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('pembayarans.index');
    }

    public function create()
    {
        $this->authorize('create', Pelanggan::class);

        if(count(FakturService::all()) <= 0){
            return redirect(route('pembayarans.index'))->with('error', 'Tidak ada faktur yang bisa dibayar.');
        }
        return view('pembayarans.create');
    }

    // public function store(Request $request)
    // {
    //     $this->authorize('create', Pembayaran::class);

    //     $request->validate([
    //         'faktur_service_id' => 'required|exists:faktur_services,id',
    //         'jumlah' => 'required|numeric|min:0',
    //         'keterangan' => 'max:255',
    //     ]);

    //     $pembayaran = new Pembayaran();

    //     $pembayaran->faktur_service_id = $request->faktur_service_id;
    //     $pembayaran->jumlah = $request->jumlah;
    //     $pembayaran->keterangan = $request->keterangan;

    //     $pembayaran->save();

    //     return redirect(route('pelanggans.index'));
    // }

}
