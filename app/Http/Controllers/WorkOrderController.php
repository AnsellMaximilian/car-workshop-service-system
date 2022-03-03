<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function index()
    {
        return view('work-orders.index');
    }

    public function show(WorkOrder $workOrder)
    {
        return view('work-orders.show', ['workOrder' => $workOrder]);
    }

    public function create()
    {
        return view('work-orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'keluhan' => 'max:255',
        ]);

        $workOrder = new WorkOrder;

        $workOrder->kendaraan_id = $request->kendaraan_id;
        $workOrder->keluhan = $request->keluhan;
        $workOrder->tanggal = now();
        $workOrder->user_id = request()->user()->id;

        $workOrder->save();

        return redirect(route('work-orders.index'));
    }

    public function edit(WorkOrder $workOrder)
    {
        return view('work-orders.edit', ['workOrder' => $workOrder]);
    }

    public function update(WorkOrder $workOrder, Request $request)
    {
        $request->validate([
            'nama' => 'required|max:25',
            'harga' => 'required|numeric|min:0',
        ]);

        $workOrder->nama = $request->nama;
        $workOrder->harga = $request->harga;

        $workOrder->save();

        return redirect(route('work-orders.index'));
    }
}
