<?php

namespace App\Http\Controllers;

use App\Models\FakturService;
use App\Models\Service;
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
        
        $this->authorize('create', FakturService::class);

        $servicesReadyToBeInvoiced = Service::getAllInvoicable();

        if(count($servicesReadyToBeInvoiced) <= 0 ){
            return redirect(route('services.index'))->with('error', 'Tidak ada service yang siap dibuat fakturnya.');
        }

        return view('faktur-services.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', FakturService::class);

        $request->validate([
            'service_id' => 'required|exists:services,id'
        ]);

        $fakturService = new FakturService();

        $fakturService->tanggal = now();
        $fakturService->service_id = $request->service_id;

        $fakturService->save();

        return redirect(route('faktur-services.show', $fakturService->id));
        
    }

    public function destroy(FakturService $fakturService)
    {
        $this->authorize('delete', $fakturService);

        $fakturService->delete();

        return redirect(route('faktur-services.index'));
    }

}
