<?php

namespace App\Http\Controllers;

use App\Models\FakturService;
use Illuminate\Http\Request;

class FakturServiceController extends Controller
{
    public function index()
    {
        return view('faktur-services.index');
    }

    public function show(FakturService $fakturService)
    {
        return view('faktur-services.show', ['fakturService' => $fakturService]);
    }

    public function create()
    {
        return view('faktur-services.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'kendaraan_id' => 'required|exists:kendaraans,id',
        //     'keluhan' => 'max:255',
        // ]);

        // $workOrder = new WorkOrder;

        // $workOrder->kendaraan_id = $request->kendaraan_id;
        // $workOrder->keluhan = $request->keluhan;
        // $workOrder->tanggal = now();
        // $workOrder->user_id = request()->user()->id;

        // $workOrder->save();

        // return redirect(route('faktur-services.index'));
    }

}
